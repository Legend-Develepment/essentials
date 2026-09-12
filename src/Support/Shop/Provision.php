<?php

namespace LegendDevelopment\Theme\Support\Shop;

use App\Models\Allocation;
use App\Models\Node;
use App\Services\Servers\ServerCreationService;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Shop\Delivery;
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

            /*
             * The package, plus everything bought alongside it.
             *
             * Through Addons::limits() rather than straight off the spec,
             * because a customer who bought two gigabytes at the checkout must
             * get a server with them - not one built to the bare package and
             * resized afterwards, which is a server that starts too small and a
             * second call that can fail on its own.
             *
             * It is the same sum a resize uses, which is the point of it being
             * in one place: build and resize cannot disagree about what
             * somebody is entitled to.
             */
            ...Addons::limits($order, $spec),

            'environment' => self::environment($spec, $order),
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
            /*
             * Said out loud, on the order, where somebody will see it.
             *
             * This used to return false and write nothing, which is how a
             * basket of two quietly built one server: the second order sat
             * there pending, with no note, no notification and no reason - and
             * the only trace of it anywhere was a queue job that finished in
             * eight milliseconds.
             *
             * Nothing is built either way. A build that is refused because the
             * money is not there is right to refuse; it is the silence that was
             * wrong.
             */
            self::refuse($order, Theme::trans('orders.not_paid'));

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
                /*
                 * And when the agreement runs out.
                 *
                 * Written now, from the package as it was bought, because a
                 * contract is what was agreed at the time - a package whose
                 * term is shortened next month must not shorten a contract
                 * somebody already signed. Null when the package ties nobody
                 * in, which is most of them.
                 */
                'ends_at' => self::endsAt($order),
            ])->save();
        } catch (Throwable $exception) {
            report($exception);
        }

        /*
         * The customer's own file, before they are told it is ready.
         *
         * Told first and delivered second would be a server somebody opens to
         * find their world missing. Its own try because a file that would not
         * go in is not a failed order: the server exists and is theirs, and
         * this is a thing an administrator can put right by hand.
         */
        try {
            Delivery::run($order);
        } catch (Throwable $exception) {
            report($exception);

            Billing::trouble(
                Theme::trans('orders.bell_undelivered', ['number' => '#' . (int) $order->id]),
                Theme::trans('orders.bell_undelivered_body'),
            );
        }

        Billing::ready($order, (string) $server->name);

        return true;
    }

    /**
     * The end of the contract, counted from the moment the server exists.
     *
     * From the order's own snapshot rather than from the package, for the same
     * reason everything else here is: the package can change and the agreement
     * cannot. Nothing at all when the package had no term.
     */
    private static function endsAt(Order $order): ?Carbon
    {
        $spec = is_array($order->spec) ? $order->spec : [];

        $length = (int) ($spec['term'] ?? 0);
        $unit = (string) ($spec['term_unit'] ?? Package::MONTH_TERM);

        if ($length <= 0 || !in_array($unit, Package::TERM_UNITS, true)) {
            return null;
        }

        return match ($unit) {
            Package::DAY => now()->addDays($length),
            Package::YEAR_TERM => now()->addYears($length),
            default => now()->addMonths($length),
        };
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
            // Named in order_id, which is how every invoice said it before one
            // could bill more than a single order.
            if (Invoice::query()
                ->where('order_id', (int) $order->id)
                ->where('kind', Invoice::ORDER)
                ->where('state', Invoice::PAID)
                ->exists()) {
                return true;
            }
        } catch (Throwable) {
            return false;
        }

        try {
            /*
             * Or billed on one through the pairing table.
             *
             * This is what a basket does: two orders, one invoice, and order_id
             * naming only the first of them. Without this the second order was
             * read as unpaid and its server was never built - the customer paid
             * for two things and got one, and nothing anywhere said why, because
             * the caller of this treats false as "not paid for yet" and says
             * nothing about it.
             */
            return $order->billedOn()
                ->where('kind', Invoice::ORDER)
                ->where('state', Invoice::PAID)
                ->exists();
        } catch (Throwable) {
            // No pairing table on this panel yet, and then there is no basket
            // either - so the question above was the whole question.
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
    private static function environment(array $spec, Order $order): array
    {
        $out = [];

        foreach ((array) ($spec['environment'] ?? []) as $key => $value) {
            if (is_string($key) && is_scalar($value)) {
                $out[$key] = (string) $value;
            }
        }

        /*
         * And on top, what the customer filled in.
         *
         * Last, so an answer wins over the package's own value for the same
         * variable - which is the whole point of asking. Only the names the
         * package actually asked for: the snapshot carries that list, so a
         * package edited since cannot let an old order set something it was
         * never offered.
         */
        $asked = (array) ($spec['ask_vars'] ?? []);
        $given = is_array($order->extras) ? $order->extras : [];

        foreach ($asked as $name) {
            $name = trim((string) $name);

            if ($name === '' || !array_key_exists($name, $given)) {
                continue;
            }

            $value = $given[$name];

            if (is_scalar($value)) {
                $out[$name] = (string) $value;
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
