<?php

namespace LegendDevelopment\Theme\Support\Shop;

use Illuminate\Support\Collection;
use LegendDevelopment\Theme\Models\Addon;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Models\OrderAddon;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Extras sold alongside a package, and what having one means.
 *
 * **A delta, never a value.** An addon says "and two thousand more megabytes",
 * because two of them bought together have to add up and two absolute values
 * cannot. What a server is actually allowed is the package's snapshot plus
 * everything hanging off the order, worked out in limits() and nowhere else -
 * three things build a server's limits and a fourth resizes one, and each of
 * them getting this right separately is how a customer ends up paying for
 * memory they do not have.
 *
 * **An addon need not touch the server at all.** All seven limits nought is a
 * line on an invoice and nothing more, which is exactly what priority support
 * is. Nothing here treats that as a special case; the sum simply adds nought.
 *
 * **Mid-period is pro-rated, the same way a package change is.** Buying one
 * halfway through a month costs half of it, and dropping one gives half of it
 * back. That is not a second implementation of the arithmetic - it is
 * Money::share() and the same day count Upgrades uses, because a customer who
 * upgrades and a customer who buys a gigabyte are asking the same question.
 */
class Addons
{
    /** What is on sale and fits this package, cheapest first. */
    public static function forPackage(?Package $package): Collection
    {
        if (!Features::enabled(Features::ADDONS) || !$package instanceof Package) {
            return new Collection();
        }

        try {
            return Addon::query()
                ->where('live', true)
                ->orderBy('sort')
                ->orderBy('price')
                ->get()
                ->filter(static fn (Addon $addon): bool => $addon->fits((int) $package->id))
                ->values();
        } catch (Throwable) {
            // No table yet on a panel between the file swap and the install.
            // Nothing on sale is the honest answer.
            return new Collection();
        }
    }

    /** What this service actually has. */
    public static function of(Order $order): Collection
    {
        if (!Features::enabled(Features::ADDONS)) {
            return new Collection();
        }

        try {
            return $order->relationLoaded('addons')
                ? $order->addons
                : OrderAddon::query()->where('order_id', (int) $order->id)->orderBy('id')->get();
        } catch (Throwable) {
            return new Collection();
        }
    }

    /**
     * What the server may use: the package, plus everything bought with it.
     *
     * The one place the sum is done. Provision builds from this, Upgrades
     * resizes from it, and adding or dropping an addon goes through it - so the
     * four of them cannot disagree about what somebody is entitled to.
     *
     * A spec may be handed in, for the moment during a package change when the
     * order still says one thing and is about to say another.
     *
     * @param  array<string, mixed>|null  $spec
     * @return array<string, mixed>
     */
    public static function limits(Order $order, ?array $spec = null): array
    {
        $spec ??= is_array($order->spec) ? $order->spec : [];
        $limits = Servers::limits($spec);

        foreach (self::of($order) as $line) {
            foreach ($line->deltas() as $key => $delta) {
                if ($delta === 0) {
                    continue;
                }

                /*
                 * Never below nothing, and that matters more than it looks.
                 * Nought is Pelican's word for unlimited on several of these,
                 * so an addon that took a limit negative would not be a small
                 * server - it would be one with no limit at all.
                 */
                $limits[$key] = max(0, (int) ($limits[$key] ?? 0) + $delta);
            }
        }

        return $limits;
    }

    /**
     * What a set of chosen extras costs, as invoice lines.
     *
     * Used by the checkout, where the extras are bought with the package and
     * charged whole: there is no part-period to work out, because the period
     * starts with them in it.
     *
     * Anything that does not fit the package, is off sale, or is asked for more
     * times than it allows is dropped rather than refused. The list comes from a
     * form, and a stale tick in it must not lose somebody their order.
     *
     * @param  array<int|string, mixed>  $chosen  Addon id to quantity.
     * @return array<int, array{text: string, amount: int}>
     */
    public static function quoteLines(?Package $package, array $chosen): array
    {
        $out = [];

        foreach (self::picked($package, $chosen) as $pick) {
            $addon = $pick['addon'];
            $many = $pick['quantity'];

            $out[] = [
                'text' => $many > 1
                    ? (string) $addon->name . ' × ' . $many
                    : (string) $addon->name,
                'amount' => (int) $addon->price * $many,
            ];
        }

        return $out;
    }

