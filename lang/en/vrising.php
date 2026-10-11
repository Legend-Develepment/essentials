<?php

/*
 * V Rising, and only what is about V Rising.
 *
 * Six strings, which is what a game costs. The words the page itself uses are
 * in games.php and shared with every game that edits a file, which is what
 * makes the next one cheap. See roadmap/games.md.
 */

return [
    /* ------------------------------------------- the settings page ------ */

    'section_helper' => 'Which eggs run V Rising. Nothing else - the rest of a V Rising server is configured by its startup variables, and the Startup page Pelican has already edits those.',
    'eggs' => 'Which eggs are V Rising',
    'eggs_helper' => 'Tick the eggs that run a V Rising server. A Server settings page appears inside servers using them and nowhere else. Nothing is ticked to begin with, on purpose: a plugin cannot know what you have named your eggs.',

    /* ------------------------------------------ the server's page ------- */

    'nav_label' => 'Server settings',
    'title' => 'V Rising server settings',
];
