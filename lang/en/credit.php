<?php

/*
 * Credit, refunds and credit notes.
 *
 * Two words are kept apart on purpose everywhere below.
 *
 * "Credit" is money the shop is holding for somebody. It comes off their next
 * invoice on its own, before they are ever asked to pay.
 *
 * A "refund" is the act of giving money back, and it has two destinations: to
 * the card it came from, or on to the account as credit. The wording always
 * says which, because a customer told "you have been refunded" who then finds
 * nothing in their bank writes in, and rightly.
 *
 * A "credit note" is the document. One is written either way, because it is the
 * record that the money is no longer owed to the shop - not a claim about where
 * it went.
 */

return [
    // ---- what a customer sees --------------------------------------------
    'yours' => 'Your credit',
    'yours_body' => 'This comes off your next invoice automatically. You do not have to do anything with it.',
    'applied' => 'Paid from your credit',
    'payable' => 'Left to pay',

    // ---- the ledger, on the customer window ------------------------------
    'held' => 'Credit',
    'none_held' => 'Nothing on account',
    'movements' => 'Credit',
    'column' => 'Credit',
    'none' => 'None',

    // ---- giving some -----------------------------------------------------
    'give' => 'Credit',
    'give_helper' => 'This account holds :held. What you put on it comes off their next invoice on its own. A negative amount takes credit off again, and both movements stay in the history.',
    'amount' => 'Amount',
    'amount_helper' => 'A negative amount takes credit away instead of giving it.',
    'reason' => 'Reason',
    'reason_helper' => 'The customer sees this beside the amount, so write it for them rather than for the file.',
    'given' => ':amount credit for :who',
    'bad_amount' => 'That is not an amount.',
    'give_failed' => 'The credit was not given',
    'give_failed_body' => 'Nothing was written. Try again, and look in the log if it keeps happening.',
    'take_failed' => 'The credit was not taken off',
    'take_failed_body' => 'There is less on the account than you asked to remove. A balance is never taken below nothing.',

    // ---- what a movement says -------------------------------------------
    'spent_on' => 'Invoice :number',
    'returned' => 'Put back: the invoice it was for could not be written',
    'note_line' => 'Credit note for invoice :number',
    'refund_description' => 'Refund of invoice :number',

    // ---- giving it back --------------------------------------------------
    'refund' => 'Refund',
    'refund_helper' => ':left of this invoice has not been given back yet. A credit note is written either way, so there is a record of it on both sides.',
    'refund_amount_helper' => 'Part of it is fine. What is left can be given back later.',
    'refund_reason_helper' => 'This is printed on the credit note the customer can open.',
    'where' => 'Where does the money go',
    'where_provider' => 'Back to how they paid',
    'where_provider_helper' => 'The provider sends it to the card or account it came from. It can take a few days to appear, and they can refuse - an old payment, or a method that does not reverse.',
    'where_balance' => 'On to their account here',
    'where_balance_helper' => 'It becomes credit and comes off their next invoice. Nothing leaves the bank, and it cannot fail.',
    'refunded' => ':amount refunded',
    'refunded_body' => 'Credit note :number was written for it.',
    'refund_failed' => 'Nothing was refunded',

    // ---- and why not, said one reason at a time --------------------------
    'refused_off' => 'Credit and refunds are switched off for this panel.',
    'refused_amount' => 'That is more than is left on this invoice.',
    'refused_no_payment' => 'No payment on this invoice has that much left in it, so there is nothing for a provider to reverse. Put it on their account instead.',
    'refused_no_gateway' => 'The provider this was paid through is no longer switched on, so it cannot be asked to reverse anything. Put it on their account instead.',
    'refused_refused' => 'The provider refused. That is usually an old payment or a method that does not reverse; the reason they gave is in the log. Put it on their account instead.',
    'refused_note_failed' => 'The money moved but the credit note would not write, so nothing was recorded. Look in the log before trying again.',

    // ---- putting money on ------------------------------------------------
    'topup' => 'Add credit',
    'topup_helper' => 'You have :held on account. What you add here comes off your next invoice on its own, and any invoice you already have open is settled from it the moment it arrives.',
    'topup_go' => 'Continue to payment',
    'topup_amount_helper' => 'Between :least and :most.',
    'topup_bad' => 'That amount cannot be paid',
    'topup_failed' => 'The payment could not be started. Try again, and tell whoever runs this panel if it keeps happening.',
    'topup_line' => 'Credit added to account',
    'topup_reason' => 'Added on invoice :number',

    // ---- where it is shown -----------------------------------------------
    'menu' => ':amount credit',
    'held_helper' => 'Comes off your next invoice on its own. Add to it on the invoices page.',
];
