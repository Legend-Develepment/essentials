<?php

namespace LegendDevelopment\Theme\Support\Tickets\Desks;

use GuzzleHttp\TransferStats;
use Illuminate\Support\Facades\Http;
use LegendDevelopment\Theme\Models\Ticket;
use LegendDevelopment\Theme\Models\TicketMessage;
use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Support\Tickets\Desk;
use LegendDevelopment\Theme\Support\Tickets\Files;
use RuntimeException;
use Throwable;

/**
 * Tickets answered in Discord, through Modora.
 *
 * The customer asks from inside the panel, beside the server they are asking
 * about, and whoever answers does it where they already are. That is the whole
 * point of this desk: it is not a second place to look, it is the same
 * conversation reachable from both ends.
 *
 * **Guests, and why every ticket opened here is one.** Modora will open a
 * ticket on behalf of a Discord account if you name one, and this panel does
 * not know anybody's. So a ticket is opened without a `discord_user_id`, which
 * makes it a guest ticket and hands back a claim link. The customer follows
 * that link once to tie it to their Discord account; until they do, they read
 * and reply from the panel and staff answer in the channel. Both halves work
 * either way, which is why the link is offered rather than insisted on.
 *
 * **Nothing here decides anything.** The ticket and every message are already
 * in this panel's tables before this class is asked - see Board. A refusal from
 * Modora leaves a row saying "not passed on yet" and a button to try again; it
 * never loses what somebody typed.
 *
 * **Told and asked, both.** Modora fires events at an address this panel makes -
 * see Hook - and that is how an answer appears while somebody is still reading
 * the page. Underneath it, reading the message list when a ticket is opened and
 * on a timer for the ones still open. Neither on its own is enough: a webhook
 * needs a panel Modora can reach from outside and many of these do not have
 * one, and a poll alone means a customer waits a quarter of an hour to see a
 * reply that was typed a minute ago.
 *
 * The two crossing each other is harmless by design rather than by timing: the
 * unique index on (ticket, remote id) is what makes the same message arriving
 * twice one row.
 */
class Modora implements Desk
{
    public const KEY = 'modora';

    /**
     * Why the last call failed, in Modora's own words.
     *
     * Kept because "the reason is in the log" is a poor answer when the reason
     * arrived in the body: it sends somebody to a terminal to read a sentence
     * that could have been on their screen. Static rather than on the instance
     * because a desk is made fresh at every call site - see Desks::current().
     */
    private static string $problem = '';

    /** What went wrong last, or an empty string. */
    public static function problem(): string
    {
        return self::$problem;
    }

    private const API = 'https://modora.gg/api/tickets/v1';

    private const TIMEOUT = 15;

    /** How many messages a single pull will take in. */
    private const PAGE = 200;

    /**
     * This plugin's three levels, in Modora's four-step vocabulary.
     *
     * Their words are low, medium, high and urgent - found by offering the API
     * an invalid one and reading which of the others it accepted, because the
     * documentation does not list them. Ours stops at three, so the top of ours
     * is their `high`: promoting every high-priority question to urgent would
     * make that word mean nothing by the end of the week.
     */
    /**
     * Author types that mean the person who asked, rather than somebody
     * answering.
     *
     * Everything else is read as an answer, including a type this release has
     * never heard of - which is the safer way round: the far end is where staff
     * are, and mislabelling an answer as a question is the mistake that shows.
     */
    private const THEIRS = ['customer', 'guest', 'opener', 'requester'];

    private const URGENCY = [
        Ticket::LOW => 'low',
        Ticket::NORMAL => 'medium',
        Ticket::HIGH => 'high',
    ];

    public function key(): string
    {
        return self::KEY;
    }

    public function enabled(): bool
    {
        return $this->token() !== '';
    }

