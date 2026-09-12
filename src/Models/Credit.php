<?php

namespace LegendDevelopment\Theme\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LegendDevelopment\Theme\Support\Shop\Tables;

/**
 * One movement of money the shop holds for a customer.
 *
 * A ledger and not a balance. Every row is a thing that happened and no row is
 * ever edited: money put on the account is positive, money taken off it to
 * settle an invoice is negative, and what somebody has is the sum. That is a
 * deliberate refusal of the obvious design - a `balance` column on the customer
 * - because such a column is a second answer to a question the history already
 * answers, and the day the two disagree neither can be shown to be right.
 *
 * `amount` is minor units like every other figure in this shop, and it is the
 * one signed column the shop has.
 */
class Credit extends Model
{
    public const TABLE = Tables::CREDIT;

    /** Written back by an administrator, for whatever reason they gave. */
    public const GIVEN = 'given';

    protected $table = self::TABLE;

    protected $fillable = [
        'user_id',
        'amount',
        'currency',
        'reason',
        'invoice_id',
        'created_by',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'amount' => 'integer',
            'invoice_id' => 'integer',
            'created_by' => 'integer',
        ];
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** @return BelongsTo<Invoice, $this> */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    /** Money on, as opposed to money off. */
    public function added(): bool
    {
        return (int) $this->amount > 0;
    }
}
