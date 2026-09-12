<?php

namespace LegendDevelopment\Theme\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A code that takes something off the first invoice.
 *
 * Two kinds: a whole percentage, or a fixed amount in minor units. Which
 * packages it applies to is a list of ids, or null for all of them. Uses are
 * counted when an order is placed with it, not when the invoice is paid - a
 * code that only counts on payment is a code that can be placed a hundred times
 * before anybody pays.
 */
class Coupon extends Model
{
    public const TABLE = 'essentials_coupons';

    public const PERCENT = 'percent';

    public const FIXED = 'fixed';

    protected $table = self::TABLE;

    protected $fillable = [
        'code',
        'kind',
        'value',
        'package_ids',
        'max_uses',
        'uses',
        'expires_at',
        'live',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'value' => 'integer',
            'package_ids' => 'array',
            'max_uses' => 'integer',
            'uses' => 'integer',
            'expires_at' => 'datetime',
            'live' => 'boolean',
        ];
    }

    /** Whether this code could be applied right now, to anything. */
    public function usable(): bool
    {
        if (!$this->live) {
            return false;
        }

        if ($this->expires_at !== null && $this->expires_at->isPast()) {
            return false;
        }

        return $this->max_uses === null || $this->uses < $this->max_uses;
    }

    /** Whether this code is good for one particular package. */
    public function covers(int $packageId): bool
    {
        $ids = $this->package_ids;

        if (!is_array($ids) || $ids === []) {
            return true;
        }

        return in_array($packageId, array_map('intval', $ids), true);
    }
}
