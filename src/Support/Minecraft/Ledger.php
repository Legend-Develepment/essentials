<?php

namespace LegendDevelopment\Theme\Support\Minecraft;

use App\Models\Server;
use Illuminate\Support\Facades\Storage;
use Throwable;

/**
 * Which Modrinth project each installed jar came from.
 *
 * Without this there is no such thing as updating a mod, and the reason is
 * worth stating plainly because it is not obvious: an installed mod is a
 * filename in a folder, and a filename does not say which project it is.
 * `EssentialsX-2.20.1.jar` looks like it does, right up until the file is
 * called `essx.jar` or `plugin.jar` or carries a build number nobody can parse.
 * Guessing the project from the name would be wrong often enough to install the
 * wrong mod over somebody's server, which is worse than not offering it.
 *
 * The exact way is Modrinth's hash lookup - it will name the project for a
 * file's SHA-1 - and it is not available here: the file is on a node, the panel
 * would have to pull the whole jar through itself to hash it, and it would have
 * to do that once per file on every page load.
 *
 * So this writes down what it installed, at the moment it installs it, when the
 * project and the version are already known for certain. Anything installed
 * through this page can be updated. Anything that was already there cannot be,
 * until somebody says once what it is - which is what the match action on the
 * page is for, and which is a question a person can answer and this code
 * cannot.
 *
 * Kept on the panel rather than in the server's own directory. A file in the
 * server folder would travel with the server, which is a real advantage, and it
 * would also be one more unexplained file in somebody's mods directory for them
 * to delete or wonder about. Losing this record costs the update button and
 * nothing else - the mods themselves are untouched, and a match puts it back.
 */
class Ledger
{
    private const DIRECTORY = 'legend-theme/resources';

    /**
     * A cap, because this is written from a page and read from a page and both
     * would rather truncate than fail. Four hundred is the same bound the
     * folder listing uses.
     */
    private const MAX_ENTRIES = 400;

    /**
     * Everything recorded for one server, keyed by folder and filename.
     *
     * Reconciled against nothing here: an entry whose file has since been
     * deleted by hand is harmless, and the page only ever looks up entries for
     * files it has actually listed.
     *
     * @return array<string, array{project: string, name: string, version: string, number: string}>
     */
    public static function all(Server $server): array
    {
        try {
            $disk = Storage::disk('local');
            $path = self::path($server);

            if ($path === null || !$disk->exists($path)) {
                return [];
            }

            $decoded = json_decode((string) $disk->get($path), true);

            if (!is_array($decoded)) {
                return [];
            }

            $out = [];

            foreach ($decoded as $key => $entry) {
                if (!is_string($key) || !is_array($entry)) {
                    continue;
                }

                $clean = self::entry($entry);

                if ($clean !== null) {
                    $out[$key] = $clean;
                }
            }

            return $out;
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * What is known about one file, or null.
     *
     * @return array{project: string, name: string, version: string, number: string}|null
     */
    public static function find(Server $server, string $kind, string $filename): ?array
    {
        $key = self::key($kind, $filename);

        return $key === null ? null : (self::all($server)[$key] ?? null);
    }

    /**
     * Write down that this file is this version of this project.
     *
     * @param  array<string, mixed>  $version
     */
    public static function remember(
        Server $server,
        string $kind,
        string $filename,
        string $slug,
        string $projectName,
        array $version,
    ): void {
        $key = self::key($kind, $filename);

        if ($key === null) {
            return;
        }

        $entries = self::all($server);

        $entries[$key] = [
            'project' => mb_substr($slug, 0, 100),
            'name' => Players::reason($projectName, 80),
            'version' => mb_substr((string) ($version['id'] ?? ''), 0, 40),
            'number' => Players::reason((string) ($version['version_number'] ?? ''), 40),
        ];

        self::put($server, $entries);
    }

    /** Forget one, which is what removing the file means. */
    public static function forget(Server $server, string $kind, string $filename): void
    {
        $key = self::key($kind, $filename);

        if ($key === null) {
            return;
        }

        $entries = self::all($server);

        if (!array_key_exists($key, $entries)) {
            return;
        }

        unset($entries[$key]);

        self::put($server, $entries);
    }

    /* ------------------------------------------------------------ inside -- */

    /**
     * The key for a file, or null when either half is not one.
     *
     * Built from the same two validators the writes use, so a key can only ever
     * describe a real folder and a real jar name. This string reaches a
     * filename on disk, so it is not allowed to be anything else.
     */
    private static function key(string $kind, string $filename): ?string
    {
        $folder = Resources::folder($kind);
        $name = Resources::filename($filename);

        return $folder === null || $name === null ? null : $folder . '/' . $name;
    }

    /**
     * @param  array<string, mixed>  $entry
     * @return array{project: string, name: string, version: string, number: string}|null
     */
    private static function entry(array $entry): ?array
    {
        $slug = $entry['project'] ?? null;

        // The slug is put into a Modrinth URL, so it is held to the same shape
        // Modrinth::versions() holds it to rather than trusted for having been
        // written by this class - a file on disk is a file somebody can edit.
        if (!is_string($slug) || preg_match('/^[A-Za-z0-9!@$()`.+,_"\-]{1,100}$/D', $slug) !== 1) {
            return null;
        }

        return [
            'project' => $slug,
            'name' => Players::reason($entry['name'] ?? null, 80),
            'version' => is_string($entry['version'] ?? null) ? mb_substr($entry['version'], 0, 40) : '',
            'number' => Players::reason($entry['number'] ?? null, 40),
        ];
    }

    /**
     * @param  array<string, array{project: string, name: string, version: string, number: string}>  $entries
     */
    private static function put(Server $server, array $entries): void
    {
        $path = self::path($server);

        if ($path === null) {
            return;
        }

        try {
            Storage::disk('local')->put(
                $path,
                (string) json_encode(array_slice($entries, 0, self::MAX_ENTRIES, true), JSON_PRETTY_PRINT),
            );
        } catch (Throwable) {
            // The record does not stick, which costs the update button on that
            // file and nothing else. Not worth failing an install that worked.
        }
    }

    /**
     * One file per server, named by its uuid.
     *
     * The uuid rather than the id because it is what everything else about a
     * server is keyed on, and it is checked rather than interpolated - this
     * becomes a path.
     */
    private static function path(Server $server): ?string
    {
        $uuid = (string) ($server->uuid ?? '');

        if (preg_match('/^[0-9a-fA-F-]{8,64}$/D', $uuid) !== 1) {
            return null;
        }

        return self::DIRECTORY . '/' . $uuid . '.json';
    }
}
