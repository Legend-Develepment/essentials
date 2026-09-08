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
 * Packages::stockLeft. Pending, active, suspended and ending all hold a
 * place: a pending order is somebody who has bought and not yet been
 * provisioned, and their place is theirs. Counting only active would sell the
 * last one twice to two people paying at the same moment, and leaving out an
 * order under notice would sell a place that is still running on a node.
 */
const OCCUPYING = ['pending', 'active', 'suspended', 'ending'];

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

/* -------------------------------------------------------------- mollie -- */

/*
 * The status map, and the one line in it that would cost real money.
 *
 * Only 'paid' is money in the account. 'authorized' is a card that has agreed
 * to pay and has not, 'pending' is a bank transfer that may take three days,
 * and treating either as paid is how a shop hands over a server for a payment
 * that is later refused. Everything that is not one of the five known words is
 * left open rather than guessed at, because a status Mollie adds next year
 * must not silently mean paid.
 */
function mollieState(status) {
    if (status === 'paid') { return 'paid'; }
    if (status === 'failed' || status === 'expired') { return 'failed'; }
    if (status === 'canceled') { return 'cancelled'; }
    return 'open';
}

check('paid is the only one that pays', mollieState('paid'), 'paid');
check('authorized is not paid', mollieState('authorized'), 'open');
check('pending is not paid', mollieState('pending'), 'open');
check('open stays open', mollieState('open'), 'open');
check('failed', mollieState('failed'), 'failed');
check('expired counts as failed', mollieState('expired'), 'failed');
check('canceled', mollieState('canceled'), 'cancelled');
check('a status nobody has seen yet', mollieState('quantum'), 'open');
check('no status at all', mollieState(''), 'open');

/*
 * What the webhook accepts before it looks anything up.
 *
 * Mollie signs nothing and posts one field. The shape check here is not
 * security - the security is that the id is then fetched with the API key, and
 * a guessed id answers "not paid" - it is only to keep obvious rubbish out of
 * a database query.
 */
function acceptable(id) {
    return typeof id === 'string' && id.startsWith('tr_') && id.length > 3;
}

check('a real looking id', acceptable('tr_7UhSN1zuXS'), true);
check('empty', acceptable(''), false);
check('the prefix alone', acceptable('tr_'), false);
check('another provider prefix', acceptable('pay_123'), false);
check('not a string', acceptable(null), false);

/*
 * The unique index on (gateway, gateway_id) is what makes a webhook firing
 * twice harmless: the second call finds the row the first one wrote rather
 * than inserting a second. Two providers may use the same id without
 * colliding, which is why the gateway is half of the key.
 */
function rowKey(gateway, id) { return gateway + '/' + id; }

check('the same webhook twice is one row',
    rowKey('mollie', 'tr_1') === rowKey('mollie', 'tr_1'), true);
check('two attempts on one invoice are two rows',
    rowKey('mollie', 'tr_1') === rowKey('mollie', 'tr_2'), false);
check('two providers may share an id',
    rowKey('mollie', 'x') === rowKey('stripe', 'x'), false);

/* -------------------------------------------------------------- stripe -- */

/*
 * The Stripe-Signature header, taken apart.
 *
 * The header is a comma-separated list of key=value. `t` is when it was
 * signed; there may be several `v1` digests at once while a secret is being
 * rotated, and any one of them matching is a match. Getting this wrong in the
 * generous direction - accepting a header with no digest, or with a timestamp
 * from last year - is accepting anything at all.
 */
const crypto = require('crypto');

function parse(header) {
    const out = { t: 0, v1: [] };

    for (const part of String(header || '').split(',')) {
        const pair = part.trim().split('=');
        if (pair.length !== 2) { continue; }
        if (pair[0] === 't' && /^[0-9]+$/.test(pair[1])) { out.t = parseInt(pair[1], 10); }
        if (pair[0] === 'v1') { out.v1.push(pair[1]); }
    }

    return out;
}

check('a normal header', parse('t=1700000000,v1=abc'), { t: 1700000000, v1: ['abc'] });
check('two digests during a rotation',
    parse('t=1,v1=aaa,v1=bbb'), { t: 1, v1: ['aaa', 'bbb'] });
check('spaces around the commas', parse('t=5, v1=xyz'), { t: 5, v1: ['xyz'] });
check('no digest at all', parse('t=5'), { t: 5, v1: [] });
check('nothing', parse(''), { t: 0, v1: [] });
check('a timestamp that is not a number', parse('t=soon,v1=a'), { t: 0, v1: ['a'] });
/* v0 is Stripe's own test-mode digest and is not what we verify against. */
check('only v1 counts', parse('t=5,v0=old,v1=new'), { t: 5, v1: ['new'] });

/*
 * The digest itself: HMAC-SHA256 over "timestamp.body" with the signing
 * secret. Reproduced here rather than asserted against a fixed string, so the
 * test says what the rule is instead of what one example happened to produce.
 */
