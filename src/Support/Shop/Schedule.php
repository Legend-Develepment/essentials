<?php

namespace LegendDevelopment\Theme\Support\Shop;

use Illuminate\Console\Scheduling\Schedule as Scheduler;
use LegendDevelopment\Theme\Jobs\RunRenewals;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Workers;
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

            /*
             * Run here when there is no queue to run it in.
             *
             * ->job() puts it on the queue, and a worker that never answers
             * turns the whole of this into nothing at all: no invoice a
             * fortnight before the period ends, no suspension after the grace
             * period, no reminder in between, and no error anywhere saying so.
             * A shop that quietly stops billing is worse than one that is
             * slow, so with no worker the scheduler does the work itself - it
             * is a fresh CLI process with the plugin loaded, which is the same
             * reason the updater does.
             *
             * withoutOverlapping() below covers both roads: two passes at once
             * would each see the same orders and each write an invoice.
             */
            $work = static function (): void {
                if ((Workers::state()['state'] ?? '') === 'missing') {
                    app(RunRenewals::class)->handle();

                    return;
                }

                RunRenewals::dispatch();
            };

            $schedule
                ->call($work)
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
