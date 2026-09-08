<?php

namespace LegendDevelopment\Theme\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Shop\Renewals;
use LegendDevelopment\Theme\Support\Shop\Tables;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * The daily pass over recurring orders.
 *
 * Queued because it writes invoices and sends mail, and a cron entry that
 * waits on an SMTP server is a cron entry that overlaps itself. It carries no
 * arguments at all: what to do is entirely a question about the state of the
 * table, asked fresh each time.
 *
 * Safe to run twice in a minute and safe to miss for a week. An order that has
 * already been invoiced for its next period is skipped because the unpaid
 * invoice is right there; one whose date has long passed is caught up on the
 * next tick. Nothing here keeps a marker of when it last ran, because a marker
 * is a thing that can be wrong.
 */
class RunRenewals implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /** Two hundred invoices and two hundred suspensions is not a fast minute. */
    public int $timeout = 900;

    /**
     * Once. A pass that failed halfway has already written the invoices it
     * wrote, and running it again from the top would find them and skip them -
     * so a retry is not wrong, it is simply the next day's run arriving early.
     */
    public int $tries = 1;

    public function handle(): void
    {
        try {
            if (!Features::enabled(Features::SHOP) || !Tables::ready()) {
                return;
            }

            $done = Renewals::run();
        } catch (Throwable $exception) {
            report($exception);

            return;
        }

        if (array_sum($done) === 0) {
            return;
        }

        // One line, and only when something happened. A daily entry saying
        // nothing happened is a log nobody reads by the end of the month.
        try {
            Log::info(Theme::name() . ': renewals wrote ' . $done['invoiced']
                . ' invoice(s), sent ' . $done['reminded']
                . ' reminder(s), suspended ' . $done['suspended']
                . ' order(s) and closed ' . $done['finished'] . '.');
        } catch (Throwable) {
            // Not logged. The invoices exist either way.
        }
    }
}
