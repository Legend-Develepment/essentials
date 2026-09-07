<?php

namespace LegendDevelopment\Theme\Support\Api;

use LegendDevelopment\Theme\Http\ApiController;
use LegendDevelopment\Theme\Models\Key;
use Throwable;

/**
 * What the API offers, written once.
 *
 * The page in the panel, the Markdown somebody downloads and the OpenAPI file
 * they hand to Postman are three renderings of the array in endpoints(). That
 * is the whole point of this class: documentation kept beside the code it
 * describes drifts from it the first time somebody is in a hurry, and three
 * copies drift three ways.
 *
 * tools/check-api-docs.js is the other half of that promise. It reads the
 * routes this plugin registers and the list below, and fails the build when
 * either has something the other does not - so a new endpoint cannot ship
 * undocumented and a documented one cannot quietly stop existing.
 *
 * **Two versions, and they mean different things.** The path carries `v1`,
 * which is a promise about the shape of what comes back. `api` in every
 * response body is this implementation, and it starts at 0.0.1 because it is
 * young. A bot should read the second and refuse to be surprised by it.
 */
class Docs
{
    /**
     * Every endpoint, in the order somebody meets them.
     *
     * `scope` is which kind of key may call it: a person's own key, a
     * panel-wide one, or either. `answers` is a real response rather than a
     * schema - somebody writing a bot at one in the morning wants to see the
     * shape, not to reconstruct it from types.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function endpoints(): array
    {
        return [
            [
                'method' => 'GET',
                'path' => '/health',
                'ability' => 'health',
                'scope' => 'any',
                'summary' => 'Whether the API is answering, and what this key may reach.',
                'detail' => 'The first call to make. It proves the key works, says which panel it belongs to and who it acts for, and reports what is left of this minute\'s allowance. It reaches nothing else, so it is safe to call on a timer.',
                'answers' => [
                    'essentials' => [
                        'contract' => ApiController::CONTRACT,
                        'api' => ApiController::VERSION,
                        'plugin' => '3.10.2-dev',
                    ],
                    'key' => [
                        'name' => 'Discord bot',
                        'prefix' => 'a1b2c3d4e5f6',
                        'scope' => Key::PERSON,
                        'expires_at' => null,
                        // What it was granted, so a bot can find out in one
                        // call rather than by being refused four times.
                        'abilities' => ['health', 'me', 'live'],
                    ],
                    'acting_for' => ['id' => 4, 'username' => 'bryan'],
                    'rate' => ['limit' => 60, 'remaining' => 59],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/me/servers',
                'ability' => 'me',
                'scope' => Key::PERSON,
                'summary' => 'The servers this key answers for.',
                'detail' => 'Scoped exactly as the panel scopes them for its owner, so it can never list a server they could not open themselves. Carries the last successful backup with each one, because that is the question the panel does not answer anywhere else.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'servers' => [
                        ['uuid' => 'a1b2c3d4', 'name' => 'RIPCraft Survival', 'last_backup_at' => '2026-09-05 03:00:00', 'backups' => 12],
                        ['uuid' => 'e5f6a7b8', 'name' => 'Modded Lobby', 'last_backup_at' => null, 'backups' => 0],
                    ],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/me/backups',
                'ability' => 'me',
                'scope' => Key::PERSON,
                'summary' => 'Which of their servers has no backup, and which has gone stale.',
                'detail' => 'Two lists rather than one count, because they are different problems: a server with no backup at all is usually one nobody set one up for, and one whose last is nine days old is a schedule that has stopped.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'stale_after_days' => 7,
                    'never' => [['uuid' => 'e5f6a7b8', 'name' => 'Modded Lobby', 'last_backup_at' => null]],
                    'stale' => [['uuid' => 'c9d0e1f2', 'name' => 'Mental RP', 'last_backup_at' => '2026-08-20 04:00:00']],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/backups',
                'ability' => 'panel',
                'scope' => Key::PANEL,
                'summary' => 'The same two lists, for every server on the panel.',
                'detail' => 'The inverse of Pelican\'s own backup page, which shows one server its own backups and is no help to somebody looking after forty.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'stale_after_days' => 7,
                    'never' => [['uuid' => 'e5f6a7b8', 'name' => 'Modded Lobby', 'last_backup_at' => null]],
                    'stale' => [],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/nodes',
                'ability' => 'panel',
                'scope' => Key::PANEL,
                'summary' => 'Every machine, and what it is using.',
                'detail' => 'Read the same way the dashboard block reads it. A node that cannot be reached says so rather than being left out, which is the difference between "nothing is wrong" and "nothing could be asked".',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'nodes' => [[
                        'name' => 'node-01',
                        'reachable' => true,
                        'memory' => ['used' => 12_884_901_888, 'total' => 34_359_738_368],
                        'disk' => ['used' => 214_748_364_800, 'total' => 1_099_511_627_776],
                    ]],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/system',
                'ability' => 'panel',
                'scope' => Key::PANEL,
                'summary' => 'The machine the panel itself runs on.',
                'detail' => 'Processor, memory, swap, every filesystem, load and uptime, read from /proc rather than from shell commands - so it works on a host where process execution is switched off. Any figure that cannot be had is null rather than invented.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'system' => ['cpu' => 12.4, 'load' => [0.8, 0.6, 0.5], 'uptime' => 864_000],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/schedules',
                'ability' => 'panel',
                'scope' => Key::PANEL,
                'summary' => 'Scheduled tasks that have stopped.',
                'detail' => 'Stuck part way through a run, overdue because the cron is not running, or never run at all. Pelican has no word for any of those - a crashed run stays "processing" for ever and is drawn exactly like one running now.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'stuck_after_hours' => 6,
                    'overdue_after_minutes' => 60,
                    'schedules' => [['id' => 3, 'name' => 'Nightly backup', 'server' => 'RIPCraft Survival', 'server_id' => 12, 'verdict' => 'stuck']],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/alerts',
                'ability' => 'panel',
                'scope' => Key::PANEL,
                'summary' => 'What the watchdog currently thinks is wrong.',
                'detail' => 'Its held state rather than a fresh sweep: this reads the file the watchdog writes, so it costs nothing and reaches no node. `since` is when the state last changed, which is what turns "a node is down" into "a node has been down for two hours".',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'alerts' => [
                        ['check' => 'node.1.down', 'state' => 'bad', 'since' => '2026-09-07T09:14:00+00:00'],
                        ['check' => 'worker', 'state' => 'ok', 'since' => '2026-09-01T00:00:00+00:00'],
                    ],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/servers/{server}/status',
                'ability' => 'live',
                'params' => [
                    ['in' => 'path', 'name' => 'server', 'required' => true,
                        'note' => 'The server uuid, as returned by /me/servers.'],
                ],
                'scope' => Key::PERSON,
                'summary' => 'Whether a server is running, and what it is using.',
                'detail' => 'A second reader of something the panel already worked out: Pelican caches both figures for fifteen seconds on its own cards, so a hundred bots asking at once is one question to the daemon. A node that cannot be reached gives state null rather than offline - a server nobody could ask about is not a server that is off, and a bot told the second would announce an outage that is not happening. One server a call: putting this on /me/servers would mean a daemon call per server on a cold cache.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'server' => ['uuid' => 'a1b2c3d4', 'name' => 'RIPCraft Survival'],
                    'max_age_seconds' => 15,
                    'state' => 'running',
                    'resources' => [
                        'memory_bytes' => 2_147_483_648,
                        'cpu_absolute' => 41.2,
                        'disk_bytes' => 8_589_934_592,
                        'uptime' => 864_000,
                    ],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/servers/{server}/players',
                'ability' => 'live',
                'scope' => Key::PERSON,
                'summary' => 'Who is connected to one game server right now.',
                'params' => [
                    ['in' => 'path', 'name' => 'server', 'required' => true,
                        'note' => 'The server uuid, as returned by /me/servers.'],
                ],
                'detail' => 'The only endpoint here that asks the game rather than the panel. Minecraft answers through its own protocol, everything else through Valve\'s query - and a game that answers neither gives `players: null`, which is not the same as an empty server. Both readers cache on the address for twenty seconds, so a hundred bots asking at once is one query; `max_age_seconds` says how stale an answer may be, so a quiet evening cannot be mistaken for an outage. Take the uuid from /me/servers. A server the key\'s owner cannot open is a 404 rather than a 403, because a 403 would confirm it exists.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'server' => ['uuid' => 'a1b2c3d4', 'name' => 'RIPCraft Survival'],
                    'source' => 'minecraft',
                    'max_age_seconds' => 20,
                    'online' => 3,
                    'max' => 40,
                    'players' => [['name' => 'Bryan'], ['name' => 'Sofie'], ['name' => 'Wout']],
                ],
            ],
            [
                'method' => 'POST',
                'path' => '/connect/claim',
                'ability' => 'connect',
                'scope' => Key::PANEL,
                'summary' => 'Tie a Discord account to a panel account, using a code the panel gave out.',
                'params' => [
                    ['in' => 'body', 'name' => 'code', 'required' => true,
                        'note' => 'The six characters the panel gave the person. Case is ignored.'],
                    ['in' => 'body', 'name' => 'discord_id', 'required' => true,
                        'note' => 'The id of whoever typed it. Digits only.'],
                    ['in' => 'body', 'name' => 'discord_name', 'required' => false,
                        'note' => 'Shown on their own page, so they can tell which account is tied to theirs.'],
                ],
                'detail' => 'Send `code`, `discord_id` and optionally `discord_name`. The person gets the code from **API access** in the client area after signing in, so the panel knows which account is asking; the bot supplies the id of whoever typed it, so it knows which Discord account is asking. Neither side vouches for the other. On success this returns a real Pelican account key, once - use it against `/api/client` for anything that starts, stops or reaches a server. Every failure answers `connected: false` without saying which, because a code that says why is a code worth guessing at.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'connected' => true,
                    'username' => 'bryan',
                    'pelican_key' => 'ptlc_a1b2c3d4e5f6g7h8IJKLMNOPQRSTUVWXYZ012345678',
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/connect/{discord}/servers',
                'ability' => 'connect',
                'params' => [
                    ['in' => 'path', 'name' => 'discord', 'required' => true, 'note' => 'A Discord user id.'],
                ],
                'scope' => Key::PANEL,
                'summary' => 'Which servers that Discord account may reach, and what it may do to them.',
                'detail' => 'The question a bot cannot answer any other way. Somebody types /start survival and the bot has to know two things first: is that server theirs, and are they allowed to start it. Those are not the same - a subuser can often see a server and not power it. Both answers come from Pelican rather than from a rule of ours, so this can never say yes to something Pelican would refuse. No live state here, because that costs a call per server; ask /servers/{server}/status for the one that matters.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'connected' => true,
                    'username' => 'bryan',
                    'servers' => [[
                        'uuid' => 'a1b2c3d4',
                        'name' => 'RIPCraft Survival',
                        'owner' => true,
                        'may' => ['start' => true, 'stop' => true, 'restart' => true, 'console' => true],
                    ]],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/connect/{discord}',
                'ability' => 'connect',
                'scope' => Key::PANEL,
                'summary' => 'Whether a Discord id is connected, and to whom.',
                'params' => [
                    ['in' => 'path', 'name' => 'discord', 'required' => true, 'note' => 'A Discord user id.'],
                ],
                'detail' => 'Never returns the key. A bot that has lost its copy has to be given a new code by the person it belongs to, which is the same door everybody else uses.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'connected' => true,
                    'username' => 'bryan',
                    'since' => '2026-09-01T18:30:00+00:00',
                ],
            ],
            [
                'method' => 'DELETE',
                'path' => '/connect/{discord}',
                'ability' => 'connect',
                'scope' => Key::PANEL,
                'summary' => 'End a connection from the bot\'s side.',
                'params' => [
                    ['in' => 'path', 'name' => 'discord', 'required' => true, 'note' => 'A Discord user id.'],
                ],
                'detail' => 'Deletes the Pelican key first and the record after, so the worst case is a row pointing at a key that is already gone rather than a credential still working with nothing admitting it exists. Answers the same whether there was anything to end, so this cannot be used to discover which Discord ids the panel knows.',
                'answers' => ['as_of' => '2026-09-07T12:00:00+00:00', 'connected' => false],
            ],
        ];
    }

    /**
     * One copyable line per endpoint.
     *
     * The single most useful thing a page like this can carry. Somebody writing
     * a bot at one in the morning does not want a description of a header; they
     * want a line they can paste into a terminal and watch answer, because the
     * first question is never "what does this return" but "is any of this
     * working at all".
     *
     * The key is left as a placeholder rather than filled in with a real one:
     * this page is rendered for whoever is looking at it, and a page that pastes
     * somebody's credential into an example is a page that puts it in a
     * screenshot.
     *
     * @param  array<string, mixed>  $endpoint
     */
    public static function curl(array $endpoint): string
    {
        $path = (string) $endpoint['path'];

        // A path parameter shown as itself would be pasted as itself, so it is
        // filled with something obviously an example.
        foreach ((array) ($endpoint['params'] ?? []) as $param) {
            if (($param['in'] ?? '') === 'path') {
                $path = str_replace('{' . $param['name'] . '}', '<' . $param['name'] . '>', $path);
            }
        }

        $out = 'curl ' . ($endpoint['method'] === 'GET' ? '' : '-X ' . $endpoint['method'] . ' ')
            . self::base() . $path
            . " \
  -H 'Authorization: Bearer esk_<prefix>_<secret>'";

        $body = [];

        foreach ((array) ($endpoint['params'] ?? []) as $param) {
            if (($param['in'] ?? '') === 'body') {
                $body[$param['name']] = '<' . $param['name'] . '>';
            }
        }

        if ($body !== []) {
            $out .= " \
  -H 'Content-Type: application/json'"
                . " \
  -d '" . json_encode($body, JSON_UNESCAPED_SLASHES) . "'";
        }

        return $out;
    }

