<?php

namespace LegendDevelopment\Theme\Support\Shop\Gateways;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
 * PayPal, and the one way it differs from the other two.
 *
 * With Mollie and Stripe the customer's return is a courtesy - the money has
 * already moved and the panel is only asking about it earlier than the webhook
 * would. **With PayPal the return is where the money moves.** Their flow
 * approves an order and then waits to be told to capture it, and an order that
 * is approved and never captured is a customer who thinks they paid and a
 * merchant who has nothing.
 *
 * So settle() captures first and asks afterwards. It is safe to call twice:
 * PayPal answers ORDER_ALREADY_CAPTURED to the second, and the read that
 * follows finds a completed order either way. That is what makes the webhook
 * and the return able to race each other without either being wrong.
 *
 * **Access tokens are fetched and cached.** PayPal is the only one of the three
 * that wants a token before every call; it is cached for slightly less than
 * its own lifetime, so a busy panel makes one token call an hour rather than
 * one per payment.
 *
 * **Webhooks are verified by asking PayPal.** There is no local signature to
 * recompute - the headers are handed back to their verify endpoint along with
 * the stored webhook id, and their answer is the verdict.
 */
class PayPal implements Gateway
{
    public const KEY = 'paypal';

    private const LIVE = 'https://api-m.paypal.com';

    private const SANDBOX = 'https://api-m.sandbox.paypal.com';

    private const TIMEOUT = 20;

    /** Where the cached token lives, and how far short of its life to keep it. */
    private const TOKEN_KEY = 'legend-theme.paypal.token';

    private const TOKEN_MARGIN = 60;

    public function key(): string
    {
        return self::KEY;
    }

    public function enabled(): bool
    {
        return (bool) Theme::config('shop_paypal_on', false)
            && $this->clientId() !== ''
            && $this->secret() !== '';
    }

    /**
     * Create an order and answer with the approval link.
     *
     * `custom_id` carries our invoice id so a payment can be traced from
     * PayPal's own dashboard, and `intent=CAPTURE` says the money is taken at
     * capture rather than authorised now and taken later - which is what makes
     * settle() the moment it moves.
     */
    public function start(Invoice $invoice, string $returnUrl, string $webhookUrl): ?string
    {
        $token = $this->token();

        // token() has already said why when it is null.
        if ($token === null) {
            return null;
        }

        if ((int) $invoice->total <= 0) {
            report(new RuntimeException('PayPal was asked for an order worth nothing, on invoice ' . $invoice->number . '.'));

            return null;
        }

        try {
            $response = Http::withToken($token)
                ->timeout(self::TIMEOUT)
                ->acceptJson()
                ->asJson()
                ->post($this->base() . '/v2/checkout/orders', [
                    'intent' => 'CAPTURE',
                    'purchase_units' => [[
                        'custom_id' => (string) (int) $invoice->id,
                        'description' => mb_substr(Theme::trans('shop.pay_description', [
                            'number' => (string) $invoice->number,
                        ]), 0, 127),
                        'amount' => [
                            'currency_code' => Money::currency($invoice->currency),
                            'value' => Money::decimal((int) $invoice->total),
                        ],
                    ]],
                    'application_context' => [
                        'return_url' => $returnUrl,
                        'cancel_url' => $returnUrl,
                        'user_action' => 'PAY_NOW',
                    ],
                ]);
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }

        if (!$response->successful()) {
            report(new RuntimeException('PayPal refused an order: ' . $response->status()));

            return null;
        }

        $body = $response->json();
        $id = is_array($body) ? (string) ($body['id'] ?? '') : '';
        $url = $this->approval(is_array($body) ? $body : []);

        if ($id === '' || $url === null) {
            report(new RuntimeException('PayPal took the order but gave back no address to send anybody to.'));

            return null;
        }

        Gateways::remember($invoice, self::KEY, $id, Payment::OPEN, is_array($body) ? $this->trim($body) : null);

        return $url;
    }

