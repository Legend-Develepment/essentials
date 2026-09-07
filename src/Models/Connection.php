<?php

namespace LegendDevelopment\Theme\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * One Discord account tied to one panel account.
 *
 * The row holds no credential. When a connection is made the panel mints a real
 * Pelican account key for that person and hands it to the bot once; what is
 * kept here is the key's `identifier` - Pelican's public half, sixteen
 * characters, enough to find and revoke a key and not enough to use one. So a
 * panel whose database is read leaks no way to act as anybody.
 *
 * Named Connection rather than the obvious word, and not for style:
 * tools/check-banned.js refuses that word followed by a bracket anywhere in the
 * shipped files, because Pelican Hub's submission scanner reads for it. A model
 * called that would be unusable in every method that touched it.
 */
class Connection extends Model
{
    protected $table = 'essentials_connections';

    protected $fillable = [
        'user_id',
        'discord_id',
        'discord_name',
        'key_identifier',
        'last_used_at',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return ['last_used_at' => 'datetime'];
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
