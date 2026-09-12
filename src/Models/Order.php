<?php

namespace LegendDevelopment\Theme\Models;

use App\Models\Server;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use LegendDevelopment\Theme\Support\Shop\Tables;

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

    /**
     * Notice given, still running.
     *
     * Cancelling does not stop a service - it says when it will stop. An order
     * sits here from the moment somebody cancels until its contract runs out,
     * and only then is the server removed. That is the difference between
     * ending an agreement and taking somebody's files away, and the two used
     * to be the same button.
     */
    public const ENDING = 'ending';

    /** Ended by the person who was paying for it. */
    public const BY_CUSTOMER = 'customer';

    /** Ended by somebody with the run of the panel. */
    public const BY_ADMIN = 'admin';

    public const CANCELLED = 'cancelled';

    /** The states in which an order still holds a place in a package's stock. */
    public const OCCUPYING = [self::PENDING, self::ACTIVE, self::SUSPENDED, self::ENDING];

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
        'cancelled_by',
        'ends_at',
        'extras',
        'upload_path',
        'delivered_at',
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
            'ends_at' => 'datetime',
            'extras' => 'array',
            'delivered_at' => 'datetime',
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

    /**
     * The invoices that name this order in order_id.
     *
     * Which is not the same as every invoice that bills it - see billedOn().
     * An order bought in a basket is one of several on its first invoice, and
     * only one of them is the one order_id points at.
     *
     * @return HasMany<Invoice, $this>
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'order_id');
    }

    /**
     * Every invoice that bills this order, basket and renewals alike.
     *
     * @return BelongsToMany<Invoice, $this>
     */
    public function billedOn(): BelongsToMany
    {
        return $this->belongsToMany(Invoice::class, Tables::INVOICE_ORDERS, 'order_id', 'invoice_id')
            ->withPivot('amount')
            ->withTimestamps();
    }

    /**
     * The extras bought with this service.
     *
     * @return HasMany<OrderAddon, $this>
     */
    public function addons(): HasMany
    {
        return $this->hasMany(OrderAddon::class, 'order_id');
    }

    public function recurring(): bool
    {
        return $this->period !== Package::ONCE;
    }

    /** Notice given, and the day it actually stops has not arrived. */
    public function ending(): bool
    {
        return $this->state === self::ENDING;
    }

    /** Whether this order still counts against its package's stock. */
    public function occupiesStock(): bool
    {
        return in_array($this->state, self::OCCUPYING, true);
    }
}
