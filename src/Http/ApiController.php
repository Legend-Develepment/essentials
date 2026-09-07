<?php

namespace LegendDevelopment\Theme\Http;

use App\Models\Server;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use LegendDevelopment\Theme\Models\Key;
use LegendDevelopment\Theme\Support\Alerts\State;
use LegendDevelopment\Theme\Support\Api\Connections;
use LegendDevelopment\Theme\Support\Api\Keys;
use LegendDevelopment\Theme\Support\Backups;
use LegendDevelopment\Theme\Support\Games\A2S;
use LegendDevelopment\Theme\Support\Games\Games;
use LegendDevelopment\Theme\Support\Minecraft\Minecraft;
use LegendDevelopment\Theme\Support\Minecraft\Ping;
use LegendDevelopment\Theme\Support\Channels;
use LegendDevelopment\Theme\Support\NodeHealth;
use LegendDevelopment\Theme\Support\Schedules;
use LegendDevelopment\Theme\Support\SystemStatus;
use Throwable;

/**
 * The API: what this panel knows that Pelican's own does not.
 *
 * Every endpoint here is a second reader of an answer that already exists. The
 * player counts, the backup ages, the watchdog's opinion and the panel host's
 * disks are all worked out for pages somebody looks at; none of it is computed
 * twice and none of it is a new question asked of a node.
 *
 * **Nothing here starts, stops or reaches a server.** roadmap/api.md has the
 * argument in full: Pelican's client API already does that, already checks
 * subuser permissions and already writes the activity log, so a second one
 * would be a second thing to get right and then keep right through every
 * Pelican release. This answers questions and that is all it will ever do.
 *
 * **The reader is always explicit.** There is no session on these requests -
 * the route carries a throttle and nothing else - so `user()` is null, and a
 * support method scoped through it would answer with an empty list rather than
 * failing. That is the fault that silenced every backup alert for several
 * releases, and tools/check-watchdog.js now reads this file for it as well as
 * the watchdog. Anything per-person here goes through the key's own owner.
 *
 * **Two versions, and they are different things.** The path carries `v1`, a
 * promise about the shape of what comes back. `api` in the body is this
 * implementation, and it starts at 0.0.1 because it is young. A bot should read
 * the second and refuse to be surprised by it.
 *
 * **Every failure looks the same from outside.** A missing header, a malformed
 * key, a prefix that does not exist, a secret that does not match, a key
 * revoked this morning, one that expired, one whose owner is gone: all 401,
 * all the same body. Saying which would be telling somebody which half of a key
 * they had right.
 */
class ApiController
{
    /** The shape of what comes back. In the path, so a bot can pin it. */
    public const CONTRACT = 'v1';

    /** This implementation. Young, and saying so. */
    public const VERSION = '0.0.1';

    /* ------------------------------------------------------------ health -- */

    public function health(Request $request): JsonResponse
    {
        return $this->answer($request, Key::PERSON, function (Key $key, int $limit, int $left): array {
            return [
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
                 * Who the key answers as. A bot handed the wrong key finds out
                 * here rather than by wondering why a list is short.
                 */
                'acting_for' => [
                    'id' => $key->user?->id,
                    'username' => $key->user?->username,
                ],
                'rate' => ['limit' => $limit, 'remaining' => $left],
            ];
        });
    }

    /* ------------------------------------------------- the whole panel ---- */

    /** Every machine, and what it is using. Support\NodeHealth's reading. */
    public function nodes(Request $request): JsonResponse
    {
        return $this->answer($request, Key::PANEL, static fn (): array => [
            'nodes' => NodeHealth::nodes([], true),
        ]);
    }

    /**
     * The panel host itself, read from /proc rather than from a shell.
     *
     * Named host() and not for the obvious word. tools/check-banned.js refuses
     * that one followed by a bracket anywhere in the shipped files, because
     * Pelican Hub's submission check reads for it and turned this plugin away
     * once over two method names and two comments explaining that the system
     * status page deliberately avoids the shell. The address is still /system;
     * it is only the method that costs a rename.
     */
    public function host(Request $request): JsonResponse
    {
        return $this->answer($request, Key::PANEL, static fn (): array => [
            'system' => SystemStatus::all(),
        ]);
    }

    /**
     * Which servers have no backup, and which have gone stale.
     *
     * Backups::all() rather than ::query(). The panel-wide one, because there
     * is nobody signed in here and the scoped one would answer with nothing.
     */
    public function backups(Request $request): JsonResponse
    {
        return $this->answer($request, Key::PANEL, static fn (): array => self::backupRows(Backups::all()));
    }

    /** Schedules that have stopped: stuck, overdue, or never run. */
    public function schedules(Request $request): JsonResponse
    {
        return $this->answer($request, Key::PANEL, static fn (): array => [
            'stuck_after_hours' => Schedules::STUCK_HOURS,
            'overdue_after_minutes' => Schedules::OVERDUE_MINUTES,
            'schedules' => Schedules::troubled(),
        ]);
    }