    /**
     * Modora's own ping: it authenticates, creates nothing, and answers with
     * the scopes the key carries.
     *
     * The scopes are checked here rather than discovered later, because a key
     * missing `messages.write` fails in exactly the place where somebody has
     * just typed a reply - and a sentence on the settings page is a much better
     * moment to find out than that one.
     */
    public function check(): ?string
    {
        $token = $this->token();

        if ($token === '') {
            return Theme::trans('tickets.check_no_key');
        }

        /*
         * Which address this request actually went out from.
         *
         * Filled in by curl through Guzzle's stats hook rather than guessed at,
         * and that is the whole reason it is here. This check used to report a
         * refusal by naming SERVER_ADDR - the address the web server is bound
         * to - which on a machine with both an IPv4 and an IPv6 address is the
         * wrong one: the connection leaves over IPv6 by default, Modora sees
         * that, and somebody is told to allow a number that was already
         * allowed. Asking the connection is the only answer that cannot be
         * wrong.
         */
        $from = null;

        try {
            $response = Http::withToken($token)
                ->timeout(self::TIMEOUT)
                ->acceptJson()
                ->withOptions(['on_stats' => static function (TransferStats $stats) use (&$from): void {
                    $from = (string) ($stats->getHandlerStats()['local_ip'] ?? '');
                }])
                ->get(self::API . '/ping');
        } catch (Throwable $exception) {
            return $exception->getMessage();
        }

        /*
         * What they said, rather than what a status code is usually about.
         *
         * A 403 was reported here as "the key is wrong or revoked", which sent
         * somebody to check a key that was perfectly good: the real answer was
         * `ip_not_allowed`, a restriction on the key that has nothing to do
         * with the key itself. Modora's own body names the fault and explains
         * it in a sentence, and passing that through is both shorter and more
         * honest than a table of guesses about status codes.
         */
        if (!$response->successful()) {
            return $this->refusal($response->json(), $response->status(), $from);
        }

        $has = array_map(
            static fn (mixed $scope): string => (string) $scope,
            (array) ($response->json('scopes') ?? []),
        );

        /*
         * The five this plugin actually uses. panels.read is not among them:
         * nothing here lists panels, and asking for a scope that is never
         * exercised is asking somebody to hand over more than is needed.
         */
        $wants = ['tickets.create', 'tickets.read', 'tickets.close', 'messages.read', 'messages.write'];
        $short = array_values(array_diff($wants, $has));

        if ($short !== [] && $has !== []) {
            return Theme::trans('tickets.check_scopes', ['scopes' => implode(', ', $short)]);
        }

        return null;
    }

    /**
     * Open it, as a guest ticket, and keep both the id and the claim link.
     *
     * The subject goes as the ticket's own, and the first message is sent
     * separately by Board - so a ticket that opened but whose first message did
     * not is a ticket with a heading and a retry, rather than nothing.
     */
    public function open(Ticket $ticket): bool
    {
        $token = $this->token();

        if ($token === '' || $ticket->pushed()) {
            return $ticket->pushed();
        }

        $body = [
            'subject' => mb_substr((string) $ticket->subject, 0, 191),

            /*
             * How urgent, in their words.
             *
             * Their scale has four steps and this plugin's has three, so the
             * top of ours maps to their `high` rather than to `urgent`: a
             * customer choosing the highest of three options has not asked for
             * the highest of four, and quietly promoting every one of them
             * would make the word mean nothing by the end of the week.
             */
            'priority' => self::URGENCY[(string) $ticket->priority] ?? 'medium',

            /*
             * And which ticket this is here, so the two sides can be lined up
             * from either end. An unknown field is ignored by them rather than
             * refused, which is what makes it safe to send.
             */
            'external_reference' => (string) $ticket->id,
        ];

        /*
         * A number, and left out entirely when it is not one.
         *
         * It comes off a text field and went across as a string, which Modora
         * refuses with "The panel id field must be an integer" - a 422 on every
         * ticket, for a field that is optional in the first place. Sending a
         * typo would guarantee the same refusal, so anything that is not a
         * number is simply not sent and Modora picks the panel itself.
         */
        $panel = trim((string) Theme::config('tickets_modora_panel', ''));

        if ($panel !== '' && ctype_digit($panel)) {
            $body['panel_id'] = (int) $panel;
        }

        try {
            $response = Http::withToken($token)
                ->timeout(self::TIMEOUT)
                ->acceptJson()
                ->asJson()
                ->post(self::API . '/tickets', $body);
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }

        if (!$response->successful()) {
            self::$problem = $this->refusal($response->json(), $response->status());

            report(new RuntimeException(
                'Modora refused a ticket: HTTP ' . $response->status() . ' ' . $response->body(),
            ));

            return false;
        }

        $id = $this->ticketId($response->json());

        if ($id === '') {
            return false;
        }

        $said = $this->inside($response->json());

        try {
            $ticket->forceFill([
                'remote' => $id,

                /*
                 * Their number, so both sides can say the same one.
                 *
                 * This was missed the first time round and the effect was two
                 * people unable to help each other: a customer reading #3 in
                 * the panel and staff reading #17 on the channel.
                 */
                'remote_number' => $this->text($said['ticket_number'] ?? null),

                /*
                 * Where the customer ties it to their Discord account.
                 *
                 * Read out of `data`, which is where it is - the first version
                 * read it off the top of the body and always found nothing, so
                 * no ticket ever had a claim link. Offered rather than
                 * required: the panel half works without it.
                 */
                'claim_url' => $this->text($said['claim_url'] ?? null),
            ])->save();
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }

        return true;
    }

