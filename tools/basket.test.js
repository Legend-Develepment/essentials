/*
 * One invoice covering more than one service.
 *
 * The shop sold a package at a time until now, and Checkout.php said why in so
 * many words: "an invoice covering two orders is a refund, a suspension and a
 * renewal that all have to decide which half they mean." Those three are
 * decided now, and this is where the decisions are written down as arithmetic
 * rather than as prose:
 *
 *   A renewal covers what falls due on the same day, for one customer, in one
 *   currency. What was bought together renews together, and a service that was
 *   cancelled is not in the list at all - which is the whole of "only the
 *   active one still gets an invoice".
 *
 *   A cancelled service comes off any bill that has not been paid yet, and the
 *   total is recomputed from what is left rather than subtracted from what was
 *   there. Tax on a smaller subtotal is not the old tax minus a share.
 *
 *   A shared bill is one debt: when it goes unpaid past the grace period,
 *   everything on it is suspended.
 *
 * The money is in minor units all the way through, because that is what the
 * database holds and what every rounding mistake in a shop comes from.
 */
let pass = 0;
let fail = 0;

const NEWLINE = String.fromCharCode(10);

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + NEWLINE + '        got  ' + JSON.stringify(got) + NEWLINE + '        want ' + JSON.stringify(want));
};

/* ------------------------------------------------------------ the port -- */

/** Money::tax(): basis points, rounded half up, never below zero. */
const tax = (amount, rate) => amount <= 0 || rate <= 0 ? 0 : Math.round((amount * rate) / 10000);

/** Renewals::bundle(): one invoice per customer, per currency, per day. */
function bundle(orders) {
    const out = {};

    for (const order of orders) {
        const key = order.user + '|' + order.currency + '|' + order.due;

        (out[key] = out[key] || []).push(order);
    }

    return out;
}

/** Renewals::due(), as the rule rather than the query. */
const due = (orders, today, noticeDays) => orders.filter((order) =>
    order.state === 'active'
    && order.period !== 'once'
    && order.due !== null
    && days(order.due) <= days(today) + noticeDays
    && !order.billed);

const days = (date) => Math.round(Date.parse(date + 'T00:00:00Z') / 86400000);

/** Renewals::invoiceMany(): what one bundle becomes. */
function invoiceMany(orders, rate) {
    const live = orders.filter((order) => order.period !== 'once' && order.state !== 'cancelled');

    if (live.length === 0) { return null; }

    const subtotal = live.reduce((sum, order) => sum + Math.max(0, order.price), 0);

    return {
        orders: live.map((order) => order.id),
        lines: live.length,
        subtotal,
        tax: tax(subtotal, rate),
        total: subtotal + tax(subtotal, rate),
        // The earliest of them: a bill covering two services is due when the
        // first of them is, or the days in between are given away.
        due: live.map((order) => order.due).sort()[0],
    };
}

/** Invoices::withdrawLine(): one cancelled service, off one unpaid invoice. */
function withdraw(invoice, orderId) {
    const left = invoice.orders.filter((order) => order.id !== orderId);

    if (left.length === 0) { return { state: 'cancelled' }; }

    const subtotal = left.reduce((sum, order) => sum + Math.max(0, order.price), 0);
    // Never more than what is left to take it off.
    const discount = Math.min(invoice.discount, subtotal);
    const t = tax(subtotal - discount, invoice.rate);

    return {
        state: 'unpaid',
        orders: left.map((order) => order.id),
        lines: left.length,
        subtotal,
        discount,
        tax: t,
        total: Math.max(0, subtotal - discount + t),
        // Whatever order_id names has to still be on the invoice.
        first: left[0].id,
    };
}

/** Renewals::overdue(): who stops when a shared bill is not paid. */
const suspends = (invoice, today, graceDays) =>
    invoice.state === 'unpaid' && days(today) - days(invoice.due) > graceDays
        ? invoice.orders.filter((order) => order.state === 'active' && order.server !== null).map((order) => order.id)
        : [];

/* ------------------------------------------------------- the bundling --- */

const RATE = 2100; // 21%, in basis points.

const two = [
    { id: 1, user: 7, currency: 'EUR', due: '2026-10-01', state: 'active', period: 'month', price: 500, billed: false, server: 11 },
    { id: 2, user: 7, currency: 'EUR', due: '2026-10-01', state: 'active', period: 'month', price: 300, billed: false, server: 12 },
];