    /** What the watchdog currently thinks is wrong. A JSON file already. */
    public function alerts(Request $request): JsonResponse
    {
        return $this->answer($request, Key::PANEL, static function (): array {
            $out = [];

            foreach (State::all() as $check => $held) {
                $out[] = [
                    'check' => $check,
                    'state' => $held['state'] ?? State::UNREADABLE,
                    'since' => isset($held['since']) ? date('c', (int) $held['since']) : null,
                ];
            }

            return ['alerts' => $out];
        });
    }

    /* --------------------------------------------------- one person's ----- */

    /**
     * The servers this key answers for.
     *
     * Scoped through the key's own owner rather than through user(), which is
     * null here. Backups::forUser() is the same scope the page uses with the
     * reader passed in rather than assumed.
     */
    public function myServers(Request $request): JsonResponse
    {
        return $this->answer($request, Key::PERSON, static function (Key $key): array {
            $rows = [];

            foreach (Backups::forUser($key->user)->get() as $server) {
                /** @var Server $server */
                $rows[] = [
                    'uuid' => (string) $server->uuid,
                    'name' => (string) $server->name,
                    'last_backup_at' => $server->ld_last,
                    'backups' => (int) ($server->ld_kept ?? 0),
                ];
            }

            return ['servers' => $rows];
        });
    }

    /** The same list, narrowed to what is behind. */
    public function myBackups(Request $request): JsonResponse
    {
        return $this->answer($request, Key::PERSON, static fn (Key $key): array => self::backupRows(Backups::forUser($key->user)));
    }

    /**
     * Who is connected to one game server right now.
     *
     * **The only endpoint here that goes near a network.** Everything else
     * reads something the panel already worked out; this asks the game itself.
     * Three things keep it from becoming a load generator pointed at somebody's
     * server, and none of them is new work:
     *
     *  1. both readers cache on the address for twenty seconds, so a hundred
     *     bots asking at once is one query;
     *  2. the per-key ceiling caps how often any one key may ask at all;
     *  3. and the answer says `max_age_seconds`, so a bot can tell a fresh
     *     answer from a held one rather than reporting an empty server that
     *     filled up fifteen seconds ago.
     *
     * The server has to be one the key's owner can open, asked through their
     * own accessibleServers() rather than through user() - which is null here.
     * A uuid they may not reach is a 404 and not a 403: a 403 would confirm the
     * server exists, which is a thing worth not saying to somebody guessing.
     */
    public function players(Request $request, string $server): JsonResponse
    {
        return $this->answer($request, Key::PERSON, function (Key $key) use ($server): array {
            $found = $this->serverFor($key, $server);

            if ($found === null) {
                abort(404);
            }

            $live = Minecraft::detect($found) ? Ping::status($found) : null;

            if ($live !== null) {
                return [
                    'server' => ['uuid' => (string) $found->uuid, 'name' => (string) $found->name],
                    'source' => 'minecraft',
                    'max_age_seconds' => 20,
                    'online' => (int) ($live['online'] ?? 0),
                    'max' => (int) ($live['max'] ?? 0),
                    'players' => array_map(
                        static fn (string $name): array => ['name' => $name],
                        $live['names'] ?? [],
                    ),
                ];
            }

            $rows = Games::speaks($found) ? A2S::players($found) : null;

            /*
             * Null is not an empty server. It is a server that did not answer,
             * or one whose game answers no query at all, and a bot told "zero
             * players" would report an outage as a quiet evening.
             */
            if ($rows === null) {
                return [
                    'server' => ['uuid' => (string) $found->uuid, 'name' => (string) $found->name],
                    'source' => null,
                    'max_age_seconds' => 20,
                    'players' => null,
                ];
            }

            return [
                'server' => ['uuid' => (string) $found->uuid, 'name' => (string) $found->name],
                'source' => 'a2s',
                'max_age_seconds' => 20,
                'online' => count($rows),
                'players' => $rows,
            ];
        });
    }

    /* --------------------------------------------------- the connection --- */

    /*
     * Three endpoints for the bot, all of them needing a panel-wide key.
     *
     * A personal key must not reach these: it would let whoever holds one bind
     * arbitrary Discord accounts and read who else is connected. The bot is one
     * thing, run by whoever runs the panel, and it gets one key from an
     * administrator.
     */

    /** Discord posts the code back with the id of whoever typed it. */
    public function claim(Request $request): JsonResponse
    {
        return $this->answer($request, Key::PANEL, static function () use ($request): array {
            $made = Connections::claim(
                (string) $request->input('code', ''),
                (string) $request->input('discord_id', ''),
                (string) $request->input('discord_name', ''),
            );

            /*
             * One answer for every way this fails - an unknown code, an expired
             * one, one already used, an account that has gone, a Discord id
             * already tied to somebody else. Saying which would make the code
             * something worth guessing at.
             */
            if ($made === null) {
                return ['connected' => false];
            }

            return [
                'connected' => true,
                'username' => $made['user'],
                /*
                 * The only time this is readable. It is a real Pelican account
                 * key: the bot uses it against /api/client, where Pelican
                 * checks the permissions and writes the activity log.
                 */
                'pelican_key' => $made['key'],
            ];
        });
    }

