<?php

/*
 * Terraria, and only what is about Terraria.
 *
 * Six strings. The words the page itself uses - Save, what to say when the file
 * is not there, what the raw field names mean - are in games.php and shared with
 * every game, which is what makes a third one cheap. See roadmap/games.md.
 */

return [
    /* ------------------------------------------- the settings page ------ */

    'section_helper' => 'Which eggs run Terraria. Nothing else - the rest of a Terraria server is configured by its startup variables, and the Startup page Pelican has already edits those.',
    'eggs' => 'Which eggs are Terraria',
    'eggs_helper' => 'Tick the eggs that run a Terraria server, vanilla or tModLoader. A Server settings page appears inside servers using them and nowhere else. Nothing is ticked to begin with, on purpose: a plugin cannot know what you have named your eggs.',

    /* ------------------------------------------ the server's page ------- */

    'nav_label' => 'Server settings',
    'title' => 'Terraria server settings',
];
