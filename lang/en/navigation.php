<?php

/*
 * The Navigation links page. Beside the announcements rather than inside the
 * theme's settings: neither is about what the panel looks like. One is what it
 * says, and this one is where it goes.
 */

return [
    'title' => 'Navigation links',
    'nav_label' => 'Navigation links',
    'subheading' => 'Rows of your own in the sidebar — a Discord invite, a status page, a knowledge base. They go through Filament\'s own navigation, so they behave like every other entry: they sit under a heading, and they follow the sidebar whether it is a rail or a topbar.',

    'add' => 'Add a link',
    'enabled' => 'On',
    'off' => 'off',

    'label' => 'Name',
    'icon' => 'Icon',
    'url' => 'Address',
    'url_helper' => 'https:// or a path inside this panel, such as /account. Anything else is ignored — a row in the navigation is not a place for a scheme nobody expected.',
    'scope' => 'Shown in',
    'scope_all' => 'Everywhere',
    'scope_client' => 'Only outside the admin area',
    'scope_admin' => 'Only in the admin area',
    'scope_login' => 'Under the sign-in form',
    'group' => 'Group',
    'group_helper' => 'Leave empty to put it above the first heading. Type the same name on two links and they sit together under it.',
    'new_tab' => 'Open in a new tab',

    'favicon' => "Use the site's own icon",
    'favicon_helper' => 'Fetched once, when you save - never while somebody is loading a page. If the site does not answer, the icon picked above is what stays.',
    'icon_fallback' => 'Used only if the site has no icon of its own.',

    'saved' => 'Navigation links saved',
    'failed' => 'The navigation links could not be saved',
];