function sign(timestamp, body, secret) {
    return crypto.createHmac('sha256', secret).update(timestamp + '.' + body).digest('hex');
}

function verify(header, body, secret, now, tolerance) {
    const parts = parse(header);

    if (parts.t <= 0 || parts.v1.length === 0) { return false; }
    if (Math.abs(now - parts.t) > tolerance) { return false; }

    const want = sign(parts.t, body, secret);

    return parts.v1.some((got) => got === want);
}

const BODY = '{"id":"cs_test_1"}';
const SECRET = 'whsec_example';
const SIGNED_AT = 1700000000;
const TOL = 300;

const good = 't=' + SIGNED_AT + ',v1=' + sign(SIGNED_AT, BODY, SECRET);

check('a genuine event', verify(good, BODY, SECRET, SIGNED_AT, TOL), true);
check('the body was changed in flight',
    verify(good, '{"id":"cs_test_2"}', SECRET, SIGNED_AT, TOL), false);
check('somebody else signed it',
    verify('t=' + SIGNED_AT + ',v1=' + sign(SIGNED_AT, BODY, 'whsec_wrong'), BODY, SECRET, SIGNED_AT, TOL), false);
check('an old event replayed', verify(good, BODY, SECRET, SIGNED_AT + 3600, TOL), false);
check('just inside the tolerance', verify(good, BODY, SECRET, SIGNED_AT + 299, TOL), true);
check('just outside it', verify(good, BODY, SECRET, SIGNED_AT + 301, TOL), false);
/* A clock far ahead is as wrong as one far behind, and only one of the two is
   somebody replaying - so both directions are refused. */
check('a timestamp from the future', verify(good, BODY, SECRET, SIGNED_AT - 3600, TOL), false);
check('no signature header', verify('', BODY, SECRET, SIGNED_AT, TOL), false);
check('one of two digests matches',
    verify('t=' + SIGNED_AT + ',v1=nonsense,v1=' + sign(SIGNED_AT, BODY, SECRET), BODY, SECRET, SIGNED_AT, TOL), true);

/*
 * And what counts as paid. A session can be complete while the payment is
 * still processing - a bank debit that lands in three days - and complete is
 * not money in the account.
 */
function stripeState(paymentStatus, status) {
    if (paymentStatus === 'paid') { return 'paid'; }
    if (status === 'expired') { return 'failed'; }
    return 'open';
}

check('paid is paid', stripeState('paid', 'complete'), 'paid');
check('complete but still processing', stripeState('unpaid', 'complete'), 'open');
check('no payment yet', stripeState('unpaid', 'open'), 'open');
check('the session ran out', stripeState('unpaid', 'expired'), 'failed');
check('paid even though expired is still paid', stripeState('paid', 'expired'), 'paid');

/* -------------------------------------------------------------- paypal -- */

/*
 * PayPal differs from the other two in one way that matters, and these are
 * the pieces of it.
 *
 * With Mollie and Stripe the customer's return is a courtesy - the money moved
 * while they were away. With PayPal the return is where it moves: their flow
 * approves an order and waits to be told to capture it, and an approved order
 * nobody captured is a customer who thinks they paid and a merchant with
 * nothing.
 */

/* Which environment a call goes to. The switch, not the credentials - PayPal
   client ids look the same either way, which is the whole reason it exists. */
function base(sandbox) {
    return sandbox ? 'https://api-m.sandbox.paypal.com' : 'https://api-m.paypal.com';
}

check('live by default', base(false), 'https://api-m.paypal.com');
check('sandbox when asked', base(true), 'https://api-m.sandbox.paypal.com');

/*
 * The approval link is picked by rel, never by position. The order PayPal
 * returns its links in is theirs to change, and reading links[1] is a bug
 * waiting for one of their release notes.
 */
function approval(links) {
    for (const link of links || []) {
        if (!link) { continue; }
        const rel = link.rel || '';
        const href = link.href || '';
        if ((rel === 'approve' || rel === 'payer-action') && href.startsWith('https://')) { return href; }
    }
    return null;
}

check('the approve link, wherever it sits',
    approval([{ rel: 'self', href: 'https://a' }, { rel: 'approve', href: 'https://b' }]), 'https://b');
check('their newer name for it',
    approval([{ rel: 'payer-action', href: 'https://c' }]), 'https://c');
check('self is not it', approval([{ rel: 'self', href: 'https://a' }]), null);
check('a link that is not https', approval([{ rel: 'approve', href: 'http://x' }]), null);
check('no links at all', approval([]), null);

/*
 * Which order a webhook event is about. A capture event names it deep in
 * supplementary data; an order event is the order itself. Both are read,
 * because which one arrives depends on what somebody subscribed to.
 */
