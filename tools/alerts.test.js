/*
 * Alerts\State, ported, because it is the part that decides whether the
 * watchdog is usable or unbearable.
 *
 * The checks themselves are a list of conditions anybody can read down and
 * argue with. This is the awkward half: a node that goes down at three in the
 * morning and is fixed at nine is *one* event, and a check running every five
 * minutes turns it into seventy-two messages. Seventy-two messages is a channel
 * people mute, and a muted channel is worse than no watchdog at all, because the
 * next outage arrives somewhere nobody is looking.
 *
 * Four behaviours, each of which the obvious implementation gets wrong:
 *
 *  1. Speak on a change, in either direction. Recovery is news.
 *  2. Say nothing on the first run. A fresh state file makes every check
 *     "changed", so switching the feature on would deliver one message per node
 *     per check describing a panel that is fine.
 *  3. An unreadable reading is not a failure until it happens twice. One timed
 *     out daemon says something about the network for two seconds, not about
 *     the node.
 *  4. Repeat a standing problem only when asked, and never by default.
 */
let pass = 0;
let fail = 0;

const check = (label, got, want) => {
    if (got === want) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + '\n        got  ' + JSON.stringify(got) + '\n        want ' + JSON.stringify(want));
};

/* ------------------------------------------------------------- the port -- */

const OK = 'ok';
const BAD = 'bad';
const UNREADABLE = 'unreadable';

/*
 * A fresh State, with time under the test's control.
 *
 * `now` is a function rather than a value because the repeat rule is entirely
 * about elapsed time, and a test that had to sleep for it would be a test
 * nobody runs.
 */
function makeState() {
    let rows = {};
    let clock = 1000000;

    const fresh = () => Object.keys(rows).length === 0;

    return {
        tick: (seconds) => { clock += seconds; },
        rows: () => rows,
        standing: (key) => (rows[key] ? clock - rows[key].since : null),

        record(key, result, repeat = 0) {
            const quiet = fresh();
            const row = rows[key] ?? { state: OK, since: clock, told: 0, unread: 0 };

            if (result === UNREADABLE) {
                row.unread += 1;

                if (row.unread < 2) {
                    rows[key] = row;
                    return null;
                }

                result = BAD;
            } else {
                row.unread = 0;
            }

            const changed = row.state !== result;

            if (changed) {
                row.state = result;
                row.since = clock;
                row.told = clock;
            }

            rows[key] = row;

            const due = !changed && result === BAD && repeat > 0 && clock - row.told >= repeat;

            if (due) {
                rows[key].told = clock;
            }

            if (quiet) {
                return null;
            }

            if (changed) {
                return result === BAD ? 'raised' : 'cleared';
            }

            return due ? 'reminder' : null;
        },
    };
}

console.log('watchdog deduplication\n');

/* ---------------------------------------------------- the quiet first run -- */

{
    const s = makeState();

    // Everything is wrong, and it is a brand new install. It learns and says
    // nothing - otherwise switching the feature on delivers a flood.
    check('first run says nothing, even about a failure', s.record('a', BAD), null);
    check('the failure is still recorded', s.rows().a.state, BAD);

    // The second check in the same run is no longer the first run.
    check('a second key in the same run does speak', s.record('b', BAD), 'raised');
}

/* --------------------------------------------------------- change, twice -- */

{
    const s = makeState();
    s.record('seed', OK);

    check('a failure is raised', s.record('n', BAD), 'raised');
    check('the same failure again is silent', s.record('n', BAD), null);
    check('and again', s.record('n', BAD), null);
    check('and again', s.record('n', BAD), null);
    check('recovery is news', s.record('n', OK), 'cleared');
    check('still fine is silent', s.record('n', OK), null);
    check('a second failure is raised again', s.record('n', BAD), 'raised');
}

/* --------------------------------------------------- unreadable readings -- */

{
    const s = makeState();
    s.record('seed', OK);

    check('one unreadable says nothing', s.record('u', UNREADABLE), null);
    check('two in a row is a failure', s.record('u', UNREADABLE), 'raised');

    const t = makeState();
    t.record('seed', OK);

    // The count resets, so a check flickering between unreadable and fine never
    // accumulates its way to an alert.
    check('unreadable, then fine, says nothing', t.record('f', UNREADABLE), null);
    check('the good reading is silent too', t.record('f', OK), null);
    check('one unreadable again is still not enough', t.record('f', UNREADABLE), null);
    check('nor is the next good one', t.record('f', OK), null);
}

