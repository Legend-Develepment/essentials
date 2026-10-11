<?php

namespace LegendDevelopment\Theme\Support\Games;

use App\Models\Server;
use App\Repositories\Daemon\DaemonFileRepository;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Enshrouded's enshrouded_server.json, and which eggs are Enshrouded.
 *
 * One file at the server root, which its egg declares and the daemon parses -
 * so the shape of it is a claim the panel already has to keep rather than
 * something this had to go and check. See roadmap/games.md for why a `json`
 * declaration is worth believing and a `file` one is not.
 *
 * The reader is `Support\Games\Json`, shared with the rest of the eighteen
 * games that keep their settings this way.
 */
class Enshrouded
{
    /**
     * Where Enshrouded keeps it.
     *
     * Relative to the server root, like every path the daemon's file repository
     * takes. This is the path the egg itself declares, which is also why the
     * format can be believed: the daemon parses this file and would fail on one
     * that was not JSON.
     */
    public const PATH = 'enshrouded_server.json';

    /**
     * A cap, and a generous one.
     *
     * The file the game writes is a few kilobytes. A quarter of a megabyte is
     * far past anything Enshrouded puts there, and the number is here to refuse
     * a file that is not this one rather than to tune anything.
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
     * The eggs an administrator has said are Enshrouded.
     *
     * @return array<int, int>
     */
    public static function eggs(): array
    {
        if (self::$eggs !== null) {
            return self::$eggs;
        }

        $stored = Theme::config('enshrouded_eggs', '');

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
