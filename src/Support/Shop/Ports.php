<?php

namespace LegendDevelopment\Theme\Support\Shop;

use App\Models\Allocation;
use App\Models\Node;
use App\Services\Allocations\AssignmentService;
use LegendDevelopment\Theme\Models\Package;
use Throwable;

/**
 * Which ports a bought server is allowed to land on.
 *
 * Without this, `Provision::allocation()` takes the first free allocation on a
 * node in port order, which is the right default and is no help at all to
 * somebody who wants Minecraft on 5000 to 5100 and ARK on 6000 to 6100.
 *
 * **The range lives on the package**, which is the thing being sold and the
 * thing an administrator is already editing when they think about this. It was
 * a list in the shop settings for one release, with packages pointing at
 * entries by name, and that was one indirection too many: two screens to set up
 * one number, and a package whose range was defined somewhere the person
 * editing it could not see.
 *
 * A package with no range behaves exactly as it did, which is what makes this
 * safe on a panel that has been selling for months.
 *
 * **Saving a range makes the ports.** It did not for one release, and a range
 * that only narrows is a range over ports nobody has created: it finds nothing,
 * and a purchase that finds nothing is paid for and then refused. So make()
 * hands the missing ports to Pelican's own AssignmentService, which is the same
 * road the node page walks when somebody types 5000-5100 into it by hand.
 *
 * **It makes and never unmakes.** Narrowing a range, or clearing it, leaves
 * every allocation where it is. Some of them have servers on them, Pelican
 * refuses to delete those anyway, and the ones without are free ports on a node
 * - which is a thing nobody was ever harmed by having.
 *
 * The warning stays, because making the ports is not the same as having them
 * free: a range fills up as it sells, and running out quietly is still the
 * failure mode this feature adds.
 */
class Ports
{
    /**
     * The lowest and highest a port may be.
     *
     * One port is a legitimate range - a panel with a single reserved port for
     * one game is a real thing - so the floor is on the numbers rather than on
     * the width.
     */
    public const LOWEST = 1024;

    public const HIGHEST = 65535;

    /** How many free ports left before the watchdog says something. */
    public const WARN_AT = 5;

    /*
     * The widest range that may be made in one go.
     *
     * Pelican's own number, from AssignmentService, and named here rather than
     * reached for so the form can say what the limit is before somebody runs
     * into it. A thousand ports is already more than any one game needs, and
     * the reason the limit exists is that each one is a row.
     */
    public const MOST = 1000;

    /** @var array<string, array{free: int, total: int}|null> */
    private static array $counted = [];

    /**
     * Let go of what was counted.
     *
     * A queue worker lives for hours and would otherwise answer a watchdog pass
     * with what it counted on the pass before.
     */
    public static function forget(): void
    {
        self::$counted = [];
    }

    /**
     * The range this package sells into, or null where it has none.
     *
     * Both ends or neither. A package with one number filled in is a package
     * somebody started setting up and did not finish, and guessing the other
     * end would be this class deciding something nobody asked it to decide.
     *
     * @return array{from: int, to: int}|null
     */
    public static function of(?int $from, ?int $to): ?array
    {
        $from = (int) $from;
        $to = (int) $to;

        if ($from <= 0 || $to <= 0) {
            return null;
        }

        // Typed the wrong way round is a thing people do, and refusing it
        // teaches nothing that swapping it does not.
        if ($from > $to) {
            [$from, $to] = [$to, $from];
        }

        if ($from < self::LOWEST || $to > self::HIGHEST) {
            return null;
        }

        return ['from' => $from, 'to' => $to];
    }

    /**
     * The same, read off a package.
     *
     * @return array{from: int, to: int}|null
     */
    public static function forPackage(Package $package): ?array
    {
        return self::of($package->port_from, $package->port_to);
    }

    /**
     * What a purchase should use, from the snapshot the order carries.
     *
     * @param  array<string, mixed>  $spec
     * @return array{from: int, to: int}|null
     */
    public static function forSpec(array $spec): ?array
    {
        return self::of(
            isset($spec['port_from']) ? (int) $spec['port_from'] : null,
            isset($spec['port_to']) ? (int) $spec['port_to'] : null,
        );
    }