    /**
     * What a failure looks like, as a body rather than as prose.
     *
     * Written out because a bot has to branch on it, and reading a status code
     * out of a sentence is how somebody ends up matching on the message text.
     *
     * @return array<int, array{code: int, when: string, body: array<string, mixed>}>
     */
    public static function errors(): array
    {
        return [
            [
                'code' => 401,
                'when' => 'No key, or one that is not usable. Every reason gives this same answer - missing, '
                    . 'malformed, unknown, revoked, expired, or belonging to an account that is gone.',
                'body' => ['error' => 'unauthorized'],
            ],
            [
                'code' => 403,
                'when' => 'A real key asking something it was not granted, or something its scope does not reach. Deliberately not a 401: the key is fine, so this is acted on by asking for a wider one rather than by checking the token. The body names which of the two it was - `ability` when the key was narrowed and this question is off its list, `needs` when the question wants a panel-wide key.',
                'body' => ['error' => 'forbidden', 'ability' => 'connect'],
            ],
            [
                'code' => 404,
                'when' => 'The API is switched off, or the thing asked for is not one this key may reach. A '
                    . 'server somebody cannot open answers this rather than 403, because a 403 would confirm it '
                    . 'exists.',
                'body' => [],
            ],
            [
                'code' => 429,
                'when' => 'The allowance for this key this minute is spent. The ceiling is in the body, so a bot '
                    . 'that is told no can work out how long to wait rather than retrying immediately and making '
                    . 'it worse.',
                'body' => ['error' => 'too_many_requests', 'rate' => ['limit' => 60, 'remaining' => 0]],
            ],
            [
                'code' => 503,
                'when' => 'The panel could not work the answer out. Reported rather than dressed up as an empty '
                    . 'result, because an empty list and a broken reading are different things and a bot that '
                    . 'cannot tell them apart reports an outage that is not happening.',
                'body' => ['error' => 'unavailable'],
            ],
        ];
    }

