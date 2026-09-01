<?php

namespace LegendDevelopment\Theme\Support;

use Illuminate\Console\Scheduling\Schedule;
use LegendDevelopment\Theme\Jobs\UpdateFromChannel;
use Throwable;

/**
 * Installing new releases without anyone pressing the button.
 *
 * This rides on the scheduler Pelican already requires - the same cron entry
 * that runs its own tasks - so there is nothing extra to set up on the host. If
 * that cron is not running, nothing here fires and the button on the Theme page
 * is still the way to update.
 */
class AutoUpdate
{
    /**
     * Registers the check at the chosen interval, or not at all when the setting
     * is off. Reading the setting here rather than inside the task means turning
     * it off actually removes the entry instead of leaving a task that decides
     * every run to do nothing.
     */
    public static function schedule(Schedule $schedule): void
    {
        $frequency = Channels::autoUpdate();

        if ($frequency === Channels::AUTO_OFF) {
            return;
        }

        $event = $schedule
            ->call(static fn () => self::run())
            // A name is what lets the scheduler recognise a closure across runs,
            // which overlap prevention needs; an update takes minutes, so a
            // second one starting on top of it has to be impossible. Ten minutes
            // rather than the default day: on a check that runs every minute, a
            // lock left behind by a crash would otherwise stop the next 1439.
            ->name('legend-theme:auto-update')
            ->withoutOverlapping(10);

        match ($frequency) {
            Channels::AUTO_MINUTE => $event->everyMinute(),
            Channels::AUTO_FIVE_MINUTES => $event->everyFiveMinutes(),
            Channels::AUTO_TEN_MINUTES => $event->everyTenMinutes(),
            Channels::AUTO_THIRTY_MINUTES => $event->everyThirtyMinutes(),
            Channels::AUTO_HOURLY => $event->hourly(),
            // Weekly and daily land at night: the panel rebuilds its assets
            // during an update and is briefly unresponsive.
            Channels::AUTO_WEEKLY => $event->weeklyOn(1, '04:00'),
            default => $event->dailyAt('04:00'),
        };
    }

    /**
     * When the next check is due, as a unix timestamp - or null when nothing is
     * scheduled.
     *
     * Worked out here rather than asked of the scheduler: the schedule is only
     * built inside artisan, and this is read by a page in a browser. The
     * arithmetic mirrors schedule() above, and the two are next to each other
     * so a change to one is a change made looking at the other.
     *
     * Cron fires on the boundary, so "every five minutes" means the next
     * multiple of five past the hour, not five minutes from now.
     */
    public static function nextRun(): ?int
    {
        $frequency = Channels::autoUpdate();

        if ($frequency === Channels::AUTO_OFF) {
            return null;
        }

        try {
            $now = now();

            return match ($frequency) {
                Channels::AUTO_MINUTE => $now->copy()->addMinute()->startOfMinute()->getTimestamp(),
                Channels::AUTO_FIVE_MINUTES => self::nextMultiple($now, 5),
                Channels::AUTO_TEN_MINUTES => self::nextMultiple($now, 10),
                Channels::AUTO_THIRTY_MINUTES => self::nextMultiple($now, 30),
                Channels::AUTO_HOURLY => $now->copy()->addHour()->startOfHour()->getTimestamp(),
                Channels::AUTO_WEEKLY => $now->copy()->next(1)->setTime(4, 0)->getTimestamp(),
                default => self::nextAtFour($now),
            };
        } catch (Throwable) {
            // No clock to read. A missing countdown is a widget with one line
            // less on it.
            return null;
        }
    }

    private static function nextMultiple(mixed $now, int $minutes): int
    {
        $next = $now->copy()->startOfMinute();

        // The next boundary strictly after now, so a check due this very minute
        // does not read as "due in 0 seconds" for sixty seconds.
        do {
            $next->addMinute();
        } while ($next->minute % $minutes !== 0);

        return $next->getTimestamp();
    }

    private static function nextAtFour(mixed $now): int
    {
        $today = $now->copy()->setTime(4, 0);

        return ($today->greaterThan($now) ? $today : $today->addDay())->getTimestamp();
    }

    /**
     * One check, and an update when the channel has something newer. Failures
     * are reported and swallowed: the scheduler runs everything else in the
     * panel too, and a feed that is briefly down must not take that with it.
     */
    public static function run(): void
    {
        try {
            // Ten minutes of cached answer means nothing on an hourly check, but
            // on a daily one it could be the whole reason a release is missed.
            Channels::forget();

            $latest = Channels::latest();

            if ($latest === null) {
                self::record('unreachable');

                return;
            }

            if (!Channels::updateAvailable()) {
                self::record('current');

                return;
            }

            UpdateFromChannel::dispatch(null, $latest['download_url'], $latest['version']);

            self::record('queued', $latest['version']);
        } catch (Throwable $exception) {
            report($exception);

            self::record('failed');
        }
    }

    /* ----------------------------------------------------- saying so ----- */

    private const RECORD = 'legend-theme.autoupdate.last';

    /**
     * What the last check did, so that a check which does nothing can be told
     * apart from one that never happened.
     *
     * This is the whole of the fix for "the automatic updater is broken". It
     * was not that the comparison was wrong - it reads the right feed and
     * compares it to the right version. It was that the thing ran unattended,
     * said nothing, and left three quite different failures looking identical
     * from a browser:
     *
     *  - the scheduler is not running, so run() is never called at all;
     *  - it ran and there was nothing new;
     *  - it ran, queued an update, and no worker ever picked the job up.
     *
     * A countdown ticking towards a check that never happens looks exactly like
     * one ticking towards a check that finds nothing. Now the dashboard says
     * which, and the answer points at the part that needs attention.
     *
     * In the cache rather than in a file: this is written on every check - once
     * a minute on the busiest setting - and it is diagnosis rather than
     * settings. Losing it to a cache clear costs nothing but the next check.
     */
    private static function record(string $outcome, ?string $version = null): void
    {
        try {
            cache()->put(self::RECORD, [
                'at' => time(),
                'outcome' => $outcome,
                'version' => $version,
            ], now()->addDays(30));
        } catch (Throwable) {
            // A panel whose cache will not hold a diagnostic line is a panel
            // with a larger problem, and not one this should raise here.
        }
    }

    /**
     * The last check, or null if there has not been one since the cache was
     * last cleared.
     *
     * @return array{at: int, outcome: string, version: string|null}|null
     */
    public static function lastCheck(): ?array
    {
        try {
            $held = cache()->get(self::RECORD);

            if (!is_array($held) || !is_int($held['at'] ?? null) || !is_string($held['outcome'] ?? null)) {
                return null;
            }

            return [
                'at' => $held['at'],
                'outcome' => $held['outcome'],
                'version' => is_string($held['version'] ?? null) ? $held['version'] : null,
            ];
        } catch (Throwable) {
            return null;
        }
    }
}
