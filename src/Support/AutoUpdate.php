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

            if ($latest === null || !Channels::updateAvailable()) {
                return;
            }

            UpdateFromChannel::dispatch(null, $latest['download_url'], $latest['version']);
        } catch (Throwable $exception) {
            report($exception);
        }
    }
}
