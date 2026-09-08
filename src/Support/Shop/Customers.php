<?php

namespace LegendDevelopment\Theme\Support\Shop;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * The shop, turned around to face the person instead of the row.
 *
 * Orders, invoices and payments are each a list of things that happened. This
 * is the same information asked a different question: who is this, what do
 * they hold, what have they paid, and what is still outstanding. That question
 * is the one somebody answering a support ticket actually has, and answering
 * it by reading three tables and doing the arithmetic in your head is how
 * mistakes get made in front of a customer.
 *
 * **Only people who have bought something.** A panel with four hundred users
 * and nine customers should show nine rows. The list is built from the orders
 * table rather than from the users table for that reason - a customer is
 * somebody who ordered, not somebody who signed up.
 *
 * Money is summed from paid invoices rather than from orders, because an order
 * is a price and an invoice is a payment. Somebody with a year-old order and
 * nothing paid has spent nothing, and this says so.
 */
class Customers
{
    /**
     * What each person's totals came to, for the length of one request.
     *
     * @var array<int, array<string, mixed>>
     */
    private static array $memo = [];

    /**
     * Users who have at least one order, newest customer first.
     *
     * A query rather than a collection, so the page can sort, search and page
     * through it the way every other table in this plugin does.
     *
     * @return Builder<User>
     */
    public static function query(): Builder
    {
        return User::query()->whereIn(
            'id',
            Order::query()->select('user_id')->distinct(),
        );
    }

    /**
     * What one person holds and owes, in one read each.
     *
     * Six small aggregates rather than loading their orders and invoices and
     * counting in PHP: a customer with two hundred orders would otherwise pull
     * two hundred rows to draw one line of a table.
     *
     * @return array{
     *     services: int, servers: int, orders: int,
     *     spent: int, outstanding: int, currency: string, since: ?string
     * }
     */
    public static function of(int $userId): array
    {
        /*
         * Answered once per person per request.
         *
         * A table row draws four columns from this, and each one asking again
         * would be twenty-four queries a row - so nine customers would cost
         * two hundred. The memo lives for the request, which is exactly as
         * long as one page of the table.
         */
        if (array_key_exists($userId, self::$memo)) {
            return self::$memo[$userId];
        }

        $out = [
            'services' => 0,
            'servers' => 0,
            'orders' => 0,
            'spent' => 0,
            'outstanding' => 0,
            'currency' => Packages::currency(),
            'since' => null,
        ];

        try {
            $orders = Order::query()->where('user_id', $userId);

            $out['orders'] = (clone $orders)->count();
            $out['services'] = (clone $orders)->whereIn('state', Order::OCCUPYING)->count();
            $out['servers'] = (clone $orders)->whereNotNull('server_id')->count();
            $out['since'] = (clone $orders)->min('created_at');

            $invoices = Invoice::query()->where('user_id', $userId);

            $out['spent'] = (int) (clone $invoices)->where('state', Invoice::PAID)->sum('total');
            $out['outstanding'] = (int) (clone $invoices)->where('state', Invoice::UNPAID)->sum('total');
        } catch (Throwable) {
            // A database that will not answer draws a row of zeroes rather
            // than taking the page with it.
        }

        self::$memo[$userId] = $out;

        return $out;
    }

    /**
     * One person's services, as lines a person can read.
     *
     * The order's own snapshot for the name, so a package renamed or deleted
     * since the sale still says what was bought.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function services(int $userId): array
    {
        $out = [];

        try {
            $orders = Order::query()
                ->where('user_id', $userId)
                ->with('server')
                ->orderByDesc('id')
                ->limit(100)
                ->get();
        } catch (Throwable) {
            return [];
        }

        foreach ($orders as $order) {
            $spec = is_array($order->spec) ? $order->spec : [];

            $out[] = [
                'id' => (int) $order->id,
                'name' => trim((string) ($spec['name'] ?? '')) ?: Theme::trans('orders.gone_package'),
                'state' => Theme::trans('orders.state_' . $order->state),
                'colour' => match ($order->state) {
                    Order::ACTIVE => 'success',
                    Order::PENDING => 'warning',
                    Order::SUSPENDED => 'danger',
                    default => 'gray',
                },
                'server' => $order->server?->name,
                'price' => Money::format((int) $order->price, (string) $order->currency)
                    . ' ' . Theme::trans('packages.per_' . $order->period),
                'due' => $order->next_due_at?->toFormattedDateString(),
            ];
        }

        return $out;
    }

    /**
     * One person's invoices, the same way.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function invoices(int $userId): array
    {
        $out = [];

        try {
            $invoices = Invoice::query()
                ->where('user_id', $userId)
                ->orderByDesc('id')
                ->limit(100)
                ->get();
        } catch (Throwable) {
            return [];
        }

        foreach ($invoices as $invoice) {
            $out[] = [
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
                'due' => $invoice->due_at?->toFormattedDateString(),
                'url' => Invoices::address($invoice),
            ];
        }

        return $out;
    }
}