/* ---------------------------------------------------------- the reminder -- */

{
    const s = makeState();
    s.record('seed', OK);

    const hour = 3600;

    check('raised', s.record('r', BAD, 6 * hour), 'raised');

    s.tick(hour);
    check('an hour later, nothing', s.record('r', BAD, 6 * hour), null);

    s.tick(4 * hour);
    check('five hours in, still nothing', s.record('r', BAD, 6 * hour), null);

    s.tick(hour);
    check('six hours in, a reminder', s.record('r', BAD, 6 * hour), 'reminder');

    s.tick(hour);
    check('an hour after the reminder, nothing', s.record('r', BAD, 6 * hour), null);

    s.tick(6 * hour);
    check('six hours after it, another', s.record('r', BAD, 6 * hour), 'reminder');

    // The default, and the one that matters: nobody gets a reminder because it
    // seemed thorough.
    const q = makeState();
    q.record('seed', OK);
    q.record('n', BAD);
    q.tick(365 * 24 * hour);
    check('with no repeat asked for, never', q.record('n', BAD), null);
}

/* ------------------------------------------------------------- duration -- */

{
    const s = makeState();
    s.record('seed', OK);
    s.record('d', BAD);

    s.tick(7200);
    check('standing is measured from the change', s.standing('d'), 7200);

    s.record('d', BAD);
    check('a repeated reading does not reset it', s.standing('d'), 7200);

    s.record('d', OK);
    check('a change does reset it', s.standing('d'), 0);
}

/* ------------------------------------------------------ keys are separate -- */

{
    const s = makeState();
    s.record('seed', OK);

    check('one node failing', s.record('node.1.disk', BAD), 'raised');
    check('another node is its own question', s.record('node.2.disk', BAD), 'raised');
    check('and another check on the first node too', s.record('node.1.memory', BAD), 'raised');
    check('the first is still silent', s.record('node.1.disk', BAD), null);
}

/* ------------------------------------------------- the signed bot channel -- */

/*
 * Notifier::bot() refuses to send twice over, and both refusals matter.
 *
 * Plain http would put which of your machines is down on the wire in clear
 * text; an empty secret would mean an unsigned webhook, which is an address
 * anybody who learns it can post to - and for this payload that means anybody
 * can tell a Discord server that a node is down.
 */
const sendable = (url, secret) => {
    const address = String(url ?? '').trim();

    if (address === '' || !address.toLowerCase().startsWith('https://')) return 'no address, or not https';
    if (String(secret ?? '').trim() === '') return 'no signing secret';

    return null;
};

check('https and a secret', sendable('https://bot.example/hook', 's3cret'), null);
check('plain http is refused', sendable('http://bot.example/hook', 's3cret'), 'no address, or not https');
check('no address', sendable('', 's3cret'), 'no address, or not https');
check('https but no secret', sendable('https://bot.example/hook', ''), 'no signing secret');
check('a secret of spaces is no secret', sendable('https://bot.example/hook', '   '), 'no signing secret');
check('neither', sendable('', ''), 'no address, or not https');

// HTTPS is checked without case mattering, because somebody will paste one.
check('uppercase scheme still counts', sendable('HTTPS://bot.example/hook', 's3cret'), null);


/* ------------------------------------------------ the file, and who owns it -- */

/*
 * The rows live in a file and more than one process writes it, which the model
 * above cannot show because it has no file at all.
 *
 * The panel runs the watchdog on a queue worker: one PHP process handling many
 * jobs, holding its rows in a static that used to be read once and kept for the
 * life of the process. Reset in the browser is a different process. So the
 * worker would write its own remembered rows back over an emptied file, and the
 * button did nothing - proven on the live panel before this was changed.
 *
 * Two rules fix it and both are modelled here: a pass starts by reading the file
 * again, and a write puts back only the keys that pass actually changed.
 */

function makeFile() {
    let content = {};

    return {
        read: () => JSON.parse(JSON.stringify(content)),
        write: (rows) => { content = JSON.parse(JSON.stringify(rows)); },
        keys: () => Object.keys(content).sort(),
    };
}

