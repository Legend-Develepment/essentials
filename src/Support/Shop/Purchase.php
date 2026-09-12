<?php

namespace LegendDevelopment\Theme\Support\Shop;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use LegendDevelopment\Theme\Models\Coupon;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Theme;
use RuntimeException;
use Throwable;

/**
 * Buying one package: what it would cost, and what happens when somebody says
 * yes.
 *
 * The two are deliberately separate. quote() is arithmetic and touches
 * nothing, so the checkout page can call it on every keystroke of a coupon
 * field; place() writes an order and an invoice and is called once. That split
 * is also why the total on the page and the total on the invoice are the same
 * number: they come from the same function rather than from two that agree
 * today.
 *
 * **A quote is not a promise.** Everything place() needs is checked again at
 * the moment it writes - the package is still live, the stock has not gone in
 * the seconds since, the code has not been used up by somebody else. A shop
 * that only checks on the page it drew is a shop that sells its last one twice.
 *
 * Money is minor units end to end. The only strings are what gets shown.
 */
class Purchase
{
    /** Nothing was wrong; the sale can go through. */
    public const OK = 'ok';

    public const GONE = 'gone';

    /** A package that wants a file, bought without one. */
    public const NO_FILE = 'no_file';

    /** Something was sent, and it was not a zip. */
    public const NOT_ZIP = 'not_zip';

    /** A zip larger than this panel will take. */
    public const TOO_BIG = 'too_big';

    public const SOLD_OUT = 'sold_out';

    public const BAD_COUPON = 'bad_coupon';

    public const FAILED = 'failed';

    /** Pressed Buy with an empty basket. Nothing is wrong; there is nothing to do. */
    public const EMPTY_BASKET = 'empty_basket';

    /**
     * How many times a write is tried before giving up.
     *
     * Three, because the only thing being retried is a running number two
     * purchases wanted at once - and a panel where three in a row collide has
     * a busier shop than this plugin is built for.
     */
    private const ATTEMPTS = 3;

    /**
     * What one package costs, with a code applied if there is one.
     *
     * The lines are what the invoice will say, built here so the page and the
     * document cannot disagree. A setup fee is its own line because it is a
     * different thing from the price and somebody reading the invoice a year
     * later should not have to work out why the first one was bigger.
     *
     * @return array{
     *     lines: array<int, array{text: string, amount: int}>,
     *     subtotal: int, discount: int, tax: int, total: int,
     *     tax_rate: int, currency: string, coupon: ?string
     * }
     */
    public static function quote(
        Package $package,
        ?Coupon $coupon = null,
        string $vat = '',
        int $items = 1,
        array $extras = [],
    ): array
    {
        $currency = Packages::currency();
        $setup = max(0, (int) $package->setup_fee);

        /*
         * What it costs with whatever offer is on it, for a basket this size.
         *
         * The checkout is a basket of one, so an offer that only starts at
         * three does not apply there - which is the honest answer rather than a
         * price that changes after the button is pressed.
         */
        $price = Packages::priceNow($package, $items);

        $lines = [[
            'text' => (string) $package->name . ' - ' . Theme::trans('packages.period_' . Packages::period($package->period)),
            'amount' => $price,
        ]];

        if ($setup > 0) {
            $lines[] = ['text' => Theme::trans('packages.setup_fee'), 'amount' => $setup];
        }

        // The coupon comes off what the lines add up to, whether or not the tax
        // is inside them: somebody told "10% off" means off what they pay.
        $discount = Coupons::discount($coupon, $price + $setup);

        /*
         * And the extras, after the coupon has been worked out.
         *
         * A code is off the package, not off what somebody piles on top of it.
         * That is a decision rather than an oversight: "ten percent off" on a
         * launch offer should not quietly become ten percent off four
         * gigabytes of memory, and a code for the whole of it would give the
         * extras away.
         */
        foreach (Addons::quoteLines($package, $extras) as $line) {
            $lines[] = $line;
        }

        return self::money($lines, $discount, $vat) + [
            'currency' => $currency,
            'coupon' => $coupon?->code,
        ];
    }

