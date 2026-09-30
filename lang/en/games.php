<?php

/*
 * The words every game settings page uses.
 *
 * Shared because that is where the cost of a game turned out to be. A page's
 * own list of settings costs nothing to translate - a key in a config file is
 * the same string in every language, and the two pages that exist both derive
 * their field names from it. What a game actually costs is its page: the title,
 * the sentence under it, what to say when the file is not there yet, and what
 * to say when the daemon refuses a write.
 *
 * None of that is about any particular game, so none of it is repeated per
 * game. A third game needs six strings of its own rather than eighteen.
 *
 * See roadmap/games.md.
 */

return [
    'save' => 'Save',
    'saved' => 'Saved',
    'restart' => 'The game reads this file when it starts, so restart the server for the change to take effect.',
    'failed' => 'Could not save',
    'failed_write' => 'The daemon refused the write. Check that the server is reachable and that the file is not read only.',
    'read_only' => 'You may read this file but not write it, so nothing here can be changed.',
    'missing' => 'This server has no settings file yet. The game writes it the first time it runs, so start the server once and this page will fill in.',
    'keeps' => 'Everything else in the file - the comments, the blank lines, the order of it and every key this plugin has never heard of - is left exactly as it was when you save.',
    'raw' => 'The names here are the names the game uses, in the order the file has them. Nothing is translated and nothing is grouped, because this page reads the file rather than a list somebody wrote out - so it shows every setting the game understands, including ones added after this release.',
    'unset' => 'Not set. The game mentions it as an example; filling this in adds it.',
    'group_all' => 'Settings',
    'group_all_helper' => 'Everything this file mentions.',
    'subheading' => 'Drawn from :files rather than from a list somebody wrote out.',
];
