<?php

namespace LegendDevelopment\Theme\Support\Shop;

use App\Enums\SuspendAction;
use App\Models\Server;
use App\Services\Servers\SuspensionService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use LegendDevelopment\Theme\Jobs\ProvisionServer;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Support\Workers;
use Throwable;

/**
 * What happens when an invoice is paid, wherever the news came from.
 *
 * Every gateway added later ends here. Mollie's webhook, Stripe's signed
 * event, PayPal's capture and an administrator clicking "mark paid" all call
 * markPaid(), and none of them knows what paying means - whether a server gets
 * built, whether a suspended one comes back, whether a date moves on. That is
 * one decision and it lives in one method.
 *
 * **markPaid() is idempotent, and that is the whole design.** A webhook that
 * fires twice is normal. A webhook that arrives while the customer is being
 * redirected back to the panel, which also checks, is normal. So the first
 * thing it does is look at the invoice: already paid, nothing happens, and the
 * caller is told so rather than being handed an error. Everything after that
 * point runs exactly once because the state changed before it ran.
 */
class Invoices
{
    /** How wide the running number is: INV-000001. */
    private const WIDTH = 6;

    /**
     * The next invoice number.
     *
     * The prefix from the settings and a zero-padded count. Not the row id: an
     * invoice number is a thing people quote at each other, and one that jumps
     * from 4 to 190 because the table is shared with something else reads as a
     * mistake. The unique index on the column is what actually guarantees it,
     * and a collision retries with the next one.
     */
    public static function number(): string
    {
        $prefix = trim((string) Theme::config('shop_invoice_prefix', 'INV-'));
        $prefix = mb_substr($prefix, 0, 16);

        try {
            $next = (int) Invoice::query()->count() + 1;
        } catch (Throwable) {
            $next = 1;
        }

        for ($attempt = 0; $attempt < 50; $attempt++) {
            $number = $prefix . str_pad((string) ($next + $attempt), self::WIDTH, '0', STR_PAD_LEFT);

            try {
                if (!Invoice::query()->where('number', $number)->exists()) {
                    return $number;
                }
            } catch (Throwable) {
                return $number;
            }
        }

        return $prefix . (string) time();
    }

    /**
     * The invoice is paid. Do whatever that means for the order behind it.
     *
     * Three cases, and they are about what the order is rather than about what
     * kind of invoice arrived:
     *
     *   pending    no server exists yet, so build one
     *   suspended  a server exists and this plugin stopped it, so start it
     *   active     nothing to do to the server; the date moves on
     *
     * The due date advances for the last two. It does not advance for a
     * pending order, because that order has no period yet - ProvisionServer
     * sets the first one from the moment the server actually exists, so
     * nobody's month starts while they are waiting for a node.
     *
     * @return bool Whether this call is the one that changed anything.
     */
    /**
     * An invoice worth nothing settles itself.
     *
     * A coupon that takes a hundred percent off, or a package priced at
     * nothing, leaves a total of zero - and zero is not an amount any payment
     * provider will take. Stripe answers that a line item must be at least
     * fifty cents; ours refused before even asking, and the customer got "The
     * payment could not be opened" with nothing in the log.
     *
     * So it is settled here instead, by the same path a real payment takes:
     * markPaid() is what provisions the server, advances the date and tells the
     * customer, and none of that should have a second implementation just
     * because the amount happened to be nought.
     *
     * Recorded as paid via free rather than manual, because nobody did
     * anything and an administrator reading the invoices page should not go
     * looking for a payment that never existed.
     *
     * @return bool Whether this invoice was one, and is now settled.
     */
    public static function settleFree(Invoice $invoice): bool
    {
        if (!$invoice->free() || $invoice->state !== Invoice::UNPAID) {
            return false;
        }

        /*
         * Free and settled-from-the-balance arrive here by the same road and
         * are not the same event. One cost nothing; the other cost the usual
         * and was paid out of money the shop was already holding. Recording
         * both as free would hide every settlement from the balance from
         * whoever reads the invoices page.
         */
        return self::markPaid($invoice, $invoice->settledFromCredit()
            ? Invoice::BALANCE
            : Invoice::FREE);
    }

