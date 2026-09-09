<?php

namespace LegendDevelopment\Theme\Support\Shop;

use App\Enums\SuspendAction;
use App\Models\Server;
use App\Services\Servers\ServerDeletionService;
use App\Services\Servers\SuspensionService;
use Illuminate\Support\Carbon;
use LegendDevelopment\Theme\Jobs\ProvisionServer;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * The things that happen to an order after it is placed.
 *
 * Stopping one, starting it again, giving notice on it, closing it when that
 * notice runs out, ending it on the spot, and trying the build again. They are
 * all here rather than on the admin page, because the nightly renewals pass
 * does several of them on a timer and the two callers must not have separate
 * ideas about what any of them means.
 *
 * The unsuspend half lives in Invoices, beside the payment that causes it -
 * that direction is always somebody paying, and putting it here would split
 * one sentence across two files.
 *
 * **Two of these delete a server**, and they are the only two in the plugin
 * that do. finish() is the nightly one and will only touch an order a person
 * cancelled, on the date that person set and the customer was told.
 * terminate() is the button, behind a permission of its own. Everything else
 * in this file leaves the files, the databases and the backups exactly where
 * they are.
 */
class Orders
{
    /**
     * Everything worth knowing about one order, as label and value.
     *
     * Built here rather than in the page because it is a reading of the row
     * rather than a decision about it, and because the same reading is what a
     * support answer is written from - which is a thing that will want to be
     * somewhere else eventually.
     *
     * A row is left out when it has nothing to say. A list with four blanks in
     * it is a list somebody has to read twice to find the two lines that matter.
     *
     * @return array<int, array{label: string, value: string, wide: bool}>
     */
    public static function detail(Order $order): array
    {
        $rows = [];

        $add = static function (string $key, ?string $value, bool $wide = false) use (&$rows): void {
            $value = $value === null ? '' : trim($value);

            if ($value !== '') {
                $rows[] = ['label' => Theme::trans('orders.' . $key), 'value' => $value, 'wide' => $wide];
            }
        };

        $spec = is_array($order->spec) ? $order->spec : [];

        $add('detail_package', (string) ($spec['name'] ?? ''));
        $add('detail_placed', $order->created_at?->toDayDateTimeString());
        $add('detail_built', $order->provisioned_at?->toDayDateTimeString());
        $add('detail_due', $order->next_due_at?->toFormattedDateString());
        $add('detail_ends', $order->ends_at?->toFormattedDateString());
        $add('detail_suspended', $order->suspended_at?->toDayDateTimeString());
        /*
         * The date and who did it on one line.
         *
         * Two rows read "Ended by: Ended by the customer", because the value
         * is a whole sentence and the label repeats its first two words. One
         * row with both facts says the same thing once.
         */
        $who = match ((string) $order->cancelled_by) {
            Order::BY_CUSTOMER => Theme::trans('orders.by_customer'),
            Order::BY_ADMIN => Theme::trans('orders.by_admin'),
            default => null,
        };

        $when = $order->cancelled_at?->toDayDateTimeString();

        $add('detail_cancelled', $when === null
            ? null
            : ($who === null ? $when : $when . ' - ' . $who));

        /*
         * What the customer typed, in the order the package asked for it. Only
         * the names it asked for: an answer to something that was never asked
         * is not on the row, and if one ever were it would not be shown as
         * though it had been.
         */
        $answers = is_array($order->extras) ? $order->extras : [];

        foreach ((array) ($spec['ask_vars'] ?? []) as $name) {
            $name = trim((string) $name);

            if ($name === '' || !array_key_exists($name, $answers)) {
                continue;
            }

            $rows[] = [
                'label' => $name,
                'value' => (string) $answers[$name],
                'wide' => true,
            ];
        }

        // And their file, in whichever of its three states it is.
        if ($order->delivered_at !== null) {
            $add('detail_file_in', $order->delivered_at->toDayDateTimeString());
        } elseif (trim((string) $order->upload_path) !== '') {
            $add('detail_file_waiting', Theme::trans('orders.detail_file_waiting_value'));
        }

        $add('detail_note', (string) $order->note, true);

        return $rows;
    }

    /**
     * Stop the server and say so on the order.
     *
     * Pelican's own suspension. The server keeps its files, its databases and
     * its backups, and the panel shows it the way it shows any suspended
     * server - which is the whole reason for using theirs rather than stopping
     * the container ourselves. Suspending deletes nothing, ever, and paying
     * the invoice behind it starts the server again.
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
     * Give notice.
     *
     * Cancelling does not stop a service - it says when it will stop. The
     * order keeps running until its contract runs out, and only then is the
     * server removed. That distinction is the whole of this method: ending an
     * agreement and taking somebody's files away are different acts, and they
     * used to be the same button.
     *
     * When there is a date to run to, the order sits in `ending` until it
     * passes and the nightly pass finishes the job. When there is not - a
     * one-off package with no term - there is nothing to run to, so it is
     * cancelled on the spot and the server is left alone. Removing it then is
     * a separate decision, behind a separate permission: see terminate().
     *
     * Unpaid invoices are withdrawn either way. Leaving them would mean a
     * customer being asked to pay for something they have already cancelled.
     */
    /**
     * @param  string  $by  Order::BY_CUSTOMER or Order::BY_ADMIN - written down
     *                      because "who ended this" is the first thing anybody
     *                      asks about a service that has stopped, and asking it
     *                      afterwards means guessing from timestamps.
     */
    public static function cancel(Order $order, string $by = Order::BY_ADMIN): bool
    {
        if (in_array($order->state, [Order::CANCELLED, Order::ENDING], true)) {
            return false;
        }

        $ends = self::endsAt($order);

        try {
            $order->forceFill([
                'state' => $ends === null ? Order::CANCELLED : Order::ENDING,
                'cancelled_at' => now(),
                'cancelled_by' => $by,
                'ends_at' => $ends,
                // Nothing renews after notice is given, whichever it became.
                'next_due_at' => null,
            ])->save();
        } catch (Throwable) {
            return false;
        }

        self::withdraw($order);

        Billing::ending($order, $ends);

        return true;
    }

