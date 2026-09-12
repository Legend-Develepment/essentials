<?php

namespace LegendDevelopment\Theme\Support\Alerts;

use Illuminate\Console\Scheduling\Schedule as Scheduler;
use LegendDevelopment\Theme\Jobs\RunWatchdog;
use LegendDevelopment\Theme\Support\Workers;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Status\Pages;
use LegendDevelopment\Theme\Support\Status\Publish;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * When the watchdog runs.
 *
 * Its own file rather than a method on the watchdog, for the same reason
 * AutoUpdate keeps its scheduling apart from its work: this is read at boot, on
 * every artisan command, on a panel where the feature may be switched off - and
 * the class it schedules should not have to be loaded to find that out.
 *
 * The interval is read here rather than inside the job. Switching the checks off
 * then removes the entry, instead of leaving a task that wakes up every five
 * minutes to decide to do nothing.
 */
class Schedule
{
    /**
     * The public status page, rebuilt on the minute.
     *
     * Its own entry rather than part of the watchdog: they run at different
     * rates and for different people. The watchdog is once a quarter hour and
     * tells an administrator something; this is once a minute and is what a
     * hundred visitors are looking at.
     *
     * Not queued, and that is the difference from the watchdog. A build asks
     * each chosen node for a state it has already cached for fifteen seconds
     * and pings the game ports it is allowed to - seconds of work, not minutes -
     * and putting it on the queue would mean a panel whose worker has stopped
     * quietly serving a page that is an hour old.
     */
    public static function status(Scheduler $schedule): void
    {
        if (!Publish::enabled() && !Pages::enabled()) {
            return;
        }

        $schedule
            ->call(static function (): void {
                try {
                    if (Publish::enabled()) {
                        Publish::build();
                    }

                    foreach (Pages::everyone() as $userId) {
                        Publish::build($userId);
                    }
                } catch (Throwable) {
                    // A build that fails leaves the last snapshot standing,
                    // which is the right failure for a page somebody is looking
                    // at right now.
                }
            })
            ->name('legend-theme:status')
            // A build that overran would otherwise have the next one queue
            // behind it, and this runs sixty times an hour.
            ->withoutOverlapping(5)
            ->everyMinute();
    }

    public static function register(Scheduler $schedule): void
    {
        if (!Features::enabled(Features::ALERTS)) {
            return;
        }

        $every = (string) Theme::config('alert_every', 'fifteen');

        if ($every === 'off') {
            return;
        }

        $event = $schedule
            /*
             * Handed to the queue when there is a queue, and done here when
             * there is not.
             *
             * This used to be ->job(new RunWatchdog()), which queues it - and
             * the watchdog's own first check is whether the worker is running.
             * So on the one panel that most needed telling, the message sat in
             * the dead queue behind everything else. A worker went down at
             * twenty past two and nothing said so for six hours; the only trace
             * anywhere was in journalctl.
             *
             * It is the same trap that took the updater off the queue in
             * 3.46.1-dev and EnsureEnabled off it before that, and it is worth
             * stating as a rule: a check that reports on the queue must not
             * depend on the queue.
             *
             * Running it here costs the scheduler tick however long the checks
             * take - which on unreachable nodes is minutes - and that is only
             * ever paid on a panel whose worker is already missing. A slow tick
             * on a broken panel is a better trade than silence on one.
             */
            ->call(static function (): void {
                if ((Workers::state()['state'] ?? '') === 'missing') {
                    (new RunWatchdog())->handle();

                    return;
                }

                RunWatchdog::dispatch();
            })
            /*
             * Named, and not allowed to overlap.
             *
             * A run that is waiting on ten unreachable nodes takes the full
             * timeout ten times over, which on the five-minute setting is
             * several runs stacked on each other - each one holding a worker
             * and each one about to report the same thing. Ten minutes rather
             * than the default day: a lock left behind by a crashed worker
             * would otherwise stop every run until tomorrow.
             */
            ->name('legend-theme:watchdog')
            ->withoutOverlapping(10);

        match ($every) {
            'five' => $event->everyFiveMinutes(),
            'thirty' => $event->everyThirtyMinutes(),
            'hourly' => $event->hourly(),
            'daily' => $event->dailyAt('09:00'),
            default => $event->everyFifteenMinutes(),
        };
    }
}