    /**
     * How many allocations inside a range are free, and how many there are.
     *
     * Counted across every node unless one is named, because a port number is
     * only unique per node: two machines both having 5000 free is two ports,
     * not one. A package lists the nodes it may land on, so the honest count
     * for a package is over those.
     *
     * @param  array{from: int, to: int}  $range
     * @param  array<int, int>  $nodes  Empty for every node.
     * @return array{free: int, total: int}|null  null where the count could not be taken
     */
    public static function count(array $range, array $nodes = []): ?array
    {
        /*
         * Held for the request, because one cell asks three times.
         *
         * A table column formats, describes and colours itself from separate
         * closures, and each of them wants the same number. Two queries a call
         * over five packages is twenty queries for five answers, which is the
         * shape of thing this plugin went looking for and fixed elsewhere in
         * Pelican; adding a new one while doing so would be poor form.
         *
         * Per request and not longer. An allocation freed by a cancellation
         * five seconds ago should show as free on the next page, not on the
         * next hour.
         */
        sort($nodes);

        $key = $range['from'] . '-' . $range['to'] . ':' . implode(',', $nodes);

        if (array_key_exists($key, self::$counted)) {
            return self::$counted[$key];
        }

        try {
            $base = Allocation::query()
                ->where('port', '>=', $range['from'])
                ->where('port', '<=', $range['to']);

            if ($nodes !== []) {
                $base->whereIn('node_id', $nodes);
            }

            return self::$counted[$key] = [
                'free' => (clone $base)->whereNull('server_id')->count(),
                'total' => $base->count(),
            ];
        } catch (Throwable) {
            return self::$counted[$key] = null;
        }
    }

    /**
     * Every package that has a range, with how its ports are doing.
     *
     * The overview on the shop settings page and the watchdog both ask this, so
     * the two cannot disagree about what is nearly empty.
     *
     * **Null is not the same as empty.** A shop where nobody has set a range
     * answers with an empty list; a database that would not answer says so, and
     * the difference matters to the one caller that acts on it. The watchdog
     * keeps a row per package and takes away the rows for packages that are no
     * longer short of anything - so reading a refused query as "nothing to
     * report" would clear every standing warning and raise them all again on
     * the next pass that worked.
     *
     * @return array<int, array{id: int, name: string, from: int, to: int, free: int, total: int, low: bool}>|null
     */
    public static function overview(): ?array
    {
        try {
            $packages = Package::query()->orderBy('sort')->orderBy('name')->get();
        } catch (Throwable) {
            return null;
        }

        $out = [];

        foreach ($packages as $package) {
            $range = self::forPackage($package);

            if ($range === null) {
                continue;
            }

            $nodes = is_array($package->node_ids) ? array_map('intval', $package->node_ids) : [];
            $count = self::count($range, $nodes);

            // Half an overview is not an overview. One package that could not
            // be counted means the answer for the rest is from the same
            // database in the same state, and guessing which half to trust is
            // how a warning goes missing.
            if ($count === null) {
                return null;
            }

            $out[] = [
                'id' => (int) $package->id,
                'name' => (string) $package->name,
                'from' => $range['from'],
                'to' => $range['to'],
                'free' => $count['free'],
                'total' => $count['total'],
                'low' => $count['free'] <= self::WARN_AT,
            ];
        }

        return $out;
    }

