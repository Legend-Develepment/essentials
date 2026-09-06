/*
 * Support\Windows, ported.
 *
 * A window is two times and a style, which sounds like nothing until one of
 * them crosses midnight. "22:00 until 06:00" is not a range in the arithmetic
 * sense - from is greater than to - and every naive comparison gets it exactly
 * backwards, covering the whole day except the night it was written for.
 *
 * The day it belongs to is the second half of the same problem. Friday 22:00
 * until 06:00 means Saturday morning is inside it and Friday morning is not,
 * which means the part after midnight has to be checked against yesterday's
 * name rather than today's. That is the kind of rule that is obvious once
 * written down and silently wrong until somebody notices their weekend theme
 * appearing on Friday.
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

const DAYS = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];

function minutes(value) {
    if (typeof value !== 'string') { return null; }

    const found = /^([0-9]{1,2}):([0-9]{2})$/.exec(value.trim());

    if (found === null) { return null; }

    const hours = parseInt(found[1], 10);
    const mins = parseInt(found[2], 10);

    if (hours > 23 || mins > 59) { return null; }

    return hours * 60 + mins;
}

const clock = (m) => String(Math.floor(m / 60) % 24).padStart(2, '0') + ':' + String(m % 60).padStart(2, '0');

const onDay = (row, day) => row.days.length === 0 || row.days.includes(day);

function covers(row, at, today, yesterday) {
    const from = minutes(row.from);
    const to = minutes(row.to);

    if (from === null || to === null || from === to) { return false; }

    if (from < to) { return at >= from && at < to && onDay(row, today); }

    if (at >= from) { return onDay(row, today); }

    return at < to && onDay(row, yesterday);
}

const days = (value) => Array.isArray(value)
    ? DAYS.filter((day) => value.map((d) => String(d).toLowerCase()).includes(day))
    : [];

// exists() stands in for Presets::exists(): a style that has been deleted must
// not leave a window that turns the panel's look off instead of changing it.
const KNOWN = ['midnight', 'default', 'ember'];

function clean(rows) {
    const out = [];

    for (const row of (Array.isArray(rows) ? rows : []).slice(0, 12)) {
        if (row === null || typeof row !== 'object') { continue; }

        const from = minutes(row.from);
        const to = minutes(row.to);
        const preset = typeof row.preset === 'string' ? row.preset : '';

        if (from === null || to === null || from === to) { continue; }
        if (preset === '' || !KNOWN.includes(preset)) { continue; }

        out.push({ from: clock(from), to: clock(to), preset, days: days(row.days) });
    }

    return out;
}

// active(): the first window that covers this moment, in list order.
function active(rows, at, today, yesterday) {
    for (const row of rows) {
        if (covers(row, at, today, yesterday)) { return row.preset; }
    }

    return null;
}

const t = (text) => minutes(text);

console.log('timed looks\n');

/* ------------------------------------------------------------ the clock -- */

check('midnight', minutes('00:00'), 0);
check('an hour', minutes('01:00'), 60);
check('ten past ten at night', minutes('22:10'), 1330);
check('one minute to midnight', minutes('23:59'), 1439);
check('a single-digit hour', minutes('9:30'), 570);

check('twenty-four is not a time', minutes('24:00'), null);
check('sixty minutes is not a time', minutes('12:60'), null);
check('seconds are not offered', minutes('22:00:00'), null);
check('not a time at all', minutes('evening'), null);
check('empty', minutes(''), null);
check('not a string', minutes(2200), null);

check('back again', clock(1330), '22:10');
check('and midnight', clock(0), '00:00');

/* ----------------------------------------------------- an ordinary window */

const DAY = { from: '09:00', to: '17:00', preset: 'default', days: [] };

check('before it', covers(DAY, t('08:59'), 'mon', 'sun'), false);
check('on the minute it opens', covers(DAY, t('09:00'), 'mon', 'sun'), true);
check('inside it', covers(DAY, t('13:00'), 'mon', 'sun'), true);
// The end is exclusive, so two windows meeting at 17:00 do not both cover it.
check('on the minute it closes', covers(DAY, t('17:00'), 'mon', 'sun'), false);
check('after it', covers(DAY, t('23:00'), 'mon', 'sun'), false);

/* ------------------------------------------------------ across midnight -- */

const NIGHT = { from: '22:00', to: '06:00', preset: 'midnight', days: [] };