    /**
     * The same, for a basket.
     *
     * One line per package - two if it carries a setup fee - and the coupon
     * comes off the combined subtotal rather than off each item, because a
     * customer who is told "10% off" means off what they are paying.
     *
     * The rate and the currency are the panel's, so they cannot disagree
     * between two items in one basket.
     *
     * @param  array<int, Package>  $packages
     * @param  array<int, array<int|string, mixed>>  $extras  Chosen per package, by the same index.
     * @return array<string, mixed>
     */
    public static function quoteMany(
        array $packages,
        ?Coupon $coupon = null,
        string $vat = '',
        array $extras = [],
    ): array {
        $lines = [];
        $subtotal = 0;

        // How full the basket is, which is what an offer with a minimum asks
        // about. Counted once and handed to every line, so all of them agree
        // about whether the offer is on.
        $items = count($packages);

        /*
         * The extras belong to a package by position, which is why this walks
         * the index rather than the values.
         *
         * They were missing here for one version and the effect was exactly
         * what a missing line always is: the order carried two gigabytes, the
         * renewal billed for them, and the first invoice did not. A customer
         * got them free for a month and nothing said so.
         */
        foreach ($packages as $at => $package) {
            foreach (self::quote($package, null, '', $items, (array) ($extras[$at] ?? []))['lines'] as $line) {
                $lines[] = $line;
                $subtotal += (int) $line['amount'];
            }
        }

        return self::money($lines, Coupons::discount($coupon, $subtotal), $vat) + [
            'coupon' => $coupon?->code,
        ];
    }

    /** Whether a package's price already contains the tax. */
    public static function inclusive(): bool
    {
        return (bool) Theme::config('shop_tax_inclusive', false);
    }

    /**
     * Lines and a discount, turned into the four numbers a document carries.
     *
     * Every total in this shop comes through here - the checkout, the basket,
     * a renewal, and an invoice being revised because a service on it was
     * cancelled. Four places, and before this each did the arithmetic itself.
     * They agreed, which is luck rather than design: the moment tax could be
     * inside a price as well as on top of it, four copies became four chances
     * to get it wrong in a way nobody notices until an accountant does.
     *
     * **Tax on top:** subtotal is what the lines add up to, the discount comes
     * off, tax is worked out on what is left, and the total is the sum of the
     * two. The line amounts are what the shop showed.
     *
     * **Tax inside:** the lines are already what somebody pays, so the total is
     * simply the lines minus the discount, and the tax is the part of that
     * which is tax. It is not added again - it is said, because a document has
     * to state the tax it contains even when it did not add it.
     *
     * The shapes tell themselves apart afterwards without a column to say so:
     * on top, subtotal - discount + tax equals the total; inside, subtotal -
     * discount equals it. Which is what lets an invoice written last year print
     * the way it was written rather than the way the shop is set up today.
     *
     * @param  array<int, array{text: string, amount: int}>  $lines
     * @return array<string, mixed>
     */
    public static function money(array $lines, int $discount = 0, string $vat = ''): array
    {
        $subtotal = 0;

        foreach ($lines as $line) {
            $subtotal += max(0, (int) $line['amount']);
        }

        $rate = self::taxRate();
        $discount = max(0, min($discount, $subtotal));
        $after = $subtotal - $discount;

        /*
         * A business in another member state accounts for the tax itself, so
         * this invoice carries none.
         *
         * Where the price already contained tax, taking it off is not simply
         * setting the tax to zero - the customer would be paying the tax as
         * part of a price and being told there is none. The amounts are moved
         * back to what they are without it, and the discount is whatever now
         * separates the two, so the document still adds up exactly.
         */
        if ($rate > 0 && $vat !== '' && Vat::reverses($vat) && Vat::check($vat)) {
            if (!self::inclusive()) {
                return [
                    'lines' => $lines,
                    'subtotal' => $subtotal,
                    'discount' => $discount,
                    'tax' => 0,
                    'total' => $after,
                    'tax_rate' => $rate,
                    'currency' => Packages::currency(),
                    'reverse' => true,
                ];
            }

            $net = $after - Money::taxIn($after, $rate);
            $netSubtotal = $subtotal - Money::taxIn($subtotal, $rate);

            return [
                'lines' => $lines,
                'subtotal' => $netSubtotal,
                // What is left between the two, so subtotal minus discount is
                // exactly the total rather than a cent away from it.
                'discount' => max(0, $netSubtotal - $net),
                'tax' => 0,
                'total' => $net,
                'tax_rate' => $rate,
                'currency' => Packages::currency(),
                'reverse' => true,
            ];
        }

        if (self::inclusive()) {
            return [
                'lines' => $lines,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'tax' => Money::taxIn($after, $rate),
                'total' => $after,
                'tax_rate' => $rate,
                'currency' => Packages::currency(),
                'reverse' => false,
            ];
        }

        $tax = Money::tax($after, $rate);

        return [
            'lines' => $lines,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'tax' => $tax,
            'total' => $after + $tax,
            'tax_rate' => $rate,
            'currency' => Packages::currency(),
            'reverse' => false,
        ];
    }

