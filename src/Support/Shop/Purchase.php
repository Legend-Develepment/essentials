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
    public static function quote(Package $package, ?Coupon $coupon = null): array
    {
        $currency = Packages::currency();
        $price = max(0, (int) $package->price);
        $setup = max(0, (int) $package->setup_fee);

        $lines = [[
            'text' => (string) $package->name . ' - ' . Theme::trans('packages.period_' . Packages::period($package->period)),
            'amount' => $price,
        ]];

        if ($setup > 0) {
            $lines[] = ['text' => Theme::trans('packages.setup_fee'), 'amount' => $setup];
        }

        $subtotal = $price + $setup;
        $discount = Coupons::discount($coupon, $subtotal);
        $rate = self::taxRate();
        $tax = Money::tax($subtotal - $discount, $rate);

        return [
            'lines' => $lines,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'tax' => $tax,
            'total' => max(0, $subtotal - $discount + $tax),
            'tax_rate' => $rate,
            'currency' => $currency,
            'coupon' => $coupon?->code,
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
    ): array
    {
        $refusal = self::refusal($package);

        if ($refusal !== null) {
            return ['state' => $refusal, 'invoice' => null, 'order' => null];
        }

        $typed = Coupons::normalise($code);
        $coupon = $typed === '' ? null : Coupons::find($typed, $package);

        if ($typed !== '' && $coupon === null) {
            return ['state' => self::BAD_COUPON, 'invoice' => null, 'order' => null];
        }

        $quote = self::quote($package, $coupon);

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
            $written = self::write($user, $package, $quote, $coupon, $answers, $upload);

            if ($written === self::SOLD_OUT) {
                return ['state' => self::SOLD_OUT, 'invoice' => null, 'order' => null];
            }

            if (is_array($written)) {
                // Outside the transaction on purpose. A code whose counter did
                // not move is a smaller problem than an order that rolled back
                // because a counter would not.
                Coupons::spend($coupon);

                Billing::announce($written['invoice']);

                return ['state' => self::OK, 'invoice' => $written['invoice'], 'order' => $written['order']];
            }
        }

        return ['state' => self::FAILED, 'invoice' => null, 'order' => null];
    }

    /**
     * One attempt at writing the order and its invoice.
     *
     * Answers with both rows, with SOLD_OUT when the stock went in the seconds
     * since the page was drawn, or with null when the write failed and is
     * worth trying again.
     *
     * @param  array<string, mixed>  $quote
     * @return array{order: Order, invoice: Invoice}|string|null
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

            $out[$name] = mb_substr((string) $given[$name], 0, 255);
        }

        return $out;
    }

    /**
     * @param  array<string, mixed>  $answers
     */
    private static function write(
        User $user,
        Package $package,
        array $quote,
        ?Coupon $coupon,
        array $answers = [],
        ?string $upload = null,
    ): array|string|null
    {
        try {
            /** @var array{order: Order, invoice: Invoice} $written */
            $written = DB::transaction(static function () use ($user, $package, $quote, $coupon): array {
                /*
                 * The last one, sold once.
                 *
                 * refusal() above asked whether there was stock; this asks
                 * again with the package row held, so two people pressing Buy
                 * in the same second cannot both be told yes. Without the lock
                 * they both count the orders before either has written one,
                 * both see room, and a shop with one server in stock sells two.
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
                    'extras' => self::answers($package, $answers),
                    'upload_path' => $upload,
                    'period' => Packages::period($package->period),
                    'price' => (int) $package->price,
                    'setup_fee' => (int) $package->setup_fee,
                    'currency' => $quote['currency'],
                    'next_due_at' => null,
                ])->save();

                $invoice = new Invoice();
                $invoice->forceFill([
                    'number' => Invoices::number(),
                    'user_id' => (int) $user->id,
                    'order_id' => (int) $order->id,
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
                    'customer_name' => mb_substr((string) $user->username, 0, 191),
                    'customer_email' => mb_substr((string) $user->email, 0, 191),
                    'due_at' => now(),
                ])->save();

                return ['order' => $order, 'invoice' => $invoice];
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