function orderId(event) {
    const resource = (event && event.resource) || {};
    const nested = ((resource.supplementary_data || {}).related_ids || {}).order_id || '';

    if (nested) { return nested; }

    return event.resource_type === 'checkout-order' ? (resource.id || '') : '';
}

check('a capture event',
    orderId({ resource: { supplementary_data: { related_ids: { order_id: '5X9' } } } }), '5X9');
check('an order event',
    orderId({ resource_type: 'checkout-order', resource: { id: '7YQ' } }), '7YQ');
/* A capture's own id is not the order id, and using it would look up nothing -
   which is better than looking up the wrong thing, and is what this returns. */
check('a capture id is not an order id',
    orderId({ resource_type: 'capture', resource: { id: 'CAP1' } }), '');
check('an event about nothing we know', orderId({ resource: {} }), '');

/*
 * And what counts as paid. COMPLETED is the money; APPROVED is the customer
 * having agreed and the capture not having happened, which is exactly the
 * state that must not be mistaken for payment.
 */
function paypalState(status) {
    if (status === 'COMPLETED') { return 'paid'; }
    if (status === 'VOIDED') { return 'cancelled'; }
    return 'open';
}

check('completed is the money', paypalState('COMPLETED'), 'paid');
check('approved is not paid yet', paypalState('APPROVED'), 'open');
check('created is not paid', paypalState('CREATED'), 'open');
check('voided', paypalState('VOIDED'), 'cancelled');
check('a status nobody has seen', paypalState('SOMETHING'), 'open');

/*
 * The access token is cached for slightly less than its own life, so the
 * panel never presents one that expired between the cache and PayPal. Their
 * shortest sensible answer still has to leave a usable window, so there is a
 * floor under it.
 */
function ttl(expiresIn, margin, floor) {
    return Math.max(floor, expiresIn - margin);
}

check('a nine hour token', ttl(32400, 60, 60), 32340);
check('a short one keeps the floor', ttl(30, 60, 60), 60);
check('exactly the margin', ttl(60, 60, 60), 60);
check('nothing at all still gets the floor', ttl(0, 60, 60), 60);

/* ------------------------------------------------------------ renewals -- */

/*
 * The nightly pass, as the two questions it actually asks.
 *
 * Neither of them is "what did I do last time". A panel whose cron did not run
 * for a week has to catch up correctly on the next tick, and one that runs the
 * pass twice in a minute has to do nothing the second time - both of which
 * fall out of asking about the state of the world instead of keeping a marker.
 */

const DAY = 86400;

/*
 * Which orders get next period's invoice written.
 *
 * The last clause is the one that matters: an order with an unpaid renewal
 * invoice already waiting is skipped. Without it the pass would write a fresh
 * bill every night until somebody paid, and a customer would wake up to seven
 * invoices for one month.
 */
function shouldInvoice(order, now, noticeDays) {
    if (order.state !== 'active') { return false; }
    if (order.period === 'once') { return false; }
    if (order.next_due_at === null) { return false; }
    if (order.next_due_at > now + noticeDays * DAY) { return false; }
    return !order.has_unpaid_renewal;
}

const T = 1000 * DAY;
const NOTICE = 7;

const live = (over) => Object.assign({
    state: 'active', period: 'month', next_due_at: T + 3 * DAY, has_unpaid_renewal: false,
}, over || {});

check('due inside the notice window', shouldInvoice(live(), T, NOTICE), true);
check('due today', shouldInvoice(live({ next_due_at: T }), T, NOTICE), true);
check('not due for a month yet',
    shouldInvoice(live({ next_due_at: T + 30 * DAY }), T, NOTICE), false);
check('exactly at the edge of the window',
    shouldInvoice(live({ next_due_at: T + 7 * DAY }), T, NOTICE), true);
check('a day beyond the edge',
    shouldInvoice(live({ next_due_at: T + 8 * DAY }), T, NOTICE), false);

/* The one that stops seven invoices for one month. */
check('already invoiced and waiting to be paid',
    shouldInvoice(live({ has_unpaid_renewal: true }), T, NOTICE), false);

check('a one-off never renews', shouldInvoice(live({ period: 'once' }), T, NOTICE), false);
check('a suspended order is not invoiced again',
    shouldInvoice(live({ state: 'suspended' }), T, NOTICE), false);
check('nor a cancelled one', shouldInvoice(live({ state: 'cancelled' }), T, NOTICE), false);
check('nor one still waiting to be built',
    shouldInvoice(live({ state: 'pending' }), T, NOTICE), false);
check('no date at all', shouldInvoice(live({ next_due_at: null }), T, NOTICE), false);

/*
 * A long-overdue order is still invoiced - the date being far in the past does
 * not put it outside the window, it puts it well inside. A panel whose cron
 * was off for a month bills once on the next tick, not thirty times, because
 * the invoice it writes is then the unpaid one that stops the rest.
 */
