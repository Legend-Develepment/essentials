<?php

namespace LegendDevelopment\Theme\Filament\Admin\Widgets;

use Filament\Widgets\Widget;
use LegendDevelopment\Theme\Support\NodeHealth as Health;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * The machines, on the dashboard: cpu, memory, disk and load for every node.
 *
 * Every figure is Pelican's own, from the daemon on the node - see
 * Support\NodeHealth for why that source rather than the panel's own host.
 *
 * Lazy, and that is the one thing here that is not optional. Pelican serves
 * these statistics from a five-second cache and refreshes them behind the
 * request, but a cold cache is one call per node with a one-second timeout, and
 * this is the page the whole panel opens on.
 */
class NodeHealth extends Widget
{
    protected string $view = 'legend-development-theme::widgets.node-health';

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = -1;

    public static function canView(): bool
    {
        try {
            // Nothing to show on a panel with no nodes - and Pelican already
            // has a widget that says so, better than this one would.
            return (user()?->can('viewAny', \App\Models\Node::class) ?? false)
                && \App\Models\Node::query()->exists();
        } catch (Throwable) {
            return false;
        }
    }

    public function getViewData(): array
    {
        $nodes = [];

        try {
            foreach (Health::nodes() as $node) {
                $memory = Health::percent($node['memory_used'], $node['memory_total']);
                $disk = Health::percent($node['disk_used'], $node['disk_total']);

                $nodes[] = $node + [
                    'memory_percent' => $memory,
                    'memory_level' => Health::level($memory),
                    'memory_label' => Health::bytes($node['memory_used'])
                        . ' / ' . Health::bytes($node['memory_total']),
                    'disk_percent' => $disk,
                    'disk_level' => Health::level($disk),
                    'disk_label' => Health::bytes($node['disk_used'])
                        . ' / ' . Health::bytes($node['disk_total']),
                    'cpu_level' => Health::level($node['cpu']),
                ];
            }
        } catch (Throwable) {
            $nodes = [];
        }

        return [
            'nodes' => $nodes,
            'title' => Theme::trans('nodes.title'),
            'offline' => Theme::trans('nodes.offline'),
            'maintenance' => Theme::trans('nodes.maintenance'),
            'cpu' => Theme::trans('nodes.cpu'),
            'memory' => Theme::trans('nodes.memory'),
            'disk' => Theme::trans('nodes.disk'),
            'load' => Theme::trans('nodes.load'),
        ];
    }
}
