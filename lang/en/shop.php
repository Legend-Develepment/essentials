<?php

/*
 * The shop's settings, and later the shop itself.
 *
 * Two audiences share this file on purpose. The settings half is read by the
 * administrator; the public and customer halves - added as the shop grows -
 * are read by people who may never have heard of Pelican, and every sentence
 * there has to be written for them.
 */

return [
    'title' => 'Shop settings',
    'nav_label' => 'Shop settings',
    'subheading' => 'The currency, the tax, how invoices are numbered, and what the public page says. What is for sale is on the Packages page.',

    // ---- where it is -----------------------------------------------------
    'address' => 'The public shop is at',
    'address_off' => 'The public page is switched off. Turn on "Public shop page" in the features list on the Essentials settings page and it answers at :url.',

    // ---- general ---------------------------------------------------------
    'section_general' => 'Money',
    'section_general_helper' => 'One currency for the whole shop. Every price on every package is a number in it.',
    'currency' => 'Currency',
    'currency_helper' => 'Changing it does not convert anything: the prices on the packages are numbers, and after a change they are numbers in the new currency.',
    'tax' => 'Tax',
    'tax_helper' => 'A percentage added to every invoice as its own line. Prices on the packages are before tax. Zero for none.',
    'tax_suffix' => '%',
    'prefix' => 'Invoice numbers start with',
    'prefix_helper' => 'Followed by a number that counts up. INV- gives INV-000001.',

    // ---- renewals --------------------------------------------------------
    'section_renewals' => 'Renewals',
    'section_renewals_helper' => 'For packages billed by the month, quarter or year. A one-off package is never touched by any of this.',
    'notice_days' => 'Invoice this many days before the period ends',
    'notice_days_helper' => 'When the next invoice is made and the customer is told about it.',
    'grace' => 'Suspend this many days after an invoice is due',
    'grace_helper' => 'An unpaid invoice past this suspends the server — Pelican\'s own suspension, lifted the moment the invoice is paid. Nothing is ever deleted by the shop.',
    'days' => 'days',

    // ---- the public page -------------------------------------------------
    'section_public' => 'The public page',
    'section_public_helper' => 'Read by people without an account. Whether it is served at all is the "Public shop page" switch in the features list.',
    'heading' => 'Heading',
    'heading_helper' => 'Left empty, the panel\'s own name is used.',
    'note' => 'A line above the packages',
    'note_helper' => 'For saying who you are, or what buying gets somebody. Plain text.',
    'terms_url' => 'Terms',
    'terms_url_helper' => 'An https address. If it is set, buying means ticking a box that points at it.',

    // ---- paying by hand --------------------------------------------------
    'section_manual' => 'Paying without a provider',
    'section_manual_helper' => 'Shown on an unpaid invoice while no payment provider is switched on: bank details, or where to send the money. Plain text.',
    'pay_note' => 'How to pay',
    'pay_note_helper' => 'Leave it empty and an unpaid invoice says only that it is unpaid.',

    // ---- the buttons -----------------------------------------------------
    'save' => 'Save',
    'saved' => 'Saved',
    'save_failed' => 'Nothing was saved',
];
