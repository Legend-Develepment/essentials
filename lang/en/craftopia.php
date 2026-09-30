<?php

/*
 * Craftopia, and only what is about Craftopia.
 *
 * Six strings, which is what a game costs. The words the page itself uses are
 * in games.php and shared with every game that edits a file, which is what
 * makes the next one cheap. See roadmap/games.md.
 */

return [
    /* ------------------------------------------- the settings page ------ */

    'section_helper' => 'Which eggs run Craftopia. Nothing else - the rest of a Craftopia server is configured by its startup variables, and the Startup page Pelican has already edits those.',
    'eggs' => 'Which eggs are Craftopia',
    'eggs_helper' => 'Tick the eggs that run a Craftopia server. A Server settings page appears inside servers using them and nowhere else. Nothing is ticked to begin with, on purpose: a plugin cannot know what you have named your eggs.',

    /* ------------------------------------------ the server's page ------- */

    'nav_label' => 'Server settings',
    'title' => 'Craftopia server settings',
];
