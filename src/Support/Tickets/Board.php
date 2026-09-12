<?php

namespace LegendDevelopment\Theme\Support\Tickets;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Models\Ticket;
use LegendDevelopment\Theme\Models\TicketMessage;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Shop\Billing;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Asking a question, and everything that happens to it.
 *
 * **Written here first, then passed on. Always, in that order.** A customer who
 * has typed out what is wrong with their server has done the expensive part; an
 * HTTP call that fails afterwards is an inconvenience, and one that fails
 * before the row is written loses their afternoon. So every method below saves
 * to this panel's own tables and only then asks the desk to mirror it, and a
 * desk that refuses leaves a row that says so and can be tried again.
 *
 * That is the same rule Gateways::remember() follows for a payment, and it is
 * the rule the whole ticket feature is arranged around.
 *
 * **A ticket may name a service**, which is the one thing a chat channel cannot
 * do and the reason to have this at all. "My server will not start" is a
 * different question when the panel already knows which server, who owns it,
 * what package it is and whether its last invoice was paid.
 */
class Board
{
    /** Whether any of this is offered at all. */
    public static function ready(): bool
    {
        return Features::enabled(Features::TICKETS) && Tables::ready();
    }

    /**
     * Whether somebody may start a new one.
     *
     * A separate question from ready(), and the separation is the point: an
     * intake that is closed leaves every conversation already going exactly
     * where it is. People can still read and reply to what they opened, which
     * is the difference between "not taking new questions this week" and
     * "everybody who asked one is now talking to nobody".
     */
    public static function opening(): bool
    {
        return self::ready() && (bool) Theme::config('tickets_open', true);
    }

    /**
     * Open one.
     *
     * The subject and the first message arrive together because that is how
     * somebody asks a question, but they are two records: a ticket with a
     * heading and no message is a thing that can be recovered, and a message
     * with nowhere to live is not.
     */
    public static function open(
        User $user,
        string $subject,
        string $body,
        ?Order $order = null,
        string $priority = Ticket::NORMAL,
    ): ?Ticket {
        if (!self::opening()) {
            return null;
        }

        $subject = mb_substr(trim($subject), 0, 191);
        $body = mb_substr(trim($body), 0, 20000);

        if ($subject === '' || $body === '') {
            return null;
        }

        try {
            $ticket = new Ticket();

            $ticket->forceFill([
                'user_id' => (int) $user->id,
                'order_id' => $order === null ? null : (int) $order->id,
                // The server, where the order has one. Kept beside the order
                // rather than instead of it: an order that is cancelled loses
                // its server, and the question was still about that service.
                'server_id' => $order?->server_id === null ? null : (int) $order->server_id,
                'subject' => $subject,
                'state' => Ticket::OPEN,
                'priority' => in_array($priority, Ticket::PRIORITIES, true) ? $priority : Ticket::NORMAL,
                'last_at' => now(),
            ])->save();
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }

        // And only then the far end. A desk that refuses leaves a ticket with
        // no remote id, which retry() can put right without anybody retyping.
        try {
            Desks::current()->open($ticket);
        } catch (Throwable $exception) {
            report($exception);
        }

        self::say($ticket, $user, $body, false);

        return $ticket->fresh();
    }

