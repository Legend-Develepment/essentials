<?php

namespace LegendDevelopment\Theme\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * What somebody owes, or paid.
 *
 * Every amount is minor units and every amount is a snapshot: the lines, the
 * tax rate, the currency and the customer's name are copied in when the
 * invoice is made, because a document that changes after it was issued is not
 * a document. Editing the package, changing the tax rate, renaming the account
 * - none of it reaches an invoice already written.
 *
 * Three states. `unpaid` is the only one that can change on its own; `paid`
 * and `cancelled` are final, and a paid invoice is never cancelled - a refund
 * is a separate record and a later release.
 */
class Invoice extends Model
{
    public const TABLE = 'essentials_invoices';

    /** The first invoice for an order: the package, and any setup fee. */
    public const ORDER = 'order';

    /** One period more of the same. */
    public const RENEWAL = 'renewal';

    public const UNPAID = 'unpaid';

    public const PAID = 'paid';

    public const CANCELLED = 'cancelled';

    /** Marked paid by hand, on the admin page. */
    public const MANUAL = 'manual';

    protected $table = self::TABLE;

    protected $fillable = [
        'number',
        'user_id',
        'order_id',
        'kind',
        'state',
        'subtotal',
        'discount',
        'tax',
        'total',
        'tax_rate',
        'currency',
        'coupon_code',
        'lines',
        'customer_name',
        'customer_email',
        'due_at',
        'paid_at',
        'paid_via',
        'emailed_at',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'order_id' => 'integer',
            'subtotal' => 'integer',
            'discount' => 'integer',
            'tax' => 'integer',
            'total' => 'integer',
            'tax_rate' => 'integer',
            'lines' => 'array',
            'due_at' => 'datetime',
            'paid_at' => 'datetime',
            'emailed_at' => 'datetime',
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

    /** @return HasMany<Payment, $this> */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'invoice_id');
    }

    public function paid(): bool
    {
        return $this->state === self::PAID;
    }

    public function open(): bool
    {
        return $this->state === self::UNPAID;
    }

    /** Past due and still unpaid. */
    public function overdue(): bool
    {
        return $this->open() && $this->due_at !== null && $this->due_at->isPast();
    }
}
