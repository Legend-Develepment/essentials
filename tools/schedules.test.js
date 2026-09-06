/*
 * Support\Schedules::verdict(), which is the whole page.
 *
 * Pelican's own status enum has three states and none of them is "this
 * stopped": a run that crashed part way stays `is_processing` for ever and is
 * drawn exactly like one running right now, and a schedule whose time passed
 * hours ago because the cron died is still called Active. This is the function
 * that says otherwise, and everything on the page - the badge, the colour, the
 * sort, the watchdog message - comes out of it.
 *
 * Which makes the *order* of its tests the thing to hold onto. More than one
 * can be true at once, and only the worst is worth showing: a schedule that is
 * switched off cannot meaningfully be overdue, and one that is stuck is stuck
 * whether or not its next run has also passed.
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

const STUCK_HOURS = 6;
const OVERDUE_MINUTES = 60;

const STUCK = 'stuck';
const OVERDUE = 'overdue';
const NEVER = 'never';
const OFF = 'off';
const HEALTHY = 'healthy';

// A fixed now, because every rule here is about elapsed time and a test that
// had to wait for it is a test nobody runs.
const NOW = 1757160000000;
const hoursAgo = (h) => NOW - h * 3600 * 1000;
const minutesAgo = (m) => NOW - m * 60 * 1000;
const inMinutes = (m) => NOW + m * 60 * 1000;

const hoursSince = (at) => at === null ? Number.MAX_SAFE_INTEGER : Math.abs(NOW - at) / 3600000;

function verdict(s) {
    if (!s.is_active) { return OFF; }

    if (s.is_processing && hoursSince(s.last_run_at) >= STUCK_HOURS) { return STUCK; }

    // Still processing, but not for long enough to worry about. Said outright
    // rather than falling through: a schedule running now has no meaningful
    // next run, and calling it overdue would report every long backup as broken.
    if (s.is_processing) { return HEALTHY; }

    if (s.next_run_at === null) { return NEVER; }

    if (s.next_run_at < minutesAgo(OVERDUE_MINUTES)) { return OVERDUE; }

    return HEALTHY;
}

const wrong = (v) => [STUCK, OVERDUE, NEVER].includes(v);

const weight = (v) => ({ [STUCK]: 0, [OVERDUE]: 1, [NEVER]: 2, [HEALTHY]: 3 })[v] ?? 4;

const colour = (v) => {
    if (v === STUCK || v === OVERDUE) { return 'danger'; }
    if (v === NEVER) { return 'warning'; }
    if (v === HEALTHY) { return 'success'; }

    return 'gray';
};

const cron = (s) => [s.cron_minute, s.cron_hour, s.cron_day_of_month, s.cron_month, s.cron_day_of_week].join(' ');

// A healthy, active, recently run schedule due in an hour.
const fine = (over = {}) => ({
    is_active: true,
    is_processing: false,
    last_run_at: hoursAgo(1),
    next_run_at: inMinutes(60),
    ...over,
});

console.log('schedules\n');

/* ------------------------------------------------------------ the healthy -- */

check('active, run recently, due later', verdict(fine()), HEALTHY);
check('due in a minute', verdict(fine({ next_run_at: inMinutes(1) })), HEALTHY);

// Pelican's cron runs every minute, so a few minutes past is a busy queue
// rather than a fault.
check('a few minutes past its time', verdict(fine({ next_run_at: minutesAgo(5) })), HEALTHY);
check('fifty-nine minutes past', verdict(fine({ next_run_at: minutesAgo(59) })), HEALTHY);

/* ------------------------------------------------------------- the stuck -- */

/*
 * The one Pelican cannot say. A crashed run leaves is_processing true for ever
 * and the schedule never fires again, and Pelican draws that identically to one
 * running right now.
 */
