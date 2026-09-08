<?php

/*
 * Customers: the shop, facing the person instead of the row.
 *
 * Orders, invoices and payments are each a list of things that happened. This
 * page asks the question somebody answering a ticket actually has - who is
 * this, what do they hold, what have they paid, what is still outstanding -
 * and the words here are chosen for that moment rather than for a report.
 *
 * "Customer" means somebody who has ordered. A panel with four hundred users
 * and nine customers shows nine rows, and the empty state says so.
 */

return [
    'title' => 'Customers',
    'nav_label' => 'Customers',
    'subheading' => 'Everybody who has bought something, with what they hold, what they have paid and what is still owed.',

    // ---- the table -------------------------------------------------------
    'column_customer' => 'Customer',
    'column_services' => 'Services',
    'column_spent' => 'Paid',
    'column_outstanding' => 'Outstanding',

    'of_orders' => 'of :count ordered',
    'nothing_owed' => 'Nothing',

    'filter_owing' => 'Owes something',
    'filter_active' => 'Has an active service',

    // ---- one of them -----------------------------------------------------
    'open' => 'Open',
    'close' => 'Close',
    'servers' => 'Servers',
    'since' => 'Customer since',
    'their_services' => 'Services',
    'their_invoices' => 'Invoices',
    'no_services' => 'Nothing active, and nothing waiting to be built.',
    'no_invoices' => 'No invoices have been written for this account.',

    'empty' => 'Nobody has bought anything yet',
    'empty_body' => 'This lists people who have ordered, not everybody with an account, so it fills up with the first sale.',
];
