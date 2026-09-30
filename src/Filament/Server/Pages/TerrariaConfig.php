<?php

namespace LegendDevelopment\Theme\Filament\Server\Pages;

use App\Models\Server;
use BackedEnum;
use LegendDevelopment\Theme\Support\Games\Terraria;
use LegendDevelopment\Theme\Support\Minecraft\Properties;

/**
 * Terraria's serverconfig.txt as a form.
 *
 * **Seventy lines, and that is the point of the class above it.** The first
 * version of this page was three hundred, and everything in it that was not
 * about Terraria now lives in GameConfig - which is what roadmap/games.md is
 * actually about: what a game costs.
 *
 * What is left here is the four answers only Terraria can give: which servers
 * are Terraria, where the file is, what a setting in it looks like, and how to
 * put one back.
 *
 * `serverconfig.txt` is `server.properties` with a different name on it, so the
 * reader is Minecraft's and there is no parsing here at all.
 */
class TerrariaConfig extends GameConfig
{
    protected static string|BackedEnum|null $navigationIcon = 'tabler-tree';

    protected static ?string $slug = 'terraria-settings';

    protected static ?int $navigationSort = 7;


    protected static function words(): string
    {
        return 'terraria';
    }

    protected static function knows(Server $server): bool
    {
        return Terraria::detect($server);
    }

    /** @return array<int, string> */
    protected static function paths(): array
    {
        return [Terraria::PATH];
    }

    protected function contentsOf(Server $server, string $path): ?string
    {
        return Terraria::read($server, $path);
    }

    protected function saveTo(Server $server, string $path, string $contents): bool
    {
        return Terraria::write($server, $contents, $path);
    }

    /**
     * Including the ones that are only mentioned in a comment, which is most of
     * them: Terraria ships this file as an example with a `#` in front of
     * nearly every line. See Terraria::offered().
     *
     * @return array<string, string|null>
     */
    protected function offered(string $contents): array
    {
        return Terraria::offered($contents);
    }

    /** @param  array<string, string>  $changes */
    protected function rewrite(string $contents, array $changes): string
    {
        return Properties::apply($contents, $changes);
    }
}