    public function say(Ticket $ticket, TicketMessage $message): bool
    {
        $token = $this->token();

        if ($token === '' || !$ticket->pushed() || $message->pushed()) {
            return false;
        }

        try {
            $response = Http::withToken($token)
                ->timeout(self::TIMEOUT)
                ->acceptJson()
                ->asJson()
                ->post(self::API . '/tickets/' . rawurlencode((string) $ticket->remote) . '/messages', [
                    // Who said it, in the message rather than as an author
                    // field: this integration posts as itself, so a channel
                    // that did not say whose question it is would be a channel
                    // full of anonymous questions.
                    'content' => $this->wrote($ticket, $message),
                ]);
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }

        if (!$response->successful()) {
            self::$problem = $this->refusal($response->json(), $response->status());

            report(new RuntimeException(
                'Modora refused a message on ticket ' . $ticket->remote . ': HTTP ' . $response->status(),
            ));

            return false;
        }

        try {
            $message->forceFill([
                /*
                 * Null rather than an empty string when no id could be read.
                 *
                 * The column is asked about both ways - pushed() compares the
                 * text, the catch-up query asks whereNull - and an empty string
                 * answers those two differently. Null is the one value that
                 * means the same thing to both.
                 */
                'remote' => $this->messageId($response->json()) ?: null,
                'discord_id' => $this->text($response->json('data.discord_message_id')),

                /*
                 * And the fact that it went, separately from the id.
                 *
                 * Belt and braces, and the braces are the important half: a
                 * provider that changes what it calls an id would otherwise
                 * turn every sent message back into an unsent one, and the
                 * catch-up pass would post the whole conversation again every
                 * five minutes. This says "delivered" whatever they call it.
                 */
                'sent_at' => now(),
            ])->save();
        } catch (Throwable $exception) {
            // Sent and not marked as sent. Reported, and the pull below will
            // find it again by its own id - which is the whole reason the
            // unique index exists.
            report($exception);
        }

        return true;
    }

    public function close(Ticket $ticket): bool
    {
        $token = $this->token();

        if ($token === '' || !$ticket->pushed()) {
            return false;
        }

        try {
            $response = Http::withToken($token)
                ->timeout(self::TIMEOUT)
                ->acceptJson()
                ->withBody('{}', 'application/json')
                ->post(self::API . '/tickets/' . rawurlencode((string) $ticket->remote) . '/close');
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }

        return $response->successful();
    }

