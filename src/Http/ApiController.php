<?php

namespace LegendDevelopment\Theme\Http;

use App\Enums\SubuserPermission;
use App\Models\Server;
use App\Models\User;
use Carbon\CarbonImmutable;
use DateTimeInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use LegendDevelopment\Theme\Models\Key;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Support\Alerts\State;
use LegendDevelopment\Theme\Support\Api\Connections;
use LegendDevelopment\Theme\Support\Api\Docs;
use LegendDevelopment\Theme\Support\Api\Keys;
use LegendDevelopment\Theme\Support\Backups;
use LegendDevelopment\Theme\Support\Capacity;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Games\A2S;
use LegendDevelopment\Theme\Support\Games\Games;
use LegendDevelopment\Theme\Support\Minecraft\Minecraft;
use LegendDevelopment\Theme\Support\Minecraft\Ping;
use LegendDevelopment\Theme\Support\Channels;
use LegendDevelopment\Theme\Support\NodeHealth;
use LegendDevelopment\Theme\Support\Schedules;
use LegendDevelopment\Theme\Support\Shop\Tables as ShopTables;
use LegendDevelopment\Theme\Support\Shop\Takings;
use LegendDevelopment\Theme\Support\SystemStatus;
use App\Facades\Activity;
use LegendDevelopment\Theme\Support\Api\Writes;
use RuntimeException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use LegendDevelopment\Theme\Models\Ticket;
use LegendDevelopment\Theme\Models\TicketMessage;
use LegendDevelopment\Theme\Support\Tickets\Board;
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
 * implementation: it started at 0.0.1 and is 1.0.0. A bot should read the
 * second and refuse to be surprised by it.
 *
 * **Every failure looks the same from outside.** A missing header, a malformed
 * key, a prefix that does not exist, a secret that does not match, a key
 * revoked this morning, one that expired, one whose owner is gone: all 401,
 * all the same body. Saying which would be telling somebody which half of a key
 * they had right.
 */
class ApiController
{
    /**
     * Which part of the plugin each address is a second door onto.
     *
     * It had none, and answered everything. Switch off the backups overview and
     * /backups went on listing every server by how long it had gone without
     * one; switch off the watchdog and /alerts went on reporting what it had
     * last found. A switch that a bot can walk around is not a switch, it is a
     * setting for one of the two doors.
     *
     * Keyed by the route pattern rather than by the ability, because the
     * abilities are four coarse words - panel, me, live, connect - and one of
     * them covers five different parts. The pattern is what the route is.
     *
     * /health and /connect are not here on purpose. They are this API being
     * itself: what a key is, and which Discord account holds one. Both are
     * already behind Features::API, which is the switch that decides whether
     * any of this is registered at all.
     *
     * /capacity and /connect/{discord}/backups are here and were not, and both
     * went on answering with their part switched off. The first is the
     * capacity page's own table; the second is the same backup reading as
     * /backups, about one person.
     *
     * /schedules is gated on the stopped-schedules page it reads, and was
     * gated on Features::SCHEDULED - the switch for a different look between
     * two times of day, which only shares the first letters. See NAMED for why
     * its 404 still says `scheduled`.
     *
     * @var array<string, string>
     */
    private const PARTS = [
        '/nodes' => Features::CAPACITY,
        '/capacity' => Features::CAPACITY,
        '/system' => Features::SYSTEM_STATUS,
        '/backups' => Features::BACKUPS,
        '/schedules' => Features::SCHEDULES,
        '/tickets' => Features::TICKETS,
        '/tickets/{ticket}' => Features::TICKETS,
        '/tickets/{ticket}/messages' => Features::TICKETS,
        '/tickets/{ticket}/close' => Features::TICKETS,
        '/alerts' => Features::ALERTS,
        '/me/servers' => Features::MY_BACKUPS,
        '/me/backups' => Features::MY_BACKUPS,
        '/connect/{discord}/backups' => Features::BACKUPS,
        '/servers/{server}/players' => Features::GAME_PLAYERS,
    ];

    /**
     * The part a 404 names, where it is not the switch behind the address.
     *
     * Only /schedules, and only because of the fault above: its switch was
     * corrected and its refusal went out as `part: scheduled` for as long as
     * the wrong one was read. That field is what a bot branches on, so the
     * name on the wire stays; changing it is a change to v1.
     *
     * @var array<string, string>
     */
    private const NAMED = [
        '/schedules' => Features::SCHEDULED,
    ];

    /** The shape of what comes back. In the path, so a bot can pin it. */
    public const CONTRACT = 'v1';

    /**
     * A ceiling on how many services one answer carries.
     *
     * Somebody with four hundred is somebody a bot should be paging through,
     * and there is no paging here. A number well above any real customer
     * and well below a body nothing can read.
     */
    public const MOST_SERVICES = 100;

    /**
     * How many rows any other list carries at most.
     *
     * **No ceiling is also a promise, and it is the one that breaks first.**
     * Four of these lists had none at all: a panel with nine hundred servers
     * answered with nine hundred rows in one body, and /backups hydrated every
     * server on the panel to report the handful with no backup.
     *
     * Not paging. The queries behind these are ordered by computed columns - a
     * server's newest backup is a withMax over a join - and a cursor cannot be
     * built honestly over an order the database works out per row. What a bot
     * actually wants from these is the number anyway: "47 servers have no
     * backup" is what gets posted, not a list of 47.
     *
     * So each list carries a `*_total` beside it saying how many there really
     * were, and the rows stop here. A caller that sees a total larger than the
     * list it got knows it is looking at the first hundred, which is the thing
     * no ceiling ever told it.
     */
    public const MOST_ROWS = 100;

    /**
     * This implementation.
     *
     * **1.0.0 is not a bigger number, it is a promise being made.** Everything
     * that had to change about a shape has changed, because after this it costs
     * a `v2` - the five things roadmap/api-one.md named, each of them checked
     * against a live panel rather than argued: every field named at the
     * boundary, every moment in one format, no field that comes and goes, a
     * total beside every list that stops short, and a grant that is knowable
     * and closed.
     *
     * What it promises is the shape, not the contents. Fields will be added,
     * endpoints will be added, and a bot that reads a field it does not know
     * about as a reason to stop is a bot that will stop. What will not happen
     * inside `v1` is a field changing meaning, changing type, or going away.
     */
    public const VERSION = '1.0.0';