    /** Whether a Discord id is connected, and to whom. Never the key. */
    public function connection(Request $request, string $discord): JsonResponse
    {
        return $this->answer($request, Key::PANEL, static function () use ($discord): array {
            $row = Connections::forDiscord($discord);

            return [
                'connected' => $row !== null,
                'username' => $row?->user?->username,
                'since' => $row?->created_at?->toIso8601String(),
            ];
        });
    }

    /**
     * End it from the bot's side.
     *
     * Answers the same whether there was anything to end, so a bot cannot use
     * this to find out which Discord ids the panel knows about.
     */
    public function disconnect(Request $request, string $discord): JsonResponse
    {
        return $this->answer($request, Key::PANEL, static function () use ($discord): array {
            $row = Connections::forDiscord($discord);

            if ($row !== null && $row->user !== null) {
                Connections::cut($row->user);
            }

            return ['connected' => false];
        });
    }

    /* ------------------------------------------------------- the works ---- */

    /**
     * Everything every endpoint does before and after its own answer.
     *
     * The key, where it is allowed to be used from, the ceiling for this
     * minute, the scope it needs, and the timestamp on the way out. Written
     * once because five of these differ only in the closure - and because a
     * check that is written six times is a check that is eventually written
     * five times.
     *
     * `$needs` is the *narrowest* scope that may call it. A panel key may ask
     * anything, including the per-person questions - it answers for whoever it
     * belongs to. A personal key may only ask the per-person ones.
     *
     * @param  callable(Key, int, int): array<string, mixed>  $work
     */
    private function answer(Request $request, string $needs, callable $work): JsonResponse
    {
        $key = Keys::verify($this->presented($request));

        if ($key === null || !$this->addressAllowed($key, $request)) {
            return response()->json(['error' => 'unauthorized'], 401);
        }

        if ($needs === Key::PANEL && $key->scope !== Key::PANEL) {
            /*
             * A different answer from 401 on purpose. The key is real and the
             * caller knows it is; what they have been told is that this
             * question is not theirs to ask, which is something they can act on
             * by asking for a wider key rather than by checking their token.
             */
            return response()->json(['error' => 'forbidden', 'needs' => Key::PANEL], 403);
        }

        $limit = Keys::rate();
        $left = $this->take($key, $limit);

        if ($left === null) {
            return response()->json([
                'error' => 'too_many_requests',
                'rate' => ['limit' => $limit, 'remaining' => 0],
            ], 429);
        }

        Keys::touch($key);

        try {
            $body = $work($key, $limit, $left);
        } catch (Throwable $exception) {
            report($exception);

            return response()->json(['error' => 'unavailable'], 503);
        }

        /*
         * Every answer says when it was worked out. Several of these are read
         * from a cache or a file that is a minute or two old, and a bot that
         * cannot tell a fresh answer from a held one will eventually report an
         * outage that ended a while ago.
         */
        return response()->json(array_merge(['as_of' => now()->toIso8601String()], $body));
    }

    /**
     * One server, if the key's owner can open it.
     *
     * accessibleServers() is Pelican's own answer to whose servers these are,
     * asked of the key's owner rather than of a session that does not exist.
     * Filtered in the query rather than found and then checked, so a uuid
     * belonging to somebody else is a row that was never returned.
     */
    private function serverFor(Key $key, string $uuid): ?Server
    {
        try {
            if ($key->user === null || !preg_match('/^[0-9a-fA-F-]{8,36}$/', $uuid)) {
                return null;
            }

            /** @var Server|null $server */
            $server = $key->user->accessibleServers()->where('servers.uuid', $uuid)->first();

            return $server;
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * The two backup lists, from whichever query was handed in.
     *
     * Shared by the panel-wide endpoint and the per-person one, which differ
     * only in scope. Two lists rather than one count, for the same reason the
     * page gives: a server with no backup at all is usually one nobody set one
     * up for, and one whose last is nine days old is a schedule that stopped.
     *
     * @param  \Illuminate\Database\Eloquent\Builder<Server>  $query
     * @return array<string, mixed>
     */
    private static function backupRows($query): array
    {
        $none = [];
        $stale = [];

        foreach ($query->get() as $server) {
            /** @var Server $server */
            $last = $server->ld_last;

            $row = ['uuid' => (string) $server->uuid, 'name' => (string) $server->name, 'last_backup_at' => $last];

            if ($last === null) {
                $none[] = $row;

                continue;
            }

            if (Backups::stale($last) === true) {
                $stale[] = $row;
            }
        }

        return [
            'stale_after_days' => Backups::days(),
            'never' => $none,
            'stale' => $stale,
        ];
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
             * through rather than turned away: these are read-only endpoints
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
}
