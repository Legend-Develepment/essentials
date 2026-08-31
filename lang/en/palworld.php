<?php

/*
 * Palworld's world settings, on a page instead of in a file.
 *
 * Nothing here names a setting. Every label on that page is worked out from the
 * key the server's own file holds - see Support\Palworld\Palworld::label() for
 * why a list of names would be worse than none at all.
 */

return [
    'title' => 'Palworld settings',
    'nav_label' => 'Palworld',
    'subheading' => 'The world settings from this server\'s own PalWorldSettings.ini, read when you opened this page. Only editable while the server is stopped.',

    'reload' => 'Read the file again',

    'save_confirm' => 'The file is rewritten with these values. Every setting this page did not show is written back exactly as it was, and so is everything else in the file.',
    'saved' => 'Settings saved',
    'saved_body' => 'They take effect the next time the server starts.',
    'save_failed' => 'Could not write the file',

    'running' => 'The server is running',
    'running_body' => 'Palworld keeps these settings in memory and writes the file out again when it stops, so a change saved now would be undone without a word. Stop the server first.',

    'groups' => [
        'server' => 'Server and connection',
        'world' => 'World and rates',
        'pals' => 'Pals',
        'players' => 'Players',
        'building' => 'Building, items and gathering',
        'guild' => 'Guilds',
        'other' => 'Other',
    ],
];
