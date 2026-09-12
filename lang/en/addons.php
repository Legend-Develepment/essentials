<?php

/*
 * Extras sold alongside a package.
 *
 * Two words are kept apart here. What an extra *costs* is its price, which is
 * what it is charged every time. What it *costs today* is a share of that,
 * because somebody buying one halfway through a month pays for half a month of
 * it. The customer-facing wording always says which of the two it means.
 *
 * "Adds nothing to the server" is a real answer and is said out loud rather
 * than left as a blank, because priority support is an ordinary thing to sell
 * and an empty cell reads as a mistake.
 */

return [
    'title' => 'Extras',
    'nav_label' => 'Extras',
    'subheading' => 'Things sold alongside a package: more memory, another backup slot, or something that is only a line on the invoice.',

    // ---- the table --------------------------------------------------------
    'column_name' => 'Extra',
    'column_price' => 'Price',
    'column_adds' => 'Adds',
    'column_sold' => 'In use',
    'column_live' => 'On sale',
    'adds_nothing' => 'Nothing on the server',

    // ---- the form ---------------------------------------------------------
    'section_what' => 'What it is',
    'section_what_helper' => 'The name and the price a customer sees, and which packages it can be bought with.',
    'name' => 'Name',
    'price' => 'Price',
    'price_helper' => 'What it costs each time it is charged. Bought part-way through a period, a customer pays a share of this and the whole of it from the next renewal.',
    'billing' => 'Charged',
    'billing_helper' => 'With the service means it comes back on every renewal, for as long as they keep it. Once means it is charged on the invoice that first carries it and never again.',
    'billing_with' => 'With every renewal',
    'billing_once' => 'Once',
    'max' => 'Most per service',
    'max_helper' => 'How many of this one somebody may hold. One is the ordinary case; raise it for something sold by the gigabyte.',
    'description' => 'Description',
    'description_helper' => 'One line under the name at the checkout. Say what it does rather than what it is called.',
    'packages' => 'Packages',
    'packages_helper' => 'Which packages this can be bought with. Nothing ticked means all of them, which is what a support option or a backup slot usually is.',

    'section_adds' => 'What it adds to the server',
    'section_adds_helper' => 'These are added to whatever the package already gives, not set instead of it: 4096 in memory makes the server 4 GiB bigger. Two of the same extra add up. Leave them all at nought for something that is only a line on the invoice. A negative number takes something away, which is allowed and is occasionally what somebody wants.',
    'sort' => 'Order',
    'sort_helper' => 'Lower comes first at the checkout. Equal numbers fall back to price.',
    'live' => 'On sale',
    'live_helper' => 'Off, it is not offered anywhere. Anybody who already has it keeps it and keeps being billed for it.',

    // ---- the buttons ------------------------------------------------------
    'new' => 'New extra',
    'edit' => 'Edit',
    'delete' => 'Delete',
    'delete_confirm' => 'Nobody has this one. Deleting it takes it off the list for good.',
    'delete_sold' => ':count service(s) have this. They keep it, keep the limits it gave them and keep being billed for it - what goes is the entry on the list, so nobody new can buy it.',
    'go_live' => 'Put on sale',
    'go_offline' => 'Take off sale',
    'saved' => 'Saved',
    'deleted' => 'The extra is gone',
    'save_failed' => 'Not saved',
    'save_failed_body' => 'Nothing was written. Try again, and look in the log if it keeps happening.',
    'invalid' => 'An extra needs a name and a price.',
    'empty' => 'No extras yet',
    'empty_body' => 'An extra is something sold beside a package: another gigabyte, a second backup slot, or a service that adds nothing to the server at all.',

    // ---- what a customer sees ---------------------------------------------
    'choose' => 'Extras',
    'choose_helper' => 'Optional, and you can add or drop them later.',
    'yours' => 'Extras on this service',
    'add' => 'Add an extra',
    'add_helper' => 'You pay for what is left of this period now, and the whole price from the next renewal.',
    'add_to' => 'Add :name',
    'add_confirm' => 'Add :name to this service?',
    'drop' => 'Remove',
    'drop_confirm' => 'Remove :name? The unused part of what you have paid goes back on your account, and your server changes straight away.',
    'costs_now' => ':amount now',
    'free_now' => 'Nothing to pay now',
    'then' => 'then :amount per renewal',
    'once_only' => ':amount, once',
    'each' => 'each',
    'added' => ':name added',
    'added_body' => 'Your server has been given what it adds.',
    'dropped' => ':name removed',
    'dropped_body' => 'Anything you had paid for and not used is on your account.',

    // ---- and when it will not --------------------------------------------
    'refused' => 'That could not be done',
    'refused_off' => 'Extras are switched off for this panel.',
    'refused_not_active' => 'Only a running service can have extras added to it.',
    'refused_gone' => 'That extra is no longer on sale.',
    'refused_wrong_package' => 'That extra is not sold with this package.',
    'refused_enough' => 'You already have as many of those as this service may hold.',
    'refused_failed' => 'Nothing was written down, so nothing has changed. Try again, and tell whoever runs this panel if it keeps happening.',
    'refused_server' => 'The server would not take the new limits, so nothing was changed and nothing was charged.',
    'refused_not_yours' => 'That extra is not on this service.',

    // ---- what the documents say ------------------------------------------
    'line' => ':name × :many, for the :days days left of this period',
    'credit_reason' => 'Removed: :name',
    'bell_failed' => 'An extra could not be given to the server on order :number',

    // ---- units, for the admin table --------------------------------------
    'unit_memory' => 'MiB memory',
    'unit_swap' => 'MiB swap',
    'unit_disk' => 'MiB disk',
    'unit_cpu' => '% CPU',
    'unit_database_limit' => 'databases',
    'unit_allocation_limit' => 'allocations',
    'unit_backup_limit' => 'backups',
];
