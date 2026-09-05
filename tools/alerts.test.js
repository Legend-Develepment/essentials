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

console.log('\nwatchdog deduplication: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
