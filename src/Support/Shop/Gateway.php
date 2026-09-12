<?php

namespace LegendDevelopment\Theme\Support\Shop;

use Illuminate\Http\Request;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Payment;

/**
 * What every payment provider has to be able to do.
 *
 * Four methods, and the shape of them is the whole design.
 *
 * **start()** takes an invoice and hands back somewhere to send the customer.
 * It records a Payment row in the same breath, because a redirect to a
 * provider with nothing written down here is money that might arrive with
 * nothing to attach it to.
 *
 * **webhook()** turns whatever the provider posted into one of our Payment
 * rows, or null. It does not decide anything: verifying the request is its
 * job, and what happens next is not.
 *
 * **settle()** re-reads the provider and, if they say paid, calls
 * Invoices::markPaid(). This is the only method that moves money into the
 * books, and it is deliberately the one called from two places - the webhook
 * and the customer's return - because either can arrive first and neither can
 * be relied on to arrive at all.
 *
 * **A provider is never trusted about the amount from a request body.** Every
 * implementation re-reads the payment from the provider's own API before
 * settling. A webhook body is a message from the internet; an authenticated
 * read is an answer.
 */
interface Gateway
{
    /** The short name this provider is stored and routed under. */
    public function key(): string;

    /** Whether an administrator has switched it on and given it what it needs. */
    public function enabled(): bool;

    /**
     * Whether this provider will accept the keys it has been given.
     *
     * Null when it will. A sentence when it will not, said in words an
     * administrator can act on - which key, which environment - rather than a
     * status code they have to look up.
     *
     * Nothing is created by asking. Every provider here has an endpoint that
     * authenticates and answers, and that is what this uses.
     */
    public function check(): ?string;

    /**
     * Begin a payment.
     *
     * Records a Payment in the `open` state and answers with the URL the
     * customer should be sent to. Null when the provider refused or could not
     * be reached - the caller turns that into a sentence on the page rather
     * than a 500.
     */
    public function start(Invoice $invoice, string $returnUrl, string $webhookUrl): ?string;

    /**
     * The provider is telling us something.
     *
     * Answers with the Payment the message is about, or null when the request
     * cannot be verified or names nothing we know. Nothing is settled here.
     */
    public function webhook(Request $request): ?Payment;

    /**
     * Ask the provider what actually happened, and act on the answer.
     *
     * @return bool Whether this call is the one that marked the invoice paid.
     */
    public function settle(Payment $payment): bool;

    /**
     * Send part or all of a payment back where it came from.
     *
     * True only when the provider says the money is on its way. False is not a
     * fault to hide - a payment too old to reverse, a provider without the
     * balance to do it, a method that never supported it - so the caller offers
     * the customer credit instead rather than turning this into an error.
     *
     * **Nothing here records anything.** A refund that went through still has
     * to be written down as a credit note and against the payment, and that is
     * one job done in one place - see Refunds::give(). A gateway that wrote its
     * own would be a fourth implementation of the same bookkeeping.
     *
     * @param  int  $amount  Minor units, and never more than is left on the
     *                       payment. The caller checks that; a provider that
     *                       refuses an over-refund is the second line of
     *                       defence and not the first.
     */
    public function refund(Payment $payment, int $amount): bool;
}
