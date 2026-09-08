/*
 * The shop's arithmetic, and the two rules that would cost somebody money.
 *
 * Everything here is a port of PHP that runs against a database, so what is
 * tested is the reasoning rather than the code: the order the numbers are
 * combined in, the rounding, and the decisions markPaid() makes about an
 * order. Those are the parts where being wrong is expensive and where being
 * wrong is silent - an invoice is a number nobody re-derives.
 *
 * Two of these found something while they were being written.
 *
 * **Tax is charged after the discount, not before.** Charging it on the full
 * subtotal and then taking the coupon off the total overcharges tax on every
 * discounted sale - a small amount each time, on the one line a customer is
 * least likely to check and a tax office most likely to.
 *
 * **A due date advances from the date it was due, not from today.** Advancing
 * from today gives away every day between the due date and the payment, on
 * every renewal, forever. Except when the old date has already gone past, where
 * advancing from it would write an invoice for a period that is over before it
 * begins - so it catches up to now instead.
 */
let pass = 0;
let fail = 0;

const NEWLINE = String.fromCharCode(10);

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + '\n        got  ' + JSON.stringify(got) + '\n        want ' + JSON.stringify(want));
};

/* ---------------------------------------------------------------- money -- */

/* Money::tax - basis points, half up. 2100 is twenty-one percent. */
function tax(amount, basisPoints) {
    if (amount <= 0 || basisPoints <= 0) { return 0; }
    return Math.trunc((amount * basisPoints + 5000) / 10000);
}

/* Money::percent - a whole percentage, half up, never above the amount. */
function percent(amount, pc) {
    if (amount <= 0 || pc <= 0) { return 0; }
    return Math.min(amount, Math.trunc((amount * Math.min(100, pc) + 50) / 100));
}

check('no tax is no line', tax(1250, 0), 0);
check('twenty-one percent of 12.50', tax(1250, 2100), 263);
check('half a cent rounds up', tax(1250, 100), 13);
check('a rate with decimals in it', tax(10000, 825), 825);
check('nothing to tax', tax(0, 2100), 0);

check('half off', percent(1250, 50), 625);
check('an odd number rounds up', percent(999, 50), 500);
check('a hundred percent is all of it', percent(1250, 100), 1250);
check('more than a hundred is still all of it', percent(1250, 250), 1250);
check('nothing off', percent(1250, 0), 0);

/* ---------------------------------------------------------------- quote -- */

/*
 * Purchase::quote, in the order it actually combines things:
 *
 *   subtotal = price + setup fee
 *   discount = the coupon, capped at the subtotal
 *   tax      = the rate applied to (subtotal - discount)
 *   total    = subtotal - discount + tax
 */
function quote(price, setup, coupon, rate) {
    const subtotal = price + setup;

    let discount = 0;
    if (coupon && coupon.kind === 'percent') { discount = percent(subtotal, coupon.value); }
    if (coupon && coupon.kind === 'fixed') { discount = coupon.value; }
    discount = Math.max(0, Math.min(subtotal, discount));

    const charged = tax(subtotal - discount, rate);

    return {
        subtotal: subtotal,
        discount: discount,
        tax: charged,
        total: Math.max(0, subtotal - discount + charged),
    };
}

check('a plain package',
    quote(1250, 0, null, 0),
    { subtotal: 1250, discount: 0, tax: 0, total: 1250 });

check('with a setup fee',
    quote(1250, 500, null, 0),
    { subtotal: 1750, discount: 0, tax: 0, total: 1750 });

check('with tax',
    quote(1250, 0, null, 2100),
    { subtotal: 1250, discount: 0, tax: 263, total: 1513 });

/*
 * The one that matters. Tax on 6.25, not on 12.50: charging it on the full
 * subtotal would make this 1250 - 625 + 263 = 888, which is 57 cents of tax
 * on money nobody was charged.
 */
check('tax is charged after the discount',
    quote(1250, 0, { kind: 'percent', value: 50 }, 2100),
    { subtotal: 1250, discount: 625, tax: 131, total: 756 });

check('a fixed coupon',
    quote(1250, 0, { kind: 'fixed', value: 300 }, 0),
    { subtotal: 1250, discount: 300, tax: 0, total: 950 });

/* A coupon worth more than the order takes it to zero rather than owing money. */
check('a coupon bigger than the order',
    quote(1250, 0, { kind: 'fixed', value: 9999 }, 2100),
    { subtotal: 1250, discount: 1250, tax: 0, total: 0 });

/* The setup fee is discounted with everything else: it is in the subtotal, and
   a coupon that skipped it would be a coupon whose worth depends on which
   package it is used on. */
check('a coupon covers the setup fee too',
    quote(1000, 1000, { kind: 'percent', value: 50 }, 0),
    { subtotal: 2000, discount: 1000, tax: 0, total: 1000 });

/* ------------------------------------------------------------- coupons --- */

