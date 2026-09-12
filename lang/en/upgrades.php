<?php

/*
 * Moving a live service from one package to another.
 *
 * The wording keeps one thing straight throughout: what a package costs and
 * what changing to it costs today are two different numbers. The first is on
 * the shelf; the second depends on how far through the paid period this service
 * is, and it is the one somebody is agreeing to when they press the button.
 *
 * "Upgrade" is avoided in what a customer reads, because half of these moves
 * are the other way. The word here is change.
 */

return [
    // ---- on the service card ---------------------------------------------
    'change' => 'Change package',
    'change_body' => 'What is left of the period you have already paid for comes off, and the same days are charged at the new price. Nothing on your server is lost.',
    'change_to' => 'Change to :name',
    'change_confirm' => 'Change this service to :name?',
    'change_free' => 'Nothing to pay',
    'costs_now' => ':amount now',
    'gives_back' => ':amount back',
    'waiting' => 'Change agreed',
    'waiting_for' => 'A change to :name is waiting on an unpaid invoice.',

    // ---- what happens afterwards -----------------------------------------
    'done' => 'Moved to :name',
    'done_body' => 'Your service is on the new package. Anything you were owed is on your account.',
    'refused' => 'The change was not made',

    // ---- and why not, one reason at a time -------------------------------
    'refused_off' => 'Changing package is switched off for this panel.',
    'refused_not_active' => 'Only a running service can be changed. One that is pending, suspended or ending has nothing to work out.',
    'refused_gone' => 'The package this service is on no longer exists, so there is nothing to compare against.',
    'refused_same' => 'That is the package it is already on.',
    'refused_egg' => 'That package runs different software. It would be a different server rather than a bigger one, so it has to be bought as one.',
    'refused_period' => 'That package is billed over a different period, which is a different agreement rather than a bigger one.',
    'refused_stock' => 'That package is sold out.',
    'refused_waiting' => 'There is already a change waiting on an unpaid invoice for this service. Pay or cancel that one first.',
    'refused_failed' => 'Nothing was written down, so nothing has changed. Try again, and tell whoever runs this panel if it keeps happening.',
    'refused_server' => 'The server could not be given the new limits, so the service was left exactly as it was. Whoever runs this panel has been told.',

    // ---- what the documents say ------------------------------------------
    'line' => 'Change from :from to :to, for the :days days left of this period',
    'credit_reason' => 'Change to :name',

    // ---- and what the owner is told --------------------------------------
    'bell_failed' => 'A package change failed on order :number',
    'cold_title' => 'A package change reached the panel but not the node, on order :number',
    'cold_body' => 'The service is on :name and the new limits are recorded. The node has not taken them yet and will read them the next time that server starts, so until then the customer still has the old size. Check the node.',
    'gone' => 'The package being moved to no longer exists.',
    'refused_by_node' => 'The server would not take the new limits: :why',

    // ---- putting one right ------------------------------------------------
    'retry' => 'Retry the change',
    'retry_confirm' => 'Try the package change again. The invoice for it is already paid, so nothing is charged twice.',
    'retried' => 'The change went through',
    'retry_failed' => 'It failed again. The reason is on the order.',
];