check('a month behind is still one invoice',
    shouldInvoice(live({ next_due_at: T - 30 * DAY }), T, NOTICE), true);

/*
 * And which get stopped: an unpaid renewal invoice past its due date plus the
 * grace period. Read from the invoice, not the order - the invoice is the
 * thing that went unpaid and it carries when it should have been settled.
 */
function shouldSuspend(order, now, graceDays) {
    if (order.state !== 'active') { return false; }
    if (order.server_id === null) { return false; }
    if (!order.unpaid_due_at) { return false; }
    return order.unpaid_due_at < now - graceDays * DAY;
}

const GRACE = 7;
const running = (over) => Object.assign({
    state: 'active', server_id: 4, unpaid_due_at: null,
}, over || {});

check('nothing unpaid', shouldSuspend(running(), T, GRACE), false);
check('unpaid but inside the grace period',
    shouldSuspend(running({ unpaid_due_at: T - 3 * DAY }), T, GRACE), false);
check('unpaid exactly at the grace boundary',
    shouldSuspend(running({ unpaid_due_at: T - 7 * DAY }), T, GRACE), false);
check('unpaid one day past it',
    shouldSuspend(running({ unpaid_due_at: T - 8 * DAY }), T, GRACE), true);
check('an order with no server yet is not suspended',
    shouldSuspend(running({ server_id: null, unpaid_due_at: T - 30 * DAY }), T, GRACE), false);
check('an already suspended order is not suspended again',
    shouldSuspend(running({ state: 'suspended', unpaid_due_at: T - 30 * DAY }), T, GRACE), false);

/* A grace of zero means the day after the due date, not the same day. */
check('no grace at all, on the day', shouldSuspend(running({ unpaid_due_at: T }), T, 0), false);
check('no grace at all, the day after',
    shouldSuspend(running({ unpaid_due_at: T - DAY }), T, 0), true);

/*
 * A renewal invoice carries the price and the tax and not the setup fee. The
 * fee is charged once, on the first invoice; a renewal that carried it would
 * be charging every year for a setup that happened once.
 */
function renewalTotal(price, setupFee, rate) {
    const charged = tax(price, rate);
    return { subtotal: price, tax: charged, total: price + charged };
}

check('a renewal leaves the setup fee behind',
    renewalTotal(1250, 500, 0), { subtotal: 1250, tax: 0, total: 1250 });
check('with tax on it',
    renewalTotal(1250, 500, 2100), { subtotal: 1250, tax: 263, total: 1513 });

/* ------------------------------------------------------------- placing -- */

/*
 * The two races in the buying path, and what each of them answers.
 *
 * Both were found by asking what happens when two people press Buy in the same
 * second, which on a shop with one server in stock is the question that costs
 * real money.
 */

/*
 * The stock is counted a second time inside the transaction, with the package
 * row held. Without that both purchases count the orders before either has
 * written one, both see room, and one server in stock is sold twice.
 */
function writeOnce(stockLeftNow) {
    return stockLeftNow === 0 ? 'sold_out' : 'written';
}

check('room when the lock is taken', writeOnce(1), 'written');
check('the last one went while we waited', writeOnce(0), 'sold_out');

/*
 * And the retry. A rolled-back attempt wrote nothing, so trying again is
 * clean - and the second attempt counts the first one's invoice and takes the
 * next number. Sold out is not retried: it is an answer, not a failure.
 */
function place(outcomes, attempts) {
    for (let i = 0; i < attempts; i++) {
        const got = outcomes[i];

        if (got === 'sold_out') { return 'sold_out'; }
        if (got === 'written') { return 'ok'; }
    }

    return 'failed';
}

const ATTEMPTS = 3;

check('first time', place(['written'], ATTEMPTS), 'ok');
check('a number collision, then through',
    place([null, 'written'], ATTEMPTS), 'ok');
check('two collisions, then through',
    place([null, null, 'written'], ATTEMPTS), 'ok');
check('three in a row gives up',
    place([null, null, null], ATTEMPTS), 'failed');

/* Sold out stops on the spot - retrying would only find it sold out again,
   and the customer would wait three transactions to be told so. */
check('sold out is not retried', place(['sold_out', 'written'], ATTEMPTS), 'sold_out');
check('sold out on a retry still stops',
    place([null, 'sold_out', 'written'], ATTEMPTS), 'sold_out');

/* ------------------------------------------------------------- contract -- */

/*
 * Provision::endsAt - the day a contract runs out, worked out once when the
 * server is built and written on the order.
 *
 * From the order's snapshot rather than from the package, which is the whole
 * point of the snapshot: an administrator who shortens a package's term next
 * month has not shortened a contract somebody already signed.
 *
 * Days here rather than dates, so the arithmetic is checkable without a
 * calendar. UNIT is how many days each unit is worth for that purpose.
 */