check('processing for seven hours', verdict(fine({ is_processing: true, last_run_at: hoursAgo(7) })), STUCK);
check('processing for exactly six', verdict(fine({ is_processing: true, last_run_at: hoursAgo(6) })), STUCK);
check('processing for five is not yet', verdict(fine({ is_processing: true, last_run_at: hoursAgo(5) })), HEALTHY);
check('processing right now', verdict(fine({ is_processing: true, last_run_at: minutesAgo(2) })), HEALTHY);

/*
 * Processing with no last run at all. Null has to mean "for ever" rather than
 * "just now": it has been processing since before anybody recorded when, which
 * is longer than any threshold and not shorter.
 */
check('processing since nobody knows when',
    verdict(fine({ is_processing: true, last_run_at: null })), STUCK);

/* ----------------------------------------------------------- the overdue -- */

check('an hour and a minute past', verdict(fine({ next_run_at: minutesAgo(61) })), OVERDUE);
check('a day past', verdict(fine({ next_run_at: hoursAgo(24) })), OVERDUE);

/* ------------------------------------------------------------- the never -- */

check('active with no next run', verdict(fine({ next_run_at: null })), NEVER);
check('and no last run either', verdict(fine({ next_run_at: null, last_run_at: null })), NEVER);

/* --------------------------------------------------------------- the off -- */

check('switched off', verdict(fine({ is_active: false })), OFF);

/*
 * Off wins over everything, and that is the point of testing the order. A
 * schedule somebody switched off in March is not overdue and is not stuck; it
 * is off, and a page that called it broken would be a page that nags about a
 * decision somebody made on purpose.
 */
check('off beats overdue', verdict(fine({ is_active: false, next_run_at: hoursAgo(500) })), OFF);
check('off beats stuck',
    verdict(fine({ is_active: false, is_processing: true, last_run_at: hoursAgo(500) })), OFF);
check('off beats never', verdict(fine({ is_active: false, next_run_at: null })), OFF);

/* And stuck wins over the rest of them. */
check('stuck beats overdue',
    verdict(fine({ is_processing: true, last_run_at: hoursAgo(9), next_run_at: hoursAgo(9) })), STUCK);
check('stuck beats never',
    verdict(fine({ is_processing: true, last_run_at: hoursAgo(9), next_run_at: null })), STUCK);

/* ------------------------------------------------------ what to act on --- */

/*
 * Off is not something to report. Switching a schedule off is a thing people do
 * deliberately, and a watchdog that mailed about it is one they turn off.
 */
check('stuck is worth saying', wrong(STUCK), true);
check('overdue is', wrong(OVERDUE), true);
check('never run is', wrong(NEVER), true);
check('off is not', wrong(OFF), false);
check('and neither is fine', wrong(HEALTHY), false);

/* ---------------------------------------------------------- how it sorts -- */

// A number rather than an alphabet: "never" sorts above "overdue" as a word,
// and "stuck" below both, which is the reverse of how much they matter.
check('the worst is first',
    [HEALTHY, OFF, OVERDUE, STUCK, NEVER].slice().sort((a, b) => weight(a) - weight(b)),
    [STUCK, OVERDUE, NEVER, HEALTHY, OFF]);

check('the two that need doing are red', [colour(STUCK), colour(OVERDUE)], ['danger', 'danger']);
check('never run is amber, not red', colour(NEVER), 'warning');
check('off is grey', colour(OFF), 'gray');

/* --------------------------------------------------------- the cron line -- */

/*
 * Five fields in the order the file has them, not turned into a sentence.
 * "Every day at 04:00" is friendlier right up to the schedule that does not fit
 * one, and a page describing half its rows and printing the other half is worse
 * than one that prints them all.
 */
check('a nightly schedule',
    cron({ cron_minute: '0', cron_hour: '4', cron_day_of_month: '*', cron_month: '*', cron_day_of_week: '*' }),
    '0 4 * * *');
check('one that does not fit a sentence',
    cron({ cron_minute: '*/5', cron_hour: '2-6', cron_day_of_month: '1,15', cron_month: '*', cron_day_of_week: '1-5' }),
    '*/5 2-6 1,15 * 1-5');

console.log(NEWLINE + 'schedules: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