    /**
     * The other direction: what this panel posts to a bot, unasked.
     *
     * Documented here rather than only on the alerts page, because the person
     * who needs it is writing the receiver and this is where they are looking.
     * It is the one part of all this that arrives without being asked for, and
     * the only part with a signature to check.
     *
     * @return array<string, mixed>
     */
    public static function webhook(): array
    {
        return [
            'body' => [
                'panel' => 'Legend Gaming',
                'title' => 'node-01 is not answering',
                'body' => 'The panel cannot reach the daemon on node-01. Servers on it will not start, '
                    . 'stop or report anything until it is back.',
                'good' => false,
                'at' => '2026-09-07T09:14:00+00:00',
            ],
            'verify' => "const mac = crypto.createHmac('sha256', SECRET).update(raw).digest('hex');
"
                . "const sent = req.get('X-Essentials-Signature') ?? '';
"
                . "const ours = Buffer.from('sha256=' + mac);
"
                . "const theirs = Buffer.from(sent);

"
                . "if (ours.length !== theirs.length || !crypto.timingSafeEqual(ours, theirs)) {
"
                . "    return res.sendStatus(401);
"
                . "}",
        ];
    }

    /**
     * The abilities a key can be granted, read from the endpoints themselves.
     *
     * Grouped rather than one a path, because a list of fourteen checkboxes
     * that grows every release is a list nobody reads before ticking all of
     * them - and a permission nobody reads is not a permission. The groups are
     * what they cost and what they reach, which is what somebody deciding is
     * actually weighing:
     *
     *  - **health** proves a key works and reaches nothing else.
     *  - **me** answers for the key owner and cannot see anybody else.
     *  - **panel** is every node, every backup, the watchdog, the host.
     *  - **live** asks a game server or a daemon, so it costs something.
     *  - **connect** ties Discord accounts to panel accounts and hands out
     *    Pelican keys. The one group that is not a reading.
     *
     * Built from Docs::endpoints() rather than listed here, so an endpoint
     * added tomorrow cannot land in a group that does not exist - and the
     * checkbox list on the page is generated from the same array the
     * documentation is.
     *
     * @return array<int, string>
     */
    public static function abilities(): array
    {
        $out = [];

        foreach (self::endpoints() as $endpoint) {
            $ability = (string) ($endpoint['ability'] ?? '');

            if ($ability !== '' && !in_array($ability, $out, true)) {
                $out[] = $ability;
            }
        }

        return $out;
    }