    /**
     * Read the message list and keep whatever is new.
     *
     * Everything is offered to the database and the unique index decides: a
     * message already here is a duplicate key rather than a comparison this
     * code has to get right. Our own messages come back too, and are matched by
     * the id written in say() - which is why that id is written at all.
     *
     * @return int How many were new.
     */
    public function pull(Ticket $ticket): int
    {
        $token = $this->token();

        if ($token === '' || !$ticket->pushed()) {
            return 0;
        }

        try {
            $response = Http::withToken($token)
                ->timeout(self::TIMEOUT)
                ->acceptJson()
                ->get(self::API . '/tickets/' . rawurlencode((string) $ticket->remote) . '/messages', [
                    'limit' => self::PAGE,
                ]);
        } catch (Throwable $exception) {
            report($exception);

            return 0;
        }

        if (!$response->successful()) {
            return 0;
        }

        $body = $response->json();
        $rows = is_array($body['data'] ?? null) ? $body['data'] : (is_array($body) ? $body : []);

        $mine = TicketMessage::query()
            ->where('ticket_id', (int) $ticket->id)
            ->whereNotNull('remote')
            ->pluck('remote')
            ->all();

        $new = 0;

        foreach ($rows as $row) {
            if (!is_array($row)) {
                continue;
            }

            $id = trim((string) ($row['id'] ?? ''));
            $said = trim((string) ($row['content'] ?? ''));

            /*
             * The picture first, because whether there is one decides whether
             * an empty message is a message.
             *
             * Somebody who drops a screenshot into the channel and types
             * nothing has said what they came to say, and Discord sends that as
             * a message with no content at all. This used to require text and
             * threw every one of them away, which read from the panel as
             * pictures from Discord simply never arriving.
             */
            $picture = Files::theirs($row['attachments'] ?? null);

            if ($id === '' || ($said === '' && $picture === null) || in_array($id, $mine, true)) {
                continue;
            }

            /*
             * Only what actually reached the channel.
             *
             * Modora keeps entries of its own in this list - the reference line
             * it writes when a ticket is opened through the API is one - and
             * they have no Discord message id because they were never posted to
             * Discord. They were showing up in the panel as somebody's message,
             * which is a line of bookkeeping wearing a customer's name.
             *
             * A message in a ticket channel has an id in that channel. That is
             * the whole test, and it is theirs rather than a guess of mine.
             */
            if (trim((string) ($row['discord_message_id'] ?? '')) === '') {
                continue;
            }

            try {
                TicketMessage::query()->create([
                    'ticket_id' => (int) $ticket->id,
                    // Nobody here. Whoever wrote it has a Discord account and
                    // not an account on this panel, which is the ordinary case
                    // for an answer.
                    'user_id' => null,
                    'author' => mb_substr(
                        $this->text($row['author']['name'] ?? null) ?? Theme::trans('tickets.someone'),
                        0,
                        191,
                    ),
                    /*
                     * An answer unless they say it is the customer's.
                     *
                     * Read that way round rather than "staff only when it says
                     * staff", which labelled every type this code had not heard
                     * of as a customer - and the first one it met was `user`, on
                     * a line Modora had written itself. The far end is where
                     * staff are; the exception is a customer who has claimed
                     * their ticket and writes in the channel, and that is the
                     * one case worth naming.
                     */
                    'staff' => !in_array((string) ($row['author']['type'] ?? ''), self::THEIRS, true),
                    'body' => mb_substr($said, 0, 20000),
                    'remote' => $id,
                    'discord_id' => $this->text($row['discord_message_id'] ?? null),
                    // And a picture, where somebody attached one in the
                    // channel. Their address rather than a copy of the file.
                    'file' => $picture,
                ]);

                $new++;
            } catch (Throwable) {
                // A duplicate key, almost always, which is this working. A read
                // that overlapped another read is not a fault to report.
            }
        }

        return $new;
    }

    /**
     * Why they would not answer, in their words where there are any.
     *
     * The one fault worth a sentence of our own is the IP restriction, because
     * their message says what is wrong and not what to do about it - and what
     * to do about it needs a number only this panel knows.
     *
     * @param  mixed  $body
     */
    private function refusal(mixed $body, int $status, ?string $from = null): string
    {
        $at = is_array($body) ? $body : [];
        $fault = trim((string) ($at['error'] ?? ''));
        $said = trim((string) ($at['message'] ?? ''));

        if ($fault === 'ip_not_allowed') {
            $address = trim((string) $from);

            if ($address === '') {
                return Theme::trans('tickets.check_ip_blind');
            }

            /*
             * Named, and said twice where it matters.
             *
             * A colon in it means the connection went out over IPv6, which is
             * the shape of this fault that wastes an afternoon: the panel has
             * an IPv4 address, somebody allows that one, and every request
             * still leaves over the other. Saying so is the difference between
             * a number to copy and a puzzle.
             */
            return Theme::trans(
                str_contains($address, ':') ? 'tickets.check_ip_six' : 'tickets.check_ip',
                ['ip' => $address],
            );
        }

        if ($said !== '') {
            return $said;
        }

        return Theme::trans('tickets.check_http', ['status' => (string) $status]);
    }

