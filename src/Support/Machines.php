<?php

namespace LegendDevelopment\Theme\Support;

use App\Models\Node;
use Throwable;

/**
 * The machines, as rows: the host the panel is on, then every node.
 *
 * Two sources, on purpose. The node rows are Pelican's own figures, from the
 * daemon on each node. The first row is the panel's own host, read from /proc -
 * see SystemStatus for why that is a different question. On a single-box
 * install the two agree; on any install with a separate node they do not, and
 * the machine you are reading the dashboard on is worth a line whether or not
 * it happens to run servers.
 *
 * Here rather than in the widget because the widget's job is to draw, and this
 * is two data sources, a permission check and a pile of arithmetic.
 */
class Machines
{
    /**
     * @return array<int, array<string, mixed>>
     */
    public static function rows(): array
    {
        $rows = [];

        $panel = self::panel();

        if ($panel !== null) {
            $rows[] = $panel;
        }

        try {
            // The panel row needs no node and no node permission. Nodes are
            // asked for separately, so somebody who may not see them gets the
            // panel row rather than an empty block.
            if (user()?->can('viewAny', Node::class) ?? false) {
                foreach (NodeHealth::nodes() as $node) {
                    $rows[] = $node;
                }
            }
        } catch (Throwable) {
            // Whatever was gathered before it failed is still worth drawing.
        }

        return array_map(self::dress(...), $rows);
    }

    /**
     * The machine the panel itself is on.
     *
     * @return array<string, mixed>|null
     */
    private static function panel(): ?array
    {
        try {
            $memory = SystemStatus::memory();

            // No memory reading is a host that will not be read at all, and a
            // row of dashes helps nobody.
            if ($memory === null) {
                return null;
            }

            $disk = self::panelDisk();
            $load = SystemStatus::load();

            return [
                'name' => Theme::trans('nodes.panel'),
                'maintenance' => false,
                'reachable' => true,
                'cpu' => SystemStatus::cpu(),
                'memory_used' => $memory['used'],
                'memory_total' => $memory['total'],
                'disk_used' => $disk['used'],
                'disk_total' => $disk['total'],
                'load' => $load[0] ?? null,
            ];
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * @return array<string, int>
     */
    private static function panelDisk(): array
    {
        $disks = SystemStatus::disks();

        foreach ($disks as $disk) {
            // The one the panel is on. It is the one that fills up when backups
            // and server files do, and on a host with several it is the only
            // one worth a single line.
            if ($disk['panel']) {
                return $disk;
            }
        }

        // Failing that the largest, which is what disks() sorts to the front.
        return $disks[0] ?? ['used' => 0, 'total' => 0];
    }

    /**
     * One row, with the percentages and the words worked out.
     *
     * @param  array<string, mixed>  $row
     * @return array<string, mixed>
     */
    private static function dress(array $row): array
    {
        $memory = NodeHealth::percent($row['memory_used'], $row['memory_total']);
        $disk = NodeHealth::percent($row['disk_used'], $row['disk_total']);

        return $row + [
            'memory_percent' => $memory,
            'memory_level' => NodeHealth::level($memory),
            'memory_label' => NodeHealth::bytes($row['memory_used'])
                . ' / ' . NodeHealth::bytes($row['memory_total']),
            'disk_percent' => $disk,
            'disk_level' => NodeHealth::level($disk),
            'disk_label' => NodeHealth::bytes($row['disk_used'])
                . ' / ' . NodeHealth::bytes($row['disk_total']),
            'cpu_level' => NodeHealth::level($row['cpu']),
            // A processor reading can honestly be missing - one look at
            // /proc/stat has nothing to compare against - and "%" on its own is
            // not a figure.
            'cpu_label' => $row['cpu'] === null ? '—' : $row['cpu'] . '%',
        ];
    }
}
