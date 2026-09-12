<?php

namespace LegendDevelopment\Theme\Support;

use App\Models\Node;
use App\Models\Server;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

/**
 * What has been promised on each node, against what the node has.
 *
 * The question is whether another server fits, and nothing answers it today.
 * Pelican's node list shows a name, an address and a count of servers. The
 * dashboard block this plugin already draws shows something that sounds the
 * same and is not: **live host usage**, read from the daemon. A node can be
 * twenty percent used and completely full, because full is about what has been
 * handed out rather than about what is running.
 *
 * **Pelican's own arithmetic, not a version of it.** Node::isViable() is the
 * method that decides whether a server may be created, and the figures here are
 * the same three lines it uses:
 *
 *     limit = capacity * (1 + overallocate / 100)
 *     used  = the sum of what every server on it was promised
 *
 * Including its two conventions, which are easy to get wrong and would make
 * this page quietly disagree with the panel: a capacity of zero means
 * unlimited, and an overallocation below zero means unlimited too. Neither is
 * a percentage of anything, so neither gets a bar.
 */
class Capacity
{
    /** Past this, a node is worth looking at before somebody tries to fill it. */
    public const TIGHT = 90;

    public const WARM = 75;

    /** @var array<int, int>|null */
    private static ?array $atLimit = null;

    public static function enabled(): bool
    {
        return Features::enabled(Features::CAPACITY);
    }

    public static function forget(): void
    {
        self::$atLimit = null;
    }

    /**
     * The nodes this person can reach, with what is promised on each.
     *
     * withSum produces exactly the columns Pelican's own isViable() reads -
     * servers_sum_memory and the rest - so the two cannot drift apart by
     * counting different things.
     *
     * @return Builder<Node>
     */
    public static function query(): Builder
    {
        $ids = [];

        try {
            $ids = user()?->accessibleNodes()->pluck('nodes.id')->all() ?? [];
        } catch (Throwable) {
            // No list is an empty page rather than every node on the panel.
        }

        return Node::query()
            ->whereIn('nodes.id', $ids)
            ->withCount('servers')
            ->withSum('servers as ld_memory', 'memory')
            ->withSum('servers as ld_disk', 'disk')
            ->withSum('servers as ld_cpu', 'cpu');
    }

    /**
     * How full one resource is, as a percentage, or null for unlimited.
     *
     * Null rather than zero or a hundred, and that distinction is the whole
     * reason this returns what it does: a node with no memory limit is not
     * empty and is not full, it has no answer - and drawing it as an empty bar
     * would say there is room in a way that happens to be true and for the
     * wrong reason.
     */
    public static function percent(mixed $capacity, mixed $overallocate, mixed $used): ?int
    {
        $capacity = (int) $capacity;
        $overallocate = (float) $overallocate;

        // Pelican's own two conventions. isViable() skips the check when either
        // is true, which is to say the node is unlimited in that resource.
        if ($capacity <= 0 || $overallocate < 0) {
            return null;
        }

        $limit = $capacity * (1 + $overallocate / 100);

        if ($limit <= 0) {
            return null;
        }

        return (int) round(max(0, (int) $used) / $limit * 100);
    }

    /**
     * What a node may hand out in one resource, overallocation included.
     *
     * Null for unlimited, on the same rule as percent().
     */
    public static function limit(mixed $capacity, mixed $overallocate): ?int
    {
        $capacity = (int) $capacity;
        $overallocate = (float) $overallocate;

        if ($capacity <= 0 || $overallocate < 0) {
            return null;
        }

        return (int) round($capacity * (1 + $overallocate / 100));
    }

    /**
     * The worst of a node's three resources, which is what fills it.
     *
     * A node with memory to spare and no disk left is a full node - isViable()
     * refuses on any one of the three - so the row is coloured by the tightest
     * rather than by an average that would read as comfortable.
     */
    public static function worst(Node $node): ?int
    {
        $each = [
            self::percent($node->memory, $node->memory_overallocate, $node->ld_memory ?? 0),
            self::percent($node->disk, $node->disk_overallocate, $node->ld_disk ?? 0),
            self::percent($node->cpu, $node->cpu_overallocate, $node->ld_cpu ?? 0),
        ];

        $known = array_filter($each, static fn (?int $value): bool => $value !== null);

        return $known === [] ? null : max($known);
    }

    public static function colour(?int $percent): string
    {
        return match (true) {
            $percent === null => 'gray',
            $percent >= self::TIGHT => 'danger',
            $percent >= self::WARM => 'warning',
            default => 'success',
        };
    }

    /**
     * Megabytes as something readable.
     *
     * Pelican stores memory and disk in MiB, so this starts a step up from the
     * usual byte formatter rather than dividing by 1024 twice for nothing.
     */
    public static function size(?int $mib): string
    {
        if ($mib === null) {
            return '-';
        }

        if ($mib < 1024) {
            return $mib . ' MiB';
        }

        $gib = $mib / 1024;

        return ($gib < 10 ? round($gib, 1) : round($gib)) . ' GiB';
    }

    /**
     * How many servers on each node have reached a limit of their own.
     *
     * Backups, databases and allocations: the three that are counted rather
     * than measured, and therefore the three where the panel can say for
     * certain that the next one will be refused. A server's memory and disk are
     * limits too, but how much of them is being used is a question for the
     * daemon rather than for this table.
     *
     * One query for the lot, keyed by node, because the alternative is a
     * subquery per server on a page that already lists every node.
     *
     * @return array<int, int>
     */
    public static function atLimit(): array
    {
        if (self::$atLimit !== null) {
            return self::$atLimit;
        }

        self::$atLimit = [];

        try {
            foreach (
                Server::query()
                    ->select(['id', 'node_id', 'backup_limit', 'database_limit', 'allocation_limit'])
                    ->withCount(['backups', 'databases', 'allocations'])
                    ->get() as $server
            ) {
                if (!self::full($server)) {
                    continue;
                }

                $node = (int) $server->node_id;
                self::$atLimit[$node] = (self::$atLimit[$node] ?? 0) + 1;
            }
        } catch (Throwable) {
            // A count that cannot be read is a column of dashes, not a page
            // that will not draw.
            return self::$atLimit = [];
        }

        return self::$atLimit;
    }

    /**
     * Whether one server has run out of something it is allowed to make.
     *
     * A limit of zero is Pelican's "none allowed", and a server allowed none
     * has not run out - it was never going to be able to. Only a limit above
     * zero that has been reached is a server whose next request fails.
     */
    public static function full(Server $server): bool
    {
        $pairs = [
            [(int) ($server->backup_limit ?? 0), (int) ($server->backups_count ?? 0)],
            [(int) ($server->database_limit ?? 0), (int) ($server->databases_count ?? 0)],
            [(int) ($server->allocation_limit ?? 0), (int) ($server->allocations_count ?? 0)],
        ];

        foreach ($pairs as [$limit, $count]) {
            if ($limit > 0 && $count >= $limit) {
                return true;
            }
        }

        return false;
    }
}
