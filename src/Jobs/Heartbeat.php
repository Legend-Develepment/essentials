<?php

namespace LegendDevelopment\Theme\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use LegendDevelopment\Theme\Support\Workers;

/**
 * Does nothing, and that is the whole of it: it records that it ran.
 *
 * Everything this plugin does that outlives a request goes through a queue
 * worker - updating itself, installing a modpack - and a panel without a
 * working one fails silently. The job is written to the table, the notification
 * says "started", and nothing ever reads it. There is no error, because nothing
 * errored.
 *
 * Dispatching this and seeing whether it comes back is the only way the panel
 * can find that out about itself. See Support\Workers for why the probe has to
 * be one of this plugin's own job classes rather than a framework one.
 *
 * Deliberately carries no payload and touches no model: it has to be able to
 * unserialise on a worker that may be running older code, or this reports a
 * problem of its own making.
 */
class Heartbeat implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * One attempt, and a short one.
     *
     * A probe that retries would keep a stale answer looking fresh, and a probe
     * that hangs would hold a worker off the queue it is being asked about.
     */
    public int $tries = 1;

    public int $timeout = 15;

    public function handle(): void
    {
        Workers::beat();
    }
}
