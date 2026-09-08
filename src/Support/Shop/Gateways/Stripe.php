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
 * Stripe, over Checkout Sessions.
 *
 * Sessions rather than PaymentIntents on purpose: a session is a hosted page
 * Stripe draws, which means the card number never touches this panel and
 * nothing here is in scope for the questions a card number brings with it. The
 * customer goes there, pays, and comes back.
 *
 * **Stripe signs its webhooks, and this class checks the signature itself.**
 * Without an SDK that is thirty lines: read the `Stripe-Signature` header,
 * take the timestamp and the v1 digest out of it, recompute HMAC-SHA256 over
 * "timestamp.body" with the webhook secret, and compare with hash_equals. A
 * five-minute tolerance on the timestamp is what stops a valid old event being
 * replayed forever.
 *
 * And even after all that, the session is re-read from Stripe before anything
 * is settled. The signature says the message is genuinely Stripe's; the fetch
 * says what is true now.
 *
 * **Amounts are minor units, which is what Stripe wants** - the one place in
 * this plugin where no conversion is needed at the boundary. Zero-decimal
 * currencies would need care here; none of the twelve this plugin offers is
 * one, and the check is on Money's list rather than here.
 */
class Stripe implements Gateway
{
    public const KEY = 'stripe';

    private const API = 'https://api.stripe.com/v1/checkout/sessions';

    private const TIMEOUT = 15;

    /** How old a signed event may be. Stripe's own recommendation. */
    private const TOLERANCE = 300;

    public function key(): string
    {
        return self::KEY;
    }

    public function enabled(): bool
    {
        return (bool) Theme::config('shop_stripe_on', false) && $this->secret() !== '';
    }

    /**
     * Open a Checkout Session.
     *
     * Form-encoded with bracket notation, because that is Stripe's API and no
     * SDK is available to hide it. `client_reference_id` and the metadata both
     * carry the invoice, so it can be traced from Stripe's own dashboard by
     * somebody looking from the other side.
     */
    public function start(Invoice $invoice, string $returnUrl, string $webhookUrl): ?string
    {
        $secret = $this->secret();

        if ($secret === '' || (int) $invoice->total <= 0) {
            return null;
        }

        $name = mb_substr(Theme::trans('shop.pay_description', [
            'number' => (string) $invoice->number,
        ]), 0, 250);

        try {
            $response = Http::withToken($secret)
                ->timeout(self::TIMEOUT)
                ->asForm()
                ->post(self::API, [
                    'mode' => 'payment',
                    'line_items[0][quantity]' => 1,
                    'line_items[0][price_data][currency]' => mb_strtolower(Money::currency($invoice->currency)),
                    'line_items[0][price_data][unit_amount]' => (int) $invoice->total,
                    'line_items[0][price_data][product_data][name]' => $name,
                    'success_url' => $returnUrl,
                    'cancel_url' => $returnUrl,
                    'client_reference_id' => (string) (int) $invoice->id,
                    'metadata[invoice]' => (string) (int) $invoice->id,
                ]);
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }

        if (!$response->successful()) {
            report(new RuntimeException('Stripe refused a session: ' . $response->status()));

            return null;
        }

        $body = $response->json();
        $id = is_array($body) ? (string) ($body['id'] ?? '') : '';
        $url = is_array($body) ? (string) ($body['url'] ?? '') : '';

        if ($id === '' || !str_starts_with($url, 'https://')) {
            return null;
        }

        Gateways::remember($invoice, self::KEY, $id, Payment::OPEN, is_array($body) ? $this->trim($body) : null);

        return $url;
    }

    /**
     * A signed event from Stripe.
     *
     * The signature is checked before the body is parsed for anything that
     * matters, and a body that does not verify is answered with null - which
     * the controller turns into "we heard you" rather than an error, because
     * a 500 would have Stripe retrying a forged request for days.
     */
    public function webhook(Request $request): ?Payment
    {
        $secret = trim((string) Theme::config('shop_stripe_hook', ''));
        $body = $request->getContent();

        if ($secret === '' || $body === '') {
            return null;
        }

        if (!$this->signed($request->header('Stripe-Signature', ''), $body, $secret)) {
            return null;
        }

        try {
            $event = json_decode($body, true, 8, JSON_THROW_ON_ERROR);
        } catch (Throwable) {
            return null;
        }

        if (!is_array($event)) {
            return null;
        }

        $id = (string) ($event['data']['object']['id'] ?? '');

        if ($id === '' || !str_starts_with($id, 'cs_')) {
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
     * Ask Stripe about the session, and act on what they say.
     *
     * `payment_status === 'paid'` and nothing else. A session can be complete
     * with a payment still processing - a bank debit that will land in three
     * days - and that is not money in the account.
     */
    public function settle(Payment $payment): bool
    {
        $secret = $this->secret();

        if ($secret === '') {
            return false;
        }

        try {
            $response = Http::withToken($secret)
                ->timeout(self::TIMEOUT)
                ->get(self::API . '/' . rawurlencode((string) $payment->gateway_id));
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }

        if (!$response->successful()) {
            return false;
        }

        $body = $response->json();
        $paid = is_array($body) ? (string) ($body['payment_status'] ?? '') : '';
        $status = is_array($body) ? (string) ($body['status'] ?? '') : '';

        $state = match (true) {
            $paid === 'paid' => Payment::PAID,
            $status === 'expired' => Payment::FAILED,
            default => Payment::OPEN,
        };

        try {
            $payment->forceFill([
                'state' => $state,
                'raw' => is_array($body) ? $this->trim($body) : null,
            ])->save();
        } catch (Throwable) {
            // The row did not move; the invoice below still does.
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

    /**
     * Whether a body really came from Stripe.
     *
     * The header is a comma-separated list of `key=value`: `t` is the moment
     * it was signed, and there may be several `v1` digests during a secret
     * rotation - any one matching is a match. hash_equals rather than ===,
     * because a comparison that stops at the first wrong byte tells somebody
     * timing them how much of their guess was right.
     */
    private function signed(string $header, string $body, string $secret): bool
    {
        if ($header === '') {
            return false;
        }

        $timestamp = 0;
        $digests = [];

        foreach (explode(',', $header) as $part) {
            $pair = explode('=', trim($part), 2);

            if (count($pair) !== 2) {
                continue;
            }

            if ($pair[0] === 't' && ctype_digit($pair[1])) {
                $timestamp = (int) $pair[1];
            }

            if ($pair[0] === 'v1') {
                $digests[] = $pair[1];
            }
        }

        if ($timestamp <= 0 || $digests === []) {
            return false;
        }

        // Both directions: a timestamp far in the future is as wrong as one
        // far in the past, and only one of the two is somebody replaying.
        if (abs(time() - $timestamp) > self::TOLERANCE) {
            return false;
        }

        $expected = hash_hmac('sha256', $timestamp . '.' . $body, $secret);

        foreach ($digests as $digest) {
            if (hash_equals($expected, $digest)) {
                return true;
            }
        }

        return false;
    }

    private function secret(): string
    {
        return trim((string) Theme::config('shop_stripe_key', ''));
    }

    /**
     * @param  array<string, mixed>  $body
     * @return array<string, mixed>
     */
    private function trim(array $body): array
    {
        return [
            'id' => $body['id'] ?? null,
            'status' => $body['status'] ?? null,
            'payment_status' => $body['payment_status'] ?? null,
            'livemode' => $body['livemode'] ?? null,
            'amount_total' => $body['amount_total'] ?? null,
            'currency' => $body['currency'] ?? null,
        ];
    }
}
