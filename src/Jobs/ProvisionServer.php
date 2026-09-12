<?php

namespace LegendDevelopment\Theme\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use LegendDevelopment\Theme\Support\Shop\Provision;

/**
 * Building the server somebody paid for.
 *
 * Queued because creating a server talks to a node, and a node that is slow to
 * answer must not be something a customer watches a spinner for - or worse,
 * something a payment provider's webhook waits on and gives up over.
 *
 * The order id and nothing else. A job holding the model would carry a row as
 * it was when the payment landed, and this is precisely the window in which
 * that row changes.
 *
 * Once. A build that failed left a reason on the order and told somebody who
 * can act; running it again on a timer would either do nothing, because the
 * node is still full, or make a second server when the first one actually
 * succeeded and only the bookkeeping after it failed. Retrying is a button on
 * the orders page, pressed by a person who has read the reason.
 */
class ProvisionServer implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /** A node under load is not a fast node. */
    public int $timeout = 600;

    public int $tries = 1;

    public function __construct(public int $orderId) {}

    public function handle(): void
    {
        Provision::run($this->orderId);
    }
}
