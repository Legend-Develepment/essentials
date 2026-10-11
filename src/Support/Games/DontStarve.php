<?php

namespace LegendDevelopment\Theme\Support\Games;

use App\Models\Server;
use App\Repositories\Daemon\DaemonFileRepository;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Don't Starve Together: its configuration files, and which eggs are it.
 *
 * **Three files, and that is the shape of the game rather than an accident.**
 * A world here is a cluster: cluster.ini is what the whole thing is - its name,
 * its password, how many people fit, whether it is PvP - and then each shard
 * gets its own server.ini. Master is the surface, Caves is underground, and the
 * two are separate servers sharing one world.
 *
 * Two of those three are named server.ini, and that is this game's one
 * contribution to the page above it: a section headed by a file's basename was
 * fine until two files shared one, so GameConfig now keeps the directory where
 * it has to. Master and Caves read as `Master/server.ini` and
 * `Caves/server.ini`, and a game with no clash still reads as `Game.ini`.
 *
 * The reader is `Support\Games\Ini`, the one written for ARK.
 */
class DontStarve
{
    /**
     * Where the cluster keeps them, in the order the page shows them.
     *
     * Relative to the server root, like every path the daemon's file repository
     * takes, and all three are paths the egg itself declares. The cluster comes
     * first because it is the one somebody came here to change; the two shards
     * follow it in the order the game starts them.
     *
     * @var array<int, string>
     */
    public const PATHS = [
        'DoNotStarveTogether/config/server/cluster.ini',
        'DoNotStarveTogether/config/server/Master/server.ini',
        'DoNotStarveTogether/config/server/Caves/server.ini',
    ];

    /** The first of them, for anything that wants only one. */
    public const PATH = self::PATHS[0];

    /**
     * A cap, and a generous one.
     *
     * None of the three is large. A quarter of a megabyte is far past anything
     * the game writes into any of them, and the number is here to refuse a file
     * that is not one of these rather than to tune anything.
     */
    public const MAX_BYTES = 262144;

    /** @var array<int, int>|null */
    private static ?array $eggs = null;

    /** @var array<int, bool> */
    private static array $detected = [];

    /**
     * Let go of the egg list and everything decided against it.
     *
     * Called by Theme::using(), which swaps the configuration under a request
     * to render a preview - so anything cached from configuration goes too.
     */
    public static function forget(): void
    {
        self::$eggs = null;
        self::$detected = [];
    }

    public static function enabled(): bool
    {
        return Features::enabled(Features::GAMES);
    }

    /**
     * The eggs an administrator has said are this game.
     *
     * @return array<int, int>
     */
    public static function eggs(): array
    {
        if (self::$eggs !== null) {
            return self::$eggs;
        }

        $stored = Theme::config('dontstarve_eggs', '');

        if (!is_string($stored) || trim($stored) === '') {
            return self::$eggs = [];
        }

        return self::$eggs = array_values(array_unique(array_filter(
            array_map('intval', explode(',', $stored)),
            static fn (int $id): bool => $id > 0,
        )));
    }

    /** Whether this server is one. Memoised: a page asks more than once. */
    public static function detect(Server $server): bool
    {
        if (!self::enabled()) {
            return false;
        }

        $id = (int) $server->id;

        if (array_key_exists($id, self::$detected)) {
            return self::$detected[$id];
        }

        try {
            return self::$detected[$id] = in_array((int) $server->egg_id, self::eggs(), true);
        } catch (Throwable) {
            return self::$detected[$id] = false;
        }
    }

    /** One of them, or null where there is not one yet. */
    public static function read(Server $server, ?string $path = null): ?string
    {
        try {
            $contents = (new DaemonFileRepository())
                ->setServer($server)
                ->getContent($path ?? self::PATH, self::MAX_BYTES);

            return $contents === '' ? null : $contents;
        } catch (Throwable) {
            return null;
        }
    }

    public static function write(Server $server, string $contents, ?string $path = null): bool
    {
        try {
            (new DaemonFileRepository())
                ->setServer($server)
                ->putContent($path ?? self::PATH, $contents);

            return true;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * Every setting the file holds.
     *
     * No second answer here, unlike Terraria: a commented line in an INI is a
     * comment rather than a setting waiting to be switched on, so everything
     * the parse finds is set. See Support\Games\Ini, which keeps the comments
     * exactly where they were anyway.
     *
     * @return array<string, string>
     */
    public static function offered(string $contents): array
    {
        return Ini::parse($contents);
    }

    /**
     * The stored form of a list of egg ids.
     *
     * @param  mixed  $value  Whatever the form handed back.
     */
    public static function sanitise(mixed $value): string
    {
        if (!is_array($value)) {
            return '';
        }

        $ids = array_values(array_unique(array_filter(
            array_map('intval', $value),
            static fn (int $id): bool => $id > 0,
        )));

        return implode(',', array_slice($ids, 0, 200));
    }
}
