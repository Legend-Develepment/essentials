<?php

namespace LegendDevelopment\Theme\Support\Tickets;

use Illuminate\Http\Request;
use LegendDevelopment\Theme\Models\Ticket;
use LegendDevelopment\Theme\Models\TicketMessage;
use Illuminate\Support\Facades\Storage;
use LegendDevelopment\Theme\Support\Settings;
use LegendDevelopment\Theme\Support\Tickets\Files;
use LegendDevelopment\Theme\Support\Shop\Billing;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * What Modora posts here when something happens in a ticket.
 *
 * **It writes down what it was sent before it tries to understand it**, and
 * that is worth keeping even now the shape is known. A delivery this release
 * cannot read is a delivery the next one can be written against, and "is it
 * reaching us at all" is the first question anybody asks when an answer does
 * not appear.
 *
 * The shape it reads is theirs, and it is not the one that would have been
 * guessed. A ticket is named at `ticket.ticket_id` rather than `ticket.id`,
 * which is exactly the kind of thing a list of plausible paths gets wrong: the
 * first version of this had five candidates for that field and none of them was
 * the right one. Every path below is one that has actually been seen.
 *
 * **The address is the credential.** Nothing in what they send is a signature,
 * so the route carries a long random secret that only this panel and Modora
 * know. That is the same shape as a Laravel signed URL, and it is why the next
 * paragraph matters more than it would otherwise.
 *
 * **It may add to a conversation and it may not start one.** A delivery can put
 * a message on a ticket that already exists and is already known by its Modora
 * id, mark such a ticket answered, or mark it finished. It cannot create a
 * ticket, cannot name a customer, cannot reopen anything and cannot touch a
 * ticket this panel has never pushed. An endpoint the internet may call should
 * be able to add to something, never to steer it - and with the shape of the
 * payload still unknown, that line is where the caution has to live.
 *
 * **Polling stays underneath it.** A delivery that never arrives is then an
 * answer that shows up a quarter of an hour later rather than one the customer
 * never sees, and the unique index on (ticket, remote id) means a webhook and a
 * pull that cross each other produce one message rather than two.
 */
class Hook
{
    /**
     * Where the last few deliveries are kept, so somebody can read them.
     *
     * A file rather than the cache, and that is a correction: the cache is
     * flushed by `optimize:clear`, which this plugin's own updater runs on
     * every release - so on a panel that updates itself the evidence was being
     * wiped roughly as often as somebody thought to look at it. A file on the
     * local disk survives that, which is the whole point of keeping it.
     */
    private const SEEN = 'legend-theme/ticket-hooks.json';

    /** How many. Enough to see a pattern, few enough to read. */
    private const KEEP = 20;

    /** And how much of each. A payload longer than this is a payload that is not one. */
    private const SLICE = 8192;

    /** The biggest body this will read at all. */
    private const MOST = 65536;

    /**
     * Author types that mean the person who asked.
     *
     * Everything else is an answer, including a type this release has never
     * heard of. Read the other way round, the first unknown type it met - `user`,
     * on a line Modora wrote itself - came through wearing a customer's label.
     */
    private const THEIRS = ['customer', 'guest', 'opener', 'requester'];

    /**
     * Take a delivery.
     *
     * @return array{ok: bool, why: string, did: string}
     */
    public static function take(Request $request, string $secret): array
    {
        $ours = self::secret();

        /*
         * Nothing is read off the request until the address checks out, and it
         * is compared in constant time. A cheap comparison here leaks how much
         * of a guessed secret was right, one character at a time.
         */
        if ($ours === '' || !hash_equals($ours, $secret)) {
            return ['ok' => false, 'why' => 'address', 'did' => ''];
        }

        $body = (string) $request->getContent();

        if (strlen($body) > self::MOST) {
            return ['ok' => false, 'why' => 'size', 'did' => ''];
        }

        $payload = json_decode($body, true);
        $payload = is_array($payload) ? $payload : [];

        $event = self::pick($payload, ['event', 'type', 'name'])
            ?? (string) $request->header('X-Modora-Event', '');

        // Written down first, whatever it turns out to be. A delivery this
        // release cannot read is a delivery the next one can be written against.
        self::remember($request, $event, $body);

        return ['ok' => true, 'why' => '', 'did' => self::act($event, $payload)];
    }

