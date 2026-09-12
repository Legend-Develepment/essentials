<?php

namespace LegendDevelopment\Theme\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LegendDevelopment\Theme\Support\Shop\Tables;

/**
 * One service moving from one package to another.
 *
 * A row of its own rather than a note on the order, for two reasons that both
 * come down to time. An upgrade that costs money is agreed now and applied when
 * the invoice is paid, which may be tomorrow; something has to hold what was
 * agreed in between. And a service that has been three different packages has a
 * history worth keeping, because "why is this server smaller than the invoice
 * says" is a question somebody eventually asks.
 *
 * `amount` is signed, like the credit ledger: positive is money owed for a
 * bigger package, negative is money given back for a smaller one.
 */
class Upgrade extends Model
{
    public const TABLE = Tables::UPGRADES;

    /** Agreed, waiting on an invoice that has not been paid. */
    public const PENDING = 'pending';

    /** Done: the order carries the new package and the server the new limits. */
    public const APPLIED = 'applied';

    /**
     * Paid for and not applied.
     *
     * The one state that needs somebody. It means the money moved and the
     * server did not, which is a thing to fix rather than a thing to log - so
     * the order carries the reason and the owner is rung.
     */
    public const REFUSED = 'refused';

    protected $table = self::TABLE;

    protected $fillable = [
        'order_id',
        'invoice_id',
        'from_package_id',
        'to_package_id',
        'amount',
        'currency',
        'state',
        'note',
        'applied_at',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'order_id' => 'integer',
            'invoice_id' => 'integer',
            'from_package_id' => 'integer',
            'to_package_id' => 'integer',
            'amount' => 'integer',
            'applied_at' => 'datetime',
        ];
    }

    /** @return BelongsTo<Order, $this> */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /** @return BelongsTo<Invoice, $this> */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    /** @return BelongsTo<Package, $this> */
    public function to(): BelongsTo
    {
        return $this->belongsTo(Package::class, 'to_package_id');
    }

    /** A bigger package, as opposed to a smaller one. */
    public function costs(): bool
    {
        return (int) $this->amount > 0;
    }
}
