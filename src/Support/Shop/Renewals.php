<?php

namespace LegendDevelopment\Theme\Support\Shop;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * What happens to a recurring order as time passes.
 *
 * Two jobs, and they are deliberately separate passes over the same table.
 * **Invoicing** writes the next period's bill a few days before it is due, so
 * a customer has warning rather than a suspension. **Suspending** stops the
 * server when that bill has been unpaid past the grace period.
 *
 * The rules are read from the orders and the invoices every time rather than
 * from a "last run" marker anywhere. A panel whose cron did not run for a week
 * catches up correctly on the next tick, and one that runs the pass twice in a
 * minute does nothing the second time - both because the questions asked are
 * about the state of the world and not about what this code did last.
 *
 * **Nothing here deletes anything, ever.** A suspended server keeps its files,
 * its databases and its backups, and paying the invoice starts it again.
 */
class Renewals
{
    /** A ceiling on one pass, so a panel with thousands does not stall a cron. */
    public const MAX = 200;

    /** How many days before the period ends the next invoice is written. */
    public static function noticeDays(): int
    {
        return max(0, min(90, (int) Theme::config('shop_notice_days', 7)));
    }

    /** How many days past due before the server stops. */
    public static function graceDays(): int
    {
        return max(0, min(365, (int) Theme::config('shop_grace_days', 7)));
    }

    /**
     * Orders whose next period should be invoiced now.
     *
     * Active, recurring, due within the notice window - and with no unpaid
     * renewal invoice already waiting, which is what stops a second bill being
     * written every day until the first one is paid.
     *
     * @return Collection<int, Order>
     */
    public static function due(): Collection
    {
        try {
            return Order::query()
                ->where('state', Order::ACTIVE)
                ->where('period', '!=', 'once')
                ->whereNotNull('next_due_at')
                ->where('next_due_at', '<=', now()->addDays(self::noticeDays()))
                ->whereDoesntHave('invoices', static fn ($query) => $query
                    ->where('kind', Invoice::RENEWAL)
                    ->where('state', Invoice::UNPAID))
                ->orderBy('next_due_at')
                ->limit(self::MAX)
                ->get();
        } catch (Throwable) {
            return new Collection();
        }
    }

    /**
     * Orders with a renewal invoice unpaid past the grace period.
     *
     * Read from the invoice's own due date rather than from the order's next
     * date: the invoice is the thing that went unpaid, and it carries when it
     * should have been settled.
     *
     * @return Collection<int, Order>
     */
    public static function overdue(): Collection
    {
        $deadline = now()->subDays(self::graceDays());

        try {
            return Order::query()
                ->where('state', Order::ACTIVE)
                ->whereNotNull('server_id')
                ->whereHas('invoices', static fn ($query) => $query
                    ->where('kind', Invoice::RENEWAL)
                    ->where('state', Invoice::UNPAID)
                    ->whereNotNull('due_at')
                    ->where('due_at', '<', $deadline))
                ->limit(self::MAX)
                ->get();
        } catch (Throwable) {
            return new Collection();
        }
    }

    /**
     * Write one period's invoice for an order.
     *
     * The price comes from the order, not from the package: somebody who
     * bought at last year's price keeps last year's price until an
     * administrator changes their order. The tax rate is read fresh, because a
     * tax rate is the law's and not the customer's.
     *
     * The setup fee is not on it. That is charged once, on the first invoice,
     * and a renewal that carried it would be charging for a setup that
     * happened a year ago.
     */
    public static function invoice(Order $order): ?Invoice
    {
        if (!$order->recurring() || $order->state === Order::CANCELLED) {
            return null;
        }

        $currency = Money::currency($order->currency);
        $price = max(0, (int) $order->price);
        $rate = Purchase::taxRate();
        $tax = Money::tax($price, $rate);

        $spec = is_array($order->spec) ? $order->spec : [];
        $name = trim((string) ($spec['name'] ?? '')) ?: Theme::trans('orders.gone_package');

        $due = $order->next_due_at instanceof Carbon ? $order->next_due_at->copy() : now();

        try {
            $user = $order->user;

            $invoice = new Invoice();
            $invoice->forceFill([
                'number' => Invoices::number(),
                'user_id' => (int) $order->user_id,
                'order_id' => (int) $order->id,
                'kind' => Invoice::RENEWAL,
                'state' => Invoice::UNPAID,
                'subtotal' => $price,
                'discount' => 0,
                'tax' => $tax,
                'total' => $price + $tax,
                'tax_rate' => $rate,
                'currency' => $currency,
                'coupon_code' => null,
                'lines' => [[
                    'text' => $name . ' - ' . Theme::trans('packages.period_' . Packages::period($order->period)),
                    'amount' => $price,
                ]],
                'customer_name' => mb_substr((string) ($user?->username ?? ''), 0, 191),
                'customer_email' => mb_substr((string) ($user?->email ?? ''), 0, 191),
                'due_at' => $due,
            ])->save();
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }

        Billing::announce($invoice);

        return $invoice;
    }

    /**
     * Stop an order's server over an unpaid renewal.
     *
     * Orders::suspend does the work; this exists so the pass reads as the
     * sentence it is, and so the customer is told the reason rather than
     * finding a stopped server and guessing.
     */
    public static function suspend(Order $order): bool
    {
        return Orders::suspend($order);
    }

    /**
     * One pass: invoice what is due, stop what is overdue.
     *
     * Every order in its own try, because one bad row must not stop the rest -
     * a panel where one deleted user's order breaks the pass is a panel where
     * nothing renews and nobody knows why.
     *
     * @return array{invoiced: int, suspended: int}
     */
    public static function run(): array
    {
        $invoiced = 0;
        $suspended = 0;

        foreach (self::due() as $order) {
            try {
                if (self::invoice($order) !== null) {
                    $invoiced++;
                }
            } catch (Throwable $exception) {
                report($exception);
            }
        }

        foreach (self::overdue() as $order) {
            try {
                if (self::suspend($order)) {
                    $suspended++;
                }
            } catch (Throwable $exception) {
                report($exception);
            }
        }

        return ['invoiced' => $invoiced, 'suspended' => $suspended];
    }
}
