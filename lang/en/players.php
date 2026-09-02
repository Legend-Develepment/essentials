<?php

return [
    'nav_label' => 'Players',
    'title' => 'Players',
    'subheading' => 'The whitelist, the operators, the bans, and everyone this server has seen.',

    /*
     * Said once, near the top, because it explains both what the page can do
     * and why one thing it cannot is not a bug. Every change is issued as a
     * console command, which is how Minecraft is meant to be told - the game
     * makes the change and writes its own file, so the two never disagree.
     */
    'how' => 'Changes are sent to the server as console commands, so the game makes them and writes its own files. That needs the server to be running.',
    'needs_running' => 'The server has to be running. These changes are made by the game, not by editing its files underneath it.',

    'name' => 'Player name',
    'reason' => 'Reason (optional)',

    'whitelist' => 'Add to whitelist',
    'unwhitelist' => 'Remove from whitelist',
    'op' => 'Make operator',
    'deop' => 'Remove operator',
    'ban' => 'Ban',
    'pardon' => 'Unban',
    'kick' => 'Kick',

    'sent' => 'Command sent',
    'sent_body' => 'The server applies it and updates its own files. Reload the page to see the lists change.',
    'refused' => 'That was not sent',

    'flag_op' => 'Operator',
    'flag_whitelisted' => 'Whitelisted',
    'flag_banned' => 'Banned',
    'flag_seen' => 'Has played here',

    'players' => 'Players',
    'ips' => 'Banned addresses',
    'ips_empty' => 'No addresses are banned.',

    /*
     * What an empty page means, which is usually not "no players" but "this
     * server has never started". Minecraft creates none of these files until
     * its first run.
     */
    'empty' => 'Nothing to show yet. Minecraft writes these lists itself, and it does not create them until the server has started for the first time.',

    'level' => 'Level :level',

    /*
     * The one thing this page does not do, said rather than left to be
     * discovered. Live status needs a second connection to the game itself,
     * which is a different feature with its own requirements.
     */
    'not_live' => 'This is what the server has written down, not who is on right now.',
];
