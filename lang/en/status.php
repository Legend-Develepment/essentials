<?php

/*
 * The public status page.
 *
 * The only thing this plugin serves to somebody who is not signed in, and the
 * only page whose wording has to be read as though a stranger will see it -
 * because one will. Nothing here says which node, which owner, or which
 * address; a name, whether it is up, and how many people are on it.
 */

return [
    // ---- the settings page ------------------------------------------------
    'title' => 'Public status page',
    'nav_label' => 'Status page',
    'subheading' => 'A page anybody can open, without an account, showing which of your servers are up. Nothing appears on it until you name a server below.',

    'address' => 'Your status page is live at',
    'address_off' => 'Nothing is being served yet. Add a server below and save, and the address appears here.',

    'which' => 'What is published',
    'which_helper' => 'The list starts empty and nothing is public until something is in it. Only servers you can already open are offered.',
    'add' => 'Publish a server',
    'server' => 'Server',
    'shown_as' => 'Shown as',
    'shown_as_helper' => 'What the public sees. Type it rather than letting the panel use the real name — "mc-prod-3 (do not touch)" is a note to yourself, not a thing to put on a forum.',

    'look' => 'Wording',
    'look_helper' => 'Everything on this page is read by people who do not have an account.',
    'heading' => 'Heading',
    'heading_helper' => 'Left empty, the panel\'s own name is used.',
    'note' => 'A line above the list',
    'note_helper' => 'For saying what is going on — a maintenance window, or where to ask. Plain text.',
    'link' => 'Link to the panel',
    'link_helper' => 'A way back in at the bottom of the page. Switch it off if you would rather not advertise where your panel is.',

    'save' => 'Save',
    'saved' => 'Saved',
    'save_failed' => 'Nothing was saved',
    'open' => 'Open the page',

    // ---- the page itself --------------------------------------------------
    'up' => 'Online',
    'down' => 'Offline',
    'starting' => 'Starting',

    /*
     * Not "offline", and the difference matters in public.
     *
     * The panel could not reach the server. That is usually a node in
     * maintenance or a daemon restarting - it is not the same as the server
     * being off, and telling a hundred players their server is down when it is
     * running is worse than admitting to not knowing.
     */
    'unknown' => 'Unknown',

    'players' => 'Players',
    'checked' => 'Checked',
    'panel' => 'Sign in',

    'all_up' => 'Everything is running.',
    'some_down' => 'Something is not running.',
    'empty' => 'Nothing is being published here yet.',
];