check('two services due the same day are one bundle', Object.keys(bundle(two)).length, 1);

check(
    'a different day is a different invoice',
    Object.keys(bundle([two[0], { ...two[1], due: '2026-10-08' }])).length,
    2,
);

check(
    'so is a different customer',
    Object.keys(bundle([two[0], { ...two[1], user: 8 }])).length,
    2,
);

// One document has one total, and two currencies cannot be added up.
check(
    'and so is a different currency',
    Object.keys(bundle([two[0], { ...two[1], currency: 'USD' }])).length,
    2,
);

/* ------------------------------------------------------- the invoice ---- */

const bill = invoiceMany(two, RATE);

check('one invoice, a line each', [bill.lines, bill.orders], [2, [1, 2]]);
check('the subtotal is the sum', bill.subtotal, 800);
check('tax is on the whole of it', bill.tax, 168);
check('and the total adds up', bill.total, 968);

check(
    'it is due when the first of them is',
    invoiceMany([{ ...two[0], due: '2026-10-05' }, two[1]], RATE).due,
    '2026-10-01',
);

/* ---------------------------------------------------- the cancellation -- */

/*
 * The rule this was asked for. A cancelled order never reaches due(), so the
 * next invoice is written for the one that is left - without anything having
 * to remember that the other one existed.
 */
const afterCancel = due(
    [{ ...two[0] }, { ...two[1], state: 'cancelled', due: null }],
    '2026-10-01',
    7,
);

check('a cancelled service is not billed again', afterCancel.map((order) => order.id), [1]);
check('and the one that was kept still is', afterCancel.length, 1);

// The second service on a shared invoice is billed without order_id ever
// pointing at it. Without the pairing table it would be invoiced again the next
// day, and the day after that.
check(
    'and neither is one already on a shared bill',
    due([{ ...two[0], billed: true }, { ...two[1], billed: true }], '2026-10-01', 7).length,
    0,
);

/* An invoice that has already gone out, with one of its two cancelled. */
const open = {
    state: 'unpaid',
    rate: RATE,
    discount: 0,
    orders: [{ id: 1, price: 500 }, { id: 2, price: 300 }],
};

const revised = withdraw(open, 2);

check('the cancelled line comes off', [revised.lines, revised.orders], [1, [1]]);
check('the money follows the line', [revised.subtotal, revised.tax, revised.total], [500, 105, 605]);
check('and order_id still names something on it', revised.first, 1);

// Recomputed, not subtracted: 168 - 63 happens to be 105 here, and would not be
// on a subtotal where the rounding falls the other way.
check(
    'tax is recomputed rather than shared out',
    withdraw({ ...open, orders: [{ id: 1, price: 333 }, { id: 2, price: 333 }] }, 2).tax,
    tax(333, RATE),
);

check(
    'a percentage code is worth less of a smaller bill',
    withdraw({ ...open, discount: 800 }, 2).discount,
    500,
);

check('the last one off withdraws the invoice', withdraw(open, 2) && withdraw({ ...open, orders: [{ id: 1, price: 500 }] }, 1).state, 'cancelled');

/* ------------------------------------------------------ the suspension -- */

const shared = {
    state: 'unpaid',
    due: '2026-10-01',
    orders: [
        { id: 1, state: 'active', server: 11 },
        { id: 2, state: 'active', server: 12 },
    ],
};

check('inside the grace period, nothing stops', suspends(shared, '2026-10-08', 7), []);
check('past it, everything on the bill stops', suspends(shared, '2026-10-09', 7), [1, 2]);

check(
    'a service with no server has nothing to stop',
    suspends({ ...shared, orders: [shared.orders[0], { id: 2, state: 'active', server: null }] }, '2026-10-09', 7),
    [1],
);

check('and a paid bill stops nothing', suspends({ ...shared, state: 'paid' }, '2026-11-01', 7), []);

/* --------------------------------------------------------- the tax ------ */

/*
 * Purchase::money(): the four numbers every document in this shop carries.
 *
 * Two shapes, and they have to tell themselves apart afterwards without a
 * column saying which is which - an invoice written last year prints the way it
 * was written, not the way the shop is set up today.
 */
const taxIn = (amount, rate) => amount <= 0 || rate <= 0
    ? 0
    : Math.max(0, Math.min(amount, amount - Math.floor((amount * 10000 + Math.floor((10000 + rate) / 2)) / (10000 + rate))));

