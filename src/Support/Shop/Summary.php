<?php

namespace LegendDevelopment\Theme\Support\Shop;

use App\Enums\ServerState;
use App\Models\Server;
use Illuminate\Support\Collection;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * One service, described.
 *
 * **Lifted out of the page that used to hold it**, because there is now more
 * than one place that draws a service: the list of cards and the page for a
 * single one. Two copies of "what is this service" is two answers to the same
 * question, and only one of them would ever get fixed.
 *
 * Everything here reads and nothing here writes. What a customer can *do* to a
 * service sends notifications and redirects, which is page work, and that lives
 * in Filament\Concerns\ManagesServices beside the pages that need it.
 *
 * **The order's own snapshot, not the package.** A service bought before its
 * package was edited still reads the way it was sold - that is what `spec` is
 * for, and it is why specs() takes an array rather than a Package.
 */
class Summary
{
    /**
     * This person's services, as two lists rather than one filtered later.
     *
     * A service that has been closed is not a thing anybody can do anything
     * with: no server behind it and no bill in front of it. A hundred rows of
     * which ninety are closed would otherwise leave ten on a page that says it
     * has a hundred.
     *
     * @return Collection<int, Order>
     */
    public static function listFor(int $userId, bool $closed): Collection
    {
        if ($userId <= 0) {
            return new Collection();
        }

        try {
            return Order::query()
                ->where('user_id', $userId)
                ->where('state', $closed ? '=' : '!=', Order::CANCELLED)
                /*
                 * The extras too, because Addons::of() prefers a relation that
                 * is already loaded. Without it every card on the page is one
                 * more query for something the first query could have brought.
                 */
                ->with(['server', 'package.egg', 'addons'])
                ->orderByDesc('id')
                ->limit(100)
                ->get();
        } catch (Throwable) {
            return new Collection();
        }
    }

    /**
     * One service, as a card or a page reads it.
     *
     * The keys a page needs and not one more. `ask` and the address of the
     * service's own page are added by whoever is drawing, because both name a
     * page and this class knows nothing about pages.
     *
     * @return array<string, mixed>
     */
    public static function card(Order $order): array
    {
        $spec = is_array($order->spec) ? $order->spec : [];
        $server = $order->server;

        return [
            'id' => (int) $order->id,
            'name' => trim((string) ($spec['name'] ?? '')) ?: Theme::trans('orders.gone_package'),
            'state' => Theme::trans('orders.state_' . $order->state),
            'colour' => match ($order->state) {
                Order::ACTIVE => 'success',
                Order::PENDING => 'warning',
                Order::SUSPENDED => 'danger',
                Order::ENDING => 'info',
                default => 'gray',
            },
            'server' => $server?->name,
            /*
             * What the panel knows about the machine, which is a different
             * question from what the order says. An order can be active
             * while its server is still installing, and somebody looking at
             * "Active" and a server that will not start needs the second
             * sentence rather than a support ticket.
             *
             * The panel's own state and not the daemon's: asking the node
             * whether each server is running is one network call per card,
             * on a page somebody opens to look at a list.
             */
            'server_state' => self::serverState($server),
            /*
             * Straight into the server, by the uuid Pelican's own server
             * panel is addressed by. Built as a path rather than resolved
             * through that panel's routes, because those belong to a panel
             * this page is not on.
             */
            'url' => $server === null ? null : url('/server/' . $server->uuid_short),
            'price' => Money::format((int) $order->price, (string) $order->currency)
                . ' ' . Theme::trans('packages.per_' . $order->period),
            'due' => $order->next_due_at?->toFormattedDateString(),
            'specs' => self::specs($spec),
            /*
             * Both ways out, or neither. Ending is the ordinary one - it
             * runs to the date they were told and nothing is deleted before
             * then. Now is the other, and it is only offered because being
             * unable to leave is its own kind of trap; the confirmation
             * says what it costs in the plainest words there are.
             */
            'may_cancel' => self::mayCancel($order),

            /*
             * Where this service could go, and what each move costs today.
             *
             * Worked out per card rather than once for the page, because
             * the answer depends on how far through its own period each
             * service is. Two identical servers bought a fortnight apart
             * are two different prices this afternoon.
             */
            'changes' => self::changes($order),

            // What it already carries, and what could still be added to it.
            'extras' => self::extras($order),
            'offers' => self::offers($order),

            // A change already agreed and waiting on an invoice, so the
            // card says so rather than offering the same move again.
            'waiting' => self::pending($order),
            'ends_on' => Orders::endsAt($order)?->toFormattedDateString(),
            /*
             * The card keeps the package's picture, so a service looks
             * like the thing that was bought. From the package rather than
             * the snapshot: a picture is decoration, and showing today's
             * one costs nobody anything.
             */
            'art' => $order->package instanceof Package ? Packages::art($order->package) : null,
            'note' => match ($order->state) {
                Order::PENDING => Theme::trans('shop.order_pending'),
                Order::SUSPENDED => Theme::trans('shop.order_suspended'),
                // The one sentence somebody with notice on their service
                // actually needs: the day it stops.
                Order::ENDING => $order->ends_at === null
                    ? Theme::trans('shop.order_ending_open')
                    : Theme::trans('shop.order_ending', [
                        'date' => $order->ends_at->toFormattedDateString(),
                    ]),
                default => null,
            },
        ];
    }

