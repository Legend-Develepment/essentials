<?php

namespace LegendDevelopment\Theme\Support\Api;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use LegendDevelopment\Theme\Models\Key;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Making, granting, checking and taking away an API key.
 *
 * Everything that touches the secret is in here, and there is not much of it -
 * which is the point. A key is generated once, hashed, and the plain text is
 * returned to exactly one caller and never stored. Every other part of the
 * plugin sees a row with a prefix on it.
 *
 * **The shape of the key.** `esk_<prefix>_<secret>`. The prefix is a public
 * name for the row: it is unique, it is indexed, and it is what a list shows so
 * somebody can tell two of their own keys apart. The secret is the half that
 * proves anything. Splitting them means verifying a key is one indexed read and
 * one hash, rather than a walk through every row hashing as it goes - which is
 * a difference nobody notices at ten keys and everybody notices at four
 * hundred.
 *
 * **What is deliberately not here.** Nothing starts, stops or reaches a server.
 * roadmap/api.md has the argument: Pelican's own client API already does that,
 * already checks subuser permissions and already writes the activity log, so a
 * second one here would be a second thing to get right and then keep right.
 */
class Keys
{
    /** How the key is recognisable at a glance, in a log or a support ticket. */
    private const MARK = 'esk';

    private const PREFIX_LENGTH = 12;

    private const SECRET_LENGTH = 40;

