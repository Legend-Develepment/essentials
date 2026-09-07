<?php

namespace LegendDevelopment\Theme\Support\Api;

use App\Models\ApiKey;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use LegendDevelopment\Theme\Models\Connection;
use Throwable;

/**
 * Tying a Discord account to a panel account.
 *
 * This is the piece that makes a bot useful rather than a demonstration:
 * `/servers` has to list the servers of the person who typed it, and nothing
 * else here can arrange that.
 *
 * **Each side proves the identity it owns, and that is the whole security
 * property.** The panel gives out the code, to somebody who has signed in - so
 * it knows which panel account is asking. Discord posts it back with the id of
 * whoever typed it - so the bot knows which Discord account is asking. Neither
 * side is ever asked to vouch for the other, and an unsolicited `/connect` in
 * Discord can create nothing at all, because the code only exists because
 * somebody signed in and pressed a button.
 *
 * **What a connection produces is a real Pelican key.** Not one of ours: the
 * bot then talks to `/api/client`, which already checks subuser permissions and
 * already writes the activity log. So this plugin never grows a way to start a
 * server, and there is never a power endpoint here to secure.
 *
 * Minting a key on somebody's behalf is a real capability, and five things make
 * it acceptable - all of them true at once:
 *
 *  1. the person does it themselves, from a page that says what it will create;
 *  2. it is a real Pelican key, so it appears under their own Account -> API
 *     keys and can be revoked there without this plugin's help;
 *  3. the memo says where it came from;
 *  4. it expires, so a connection somebody forgot dies on its own;
 *  5. **only the identifier is stored here.** Pelican's identifier is the
 *     public half: enough to revoke a key, never enough to use one.
 */
class Connections
{
    /** The table this owns. */
    public const TABLE = 'essentials_connections';

    /** How long a code is good for. Ten minutes is a walk to another window. */
    private const MINUTES = 10;

    /** How long the minted Pelican key lasts before it has to be made again. */
    private const KEY_DAYS = 365;

    /**
     * Made at install, like the keys table and for the same reason.
     *
     * See Api\Keys::install(). Installing is the seeder's work; a migration
     * runs once, records that it ran, and when that record and the database
     * disagree there is no way back - which cost three broken releases.
     */
    public static function install(): void
    {
        if (Schema::hasTable(self::TABLE)) {
            return;
        }

        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->id();

            // unsignedInteger, not foreignId: Pelican's users table is
            // `increments`, and MySQL refuses a key between two widths.
            $table->unsignedInteger('user_id');

            /*
             * One Discord account, one panel account. Unique on both sides -
             * the id because a person may not be two people, and user_id
             * because a second connection would be a second key nobody is
             * looking at.
             */
            $table->string('discord_id', 32)->unique();
            $table->string('discord_name')->nullable();

            // The public half of the Pelican key this made. Never the secret.
            $table->string('key_identifier', 16)->nullable();

            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();

            $table->unique('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /** Whether the table is there to be asked. */
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
     * A code for somebody who has signed in and pressed the button.
     *
     * Six characters from an alphabet with no I, O, 0 or 1 in it, because this
     * is read off one screen and typed into another - and a code that has to be
     * spelled out is a code somebody gets wrong twice before it expires.
     *
     * Held in the cache rather than in the table. It is worth ten minutes and
     * one use; a row for it would be a row to clean up, and a cache that has
     * been cleared costs one press of the button.
     */
    public static function open(User $user): string
    {
        $code = Str::upper(Str::random(6));
        $code = str_replace(['I', 'O', '0', '1'], ['J', 'P', '2', '3'], $code);

        Cache::put(self::cacheKey($code), $user->id, self::MINUTES * 60);

        return $code;
    }

    /**
     * Discord posts the code back with the id of whoever typed it.
     *
     * Returns the Pelican key, once, or null for every way this can fail: an
     * unknown code, an expired one, one already used, a panel account that has
     * gone, or a Discord id already tied to somebody else. The caller turns all
     * of them into the same answer, because a code that says *which* of those
     * it was is a code somebody can probe.
     *
     * @return array{key: string, user: string}|null
     */
    public static function claim(string $code, string $discordId, string $name = ''): ?array
    {
        $code = Str::upper(trim($code));
        $discordId = trim($discordId);

        if ($code === '' || !preg_match('/^[0-9]{5,32}$/', $discordId)) {
            return null;
        }

        try {
            $id = Cache::pull(self::cacheKey($code));

            if ($id === null) {
                return null;
            }

            /** @var User|null $user */
            $user = User::query()->find($id);

            if ($user === null) {
                return null;
            }

            // A Discord account already tied to somebody else is refused rather
            // than moved. Moving it would let whoever holds that Discord
            // account take a connection away from a panel user who never asked.
            $taken = Connection::query()
                ->where('discord_id', $discordId)
                ->where('user_id', '!=', $user->id)
                ->exists();

            if ($taken) {
                return null;
            }

            // Connecting again replaces what was there, key and all, so a
            // person who lost their bot's copy can simply do it once more.
            self::cut($user);

            $token = $user->createToken('Discord (Essentials)', []);

            /*
             * The wire format is the identifier followed by the secret - see
             * ApiKey::findToken(), which reads the first sixteen characters as
             * the identifier and compares the rest. Handing back only the
             * secret would give the bot a string Pelican cannot resolve.
             */
            $plain = $token->accessToken->identifier . $token->plainTextToken;

            $token->accessToken->forceFill([
                'expires_at' => Carbon::now()->addDays(self::KEY_DAYS),
            ])->save();

            Connection::query()->create([
                'user_id' => $user->id,
                'discord_id' => $discordId,
                'discord_name' => Str::limit(trim($name), 80, ''),
                'key_identifier' => $token->accessToken->identifier,
            ]);

            return ['key' => $plain, 'user' => (string) $user->username];
        } catch (Throwable) {
            return null;
        }
    }

    /** What is tied to this panel account, if anything. */
    public static function forUser(User $user): ?Connection
    {
        try {
            /** @var Connection|null $row */
            $row = Connection::query()->where('user_id', $user->id)->first();

            return $row;
        } catch (Throwable) {
            return null;
        }
    }

    /** And the same question from the other side, for the bot. */
    public static function forDiscord(string $discordId): ?Connection
    {
        try {
            /** @var Connection|null $row */
            $row = Connection::query()->where('discord_id', trim($discordId))->first();

            return $row;
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * End it, from either side.
     *
     * **The Pelican key goes first.** Deleting the row and leaving the key
     * would be a credential still working with nothing in the panel admitting
     * it exists - the exact shape of a revocation that did not happen. Doing it
     * in this order means the worst case is a row left behind pointing at a key
     * that is already gone, which is untidy rather than dangerous.
     */
    public static function cut(User $user): void
    {
        try {
            $row = self::forUser($user);

            if ($row === null) {
                return;
            }

            if ($row->key_identifier !== null) {
                ApiKey::query()
                    ->where('user_id', $user->id)
                    ->where('identifier', $row->key_identifier)
                    ->delete();
            }

            $row->delete();
        } catch (Throwable) {
            // Nothing here may throw into a page or a bot's request.
        }
    }

    private static function cacheKey(string $code): string
    {
        return 'essentials.connect.' . $code;
    }
}
