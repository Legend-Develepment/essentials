<?php

namespace LegendDevelopment\Theme\Models;

use App\Models\Server;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * One package somebody bought, and the server it became.
 *
 * It carries its own copy of the package in `spec`, taken at the moment of
 * purchase. A package is edited after it is sold - the price changes, a limit
 * comes down - and the server somebody paid for is the one they were shown.
 *
 * Four states, and they are about the money rather than about the server:
 *
 *   pending    paid for or not yet, but no server exists for it
 *   active     the server exists and the account is in good standing
 *   suspended  this plugin suspended the server because an invoice was not paid
 *   cancelled  finished, by the customer or the administrator; never renews
 *
 * Whether the server is running is Pelican's question, not this one's.
 */
class Order extends Model
{
    public const TABLE = 'essentials_orders';

    public const PENDING = 'pending';

    public const ACTIVE = 'active';

    public const SUSPENDED = 'suspended';

    public const CANCELLED = 'cancelled';

    /** The states in which an order still holds a place in a package's stock. */
    public const OCCUPYING = [self::PENDING, self::ACTIVE, self::SUSPENDED];

    protected $table = self::TABLE;

    protected $fillable = [
        'user_id',
        'package_id',
        'server_id',
        'state',
        'spec',
        'period',
        'price',
        'setup_fee',
        'currency',
        'next_due_at',
        'provisioned_at',
        'suspended_at',
        'cancelled_at',
        'note',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'package_id' => 'integer',
            'server_id' => 'integer',
            'spec' => 'array',
            'price' => 'integer',
            'setup_fee' => 'integer',
            'next_due_at' => 'datetime',
            'provisioned_at' => 'datetime',
            'suspended_at' => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** @return BelongsTo<Package, $this> */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    /** @return BelongsTo<Server, $this> */
    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class, 'server_id');
    }

    /** @return HasMany<Invoice, $this> */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'order_id');
    }

    public function recurring(): bool
    {
        return $this->period !== Package::ONCE;
    }

    /** Whether this order still counts against its package's stock. */
    public function occupiesStock(): bool
    {
        return in_array($this->state, self::OCCUPYING, true);
    }
}
