/*
 * Moving a live service to another package, mid-period.
 *
 * The whole of it is one sentence: what is left of the period the customer
 * already paid for comes back, the same stretch of time is charged at the new
 * price, and the difference changes hands. Everything below is that sentence
 * asked at the awkward moments.
 *
 *   Day one of a month, and it is very nearly the whole difference in price.
 *   The last day, and it is very nearly nothing - which is right, because they
 *   had the small package for the month they paid for it.
 *
 *   A cheaper package gives money back rather than billing nothing, and the
 *   two are told apart by the sign rather than by a flag: a flag can disagree
 *   with the number beside it.
 *
 *   A period is measured off the real dates, not out of a table. February is
 *   twenty-eight days and a customer upgrading in it should not be charged as
 *   though it had thirty-one.
 *
 * Minor units throughout. The rounding is half up on a product before the
 * division, which is what stops a cent being invented on one side of the sum
 * and lost on the other.
 */
let pass = 0;
let fail = 0;

const NEWLINE = String.fromCharCode(10);

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + NEWLINE + '        got  ' + JSON.stringify(got) + NEWLINE + '        want ' + JSON.stringify(want));
};

/* -------------------------------------------------------- the share ----- */

/** Money::share(): a part of an amount, half up, never past the whole. */
function share(amount, part, whole) {
    if (amount <= 0 || part <= 0 || whole <= 0) return 0;
    if (part >= whole) return amount;

    return Math.floor((amount * part + Math.floor(whole / 2)) / whole);
}

check('nothing of an amount is nothing', share(1000, 0, 30), 0);
check('all of it is all of it', share(1000, 30, 30), 1000);
check('more than all of it is still all of it', share(1000, 31, 30), 1000);
check('half of it is half', share(1000, 15, 30), 500);
check('a third, half up', share(1000, 10, 30), 333);
check('two thirds, half up', share(1000, 20, 30), 667);
check('a negative amount is nothing', share(-1000, 15, 30), 0);
check('a period of nothing is nothing', share(1000, 15, 0), 0);

/*
 * The two thirds above is 666.67 and rounds to 667, and the third is 333.33 and
 * rounds to 333. They add to 1000, which is the property that matters: the
 * shop never invents a cent and never loses one.
 */
check('a third and two thirds add back up', share(1000, 10, 30) + share(1000, 20, 30), 1000);

/* ------------------------------------------------------- the quote ------ */

/**
 * Upgrades::quote(): back what is unused, charge the same days anew.
 *
 * A one-off has no period to divide, so days is nought and the whole of each
 * price is used - the difference between two prices paid once.
 */
function quote(was, now, daysLeft, days) {
    const back = days === 0 ? was : share(was, daysLeft, days);
    const ahead = days === 0 ? now : share(now, daysLeft, days);

    return { back, ahead, amount: ahead - back };
}

/* Ten euro a month to twenty, on a thirty day period. */
const tenToTwenty = (left) => quote(1000, 2000, left, 30);

check('on day one it is the whole difference', tenToTwenty(30).amount, 1000);
check('halfway it is half the difference', tenToTwenty(15).amount, 500);
check('on the last day it is nothing', tenToTwenty(0).amount, 0);
/*
 * With one day left, a thirtieth of ten euro is 3.33 and a thirtieth of twenty
 * is 6.67, so the difference is 34 and not the 33 that a thirtieth of the
 * difference would be. Both sides are rounded, and half up rounds the bigger
 * one up more often, so the amount can sit a cent above the exact difference.
 *
 * That is the trade being made, deliberately: the three figures always agree
 * with each other. Rounding once, off the difference, would put the amount a
 * cent away from the two halves it is supposed to be the difference of - and a
 * customer who checks the arithmetic on a document is checking those halves.
 * A cent at the very end of a period is the cheaper of the two wrongs.
 */