    /**
     * Do whatever can be done with it, and say what that was.
     *
     * The event name decides. Every one of the five is worth subscribing to,
     * and each does something different: a message from the channel is added, a
     * message of our own confirms where it landed, a close ends it here too, a
     * claim retires the link, and a ticket created in Discord is somebody
     * else's conversation this panel leaves alone.
     */
    private static function act(?string $event, array $payload): string
    {
        $ticket = self::ticket($payload);

        if (!$ticket instanceof Ticket) {
            return 'unknown ticket';
        }

        return match ($event) {
            'ticket.message' => self::said($ticket, $payload),
            'ticket.message.api' => self::mine($ticket, $payload),
            'ticket.closed' => self::finished($ticket),
            'ticket.linked' => self::linked($ticket),

            /*
             * ticket.created among them, and deliberately nothing.
             *
             * It fires for every ticket opened in the server, including ones
             * opened in Discord by somebody who has no account here - and a
             * webhook is not allowed to make a ticket in this panel. One of
             * ours is already here before Modora ever hears of it, so there is
             * nothing this could add.
             */
            default => 'noted',
        };
    }

    /** Somebody said something in the channel. */
    private static function said(Ticket $ticket, array $payload): string
    {
        $id = self::pick($payload, ['message.id', 'id']);
        $body = trim((string) (self::pick($payload, ['message.content', 'content']) ?? ''));

        /*
         * The picture decides whether an empty message is a message.
         *
         * Somebody who drops a screenshot into the channel and types nothing
         * has said what they came to say, and that arrives here with no content
         * at all. Insisting on text threw every one of those away.
         */
        $picture = Files::theirs(
            $payload['message']['attachments'] ?? $payload['attachments'] ?? null,
        );

        if ($id === null || ($body === '' && $picture === null)) {
            return 'no message in it';
        }

        /*
         * And only what actually reached the channel.
         *
         * The same test the pull makes, for the same reason: Modora writes
         * entries of its own into a ticket, they carry no Discord message id
         * because they were never posted there, and they were turning up in the
         * panel as somebody's message.
         */
        if (self::pick($payload, ['message.discord_message_id', 'discord_message_id']) === null) {
            return 'not a channel message';
        }

        try {
            TicketMessage::query()->create([
                'ticket_id' => (int) $ticket->id,
                /*
                 * Nobody here, and staff either way.
                 *
                 * Whoever wrote it has a Discord account rather than an account
                 * on this panel, and anything arriving from the far end is an
                 * answer. The author name is shown but never believed: it does
                 * not decide who anybody is, only what the message is labelled.
                 */
                'user_id' => null,
                'author' => mb_substr(
                    self::pick($payload, ['message.author.name', 'author.name'])
                        ?? Theme::trans('tickets.someone'),
                    0,
                    191,
                ),
                /*
                 * Whether it is an answer, from what they say rather than from
                 * where it came.
                 *
                 * `author.type` is on every message and says staff or does not.
                 * The first version of this called everything from the far end
                 * an answer, which is wrong the moment a customer claims their
                 * ticket and writes in the channel: their own words would have
                 * come back labelled as support. Absent, an answer is still the
                 * safer reading - the far end is where staff are.
                 */
                'staff' => !in_array(
                    self::pick($payload, ['message.author.type', 'author.type']) ?? '',
                    self::THEIRS,
                    true,
                ),
                'body' => mb_substr($body, 0, 20000),
                'remote' => mb_substr($id, 0, 191),
                // A picture, where the delivery carries one. Read by the same
                // method the pull uses, so both roads leave the same row behind
                // rather than two copies of one rule drifting apart.
                'file' => $picture,
                'discord_id' => self::cut(self::pick($payload, [
                    'message.discord_message_id',
                    'discord_message_id',
                ])),
            ]);
        } catch (Throwable) {
            // A duplicate key, almost always, which is this working: a pull got
            // there first. Not a fault, and not worth reporting.
            return 'already had it';
        }

        $staff = !in_array(
            self::pick($payload, ['message.author.type', 'author.type']) ?? '',
            self::THEIRS,
            true,
        );

        try {
            // Whose turn it is, the same rule Board::say() follows: an answer
            // puts it on the customer, and anything else puts it back on the
            // panel. A finished ticket stays finished either way.
            $ticket->forceFill([
                'state' => match (true) {
                    $ticket->closed() => Ticket::CLOSED,
                    $staff => Ticket::ANSWERED,
                    default => Ticket::OPEN,
                },
                'last_at' => now(),
            ])->save();
        } catch (Throwable $exception) {
            report($exception);
        }

        // And only an answer is worth a bell. Telling a customer that they
        // themselves have written something is how notifications get switched
        // off.
        if ($staff) {
            self::told($ticket);
        }

        return 'added a message';
    }

