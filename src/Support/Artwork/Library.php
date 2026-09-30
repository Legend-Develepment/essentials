<?php

namespace LegendDevelopment\Theme\Support\Artwork;

use App\Models\Egg;
use Illuminate\Support\Facades\Http;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Artwork from the Essentials artwork library.
 *
 * artwork.essentialsplugins.nl keeps one picked logo per game or piece of
 * server software, found by name, and searching it needs no key. It goes first
 * in a bulk fetch, before Steam: every picture in it was chosen by a person for
 * exactly this, where Steam's store search is a guess.
 *
 * **Not only for eggs.** search(), find(), logo() and logoUrl() answer with
 * plain rows - an id, a name, an https address on the library's own CDN and
 * the size - so anything else in this plugin that draws a game, such as a
 * shop package card, can use the same logos without knowing where they come
 * from. byId() and byName() are the two that put one on an egg.
 *
 * **A match is a name, not a guess.** Only a logo whose name or alias is the
 * egg's name, or the only one that starts with it, is put on an egg by itself.
 * A wrong picture is worse than none, because none is what somebody goes
 * looking for on the egg artwork page.
 *
 * The public half of the library, asked directly, at its own address unless
 * config/essentials.php names another https one. The Essentials modules can
 * also go through Essentials Core, which holds a key; this plugin has no Core
 * to ask and needs no key for anything it does.
 */
class Library
{
    private const DEFAULT_URL = 'https://artwork.essentialsplugins.nl';

    /** Long enough for a library having a slow moment, short enough for a page. */
    private const TIMEOUT = 8;

    /** How long an answer is kept. A miss is asked again sooner than a hit. */
    private const FOUND_FOR = 86400;

    private const MISSING_FOR = 21600;

    private const SEARCH_FOR = 3600;

    /**
     * How many names one request may look up that are not cached yet.
     *
     * A page that draws a card per package, on a cold cache, would otherwise
     * be one round trip per card before anything showed. The rest are looked
     * up on the next request, so a page is slower once rather than slow for as
     * long as the library takes to answer twenty questions.
     *
     * A web request's budget only. A queued job or a command is not a page
     * anybody is waiting on, and a queue worker lives for many jobs, so a
     * count kept in it would run out once and stay out.
     */
    private const PER_REQUEST = 4;

    private static int $cold = 0;

    /**
     * Words an egg's name carries that no logo's does.
     *
     * "Forge Minecraft" is the Forge logo and "Palworld Dedicated Server" is
     * Palworld's. Tried only after the whole name, so a logo that really is
     * called "Minecraft Bedrock" is still found by that name first.
     */
    private const NOISE = ['minecraft', 'server', 'servers', 'dedicated', 'egg', 'vanilla', 'edition', 'the'];

    /* ------------------------------------------------------- the answers -- */