    /**
     * A form's worth of ticks, as the addons they name.
     *
     * One place that turns "what somebody chose" into "what they may have", so
     * the quote and the order cannot disagree about it - which is the way a
     * customer ends up billed for something their server never got.
     *
     * @param  array<int|string, mixed>  $chosen
     * @return array<int, array{addon: Addon, quantity: int}>
     */
    public static function picked(?Package $package, array $chosen): array
    {
        if (!Features::enabled(Features::ADDONS) || $chosen === []) {
            return [];
        }

        $out = [];

        foreach ($chosen as $id => $quantity) {
            $addon = self::live((int) $id);

            if ($addon === null) {
                continue;
            }

            if ($package instanceof Package && !$addon->fits((int) $package->id)) {
                continue;
            }

            $many = self::many($addon, (int) $quantity);

            if ($many <= 0) {
                continue;
            }

            $out[] = ['addon' => $addon, 'quantity' => $many];
        }

        return $out;
    }

    /**
     * Write the chosen addons onto an order.
     *
     * @param  array<int, array{addon: int, quantity: int}>  $chosen
     * @return int What they came to, once.
     */
    public static function attach(Order $order, array $chosen): int
    {
        if (!Features::enabled(Features::ADDONS) || $chosen === []) {
            return 0;
        }

        $package = $order->package;
        $total = 0;

        foreach ($chosen as $pick) {
            $addon = self::live((int) ($pick['addon'] ?? 0));

            if ($addon === null || ($package instanceof Package && !$addon->fits((int) $package->id))) {
                continue;
            }

            $many = self::many($addon, (int) ($pick['quantity'] ?? 1));

            if ($many <= 0) {
                continue;
            }

            try {
                OrderAddon::query()->create([
                    'order_id' => (int) $order->id,
                    'addon_id' => (int) $addon->id,
                    // The snapshot: name, price and what it adds, as they are
                    // today. An addon edited next year does not change this.
                    'name' => mb_substr((string) $addon->name, 0, 191),
                    'price' => (int) $addon->price,
                    'billing' => $addon->recurring() ? Addon::WITH : Addon::ONCE,
                    'quantity' => $many,
                    'spec' => $addon->deltas(),
                ]);
            } catch (Throwable $exception) {
                report($exception);

                continue;
            }

            $total += (int) $addon->price * $many;
        }

        return $total;
    }

    /**
     * What an order's addons add to a renewal.
     *
     * Only the recurring ones. A one-off was charged on the invoice that first
     * carried it and charging it again every month is the oldest billing bug
     * there is.
     */
    public static function renewing(Order $order): int
    {
        $total = 0;

        foreach (self::of($order) as $line) {
            if ($line->recurring()) {
                $total += $line->total();
            }
        }

        return $total;
    }

    /**
     * The lines an addon puts on a document.
     *
     * Their own lines rather than a bigger figure on the package's, because a
     * customer reading an invoice should be able to see what they are paying
     * for. A total that quietly includes four extras is a support ticket.
     *
     * @return array<int, array{text: string, amount: int}>
     */
    public static function lines(Order $order, bool $renewalOnly = false): array
    {
        $out = [];

        foreach (self::of($order) as $line) {
            if ($renewalOnly && !$line->recurring()) {
                continue;
            }

            $many = max(1, (int) $line->quantity);

            $out[] = [
                'text' => $many > 1
                    ? $line->name . ' × ' . $many
                    : (string) $line->name,
                'amount' => $line->total(),
            ];
        }

        return $out;
    }