    /**
     * Whether the API answers at all.
     *
     * Both halves have to be true: the feature switch, like every other feature
     * in this plugin, and a route that only exists when it is on. A panel that
     * has not asked for an API does not get one listening.
     */
    public static function enabled(): bool
    {
        try {
            return Features::enabled(Features::API);
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * Whether a person's request waits for somebody to say yes.
     *
     * On by default, and that default is the whole reason this is a setting. A
     * panel where anybody may mint themselves a key the moment they sign in is
     * a reasonable thing to want and a terrible thing to arrive at without
     * having chosen it.
     */
    public static function approvalNeeded(): bool
    {
        return (bool) Theme::config('api_approval', true);
    }

    /** Requests a minute, per key. Held between one and a thousand. */
    public static function rate(): int
    {
        return max(1, min(1000, (int) Theme::config('api_rate', 60)));
    }

    /**
     * How long a granted key lasts, in days. Zero means until somebody revokes
     * it, which is the honest default: a key that expires while nobody is
     * watching is a bot that stops overnight with no message anywhere.
     */
    public static function lifetime(): int
    {
        return max(0, min(3650, (int) Theme::config('api_days', 0)));
    }

    /**
     * Somebody asks for one.
     *
     * A row with no secret in it. It is not a key yet and cannot be used as
     * one - `token` is null, so nothing can ever match it on the way in, which
     * is a stronger statement than a state column alone would make.
     */
    public static function ask(User $user, string $name, string $reason = ''): Key
    {
        return Key::query()->create([
            'user_id' => $user->id,
            'name' => Str::limit(trim($name), 60, ''),
            'scope' => Key::PERSON,
            'state' => Key::PENDING,
            'prefix' => self::freshPrefix(),
            'token' => null,
            'reason' => Str::limit(trim($reason), 500, ''),
        ]);
    }

    /**
     * Yes.
     *
     * Returns the plain key, once. There is no second chance to read it and no
     * way to recover it from the row, which is worth saying on the page that
     * shows it rather than leaving somebody to find out by closing a dialog.
     */
    public static function grant(Key $key, User $by): string
    {
        $secret = Str::random(self::SECRET_LENGTH);
        $plain = self::MARK . '_' . $key->prefix . '_' . $secret;
        $days = self::lifetime();

        $key->forceFill([
            'token' => hash('sha256', $plain),
            'state' => Key::ACTIVE,
            'answer' => null,
            'decided_at' => Carbon::now(),
            'decided_by' => $by->id,
            'expires_at' => $days === 0 ? null : Carbon::now()->addDays($days),
        ])->save();

        return $plain;
    }

    /** No, with a reason the person can read on their own page. */
    public static function refuse(Key $key, User $by, string $answer = ''): void
    {
        $key->forceFill([
            'state' => Key::REFUSED,
            'token' => null,
            'answer' => Str::limit(trim($answer), 500, ''),
            'decided_at' => Carbon::now(),
            'decided_by' => $by->id,
        ])->save();
    }

    /**
     * Taken away.
     *
     * The hash goes with it. A revoked key that kept its hash would still match
     * on the way in and be turned away by a state check - which is one check
     * away from working, and the wrong number of checks away for the thing that
     * decides whether somebody still has access.
     */
    public static function revoke(Key $key): void
    {
        $key->forceFill([
            'state' => Key::REVOKED,
            'token' => null,
        ])->save();
    }

    /**
     * A key an administrator makes directly, for a bot rather than a person.
     *
     * Granted the moment it is made, because the person making it is the person
     * who would approve it - a request they then answer themselves is a form
     * with an extra page in it.
     */
    public static function mint(User $owner, string $name, string $scope): string
    {
        $key = Key::query()->create([
            'user_id' => $owner->id,
            'name' => Str::limit(trim($name), 60, ''),
            'scope' => $scope === Key::PANEL ? Key::PANEL : Key::PERSON,
            'state' => Key::PENDING,
            'prefix' => self::freshPrefix(),
            'token' => null,
        ]);

        return self::grant($key, $owner);
    }

    /**
     * The key a request is carrying, or nothing.
     *
     * Answers null for every kind of failure without saying which: a malformed
     * header, a prefix that does not exist, a secret that does not match, a key
     * that was revoked this morning, one that expired, one whose owner is gone,
     * or the whole feature being switched off. The caller turns all of them
     * into the same 401, because telling somebody which of those it was is
     * telling them which half of a key they got right.
     */
    public static function verify(?string $presented): ?Key
    {
        if (!self::enabled() || $presented === null) {
            return null;
        }

        $parts = explode('_', trim($presented));

        if (count($parts) !== 3 || $parts[0] !== self::MARK) {
            return null;
        }

        try {
            /** @var Key|null $key */
            $key = Key::query()->with('user')->where('prefix', $parts[1])->first();
        } catch (Throwable) {
            // A database that cannot be read is not an open door.
            return null;
        }

        if ($key === null || $key->token === null || !$key->usable() || $key->user === null) {
            return null;
        }

        /*
         * hash_equals rather than ===. The comparison is against a hash of what
         * was sent, so an attacker cannot steer it by content - but the whole
         * reason this codebase has a rule about reading before guessing is that
         * "cannot" in security is usually "have not thought of how", and the
         * safe version costs one function name.
         */
        if (!hash_equals($key->token, hash('sha256', $presented))) {
            return null;
        }

        return $key;
    }

    /**
     * Note that a key was used, at most once a minute.
     *
     * A write on every request turns a read-only API into one that writes to
     * the same row every time a bot polls, which on a busy panel is the most
     * contended row in the table. A minute is fine: this column answers "is
     * this key still in use", not "when exactly".
     */
    public static function touch(Key $key): void
    {
        try {
            $last = $key->last_used_at;

            if ($last !== null && $last->diffInSeconds(Carbon::now()) < 60) {
                return;
            }

            $key->forceFill(['last_used_at' => Carbon::now()])->saveQuietly();
        } catch (Throwable) {
            // Never fail a request over bookkeeping.
        }
    }

    /**
     * A prefix nothing else is using.
     *
     * Collisions are not the risk a retry is guarding against - twelve random
     * characters will not collide - so it gives up after a few tries rather
     * than looping: a unique index that keeps refusing means something is wrong
     * that another attempt will not fix.
     */
    private static function freshPrefix(): string
    {
        for ($attempt = 0; $attempt < 5; $attempt++) {
            $prefix = Str::lower(Str::random(self::PREFIX_LENGTH));

            if (!Key::query()->where('prefix', $prefix)->exists()) {
                return $prefix;
            }
        }

        return Str::lower(Str::random(self::PREFIX_LENGTH));
    }
}
