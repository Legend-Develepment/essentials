/*
 * What a discount code is allowed to come off.
 *
 * The rule is a decision rather than an accident and Purchase::quote() states
 * it: a code is off the package and its setup fee, and not off the extras
 * somebody piles on top. "Ten percent off" on a launch offer should not quietly
 * become ten percent off four gigabytes of memory.
 *
 * It was stated in one method and applied in two. quote() draws the checkout
 * page and discounted the package; quoteMany() writes the invoice and
 * discounted the whole basket, extras included. So the page and the document
 * disagreed, and the worst case is not a rounding error: a fixed code of twenty
 * against a ten pound package with a five pound extra showed five to pay on the
 * page and nothing at all on the invoice, and an invoice for nothing is settled
 * as free and provisions the server.
 *
 * The model below is the PHP, rewritten once. When one changes the other has
 * to, which is the price of testing a thing written in a language this
 * repository has no runner for.
 */
let pass = 0;
let fail = 0;

const NEWLINE = String.fromCharCode(10);

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + NEWLINE + '        got  ' + JSON.stringify(got) + NEWLINE + '        want ' + JSON.stringify(want));
};

/** Coupons::discount(), which never takes a total below nothing. */
function discount(coupon, base) {
    if (coupon === null || base <= 0) { return 0; }

    /*
     * Money::percent(), to the character: the percentage is clamped at a
     * hundred and the division rounds half up on a whole number of minor
     * units. Written out rather than approximated with Math.round, because the
     * two agree until they do not and this file exists to catch that.
     */
    const off = coupon.percent === undefined
        ? coupon.amount
        : Math.min(base, Math.floor((base * Math.min(100, coupon.percent) + 50) / 100));

    return Math.max(0, Math.min(off, base));
}

/** Purchase::quote(), reduced to the two numbers this file is about. */
function quote(item) {
    const lines = [{ text: 'package', amount: item.price }];

    if (item.setup > 0) { lines.push({ text: 'setup', amount: item.setup }); }

    for (const extra of item.extras || []) {
        lines.push({ text: 'extra', amount: extra });
    }

    return { lines, couponable: item.price + item.setup };
}

/** Purchase::quoteMany(), which is the one that writes the invoice. */
function quoteMany(items, coupon) {
    const lines = [];
    let couponable = 0;

    for (const item of items) {
        const one = quote(item);

        lines.push(...one.lines);
        couponable += one.couponable;
    }

    const subtotal = lines.reduce((sum, line) => sum + line.amount, 0);

    return { subtotal, discount: discount(coupon, couponable), couponable };
}

/** What quoteMany used to do: the discount off everything in the basket. */
function asItWas(items, coupon) {
    const lines = [];

    for (const item of items) { lines.push(...quote(item).lines); }

    const subtotal = lines.reduce((sum, line) => sum + line.amount, 0);

    return { subtotal, discount: discount(coupon, subtotal) };
}

console.log('coupons' + NEWLINE);

/* -------------------------------------------- the page and the document -- */

const one = { price: 1000, setup: 0, extras: [500] };
const fixed = { amount: 2000 };

check('the code comes off the package, not the extra', quote(one).couponable, 1000);
check('one package, one extra, a fixed code bigger than both',
    quoteMany([one], fixed).discount, 1000);
check('so something is still owed', quoteMany([one], fixed).subtotal - quoteMany([one], fixed).discount, 500);

/*
 * The exact case that shipped. Left in as the thing this file is here to stop
 * coming back: the old arithmetic discounted the extra as well, took the
 * invoice to nothing, and a total of nothing is settled as free.
 */
check('the old way took it to nothing', asItWas([one], fixed).subtotal - asItWas([one], fixed).discount, 0);

/* ------------------------------------------------------ the quieter one -- */

const tenth = { percent: 10 };

check('a percentage is off the package and the setup fee only',
    quoteMany([{ price: 1000, setup: 200, extras: [500] }], tenth).discount, 120);
check('and the old way took a tenth of the extra with it',
    asItWas([{ price: 1000, setup: 200, extras: [500] }], tenth).discount, 170);

/* ------------------------------------------------------- a basket of two -- */

const basket = [
    { price: 1000, setup: 100, extras: [500] },
    { price: 2000, setup: 0, extras: [] },
];

check('the base is every package and every setup fee', quoteMany(basket, null).couponable, 3100);
check('the subtotal is still everything', quoteMany(basket, null).subtotal, 3600);
check('a tenth off the base', quoteMany(basket, tenth).discount, 310);

/* ----------------------------------------------------------- the edges -- */

check('no code, no discount', quoteMany(basket, null).discount, 0);
check('a code bigger than the base stops at the base',
    quoteMany([{ price: 500, setup: 0, extras: [] }], fixed).discount, 500);
check('a basket of nothing but extras cannot be discounted',
    quoteMany([{ price: 0, setup: 0, extras: [900] }], tenth).discount, 0);
check('a percentage over a hundred is a hundred',
    quoteMany([{ price: 1000, setup: 0, extras: [] }], { percent: 250 }).discount, 1000);
check('a half rounds up, which is what intdiv(x + 50, 100) does',
    discount({ percent: 10 }, 1005), 101);

/* ------------------------------------------------------- whose it is -- */

/* Coupon::mayUse - a code tied to accounts is theirs alone, and a caller
   that knows nobody asks with null and is told no. Nobody chosen is anybody,
   which is every code made before the list existed. */
function mayUse(userIds, userId) {
    if (!Array.isArray(userIds) || userIds.length === 0) { return true; }

    return userId !== null && userIds.map((id) => parseInt(id, 10)).includes(userId);
}

check('nobody chosen is anybody', mayUse([], 7), true);
check('a code from before the list is anybody', mayUse(null, 7), true);
check('an open code works without an account too', mayUse([], null), true);
check('the account it is tied to', mayUse([7, 9], 9), true);
check('ids stored as text still match', mayUse(['7'], 7), true);
check('somebody else', mayUse([7], 8), false);
check('nobody at all, for a tied code', mayUse([7], null), false);

console.log(NEWLINE + 'coupons: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
