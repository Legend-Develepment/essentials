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
    public static function search(string $query = '', int $limit = 20): array
    {
        $query = trim(mb_substr($query, 0, 100));
        $limit = max(1, min(50, $limit));

        try {
            $key = 'legend-theme.modrinth.' . md5($query . '|' . $limit);

            $hits = cache()->remember(
                $key,
                now()->addMinutes(self::CACHE_MINUTES),
                static function () use ($query, $limit): array {
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
                                ['project_type:modpack'],
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
    public static function options(string $query = ''): array
    {
        $options = [];

        foreach (self::search($query) as $hit) {
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
            $response = Http::withHeaders(['User-Agent' => self::AGENT])
                ->timeout(self::TIMEOUT)
                ->connectTimeout(3)
                ->get(self::BASE . '/project/' . rawurlencode($slug) . '/version');

            if (!$response->successful()) {
                return [];
            }

            $versions = $response->json();

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
