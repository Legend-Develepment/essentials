<?php

namespace LegendDevelopment\Theme\Support\Games;

use App\Models\Server;
use App\Repositories\Daemon\DaemonFileRepository;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * V Rising's ServerHostSettings.json, and which eggs are V Rising.
 *
 * **The file the egg names, and not the other one.** A V Rising server keeps
 * two: this one, which is what the server is - its name, its ports, how many
 * may join, the RCON password - and `ServerGameSettings.json`, which is how the
 * game plays. Only the first is declared in the egg, so only the first is a
 * path this plugin knows rather than one it guessed. The second is worth adding
 * when somebody who runs one says where their egg puts it.
 *
 * The reader is `Support\Games\Json`, shared with the six other games in
 * roadmap/games.md that keep their settings this way. It never decodes and
 * re-encodes the document: a round trip through an encoder is valid JSON that
 * says the same thing and is not the same file, and these files are full of
 * numbers written `1.000000` that come back as `1`.
 */
class VRising
{
    /**
     * Where Terraria keeps it.
     *
     * Relative to the server root, like every path the daemon's file repository
     * takes. The vanilla server and tModLoader both read it from there, and the
     * tModLoader egg renames its own copy into place at install, so the name is
     * the same on both.
     */
    public const PATH = 'save-data/Settings/ServerHostSettings.json';

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

        $stored = Theme::config('vrising_eggs', '');

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
     * Every setting the file holds.
     *
     * No second answer here, unlike Terraria: JSON has no way to mention a
     * setting without setting it, so everything the scan finds is set and
     * nothing is offered as an example. See Support\Games\Json for the scan,
     * and for why the file is never decoded and re-encoded.
     *
     * @return array<string, string>
     */
    public static function offered(string $contents): array
    {
        return Json::parse($contents);
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
