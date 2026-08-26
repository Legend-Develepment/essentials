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
            // second one starting on top of it has to be impossible.
            ->name('legend-theme:auto-update')
            ->withoutOverlapping();

        match ($frequency) {
            Channels::AUTO_HOURLY => $event->hourly(),
            // Weekly and daily land at night: the panel rebuilds its assets
            // during an update and is briefly unresponsive.
            Channels::AUTO_WEEKLY => $event->weeklyOn(1, '04:00'),
            default => $event->dailyAt('04:00'),
        };
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