const UNIT = { day: 1, month: 30, year: 365 };

function contractEnd(spec) {
    const length = Number(spec.term || 0);
    const unit = spec.term_unit;

    if (!(length > 0) || UNIT[unit] === undefined) { return null; }

    return length * UNIT[unit];
}

check('no term is no end date', contractEnd({ term: 0, term_unit: 'month' }), null);
check('a term with no unit is no end date', contractEnd({ term: 12 }), null);
check('a made-up unit is no end date', contractEnd({ term: 3, term_unit: 'fortnight' }), null);
check('thirty days', contractEnd({ term: 30, term_unit: 'day' }), 30);
check('twelve months', contractEnd({ term: 12, term_unit: 'month' }), 360);
check('one year', contractEnd({ term: 1, term_unit: 'year' }), 365);

/* A negative term is a typo, not a contract that ended last year. */
check('a negative term is no end date', contractEnd({ term: -6, term_unit: 'month' }), null);

/*
 * Orders::endsAt - what a cancellation runs to.
 *
 * Three answers in order. The contract date if there is one still ahead; the
 * period they have already paid for if there is not; and null when neither
 * applies, which is a one-off with no term and nothing to wait for.
 *
 * Dates as day numbers again, with 0 for today.
 */
function endsAt(order) {
    if (order.ends_at !== null && order.ends_at !== undefined && order.ends_at > 0) {
        return order.ends_at;
    }

    if (order.recurring && order.next_due_at !== null && order.next_due_at !== undefined && order.next_due_at > 0) {
        return order.next_due_at;
    }

    return null;
}

check('the contract date wins',
    endsAt({ ends_at: 200, recurring: true, next_due_at: 20 }), 200);
check('no contract falls back to the paid period',
    endsAt({ ends_at: null, recurring: true, next_due_at: 20 }), 20);
check('a one-off with no contract ends now',
    endsAt({ ends_at: null, recurring: false, next_due_at: null }), null);

/*
 * A date in the past is not a date. An order whose contract ran out while
 * nobody was looking is cancelled outright rather than given a notice period
 * that expired before it was written.
 */
check('a contract date that has gone is ignored',
    endsAt({ ends_at: -5, recurring: false, next_due_at: null }), null);
check('a due date that has gone falls through too',
    endsAt({ ends_at: null, recurring: true, next_due_at: -3 }), null);

/* --------------------------------------------------------- what cancel does */

/*
 * Orders::cancel - notice, or the end of it.
 *
 * The state it lands in is the whole of the difference Bryan asked for: with a
 * date it becomes 'ending' and the server keeps running until that day, and
 * without one there is nothing to wait for.
 */
function cancel(order) {
    if (order.state === 'cancelled' || order.state === 'ending') { return null; }

    const ends = endsAt(order);

    return {
        state: ends === null ? 'cancelled' : 'ending',
        ends_at: ends,
        next_due_at: null,
    };
}

check('cancelling a yearly contract gives notice',
    cancel({ state: 'active', ends_at: 300, recurring: true, next_due_at: 30 }),
    { state: 'ending', ends_at: 300, next_due_at: null });

check('cancelling a monthly with no term runs to the paid date',
    cancel({ state: 'active', ends_at: null, recurring: true, next_due_at: 12 }),
    { state: 'ending', ends_at: 12, next_due_at: null });

check('cancelling a one-off is immediate',
    cancel({ state: 'active', ends_at: null, recurring: false, next_due_at: null }),
    { state: 'cancelled', ends_at: null, next_due_at: null });

/* Nothing renews once notice is given, whichever it became. */
check('a suspended order can still be cancelled',
    cancel({ state: 'suspended', ends_at: 90, recurring: true, next_due_at: -4 }),
    { state: 'ending', ends_at: 90, next_due_at: null });

/* Pressing it twice must not move the date the customer was already given. */
check('cancelling twice does nothing',
    cancel({ state: 'ending', ends_at: 90, recurring: true, next_due_at: null }), null);
check('cancelling something already closed does nothing',
    cancel({ state: 'cancelled', ends_at: null, recurring: false, next_due_at: null }), null);

/* ------------------------------------------------------ the nightly close -- */

/*
 * Renewals::finished - the only thing in the plugin that deletes a server
 * without somebody pressing a button.
 *
 * Three conditions, all of them required, because the cost of being wrong here
 * is somebody's world: the order was cancelled by a person, a date was written
 * on it at that moment, and that date has arrived.
 */
function finishes(order, today) {
    return order.state === 'ending'
        && order.ends_at !== null
        && order.ends_at !== undefined
        && order.ends_at <= today;
}

check('the day it was due to end', finishes({ state: 'ending', ends_at: 10 }, 10), true);
check('a week after nobody ran the cron', finishes({ state: 'ending', ends_at: 10 }, 17), true);
check('the day before', finishes({ state: 'ending', ends_at: 10 }, 9), false);