    /**
     * The panel's tax rate, in basis points.
     *
     * Stored as basis points rather than a percentage so 8.25 % is a whole
     * number and no invoice ever carries a rounded rate. 0 means no tax line
     * at all, which is not the same as a line saying zero.
     */
    public static function taxRate(): int
    {
        /*
         * Already basis points. This multiplied by a hundred as well, which is
         * the conversion the settings page does on the way in - it shows a
         * percentage and stores 2100 for 21. Doing it twice made 21% into
         * 210000, and the clamp turned that into 100%: every invoice with tax
         * on it charged the whole of itself again.
         *
         * The form is the only place a percentage exists. Everything past it -
         * this, Money::tax(), the rate written on the invoice - is basis
         * points, and the one job here is to refuse a number outside them.
         */
        $stored = Theme::config('shop_tax', 0);
        $rate = (int) round((float) (is_numeric($stored) ? $stored : 0));

        return max(0, min(10000, $rate));
    }

    /**
     * Whether this package could be bought at all, right now.
     *
     * Asked by the shop page to grey a card, by the checkout page before it
     * draws a total, and by place() before it writes anything. One answer,
     * three readers.
     */
    public static function refusal(Package $package): ?string
    {
        if (!$package->buildable()) {
            return self::GONE;
        }

        if (Packages::soldOut($package)) {
            return self::SOLD_OUT;
        }

        return null;
    }

    /**
     * Place the order.
     *
     * Order and invoice are written inside one transaction, because half of a
     * purchase is worse than none: an order with no invoice is a server
     * somebody gets for free, and an invoice with no order is a bill for
     * nothing.
     *
     * Nothing is provisioned here. The server is built when the invoice is
     * paid, by Invoices::markPaid() - so a shop with no gateway configured and
     * an administrator marking invoices by hand runs exactly the same path as
     * one taking cards.
     *
     * @return array{state: string, invoice: ?Invoice, order: ?Order}
     */
    /**
     * @param  array<string, mixed>  $answers  What the customer filled in, by env name.
     * @param  string|null  $upload  Where their file is kept until the server exists.
     */
    public static function place(
        User $user,
        Package $package,
        mixed $code = null,
        array $answers = [],
        ?string $upload = null,
        string $vat = '',
        array $extras = [],
    ): array
    {
        /*
         * One item is a basket of one.
         *
         * Kept as its own method because everything that buys a single package
         * calls it and reads better for it, but it does not have a path of its
         * own: two ways to write an order is two places for a rule about stock
         * or coupons to be true in only one of them.
         */
        $placed = self::placeMany($user, [[
            'package' => $package,
            'answers' => $answers,
            'upload' => $upload,
            'extras' => $extras,
        ]], $code, $vat);

        return [
            'state' => $placed['state'],
            'invoice' => $placed['invoice'],
            'order' => $placed['orders'][0] ?? null,
        ];
    }

