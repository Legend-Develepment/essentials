<?php

namespace LegendDevelopment\Theme\Support\Shop\Gateways;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Payment;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Gateway;
use LegendDevelopment\Theme\Support\Shop\Gateways;
use LegendDevelopment\Theme\Support\Shop\Invoices;
use LegendDevelopment\Theme\Support\Theme;
use RuntimeException;
use Throwable;

/**
 * Mollie, over plain HTTP calls.
 *
 * A Pelican plugin cannot add a composer dependency, so there is no SDK here -
 * three REST calls and the panel's own HTTP client, which is enough because
 * Mollie's payments API is three REST calls.
 *
 * **The webhook carries no proof, and does not need to.** Mollie posts a
 * single field, `id=tr_...`, and signs nothing. That looks alarming until you
 * see what happens next: the id is worthless without the API key, and this
 * class immediately fetches the payment with the key before believing
 * anything. Somebody who guesses a transaction id gets exactly one thing - the
 * panel asking Mollie about a payment that is not theirs, and Mollie saying it
 * is not paid. Verification is the fetch.
 *
 * **Test and live are the same code.** The key's own prefix decides which
 * Mollie account is being talked to, so there is no sandbox switch here to get
 * out of step with the key beside it.
 */
class Mollie implements Gateway
{
    public const KEY = 'mollie';

    private const API = 'https://api.mollie.com/v2/payments';

    /** Long enough for a provider having a slow minute, short enough to fail. */
    private const TIMEOUT = 15;

    public function key(): string
    {
        return self::KEY;
    }

    public function enabled(): bool
    {
        return (bool) Theme::config('shop_mollie_on', false) && $this->apiKey() !== '';
    }

    /**
     * Open a payment and answer with where to send the customer.
     *
     * The amount is sent as a decimal string because that is what Mollie
     * wants; everything on this side stays in minor units until this line.
     * `metadata.invoice` is carried so a payment can be traced back from
     * Mollie's own dashboard by somebody looking at it from the other side.
     */
    public function start(Invoice $invoice, string $returnUrl, string $webhookUrl): ?string
    {
        $key = $this->apiKey();

        if ($key === '') {
            report(new RuntimeException('Mollie is on but has no API key.'));

            return null;
        }

        if ((int) $invoice->total <= 0) {
            report(new RuntimeException('Mollie was asked for a payment worth nothing, on invoice ' . $invoice->number . '.'));

            return null;
        }

        try {
            $response = Http::withToken($key)
                ->timeout(self::TIMEOUT)
                ->acceptJson()
                ->asJson()
                ->post(self::API, [
                    'amount' => [
                        'currency' => Money::currency($invoice->currency),
                        'value' => Money::decimal((int) $invoice->total),
                    ],
                    'description' => mb_substr(Theme::trans('shop.pay_description', [
                        'number' => (string) $invoice->number,
                    ]), 0, 255),
                    'redirectUrl' => $returnUrl,
                    'webhookUrl' => $webhookUrl,
                    'metadata' => ['invoice' => (int) $invoice->id],
                ]);
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }

        if (!$response->successful()) {
            report(new RuntimeException('Mollie refused a payment: ' . $response->status()));

            return null;
        }

        $body = $response->json();
        $id = is_array($body) ? (string) ($body['id'] ?? '') : '';
        $url = is_array($body) ? (string) ($body['_links']['checkout']['href'] ?? '') : '';

        if ($id === '' || !str_starts_with($url, 'https://')) {
            return null;
        }

        Gateways::remember($invoice, self::KEY, $id, Payment::OPEN, is_array($body) ? $this->trim($body) : null);

        return $url;
    }

    /**
     * Mollie is telling us a payment changed.
     *
     * The body is one field. What comes back is the row we already have for
     * that id, or null - and null means this panel has no record of the
     * payment, which is the right answer to a request that made one up.
     */
    public function webhook(Request $request): ?Payment
    {
        $id = trim((string) $request->input('id', ''));

        if ($id === '' || !str_starts_with($id, 'tr_')) {
            return null;
        }

        try {
            $payment = Payment::query()
                ->where('gateway', self::KEY)
                ->where('gateway_id', $id)
                ->first();
        } catch (Throwable) {
            return null;
        }

        return $payment instanceof Payment ? $payment : null;
    }

    /**
     * Ask Mollie what happened, and write down the answer.
     *
     * This is where the money moves. `status === 'paid'` and nothing else -
     * `authorized`, `pending` and the rest are not money in the account, and
     * treating them as such is how a shop hands over a server for a payment
     * that is later refused.
     */
    public function settle(Payment $payment): bool
    {
        $key = $this->apiKey();

        if ($key === '') {
            return false;
        }

        try {
            $response = Http::withToken($key)
                ->timeout(self::TIMEOUT)
                ->acceptJson()
                ->get(self::API . '/' . rawurlencode((string) $payment->gateway_id));
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }

        if (!$response->successful()) {
            return false;
        }

        $body = $response->json();
        $status = is_array($body) ? (string) ($body['status'] ?? '') : '';

        $state = match ($status) {
            'paid' => Payment::PAID,
            'failed', 'expired' => Payment::FAILED,
            'canceled' => Payment::CANCELLED,
            default => Payment::OPEN,
        };

        try {
            $payment->forceFill([
                'state' => $state,
                'raw' => is_array($body) ? $this->trim($body) : null,
            ])->save();
        } catch (Throwable) {
            // The state on the row did not move. The invoice below still does,
            // which is the half that matters.
        }

        if ($state !== Payment::PAID) {
            return false;
        }

        $invoice = $payment->invoice;

        if (!$invoice instanceof Invoice) {
            return false;
        }

        return Invoices::markPaid($invoice, self::KEY);
    }

    /** The key, as an administrator typed it. */
    private function apiKey(): string
    {
        return trim((string) Theme::config('shop_mollie_key', ''));
    }

    /**
     * What is worth keeping of a provider's answer.
     *
     * Not the whole body: it carries links, a profile id and whatever Mollie
     * adds next, and a json column that grows with somebody else's API is a
     * column nobody reads. These six are what an administrator looking at a
     * failed payment actually wants.
     *
     * @param  array<string, mixed>  $body
     * @return array<string, mixed>
     */
    private function trim(array $body): array
    {
        return [
            'id' => $body['id'] ?? null,
            'status' => $body['status'] ?? null,
            'mode' => $body['mode'] ?? null,
            'method' => $body['method'] ?? null,
            'amount' => $body['amount'] ?? null,
            'paidAt' => $body['paidAt'] ?? null,
        ];
    }
}
