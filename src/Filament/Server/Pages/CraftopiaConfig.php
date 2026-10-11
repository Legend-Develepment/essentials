<?php

namespace LegendDevelopment\Theme\Filament\Server\Pages;

use App\Models\Server;
use BackedEnum;
use LegendDevelopment\Theme\Support\Games\Craftopia;
use LegendDevelopment\Theme\Support\Games\Ini;

/**
 * Craftopia's ServerSetting.ini as a form.
 *
 * Four answers and a name, which is what a game costs once GameConfig exists.
 * See roadmap/games.md for why that is the number that matters.
 *
 * Sectioned INI, so the reader is ARK's and there is no parsing here at all.
 */
class CraftopiaConfig extends GameConfig
{
    protected static string|BackedEnum|null $navigationIcon = 'tabler-pick';

    protected static ?string $slug = 'craftopia-settings';

    protected static ?int $navigationSort = 7;

    protected static function words(): string
    {
        return 'craftopia';
    }

    protected static function knows(Server $server): bool
    {
        return Craftopia::detect($server);
    }

    /** @return array<int, string> */
    protected static function paths(): array
    {
        return [Craftopia::PATH];
    }

    protected function contentsOf(Server $server, string $path): ?string
    {
        return Craftopia::read($server, $path);
    }

    protected function saveTo(Server $server, string $path, string $contents): bool
    {
        return Craftopia::write($server, $contents, $path);
    }

    /** @return array<string, string|null> */
    protected function offered(string $contents): array
    {
        return Craftopia::offered($contents);
    }

    /** @param  array<string, string>  $changes */
    protected function rewrite(string $contents, array $changes): string
    {
        return Ini::apply($contents, $changes);
    }
}
