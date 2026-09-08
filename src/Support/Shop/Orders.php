<?php

namespace LegendDevelopment\Theme\Support\Shop;

use App\Enums\SuspendAction;
use App\Models\Server;
use App\Services\Servers\SuspensionService;
use Illuminate\Support\Carbon;
use LegendDevelopment\Theme\Jobs\ProvisionServer;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
use Throwable;

/**
 * The things that happen to an order after it is placed.
 *
 * Stopping one, starting it again, giving up on it, trying the build again.
 * All four are here rather than on the admin page, because the renewals pass
 * in a later release does three of them on a timer and the two callers must
 * not have separate ideas about what stopping an order means.
 *
 * The unsuspend half lives in Invoices, beside the payment that causes it -
 * that direction is always somebody paying, and putting it here would split
 * one sentence across two files.
 */
class Orders
{
    /**
     * Stop the server and say so on the order.
     *
     * Pelican's own suspension. The server keeps its files, its databases and
     * its backups, and the panel shows it the way it shows any suspended
     * server - which is the whole reason for using theirs rather than stopping
     * the container ourselves. Nothing is ever deleted by this plugin.
     *
     * @return bool Whether the order is now suspended.
     */
    public static function suspend(Order $order): bool
    {
        if ($order->state !== Order::ACTIVE) {
            return false;
        }

        try {
            $server = $order->server;

            if ($server instanceof Server && !$server->isSuspended()) {
                app(SuspensionService::class)->handle($server, SuspendAction::Suspend);
            }
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }

        try {
            $order->forceFill([
                'state' => Order::SUSPENDED,
                'suspended_at' => now(),
            ])->save();
        } catch (Throwable) {
            return false;
        }

        Billing::suspended($order);

        return true;
    }

    /**
     * Finished with, one way or another.
     *
     * The server is left alone. An administrator who wants it gone deletes it
     * in Pelican, where deleting a server is a thing with a confirmation on it
     * and a daemon that knows about it - a shop is not the place to remove
     * somebody's files. What cancelling does is stop the money: no more
     * renewals, and the place in the package's stock is given back.
     *
     * Unpaid invoices for the order are withdrawn at the same time. Leaving
     * them would mean a customer's billing page asks them to pay for something
     * that has been cancelled.
     */
    public static function cancel(Order $order): bool
    {
        if ($order->state === Order::CANCELLED) {
            return false;
        }

        try {
            $order->forceFill([
                'state' => Order::CANCELLED,
                'cancelled_at' => now(),
                'next_due_at' => null,
            ])->save();
        } catch (Throwable) {
            return false;
        }

        try {
            foreach ($order->invoices()->where('state', Invoice::UNPAID)->get() as $invoice) {
                Invoices::cancel($invoice);
            }
        } catch (Throwable) {
            // The order is cancelled either way. An invoice left open is
            // visible on the invoices page, where it can be withdrawn by hand.
        }

        return true;
    }

    /**
     * Build it again.
     *
     * Only for an order that is waiting and has no server - which is what a
     * failed build leaves. Queued rather than run here so a node that hangs
     * hangs a worker rather than an administrator's browser, and so the retry
     * path and the paid-for-the-first-time path are the same path.
     */
    public static function retry(Order $order): bool
    {
        if ($order->state !== Order::PENDING || $order->server_id !== null) {
            return false;
        }

        try {
            $order->forceFill(['note' => null])->save();

            ProvisionServer::dispatch((int) $order->id);

            return true;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * Move the next due date by hand.
     *
     * There for the cases a shop cannot predict: a customer who was down for a
     * week, a month given away, an invoice settled outside the panel. Recurring
     * orders only - a one-off has no next date to move.
     */
    public static function due(Order $order, ?Carbon $when): bool
    {
        if (!$order->recurring()) {
            return false;
        }

        try {
            $order->forceFill(['next_due_at' => $when])->save();

            return true;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * How late this order is, in days, or null if it is not.
     *
     * Read from the order's own oldest unpaid invoice rather than from the due
     * date, because the due date is when the next invoice is written and the
     * question here is how long one has been sitting unpaid.
     */
    public static function overdueDays(Order $order): ?int
    {
        try {
            $invoice = $order->invoices()
                ->where('state', Invoice::UNPAID)
                ->whereNotNull('due_at')
                ->orderBy('due_at')
                ->first();
        } catch (Throwable) {
            return null;
        }

        if (!$invoice instanceof Invoice || !$invoice->overdue()) {
            return null;
        }

        return max(0, (int) $invoice->due_at->diffInDays(now()));
    }
}
