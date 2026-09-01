<?php

namespace LegendDevelopment\Theme\Support\Minecraft;

use App\Models\Server;
use App\Repositories\Daemon\DaemonFileRepository;
use Throwable;

/**
 * Putting a Modrinth modpack onto a server, through the daemon and nothing else.
 *
 * A .mrpack is not a folder of mods. It is a zip holding modrinth.index.json -
 * a list of files, each with a path and a URL - and an `overrides` folder of
 * everything the pack ships directly. Installing one means fetching the pack,
 * reading its index, and asking the daemon to pull every listed file to its
 * place.
 *
 * **Nothing is deleted.** Not the world, not the old mods, not a config. The
 * other plugin this idea came from cleans up old pack files, and that is a
 * reasonable thing to want and a terrible thing to get wrong on somebody's
 * server behind a button that says Install. A pack installed over another
 * leaves both, which is a mess somebody can see and sort out; a pack that
 * deleted the wrong folder is a restore from backup.
 *
 * So this adds. Two hundred files is a slow operation and it runs in a job -
 * see Jobs\InstallModpack, which is also where the count of what worked and
 * what did not comes from.
 */
class Installer
{
    /** Where the pack is unpacked before its contents are placed. */
    public const WORK = '.essentials-modpack';

    /**
     * The index, read out of an unpacked pack.
     *
     * @return array<string, mixed>|null
     */
    public static function index(Server $server): ?array
    {
        try {
            $contents = (new DaemonFileRepository())
                ->setServer($server)
                ->getContent(self::WORK . '/modrinth.index.json', 2097152);

            $decoded = json_decode($contents, true);

            return is_array($decoded) ? $decoded : null;
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * Fetch the .mrpack and unpack it into the working folder.
     */
    public static function fetch(Server $server, string $url, string $filename): bool
    {
        try {
            $daemon = (new DaemonFileRepository())->setServer($server);

            // Left over from a previous attempt, and its index would be read as
            // this pack's. Removed before anything is written rather than after
            // - a run that failed halfway is exactly when this matters.
            self::clean($server);

            $daemon->createDirectory(self::WORK, '/');

            /*
             * foreground, and this one has to be.
             *
             * The daemon's pull is a background fetch by default: it answers
             * immediately and gets the file when it gets it. That is right for
             * two hundred mods and wrong for this one, because the very next
             * line unpacks the archive - and unpacking a file that has not
             * arrived yet fails in a way that reads as "the pack is broken".
             */
            $daemon->pull($url, self::WORK, ['filename' => $filename, 'foreground' => true]);
            $daemon->decompressFile(self::WORK, $filename);

            return true;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * Ask the daemon to fetch one file to where the index says it goes.
     *
     * The path has already been through Modpack::path(), which is the only
     * thing standing between an index from the internet and a write outside the
     * server. It is checked again here anyway: this method is the one that
     * writes, and a check at the point of writing is the one that cannot be
     * skipped by a future caller.
     */
    public static function place(Server $server, string $path, string $url): bool
    {
        $path = Modpack::path($path);
        $url = Modpack::url([$url]);

        if ($path === null || $url === null) {
            return false;
        }

        $at = strrpos($path, '/');
        $directory = $at === false ? '/' : substr($path, 0, $at);
        $filename = $at === false ? $path : substr($path, $at + 1);

        try {
            $daemon = (new DaemonFileRepository())->setServer($server);

            if ($directory !== '/') {
                // Harmless if it is already there, and the pull needs somewhere
                // to land.
                try {
                    $daemon->createDirectory($directory, '/');
                } catch (Throwable) {
                    // Already exists, which is the usual case after the first
                    // file in a folder.
                }
            }

            $daemon->pull($url, $directory, ['filename' => $filename]);

            return true;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * Everything in the pack's `overrides` folder belongs at the server root.
     *
     * Done by the daemon's own move, one entry at a time, so a folder that is
     * already there is merged rather than replaced.
     *
     * @param  array<int, string>  $names
     */
    public static function overrides(Server $server, array $names): int
    {
        $moved = 0;
        $daemon = (new DaemonFileRepository())->setServer($server);

        foreach ($names as $name) {
            $name = Modpack::path($name);

            if ($name === null) {
                continue;
            }

            try {
                $daemon->renameFiles('/', [[
                    'from' => self::WORK . '/overrides/' . $name,
                    'to' => $name,
                ]]);

                $moved++;
            } catch (Throwable) {
                // One override that will not move is one file the pack shipped,
                // not a reason to abandon the other hundred.
            }
        }

        return $moved;
    }

    /**
     * What is in the pack's overrides folder.
     *
     * @return array<int, string>
     */
    public static function overrideNames(Server $server): array
    {
        try {
            $entries = (new DaemonFileRepository())
                ->setServer($server)
                ->getDirectory(self::WORK . '/overrides');

            $names = [];

            foreach ($entries as $entry) {
                $name = is_array($entry) ? ($entry['name'] ?? null) : null;

                if (is_string($name) && $name !== '') {
                    $names[] = $name;
                }
            }

            return $names;
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * Take the working folder away again.
     *
     * The one delete this class does, and it only ever names a folder this
     * class created.
     */
    public static function clean(Server $server): void
    {
        try {
            (new DaemonFileRepository())
                ->setServer($server)
                ->deleteFiles('/', [self::WORK]);
        } catch (Throwable) {
            // Nothing there, or a daemon that will not answer. A working folder
            // left behind is untidy and harmless, and the next run removes it.
        }
    }
}