    /** Which ability one endpoint belongs to. */
    public static function abilityFor(string $method, string $path): string
    {
        foreach (self::endpoints() as $endpoint) {
            if ($endpoint['method'] === $method && $endpoint['path'] === $path) {
                return (string) ($endpoint['ability'] ?? '');
            }
        }

        return '';
    }

    /** The panel itself, for the one example that is not about this API. */
    public static function panelBase(): string
    {
        try {
            return rtrim((string) url('/'), '/');
        } catch (Throwable) {
            return '';
        }
    }

    /** Where the API lives on this panel, as a whole address. */
    public static function base(): string
    {
        try {
            return url('/api/essentials/' . ApiController::CONTRACT);
        } catch (Throwable) {
            return '/api/essentials/' . ApiController::CONTRACT;
        }
    }

    /**
     * The things that are true of every call, rather than of one endpoint.
     *
     * Kept apart from the endpoint list because they are what somebody reads
     * once and then never again, and because every one of them is a decision
     * that would otherwise have to be discovered from a 401.
     *
     * @return array<int, array{title: string, body: string}>
     */
    public static function notes(): array
    {
        return [
            [
                'title' => 'Authentication',
                'body' => 'Send the key as a bearer token: `Authorization: Bearer esk_<prefix>_<secret>`. '
                    . 'Never in the query string - a key in a URL is a key in the panel\'s access log, in whatever '
                    . 'sits in front of it, and in the history of any browser it was pasted into once.',
            ],
            [
                'title' => 'Getting a key',
                'body' => 'Anyone signed in can ask for one under **API access** in the client area. It answers only '
                    . 'for the servers they can already open. A panel-wide key, for a bot that reports on the panel '
                    . 'rather than for a person, is issued by an administrator on the API page.',
            ],
            [
                'title' => 'Starting and stopping a server',
                'body' => 'Nothing here does it, and that is deliberate rather than unfinished. Pelican has a client API at `/api/client` which already checks subuser permissions and already writes the activity log; a second one here would be a second thing to get right and then keep right through every Pelican release. '
                    . '**Your bot already holds the key for it.** `/connect/claim` returns a real Pelican account key when somebody connects their Discord account - that is what it is for. Ask `/connect/{discord}/servers` first, which says whether the server is theirs and whether they hold `control.start`, and then post the signal:'
                    . "

```bash
curl -X POST " . self::panelBase() . "/api/client/servers/<uuid>/power \\
  -H 'Authorization: Bearer <the Pelican key from /connect/claim>' \\
  -H 'Content-Type: application/json' \\
  -d '{\"signal\":\"start\"}'
```

"
                    . 'The signal is `start`, `stop`, `restart` or `kill`. Pelican answers 403 if that person may not - which is the answer you want, because it is the same one the panel would give them.',
            ],
            [
                'title' => 'What a key may ask about',
                'body' => 'A key can be narrowed to some of these questions and not others, in five groups: '
                    . '**health** proves it works and reaches nothing else; **me** answers for its owner and can never see anybody else; **panel** is every node, backup, schedule and the host; **live** asks a game server or a daemon, so it costs something; and **connect** ties Discord accounts to panel accounts and hands out Pelican keys - the one group that is not a reading. '
                    . 'A key with nothing recorded may do everything its scope allows, which is what every key issued before this existed has. One that was narrowed may do what is on its list and nothing else, including abilities added in a later release - a capability nobody ticked is a capability nobody granted. Asking anyway gives **403** with the ability named.',
            ],
            [
                'title' => 'Rate limiting',
                'body' => 'Counted per key rather than per address, because one host may hold several keys and throttling them together would make a loop in one bot a problem for all of them. Every response carries`rate.limit` and `rate.remaining`; going over returns **429** with the ceiling in it, so a bot that is told no can work out how long to wait rather than retrying straight away and making it worse. '
                    . 'A key can be given a ceiling of its own instead of the panel one, and that ceiling can be **none at all** - reasonable for a bot on the same machine as the panel, and a real way to be sorry if the key goes anywhere else. `rate.limit` reports 0 when a key is unlimited.',
            ],
            [
                'title' => 'When something is wrong',
                'body' => '**401** for every way a key can fail to be one - missing, malformed, unknown, revoked, '
                    . 'expired, or belonging to an account that is gone. They are deliberately the same answer: '
                    . 'saying which would be telling somebody which half of a key they had right. '
                    . '**404** when the API is switched off, because then the route does not exist at all. '
                    . '**429** when the allowance for this minute is spent.',
            ],
            [
                'title' => 'Versions',
                'body' => 'The `v1` in the address is a promise about the shape of what comes back and changes only '
                    . 'when that shape breaks. The `api` field in every response is this implementation and moves '
                    . 'freely. Read the second one and refuse to be surprised by it.',
            ],
        ];
    }

