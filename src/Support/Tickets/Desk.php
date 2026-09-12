<?php

namespace LegendDevelopment\Theme\Support\Tickets;

use LegendDevelopment\Theme\Models\Ticket;
use LegendDevelopment\Theme\Models\TicketMessage;

/**
 * Where a question actually gets answered.
 *
 * Two of these, and the shape of them is the whole design.
 *
 * **Nothing here writes anything down.** The ticket and every message on it are
 * already in this panel's own tables before a desk is asked to do anything -
 * see Board. A desk mirrors what is already recorded, and a desk that could not
 * be reached is a mirror that is out of date rather than a question that was
 * lost. That rule is the reason this is an interface and not a choice made in
 * four places.
 *
 * **Every method may fail, and failing is ordinary.** A network is a network.
 * What a caller does about false is show a line saying the answer has not been
 * passed on yet, never lose the thing somebody typed.
 *
 * **The panel's own desk implements all of this by doing nothing**, and that is
 * not a stub. When the panel answers its own tickets, the local tables are the
 * whole truth and there is nothing to mirror; saying so in one class is what
 * keeps every caller free of "which one is this again".
 */
interface Desk
{
    /** The short name this desk is stored and chosen under. */
    public function key(): string;

    /** Whether an administrator has switched it on and given it what it needs. */
    public function enabled(): bool;

    /**
     * Whether it will answer with what it has been given.
     *
     * Null when it will. A sentence when it will not, said in words an
     * administrator can act on - which key, which scope - rather than a status
     * code they have to look up. Nothing is created by asking.
     */
    public function check(): ?string;

    /**
     * Say that this ticket exists.
     *
     * Writes the far end's own id back onto the ticket when there is one, so
     * everything after this can find it again. A desk that keeps no id of its
     * own leaves it null, which is what the panel's own does.
     */
    public function open(Ticket $ticket): bool;

    /** Pass a message on to wherever it is answered. */
    public function say(Ticket $ticket, TicketMessage $message): bool;

    /** Say that it is finished. */
    public function close(Ticket $ticket): bool;

    /**
     * Bring back anything said at the far end that is not here yet.
     *
     * @return int How many messages that was.
     */
    public function pull(Ticket $ticket): int;

    /**
     * Whether the far end still considers this open.
     *
     * True for open, false for finished, null for "cannot say" - and those are
     * three answers rather than two on purpose: a desk that could not be
     * reached must not be read as a desk saying the ticket is over.
     *
     * Asked because a ticket closed in Discord was staying open here. An event
     * says so the moment it happens, but only on a panel Modora can reach and
     * only once somebody has set that up; asking is what makes it true
     * everywhere else.
     */
    public function stillOpen(Ticket $ticket): ?bool;
}