    /**
     * The ticket panels this key can see, by their id.
     *
     * So the setting is a list to choose from rather than a number to look up
     * and type. That is not decoration: the field was a text box, somebody put
     * the panel's name in it, and every ticket came back 422 for a field that
     * is optional in the first place. A list cannot be typed wrong.
     *
     * `panels.read` is the scope for it, and it is the one scope check() does
     * not insist on - a key without it gets an empty list and a field that says
     * so, rather than a shop that will not sell.
     *
     * @return array<int, string>
     */
    public function panels(): array
    {
        $token = $this->token();

        if ($token === '') {
            return [];
        }

        try {
            $response = Http::withToken($token)
                ->timeout(self::TIMEOUT)
                ->acceptJson()
                ->get(self::API . '/panels');

            if (!$response->successful()) {
                return [];
            }

            $body = $response->json();
            $rows = is_array($body['data'] ?? null) ? $body['data'] : (is_array($body) ? $body : []);
        } catch (Throwable $exception) {
            report($exception);

            return [];
        }

        $out = [];

        foreach ($rows as $row) {
            if (!is_array($row)) {
                continue;
            }

            $id = (int) ($row['id'] ?? $row['panel_id'] ?? 0);

            if ($id <= 0) {
                continue;
            }

            $out[$id] = mb_substr(
                trim((string) ($row['name'] ?? $row['title'] ?? '')) ?: ('#' . $id),
                0,
                120,
            );
        }

        return $out;
    }

    /**
     * Whether Modora still has this ticket open.
     *
     * Their record carries a `status`, and `closed` is the one value that
     * matters here: anything else - open, claimed, whatever they add next - is
     * a ticket still being dealt with. Reading it that way round means a status
     * this release has never heard of does not quietly finish somebody's
     * conversation.
     *
     * Null when they could not be asked, which is not the same as open and is
     * certainly not the same as closed.
     */
    public function stillOpen(Ticket $ticket): ?bool
    {
        $token = $this->token();

        if ($token === '' || !$ticket->pushed()) {
            return null;
        }

        try {
            $response = Http::withToken($token)
                ->timeout(self::TIMEOUT)
                ->acceptJson()
                ->get(self::API . '/tickets/' . rawurlencode((string) $ticket->remote));

            if (!$response->successful()) {
                return null;
            }

            $at = $this->inside($response->json());
            $status = trim((string) ($at['status'] ?? ''));

            return $status === '' ? null : $status !== 'closed';
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }
    }

    /** The key, as an administrator typed it. */
    private function token(): string
    {
        return trim((string) Theme::config('tickets_modora_key', ''));
    }

    /**
     * The ticket's own id out of an answer.
     *
     * `ticket_id` first, because that is what their event payload calls it and
     * it is what the messages endpoint is addressed by. `ticket_number` is
     * deliberately not read: it is the number the Discord channel is named
     * after, counts from one per server, and is not what addresses a ticket.
     */
    private function ticketId(mixed $body): string
    {
        $at = $this->inside($body);

        return trim((string) ($at['ticket_id'] ?? $at['ticket']['ticket_id'] ?? $at['id'] ?? ''));
    }

    /**
     * And a message's, which they call two different things.
     *
     * Posting one answers with `message_id`; listing them calls the same field
     * `id`. Reading only the second meant a sent message kept no id at all -
     * and an id is the only thing that tells our own message apart from a
     * stranger's when it comes back. The effect was every question appearing
     * twice, and the catch-up pass sending it again every five minutes because
     * a message with no id looks like one that never went.
     */
    private function messageId(mixed $body): string
    {
        $at = $this->inside($body);

        return trim((string) ($at['message_id'] ?? $at['message']['id'] ?? $at['id'] ?? ''));
    }

    /**
     * Past a `data` wrapper, if there is one.
     *
     * @return array<string, mixed>
     */
    private function inside(mixed $body): array
    {
        if (!is_array($body)) {
            return [];
        }

        return is_array($body['data'] ?? null) ? $body['data'] : $body;
    }

    private function text(mixed $value): ?string
    {
        $text = trim((string) (is_scalar($value) ? $value : ''));

        return $text === '' ? null : $text;
    }

