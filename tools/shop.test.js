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

console.log(NEWLINE + 'shop: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
