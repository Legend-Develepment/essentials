<?php

namespace LegendDevelopment\Theme\Models;

use App\Models\Egg;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * A server somebody can buy: the template it is made from, and the price.
 *
 * The template half is the same set of fields Pelican's own ServerCreationService
 * reads - see Duplicate::COPIED - so that making a server from a package is the
 * same call as making a copy of one. The price half is a number of minor units,
 * a currency the panel sets once, and a period.
 *
 * Nothing here is a server. A package is what a server would be; an Order is
 * the one that was actually made, and it carries its own copy of this row as
 * it stood at the time.
 */
class Package extends Model
{
    public const TABLE = 'essentials_packages';

    /** Paid once, kept for good. */
    public const ONCE = 'once';

    public const MONTH = 'month';

    public const QUARTER = 'quarter';

    public const YEAR = 'year';

    /** In the order the form offers them. */
    public const PERIODS = [self::ONCE, self::MONTH, self::QUARTER, self::YEAR];

    /** A contract counted in days. */
    public const DAY = 'day';

    /** In months. */
    public const MONTH_TERM = 'month';

    /** In years. */
    public const YEAR_TERM = 'year';

    /**
     * What a contract length can be counted in.
     *
     * Deliberately not the billing periods above: a package can be billed
     * monthly on a twelve-month contract, and a term measured in quarters is a
     * sentence nobody says out loud.
     */
    public const TERM_UNITS = [self::DAY, self::MONTH_TERM, self::YEAR_TERM];

    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'egg_id',
        'image',
        'startup',
        'memory',
        'swap',
        'disk',
        'io',
        'cpu',
        'threads',
        'oom_killer',
        'database_limit',
        'allocation_limit',
        'backup_limit',
        'environment',
        'node_ids',
        'price',
        'setup_fee',
        'period',
        'stock',
        'live',
        'sort',
        'term',
        'term_unit',
        'art_path',
        'art_url',
        'ask_vars',
        'upload_ask',
        'upload_label',
        'upload_dir',
        'upload_extract',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'egg_id' => 'integer',
            'memory' => 'integer',
            'swap' => 'integer',
            'disk' => 'integer',
            'io' => 'integer',
            'cpu' => 'integer',
            'oom_killer' => 'boolean',
            'database_limit' => 'integer',
            'allocation_limit' => 'integer',
            'backup_limit' => 'integer',
            'environment' => 'array',
            'node_ids' => 'array',
            'price' => 'integer',
            'setup_fee' => 'integer',
            'stock' => 'integer',
            'live' => 'boolean',
            'sort' => 'integer',
            'term' => 'integer',
            'ask_vars' => 'array',
            'upload_ask' => 'boolean',
            'upload_extract' => 'boolean',
        ];
    }

    /** @return BelongsTo<Egg, $this> */
    public function egg(): BelongsTo
    {
        return $this->belongsTo(Egg::class, 'egg_id');
    }

    /** @return HasMany<Order, $this> */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'package_id');
    }

    /** Whether this bills again after the first payment. */
    public function recurring(): bool
    {
        return $this->period !== self::ONCE;
    }

    /**
     * Whether a server could be made from this right now - which is a
     * different question from whether it is offered for sale.
     */
    public function buildable(): bool
    {
        return $this->egg_id !== null;
    }

    /** Whether the customer is asked for a file when they buy this. */
    public function wantsUpload(): bool
    {
        return (bool) $this->upload_ask;
    }

    /**
     * The egg variables the customer fills in, by env name.
     *
     * @return array<int, string>
     */
    public function asked(): array
    {
        $names = is_array($this->ask_vars) ? $this->ask_vars : [];

        return array_values(array_filter(array_map(
            static fn ($name): string => trim((string) $name),
            $names,
        ), static fn (string $name): bool => $name !== ''));
    }

    /** Whether this package ties somebody in at all. */
    public function hasTerm(): bool
    {
        return (int) $this->term > 0 && in_array($this->term_unit, self::TERM_UNITS, true);
    }
}
