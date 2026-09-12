/*
 * Extras sold alongside a package.
 *
 * The arithmetic is small and the two ways to get it wrong are both about
 * addition.
 *
 *   An extra is a delta, never a value. Two gigabytes bought twice is four
 *   gigabytes, and that only works if what is stored is "and two thousand
 *   more" rather than "memory is six thousand". Everything below that looks
 *   like a tautology is checking that they still add up.
 *
 *   And a limit never goes below nothing, which matters more than it looks:
 *   nought is Pelican's word for unlimited on several of these, so an extra
 *   that took a limit negative would not make a small server, it would make one
 *   with no limit at all.
 *
 * The money is Money::share() and the same day count a package change uses,
 * because a customer buying a gigabyte in the middle of a month and one
 * upgrading in the middle of a month are asking the same question.
 */
let pass = 0;
let fail = 0;

const NEWLINE = String.fromCharCode(10);

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + NEWLINE + '        got  ' + JSON.stringify(got) + NEWLINE + '        want ' + JSON.stringify(want));
};

const LIMITS = ['memory', 'swap', 'disk', 'cpu', 'database_limit', 'allocation_limit', 'backup_limit'];

/* --------------------------------------------------------- the sum ------ */

/** OrderAddon::deltas(): what it adds, times how many were bought. */
const deltas = (line) => {
    const out = {};
    const many = Math.max(1, line.quantity || 1);

    for (const key of LIMITS) out[key] = (line.spec[key] || 0) * many;

    return out;
};

/** Addons::limits(): the package, plus everything hanging off the order. */
function limits(spec, lines) {
    const out = {};

    for (const key of LIMITS) out[key] = spec[key] || 0;

    for (const line of lines) {
        for (const [key, delta] of Object.entries(deltas(line))) {
            if (delta === 0) continue;

            out[key] = Math.max(0, out[key] + delta);
        }
    }

    return out;
}

const base = { memory: 2048, disk: 10240, cpu: 100, backup_limit: 1 };
const gig = { spec: { memory: 1024 }, quantity: 1 };

check('no extras leaves the package alone', limits(base, []).memory, 2048);
check('one gigabyte adds a gigabyte', limits(base, [gig]).memory, 3072);
check('two of them add two', limits(base, [gig, gig]).memory, 4096);
check('two bought as a quantity add the same', limits(base, [{ spec: { memory: 1024 }, quantity: 2 }]).memory, 4096);
check('and it touches nothing else', limits(base, [gig]).disk, 10240);

/* Which is the whole reason a delta is stored rather than a value. */
check('a delta of two is two, wherever it starts', limits({ memory: 512 }, [gig]).memory, 1536);
check('and the same delta on a bigger package', limits({ memory: 8192 }, [gig]).memory, 9216);

/* Several extras, several limits, all at once. */
const loaded = limits(base, [
    { spec: { memory: 1024 }, quantity: 2 },
    { spec: { backup_limit: 5 }, quantity: 1 },
    { spec: {} , quantity: 1 },
]);

check('memory took both gigabytes', loaded.memory, 4096);
check('backups took the five', loaded.backup_limit, 6);
check('an extra that adds nothing added nothing', loaded.cpu, 100);

/* An extra may take away, and a limit still never goes below nothing. */
check('a negative delta takes away', limits({ backup_limit: 5 }, [{ spec: { backup_limit: -3 }, quantity: 1 }]).backup_limit, 2);
check('but never past nothing', limits({ backup_limit: 1 }, [{ spec: { backup_limit: -5 }, quantity: 1 }]).backup_limit, 0);

/*
 * Which is not a rounding nicety. Nought means unlimited on several of these,
 * so the clamp is the difference between a small server and one with no cap.
 */
check('taking two databases off one leaves nought, not minus one', limits({ database_limit: 1 }, [{ spec: { database_limit: -2 }, quantity: 1 }]).database_limit, 0);

/* ------------------------------------------------- what it costs now ---- */

/** Money::share(): a part of an amount, half up, never past the whole. */
const share = (amount, part, whole) => {
    if (amount <= 0 || part <= 0 || whole <= 0) return 0;
    if (part >= whole) return amount;

    return Math.floor((amount * part + Math.floor(whole / 2)) / whole);
};

/**
 * Addons::buy(): a recurring extra is pro-rated, a one-off is not.
 *
 * A one-off is not being sold for a stretch of time, so there is no stretch to
 * divide. Charging half of it because somebody bought it on the fifteenth would
 * be charging half for the whole thing.
 */
const costsNow = (price, many, recurring, left, days) => recurring
    ? share(price * many, left, days)
    : price * many;

check('bought on day one, nearly all of it', costsNow(500, 1, true, 30, 30), 500);
check('halfway, half of it', costsNow(500, 1, true, 15, 30), 250);
check('on the last day, nothing', costsNow(500, 1, true, 0, 30), 0);
check('two of them, halfway', costsNow(500, 2, true, 15, 30), 500);
check('a one-off is charged whole whenever it is bought', costsNow(500, 1, false, 15, 30), 500);
check('and on the last day too', costsNow(500, 1, false, 0, 30), 500);

/* An overdue service has nought days left, so an extra costs nothing today. */
check('overdue costs nothing now', costsNow(500, 1, true, 0, 30), 0);

/* And dropping gives back the same share, for recurring ones only. */
const backOnDrop = (price, many, recurring, left, days) => recurring
    ? share(price * many, left, days)
    : 0;

