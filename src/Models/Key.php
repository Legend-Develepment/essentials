<?php

namespace LegendDevelopment\Theme\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * One API key, or the request that has not become one yet.
 *
 * Named `Key` rather than `ApiKey` on purpose. Pelican has an `App\Models\ApiKey`
 * of its own and step three of roadmap/api.md will hold one beside this in the
 * same file - two classes with one short name is the exact shape
 * tools/check-classes.js exists to catch, and the cheapest time to avoid it is
 * before either of them is written.
 *
 * There is no secret on this model. `token` is a SHA-256 of what was handed out
 * once and never stored; `prefix` is the public half. Everything here can be
 * shown in a list without showing anybody a working key.
 */
class Key extends Model
{
    /** Waiting for somebody to say yes or no. */
    public const PENDING = 'pending';

    /** Granted, and answering. */
    public const ACTIVE = 'active';

    /** Asked for and turned down. It stays, so the answer stays with it. */
    public const REFUSED = 'refused';

    /** Granted and then taken away. Also stays: revocation is a fact worth keeping. */
    public const REVOKED = 'revoked';

    /**
     * Answers only for its owner, scoped by accessibleServers() on every
     * request. The only scope a person may ask for.
     */
    public const PERSON = 'person';

    /**
     * Answers the panel-wide questions - nodes, capacity, the watchdog. Only
     * somebody holding this plugin's API permission may issue one.
     */
    public const PANEL = 'panel';

    protected $table = 'essentials_api_keys';

    protected $fillable = [
        'user_id',
        'name',
        'scope',
        'state',
        'prefix',
        'token',
        'reason',
        'answer',
        'allowed_ips',
        'abilities',
        'rate',
        'last_used_at',
        'expires_at',
        'decided_at',
        'decided_by',
    ];

    /**
     * Hidden as well as unusable.
     *
     * The hash cannot be turned back into a key, so this is not what keeps
     * anybody safe - it keeps the column out of anything that serialises a
     * model without thinking, which over a long enough time is everything.
     *
     * @var array<int, string>
     */
    protected $hidden = ['token'];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'allowed_ips' => 'array',
            'abilities' => 'array',
            'last_used_at' => 'datetime',
            'expires_at' => 'datetime',
            'decided_at' => 'datetime',
        ];
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** @return BelongsTo<User, $this> */
    public function decider(): BelongsTo
    {
        return $this->belongsTo(User::class, 'decided_by');
    }

    /**
     * Whether this key was granted one particular ability.
     *
     * A key with nothing recorded may do everything its scope allows, which is
     * what every key issued before this column existed has - they were granted
     * when there was nothing to narrow, so narrowing them retroactively would
     * break bots that were working correctly.
     *
     * A key with a list may do what is on it and nothing else, including
     * abilities added in a later release. That asymmetry is the point: a
     * capability nobody ticked is a capability nobody granted.
     */
    public function may(string $ability): bool
    {
        $granted = $this->abilities;

        if (!is_array($granted) || $granted === []) {
            return true;
        }

        return in_array($ability, $granted, true);
    }

    /**
     * Whether this key would answer a request made right now.
     *
     * Expiry is checked here rather than in a scope, because the one caller
     * that matters has already found the row by its prefix and a scope would
     * mean asking the database a second question about a row it is holding.
     */
    public function usable(): bool
    {
        if ($this->state !== self::ACTIVE) {
            return false;
        }

        return $this->expires_at === null || $this->expires_at->isFuture();
    }
}