    /**
     * Add something to one.
     *
     * @param  bool  $staff  Whether this is an answer rather than a question.
     */
    public static function say(
        Ticket $ticket,
        ?User $who,
        string $body,
        bool $staff,
        mixed $picture = null,
    ): ?TicketMessage {
        if (!self::ready()) {
            return null;
        }

        $body = mb_substr(trim($body), 0, 20000);

        /*
         * A picture on its own is a message.
         *
         * Somebody sending a screenshot of an error has said what they came to
         * say; insisting they also type something would be insisting on
         * ceremony. The text can be empty as long as something else is not.
         */
        $file = Files::keep($picture);

        if (($body === '' && $file === null) || $ticket->closed()) {
            return null;
        }

        try {
            $message = new TicketMessage();

            $message->forceFill([
                'ticket_id' => (int) $ticket->id,
                'user_id' => $who === null ? null : (int) $who->id,
                'author' => mb_substr(
                    (string) ($who?->username ?? Theme::trans('tickets.someone')),
                    0,
                    191,
                ),
                'staff' => $staff,
                'body' => $body,
                'file' => $file,
            ])->save();
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }

        try {
            /*
             * Whose turn it is now. The state is about who is waiting, not
             * about whether anything is wrong: a ticket somebody answered is
             * waiting on the customer, and one the customer replied to is
             * waiting on the panel again.
             */
            $ticket->forceFill([
                'state' => $staff ? Ticket::ANSWERED : Ticket::OPEN,
                'last_at' => now(),
            ])->save();
        } catch (Throwable $exception) {
            report($exception);
        }

        try {
            Desks::current()->say($ticket, $message);
        } catch (Throwable $exception) {
            report($exception);
        }

        self::told($ticket, $staff);

        return $message;
    }

    /**
     * Put somebody's name on it, or take it off again.
     *
     * Null releases it, which is the same act and belongs in the same method:
     * a release that lived somewhere else would be a second place to remember
     * that the channel has to be told.
     *
     * **Recorded here and announced there**, because Modora has no assign
     * endpoint - no assign, no transfer, no priority, nothing that changes a
     * ticket after it exists. Waiting for one would be waiting for ever. What
     * the far end does have is the channel, and "Bryan picked this up" in the
     * channel is what stops two people answering the same question.
     */
    public static function claim(Ticket $ticket, ?User $who): bool
    {
        if (!self::ready() || $ticket->closed()) {
            return false;
        }

        $by = user();

        try {
            $ticket->forceFill(['claimed_by' => $who === null ? null : (int) $who->id])->save();
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }

        self::note($ticket, $by, Theme::trans(
            $who === null ? 'tickets.note_released' : 'tickets.note_claimed',
            [
                'who' => (string) ($by?->username ?? Theme::trans('tickets.someone')),
                'whom' => (string) ($who?->username ?? ''),
            ],
        ));

        return true;
    }

    /**
     * Hand it to a group, where a group is a role.
     *
     * Pelican has no notion of a team and a second list of them beside the
     * roles would be two lists to keep in step: the people who answer billing
     * questions are already a role, because that is how they were given the
     * permission to read this page at all.
     *
     * A label and a filter rather than a wall. Nothing is hidden from anybody
     * who could already see it - hiding a customer's question from half the
     * staff because somebody filed it wrongly is a worse failure than the one
     * it would prevent.
     */
    public static function hand(Ticket $ticket, ?int $roleId): bool
    {
        if (!self::ready() || $ticket->closed()) {
            return false;
        }

        $by = user();
        $roleId = $roleId !== null && $roleId > 0 ? $roleId : null;

        /*
         * A submit that changed nothing is not a move.
         *
         * The picker has a placeholder and no required, so "I did not choose
         * anything" and "take it out of its group" arrive as the same value -
         * which meant pressing the confirm button on an ungrouped ticket wrote
         * "took this out of its group" about a group it was never in, and
         * pressing it on a grouped one wrote the same move again every time.
         *
         * urgency() has had this guard since it was written. hand() is the one
         * that went out without it.
         */
        if ((int) ($ticket->role_id ?? 0) === (int) ($roleId ?? 0)) {
            return true;
        }

        $name = $roleId === null ? '' : self::groupName($roleId);

        // A role that is not there any more is not a group to move anything to.
        if ($roleId !== null && $name === '') {
            return false;
        }

        try {
            $ticket->forceFill(['role_id' => $roleId])->save();
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }

        /*
         * Written here and nowhere else, which is the one difference from a
         * claim or a priority change.
         *
         * A group is a thing this panel invented: Discord has no groups, and a
         * customer has no use for the name of the role that will answer them.
         * "bryan moved this to blackdragon" in somebody's support ticket is an
         * internal note that escaped, so this one stays inside.
         */
        self::note($ticket, $by, Theme::trans(
            $roleId === null ? 'tickets.note_ungrouped' : 'tickets.note_grouped',
            [
                'who' => (string) ($by?->username ?? Theme::trans('tickets.someone')),
                'group' => $name,
            ],
        ), true);

        return true;
    }