    /**
     * The whole thing as Markdown, for a repository beside a bot.
     *
     * Markdown rather than a PDF because it belongs next to the code that calls
     * the API, where it can be read in a terminal, searched, and shown in a diff
     * when this file changes under it.
     */
    public static function markdown(): string
    {
        $out = [];

        $out[] = '# Essentials API';
        $out[] = '';
        $out[] = 'Contract `' . ApiController::CONTRACT . '`, implementation `' . ApiController::VERSION . '`.';
        $out[] = '';
        $out[] = '    ' . self::base();
        $out[] = '';

        foreach (self::notes() as $note) {
            $out[] = '## ' . $note['title'];
            $out[] = '';
            $out[] = $note['body'];
            $out[] = '';
        }

        $out[] = '## Endpoints';
        $out[] = '';

        foreach (self::endpoints() as $endpoint) {
            $out[] = '### `' . $endpoint['method'] . ' ' . $endpoint['path'] . '`';
            $out[] = '';
            $out[] = $endpoint['summary'];
            $out[] = '';
            $out[] = $endpoint['detail'];
            $out[] = '';
            $out[] = 'Keys that may call it: **' . self::scopeWords($endpoint['scope']) . '**';
            $out[] = '';

            foreach ((array) ($endpoint['params'] ?? []) as $param) {
                $out[] = '- `' . $param['name'] . '` *(' . $param['in']
                    . ($param['required'] ? ', required' : ', optional') . ')* - ' . $param['note'];
            }

            if (($endpoint['params'] ?? []) !== []) {
                $out[] = '';
            }

            $out[] = '```bash';
            $out[] = self::curl($endpoint);
            $out[] = '```';
            $out[] = '';
            $out[] = '```json';
            $out[] = self::pretty($endpoint['answers']);
            $out[] = '```';
            $out[] = '';
        }

        $out[] = '## When something is wrong';
        $out[] = '';

        foreach (self::errors() as $error) {
            $out[] = '### ' . $error['code'];
            $out[] = '';
            $out[] = $error['when'];
            $out[] = '';

            if ($error['body'] !== []) {
                $out[] = '```json';
                $out[] = self::pretty($error['body']);
                $out[] = '```';
                $out[] = '';
            }
        }

        /*
         * The other direction, and the only part of this that arrives without
         * being asked for. Documented beside the endpoints because the person
         * who needs it is writing the receiver, and this is where they are.
         */
        $hook = self::webhook();

        $out[] = '## What the panel posts to you';
        $out[] = '';
        $out[] = 'Switched on under Alerts, with an address and a signing secret. One JSON post when the '
            . 'watchdog finds something and one when it clears, so a bot hears about a dead node rather '
            . 'than asking every minute whether there is one.';
        $out[] = '';
        $out[] = '```json';
        $out[] = self::pretty($hook['body']);
        $out[] = '```';
        $out[] = '';
        $out[] = 'The body is hashed with the secret and the hash travels in `X-Essentials-Signature` as '
            . '`sha256=<hex>`. **Hash the raw body, not a re-serialised object** - any difference in '
            . 'spacing or key order gives a different hash, and the mismatch reads like an attack rather '
            . 'than a bug.';
        $out[] = '';
        $out[] = '```js';
        $out[] = $hook['verify'];
        $out[] = '```';
        $out[] = '';

        return implode("\n", $out);
    }

