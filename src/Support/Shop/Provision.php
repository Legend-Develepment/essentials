<?php

namespace LegendDevelopment\Theme\Support\Shop;

use App\Models\Allocation;
use App\Models\Node;
use App\Services\Servers\ServerCreationService;
use Illuminate\Support\Arr;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Turning a paid order into a server.
 *
 * The same road Duplicate takes - Pelican's own ServerCreationService, an
 * allocation found rather than asked for - with one difference that matters:
 * there is no source server to copy, so every field comes from the spec the
 * order snapshotted when it was bought. That is why the spec exists. A package
 * edited between the sale and the build must not change what somebody paid
 * for, and reading the package here instead would do exactly that.
 *
 * **A failure is a state, not an exception.** A node with no free allocation
 * at three in the morning is an ordinary thing. So run() catches, writes the
 * reason onto the order, tells whoever can act, and leaves the order pending
 * with its invoice paid - which is the state the admin page has a Retry button
 * for. Nothing is rolled back and nobody's payment disappears.
 */
class Provision
{
    /**
     * Where this order's server can go.
     *
     * The package's nodes in the order they were listed, first one with a free
     * allocation wins - so a panel can say "prefer the big machine, fall back
     * to the small one" by dragging one checkbox above another. An empty list
     * means any node, in id order, which is what a panel with one node wants
     * without having to say so.
     */
    public static function allocation(Order $order): ?Allocation
    {
        $spec = is_array($order->spec) ? $order->spec : [];
        $wanted = [];

        foreach ((array) ($spec['node_ids'] ?? []) as $id) {
            if (is_numeric($id) && (int) $id > 0) {
                $wanted[] = (int) $id;
            }
        }

        try {
            if ($wanted === []) {
                $wanted = Node::query()->orderBy('id')->pluck('id')->map(
                    static fn (mixed $id): int => (int) $id,
                )->all();
            }

            foreach ($wanted as $nodeId) {
                $allocation = Allocation::query()
                    ->where('node_id', $nodeId)
                    ->whereNull('server_id')
                    ->orderBy('ip')
                    ->orderBy('port')
                    ->first();

                if ($allocation instanceof Allocation) {
                    return $allocation;
                }
            }
        } catch (Throwable) {
            return null;
        }

        return null;
    }

    /**
     * The fields ServerCreationService reads, built from the order's spec.
     *
     * `start_on_completion` is false on purpose. A server that boots the
     * instant it is created is a server whose owner has not yet seen it, and
     * on a Minecraft egg that means an EULA prompt in a console nobody is
     * watching. They start it themselves, from their own panel.
     *
     * @return array<string, mixed>
     */
    public static function fields(Order $order, Allocation $allocation): array
    {
        $spec = is_array($order->spec) ? $order->spec : [];

        return [
            'owner_id' => (int) $order->user_id,
            'egg_id' => (int) ($spec['egg_id'] ?? 0),
            'name' => self::name($order),
            'description' => Theme::trans('orders.server_description', [
                'number' => '#' . (int) $order->id,
            ]),
            'image' => self::text($spec['image'] ?? null),
            'startup' => self::text($spec['startup'] ?? null),
            'memory' => (int) ($spec['memory'] ?? 1024),
            'swap' => (int) ($spec['swap'] ?? 0),
            'disk' => (int) ($spec['disk'] ?? 5120),
            'io' => (int) ($spec['io'] ?? 500),
            'cpu' => (int) ($spec['cpu'] ?? 100),
            'threads' => self::text($spec['threads'] ?? null),
            'oom_killer' => (bool) ($spec['oom_killer'] ?? false),
            'database_limit' => (int) ($spec['database_limit'] ?? 0),
            'allocation_limit' => (int) ($spec['allocation_limit'] ?? 0),
            'backup_limit' => (int) ($spec['backup_limit'] ?? 0),
            'environment' => self::environment($spec),
            'allocation_id' => (int) $allocation->id,
            'node_id' => (int) $allocation->node_id,
            'start_on_completion' => false,
        ];
    }