check('dropping halfway gives half back', backOnDrop(500, 1, true, 15, 30), 250);
check('dropping two gives both halves', backOnDrop(500, 2, true, 15, 30), 500);
check('a one-off gives nothing back', backOnDrop(500, 1, false, 15, 30), 0);
check('dropping on the last day gives nothing back', backOnDrop(500, 1, true, 0, 30), 0);

/*
 * Bought and dropped on the same day nets to nothing, which is the property
 * that keeps somebody from making money by toggling a button.
 */
check('bought and dropped the same day is a wash',
    costsNow(500, 1, true, 15, 30) - backOnDrop(500, 1, true, 15, 30), 0);

/* -------------------------------------------------- what renews --------- */

/**
 * Addons::renewing() and lines(): only the recurring ones.
 *
 * A one-off was charged on the invoice that first carried it. Charging it again
 * every month is the oldest billing bug there is.
 */
const renewing = (lines) => lines
    .filter((line) => line.billing !== 'once')
    .reduce((sum, line) => sum + line.price * Math.max(1, line.quantity || 1), 0);

const held = [
    { name: 'A gigabyte', price: 500, billing: 'with', quantity: 2 },
    { name: 'Setting up', price: 2500, billing: 'once', quantity: 1 },
    { name: 'A backup slot', price: 200, billing: 'with', quantity: 1 },
];

check('the recurring ones add up', renewing(held), 1200);
check('the one-off is left out', renewing(held) < 1200 + 2500, true);
check('nothing held renews nothing', renewing([]), 0);
check('only one-offs renew nothing', renewing([held[1]]), 0);

/* They go on as their own lines rather than folded into the package price. */
const lines = (holdings) => holdings
    .filter((line) => line.billing !== 'once')
    .map((line) => ({
        text: (line.quantity || 1) > 1 ? line.name + ' x ' + line.quantity : line.name,
        amount: line.price * Math.max(1, line.quantity || 1),
    }));

check('two of one become one line saying so', lines(held)[0], { text: 'A gigabyte x 2', amount: 1000 });
check('one of one is just its name', lines(held)[1], { text: 'A backup slot', amount: 200 });
check('and a renewal has as many lines as it has extras', lines(held).length, 2);

/* --------------------------------------------- what the first bill says - */

/*
 * The extras go on the invoice that buys them, not only on the order.
 *
 * This shipped wrong for one version and a probe against the live panel caught
 * it: the checkout's own quote counted them, but a purchase builds its quote
 * through the basket's, and that one did not know about them. The order
 * carried two gigabytes, the renewal billed for them, and the first invoice
 * did not - so a customer got them free for a month with nothing saying so.
 */
const firstBill = (packagePrice, setupFee, extras) => packagePrice + setupFee
    + extras.reduce((sum, extra) => sum + extra.price * Math.max(1, extra.quantity || 1), 0);

check('a package on its own', firstBill(1000, 0, []), 1000);
check('with a setup fee', firstBill(1000, 500, []), 1500);
check('with two gigabytes and a one-off', firstBill(1000, 0, [
    { price: 500, quantity: 2 },
    { price: 2500, quantity: 1 },
]), 4500);

/*
 * Which has to match what the order then renews plus what was one-off - the
 * property that was broken. The first bill covers everything; the renewal
 * covers the recurring half.
 */
const bought = [
    { price: 500, quantity: 2, billing: 'with' },
    { price: 2500, quantity: 1, billing: 'once' },
];

check('the first bill has both kinds on it', firstBill(1000, 0, bought), 4500);
check('and the renewal has only the recurring one', 1000 + renewing(bought), 2000);
check('so the difference is exactly the one-off', firstBill(1000, 0, bought) - (1000 + renewing(bought)), 2500);

/* ------------------------------------------------- what is allowed ------ */

/** Addon::fits(): an empty list means any package. */
const fits = (addon, packageId) => addon.packages.length === 0 || addon.packages.includes(packageId);

check('an extra for everything fits', fits({ packages: [] }, 7), true);
check('one naming this package fits', fits({ packages: [7, 9] }, 7), true);
check('one naming others does not', fits({ packages: [8, 9] }, 7), false);

/** Addons::many(): inside what the addon allows, given what is already held. */
const many = (max, asked, already) => Math.max(0, Math.min(Math.max(1, asked), Math.max(1, max) - already));

check('one of one, holding none', many(1, 1, 0), 1);
check('one of one, already holding it', many(1, 1, 1), 0);
check('asking for five where three are allowed', many(3, 5, 0), 3);
check('asking for five holding two of three', many(3, 5, 2), 1);
check('asking for nothing still asks for one', many(3, 0, 0), 1);
check('holding more than allowed asks for none', many(3, 1, 4), 0);

/* ------------------------------------------------- what settles it ------ */

/*
 * An extra bought mid-period gets an invoice of its own kind, for the reason a
 * package change does: settled as a renewal it would advance the due date and
 * hand out a free period.
 */
const advances = (kind) => kind === 'renewal' || kind === 'order';

check('a renewal advances the period', advances('renewal'), true);
check('an addon invoice does not', advances('addon'), false);
check('nor does an upgrade', advances('upgrade'), false);
check('nor a top-up', advances('topup'), false);

/*
 * And one that costs nothing today - a free extra, or one bought on the last
 * day - happens at once rather than waiting for an invoice of nought that no
 * provider would take.
 */
const route = (amount) => amount > 0 ? 'invoice' : 'now';

check('something to pay waits for its invoice', route(250), 'invoice');
check('nothing to pay happens now', route(0), 'now');

/* ------------------------------------------------------------------------ */

console.log('Addons: ' + pass + ' passed, ' + fail + ' failed.');
process.exit(fail === 0 ? 0 : 1);