    /**
     * The same as OpenAPI 3.1, for anything that reads one.
     *
     * Postman, Insomnia and every client generator take this, which turns "read
     * the docs and write a wrapper" into an import. Built from the same array,
     * so it cannot describe an endpoint the Markdown does not.
     *
     * @return array<string, mixed>
     */
    public static function openapi(): array
    {
        $paths = [];

        foreach (self::endpoints() as $endpoint) {
            /*
             * Parameters and a request body, which the first version of this
             * had none of. Without them an import into Postman produces an
             * address and no way to call it - the path parameter stays a
             * literal {server} and the connect endpoint sends nothing at all,
             * which is worse than no file because it looks like it worked.
             */
            $parameters = [];
            $body = [];

            foreach ((array) ($endpoint['params'] ?? []) as $param) {
                if ($param['in'] === 'body') {
                    $body[$param['name']] = ['type' => 'string', 'description' => $param['note']];

                    continue;
                }

                $parameters[] = [
                    'name' => $param['name'],
                    'in' => $param['in'],
                    'required' => (bool) $param['required'],
                    'description' => $param['note'],
                    'schema' => ['type' => 'string'],
                ];
            }

            $responses = [
                '200' => [
                    'description' => 'The answer.',
                    'content' => ['application/json' => ['example' => $endpoint['answers']]],
                ],
            ];

            foreach (self::errors() as $error) {
                $responses[(string) $error['code']] = array_filter([
                    'description' => $error['when'],
                    'content' => $error['body'] === []
                        ? null
                        : ['application/json' => ['example' => $error['body']]],
                ]);
            }

            $operation = [
                // A generator names its method after this, so it is the
                // difference between client.health() and client.getV1Health().
                'operationId' => self::operationId($endpoint),
                'summary' => $endpoint['summary'],
                'description' => $endpoint['detail'] . ' Keys that may call it: '
                    . self::scopeWords($endpoint['scope']) . '.',
                'security' => [['bearer' => []]],
                'responses' => $responses,
            ];

            if ($parameters !== []) {
                $operation['parameters'] = $parameters;
            }

            if ($body !== []) {
                $operation['requestBody'] = [
                    'required' => true,
                    'content' => ['application/json' => ['schema' => [
                        'type' => 'object',
                        'properties' => $body,
                        'required' => array_values(array_map(
                            static fn (array $p): string => $p['name'],
                            array_filter(
                                (array) ($endpoint['params'] ?? []),
                                static fn (array $p): bool => $p['in'] === 'body' && $p['required'],
                            ),
                        )),
                    ]]],
                ];
            }

            $paths[$endpoint['path']][strtolower($endpoint['method'])] = $operation;
        }

        return [
            'openapi' => '3.1.0',
            'info' => [
                'title' => 'Essentials API',
                'version' => ApiController::VERSION,
                'description' => 'What this panel knows that Pelican\'s own API does not. Read only: '
                    . 'nothing here starts, stops or reaches a server.',
            ],
            'servers' => [['url' => self::base()]],
            'components' => [
                'securitySchemes' => [
                    'bearer' => ['type' => 'http', 'scheme' => 'bearer', 'bearerFormat' => 'esk_<prefix>_<secret>'],
                ],
            ],
            'security' => [['bearer' => []]],
            'paths' => $paths,
        ];
    }