    /**
     * A basket: several packages, one invoice.
     *
     * Each item is a package with the answers and the upload that belong to it,
     * because those are asked per package and cannot be shared. What is shared
     * is the invoice, the coupon and the total - which is the whole point of a
     * basket, and the reason the invoice can bill more than one order.
     *
     * @param  array<int, array{package: Package, answers?: array<string, mixed>, upload?: ?string, extras?: array<int|string, mixed>}>  $items
     * @return array{state: string, invoice: ?Invoice, orders: array<int, Order>}
     */
    public static function placeMany(User $user, array $items, mixed $code = null, string $vat = ''): array
    {
        $items = array_values($items);

        if ($items === []) {
            return ['state' => self::EMPTY_BASKET, 'invoice' => null, 'orders' => []];
        }

        $packages = [];

        foreach ($items as $item) {
            $package = $item['package'];
            $refusal = self::refusal($package);

            // The first thing wrong with the basket, named. Not a list: the
            // customer fixes one and presses the button again.
            if ($refusal !== null) {
                return ['state' => $refusal, 'invoice' => null, 'orders' => []];
            }

            $packages[] = $package;
        }

        $typed = Coupons::normalise($code);
        $coupon = $typed === '' ? null : Coupons::find($typed);

        /*
         * A code has to cover everything in the basket.
         *
         * Coupons can be tied to particular packages, and a discount taken off
         * a combined subtotal cannot be tied to half of it without inventing a
         * rule about which half - so the answer is the honest one: a code that
         * does not apply to all of it does not apply.
         */
        if ($coupon !== null) {
            foreach ($packages as $package) {
                if (!$coupon->covers((int) $package->id)) {
                    $coupon = null;

                    break;
                }
            }
        }

        if ($typed !== '' && $coupon === null) {
            return ['state' => self::BAD_COUPON, 'invoice' => null, 'orders' => []];
        }

        // Normalised once, here, so what is checked, what is charged and what
        // is printed on the document are the same string.
        $vat = Vat::normalise($vat);
        $quote = self::quoteMany($packages, $coupon, $vat, array_map(
            static fn (array $item): array => (array) ($item['extras'] ?? []),
            $items,
        ));

        /*
         * Up to three goes at it.
         *
         * Invoice numbers are a running count, so two purchases landing in the
         * same instant can compute the same one and the unique index rejects
         * the second - which rolls its whole transaction back and would
         * otherwise tell a customer their order failed when nothing was wrong
         * with it. Nothing is written on a rolled-back attempt, so trying
         * again is clean, and the second attempt counts the first one's
         * invoice and takes the next number.
         */
        for ($attempt = 1; $attempt <= self::ATTEMPTS; $attempt++) {
            $written = self::write($user, $items, $quote, $coupon, $vat);

            if ($written === self::SOLD_OUT) {
                return ['state' => self::SOLD_OUT, 'invoice' => null, 'orders' => []];
            }

            if (is_array($written)) {
                // Outside the transaction on purpose. A code whose counter did
                // not move is a smaller problem than an order that rolled back
                // because a counter would not.
                Coupons::spend($coupon);

                /*
                 * And off any waiting list this answers. Outside the
                 * transaction like the lines around it, and a second delete of
                 * rows that have gone is a no-op - which matters, because this
                 * block is retried when an invoice number collides.
                 */
                Waiting::took((int) $user->id, array_map(
                    static fn (Order $order): int => (int) $order->package_id,
                    $written['orders'],
                ));

                Billing::announce($written['invoice']);

                return ['state' => self::OK, 'invoice' => $written['invoice'], 'orders' => $written['orders']];
            }
        }

        return ['state' => self::FAILED, 'invoice' => null, 'orders' => []];
    }

    /**
     * One attempt at writing the order and its invoice.
     *
     * Answers with every row it wrote, with SOLD_OUT when the stock went in the
     * seconds since the page was drawn, or with null when the write failed and
     * is worth trying again.
     *
     * @param  array<int, array{package: Package, answers?: array<string, mixed>, upload?: ?string, extras?: array<int|string, mixed>}>  $items
     * @param  array<string, mixed>  $quote
     * @return array{orders: array<int, Order>, invoice: Invoice}|string|null
     */
    /**
     * The answers, filtered to the questions that were actually asked.
     *
     * Anything else in what the browser sent is a field somebody added in a
     * browser, and a browser is not where the list of questions lives.
     *
     * @param  array<string, mixed>  $given
     * @return array<string, string>
     */
    private static function answers(Package $package, array $given): array
    {
        $out = [];

        foreach (Packages::asked($package) as $name) {
            if (!array_key_exists($name, $given) || !is_scalar($given[$name])) {
                continue;
            }

            $value = trim((string) $given[$name]);

            /*
             * A question left alone is a question left alone. Writing the empty
             * string would set the variable to nothing, which is not what an
             * untouched field means - it means "whatever the egg already had",
             * and leaving the name out entirely is how that is said.
             */
            if ($value === '') {
                continue;
            }

            $out[$name] = mb_substr($value, 0, 255);
        }

        return $out;
    }