    /**
     * Add one to a service that is already running.
     *
     * Pro-rated to what is left of the period, so somebody buying a gigabyte on
     * the twenty-eighth pays for two days of it rather than a month. The whole
     * price is what renews next time; this is only the stub.
     *
     * @return array{ok: bool, reason: string, invoice: ?Invoice, amount: int}
     */
    public static function buy(Order $order, Addon $addon, int $quantity = 1, string $vat = ''): array
    {
        $no = static fn (string $reason): array => [
            'ok' => false,
            'reason' => $reason,
            'invoice' => null,
            'amount' => 0,
        ];

        if (!Features::enabled(Features::ADDONS)) {
            return $no('off');
        }

        if ($order->state !== Order::ACTIVE) {
            return $no('not_active');
        }

        if (!(bool) $addon->live) {
            return $no('gone');
        }

        $package = $order->package;

        if ($package instanceof Package && !$addon->fits((int) $package->id)) {
            return $no('wrong_package');
        }

        $many = self::many($addon, $quantity, self::held($order, (int) $addon->id));

        if ($many <= 0) {
            return $no('enough');
        }

        $full = (int) $addon->price * $many;

        /*
         * A one-off is charged whole: there is no period to divide, because it
         * is not being sold for a stretch of time. A recurring one is charged
         * for the days left in the period the customer has already paid for.
         */
        $amount = $addon->recurring()
            ? Money::share($full, Periods::left($order), Periods::length($order))
            : $full;

        $invoice = $amount > 0
            ? self::bill($order, $addon, $many, $amount, $vat)
            : null;

        if ($amount > 0 && !$invoice instanceof Invoice) {
            return $no('failed');
        }

        /*
         * Nothing to pay - a free addon, or one bought on the last day of a
         * period - so it happens now. Anything with a price waits for its
         * invoice, and Addons::settle() is what finishes it.
         */
        if ($invoice === null) {
            return self::apply($order, $addon, $many)
                ? ['ok' => true, 'reason' => '', 'invoice' => null, 'amount' => 0]
                : $no('server');
        }

        return ['ok' => true, 'reason' => '', 'invoice' => $invoice, 'amount' => $amount];
    }

    /**
     * Give one up.
     *
     * The unused part of what was paid comes back as credit and the server
     * shrinks now, which is the same trade a downgrade makes: money owed to a
     * customer should not wait behind a date, and a limit somebody has stopped
     * paying for should not linger for three weeks.
     *
     * @return array{ok: bool, reason: string, back: int}
     */
    public static function drop(Order $order, OrderAddon $line): array
    {
        if (!Features::enabled(Features::ADDONS)) {
            return ['ok' => false, 'reason' => 'off', 'back' => 0];
        }

        if ((int) $line->order_id !== (int) $order->id) {
            return ['ok' => false, 'reason' => 'not_yours', 'back' => 0];
        }

        /*
         * Only the recurring ones give anything back. A one-off bought and
         * dropped is a thing that was delivered; the money for it is not owed
         * back because a limit went away.
         */
        $back = $line->recurring()
            ? Money::share($line->total(), Periods::left($order), Periods::length($order))
            : 0;

        try {
            $line->delete();
        } catch (Throwable $exception) {
            report($exception);

            return ['ok' => false, 'reason' => 'failed', 'back' => 0];
        }

        self::resize($order);

        if ($back > 0) {
            Credits::add(
                (int) $order->user_id,
                $back,
                Theme::trans('addons.credit_reason', ['name' => (string) $line->name]),
                null,
                null,
            );
        }

        return ['ok' => true, 'reason' => '', 'back' => $back];
    }

