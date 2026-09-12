<?php

/*
 * Coupons: codes that take something off the first invoice.
 *
 * Only the first, deliberately, and the wording says so where it matters. A
 * code that also discounted every renewal would be a price change with an
 * expiry date on it, and somebody who wants that should change the price.
 */

return [
    'title' => 'Coupons',
    'nav_label' => 'Coupons',
    'subheading' => 'Codes that take a percentage or an amount off the first invoice. Renewals are charged at the package price.',

    // ---- the table -------------------------------------------------------
    'column_code' => 'Code',
    'column_value' => 'Worth',
    'column_uses' => 'Used',
    'column_expires' => 'Expires',
    'column_packages' => 'Applies to',
    'column_live' => 'Live',

    'never_expires' => 'No end date',
    'all_packages' => 'Everything',
    'some_packages' => ':count packages',
    'usable' => 'Can be used right now',
    'unusable' => 'Off, expired or used up',

    // ---- the buttons -----------------------------------------------------
    'new' => 'New coupon',
    'edit' => 'Edit',
    'delete' => 'Delete',
    'delete_confirm' => 'Removes the code. Invoices that already used it keep their discount - each one stores what it took off.',
    'deleted' => 'Coupon deleted',
    'saved' => 'Coupon saved',
    'save_failed' => 'The coupon could not be saved',
    'taken' => 'Something else already uses that code.',
    'invalid' => 'A percentage is a whole number from 1 to 100. An amount is written like 12.50 or 12,50.',

    // ---- the form --------------------------------------------------------
    'section_code' => 'The code',
    'section_code_helper' => 'What a customer types at the checkout.',
    'code' => 'Code',
    'code_helper' => 'Stored and compared in capitals with the spaces taken out, so it works however somebody types it.',
    'live' => 'Live',
    'live_helper' => 'Off stops the code working without deleting it, which keeps it out of use while the discount it gave stays on the invoices that had it.',

    'section_worth' => 'What it takes off',
    'section_worth_helper' => 'Off the first invoice only. It never takes an invoice below zero.',
    'kind' => 'Kind',
    'kind_helper' => 'A share of the price, or a flat amount.',
    'kind_percent' => 'Percentage',
    'kind_fixed' => 'Fixed amount',
    'value' => 'Worth',
    'value_percent_helper' => 'A whole number from 1 to 100.',
    'value_fixed_helper' => 'In the shop currency. Write it as 12.50 or 12,50.',

    'section_limits' => 'Limits',
    'section_limits_helper' => 'Every one of these is optional. A code with none of them set works for anything, for anybody, forever.',
    'max_uses' => 'Times it can be used',
    'max_uses_helper' => 'Counted when an order is placed, not when the invoice is paid - otherwise a code with ten uses could be placed a hundred times overnight.',
    'expires' => 'Expires',
    'expires_helper' => 'After this moment the code stops working. Empty means it never does.',
    'packages' => 'Packages',
    'packages_helper' => 'Nothing ticked means every package, now and later.',

    'empty' => 'No coupons yet',
    'empty_body' => 'Make one and it works at the checkout the moment it is live.',
];
