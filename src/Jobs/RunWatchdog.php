<?php

namespace LegendDevelopment\Theme\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use LegendDevelopment\Theme\Support\Alerts\Watchdog;
use Throwable;

/**
 * One pass of the watchdog, on the queue.
 *
 * Queued rather than run inside the scheduler's own process, and for one
 * reason: the checks talk to every node's daemon, and a node that has stopped
 * answering does not refuse quickly - it takes the full timeout. Ten nodes in
 * that state is a minute and a half of a scheduler run, and the scheduler is
 * also what runs this plugin's updates and Pelican's own tasks.
 *
 * That does mean the watchdog needs a queue worker, and a panel without one
 * gets no alerts. Which is worth saying out loud, because it is circular: the
 * watchdog's own worker check cannot report that the worker is missing. The
 * settings page says so plainly instead, using the probe in Support\Workers
 * that answers the question directly.
 */
class RunWatchdog implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Ten nodes at a ten-second timeout, with room to spare.
     *
     * Not the default of nothing: a job with no timeout that hangs on a socket
     * holds a worker for ever, and this one is scheduled - so the next run
     * queues behind it, and the one after that.
     */
    public int $timeout = 300;

    /**
     * Once.
     *
     * A retry would re-run every check, and the checks are not idempotent in
     * the way that matters: the first pass has already written what it saw, so
     * the second would find nothing changed and send nothing. Retrying costs
     * the timeout again for no message.
     */
    public int $tries = 1;

    public function handle(): void
    {
        try {
            $sent = Watchdog::run();
        } catch (Throwable $exception) {
            report($exception);

            Log::warning('Essentials watchdog: the run failed - ' . $exception->getMessage());

            return;
        }

        if ($sent === []) {
            return;
        }

        /*
         * A line per message, and only when there was one.
         *
         * A watchdog that logged "ran, nothing wrong" every five minutes would
         * bury the entry that matters under three hundred a day. What is
         * written is what was sent, which is also the record of what somebody
         * should have received - useful precisely when they say they did not.
         */
        foreach ($sent as $event) {
            Log::info('Essentials watchdog: ' . $event['kind'] . ' - ' . $event['title']);
        }
    }
}
