<?php

/*
 * Don't Starve Together, and only what is about Don't Starve Together.
 *
 * Six strings, which is what a game costs. The words the page itself uses are
 * in games.php and shared with every game that edits a file, which is what
 * makes the next one cheap. See roadmap/games.md.
 */

return [
    /* ------------------------------------------- the settings page ------ */

    'section_helper' => 'Which eggs run Don\'t Starve Together. Nothing else - the rest of a Don\'t Starve Together server is configured by its startup variables, and the Startup page Pelican has already edits those.',
    'eggs' => 'Which eggs are Don\'t Starve Together',
    'eggs_helper' => 'Tick the eggs that run a Don\'t Starve Together server. A Server settings page appears inside servers using them and nowhere else. Nothing is ticked to begin with, on purpose: a plugin cannot know what you have named your eggs.',

    /* ------------------------------------------ the server's page ------- */

    'nav_label' => 'Server settings',
    'title' => 'Don\'t Starve Together server settings',
];
