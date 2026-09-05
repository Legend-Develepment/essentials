<?php

return [
    /* ------------------------------------------------- the admin tab ----- */

    'section_helper' => 'Which eggs run Valheim. Nothing else — a Valheim server is configured by its startup variables, and Pelican\'s own Startup page already edits those.',

    'eggs' => 'Which eggs are Valheim',
    'eggs_helper' => 'Tick the eggs that run a Valheim server. A Player lists page appears inside servers using them and nowhere else. Where those lists live differs by egg, so it is worked out per server by looking in the places the game uses. Nothing is ticked to begin with, on purpose — a plugin cannot know what you have named your eggs.',

    /* ---------------------------------------------- the server's page ---- */

    'nav_label' => 'Player lists',
    'title' => 'Valheim player lists',
    'subheading' => 'Admins, bans and the permitted list, as three lists instead of three text files.',

    'admin' => 'Admins',
    'admin_helper' => 'Everyone here can use the admin commands in game.',
    'banned' => 'Banned',
    'banned_helper' => 'Everyone here is refused when they try to join.',
    'permitted' => 'Permitted',
    'permitted_helper' => 'If this list has anybody in it, only these people may join. An empty list lets everybody in — which is what most servers want, so leave it empty unless you mean it.',

    'ids' => 'Player IDs',
    'ids_placeholder' => 'Paste an ID and press space',

    'how' => 'One ID per player — a SteamID64 on a Steam server, a PlayFab ID on a crossplay one. Paste them in and press space, tab or comma. Anything the game wrote as a comment above the list stays where it is.',
    'where' => 'Read from :dir.',
    'missing' => 'This server has none of these files yet. The game writes them when it first needs them, and saving here will create the ones you fill in.',
    'read_only' => 'You may read these files but not write them, so nothing here can be changed.',

    'save' => 'Save',
    'saved' => 'Saved',
    'saved_reload' => 'Valheim reads these lists while it runs, so the change applies without a restart.',
    'unchanged' => 'Nothing had changed, so nothing was written',
    'failed' => 'Could not save',
    'failed_lists' => 'The daemon refused the write for: :lists. Check that the server is reachable and that the files are not read only.',
];
