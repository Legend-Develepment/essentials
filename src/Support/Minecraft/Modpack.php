<?php

namespace LegendDevelopment\Theme\Support\Minecraft;

use Throwable;

/**
 * What a Modrinth modpack index says, turned into something safe to act on.
 *
 * A .mrpack is a zip holding modrinth.index.json and an overrides folder. The
 * index is a list of files, each with a path on the server and a URL to fetch
 * it from - so installing a pack means asking the daemon to pull a couple of
 * hundred files to a couple of hundred paths, and **the paths come from the
 * internet**.
 *
 * That is the whole reason this class exists on its own. Everything that
 * decides where a byte lands is here, in one place, with nothing else in it -
 * so it can be read in one sitting and tested without a Minecraft server.
 *
 * Three rules, and each one is a way somebody could otherwise write outside the
 * server:
 *
 *  - A path is relative, uses forward slashes, and contains no `..` segment.
 *    `../../etc/passwd` is the obvious attempt; `mods/../../..` is the same
 *    attempt written by somebody who read a blog post about it.
 *  - A download is https and points at a Modrinth CDN host. A pack index that
 *    asks for a file from somewhere else is not a pack this will install, which
 *    costs nothing real - Modrinth requires its own CDN for hosted files.
 *  - Client-only files are skipped. A server that downloads two hundred
 *    megabytes of shaders and resource packs it will never load is a server
 *    with a full disk.
 */
class Modpack
{
    /** Where a Modrinth-hosted file is allowed to come from. */
    private const HOSTS = ['cdn.modrinth.com', 'cdn-raw.modrinth.com'];

    /**
     * A pack is a few hundred files. Ten times that is not a pack, it is
     * something that would keep a daemon busy for an hour.
     */
    public const MAX_FILES = 600;

    /**
     * The files a server should actually fetch, in the order the index gave
     * them.
     *
     * @param  array<string, mixed>  $index
     * @return array<int, array{path: string, url: string, size: int}>
     */
    public static function files(array $index): array
    {
        $files = [];

        foreach (($index['files'] ?? []) as $entry) {
            if (!is_array($entry)) {
                continue;
            }

            $path = self::path($entry['path'] ?? null);
            $url = self::url($entry['downloads'] ?? null);

            if ($path === null || $url === null || !self::wantedOnServer($entry)) {
                continue;
            }

            $files[] = [
                'path' => $path,
                'url' => $url,
                'size' => is_numeric($entry['fileSize'] ?? null) ? (int) $entry['fileSize'] : 0,
            ];

            if (count($files) >= self::MAX_FILES) {
                break;
            }
        }

        return $files;
    }

    /**
     * A path from the index, or null if it is not one this will write to.
     */
    public static function path(mixed $path): ?string
    {
        if (!is_string($path)) {
            return null;
        }

        // Backslashes first: a Windows-style separator would sail past a check
        // that only looks for "../" and land wherever the daemon resolves it.
        $path = str_replace('\\', '/', trim($path));

        if ($path === '' || str_starts_with($path, '/')) {
            return null;
        }

        // A drive letter is not a relative path, whatever the slashes say.
        if (preg_match('#^[A-Za-z]:#', $path) === 1) {
            return null;
        }

        foreach (explode('/', $path) as $segment) {
            // '..' walks out of the server. '' is a doubled slash, which is
            // harmless but means the path was not written carefully, and a
            // path not written carefully is not one to trust with a write.
            if ($segment === '..' || $segment === '' || $segment === '.') {
                return null;
            }
        }

        return $path;
    }

    /**
     * The first download that is one this will fetch from.
     */
    public static function url(mixed $downloads): ?string
    {
        if (!is_array($downloads)) {
            return null;
        }

        foreach ($downloads as $candidate) {
            if (!is_string($candidate)) {
                continue;
            }

            try {
                $parts = parse_url($candidate);
            } catch (Throwable) {
                continue;
            }

            if (!is_array($parts)) {
                continue;
            }

            $scheme = strtolower((string) ($parts['scheme'] ?? ''));
            $host = strtolower((string) ($parts['host'] ?? ''));

            if ($scheme === 'https' && in_array($host, self::HOSTS, true)) {
                return $candidate;
            }
        }

        return null;
    }

    /**
     * Whether a server wants this file.
     *
     * The index marks each file required, optional or unsupported per side. A
     * server takes anything not marked unsupported for it - optional means the
     * pack author left the choice open, and on a server the useful default is
     * to have it.
     *
     * A file with no env at all is taken: older packs omit it, and the pack
     * would be missing its mods if that were read as "not for the server".
     *
     * @param  array<string, mixed>  $entry
     */
    public static function wantedOnServer(array $entry): bool
    {
        $env = $entry['env'] ?? null;

        if (!is_array($env)) {
            return true;
        }

        return ($env['server'] ?? 'required') !== 'unsupported';
    }

    /**
     * What the pack says it needs, for showing before anything is installed.
     *
     * @param  array<string, mixed>  $index
     * @return array<string, string>
     */
    public static function dependencies(array $index): array
    {
        $found = [];

        foreach (($index['dependencies'] ?? []) as $name => $version) {
            if (is_string($name) && is_scalar($version)) {
                $found[$name] = (string) $version;
            }
        }

        return $found;
    }
}
