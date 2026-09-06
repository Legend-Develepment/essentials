<?php

namespace LegendDevelopment\Theme\Support\Games;

use App\Models\Server;
use App\Repositories\Daemon\DaemonFileRepository;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Valheim's three name lists, and which eggs are Valheim.
 *
 * No settings form here, and that is a finding rather than an omission: a
 * Valheim server is configured by its start-up arguments - name, world,
 * password, port, crossplay - and Pelican's own Startup page already edits every
 * one of them, respecting `user_editable`. A "Valheim settings" page would be a
 * worse copy of a page that exists. What Pelican has no answer for is the three
 * files the game keeps beside the world, so that is what this is.
 *
 * Where those files live is the awkward part. The game writes them into its
 * save directory, and which directory that is depends on how the egg starts it -
 * so rather than guess once and be wrong on somebody's panel, the known
 * locations are tried in turn and the one that answers is the one used.
 */
class Valheim
{
    /**
     * The three lists, by the name this plugin calls them.
     *
     * The keys are what the pages and the translations use; the values are what
     * the game reads. They differ - the game's file is `banlist.txt` and the
     * word on the page is "banned" - and pretending otherwise would put a file
     * name in a translator's file.
     */
    public const LISTS = [
        'admin' => 'adminlist.txt',
        'banned' => 'banlist.txt',
        'permitted' => 'permittedlist.txt',
    ];

    /**
     * Where the game might keep them, best guess first.
     *
     * The first is where a Linux dedicated server puts them with no arguments -
     * `$HOME/.config/unity3d/IronGate/Valheim`, and the container's home is the
     * server's own root. The others are what the common eggs use when they pass
     * `-savedir`. Tried in order; the first that answers is the answer.
     */
    public const DIRS = [
        '.config/unity3d/IronGate/Valheim',
        'saves',
        'valheim/saves',
        'config',
    ];

    /**
     * A cap on a file that is one identifier per line.
     *
     * Seventeen digits and a newline is eighteen bytes, so this is room for
     * something like fourteen thousand names. A file bigger than that is not
     * one of these.
     */
    public const MAX_BYTES = 262144;

    /** @var array<int, int>|null */
    private static ?array $eggs = null;

    /** @var array<int, bool> */
    private static array $detected = [];

    /** @var array<int, string> */
    private static array $dirs = [];

    /**
     * Let go of the egg list and everything decided against it.
     *
     * Called by Theme::using(), which swaps the configuration under a request
     * to render a preview - so anything cached from configuration has to go
     * with it.
     */
    public static function forget(): void
    {
        self::$eggs = null;
        self::$detected = [];
        self::$dirs = [];
    }

    /**
     * @return array<int, int>
     */
    public static function eggs(): array
    {
        if (self::$eggs !== null) {
            return self::$eggs;
        }

        $stored = Theme::config('valheim_eggs', '');

        if (!is_string($stored) || trim($stored) === '') {
            return self::$eggs = [];
        }

        return self::$eggs = array_values(array_unique(array_filter(
            array_map('intval', explode(',', $stored)),
            static fn (int $id): bool => $id > 0,
        )));
    }

    public static function enabled(): bool
    {
        return Features::enabled(Features::GAMES);
    }

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

    /**
     * @return array<string, string>
     */
    public static function files(): array
    {
        return self::LISTS;
    }

    /**
     * One list, or null if the server has none of these files anywhere.
     *
     * Null and empty are different things here and the page says so: null is a
     * server that has never written a list, empty is a list with nobody on it.
     *
     * @return array<int, string>|null
     */
    public static function read(Server $server, string $list): ?array
    {
        $contents = self::contents($server, $list);

        return $contents === null ? null : Names::parse($contents);
    }

    /**
     * One list as the file holds it, comments and all.
     */
    public static function contents(Server $server, string $list): ?string
    {
        $file = self::LISTS[$list] ?? null;

        if ($file === null) {
            return null;
        }

        foreach (self::order($server) as $dir) {
            try {
                $contents = (new DaemonFileRepository())
                    ->setServer($server)
                    ->getContent($dir . '/' . $file, self::MAX_BYTES);
            } catch (Throwable) {
                // Not there, or not readable. The next candidate might be.
                continue;
            }

            // Remembered, so the other two lists and the save that follows do
            // not walk the candidates again.
            self::$dirs[(int) $server->id] = $dir;

            return $contents;
        }

        return null;
    }

    /**
     * @param  array<int, mixed>  $names
     */
    public static function write(Server $server, string $list, array $names): bool
    {
        $file = self::LISTS[$list] ?? null;

        if ($file === null) {
            return false;
        }

        $before = self::contents($server, $list) ?? '';

        try {
            (new DaemonFileRepository())
                ->setServer($server)
                ->putContent(self::dir($server) . '/' . $file, Names::render($before, $names));

            return true;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * The directory this server's lists live in.
     *
     * Whichever one answered, or the first candidate for a server that has
     * never written one - the game reads that path with no arguments, so it is
     * the right place to create a list that does not exist yet.
     */
    public static function dir(Server $server): string
    {
        return self::$dirs[(int) $server->id] ?? self::DIRS[0];
    }

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

    /**
     * The candidates to try, the remembered one first.
     *
     * @return array<int, string>
     */
    private static function order(Server $server): array
    {
        $known = self::$dirs[(int) $server->id] ?? null;

        if ($known === null) {
            return self::DIRS;
        }

        return array_merge([$known], array_values(array_diff(self::DIRS, [$known])));
    }
}