    public static function markPaid(Invoice $invoice, string $via = Invoice::MANUAL): bool
    {
        if ($invoice->state === Invoice::PAID) {
            return false;
        }

        try {
            $invoice->forceFill([
                'state' => Invoice::PAID,
                'paid_at' => now(),
                'paid_via' => mb_substr($via, 0, 32),
            ])->save();
        } catch (Throwable) {
            return false;
        }

        try {
            /*
             * A top-up has no order and never will. It buys credit, so paying
             * one puts the money on the account and there is nothing else to
             * do: no server to build, no period to move.
             */
            if ($invoice->kind === Invoice::TOPUP) {
                Credits::credited($invoice);

                return true;
            }

            /*
             * Every order on it, not only the one in order_id.
             *
             * An invoice can bill a basket, and a renewal invoice can cover two
             * services that fell due on the same day. Settling the first and
             * leaving the rest would take the money for two servers and build
             * one - which is the failure this whole pairing exists to prevent.
             *
             * billed() answers for invoices written before the pairing table as
             * well, so this is the same sentence for every invoice there has
             * ever been.
             */
            foreach ($invoice->billed() as $order) {
                if ($order instanceof Order) {
                    self::settle($order, $invoice);
                }
            }
        } catch (Throwable $exception) {
            /*
             * The money is recorded and the server is not. That is the right
             * way round to fail: the invoice stays paid, the order keeps its
             * state, and the admin page shows a pending order with the reason
             * on it and a button to try again. The reverse - unpaying an
             * invoice because a node was full - would lose somebody's payment.
             */
            report($exception);
        }

        return true;
    }