/* An active order is never touched by this pass, whatever its dates say. */
check('an active order is left alone', finishes({ state: 'active', ends_at: 5 }, 10), false);
check('a suspended order is left alone', finishes({ state: 'suspended', ends_at: 5 }, 10), false);
check('an ending order with no date is left alone',
    finishes({ state: 'ending', ends_at: null }, 10), false);

/* And once it has run, the order is no longer ending, so it cannot run twice. */
function finish(order, deleted) {
    if (order.state !== 'ending') { return null; }

    return {
        state: 'cancelled',
        server_id: deleted ? null : order.server_id,
        ends_at: null,
    };
}

check('finishing closes it and lets the server go',
    finish({ state: 'ending', server_id: 41, ends_at: 10 }, true),
    { state: 'cancelled', server_id: null, ends_at: null });
check('finishing the same order twice does nothing',
    finish({ state: 'cancelled', server_id: null, ends_at: null }, true), null);

/* A node that would not answer must not cost us the only record of which
   server this was. The order closes so nobody is billed, and it keeps the id
   so Stop and delete can be pressed again once the node is back. */
check('a deletion that failed keeps the server it could not delete',
    finish({ state: 'ending', server_id: 41, ends_at: 10 }, false),
    { state: 'cancelled', server_id: 41, ends_at: null });

/* ------------------------------------------------------------- terminate -- */

/*
 * Orders::terminate - the one that does not wait.
 *
 * It is the same close, from any state and without a date. The distinction
 * worth testing is that it needs a server to remove and that it leaves nothing
 * for the nightly pass to find afterwards.
 */
function terminate(order) {
    if (order.state === 'cancelled' && order.server_id === null) { return null; }

    return { state: 'cancelled', server_id: null, ends_at: null, next_due_at: null };
}

check('an active order goes now',
    terminate({ state: 'active', server_id: 7 }),
    { state: 'cancelled', server_id: null, ends_at: null, next_due_at: null });
check('one already under notice goes now too',
    terminate({ state: 'ending', server_id: 7 }),
    { state: 'cancelled', server_id: null, ends_at: null, next_due_at: null });
check('a closed order with nothing left to remove does nothing',
    terminate({ state: 'cancelled', server_id: null }), null);

/* A closed order whose deletion failed still has a server, and the button has
   to work a second time - that is the whole reason the check is on the server
   and not on the state. */
check('a closed order whose server survived can be tried again',
    terminate({ state: 'cancelled', server_id: 7 }),
    { state: 'cancelled', server_id: null, ends_at: null, next_due_at: null });

/* After either one, the nightly pass has nothing to do. */
check('nothing is left for the nightly pass',
    finishes({ state: 'cancelled', ends_at: null }, 999), false);

/* ------------------------------------------------------------- the stock -- */

/*
 * An order under notice still holds its place in stock, because the server is
 * still running on a node. It stops holding it the day it is deleted.
 */
function occupies(state) { return OCCUPYING.indexOf(state) !== -1; }

check('a pending order holds its place', occupies('pending'), true);
check('an active order holds its place', occupies('active'), true);
check('a suspended order holds its place', occupies('suspended'), true);
check('an order under notice still holds its place', occupies('ending'), true);
check('a closed order gives it back', occupies('cancelled'), false);

/* ------------------------------------------------------------- takings -- */

/*
 * Takings::recurring - what the live services are worth every month.
 *
 * A yearly service is a twelfth of its price each month and a quarterly one a
 * third, so a shop selling both can be compared with one selling neither. The
 * division is integer on purpose: money is minor units and a third of a penny
 * is not a thing. It rounds down, which understates rather than overstates,
 * and that is the right direction for a number somebody plans with.
 */
function monthly(price, period) {
    if (price <= 0) { return 0; }

    if (period === 'year') { return Math.trunc(price / 12); }
    if (period === 'quarter') { return Math.trunc(price / 3); }
    if (period === 'month') { return price; }

    return 0;
}

check('a monthly service is its own price', monthly(1250, 'month'), 1250);
check('a quarterly service is a third', monthly(3600, 'quarter'), 1200);
check('a yearly service is a twelfth', monthly(12000, 'year'), 1000);

/* A one-off was paid once. It is not income next month, and counting it as
   though it were is how a shop talks itself into a number it cannot keep. */
check('a one-off is worth nothing per month', monthly(9900, 'once'), 0);
check('an unknown period is worth nothing', monthly(9900, 'fortnight'), 0);

/* Rounding down, both of them. */
check('a third of an odd amount rounds down', monthly(1000, 'quarter'), 333);
check('a twelfth of an odd amount rounds down', monthly(1000, 'year'), 83);
check('nothing is worth nothing', monthly(0, 'month'), 0);

