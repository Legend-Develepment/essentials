<?php

namespace LegendDevelopment\Theme\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LegendDevelopment\Theme\Support\Tickets\Tables as TicketTables;

/**
 * One thing said in a ticket.
 *
 * Written here before it is sent anywhere, always. A failed HTTP call must
 * never lose somebody's question - the same rule Gateways::remember() follows
 * for a payment, and for the same reason: the thing the customer did is the
 * thing that has to survive.
 *
 * `author` is a snapshot rather than a join. A message from staff on Discord
 * has no account in this panel at all, and one from a customer who renames
 * themselves next year should still read the way the conversation read.
 *
 * The two remote ids are both kept because Modora hands back both and they mean
 * different things: `remote` is the message in their system, `discord_id` is
 * the message in the channel. Keeping only one of them makes the other
 * unanswerable later.
 */
class TicketMessage extends Model
{
    public const TABLE = TicketTables::MESSAGES;

    protected $table = self::TABLE;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'author',
        'staff',
        'notice',
        'inside',
        'body',
        'remote',
        'discord_id',
        'sent_at',
        'file',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'ticket_id' => 'integer',
            'user_id' => 'integer',
            'staff' => 'boolean',
            'notice' => 'boolean',
            'inside' => 'boolean',
            'sent_at' => 'datetime',
            'file' => 'array',
        ];
    }

    /** @return BelongsTo<Ticket, $this> */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Whether it has reached the desk that answers it.
     *
     * Either half is enough. `remote` is how it is recognised coming back;
     * `sent_at` is only whether it went. A desk that took the message but
     * named its id in a way this release cannot read has still taken it, and
     * sending it again would put it in the channel twice.
     */
    public function pushed(): bool
    {
        return trim((string) ($this->remote ?? '')) !== '' || $this->sent_at !== null;
    }
}
