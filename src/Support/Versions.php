<?php

namespace LegendDevelopment\Theme\Support;

use App\Services\Helpers\SoftwareVersionService;
use Throwable;

/**
 * What the panel and the nodes are running, and whether that is the latest.
 *
 * All of it is Pelican's own: SoftwareVersionService already asks GitHub for the
 * latest panel and Wings releases, already caches the answer for an hour, and
 * already returns the string 'error' rather than throwing when it cannot reach
 * them. Nothing here re-implements any of that - it only turns those answers
 * into something a card can draw.
 *
 * "Could not check" is kept as its own state rather than folded into "up to
 * date". They are different facts and only one of them is safe to guess: a
 * panel behind a firewall that cannot reach GitHub should say so, not sit there
 * quietly claiming to be current.
 */
class Versions
{
    /**
     * @return array{installed: string, latest: ?string, current: ?bool}
     */
    public static function panel(): array
    {
        $row = ['installed' => '?', 'latest' => null, 'current' => null];

        try {
            $service = app(SoftwareVersionService::class);

            $row['installed'] = $service->currentPanelVersion();

            $latest = $service->latestPanelVersion();

            if ($latest !== 'error' && $latest !== '') {
                $row['latest'] = $latest;
                $row['current'] = $service->isLatestPanel();
            }
        } catch (Throwable) {
            // Whatever was read before it failed is still worth showing, and a
            // null 'current' already says the rest is unknown.
        }

        return $row;
    }

    /**
     * @return array{installed: string, latest: ?string, current: ?bool}
     */
    public static function wings(string $installed): array
    {
        $row = ['installed' => $installed, 'latest' => null, 'current' => null];

        if ($installed === '') {
            return $row;
        }

        try {
            $service = app(SoftwareVersionService::class);
            $latest = $service->latestWingsVersion();

            if ($latest !== 'error' && $latest !== '') {
                $row['latest'] = $latest;
                $row['current'] = $service->isLatestWings($installed);
            }
        } catch (Throwable) {
            //
        }

        return $row;
    }
}
