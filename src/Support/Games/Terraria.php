<?php

namespace LegendDevelopment\Theme\Support\Games;

use App\Models\Server;
use App\Repositories\Daemon\DaemonFileRepository;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Minecraft\Properties;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Terraria's serverconfig.txt, and which eggs are Terraria.
 *
 * **The first game here whose form is drawn from its own file rather than from
 * a list somebody wrote down.** ARK has fifteen named settings out of hundreds,
 * each with a label and a sentence in thirty-two languages, and that is why ARK
 * is one of two games rather than one of twelve: six hundred and forty strings
 * apiece is the whole cost. See roadmap/games.md.
 *
 * A key in this file is the same string in every language - `maxplayers` is
 * `maxplayers` in Japanese - so the page lists what the file holds and puts no
 * label on anything. What that loses is real and is written on the page: it
 * cannot group, order or explain, and somebody who does not already know what
 * a setting does learns nothing from seeing its name. What it buys is a page
 * that shows every setting rather than the fifteen somebody had time for, and
 * a game that costs a reader and a heading.
 *
 * `serverconfig.txt` is `server.properties` with a different name on it, so the
 * reader is Minecraft's and there is no new parsing here at all.
 *
 * **Most of the file ships commented out**, which is the one thing about
 * Terraria that shapes this class. The game writes an example with every
 * setting present and a `#` in front of nearly all of them, so a page that
 * listed only what is set would list two or three lines on a fresh server.
 * offered() reads the commented ones too and hands them back as null, meaning
 * "this game understands it and it is not set".
 */
class Terraria
{
    /**
     * Where Terraria keeps it.
     *
     * Relative to the server root, like every path the daemon's file repository
     * takes. The vanilla server and tModLoader both read it from there, and the
     * tModLoader egg renames its own copy into place at install, so the name is
     * the same on both.
     */
    public const PATH = 'serverconfig.txt';

    /**
     * A cap, and a generous one.
     *
     * The file the game ships is under four kilobytes. A quarter of a megabyte
     * is far past anything Terraria writes, and the number is here to refuse a
     * file that is not this one rather than to tune anything.
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
     * The eggs an administrator has said are Terraria.
     *
     * @return array<int, int>
     */
    public static function eggs(): array
    {
        if (self::$eggs !== null) {
            return self::$eggs;
        }

        $stored = Theme::config('terraria_eggs', '');

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

    /** The file, or null where there is not one yet. */
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
     * Every setting the file mentions, set or not.
     *
     * A string for a key that is set and **null for one that is only mentioned
     * in a comment**, which is most of them: Terraria ships this file as an
     * example with a `#` in front of nearly every line, so parsing it normally
     * yields the two or three the egg uncommented and nothing else.
     *
     * The commented ones are read with the same key rules as the live ones, so
     * a sentence that happens to contain an equals sign is not mistaken for a
     * setting - `# set this to 1 to enable` has no key before its `=`, and a
     * comment with no `=` at all cannot produce one either.
     *
     * Order is the file's own order, which is the only order there is: nothing
     * here knows what any of these mean, so nothing here can group them.
     *
     * @return array<string, string|null>
     */
    public static function offered(string $contents): array
    {
        $live = Properties::parse($contents);
        $out = [];

        foreach (explode("\n", str_replace(["\r\n", "\r"], "\n", $contents)) as $line) {
            $bare = ltrim($line);
            $commented = str_starts_with($bare, '#');
            $body = $commented ? ltrim(substr($bare, 1)) : $bare;

            $at = strpos($body, '=');

            if ($at === false || $at === 0) {
                continue;
            }

            $key = rtrim(substr($body, 0, $at));

            if (preg_match('/^[A-Za-z0-9._-]+$/', $key) !== 1) {
                continue;
            }

            if (array_key_exists($key, $out)) {
                continue;
            }

            /*
             * A key that is set wins over the same key in a comment, whichever
             * came first in the file. Terraria's own example has both for
             * several settings, and the one that matters is the one the game
             * reads.
             */
            $out[$key] = array_key_exists($key, $live) ? $live[$key] : null;
        }

        foreach ($live as $key => $value) {
            if (!array_key_exists($key, $out)) {
                $out[$key] = $value;
            }
        }

        return $out;
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