    /**
     * When a cancelled order actually stops.
     *
     * Three answers in order of authority. A contract date written when the
     * server was built wins, because that is what was agreed. Failing that, a
     * recurring order runs to the end of the period already paid for - taking
     * back something somebody has paid until the end of the month would be
     * theft with extra steps. And a one-off with no term has no end at all.
     */
    public static function endsAt(Order $order): ?Carbon
    {
        if ($order->ends_at instanceof Carbon && $order->ends_at->isFuture()) {
            return $order->ends_at->copy();
        }

        if ($order->recurring() && $order->next_due_at instanceof Carbon && $order->next_due_at->isFuture()) {
            return $order->next_due_at->copy();
        }

        return null;
    }

    /**
     * The contract runs out: the server goes.
     *
     * Called by the nightly pass once ends_at has passed, and this is the only
     * place in the plugin that deletes a server without somebody pressing a
     * button - which is why it will not touch an order that is not in
     * `ending`. An order gets there by being cancelled, by a person, on
     * purpose.
     */
    public static function finish(Order $order): bool
    {
        if (!$order->ending()) {
            return false;
        }

        $gone = self::remove($order);

        try {
            $order->forceFill([
                'state' => Order::CANCELLED,
                // Only when it really went. Otherwise the row keeps pointing at
                // the server so Stop and delete can be pressed again.
                'server_id' => $gone ? null : $order->server_id,
                'ends_at' => null,
            ])->save();
        } catch (Throwable) {
            return false;
        }

        Billing::ended($order);

        return true;
    }

    /**
     * Stop now, and take the server with it.
     *
     * The one irreversible thing in the shop, behind its own permission for
     * exactly that reason. Everything else here can be undone: a suspension
     * lifts, a date moves, a cancellation still has a notice period. This
     * deletes files.
     *
     * No end date is honoured and none is written. Somebody pressing this has
     * decided the agreement is over now, and a plugin that argued with them
     * about a contract would be a plugin they worked around.
     */
    /** @param  string  $by  Who pressed it. See cancel() above. */
    public static function terminate(Order $order, string $by = Order::BY_ADMIN): bool
    {
        if ($order->state === Order::CANCELLED && $order->server_id === null) {
            return false;
        }

        $gone = self::remove($order);

        try {
            $order->forceFill([
                'state' => Order::CANCELLED,
                'cancelled_at' => $order->cancelled_at ?? now(),
                'cancelled_by' => $order->cancelled_by ?? $by,
                'ends_at' => null,
                'next_due_at' => null,
                'server_id' => $gone ? null : $order->server_id,
            ])->save();
        } catch (Throwable) {
            return false;
        }

        self::withdraw($order);

        Billing::ended($order);

        return true;
    }

    /**
     * Hand the server to Pelican's own deletion.
     *
     * Theirs rather than a delete of the row, because a server is a container
     * on a node and a database and a set of files, and only the daemon knows
     * how to take all of that away.
     *
     * A failure is reported and the order still closes: an order that will not
     * close because a node is unreachable is an order that keeps billing. But
     * it says so, and the false is what stops the caller forgetting which
     * server it was - a closed order pointing at a server that is still there
     * is recoverable, and one pointing at nothing is a container nobody can
     * find again from this panel.
     */
    private static function remove(Order $order): bool
    {
        try {
            $server = $order->server;

            if (!$server instanceof Server) {
                // Nothing to delete is not a failure. An order whose server was
                // removed in Pelican is already in the state this wants.
                return true;
            }

            app(ServerDeletionService::class)->handle($server);
        } catch (Throwable $exception) {
            report($exception);

            Billing::trouble(
                Theme::trans('orders.bell_undeleted', ['number' => '#' . (int) $order->id]),
                Theme::trans('orders.bell_undeleted_body'),
            );

            return false;
        }

        return true;
    }

    /** Take back any bill nobody is going to pay now. */
    private static function withdraw(Order $order): void
    {
        try {
            foreach ($order->invoices()->where('state', Invoice::UNPAID)->get() as $invoice) {
                Invoices::cancel($invoice);
            }
        } catch (Throwable) {
            // The order is closed either way. An invoice left open is visible
            // on the invoices page, where it can be withdrawn by hand.
        }
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
