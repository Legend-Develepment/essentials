<?php

/*
 * Invoices: the document, the page listing them, and the mail.
 *
 * Three readers share this file. An administrator reads the table and presses
 * "mark paid"; a customer reads the printable document and the mail; and the
 * document itself is read months later by somebody doing their books. The
 * last of those is why the doc_ keys are plain and formal - an invoice is not
 * the place for the tone the rest of the panel uses.
 */

return [
    'title' => 'Invoices',
    'nav_label' => 'Invoices',
    'subheading' => 'What is owed and what has been paid. Marking one paid here does everything paying it would: the server gets built, a suspended one comes back.',

    // ---- the table -------------------------------------------------------
    'column_number' => 'Invoice',
    'column_customer' => 'Customer',
    'column_order' => 'Order',
    'column_total' => 'Total',
    'column_state' => 'State',
    'column_due' => 'Due',

    'kind_order' => 'First invoice',
    'kind_renewal' => 'Renewal',

    'state_unpaid' => 'Unpaid',
    'state_paid' => 'Paid',
    'state_cancelled' => 'Withdrawn',

    'no_order' => 'No order',
    'no_due' => 'No date',
    'gone_customer' => 'Account deleted',
    'discount_of' => ':amount off with :code',
    'paid_via' => 'through :how',
    'emailed' => 'Emailed',
    'not_emailed' => 'Not emailed',
    'filter_overdue' => 'Past due',

    // ---- the buttons -----------------------------------------------------
    'open' => 'Open',
    'mark_paid' => 'Mark paid',
    'mark_paid_confirm' => 'Records that the money arrived. The server is built, a suspended one starts again, and the next due date moves on - the same as if a payment provider had said so.',
    'paid' => 'Marked paid',
    'paid_body' => 'Anything waiting on this invoice is on its way.',
    'already_paid' => 'It was already paid',

    'withdraw' => 'Withdraw',
    'withdraw_confirm' => 'Takes the invoice off the books. Only an unpaid one can be withdrawn; a paid invoice is a record of money that changed hands.',
    'withdrawn' => 'Withdrawn',
    'withdraw_refused' => 'Only an unpaid invoice can be withdrawn',

    'empty' => 'No invoices yet',
    'empty_body' => 'One is written the moment somebody buys, and again each period for anything that renews.',

    // ---- the document ----------------------------------------------------
    'doc_title' => 'Invoice',
    'doc_number' => 'Number',
    'doc_issued' => 'Issued',
    'doc_due' => 'Due',
    'doc_paid_on' => 'Paid',
    'doc_billed_to' => 'Billed to',
    'doc_from' => 'From',
    'doc_description' => 'Description',
    'doc_amount' => 'Amount',
    'doc_subtotal' => 'Subtotal',
    'doc_discount' => 'Discount',
    'doc_total' => 'Total',
    'doc_how_to_pay' => 'How to pay',
    'doc_print' => 'Print or save as PDF',
    'doc_back' => 'Back to the panel',

    // ---- the mail --------------------------------------------------------
    'mail_subject' => 'Invoice :number',
    'mail_hello' => 'Hello :name,',
    'mail_intro' => 'Here is invoice :number.',
    'mail_open' => 'Open the invoice',
    'mail_foot' => 'You can read this invoice any time on your billing page.',

    // ---- the bell --------------------------------------------------------
    'bell_new' => 'Invoice :number',
    'bell_new_body' => ':total is due. Open your billing page to pay it.',
    'bell_reminder' => 'Invoice :number is past its date',
    'bell_reminder_body' => 'It is still open for :total. The server it pays for stops on :date if it has not been settled by then, and nothing on it is deleted when that happens.',
];
