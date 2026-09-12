<?php

namespace LegendDevelopment\Theme\Support\Shop;

use Illuminate\Database\Eloquent\Builder;
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
        $unpaidRenewal = static fn ($query) => $query
            ->where('kind', Invoice::RENEWAL)
            ->where('state', Invoice::UNPAID);

        $base = static fn (): Builder => Order::query()
            ->where('state', Order::ACTIVE)
            ->where('period', '!=', 'once')
            ->whereNotNull('next_due_at')
            ->where('next_due_at', '<=', now()->addDays(self::noticeDays()))
            ->orderBy('next_due_at')
            ->limit(self::MAX);

        try {
            /*
             * Both ways an order can already have been billed.
             *
             * invoices() is the invoice that names it in order_id, which is how
             * every renewal was written before a bill could cover two services.
             * billedOn() is the pairing table, and it is the one that matters
             * here: the second service on a shared renewal is billed without
             * order_id ever pointing at it, and without this clause it would be
             * invoiced again tomorrow, and the day after that.
             */
            return $base()
                ->whereDoesntHave('invoices', $unpaidRenewal)
                ->whereDoesntHave('billedOn', $unpaidRenewal)
                ->get();
        } catch (Throwable) {
            // The pairing table is not there yet - a panel between the file
            // swap and the install. Falling back rather than returning nothing:
            // renewals stopping for a boot is worse than them being read the
            // way they were read last week.
        }

        try {
            return $base()->whereDoesntHave('invoices', $unpaidRenewal)->get();
        } catch (Throwable) {
            return new Collection();
        }
    }

    /**
     * The due orders, in the bundles they should be billed in.
     *
     * One invoice per customer per due date, in one currency. What was bought
     * together renews together, so a basket comes back out of here as the one
     * bundle it went in as - and a service that was cancelled is not in due()
     * at all, which is the whole of "only the active one gets an invoice".
     *
     * The date is compared by day and not by the second. Two orders placed
     * eleven seconds apart have next_due_at eleven seconds apart, and a
     * customer does not think of that as two different days.
     *
     * @param  Collection<int, Order>  $orders
     * @return array<string, array<int, Order>>
     */
    public static function bundle(Collection $orders): array
    {
        $out = [];

        foreach ($orders as $order) {
            $due = $order->next_due_at instanceof Carbon
                ? $order->next_due_at->format('Y-m-d')
                : now()->format('Y-m-d');

            // The currency as well, because one document has one total and two
            // currencies cannot be added up.
            $key = (int) $order->user_id . '|' . Money::currency($order->currency) . '|' . $due;

            $out[$key][] = $order;
        }

        return $out;
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
            $unpaid = static fn ($query) => $query
                ->where('kind', Invoice::RENEWAL)
                ->where('state', Invoice::UNPAID)
                ->whereNotNull('due_at')
                ->where('due_at', '<', $deadline);

            /*
             * Either way of being on the unpaid bill.
             *
             * One invoice is one debt: when a bill covering two services is not
             * paid, both stop. That is the answer this shop chose, and it is
             * the only one that cannot be gamed by ignoring half a bill - but
             * it only works if the second service is *found*, and order_id does
             * not point at it.
             */
            return Order::query()
                ->where('state', Order::ACTIVE)
                ->whereNotNull('server_id')
                ->where(static fn (Builder $query) => $query
                    ->whereHas('invoices', $unpaid)
                    ->orWhereHas('billedOn', $unpaid))
                ->limit(self::MAX)
                ->get();
        } catch (Throwable) {
            // Without the pairing table, the question is the one it always was.
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
        return self::invoiceMany([$order]);
    }

    /**
     * One renewal invoice for several services at once.
     *
     * A line per order, and the pairing table underneath saying which line is
     * which service - because that pairing is what suspension reads when the
     * bill goes unpaid, and what tells due() next month that these are already
     * billed.
     *
     * Anything cancelled or not recurring is dropped rather than refused: the
     * list comes from a pass over the whole shop, and one closed service in it
     * must not cost the others their invoice.
     *
     * @param  array<int, Order>  $orders
     */
    public static function invoiceMany(array $orders): ?Invoice
    {
        $orders = array_values(array_filter(
            $orders,
            static fn (Order $order): bool => $order->recurring() && $order->state !== Order::CANCELLED,
        ));

        if ($orders === []) {
            return null;
        }

        $first = $orders[0];
        $currency = Money::currency($first->currency);

        $lines = [];
        $due = null;

        foreach ($orders as $order) {
            foreach (self::linesFor($order) as $line) {
                $lines[] = $line;
            }

            $its = $order->next_due_at instanceof Carbon ? $order->next_due_at->copy() : now();

            // The earliest of them. A bill covering two services is due when the
            // first of them is, or the shop would give one of them away for the
            // days in between.
            if ($due === null || $its->lessThan($due)) {
                $due = $its;
            }
        }

        // Through the shop's own arithmetic, so a renewal totals the way the
        // sale did - including whether the tax is inside the price or on it.
        $money = Purchase::money($lines);

        try {
            $user = $first->user;

            $invoice = new Invoice();
            $invoice->forceFill([
                'number' => Invoices::number(),
                'user_id' => (int) $first->user_id,
                'order_id' => (int) $first->id,
                'kind' => Invoice::RENEWAL,
                'state' => Invoice::UNPAID,
                'subtotal' => $money['subtotal'],
                'discount' => 0,
                'tax' => $money['tax'],
                'total' => $money['total'],
                'tax_rate' => $money['tax_rate'],
                'currency' => $currency,
                'coupon_code' => null,
                'lines' => $lines,
                /*
                 * The same six columns a purchase writes, from the same place.
                 *
                 * This used to write the name and the email and stop, so a
                 * customer with a VAT number reverse-charged on the sale was
                 * charged tax on every renewal after it - the number was simply
                 * not on the document, and nothing that read the document could
                 * tell the difference between "no number" and "forgot to copy
                 * the number".
                 */
                ...Customers::snapshot($user),
                'due_at' => $due ?? now(),
            ])->save();

            Invoices::bill($invoice, $orders);

            // The balance comes off a renewal exactly as it comes off a sale.
            // A customer with credit should not be emailed a demand for money
            // the shop is already holding.
            Credits::settle($invoice);
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
    /**
     * What one order puts on a renewal invoice.
     *
     * The package at the price the order holds - somebody who bought at last
     * year's price keeps it - and then the extras, each on a line of its own.
     *
     * Their own lines rather than folded into the price, because a customer
     * reading a renewal should be able to see what they are paying for: a
     * figure that quietly includes four extras is a support ticket every month.
     *
     * Only the recurring ones, and never the setup fee. A one-off was charged
     * on the invoice that first carried it, and charging either again every
     * month is the oldest billing bug there is.
     *
     * @return array<int, array{text: string, amount: int}>
     */
    private static function linesFor(Order $order): array
    {
        $spec = is_array($order->spec) ? $order->spec : [];
        $name = trim((string) ($spec['name'] ?? '')) ?: Theme::trans('orders.gone_package');

        $lines = [[
            'text' => $name . ' - ' . Theme::trans('packages.period_' . Packages::period($order->period)),
            'amount' => max(0, (int) $order->price),
        ]];

        foreach (Addons::lines($order, true) as $extra) {
            $lines[] = $extra;
        }

        return $lines;
    }

    /**
     * What this one service would be billed for next time, before it is.
     *
     * The same lines invoiceMany() writes, through the same arithmetic, so a
     * page cannot quote a figure from a different sum than the one the nightly
     * pass will use.
     *
     * **What it cannot promise is the invoice.** Renewals are bundled - one
     * document per customer, per currency, per due day - so somebody with two
     * services falling due together gets one bill whose total is both of them.
     * This answers for the service; the page has to say so rather than let
     * somebody expect a bill for exactly this figure.
     *
     * No discount and no VAT number, because invoiceMany passes neither.
     * Handing one in here would fire the reverse-charge branch and quote a
     * number the nightly pass is never going to write.
     *
     * @return array{lines: array<int, array{text: string, amount: int}>, money: array<string, mixed>, due_at: ?Carbon}|null
     */
    public static function quote(Order $order): ?array
    {
        /*
         * Only a service that is actually going to be billed again. due() only
         * ever selects active orders, so a cancelled one's future next_due_at
         * never becomes an invoice and must never be called the next bill.
         */
        if (!$order->recurring() || $order->state !== Order::ACTIVE) {
            return null;
        }

        $lines = self::linesFor($order);

        return [
            'lines' => $lines,
            'money' => Purchase::money($lines),
            'due_at' => $order->next_due_at instanceof Carbon ? $order->next_due_at->copy() : null,
        ];
    }

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

        foreach (self::bundle(self::due()) as $bundle) {
            try {
                if (self::invoiceMany($bundle) !== null) {
                    // One invoice, however many services are on it. The number
                    // in the log is invoices sent, and a customer with two
                    // servers got one.
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
