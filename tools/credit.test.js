/*
 * Money the shop holds for a customer, and money it gives back.
 *
 * The arithmetic here is small and the ways to get it wrong are all the same
 * way: mixing up what a document says with what somebody still has to pay.
 *
 *   An invoice keeps its total. Credit comes off what is payable, never off the
 *   total, because the total states the supply and the tax on it - and neither
 *   of those changes because the buyer had money on account. So `due` is the
 *   derived figure and `total` is the recorded one, and every test below that
 *   looks redundant is checking that they stayed apart.
 *
 *   A balance is a sum of rows, so it can never disagree with its history and
 *   it can never go below nothing. Spending is refused rather than clamped: a
 *   spend that quietly took what it could would leave an invoice marked part
 *   settled from a balance that never held it.
 *
 *   Refundable is the invoice less every credit note already written against
 *   it. Two half refunds make a whole and a third makes nothing.
 *
 * Minor units throughout, because that is what the database holds.
 */
let pass = 0;
let fail = 0;

const NEWLINE = String.fromCharCode(10);

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + NEWLINE + '        got  ' + JSON.stringify(got) + NEWLINE + '        want ' + JSON.stringify(want));
};

/* ------------------------------------------------- what is left to pay -- */

/** Invoice::due() */
const due = (invoice) => Math.max(0, invoice.total - (invoice.credit || 0));

/** Invoice::free() */
const free = (invoice) => due(invoice) <= 0;

check('nothing applied leaves the whole total', due({ total: 1210 }), 1210);
check('part applied leaves the rest', due({ total: 1210, credit: 500 }), 710);
check('all of it applied leaves nothing', due({ total: 1210, credit: 1210 }), 0);
check('more than the total cannot go negative', due({ total: 1210, credit: 2000 }), 0);
check('a total of nothing is nothing', due({ total: 0 }), 0);

check('an ordinary invoice is not free', free({ total: 1210 }), false);
check('one covered by credit is free', free({ total: 1210, credit: 1210 }), true);
check('one half covered is not free', free({ total: 1210, credit: 605 }), false);
check('a coupon that took it all is free', free({ total: 0 }), true);

/*
 * The total is untouched by any of that. This is the whole reason `credit` is
 * its own column rather than a subtraction done when the invoice is written:
 * the tax line has to keep describing the supply.
 */
const settled = { total: 1210, tax: 210, tax_rate: 2100, credit: 500 };
check('the total still states the supply', settled.total, 1210);
check('the tax still states the supply', settled.tax, 210);

/* ------------------------------------------------------- the balance ---- */

/** Credits::balance(): the sum, and only in this shop's currency. */
const balance = (rows, currency) => rows
    .filter((row) => row.currency === currency)
    .reduce((held, row) => held + row.amount, 0);

const ledger = [
    { amount: 1000, currency: 'EUR' },
    { amount: -400, currency: 'EUR' },
    { amount: 5000, currency: 'USD' },
];

check('a balance is its rows added up', balance(ledger, 'EUR'), 600);
check('another currency is not converted, it is ignored', balance(ledger, 'USD'), 5000);
check('a currency with no rows holds nothing', balance(ledger, 'GBP'), 0);
check('an empty ledger holds nothing', balance([], 'EUR'), 0);

/*
 * Two movements that cancel out leave a balance of nothing and a history of
 * two, which is the point of a ledger. A balance column would have shown the
 * same nought with nothing to explain it.
 */
check('given and taken back nets to nothing', balance([
    { amount: 500, currency: 'EUR' },
    { amount: -500, currency: 'EUR' },
], 'EUR'), 0);
check('and the history still has both', [
    { amount: 500, currency: 'EUR' },
    { amount: -500, currency: 'EUR' },
].length, 2);

/** Credits::spend(): refused rather than clamped. */
const spend = (held, amount) => amount > 0 && held >= amount;

check('spending what is there is allowed', spend(600, 600), true);
check('spending less than there is', spend(600, 100), true);
check('spending more than there is is refused', spend(600, 601), false);
check('spending from nothing is refused', spend(0, 1), false);
check('spending nothing is refused', spend(600, 0), false);
check('spending a negative is refused', spend(600, -100), false);

/* ------------------------------------------ what an invoice takes off --- */

/**
 * Credits::settle(): the smaller of what is still owed and what is held.
 *
 * **Bounded by due(), and cumulative.** That is what makes running it any
 * number of times safe without a flag saying it has run - an invoice with
 * nothing left to pay owes nought and takes nothing, whatever the balance.
 *
 * The first version refused outright once `credit` was set, which made it run
 * exactly once per invoice: a customer who had half a bill covered and then
 * topped up was still looking at the other half, with the money sitting right
 * there. Every check below with a credit already on it is about that.
 *
 * Nought for anything that is not an unpaid ordinary invoice with something
 * still owing on it. The two documents that are about the balance itself are
 * refused by name: a credit note is money going the other way, and paying for a
 * top-up out of the balance is a sum that goes round in a circle.
 */
