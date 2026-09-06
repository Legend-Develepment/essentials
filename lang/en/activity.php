<?php

return [
    'nav_label' => 'Activity',
    'title' => 'What happened on this panel',
    'subheading' => 'Every logged event, newest first — not one server at a time.',

    'more' => 'About this page',
    'how' => 'The same log Pelican keeps and shows on each server\'s own Activity tab, asked the other way round. Read only: nothing here deletes a line, and how long lines are kept is Pelican\'s own setting under Settings → Misc.',
    'empty' => 'Nothing has been logged yet, or nothing that you can see. You see events on the servers you can reach, plus events about the panel itself.',

    'column_what' => 'What',
    'column_who' => 'Who',
    'column_where' => 'Server',
    'column_when' => 'When',

    'filter_event' => 'Event',
    'filter_who' => 'Who',
    'filter_today' => 'Today only',
    'filter_servers' => 'About a server',
    'filter_panel' => 'About the panel itself',

    /*
     * Two different things, and worth keeping apart: nobody at all was the
     * panel acting on its own, and an actor who has gone is an account that was
     * deleted after the line was written.
     */
    'system' => 'The panel',
    'gone' => 'A deleted account',

    'open' => 'Open on the server',

    'ip_hidden' => 'Addresses are hidden. They show in the tooltip for anyone holding Pelican\'s own "see IPs" permission on the activity log.',
];
