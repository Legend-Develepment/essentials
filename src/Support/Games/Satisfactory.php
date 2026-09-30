<?php

namespace LegendDevelopment\Theme\Support\Games;

use App\Models\Server;
use App\Repositories\Daemon\DaemonFileRepository;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Satisfactory's two config files, and which eggs are Satisfactory.
 *
 * **The first game here that keeps more than one**, which is the question
 * roadmap/games.md left open and the reason the page holds a list of files
 * rather than a file. Game.ini is how the game plays and Engine.ini is how it
 * runs, and both are sectioned INI at paths the egg declares.
 *
 * The reader is `Support\Games\Ini`, the one written for ARK: it keeps every
 * comment, the order of everything, and every key this plugin has never heard
 * of, which matters more here than it did there - an Engine.ini is mostly keys
 * nobody in this codebase can name.
 */
class Satisfactory
{
    /**
     * Where Satisfactory keeps them, in the order the page shows them.
     *
     * Relative to the server root, like every path the daemon's file repository
     * takes, and both are paths the egg itself declares. Game.ini first because
     * it is the one somebody came here to change; Engine.ini is how the process
     * runs rather than how the game plays.
     *
     * @var array<int, string>
     */
    public const PATHS = [
        'FactoryGame/Saved/Config/LinuxServer/Game.ini',
        'FactoryGame/Saved/Config/LinuxServer/Engine.ini',
    ];

    /** The first of them, for anything that wants only one. */
    public const PATH = self::PATHS[0];

    /**
     * A cap, and a generous one.
     *
     * Neither file is large. A quarter of a megabyte is far past anything
     * Satisfactory writes into either, and the number is here to refuse a file
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
     * The eggs an administrator has said are Satisfactory.
     *
     * @return array<int, int>
     */
    public static function eggs(): array
    {
        if (self::$eggs !== null) {
            return self::$eggs;
        }

        $stored = Theme::config('satisfactory_eggs', '');

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
