<?php

namespace LegendDevelopment\Theme\Support;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

/**
 * Every scheduled task on the panel, and which of them have stopped.
 *
 * Pelican keeps schedules per server and shows them there, which is the right
 * page for one server. It is no help to somebody looking after forty, and the
 * question that matters here is one Pelican does not ask at all.
 *
 * **Its own status enum has three states** - inactive, processing, active - and
 * none of them is "this stopped working". A schedule whose run crashed part way
 * stays `is_processing` for ever and never fires again; Pelican calls that
 * Processing, which is also what a schedule running right now is called. A
 * schedule whose `next_run_at` passed hours ago because the cron stopped is
 * called Active. Both look healthy on the page that shows them.
 *
 * So this reads the same rows and asks a different question: not what state is
 * it in, but has it stopped. Read only - nothing here edits, triggers or
 * deletes a schedule. Pelican owns all of that, and the cron with it.
 */
class Schedules
{
    /**
     * How long a schedule may say it is processing before it is stuck.
     *
     * A run is a handful of tasks against the daemon, so minutes at the very
     * outside. Six hours is far past anything legitimate and well short of the
     * day it would take somebody to notice on their own - the point of the
     * number is to be obviously wrong rather than finely tuned.
     */
    public const STUCK_HOURS = 6;

    /**
     * And how late is late.
     *
     * Pelican's cron runs every minute, so a schedule a few minutes past its
     * time is a queue that is busy. An hour past it is a cron that is not
     * running, and that is worth saying.
     */
    public const OVERDUE_MINUTES = 60;

    public const STUCK = 'stuck';

    public const OVERDUE = 'overdue';

    public const NEVER = 'never';

    public const OFF = 'off';

    public const HEALTHY = 'healthy';

    public static function enabled(): bool
    {
        return Features::enabled(Features::SCHEDULES);
    }

    /**
     * The schedules on servers this person can reach.
     *
     * Same scoping as the backups overview - accessibleServers() honours the
     * node scoping Pelican already applies to a delegated administrator, so a
     * page listing every schedule on the panel lists every schedule they were
     * already able to open.
     *
     * @return Builder<Schedule>
     */
    public static function query(): Builder
    {
        $ids = [];

        try {
            $ids = user()?->accessibleServers()->pluck('servers.id')->all() ?? [];
        } catch (Throwable) {
            // No list is an empty page rather than every schedule on the panel.
        }

        return Schedule::query()
            ->whereIn('schedules.server_id', $ids)
            ->with('server:id,name,uuid_short');
    }

    /**
     * What is wrong with one schedule, or that nothing is.
     *
     * The order is the whole of it, because more than one can be true at once
     * and only the worst is worth showing. A schedule that is switched off
     * cannot be overdue in any sense that matters; one that is stuck is stuck
     * whether or not its next run has also passed.
     */
    public static function verdict(Schedule $schedule): string
    {
        if (!$schedule->is_active) {
            return self::OFF;
        }

        if ($schedule->is_processing && self::hoursSince($schedule->last_run_at) >= self::STUCK_HOURS) {
            return self::STUCK;
        }

        /*
         * Still processing, but not for long enough to worry about. Said
         * explicitly rather than falling through: a schedule running right now
         * has no meaningful next run, and calling it overdue would report every
         * long-running backup as a fault.
         */
        if ($schedule->is_processing) {
            return self::HEALTHY;
        }

        if ($schedule->next_run_at === null) {
            return self::NEVER;
        }

        try {
            if ($schedule->next_run_at->isBefore(now()->subMinutes(self::OVERDUE_MINUTES))) {
                return self::OVERDUE;
            }
        } catch (Throwable) {
            // An unreadable date is not a verdict. Better to say nothing than
            // to raise an alarm about a column that could not be parsed.
            return self::HEALTHY;
        }

        // Never run and not yet due is a schedule somebody made this morning.
        return self::HEALTHY;
    }

