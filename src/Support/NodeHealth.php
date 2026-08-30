<?php

namespace LegendDevelopment\Theme\Support;

use App\Models\Node;
use Throwable;

/**
 * How the machines are doing, for the dashboard.
 *
 * Pelican already collects every figure here - Node::statistics() returns the
 * cpu, the memory, the swap, the disk and the load averages, and
 * systemInformation() the operating system and the kernel. Both come from the
 * daemon on the node itself, both are already cached, and neither needs a shell
 * command or a readable /proc.
 *
 * That matters more than it sounds. Reading the panel's own host tells you about
 * the machine the web interface runs on, which on any install with a separate
 * node is not the machine anybody's server is running on. This asks the nodes.
 *
 * What is added here is only that it is on the dashboard: Pelican shows these
 * numbers on a node's own page, and the question "is everything alright" is one
 * you have before you pick a node to look at.
 */
class NodeHealth
{
    /**
     * A ceiling. Every node is a row and, on a cold cache, a request; a panel
     * with sixty of them does not want all sixty on the front page.
     */
    private const MAX_NODES = 12;

    /**
     * @return array<int, array<string, mixed>>
     */
    public static function nodes(): array
    {
        try {
            $nodes = Node::query()->orderBy('name')->limit(self::MAX_NODES)->get();
        } catch (Throwable) {
            // No database answer is no block, not a broken dashboard.
            return [];
        }

        $rows = [];

        foreach ($nodes as $node) {
            $rows[] = self::read($node);
        }

        return $rows;
    }

    /**
     * @return array<string, mixed>
     */
    private static function read(Node $node): array
    {
        $row = [
            'name' => (string) $node->name,
            'maintenance' => false,
            'reachable' => false,
            'cpu' => null,
            'memory_used' => 0,
            'memory_total' => 0,
            'disk_used' => 0,
            'disk_total' => 0,
            'load' => null,
        ];

        try {
            $row['maintenance'] = (bool) $node->isUnderMaintenance();
        } catch (Throwable) {
            // Left as it was: a node whose state cannot be read is not
            // announced as being in maintenance.
        }

        try {
            $stats = $node->statistics();

            /*
             * Pelican hands back a zeroed set when the daemon does not answer,
             * so "unreachable" has to be inferred rather than asked for. Total
             * memory is the tell: a machine that answers always has some, and
             * one that does not answer reports none.
             */
            $row['memory_total'] = (int) ($stats['memory_total'] ?? 0);
            $row['reachable'] = $row['memory_total'] > 0;

            if ($row['reachable']) {
                $row['memory_used'] = (int) ($stats['memory_used'] ?? 0);
                $row['disk_total'] = (int) ($stats['disk_total'] ?? 0);
                $row['disk_used'] = (int) ($stats['disk_used'] ?? 0);
                $row['cpu'] = round((float) ($stats['cpu_percent'] ?? 0), 1);
                $row['load'] = round((float) ($stats['load_average1'] ?? 0), 2);
            }
        } catch (Throwable) {
            // Unreachable, which is exactly what the row now says.
        }

        return $row;
    }

    /**
     * A figure as a percentage of its total, or null when there is no total to
     * be a fraction of.
     */
    public static function percent(int $used, int $total): ?float
    {
        if ($total <= 0) {
            return null;
        }

        return round(min(100, max(0, $used / $total * 100)), 1);
    }

    /**
     * Green, amber or red - on the same two thresholds the server cards' meters
     * use, so a number that is red here is red there.
     */
    public static function level(?float $percent): string
    {
        if ($percent === null) {
            return 'unknown';
        }

        if ($percent >= Bars::danger()) {
            return 'danger';
        }

        return $percent >= Bars::warning() ? 'warning' : 'ok';
    }

    /**
     * Bytes, said the way a person would. Pelican's own figures are bytes and
     * a dashboard is not the place to read nine digits.
     */
    public static function bytes(int $bytes): string
    {
        if ($bytes <= 0) {
            return '—';
        }

        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];
        $power = min((int) floor(log($bytes, 1024)), count($units) - 1);
        $value = $bytes / (1024 ** $power);

        return round($value, $value < 10 && $power > 0 ? 1 : 0) . ' ' . $units[$power];
    }
}
