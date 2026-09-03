<?php

namespace LegendDevelopment\Theme\Support\Minecraft;

use Illuminate\Support\Facades\Http;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Modrinth's public API, asked politely.
 *
 * The idea comes from N3rdmade's Modpack Manager (MIT), which browses four
 * sources. This does one, and that is a decision rather than a first step:
 * Modrinth needs no key, publishes its terms, and serves a machine-readable
 * index for every pack. CurseForge needs an API key each administrator would
 * have to get and paste in; FTB and ATLauncher each have a format of their own.
 * One source that works without setup beats four that need a form filled in
 * before anything appears.
 *
 * Everything here fails to an empty list. A browser that cannot reach Modrinth
 * shows nothing and says so; it does not take a page down because somebody
 * else's API is having an afternoon.
 */
class Modrinth
{
    private const BASE = 'https://api.modrinth.com/v2';

    /** Modrinth asks that a client identify itself, so it does. */
    private const AGENT = 'Legend-Develepment/essentials (github.com/Legend-Develepment/essentials)';

    /**
     * Long enough that a slow answer still arrives, short enough that a silent
     * one does not hold a page open.
     */
    private const TIMEOUT = 8;

    /** How long a search is worth keeping. Modrinth's catalogue is not urgent. */
    private const CACHE_MINUTES = 10;

    /**
     * Modpacks matching a search, newest and most downloaded first.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function search(string $query = '', int $limit = 20, string $type = 'modpack'): array
    {
        $query = trim(mb_substr($query, 0, 100));
        $limit = max(1, min(50, $limit));

        /*
         * Three project types and no more. Modrinth also carries resource
         * packs and shaders, which are client-side things a server never
         * loads, and an unchecked type here would go straight into a facet.
         */
        $type = in_array($type, ['modpack', 'mod', 'plugin'], true) ? $type : 'modpack';

