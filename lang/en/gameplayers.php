<?php

/*
 * Who is on a server, for the games that answer Valve's query.
 *
 * One page for Rust, ARK, Valheim and the rest, because they answer the same
 * packet. What differs per game is what you can do to somebody - kicking is
 * `kick "name"` on one and `KickPlayer <id>` on another - and that is why this
 * page reads and does not act.
 */

return [
    'title' => 'Players',
    'nav_label' => 'Players',
    'subheading' => 'Who is connected, asked of the game itself rather than of the panel.',

    'refresh' => 'Ask again',

    'count' => ':count connected',
    'score' => 'Score',

    'just_joined' => 'just joined',
    'minutes' => ':count min',
    'hours' => ':count h',
    'hours_minutes' => ':hours h :minutes min',

    'empty' => 'Nobody is on this server.',

    /*
     * Not "nobody is on", and the difference matters.
     *
     * The panel and the game port are often on networks that cannot reach each
     * other, and drawing that as an empty list would be this page saying
     * something it does not know.
     */
    'unreachable' => 'The server did not answer. It may be starting, or the panel may not be able to reach its game port from where it runs — that is a different thing from nobody being on it.',
];
