<?php

namespace LegendDevelopment\Theme\Support\Games;

use App\Models\Server;
use App\Repositories\Daemon\DaemonFileRepository;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * ARK's GameUserSettings.ini, and which eggs are ARK.
 *
 * Its own egg list rather than sharing the Valve-query one, and the reason is
 * worth stating: that list answers "does this speak A2S", which Rust and
 * Valheim also do. This one answers "does this keep GameUserSettings.ini at the
 * path below", which only ARK does. Writing a Rust server's config directory
 * because both games answer the same UDP packet would be a bad afternoon.
 *
 * The file is read and written through the daemon, like everything else here
 * that touches a server's disk, and it is kept as its lines - see
 * Support\Games\Ini for why that matters more here than it did for Minecraft.
 */
class Ark
{
    /**
     * Where ARK keeps it.
     *
     * Relative to the server's own root, which is what the daemon's file
     * repository takes. Every ARK egg lays the game out the same way because
     * the game does - this is the path the binary itself writes.
     */
    public const PATH = 'ShooterGame/Saved/Config/LinuxServer/GameUserSettings.ini';

    /**
     * A cap, and a real one.
     *
     * A GameUserSettings.ini with a few mods in it runs to tens of kilobytes.
     * Half a megabyte is far past anything the game writes, and the point of
     * the number is to refuse a file that is not this one rather than to tune
     * anything.
     */
    public const MAX_BYTES = 524288;

    /** @var array<int, int>|null */
    private static ?array $eggs = null;

    /** @var array<int, bool> */
    private static array $detected = [];

    /**
     * Let go of the egg list and everything decided against it.
     *
     * Called by Theme::using(), which swaps the configuration under a request
     * to render a preview - so anything cached from configuration goes with it.
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
     * @return array<int, int>
     */
    public static function eggs(): array
    {
        if (self::$eggs !== null) {
            return self::$eggs;
        }

        $stored = Theme::config('ark_eggs', '');

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

    /**
     * The file, or null.
     *
     * Null covers a server that has never started - the game writes this file
     * on its first run, so a freshly installed one does not have it yet, and
     * that is a thing to say on the page rather than an error.
     */
    public static function read(Server $server): ?string
    {
        try {
            $contents = (new DaemonFileRepository())
                ->setServer($server)
                ->getContent(self::PATH, self::MAX_BYTES);

            return $contents === '' ? null : $contents;
        } catch (Throwable) {
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
     * @param  mixed  $value
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

    /**
     * The settings this page offers, and nothing else in the file is touched.
     *
     * A short list on purpose. GameUserSettings.ini has hundreds of keys and
     * mods add more; offering all of them would be a worse file manager than
     * the one Pelican already has. These are the ones somebody changes without
     * looking anything up - the rest stay exactly where they are, which is the
     * promise Support\Games\Ini keeps.
     *
     * @return array<string, array{type: string, group: string}>
     */
    public static function fields(): array
    {
        return [
            'SessionSettings.SessionName' => ['type' => 'text', 'group' => 'server'],
            'ServerSettings.ServerPassword' => ['type' => 'text', 'group' => 'server'],
            'ServerSettings.ServerAdminPassword' => ['type' => 'secret', 'group' => 'server'],
            'ServerSettings.MaxPlayers' => ['type' => 'number', 'group' => 'server'],
            'ServerSettings.ServerPVE' => ['type' => 'bool', 'group' => 'server'],

            'ServerSettings.DifficultyOffset' => ['type' => 'text', 'group' => 'rates'],
            'ServerSettings.XPMultiplier' => ['type' => 'text', 'group' => 'rates'],
            'ServerSettings.TamingSpeedMultiplier' => ['type' => 'text', 'group' => 'rates'],
            'ServerSettings.HarvestAmountMultiplier' => ['type' => 'text', 'group' => 'rates'],
            'ServerSettings.DayCycleSpeedScale' => ['type' => 'text', 'group' => 'rates'],

            'ServerSettings.AllowThirdPersonPlayer' => ['type' => 'bool', 'group' => 'rules'],
            'ServerSettings.ShowMapPlayerLocation' => ['type' => 'bool', 'group' => 'rules'],
            'ServerSettings.ServerCrosshair' => ['type' => 'bool', 'group' => 'rules'],
            'ServerSettings.AllowCaveBuildingPvE' => ['type' => 'bool', 'group' => 'rules'],
            'ServerSettings.DisableStructureDecayPvE' => ['type' => 'bool', 'group' => 'rules'],
        ];
    }
}
