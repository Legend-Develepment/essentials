<?php

/*
 * The Announcements page. Its own file rather than a corner of settings.php,
 * because it is a page rather than a preference.
 */

return [
    'title' => 'Announcements',
    'nav_label' => 'Announcements',
    'subheading' => 'Lines across the top of the panel. Each one can be switched off, or given a window of time it shows in.',

    'add' => 'Add an announcement',
    'enabled' => 'On',
    'off' => 'off',

    'starts_at' => 'Show from',
    'starts_at_helper' => 'Leave empty to show it as soon as it is on.',
    'ends_at' => 'Show until',
    'ends_at_helper' => 'Leave empty to leave it up. It takes itself down at this time; nobody has to remember.',

    'saved' => 'Announcements saved',
    'failed' => 'The announcements could not be saved',
];
