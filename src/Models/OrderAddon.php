<?php

namespace LegendDevelopment\Theme\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LegendDevelopment\Theme\Support\Shop\Tables;

/**
 * One addon somebody actually has, on one service.
 *
 * A snapshot rather than a pointer, for the same reason an order carries its
 * package in `spec`: the addon is edited after it is sold - the price goes up,
 * a limit changes - and what somebody pays for is what they were shown. The
 * addon row is still named so the shop knows they are the same thing, and it
 * may go without taking this with it.
 *
 * `spec` is what it adds to the server, taken at the moment of purchase. It is
 * what Servers::resize() is handed, so a gigabyte bought last year stays a
 * gigabyte when the addon behind it is edited to two.
 */
class OrderAddon extends Model
{
    public const TABLE = Tables::ORDER_ADDONS;

    protected $table = self::TABLE;

    protected $fillable = [
        'order_id',
        'addon_id',
        'name',
        'price',
        'billing',
        'quantity',
        'spec',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'order_id' => 'integer',
            'addon_id' => 'integer',
            'price' => 'integer',
            'quantity' => 'integer',
            'spec' => 'array',
        ];
    }

    /** @return BelongsTo<Order, $this> */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /** @return BelongsTo<Addon, $this> */
    public function addon(): BelongsTo
    {
        return $this->belongsTo(Addon::class, 'addon_id');
    }

    /** What this line costs each time it is charged. */
    public function total(): int
    {
        return max(0, (int) $this->price) * max(1, (int) $this->quantity);
    }

    public function recurring(): bool
    {
        return $this->billing !== Addon::ONCE;
    }

    /**
     * What it adds to the server, times how many were bought.
     *
     * @return array<string, int>
     */
    public function deltas(): array
    {
        $spec = is_array($this->spec) ? $this->spec : [];
        $many = max(1, (int) $this->quantity);
        $out = [];

        foreach (Addon::LIMITS as $limit) {
            $out[$limit] = (int) ($spec[$limit] ?? 0) * $many;
        }

        return $out;
    }
}
