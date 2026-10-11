<?php

namespace LegendDevelopment\Theme\Filament\Server\Pages;

use App\Models\Server;
use BackedEnum;
use LegendDevelopment\Theme\Support\Games\Ini;
use LegendDevelopment\Theme\Support\Games\Satisfactory;

/**
 * Satisfactory's Game.ini and Engine.ini as a form.
 *
 * **The first page here with two files on it**, which is the whole reason
 * GameConfig learned to hold more than one: Satisfactory splits its settings
 * across two, Don't Starve Together across three, and a page that knew one file
 * was a page those games could not have had. Each file gets its own section,
 * headed by its own name, and each is written separately.
 *
 * Sectioned INI, so the reader is ARK's and there is no parsing here at all.
 */
class SatisfactoryConfig extends GameConfig
{
    protected static string|BackedEnum|null $navigationIcon = 'tabler-building-factory';

    protected static ?string $slug = 'satisfactory-settings';

    protected static ?int $navigationSort = 7;


    protected static function words(): string
    {
        return 'satisfactory';
    }

    protected static function knows(Server $server): bool
    {
        return Satisfactory::detect($server);
    }

    /** @return array<int, string> */
    protected static function paths(): array
    {
        return Satisfactory::PATHS;
    }

    protected function contentsOf(Server $server, string $path): ?string
    {
        return Satisfactory::read($server, $path);
    }

    protected function saveTo(Server $server, string $path, string $contents): bool
    {
        return Satisfactory::write($server, $contents, $path);
    }

    /** @return array<string, string|null> */
    protected function offered(string $contents): array
    {
        return Satisfactory::offered($contents);
    }

    /** @param  array<string, string>  $changes */
    protected function rewrite(string $contents, array $changes): string
    {
        return Ini::apply($contents, $changes);
    }
}
