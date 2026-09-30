<?php

namespace LegendDevelopment\Theme\Filament\Server\Pages;

use App\Models\Server;
use BackedEnum;
use LegendDevelopment\Theme\Support\Games\Json;
use LegendDevelopment\Theme\Support\Games\VRising;

/**
 * V Rising's ServerHostSettings.json as a form.
 *
 * Four answers and a name, which is what a game costs once GameConfig exists.
 * See roadmap/games.md for why that is the number that matters.
 *
 * The one thing worth knowing here that is not in the parent: a JSON file has
 * no way of mentioning a setting without setting it, so nothing on this page is
 * ever marked as not set. Every field is a value the server is actually using.
 */
class VRisingConfig extends GameConfig
{
    protected static string|BackedEnum|null $navigationIcon = 'tabler-droplet';

    protected static ?string $slug = 'vrising-settings';

    protected static ?int $navigationSort = 7;


    protected static function words(): string
    {
        return 'vrising';
    }

    protected static function knows(Server $server): bool
    {
        return VRising::detect($server);
    }

    /** @return array<int, string> */
    protected static function paths(): array
    {
        return [VRising::PATH];
    }

    protected function contentsOf(Server $server, string $path): ?string
    {
        return VRising::read($server, $path);
    }

    protected function saveTo(Server $server, string $path, string $contents): bool
    {
        return VRising::write($server, $contents, $path);
    }

    /** @return array<string, string|null> */
    protected function offered(string $contents): array
    {
        return VRising::offered($contents);
    }

    /** @param  array<string, string>  $changes */
    protected function rewrite(string $contents, array $changes): string
    {
        return Json::apply($contents, $changes);
    }
}