function settle(invoice, held) {
    if (invoice.state !== 'unpaid') return 0;
    if (invoice.kind === 'credit' || invoice.kind === 'topup') return 0;

    const owed = Math.max(0, invoice.total - (invoice.credit || 0));

    if (owed <= 0) return 0;

    return Math.max(0, Math.min(owed, held));
}

const unpaid = (total) => ({ state: 'unpaid', kind: 'order', total });

check('a balance smaller than the bill covers part', settle(unpaid(1000), 500), 500);
check('a balance larger than the bill covers the bill', settle(unpaid(400), 500), 400);
check('exactly enough covers it exactly', settle(unpaid(500), 500), 500);
check('no balance takes nothing', settle(unpaid(1000), 0), 0);
check('a paid invoice takes nothing', settle({ state: 'paid', kind: 'order', total: 1000 }, 500), 0);
check('a cancelled invoice takes nothing', settle({ state: 'cancelled', kind: 'order', total: 1000 }, 500), 0);
check('a credit note takes nothing', settle({ state: 'unpaid', kind: 'credit', total: 1000 }, 500), 0);
check('a top-up takes nothing', settle({ state: 'unpaid', kind: 'topup', total: 1000 }, 500), 0);
check('an invoice worth nothing takes nothing', settle(unpaid(0), 500), 0);

/* The half-covered bill, and the top-up that finishes it. */
const half = { state: 'unpaid', kind: 'order', total: 1000, credit: 300 };

check('a part-settled bill takes what is still owed', settle(half, 500), 500);
check('and no more than that', settle(half, 5000), 700);
check('one already covered in full takes nothing', settle({ state: 'unpaid', kind: 'order', total: 1000, credit: 1000 }, 500), 0);
check('running it twice over takes nothing the second time', settle({ ...half, credit: 300 + settle(half, 500) }, 0), 0);

/*
 * Which is the property that matters: settle, add the take to the invoice,
 * settle again, and the second one is a no-op rather than a second spend.
 */
let running = { state: 'unpaid', kind: 'order', total: 1000, credit: 0 };
let spent = 0;

for (let i = 0; i < 5; i++) {
    const took = settle(running, 1000 - spent);
    spent += took;
    running = { ...running, credit: running.credit + took };
}

check('five passes spend the bill once', spent, 1000);
check('and leave it covered exactly', running.credit, 1000);

/*
 * The two cases the plan named, end to end.
 *
 * Five on account, a bill of four: the bill is settled and one is left.
 * Five on account, a bill of ten: five is asked for and the account is empty.
 */
const cheap = unpaid(400);
const took = settle(cheap, 500);
check('a four euro bill against five euro credit takes four', took, 400);
check('and leaves one on the account', 500 - took, 100);
check('and the bill is then free', free({ total: 400, credit: took }), true);

const dear = unpaid(1000);
const partly = settle(dear, 500);
check('a ten euro bill against five euro credit takes five', partly, 500);
check('and leaves nothing on the account', 500 - partly, 0);
check('and five is still to pay', due({ total: 1000, credit: partly }), 500);
check('so it is not free', free({ total: 1000, credit: partly }), false);

/* -------------------------------------------- a balance against bills --- */

/**
 * Credits::settleOpen(): oldest first, until the money runs out.
 *
 * Oldest first because the oldest is the one closest to being chased, and a
 * customer with fifty euro against a hundred owed would rather clear the bill
 * that is overdue than the one that is not.
 */
function settleOpen(invoices, held) {
    // Nothing to spend is not a queue to walk. The PHP asks the balance once
    // before it reads a single invoice, for the same reason: on most panels
    // this is the answer for everybody.
    if (held <= 0) return { out: [], left: 0 };

    const queue = invoices
        .filter((invoice) => invoice.state === 'unpaid' && invoice.kind !== 'credit' && invoice.kind !== 'topup')
        .slice()
        .sort((a, b) => a.due - b.due);

    let left = held;
    const out = [];

    for (const invoice of queue) {
        const took = settle(invoice, left);

        left -= took;
        out.push({ id: invoice.id, took, settled: (invoice.credit || 0) + took >= invoice.total });

        if (left <= 0) break;
    }

    return { out, left };
}

const bills = [
    { id: 2, state: 'unpaid', kind: 'renewal', total: 1000, due: 20 },
    { id: 1, state: 'unpaid', kind: 'order', total: 400, due: 10 },
    { id: 3, state: 'paid', kind: 'order', total: 900, due: 5 },
    { id: 4, state: 'unpaid', kind: 'topup', total: 2000, due: 1 },
];

