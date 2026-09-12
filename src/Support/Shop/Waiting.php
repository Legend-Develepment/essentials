<?php

namespace LegendDevelopment\Theme\Support\Shop;

use App\Models\User;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Models\Waitlist;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Asking to be told when a sold-out package is for sale again.
 *
 * **When stock returns, everybody on that package's list is told, and being
 * told takes them off it.** No hold, no expiry, no invitation, no position.
 * That is a decision rather than a simplification, and the argument is worth
 * having in one place:
 *
 * The shop already has exactly one arbiter of who gets the last one - a locked
 * read inside the purchase - and exactly one honest sentence for whoever misses
 * it. Telling everybody reuses both. Holding a place would invent a second
 * definition of "how many are left", which every existing reader of stock would
 * have to be taught, and the one that was not taught would refuse the person
 * the hold was for. Telling only the first two *without* a hold is strictly
 * worse than telling everybody: the shop shows the restock to every passer-by
 * anyway, so being told buys no advantage, and the two who were told have given
 * up their place for nothing.
 *
 * So the cost is paid in the message instead of hidden in a column: it says how
 * many there are, that they go to whoever buys first, and that the reader is no
 * longer on the list. That is a sentence somebody can act on correctly.
 *
 * **It reads the answer rather than watching for a change.** Nothing hooks the
 * places stock moves, and that is what makes it right: a package change frees a
 * place on one package and takes one on another in a single write that never
 * touches an order's state, and a purchase is written inside a transaction that
 * can be retried three times. A pass that simply asks "is there one now" has
 * neither problem, and needs no memory of what the answer was before.
 *
 * **Nothing in this file may ask who is signed in.** From the moment the
 * watchdog reads a count from here, the gate that checks the watchdog follows
 * every method it can reach looking for exactly that call, because an alert
 * must never be scoped to whoever happened to trigger it. Every method here
 * takes the person as an int instead.
 */
class Waiting
{
    /** The feature, the setting or the table is not there. */
    public const OFF = 'off';

    /** No such package, or it is not for sale. */
    public const GONE = 'gone';

    /** Nothing that cannot run out has a queue. */
    public const UNLIMITED = 'unlimited';

    /** There is one to buy, so there is nothing to wait for. */
    public const AVAILABLE = 'available';

    public const ALREADY = 'already';

    public const FULL = 'full';

    public const MANY = 'many';

    public const FAILED = 'failed';

    /**
     * How many people one pass will write to, across every package.
     *
     * Per pass rather than per package, so a package with a thousand waiting
     * drains two hundred a tick and starves the ones behind it for a few ticks.
     * Bounded and deliberate: the alternative is one tick that writes a
     * thousand notifications.
     */
    public const MAX = 200;

    /** How long one package's list may get. */
    public const ROOM = 1000;

    /** How many lists one account may be on. */
    public const MINE = 20;