    /**
     * Whether a verdict is one somebody should look at.
     *
     * Off is not: switching a schedule off is a thing people do on purpose, and
     * a page that nags about it is a page they stop reading.
     */
    public static function wrong(string $verdict): bool
    {
        return in_array($verdict, [self::STUCK, self::OVERDUE, self::NEVER], true);
    }

    /**
     * How badly, so the worst rows sort to the top.
     *
     * A number rather than an alphabet: "never" would otherwise sort above
     * "overdue" and "stuck" below both, which is the reverse of how much they
     * matter.
     */
    public static function weight(string $verdict): int
    {
        return match ($verdict) {
            self::STUCK => 0,
            self::OVERDUE => 1,
            self::NEVER => 2,
            self::HEALTHY => 3,
            default => 4,
        };
    }

    public static function colour(string $verdict): string
    {
        return match ($verdict) {
            self::STUCK, self::OVERDUE => 'danger',
            self::NEVER => 'warning',
            self::HEALTHY => 'success',
            default => 'gray',
        };
    }

    /**
     * The cron line, as it is written in the five columns.
     *
     * Not turned into a sentence. "Every day at 04:00" is friendlier right up
     * to the schedule that does not fit one, and a page that describes half its
     * rows and prints the other half is worse than one that prints them all.
     */
    public static function cron(Schedule $schedule): string
    {
        return implode(' ', [
            (string) $schedule->cron_minute,
            (string) $schedule->cron_hour,
            (string) $schedule->cron_day_of_month,
            (string) $schedule->cron_month,
            (string) $schedule->cron_day_of_week,
        ]);
    }

    /**
     * Hours since a moment, or a very large number if there was none.
     *
     * Null is the awkward case and it has to mean "for ever": a schedule
     * processing with no last run has been processing since before anybody
     * recorded when, which is longer than any threshold rather than shorter.
     */
    public static function hoursSince(mixed $at): float
    {
        if ($at === null) {
            return PHP_INT_MAX;
        }

        try {
            return abs(now()->diffInHours($at, true));
        } catch (Throwable) {
            return PHP_INT_MAX;
        }
    }

    /**
     * Everything wrong right now, for the watchdog.
     *
     * Its own pass rather than the page's query: the watchdog runs with nobody
     * signed in, so accessibleServers() would answer with nothing.
     *
     * @return array<int, array{id: int, name: string, server: string, server_id: int, verdict: string}>
     */
    public static function troubled(array $only = []): array
    {
        $out = [];

        try {
            $query = Schedule::query()
                ->where('is_active', true)
                ->with('server:id,name');

            /*
             * Narrowed to a list of servers when one is handed in, which is how
             * the warning above somebody's own server list asks this. Filtered
             * in the query rather than after it: a panel with four hundred
             * schedules should not read all of them to report one person's two.
             *
             * And still nothing here asks who is looking. The caller says which
             * servers, because the two callers know different answers to that:
             * the watchdog means every one, and a page means whoever is looking
             * at it. tools/check-watchdog.js reads this method for the name of
             * that helper and finds it in neither the code nor the prose, which
             * is why this sentence is worded the long way round.
             */
            if ($only !== []) {
                $query->whereIn('server_id', $only);
            }

            foreach ($query->get() as $schedule) {
                $verdict = self::verdict($schedule);

                if (!self::wrong($verdict)) {
                    continue;
                }

                $out[] = [
                    'id' => (int) $schedule->id,
                    'name' => (string) ($schedule->name ?? ''),
                    // Both the name and the id: a message reads the first and a
                    // page counts by the second, and asking twice for one row
                    // is a second query to save four characters.
                    'server' => (string) ($schedule->server->name ?? ''),
                    'server_id' => (int) ($schedule->server->id ?? 0),
                    'verdict' => $verdict,
                ];
            }
        } catch (Throwable) {
            // A watchdog that cannot read is one that reports nothing, not one
            // that reports everything as broken.
            return [];
        }

        return $out;
    }
}
