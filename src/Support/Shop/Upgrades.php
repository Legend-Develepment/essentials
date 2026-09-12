<?php

namespace LegendDevelopment\Theme\Support\Shop;

use Illuminate\Support\Carbon;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Models\Upgrade;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Moving a live service from one package to another, mid-period.
 *
 * **The arithmetic is one sentence.** What is left of the period the customer
 * already paid for comes back, and the same stretch of time is charged again at
 * the new price. The difference is what changes hands. Upgrade on the first day
 * and that is very nearly the whole difference in price; upgrade on the last
 * day and it is very nearly nothing, which is right - they had the small
 * package for the month they paid for it.
 *
 * **What is refused, and why.** A different egg is not an upgrade, it is a
 * different server, and pretending otherwise would hand somebody a Minecraft
 * world running a Rust image. A different billing period is a different
 * agreement rather than a bigger one. A service that is not active has nothing
 * to pro-rate. And a package can only be moved to one its own list names, which
 * is the shop deciding what a ladder looks like rather than this guessing from
 * prices.
 *
 * **Money first, server second, and never the other way round.** A bigger
 * package is invoiced and applied when that invoice is paid. A smaller one is
 * applied at once and the difference goes on the customer's balance, because
 * there is nothing to wait for and money owed to a customer should not sit
 * behind a button somebody has to press.
 *
 * **A failure leaves the order where it was.** If the node will not take the
 * new limits, the order keeps its old package and carries the reason, the owner
 * is rung, and the row here says refused. That is the same shape as
 * Provision::refuse(), and it is chosen over rolling the money back for the
 * same reason: an upgrade recorded and not applied can be applied again, and a
 * payment quietly reversed cannot be un-reversed.
 */
class Upgrades
{
    /**
     * Which packages this order may move to.
     *
     * The package's own list, filtered by everything that makes a move
     * impossible rather than merely unwise. An administrator who lists a
     * package with another egg gets it dropped here rather than getting a
     * broken server later.
     *
     * @return array<int, Package>
     */
    public static function options(Order $order): array
    {
        if (!Features::enabled(Features::UPGRADES) || $order->state !== Order::ACTIVE) {
            return [];
        }

        $from = $order->package;

        if (!$from instanceof Package) {
            return [];
        }

        $wanted = is_array($from->upgrade_to) ? $from->upgrade_to : [];

        if ($wanted === []) {
            return [];
        }

        try {
            $packages = Package::query()
                ->whereIn('id', array_map('intval', $wanted))
                ->where('live', true)
                ->orderBy('price')
                ->get();
        } catch (Throwable) {
            return [];
        }

        return $packages
            ->filter(static fn (Package $to): bool => self::may($order, $from, $to) === null)
            ->values()
            ->all();
    }

    /**
     * Why this move cannot be made, or null when it can.
     *
     * A reason string rather than a bool, because every one of these is shown
     * to somebody: three of them to an administrator wondering why a package is
     * not in the list, and the last to a customer who was too slow.
     */
    public static function may(Order $order, Package $from, Package $to): ?string
    {
        if ((int) $to->id === (int) $from->id) {
            return 'same';
        }

        // The whole reason the shop asks which packages, rather than working it
        // out from the prices.
        if ((int) $to->egg_id !== (int) $from->egg_id) {
            return 'egg';
        }

        if (Packages::period($to->period) !== Packages::period($order->period)) {
            return 'period';
        }

        if (Packages::soldOut($to)) {
            return 'stock';
        }

        return null;
    }

    /**
     * What moving to this package costs, today.
     *
     * Every figure is net of tax. The invoice, when there is one, goes through
     * Purchase::money() like every other document in this shop, so whether the
     * shop prices in tax or on top of it is decided in one place and not two.
     *
     * @return array{
     *     ok: bool,
     *     reason: string,
     *     days_left: int,
     *     days: int,
     *     back: int,
     *     ahead: int,
     *     amount: int,
     *     currency: string,
     *     from: ?Package,
     *     to: Package,
     * }
     */
    public static function quote(Order $order, Package $to, ?Carbon $today = null): array
    {
        $from = $order->package;
        $currency = (string) ($order->currency ?: Packages::currency());

        $no = static fn (string $reason): array => [
            'ok' => false,
            'reason' => $reason,
            'days_left' => 0,
            'days' => 0,
            'back' => 0,
            'ahead' => 0,
            'amount' => 0,
            'currency' => $currency,
            'from' => null,
            'to' => $to,
        ];

        if (!Features::enabled(Features::UPGRADES)) {
            return $no('off');
        }

        if ($order->state !== Order::ACTIVE) {
            return $no('not_active');
        }

        if (!$from instanceof Package) {
            return $no('gone');
        }

        $why = self::may($order, $from, $to);

        if ($why !== null) {
            return $no($why);
        }

        $today ??= Carbon::now();

        /*
         * A one-off has no period to divide, so there is nothing to pro-rate:
         * the customer paid a price once and the difference between the two
         * prices is the whole of it. Written as days of nought rather than as a
         * separate branch further down, so the sum below is the only sum.
         */
        $days = $order->recurring() ? Periods::length($order) : 0;
        $left = $days === 0 ? 0 : Periods::left($order, $today);

        $was = (int) $order->price;
        $now = (int) $to->price;

        $back = $days === 0 ? $was : Money::share($was, $left, $days);
        $ahead = $days === 0 ? $now : Money::share($now, $left, $days);

        return [
            'ok' => true,
            'reason' => '',
            'days_left' => $left,
            'days' => $days,
            'back' => $back,
            'ahead' => $ahead,
            'amount' => $ahead - $back,
            'currency' => $currency,
            'from' => $from,
            'to' => $to,
        ];
    }

