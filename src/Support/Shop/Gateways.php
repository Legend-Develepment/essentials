<?php

namespace LegendDevelopment\Theme\Support\Shop;

use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Payment;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Which payment providers exist, and which of them are switched on.
 *
 * A registry rather than a list of ifs, so the billing page, the routes and
 * the settings page all ask the same question and get the same answer. Adding
 * a provider is adding a class and a line here.
 *
 * **Everything is wrapped.** A provider that throws while being asked whether
 * it is enabled must not take the billing page with it, and a panel with no
 * provider at all is the normal case: the shop works without one, by an
 * administrator marking invoices paid by hand.
 */
class Gateways
{
    /** Every provider this release knows about, in the order they are offered. */
    private const ALL = [
        Gateways\Mollie::class,
        Gateways\Stripe::class,
    ];

    /**
     * One instance of each, whether it is on or not.
     *
     * @return array<string, Gateway>
     */
    public static function all(): array
    {
        $out = [];

        foreach (self::ALL as $class) {
            try {
                /** @var Gateway $gateway */
                $gateway = new $class();

                $out[$gateway->key()] = $gateway;
            } catch (Throwable) {
                // A provider that cannot even be constructed is one this panel
                // does without.
            }
        }

        return $out;
    }

    /**
     * The ones a customer could actually pay with right now.
     *
     * @return array<string, Gateway>
     */
    public static function enabled(): array
    {
        if (!Features::enabled(Features::PAYMENTS) || !Features::enabled(Features::SHOP)) {
            return [];
        }

        $out = [];

        foreach (self::all() as $key => $gateway) {
            try {
                if ($gateway->enabled()) {
                    $out[$key] = $gateway;
                }
            } catch (Throwable) {
                // Not offered. An administrator sees why on the settings page.
            }
        }

        return $out;
    }

    /** One by name, if it exists and is switched on. */
    public static function get(string $key): ?Gateway
    {
        return self::enabled()[$key] ?? null;
    }

    /** Whether anybody can pay by themselves at all. */
    public static function any(): bool
    {
        return self::enabled() !== [];
    }

    /**
     * What a provider is called on a button.
     *
     * From the language files where there is a word for it, and the key itself
     * where there is not - so a provider added in a later release still has a
     * label before its translations land.
     */
    public static function label(string $key): string
    {
        $word = Theme::trans('shop.gateway_' . $key);

        return str_contains($word, 'shop.gateway_') ? ucfirst($key) : $word;
    }

    /**
     * Record an attempt.
     *
     * The unique index on (gateway, gateway_id) is what makes a webhook that
     * fires twice harmless, so this is an update-or-create rather than an
     * insert: the second call finds the first row and changes it instead of
     * failing on the index.
     */
    public static function remember(Invoice $invoice, string $gateway, string $id, string $state, mixed $raw = null): ?Payment
    {
        try {
            /** @var Payment $payment */
            $payment = Payment::query()->updateOrCreate(
                ['gateway' => $gateway, 'gateway_id' => mb_substr($id, 0, 191)],
                [
                    'invoice_id' => (int) $invoice->id,
                    'state' => $state,
                    'amount' => (int) $invoice->total,
                    'currency' => Money::currency($invoice->currency),
                    'raw' => is_array($raw) ? $raw : null,
                ],
            );

            return $payment;
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }
    }
}