const swept = settleOpen(bills, 600);

check('the oldest unpaid bill is taken first', swept.out[0].id, 1);
check('and it is cleared', swept.out[0].settled, true);
check('the next one gets what is left', swept.out[1].took, 200);
check('which does not clear it', swept.out[1].settled, false);
check('and the balance is empty', swept.left, 0);
check('a paid bill and a top-up were never in the queue', swept.out.length, 2);

/* Enough for everything clears everything and leaves the rest. */
const rich = settleOpen(bills, 5000);

check('plenty clears both', rich.out.every((row) => row.settled), true);
check('and leaves the difference', rich.left, 5000 - 1400);

/* Nothing on account touches nothing. */
check('an empty balance takes nothing', settleOpen(bills, 0).out.length, 0);

/* -------------------------------------------------- putting money on ---- */

/**
 * Credits::topUp(): a floor and a ceiling.
 *
 * The floor is not a policy about small amounts - no provider will take a
 * payment of nothing and several refuse anything under half a unit. The
 * ceiling is a guard against a nought too many.
 */
const LEAST = 100;
const MOST = 1000000;
const mayTopUp = (amount) => amount >= LEAST && amount <= MOST;

check('a pound is allowed', mayTopUp(100), true);
check('a penny is not', mayTopUp(1), false);
check('nothing is not', mayTopUp(0), false);
check('a negative is not', mayTopUp(-500), false);
check('ten thousand is allowed', mayTopUp(1000000), true);
check('a hundred thousand is a slipped finger', mayTopUp(10000000), false);

/*
 * A top-up carries no tax, and that is not an oversight: nothing has been
 * supplied yet. The tax is charged on whatever it eventually pays for, which is
 * where the supply is. Taxing both would charge it twice.
 */
const topUp = (amount) => ({ kind: 'topup', subtotal: amount, tax: 0, tax_rate: 0, total: amount });

check('a top-up is its own amount', topUp(2500).total, 2500);
check('with no tax on it', topUp(2500).tax, 0);
check('and no rate stated', topUp(2500).tax_rate, 0);

/*
 * And paying one adds it. Which is why turnover has to leave them out: a
 * hundred euro put on account and then spent is one sale, not two.
 */
const withTopUps = (invoices) => invoices.reduce(
    (sum, invoice) => sum + (invoice.kind === 'credit' || invoice.kind === 'topup' ? 0 : invoice.total),
    0,
);

check('a top-up is not turnover', withTopUps([{ kind: 'topup', total: 10000 }]), 0);
check('what it later buys is', withTopUps([
    { kind: 'topup', total: 10000 },
    { kind: 'order', total: 10000 },
]), 10000);

/* ------------------------------------------------- giving money back ---- */

/** Credits::refundable(): the invoice, less the notes already written. */
const refundable = (invoice, notes) => {
    if (invoice.state !== 'paid' || invoice.kind === 'credit') return 0;

    const given = notes
        .filter((note) => note.credit_for === invoice.id)
        .reduce((sum, note) => sum + note.total, 0);

    return Math.max(0, invoice.total - given);
};

const paid = { id: 7, state: 'paid', kind: 'order', total: 1000 };

check('nothing given back yet leaves the whole', refundable(paid, []), 1000);
check('half given back leaves half', refundable(paid, [{ credit_for: 7, total: 500 }]), 500);
check('two halves leave nothing', refundable(paid, [
    { credit_for: 7, total: 500 },
    { credit_for: 7, total: 500 },
]), 0);
check('a note about another invoice does not count', refundable(paid, [{ credit_for: 8, total: 500 }]), 1000);
check('an unpaid invoice cannot be refunded', refundable({ id: 7, state: 'unpaid', kind: 'order', total: 1000 }, []), 0);
check('a credit note cannot itself be refunded', refundable({ id: 7, state: 'paid', kind: 'credit', total: 1000 }, []), 0);

/*
 * And over-refunding is refused before a provider ever hears about it. A shop
 * that has to be told no by somebody else's API does not know its own books.
 */
const mayRefund = (invoice, notes, amount) => amount > 0 && amount <= refundable(invoice, notes);

check('refunding what is left is allowed', mayRefund(paid, [], 1000), true);
check('refunding part of it is allowed', mayRefund(paid, [], 1), true);
check('refunding a penny more is refused', mayRefund(paid, [], 1001), false);
check('a third half is refused', mayRefund(paid, [
    { credit_for: 7, total: 500 },
    { credit_for: 7, total: 500 },
], 500), false);
check('refunding nothing is refused', mayRefund(paid, [], 0), false);

/* ----------------------------------------- which payment can carry it --- */