    /**
     * Agree the move.
     *
     * A bigger package is written down and invoiced; it happens when that
     * invoice is paid. A smaller one, or one that costs the same, happens now.
     *
     * @return array{ok: bool, reason: string, invoice: ?Invoice, upgrade: ?Upgrade}
     */
    public static function start(Order $order, Package $to, string $vat = ''): array
    {
        $quote = self::quote($order, $to);

        $no = static fn (string $reason): array => [
            'ok' => false,
            'reason' => $reason,
            'invoice' => null,
            'upgrade' => null,
        ];

        if (!$quote['ok']) {
            return $no($quote['reason']);
        }

        // One at a time. Two pending changes on one service is two invoices
        // that each think they know what the service is about to be.
        if (self::waiting($order) !== null) {
            return $no('waiting');
        }

        try {
            $row = new Upgrade();

            $row->forceFill([
                'order_id' => (int) $order->id,
                'invoice_id' => null,
                'from_package_id' => (int) ($quote['from']?->id ?? 0) ?: null,
                'to_package_id' => (int) $to->id,
                'amount' => $quote['amount'],
                'currency' => $quote['currency'],
                'state' => Upgrade::PENDING,
            ])->save();
        } catch (Throwable $exception) {
            report($exception);

            return $no('failed');
        }

        if ($quote['amount'] <= 0) {
            /*
             * Nothing to wait for. The money goes back before the server
             * changes, because the customer is owed it either way - a node that
             * will not take the new limits does not make the refund untrue.
             */
            if ($quote['amount'] < 0) {
                Credits::add(
                    (int) $order->user_id,
                    -$quote['amount'],
                    Theme::trans('upgrades.credit_reason', ['name' => (string) $to->name]),
                    null,
                    null,
                );
            }

            $done = self::apply($order, $row);

            return ['ok' => $done, 'reason' => $done ? '' : 'server', 'invoice' => null, 'upgrade' => $row];
        }

        $invoice = self::bill($order, $row, $quote, $vat);

        if (!$invoice instanceof Invoice) {
            try {
                $row->delete();
            } catch (Throwable) {
                // A pending row with no invoice would block the next attempt,
                // which is the one thing worse than this having failed.
            }

            return $no('failed');
        }

        return ['ok' => true, 'reason' => '', 'invoice' => $invoice, 'upgrade' => $row];
    }

    /**
     * Do it: the order carries the new package, the server the new limits.
     *
     * The server first. If the node refuses, nothing about the order changes,
     * which means the customer keeps exactly what they had and this can be run
     * again - by hand from the orders page, or by whoever fixes the node.
     */
    public static function apply(Order $order, Upgrade $row): bool
    {
        $to = $row->to;

        if (!$to instanceof Package) {
            self::refuse($order, $row, Theme::trans('upgrades.gone'));

            return false;
        }

        $spec = Packages::spec($to);
        $server = $order->server;

        if ($server !== null) {
            /*
             * The new package, plus whatever extras hang off this order.
             *
             * Straight from the spec would have quietly stripped every addon a
             * customer had: an upgrade would have made their server bigger by
             * the package's difference and smaller by everything they had
             * bought on top of it.
             */
            $result = Servers::resize($server, Addons::limits($order, $spec));

            if (!$result['ok']) {
                self::refuse($order, $row, Theme::trans('upgrades.refused_by_node', [
                    'why' => $result['reason'],
                ]));

                return false;
            }

            /*
             * Recorded, and the node has not taken it yet. The upgrade stands -
             * the limits are in the panel and the node reads them when the
             * server next boots - but somebody should know, because until then
             * the customer's server is still the old size.
             */
            if (!$result['synced']) {
                Billing::trouble(
                    Theme::trans('upgrades.cold_title', ['number' => '#' . (int) $order->id]),
                    Theme::trans('upgrades.cold_body', ['name' => (string) $to->name]),
                );
            }
        }

        try {
            $order->forceFill([
                'package_id' => (int) $to->id,
                'spec' => $spec,
                // What it renews at from now on. The offer price is not used
                // here on purpose: an offer is a reason to buy, and this
                // customer has already bought.
                'price' => (int) $to->price,
                'period' => Packages::period($to->period),
            ])->save();

            $row->forceFill([
                'state' => Upgrade::APPLIED,
                'applied_at' => now(),
                'note' => null,
            ])->save();
        } catch (Throwable $exception) {
            report($exception);

            self::refuse($order, $row, $exception->getMessage());

            return false;
        }

        return true;
    }

