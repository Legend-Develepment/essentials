<?php

namespace LegendDevelopment\Theme\Support\Artwork;

use App\Models\Egg;
use Illuminate\Support\Facades\Http;
use Throwable;

/**
 * Artwork from Steam.
 *
 * Steam's header image is a fixed address built from an application id, and it
 * needs no key, no account and no agreement - which is why this is the default
 * and IGDB is the fallback rather than the other way round.
 *
 * Two ways in, and the difference between them matters:
 *
 *  - **By id**, which somebody typed. That is a statement about which game this
 *    egg is, so the picture that comes back is marked as chosen and a later
 *    bulk run leaves it alone.
 *  - **By name**, which is a guess. Steam's store search is good at real titles
 *    and hopeless at "Paper 1.20.4" or an egg named after whoever wrote it, so
 *    what it finds is not marked as chosen - a wrong picture should be
 *    replaceable by the next attempt rather than stuck.
 */
class Steam
{
    private const IMAGE = 'https://cdn.cloudflare.steamstatic.com/steam/apps/%d/header.jpg';

    private const SEARCH = 'https://store.steampowered.com/api/storesearch/';

    /** Long enough for a CDN having a slow day, short enough not to hold a page. */
    private const TIMEOUT = 10;

    /**
     * A picture for an id somebody gave.
     *
     * @return string|null  null on success, otherwise why not
     */
    public static function byAppId(Egg $egg, int $appId): ?string
    {
        if ($appId <= 0) {
            return 'bad_id';
        }

        $body = self::download(sprintf(self::IMAGE, $appId));

        if ($body === null) {
            return 'not_found';
        }

        $problem = Artwork::store($egg, $body);

        if ($problem !== null) {
            return $problem;
        }

        Artwork::setSteamAppId($egg, $appId);

        // Typed by hand, so it is a decision: a bulk run must not undo it.
        Artwork::protect($egg);

        return null;
    }

    /**
     * A picture for whatever Steam thinks this egg is called.
     *
     * Deliberately does not protect what it finds. See the class note.
     *
     * @return string|null  null on success, otherwise why not
     */
    public static function byName(Egg $egg, ?string $term = null): ?string
    {
        $term = trim($term ?? (string) $egg->name);

        if ($term === '') {
            return 'no_name';
        }

        $appId = self::search($term);

        if ($appId === null) {
            return 'no_match';
        }

        $body = self::download(sprintf(self::IMAGE, $appId));

        if ($body === null) {
            return 'not_found';
        }

        $problem = Artwork::store($egg, $body);

        if ($problem !== null) {
            return $problem;
        }

        // The id is kept even though the picture is not protected: knowing
        // which game this matched is what makes the next attempt cheaper, and
        // what lets somebody see on the page that the guess was wrong.
        Artwork::setSteamAppId($egg, $appId);

        return null;
    }

    /**
     * The first application id Steam's store search answers with.
     *
     * The first and not the best: this endpoint is undocumented and returns
     * what the store would show, which is ranked by something Valve has never
     * published. Picking through the list on some notion of a better match
     * would be guessing about a guess. If it is wrong, the id field on the page
     * is the way to say so, once.
     */
    private static function search(string $term): ?int
    {
        try {
            $response = Http::timeout(self::TIMEOUT)->get(self::SEARCH, [
                'term' => $term,
                'l' => 'english',
                'cc' => 'US',
            ]);

            if (!$response->successful()) {
                return null;
            }

            $items = $response->json('items');

            if (!is_array($items) || $items === []) {
                return null;
            }

            $id = (int) ($items[0]['id'] ?? 0);

            return $id > 0 ? $id : null;
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * The bytes at an address, or null.
     *
     * Steam answers 404 for an id it does not know, which is the common case
     * and not an error worth logging - a typo in a six-digit number is a thing
     * people do, and the page says so where they can see it.
     */
    private static function download(string $url): ?string
    {
        try {
            $response = Http::timeout(self::TIMEOUT)->get($url);

            if (!$response->successful()) {
                return null;
            }

            $body = $response->body();

            return $body === '' ? null : $body;
        } catch (Throwable) {
            return null;
        }
    }
}
