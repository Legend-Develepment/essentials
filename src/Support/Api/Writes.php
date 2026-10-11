<?php

namespace LegendDevelopment\Theme\Support\Api;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use LegendDevelopment\Theme\Models\Key;
use Throwable;

/**
 * What a write already did, so doing it again does not do it twice.
 *
 * **This is the thing that had to exist before any write could.** Every read in
 * this API can be repeated for nothing: ask twice and you learn the same thing
 * twice. A write cannot. A webhook that is not acknowledged is retried, a bot
 * that times out retries, and a person who does not see a spinner presses the
 * button again - so the same reply lands in front of a customer two or three
 * times, and the second one is indistinguishable from somebody being rude.
 *
 * The shop solves the same problem twice already and both solutions are its
 * own: `Invoices::markPaid()` uses a conditional update because a state
 * transition is its own guard, and `Provision::build()` returns early because
 * an order that has a server already has one. A reply has no such guard - every
 * reply is a new row and a new row is a correct thing to make - so the guard
 * has to come from the caller saying "this is the same request I sent before".
 *
 * That is the `Idempotency-Key` header, and the name is deliberately the one
 * Stripe made ordinary rather than one of ours: somebody wiring up a bot has
 * met it before.
 *
 * **What is kept is the answer, not a marker.** A repeat gets the first reply
 * back, byte for byte, rather than a 409 saying "already done" - because a
 * caller retrying has not yet seen any reply at all, and telling it the work
 * happened without telling it what happened leaves it no better off. The one
 * refusal here is the honest one: the same key with a different body is not a
 * retry, it is a mistake, and it is told so.
 *
 * Rows live a day. Long enough for every retry anybody sends and short enough
 * that this never becomes a table somebody has to think about.
 */
class Writes
{
    /** The table this owns. */
    public const TABLE = 'essentials_api_writes';

    /** How long a remembered answer is worth returning. */
    private const HOURS = 24;

    /** The header, spelled the way everything else that does this spells it. */
    public const HEADER = 'Idempotency-Key';

    /**
     * Made at install, like the keys table and for the same reason.
     *
     * See Api\Keys::install(). A plugin's tables are the seeder's work; a
     * migration that runs before the plugin is enabled is a migration that runs
     * on panels which never wanted any of this.
     */
    public static function install(): void
    {
        try {
            if (Schema::hasTable(self::TABLE)) {
                return;
            }

            Schema::create(self::TABLE, static function (Blueprint $table): void {
                $table->id();

                /*
                 * Whose retry this was.
                 *
                 * Scoped to the key rather than global, because two bots
                 * choosing the same token is not a thing either of them can
                 * prevent and is not a thing either should be punished for.
                 * unsignedBigInteger to match the keys table's own id, by hand
                 * rather than through foreignId(), for the reason written at
                 * the top of tools/check-migrations.js.
                 */
                $table->unsignedBigInteger('key_id');
                $table->foreign('key_id')->references('id')->on(Keys::TABLE)->cascadeOnDelete();

                /*
                 * A hash of whatever the caller chose, not the choice itself.
                 *
                 * Two reasons and the second is the one that decided it. A
                 * token of any length fits a fixed column, so there is no
                 * length to refuse and no truncation - and a truncated token is
                 * two different requests that look like one. And a caller is
                 * free to use something meaningful as its token, which is then
                 * something of theirs in a table of ours for no reason.
                 */
                $table->string('token', 64);

                // The address it was sent to, so one token cannot answer for
                // two different writes.
                $table->string('route', 120);

                /*
                 * A fingerprint of what was sent, not the body itself.
                 *
                 * The body of a reply is somebody's message to a customer and
                 * there is no reason to keep a second copy of it here. What
                 * this needs to know is only whether the second request is the
                 * same as the first, which a hash answers.
                 */
                $table->string('digest', 64);

                $table->unsignedSmallInteger('status');
                $table->json('body');

                $table->timestamp('created_at')->nullable();

                $table->unique(['key_id', 'token']);
                $table->index('created_at');
            });
        } catch (Throwable) {
            // A table that cannot be made leaves every write unremembered,
            // which recall() and remember() both survive. It is worse than
            // having one and better than refusing to answer at all.
        }
    }

    /**
     * The answer this key already got for this token, if it did.
     *
     * Three states, and the caller has to tell them apart: null for "nothing
     * remembered, do the work", an array for "here is what happened last
     * time", and false for "this token was used for something else".
     *
     * @return array<string, mixed>|false|null
     */
    public static function recall(Key $key, string $token, string $route, string $digest): array|false|null
    {
        if ($token === '') {
            return null;
        }

        try {
            $row = DB::table(self::TABLE)
                ->where('key_id', (int) $key->id)
                ->where('token', hash('sha256', $token))
                ->first();

            if ($row === null) {
                return null;
            }

            /*
             * Old enough to have been forgotten, so it is.
             *
             * Deleted rather than ignored, so the token is usable again -
             * a caller that comes back a week later with the same token is
             * sending a new request by any reasonable reading.
             */
            if (Carbon::parse((string) $row->created_at)->addHours(self::HOURS)->isPast()) {
                DB::table(self::TABLE)->where('id', $row->id)->delete();

                return null;
            }

            if ((string) $row->route !== $route || (string) $row->digest !== $digest) {
                return false;
            }

            $body = json_decode((string) $row->body, true);

            return [
                'status' => (int) $row->status,
                'body' => is_array($body) ? $body : [],
            ];
        } catch (Throwable) {
            // Not remembering is the safe direction: the work happens again,
            // which is what would have happened without this table at all.
            return null;
        }
    }

    /**
     * Keep what happened, so the next identical request does not happen.
     *
     * @param  array<string, mixed>  $body
     */
    public static function remember(Key $key, string $token, string $route, string $digest, int $status, array $body): void
    {
        if ($token === '') {
            return;
        }

        try {
            DB::table(self::TABLE)->insertOrIgnore([
                'key_id' => (int) $key->id,
                'token' => hash('sha256', $token),
                'route' => $route,
                'digest' => $digest,
                'status' => $status,
                'body' => json_encode($body, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'created_at' => Carbon::now(),
            ]);

            self::prune();
        } catch (Throwable) {
            // The work was done and the caller is being told about it. Failing
            // to write this down means a retry does the work twice, which is
            // the state this whole class exists to improve on rather than a
            // reason to fail the request that succeeded.
        }
    }

    /**
     * Older than a day, occasionally.
     *
     * One in fifty writes rather than every one, and a limit on each pass, so
     * this is never a query anybody waits for. A table nobody ever writes to
     * again stops growing on its own because it was never growing.
     */
    private static function prune(): void
    {
        try {
            if (random_int(1, 50) !== 1) {
                return;
            }

            DB::table(self::TABLE)
                ->where('created_at', '<', Carbon::now()->subHours(self::HOURS))
                ->limit(500)
                ->delete();
        } catch (Throwable) {
            // Tidying is not the request's job.
        }
    }
}