        try {
            $key = 'legend-theme.modrinth.' . md5($query . '|' . $limit . '|' . $type);

            $hits = cache()->remember(
                $key,
                now()->addMinutes(self::CACHE_MINUTES),
                static function () use ($query, $limit, $type): array {
                    $response = Http::withHeaders(['User-Agent' => self::AGENT])
                        ->timeout(self::TIMEOUT)
                        ->connectTimeout(3)
                        ->get(self::BASE . '/search', [
                            'query' => $query,
                            'limit' => $limit,
                            // Server-side packs only. A client modpack installed
                            // on a server is two hundred megabytes of shaders it
                            // will never load.
                            'facets' => json_encode([
                                ['project_type:' . $type],
                                ['server_side:required', 'server_side:optional'],
                            ]),
                            'index' => 'downloads',
                        ]);

                    if (!$response->successful()) {
                        return [];
                    }

                    $hits = $response->json('hits');

                    return is_array($hits) ? $hits : [];
                },
            );

            return is_array($hits) ? $hits : [];
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * The search results as a picker's options.
     *
     * @return array<string, string>
     */
    public static function options(string $query = '', string $type = 'modpack'): array
    {
        $options = [];

        foreach (self::search($query, 20, $type) as $hit) {
            $slug = $hit['slug'] ?? null;

            if (!is_string($slug) || $slug === '') {
                continue;
            }

            $title = (string) ($hit['title'] ?? $slug);
            $downloads = is_numeric($hit['downloads'] ?? null) ? (int) $hit['downloads'] : 0;

            $options[$slug] = $title . ' — ' . self::round($downloads) . ' ' . Theme::trans('modpack.downloads');
        }

        return $options;
    }

    /**
     * Every version of one pack, newest first.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function versions(string $slug): array
    {
        $slug = trim($slug);

        if ($slug === '' || preg_match('/^[A-Za-z0-9!@$()`.+,_"\-]+$/', $slug) !== 1) {
            return [];
        }

        try {
            /*
             * Cached, because checking a server's installed list for updates
             * asks this once per project and a busy Paper server runs sixty of
             * them. Uncached that was sixty requests to somebody else's API
             * every time the button was pressed, and Modrinth is being asked a
             * favour rather than paid for one.
             */
            $versions = cache()->remember(
                'legend-theme.modrinth.v.' . md5($slug),
                now()->addMinutes(self::CACHE_MINUTES),
                static function () use ($slug): array {
                    $response = Http::withHeaders(['User-Agent' => self::AGENT])
                        ->timeout(self::TIMEOUT)
                        ->connectTimeout(3)
                        ->get(self::BASE . '/project/' . rawurlencode($slug) . '/version');

                    if (!$response->successful()) {
                        return [];
                    }

                    $versions = $response->json();

                    return is_array($versions) ? $versions : [];
                },
            );

            return is_array($versions) ? $versions : [];
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * One pack's versions as a picker's options.
     *
     * @return array<string, string>
     */
    public static function versionOptions(string $slug): array
    {
        $options = [];

        foreach (self::versions($slug) as $version) {
            $id = $version['id'] ?? null;

            if (!is_string($id) || self::pack($version) === null) {
                continue;
            }

            $options[$id] = trim(
                (string) ($version['version_number'] ?? $id)
                . '  ·  ' . implode(', ', array_slice((array) ($version['game_versions'] ?? []), 0, 3))
                . '  ·  ' . implode(', ', (array) ($version['loaders'] ?? []))
            );
        }

        return $options;
    }

    /**
     * One version, by id.
     *
     * @return array<string, mixed>|null
     */
    public static function version(string $slug, string $id): ?array
    {
        foreach (self::versions($slug) as $version) {
            if (($version['id'] ?? null) === $id) {
                return $version;
            }
        }

        return null;
    }

    /**
     * The .mrpack file in a version, which is the only one worth downloading.
     *
     * A version also carries signatures and sometimes a client jar. The pack is
     * the one whose name ends in .mrpack, and it is matched on that rather than
     * on `primary` - primary is the uploader's opinion and the extension is a
     * fact.
     *
     * @param  array<string, mixed>  $version
     * @return array<string, mixed>|null
     */
    public static function pack(array $version): ?array
    {
        foreach (($version['files'] ?? []) as $file) {
            if (!is_array($file)) {
                continue;
            }

            $name = (string) ($file['filename'] ?? '');
            $url = Modpack::url([$file['url'] ?? null]);

            if ($url !== null && str_ends_with(strtolower($name), '.mrpack')) {
                return ['filename' => $name, 'url' => $url, 'size' => (int) ($file['size'] ?? 0)];
            }
        }

        return null;
    }

    /**
     * The single downloadable file in a version of a mod or a plugin.
     *
     * The counterpart to pack() above, and it has to decide differently. A
     * modpack version holds exactly one .mrpack and the extension settles it. A
     * mod version holds a jar, and often several: the mod, a sources jar, a
     * javadoc jar, sometimes a dev build. All of them end in .jar, so the
     * extension decides nothing.
     *
     * So `primary` is used - the uploader saying which one people want - with a
     * fallback to the first jar whose name does not announce itself as one of
     * the others. That is a heuristic and is allowed to be one: the worst case
     * is the wrong jar in mods/, which is visible on the installed list and one
     * click to remove.
     *
     * @param  array<string, mixed>  $version
     * @return array{filename: string, url: string, size: int}|null
     */
    public static function jar(array $version): ?array
    {
        $fallback = null;

        foreach (($version['files'] ?? []) as $file) {
            if (!is_array($file)) {
                continue;
            }

            $name = (string) ($file['filename'] ?? '');
            $url = Modpack::url([$file['url'] ?? null]);

            if ($url === null || !str_ends_with(strtolower($name), '.jar')) {
                continue;
            }

            $found = ['filename' => $name, 'url' => $url, 'size' => (int) ($file['size'] ?? 0)];

            if (($file['primary'] ?? false) === true) {
                return $found;
            }

            $lower = strtolower($name);

            $extra = str_contains($lower, '-sources')
                || str_contains($lower, '-javadoc')
                || str_contains($lower, '-dev')
                || str_contains($lower, '-slim');

            if ($fallback === null && !$extra) {
                $fallback = $found;
            }
        }

        return $fallback;
    }

    /**
     * A project's versions as options, for anything that is not a modpack.
     *
     * versionOptions() above filters on pack(), which hides every version of a
     * mod - a mod has no .mrpack in it.
     *
     * @return array<string, string>
     */
    public static function jarOptions(string $slug): array
    {
        $options = [];

        foreach (self::versions($slug) as $version) {
            $id = $version['id'] ?? null;

            if (!is_string($id) || self::jar($version) === null) {
                continue;
            }

            $options[$id] = trim(
                (string) ($version['version_number'] ?? $id)
                . '  ·  ' . implode(', ', array_slice((array) ($version['game_versions'] ?? []), 0, 3))
                . '  ·  ' . implode(', ', (array) ($version['loaders'] ?? []))
            );
        }

        return $options;
    }

    /**
     * The newest version of a project that has a jar in it.
     *
     * Modrinth returns versions newest first, so this is the first one with an
     * installable file - skipping any release that carries only sources or only
     * a client build.
     *
     * What it does not do is check that the version suits the server. Nothing
     * here knows which Minecraft version or which loader is running, so
     * "newest" is newest and not "newest that will work". The page says so, and
     * the version picker beside it lists what each release is built for.
     *
     * @return array<string, mixed>|null
     */
    public static function newest(string $slug): ?array
    {
        foreach (self::versions($slug) as $version) {
            if (is_array($version) && self::jar($version) !== null) {
                return $version;
            }
        }

        return null;
    }

    /** 16639875 as 16.6M, because a download count is read and not audited. */
    private static function round(int $count): string
    {
        return match (true) {
            $count >= 1000000 => round($count / 1000000, 1) . 'M',
            $count >= 1000 => round($count / 1000) . 'k',
            default => (string) $count,
        };
    }
}