    /** How urgent it is now. */
    public static function urgency(Ticket $ticket, string $priority): bool
    {
        if (!self::ready() || $ticket->closed() || !in_array($priority, Ticket::PRIORITIES, true)) {
            return false;
        }

        if ($priority === $ticket->priority) {
            return true;
        }

        $by = user();

        try {
            $ticket->forceFill(['priority' => $priority])->save();
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }

        self::note($ticket, $by, Theme::trans('tickets.note_priority', [
            'who' => (string) ($by?->username ?? Theme::trans('tickets.someone')),
            'level' => Theme::trans('tickets.priority_' . $priority),
        ]));

        return true;
    }

    /** What a group is called, or nothing if there is no such role. */
    public static function groupName(int $roleId): string
    {
        try {
            return (string) (Role::query()->whereKey($roleId)->value('name') ?? '');
        } catch (Throwable) {
            return '';
        }
    }

    /** Finish one. */
    public static function close(Ticket $ticket): bool
    {
        if (!self::ready() || $ticket->closed()) {
            return false;
        }

        try {
            $ticket->forceFill([
                'state' => Ticket::CLOSED,
                'closed_at' => now(),
                'last_at' => now(),
            ])->save();
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }

        try {
            Desks::current()->close($ticket);
        } catch (Throwable $exception) {
            report($exception);
        }

        return true;
    }

    /**
     * Ask the desk again about a ticket it has not taken yet.
     *
     * The one repair this needs: a ticket written here while Modora was down
     * has everything except a remote id, and this gives it one and sends
     * everything already said. Nobody retypes anything.
     */
    public static function retry(Ticket $ticket): bool
    {
        if (!self::ready() || $ticket->closed()) {
            return false;
        }

        $desk = Desks::current();

        if (!$ticket->pushed() && !$desk->open($ticket)) {
            return false;
        }

        $ticket = $ticket->fresh() ?? $ticket;
        $sent = 0;

        foreach (self::messages($ticket) as $message) {
            /*
             * Anything that has not gone, whoever wrote it.
             *
             * This used to skip every message with staff set, which quietly
             * meant that an answer refused by the desk - or a claim, or a
             * priority change - was never tried again by anything: not the
             * timer, not this button, not ever. The customer's question was
             * retried and the reply to it was not.
             *
             * Only the panel's own internal notes stay behind, because those
             * were never going anywhere.
             */
            if (!$message->pushed() && !$message->inside && $desk->say($ticket, $message)) {
                $sent++;
            }
        }

        return $ticket->pushed() || $sent > 0;
    }

    /**
     * Bring back whatever was said at the far end.
     *
     * Called when somebody opens a ticket and on a timer for the ones still
     * open. Told to the customer only when something actually arrived, because
     * a pull that found nothing is not news.
     */
    public static function pull(Ticket $ticket): int
    {
        if (!self::ready() || !$ticket->pushed()) {
            return 0;
        }

        $desk = Desks::current();

        try {
            $new = $desk->pull($ticket);
        } catch (Throwable $exception) {
            report($exception);

            return 0;
        }

        /*
         * And whether it is still a conversation.
         *
         * A ticket closed in Discord was staying open here, because nothing
         * ever asked. The event says so the moment it happens - but only on a
         * panel Modora can reach and only once somebody has set that up, so
         * asking is what makes it true on the rest of them.
         *
         * Only false closes it. Null means the desk could not be asked, and a
         * desk that did not answer is not a desk saying the ticket is over.
         */
        try {
            if ($desk->stillOpen($ticket) === false && !$ticket->closed()) {
                $ticket->forceFill([
                    'state' => Ticket::CLOSED,
                    'closed_at' => now(),
                    'last_at' => now(),
                ])->save();
            }
        } catch (Throwable $exception) {
            report($exception);
        }

        if ($new <= 0) {
            return 0;
        }

        try {
            $ticket->forceFill([
                'state' => $ticket->closed() ? Ticket::CLOSED : Ticket::ANSWERED,
                'last_at' => now(),
            ])->save();
        } catch (Throwable $exception) {
            report($exception);
        }

        self::told($ticket, true);

        return $new;
    }

