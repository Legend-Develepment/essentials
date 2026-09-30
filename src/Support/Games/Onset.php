<?php

namespace LegendDevelopment\Theme\Support\Games;

use App\Models\Server;
use App\Repositories\Daemon\DaemonFileRepository;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Onset's server_config.json, and which eggs are Onset.
 *
 * One strict JSON file at the server root. It ships inside the Steam depot
 * rather than being written by the egg, so unlike most games here it is already
 * there before the server has ever started.
 *
 * **What this page cannot do, which is worth knowing before using it.** Two of
 * the settings an Onset operator changes most often - `plugins` and `packages` -
 * are arrays of strings. `Support\Games\Json` answers scalars, so the entries
 * that are already there appear as `plugins.0` and can be renamed, and there is
 * no way to add a row or remove one. Everything else in the file is a plain
 * setting and behaves normally.
 *
 * The rest of the file is about twenty top-level settings plus a `pools` block
 * holding a distance and an update rate for each of eight kinds of entity, and
 * those nest cleanly.
 */
class Onset
{
    /**
     * Where Onset keeps it.
     *
     * Relative to the server root, like every path the daemon's file repository
     * takes, and the path the egg itself declares. The egg's install script
     * writes no configuration of its own: this comes out of the depot, which is
     * why it exists on a server that has never been started.
     */
    public const PATH = 'server_config.json';

    /**
     * A cap, and a generous one.
     *
     * The file is a couple of kilobytes. A quarter of a megabyte is far past
     * anything Onset writes there, and the number is here to refuse a file that
     * is not this one rather than to tune anything.
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
     * The eggs an administrator has said are Onset.
     *
     * @return array<int, int>
     */
    public static function eggs(): array
    {
        if (self::$eggs !== null) {
            return self::$eggs;
        }

        $stored = Theme::config('onset_eggs', '');

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
     * for why the file is never decoded and re-encoded, and for why a file that
     * is not JSON at all reads as nothing rather than as fragments.
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