/*
 * Takings::change - this month against last, as a whole percentage.
 *
 * Null when there is nothing to compare against. A percentage of zero is
 * infinity, and "up 0%" beside a real number is worse than no number at all -
 * which is the entire reason this returns null instead of a number.
 */
function change(now, before) {
    if (before <= 0) { return null; }

    return Math.round(((now - before) / before) * 100);
}

check('twice as much is up a hundred', change(2000, 1000), 100);
check('half as much is down fifty', change(500, 1000), -50);
check('the same is no change', change(1000, 1000), 0);
check('a first month has nothing to compare', change(1000, 0), null);
check('a month that took nothing still compares', change(0, 1000), -100);

/* -------------------------------------------------------- the reminder -- */

/*
 * Renewals::chasing - the one warning between an unpaid bill and a stopped
 * server.
 *
 * Four conditions, and the interesting one is the window: past the due date,
 * but not yet past the grace period. Outside it on the early side there is
 * nothing to warn about; outside it on the late side the server has already
 * stopped, and a warning about something that has happened is not a warning.
 *
 * Days again, with 0 for today and negative for the past, and the same GRACE
 * the suspension tests above are written against - it is the same setting.
 */
function chases(invoice, today) {
    return invoice.state === 'unpaid'
        && invoice.kind === 'renewal'
        && invoice.reminded_at === null
        && invoice.due_at !== null
        && invoice.due_at < today
        && invoice.due_at >= today - GRACE
        && invoice.order === 'active';
}

const open = { state: 'unpaid', kind: 'renewal', reminded_at: null, order: 'active' };
const bill = (due, extra) => Object.assign({}, open, { due_at: due }, extra || {});

check('one day late is chased', chases(bill(9), 10), true);
check('six days late is still chased', chases(bill(4), 10), true);

/* On the boundary it is chased, because the suspension happens after the
   grace period and not on the last day of it. */
check('the last day of the grace period is chased', chases(bill(3), 10), true);
check('the day after is not - the server has stopped', chases(bill(2), 10), false);

check('a bill due today is not late yet', chases(bill(10), 10), false);
check('a bill due next week is not chased', chases(bill(17), 10), false);

/* Once. reminded_at is a fact about the customer - we told them - so an
   invoice that has one is never selected again, whatever the dates say. */
check('somebody already told is not told twice',
    chases(bill(9, { reminded_at: 5 }), 10), false);

/* And only for a service that is still running. */
check('a suspended order is not chased', chases(bill(9, { order: 'suspended' }), 10), false);
check('a cancelled order is not chased', chases(bill(9, { order: 'cancelled' }), 10), false);
check('a paid invoice is not chased', chases(bill(9, { state: 'paid' }), 10), false);
check('a first invoice is not a renewal', chases(bill(9, { kind: 'order' }), 10), false);
check('an invoice with no date is not chased', chases(bill(null), 10), false);

/*
 * And the day it names. Worked out from the invoice rather than from today,
 * so a pass that runs late still names the day the server actually stops.
 */
function stopsOn(due) { return due + GRACE; }

check('the day named is the due date plus the grace period', stopsOn(9), 16);
check('running the pass late does not move it', stopsOn(4), 11);

/* ------------------------------------------------------- the front door -- */

/*
 * What sits at the panel's root, and what a stranger gets.
 *
 * Four cases, and they were correct by accident: nothing wrote them down, so
 * nothing would have noticed the day one of them changed. Checked against a
 * live panel's route table before being written here.
 *
 * The switch moves two things at once, and it has to be both. Pelican's own
 * ServerResource sits at slug '/' by default, so leaving it alone is what makes
 * the server list the landing page - and embedServerList() moves it into the
 * navigation so the shop can have the root instead. Doing one without the other
 * either loses the server list or puts two pages at one address.
 */
function landing(shopFirst) {
    return shopFirst ? 'store' : 'servers';
}

check('the shop takes the root when the switch is on', landing(true), 'store');
check('the server list keeps it when the switch is off', landing(false), 'servers');

/*
 * And where somebody with no account is sent from it.
 *
 * Only to the shop, and only when there is a shop to send them to: the public
 * page is what publishes it, so with that switch off the sign-in form is the
 * correct answer rather than a worse one.
 */
function guest(shopFirst, publicShop) {
    return shopFirst && publicShop ? '/shop' : '/login';
}

check('a stranger sees the shop', guest(true, true), '/shop');
check('a stranger signs in when the shop is not the front door',
    guest(false, true), '/login');
check('a stranger signs in when there is no public shop to show',
    guest(true, false), '/login');
check('neither switch, and it is the sign-in form', guest(false, false), '/login');

/* Somebody already signed in is never redirected - they have a panel to be in,
   whichever page is at the root of it. */
function signedIn(shopFirst) { return landing(shopFirst); }

check('signed in with the switch off lands on their servers', signedIn(false), 'servers');
check('signed in with the switch on lands on the shop', signedIn(true), 'store');

