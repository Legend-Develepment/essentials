/*
 * The rule that decides which ports a bought server may land on.
 *
 * Two numbers on a package, and three separate places have to agree about what
 * they mean: the form that takes them, the save that stores them, and
 * Provision that narrows the allocation query with them. Ported here because
 * the interesting part is the reasoning and not the database - and because the
 * one thing that went wrong with it so far was exactly a disagreement between
 * two of those three, with the form collecting a range the save threw away.
 *
 * The rule, in one line: both ends or neither, each a port that can exist, and
 * a range typed backwards is the range the person meant.
 */
let pass = 0;
let fail = 0;

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.log('  FAIL ' + label + '\n    got  ' + JSON.stringify(got) + '\n    want ' + JSON.stringify(want));
};

/* ------------------------------------------------- Ports, line for line ---- */

const LOWEST = 1024;
const HIGHEST = 65535;
const WARN_AT = 5;

/** Ports::sanitise() - one end, as it should be stored. */
const sanitise = (value) => {
    const port = Number.parseInt(value, 10) || 0;

    return port >= LOWEST && port <= HIGHEST ? port : null;
};

/** Ports::of() - the pair, or nothing. */
const of = (from, to) => {
    from = Number.parseInt(from, 10) || 0;
    to = Number.parseInt(to, 10) || 0;

    if (from <= 0 || to <= 0) return null;

    if (from > to) [from, to] = [to, from];

    if (from < LOWEST || to > HIGHEST) return null;

    return { from, to };
};

/** What Packages::sanitise() now does with the two form fields. */
const stored = (data) => {
    const range = of(sanitise(data.port_from ?? null), sanitise(data.port_to ?? null));

    return { port_from: range === null ? null : range.from, port_to: range === null ? null : range.to };
};

/* --------------------------------------------------------- one end alone ---- */

check('a port is a port', sanitise(5000), 5000);
check('the floor is inclusive', sanitise(LOWEST), LOWEST);
check('and the ceiling too', sanitise(HIGHEST), HIGHEST);
check('below the floor is nothing', sanitise(80), null);
check('above the ceiling is nothing', sanitise(70000), null);
check('zero is nothing', sanitise(0), null);
check('and so is a word', sanitise('nonsense'), null);
check('an empty field is nothing', sanitise(''), null);
check('digits typed as text still count', sanitise('5000'), 5000);

/* ------------------------------------------------------------- the pair ---- */

check('both ends make a range', of(5000, 5100), { from: 5000, to: 5100 });
check('one port is a range', of(7000, 7000), { from: 7000, to: 7000 });
check('backwards is turned round', of(5100, 5000), { from: 5000, to: 5100 });

/*
 * Half a range is no range.
 *
 * This is the rule that keeps the rest of the plugin simple: every reader would
 * otherwise have to decide what the missing end meant, and each of them would
 * be deciding something the person filling in the form did not say.
 */
check('a first end alone is nothing', of(5000, null), null);
check('a second end alone is nothing', of(null, 5100), null);
check('neither is nothing', of(null, null), null);

check('an end below the floor takes the range with it', of(80, 5100), null);
check('and an end above the ceiling does too', of(5000, 70000), null);

/* ------------------------------------------- what the save actually keeps ---- */

check('a range typed in is a range stored',
    stored({ port_from: 5000, port_to: 5100 }), { port_from: 5000, port_to: 5100 });

check('typed backwards, stored forwards',
    stored({ port_from: 5100, port_to: 5000 }), { port_from: 5000, port_to: 5100 });

check('a form that left them empty stores nothing',
    stored({}), { port_from: null, port_to: null });

check('and empty strings are empty, not zero',
    stored({ port_from: '', port_to: '' }), { port_from: null, port_to: null });

/*
 * Clearing one field clears the range.
 *
 * Somebody who empties the first box has decided this package no longer has a
 * range, and storing the other end would leave a package that says 0 to 5100
 * to every reader and cannot be cleared from the form at all.
 */
check('emptying one end clears both',
    stored({ port_from: '', port_to: 5100 }), { port_from: null, port_to: null });

