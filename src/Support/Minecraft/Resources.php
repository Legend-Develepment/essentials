<?php

namespace LegendDevelopment\Theme\Support\Minecraft;

use App\Models\Server;
use App\Repositories\Daemon\DaemonFileRepository;
use Throwable;

/**
 * Single mods and plugins, rather than whole modpacks.
 *
 * The modpack page already installs a pack: one archive holding a manifest, a
 * few hundred files and their own download addresses. This is the other half of
 * the same job and is much smaller - one jar into one folder - but it is the
 * half people do far more often. Somebody wants Vault on their Paper server,
 * not a two-hundred-mod pack.
 *
 * Modrinth only, and that is a deliberate narrowing rather than an oversight.
 * The plugin this follows offers CurseForge as a second source, which needs an
 * API key that every administrator would have to get for themselves, put into a
 * settings field, and keep. Modrinth needs nothing, its CDN is already on this
 * plugin's host allowlist, and the download path is the one the modpack
 * installer has been using.
 *
 * Two folders and no others, which is this class's reason for existing. A mod
 * goes in mods/, a plugin goes in plugins/, and a folder chosen anywhere else
 * would be a write to an arbitrary path on somebody's server.
 */
class Resources
{
    /**
     * Where each project type belongs.
     *
     * Fabric, Forge and NeoForge read mods/; Bukkit, Spigot and Paper read
     * plugins/. Modrinth's own project types line up with that split exactly,
     * which is why the mapping is this short and why it is safe to derive the
     * destination from the type rather than asking.
     */
    public const FOLDERS = ['mod' => 'mods', 'plugin' => 'plugins'];

    /** A jar and nothing else. */
    private const EXTENSION = '.jar';

    /**
     * Long lists happen - a big Paper server runs sixty plugins - but a folder
     * with thousands of entries in it is a folder something has gone wrong in,
     * and not one worth drawing.
     */
    private const MAX_FILES = 400;

    /**
     * The folder for a project type, or null.
     *
     * Everything that writes goes through here. A type that is not one of the
     * two has no folder, and no caller can invent one: the strings 'mods' and
     * 'plugins' appear once, above.
     */
    public static function folder(mixed $type): ?string
    {
        return is_string($type) ? (self::FOLDERS[$type] ?? null) : null;
    }

    /**
     * What is in one of the two folders now.
     *
     * Only jars. A folder also holds config directories, .jar.disabled files
     * somebody has parked, and whatever else has been dropped in; listing those
     * beside a Remove button would be offering to delete things this page knows
     * nothing about.
     *
     * @return array<int, array{name: string, size: int}>
     */
    public static function installed(Server $server, string $type): array
    {
        $folder = self::folder($type);

        if ($folder === null) {
            return [];
        }

        try {
            $entries = (new DaemonFileRepository())
                ->setServer($server)
                ->getDirectory('/' . $folder);

            if (!is_array($entries)) {
                return [];
            }

            $files = [];

            foreach ($entries as $entry) {
                if (!is_array($entry) || ($entry['directory'] ?? false) === true) {
                    continue;
                }

                $name = is_string($entry['name'] ?? null) ? $entry['name'] : '';

                // Through the same validator a downloaded filename goes
                // through: this list feeds a Remove button, and a name the
                // daemon reported is still a name from outside this code.
                if (self::filename($name) === null) {
                    continue;
                }

                $files[] = ['name' => $name, 'size' => (int) ($entry['size'] ?? 0)];
            }

            usort($files, static fn (array $a, array $b): int => strcasecmp($a['name'], $b['name']));

            return array_slice($files, 0, self::MAX_FILES);
        } catch (Throwable) {
            // No such folder yet, which is what a server that has never run a
            // mod looks like. An empty list is the true answer.
            return [];
        }
    }

    /**
     * A jar's filename, or null.
     *
     * The same shape of check as Modpack::path(), and for the same reason: this
     * name is joined to a folder and handed to the daemon as somewhere to write
     * or something to delete. A name holding a slash or a pair of dots is a
     * name that leaves the folder it was supposed to be in.
     */
    public static function filename(mixed $value): ?string
    {
        if (!is_string($value)) {
            return null;
        }

        $name = trim($value);

        if ($name === '' || mb_strlen($name) > 200) {
            return null;
        }

        // Anything that could be read as a path rather than a name.
        if (str_contains($name, '/') || str_contains($name, '\\') || str_contains($name, "\0")) {
            return null;
        }

        // '.' and '..' are caught by this too, having no .jar on the end.
        if (!str_ends_with(strtolower($name), self::EXTENSION)) {
            return null;
        }

        return $name;
    }

    /**
     * Put one jar in the right folder.
     *
     * The download itself is Installer::place(), which already checks the
     * address against the CDN allowlist and has the daemon fetch it directly -
     * the file never passes through the panel.
     */
    public static function install(Server $server, string $type, string $filename, string $url): bool
    {
        $folder = self::folder($type);
        $name = self::filename($filename);

        if ($folder === null || $name === null) {
            return false;
        }

        return Installer::place($server, $folder . '/' . $name, $url);
    }

    /**
     * Take one out again.
     *
     * Deliberately one file at a time and only ever a validated .jar inside one
     * of the two folders. There is no "remove all" here: the file manager is
     * where somebody who wants to empty a directory should be, with the
     * confirmations Pelican puts in front of it.
     */
    public static function remove(Server $server, string $type, string $filename): bool
    {
        $folder = self::folder($type);
        $name = self::filename($filename);

        if ($folder === null || $name === null) {
            return false;
        }

        try {
            (new DaemonFileRepository())
                ->setServer($server)
                ->deleteFiles('/' . $folder, [$name]);

            return true;
        } catch (Throwable) {
            return false;
        }
    }

    /** A size as something readable, because a byte count is read and not audited. */
    public static function size(int $bytes): string
    {
        return match (true) {
            $bytes >= 1048576 => round($bytes / 1048576, 1) . ' MB',
            $bytes >= 1024 => round($bytes / 1024) . ' KB',
            default => $bytes . ' B',
        };
    }
}
