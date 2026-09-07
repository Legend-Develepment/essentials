<?php

/*
 * Packages: a server somebody can buy.
 *
 * Read by whoever sets up the shop. Every word here is about the template and
 * the price; what a customer sees is in shop.php, because the two audiences
 * want different sentences about the same row.
 *
 * "egg", "node", "swap", "io" and the Minecraft-shaped words stay in English:
 * they are the words on Pelican's own server form, and a package is that form
 * saved for later.
 */

return [
    'title' => 'Packages',
    'nav_label' => 'Packages',
    'subheading' => 'What is for sale. Each one is a server template with a price on it; a customer buys one and the panel makes the server.',

    // ---- the table -------------------------------------------------------
    'column_name' => 'Package',
    'column_egg' => 'Egg',
    'column_price' => 'Price',
    'column_stock' => 'Stock',
    'column_live' => 'For sale',
    'column_orders' => 'Sold',

    'live' => 'Live',
    'offline' => 'Not for sale',
    'no_egg' => 'No egg — cannot be built',

    'stock_unlimited' => 'Unlimited',
    'stock_left' => ':count left',
    'stock_out' => 'Sold out',

    // ---- periods ---------------------------------------------------------
    'period_once' => 'One-off',
    'period_month' => 'Monthly',
    'period_quarter' => 'Every three months',
    'period_year' => 'Yearly',

    // After a price: "€ 12,50 a month".
    'per_once' => 'once',
    'per_month' => 'a month',
    'per_quarter' => 'a quarter',
    'per_year' => 'a year',

    // ---- actions ---------------------------------------------------------
    'new' => 'New package',
    'edit' => 'Edit',
    'duplicate' => 'Duplicate',
    'copy_suffix' => ' (copy)',
    'go_live' => 'Put on sale',
    'go_offline' => 'Take off sale',
    'delete' => 'Delete',
    'delete_confirm' => 'Removes the package. Nothing that was already bought is touched — orders keep their own copy of what they were.',
    'delete_refused' => 'Not deleted',
    'delete_refused_body' => 'Orders were placed against this package, and they point at it. Take it off sale instead; it stays for the records and nobody can buy it.',
    'deleted' => 'Package deleted',
    'saved' => 'Package saved',
    'save_failed' => 'Could not save the package',
    'price_invalid' => 'That is not an amount. Write it like 12.50 or 12,50.',

    // ---- the form: what it is --------------------------------------------
    'section_basics' => 'The package',
    'section_basics_helper' => 'What a customer sees on the card.',
    'name' => 'Name',
    'name_helper' => 'What it is called in the shop.',
    'slug' => 'Address',
    'slug_helper' => 'Lowercase letters, numbers and hyphens. Left empty it is made from the name. Changing it later breaks a link somebody saved.',
    'description' => 'Description',
    'description_helper' => 'A few lines under the name. Plain text.',
    'live_field' => 'For sale',
    'live_helper' => 'Off keeps the package here and shows it to nobody. A package with no egg is never shown whatever this says.',
    'sort' => 'Order',
    'sort_helper' => 'Lower comes first in the shop.',

    // ---- the form: what it becomes ---------------------------------------
    'section_server' => 'The server it becomes',
    'section_server_helper' => 'The same questions Pelican asks when you create a server by hand, answered once here and used for every sale.',
    'egg' => 'Egg',
    'egg_helper' => 'Picking one fills the image, the startup command and every variable with the egg\'s own defaults. Change any of them afterwards.',
    'image' => 'Docker image',
    'image_helper' => 'One of the images the egg offers.',
    'image_default' => 'The egg\'s first image',
    'startup' => 'Startup command',
    'startup_helper' => 'One of the commands the egg offers.',
    'startup_default' => 'The egg\'s first command',
    'environment' => 'Variables',
    'environment_helper' => 'The egg\'s variables and what they are set to. Anything the egg has that is not listed here takes its default when the server is made.',
    'env_key' => 'Variable',
    'env_value' => 'Value',
    'nodes' => 'Nodes',
    'nodes_helper' => 'Where a server from this package may be made, tried in this order until one has a free address. Nothing ticked means any node.',

    // ---- the form: limits ------------------------------------------------
    'section_limits' => 'Limits',
    'section_limits_helper' => 'What the server gets. The same fields as Pelican\'s own server form, in the same units.',
    'memory' => 'Memory',
    'disk' => 'Disk',
    'cpu' => 'CPU',
    'cpu_helper' => 'Percent of one core: 100 is one core, 200 is two, 0 is no limit.',
    'swap' => 'Swap',
    'swap_helper' => '0 is none, -1 is unlimited.',
    'io' => 'Block IO weight',
    'io_helper' => 'Pelican\'s default is 500. Leave it there unless you know why not.',
    'threads' => 'CPU pinning',
    'threads_helper' => 'Which cores, as Pelican writes them: 0,1 or 0-3. Empty is any.',
    'oom_killer' => 'OOM killer',
    'oom_killer_helper' => 'Whether the kernel may end the server when it runs out of memory.',
    'databases' => 'Databases',
    'allocations' => 'Extra allocations',
    'backups' => 'Backups',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- the form: the money ---------------------------------------------
    'section_price' => 'Price and stock',
    'section_price_helper' => 'In the shop\'s currency, set on the Shop settings page. Before tax — tax is added on the invoice as its own line.',
    'price' => 'Price',
    'price_helper' => 'Per period. Write it like 12.50 or 12,50.',
    'setup_fee' => 'Setup fee',
    'setup_fee_helper' => 'Charged once, on the first invoice. Zero for none.',
    'period' => 'Billed',
    'period_helper' => 'One-off is paid once and kept. The others get a new invoice every period; an unpaid one suspends the server after the grace period on the Shop settings page.',
    'stock' => 'Stock',
    'stock_helper' => 'How many may be sold at once, counting every order that has not been cancelled. Empty is unlimited.',

    'empty' => 'No packages yet',
    'empty_body' => 'Make one and it appears in the shop the moment it is put on sale.',
];
