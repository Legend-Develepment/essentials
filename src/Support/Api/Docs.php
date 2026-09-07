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
                    ],
                    'acting_for' => ['id' => 4, 'username' => 'bryan'],
                    'rate' => ['limit' => 60, 'remaining' => 59],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/me/servers',
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
                'scope' => Key::PANEL,
                'summary' => 'Scheduled tasks that have stopped.',
                'detail' => 'Stuck part way through a run, overdue because the cron is not running, or never run at all. Pelican has no word for any of those - a crashed run stays "processing" for ever and is drawn exactly like one running now.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'stuck_after_hours' => 6,
                    'overdue_after_minutes' => 60,
                    'schedules' => [['id' => 3, 'name' => 'Nightly backup', 'server' => 'RIPCraft Survival', 'verdict' => 'stuck']],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/alerts',
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
        ];
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
                'title' => 'What it will not do',
                'body' => 'Nothing here starts, stops or reaches a server. Pelican\'s own client API at `/api/client` '
                    . 'already does that, already checks subuser permissions and already writes the activity log - a '
                    . 'second one would be a second thing to get right and then keep right.',
            ],
            [
                'title' => 'Rate limiting',
                'body' => 'Counted per key rather than per address, because one host may hold several keys and '
                    . 'throttling them together would make one bot\'s loop everybody else\'s problem. Every response '
                    . 'carries `rate.limit` and `rate.remaining`; going over returns **429** with the ceiling in it, '
                    . 'so a bot that is told no can work out how long to wait.',
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
            $out[] = '```json';
            $out[] = self::pretty($endpoint['answers']);
            $out[] = '```';
            $out[] = '';
        }

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
            $paths[$endpoint['path']][strtolower($endpoint['method'])] = [
                'summary' => $endpoint['summary'],
                'description' => $endpoint['detail'] . ' Keys that may call it: ' . self::scopeWords($endpoint['scope']) . '.',
                'security' => [['bearer' => []]],
                'responses' => [
                    '200' => [
                        'description' => 'The answer.',
                        'content' => ['application/json' => ['example' => $endpoint['answers']]],
                    ],
                    '401' => ['description' => 'No key, or one that is not usable. Every reason gives this same answer.'],
                    '429' => ['description' => 'This minute\'s allowance for this key is spent.'],
                ],
            ];
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