check('the evening before it', covers(NIGHT, t('21:59'), 'mon', 'sun'), false);
check('the minute it opens', covers(NIGHT, t('22:00'), 'mon', 'sun'), true);
check('late', covers(NIGHT, t('23:30'), 'mon', 'sun'), true);
check('after midnight', covers(NIGHT, t('00:30'), 'tue', 'mon'), true);
check('just before it closes', covers(NIGHT, t('05:59'), 'tue', 'mon'), true);
check('the minute it closes', covers(NIGHT, t('06:00'), 'tue', 'mon'), false);
check('the middle of the day', covers(NIGHT, t('13:00'), 'mon', 'sun'), false);

/* ------------------------------------------------------------- the days -- */

const FRIDAY = { from: '09:00', to: '17:00', preset: 'ember', days: ['fri'] };

check('on the day', covers(FRIDAY, t('13:00'), 'fri', 'thu'), true);
check('not on another', covers(FRIDAY, t('13:00'), 'sat', 'fri'), false);
check('no days means every day', covers(DAY, t('13:00'), 'sun', 'sat'), true);

/*
 * The rule that is silently wrong if nobody writes it down. Friday 22:00 until
 * 06:00 belongs to Friday, so it covers Saturday morning and not Friday
 * morning.
 */
const FRIDAY_NIGHT = { from: '22:00', to: '06:00', preset: 'midnight', days: ['fri'] };

check('friday evening', covers(FRIDAY_NIGHT, t('23:00'), 'fri', 'thu'), true);
check('saturday morning is still friday night',
    covers(FRIDAY_NIGHT, t('02:00'), 'sat', 'fri'), true);
check('friday morning is not',
    covers(FRIDAY_NIGHT, t('02:00'), 'fri', 'thu'), false);
check('saturday evening is not',
    covers(FRIDAY_NIGHT, t('23:00'), 'sat', 'fri'), false);

/* ------------------------------------------------------- which one wins -- */

const TWO = [
    { from: '09:00', to: '17:00', preset: 'ember', days: [] },
    { from: '12:00', to: '13:00', preset: 'default', days: [] },
];

check('the first that covers it', active(TWO, t('12:30'), 'mon', 'sun'), 'ember');
check('and moving it changes the answer',
    active(TWO.slice().reverse(), t('12:30'), 'mon', 'sun'), 'default');
check('outside both', active(TWO, t('20:00'), 'mon', 'sun'), null);
check('no windows at all', active([], t('12:00'), 'mon', 'sun'), null);

/* ------------------------------------------------------------ the rows --- */

check('a good row', clean([{ from: '22:00', to: '06:00', preset: 'midnight' }]),
    [{ from: '22:00', to: '06:00', preset: 'midnight', days: [] }]);

check('a single-digit hour is padded',
    clean([{ from: '9:00', to: '17:00', preset: 'default' }])[0].from, '09:00');

/*
 * The two times being the same could be read as "no time at all" or as "all
 * day", and there is no way to tell which - so it is neither, and "all day" is
 * written the way it reads.
 */
check('the same time twice is not a window',
    clean([{ from: '12:00', to: '12:00', preset: 'default' }]), []);
check('but all day is', clean([{ from: '00:00', to: '23:59', preset: 'default' }]).length, 1);

check('a style that no longer exists',
    clean([{ from: '09:00', to: '17:00', preset: 'deleted' }]), []);
check('no style', clean([{ from: '09:00', to: '17:00' }]), []);
check('no times', clean([{ preset: 'default' }]), []);
check('a broken time', clean([{ from: '25:00', to: '06:00', preset: 'default' }]), []);
check('not a row', clean(['nonsense']), []);

check('days come back in week order',
    clean([{ from: '09:00', to: '17:00', preset: 'default', days: ['sun', 'mon'] }])[0].days,
    ['mon', 'sun']);
check('a day that is not one is dropped',
    clean([{ from: '09:00', to: '17:00', preset: 'default', days: ['mon', 'funday'] }])[0].days,
    ['mon']);
check('case does not matter',
    clean([{ from: '09:00', to: '17:00', preset: 'default', days: ['MON'] }])[0].days,
    ['mon']);

check('twelve at most',
    clean(Array.from({ length: 20 }, () => ({ from: '09:00', to: '17:00', preset: 'default' }))).length,
    12);

console.log(NEWLINE + 'timed looks: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