    /* ------------------------------------------------------------ health -- */

    public function health(Request $request): JsonResponse
    {
        return $this->answer($request, Key::PERSON, function (Key $key): array {
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

                    /*
                     * What this key may ask, resolved rather than copied.
                     *
                     * The stored column has three states and only one of them
                     * is a list: null is the legacy read-everything-its-scope-
                     * allows that keys issued before the column existed carry.
                     * Publishing the column would put that state on the wire
                     * and make a later narrowing look like a change to the
                     * caller. This is the effective answer instead: the groups
                     * this key holds, narrowed to the ones its scope can reach,
                     * which is the pair answer() actually enforces. See
                     * Key::may() for the three states.
                     *
                     * Without it a bot discovers what it may do by being
                     * refused, which for a module rendering a menu means
                     * drawing a button that 403s.
                     */
                    'abilities' => Docs::abilitiesFor($key),
                    'expires_at' => $key->expires_at?->toIso8601String(),
                    /*
                     * The prefix of whatever replaced this one, or null.
                     *
                     * A key being rotated keeps working until the day in
                     * `expires_at`, which is the whole point of rotating one -
                     * so the only way a bot can know it is holding the outgoing
                     * half is to be told. Without this it finds out by being
                     * refused, on whichever morning the window closed.
                     */
                    'replaced_by' => $key->replaced_by,
                ],
                /*
                 * Who the key answers as. A bot handed the wrong key finds out
                 * here rather than by wondering why a list is short.
                 */
                'acting_for' => [
                    'id' => $key->user?->id,
                    'username' => $key->user?->username,
                ],
            ];
        });
    }

    /**
     * A write, done once however many times it is sent.
     *
     * Everything answer() does, with one thing in front of it. A caller may
     * send an `Idempotency-Key` header; if it did, and this key has already
     * been answered for that header with the same request, the first answer
     * comes back instead of the work happening again. See Api\Writes for why
     * that is the shape rather than a 409 saying "already done".
     *
     * **Without the header there is no protection, and that is the caller's
     * choice to make.** A write that silently deduplicated on its own content
     * would refuse a customer who genuinely wrote the same sentence twice, and
     * this cannot tell those two apart. The header is how a caller says which
     * it meant.
     *
     * The envelope around a replayed answer is fresh - `as_of` is now and
     * `rate` is this minute's - because those describe this response. The body
     * is the one from the first time, because that describes what happened.
     */
    private function written(Request $request, string $needs, callable $work): JsonResponse
    {
        $token = trim((string) $request->header(Writes::HEADER, ''));
        $route = $this->pattern($request);

        /*
         * What the path bound, as well as what was sent.
         *
         * $route is the pattern, so /tickets/3/close and /tickets/9/close were
         * one address here, and closing carries no body at all - one token
         * aimed at two tickets matched on both halves, replayed the first
         * answer and left the second ticket open while telling the caller it
         * was closed. The ticket is in neither half unless it is put there.
         *
         * http_build_query rather than json_encode, which answers false for a
         * path segment that is not valid UTF-8 and would fold quietly back to
         * a fingerprint of the body alone.
         */
        $digest = hash(
            'sha256',
            http_build_query($request->route()?->parameters() ?? []) . "\n" . (string) $request->getContent(),
        );

        return $this->answer($request, $needs, static function (Key $key) use ($work, $token, $route, $digest): array {
            $seen = Writes::recall($key, $token, $route, $digest);

            if ($seen === false) {
                throw new ConflictHttpException();
            }

            if (is_array($seen)) {
                return $seen['body'];
            }

            $body = $work($key);

            Writes::remember($key, $token, $route, $digest, 200, $body);

            return $body;
        });
    }

    /* ----------------------------------------------------- the support ---- */

    /**
     * Every ticket, newest conversation first.
     *
     * **The panel's own tables are the answer whichever desk is switched on**,
     * which is worth saying because the plan this came from guessed otherwise.
     * A ticket and every message on it are written here before a desk is asked
     * to mirror them - see Tickets\Board - so there is no such thing as a
     * hollow row for a ticket that "lives" in Modora. It lives here.
     *
     * What that does leave is a question of timing, and `remote` is the answer
     * to it: a module reading the same conversation from Modora as well can
     * match the two on that id rather than posting a message twice. A reply
     * typed in Discord is written here when the webhook lands or when the next
     * pull runs, so this can be a few minutes behind the channel and never
     * ahead of it.
     *
     * **The rows it keeps and nothing more.** This used to read the whole table
     * to count it and keep the first hundred, so a desk with years of history
     * hydrated thousands of tickets per call - and then asked for each row's
     * customer, server and claimer one query at a time. The hundred are read
     * with their three accounts, and both totals are counted by the database.
     *
     * Queried here rather than through Board, whose readers answer an empty
     * list when the table cannot be read. A page can live with that; an answer
     * that says a panel has no tickets because its database is down is the
     * thing the 503 exists to prevent.
     */
    public function tickets(Request $request): JsonResponse
    {
        return $this->answer($request, Key::PANEL, static function (): array {
            $rows = [];

            $latest = Ticket::query()
                ->with(['user', 'server', 'claimer'])
                ->orderByDesc('last_at')
                ->orderByDesc('id')
                ->limit(self::MOST_ROWS)
                ->get();

            foreach ($latest as $ticket) {
                /** @var Ticket $ticket */
                $rows[] = self::ticketRow($ticket);
            }

            return [
                'tickets_total' => Ticket::query()->count(),
                'open_total' => Ticket::query()->where('state', '!=', Ticket::CLOSED)->count(),
                'waiting_total' => Board::waiting(),
                'tickets' => $rows,
            ];
        });
    }

    /**
     * One ticket and what was said in it.
     *
     * **Staff notes are never served.** A message flagged `inside` is a thing
     * staff wrote for each other about a customer, and the first use anybody
     * has for this endpoint is posting a conversation into a Discord channel.
     * There is no key width that changes this: an API that can leak an internal
     * note into a customer-facing channel is one nobody should point at a bot,
     * and if that is ever wanted it is an addition rather than a flag here.
     */
    public function ticket(Request $request, string $ticket): JsonResponse
    {
        return $this->answer($request, Key::PANEL, static function () use ($ticket): array {
            $row = Ticket::query()->find((int) $ticket);

            if (!$row instanceof Ticket) {
                throw new NotFoundHttpException();
            }

            $said = [];
            $total = 0;

            foreach (Board::messages($row) as $message) {
                /** @var TicketMessage $message */
                if ((bool) $message->inside) {
                    continue;
                }

                $total++;

                if (count($said) >= self::MOST_ROWS) {
                    continue;
                }

                $said[] = [
                    'id' => (int) $message->id,
                    'author' => (string) $message->author,
                    // Who said it, in the two ways a receiver needs: whether it
                    // was an answer, and whether it was a person talking at all.
                    'staff' => (bool) $message->staff,
                    'notice' => (bool) $message->notice,
                    'body' => (string) $message->body,
                    'at' => self::moment($message->created_at),
                    'remote' => $message->remote === null ? null : (string) $message->remote,
                ];
            }

            return [
                'ticket' => self::ticketRow($row),
                'messages_total' => $total,
                'messages' => $said,
            ];
        });
    }

    /**
     * One ticket, as both endpoints publish it.
     *
     * Named here rather than written twice, for the reason blocker 1 of
     * roadmap/api-one.md gives: a shape that is built in two places is a shape
     * that disagrees with itself the first time one of them is changed.
     *
     * @return array<string, mixed>
     */
    private static function ticketRow(Ticket $ticket): array
    {
        $server = $ticket->server;

        return [
            'id' => (int) $ticket->id,
            'subject' => (string) $ticket->subject,
            'state' => (string) $ticket->state,
            'priority' => (string) $ticket->priority,
            'opened_by' => [
                'id' => $ticket->user_id === null ? null : (int) $ticket->user_id,
                'username' => $ticket->user?->username,
            ],
            'server' => $server === null ? null : [
                'uuid' => (string) $server->uuid,
                'name' => (string) $server->name,
            ],
            'claimed_by' => $ticket->claimed_by === null ? null : $ticket->claimer?->username,
            'opened_at' => self::moment($ticket->created_at),
            'last_at' => self::moment($ticket->last_at),
            'closed_at' => self::moment($ticket->closed_at),
            /*
             * The desk's own id for this, where a desk keeps one.
             *
             * Null on a panel answering its own tickets, and the thing a module
             * holding both ends matches on where it is not.
             */
            'remote' => $ticket->remote === null ? null : (string) $ticket->remote,
        ];
    }

    /**
     * Say something in a ticket, as staff.
     *
     * **Always as staff, and never as the customer.** A panel-wide key belongs
     * to whoever runs the panel, so a reply it posts is an answer by
     * definition; letting it choose would be letting it write a sentence into a
     * customer's mouth, which is not a capability worth having for the sake of
     * symmetry.
     *
     * Through Board::say(), which is the same path the page uses - so the
     * message is written here first, mirrored to whichever desk is switched on,
     * and the customer is told, all in the order they already happen. Nothing
     * about this endpoint is a second implementation of replying.
     *
     * **A ticket that is closed is a refusal and not a fault**, so it answers
     * 409 rather than 503. Reopening one is not something this API does.
     */
    public function reply(Request $request, string $ticket): JsonResponse
    {
        return $this->written($request, Key::PANEL, static function (Key $key) use ($request, $ticket): array {
            $row = Ticket::query()->find((int) $ticket);

            if (!$row instanceof Ticket) {
                throw new NotFoundHttpException();
            }

            $said = trim((string) $request->input('body', ''));

            if ($said === '') {
                throw new ConflictHttpException();
            }

            /*
             * A closed ticket first, and by asking the ticket rather than by
             * reading say()'s null.
             *
             * say() answers null for a closed ticket and for a write that
             * failed alike, and the two want opposite statuses. This was the
             * 503 for both, which told a bot to back off and retry a refusal
             * that no retry changes - and every retry reported another
             * exception into the panel's log. A closed ticket is 409, the same
             * as a body with nothing in it and for the same reason.
             */
            if ($row->closed()) {
                throw new ConflictHttpException();
            }

            $message = Board::say($row, $key->user, $said, true);

            /*
             * And null now is the other thing: the ticket is open and the write
             * did not happen anyway. That is a fault, Board has already reported
             * it, and a retry may well clear it - so it is the 503 that says so.
             */
            if (!$message instanceof TicketMessage) {
                throw new RuntimeException('The ticket desk did not write the reply.');
            }

            self::wrote($key, 'ticket.reply', $row, ['message' => (int) $message->id]);

            return [
                'ticket' => (int) $row->id,
                'message' => (int) $message->id,
                'at' => self::moment($message->created_at),
            ];
        });
    }

    /**
     * Mark a ticket finished.
     *
     * Answers the same whether it was open or already closed, which is what
     * makes it safe to send twice without a header - closing a closed ticket
     * is not a second closure, and a caller retrying should not be told off for
     * the thing it was trying to achieve having already happened.
     *
     * And only a closure that happened on this call is written into the
     * panel's log. A second call logging a second closure would make the
     * record say something that is not true.
     */
    public function closeTicket(Request $request, string $ticket): JsonResponse
    {
        return $this->written($request, Key::PANEL, static function (Key $key) use ($ticket): array {
            $row = Ticket::query()->find((int) $ticket);

            if (!$row instanceof Ticket) {
                throw new NotFoundHttpException();
            }

            // True only when this call is what closed it, which is the question.
            $closed = Board::close($row);

            /*
             * Read back rather than trusted.
             *
             * close() fills the row and then saves it, so an instance whose
             * save failed still says closed in memory - and answering from it
             * would tell a bot a conversation was finished while the table has
             * it open. A ticket still open after this is the desk refusing,
             * which is a 503 rather than a closure that did not happen.
             */
            $row = Ticket::query()->find((int) $row->id);

            if (!$row instanceof Ticket || !$row->closed()) {
                throw new RuntimeException('The ticket desk did not close the ticket.');
            }

            if ($closed) {
                self::wrote($key, 'ticket.close', $row, []);
            }

            return [
                'ticket' => (int) $row->id,
                'state' => (string) $row->state,
                'closed_at' => self::moment($row->closed_at),
            ];
        });
    }

    /**
     * Write it down where the panel already writes things down.
     *
     * Pelican's own activity log, through its own facade, rather than a second
     * log of ours: an administrator looking for what happened on this panel has
     * one page to look at, and a row this plugin wrote is a row that page
     * already draws. The house rule was read first - App\Facades\Activity is
     * public and Support\Activity has been reading what it writes for releases.
     *
     * **Which key did it is the whole point.** A write through the API is a
     * thing a person did not do at a screen, so the actor alone does not
     * answer "who", and the prefix is the half of a key that is safe to record.
     *
     * @param  array<string, mixed>  $extra
     */
    private static function wrote(Key $key, string $what, Ticket $ticket, array $extra = []): void
    {
        try {
            /*
             * The ticket named in a property rather than as the subject.
             *
             * subject() is a polymorphic relation and Pelican enforces a morph
             * map, so handing it a model of this plugin's throws
             * ClassMorphViolationException - which the catch below turned into
             * a reported error and an empty log. A plugin has no business
             * claiming an alias in the panel's own morph map either, so the id
             * goes in beside the key, where a reader needs it anyway.
             */
            $entry = Activity::event('essentials:' . $what)
                ->property('ticket', (int) $ticket->id)
                ->property('key', (string) $key->prefix)
                ->property('via', 'api');

            foreach ($extra as $name => $value) {
                $entry = $entry->property($name, $value);
            }

            if ($key->user !== null) {
                $entry = $entry->actor($key->user);
            }

            $entry->log();
        } catch (Throwable $exception) {
            /*
             * Reported, not swallowed, and the write still stands.
             *
             * A reply that reached a customer and was not written down is a
             * gap in the record; a reply refused because the record could not
             * be written is a customer who was not answered. The first is
             * worse to discover and the second is worse to live through.
             */
            report($exception);
        }
    }

    /* ------------------------------------------------- the whole panel ---- */

    /** Every machine, and what it is using. Support\NodeHealth's reading. */
    public function nodes(Request $request): JsonResponse
    {
        return $this->answer($request, Key::PANEL, static function (): array {
            $rows = [];

            // every() rather than nodes(), which stops at the twelve the
            // dashboard draws - and this endpoint says every machine.
            foreach (NodeHealth::every(true) as $node) {
                $rows[] = self::nodeRow($node);
            }

            /*
             * How many there really are, which this was not saying.
             *
             * every() stops at NodeHealth::MOST, and a list that stops without
             * saying so is the fault the *_total fields exist to remove -
             * these two were the ones that pass got wrong. A panel with more
             * nodes than the ceiling was answered with the ceiling and no
             * reason to doubt it.
             */
            return ['nodes_total' => NodeHealth::count(), 'nodes' => $rows];
        });
    }

    /**
     * One node, named field by field rather than handed over.
     *
     * NodeHealth::read() was written for a card on the dashboard, and this
     * endpoint was returning it whole - so what a card happens to carry was the
     * published contract, and reshaping the card would have been a v2. It also
     * meant the documentation described a shape nobody served: nested memory
     * and disk objects, against the flat keys actually on the wire.
     *
     * The names are the ones already going out, deliberately. Correcting the
     * documentation to the wire breaks nobody; correcting the wire to the
     * documentation would break whoever read it off a real answer.
     *
     * Units, because a number with no unit is a number somebody will guess at:
     * memory and disk are bytes, cpu is a percentage of the whole machine, and
     * load is the one-minute average as a single figure. The documentation
     * described three of them and published an array, which is /system's
     * shape copied onto a node: a receiver written off that example read
     * load[0] and got nothing on every node this has ever answered with.
     *
     * @param  array<string, mixed>  $node
     * @return array<string, mixed>
     */
    private static function nodeRow(array $node): array
    {
        return [
            'id' => (int) ($node['id'] ?? 0),
            'name' => (string) ($node['name'] ?? ''),
            'maintenance' => (bool) ($node['maintenance'] ?? false),
            'reachable' => (bool) ($node['reachable'] ?? false),
            'cpu' => $node['cpu'] ?? null,
            'memory_used' => (int) ($node['memory_used'] ?? 0),
            'memory_total' => (int) ($node['memory_total'] ?? 0),
            'disk_used' => (int) ($node['disk_used'] ?? 0),
            'disk_total' => (int) ($node['disk_total'] ?? 0),
            'load' => $node['load'] ?? null,

            // Empty where the node did not say, rather than absent: a field
            // that comes and goes is a field every caller has to test for.
            'version' => trim((string) ($node['version'] ?? '')),
        ];
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
        return $this->answer($request, Key::PANEL, static function (): array {
            $all = SystemStatus::all();
            $facts = is_array($all['system'] ?? null) ? $all['system'] : [];
            $version = is_array($all['version'] ?? null) ? $all['version'] : [];

            /*
             * Named one at a time, for the reason nodeRow() gives: this was
             * SystemStatus::all() handed over whole, so a page's shape was the
             * published contract - and the documentation described three of its
             * eight fields.
             *
             * The keys inside `host` are the ones that used to come and go:
             * facts() only adds cores and processes where it could read them,
             * so a caller had to test for two fields that are present on most
             * panels and absent on some. Always there, null where unknown.
             *
             * Units: memory and swap in bytes, uptime in seconds, cpu a
             * percentage of the whole machine.
             */
            return [
                'system' => [
                    'cpu' => $all['cpu'] ?? null,
                    'memory' => $all['memory'] ?? null,
                    'swap' => $all['swap'] ?? null,
                    'disk' => is_array($all['disk'] ?? null) ? $all['disk'] : [],
                    'load' => $all['load'] ?? null,
                    'uptime' => $all['uptime'] ?? null,
                    'host' => [
                        'os' => self::said($facts['os'] ?? null),
                        'hostname' => self::said($facts['hostname'] ?? null),
                        'php' => self::said($facts['php'] ?? null),
                        'cores' => isset($facts['cores']) ? (int) $facts['cores'] : null,
                        'processes' => isset($facts['processes']) ? (int) $facts['processes'] : null,
                    ],
                    'panel' => [
                        'installed' => self::said($version['installed'] ?? null),
                        'latest' => self::said($version['latest'] ?? null),
                        'current' => $version['current'] ?? null,
                    ],
                ],
            ];
        });
    }

    /**
     * A list with its real length beside it, cut to what one answer carries.
     *
     * Written once because four endpoints need it and a fifth will. The total
     * comes first in the body so a caller reading the top of a truncated answer
     * sees the number before the rows.
     *
     * @param  array<int, mixed>  $rows
     * @return array<string, mixed>
     */
    private static function capped(string $name, array $rows): array
    {
        return [
            $name . '_total' => count($rows),
            $name => array_slice($rows, 0, self::MOST_ROWS),
        ];
    }

    /** A string that was read, or null where nothing was. */
    private static function said(mixed $value): ?string
    {
        $text = is_scalar($value) ? trim((string) $value) : '';

        return $text === '' || $text === '?' ? null : $text;
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
            // Counted whole and then cut: the scan is over active schedules
            // and the troubled ones are a handful of them on a working panel,
            // so the number is cheap and the truncation is the surprise.
            ...self::capped('schedules', Schedules::troubled()),
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
            $total = 0;

            foreach (Backups::forUser($key->user)->get() as $server) {
                /** @var Server $server */
                $total++;

                if (count($rows) >= self::MOST_ROWS) {
                    continue;
                }

                $rows[] = [
                    'uuid' => (string) $server->uuid,
                    'name' => (string) $server->name,
                    'last_backup_at' => self::moment($server->ld_last),
                    'backups' => (int) ($server->ld_kept ?? 0),
                ];
            }

            // How many they have, beside however many fit.
            return ['servers_total' => $total, 'servers' => $rows];
        });
    }

    /** The same list, narrowed to what is behind. */
    public function myBackups(Request $request): JsonResponse
    {
        return $this->answer($request, Key::PERSON, static fn (Key $key): array => self::backupRows(Backups::forUser($key->user)));
    }

    /**
     * How full every node is, and whether another server fits.
     *
     * The one question in roadmap/api.md's list that neither Pelican API can
     * answer and this one did not either. /nodes says what a machine is using
     * right now, read off the daemon; this says what it is allowed to hand out,
     * which is a different number and the one that decides whether a sale can
     * be delivered. A node at forty percent of its memory can still be full,
     * because what is sold is not what is running.
     *
     * Through Capacity::all() rather than Capacity::query(), which scopes to
     * whoever is looking - see the note on it, and the gate that reads it.
     */
    public function capacity(Request $request): JsonResponse
    {
        return $this->answer($request, Key::PANEL, static fn (): array => [
            'tight_at_percent' => Capacity::TIGHT,
            // Capacity::all() stops at Capacity::MOST, for the same reason and
            // with the same silence as /nodes above.
            'nodes_total' => NodeHealth::count(),
            'nodes' => Capacity::all(),
        ]);
    }

    /**
     * How the shop is doing, in the ten figures its own overview reads.
     *
     * Its own ability rather than `panel`, and that is the whole reason it is
     * a separate one: a bot that reports a node going down has no business
     * reading what the month took. The two are both "the panel" and only one of
     * them is money.
     *
     * Empty of figures rather than absent when the shop is switched off, so a
     * bot written against a panel that sells things does not have to tell a 404
     * from a network fault.
     */
    public function shop(Request $request): JsonResponse
    {
        return $this->answer($request, Key::PANEL, static function (): array {
            if (!Features::enabled(Features::SHOP) || !ShopTables::ready()) {
                return ['selling' => false, 'shop' => null];
            }

            $all = Takings::all();

            /*
             * Named one at a time rather than handed over whole.
             *
             * Takings::all() carries two things a page draws and an answer must
             * not: `soon` is a collection of Invoice models with their users
             * loaded, and handing that to json would put every column of both
             * on the wire - somebody's address and email among them, to a key
             * that asked how the month was going. `low` is already shaped, and
             * is the only one of the two worth a bot's attention anyway.
             *
             * So this reads the figures by name. A figure added to the page
             * later does not silently appear here, which is the right way round
             * for something published.
             */
            return [
                'selling' => true,
                'shop' => [
                    'currency' => (string) ($all['currency'] ?? ''),
                    'month' => (int) ($all['month'] ?? 0),
                    'previous' => (int) ($all['previous'] ?? 0),
                    'outstanding' => (int) ($all['outstanding'] ?? 0),
                    'overdue' => (int) ($all['overdue'] ?? 0),
                    'recurring' => (int) ($all['recurring'] ?? 0),
                    'services' => (int) ($all['services'] ?? 0),
                    'ending' => (int) ($all['ending'] ?? 0),
                    'pending' => (int) ($all['pending'] ?? 0),

                    // How many bills fall due inside the next few days, and not
                    // which: a list of who owes what is a different question
                    // with a different answer to the one about who may ask it.
                    // Counted on its own, because the page's list stops at eight.
                    'due_soon' => Takings::dueSoonCount(),

                    // Packages with three or fewer places left, which is the
                    // one thing on that page a bot can act on.
                    'low_stock' => is_array($all['low'] ?? null) ? $all['low'] : [],
                ],
            ];
        });
    }

    /**
     * What this key's owner is paying for, and when each of them renews.
     *
     * The question a hosting Discord is asked more than any other, and the one
     * the panel already answers on the customer's own services page. Their
     * orders and nobody else's: read through the key's owner rather than
     * through user(), which is null on a request carrying a key.
     */
    public function myServices(Request $request): JsonResponse
    {
        return $this->answer($request, Key::PERSON, static fn (Key $key): array => self::serviceRows($key->user));
    }

    /**
     * A moment as this API states every moment: ISO-8601, with an offset.
     *
     * `last_backup_at` was the one that left without one, because it is not a
     * cast attribute - it comes off a withMax() sub-select as whatever string
     * the database printed. A caller then has two formats in one body, and
     * `new Date('2026-09-05 03:00:00')` is invalid in Safari and local time in
     * Node: the same backup reads as a different hour depending on where the
     * bot runs, which is how a fresh backup gets reported as stale.
     *
     * Caught rather than trusted, for the same reason Backups::stale() wraps
     * the same parse: the value is unvalidated, and an endpoint that throws
     * where a page degrades is the worse of the two.
     */
    private static function moment(mixed $raw): ?string
    {
        /*
         * A date object first, and this was missing.
         *
         * The first version tested is_scalar() and nothing else, which is true
         * of the raw string a sub-select hands back and false of every Carbon
         * an Eloquent cast hands back - so a column read through a model went
         * out as null while a column read through a query went out correctly.
         * Both were called the same thing in the same answer.
         *
         * It survived a field-by-field sweep because that compares the names
         * in an answer against the names in the published example, and null is
         * a name being present. Nothing checked that a timestamp was a time.
         */
        if ($raw instanceof DateTimeInterface) {
            try {
                return CarbonImmutable::instance($raw)->toIso8601String();
            } catch (Throwable) {
                return null;
            }
        }

        $text = is_scalar($raw) ? trim((string) $raw) : '';

        if ($text === '') {
            return null;
        }

        try {
            return CarbonImmutable::parse($text)->toIso8601String();
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * What one person pays for, whoever is asking on their behalf.
     *
     * Written once because it is answered twice: for the owner of a personal
     * key, and for the panel account behind a Discord id. Those are two ways of
     * naming the same person and they must not drift into two answers, which is
     * the fault this codebase has now fixed often enough to write the helper
     * first.
     *
     * @return array{selling: bool, services: array<int, array<string, mixed>>}
     */
    private static function serviceRows(?User $person): array
    {
        if (!Features::enabled(Features::SHOP) || !ShopTables::ready()) {
            return ['selling' => false, 'services_total' => 0, 'services' => []];
        }

        if ($person === null) {
            return ['selling' => true, 'services_total' => 0, 'services' => []];
        }

        try {
            $query = Order::query()
                ->where('user_id', (int) $person->id)
                ->whereIn('state', Order::OCCUPYING);

            // Counted before the ceiling is applied, so a customer with more
            // services than fit is told so rather than shown a short list.
            $total = (clone $query)->count();

            $orders = $query
                ->with(['server'])
                ->orderBy('id')
                ->limit(self::MOST_SERVICES)
                ->get();
        } catch (Throwable) {
            return ['selling' => true, 'services_total' => 0, 'services' => []];
        }

        $rows = [];

        foreach ($orders as $order) {
            $spec = is_array($order->spec) ? $order->spec : [];

            $rows[] = [
                'id' => (int) $order->id,
                'package' => trim((string) ($spec['name'] ?? '')),
                'state' => (string) $order->state,
                'server' => $order->server === null ? null : [
                    'uuid' => (string) $order->server->uuid,
                    'name' => (string) $order->server->name,
                ],
                'price' => (int) $order->price,
                'currency' => (string) $order->currency,
                'period' => (string) $order->period,
                'next_due_at' => $order->next_due_at?->toIso8601String(),
                'ends_at' => $order->ends_at?->toIso8601String(),
            ];
        }

        return ['selling' => true, 'services_total' => $total, 'services' => $rows];
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

            /*
             * One shape on all three branches, which it was not.
             *
             * Minecraft answered with online, max and a list; A2S answered with
             * online and a list and no max; a server that said nothing answered
             * with neither number. Three shapes from one address means a caller
             * writes three parsers, or one that guesses.
             *
             * Null is still not an empty server, and that is why every number
             * here starts as null rather than nought: a server that did not
             * answer, or whose game answers no query at all, must not read as a
             * quiet evening.
             */
            $blank = [
                'server' => ['uuid' => (string) $found->uuid, 'name' => (string) $found->name],
                'source' => null,
                'max_age_seconds' => 20,
                'online' => null,
                'max' => null,
                'players' => null,
            ];

            $live = Minecraft::detect($found) ? Ping::status($found) : null;

            if ($live !== null) {
                return array_merge($blank, [
                    'source' => 'minecraft',
                    'online' => (int) ($live['online'] ?? 0),
                    'max' => (int) ($live['max'] ?? 0),

                    /*
                     * Padded to the shape the A2S branch uses, so one row reads
                     * the same whichever game answered. A Minecraft sample
                     * carries no score and no time played, and says so with
                     * null rather than by the key being absent.
                     */
                    'players' => array_map(
                        static fn (string $name): array => [
                            'name' => $name,
                            'score' => null,
                            'minutes' => null,
                        ],
                        $live['names'] ?? [],
                    ),
                ]);
            }

            $rows = Games::speaks($found) ? A2S::players($found) : null;

            if ($rows === null) {
                return $blank;
            }

            /*
             * The declared count rather than the length of the list.
             *
             * `online` used to be count($rows) here and the server's own figure
             * on the branch above - two quantities under one name, which is
             * worse than a missing one because nothing looks wrong. A2S says
             * itself that some games answer the player query with fewer rows
             * than they are running, so the list is a sample and the number is
             * the number.
             *
             * status() is cached on the address for twenty seconds exactly like
             * players(), so asking both is one round trip rather than two.
             */
            $said = A2S::status($found);

            return array_merge($blank, [
                'source' => 'a2s',
                'online' => $said === null ? count($rows) : (int) ($said['online'] ?? count($rows)),
                'max' => $said === null ? null : (int) ($said['max'] ?? 0),
                'players' => $rows,
            ]);
        });
    }

    /**
     * Whether a server is running, right now.
     *
     * A second reader of something Pelican already worked out: it caches both
     * `retrieveStatus()` and `retrieveResources()` for fifteen seconds on the
     * server uuid, for its own cards. So a hundred bots asking at once is one
     * question to the daemon, and asking on a timer costs the panel nothing it
     * was not already spending.
     *
     * One server a call, deliberately. Putting live state on /me/servers would
     * mean a daemon call per server on a cold cache - forty of them for
     * somebody with forty servers, before anything came back. That is the same
     * trap the players endpoint was held back for.
     */
    public function status(Request $request, string $server): JsonResponse
    {
        return $this->answer($request, Key::PERSON, function (Key $key) use ($server): array {
            $found = $this->serverFor($key, $server);

            if ($found === null) {
                abort(404);
            }

            $state = null;
            $resources = [];

            try {
                $state = $found->retrieveStatus()->value;
                $resources = $found->retrieveResources();
            } catch (Throwable) {
                /*
                 * A node that cannot be reached, or one in maintenance. State
                 * stays null rather than becoming "offline": a server nobody
                 * could ask about is not a server that is off, and a bot told
                 * the second would announce an outage that is not happening.
                 */
            }

            return [
                'server' => ['uuid' => (string) $found->uuid, 'name' => (string) $found->name],
                'max_age_seconds' => 15,
                'state' => $state,
                'resources' => [
                    'memory_bytes' => $resources['memory_bytes'] ?? null,
                    'cpu_absolute' => $resources['cpu_absolute'] ?? null,
                    'disk_bytes' => $resources['disk_bytes'] ?? null,
                    'uptime' => $resources['uptime'] ?? null,
                ],
            ];
        });
    }

    /* --------------------------------------------------- the connection --- */

    /**
     * Which servers a Discord account may reach, and what it may do to them.
     *
     * **The question a bot cannot answer any other way.** Somebody types
     * `/start survival` and the bot has to know two things before it does
     * anything: is that server theirs, and are they allowed to start it. The
     * second is not the same as the first - a subuser can often see a server
     * and not power it.
     *
     * Both answers come from Pelican rather than from a rule of ours.
     * accessibleServers() decides which servers, and `can()` with a
     * SubuserPermission decides each verb - the same call the panel makes
     * before drawing a power button. So this can never say yes to something
     * Pelican would refuse.
     *
     * No live state here, and that is the same restraint as everywhere else:
     * state costs a daemon call per server. Ask /servers/{server}/status for
     * the one that matters.
     */
    public function connectionServers(Request $request, string $discord): JsonResponse
    {
        return $this->answer($request, Key::PANEL, static function () use ($discord): array {
            $row = Connections::forDiscord($discord);
            $person = $row?->user;

            if ($person === null) {
                return ['connected' => false, 'servers' => []];
            }

            $servers = [];
            $total = 0;

            foreach (Backups::forUser($person)->get() as $server) {
                /** @var Server $server */
                $total++;

                /*
                 * The ceiling matters more here than anywhere else: every row
                 * below asks Pelican four permission questions, so an
                 * administrator's key on a panel with nine hundred servers was
                 * three thousand six hundred of them in one request.
                 */
                if (count($servers) >= self::MOST_ROWS) {
                    continue;
                }

                $servers[] = [
                    'uuid' => (string) $server->uuid,
                    'name' => (string) $server->name,
                    'owner' => (int) $server->owner_id === (int) $person->id,
                    'may' => [
                        'start' => $person->can(SubuserPermission::ControlStart, $server),
                        'stop' => $person->can(SubuserPermission::ControlStop, $server),
                        'restart' => $person->can(SubuserPermission::ControlRestart, $server),
                        'console' => $person->can(SubuserPermission::ControlConsole, $server),
                    ],
                ];
            }

            return [
                'connected' => true,
                'username' => (string) $person->username,
                'servers_total' => $total,
                'servers' => $servers,
            ];
        });
    }



    /*
     * Three endpoints for the bot, all of them needing a panel-wide key.
     *
     * A personal key must not reach these: it would let whoever holds one bind
     * arbitrary Discord accounts and read who else is connected. The bot is one
     * thing, run by whoever runs the panel, and it gets one key from an
     * administrator.
     */

    /**
     * What the person behind a Discord id pays for.
     *
     * **The question a Discord module cannot ask any other way.** Everything
     * under /me answers for the owner of the key, and a bot's key is owned by
     * whoever runs the panel - so a module that knows a Discord id and nothing
     * else could read that person's servers and not one thing about their
     * services. "When does mine renew" is what a hosting Discord is asked more
     * than any other question, and the answer was reachable only by minting a
     * personal key for every customer.
     *
     * Under the shop ability rather than connect, because this is money about a
     * person and the shop group exists for exactly that line: a bot that ties
     * Discord accounts to panel accounts has no business reading what anybody
     * pays unless somebody granted it that as well. It needs both, and a key
     * holding one and not the other is told which is missing.
     */
    public function connectionServices(Request $request, string $discord): JsonResponse
    {
        return $this->answer($request, Key::PANEL, static function () use ($discord): array {
            $person = Connections::forDiscord($discord)?->user;

            if ($person === null) {
                return ['connected' => false, 'selling' => false, 'services_total' => 0, 'services' => []];
            }

            return ['connected' => true] + self::serviceRows($person);
        });
    }

    /**
     * Which of that person's servers have no backup, and which have gone stale.
     *
     * The same two lists as /me/backups, for the person behind a Discord id
     * rather than for the key's owner. A bot telling somebody their server has
     * not been backed up in three weeks is the most useful thing this API can
     * do that nobody else can, and it could only say it about the account the
     * key belonged to.
     *
     * Through Backups::forUser(), which is the page's own scope with the reader
     * handed in rather than assumed - the same method /me/backups uses, so the
     * two cannot disagree about what behind means.
     */
    public function connectionBackups(Request $request, string $discord): JsonResponse
    {
        return $this->answer($request, Key::PANEL, static function () use ($discord): array {
            $person = Connections::forDiscord($discord)?->user;

            if ($person === null) {
                return [
                    'connected' => false,
                    'never_total' => 0,
                    'stale_total' => 0,
                    // Said on both branches, because a caller reading it should
                    // not have to test whether the id was connected first.
                    'stale_after_days' => Backups::days(),
                    'never' => [],
                    'stale' => [],
                ];
            }

            return ['connected' => true] + self::backupRows(Backups::forUser($person));
        });
    }

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
        $pattern = $this->pattern($request);

        /*
         * HEAD is a GET that stops before the body, and it has to be checked
         * like one.
         *
         * Route::get registers GET and HEAD together - Laravel does that for
         * every read here - while every entry in Docs::endpoints() says GET. So
         * abilityFor('HEAD', ...) found nothing, returned an empty string, and
         * the guard below read an empty ability as "this endpoint is not
         * behind one" and let it through. A key told in as many words that it
         * may not read the shop answered 403 to GET /shop and 200 to HEAD /shop
         * on a live panel, which is how this was found rather than argued.
         *
         * No figure leaves in either case, because HTTP drops the body of a
         * HEAD. What did leave is the answer to "does this exist and would it
         * have worked", from a key that was refused - and an access check that
         * one verb walks past is a check that has to be read twice by everybody
         * who comes after.
         *
         * Folded here rather than answered with 405, because polling a URL with
         * HEAD is the right way to poll one: this plugin's own uptime monitors
         * do exactly that, and work around the hosts that refuse it.
         */
        $ability = Docs::abilityFor($request->isMethod('HEAD') ? 'GET' : $request->method(), $pattern);

        $key = Keys::verify($this->presented($request));

        if ($key === null || !$this->addressAllowed($key, $request)) {
            return response()->json(['error' => 'unauthorized'], 401);
        }

        /*
         * An address that names no ability answers nobody.
         *
         * Every route is listed in Docs::endpoints() with one, and a route that
         * is not - registered in the provider and forgotten in the list - used
         * to skip the check below entirely and answer any key of the right
         * scope. Closed is the safe way for that mistake to fail: it shows up
         * the first time somebody calls it, instead of never.
         */
        if ($ability === '') {
            return response()->json(['error' => 'forbidden'], 403);
        }

        /*
         * What this key was granted, before what its scope allows.
         *
         * A scope says how far a key can see; an ability says which questions
         * it may ask within that. They are checked in this order because the
         * narrower answer is the more useful one: "you were not given this"
         * tells somebody to ask for it, where "wrong scope" sends them to ask
         * for a wider key they may not need.
         */
        if (!$key->may($ability)) {
            return response()->json(['error' => 'forbidden', 'ability' => $ability], 403);
        }

        /*
         * And whether the panel does this at all.
         *
         * After the key and before the scope, because the order is the answer
         * somebody can act on: an unknown key is 404-shaped, a key that was not
         * granted this is "ask for it", and a part that is switched off is
         * neither of those - it is the panel saying it does not do that, and no
         * key of any width will change it.
         *
         * 404 rather than 403 for the same reason the pages do it: a part that
         * is off does not exist here, and saying "forbidden" invites somebody
         * to go looking for the permission that would fix it.
         */
        $part = self::PARTS[$pattern] ?? null;

        if ($part !== null && !Features::enabled($part)) {
            /*
             * Which part, because the documentation said it was named here and
             * it was not.
             *
             * Two different 404s leave this class - this one, and a server the
             * key's owner cannot open - and both sent exactly {"error":
             * "not_found"}. The published errors list told a bot author the
             * body would tell them apart, so a receiver written against the
             * documentation branched on a field that was never sent. The 403
             * pair beside this has said which of the two it is since it was
             * built; this is that, late.
             *
             * Additive: a field nobody was reading cannot break anybody, and it
             * turns "the panel said no and I cannot tell you why" into "the
             * capacity page is switched off".
             */
            return response()->json(['error' => 'not_found', 'part' => self::NAMED[$pattern] ?? $part], 404);
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

        $limit = Keys::rate($key);
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
        } catch (NotFoundHttpException) {
            /*
             * An endpoint saying "not this one", not the panel falling over.
             *
             * Two endpoints abort(404) for a server the key's owner cannot
             * open, and that landed here as a Throwable like any other - so the
             * documented 404 went out as a 503 unavailable. The difference is
             * not cosmetic: 503 tells a well-behaved client to back off and try
             * again, for a request that can never succeed, and 404 tells it to
             * stop asking.
             *
             * Caught by its own name rather than by HttpExceptionInterface, so
             * the set of statuses this API can emit stays exactly the set
             * Docs::errors() documents.
             */
            return response()->json(['error' => 'not_found'], 404);
        } catch (ConflictHttpException) {
            /*
             * One idempotency key, two different requests - or a write that
             * cannot be done as it was asked: a reply with nothing in it, or a
             * reply to a ticket that is closed.
             *
             * Caught by its own name beside the 404 above and for the same
             * reason: a Throwable here would have gone out as a 503, which
             * tells a well-behaved client to back off and try again - and
             * trying again is exactly the thing that cannot help, because the
             * request will conflict every time until the caller changes the
             * token, the body or the ticket.
             */
            return response()->json(['error' => 'conflict'], 409);
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
        return response()->json(array_merge([
            'as_of' => now()->toIso8601String(),
            /*
             * What is left of this minute, on every answer rather than only in
             * the 429 that ends it.
             *
             * The rate-limiting note has told bot authors this was here for
             * several releases. It was not: /health built it into its own body
             * and nothing else carried it, so a module that paced itself on
             * `rate.remaining` read undefined everywhere except the endpoint it
             * called once at startup. Cheaper to make the sentence true than to
             * withdraw it, and additive either way.
             *
             * Merged under $body rather than over it, so an endpoint that wants
             * to say something else about the allowance still can.
             */
            'rate' => ['limit' => $limit, 'remaining' => $left],
        ], $body));
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

            $row = [
                'uuid' => (string) $server->uuid,
                'name' => (string) $server->name,
                // Through moment(), while the test below keeps reading the raw
                // string: Backups::stale() parses it itself and is the panel's
                // own answer to what behind means.
                'last_backup_at' => self::moment($last),
            ];

            if ($last === null) {
                $none[] = $row;

                continue;
            }

            if (Backups::stale($last) === true) {
                $stale[] = $row;
            }
        }

        return [
            // How many there really are, beside however many fit. The partition
            // above already walked all of them, so this costs nothing.
            'never_total' => count($none),
            'stale_total' => count($stale),
            'stale_after_days' => Backups::days(),
            'never' => array_slice($none, 0, self::MOST_ROWS),
            'stale' => array_slice($stale, 0, self::MOST_ROWS),
        ];
    }

    /**
     * The documented path this request matched, rather than the one it typed.
     *
     * `/servers/a1b2/players` has to become `/servers/{server}/players` before
     * it can be looked up in the documentation - and taking it from the route's
     * own URI rather than from the address means a bot cannot choose which
     * ability it is checked against by how it spells a uuid.
     */
    private function pattern(Request $request): string
    {
        $uri = '/' . ltrim((string) ($request->route()?->uri() ?? ''), '/');
        $base = '/api/essentials/' . self::CONTRACT;

        return str_starts_with($uri, $base) ? substr($uri, strlen($base)) : $uri;
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
     * one, it is exact - still no ranges, because a half-understood CIDR
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
        /*
         * Nought is no ceiling, and it was the tightest ceiling there is.
         *
         * Keys::rate() answers 0 for a key somebody deliberately set to
         * unlimited - the setting says so in as many words, and calls it a real
         * way to be sorry if the key gets out. It was then handed to
         * RateLimiter::tooManyAttempts($bucket, 0), which compares attempts
         * against nought: the first request of each minute found the counter
         * reset and went through, and every one after it was refused. A key
         * asking for no limit got one request a minute, which is the opposite
         * of the two things it could have meant.
         *
         * Counted not at all rather than counted generously, because a bucket
         * nobody reads is a write per request for nothing.
         */
        if ($limit <= 0) {
            return 0;
        }

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