check('a port that cannot exist clears both',
    stored({ port_from: 80, port_to: 5100 }), { port_from: null, port_to: null });

/* ------------------------------------------------------- the warning line ---- */

const low = (free) => free <= WARN_AT;

check('five free is already low', low(5), true);
check('six is not', low(6), false);
check('none left is low', low(0), true);

/*
 * A range over ports nobody made.
 *
 * It narrows and never invents: a range does not create allocations, so a
 * range nobody has made ports in finds nothing, counts nothing, and is low
 * from the moment it is saved. Which is the point of the warning - it says so
 * before a customer pays rather than after.
 */
check('a range with no allocations in it is low from the start', low(0), true);

/* -------------------------------------------- which of the two keys speaks ---- */

/*
 * The warning and the denial are separate rows, and only one of them may talk.
 *
 * With a single row a range that was already low and then ran out said nothing
 * at all, because it was bad before and bad after. Two rows fix that and bring
 * their own way of being wrong: both clearing at once, or the wrong one
 * speaking because State happened to silence the other. So the level decides,
 * not the order.
 */
const level = (free, was) => {
    if (free === 0) return 'out';

    return free <= (was === 'low' ? WARN_AT + 1 : WARN_AT) ? 'low' : 'fine';
};

// What State would answer for each row, given the level now and before.
const rows = (now, was) => ({
    out: now === 'out' ? 'bad' : 'ok',
    low: now === 'fine' ? 'ok' : 'bad',
    wasOut: was === 'out' ? 'bad' : 'ok',
    wasLow: was === 'fine' ? 'ok' : 'bad',
});

// 'raised' when it turns bad, 'cleared' when it turns good, nothing otherwise.
const kind = (was, now) => (was === now ? null : now === 'bad' ? 'raised' : 'cleared');

/** The one message a pass sends about a package, or null. */
const speaks = (was, now) => {
    const r = rows(now, was);
    const out = kind(r.wasOut, r.out);

    if (out !== null) return 'out:' + out;

    // While the range is empty the low row says nothing whatever State answers.
    if (now === 'out') return null;

    const low = kind(r.wasLow, r.low);

    return low === null ? null : 'low:' + low;
};

check('plenty stays quiet', speaks('fine', 'fine'), null);
check('dipping under the line warns once', speaks('fine', 'low'), 'low:raised');
check('and does not warn again', speaks('low', 'low'), null);

/*
 * The one that was missing.
 *
 * Already warned about, then completely empty: with one row this was bad
 * followed by bad and the panel said nothing, which is the message that
 * mattered most of the three.
 */
check('running out after the warning still says so', speaks('low', 'out'), 'out:raised');

check('and straight from plenty to empty says so too', speaks('fine', 'out'), 'out:raised');
check('and does not repeat it', speaks('out', 'out'), null);

/*
 * Coming back says one thing.
 *
 * Both rows clear at once here, and two messages - "there is room again" and
 * "there is room again" - is how somebody learns to stop reading these.
 */
check('coming back from empty says it once', speaks('out', 'fine'), 'out:cleared');
check('coming back to nearly out says so', speaks('out', 'low'), 'out:cleared');
check('climbing off the line says it once', speaks('low', 'fine'), 'low:cleared');

/* ------------------------------------------------------------- the band ------- */

check('five free warns', level(5, 'fine'), 'low');
check('six does not', level(6, 'fine'), 'fine');

/*
 * The band, which is the whole of the hysteresis.
 *
 * A range sitting at six free that one purchase pushes to five and one
 * cancellation pushes back would otherwise announce itself both ways every
 * pass, for ever.
 */
check('six free while already low stays low', level(6, 'low'), 'low');
check('seven is what it takes to be well again', level(7, 'low'), 'fine');

/* ---------------------------------------------------------------------------- */

console.log(fail === 0
    ? 'Ports: ' + pass + ' checks, all passed.'
    : 'Ports: ' + fail + ' of ' + (pass + fail) + ' failed.');

process.exit(fail === 0 ? 0 : 1);
