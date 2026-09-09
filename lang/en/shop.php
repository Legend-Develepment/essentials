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
    'grace_helper' => 'An unpaid invoice past this suspends the server — Pelican\'s own suspension, lifted the moment the invoice is paid. Suspending itself deletes nothing.',
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

    /* ---------------------------------------------------------------------
     * The shop itself, from here down.
     *
     * A different reader entirely: somebody buying a server, who may never
     * have heard of Pelican and does not care what an egg is. Nothing below
     * mentions the panel's own words, and every sentence answers the question
     * a customer is actually asking at that point on the page.
     * ------------------------------------------------------------------- */

    // ---- the store -------------------------------------------------------
    'store_title' => 'Shop',
    'store_nav_label' => 'Shop',
    'store_subheading' => 'Pick a server. It is created for you as soon as the invoice is paid.',
    'store_empty' => 'Nothing is for sale right now',
    'store_empty_body' => 'Come back later, or ask whoever runs this panel.',

    'buy' => 'Buy',
    'sold_out' => 'Sold out',
    'plus_setup' => 'plus :amount once',

    'spec_memory' => ':amount MiB memory',
    'spec_disk' => ':amount MiB disk',
    'spec_cpu' => ':amount% CPU',
    'spec_backups' => ':count backups',
    'spec_databases' => ':count databases',

    // ---- the public page -------------------------------------------------
    'public_empty' => 'Nothing is for sale right now',
    'public_empty_body' => 'Come back later.',
    'to_panel' => 'Sign in',
    'terms' => 'Terms',
    'sign_in_note' => 'Pick a server below. You sign in to finish, and it is created once the invoice is paid.',
    'to_account' => 'My account',
    'filter_all' => 'Everything',
    'filter_label' => 'Show',
    'includes' => 'Includes',
    'public_count' => ':count for sale',

    // ---- the checkout ----------------------------------------------------
    'checkout_title' => 'Checkout',
    'tax_line' => 'Tax (:rate%)',
    'coupon' => 'Discount code',
    'asks' => 'About your server',
    'upload_default' => 'Your file',
    'upload_help' => 'A zip file. It goes into your server when it is built.',
    'upload_busy' => 'Uploading…',
    'what_is_this' => 'What is this?',
    'refused_no_file' => 'This package needs a file, and none was chosen.',
    'refused_not_zip' => 'That has to be a zip file.',
    'refused_too_big' => 'That file is too large for this panel to take.',
    'coupon_placeholder' => 'If you have one',
    'coupon_bad' => 'That code does not work here.',
    'coupon_good' => 'Code applied.',
    'agree' => 'I agree to the',
    'place_order' => 'Place the order',
    'place_order_note' => 'This writes an invoice. Nothing is charged until you pay it, and the server is created when it is paid.',
    'back_to_store' => 'Back to the shop',

    'placed' => 'Order placed',
    'placed_body' => 'Invoice :number is waiting on your billing page.',

    'refused' => 'That could not be bought',
    'refused_gone' => 'It is not for sale any more.',
    'refused_sold_out' => 'The last one has gone.',
    'refused_bad_coupon' => 'The discount code is not valid for this.',
    'refused_failed' => 'Something went wrong writing the order. Nothing was charged. Try again, and tell whoever runs this panel if it keeps happening.',

    // ---- billing ---------------------------------------------------------
    'billing_title' => 'Billing',
    'billing_nav_label' => 'Billing',
    'billing_subheading' => 'What you have bought, and what you owe.',
    'your_orders' => 'Your orders',
    'your_invoices' => 'Your invoices',
    'no_orders' => 'You have not bought anything yet',
    'no_orders_body' => 'Anything you buy shows up here with its server and its dates.',
    'no_invoices' => 'No invoices yet',
    'to_store' => 'Go to the shop',
    'renews' => 'Renews',
    'ask_how_to_pay' => 'Ask whoever runs this panel how to pay. They have not written it down here yet.',
    'order_pending' => 'Waiting for the invoice to be paid. The server is created straight after that.',
    'order_suspended' => 'Stopped over an unpaid invoice. Paying it starts the server again - nothing has been deleted.',
    'order_ending' => 'Ends :date. It is not billed again, and everything on it is deleted that day.',
    'order_ending_open' => 'Cancelled. It is not billed again and keeps running until it is removed.',

    // ---- paying ----------------------------------------------------------
    'pay_with' => 'Pay with',
    'pay_now' => 'Pay',
    'pay_description' => 'Invoice :number',
    'pay_thanks' => 'Thank you. The invoice is paid.',
    'pay_pending' => 'The provider has not confirmed it yet. This page updates as soon as they do.',
    'pay_refused' => 'That did not start',
    'pay_refused_body' => 'The payment could not be opened. Try another way, or ask whoever runs this panel.',
    'gateway_mollie' => 'Mollie',

    // ---- the provider settings -------------------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'Takes iDEAL, cards, Bancontact and the rest through one account. Test and live are the same setting: the key itself says which account it belongs to.',
    'mollie_on' => 'Offer Mollie',
    'mollie_on_helper' => 'Off leaves the button off every invoice. Anything already paid stays paid.',
    'mollie_key' => 'API key',
    'mollie_key_helper' => 'From the Developers section of your Mollie dashboard. It is never written into an exported settings file.',
    'mollie_hook' => 'Webhook address',
    'mollie_hook_helper' => 'Mollie will report to :url - it needs to reach your panel from the internet.',

    'gateway_stripe' => 'Card',

    'section_stripe' => 'Stripe',
    'section_stripe_helper' => 'Takes cards through a page Stripe draws, so no card number ever reaches this panel. Test and live are the key prefix, not a switch.',
    'stripe_on' => 'Offer Stripe',
    'stripe_on_helper' => 'Off leaves the button off every invoice. Anything already paid stays paid.',
    'stripe_key' => 'Secret key',
    'stripe_key_helper' => 'The one starting sk_ from Developers, API keys. Never written into an exported settings file.',
    'stripe_hook' => 'Signing secret',
    'stripe_hook_key_helper' => 'The whsec_ value Stripe shows when you add the endpoint below. Without it their messages cannot be proved genuine and are ignored.',
    'stripe_hook_helper' => 'Add :url as an endpoint under Developers, webhooks, for the event checkout.session.completed.',

    'gateway_paypal' => 'PayPal',

    'section_paypal' => 'PayPal',
    'section_paypal_helper' => 'The one provider where the money moves when the customer comes back rather than while they are still on PayPal, so a closed tab leaves an unpaid invoice rather than a lost payment.',
    'paypal_on' => 'Offer PayPal',
    'paypal_on_helper' => 'Off leaves the button off every invoice. Anything already paid stays paid.',
    'paypal_sandbox' => 'Sandbox',
    'paypal_sandbox_helper' => 'Talks to PayPal\'s test account instead of the real one. Their client ids look the same either way, which is why this switch exists at all.',
    'paypal_id' => 'Client ID',
    'paypal_secret' => 'Secret',
    'paypal_id_helper' => 'From the app you made under Apps & Credentials. Make sure the tab matches the switch above.',
    'paypal_secret_helper' => 'Beside the client ID, behind Show. Never written into an exported settings file.',
    'paypal_hook' => 'Webhook ID',
    'paypal_hook_id_helper' => 'The ID PayPal gives the webhook once you add it - not the address. Without it their messages cannot be checked with them and are ignored.',
    'paypal_hook_helper' => 'Add :url as a webhook on that app, for PAYMENT.CAPTURE.COMPLETED, then paste the ID it is given here.',

    // ---- the payment page ------------------------------------------------
    'pay_title' => 'Pay',
    'pay_subheading' => 'What you owe, and the ways to settle it.',
    'pay_choose' => 'How would you like to pay?',
    'pay_choose_body' => 'Whichever you pick, you finish on their own page and come straight back here.',
    'pay_safe' => 'You are sent to the provider to pay. Your card details never reach this panel.',
    'pay_no_ways' => 'Once the money arrives, the invoice is marked paid and your server is set up.',
    'free' => 'Nothing to pay',
    'free_body' => 'A coupon covered the whole of this one, so there is no payment to make. Press the button and it is done.',
    'free_go' => 'Finish',
    'free_done' => 'Settled',
    'free_done_body' => 'There was nothing to pay, so it is closed. Your server is being made now.',
    'pay_gone' => 'No such invoice',
    'pay_gone_body' => 'It may have been withdrawn, or the address may be wrong.',
    'pay_already' => 'This one is paid',
    'pay_already_body' => 'Nothing more to do. Anything waiting on it is already on its way.',
    'pay_withdrawn' => 'This one was withdrawn',
    'pay_withdrawn_body' => 'It is off the books and does not need paying. Ask whoever runs this panel if that looks wrong.',
    'back_to_billing' => 'Back to billing',

    // What each provider actually covers. The company name means nothing to a
    // customer; a card, their bank, or the PayPal they already have does.
    'gateway_mollie_note' => 'iDEAL, Bancontact, card and more',
    'gateway_stripe_note' => 'Visa, Mastercard, American Express',
    'gateway_paypal_note' => 'Your PayPal balance, or a card through PayPal',

    // ---- services and invoices, split apart ------------------------------
    'services_title' => 'My services',
    'services_nav_label' => 'My services',
    'services_subheading' => 'What you are paying for, and the server each one became.',
    'open_server' => 'Open the server',
    'no_server_yet' => 'Being set up',

    'invoices_title' => 'Invoices',
    'invoices_subheading' => 'What you have been billed, and what is still to pay.',
    'no_invoices_body' => 'Anything you buy is billed here, and stays here after it is paid.',

    // ---- the shop as the landing page ------------------------------------
    'section_landing' => 'Where the shop sits',
    'section_landing_helper' => 'Whether the shop is the front door of the panel, for customers and for people who have not signed in.',
    'landing' => 'Open the shop first',
    'landing_helper' => 'On, the shop is the first page after signing in and the server list moves beside it. Your services and your invoices stay one click away, in the header of the shop and in the account menu. Somebody who has not signed in gets the public shop instead of the sign-in form, and is only asked to sign in once they pick a package - so this needs the public shop page switched on too. Off, the panel opens on the server list the way Pelican draws it, somebody who has not signed in gets the sign-in form, and the shop is a page like any other.',
];
