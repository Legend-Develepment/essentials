<?php

/*
 * The top bar's switcher, and the page it leads to.
 *
 * One control answering two questions people ask constantly - which server, and
 * where were those settings - and a page listing everything somebody starred.
 * See Support\Quick.
 */

return [
    // ---- the control in the top bar ------------------------------------
    'label' => 'Go to',
    'open' => 'Go to a server or a starred page',
    'search' => 'Search servers…',

    'favourites' => 'Favourites',
    'servers' => 'Servers',
    'pages' => 'Pages',

    'loading' => 'Looking…',
    'empty' => 'Nothing found.',
    // Said rather than hidden: a list that quietly stops at twenty-five looks
    // like a search that cannot find things.
    'more' => 'More matches than fit here — type a little more.',
    'failed' => 'The panel could not be reached, so this list may be out of date. The browser console says what the request answered.',

    'star_page' => 'Star this page',
    'unstar_page' => 'Starred — click to remove',
    'all' => 'See all',

    // ---- the page --------------------------------------------------------
    'title' => 'Favourites',
    'nav_label' => 'Favourites',
    'subheading' => 'Everything you have starred, in one place.',

    'how' => 'Star a server with the star on its card in the server list, and a page with the button in the Go to menu at the top of the screen. Your list is kept on the panel rather than in this browser, so it follows you to whatever you next sign in on.',
    'page_empty' => 'Nothing starred yet.',
    'remove' => 'Remove from favourites',
];
