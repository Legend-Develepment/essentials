<?php

namespace LegendDevelopment\Theme\Filament\Server\Pages;

use App\Models\Server;
use BackedEnum;
use LegendDevelopment\Theme\Support\Games\Factorio;
use LegendDevelopment\Theme\Support\Games\Json;

/**
 * Factorio's config-controller.json and config-host.json as a form.
 *
 * Four answers and a name, which is what a game costs once GameConfig exists.
 * Two files rather than one, which costs nothing extra now that the page holds
 * a list of them. See roadmap/games.md.
 *
 * JSON, so the reader is the one V Rising uses and there is no parsing here.
 */
class FactorioConfig extends GameConfig
{
    protected static string|BackedEnum|null $navigationIcon = 'tabler-settings-automation';

    protected static ?string $slug = 'factorio-settings';

    protected static ?int $navigationSort = 7;

    protected static function words(): string
    {
        return 'factorio';
    }

    protected static function knows(Server $server): bool
    {
        return Factorio::detect($server);
    }

    /** @return array<int, string> */
    protected static function paths(): array
    {
        return Factorio::PATHS;
    }

    protected function contentsOf(Server $server, string $path): ?string
    {
        return Factorio::read($server, $path);
    }

    protected function saveTo(Server $server, string $path, string $contents): bool
    {
        return Factorio::write($server, $contents, $path);
    }

    /** @return array<string, string|null> */
    protected function offered(string $contents): array
    {
        return Factorio::offered($contents);
    }

    /** @param  array<string, string>  $changes */
    protected function rewrite(string $contents, array $changes): string
    {
        return Json::apply($contents, $changes);
    }
}