    /**
     * The change this invoice was for, applied.
     *
     * Called from Invoices::markPaid(). An invoice of this kind never advances
     * a due date and never builds anything, which is why that method has to
     * know which kind it is holding.
     */
    public static function settle(Invoice $invoice): void
    {
        try {
            $row = Upgrade::query()
                ->where('invoice_id', (int) $invoice->id)
                ->where('state', Upgrade::PENDING)
                ->first();
        } catch (Throwable $exception) {
            report($exception);

            return;
        }

        if (!$row instanceof Upgrade) {
            return;
        }

        $order = $row->order;

        if ($order instanceof Order) {
            self::apply($order, $row);
        }
    }

    /** A change already agreed and not yet done, or null. */
    public static function waiting(Order $order): ?Upgrade
    {
        try {
            return Upgrade::query()
                ->where('order_id', (int) $order->id)
                ->where('state', Upgrade::PENDING)
                ->orderByDesc('id')
                ->first();
        } catch (Throwable) {
            return null;
        }
    }

    /** One that was paid for and did not happen, which is somebody's job. */
    public static function stuck(Order $order): ?Upgrade
    {
        try {
            return Upgrade::query()
                ->where('order_id', (int) $order->id)
                ->where('state', Upgrade::REFUSED)
                ->orderByDesc('id')
                ->first();
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * The invoice for a bigger package.
     *
     * One line saying what it is, priced at the difference. Through
     * Purchase::money() so the tax is worked out the way every other document
     * in this shop works it out.
     *
     * @param  array<string, mixed>  $quote
     */
    private static function bill(Order $order, Upgrade $row, array $quote, string $vat): ?Invoice
    {
        $lines = [[
            'description' => Theme::trans('upgrades.line', [
                'from' => (string) ($quote['from']?->name ?? ''),
                'to' => (string) $quote['to']->name,
                'days' => (string) $quote['days_left'],
            ]),
            'quantity' => 1,
            'amount' => (int) $quote['amount'],
        ]];

        $money = Purchase::money($lines, 0, $vat);

        try {
            $invoice = new Invoice();

            $invoice->forceFill([
                'number' => Invoices::number(),
                'user_id' => (int) $order->user_id,
                'order_id' => (int) $order->id,
                'kind' => Invoice::UPGRADE,
                'state' => Invoice::UNPAID,
                'subtotal' => $money['subtotal'],
                'discount' => 0,
                'tax' => $money['tax'],
                'total' => $money['total'],
                'tax_rate' => $money['tax_rate'],
                'currency' => $quote['currency'],
                'lines' => $lines,
                ...Customers::snapshot($order->user),
                // Due today. There is nothing to wait for: the service does not
                // change until this is paid, so a term on it would only be a
                // longer wait for the thing the customer just asked for.
                'due_at' => now(),
            ])->save();

            /*
             * Paired to the order like any other invoice, so it appears where
             * that order's invoices appear. It is not a renewal and does not
             * move a due date - Invoices::settle() reads the kind, not this.
             */
            Invoices::bill($invoice, [$order]);

            // And the balance comes off it, exactly as it does for a sale.
            Credits::settle($invoice);

            $row->forceFill(['invoice_id' => (int) $invoice->id])->save();

            return $invoice;
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }
    }

    /** Leave the order alone, say why, and ring whoever runs the shop. */
    private static function refuse(Order $order, Upgrade $row, string $why): void
    {
        $why = mb_substr(trim($why), 0, 2000) ?: Theme::trans('orders.no_reason');

        try {
            $row->forceFill(['state' => Upgrade::REFUSED, 'note' => $why])->save();
        } catch (Throwable) {
            // The note on the order below is then the only record of it, which
            // is why that carries the reason rather than pointing here.
        }

        try {
            $order->forceFill(['note' => $why])->save();
        } catch (Throwable) {
            // And the bell is then the only record. Same reasoning again.
        }

        Billing::trouble(
            Theme::trans('upgrades.bell_failed', ['number' => '#' . (int) $order->id]),
            $why,
        );
    }
}