    /**
     * A webhook from PayPal, verified by PayPal.
     *
     * There is nothing to recompute locally: the five headers and the body go
     * back to their verify endpoint with the webhook id an administrator saved,
     * and SUCCESS is the only answer that counts. Without a stored webhook id
     * nothing can be verified, so nothing is believed.
     */
    public function webhook(Request $request): ?Payment
    {
        $webhookId = trim((string) Theme::config('shop_paypal_hook', ''));
        $token = $this->token();

        if ($webhookId === '' || $token === null) {
            return null;
        }

        try {
            $event = $request->json()->all();
        } catch (Throwable) {
            return null;
        }

        if (!is_array($event) || $event === []) {
            return null;
        }

        try {
            $check = Http::withToken($token)
                ->timeout(self::TIMEOUT)
                ->acceptJson()
                ->asJson()
                ->post($this->base() . '/v1/notifications/verify-webhook-signature', [
                    'auth_algo' => (string) $request->header('PAYPAL-AUTH-ALGO', ''),
                    'cert_url' => (string) $request->header('PAYPAL-CERT-URL', ''),
                    'transmission_id' => (string) $request->header('PAYPAL-TRANSMISSION-ID', ''),
                    'transmission_sig' => (string) $request->header('PAYPAL-TRANSMISSION-SIG', ''),
                    'transmission_time' => (string) $request->header('PAYPAL-TRANSMISSION-TIME', ''),
                    'webhook_id' => $webhookId,
                    'webhook_event' => $event,
                ]);
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }

        if (!$check->successful() || (string) ($check->json('verification_status') ?? '') !== 'SUCCESS') {
            return null;
        }

        $id = $this->orderId($event);

        if ($id === '') {
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
     * Capture, then read.
     *
     * Capturing twice is not a mistake here: PayPal refuses the second with
     * ORDER_ALREADY_CAPTURED, and the read that follows tells the truth either
     * way. That is deliberate - it is what lets the webhook and the customer's
     * return both call this without one of them having to win.
     */
    public function settle(Payment $payment): bool
    {
        $token = $this->token();

        if ($token === null) {
            return false;
        }

        $id = rawurlencode((string) $payment->gateway_id);

        // The capture. A failure here is not fatal: the order may already have
        // been captured by the other caller, and the read below settles it.
        try {
            Http::withToken($token)
                ->timeout(self::TIMEOUT)
                ->acceptJson()
                ->asJson()
                ->post($this->base() . '/v2/checkout/orders/' . $id . '/capture', []);
        } catch (Throwable $exception) {
            report($exception);
        }

        try {
            $response = Http::withToken($token)
                ->timeout(self::TIMEOUT)
                ->acceptJson()
                ->get($this->base() . '/v2/checkout/orders/' . $id);
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
            'COMPLETED' => Payment::PAID,
            'VOIDED' => Payment::CANCELLED,
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
     * An access token, cached for slightly less than it is good for.
     *
     * Cached rather than fetched per call because PayPal wants one before
     * every request and hands back a token good for hours. The margin means
     * the panel never presents one that expired between being read from the
     * cache and reaching them.
     */
    private function token(): ?string
    {
        $id = $this->clientId();
        $secret = $this->secret();

        if ($id === '' || $secret === '') {
            report(new RuntimeException('PayPal is on but has no client id or no secret.'));

            return null;
        }

        // The cache key carries which account and which environment, so
        // switching sandbox off does not present a sandbox token to live.
        $key = self::TOKEN_KEY . '.' . substr(hash('sha256', $this->base() . '|' . $id), 0, 16);

        try {
            $cached = Cache::get($key);

            if (is_string($cached) && $cached !== '') {
                return $cached;
            }
        } catch (Throwable) {
            // No cache is a slower path, not a broken one.
        }

        try {
            $response = Http::withBasicAuth($id, $secret)
                ->timeout(self::TIMEOUT)
                ->acceptJson()
                ->asForm()
                ->post($this->base() . '/v1/oauth2/token', ['grant_type' => 'client_credentials']);
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }

        if (!$response->successful()) {
            /*
             * The one that matters. PayPal answers 401 to a client id that is
             * not one, and this returned null without a word - so the customer
             * got "The payment could not be opened" and the log had nothing at
             * all in it. A wrong key is the most likely thing to be wrong with
             * a payment provider and the easiest to put right, once somebody
             * is told which.
             */
            report(new RuntimeException(
                'PayPal would not issue a token: HTTP ' . $response->status()
                . '. The client id or the secret is wrong, or they belong to the other environment'
                . ' - this panel is set to ' . ($this->sandbox() ? 'sandbox' : 'live') . '.',
            ));

            return null;
        }

        $token = (string) ($response->json('access_token') ?? '');
        $life = (int) ($response->json('expires_in') ?? 0);

        if ($token === '') {
            return null;
        }

        try {
            Cache::put($key, $token, max(60, $life - self::TOKEN_MARGIN));
        } catch (Throwable) {
            // Not cached; the next call fetches another.
        }

        return $token;
    }

    /**
     * The link PayPal wants the customer sent to.
     *
     * Read from their links array by rel rather than by position: the order
     * they come in is theirs to change, and picking one by index is a bug
     * waiting for a release note.
     *
     * @param  array<string, mixed>  $body
     */
    private function approval(array $body): ?string
    {
        foreach ((array) ($body['links'] ?? []) as $link) {
            if (!is_array($link)) {
                continue;
            }

            $rel = (string) ($link['rel'] ?? '');
            $href = (string) ($link['href'] ?? '');

            if (($rel === 'approve' || $rel === 'payer-action') && str_starts_with($href, 'https://')) {
                return $href;
            }
        }

        return null;
    }

    /**
     * Which order an event is about.
     *
     * A capture event names the order in supplementary_data; an order event
     * names it as the resource id. Both are read, because which one arrives
     * depends on what an administrator subscribed to.
     *
     * @param  array<string, mixed>  $event
     */
    private function orderId(array $event): string
    {
        $resource = is_array($event['resource'] ?? null) ? $event['resource'] : [];

        $id = (string) ($resource['supplementary_data']['related_ids']['order_id'] ?? '');

        if ($id !== '') {
            return $id;
        }

        $type = (string) ($event['resource_type'] ?? '');

        return $type === 'checkout-order' ? (string) ($resource['id'] ?? '') : '';
    }

    /** Which of PayPal's two worlds this panel is pointed at. */
    private function sandbox(): bool
    {
        return (bool) Theme::config('shop_paypal_sandbox', false);
    }

    private function base(): string
    {
        return (bool) Theme::config('shop_paypal_sandbox', false) ? self::SANDBOX : self::LIVE;
    }

    private function clientId(): string
    {
        return trim((string) Theme::config('shop_paypal_id', ''));
    }

    private function secret(): string
    {
        return trim((string) Theme::config('shop_paypal_secret', ''));
    }

    /**
     * @param  array<string, mixed>  $body
     * @return array<string, mixed>
     */
    private function trim(array $body): array
    {
        $unit = is_array($body['purchase_units'][0] ?? null) ? $body['purchase_units'][0] : [];

        return [
            'id' => $body['id'] ?? null,
            'status' => $body['status'] ?? null,
            'intent' => $body['intent'] ?? null,
            'amount' => $unit['amount'] ?? null,
            'custom_id' => $unit['custom_id'] ?? null,
            'create_time' => $body['create_time'] ?? null,
        ];
    }
}
