<?php

/*
 * Payments: every attempt to pay, and what the provider said about it.
 *
 * One row per attempt rather than per invoice, because that is what happened.
 * The word this page keeps saying is "attempt": a payment that failed is a
 * fact worth keeping, not a mistake to hide, and an administrator looking at
 * one wants to know what the provider actually answered.
 */

return [
    'title' => 'Payments',
    'nav_label' => 'Payments',
    'subheading' => 'Every attempt to pay, through every provider. Re-check asks the provider again, which is the same thing their webhook does when it arrives.',

    // ---- the table -------------------------------------------------------
    'column_invoice' => 'Invoice',
    'column_gateway' => 'Provider',
    'column_reference' => 'Their reference',
    'column_amount' => 'Amount',
    'column_state' => 'State',
    'column_updated' => 'Last heard',

    'gone_invoice' => 'Invoice deleted',

    'state_open' => 'Waiting',
    'state_paid' => 'Paid',
    'state_failed' => 'Failed',
    'state_cancelled' => 'Cancelled',

    // ---- the buttons -----------------------------------------------------
    'recheck' => 'Re-check',
    'rechecked' => 'Asked again',
    'rechecked_body' => 'The provider still does not say it is paid. Nothing changed.',
    'settled' => 'It is paid',
    'settled_body' => 'The invoice is settled and anything waiting on it is on its way.',
    'recheck_failed' => 'Could not ask',
    'recheck_failed_body' => 'The provider did not answer. Try again in a minute; if it keeps happening, check the key on the Shop settings page.',
    'no_gateway' => 'That provider is switched off',
    'no_gateway_body' => 'Switch it back on to ask about this payment, or mark the invoice paid by hand.',

    'answer' => 'Their answer',
    'no_answer' => 'Nothing recorded',
    'close' => 'Close',

    'empty' => 'Nobody has paid through a provider yet',
    'empty_body' => 'Attempts show up here the moment somebody presses Pay, whether they finish or not.',
];
