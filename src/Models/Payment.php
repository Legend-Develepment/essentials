<?php

namespace LegendDevelopment\Theme\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * One attempt to pay an invoice through a provider.
 *
 * An invoice may have several of these - somebody who closed the Mollie tab and
 * came back an hour later has two - and at most one of them is paid. The pair
 * (gateway, gateway_id) is unique, which is what makes a webhook that arrives
 * twice find the row the first one made rather than make a second.
 *
 * `token` is this plugin's own handle for the attempt, put in the return
 * address a provider sends the customer back to. It says nothing about the
 * invoice and cannot be guessed from one.
 */
class Payment extends Model
{
    public const TABLE = 'essentials_payments';

    /** Started at the provider; nothing heard back yet. */
    public const OPEN = 'open';

    public const PAID = 'paid';

    public const FAILED = 'failed';

    public const CANCELLED = 'cancelled';

    protected $table = self::TABLE;

    protected $fillable = [
        'invoice_id',
        'gateway',
        'gateway_id',
        'token',
        'state',
        'amount',
        'currency',
        'raw',
        'paid_at',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'invoice_id' => 'integer',
            'amount' => 'integer',
            'raw' => 'array',
            'paid_at' => 'datetime',
        ];
    }

    /** @return BelongsTo<Invoice, $this> */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