    /**
     * The addon this invoice was for, now that it is paid.
     *
     * Called from Invoices::markPaid(), like an upgrade. An invoice of this
     * kind never advances a due date and never builds anything.
     */
    public static function settle(Invoice $invoice): void
    {
        $waiting = is_array($invoice->addon_for) ? $invoice->addon_for : [];

        $order = $invoice->order;
        $addon = self::live((int) ($waiting['addon'] ?? 0));

        if (!$order instanceof Order || $addon === null) {
            return;
        }

        self::apply($order, $addon, max(1, (int) ($waiting['quantity'] ?? 1)));
    }

    /** Write it on, and give the server what it now allows. */
    public static function apply(Order $order, Addon $addon, int $quantity): bool
    {
        if (self::attach($order, [['addon' => (int) $addon->id, 'quantity' => $quantity]]) < 0) {
            return false;
        }

        // Read afresh: attach() has just written a row this order does not know
        // about, and a stale relation would resize to the limits it had before.
        $order->unsetRelation('addons');

        return self::resize($order);
    }

    /**
     * Hand the server whatever its order now adds up to.
     *
     * Quiet about a node that is merely behind: the limits are recorded and it
     * reads them when the server next boots. Loud about one that refused, since
     * that is a customer paying for something they have not got.
     */
    public static function resize(Order $order): bool
    {
        $server = $order->server;

        if ($server === null) {
            // Nothing built yet. Provision reads the same sum when it does.
            return true;
        }

        $result = Servers::resize($server, self::limits($order));

        if (!$result['ok']) {
            Billing::trouble(
                Theme::trans('addons.bell_failed', ['number' => '#' . (int) $order->id]),
                $result['reason'],
            );

            return false;
        }

        return true;
    }

    /** How many of this addon the order already carries. */
    public static function held(Order $order, int $addonId): int
    {
        $many = 0;

        foreach (self::of($order) as $line) {
            if ((int) $line->addon_id === $addonId) {
                $many += max(1, (int) $line->quantity);
            }
        }

        return $many;
    }

    /** One that is on sale, or null. */
    private static function live(int $id): ?Addon
    {
        if ($id <= 0) {
            return null;
        }

        try {
            $addon = Addon::query()->find($id);
        } catch (Throwable) {
            return null;
        }

        return $addon instanceof Addon && (bool) $addon->live ? $addon : null;
    }

    /** A quantity inside what the addon allows, given what is already held. */
    private static function many(Addon $addon, int $asked, int $already = 0): int
    {
        $most = max(1, (int) $addon->max);

        return max(0, min(max(1, $asked), $most - $already));
    }

    /**
     * The invoice for one bought mid-period.
     *
     * Its own kind, for the reason an upgrade's is: settled as a renewal it
     * would advance the due date and hand out a free period.
     */
    private static function bill(Order $order, Addon $addon, int $many, int $amount, string $vat): ?Invoice
    {
        $lines = [[
            'description' => Theme::trans('addons.line', [
                'name' => (string) $addon->name,
                'many' => (string) $many,
                'days' => (string) Periods::left($order),
            ]),
            'quantity' => 1,
            'amount' => $amount,
        ]];

        $money = Purchase::money($lines, 0, $vat);

        try {
            $invoice = new Invoice();

            $invoice->forceFill([
                'number' => Invoices::number(),
                'user_id' => (int) $order->user_id,
                'order_id' => (int) $order->id,
                'kind' => Invoice::ADDON,
                'state' => Invoice::UNPAID,
                'subtotal' => $money['subtotal'],
                'discount' => 0,
                'tax' => $money['tax'],
                'total' => $money['total'],
                'tax_rate' => $money['tax_rate'],
                'currency' => (string) ($order->currency ?: Packages::currency()),
                'lines' => $lines,
                // What to do when it is paid. On the invoice rather than in a
                // table of its own: it is one addon and one quantity, and a
                // table for two integers is a table.
                'addon_for' => ['addon' => (int) $addon->id, 'quantity' => $many],
                ...Customers::snapshot($order->user),
                'due_at' => now(),
            ])->save();

            Invoices::bill($invoice, [$order]);
            Credits::settle($invoice);

            return $invoice;
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }
    }
}
