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


    // ---- nodes -------------------------------------------------------------
    'nodes' => 'Machines',
    'nodes_helper' => 'Up or down, and nothing else. Not the load and not how full the disk is — a visitor asking whether they can play does not need a capacity report on your hardware, and publishing one is a map of where the pressure is.',
    'add_node' => 'Publish a machine',
    'node' => 'Machine',
    'node_shown_as_helper' => 'Type it. A node is usually called something like hetzner-fsn1-01, and that is a sentence about where your machines are.',

    // ---- HTTP monitors -----------------------------------------------------
    'monitors' => 'Other services',
    'monitors_helper' => 'Anything else worth knowing is up: your website, an API, a bot\'s health endpoint. The panel asks each one on the same timer as the servers. Administrators only — a monitor makes this panel fetch an address, and letting anybody add one turns it into a probe they can point wherever they like.',
    'add_monitor' => 'Add a service',
    'monitor_name' => 'Name',
    'monitor_url' => 'Address',
    'monitor_url_helper' => 'https only. This panel fetching plain http on a timer would tell anybody on the path which of your services exist.',
    'monitor_expect' => 'Expect',
    'monitor_expect_helper' => 'Leave empty for "any answer at all", which is right for a site that redirects or returns 403 to a bare request. A number is for an endpoint written to say exactly that and nothing else — set it too strictly and the row is red for ever on a service that is fine.',

    // ---- user pages --------------------------------------------------------
    'users' => 'Pages for your users',
    'users_helper' => 'Whether people with servers on this panel may publish a status page of their own.',
    'user_pages' => 'Let users make their own',
    'user_pages_helper' => 'Each gets an address of their own at /status/their-slug, showing only servers they own, under names they type. No machines and no other services on those — both are yours alone. Once this is on, they will find it under Status page in their account menu, on whichever panel they happen to be in.',

    // ---- the look ----------------------------------------------------------
    'style' => 'Style',
    'style_helper' => 'One of the panel\'s own looks, applied to this page: its colour, the greys built from its surface, and how round the corners are. Follow the panel means whatever the panel is set to today, including anything changed later.',
    'style_mine_helper' => 'The styles this panel offers, applied to your page: a colour, the greys built from it, and how round the corners are. Which styles are on this list is the panel owner\'s to decide — the same list you can pick from under Appearance. Follow the panel means whatever the panel is set to.',
    'style_panel' => 'Follow the panel',
    'accent' => 'Accent colour',
    'accent_helper' => 'Overrides just the colour of the style above. Leave empty to use the style\'s own.',
    'mode' => 'Light or dark',
    'mode_helper' => 'Auto follows whatever the reader\'s device is set to, which is usually the kind thing to do.',
    'mode_dark' => 'Dark',
    'mode_light' => 'Light',
    'mode_auto' => 'Follow the reader',

    // ---- somebody's own page ----------------------------------------------
    'mine_title' => 'My status page',
    'mine_nav_label' => 'Status page',
    'mine_subheading' => 'One address to give the people who play on your servers. It shows the servers you choose and nothing else about this panel.',
    'mine_address' => 'Your address',
    'mine_address_helper' => 'Pick something short. Changing it later breaks any link somebody has already saved.',
    'mine_address_off' => 'Choose an address below and save, and your page appears here.',
    'slug' => 'Address',
    'slug_helper' => 'Lowercase letters, numbers and hyphens. Three characters or more.',
    'mine_heading' => 'Heading',
    'mine_heading_helper' => 'Left empty, your address is used.',
    'mine_note_helper' => 'For saying what is going on — a restart, an event, where to find you. Plain text, and read by anybody with the link.',
    'mine_which' => 'Your servers',
    'mine_which_helper' => 'Only servers you own are offered. Being a subuser somewhere else is access to a machine, not permission to publish that it exists.',
    'mine_shown_as_helper' => 'What visitors see. Type it rather than using the panel name if that name is a note to yourself.',
    'mine_look_helper' => 'How your page looks to the people you send it to.',
    'mine_remove' => 'Take my page down',
    'mine_remove_confirm' => 'Removes your page and frees the address for somebody else. Anything you set is lost; the servers themselves are untouched.',
    'mine_removed' => 'Your page has been taken down',

    'why_slug' => 'That address will not do. Lowercase letters, numbers and hyphens, three characters or more, and a few words are reserved.',
    'why_taken' => 'Somebody else has that address already.',
    'why_unwritable' => 'It could not be written. Check that storage/app belongs to the user the panel runs as.',

    // ---- headings on the page itself ---------------------------------------
    'section_servers' => 'Servers',
    'section_nodes' => 'Machines',
    'section_monitors' => 'Services',

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
