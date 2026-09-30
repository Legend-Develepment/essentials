<?php

namespace LegendDevelopment\Theme\Support\Shop;

use App\Models\Allocation;
use App\Models\Server;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Models\Package;
use Throwable;

/**
 * The name a customer connects to, instead of the node's address.
 *
 * Pelican already has the place for this: every allocation carries an
 * `ip_alias`, and wherever the panel shows an address - the server list, the
 * console header, the network tab - it shows the alias when there is one and
 * the IP when there is not. So a package that says `mc.example.com` puts that
 * on the allocation its server was built on, and the customer reads
 * `mc.example.com:25565` everywhere without a line of Pelican being changed.
 *
 * Nothing here touches DNS. The name has to point at the node already; the
 * package form says so, because a name that resolves nowhere is worse than the
 * number it replaced.
 *
 * **And it is taken off again.** Pelican's own deletion frees the allocation
 * and clears its notes, but leaves the alias - so without release() the next
 * server to land on that port, from another package or built by hand, would
 * show this package's name. The alias the allocation had before is kept on the
 * order and put back, and only when the allocation still says what this set:
 * an administrator who changed it since has said something newer.
 */
final class Hostnames
{
    /** The longest name DNS allows. */
    private const MAX = 253;

    /**
     * A hostname, or null for anything that is not one.
     *
     * Forgiving about what gets pasted - a scheme, a trailing slash, a port, a
     * trailing dot, capitals - and strict about what is kept: labels of letters,
     * digits and hyphens, at least two of them. An IP address is refused as
     * well, because that is what this exists to hide.
     */
    public static function sanitise(mixed $value): ?string
    {
        if (!is_string($value)) {
            return null;
        }

        $name = strtolower(trim($value));
        $name = (string) preg_replace('#^[a-z][a-z0-9+.-]*://#', '', $name);
        $name = explode('/', $name, 2)[0];
        $name = (string) preg_replace('/:\d+$/', '', $name);
        $name = rtrim($name, '.');

        if ($name === '' || strlen($name) > self::MAX || filter_var($name, FILTER_VALIDATE_IP) !== false) {
            return null;
        }

        $label = '[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?';

        return preg_match('/^' . $label . '(?:\.' . $label . ')+$/D', $name) === 1 ? $name : null;
    }

    /**
     * Put the package's name on the allocation a new server was built on.
     *
     * The package as it is now, and the order's snapshot only where the package
     * is gone - the same rule the port range follows, and for the same reason:
     * this is where the thing is reached rather than what was bought, so a
     * package whose name is corrected should build on the corrected one.
     *
     * A failure is reported and nothing else: the server exists and works, and
     * shows its IP, which is exactly what it did before this was set.
     */
    public static function apply(Order $order, Server $server): void
    {
        try {
            $name = self::wanted($order);

            if ($name === null) {
                return;
            }

            $allocation = Allocation::query()->find((int) $server->allocation_id);

            if (!$allocation instanceof Allocation) {
                return;
            }

            $order->forceFill([
                'hostname' => $name,
                'hostname_was' => $allocation->ip_alias,
            ])->save();

            $allocation->forceFill(['ip_alias' => $name])->save();
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    /**
     * Give the allocation back its own alias as a server goes.
     *
     * Hooked on Pelican's Server model rather than on the shop's own removal,
     * so a server an administrator deletes from Pelican's list is let go the
     * same way as one the shop cancels. Before the tables exist there is no
     * order to ask, and a panel that never sold anything is most panels.
     */
    public static function release(Server $server): void
    {
        try {
            if (!Tables::ready()) {
                return;
            }

            $order = Order::query()->where('server_id', (int) $server->id)->first();

            if (!$order instanceof Order || !is_string($order->hostname) || $order->hostname === '') {
                return;
            }

            $allocation = Allocation::query()->find((int) $server->allocation_id);

            if ($allocation instanceof Allocation && $allocation->ip_alias === $order->hostname) {
                $allocation->forceFill(['ip_alias' => $order->hostname_was])->save();
            }
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    /** The name this order's server should carry, if its package gives one. */
    private static function wanted(Order $order): ?string
    {
        $package = Package::query()->find((int) ($order->package_id ?? 0));

        if ($package instanceof Package) {
            return self::sanitise($package->hostname);
        }

        $spec = is_array($order->spec) ? $order->spec : [];

        return self::sanitise($spec['hostname'] ?? null);
    }
}