    /**
     * Logos whose name, domain or alias holds the term, for a picker.
     *
     * @return array<int, array{id: int, name: string, url: string, width: int|null, height: int|null}>
     */
    public static function search(string $term, int $limit = 24): array
    {
        $term = trim(mb_substr($term, 0, 200));

        if ($term === '') {
            return [];
        }

        $limit = max(1, min(48, $limit));

        try {
            return cache()->remember(
                self::key('search', $term) . '.' . $limit,
                self::SEARCH_FOR,
                static function () use ($term, $limit): array {
                    try {
                        $response = Http::timeout(self::TIMEOUT)->acceptJson()
                            ->get(self::address() . '/site/api/logos', ['q' => $term, 'limit' => $limit]);

                        return $response->successful() ? self::rows($response->json('items')) : [];
                    } catch (Throwable) {
                        return [];
                    }
                },
            );
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * The one logo that is this name, or null.
     *
     * Only a name that is the logo's own, one of its aliases, or the only logo
     * that starts with it. Held to PER_REQUEST lookups a request that are not
     * cached yet; past that it answers null, and the next request asks.
     *
     * @return array{id: int, name: string, url: string, width: int|null, height: int|null}|null
     */
    public static function find(string $name): ?array
    {
        return self::resolve($name, !app()->runningInConsole());
    }

    /**
     * The address of the logo that is this name, or null. For an img tag.
     */
    public static function logoUrl(string $name): ?string
    {
        return self::find($name)['url'] ?? null;
    }

    /**
     * One logo by the library's own id, or null.
     *
     * A picker sends an id and the address comes from the library, so what is
     * downloaded onto an egg can only ever be something the library holds.
     *
     * @return array{id: int, name: string, url: string, width: int|null, height: int|null}|null
     */
    public static function logo(int $id): ?array
    {
        if ($id <= 0) {
            return null;
        }

        try {
            $cached = cache()->get(self::key('logo', (string) $id));

            if (is_array($cached)) {
                return $cached['row'] ?? null;
            }

            $response = Http::timeout(self::TIMEOUT)->acceptJson()->get(self::address() . '/site/api/logos/' . $id);
            $row = $response->successful() ? (self::rows([$response->json()])[0] ?? null) : null;

            // A logo the library says it does not have is remembered as that.
            // A library having a bad moment is not, so a choice made during
            // one works once it is back rather than six hours later.
            if ($row !== null || $response->status() === 404) {
                cache()->put(self::key('logo', (string) $id), ['row' => $row], $row === null ? self::MISSING_FOR : self::FOUND_FOR);
            }

            return $row;
        } catch (Throwable) {
            return null;
        }
    }

    /* ------------------------------------------------------------ on eggs -- */

    /**
     * A logo somebody picked, written to the egg and locked.
     *
     * @return string|null  null on success, otherwise why not
     */
    public static function byId(Egg $egg, int $id): ?string
    {
        $logo = self::logo($id);

        return $logo === null ? 'library_gone' : self::apply($egg, $logo, true);
    }

    /**
     * Whatever the library holds under this egg's name.
     *
     * Not locked: a match on a name is still the library's idea of what the
     * egg is, and somebody who disagrees should be able to fetch over it.
     * Never held to the per-request budget either, because this is what the
     * bulk fetch asks for every egg in turn.
     *
     * @return string|null  null on success, otherwise why not
     */
    public static function byName(Egg $egg): ?string
    {
        $logo = self::resolve((string) $egg->name, false);

        return $logo === null ? 'no_match' : self::apply($egg, $logo, false);
    }

    /* ----------------------------------------------------------- plumbing -- */

    /**
     * Download a logo onto the egg.
     *
     * An SVG logo is made into WebP by Artwork::store() like any other picture
     * Pelican does not keep. See Raster.
     *
     * @param  array{id: int, name: string, url: string, width: int|null, height: int|null}  $logo
     */
    private static function apply(Egg $egg, array $logo, bool $chosen): ?string
    {
        try {
            $response = Http::timeout(self::TIMEOUT)->get($logo['url']);
            $body = $response->successful() ? $response->body() : '';
        } catch (Throwable) {
            $body = '';
        }

        if ($body === '') {
            return 'library_gone';
        }

        $problem = Artwork::store($egg, $body);

        if ($problem !== null) {
            return $problem;
        }

        Artwork::setLibraryId($egg, $logo['id']);

        if ($chosen) {
            Artwork::protect($egg);
        }

        return null;
    }

    /**
     * find(), with the budget or without it.
     *
     * The answer is cached under the whole name whichever of the names tried
     * found it, so the next ask is one cache read.
     *
     * @return array{id: int, name: string, url: string, width: int|null, height: int|null}|null
     */
    private static function resolve(string $name, bool $budgeted): ?array
    {
        $tries = self::tries($name);

        if ($tries === []) {
            return null;
        }

        try {
            $cached = cache()->get(self::key('find', $tries[0]));

            if (is_array($cached)) {
                return $cached['row'] ?? null;
            }

            if ($budgeted && ++self::$cold > self::PER_REQUEST) {
                return null;
            }

            $row = null;

            foreach ($tries as $try) {
                if (($row = self::matched($try)) !== null) {
                    break;
                }
            }

            cache()->put(self::key('find', $tries[0]), ['row' => $row], $row === null ? self::MISSING_FOR : self::FOUND_FOR);

            return $row;
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * The public search, narrowed to the logo that is this name.
     *
     * @return array{id: int, name: string, url: string, width: int|null, height: int|null}|null
     */
    private static function matched(string $name): ?array
    {
        try {
            $response = Http::timeout(self::TIMEOUT)->acceptJson()
                ->get(self::address() . '/site/api/logos', ['q' => $name, 'limit' => 10]);
            $items = $response->successful() ? $response->json('items') : null;
        } catch (Throwable) {
            return null;
        }

        if (!is_array($items)) {
            return null;
        }

        $wanted = self::flat($name);
        $words = self::words($name);
        $longer = [];

        foreach ($items as $item) {
            if (!is_array($item)) {
                continue;
            }

            $names = [self::flat((string) ($item['name'] ?? ''))];

            foreach (is_array($item['aliases'] ?? null) ? $item['aliases'] : [] as $alias) {
                $names[] = self::flat((string) $alias);
            }

            if (in_array($wanted, $names, true)) {
                return self::rows([$item])[0] ?? null;
            }

            /*
             * Or the logo's name is this one with nothing after it but words
             * no game is named for: "Palworld" is "Palworld Dedicated Server".
             * Whole words, so "Bun" is not the start of "BungeeCord".
             */
            $theirs = self::words((string) ($item['name'] ?? ''));

            if (array_slice($theirs, 0, count($words)) === $words
                && array_diff(array_slice($theirs, count($words)), self::NOISE) === []) {
                $longer[] = $item;
            }
        }

        return count($longer) === 1 ? (self::rows($longer)[0] ?? null) : null;
    }

    /**
     * The names to try for an egg, most specific first.
     *
     * The second only when it is a different name once compared the way the
     * library compares them: "Valheim" without its noise words is "valheim",
     * and asking for it twice is a second round trip for the same answer.
     *
     * @return array<int, string>
     */
    private static function tries(string $name): array
    {
        $name = trim(mb_substr($name, 0, 200));
        $plain = implode(' ', array_diff(self::words($name), self::NOISE));

        return array_values(array_filter(
            [$name, self::flat($plain) === self::flat($name) ? '' : $plain],
            static fn (string $try): bool => self::flat($try) !== '',
        ));
    }

    /**
     * Rows from what the library sent, keeping only what can be drawn.
     *
     * An address that is not https is dropped rather than drawn: a card that
     * loads a picture over plain http is a mixed-content warning on every
     * panel that is served properly, and the egg download goes to the same
     * address.
     *
     * @return array<int, array{id: int, name: string, url: string, width: int|null, height: int|null}>
     */
    private static function rows(mixed $items): array
    {
        if (!is_array($items)) {
            return [];
        }

        $rows = [];

        foreach ($items as $item) {
            $url = is_array($item) ? (string) ($item['url'] ?? '') : '';

            if (!str_starts_with($url, 'https://') || filter_var($url, FILTER_VALIDATE_URL) === false) {
                continue;
            }

            $rows[] = [
                'id' => (int) ($item['id'] ?? 0),
                'name' => mb_substr(trim((string) ($item['name'] ?? '')), 0, 200),
                'url' => $url,
                'width' => is_int($item['width'] ?? null) ? $item['width'] : null,
                'height' => is_int($item['height'] ?? null) ? $item['height'] : null,
            ];
        }

        return $rows;
    }

    /**
     * A name as lower-case words.
     *
     * @return array<int, string>
     */
    private static function words(string $name): array
    {
        return preg_split('/[^\pL\pN]+/u', mb_strtolower($name), -1, PREG_SPLIT_NO_EMPTY) ?: [];
    }

    /** Lower case, letters and digits only: how the library compares names. */
    private static function flat(string $name): string
    {
        return (string) preg_replace('/[^\pL\pN]+/u', '', mb_strtolower($name));
    }

    /** Scoped to the address, so pointing this at another library asks afresh. */
    private static function key(string $kind, string $what): string
    {
        return 'legend-theme.artwork.' . $kind . '.' . md5(self::address() . '|' . self::flat($what));
    }

    /** The configured address when it is https, and the Essentials library otherwise. */
    private static function address(): string
    {
        $configured = rtrim(trim((string) Theme::config('artwork_url', '')), '/');

        return str_starts_with($configured, 'https://') && filter_var($configured, FILTER_VALIDATE_URL) !== false
            ? $configured
            : self::DEFAULT_URL;
    }
}