    /**
     * One of our own messages, now that it really exists in Discord.
     *
     * Posting a message answers with `queued: true` and no Discord id, because
     * at that moment there is not one yet. This event is when there is, so the
     * row we already have is filled in rather than a second one being made -
     * the message is ours, we wrote it, and the only new fact in the delivery
     * is where it ended up.
     *
     * Nothing else changes. It is not an answer, it does not move whose turn it
     * is, and it rings no bell: it is a message somebody in this panel already
     * watched themselves send.
     */
    private static function mine(Ticket $ticket, array $payload): string
    {
        $id = self::pick($payload, ['message.id', 'id']);
        $discord = self::pick($payload, ['message.discord_message_id', 'discord_message_id']);

        if ($id === null || $discord === null) {
            return 'nothing to fill in';
        }

        try {
            $rows = TicketMessage::query()
                ->where('ticket_id', (int) $ticket->id)
                ->where('remote', $id)
                ->whereNull('discord_id')
                ->update(['discord_id' => mb_substr($discord, 0, 191)]);
        } catch (Throwable $exception) {
            report($exception);

            return 'could not fill it in';
        }

        return $rows > 0 ? 'noted where it landed' : 'already knew';
    }

    /** It was closed at the far end, by anybody. */
    private static function finished(Ticket $ticket): string
    {
        if ($ticket->closed()) {
            return 'already closed';
        }

        try {
            $ticket->forceFill([
                'state' => Ticket::CLOSED,
                'closed_at' => now(),
                'last_at' => now(),
            ])->save();
        } catch (Throwable $exception) {
            report($exception);

            return 'could not close it';
        }

        return 'closed it';
    }

    /**
     * A guest tied their ticket to a Discord account.
     *
     * The claim link goes, because following it again does nothing and a link
     * that does nothing is a link somebody will press and then write in about.
     */
    private static function linked(Ticket $ticket): string
    {
        try {
            $ticket->forceFill(['claim_url' => null])->save();
        } catch (Throwable $exception) {
            report($exception);
        }

        return 'claimed';
    }

    /**
     * The ticket a delivery is about, and only one this panel pushed.
     *
     * Matched on the Modora id rather than on anything in the body that names
     * one of ours: an id somebody put in a payload is not a claim on a row.
     */
    private static function ticket(array $payload): ?Ticket
    {
        /*
         * `ticket.ticket_id` is theirs, and it is the one this matches on.
         *
         * `ticket_number` sits beside it and is not the same thing: it is the
         * number the channel is named after, which counts from one per server
         * and is not what the API addresses a ticket by. Matching on that would
         * find the wrong conversation on the day two servers are involved.
         *
         * The two flatter forms are kept for a payload that arrives without the
         * wrapper. They cost nothing and one of them has already been wrong.
         */
        $id = self::pick($payload, [
            'ticket.ticket_id',
            'ticket.id',
            'ticket_id',
        ]);

        if ($id === null || trim($id) === '') {
            return null;
        }

        try {
            $ticket = Ticket::query()->where('remote', trim($id))->first();
        } catch (Throwable) {
            return null;
        }

        return $ticket instanceof Ticket ? $ticket : null;
    }

    /**
     * A value out of the payload, by the path it sits at.
     *
     * Still takes a list, and the list is now short on purpose: the first entry
     * is the shape Modora sends and anything after it is a fallback for a
     * payload that arrives without its wrapper. It is a thing to narrow, never
     * a thing to keep adding to - a long list of guesses is how the ticket id
     * went unread in the first place.
     *
     * Numbers come back as strings, which is right: every id this stores is a
     * string column, and an id is a name rather than a quantity.
     *
     * @param  array<string, mixed>  $payload
     * @param  array<int, string>  $paths
     */
    private static function pick(array $payload, array $paths): ?string
    {
        foreach ($paths as $path) {
            $at = $payload;

            foreach (explode('.', $path) as $step) {
                if (!is_array($at) || !array_key_exists($step, $at)) {
                    $at = null;

                    break;
                }

                $at = $at[$step];
            }

            if (is_scalar($at) && trim((string) $at) !== '') {
                return (string) $at;
            }
        }

        return null;
    }

