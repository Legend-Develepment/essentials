<?php

namespace LegendDevelopment\Theme\Support\Palworld;

use App\Enums\ContainerStatus;
use App\Models\Server;
use App\Repositories\Daemon\DaemonFileRepository;
use LegendDevelopment\Theme\Support\Features;
use Throwable;

/**
 * Palworld's world settings, edited from the panel instead of from the file.
 *
 * The file is one enormous line - see OptionSettings for what it looks like and
 * why nothing here carries a list of what is in it. This class is the part that
 * talks to the server: finding the file, reading it, writing it back, and
 * refusing to do the last one while the server is running.
 *
 * **Only while the server is stopped.** Palworld holds its settings in memory
 * and writes the file out again when it shuts down, so a change saved to a
 * running server is a change that gets overwritten with the old values the next
 * time it stops - silently, hours later, and with nothing to point at.
 */
class Palworld
{
    /**
     * Where the file is, on each of the two builds.
     *
     * Linux first because a Pelican egg runs the Linux dedicated server; the
     * Windows path is there because the game writes one or the other depending
     * on the build, and a server running under Proton has the Windows one.
     */
    private const PATHS = [
        'Pal/Saved/Config/LinuxServer/PalWorldSettings.ini',
        'Pal/Saved/Config/WindowsServer/PalWorldSettings.ini',
    ];

    /** A config file is a few kilobytes. Anything much larger is not one. */
    private const MAX_BYTES = 131072;

    public static function enabled(): bool
    {
        return Features::enabled(Features::PALWORLD);
    }

    /**
     * Does this server look like a Palworld one.
     *
     * The egg's name first, because it is a column already loaded and costs
     * nothing. Only if that says nothing does it ask the daemon whether the file
     * is there - one request, and only on a server whose egg is not named for
     * the game it runs.
     */
    public static function detect(Server $server): bool
    {
        if (!self::enabled()) {
            return false;
        }

        try {
            $egg = mb_strtolower((string) ($server->egg->name ?? ''));

            if (str_contains($egg, 'palworld')) {
                return true;
            }
        } catch (Throwable) {
            // No egg to read is not an answer either way; the file still is.
        }

        return self::find($server) !== null;
    }

    /**
     * The path the file is actually at, or null.
     *
     * @return string|null
     */
    public static function find(Server $server): ?string
    {
        foreach (self::PATHS as $path) {
            if (self::read($server, $path) !== null) {
                return $path;
            }
        }

        return null;
    }

    public static function read(Server $server, string $path): ?string
    {
        try {
            $contents = (new DaemonFileRepository())
                ->setServer($server)
                ->getContent($path, self::MAX_BYTES);

            return $contents === '' ? null : $contents;
        } catch (Throwable) {
            // A file that is not there, a daemon that will not answer, a server
            // that has never been started: all of them mean "no settings to
            // edit", and none of them is worth an error page.
            return null;
        }
    }