function money(lines, discount, rate, inclusive) {
    const subtotal = lines.reduce((sum, amount) => sum + Math.max(0, amount), 0);
    const off = Math.max(0, Math.min(discount, subtotal));
    const after = subtotal - off;

    return inclusive
        ? { subtotal, discount: off, tax: taxIn(after, rate), total: after }
        : { subtotal, discount: off, tax: tax(after, rate), total: after + tax(after, rate) };
}

/** How a document works out which shape it is. */
const contained = (m) => m.total === m.subtotal - m.discount;

const onTop = money([1000], 0, RATE, false);
const inside = money([1210], 0, RATE, true);

check('tax on top is added to the total', [onTop.tax, onTop.total], [210, 1210]);
check('tax inside is a part of it', [inside.tax, inside.total], [210, 1210]);

// 12.10 times 21% is 2.54, and the answer is 2.10. Working back out of a price
// is not the same sum as working forward into it.
check('and it is not the forward sum', taxIn(1210, RATE) === tax(1210, RATE), false);

check('the two shapes tell themselves apart', [contained(onTop), contained(inside)], [false, true]);

// Nothing is invented and nothing is lost: the parts add back up to the whole.
for (const gross of [1, 99, 100, 333, 1210, 99999]) {
    const t = taxIn(gross, RATE);

    if (t < 0 || t > gross) { check('tax inside ' + gross + ' is within it', true, false); }
}

check('a zero rate contains no tax', taxIn(1210, 0), 0);
check('and adds none', money([1000], 0, 0, false).total, 1000);

// A discount comes off what the lines add up to either way - somebody told
// "10% off" means off what they pay.
check('a discount on top', money([1000], 100, RATE, false), { subtotal: 1000, discount: 100, tax: 189, total: 1089 });
check('a discount inside', money([1210], 121, RATE, true), { subtotal: 1210, discount: 121, tax: taxIn(1089, RATE), total: 1089 });
check('and never more than the lines', money([500], 900, RATE, true).discount, 500);

/* ----------------------------------------------------------- an offer --- */

/*
 * Packages::offerOff(): what comes off one of these, with this many things in
 * the basket. The count is the whole basket rather than this package's share of
 * it - a reason to put a second thing in, not a reason to buy two of the same.
 */
function offerOff(p, items) {
    if (!p.offer) { return 0; }

    const price = Math.max(0, p.price);
    const value = Math.max(0, p.value);
    const need = Math.max(0, p.min || 0);

    if (price === 0 || value === 0 || items < need) { return 0; }

    return p.kind === 'amount'
        ? Math.min(price, value)
        : Math.min(price, Math.floor((price * Math.min(100, value) + 50) / 100));
}

const priceNow = (p, items) => Math.max(0, p.price - offerOff(p, items));

const fifth = { offer: true, kind: 'percent', value: 20, price: 1000, min: 0 };
const twoFifty = { offer: true, kind: 'amount', value: 250, price: 1000, min: 0 };

check('a fifth off a tenner', priceNow(fifth, 1), 800);
check('and a fixed amount off it', priceNow(twoFifty, 1), 750);
check('a package not on offer keeps its price', priceNow({ ...fifth, offer: false }, 1), 1000);
check('and an offer worth nothing changes nothing', priceNow({ ...fifth, value: 0 }, 1), 1000);

/* The condition, counted over the whole basket. */
const fromTwo = { ...fifth, min: 2 };

check('one thing in the basket is not enough', priceNow(fromTwo, 1), 1000);
check('two is', priceNow(fromTwo, 2), 800);
check('and so is three', priceNow(fromTwo, 3), 800);

// An offer takes a package to free, never past it.
check('a discount bigger than the price stops at free', priceNow({ ...twoFifty, value: 99999 }, 1), 0);
check('and so does a hundred per cent', priceNow({ ...fifth, value: 100 }, 1), 0);
// A percentage over a hundred is a typo, not a refund.
check('nor does more than all of it', priceNow({ ...fifth, value: 400 }, 1), 0);

/*
 * A card only draws a struck-out price where the offer applies to a basket of
 * one. A price crossed out beside one somebody cannot have yet is a shop
 * telling a small lie.
 */
const showsWas = (p) => p.offer && p.value > 0 && p.price > 0 && (p.min || 0) <= 1;

check('an offer that always applies shows the old price', showsWas(fifth), true);
check('one that waits for a fuller basket does not', showsWas(fromTwo), false);

/* ------------------------------------------------ tax somebody else pays -- */

