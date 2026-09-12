<?php

namespace LegendDevelopment\Theme\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LegendDevelopment\Theme\Support\Shop\Tables;

/**
 * Somebody who asked to be told when a package is for sale again.
 *
 * **A row with nothing on it but who and what.** No state, no "have they been
 * told", no held place, no position in a queue: the row is deleted at the
 * moment it is answered, so there is never anything to record about it. Being
 * told, buying it, leaving, losing the account or the package going all end the
 * same way, and that is the whole of the housekeeping.
 *
 * Which also means one join buys exactly one notification, ever. A list that
 * kept its rows would tell the same people about every restock for as long as
 * they existed, and that is how a bell stops being read.
 */
class Waitlist extends Model
{
    public const TABLE = Tables::WAITLIST;

    protected $table = self::TABLE;

    protected $fillable = [
        'package_id',
        'user_id',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'package_id' => 'integer',
            'user_id' => 'integer',
        ];
    }

    /** @return BelongsTo<Package, $this> */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
