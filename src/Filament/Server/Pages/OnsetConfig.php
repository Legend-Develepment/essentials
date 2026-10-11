<?php

namespace LegendDevelopment\Theme\Filament\Server\Pages;

use App\Models\Server;
use BackedEnum;
use LegendDevelopment\Theme\Support\Games\Json;
use LegendDevelopment\Theme\Support\Games\Onset;

/**
 * Onset's server_config.json as a form.
 *
 * Four answers and a name, which is what a game costs once GameConfig exists.
 * See roadmap/games.md for why that is the number that matters.
 *
 * JSON, so the reader is the one V Rising uses and there is no parsing here at
 * all - and, as there, nothing on this page is ever marked as not set: a JSON
 * file has no way of mentioning a setting without also setting it.
 */
class OnsetConfig extends GameConfig
{
    protected static string|BackedEnum|null $navigationIcon = 'tabler-car';

    protected static ?string $slug = 'onset-settings';

    protected static ?int $navigationSort = 7;

    protected static function words(): string
    {
        return 'onset';
    }

    protected static function knows(Server $server): bool
    {
        return Onset::detect($server);
    }

    /** @return array<int, string> */
    protected static function paths(): array
    {
        return [Onset::PATH];
    }

    protected function contentsOf(Server $server, string $path): ?string
    {
        return Onset::read($server, $path);
    }

    protected function saveTo(Server $server, string $path, string $contents): bool
    {
        return Onset::write($server, $contents, $path);
    }

    /** @return array<string, string|null> */
    protected function offered(string $contents): array
    {
        return Onset::offered($contents);
    }

    /** @param  array<string, string>  $changes */
    protected function rewrite(string $contents, array $changes): string
    {
        return Json::apply($contents, $changes);
    }
}