/*
 * Vat::reverses(): three things have to be true before the tax comes off, and
 * getting it wrong costs the seller rather than the buyer - so every one of
 * these leans towards charging it.
 */
const SHAPES = { NL: /^[0-9]{9}B[0-9]{2}$/, DE: /^[0-9]{9}$/, BE: /^[01][0-9]{9}$/, EL: /^[0-9]{9}$/ };

const normalise = (v) => String(v || '').replace(/[^A-Za-z0-9]/g, '').toUpperCase();

function looksValid(vat) {
    const v = normalise(vat);
    const country = v.slice(0, 2);
    const rest = v.slice(2);

    return Boolean(SHAPES[country]) && rest !== '' && SHAPES[country].test(rest);
}

const reverses = (vat, home) =>
    Boolean(SHAPES[home]) && looksValid(vat) && normalise(vat).slice(0, 2) !== home;

check('a number written on a letterhead is the same number', normalise('NL 1234.56.789 B01'), 'NL123456789B01');

check('a German number at a Dutch shop reverses', reverses('DE123456789', 'NL'), true);
// A domestic sale is a domestic sale, however business-like the buyer.
check('a Dutch one does not', reverses('NL123456789B01', 'NL'), false);
check('nor does a malformed one', reverses('DE12', 'NL'), false);
check('nor one from outside the union', reverses('US123456789', 'NL'), false);
// Without knowing where the shop sells from, "another country" cannot be
// answered - and guessing would be guessing with somebody's tax return.
check('and not at all when the shop has no country', reverses('DE123456789', ''), false);

// Shape is not existence. This one is perfectly well-formed and belongs to
// nobody, which is what the online check is for.
check('a well-formed number is only well-formed', looksValid('NL999999999B01'), true);

/* The money, when it does reverse. */
const reversed = (lines, discount, rate, inclusive) => {
    const subtotal = lines.reduce((sum, a) => sum + a, 0);
    const off = Math.max(0, Math.min(discount, subtotal));
    const after = subtotal - off;

    if (!inclusive) { return { subtotal, discount: off, tax: 0, total: after }; }

    const net = after - taxIn(after, rate);
    const netSubtotal = subtotal - taxIn(subtotal, rate);

    return { subtotal: netSubtotal, discount: Math.max(0, netSubtotal - net), tax: 0, total: net };
};

const offTop = reversed([1000], 0, RATE, false);
check('tax on top simply comes off', [offTop.tax, offTop.total], [0, 1000]);

/*
 * And a price that contained tax has to come down. Leaving the total at 12.10
 * and calling the tax zero would charge the tax and deny it in the same
 * document.
 */
const offInside = reversed([1210], 0, RATE, true);
check('a price that contained tax comes down', [offInside.tax, offInside.total], [0, 1000]);
check('and the document still adds up', offInside.subtotal - offInside.discount, offInside.total);

/* --------------------------------------------------- what may be built -- */

/*
 * Provision::owed(): has this order actually been paid for?
 *
 * It asked one question - is there a paid invoice naming this order in
 * order_id - and for a basket only the first order is named there. So the
 * second one read as unpaid, its build stopped before it started, and nothing
 * was written anywhere: the queue job finished in eight milliseconds and the
 * customer had paid for two servers and been given one.
 */
const owed = (order, invoices) => invoices.some((invoice) =>
    invoice.kind === 'order'
    && invoice.state === 'paid'
    && (invoice.order_id === order || (invoice.orders || []).includes(order)));

const paidBasket = [{ kind: 'order', state: 'paid', order_id: 1, orders: [1, 2] }];

check('the first order on a basket is paid for', owed(1, paidBasket), true);
check('and so is the second', owed(2, paidBasket), true);
check('but not one that is on no invoice', owed(3, paidBasket), false);

// The single-order shape, which is every invoice written before the basket.
check('a lone order is paid for by its own invoice', owed(1, [{ kind: 'order', state: 'paid', order_id: 1 }]), true);
check('and an unpaid one is not', owed(1, [{ kind: 'order', state: 'unpaid', order_id: 1, orders: [1] }]), false);

// A renewal is not what buys a server. It keeps one that already exists.
check('a paid renewal does not build anything', owed(2, [{ kind: 'renewal', state: 'paid', order_id: 2, orders: [2] }]), false);

/* ----------------------------------------------------------- the till --- */