/**
 * Refunds::payable(): a paid attempt with room left in it.
 *
 * Room is what it took less what has gone back out of it, which is not the
 * same question as what is left on the invoice - an invoice can hold several
 * attempts and at most one of them took money.
 */
const payable = (payments, amount) => payments.find((payment) =>
    payment.state === 'paid' && payment.amount - (payment.refunded || 0) >= amount) || null;

const attempts = [
    { id: 1, state: 'cancelled', amount: 1000 },
    { id: 2, state: 'paid', amount: 1000, refunded: 400 },
];

check('the paid attempt is the one with room', payable(attempts, 600)?.id, 2);
check('and not one that took nothing', payable([attempts[0]], 100), null);
check('room already used is not offered again', payable(attempts, 601), null);
check('exactly the room left is offered', payable(attempts, 600)?.id, 2);

/* ------------------------------------------------------- the takings ---- */

/**
 * Takings::paidBetween(): what came in, less what went back.
 *
 * A credit note is a paid invoice in the same table, so without the
 * subtraction a refund would read as a second sale.
 */
const turnover = (invoices) => invoices.reduce(
    (sum, invoice) => sum + (invoice.kind === 'credit' ? -invoice.total : invoice.total),
    0,
);

check('two sales add up', turnover([
    { kind: 'order', total: 1000 },
    { kind: 'renewal', total: 500 },
]), 1500);

check('a refund comes off', turnover([
    { kind: 'order', total: 1000 },
    { kind: 'credit', total: 400 },
]), 600);

check('a sale refunded whole is nothing', turnover([
    { kind: 'order', total: 1000 },
    { kind: 'credit', total: 1000 },
]), 0);

/*
 * Credit given in one month and spent in the next nets out on its own, and it
 * has to: the note takes it off the month it was written and the invoice it
 * eventually settles puts it back in the month that one was paid.
 */
const january = turnover([{ kind: 'order', total: 1000 }, { kind: 'credit', total: 1000 }]);
const february = turnover([{ kind: 'order', total: 1000 }]);

check('the month of the refund shows nothing', january, 0);
check('the month it is spent shows the sale', february, 1000);
check('and the two months together show one sale', january + february, 1000);

/* ---------------------------------------------- what is actually owed --- */

/** Takings::owed(): totals less credit, credit notes left out. */
const owed = (invoices) => Math.max(0, invoices
    .filter((invoice) => invoice.state === 'unpaid' && invoice.kind !== 'credit')
    .reduce((sum, invoice) => sum + invoice.total - (invoice.credit || 0), 0));

check('an unpaid invoice is owed in full', owed([{ state: 'unpaid', kind: 'order', total: 1000 }]), 1000);
check('one part settled is owed for the rest', owed([{ state: 'unpaid', kind: 'order', total: 1000, credit: 400 }]), 600);
check('a paid one is not owed', owed([{ state: 'paid', kind: 'order', total: 1000 }]), 0);
check('a credit note is not owed', owed([{ state: 'unpaid', kind: 'credit', total: 1000 }]), 0);
check('nothing outstanding is nothing', owed([]), 0);

/* --------------------------------------------- an amount with a sign ---- */

/*
 * Money::fromInput() refuses a minus, because everywhere else it reads a price.
 * Giving credit is the one place a minus means something, so the sign is read
 * off the front and put back afterwards.
 */
function signed(text) {
    const negative = text.startsWith('-');
    const amount = fromInput(negative ? text.slice(1).trimStart() : text);

    return amount === null ? null : (negative ? -amount : amount);
}

/** Money::fromInput(), as far as the sign question needs it. */
function fromInput(text) {
    const clean = text.trim().replace(/ /g, '');

    if (clean === '' || !/^[0-9.,]+$/.test(clean)) return null;

    const at = Math.max(clean.lastIndexOf('.'), clean.lastIndexOf(','));

    if (at === -1) return Number(clean) * 100;

    const whole = clean.slice(0, at).replace(/[.,]/g, '');
    const fraction = clean.slice(at + 1);

    if (fraction.length === 3) return Number(clean.replace(/[.,]/g, '')) * 100;
    if (fraction.length > 2) return null;

    return Number(whole || '0') * 100 + Number(fraction.padEnd(2, '0'));
}

check('a plain amount is positive', signed('5.00'), 500);
check('a comma reads the same', signed('5,00'), 500);
check('a minus takes it away', signed('-5.00'), -500);
check('a minus with a space after it still parses', signed('- 5.00'), -500);
check('a minus on a comma amount', signed('-12,50'), -1250);
check('nothing is not an amount', signed(''), null);
check('a word is not an amount', signed('five'), null);
check('a lone minus is not an amount', signed('-'), null);

/* ------------------------------------------------------------------------ */

console.log('Credit: ' + pass + ' passed, ' + fail + ' failed.');
process.exit(fail === 0 ? 0 : 1);
