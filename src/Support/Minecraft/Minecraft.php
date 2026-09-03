<?php

namespace LegendDevelopment\Theme\Support\Minecraft;

use App\Enums\ContainerStatus;
use App\Models\Egg;
use App\Models\Server;
use App\Repositories\Daemon\DaemonFileRepository;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Minecraft's server.properties, reached through the daemon.
 *
 * The idea comes from N3rdmade's Minecraft Config plugin (MIT), which does the
 * same job from a page inside a server. Reading it settled what is worth
 * exposing and that the file has to be read from the server rather than guessed
 * at; the code here is this plugin's own and follows the shape the Palworld
 * page already established, because a second game editor that worked differently
 * from the first would be two things to learn instead of one.
 *
 * **Which servers are Minecraft is an administrator's answer, not a guess.**
 * The Palworld page matches on the egg's name containing "palworld", which works
 * because there is one Palworld egg and it says so. Minecraft has a dozen -
 * Vanilla, Paper, Purpur, Fabric, Forge, NeoForge, Quilt, Spigot, and whatever
 * somebody has renamed theirs to - and a plugin guessing at that list would be
 * wrong on somebody's panel the week it shipped. So the eggs are ticked on the
 * Minecraft settings page and this reads that list.
 */
class Minecraft
{
    /** Where Minecraft keeps it, and where every server jar writes it. */
    public const PATH = 'server.properties';

    /**
     * A server.properties is a few kilobytes. Something far larger is not one,
     * and reading it into a form field would be a way to spend a panel's memory
     * on a file nobody asked to edit.
     */
    private const MAX_BYTES = 262144;

    /** @var array<int, int>|null */
    private static ?array $eggs = null;

    /** @var array<int, bool> */
    private static array $detected = [];

    /**
     * The eggs an administrator has said are Minecraft.
     *
     * @return array<int, int>
     */
    /**
     * Let go of the parsed egg list and the per-server answers built from it.
     *
     * Called by Theme::using(): the list comes from config, and detect() caches
     * a yes or no per server that was decided against it.
     */
    public static function forget(): void
    {
        self::$eggs = null;
        self::$detected = [];
    }

    public static function eggs(): array
    {
        // Parsed once. detect() memoises per server, but eggOptions() and the
        // server pages ask again, and this is an explode and three array passes
        // over a value that cannot change during a request.
        if (self::$eggs !== null) {
            return self::$eggs;
        }

        $stored = Theme::config('minecraft_eggs', '');

        if (!is_string($stored) || trim($stored) === '') {
            return self::$eggs = [];
        }

        return self::$eggs = array_values(array_unique(array_map(
            'intval',
            array_filter(array_map('trim', explode(',', $stored)), 'is_numeric'),
        )));
    }

    /**
     * A form's ticked eggs, turned back into what is stored.
     */
    public static function sanitiseEggs(mixed $value): string
    {
        $value = is_array($value) ? $value : [];

        $ids = array_values(array_unique(array_map(
            'intval',
            array_filter($value, 'is_numeric'),
        )));

        return implode(',', $ids);
    }

    /**
     * Every egg on the panel, for the picker.
     *
     * @return array<int, string>
     */
    public static function eggOptions(): array
    {
        try {
            return Egg::query()
                ->select(['id', 'name'])
                ->orderBy('name')
                ->get()
                ->mapWithKeys(fn (Egg $egg): array => [$egg->id => $egg->name])
                ->all();
        } catch (Throwable) {
            return [];
        }
    }

    public static function enabled(): bool
    {
        return Features::enabled(Features::MINECRAFT);
    }

    /**
     * Whether this server's page should exist.
     *
     * The egg list decides it and the file is not probed. That is the whole
     * point of asking: a probe costs a request to the daemon on every page of
     * every server, and an administrator who has ticked the eggs has already
     * given a faster and more reliable answer than a probe would.
     */
    /**
     * Whether the panel may ask a game server who is on it.
     *
     * Off unless switched on, and that is not caution for its own sake. Every
     * other thing this plugin reads comes from the panel's database or from the
     * daemon over a connection Pelican already holds open. This one opens a TCP
     * connection from the panel straight to a game port, and whether that can
     * be reached at all is a fact about somebody's network rather than about
     * this code - a panel and its nodes on separate networks will never answer.
     * A feature that silently tries and fails on every page load is worse than
     * one that was never turned on.
     */
    public static function live(): bool
    {
        try {
            return (bool) Theme::config('minecraft_live', false);
        } catch (Throwable) {
            return false;
        }
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

    public static function read(Server $server): ?string
    {
        try {
            $contents = (new DaemonFileRepository())
                ->setServer($server)
                ->getContent(self::PATH, self::MAX_BYTES);

            return $contents === '' ? null : $contents;
        } catch (Throwable) {
            // Not there, daemon silent, or a server that has never started -
            // all of them mean "nothing to edit", and none is worth an error
            // page on a settings screen.
            return null;
        }
    }

    public static function write(Server $server, string $contents): bool
    {
        try {
            (new DaemonFileRepository())
                ->setServer($server)
                ->putContent(self::PATH, $contents);

            return true;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * Whether the server is stopped, and so whether saving is allowed.
     *
     * Minecraft reads server.properties once at start and writes it back at
     * stop, so a change saved while it is running is a change the game will
     * overwrite without either of you noticing. Anything not plainly Offline
     * counts as running: a status that could not be read is not a reason to
     * write to a file the game may be about to replace.
     */
    public static function isStopped(Server $server): bool
    {
        try {
            $status = $server->retrieveStatus();

            // Missing counts as stopped: a container that does not exist yet is
            // a server that has never run, and the file is safe to write before
            // a first start. Matched against the enum rather than a string -
            // retrieveStatus() returns ContainerStatus, so comparing to ->value
            // would be false every time and lock the form for ever.
            return $status === ContainerStatus::Offline || $status === ContainerStatus::Missing;
        } catch (Throwable) {
            return false;
        }
    }
}
