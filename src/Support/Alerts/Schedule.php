<?php

namespace LegendDevelopment\Theme\Support\Alerts;

use Illuminate\Console\Scheduling\Schedule as Scheduler;
use LegendDevelopment\Theme\Jobs\RunWatchdog;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;

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
            ->job(new RunWatchdog())
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
