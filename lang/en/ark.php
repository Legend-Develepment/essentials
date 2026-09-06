<?php

return [
    /* ------------------------------------------------- the admin tab ----- */

    /*
     * The section heading itself is not here. Every settings section takes its
     * title from settings.groups.<name>, which is what group() builds.
     */
    'section_helper' => 'Which eggs run ARK. Nothing else — the rest of an ARK server is configured by its startup variables, and Pelican\'s own Startup page already edits those.',

    'eggs' => 'Which eggs are ARK',
    'eggs_helper' => 'Tick the eggs that run an ARK server. A World settings page appears inside servers using them and nowhere else. This is a separate question from the one on the status page: that one asks which eggs answer Valve\'s query, which Rust and Valheim do as well, and this one asks which eggs keep GameUserSettings.ini where ARK keeps it, which only ARK does. Nothing is ticked to begin with, on purpose — a plugin cannot know what you have named your eggs.',

    /* ---------------------------------------------- the server's page ---- */

    'nav_label' => 'World settings',
    'title' => 'ARK world settings',
    'subheading' => 'The settings people actually change, from GameUserSettings.ini.',

    'group_server' => 'The server',
    'group_server_helper' => 'What the server is called, who may join, and how many.',
    'group_rates' => 'Rates',
    'group_rates_helper' => 'How fast things happen. 1.0 is the game as it ships; 2.0 is twice as fast.',
    'group_rules' => 'Rules',
    'group_rules_helper' => 'What players may do and what the game shows them.',

    'keeps' => 'Fifteen settings out of a file with hundreds. Everything else in it — your mod settings, keys this plugin has never heard of, the comments and the order of all of it — is left exactly as it is when you save.',
    'missing' => 'This server has no GameUserSettings.ini yet. The game writes it the first time it runs, so start the server once and this page will fill in.',
    'read_only' => 'You may read this file but not write it, so nothing here can be changed.',

    'save' => 'Save',
    'saved' => 'Saved',
    'saved_restart' => 'ARK reads this file when it starts, so restart the server for the change to take effect.',
    'failed' => 'Could not save',
    'failed_write' => 'The daemon refused the write. Check that the server is reachable and that the file is not read only.',
];