/*
 * A code tied to particular packages cannot come off a total that covers three
 * of them without inventing a rule about which third it applies to. So it
 * applies to all of the basket or to none of it.
 */
const covers = (coupon, basket) => coupon.packages.length === 0
    || basket.every((id) => coupon.packages.includes(id));

check('a code for everything applies', covers({ packages: [] }, [1, 2]), true);
check('a code for both applies', covers({ packages: [1, 2] }, [1, 2]), true);
check('a code for one of two does not', covers({ packages: [1] }, [1, 2]), false);

/* ------------------------------------------------------------------------ */

/* ------------------------------------------- the extras a basket carries --- */

/*
 * A basket line carries the extras ticked on it, and this is here because it
 * did not.
 *
 * What it cost, exactly: the extras were chosen on the package page, the basket
 * stored package, answers and upload and nothing else, and from that point on
 * they did not exist. The quote did not bill them, the order did not hold them,
 * and the server was built at the package's own size. A customer picked a 2 GB
 * server with a gigabyte extra, paid for 2 GB and got 2 GB, and no screen
 * anywhere said a word about it.
 *
 * The rule is one sentence: what a line is quoted for and what a line is bought
 * with come from the same place, by position.
 */
function ticked(extras) {
    const out = {};

    for (const [id, quantity] of Object.entries(extras || {})) {
        const key = Number(id);
        const many = Number(quantity);

        if (key > 0 && many > 0) { out[key] = Math.min(many, 99); }
    }

    return out;
}

check('a tick becomes an id and a count', ticked({ 7: 1 }), { 7: 1 });
check('a count of nought is not a tick', ticked({ 7: 0 }), {});
check('nor is a negative one', ticked({ 7: -3 }), {});
check('an id of nought is dropped', ticked({ 0: 2 }), {});
check('and a silly count is capped', ticked({ 7: 5000 }), { 7: 99 });
check('nothing ticked is nothing', ticked({}), {});
check('and a basket from before this existed is nothing', ticked(undefined), {});

/*
 * By position, because two of the same package are two lines and may carry
 * different extras. A set shared across the basket would give the second server
 * whatever the first one was bought with.
 */
const basket = [
    { package: 'mc-2gb', extras: { 7: 1 } },
    { package: 'mc-2gb', extras: {} },
    { package: 'redis', extras: { 7: 2 } },
];

const byPosition = basket.map((line) => ticked(line.extras));

check('each line keeps its own', byPosition, [{ 7: 1 }, {}, { 7: 2 }]);
check('and two of the same package do not share', byPosition[0][7] === byPosition[1][7], false);

/* What the quote bills, which must be what the order holds. */
const PRICE = { 7: 250 };

const lineTotal = (base, extras) => base
    + Object.entries(extras).reduce((sum, [id, many]) => sum + (PRICE[id] || 0) * many, 0);

check('a package with an extra costs both', lineTotal(750, { 7: 1 }), 1000);
check('two of the extra costs twice', lineTotal(750, { 7: 2 }), 1250);
check('and none costs the package', lineTotal(750, {}), 750);

const quoted = basket.map((line) => lineTotal(750, ticked(line.extras)));
const bought = basket.map((line) => ticked(line.extras));

check('the basket totals what it carries', quoted, [1000, 750, 1250]);
check('and what it carries is what it bills', bought.map((e) => lineTotal(750, e)), quoted);

/*
 * And what the server is built at. The delta is added to the package's own
 * limits, never replacing them, and never below nothing - nought is Pelican's
 * word for unlimited, so an extra that took a limit negative would hand
 * somebody a server with no limit at all.
 */
const grow = (spec, deltas) => {
    const out = { ...spec };

    for (const [key, delta] of Object.entries(deltas)) {
        if (delta === 0) { continue; }
        out[key] = Math.max(0, (out[key] || 0) + delta);
    }

    return out;
};

check('a gigabyte extra grows the server', grow({ memory: 2048 }, { memory: 1024 }), { memory: 2048 + 1024 });
check('no extra leaves it alone', grow({ memory: 2048 }, {}), { memory: 2048 });
check('and nothing goes below nothing', grow({ memory: 512 }, { memory: -4096 }), { memory: 0 });
check('a zero delta is not a change', grow({ memory: 2048, cpu: 0 }, { cpu: 0 }), { memory: 2048, cpu: 0 });


console.log('Basket: ' + pass + ' passed, ' + fail + ' failed.');
process.exit(fail === 0 ? 0 : 1);
