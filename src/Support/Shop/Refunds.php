<?php

namespace LegendDevelopment\Theme\Support\Shop;

use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Payment;
use LegendDevelopment\Theme\Support\Features;
use Throwable;

/**
 * Giving money back, and writing down that it happened.
 *
 * Two things can be meant by a refund and the shop has to be told which. The
 * money can go back the way it came - on to the card, into the PayPal account -
 * or it can stay here as credit against what the customer buys next. They are
 * different events in the world, and no amount of cleverness lets this class
 * work out which one somebody meant.
 *
 * **The document is written either way.** A credit note is not a description of
 * where the money went; it is the record that it is no longer owed to the shop,
 * and that is equally true whether it left the bank or moved to a balance. What
 * differs is the ledger: money that went back to a card puts nothing on the
 * account, because the customer already has it.
 *
 * **A provider refusing is not an error.** Payments age out, some methods will
 * not reverse, and a provider without the balance to do it simply says no. The
 * answer that comes back says so in a sentence, and the credit route is still
 * there - which is the whole reason there are two.
 */
class Refunds
{
    /** Back to where the money came from. */
    public const PROVIDER = 'provider';

    /** On to the customer's account here. */
    public const BALANCE = 'balance';

    /**
     * Give some of an invoice back.
     *
     * @param  string  $where  One of the two constants above.
     * @return array{ok: bool, note: ?Invoice, reason: string}
     */
    public static function give(
        Invoice $invoice,
        int $amount,
        string $where,
        string $reason = '',
        ?int $by = null,
    ): array {
        if (!Features::enabled(Features::CREDIT)) {
            return self::no('off');
        }

        $left = Credits::refundable($invoice);

        if ($amount <= 0 || $amount > $left) {
            return self::no('amount');
        }

        /*
         * The money first, the paperwork second, and only when the money moved.
         *
         * The other order would write a credit note for a refund the provider
         * then refused, and a credit note is a document: the customer can see
         * it, it changes what the month's turnover says, and nothing about it
         * is easy to take back. A refund that failed should leave no trace but
         * a line in the log.
         */
        if ($where === self::PROVIDER) {
            $payment = self::payable($invoice, $amount);

            if ($payment === null) {
                return self::no('no_payment');
            }

            $gateway = Gateways::get((string) $payment->gateway);

            if ($gateway === null) {
                return self::no('no_gateway');
            }

            if (!$gateway->refund($payment, $amount)) {
                return self::no('refused');
            }

            try {
                $payment->forceFill([
                    'refunded' => (int) $payment->refunded + $amount,
                ])->save();
            } catch (Throwable $exception) {
                /*
                 * The money went and the row does not say so. Reported and
                 * carried on: the credit note below is the record that matters
                 * to the customer and to the books, and refusing to write it
                 * now would leave the worse of the two gaps.
                 */
                report($exception);
            }
        }

        $note = Credits::note($invoice, $amount, $reason);

        if (!$note instanceof Invoice) {
            return self::no('note_failed');
        }

        /*
         * And on to the account, where that is where it was going.
         *
         * After the note rather than before it, so the movement can name the
         * document it came from. A balance somebody cannot trace back to a
         * piece of paper is a balance they will ask about.
         */
        if ($where === self::BALANCE) {
            Credits::add(
                (int) ($invoice->user_id ?? 0),
                $amount,
                $reason !== '' ? $reason : (string) $note->number,
                (int) $note->id,
                $by,
            );
        }

        return ['ok' => true, 'note' => $note, 'reason' => ''];
    }

    /**
     * A paid payment on this invoice with room left in it.
     *
     * An invoice can have several attempts against it and at most one of them
     * took money. Refunding is against that one, and never against more than it
     * still holds - a provider would refuse anyway, but a shop that has to be
     * told no by somebody else's API is a shop that does not know its own
     * books.
     */
    public static function payable(Invoice $invoice, int $amount): ?Payment
    {
        try {
            return $invoice->payments()
                ->where('state', Payment::PAID)
                ->get()
                ->first(static fn (Payment $payment): bool => (int) $payment->amount - (int) $payment->refunded >= $amount);
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * Whether sending it back the way it came is even on the table.
     *
     * Used to decide what the refund form offers. A shop paid by bank transfer
     * has no provider to reverse, and offering the choice would be offering
     * something that can only fail.
     */
    public static function reversible(Invoice $invoice, int $amount): bool
    {
        $payment = self::payable($invoice, $amount);

        return $payment !== null && Gateways::get((string) $payment->gateway) !== null;
    }

    /** @return array{ok: bool, note: ?Invoice, reason: string} */
    private static function no(string $reason): array
    {
        return ['ok' => false, 'note' => null, 'reason' => $reason];
    }
}