    /**
     * @param  array<string, mixed>  $answers
     */
    private static function write(
        User $user,
        array $items,
        array $quote,
        ?Coupon $coupon,
        string $vat = '',
    ): array|string|null
    {
        try {
            /** @var array{orders: array<int, Order>, invoice: Invoice} $written */
            // Everything the closure reads goes in the use list. The answers and
            // the upload once did not, which is a fatal inside the transaction -
            // and so a purchase that failed three times and told the customer
            // nothing could be written.
            $written = DB::transaction(static function () use ($user, $items, $quote, $coupon, $vat): array {
                $orders = [];

                foreach ($items as $item) {
                    $package = $item['package'];

                    /*
                     * The last one, sold once.
                     *
                     * refusal() above asked whether there was stock; this asks
                     * again with the package row held, so two people pressing
                     * Buy in the same second cannot both be told yes. Without
                     * the lock they both count the orders before either has
                     * written one, and a shop with one server in stock sells
                     * two.
                     *
                     * Asked once per item rather than once for the basket, and
                     * that is what makes two of the same package behave: the
                     * first order is written before the second is counted, so
                     * it takes up stock exactly as somebody else's would.
                     *
                     * A no-op on SQLite, which has one writer anyway.
                     */
                    $held = Package::query()->whereKey($package->id)->lockForUpdate()->first();

                    if (!$held instanceof Package || Packages::soldOut($held)) {
                        throw new RuntimeException(self::SOLD_OUT);
                    }

                    $order = new Order();
                    $order->forceFill([
                        'user_id' => (int) $user->id,
                        'package_id' => (int) $package->id,
                        'server_id' => null,
                        'state' => Order::PENDING,
                        'spec' => Packages::spec($package),
                        'extras' => self::answers($package, (array) ($item['answers'] ?? [])),
                        'upload_path' => $item['upload'] ?? null,
                        'period' => Packages::period($package->period),
                        /*
                         * What was actually charged, not what the package
                         * lists. An offer is a price for this order, and the
                         * order is what a renewal reads next month - so a
                         * launch offer that renews at the offer price is a
                         * decision somebody made, and it is the one the
                         * customer was shown.
                         */
                        'price' => Packages::priceNow($package, count($items)),
                        'setup_fee' => (int) $package->setup_fee,
                        'currency' => $quote['currency'],
                        'next_due_at' => null,
                    ])->save();

                    /*
                     * The extras chosen with it, written on before the invoice
                     * is - the lines above already carry their price, and an
                     * order that is billed for something it does not hold is
                     * the one shape of this that cannot be put right later.
                     */
                    Addons::attach($order, array_map(
                        static fn (array $pick): array => [
                            'addon' => (int) $pick['addon']->id,
                            'quantity' => $pick['quantity'],
                        ],
                        Addons::picked($package, (array) ($item['extras'] ?? [])),
                    ));

                    $orders[] = $order;
                }

                $invoice = new Invoice();
                $invoice->forceFill([
                    'number' => Invoices::number(),
                    'user_id' => (int) $user->id,
                    // The first order, for everything written before an invoice
                    // could bill more than one. The pairing below is the whole
                    // truth; this is the half of it that older code reads.
                    'order_id' => (int) $orders[0]->id,
                    'kind' => Invoice::ORDER,
                    'state' => Invoice::UNPAID,
                    'subtotal' => $quote['subtotal'],
                    'discount' => $quote['discount'],
                    'tax' => $quote['tax'],
                    'total' => $quote['total'],
                    'tax_rate' => $quote['tax_rate'],
                    'currency' => $quote['currency'],
                    'coupon_code' => $coupon?->code,
                    'lines' => $quote['lines'],
                    /*
                     * Who this is for, as they are today.
                     *
                     * Through Customers::snapshot() rather than field by field:
                     * three things write an invoice and a renewal already
                     * forgot the VAT number once. A caller that has to remember
                     * six columns is a caller that will remember five.
                     *
                     * The number typed at the till still wins, because somebody
                     * buying for a company they have not saved yet is buying
                     * for that company now.
                     */
                    ...array_merge(
                        Customers::snapshot($user),
                        $vat !== '' ? ['customer_vat' => mb_substr($vat, 0, 32)] : [],
                    ),
                    /*
                     * Due today unless a term is set, which is what this shop
                     * did before the setting existed. Nothing about the server
                     * waits on this either way - an order is built when it is
                     * paid, not when it falls due - so the term is a sentence
                     * on the document rather than a delay.
                     */
                    'due_at' => now()->addDays(Billing::dueDays()),
                ])->save();

                Invoices::bill($invoice, $orders);

                /*
                 * And what the customer already has with us comes off it now,
                 * before they are ever shown a payment page.
                 *
                 * Here rather than at the moment somebody presses Pay, because
                 * an invoice that will be settled from the balance should say
                 * so from the moment it exists - it is emailed, it is listed,
                 * and a figure that changes between the email and the page is
                 * a figure nobody trusts.
                 */
                Credits::settle($invoice);

                return ['orders' => $orders, 'invoice' => $invoice];
            });
        } catch (RuntimeException $exception) {
            // The stock ran out between the page and the press. An ordinary
            // thing, and a sentence rather than a reported error.
            if ($exception->getMessage() === self::SOLD_OUT) {
                return self::SOLD_OUT;
            }

            report($exception);

            return null;
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }

        return $written;
    }
}
