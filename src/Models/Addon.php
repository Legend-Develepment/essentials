<?php

namespace LegendDevelopment\Theme\Models;

use Illuminate\Database\Eloquent\Model;
use LegendDevelopment\Theme\Support\Shop\Tables;

/**
 * Something extra a customer can buy alongside a package.
 *
 * Two kinds, and the difference is what happens next month. One renews with the
 * service it hangs off, which is what a gigabyte of memory is: you keep paying
 * for it as long as you keep it. The other is charged once, which is what a
 * one-off setup or a migration is.
 *
 * **An addon does not have to change the server.** All seven of its limits may
 * be nought, and then it is a line on an invoice and nothing else - which is
 * exactly what "priority support" or "a subdomain" is. The limits are a delta
 * rather than a value: an addon says "and two thousand more megabytes", never
 * "memory is four thousand", because two of them bought together have to add up
 * and a pair of absolute values cannot.
 */
class Addon extends Model
{
    public const TABLE = Tables::ADDONS;

    /** Charged once, on the invoice that first carries it. */
    public const ONCE = 'once';

    /** Charged again every time the service it hangs off renews. */
    public const WITH = 'with';

    /** In the order the form offers them. */
    public const BILLING = [self::WITH, self::ONCE];

    /**
     * The limits an addon may move, and the keys Pelican knows them by.
     *
     * One list, walked by the form, the snapshot and the sum. A limit added
     * here and nowhere else is a limit the form offers and nothing applies.
     */
    public const LIMITS = [
        'memory',
        'swap',
        'disk',
        'cpu',
        'database_limit',
        'allocation_limit',
        'backup_limit',
    ];

    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'description',
        'price',
        'billing',
        'package_ids',
        'memory',
        'swap',
        'disk',
        'cpu',
        'database_limit',
        'allocation_limit',
        'backup_limit',
        'max',
        'live',
        'sort',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'package_ids' => 'array',
            'memory' => 'integer',
            'swap' => 'integer',
            'disk' => 'integer',
            'cpu' => 'integer',
            'database_limit' => 'integer',
            'allocation_limit' => 'integer',
            'backup_limit' => 'integer',
            'max' => 'integer',
            'live' => 'boolean',
            'sort' => 'integer',
        ];
    }

    /** Whether it comes back on every renewal. */
    public function recurring(): bool
    {
        return $this->billing !== self::ONCE;
    }

    /**
     * Whether this addon may be bought with that package.
     *
     * An empty list means any package, which is what a support option or a
     * backup slot usually is. A list names the ones it fits.
     */
    public function fits(int $packageId): bool
    {
        $only = is_array($this->package_ids) ? $this->package_ids : [];

        return $only === [] || in_array($packageId, array_map('intval', $only), true);
    }

    /** Whether it moves anything on the server at all. */
    public function changesServer(): bool
    {
        foreach (self::LIMITS as $limit) {
            if ((int) $this->{$limit} !== 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * What it adds, as the keys Pelican uses.
     *
     * Snapshotted onto the order when it is bought, so an addon edited next
     * year does not change what somebody already has.
     *
     * @return array<string, int>
     */
    public function deltas(): array
    {
        $out = [];

        foreach (self::LIMITS as $limit) {
            $out[$limit] = (int) $this->{$limit};
        }

        return $out;
    }
}
