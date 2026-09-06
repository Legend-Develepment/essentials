<?php

return [
    'nav_label' => 'Schedules',
    'title' => 'Which schedule has stopped',
    'subheading' => 'Every scheduled task on the panel, worst first — stuck for over :hours hours, overdue, or never run.',

    'how' => 'Pelican shows schedules inside each server, and its own status has three words for them: off, processing, active. None of those is "this stopped". A run that crashed part way stays processing for ever and looks exactly like one running now; a schedule whose time passed hours ago because the cron died is still called active. This page asks the other question. Read only — everything that edits, runs or deletes a schedule stays on Pelican\'s own page for that server.',

    'column_state' => 'State',
    'column_name' => 'Schedule',
    'column_server' => 'Server',
    'column_last' => 'Last run',
    'column_next' => 'Next run',

    /*
     * The five verdicts. Written as what is true rather than as an instruction,
     * because three of them are things to look at and two are not.
     */
    'state_stuck' => 'Stuck',
    'state_overdue' => 'Overdue',
    'state_never' => 'Never run',
    'state_healthy' => 'Fine',
    'state_off' => 'Off',

    'filter_stuck' => 'Stuck',
    'filter_overdue' => 'Overdue',
    'filter_never' => 'Never run',
    'filter_off' => 'Switched off',

    'open' => 'Open on the server',

    'empty' => 'No schedules on any server you can reach — or none that have stopped, if you have a filter on.',
];
