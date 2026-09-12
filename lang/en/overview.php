<?php

/*
 * The shop, in the four numbers somebody asks for first.
 *
 * Written as sentences rather than as labels wherever there is room. A figure
 * with "12%" under it makes somebody work out twelve percent of what; one that
 * says "up 12% on last month" does not.
 */

return [
    'nav_label' => 'Overview',
    'title' => 'Shop overview',
    'subheading' => 'What came in, what is owed, and what needs looking at. Read from the invoices and the orders every time this page is opened, so nothing here can drift from what the other pages say.',

    // ---- the four figures -------------------------------------------------
    'turnover' => 'This month',
    'turnover_up' => 'Up :percent% on last month, which was :amount.',
    'turnover_down' => 'Down :percent% on last month, which was :amount.',
    'turnover_first' => 'Nothing was paid last month, so there is nothing to compare against yet.',

    'recurring' => 'Every month',
    'recurring_note' => 'What the :count live service(s) are worth per month, one-off sales excluded.',

    'outstanding' => 'Outstanding',
    'outstanding_late' => 'Of which :amount is already past its due date.',
    'outstanding_none' => 'Nothing is past its due date.',

    'services' => 'Live services',
    'services_ending' => ':count of them have notice on and stop on their contract date.',
    'services_none_ending' => 'None of them have notice on.',

    // ---- the sentence above everything ------------------------------------
    'attention_pending' => ':count order(s) have been paid for and have no server yet. Open Orders and build them, or read why they failed.',
    'attention_overdue' => 'There are invoices past their due date. Servers stop on their own once the grace period runs out.',

    // ---- a year of it -----------------------------------------------------
    'chart' => 'Paid, by month',
    'chart_none' => 'Nothing has been paid yet, so there is nothing to draw.',

    // ---- when there is nothing to do --------------------------------------
    'clear' => 'Nothing needs attention',
    'clear_body' => 'Every invoice is settled or not yet due, every order has its server, and no package is running out.',

    // ---- the two lists ----------------------------------------------------
    'chasing' => 'Due soon',
    'late' => 'Late -',
    'open_invoice' => 'Open the invoice',
    'stock' => 'Running out',
    'stock_left' => ':count left',
    'stock_gone' => 'Sold out',

    // ---- where the numbers came from --------------------------------------
    'to_orders' => 'All orders',
    'to_invoices' => 'All invoices',
    'to_customers' => 'Customers',
    'to_packages' => 'Packages',
];