    /**
     * Make the ports of this package's range, on the nodes it may use.
     *
     * Pelican's AssignmentService does the writing: it is what the node page
     * uses, it validates every row through the model, and reaching around it to
     * insert rows directly is how a plugin ends up with allocations the panel
     * does not agree with.
     *
     * **One IP per node, and the one already carrying the most ports.** A node
     * can answer with several - its own plus 0.0.0.0 and :: which Pelican adds
     * to every list - and making the range on each of them multiplies the rows
     * by something nobody asked for. The IP the node is already serving on is
     * the one a new port should join.
     *
     * Ports that exist are left alone rather than attempted, because the
     * service creates row by row and a duplicate would stop it halfway with a
     * transaction still open.
     *
     * @return array{made: int, existed: int, nodes: array<int, string>, refused: ?string}
     */
    public static function make(Package $package): array
    {
        $out = ['made' => 0, 'existed' => 0, 'nodes' => [], 'refused' => null];

        $range = self::forPackage($package);

        if ($range === null) {
            return $out;
        }

        $width = $range['to'] - $range['from'] + 1;

        if ($width > self::MOST) {
            $out['refused'] = 'wide';

            return $out;
        }

        try {
            $nodes = self::nodesFor($package);
        } catch (Throwable) {
            $out['refused'] = 'unreadable';

            return $out;
        }

        if ($nodes === []) {
            $out['refused'] = 'no-nodes';

            return $out;
        }

        $service = app(AssignmentService::class);

        foreach ($nodes as $node) {
            $ip = self::addressOf($node);

            if ($ip === null) {
                $out['nodes'][(int) $node->id] = 'no-ip';

                continue;
            }

            try {
                $have = Allocation::query()
                    ->where('node_id', $node->id)
                    ->where('ip', $ip)
                    ->whereBetween('port', [$range['from'], $range['to']])
                    ->pluck('port')
                    ->map(static fn (mixed $port): int => (int) $port)
                    ->all();
            } catch (Throwable) {
                $out['nodes'][(int) $node->id] = 'unreadable';

                continue;
            }

            $wanted = array_values(array_diff(range($range['from'], $range['to']), $have));

            $out['existed'] += count($have);

            if ($wanted === []) {
                $out['nodes'][(int) $node->id] = 'complete';

                continue;
            }

            try {
                $service->handle($node, [
                    'allocation_ip' => $ip,
                    'allocation_ports' => array_map(strval(...), $wanted),
                ]);

                $out['made'] += count($wanted);
                $out['nodes'][(int) $node->id] = 'made';
            } catch (Throwable) {
                $out['nodes'][(int) $node->id] = 'failed';
            }
        }

        self::forget();

        return $out;
    }

    /**
     * The nodes this package may land on, or every node where it says none.
     *
     * The same reading Provision does when it goes looking for an allocation,
     * because a port made somewhere a purchase will never look is a port that
     * helps nobody.
     *
     * @return array<int, Node>
     */
    private static function nodesFor(Package $package): array
    {
        $wanted = is_array($package->node_ids) ? array_map('intval', $package->node_ids) : [];

        $query = Node::query()->orderBy('id');

        if ($wanted !== []) {
            $query->whereIn('id', $wanted);
        }

        return $query->get()->all();
    }

    /**
     * The address a new port on this node should be made on.
     *
     * What the node is already serving, preferred over what it says it could
     * serve: the allocations table is the panel's own answer and needs nobody
     * awake to give it. Only when a node has none at all is the daemon asked,
     * and 0.0.0.0 and :: are dropped from what it says - Pelican appends both
     * to every list, and neither is an address a customer connects to.
     */
    private static function addressOf(Node $node): ?string
    {
        try {
            $busiest = Allocation::query()
                ->where('node_id', $node->id)
                ->selectRaw('ip, COUNT(*) as held')
                ->groupBy('ip')
                ->orderByDesc('held')
                ->value('ip');

            if (is_string($busiest) && $busiest !== '') {
                return $busiest;
            }

            foreach ($node->ipAddresses() as $ip) {
                if (is_string($ip) && !in_array($ip, ['0.0.0.0', '::'], true)) {
                    return $ip;
                }
            }
        } catch (Throwable) {
            return null;
        }

        return null;
    }

    /**
     * One end of a range, as it should be stored.
     *
     * Null rather than zero for "not set", because the column is nullable and a
     * zero would be a port number that cannot exist pretending to be one.
     */
    public static function sanitise(mixed $value): ?int
    {
        $port = (int) $value;

        return $port >= self::LOWEST && $port <= self::HIGHEST ? $port : null;
    }
}