/* Coupon::usable - four ways to say no, and they are all the same answer. */
function usable(coupon, now) {
    if (!coupon.live) { return false; }
    if (coupon.expires_at !== null && coupon.expires_at <= now) { return false; }
    return coupon.max_uses === null || coupon.uses < coupon.max_uses;
}

const NOW = 1000;

check('a plain live code',
    usable({ live: true, expires_at: null, max_uses: null, uses: 0 }, NOW), true);
check('switched off',
    usable({ live: false, expires_at: null, max_uses: null, uses: 0 }, NOW), false);
check('expired',
    usable({ live: true, expires_at: 999, max_uses: null, uses: 0 }, NOW), false);
check('not expired yet',
    usable({ live: true, expires_at: 1001, max_uses: null, uses: 0 }, NOW), true);
check('used up',
    usable({ live: true, expires_at: null, max_uses: 5, uses: 5 }, NOW), false);
check('one use left',
    usable({ live: true, expires_at: null, max_uses: 5, uses: 4 }, NOW), true);

/* Coupon::covers - an empty list is every package, not no packages. */
function covers(ids, packageId) {
    if (!Array.isArray(ids) || ids.length === 0) { return true; }
    return ids.indexOf(packageId) !== -1;
}

check('no list means everything', covers([], 7), true);
check('null means everything', covers(null, 7), true);
check('in the list', covers([3, 7], 7), true);
check('not in the list', covers([3, 9], 7), false);

/* --------------------------------------------------------------- stock --- */

/*
 * Packages::stockLeft. Pending, active and suspended all hold a place: a
 * pending order is somebody who has bought and not yet been provisioned, and
 * their place is theirs. Counting only active would sell the last one twice
 * to two people paying at the same moment.
 */
const OCCUPYING = ['pending', 'active', 'suspended'];

function stockLeft(stock, orders) {
    if (stock === null) { return null; }
    const held = orders.filter((state) => OCCUPYING.indexOf(state) !== -1).length;
    return Math.max(0, stock - held);
}

check('unlimited stays unlimited', stockLeft(null, ['active', 'active']), null);
check('two sold of five', stockLeft(5, ['active', 'active']), 3);
check('a pending order holds its place', stockLeft(5, ['pending', 'active']), 3);
check('a suspended one still holds it', stockLeft(5, ['suspended']), 4);
check('a cancelled one gives it back', stockLeft(5, ['cancelled', 'cancelled']), 5);
check('sold out', stockLeft(2, ['active', 'pending']), 0);
check('over-sold after the stock was lowered', stockLeft(1, ['active', 'active']), 0);

/* ------------------------------------------------------------- markPaid -- */

/*
 * Invoices::markPaid, as a decision table. What paying an invoice does depends
 * on the order behind it, and the first line is the one that makes a webhook
 * firing twice harmless.
 */
function markPaid(invoiceState, orderState, recurring) {
    if (invoiceState === 'paid') { return 'nothing'; }
    if (orderState === 'pending') { return 'provision'; }
    if (orderState === 'suspended') { return recurring ? 'unsuspend and advance' : 'unsuspend'; }
    if (orderState === 'active' && recurring) { return 'advance'; }
    return 'paid only';
}

check('a second webhook for the same payment', markPaid('paid', 'pending', false), 'nothing');
check('the first invoice builds the server', markPaid('unpaid', 'pending', true), 'provision');
check('a renewal on a live order moves the date', markPaid('unpaid', 'active', true), 'advance');
check('a one-off has no date to move', markPaid('unpaid', 'active', false), 'paid only');
check('paying a suspended order starts it', markPaid('unpaid', 'suspended', true), 'unsuspend and advance');
check('a cancelled order is left alone', markPaid('unpaid', 'cancelled', true), 'paid only');

/* -------------------------------------------------------------- renewal -- */

/*
 * Invoices::advance. From the date it was due, so paying four days late does
 * not quietly buy four fewer days - unless that date has already gone, where
 * catching up to now avoids writing invoices for months nobody was served.
 */
function advance(dueAt, now) {
    return (dueAt === null || dueAt < now) ? now + 1 : dueAt + 1;
}

check('paid on time', advance(10, 10), 11);
check('paid early, still one period from the due date', advance(10, 8), 11);
check('paid late, caught up to now', advance(10, 14), 15);
check('an order with no date at all', advance(null, 14), 15);

/* --------------------------------------------------------------- number -- */

/* Invoices::number - the prefix and a zero-padded running count, so the number
   somebody quotes reads like one rather than like a row id. */
function number(prefix, next) {
    return prefix + String(next).padStart(6, '0');
}

check('the first one', number('INV-', 1), 'INV-000001');
check('the hundredth', number('INV-', 100), 'INV-000100');
check('past the padding', number('INV-', 1234567), 'INV-1234567');
check('a panel with its own prefix', number('LD/2026/', 42), 'LD/2026/000042');

console.log(NEWLINE + 'shop: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
