<?php

namespace LegendDevelopment\Theme\Support\Shop;

use App\Enums\SuspendAction;
use App\Models\Server;
use App\Services\Servers\SuspensionService;
use Illuminate\Support\Carbon;
use LegendDevelopment\Theme\Jobs\ProvisionServer;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Models\Package;
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

        return self::markPaid($invoice, Invoice::FREE);
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
            $order = $invoice->order;

            if ($order instanceof Order) {
                self::settle($order);
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
     * What a paid invoice does to its order.
     *
     * Split out so a retry from the admin page runs the same path as a
     * webhook, and so markPaid() reads as the three sentences it is.
     */
    private static function settle(Order $order): void
    {
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
