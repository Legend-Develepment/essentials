<?php

namespace LegendDevelopment\Theme\Support\Artwork;

use App\Models\Egg;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Artwork from IGDB, for everything that is not on Steam.
 *
 * A game server panel is full of games Steam has never heard of - Minecraft and
 * every fork of it, Terraria servers, anything that shipped on a console, half
 * the modded eggs - so Steam alone leaves a lot of grey birds behind. IGDB
 * knows those, and it is free.
 *
 * It is the fallback rather than the default because it costs something to set
 * up: IGDB authenticates through Twitch, so somebody has to make a Twitch
 * developer application and paste two values in. Nothing here nags about that.
 * With no credentials the whole feature is simply not offered, which is the
 * honest state of a thing that cannot work.
 *
 * The token is cached, and that is not an optimisation. Twitch issues one good
 * for about sixty days and rate-limits the endpoint that issues them, so a bulk
 * run over four hundred eggs that asked each time would be four hundred
 * requests for the same token and would be throttled long before it finished.
 */
class Igdb
{
    private const TOKEN_URL = 'https://id.twitch.tv/oauth2/token';

    private const API = 'https://api.igdb.com/v4/games';

    private const IMAGE = 'https://images.igdb.com/igdb/image/upload/t_cover_big/%s.jpg';

    private const TIMEOUT = 10;

    /** A day short of nothing, and a long way short of the token's real life. */
    private const TOKEN_TTL = 86400;

    public static function configured(): bool
    {
        return self::clientId() !== '' && self::clientSecret() !== '';
    }

    private static function clientId(): string
    {
        return trim((string) Theme::config('igdb_client_id', ''));
    }

    private static function clientSecret(): string
    {
        return trim((string) Theme::config('igdb_client_secret', ''));
    }

    /**
     * A picture for a name.
     *
     * Always protects what it finds, which is the opposite of the Steam search
     * and is deliberate: this only ever runs after Steam has already failed or
     * been skipped, so an answer from here is the last one available. Leaving
     * it unprotected would mean the next bulk run reaching for Steam again and
     * replacing a correct picture with nothing.
     *
     * @return string|null  null on success, otherwise why not
     */
    public static function byName(Egg $egg, ?string $term = null): ?string
    {
        if (!self::configured()) {
            return 'not_configured';
        }

        $term = trim($term ?? (string) $egg->name);

        if ($term === '') {
            return 'no_name';
        }

        $token = self::token();

        if ($token === null) {
            return 'no_token';
        }

        $imageId = self::cover($term, $token);

        if ($imageId === null) {
            return 'no_match';
        }

        $body = self::download(sprintf(self::IMAGE, $imageId));

        if ($body === null) {
            return 'not_found';
        }

        $problem = Artwork::store($egg, $body);

        if ($problem !== null) {
            return $problem;
        }

        Artwork::protect($egg);

        return null;
    }

    /**
     * The cover image id for a search term.
     *
     * IGDB's query language goes in the request body as plain text, and the
     * search term goes inside double quotes in it. So the term is stripped of
     * the two characters that could end that string early rather than escaped -
     * a backslash is not an escape in their syntax, so escaping is not
     * available, and a game whose name contains a quote is a search that finds
     * nothing rather than a request that means something else.
     */
    private static function cover(string $term, string $token): ?string
    {
        $term = trim(preg_replace('/["\\\\\r\n]+/', ' ', $term) ?? '');

        if ($term === '') {
            return null;
        }

        try {
            $response = Http::timeout(self::TIMEOUT)
                ->withHeaders([
                    'Client-ID' => self::clientId(),
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ])
                ->withBody(
                    'search "' . mb_substr($term, 0, 120) . '"; fields name,cover.image_id; limit 1;',
                    'text/plain',
                )
                ->post(self::API);

            if (!$response->successful()) {
                // A 401 means the cached token has been revoked rather than
                // merely expired. Dropping it means the next attempt asks for a
                // fresh one instead of failing for a day.
                if ($response->status() === 401) {
                    self::forget();
                }

                return null;
            }

            $games = $response->json();

            if (!is_array($games) || $games === []) {
                return null;
            }

            $id = $games[0]['cover']['image_id'] ?? null;

            return is_string($id) && $id !== '' ? $id : null;
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * The access token, asked for once and kept.
     *
     * Keyed on the credentials rather than on a fixed name, so changing them in
     * the settings takes effect at once instead of at the end of the cached
     * day. A failure is not cached: a token endpoint that was briefly
     * unreachable should not disable the feature until tomorrow.
     */
    private static function token(): ?string
    {
        $key = 'legend-theme.igdb.' . md5(self::clientId() . '|' . self::clientSecret());

        try {
            $held = Cache::get($key);

            if (is_string($held) && $held !== '') {
                return $held;
            }
        } catch (Throwable) {
            // An unreadable cache is one request per attempt, not a failure.
        }

        try {
            $response = Http::timeout(self::TIMEOUT)->asForm()->post(self::TOKEN_URL, [
                'client_id' => self::clientId(),
                'client_secret' => self::clientSecret(),
                'grant_type' => 'client_credentials',
            ]);

            if (!$response->successful()) {
                return null;
            }

            $token = $response->json('access_token');

            if (!is_string($token) || $token === '') {
                return null;
            }

            try {
                Cache::put($key, $token, self::TOKEN_TTL);
            } catch (Throwable) {
                // Works without a cache, just less politely.
            }

            return $token;
        } catch (Throwable) {
            return null;
        }
    }

    /** Drops the held token. Called when Twitch says it is no longer good. */
    public static function forget(): void
    {
        try {
            Cache::forget('legend-theme.igdb.' . md5(self::clientId() . '|' . self::clientSecret()));
        } catch (Throwable) {
            // Nothing worth failing a fetch over.
        }
    }

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
