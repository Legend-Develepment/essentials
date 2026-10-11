<?php

namespace LegendDevelopment\Theme\Filament\Server\Pages;

use App\Models\Server;
use BackedEnum;
use LegendDevelopment\Theme\Support\Games\DontStarve;
use LegendDevelopment\Theme\Support\Games\Ini;

/**
 * A cluster's three ini files as a form.
 *
 * **The most files any game here keeps**, which is the case GameConfig learned
 * to hold: cluster.ini is the world, and Master and Caves are the two shards
 * that make it up. Each gets its own section and each is written separately.
 *
 * Sectioned INI, so the reader is ARK's and there is no parsing here at all.
 */
class DontStarveConfig extends GameConfig
{
    protected static string|BackedEnum|null $navigationIcon = 'tabler-campfire';

    protected static ?string $slug = 'dontstarve-settings';

    protected static ?int $navigationSort = 7;

    protected static function words(): string
    {
        return 'dontstarve';
    }

    protected static function knows(Server $server): bool
    {
        return DontStarve::detect($server);
    }

    /** @return array<int, string> */
    protected static function paths(): array
    {
        return DontStarve::PATHS;
    }

    protected function contentsOf(Server $server, string $path): ?string
    {
        return DontStarve::read($server, $path);
    }

    protected function saveTo(Server $server, string $path, string $contents): bool
    {
        return DontStarve::write($server, $contents, $path);
    }

    /** @return array<string, string|null> */
    protected function offered(string $contents): array
    {
        return DontStarve::offered($contents);
    }

    /** @param  array<string, string>  $changes */
    protected function rewrite(string $contents, array $changes): string
    {
        return Ini::apply($contents, $changes);
    }
}
