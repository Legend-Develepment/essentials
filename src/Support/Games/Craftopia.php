<?php

namespace LegendDevelopment\Theme\Support\Games;

use App\Models\Server;
use App\Repositories\Daemon\DaemonFileRepository;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Craftopia's ServerSetting.ini, and which eggs are Craftopia.
 *
 * One sectioned INI at the server root, and the tidiest file any game here
 * reads: six headings, thirty-two settings, every comment at the start of its
 * own line, no key repeated and nothing in it that is not a setting somebody
 * would set.
 *
 * **Two of those thirty-two are written by the daemon rather than by this
 * page.** `GameWorld.name` and `Host.port` are in the egg's find list, so the
 * daemon rewrites them from the server's allocation and its WORLD_NAME variable
 * every time the server starts. Changing either here holds until the next
 * start and then goes back. They are left on the page rather than hidden,
 * because the page shows what the file holds and hiding two of them would be
 * this plugin having an opinion about a file it was asked to show.
 *
 * The reader is `Support\Games\Ini`, the one written for ARK.
 */
class Craftopia
{
    /**
     * Where Craftopia keeps it.
     *
     * Relative to the server root, like every path the daemon's file repository
     * takes, and the path the egg itself declares. The egg's install script
     * fetches this file, so it is there before the server has ever started.
     */
    public const PATH = 'ServerSetting.ini';

    /**
     * A cap, and a generous one.
     *
     * The file the egg installs is under three kilobytes. A quarter of a
     * megabyte is far past anything Craftopia writes there, and the number is
     * here to refuse a file that is not this one rather than to tune anything.
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
     * The eggs an administrator has said are Craftopia.
     *
     * @return array<int, int>
     */
    public static function eggs(): array
    {
        if (self::$eggs !== null) {
            return self::$eggs;
        }

        $stored = Theme::config('craftopia_eggs', '');

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