    /**
     * What goes into the channel.
     *
     * Named, because this integration posts as itself: a channel of
     * unattributed questions is a channel nobody can answer.
     *
     * **And the first one carries the context.** Which service, a link straight
     * to it, how urgent, and the number both sides know it by. That is the
     * whole argument for asking from inside the panel rather than in a chat -
     * the question arrives knowing what it is about - and a channel that did
     * not say so would have thrown it away on the way over.
     *
     * Only the first: a context block on every reply is a channel nobody reads.
     */
    private function wrote(Ticket $ticket, TicketMessage $message): string
    {
        /*
         * A notice is already a whole sentence.
         *
         * "Bryan picked this up" introduced as "**Bryan** replied, from the
         * panel:" would read as somebody answering the customer with their own
         * name, which is the one thing a notice must not look like. It names
         * who and what in its own words, so it goes as it is.
         */
        if ((bool) $message->notice) {
            return mb_substr((string) $message->body, 0, 1900);
        }

        /*
         * "Asked" for a question and "replied" for an answer.
         *
         * An answer typed on the panel went into the channel introduced as a
         * question, which reads as the customer asking the same thing twice.
         * Both still say where it came from, because that is the part staff in
         * the channel cannot see for themselves.
         */
        $lines = [Theme::trans(
            $message->staff ? 'tickets.replied_by' : 'tickets.said_by',
            ['who' => (string) $message->author],
        )];

        if ($this->first($ticket, $message)) {
            foreach ($this->context($ticket) as $line) {
                $lines[] = $line;
            }
        }

        $lines[] = '';
        $lines[] = (string) $message->body;

        /*
         * And the picture, as an address rather than as a file.
         *
         * Their endpoint takes a multipart upload, answers success and throws
         * it away - the message lands in the channel with `attachments: []`. A
         * link does arrive, because Discord unfurls one into the picture
         * itself, so the same thing reaches the channel by the road that works.
         */
        $picture = Files::url($message->file);

        if ($picture !== null) {
            $lines[] = '';

            /*
             * Named, because a bare address in a channel is a bare address.
             *
             * It cannot be the picture itself: Modora wraps everything we send
             * in an embed, and Discord does not turn a link inside an embed
             * into the image. Their API has no attachment field either - a
             * message posted with every image field anybody could guess comes
             * back with `attachments: []`. So a word in front of it is the
             * whole of what can be done here, and it is worth more than it
             * sounds: it is the difference between a link somebody opens and a
             * link somebody scrolls past.
             */
            $lines[] = Theme::trans('tickets.ctx_picture', ['url' => $picture]);
        }

        return mb_substr(implode("\n", $lines), 0, 1900);
    }

    /**
     * The block that says what the question is about.
     *
     * @return array<int, string>
     */
    private function context(Ticket $ticket): array
    {
        $out = [];

        $service = $ticket->order;
        $spec = $service !== null && is_array($service->spec) ? $service->spec : [];
        $name = trim((string) ($spec['name'] ?? ''));

        if ($name !== '') {
            $out[] = Theme::trans('tickets.ctx_service', ['name' => $name]);
        }

        /*
         * A link straight to the server, by the address Pelican's own panel
         * uses. Anybody in the channel with an account here is one click from
         * the thing being asked about; anybody without one loses nothing.
         */
        $server = $ticket->server;

        if ($server !== null) {
            try {
                $out[] = Theme::trans('tickets.ctx_server', [
                    'url' => url('/server/' . $server->uuid_short),
                ]);
            } catch (Throwable) {
                // A link is the one part of this worth nothing on its own.
            }
        }

        $out[] = Theme::trans('tickets.ctx_priority', [
            'level' => Theme::trans('tickets.priority_' . $ticket->priority),
        ]);

        $out[] = Theme::trans('tickets.ctx_ticket', ['number' => '#' . (int) $ticket->id]);

        return $out;
    }

    /** Whether this is the message the ticket opened with. */
    private function first(Ticket $ticket, TicketMessage $message): bool
    {
        try {
            return TicketMessage::query()
                ->where('ticket_id', (int) $ticket->id)
                ->orderBy('id')
                ->value('id') === $message->id;
        } catch (Throwable) {
            return false;
        }
    }
}
