<?php

/*
 * The page that answers "which of mine is behind".
 *
 * Written for the person whose servers they are, not for whoever runs the
 * panel - so nothing here mentions nodes, and nothing offers a number they
 * cannot act on. Every line either names a server they can open or says what to
 * do about one.
 */

return [
    'title' => 'Needs attention',
    'nav_label' => 'Needs attention',
    'subheading' => 'Your servers, sorted by what is behind rather than by name. A backup is called stale after :days days.',

    'column_server' => 'Server',
    'column_last' => 'Last backup',
    'column_kept' => 'Kept',
    'column_schedules' => 'Stopped tasks',

    'never' => 'Never',

    'filter_none' => 'Never backed up',
    'filter_stale' => 'Backup is stale',

    'open' => 'Backups',

    /*
     * The good case, and it is worth writing properly. Somebody who opens this
     * page and finds nothing should be told that is the answer, not left
     * looking at an empty table wondering whether it failed to load.
     */
    'empty' => 'Nothing is behind',
    'empty_body' => 'Every server you can reach has a recent backup and no stopped tasks. This page fills itself in when that stops being true.',
];