    public static function write(Server $server, string $path, string $contents): bool
    {
        try {
            (new DaemonFileRepository())
                ->setServer($server)
                ->putContent($path, $contents);

            return true;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * Whether the server is stopped, and so whether saving is allowed.
     *
     * Anything that is not plainly Offline counts as running. A status that
     * could not be read is not a reason to write to a file the game may be
     * about to overwrite.
     */
    public static function isStopped(Server $server): bool
    {
        try {
            $status = $server->retrieveStatus();

            return $status === ContainerStatus::Offline || $status === ContainerStatus::Missing;
        } catch (Throwable) {
            return false;
        }
    }

    /* --------------------------------------------------------- reading it - */

    /**
     * A setting's name, in words, worked out from the key.
     *
     * Derived rather than listed, for the same reason the settings themselves
     * are: the game adds keys, and a key with no entry in a list of labels
     * would appear as nothing at all or as itself while everything around it
     * reads properly. bIsPvP becomes "Is PvP"; PalAutoHPRegeneRateInSleep
     * becomes "Pal auto HP regene rate in sleep". Not always the wording the
     * game's own menu uses, and always the right key.
     */
    public static function label(string $key): string
    {
        // The b prefix is Unreal's for a boolean and is not part of the name.
        $name = preg_match('/^b[A-Z]/', $key) === 1 ? substr($key, 1) : $key;

        /*
         * Abbreviations are pulled out before the split rather than repaired
         * after it. A run of capitals survives on its own - UNKO, RCON - but one
         * with a lowercase letter inside it does not: PvP splits between the v
         * and the P however the rule is written, and comes out "pv P". Taking
         * them out of the way first is the version of this that has no cases
         * left over.
         */
        $held = [];
        $index = 0;

        foreach (self::ABBREVIATIONS as $written => $shown) {
            $token = "\x01" . $index++ . "\x01";

            // Wrapped in underscores, because the splitter treats those as a
            // boundary. Without them the abbreviation glues itself to the word
            // before it and PublicIP comes out "PublicIP" rather than
            // "Public IP" - the split point was exactly what was taken away.
            $name = str_replace($written, '_' . $token . '_', $name);
            $held[$token] = $shown;
        }

        // Split on the case changes, keeping runs of capitals together so UNKO
        // survives as a word rather than becoming U N K O.
        $words = preg_split('/(?<=[a-z0-9])(?=[A-Z])|(?<=[A-Z])(?=[A-Z][a-z])|_/', $name) ?: [$name];
        $words = array_values(array_filter(array_map('trim', $words), static fn ($w) => $w !== ''));

        if ($words === []) {
            return $key;
        }

        // Only the first word is capitalised; a run of capitals is left alone.
        foreach ($words as $index => $word) {
            $words[$index] = $index === 0
                ? ucfirst($word)
                : (mb_strtoupper($word) === $word ? $word : mb_strtolower($word));
        }

        return strtr(implode(' ', $words), $held);
    }

    /**
     * As the keys write them, to how they should read.
     *
     * Longest first, and that matters: RESTAPIPort holds "IP" inside "API", so
     * replacing the short one first cuts the long one in half and the label
     * comes out wrong in a way nobody would think to look for.
     *
     * @var array<string, string>
     */
    private const ABBREVIATIONS = [
        'API' => 'API',
        'PvP' => 'PvP',
        'HP' => 'HP',
        // The keys are not consistent about it: PlayerAutoHPRegeneRate and
        // PalAutoHpRegeneRateInSleep are the same word, spelled two ways.
        'Hp' => 'HP',
        'IP' => 'IP',
        'UI' => 'UI',
        'ID' => 'ID',
    ];

    /**
     * Which group a setting belongs in, from what its name starts with.
     *
     * Derived, again, and deliberately coarse. A key the game adds tomorrow
     * lands in the right group if it is named like its neighbours and in "Other"
     * if it is not - which is a place to find it, rather than nowhere.
     */
    public static function group(string $key): string
    {
        $name = preg_match('/^b[A-Z]/', $key) === 1 ? substr($key, 1) : $key;

        foreach (self::GROUPS as $group => $prefixes) {
            foreach ($prefixes as $prefix) {
                if (str_starts_with($name, $prefix)) {
                    return $group;
                }
            }
        }

        return 'other';
    }

    /**
     * Longest prefixes first within each group, and the groups in the order
     * they are drawn.
     *
     * @var array<string, array<int, string>>
     */
    private const GROUPS = [
        'server' => ['Server', 'Public', 'RCON', 'RESTAPI', 'Region', 'UseAuth', 'BanList', 'AdminPassword', 'LogFormat', 'ShowPlayerList', 'AllowConnectPlatform', 'IsUseBackupSaveData'],
        'world' => ['Difficulty', 'DayTime', 'NightTime', 'Exp', 'WorkSpeed', 'PalEgg', 'Death', 'Random'],
        'pals' => ['Pal'],
        'players' => ['Player', 'Enable', 'Coop', 'Is'],
        'building' => ['Build', 'BaseCamp', 'Collection', 'DropItem', 'Enemy', 'ItemWeight'],
        'guild' => ['Guild', 'AutoResetGuild'],
    ];

    /**
     * @return array<int, string>
     */
    public static function groups(): array
    {
        return [...array_keys(self::GROUPS), 'other'];
    }
}