/* ------------------------------------------------------ nothing to pay -- */

/*
 * An invoice worth nothing settles itself.
 *
 * A coupon at a hundred percent leaves a total of zero, and zero is not an
 * amount any provider will take - Stripe refuses a line item under fifty cents,
 * and ours refused before even asking. The customer got "The payment could not
 * be opened" and the log said nothing at all, because that path returned null
 * without reporting.
 */
function settleFree(invoice) {
    if (invoice.total > 0) { return null; }
    if (invoice.state !== 'unpaid') { return null; }

    return { state: 'paid', paid_via: 'free' };
}

check('a hundred percent off settles itself',
    settleFree({ total: 0, state: 'unpaid' }), { state: 'paid', paid_via: 'free' });
check('an invoice with an amount does not', settleFree({ total: 500, state: 'unpaid' }), null);
check('one already paid is left alone', settleFree({ total: 0, state: 'paid' }), null);
check('a cancelled one is left alone', settleFree({ total: 0, state: 'cancelled' }), null);

/* Recorded as free rather than manual: nobody did anything, and an
   administrator reading the invoices page should not go looking for a payment
   that never existed. */
check('the source says free', settleFree({ total: 0, state: 'unpaid' }).paid_via, 'free');

/* And the page offers no providers for one, because none of them would take
   it - which is the whole of the bug this replaced. */
function waysFor(total, enabled) { return total > 0 ? enabled : []; }

check('a free invoice offers no providers', waysFor(0, ['stripe', 'mollie']), []);
check('one with an amount offers what is on', waysFor(500, ['stripe']), ['stripe']);

/* ------------------------------------------------- the customer answers -- */

/*
 * Only the questions the package actually asked.
 *
 * The browser sends whatever is in the form, and a form is markup: somebody
 * can add a field to it. The list of questions lives on the order snapshot,
 * so an answer to something that was never asked is dropped rather than
 * written into a server environment.
 */
function answers(asked, given) {
    const out = {};

    for (const name of asked) {
        if (Object.prototype.hasOwnProperty.call(given, name)) { out[name] = String(given[name]); }
    }

    return out;
}

check('what was asked is kept',
    answers(['SEED'], { SEED: 'abc' }), { SEED: 'abc' });
check('what was not asked is dropped',
    answers(['SEED'], { SEED: 'abc', STARTUP: 'rm -rf' }), { SEED: 'abc' });
check('a question left blank is simply absent', answers(['SEED'], {}), {});
check('a package that asks nothing keeps nothing',
    answers([], { SEED: 'abc' }), {});

/*
 * And the answers win over the package own values, because that is the whole
 * point of asking - but only for the names on the list.
 */
function environment(base, asked, given) {
    return Object.assign({}, base, answers(asked, given));
}

check('an answer beats the package value',
    environment({ SEED: 'default' }, ['SEED'], { SEED: 'mine' }), { SEED: 'mine' });
check('a package value with no question stands',
    environment({ SEED: 'default' }, [], { SEED: 'mine' }), { SEED: 'default' });

/* --------------------------------------------------------- the zip path -- */

/*
 * Where in the server the file goes. An administrator types this, so it is not
 * a customer walking upwards - but the daemon trusts what the panel sends it,
 * and a path that climbs is a path out of the server directory.
 */
function directory(given) {
    const path = String(given == null ? '' : given).trim();

    if (path === '' || path.indexOf('..') !== -1) { return '/'; }

    const parts = path.split(String.fromCharCode(92)).join(String.fromCharCode(47))
        .split(String.fromCharCode(47))
        .filter((piece) => piece !== '');

    const cleaned = String.fromCharCode(47) + parts.join(String.fromCharCode(47));

    return cleaned === '/' ? '/' : cleaned;
}

check('empty is the root', directory(''), '/');
check('null is the root', directory(null), '/');
check('a plain folder', directory('world'), '/world');
check('a leading slash is fine', directory('/world'), '/world');
check('a trailing slash is trimmed', directory('/world/'), '/world');
check('a nested path survives', directory('mods/config'), '/mods/config');

/* The one that matters. */
check('climbing out is refused', directory('../../etc'), '/');
check('climbing from inside is refused', directory('/world/../..'), '/');

/* Delivered once: the row is stamped before the copy is dropped, so a retry
   after a half-finished attempt does not put a second copy in. */
function delivers(order) {
    return String(order.upload_path || '') !== '' && order.delivered_at === null;
}

check('a waiting file is delivered', delivers({ upload_path: 'a.zip', delivered_at: null }), true);
check('one already delivered is left alone', delivers({ upload_path: 'a.zip', delivered_at: 5 }), false);
check('an order with no file does nothing', delivers({ upload_path: '', delivered_at: null }), false);

console.log(NEWLINE + 'shop: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
