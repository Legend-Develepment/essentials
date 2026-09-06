/*
 * Alerts\Owners, and the one rule that keeps it from being a nuisance.
 *
 * This is the only thing in the plugin that writes to people who are not
 * administrators. Everything else the watchdog does goes to whoever configured
 * it, and an administrator is somebody who has to act - so repeating a message
 * to them every quarter hour while a node is down is right. Repeating it to
 * four hundred customers is how a panel's notifications stop being read at all.
 *
 * So the rule is: once when it goes down, once when it comes back, never in
 * between. It rides Alerts\State, which already reports a change as "raised" or
 * "cleared" and a repeat as "reminder" - and the whole of the fix is that a
 * reminder is skipped here while still being sent to the administrator.
 */
let pass = 0;
let fail = 0;

const NEWLINE = String.fromCharCode(10);

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + '\n        got  ' + JSON.stringify(got) + '\n        want ' + JSON.stringify(want));
};

/* -------------------------------------------------------------- the port -- */

const MAX = 200;
const NAMES = 4;

function byOwner(servers) {
    const out = {};

    for (const server of servers) {
        const owner = parseInt(server.owner_id, 10) || 0;

        if (owner <= 0) { continue; }

        (out[owner] ??= []).push(String(server.name));
    }

    return out;
}

function list(names) {
    const shown = names.slice(0, NAMES);
    const rest = names.length - shown.length;

    return shown.join(', ') + (rest > 0 ? ' and ' + rest + ' more' : '');
}

/* How many people one call would write to, cap included. */
function told(servers) {
    const groups = byOwner(servers);
    let n = 0;

    for (const _ of Object.keys(groups)) {
        if (n >= MAX) { break; }

        n++;
    }

    return n;
}

/*
 * The watchdog's half: which events reach the owners at all. State::record()
 * answers 'raised', 'cleared', 'reminder' or nothing, and one() turns the first
 * three into an event.
 */
const reaches = (kind) => kind !== null && kind !== 'reminder';

console.log('owner alerts\n');

/* ------------------------------------------------------ once, and once back */

check('a node going down reaches them', reaches('raised'), true);
check('and coming back does', reaches('cleared'), true);

/*
 * The rule this exists for. The administrator still gets the reminder - it is
 * in the events either way - and the customer does not.
 */
check('a reminder does not', reaches('reminder'), false);
check('and nothing at all does not', reaches(null), false);

/* --------------------------------------------------------- who gets what -- */

const SERVERS = [
    { name: 'mc-one', owner_id: 5 },
    { name: 'mc-two', owner_id: 5 },
    { name: 'rust', owner_id: 6 },
];

check('grouped by who owns them', byOwner(SERVERS), { 5: ['mc-one', 'mc-two'], 6: ['rust'] });
check('two people, two notifications', told(SERVERS), 2);
check('not one per server', told(SERVERS) === SERVERS.length, false);

check('an empty node writes to nobody', told([]), 0);

/*
 * A server with no owner is a row that should not exist and does turn up -
 * Pelican allows the column to be anything the database holds. Writing to
 * nobody is the only sensible answer.
 */
check('a server with no owner is skipped', byOwner([{ name: 'x', owner_id: 0 }]), {});
check('and one with a null owner', byOwner([{ name: 'x', owner_id: null }]), {});

/* ----------------------------------------------------------- the ceiling -- */

/*
 * A node with four hundred servers on it is four hundred notifications from a
 * single check. The cap is not about the database - it is that a check which
 * can write unboundedly is one nobody dares switch on.
 */
{
    const many = [];

    for (let i = 1; i <= MAX + 50; i++) { many.push({ name: 's' + i, owner_id: i }); }

    check('it stops at the cap', told(many), MAX);
}

// One person owning six hundred servers is still one notification, which is
// why the cap counts people rather than rows.
{
    const many = [];

    for (let i = 1; i <= 600; i++) { many.push({ name: 's' + i, owner_id: 5 }); }

    check('six hundred servers, one owner, one notification', told(many), 1);
}

/* -------------------------------------------------------------- the names -- */

check('a few names', list(['a', 'b']), 'a, b');
check('exactly four', list(['a', 'b', 'c', 'd']), 'a, b, c, d');
check('and then a number', list(['a', 'b', 'c', 'd', 'e']), 'a, b, c, d and 1 more');
check('a lot more', list(['a', 'b', 'c', 'd', 'e', 'f', 'g']), 'a, b, c, d and 3 more');
check('none', list([]), '');

console.log(NEWLINE + 'owner alerts: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
