<?php

namespace LegendDevelopment\Theme\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Invoices;
use LegendDevelopment\Theme\Support\Theme;

/**
 * One invoice, in somebody's inbox.
 *
 * Deliberately plain HTML with the numbers in a table and one link back to the
 * panel. Not the panel's own mail layout: this goes to people who may never
 * have signed in, on clients that will strip most of what a modern panel's
 * stylesheet does anyway, and an invoice that is legible in a text-only client
 * is worth more than one that is pretty in two of them.
 *
 * Nothing is looked up at send time that is not on the invoice already. The
 * lines, the totals, the currency and the customer's name were snapshotted when
 * it was written, so a mail resent months later says what the document says.
 */
class InvoiceMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public Invoice $invoice) {}

    public function build(): self
    {
        $currency = (string) $this->invoice->currency;

        return $this
            ->subject(Theme::name() . ': ' . Theme::trans('invoices.mail_subject', [
                'number' => (string) $this->invoice->number,
            ]))
            ->view(Theme::id() . '::mail.invoice', [
                'invoice' => $this->invoice,
                'currency' => $currency,
                'lines' => is_array($this->invoice->lines) ? $this->invoice->lines : [],
                'address' => Invoices::address($this->invoice),
                'money' => static fn (int $minor): string => Money::format($minor, $currency),
            ]);
    }
}