    /** Whether any of this is offered at all. */
    public static function ready(): bool
    {
        try {
            return Features::enabled(Features::WAITLIST)
                && Tables::ready()
                && Tables::waitlistReady();
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * Whether somebody may join one.
     *
     * A separate question from ready(), and the separation is the point: a
     * closed intake leaves everybody already waiting exactly where they are,
     * and they can still be told and can still leave. That is the difference
     * between "not taking new ones this week" and "everybody who asked is now
     * waiting for nothing".
     */
    public static function joining(): bool
    {
        return self::ready() && (bool) Theme::config('shop_wait', true);
    }

    /**
     * Why they may not, or null when they may.
     *
     * In this order, because each answer is only true once the one before it is
     * not. The live check is written out here rather than borrowed from the
     * purchase's own refusal, which does not make it - anything trusting that
     * alone would queue people for a package that has been withdrawn.
     */
    public static function may(Package $package, int $userId): ?string
    {
        if (!self::joining() || $userId <= 0) {
            return self::OFF;
        }

        if (!$package->live || !$package->buildable()) {
            return self::GONE;
        }

        if ($package->stock === null) {
            return self::UNLIMITED;
        }

        if (Packages::stockLeft($package) !== 0) {
            return self::AVAILABLE;
        }

        if (self::listed((int) $package->id, $userId)) {
            return self::ALREADY;
        }

        try {
            if (Waitlist::query()->where('user_id', $userId)->count() >= self::MINE) {
                return self::MANY;
            }

            if (Waitlist::query()->where('package_id', (int) $package->id)->count() >= self::ROOM) {
                return self::FULL;
            }
        } catch (Throwable) {
            return self::FAILED;
        }

        return null;
    }

    /** Put them on it. Null when it worked. */
    public static function join(Package $package, int $userId): ?string
    {
        $why = self::may($package, $userId);

        if ($why !== null) {
            return $why;
        }

        try {
            Waitlist::query()->firstOrCreate([
                'package_id' => (int) $package->id,
                'user_id' => $userId,
            ]);
        } catch (Throwable) {
            /*
             * Two tabs racing the unique index is this working rather than
             * failing: the row they were both trying to make is there.
             */
            return self::listed((int) $package->id, $userId) ? null : self::FAILED;
        }

        return null;
    }

    /**
     * Take them off it.
     *
     * The package id is never checked, and does not need to be: this only ever
     * deletes the caller's own row, so there is nothing an id from a browser
     * can reach that was not already theirs. That is also what lets somebody
     * leave the list for a package that has since been withdrawn.
     */
    public static function leave(int $packageId, int $userId): bool
    {
        if (!self::ready() || $packageId <= 0 || $userId <= 0) {
            return false;
        }

        try {
            Waitlist::query()
                ->where('package_id', $packageId)
                ->where('user_id', $userId)
                ->delete();
        } catch (Throwable) {
            return false;
        }

        return true;
    }

    public static function listed(int $packageId, int $userId): bool
    {
        if (!self::ready() || $packageId <= 0 || $userId <= 0) {
            return false;
        }

        try {
            return Waitlist::query()
                ->where('package_id', $packageId)
                ->where('user_id', $userId)
                ->exists();
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * What one person is waiting for, as id to name.
     *
     * @return array<int, string>
     */
    public static function mine(int $userId): array
    {
        if (!self::ready() || $userId <= 0) {
            return [];
        }

        try {
            $ids = Waitlist::query()->where('user_id', $userId)->pluck('package_id')->all();

            if ($ids === []) {
                return [];
            }

            return Package::query()
                ->whereKey($ids)
                ->orderBy('name')
                ->pluck('name', 'id')
                ->mapWithKeys(static fn (mixed $name, mixed $id): array => [(int) $id => (string) $name])
                ->all();
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * How many are waiting for each of these.
     *
     * @param  array<int, int>  $packageIds
     * @return array<int, int>
     */
    public static function counts(array $packageIds): array
    {
        $packageIds = array_values(array_filter(array_map('intval', $packageIds)));

        if (!self::ready() || $packageIds === []) {
            return [];
        }

        try {
            return Waitlist::query()
                ->whereIn('package_id', $packageIds)
                ->groupBy('package_id')
                ->selectRaw('package_id, COUNT(*) as waiting')
                ->pluck('waiting', 'package_id')
                ->mapWithKeys(static fn (mixed $many, mixed $id): array => [(int) $id => (int) $many])
                ->all();
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * They bought it, so the request they were waiting on is answered.
     *
     * A row made afterwards is a new and deliberate request and is left alone,
     * which is why this is keyed on what was just bought rather than on the
     * person.
     *
     * @param  array<int, int>  $packageIds
     */
    public static function took(int $userId, array $packageIds): void
    {
        $packageIds = array_values(array_filter(array_map('intval', $packageIds)));

        if (!self::ready() || $userId <= 0 || $packageIds === []) {
            return;
        }

        try {
            Waitlist::query()
                ->where('user_id', $userId)
                ->whereIn('package_id', $packageIds)
                ->delete();
        } catch (Throwable) {
            // A list that could not be tidied is a notification somebody may
            // get about a thing they have already bought. That is untidy and
            // it is not worth failing a purchase over.
        }
    }

    /** Empty one package's list. How many were on it. */
    public static function clear(int $packageId): int
    {
        if (!self::ready() || $packageId <= 0) {
            return 0;
        }

        try {
            return Waitlist::query()->where('package_id', $packageId)->delete();
        } catch (Throwable) {
            return 0;
        }
    }

    /**
     * Tell whoever is waiting for something that has stock again.
     *
     * It keeps no memory of what the stock was a moment ago, because the list
     * is the memory: an answered row is deleted, so the next pass finds nothing
     * and says nothing.
     */
    public static function release(): int
    {
        if (!self::ready()) {
            return 0;
        }

        try {
            $ids = Waitlist::query()->distinct()->pluck('package_id')->all();

            if ($ids === []) {
                return 0;
            }

            $packages = Package::query()
                ->whereKey($ids)
                ->where('live', true)
                ->orderBy('id')
                ->get();

            $held = Packages::occupiedMany($packages->pluck('id')->all());
            $done = 0;

            foreach ($packages as $package) {
                if ($done >= self::MAX) {
                    break;
                }

                $left = $package->stock === null
                    ? null
                    : max(0, (int) $package->stock - ($held[(int) $package->id] ?? 0));

                // Still nothing to have. The list waits, and says nothing.
                if ($left !== null && $left < 1) {
                    continue;
                }

                $done += self::releaseOne($package, $left, self::MAX - $done);
            }

            return $done;
        } catch (Throwable) {
            return 0;
        }
    }

    /**
     * One package's list, oldest first.
     *
     * The rows go whether or not the bell landed. A row whose person cannot be
     * written to would fail again in five minutes, and every five minutes after
     * that, for ever.
     */
    private static function releaseOne(Package $package, ?int $left, int $room): int
    {
        try {
            $rows = Waitlist::query()
                ->where('package_id', (int) $package->id)
                ->orderBy('id')
                ->limit(max(1, $room))
                ->get();
        } catch (Throwable) {
            return 0;
        }

        if ($rows->isEmpty()) {
            return 0;
        }

        $name = (string) $package->name;

        foreach ($rows as $row) {
            try {
                $user = User::query()->find((int) $row->user_id);

                if ($user instanceof User) {
                    Billing::restocked($user, $name, $left);
                }
            } catch (Throwable) {
                // One person who could not be told is not a reason to keep the
                // other hundred and ninety-nine waiting.
            }
        }

        try {
            Waitlist::query()->whereIn('id', $rows->pluck('id')->all())->delete();
        } catch (Throwable) {
            return 0;
        }

        return $rows->count();
    }
}