    /**
     * Tickets with something still to pass on.
     *
     * **The far end is not ready the instant it says a ticket exists.** Modora
     * makes the Discord channel after it answers, so the first message posted
     * straight afterwards comes back "the channel has not been created yet,
     * retry in a moment" - which is not a fault, it is a race, and the honest
     * answer to a race is to try again rather than to make a customer press a
     * button about somebody else's queue.
     *
     * So this is what a timer walks: a live ticket that never reached the desk,
     * or one that did and has a question still sitting here unsent. On a panel
     * where everything went through first time it is an empty list and no work.
     *
     * @return Collection<int, Ticket>
     */
    public static function behind(int $limit = 40): Collection
    {
        if (!self::ready()) {
            return new Collection();
        }

        try {
            return Ticket::query()
                ->where('state', '!=', Ticket::CLOSED)
                ->where(static fn ($query) => $query
                    ->whereNull('remote')
                    ->orWhereHas('messages', static fn ($said) => $said
                        ->whereNull('remote')
                        ->whereNull('sent_at')
                        ->where('inside', false)))
                ->orderBy('id')
                ->limit($limit)
                ->get();
        } catch (Throwable) {
            return new Collection();
        }
    }

    /**
     * Every open ticket that has a far end, oldest look first.
     *
     * What the timed pull walks. Bounded, because a panel with three hundred
     * open tickets should take three hundred requests over several passes
     * rather than all of them in one.
     *
     * @return Collection<int, Ticket>
     */
    public static function stale(int $limit = 40): Collection
    {
        if (!self::ready()) {
            return new Collection();
        }

        try {
            return Ticket::query()
                ->where('state', '!=', Ticket::CLOSED)
                ->whereNotNull('remote')
                ->orderBy('last_at')
                ->limit($limit)
                ->get();
        } catch (Throwable) {
            return new Collection();
        }
    }