check('with one day left it is a thirtieth of each side', tenToTwenty(1).amount, 34);
check('and the two sides it came from', [tenToTwenty(1).back, tenToTwenty(1).ahead], [33, 67]);
check('which is what the amount is the difference of', tenToTwenty(1).ahead - tenToTwenty(1).back, 34);

/* And the two halves of it are stated, not just the difference. */
check('halfway, ten euro gives five back', tenToTwenty(15).back, 500);
check('halfway, twenty euro charges ten', tenToTwenty(15).ahead, 1000);

/* Downwards: twenty to ten, and the answer is the same size the other way. */
const twentyToTen = (left) => quote(2000, 1000, left, 30);

check('a downgrade on day one gives the whole difference back', twentyToTen(30).amount, -1000);
check('halfway it gives half back', twentyToTen(15).amount, -500);
check('on the last day it gives nothing back', twentyToTen(0).amount, 0);

/* Sideways: two packages at the same price cost nothing to swap between. */
check('same price is nothing either way', quote(1000, 1000, 15, 30).amount, 0);

/* ---------------------------------------------------- a year of it ------ */

/*
 * A yearly service upgraded after three months. Nine months of the old price
 * come back and nine of the new go on, which on a hundred and twenty euro to
 * two hundred and forty is sixty euro.
 */
const yearly = quote(12000, 24000, 274, 365);

check('nine months of the old price comes back', yearly.back, 9008);
check('nine months of the new price goes on', yearly.ahead, 18016);
check('and the difference is what changes hands', yearly.amount, 9008);

/* A year upgraded on its last day is still nothing. */
check('a year on its last day costs nothing', quote(12000, 24000, 0, 365).amount, 0);

/* ------------------------------------------------- a real period -------- */

/**
 * Upgrades::length(): measured off the dates rather than taken from a table.
 *
 * Days between the due date less one period and the due date.
 */
const days = (from, to) => Math.round((Date.parse(to) - Date.parse(from)) / 86400000);

check('january is thirty-one days', days('2026-01-01', '2026-02-01'), 31);
check('february is twenty-eight', days('2026-02-01', '2026-03-01'), 28);
check('a leap february is twenty-nine', days('2028-02-01', '2028-03-01'), 29);
check('a quarter over that boundary', days('2026-01-01', '2026-04-01'), 90);
check('a year is three hundred and sixty-five', days('2026-01-01', '2027-01-01'), 365);

/*
 * Which is why the table is not used: a customer upgrading halfway through
 * February pays for fourteen of twenty-eight days, not fourteen of thirty. On
 * ten euro that is 5.00 rather than 4.67, and the difference is the customer's.
 */
check('half of february is half the price', share(1000, 14, 28), 500);
check('half of february against a thirty day table is not', share(1000, 14, 30), 467);

/* ------------------------------------------------ days, not moments ----- */

/*
 * Upgrades::between(): both ends taken to the start of their day.
 *
 * This shipped wrong once and the probe on the live panel caught it. A service
 * due in fifteen days is due at some o'clock fifteen days from when that date
 * was set; `now()` is always a fraction past that o'clock, so the difference
 * came out at 14.999 and the cast to int made it fourteen. Every quote was a
 * day short, silently.
 *
 * A period is measured in days and its two ends are dates. Comparing them as
 * dates is the whole fix.
 */
const asMoments = (from, to) => Math.trunc((Date.parse(to) - Date.parse(from)) / 86400000);
const asDates = (from, to) => Math.round(
    (Date.parse(to.slice(0, 10)) - Date.parse(from.slice(0, 10))) / 86400000,
);

check('as moments, a fraction short reads a day short', asMoments('2026-01-01T09:00:01', '2026-01-16T09:00:00'), 14);
check('as dates, it is fifteen', asDates('2026-01-01T09:00:01', '2026-01-16T09:00:00'), 15);
check('tomorrow is one day', asDates('2026-01-01T23:59:00', '2026-01-02T00:01:00'), 1);
check('today is nought days', asDates('2026-01-01T00:01:00', '2026-01-01T23:59:00'), 0);
check('a date gone by is negative', asDates('2026-01-05T09:00:00', '2026-01-01T09:00:00'), -4);

