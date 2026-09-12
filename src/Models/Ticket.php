<?php

namespace LegendDevelopment\Theme\Models;

use App\Models\Role;
use App\Models\Server;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use LegendDevelopment\Theme\Support\Tickets\Tables as TicketTables;

/**
 * One question somebody asked.
 *
 * **It is always kept here**, whichever desk answers it. A ticket that lives
 * only in somebody else's system is a ticket this panel cannot show, cannot
 * search and loses the day that system is unreachable - and the whole point of
 * asking from inside the panel is that the answer is where the server is.
 *
 * `remote` is the same ticket at the far end, when there is a far end. Null
 * means either the panel is answering its own tickets or the push has not gone
 * through yet, and those two are deliberately the same shape: the question is
 * recorded either way and pushing is something that can be tried again.
 *
 * **A ticket may name a service.** That is the one thing a chat channel cannot
 * do and the reason this exists at all: "my server will not start" is a
 * different question when the shop knows which server.
 */
class Ticket extends Model
{
    public const TABLE = TicketTables::TICKETS;

    /** Waiting on whoever runs the panel. */
    public const OPEN = 'open';

    /** Answered, and waiting on the customer. */
    public const ANSWERED = 'answered';

    public const CLOSED = 'closed';

    public const LOW = 'low';

    public const NORMAL = 'normal';

    public const HIGH = 'high';

    /** In the order the form offers them. */
    public const PRIORITIES = [self::LOW, self::NORMAL, self::HIGH];

    protected $table = self::TABLE;

    protected $fillable = [
        'user_id',
        'order_id',
        'server_id',
        'subject',
        'state',
        'priority',
        'remote',
        'remote_number',
        'claim_url',
        'claimed_by',
        'role_id',
        'last_at',
        'closed_at',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'order_id' => 'integer',
            'server_id' => 'integer',
            'claimed_by' => 'integer',
            'role_id' => 'integer',
            'last_at' => 'datetime',
            'closed_at' => 'datetime',
        ];
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** @return BelongsTo<Order, $this> */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /** @return BelongsTo<Server, $this> */
    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class, 'server_id');
    }

    /**
     * Whoever picked it up.
     *
     * Null is the normal state and not an omission: most tickets are answered
     * by whoever reads them first, and claiming is for the ones where two
     * people would otherwise both start typing.
     *
     * @return BelongsTo<User, $this>
     */
    public function claimer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'claimed_by');
    }

    /**
     * The group it belongs to, which is a role.
     *
     * Pelican has no notion of a team, and inventing a second list of them
     * beside the roles would be two lists to keep in step for no gain: the
     * people who answer billing questions are already a role, because that is
     * how they were given the permission to.
     *
     * @return BelongsTo<Role, $this>
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /** @return HasMany<TicketMessage, $this> */
    public function messages(): HasMany
    {
        return $this->hasMany(TicketMessage::class, 'ticket_id');
    }

    public function closed(): bool
    {
        return $this->state === self::CLOSED;
    }

    /** Whether anybody is still expected to do anything about it. */
    public function live(): bool
    {
        return !$this->closed();
    }

    /** Whether it also exists somewhere else. */
    public function pushed(): bool
    {
        return trim((string) ($this->remote ?? '')) !== '';
    }

    /**
     * What to call it, so both sides say the same thing.
     *
     * The far end's own number where there is one, because that is what is
     * written on the Discord channel and what staff will quote back. Ours
     * otherwise. Not the remote id: that counts across the whole of Modora and
     * is nobody's idea of a ticket number.
     */
    /** Whether somebody has put their name on it. */
    public function claimed(): bool
    {
        return (int) ($this->claimed_by ?? 0) > 0;
    }

    public function number(): string
    {
        $theirs = trim((string) ($this->remote_number ?? ''));

        return $theirs !== '' ? '#' . $theirs : '#' . (int) $this->id;
    }
}