    /**
     * Whether anything about this ticket is still waiting to be passed on.
     *
     * The ticket itself, or a question on it. Asked by the page to decide
     * whether the retry button is worth showing, and it is the same question
     * behind() asks of the whole table.
     */
    public static function waitingOn(Ticket $ticket): bool
    {
        if (!$ticket->pushed()) {
            return true;
        }

        try {
            return TicketMessage::query()
                ->where('ticket_id', (int) $ticket->id)
                ->whereNull('remote')
                ->whereNull('sent_at')
                ->where('inside', false)
                ->exists();
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * A message, safe to print, with its links clickable.
     *
     * **Escaped first and linked second, in that order and never the other.**
     * The text is whatever somebody typed - a customer, or a stranger in a
     * Discord channel - so it is turned into text before anything is made of
     * it. Only then is a pattern that is unmistakably an address wrapped in an
     * anchor, which means an anchor can only ever appear around something this
     * code recognised and never around something the writer supplied.
     *
     * The formatting is Discord's own subset, because that is the other end of
     * the conversation: a panel that rendered things Discord does not would show
     * two different messages to two people who think they are reading the same
     * one. See Markdown, which is where all of that lives.
     */
    public static function readable(string $body): string
    {
        return Markdown::render($body);
    }

    /**
     * The conversation, ready for the window to draw.
     *
     * **Built here rather than on each page**, because the two pages show the
     * same conversation and every difference between them is a way for them to
     * drift. There is exactly one real difference - who "mine" is - and it is
     * an argument rather than a second copy of this method.
     *
     * What it adds beyond the message itself is what makes a transcript read as
     * a chat: the clock time rather than "2 hours ago", which day each one
     * belongs to so a separator can be drawn between days, and whether this is
     * the first of a run by the same person. A run is what lets six replies in
     * a row be one name and six bubbles instead of six headers.
     *
     * @param  bool  $staffReads  Whether the reader is staff, which decides
     *                            whose messages sit on the reader's own side.
     * @return array<int, array<string, mixed>>
     */
    public static function drawn(Ticket $ticket, bool $staffReads): array
    {
        $out = [];
        $wasDay = null;
        $wasWho = null;

        foreach (self::messages($ticket) as $message) {
            // Staff bookkeeping, and only staff read it.
            if ((bool) $message->inside && !$staffReads) {
                continue;
            }

            $at = $message->created_at;
            $day = $at?->toDateString() ?? '';
            $notice = (bool) $message->notice;

            /*
             * Whose bubble this is.
             *
             * A notice belongs to neither side - it is the ticket itself
             * saying something happened - so it is nobody's, and the window
             * draws it down the middle as a line rather than as a bubble.
             */
            $mine = !$notice && ($staffReads ? (bool) $message->staff : !(bool) $message->staff);

            /*
             * Whether this is still the same person talking.
             *
             * The author's name is not enough on its own: two people can share
             * a display name, and the same name arriving from the panel and
             * from Discord is two different things to look at. So the run is
             * broken by anything that would change what the header says.
             */
            $who = $notice ? 'notice' : implode(':', [
                $message->user_id !== null ? 'panel' : 'discord',
                (bool) $message->staff ? 'staff' : 'user',
                (string) $message->author,
            ]);

            $row = [
                'author' => (string) $message->author,
                'staff' => (bool) $message->staff,
                'notice' => $notice,
                // Escaped and linked in one place, so no view has to remember
                // that this text came from outside.
                'body' => self::readable((string) $message->body),
                // Both: the clock in the bubble, and the long form on hover for
                // anybody who wants to know exactly when.
                'clock' => $at?->format('H:i') ?? '',
                'when' => $at?->diffForHumans(),
                'day' => $day,
                'day_label' => self::dayName($at),
                'starts_day' => $day !== $wasDay,
                'run' => $day !== $wasDay || $who !== $wasWho,
                /*
                 * Where it was typed, which is a different question from where
                 * it now exists: everything here ends up in both places. An
                 * account behind it means somebody wrote it on this panel;
                 * nobody behind it means it came out of the channel.
                 */
                'from' => $message->user_id !== null ? 'panel' : 'discord',
                'mine' => $mine,
                /*
                 * A file, and whether it is one to look at or one to keep.
                 *
                 * A support ticket is where somebody sends a crash log or a
                 * config as often as a screenshot, so both arrive here the same
                 * way and the window draws the picture or offers the download.
                 */
                'file' => Files::url($message->file),
                'file_name' => Files::name($message->file),
                'file_size' => Files::size($message->file),
                'file_shown' => Files::drawable($message->file),
            ];

            /*
             * Whether it reached the desk, but only on the page that can do
             * anything about it. A customer told their own question has not
             * been passed on yet has been handed somebody else's problem.
             */
            if ($staffReads) {
                $row['pushed'] = $message->pushed();
            }

            $out[] = $row;
            $wasDay = $day;
            $wasWho = $who;
        }

        return $out;
    }

    /**
     * What to call a day on the separator between two of them.
     *
     * Today and yesterday by name, because that is how anybody reading a
     * conversation this morning thinks of it. Anything older gets its date, in
     * the reader's own language.
     */
    private static function dayName(?Carbon $at): string
    {
        if ($at === null) {
            return '';
        }

        try {
            if ($at->isToday()) {
                return Theme::trans('tickets.day_today');
            }

            if ($at->isYesterday()) {
                return Theme::trans('tickets.day_yesterday');
            }

            return $at->translatedFormat('j F Y');
        } catch (Throwable) {
            return '';
        }
    }

    /**
     * The conversation, oldest first.
     *
     * @return Collection<int, TicketMessage>
     */
    public static function messages(Ticket $ticket): Collection
    {
        try {
            return TicketMessage::query()
                ->where('ticket_id', (int) $ticket->id)
                ->orderBy('id')
                ->get();
        } catch (Throwable) {
            return new Collection();
        }
    }

    /**
     * This person's tickets, the ones still going first.
     *
     * @return Collection<int, Ticket>
     */
    public static function mine(int $userId, int $limit = 50): Collection
    {
        if (!self::ready() || $userId <= 0) {
            return new Collection();
        }

        try {
            return Ticket::query()
                ->where('user_id', $userId)
                ->orderByRaw("CASE WHEN state = 'closed' THEN 1 ELSE 0 END")
                ->orderByDesc('last_at')
                ->limit($limit)
                ->get();
        } catch (Throwable) {
            return new Collection();
        }
    }

    /**
     * This person's tickets about one service, the ones still going first.
     *
     * Its own query rather than mine() filtered afterwards: mine() takes fifty
     * rows before anything is filtered, so somebody with more tickets than that
     * would be told on a service page that they had never asked about a service
     * they had asked about twice.
     *
     * @return Collection<int, Ticket>
     */
    public static function about(int $userId, int $orderId, int $limit = 10): Collection
    {
        if (!self::ready() || $userId <= 0 || $orderId <= 0) {
            return new Collection();
        }

        try {
            return Ticket::query()
                ->where('user_id', $userId)
                ->where('order_id', $orderId)
                ->orderByRaw("CASE WHEN state = 'closed' THEN 1 ELSE 0 END")
                ->orderByDesc('last_at')
                ->limit($limit)
                ->get();
        } catch (Throwable) {
            return new Collection();
        }
    }

    /** How many are waiting on whoever runs the panel. */
    public static function waiting(): int
    {
        if (!self::ready()) {
            return 0;
        }

        try {
            return Ticket::query()->where('state', Ticket::OPEN)->count();
        } catch (Throwable) {
            return 0;
        }
    }

    /**
     * Something happened to the ticket, said in the conversation.
     *
     * A message rather than a log line, because it has to reach the channel as
     * well and the channel only takes messages. Flagged as a notice so both
     * windows draw it as what it is: an answer that never was one would tell a
     * customer somebody had replied when nobody had.
     *
     * Deliberately leaves `state` and `last_at` alone. Whose turn it is has not
     * changed because somebody put their name on it, and moving the row to the
     * top of a list sorted by "last thing said" would be saying it had.
     */
    private static function note(Ticket $ticket, ?User $who, string $body, bool $inside = false): void
    {
        $body = trim($body);

        if ($body === '') {
            return;
        }

        try {
            $message = new TicketMessage();

            $message->forceFill([
                'ticket_id' => (int) $ticket->id,
                'user_id' => $who === null ? null : (int) $who->id,
                'author' => mb_substr(
                    (string) ($who?->username ?? Theme::trans('tickets.someone')),
                    0,
                    191,
                ),
                'staff' => true,
                'notice' => true,
                'inside' => $inside,
                'body' => mb_substr($body, 0, 500),
            ])->save();
        } catch (Throwable $exception) {
            report($exception);

            return;
        }

        // An internal note is not sent anywhere. The channel is where the
        // customer can be, and a group is not their business.
        if ($inside) {
            return;
        }

        try {
            Desks::current()->say($ticket, $message);
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    /**
     * Tell whoever is now waiting.
     *
     * The customer gets a notification when somebody answers; the owner gets
     * one when a question arrives. Neither is told about their own message,
     * which is the sort of thing that makes people switch notifications off.
     */
    private static function told(Ticket $ticket, bool $staff): void
    {
        try {
            if ($staff) {
                $user = $ticket->user;

                if ($user instanceof User) {
                    Billing::answered($user, (string) $ticket->subject);
                }

                return;
            }

            Billing::trouble(
                Theme::trans('tickets.bell_asked', ['number' => '#' . (int) $ticket->id]),
                (string) $ticket->subject,
            );
        } catch (Throwable) {
            // The panel's own notifications table is not this plugin's to fix,
            // and a ticket that was recorded is not a failure because nobody
            // got a bell about it.
        }
    }
}
