<?php

/*
 * Backups, panel-wide.
 *
 * Pelican answers "what backups does this server have". This page answers the
 * inverse, which is the question an administrator actually has and which the
 * panel has nowhere to put: which of mine has none.
 */

return [
    'title' => 'Backups',
    'nav_label' => 'Backups',
    'subheading' => 'Every server you can reach, with how long it has gone without one. Servers that have never been backed up are at the top; anything older than :days days counts as stale.',

    // ---- the table --------------------------------------------------------
    'column_server' => 'Server',
    'column_last' => 'Last backup',
    'column_kept' => 'Kept',
    'column_size' => 'Size',
    'column_failed' => 'Failed',

    'never' => 'Never',

    'filter_none' => 'Never backed up',
    'filter_stale' => 'Stale',
    'filter_failed' => 'Failing',

    'open' => 'Open in Pelican',
];
