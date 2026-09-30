<?php

namespace LegendDevelopment\Theme\Filament\Server\Pages;

use App\Models\Server;
use BackedEnum;
use LegendDevelopment\Theme\Support\Games\Enshrouded;
use LegendDevelopment\Theme\Support\Games\Json;

/**
 * Enshrouded's enshrouded_server.json as a form.
 *
 * Four answers and a name, which is what a game costs once GameConfig exists.
 * See roadmap/games.md for why that is the number that matters.
 *
 * JSON, so the reader is the one V Rising uses and there is no parsing here at
 * all - and, as there, nothing on this page is ever marked as not set: a JSON
 * file has no way of mentioning a setting without also setting it.
 */
class EnshroudedConfig extends GameConfig
{
    protected static string|BackedEnum|null $navigationIcon = 'tabler-cloud-fog';

    protected static ?string $slug = 'enshrouded-settings';

    protected static ?int $navigationSort = 7;


    protected static function words(): string
    {
        return 'enshrouded';
    }

    protected static function knows(Server $server): bool
    {
        return Enshrouded::detect($server);
    }

    /** @return array<int, string> */
    protected static function paths(): array
    {
        return [Enshrouded::PATH];
    }

    protected function contentsOf(Server $server, string $path): ?string
    {
        return Enshrouded::read($server, $path);
    }

    protected function saveTo(Server $server, string $path, string $contents): bool
    {
        return Enshrouded::write($server, $contents, $path);
    }

    /** @return array<string, string|null> */
    protected function offered(string $contents): array
    {
        return Enshrouded::offered($contents);
    }

    /** @param  array<string, string>  $changes */
    protected function rewrite(string $contents, array $changes): string
    {
        return Json::apply($contents, $changes);
    }
}