    /**
     * A name a client generator can turn into a method.
     *
     * Without one, every generator invents its own from the verb and the path -
     * getV1ServersServerPlayers and the like - and the difference between that
     * and players() is the difference between a library somebody uses and one
     * they wrap first.
     *
     * @param  array<string, mixed>  $endpoint
     */
    public static function operationId(array $endpoint): string
    {
        $path = trim((string) $endpoint['path'], '/');
        $path = str_replace(['{', '}'], '', $path);
        $parts = array_values(array_filter(explode('/', $path)));

        $out = strtolower((string) $endpoint['method']) === 'get' ? '' : strtolower((string) $endpoint['method']);

        foreach ($parts as $part) {
            $out .= $out === '' ? $part : ucfirst($part);
        }

        return $out === '' ? 'index' : $out;
    }

    /** Which keys may call something, in words rather than in a code. */
    public static function scopeWords(string $scope): string
    {
        return match ($scope) {
            Key::PERSON => 'a personal key',
            Key::PANEL => 'a panel-wide key',
            default => 'any key',
        };
    }

    /**
     * JSON somebody can read.
     *
     * Pretty-printed and with slashes left alone, because an address written
     * `https:\/\/panel` in a documentation example is a small thing that makes
     * a reader doubt the rest of it.
     *
     * @param  array<mixed, mixed>  $value
     */
    public static function pretty(array $value): string
    {
        $json = json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        return $json === false ? '{}' : $json;
    }
}