/* Which is a whole day of a month, on ten euro to twenty. */
check('a day of the difference is thirty-three cents', share(2000, 1, 30) - share(1000, 1, 30), 34);
check('so the bug was worth a day of it', tenToTwenty(15).amount - tenToTwenty(14).amount, 34);

/* ------------------------------------------------- what is refused ------ */

/** Upgrades::may(): the four things that make a move impossible. */
function may(order, from, to) {
    if (to.id === from.id) return 'same';
    if (to.egg !== from.egg) return 'egg';
    if (to.period !== order.period) return 'period';
    if (to.soldOut) return 'stock';

    return null;
}

const small = { id: 1, egg: 5, period: 'month', soldOut: false };
const big = { id: 2, egg: 5, period: 'month', soldOut: false };
const monthly = { period: 'month' };

check('a bigger package on the same egg is allowed', may(monthly, small, big), null);
check('itself is refused', may(monthly, small, small), 'same');
check('another egg is refused', may(monthly, small, { id: 3, egg: 9, period: 'month' }), 'egg');
check('another period is refused', may(monthly, small, { id: 4, egg: 5, period: 'year' }), 'period');
check('sold out is refused', may(monthly, small, { id: 5, egg: 5, period: 'month', soldOut: true }), 'stock');

/*
 * The order of those matters: a package that is both a different egg and sold
 * out should say egg, because that is the one an owner can do something about.
 */
check('the egg is named before the stock', may(monthly, small, { id: 6, egg: 9, period: 'month', soldOut: true }), 'egg');

/** And a service has to be running before there is a period to divide. */
const quotable = (state) => state === 'active';

check('an active service can be changed', quotable('active'), true);
check('a pending one cannot', quotable('pending'), false);
check('a suspended one cannot', quotable('suspended'), false);
check('one with notice on it cannot', quotable('ending'), false);
check('a cancelled one cannot', quotable('cancelled'), false);

/* ----------------------------------------------- days left, clamped ----- */

/**
 * Upgrades::remaining(): never past the period, never below nothing.
 *
 * An overdue service has nought days left, which makes both halves of the
 * quote nought: changing a service you have not paid for costs the difference
 * from the next invoice rather than from this one.
 */
const remaining = (left, period) => Math.max(0, Math.min(period, left));

check('a day into a month leaves twenty-nine', remaining(29, 30), 29);
check('a fresh period leaves the whole', remaining(30, 30), 30);
check('a due date that has passed leaves nothing', remaining(-4, 30), 0);
check('a date further out than the period is capped', remaining(45, 30), 30);

check('an overdue service costs nothing to change', quote(1000, 2000, remaining(-4, 30), 30).amount, 0);

/* --------------------------------------------- which way it settles ----- */

/*
 * Positive is invoiced and applied when that invoice is paid. Nought or less is
 * applied at once, and money back goes on the balance - there is nothing to
 * wait for, and money owed to a customer should not sit behind a button.
 */
const route = (amount) => amount > 0 ? 'invoice' : 'now';

check('a bigger package is invoiced', route(500), 'invoice');
check('a smaller one happens now', route(-500), 'now');
check('an even swap happens now', route(0), 'now');

/*
 * And an upgrade invoice must never advance a due date. That is the whole
 * reason it has a kind of its own: settled as a renewal it would hand the
 * customer a free month every time they changed package.
 */
const advances = (kind) => kind === 'renewal' || kind === 'order';

check('a renewal advances the period', advances('renewal'), true);
check('a first invoice advances it', advances('order'), true);
check('an upgrade does not', advances('upgrade'), false);
check('nor does a credit note', advances('credit'), false);

/* ------------------------------------------------------------------------ */

console.log('Upgrades: ' + pass + ' passed, ' + fail + ' failed.');
process.exit(fail === 0 ? 0 : 1);