    private static function cut(?string $value): ?string
    {
        return $value === null ? null : mb_substr($value, 0, 191);
    }

    /**
     * Keep the last few, so somebody can read what Modora actually sends.
     *
     * In the cache rather than a table: this is a thing to look at while a
     * connection is being set up, not a record to keep. A cache clear losing
     * them is the correct amount of durability for that.
     *
     * The headers are kept because whatever signature they use is in one of
     * them, and finding out which is half the reason this exists. Anything that
     * looks like an ordinary browser header is left out to keep the list short.
     */
    private static function remember(Request $request, ?string $event, string $body): void
    {
        try {
            $wanted = [];

            foreach ($request->headers->all() as $name => $values) {
                $name = strtolower((string) $name);

                if (str_starts_with($name, 'x-') || $name === 'user-agent' || $name === 'content-type') {
                    $wanted[$name] = mb_substr((string) ($values[0] ?? ''), 0, 400);
                }
            }

            $seen = self::deliveries();

            array_unshift($seen, [
                'at' => now()->toDateTimeString(),
                'event' => $event ?? '',
                'headers' => $wanted,
                'body' => mb_substr($body, 0, self::SLICE),
            ]);

            Storage::disk('local')->put(
                self::SEEN,
                (string) json_encode(array_slice($seen, 0, self::KEEP), JSON_UNESCAPED_SLASHES),
            );
        } catch (Throwable) {
            // Nothing here is worth failing a delivery over. The acting above
            // is the part that matters; this is the part that teaches.
        }
    }

    /**
     * What has come in, newest first.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function deliveries(): array
    {
        try {
            $disk = Storage::disk('local');

            if (!$disk->exists(self::SEEN)) {
                return [];
            }

            $read = json_decode((string) $disk->get(self::SEEN), true);

            return is_array($read) ? $read : [];
        } catch (Throwable) {
            return [];
        }
    }

    public static function forget(): void
    {
        try {
            Storage::disk('local')->delete(self::SEEN);
        } catch (Throwable) {
            // A disk that will not answer keeps whatever it has, which is the
            // harmless way for a diagnostic to fail.
        }
    }

    /** The secret in the address, as it is stored. */
    public static function secret(): string
    {
        return trim((string) Theme::config('tickets_hook_secret', ''));
    }

    /**
     * The address to paste into Modora, or null while there is no secret.
     *
     * Built from the panel's own URL rather than a configured one, so it is
     * right on a panel that has moved without anybody remembering this page.
     */
    public static function address(): ?string
    {
        $secret = self::secret();

        if ($secret === '') {
            return null;
        }

        try {
            return url('/essentials/tickets/hook/' . $secret);
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * Make a new one, which is also how the old address is revoked.
     *
     * Forty-eight hex characters out of PHP's own cryptographic source. Long
     * enough that guessing it is not a thing, and short enough to paste.
     */
    public static function renew(): ?string
    {
        try {
            $secret = bin2hex(random_bytes(24));

            Settings::persistTickets(array_merge(Settings::ticketsData(), [
                'tickets_hook_secret' => $secret,
            ]));

            /*
             * And into the config this process is holding.
             *
             * Writing .env changes the file and clears the cached config; it
             * does not change the array PHP already loaded. Without this line,
             * everything in the rest of this request still believes there is no
             * address - which is exactly what a probe found, asking for the
             * address a line after making one and being told there is not one.
             *
             * The next request reads the file and agrees. This is about the
             * one in between.
             */
            config([Theme::id() . '.tickets_hook_secret' => $secret]);

            return $secret;
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }
    }

    /** Tell the customer somebody answered. */
    private static function told(Ticket $ticket): void
    {
        try {
            $user = $ticket->user;

            if ($user !== null) {
                Billing::answered($user, (string) $ticket->subject);
            }
        } catch (Throwable) {
            // A bell that did not ring is not a message that was lost.
        }
    }
}
