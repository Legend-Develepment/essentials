<?php

namespace LegendDevelopment\Theme\Support\Shop;

use Illuminate\Console\Scheduling\Schedule as Scheduler;
use LegendDevelopment\Theme\Jobs\RunRenewals;
use LegendDevelopment\Theme\Support\Features;
use Throwable;

/**
 * When the renewals pass runs.
 *
 * Its own file rather than a method on the job, the way Alerts\Schedule is
 * apart from the watchdog: this is read at boot, on every artisan command, on
 * a panel that may have no shop at all - and the job should not have to be
 * loaded to find that out.
 *
 * Daily, and that is deliberate rather than conservative. The two things it
 * does are measured in days: an invoice written a few days before the period
 * ends, a server stopped some days after a bill went unpaid. Running it hourly
 * would do the same work twenty-four times and change nothing about when
 * anybody is billed.
 *
 * The feature is checked here rather than inside the job, so switching the
 * shop off removes the entry instead of leaving a task that wakes up every
 * night to decide to do nothing.
 */
class Schedule
{
    public static function register(Scheduler $schedule): void
    {
        try {
            if (!Features::enabled(Features::SHOP) || !Tables::ready()) {
                return;
            }

            $schedule
                ->job(new RunRenewals())
                ->name('legend-theme:renewals')
                /*
                 * A pass that overran must not have the next one queue behind
                 * it - two of these at once would each see the same orders and
                 * each write an invoice, which is a customer billed twice.
                 */
                ->withoutOverlapping(60)
                ->daily();
        } catch (Throwable) {
            // Never let a scheduling problem stop artisan from running.
        }
    }
}
