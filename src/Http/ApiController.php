<?php

namespace LegendDevelopment\Theme\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use LegendDevelopment\Theme\Models\Key;
use LegendDevelopment\Theme\Support\Api\Keys;
use LegendDevelopment\Theme\Support\Channels;
use Throwable;

/**
 * The API, which at 0.0.1 answers one question: whether it is there.
 *
 * That is not a placeholder. roadmap/api.md puts the door before the rooms on
 * purpose - a surface that can be switched on, seen, rate-limited and revoked
 * before it can report anything is a surface whose every dangerous part has
 * been exercised while the worst case was still "it says hello to nobody".
 * Endpoints over what Support already works out are step two, and they are
 * cheap precisely because this is right.
 *
 * **Two versions, and they are different things.** The path carries `v1`, which
 * is a promise about the shape of what comes back and changes only when that
 * shape breaks. `api` in the body is this implementation, and it starts at
 * 0.0.1 because it is young. A bot should read the second and refuse to be
 * surprised by it.
 *
 * **Every failure looks the same from outside.** A missing header, a malformed
 * key, a prefix that does not exist, a secret that does not match, a key
 * revoked this morning, one that expired, one whose owner was deleted: all 401,
 * all the same body. Saying which would be telling somebody which half of a key
 * they had right. The one exception is the feature being off, which is a 404 -
 * and only because the route does not exist at all in that case, so there is
 * nothing here to say it.
 */
class ApiController
{
    /** The shape of what comes back. In the path, so a bot can pin it. */
    public const CONTRACT = 'v1';

    /** This implementation. Young, and saying so. */
    public const VERSION = '0.0.1';

    public function __invoke(Request $request): JsonResponse
    {
        $key = Keys::verify($this->presented($request));

        if ($key === null) {
            return $this->refused();
        }

        if (!$this->addressAllowed($key, $request)) {
            return $this->refused();
        }

        $limit = Keys::rate();
        $left = $this->take($key, $limit);

        if ($left === null) {
            /*
             * 429 with the ceiling in it. A bot that is told only "no" retries
             * immediately and makes it worse; one told the number can wait.
             */
            return response()->json([
                'error' => 'too_many_requests',
                'rate' => ['limit' => $limit, 'remaining' => 0],
            ], 429);
        }

        Keys::touch($key);

        return response()->json([
            'essentials' => [
                'contract' => self::CONTRACT,
                'api' => self::VERSION,
                'plugin' => $this->plugin(),
            ],
            'key' => [
                'name' => $key->name,
                'prefix' => $key->prefix,
                'scope' => $key->scope,
                'expires_at' => $key->expires_at?->toIso8601String(),
            ],
            /*
             * Who the key answers as. A bot that has been handed the wrong key
             * finds out here rather than by wondering why a list is short.
             */
            'acting_for' => [
                'id' => $key->user?->id,
                'username' => $key->user?->username,
            ],
            'rate' => ['limit' => $limit, 'remaining' => $left],
        ]);
    }

    /**
     * The key a request is carrying.
     *
     * `Authorization: Bearer <key>` and nothing else. No query parameter, ever:
     * a key in a URL is a key in the panel's access log, in whatever sits in
     * front of it, and in the browser history of anybody who pasted it once to
     * see what happened.
     */
    private function presented(Request $request): ?string
    {
        $header = trim((string) $request->header('Authorization', ''));

        if (!str_starts_with(strtolower($header), 'bearer ')) {
            return null;
        }

        $value = trim(substr($header, 7));

        return $value === '' ? null : $value;
    }

    /**
     * Whether this key may be used from where the request came from.
     *
     * An empty list means anywhere, which is the default and is right: most
     * bots move between hosts and an allow-list nobody maintains is a feature
     * that locks people out on the day they redeploy. Where somebody has set
     * one, it is exact - no ranges at 0.0.1, because a half-understood CIDR
     * check is worse than none.
     */
    private function addressAllowed(Key $key, Request $request): bool
    {
        $allowed = $key->allowed_ips;

        if (!is_array($allowed) || $allowed === []) {
            return true;
        }

        return in_array((string) $request->ip(), $allowed, true);
    }

    /**
     * One request against this key's ceiling, or null when it is spent.
     *
     * Keyed on the key rather than on the address, because the address is the
     * bot's host and one host may hold several keys - throttling them together
     * would make one bot's loop everybody else's problem.
     */
    private function take(Key $key, int $limit): ?int
    {
        try {
            $bucket = 'essentials-api:' . $key->prefix;

            if (RateLimiter::tooManyAttempts($bucket, $limit)) {
                return null;
            }

            RateLimiter::hit($bucket, 60);

            return max(0, $limit - RateLimiter::attempts($bucket));
        } catch (Throwable) {
            /*
             * No cache store, or one that is refusing. The request is allowed
             * through rather than turned away: this is a read-only endpoint
             * behind a key somebody granted, and a panel whose cache is broken
             * has a louder problem than an unthrottled bot.
             */
            return $limit;
        }
    }

    /** Which build of the plugin is answering, for a bug report that makes sense. */
    private function plugin(): string
    {
        try {
            return Channels::installedVersion();
        } catch (Throwable) {
            return 'unknown';
        }
    }

    /** One answer for every way a key can fail to be one. */
    private function refused(): JsonResponse
    {
        return response()->json(['error' => 'unauthorized'], 401);
    }
}