function makeWorker(file) {
    let held = null;
    let touched = {};
    let dropped = {};

    const all = () => {
        if (held === null) held = file.read();
        return held;
    };

    return {
        // The top of a pass.
        refresh() { held = null; touched = {}; dropped = {}; },

        keys: () => Object.keys(all()).sort(),

        set(key, state) {
            const row = { state };
            if (JSON.stringify(all()[key]) === JSON.stringify(row)) return;
            all()[key] = row;
            touched[key] = true;
            delete dropped[key];
        },

        prune(key) {
            delete all()[key];
            delete touched[key];
            dropped[key] = true;
        },

        write() {
            if (Object.keys(touched).length === 0 && Object.keys(dropped).length === 0) {
                return false;
            }

            const rows = file.read();
            for (const key of Object.keys(touched)) {
                if (all()[key] !== undefined) rows[key] = all()[key];
            }
            for (const key of Object.keys(dropped)) delete rows[key];

            file.write(rows);
            held = rows;
            touched = {};
            dropped = {};

            return true;
        },
    };
}

{
    // The case Bryan hit. A worker has been up a while and knows three checks.
    const file = makeFile();
    const worker = makeWorker(file);

    worker.set('node.1', BAD);
    worker.set('node.2', BAD);
    worker.set('node.3', OK);
    worker.write();

    check('the worker has written three rows', file.keys().join(' '), 'node.1 node.2 node.3');

    // Somebody presses Reset in the browser. Another process, another write.
    file.write({});

    // The worker's next pass. It reads the file again first, which is the fix.
    worker.refresh();
    worker.set('node.4', BAD);
    worker.write();

    check('reset holds, and only the new row is there', file.keys().join(' '), 'node.4');
}

{
    /*
     * And without the re-read at the top of a pass, the merge alone still keeps
     * the reset for everything the pass did not touch. Both halves earn their
     * place: this one is what protects a pass already under way.
     */
    const file = makeFile();
    const worker = makeWorker(file);

    worker.set('node.1', BAD);
    worker.set('node.2', BAD);
    worker.write();

    file.write({});

    // No refresh. The worker still believes in node.1 and node.2.
    worker.set('node.2', OK);
    worker.write();

    check('only the key it touched comes back', file.keys().join(' '), 'node.2');
}

{
    // Two passes overlapping, each looking at a different half of the panel.
    const file = makeFile();
    const nodes = makeWorker(file);
    const shop = makeWorker(file);

    nodes.set('node.1', BAD);
    shop.set('shop.stock.7.out', BAD);

    // The shop's pass lands first, the nodes' pass second.
    shop.write();
    nodes.write();

    check('neither pass loses the other', file.keys().join(' '), 'node.1 shop.stock.7.out');
}

{
    // A pass that finds nothing changed writes nothing at all, so it cannot put
    // back rows somebody has just taken away.
    const file = makeFile();
    const worker = makeWorker(file);

    worker.set('node.1', OK);
    check('the first write happens', worker.write(), true);
    check('the second, with nothing changed, does not', worker.write(), false);

    worker.set('node.1', OK);
    check('and setting a row to what it already is changes nothing', worker.write(), false);
}

{
    // A pruned key stays pruned even though the file still had it when the pass
    // began, which is what the stock check needs when a package is withdrawn.
    const file = makeFile();
    const worker = makeWorker(file);

    worker.set('shop.stock.7.out', BAD);
    worker.set('shop.stock.8.out', BAD);
    worker.write();

    worker.refresh();
    worker.set('shop.stock.7.out', BAD);
    worker.prune('shop.stock.8.out');
    worker.write();

    check('the withdrawn package is forgotten', file.keys().join(' '), 'shop.stock.7.out');
}

{
    // And a pass sees what another process did, rather than its own memory.
    const file = makeFile();
    const worker = makeWorker(file);

    worker.set('node.1', BAD);
    worker.write();

    file.write({ 'node.1': { state: OK }, 'node.9': { state: BAD } });

    worker.refresh();
    check('it reads the file, not itself', worker.keys().join(' '), 'node.1 node.9');
}

console.log('\nwatchdog deduplication: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
