<?php

namespace LegendDevelopment\Theme\Support\Api;

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
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

    /** The one table this plugin owns. */
    public const TABLE = 'essentials_api_keys';

    /**
     * Make the table, at install, every time.
     *
     * **Not a migration, and that is this plugin's own rule rather than a
     * preference.** The migration beside it has said so since it was written:
     * installing is the seeder's work, because a seeder runs on every install
     * while a migration's up() is recorded and skipped the second time round.
     * Putting the table in a migration ignored that and cost three broken
     * releases - a load error, a foreign key MySQL would not accept, and then a
     * table left standing by the half-run attempt, each one only visible once
     * the one before it was gone.
     *
     * The deeper problem was never any of those three. It was that the panel
     * ended up in a state the code could not talk itself out of: the table
     * existed, the migration was not recorded, and every retry ran the one path
     * that could not cope with either fact. Run at install and asking first,
     * there is no such state - the answer to "is it there" is looked up rather
     * than assumed, on every install, for ever.
     *
     * A table already there is left exactly as it is. It holds keys people are
     * using, and this is not the place to decide they should stop working.
     */
    public static function install(): void
    {
        if (Schema::hasTable(self::TABLE)) {
            return;
        }

        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->id();

            /*
             * unsignedInteger, not foreignId. Pelican's users table is
             * `increments`, which is int unsigned; foreignId() declares an
             * unsignedBigInteger, and MySQL refuses a foreign key between two
             * widths with nothing but "errno: 150". Its own migrations write it
             * out for the same reason - see create_passkeys_table.
             */
            $table->unsignedInteger('user_id');

            $table->string('name');

            // 'person' answers only for its owner; 'panel' answers the
            // panel-wide questions. A key cannot change scope - a wider one is
            // a new key, so widening is an act with a date on it.
            $table->string('scope')->default(Key::PERSON);

            $table->string('state')->default(Key::PENDING);

            // The public half: what a request arrives carrying, so the row is
            // found by one indexed read and only then is the hash compared.
            $table->string('prefix', 16)->unique();

            // SHA-256 of the whole key. Null while a request is pending,
            // because a key that has not been granted has not been generated.
            $table->string('token', 64)->nullable()->unique();

            $table->text('reason')->nullable();
            $table->text('answer')->nullable();

            $table->json('allowed_ips')->nullable();

            /*
             * What this key may ask about, and how often.
             *
             * `abilities` holds what is ALLOWED, which is the opposite of how
             * Features stores its switches and is deliberate: a feature added
             * later should arrive switched on, and a capability added later
             * must not arrive granted. A key that gains a power nobody granted
             * is the worse of the two failures by a distance.
             *
             * `rate` is null for "whatever the panel says", a number for this
             * key alone, and zero for no ceiling at all. Zero is a real answer
             * somebody may want for a bot on their own machine, and the form
             * says plainly what it means.
             */
            $table->json('abilities')->nullable();
            $table->unsignedInteger('rate')->nullable();

            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();

            $table->timestamp('decided_at')->nullable();
            $table->unsignedInteger('decided_by')->nullable();

            $table->timestamps();

            $table->index(['state', 'created_at']);

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('decided_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Columns a panel that installed an earlier version does not have yet.
     *
     * install() answers early when the table is there, which is what makes it
     * safe to run on every install - and also means a table made last month
     * never grows. This is the other half: each column added on its own, only
     * when it is missing, so an install is idempotent whichever version it
     * started from.
     *
     * Not a migration, for the reason written on the migration itself. A
     * migration records that it ran; when that record and the database disagree
     * there is no way back, and this plugin spent three broken releases proving
     * it.
     */
    public static function upgrade(): void
    {
        if (!Schema::hasTable(self::TABLE)) {
            return;
        }

        if (!Schema::hasColumn(self::TABLE, 'abilities')) {
            Schema::table(self::TABLE, static function (Blueprint $table): void {
                $table->json('abilities')->nullable();
            });
        }

        if (!Schema::hasColumn(self::TABLE, 'rate')) {
            Schema::table(self::TABLE, static function (Blueprint $table): void {
                $table->unsignedInteger('rate')->nullable();
            });
        }
    }

    /**
     * Whether the table is there to be asked.
     *
     * Every page and every request goes through this. A panel whose install was
     * interrupted before the seeder, or one where the table was removed by
     * hand, gets a feature that is quietly not offered rather than a page that
     * throws - which is the same rule the rest of this plugin follows and the
     * reason none of it can take the panel down.
     *
     * Held for the request. It is one lookup, and it is asked on every route.
     */
    public static function ready(): bool
    {
        static $ready = null;

        if ($ready !== null) {
            return $ready;
        }

        try {
            return $ready = Schema::hasTable(self::TABLE);
        } catch (Throwable) {
            return $ready = false;
        }
    }

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
            return Features::enabled(Features::API) && self::ready();
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

    /**
     * Hide Pelican's own API keys tab from the account profile.
     *
     * **This hides and does not remove, and the difference matters.** Pelican
     * offers no way to take a tab off that page - CanCustomizeTabs adds, and
     * nothing subtracts - so this is a stylesheet rule. The tab is gone from
     * the strip and its panel is not drawn, and everything behind it still
     * works: a key already made still authenticates, Pelican's client API
     * still answers, and somebody who knows the address still reaches the page
     * even though there is nothing on it. Anybody who needs it genuinely gone
     * has to be refused by Pelican, which is not this plugin's to arrange.
     *
     * What it is good for is a panel that has decided the Essentials key is the
     * one people should ask for, and does not want two things called API keys
     * on one page.
     *
     * The selector matches the tab by where it points, which is the one thing
     * about that markup this codebase can be sure of - the address is in
     * Pelican's own successRedirectUrl and in every link to the tab. Matching
     * nothing leaves the tab exactly as it was, which is the right way for a
     * rule against somebody else's markup to be wrong.
     */
    public static function css(): string
    {
        if (!(bool) Theme::config('api_hide_pelican', false)) {
            return '';
        }

        // Both spellings of the same address: a link carries it encoded, and
        // an attribute written by script may not.
        $encoded = 'api-keys%3A%3Adata%3A%3Atab';
        $plain = 'api-keys::data::tab';

        return '.fi-tabs a[href*="' . $encoded . '"],'
            . '.fi-tabs a[href*="' . $plain . '"],'
            . '.fi-tabs-item[href*="' . $encoded . '"],'
            . '.fi-tabs-item[href*="' . $plain . '"]{display:none !important}';
    }

    /**
     * Requests a minute for one key, or for the panel when none is given.
     *
     * A key with nothing of its own follows the panel. A key with a number
     * follows that instead, and **zero means no ceiling at all** - which is a
     * real thing to want for a bot on your own machine, and a real way to be
     * sorry if it is given to somebody else. The form says so in those words.
     *
     * The panel-wide setting is never zero: an accident there would lift the
     * ceiling on every key at once, where an accident on one key is one key.
     */
    public static function rate(?Key $key = null): int
    {
        $own = $key?->rate;

        if ($own !== null) {
            return $own === 0 ? 0 : max(1, min(100000, (int) $own));
        }

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
     * Gone for good.
     *
     * **Only one that cannot answer.** A key still in use is revoked first and
     * removed after, and that order is the point rather than an inconvenience:
     * revoking is the act that stops something working, and it should never be
     * possible to make a working key disappear without that having happened.
     * The two-step also leaves the revocation visible on the page for as long
     * as anybody wants it there.
     *
     * A refused request may go the same way. Nothing was ever issued for it, so
     * there is nothing to stop first - it is a row somebody is done reading.
     *
     * Answers false rather than throwing when asked to remove a live key. The
     * pages never offer it, so a false here means something reached this by
     * another route, and a caller that ignores the answer has removed nothing.
     */
    public static function forget(Key $key): bool
    {
        if ($key->state === Key::ACTIVE || $key->state === Key::PENDING) {
            return false;
        }

        try {
            return (bool) $key->delete();
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * A key an administrator makes directly, for a bot rather than a person.
     *
     * Granted the moment it is made, because the person making it is the person
     * who would approve it - a request they then answer themselves is a form
     * with an extra page in it.
     */
    /**
     * @param  array<int, string>  $abilities
     */
    public static function mint(User $owner, string $name, string $scope, array $abilities = [], ?int $rate = null): string
    {
        $key = Key::query()->create([
            'user_id' => $owner->id,
            'name' => Str::limit(trim($name), 60, ''),
            'scope' => $scope === Key::PANEL ? Key::PANEL : Key::PERSON,
            'state' => Key::PENDING,
            'prefix' => self::freshPrefix(),
            'token' => null,
            'abilities' => $abilities === [] ? null : array_values($abilities),
            'rate' => $rate,
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