    /**
     * What the panel knows about the machine behind one order.
     *
     * Null when there is nothing to say, which is a server doing what a server
     * ordinarily does: the card already says the order is active, and repeating
     * "running" under it is a line nobody needs.
     */
    public static function serverState(?Server $server): ?string
    {
        if (!$server instanceof Server) {
            return null;
        }

        try {
            $state = $server->status;

            if ($state === null) {
                return null;
            }

            return match ($state) {
                ServerState::Installing => Theme::trans('shop.server_installing'),
                ServerState::InstallFailed, ServerState::ReinstallFailed => Theme::trans('shop.server_failed'),
                ServerState::Suspended => Theme::trans('shop.server_suspended'),
                ServerState::RestoringBackup => Theme::trans('shop.server_restoring'),
                // Named rather than left to the catch below. A state this panel
                // has not heard of throws out of a match, and a throw is a
                // heavy way to say "nothing to report".
                default => null,
            };
        } catch (Throwable) {
            // A state this panel does not recognise is a state not worth
            // guessing at on somebody's billing page.
            return null;
        }
    }

    /**
     * Whether this person may give this service up themselves.
     *
     * Off unless the panel says so: on a panel that would rather be asked
     * first, a cancel button is a support process somebody skipped. An order
     * that is already ending or already closed has nothing to give up.
     */
    public static function mayCancel(Order $order): bool
    {
        try {
            if (!(bool) Theme::config('shop_self_cancel', false)) {
                return false;
            }

            return !in_array($order->state, [Order::CANCELLED, Order::ENDING], true);
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * The moves this service can make, priced for today.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function changes(Order $order): array
    {
        $out = [];

        foreach (Upgrades::options($order) as $package) {
            $quote = Upgrades::quote($order, $package);

            if (!$quote['ok']) {
                continue;
            }

            $amount = (int) $quote['amount'];

            $out[] = [
                'package' => (int) $package->id,
                'name' => (string) $package->name,
                'price' => Packages::priceLabel($package, (string) $quote['currency']),
                'specs' => Packages::specs($package),
                /*
                 * What it costs, said as the three different things it can be.
                 * A move that gives money back is not a bill for nothing, and a
                 * customer reading "0,00" on a downgrade would reasonably think
                 * the refund had been forgotten.
                 */
                'costs' => $amount > 0,
                'gives' => $amount < 0,
                'amount' => Money::format(abs($amount), (string) $quote['currency']),
                'days' => (int) $quote['days_left'],
            ];
        }

        return $out;
    }

    /**
     * The extras this service carries.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function extras(Order $order): array
    {
        $currency = (string) ($order->currency ?: Packages::currency());
        $out = [];

        foreach (Addons::of($order) as $line) {
            $many = max(1, (int) $line->quantity);

            $out[] = [
                'id' => (int) $line->id,
                'name' => $many > 1 ? $line->name . ' × ' . $many : (string) $line->name,
                'price' => Money::format($line->total(), $currency),
                'billing' => Theme::trans($line->recurring() ? 'addons.billing_with' : 'addons.billing_once'),
                /*
                 * A one-off cannot be dropped for money back: it was delivered,
                 * and the price of it is not owed back because a limit went
                 * away. Dropping one that changes nothing on the server would
                 * be a button that does nothing, so it is not offered.
                 */
                'may_drop' => $line->recurring(),
            ];
        }

        return $out;
    }

    /**
     * What could still be added, and what it costs today.
     *
     * Priced for the days left in the period, because that is what pressing the
     * button charges. The whole price is stated beside it, because that is what
     * it costs from next month - a customer shown only the part-period figure
     * would think they had found a bargain.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function offers(Order $order): array
    {
        if ($order->state !== Order::ACTIVE) {
            return [];
        }

        $currency = (string) ($order->currency ?: Packages::currency());
        $left = Periods::left($order);
        $days = Periods::length($order);
        $out = [];

        foreach (Addons::forPackage($order->package) as $addon) {
            $held = Addons::held($order, (int) $addon->id);

            if ($held >= max(1, (int) $addon->max)) {
                continue;
            }

            $full = (int) $addon->price;
            $now = $addon->recurring() ? Money::share($full, $left, $days) : $full;

            $out[] = [
                'id' => (int) $addon->id,
                'name' => (string) $addon->name,
                'description' => (string) ($addon->description ?? ''),
                'now' => $now > 0 ? Money::format($now, $currency) : null,
                'then' => $addon->recurring()
                    ? Theme::trans('addons.then', ['amount' => Money::format($full, $currency)])
                    : Theme::trans('addons.once_only', ['amount' => Money::format($full, $currency)]),
            ];
        }

        return $out;
    }

    /**
     * The three numbers somebody compares, from the order's own snapshot.
     *
     * @param  array<string, mixed>  $spec
     * @return array<int, string>
     */
    public static function specs(array $spec): array
    {
        return [
            Theme::trans('shop.spec_memory', ['amount' => (int) ($spec['memory'] ?? 0)]),
            Theme::trans('shop.spec_disk', ['amount' => (int) ($spec['disk'] ?? 0)]),
            Theme::trans('shop.spec_cpu', ['amount' => (int) ($spec['cpu'] ?? 0)]),
        ];
    }

    /** The name of a change already agreed, or null. */
    public static function pending(Order $order): ?string
    {
        $row = Upgrades::waiting($order);

        return $row === null ? null : (string) ($row->to?->name ?? '');
    }

    /**
     * A change that was paid for and then refused.
     *
     * Read by the administrator's page since upgrades existed, and by nobody on
     * the customer's side - so somebody whose upgrade was taken, charged and
     * then refused by the daemon saw a service that had simply not changed, and
     * no sentence anywhere saying why.
     *
     * @return array{name: string, invoice: ?int}|null
     */
    public static function stuck(Order $order): ?array
    {
        $row = Upgrades::stuck($order);

        if ($row === null) {
            return null;
        }

        return [
            'name' => (string) ($row->to?->name ?? ''),
            'invoice' => $row->invoice_id === null ? null : (int) $row->invoice_id,
        ];
    }
}
