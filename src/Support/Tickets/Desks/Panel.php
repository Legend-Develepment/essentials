<?php

namespace LegendDevelopment\Theme\Support\Tickets\Desks;

use LegendDevelopment\Theme\Models\Ticket;
use LegendDevelopment\Theme\Models\TicketMessage;
use LegendDevelopment\Theme\Support\Tickets\Desk;

/**
 * The panel answers its own tickets.
 *
 * Every method does nothing and says it worked, and that is the correct
 * implementation rather than a stub waiting to be filled in. Board has already
 * written the ticket and the message to this panel's own tables by the time a
 * desk is asked; when the panel is the desk, there is nowhere else for them to
 * go and nothing to bring back.
 *
 * Saying that in a class of its own is what keeps it out of everywhere else. A
 * `if ($desk === 'panel')` at each of the five call sites is five places for
 * the fifth one to be forgotten.
 */
class Panel implements Desk
{
    public const KEY = 'panel';

    public function key(): string
    {
        return self::KEY;
    }

    /**
     * Always. It needs nothing and cannot be misconfigured, which is the
     * reason it is the one a panel falls back to.
     */
    public function enabled(): bool
    {
        return true;
    }

    public function check(): ?string
    {
        return null;
    }

    public function open(Ticket $ticket): bool
    {
        return true;
    }

    public function say(Ticket $ticket, TicketMessage $message): bool
    {
        return true;
    }

    public function close(Ticket $ticket): bool
    {
        return true;
    }

    public function pull(Ticket $ticket): int
    {
        return 0;
    }

    /**
     * Null rather than true: there is no far end, so there is nothing that
     * could have a different opinion about this.
     */
    public function stillOpen(Ticket $ticket): ?bool
    {
        return null;
    }
}
