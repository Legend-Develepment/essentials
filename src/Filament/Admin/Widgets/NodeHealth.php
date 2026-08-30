<?php

namespace LegendDevelopment\Theme\Filament\Admin\Widgets;

use App\Models\Node;
use Filament\Widgets\Widget;
use LegendDevelopment\Theme\Support\NodeHealth as Health;
use LegendDevelopment\Theme\Support\SystemStatus;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * The machines, on the dashboard: cpu, memory, disk and load for the panel host
 * and for every node.
 *
 * Two sources, on purpose. The node rows are Pelican's own figures, from the
 * daemon on each node. The first row is the panel's own host, read from /proc.
 * On a single-box install the two agree; on any install with a separate node
 * they do not, and the machine you are reading this on is worth a line whether
 * or not it happens to run servers.
 *
 * Lazy, and that is the one thing here that is not optional. Pelican serves the
 * node statistics from a five-second cache and refreshes them behind the
 * request, but a cold cache is one call per node with a one-second timeout, and
 * this is the page the whole panel opens on.
 */
class NodeHealth extends Widget
{
    protected string $view = 'legend-development-theme::widgets.node-health';

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = -1;

    /**
     * The plugin's own permission, not the node one.
     *
     * The block is the plugin's and its first row is the panel host, which
     * needs no node to exist and no node permission to read. Nodes are gated
     * separately, in the row-building, so somebody who may not see nodes gets
     * the panel row and nothing else rather than an empty dashboard.
     */
    public static function canView(): bool
    {
        try {
            return user()?->can(Theme::PERMISSION_VIEW) ?? false;
        } catch (Throwable) {
            return false;
        }
    }

    public function getViewData(): array
    {
        $rows = [];

        $panel = $this->panelRow();

        if ($panel !== null) {
            $rows[] = $panel;
        }

        try {
            if (user()?->can('viewAny', Node::class) ?? false) {
                foreach (Health::nodes() as $node) {
                    $rows[] = $node;
                }
            }
        } catch (Throwable) {
            // No nodes read is the panel row on its own, not a broken
            // dashboard.
        }

        return [
            'nodes' => array_map(fn (array $row): array => $this->dress($row), $rows),
            // Named after the plugin, the same way its sidebar group is: this
            // block is the plugin talking, and it should say so.
            'title' => Theme::name(),
            'offline' => Theme::trans('nodes.offline'),
            'maintenance' => Theme::trans('nodes.maintenance'),
            'cpu' => Theme::trans('nodes.cpu'),
            'memory' => Theme::trans('nodes.memory'),
            'disk' => Theme::trans('nodes.disk'),
            'load' => Theme::trans('nodes.load'),
        ];
    }

    /**
     * The machine the panel itself is on, as a row like any other.
     *
     * Read from /proc rather than asked of a daemon - see Support\SystemStatus
     * for why that is a different question from the rows under it. On a
     * single-box install the two agree; anywhere else they do not, and the one
     * you are reading this on is worth a line of its own.
     *
     * @return array<string, mixed>|null
     */
    private function panelRow(): ?array
    {
        try {
            $memory = SystemStatus::memory();

            // No memory reading is a host that will not be read at all, and a
            // row of dashes helps nobody.
            if ($memory === null) {
                return null;
            }

            $disks = SystemStatus::disks();
            $disk = null;

            foreach ($disks as $candidate) {
                // The one the panel is on, or failing that the largest, which
                // is what disks() sorts to the front.
                if ($candidate['panel']) {
                    $disk = $candidate;

                    break;
                }
            }

            $disk ??= $disks[0] ?? ['used' => 0, 'total' => 0];
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
     * One row, with the percentages and the words worked out.
     *
     * @param  array<string, mixed>  $row
     * @return array<string, mixed>
     */
    private function dress(array $row): array
    {
        $memory = Health::percent($row['memory_used'], $row['memory_total']);
        $disk = Health::percent($row['disk_used'], $row['disk_total']);

        return $row + [
            'memory_percent' => $memory,
            'memory_level' => Health::level($memory),
            'memory_label' => Health::bytes($row['memory_used'])
                . ' / ' . Health::bytes($row['memory_total']),
            'disk_percent' => $disk,
            'disk_level' => Health::level($disk),
            'disk_label' => Health::bytes($row['disk_used'])
                . ' / ' . Health::bytes($row['disk_total']),
            'cpu_level' => Health::level($row['cpu']),
            // A processor reading can honestly be missing - one look at
            // /proc/stat has nothing to compare against - and "%" on its own is
            // not a figure.
            'cpu_label' => $row['cpu'] === null ? '—' : $row['cpu'] . '%',
        ];
    }
}