    /**
     * Build it.
     *
     * Takes an id rather than a model because this is what a queued job calls,
     * and a job that carries a serialised model carries whatever that model
     * looked like when it was queued.
     *
     * @return bool Whether a server now exists for this order.
     */
    public static function run(int $orderId): bool
    {
        try {
            $order = Order::query()->find($orderId);
        } catch (Throwable) {
            return false;
        }

        if (!$order instanceof Order || $order->state !== Order::PENDING) {
            return false;
        }

        // Already built, and something asked twice. Nothing to do, and saying
        // so is better than a second server on the same order.
        if ($order->server_id !== null) {
            return true;
        }

        if (!self::owed($order)) {
            return false;
        }

        $allocation = self::allocation($order);

        if ($allocation === null) {
            self::refuse($order, Theme::trans('orders.no_allocation'));

            return false;
        }

        try {
            $server = app(ServerCreationService::class)->handle(self::fields($order, $allocation));
        } catch (Throwable $exception) {
            report($exception);

            self::refuse($order, Arr::first(explode("\n", $exception->getMessage())) ?: '');

            return false;
        }

        try {
            $order->forceFill([
                'server_id' => (int) $server->id,
                'state' => Order::ACTIVE,
                'provisioned_at' => now(),
                'note' => null,
                /*
                 * The first period starts now, not when the order was placed.
                 * Somebody who waited two days for a node to have room does not
                 * pay for those two days.
                 */
                'next_due_at' => $order->recurring() ? Invoices::add(now(), (string) $order->period) : null,
            ])->save();
        } catch (Throwable $exception) {
            report($exception);
        }

        Billing::ready($order, (string) $server->name);

        return true;
    }

    /**
     * Whether this order has actually been paid for.
     *
     * Asked here rather than trusted from the caller, because this runs in a
     * queue: the job could be replayed, dispatched by hand, or left over from
     * before an invoice was cancelled. A server is only built for an order
     * whose first invoice is paid.
     */
    private static function owed(Order $order): bool
    {
        try {
            return Invoice::query()
                ->where('order_id', (int) $order->id)
                ->where('kind', Invoice::ORDER)
                ->where('state', Invoice::PAID)
                ->exists();
        } catch (Throwable) {
            return false;
        }
    }

    /** Write the reason on the order and tell somebody who can act on it. */
    private static function refuse(Order $order, string $why): void
    {
        $why = mb_substr(trim($why), 0, 2000);

        try {
            $order->forceFill(['note' => $why === '' ? Theme::trans('orders.no_reason') : $why])->save();
        } catch (Throwable) {
            // The notification below is then the only record, which is why it
            // carries the reason rather than pointing at the row.
        }

        Billing::trouble(
            Theme::trans('orders.bell_failed', ['number' => '#' . (int) $order->id]),
            $why === '' ? Theme::trans('orders.no_reason') : $why,
        );
    }

    /**
     * What the server is called.
     *
     * The package's name and the order number, because a panel full of servers
     * called "Starter" is one where nobody can find anything - and the order
     * number is the one thing that ties a server to an invoice.
     */
    private static function name(Order $order): string
    {
        $spec = is_array($order->spec) ? $order->spec : [];
        $name = trim((string) ($spec['name'] ?? ''));

        if ($name === '') {
            $name = Theme::trans('orders.server_fallback');
        }

        return mb_substr($name . ' #' . (int) $order->id, 0, 191);
    }

    /**
     * @param  array<string, mixed>  $spec
     * @return array<string, string>
     */
    private static function environment(array $spec): array
    {
        $out = [];

        foreach ((array) ($spec['environment'] ?? []) as $key => $value) {
            if (is_string($key) && is_scalar($value)) {
                $out[$key] = (string) $value;
            }
        }

        return $out;
    }

    private static function text(mixed $value): ?string
    {
        $value = trim((string) ($value ?? ''));

        return $value === '' ? null : $value;
    }
}
