<?php

namespace LegendDevelopment\Theme\Support\Api;

use LegendDevelopment\Theme\Http\ApiController;
use LegendDevelopment\Theme\Models\Key;
use LegendDevelopment\Theme\Support\Alerts\Notifier;
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
 * response body is this implementation: it started at 0.0.1 and is 1.0.0. A bot
 * should read the second and refuse to be surprised by it.
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
                'detail' => 'The first call to make. It proves the key works, says which panel it belongs to and who it acts for, and reports what is left of this minute\'s allowance. It reaches nothing else, so it is safe to call on a timer. `key.expires_at` is null on a key that does not expire, and `key.replaced_by` is the prefix of a newer key that has taken over: the one you are holding still works until `expires_at` and not after it, so a bot that sees this should say so to whoever runs it rather than waiting to be refused one morning.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'rate' => ['limit' => 60, 'remaining' => 59],
                    'essentials' => [
                        'contract' => ApiController::CONTRACT,
                        'api' => ApiController::VERSION,
                        'plugin' => '3.166.0-dev',
                    ],
                    'key' => [
                        'name' => 'Discord bot',
                        'prefix' => 'a1b2c3d4e5f6',
                        'scope' => Key::PERSON,
                        'expires_at' => null,
                        'replaced_by' => null,
                        // What it was granted, so a bot can find out in one
                        // call rather than by being refused four times.
                        'abilities' => ['health', 'me', 'live'],
                    ],
                    'acting_for' => ['id' => 4, 'username' => 'bryan'],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/me/servers',
                'ability' => 'me',
                'scope' => Key::PERSON,
                'summary' => 'The servers this key answers for.',
                'detail' => 'Scoped exactly as the panel scopes them for its owner, so it can never list a server they could not open themselves. Carries the last successful backup with each one, because that is the question the panel does not answer anywhere else.',
                'ceiling' => '`servers` stops at a hundred rows and `servers_total` is how many there really are.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'rate' => ['limit' => 60, 'remaining' => 59],
                    'servers_total' => 2,
                    'servers' => [
                        ['uuid' => '8df1a317-9244-4f0a-9e59-2f43f5b62bd9', 'name' => 'RIPCraft Survival', 'last_backup_at' => '2026-09-05T03:00:00+00:00', 'backups' => 12],
                        ['uuid' => 'b2c41d90-5e77-4a13-8f0c-6d1a9e3b7c52', 'name' => 'Modded Lobby', 'last_backup_at' => null, 'backups' => 0],
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
                'ceiling' => 'Each list stops at a hundred rows; `never_total` and `stale_total` are how many there really are.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'rate' => ['limit' => 60, 'remaining' => 59],
                    'stale_after_days' => 7,
                    'never_total' => 1,
                    'stale_total' => 1,
                    'never' => [['uuid' => 'b2c41d90-5e77-4a13-8f0c-6d1a9e3b7c52', 'name' => 'Modded Lobby', 'last_backup_at' => null]],
                    'stale' => [['uuid' => 'f47ac10b-58cc-4372-a567-0e02b2c3d479', 'name' => 'Mental RP', 'last_backup_at' => '2026-08-20T04:00:00+00:00']],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/me/services',
                'ability' => 'me',
                'scope' => Key::PERSON,
                'summary' => 'What its owner is paying for, and when each renews.',
                'detail' => 'The question a hosting Discord is asked more than any other. Their own services and nobody else\'s, read through the key\'s owner. `state` is pending, active, suspended or ending; `server` is null while a service is still being built. Amounts are minor units of `currency`, and `next_due_at` is null on a service that does not recur.',
                'ceiling' => '`services` stops at a hundred rows and `services_total` is how many there really are.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'rate' => ['limit' => 60, 'remaining' => 59],
                    'selling' => true,
                    'services_total' => 1,
                    'services' => [[
                        'id' => 41,
                        'package' => 'Redis 7',
                        'state' => 'active',
                        'server' => ['uuid' => '8df1a317-0e2e-4f2f-9a7d-2b0f5a1c4e77', 'name' => 'RIPCraft Survival'],
                        'price' => 400,
                        'currency' => 'EUR',
                        'period' => 'month',
                        'next_due_at' => '2026-10-07T00:00:00+00:00',
                        'ends_at' => null,
                    ]],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/backups',
                'ability' => 'panel',
                'scope' => Key::PANEL,
                'summary' => 'The same two lists, for every server on the panel.',
                'detail' => 'The inverse of Pelican\'s own backup page, which shows one server its own backups and is no help to somebody looking after forty.',
                'ceiling' => 'Each list stops at a hundred rows; `never_total` and `stale_total` are how many there really are.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'rate' => ['limit' => 60, 'remaining' => 59],
                    'stale_after_days' => 7,
                    'never_total' => 1,
                    'stale_total' => 1,
                    'never' => [['uuid' => 'b2c41d90-5e77-4a13-8f0c-6d1a9e3b7c52', 'name' => 'Modded Lobby', 'last_backup_at' => null]],
                    'stale' => [['uuid' => 'f47ac10b-58cc-4372-a567-0e02b2c3d479', 'name' => 'Mental RP', 'last_backup_at' => '2026-08-20T04:00:00+00:00']],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/nodes',
                'ability' => 'panel',
                'scope' => Key::PANEL,
                'summary' => 'Every machine, and what it is using.',
                'detail' => 'A node that cannot be reached says so rather than being left out, which is the difference between "nothing is wrong" and "nothing could be asked" - and an unreachable one carries nought for everything it could not be asked, with `reachable` false beside it. Memory and disk are bytes. `cpu` is a percentage of the whole machine and `load` the one-minute load average as a single figure, both null where the node did not answer. The three figures under /system are the panel host and are a different shape on purpose. `version` is what the daemon says it is running, empty where it would not say.',
                'ceiling' => '`nodes` stops at two hundred rows and `nodes_total` is how many machines there really are.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'rate' => ['limit' => 60, 'remaining' => 59],
                    'nodes_total' => 1,
                    'nodes' => [[
                        'id' => 1,
                        'name' => 'node-01',
                        'maintenance' => false,
                        'reachable' => true,
                        'cpu' => 12.4,
                        'memory_used' => 12_884_901_888,
                        'memory_total' => 34_359_738_368,
                        'disk_used' => 214_748_364_800,
                        'disk_total' => 1_099_511_627_776,
                        'load' => 0.8,
                        'version' => '1.0.0-beta12',
                    ]],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/system',
                'ability' => 'panel',
                'scope' => Key::PANEL,
                'summary' => 'The machine the panel itself runs on.',
                'detail' => 'Processor, memory, swap, every filesystem, load and uptime, read from /proc rather than from shell commands - so it works on a host where process execution is switched off. Any figure that cannot be had is null rather than invented, and every key is always present: none of them comes and goes with what the host would say. Memory and swap are bytes, uptime is seconds, and `cpu` is a percentage of the whole machine.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'rate' => ['limit' => 60, 'remaining' => 59],
                    'system' => [
                        'cpu' => 12.4,
                        'memory' => ['total' => 34_359_738_368, 'used' => 12_884_901_888],
                        'swap' => ['total' => 4_294_967_296, 'used' => 0],
                        'disk' => [['mount' => '/', 'total' => 1_099_511_627_776, 'used' => 214_748_364_800]],
                        'load' => [0.8, 0.6, 0.5],
                        'uptime' => 864_000,
                        'host' => [
                            'os' => 'Linux 6.8.0-45-generic',
                            'hostname' => 'panel-01',
                            'php' => '8.3.11',
                            'cores' => 8,
                            'processes' => 412,
                        ],
                        'panel' => ['installed' => '1.0.0-beta38', 'latest' => '1.0.0-beta38', 'current' => true],
                    ],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/schedules',
                'ability' => 'panel',
                'scope' => Key::PANEL,
                'summary' => 'Scheduled tasks that have stopped.',
                'detail' => 'Stuck part way through a run, overdue because the cron is not running, or never run at all. Pelican has no word for any of those - a crashed run stays "processing" for ever and is drawn exactly like one running now.',
                'ceiling' => '`schedules` stops at a hundred rows and `schedules_total` is how many there really are.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'rate' => ['limit' => 60, 'remaining' => 59],
                    'stuck_after_hours' => 6,
                    'overdue_after_minutes' => 60,
                    'schedules_total' => 1,
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
                    'rate' => ['limit' => 60, 'remaining' => 59],
                    'alerts' => [
                        ['check' => 'node.1.down', 'state' => 'bad', 'since' => '2026-09-07T09:14:00+00:00'],
                        ['check' => 'worker', 'state' => 'ok', 'since' => '2026-09-01T00:00:00+00:00'],
                    ],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/capacity',
                'ability' => 'panel',
                'scope' => Key::PANEL,
                'summary' => 'How full every node is, and whether another server fits.',
                'detail' => 'What a machine is allowed to hand out, which is not what it is using. A node at forty percent of its memory can still be full, because what has been sold is not what is running - and Pelican refuses a new server on any one of the three, so the tightest of them is what decides. `limit` and `percent` are null where the node is unlimited in that resource, which is not the same as empty and not the same as unknown. Memory and disk are MiB; cpu is percent of one core, so 400 is four cores.',
                'ceiling' => '`nodes` stops at two hundred rows and `nodes_total` is how many machines there really are.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'rate' => ['limit' => 60, 'remaining' => 59],
                    'tight_at_percent' => 90,
                    'nodes_total' => 1,
                    'nodes' => [[
                        'id' => 1,
                        'name' => 'node-01',
                        'servers' => 24,
                        'memory' => ['used' => 49_152, 'limit' => 65_536, 'percent' => 75],
                        'disk' => ['used' => 512_000, 'limit' => 1_024_000, 'percent' => 50],
                        'cpu' => ['used' => 1_600, 'limit' => null, 'percent' => null],
                        'worst_percent' => 75,
                        'full' => false,
                    ]],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/shop',
                'ability' => 'shop',
                'scope' => Key::PANEL,
                'summary' => 'What the shop took, what it is owed, and what is running.',
                'detail' => 'The ten figures the shop overview reads, in three queries. Its own ability rather than `panel`, which is the whole reason it is separate: a bot that reports a node going down has no business reading what the month took. Every amount is in minor units of `currency` - 1250 is 12.50 - and `selling` is false with a null `shop` on a panel that does not sell anything, so a bot can tell that from a fault.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'rate' => ['limit' => 60, 'remaining' => 59],
                    'selling' => true,
                    'shop' => [
                        'currency' => 'EUR',
                        'month' => 128_400,
                        'previous' => 119_950,
                        'outstanding' => 24_500,
                        'overdue' => 4_000,
                        'recurring' => 96_000,
                        'services' => 37,
                        'ending' => 2,
                        'pending' => 1,
                        'due_soon' => 3,
                        'low_stock' => [['name' => 'Redis 7', 'left' => 2]],
                    ],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/tickets',
                'ability' => 'support',
                'scope' => Key::PANEL,
                'summary' => 'Every ticket, and which of them are still waiting.',
                'detail' => 'The question staff want in a channel rather than on a page they have to remember to open. `state` is open, answered or closed; `priority` is low, normal or urgent; `claimed_by` is who picked it up, or null. `waiting_total` counts the ones where the customer spoke last, which is the number worth posting. **This panel\'s own tables are the answer whichever desk is switched on** - a ticket and every message on it are written here before a desk is asked to mirror them, so there is no hollow row for a ticket that lives elsewhere. `remote` is the desk\'s own id where there is one, and is what a module holding both ends matches on: a reply typed in Discord is written here when the webhook lands or the next pull runs, so this can be minutes behind that channel and is never ahead of it.',
                'ceiling' => '`tickets` stops at a hundred rows and `tickets_total` is how many there really are.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'rate' => ['limit' => 60, 'remaining' => 59],
                    'tickets_total' => 12,
                    'open_total' => 3,
                    'waiting_total' => 1,
                    'tickets' => [[
                        'id' => 7,
                        'subject' => 'Server will not start after the modpack update',
                        'state' => 'open',
                        'priority' => 'normal',
                        'opened_by' => ['id' => 4, 'username' => 'bryan'],
                        'server' => ['uuid' => '8df1a317-9244-4f0a-9e59-2f43f5b62bd9', 'name' => 'RIPCraft Survival'],
                        'claimed_by' => 'sofie',
                        'opened_at' => '2026-09-06T19:40:00+00:00',
                        'last_at' => '2026-09-07T09:12:00+00:00',
                        'closed_at' => null,
                        'remote' => null,
                    ]],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/tickets/{ticket}',
                'ability' => 'support',
                'scope' => Key::PANEL,
                'summary' => 'One ticket and what was said in it.',
                'params' => [
                    ['in' => 'path', 'name' => 'ticket', 'required' => true,
                        'note' => 'The ticket id, as returned by /tickets.'],
                ],
                'detail' => '`staff` says whether a line was an answer rather than a question, and `notice` says it was something happening rather than somebody talking - "moved to Billing", "now urgent" - which a bot should draw differently from a reply or not at all. **Staff notes are never served here.** A note staff wrote for each other about a customer is not something any key width unlocks, because the first use anybody has for this endpoint is posting a conversation into a channel a customer can read.',
                'ceiling' => '`messages` stops at a hundred rows and `messages_total` is how many there really are.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'rate' => ['limit' => 60, 'remaining' => 59],
                    'ticket' => [
                        'id' => 7,
                        'subject' => 'Server will not start after the modpack update',
                        'state' => 'open',
                        'priority' => 'normal',
                        'opened_by' => ['id' => 4, 'username' => 'bryan'],
                        'server' => ['uuid' => '8df1a317-9244-4f0a-9e59-2f43f5b62bd9', 'name' => 'RIPCraft Survival'],
                        'claimed_by' => 'sofie',
                        'opened_at' => '2026-09-06T19:40:00+00:00',
                        'last_at' => '2026-09-07T09:12:00+00:00',
                        'closed_at' => null,
                        'remote' => null,
                    ],
                    'messages_total' => 2,
                    'messages' => [[
                        'id' => 31,
                        'author' => 'bryan',
                        'staff' => false,
                        'notice' => false,
                        'body' => 'It stops about ten seconds after starting, every time.',
                        'at' => '2026-09-06T19:40:00+00:00',
                        'remote' => null,
                    ]],
                ],
            ],
            [
                'method' => 'POST',
                'path' => '/tickets/{ticket}/messages',
                'ability' => 'support.write',
                'scope' => Key::PANEL,
                'summary' => 'Answer a ticket.',
                'params' => [
                    ['in' => 'path', 'name' => 'ticket', 'required' => true,
                        'note' => 'The ticket id, as returned by /tickets.'],
                    ['in' => 'body', 'name' => 'body', 'required' => true,
                        'note' => 'What to say. Markdown, up to twenty thousand characters.'],
                ],
                'detail' => '**Always posted as staff, never as the customer.** A panel-wide key belongs to whoever runs the panel, so a reply it sends is an answer by definition; letting it choose would be letting it write a sentence into a customer\'s mouth. It goes through the same path the page uses, so the message is written here, mirrored to whichever desk is switched on, and the customer told, in the order those already happen. **Send an `Idempotency-Key` header.** A bot that times out and retries posts the same answer twice without one, and the second one is indistinguishable from somebody being rude. With one, the retry gets the first answer back instead of making a second message. The same header aimed at a different ticket, or sent with a different body, is a mistake rather than a retry and is told so with a 409. **A ticket that is closed answers 409 as well**, because no retry reopens it - reply to an open one or open a new ticket.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'rate' => ['limit' => 60, 'remaining' => 59],
                    'ticket' => 7,
                    'message' => 32,
                    'at' => '2026-09-07T12:00:00+00:00',
                ],
            ],
            [
                'method' => 'POST',
                'path' => '/tickets/{ticket}/close',
                'ability' => 'support.write',
                'scope' => Key::PANEL,
                'summary' => 'Mark a ticket finished.',
                'params' => [
                    ['in' => 'path', 'name' => 'ticket', 'required' => true,
                        'note' => 'The ticket id, as returned by /tickets.'],
                ],
                'detail' => 'Answers the same whether it was open or already closed, which is what makes this one safe to send twice without a header: closing a closed ticket is not a second closure, and a caller retrying should not be told off for the thing it wanted having already happened. Only the call that actually closed it is written into the panel\'s activity log. Closing does not delete anything and the customer can still read it.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'rate' => ['limit' => 60, 'remaining' => 59],
                    'ticket' => 7,
                    'state' => 'closed',
                    'closed_at' => '2026-09-07T12:00:00+00:00',
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
                    'rate' => ['limit' => 60, 'remaining' => 59],
                    'server' => ['uuid' => '8df1a317-9244-4f0a-9e59-2f43f5b62bd9', 'name' => 'RIPCraft Survival'],
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
                'detail' => 'The only endpoint here that asks the game rather than the panel. Minecraft answers through its own protocol, everything else through Valve\'s query - and a game that answers neither gives `players: null`, which is not the same as an empty server. Every answer carries the same six fields whichever game replied: `online`, `max`, `source`, `players`, `max_age_seconds` and the server, null where that game did not say and never absent. **`online` is what the server declares and `players` may be shorter than it**: some games answer the player query with fewer rows than they are running, so the list is a sample and the number is the number. A Minecraft row carries a name with `score` and `minutes` null; a Valve row carries all three. Both readers cache on the address for twenty seconds, so a hundred bots asking at once is one query; `max_age_seconds` says how stale an answer may be, so a quiet evening cannot be mistaken for an outage. Take the uuid from /me/servers. A server the key\'s owner cannot open is a 404 rather than a 403, because a 403 would confirm it exists.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'rate' => ['limit' => 60, 'remaining' => 59],
                    'server' => ['uuid' => '8df1a317-9244-4f0a-9e59-2f43f5b62bd9', 'name' => 'RIPCraft Survival'],
                    'source' => 'minecraft',
                    'max_age_seconds' => 20,
                    'online' => 3,
                    'max' => 40,
                    'players' => [
                        ['name' => 'Bryan', 'score' => null, 'minutes' => null],
                        ['name' => 'Sofie', 'score' => null, 'minutes' => null],
                        ['name' => 'Wout', 'score' => null, 'minutes' => null],
                    ],
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
                    'rate' => ['limit' => 60, 'remaining' => 59],
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
                'ceiling' => '`servers` stops at a hundred rows and `servers_total` is how many there really are.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'rate' => ['limit' => 60, 'remaining' => 59],
                    'connected' => true,
                    'username' => 'bryan',
                    'servers_total' => 1,
                    'servers' => [[
                        'uuid' => '8df1a317-9244-4f0a-9e59-2f43f5b62bd9',
                        'name' => 'RIPCraft Survival',
                        'owner' => true,
                        'may' => ['start' => true, 'stop' => true, 'restart' => true, 'console' => true],
                    ]],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/connect/{discord}/services',
                'ability' => 'shop',
                'scope' => Key::PANEL,
                'summary' => 'What the person behind a Discord id pays for.',
                'detail' => 'The same answer as /me/services, about somebody else. Everything under /me answers for the owner of the key, and a bot\'s key belongs to whoever runs the panel - so a module that knows a Discord id could read that person\'s servers and nothing about their services. Under the shop ability rather than connect, because this is money about a person: a key that may tie accounts together has no business reading what anybody pays unless that was granted too. `connected` is false with an empty list for a Discord id nobody has bound.',
                'ceiling' => '`services` stops at a hundred rows and `services_total` is how many there really are.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'rate' => ['limit' => 60, 'remaining' => 59],
                    'connected' => true,
                    'selling' => true,
                    'services_total' => 1,
                    'services' => [[
                        'id' => 41,
                        'package' => 'Redis 7',
                        'state' => 'active',
                        'server' => ['uuid' => '8df1a317-9244-4f0a-9e59-2f43f5b62bd9', 'name' => 'RIPCraft Survival'],
                        'price' => 400,
                        'currency' => 'EUR',
                        'period' => 'month',
                        'next_due_at' => '2026-10-07T00:00:00+00:00',
                        'ends_at' => null,
                    ]],
                ],
            ],
            [
                'method' => 'GET',
                'path' => '/connect/{discord}/backups',
                'ability' => 'connect',
                'scope' => Key::PANEL,
                'summary' => 'Which of that person\'s servers have no backup, and which have gone stale.',
                'detail' => 'The same two lists as /me/backups, about the person behind a Discord id. Telling somebody their server has not been backed up in three weeks is the most useful thing a bot can say that nothing else can, and it could only be said about the account the key belonged to. Under connect, like the servers list beside it, because it is the same class of answer about the same person.',
                'ceiling' => 'Each list stops at a hundred rows; `never_total` and `stale_total` are how many there really are.',
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'rate' => ['limit' => 60, 'remaining' => 59],
                    'connected' => true,
                    'never_total' => 1,
                    'stale_total' => 1,
                    'stale_after_days' => 7,
                    'never' => [['uuid' => '8df1a317-9244-4f0a-9e59-2f43f5b62bd9', 'name' => 'RIPCraft Survival', 'last_backup_at' => null]],
                    'stale' => [['uuid' => 'f47ac10b-58cc-4372-a567-0e02b2c3d479', 'name' => 'Mental RP', 'last_backup_at' => '2026-08-20T04:00:00+00:00']],
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
                    'rate' => ['limit' => 60, 'remaining' => 59],
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
                'answers' => [
                    'as_of' => '2026-09-07T12:00:00+00:00',
                    'rate' => ['limit' => 60, 'remaining' => 59],
                    'connected' => false,
                ],
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

        /*
         * The header the prose beside this insists on.
         *
         * A write says "send an Idempotency-Key" in its own description and the
         * example under it did not, so the thing somebody copies was the thing
         * that leaves them unprotected. Every endpoint that goes through
         * ApiController::written() is one whose ability ends in `.write`, which
         * is why that is the test rather than the method: /connect/claim is a
         * POST and is not one of these.
         */
        if (str_ends_with((string) ($endpoint['ability'] ?? ''), '.write')) {
            $out .= " \
  -H 'Idempotency-Key: <something you can send again>'";
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
                'name' => 'the key',

                'when' => 'No key, or one that is not usable. Every reason gives this same answer - missing, '
                    . 'malformed, unknown, revoked, expired, or belonging to an account that is gone.',
                'body' => ['error' => 'unauthorized'],
            ],
            [
                'code' => 403,
                'name' => 'the grant',

                'when' => 'A real key asking something it was not granted, or something its scope does not reach. Deliberately not a 401: the key is fine, so this is acted on by asking for a wider one rather than by checking the token. The body names which of the two it was - `ability` when the key was narrowed and this question is off its list, `needs` when the question wants a panel-wide key. With neither beside it, the address is one this documentation does not list, and every key is refused it until it does.',
                'body' => ['error' => 'forbidden', 'ability' => 'connect'],
            ],
            [
                'code' => 404,
                'name' => 'the thing asked for',
                'when' => 'The API is switched off, or the thing asked for is not one this key may reach. A '
                    . 'server somebody cannot open answers this rather than 403, because a 403 would confirm it '
                    . 'exists.',
                'body' => ['error' => 'not_found'],
            ],
            [
                'code' => 404,
                'name' => 'a part that is switched off',
                'when' => 'The part of the panel this address is a door onto is switched off. `part` names '
                    . 'which one, so it is not mistaken for the one above it: that is about this key or this '
                    . 'server, and this is about the panel. Deliberately not 403, for the same reason the pages '
                    . 'answer 404 - a part that is off does not exist here, and "forbidden" would send somebody '
                    . 'looking for the permission that would fix it. No key of any width changes this answer; '
                    . 'somebody has to switch that part back on under Modules.',
                'body' => ['error' => 'not_found', 'part' => 'capacity'],
            ],
            [
                'code' => 409,
                'name' => 'the same key, twice, differently',
                'when' => 'An `Idempotency-Key` that was already used for a different request - a different address, a different ticket, or a different body counts as different - or a write that cannot be done as it was asked: a reply with nothing in it, or a reply to a ticket that is closed. Retrying changes none of them, which is why it is not a 503: a client told to back off would conflict again on every attempt until somebody changed the token, the body, or the ticket.',
                'body' => ['error' => 'conflict'],
            ],
            [
                'code' => 429,
                'name' => 'the allowance',

                'when' => 'The allowance for this key this minute is spent. The ceiling is in the body, so a bot '
                    . 'that is told no can work out how long to wait rather than retrying immediately and making '
                    . 'it worse.',
                'body' => ['error' => 'too_many_requests', 'rate' => ['limit' => 60, 'remaining' => 0]],
            ],
            [
                'code' => 503,
                'name' => 'the panel',

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
                'event' => 'node.reachable',
                'kind' => 'raised',
                'class' => 'alarm',
                'subject' => ['type' => 'node', 'id' => 1],
            ],

            /*
             * What a receiver can branch on, which is the half `title` cannot
             * give it: those are sentences, and translated ones, so a bot
             * matching on them breaks the day somebody changes a word.
             *
             * `kind` is raised the first time, reminder while it is still going
             * on, and cleared when it stops. `subject` is present where the
             * check is about one thing and null where it is about the panel.
             */
            'events' => [
                ['name' => 'node.reachable', 'when' => 'The panel cannot reach a node, or can again.'],
                ['name' => 'node.maintenance', 'when' => 'A node was put into maintenance, or taken out.'],
                ['name' => 'node.wings', 'when' => 'A node is running a daemon older than the panel wants.'],
                ['name' => 'node.disk', 'when' => 'A node has crossed the disk line you set.'],
                ['name' => 'node.memory', 'when' => 'A node has crossed the memory line you set.'],
                ['name' => 'panel.version', 'when' => 'The panel itself is behind.'],
                ['name' => 'panel.worker', 'when' => 'No queue worker answered, or one came back.'],
                ['name' => 'panel.failed', 'when' => 'Jobs are failing.'],
                ['name' => 'backups.none', 'when' => 'Servers have never been backed up.'],
                ['name' => 'backups.stale', 'when' => 'Backups have gone older than your threshold.'],
                ['name' => 'backups.failed', 'when' => 'A backup failed.'],
                ['name' => 'schedules.stopped', 'when' => 'Scheduled tasks are stuck, overdue or never run.'],
                ['name' => 'shop.unbuilt', 'when' => 'An order is paid and has no server.'],
                ['name' => 'shop.stock.out', 'when' => 'A package has sold out.'],
                ['name' => 'shop.stock.low', 'when' => 'A package is nearly gone.'],
                ['name' => 'shop.stock.back', 'when' => 'A package that had sold out is available again.'],
            ],

            /*
             * The other sort, and the list is read from the sender.
             *
             * Notifier::FACTS is what decides whether one of these goes out, so
             * documenting a second copy here would be documenting something
             * nobody sends. Every one of them is off until an administrator
             * ticks it under Alerts, which is why they are listed apart rather
             * than mixed in: a receiver that subscribes to everything above
             * gets all of it, and none of this unless somebody chose it.
             */
            'facts' => array_map(
                static fn (string $name, string $when): array => ['name' => $name, 'when' => $when],
                array_keys(Notifier::FACTS),
                array_values(Notifier::FACTS),
            ),
            'branching' => 'Branch on `class`, `event` and `kind`, never on `title` or `body` - those are '
                . 'sentences, they are translated, and a bot matching on them breaks the day somebody rewords '
                . 'one. '
                . '`class` is **alarm** for something wrong and **fact** for something that simply happened, '
                . 'and it is the first thing to read: an alarm is raised and later cleared, where a fact '
                . 'happens once and is never taken back. '
                . '`kind` is **raised** the first time an alarm is seen, **reminder** while it is still going '
                . 'on and **cleared** when it stops, so a receiver can post once and edit rather than posting '
                . 'every time the watchdog runs; on a fact it is **happened**, or a word of its own where '
                . 'there is something to say - a ticket is **asked** or **answered**. '
                . '`subject` names the one thing it is about - `{"type": "node", "id": 1}` - and is null for '
                . 'a check about the panel as a whole. '
                . '`good` keeps the meaning it has always had for alarms: false on the way in and true on the '
                . 'way out. On a fact it says whether the thing that happened was welcome, which is true for '
                . 'a sale and false for a build that failed.',
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
     * Grouped rather than one a path, because a list of nineteen checkboxes
     * that grows every release is a list nobody reads before ticking all of
     * them - and a permission nobody reads is not a permission. The groups are
     * what they cost and what they reach, which is what somebody deciding is
     * actually weighing:
     *
     *  - **health** proves a key works and reaches nothing else.
     *  - **me** answers for the key owner and cannot see anybody else.
     *  - **panel** is every node, every backup, the watchdog, the host.
     *  - **live** asks a game server or a daemon, so it costs something.
     *  - **support** is the ticket desk. Kept out of panel for the reason the
     *    shop is: it is a conversation with a customer in it.
     *  - **support.write** answers and closes those tickets. The only group
     *    that changes anything, which is why it says so in its name.
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

    /**
     * One line per ability group, for a reader rather than for a form.
     *
     * The panel already has these in `lang/en/settings.php`, translated into
     * every language it ships, and this deliberately does not use them: both
     * downloads are English documents that go into somebody's repository beside
     * their bot, and a file whose headings change language depending on who
     * pressed the button is a file nobody can diff.
     *
     * Kept to one sentence each because they are tag descriptions, and an
     * importer draws them in a sidebar.
     */
    public static function abilityNote(string $ability): string
    {
        return match ($ability) {
            'health' => 'Proves a key works and reaches nothing else. Safe to call on a timer.',
            'me' => 'Answers for the key owner: their servers, their backups, what they pay for. It can never see anybody else.',
            'panel' => 'The whole panel - every node, every backup, the stopped schedules, the watchdog and the host. Needs a panel-wide key as well.',
            'shop' => 'What was taken, what is owed and what is running. Its own group rather than part of panel, because a bot that reports a dead node has no business reading the takings.',
            'live' => 'Asks a game server or a daemon directly. The only group that costs anything, so its answers are cached fifteen to twenty seconds.',
            'support' => 'The ticket desk: what was asked, what was answered, and which tickets are still waiting. Staff notes are never included.',
            'support.write' => 'Answers a ticket and closes one, as staff. The only group here that changes anything a customer sees, and the only one with a verb in its name.',
            'connect' => 'Ties Discord accounts to panel accounts and mints Pelican keys on them. The one group that is not a reading.',
            default => 'Undocumented. If this shows in a generated file, Docs::abilityNote() has not heard of an ability that Docs::endpoints() has.',
        };
    }

    /**
     * What one key may actually ask, which is not what its column says.
     *
     * Two rules, both already enforced by the controller and neither readable
     * by the caller until now. A key holds a list of abilities and may do what
     * is on it; a key with nothing recorded at all may read everything its
     * scope allows and write nothing, which is what every key issued before
     * that column existed has. See Key::may(), which is where the difference
     * between the two is kept.
     * And a key has a scope: a personal one cannot reach a panel-wide endpoint
     * however its abilities are set.
     *
     * So this walks the endpoints, keeps the ability of each one this key could
     * actually call, and answers the set. A bot reads it once and knows which
     * of its commands to offer, instead of finding out by being refused in
     * front of somebody.
     *
     * @return array<int, string>
     */
    public static function abilitiesFor(Key $key): array
    {
        $out = [];

        foreach (self::endpoints() as $endpoint) {
            $ability = (string) ($endpoint['ability'] ?? '');

            if ($ability === '' || in_array($ability, $out, true)) {
                continue;
            }

            if (!$key->may($ability)) {
                continue;
            }

            // The scope, which is the other half of what answer() asks. `any`
            // is reachable by both; a panel-wide question is not reachable by a
            // personal key however it was granted.
            if (($endpoint['scope'] ?? 'any') === Key::PANEL && $key->scope !== Key::PANEL) {
                continue;
            }

            $out[] = $ability;
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
                'title' => 'Every moment is ISO-8601',
                'body' => 'Every `*_at` in every answer is ISO-8601 with a UTC offset - `2026-09-07T12:00:00+00:00` - and that is a promise rather than a habit. '
                    . 'It is written down because one of them was not: `last_backup_at` came off a sub-select as whatever string the database printed, '
                    . 'so a body carried two formats and `new Date(...)` read the same backup as a different hour in Safari and in Node. '
                    . 'Parse them with whatever your language calls a date; none of them needs a format string.',
            ],
            [
                'title' => 'What a key may ask about',
                'body' => 'A key can be narrowed to some of these questions and not others, in seven groups: '
                    . '**health** proves it works and reaches nothing else; **me** answers for its owner and can never see anybody else; **panel** is every node, backup, schedule, the host and how full each machine is; **shop** is what was taken, what is owed and what is running, which is money and is kept out of **panel** for exactly that reason; **live** asks a game server or a daemon, so it costs something; **support** is the ticket desk, which is a conversation with a customer in it and is kept apart for the same reason the shop is; **support.write** answers and closes those tickets, and is the only group that changes anything - which is why it has a verb in its name and why it is granted on its own; and **connect** ties Discord accounts to panel accounts and hands out Pelican keys - the one group that is not a reading. '
                    . 'A key with nothing recorded may read everything its scope allows and write nothing, which is what every key issued before this existed has: **support.write** has to be ticked on a key in so many words. One that was narrowed may do what is on its list and nothing else, including abilities added in a later release - a capability nobody ticked is a capability nobody granted. Asking anyway gives **403** with the ability named.',
            ],
            [
                'title' => 'Rate limiting',
                'body' => 'Counted per key rather than per address, because one host may hold several keys and throttling them together would make a loop in one bot a problem for all of them. Every response carries `rate.limit` and `rate.remaining` beside `as_of`; going over returns **429** with the ceiling in it, so a bot that is told no can work out how long to wait rather than retrying straight away and making it worse. '
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
                    . 'freely. Read the second one and refuse to be surprised by it. '
                    . '**1.0.0 is the version that promise starts at.** Fields and endpoints will be added, and a bot '
                    . 'that treats a field it has never seen as a reason to stop is a bot that will stop. What will '
                    . 'not happen inside `v1` is a field changing meaning, changing type, or going away.',
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
            $out[] = 'Keys that may call it: **' . self::scopeWords($endpoint['scope']) . '**'
                . (($endpoint['ability'] ?? '') === ''
                    ? '.'
                    : ', holding the **' . $endpoint['ability'] . '** ability.');
            $out[] = '';

            // Said per endpoint rather than once in the notes, because notes()
            // is read by this method alone and the OpenAPI file would then be
            // the one download that never mentions a ceiling.
            if (($endpoint['ceiling'] ?? '') !== '') {
                $out[] = $endpoint['ceiling'];
                $out[] = '';
            }

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
            $out[] = '### ' . $error['code']
                . (($error['name'] ?? '') === '' ? '' : ' - ' . $error['name']);
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
        $out[] = $hook['branching'];
        $out[] = '';
        $out[] = '| Event | When it arrives |';
        $out[] = '| --- | --- |';

        foreach ($hook['events'] as $event) {
            $out[] = '| `' . $event['name'] . '` | ' . $event['when'] . ' |';
        }

        $out[] = '';
        $out[] = 'And the things that simply happened, which carry `class: fact`. **Every one of these is off '
            . 'until somebody ticks it** under Alerts, so a panel that upgrades into this release keeps '
            . 'sending exactly what it sent before:';
        $out[] = '';
        $out[] = '| Event | When it arrives |';
        $out[] = '| --- | --- |';

        foreach ($hook['facts'] as $fact) {
            $out[] = '| `' . $fact['name'] . '` | ' . $fact['when'] . ' |';
        }

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

            /*
             * Keyed by status code, which two of these share.
             *
             * OpenAPI has one response per code and this plugin answers 404 for
             * two different reasons: a thing that is not there, and a part of
             * the panel that is switched off. Writing them in turn kept the
             * second and silently dropped the first, so an imported collection
             * described the rarer of the two and never mentioned the common
             * one. Joined instead, each behind its own name.
             */
            foreach (self::errors() as $error) {
                $code = (string) $error['code'];
                $said = (($error['name'] ?? '') === '' ? '' : ucfirst((string) $error['name']) . ': ')
                    . $error['when'];

                if (isset($responses[$code])) {
                    $responses[$code]['description'] .= "

" . $said;

                    continue;
                }

                $responses[$code] = array_filter([
                    'description' => $said,
                    'content' => $error['body'] === []
                        ? null
                        : ['application/json' => ['example' => $error['body']]],
                ]);
            }

            $ability = (string) ($endpoint['ability'] ?? '');

            $operation = [
                // A generator names its method after this, so it is the
                // difference between client.health() and client.getV1Health().
                'operationId' => self::operationId($endpoint),
                'summary' => $endpoint['summary'],
                /*
                 * The ability belongs here as well as in the tag.
                 *
                 * A bearer token has no scopes in OpenAPI - that is an oauth2
                 * field - so there is nowhere structural to say which of the
                 * six groups a key needs, and an importer that shows only the
                 * description would otherwise show none of it. Somebody reading
                 * this in Swagger UI is deciding which box to tick on the key
                 * form, and this is the sentence that tells them.
                 */
                'description' => $endpoint['detail']
                    . (($endpoint['ceiling'] ?? '') === '' ? '' : ' ' . $endpoint['ceiling'])
                    . ' Keys that may call it: '
                    . self::scopeWords($endpoint['scope'])
                    . ($ability === '' ? '.' : ', holding the ' . $ability . ' ability.'),
                'security' => [['bearer' => []]],
                'responses' => $responses,
            ];

            // Grouped by ability, because that is also how a key is granted -
            // so the sections of an imported collection are the sections of the
            // form somebody fills in to allow it.
            if ($ability !== '') {
                $operation['tags'] = [$ability];
            }

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

        $hook = self::webhook();

        return [
            'openapi' => '3.1.0',
            'info' => [
                'title' => 'Essentials API',
                'version' => ApiController::VERSION,
                'description' => 'What this panel knows that Pelican\'s own API does not: which servers have '
                    . 'no backup, who is connected to a game server right now, whether another one fits on a '
                    . 'node, what the shop took, and what the watchdog thinks. Nothing here starts, stops or '
                    . 'reaches into a server - Pelican\'s own client API does that, with its own permissions '
                    . 'and its own activity log, and /connect/claim hands your bot a real key for it.',
            ],
            'servers' => [['url' => self::base()]],

            /*
             * The six ability groups, as tags.
             *
             * Every operation carries one, so an import lands as six folders
             * rather than as nineteen calls in a row - and the six are the same
             * six on the form that grants a key, which is the point of naming
             * them this way rather than by subject.
             */
            'tags' => array_values(array_map(
                static fn (string $ability): array => [
                    'name' => $ability,
                    'description' => self::abilityNote($ability),
                ],
                self::abilities(),
            )),

            /*
             * The one thing that arrives without being asked for.
             *
             * 3.1 added a place for this and the document has claimed to be 3.1
             * since it was written, while describing only the calls going out.
             * A module author importing this file was shown nineteen requests
             * and no hint that the panel posts back.
             */
            'webhooks' => [
                'alert' => [
                    'post' => [
                        'operationId' => 'alert',
                        'summary' => 'What the panel posts to you, unasked.',
                        'description' => 'Switched on under Alerts, with an address and a signing secret. '
                            . 'The body is hashed with the secret and the hash travels in '
                            . 'X-Essentials-Signature as sha256=<hex>; hash the raw body rather than a '
                            . 're-serialised object, because any difference in spacing or key order gives a '
                            . 'different hash. ' . $hook['branching']
                            . ' The alarms it can carry: '
                            . implode(', ', array_column($hook['events'], 'name'))
                            . '. And the facts, each off until it is ticked under Alerts: '
                            . implode(', ', array_column($hook['facts'], 'name')) . '.',
                        'requestBody' => [
                            'required' => true,
                            'content' => ['application/json' => ['example' => $hook['body']]],
                        ],
                        'responses' => [
                            '200' => ['description' => 'Anything 2xx. The panel does not retry, so a receiver '
                                . 'that needs the message should write it down before answering.'],
                        ],
                    ],
                ],
            ],
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
