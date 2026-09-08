<?php

/*
 * Orders: what somebody bought, and what became of it.
 *
 * The four states here are about the money rather than about the server.
 * Pending means nothing has been built yet; active means the account is in
 * good standing; suspended means this plugin stopped the server over an
 * unpaid invoice; cancelled means it is finished. Whether the server happens
 * to be running is Pelican's question and is answered on Pelican's pages, and
 * the wording below keeps the two apart on purpose.
 */

return [
    'title' => 'Orders',
    'nav_label' => 'Orders',
    'subheading' => 'Everything that has been bought, the server it became, and where it stands.',

    // ---- the table -------------------------------------------------------
    'column_order' => 'Order',
    'column_customer' => 'Customer',
    'column_package' => 'Package',
    'column_server' => 'Server',
    'column_state' => 'State',
    'column_due' => 'Next due',

    'no_server' => 'Not built yet',
    'no_due' => 'One-off',
    'gone_customer' => 'Account deleted',
    'gone_package' => 'Package deleted',
    'overdue_days' => ':days days overdue',

    'state_pending' => 'Waiting',
    'state_active' => 'Active',
    'state_suspended' => 'Suspended',
    'state_cancelled' => 'Cancelled',

    // ---- the buttons -----------------------------------------------------
    'retry' => 'Build again',
    'retry_confirm' => 'Queues the build once more. Nothing else changes, and the invoice stays paid.',
    'retrying' => 'Queued',

    'suspend' => 'Suspend',
    'suspend_confirm' => 'Stops the server with Pelican\'s own suspension. Files, databases and backups are left where they are, and paying the invoice lifts it again.',
    'suspended' => 'Suspended',

    'unsuspend' => 'Unsuspend',
    'unsuspended' => 'Running again',

    'change_due' => 'Change next due',
    'change_due_helper' => 'When the next invoice is written. Empty means never - the order stops renewing without being cancelled.',

    'cancel' => 'Cancel',
    'cancel_confirm' => 'Stops the renewals and gives the place in stock back. The server is left alone: deleting one is done in Pelican, where it belongs.',
    'cancelled' => 'Cancelled',

    'saved' => 'Saved',
    'refused' => 'Nothing changed',
    'refused_body' => 'The order is not in a state where that could be done. Reload the page and look at it again.',

    // ---- what the customer hears -----------------------------------------
    'bell_ready' => 'Your server is ready',
    'bell_ready_body' => ':server has been created and is waiting for you to start it.',
    'bell_suspended' => 'Your server has been suspended',
    'bell_suspended_body' => 'An invoice went unpaid past its grace period. Paying it starts the server again; nothing has been deleted.',

    // ---- what the administrator hears ------------------------------------
    'bell_failed' => 'Order :number could not be built',
    'no_allocation' => 'No node in this package has a free allocation. Add one, then build again.',
    'no_reason' => 'The panel refused it without saying why.',

    // ---- the server it becomes -------------------------------------------
    'server_description' => 'Bought through the shop, order :number.',
    'server_fallback' => 'Server',

    'empty' => 'Nothing has been bought yet',
    'empty_body' => 'Orders appear here the moment somebody buys a package.',

    // ---- renewals --------------------------------------------------------
    'filter_late' => 'Behind on a bill',
    'run_renewals' => 'Run renewals now',
    'run_renewals_confirm' => 'Does what the nightly pass does: writes the next invoice for anything due soon, and stops the servers behind a bill that has gone unpaid past the grace period.',
    'renewals_queued' => 'Queued',
    'renewals_queued_body' => 'It runs on the queue. Refresh in a moment to see what changed.',
];