    /**
     * Say that an invoice bills these orders.
     *
     * Written here rather than at the three call sites, so the pairing is made
     * one way and a caller cannot half-make it. Failing is survivable: the
     * invoice still names its first order, which is what every panel did before
     * this table existed.
     *
     * @param  array<int, Order>  $orders
     */
    public static function bill(Invoice $invoice, array $orders): void
    {
        try {
            $rows = [];

            foreach ($orders as $order) {
                $rows[(int) $order->id] = [
                    // What this order was worth on this invoice. Kept at the
                    // time rather than read back from the order later, because
                    // a price changes between periods and an invoice may not.
                    'amount' => max(0, (int) $order->price + (int) $order->setup_fee),
                ];
            }

            $invoice->orders()->syncWithoutDetaching($rows);
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    /**
     * One invoice, as a page reads it.
     *
     * There were two of these, byte for byte, on the customer's billing page
     * and in the administrator's customer view - and a third was about to be
     * written. That is where they drift, and it is where `kind_addon` went
     * missing from the language file for as long as it did: three places render
     * the kind and none of them had ever been asked to render that one.
     *
     * The share is this order's part of a bill that covers more than one
     * service. An invoice total on a basket or a bundled renewal is two
     * services' money, so saying "this service has cost you X" out of totals
     * over-counts.
     *
     * @return array<string, mixed>
     */
    public static function row(Invoice $invoice, ?int $share = null): array
    {
        return [
            'id' => (int) $invoice->id,
            'number' => (string) $invoice->number,
            'kind' => Theme::trans('invoices.kind_' . $invoice->kind),
            'state' => Theme::trans('invoices.state_' . $invoice->state),
            'colour' => match (true) {
                $invoice->paid() => 'success',
                $invoice->overdue() => 'danger',
                $invoice->open() => 'warning',
                default => 'gray',
            },
            'total' => Money::format((int) $invoice->total, (string) $invoice->currency),
            /*
             * What is actually handed over, which is not the total once the
             * balance has covered part of it. The total is deliberately left
             * whole on the document; this is the other question.
             */
            'owed' => Money::format($invoice->due(), (string) $invoice->currency),
            'share' => $share === null ? null : Money::format($share, (string) $invoice->currency),
            'due' => $invoice->due_at?->toFormattedDateString(),
            'paid_at' => $invoice->paid_at?->toFormattedDateString(),
            'open' => $invoice->open(),
            'overdue' => $invoice->overdue(),
            'url' => self::address($invoice),
        ];
    }

    /**
     * Every invoice that bills this order, both shapes, newest first.
     *
     * **Neither relation is right on its own.** `invoices()` names only the
     * order that `order_id` points at, so a basket and a bundled renewal are
     * missing from every sibling but the first; `billedOn()` knows nothing
     * written before the pairing table existed, and throws outright on a panel
     * that has the shop tables and not that one - which is why each is caught
     * separately rather than both together.
     *
     * `invoices()` is read first so the `billedOn()` copy wins the dedupe. They
     * are the same row either way, but only that one carries the pivot, which
     * is where this order's share of a bill covering two services lives.
     *
     * @param  array<int, string>  $with
     * @return Collection<int, Invoice>
     */
    public static function forOrder(
        Order $order,
        ?string $state = null,
        array $with = [],
        int $limit = 0,
    ): Collection {
        $found = [];

        foreach (['invoices', 'billedOn'] as $relation) {
            try {
                $query = $order->{$relation}();

                /*
                 * Qualified, all of it. The pairing table has an id and a state
                 * of its own is not the point - the id is, and an unqualified
                 * one is ambiguous the moment this reads through the pivot.
                 */
                if ($state !== null) {
                    $query->where(Invoice::TABLE . '.state', $state);
                }

                if ($with !== []) {
                    $query->with($with);
                }

                if ($limit > 0) {
                    $query->limit($limit);
                }

                foreach ($query->orderByDesc(Invoice::TABLE . '.id')->get() as $invoice) {
                    $found[(int) $invoice->id] = $invoice;
                }
            } catch (Throwable) {
                // billedOn() needs the pairing table, which a panel between the
                // file swap and the install has not got yet. The other relation
                // has answered this question since before the basket existed.
            }
        }

        krsort($found);

        return new Collection(array_values($found));
    }

    /**
     * The credit notes written against a set of invoices.
     *
     * A second query, because a credit note is in neither relation and that is
     * deliberate: it is written with no order on it at all. Refunding half of
     * somebody's first month does not un-build their server, so a credit note
     * is about the money and not about the service.
     *
     * @param  array<int, int>  $invoiceIds
     * @return Collection<int, Invoice>
     */
    public static function notesFor(array $invoiceIds, int $limit = 100): Collection
    {
        $invoiceIds = array_values(array_filter(array_map('intval', $invoiceIds)));

        if ($invoiceIds === []) {
            return new Collection();
        }

        try {
            return Invoice::query()
                ->where('kind', Invoice::CREDIT)
                ->whereIn('credit_for', $invoiceIds)
                ->orderByDesc('id')
                ->limit($limit)
                ->get();
        } catch (Throwable) {
            // credit_for was added by an upgrade rather than being there from
            // the start, so a panel that has not run it has no column to ask
            // about. No notes is the right answer there.
            return new Collection();
        }
    }

    /**
     * Take a cancelled order off the invoices that have not been paid yet.
     *
     * The rule the shop was asked for: somebody who cancels one of two services
     * is billed for the one they kept. An invoice that is already paid is
     * history and is never touched - what is owed on it was owed.
     *
     * The line and the money go together. Anything else leaves a document whose
     * lines do not add up to its total, which is worse than either mistake on
     * its own.
     */
    public static function revise(Order $order): void
    {
        // Both shapes, deduped, so an invoice that is in the pairing table
        // *and* names this order in order_id - which every basket's first order
        // is - is not revised twice.
        foreach (self::forOrder($order, Invoice::UNPAID) as $invoice) {
            try {
                self::withdrawLine($invoice, $order);
            } catch (Throwable $exception) {
                report($exception);
            }
        }
    }

    /**
     * One cancelled order, off one unpaid invoice.
     *
     * Everything is recomputed from what is left rather than subtracted from
     * what was there: tax on a smaller subtotal is not the old tax minus a
     * share, and a coupon worth a percentage is worth less of a smaller bill.
     * Recomputing cannot drift; subtracting can.
     */
    private static function withdrawLine(Invoice $invoice, Order $order): void
    {
        $left = $invoice->billed()->reject(
            static fn (Order $billed): bool => (int) $billed->id === (int) $order->id,
        )->values();

        // The last service on it. A bill for nothing is not a bill, so the
        // invoice is withdrawn rather than left as a document for zero - and
        // withdrawn the same way the invoices page does it, so a cancellation
        // by hand and one by a customer leave the same trail.
        if ($left->isEmpty()) {
            self::cancel($invoice);

            return;
        }

        $lines = [];

        foreach ($left as $billed) {
            $price = max(0, (int) $billed->price);
            $spec = is_array($billed->spec) ? $billed->spec : [];
            $name = trim((string) ($spec['name'] ?? '')) ?: Theme::trans('orders.gone_package');

            $lines[] = [
                'text' => $name . ' - ' . Theme::trans('packages.period_' . Packages::period($billed->period)),
                'amount' => $price,
            ];
        }

        // The same arithmetic the invoice was written with, so a document that
        // loses a line stays the shape it started as.
        $money = Purchase::money($lines, (int) $invoice->discount);

        $invoice->forceFill([
            'subtotal' => $money['subtotal'],
            'discount' => $money['discount'],
            'tax' => $money['tax'],
            'total' => $money['total'],
            'lines' => $lines,
            // The order_id has to keep naming something that is still on the
            // invoice, or every reader of the old shape is pointed at a
            // service this document no longer charges for.
            'order_id' => (int) $left->first()->id,
        ])->save();

        $invoice->orders()->detach((int) $order->id);

        // Said, not silently done. The customer has a document in their inbox
        // with a number on it, and the number just changed.
        Billing::announce($invoice);
    }

    /**
     * What a paid invoice does to its order.
     *
     * Split out so a retry from the admin page runs the same path as a
     * webhook, and so markPaid() reads as the three sentences it is.
     */
    private static function settle(Order $order, Invoice $invoice): void
    {
        /*
         * A package change, and nothing else.
         *
         * First, and with a return: the three sentences below are all about a
         * period - build it, un-suspend it, move it on - and none of them is
         * true of a charge made in the middle of one. An upgrade invoice
         * treated as a renewal would advance the due date and hand the customer
         * a free month for changing package.
         */
        if ($invoice->kind === Invoice::UPGRADE) {
            Upgrades::settle($invoice);

            return;
        }

        // And an extra bought mid-period, for the same reason: it is a charge
        // inside a period that is already paid for.
        if ($invoice->kind === Invoice::ADDON) {
            Addons::settle($invoice);

            return;
        }

        if ($order->state === Order::PENDING) {
            /*
             * Paid means built.
             *
             * Handed to the queue when there is a queue, and done here when
             * there is not. A worker that never answers turns a paid order into
             * a customer waiting for a server that nothing is making - and they
             * have already paid, which makes it the worst kind of silence this
             * shop can produce. The same trap took the updater off the queue in
             * 3.46.1-dev and EnsureEnabled off it before that.
             *
             * Building in the request costs that request a few seconds. Waiting
             * forever costs a customer their evening, so the choice is not a
             * close one - and if it fails, the order stays pending with the
             * reason on it and Retry is right there on the orders page.
             */
            if ((Workers::state()['state'] ?? '') === 'missing') {
                try {
                    Provision::run((int) $order->id);
                } catch (Throwable $exception) {
                    report($exception);
                }

                return;
            }

            ProvisionServer::dispatch((int) $order->id);

            return;
        }

        if ($order->state === Order::SUSPENDED) {
            self::unsuspend($order);
        }

        if ($order->recurring()) {
            self::advance($order);
        }
    }

    /**
     * Start a server this plugin stopped.
     *
     * Pelican's own suspension, so the panel shows what it always shows for a
     * suspended server and nothing here has to know what that looks like. A
     * server that is gone, or that somebody suspended by hand for another
     * reason, still moves the order back to active: the order is about the
     * money, and the money is now in order.
     */
    public static function unsuspend(Order $order): void
    {
        try {
            $server = $order->server;

            if ($server instanceof Server && $server->isSuspended()) {
                app(SuspensionService::class)->handle($server, SuspendAction::Unsuspend);
            }
        } catch (Throwable $exception) {
            report($exception);
        }

        try {
            $order->forceFill([
                'state' => Order::ACTIVE,
                'suspended_at' => null,
            ])->save();
        } catch (Throwable) {
            // Left suspended in the table while the server runs. The renewals
            // pass reads the invoice, finds it paid, and does not stop it again.
        }
    }

    /**
     * Move an order one period on.
     *
     * From the date it was already due rather than from today, so a customer
     * who pays four days late does not silently buy four fewer days - and a
     * date that has fallen far behind is caught up to now rather than
     * generating a run of invoices for months nobody was served.
     */
    public static function advance(Order $order): void
    {
        try {
            $from = $order->next_due_at instanceof Carbon ? $order->next_due_at->copy() : now();

            if ($from->isPast()) {
                $from = now();
            }

            $order->forceFill(['next_due_at' => self::add($from, (string) $order->period)])->save();
        } catch (Throwable) {
            // A due date that did not move is picked up by the next pass,
            // which reads the invoices rather than trusting this column alone.
        }
    }

    /** One period after a moment. */
    public static function add(Carbon $from, string $period): Carbon
    {
        return match ($period) {
            Package::YEAR => $from->copy()->addYear(),
            Package::QUARTER => $from->copy()->addMonths(3),
            default => $from->copy()->addMonth(),
        };
    }

    /**
     * Withdraw an invoice nobody is going to pay.
     *
     * A paid invoice is never cancelled. It is a record of money that changed
     * hands, and a document that can be withdrawn after the fact is not a
     * record of anything.
     */
    public static function cancel(Invoice $invoice): bool
    {
        if ($invoice->state !== Invoice::UNPAID) {
            return false;
        }

        try {
            $invoice->forceFill(['state' => Invoice::CANCELLED])->save();

            return true;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * Where an invoice can be read and printed.
     *
     * Called address() rather than the obvious word: check-banned.js refuses
     * a handful of function names anywhere in the source, and one of them is
     * the one this method wanted to be called.
     */
    public static function address(Invoice $invoice): string
    {
        return url('/essentials/invoice/' . (int) $invoice->id);
    }

    /** Whether this person is allowed to read this invoice. */
    public static function readableBy(Invoice $invoice, ?int $userId, bool $isAdmin = false): bool
    {
        return $isAdmin || ($userId !== null && (int) $invoice->user_id === $userId);
    }
}
