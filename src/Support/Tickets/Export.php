<?php

namespace LegendDevelopment\Theme\Support\Tickets;

use Illuminate\Support\Collection;
use LegendDevelopment\Theme\Models\Ticket;
use LegendDevelopment\Theme\Models\TicketMessage;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Every ticket, or every message in every ticket, as a CSV file.
 *
 * So the conversations a panel has had can leave it: for an accountant, a move
 * to another desk, or simply a copy kept somewhere else.
 *
 * **Read two hundred tickets at a time.** Each row is written out as soon as it
 * is built and the models behind it are let go, so a desk with years of history
 * never has all of its tickets in memory at once - only the text of the file.
 *
 * **The headings are not translated.** They are the names of the columns, the
 * same on every panel, so a script that reads one export reads the next.
 *
 * **Staff notes are included and marked.** Whoever may read tickets on the
 * panel already reads them there; leaving them out would make the export a
 * smaller copy of the truth rather than a copy of it.
 *
 * Written line by line with echo rather than through a stream handle, because
 * the package check refuses a plugin that names the file functions at all.
 */
final class Export
{
    public const TICKETS = 'tickets';

    public const MESSAGES = 'messages';

    private const CHUNK = 200;

    public static function download(string $what): StreamedResponse
    {
        $messages = $what === self::MESSAGES;
        $name = 'tickets-' . ($messages ? 'messages-' : '') . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(static function () use ($messages): void {
            // So a spreadsheet opens the file as UTF-8 rather than guessing,
            // which it gets wrong for every name with an accent in it.
            echo "\xEF\xBB\xBF";

            $messages ? self::messages() : self::tickets();
        }, $name, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    private static function tickets(): void
    {
        self::row([
            'number', 'id', 'subject', 'state', 'priority',
            'customer_id', 'customer_username', 'customer_email',
            'server_uuid', 'server_name', 'claimed_by',
            'opened_at', 'last_activity_at', 'closed_at', 'messages',
        ]);

        Ticket::query()
            ->with(['user', 'server', 'claimer'])
            ->withCount('messages')
            ->chunkById(self::CHUNK, static function (Collection $tickets): void {
                foreach ($tickets as $ticket) {
                    /** @var Ticket $ticket */
                    self::row([
                        $ticket->number(),
                        $ticket->id,
                        $ticket->subject,
                        $ticket->state,
                        $ticket->priority,
                        $ticket->user_id,
                        $ticket->user?->username,
                        $ticket->user?->email,
                        $ticket->server?->uuid,
                        $ticket->server?->name,
                        $ticket->claimer?->username,
                        $ticket->created_at?->toIso8601String(),
                        $ticket->last_at?->toIso8601String(),
                        $ticket->closed_at?->toIso8601String(),
                        $ticket->messages_count,
                    ]);
                }
            });
    }

    private static function messages(): void
    {
        self::row([
            'ticket_number', 'ticket_id', 'ticket_subject', 'message_id', 'written_at',
            'author', 'staff', 'staff_note', 'notice', 'body', 'attachment',
        ]);

        Ticket::query()->chunkById(self::CHUNK, static function (Collection $tickets): void {
            foreach ($tickets as $ticket) {
                /** @var Ticket $ticket */
                $ticket->messages()
                    ->with('user')
                    ->orderBy('id')
                    ->each(static function (TicketMessage $message) use ($ticket): void {
                        self::row([
                            $ticket->number(),
                            $ticket->id,
                            $ticket->subject,
                            $message->id,
                            $message->created_at?->toIso8601String(),
                            $message->user?->username ?? $message->author,
                            $message->staff ? 'yes' : 'no',
                            $message->inside ? 'yes' : 'no',
                            $message->notice ? 'yes' : 'no',
                            $message->body,
                            Files::name($message->file),
                        ]);
                    });
            }
        });
    }

    /**
     * One line of the file, quoted the way RFC 4180 quotes one.
     *
     * A cell holding a comma, a quote or a line break is wrapped in quotes with
     * its own quotes doubled; anything else goes out as it is.
     *
     * @param  array<int, mixed>  $cells
     */
    private static function row(array $cells): void
    {
        echo implode(',', array_map(static function (mixed $cell): string {
            $text = self::cell($cell);

            return strpbrk($text, ",\"\r\n") === false
                ? $text
                : '"' . str_replace('"', '""', $text) . '"';
        }, $cells)) . "\r\n";
    }

    /**
     * One cell, safe to open in a spreadsheet.
     *
     * A cell that starts with =, +, - or @ is read as a formula by every
     * spreadsheet, and a subject or a message is typed by a customer. Such a
     * cell gets a leading apostrophe, which the spreadsheet shows as text and
     * which costs a script reading the file one character.
     */
    private static function cell(mixed $cell): string
    {
        $text = $cell === null ? '' : (string) $cell;

        return $text !== '' && in_array($text[0], ['=', '+', '-', '@', "\t", "\r"], true)
            ? "'" . $text
            : $text;
    }
}
