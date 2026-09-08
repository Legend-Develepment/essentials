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
 * Four jobs, and they are deliberately separate passes over the same table.
 * **Invoicing** writes the next period's bill a few days before it is due, so
 * a customer has warning rather than a suspension. **Reminding** chases that
 * bill once when it goes past its date, naming the day the server stops.
 * **Suspending** stops the server when it has been unpaid past the grace
 * period. **Finishing** closes an order whose notice period has run out.
 *
 * The rules are read from the orders and the invoices every time rather than
 * from a "last run" marker anywhere. A panel whose cron did not run for a week
 * catches up correctly on the next tick, and one that runs the pass twice in a
 * minute does nothing the second time - both because the questions asked are
 * about the state of the world and not about what this code did last.
 *
 * **Suspending never deletes.** A suspended server keeps its files, its
 * databases and its backups, and paying the invoice starts it again.
 *
 * **Finishing does delete**, and it is the only thing in this plugin that
 * removes a server without somebody pressing a button. It will only touch an
 * order that a person cancelled, on a date that person set and the customer
 * was told. That chain - a human decision, a written date, a notice - is what
 * makes an automatic deletion something other than a bug waiting to happen.
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
     * Unpaid renewals that have gone past their date and not been chased.
     *
     * The gap this fills: between an invoice going unpaid and the grace period
     * running out, a customer currently hears nothing at all, and the next
     * thing that happens is a stopped server. One sentence in between costs a
     * row of this table and saves the ticket.
     *
     * **Once, and idempotent without a marker of a run.** reminded_at is a fact
     * about the customer - we told them, on this day - and not a note about
     * what this code did, which is the distinction the whole of this class is
     * built on. An invoice that has one is not selected again, so a pass that
     * runs twice in a minute sends one reminder and a panel whose cron was off
     * for a week sends one reminder late rather than seven.
     *
     * Only while there is still something to warn about. An invoice already
     * past the grace period is a server that has stopped, and a warning about
     * a thing that has happened is not a warning.
     *
     * @return Collection<int, Invoice>
     */
    public static function chasing(): Collection
    {
        $deadline = now()->subDays(self::graceDays());

        try {
            return Invoice::query()
                ->with('order')
                ->where('kind', Invoice::RENEWAL)
                ->where('state', Invoice::UNPAID)
                ->whereNull('reminded_at')
                ->whereNotNull('due_at')
                ->where('due_at', '<', now())
                ->where('due_at', '>=', $deadline)
                ->whereHas('order', static fn ($query) => $query->where('state', Order::ACTIVE))
                ->orderBy('due_at')
                ->limit(self::MAX)
                ->get();
        } catch (Throwable) {
            return new Collection();
        }
    }

    /**
     * Tell one customer, and write down that they were told.
     *
     * The date is worked out from the invoice rather than from today, so the
     * day named is the day the server actually stops however late this pass
     * runs.
     */
    public static function remind(Invoice $invoice): bool
    {
        $due = $invoice->due_at;

        if (!$due instanceof Carbon) {
            return false;
        }

        try {
            $invoice->forceFill(['reminded_at' => now()])->save();
        } catch (Throwable) {
            // Not written means not sent. A reminder that goes out without the
            // row being marked is a reminder that goes out again tomorrow.
            return false;
        }

        Billing::remind($invoice, $due->copy()->addDays(self::graceDays()));

        return true;
    }

    /**
     * Orders whose notice period has run out.
     *
     * Cancelled, still running, and past the day they were told they would
     * stop. These are the only orders in the plugin whose servers are deleted
     * without somebody pressing a button - and they got here by a person
     * cancelling them, on purpose, with a date the customer was told.
     *
     * @return Collection<int, Order>
     */
    public static function finished(): Collection
    {
        try {
            return Order::query()
                ->where('state', Order::ENDING)
                ->whereNotNull('ends_at')
                ->where('ends_at', '<=', now())
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
     * One pass: invoice what is due, stop what is overdue, close what has run
     * its course.
     *
     * Every order in its own try, because one bad row must not stop the rest -
     * a panel where one deleted user's order breaks the pass is a panel where
     * nothing renews and nobody knows why.
     *
     * @return array{invoiced: int, reminded: int, suspended: int, finished: int}
     */
    public static function run(): array
    {
        $invoiced = 0;
        $reminded = 0;
        $suspended = 0;
        $finished = 0;

        foreach (self::due() as $order) {
            try {
                if (self::invoice($order) !== null) {
                    $invoiced++;
                }
            } catch (Throwable $exception) {
                report($exception);
            }
        }

        /*
         * Before the suspensions, on purpose: somebody who is going to be
         * warned today should be warned before anything is done to them, and
         * an invoice that is far enough past due to be suspended is not in
         * this list anyway.
         */
        foreach (self::chasing() as $invoice) {
            try {
                if (self::remind($invoice)) {
                    $reminded++;
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

        /*
         * Last, and after the suspensions on purpose: an order being closed
         * today should not also be suspended today for a bill it will never
         * be asked to pay.
         */
        foreach (self::finished() as $order) {
            try {
                if (Orders::finish($order)) {
                    $finished++;
                }
            } catch (Throwable $exception) {
                report($exception);
            }
        }

        return [
            'invoiced' => $invoiced,
            'reminded' => $reminded,
            'suspended' => $suspended,
            'finished' => $finished,
        ];
    }
}
