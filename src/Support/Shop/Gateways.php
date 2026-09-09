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
        Gateways\PayPal::class,
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
     * What a provider actually covers, in words a customer recognises.
     *
     * "Mollie" and "Stripe" are the names of companies. What somebody choosing
     * how to pay recognises is a card, their own bank, or the PayPal account
     * they already have - so the payment page shows the company name with this
     * underneath it.
     *
     * Empty where a provider has no sentence yet, which the page draws as no
     * second line rather than as the key.
     */
    public static function note(string $key): string
    {
        $word = Theme::trans('shop.gateway_' . $key . '_note');

        return str_contains($word, 'shop.gateway_') ? '' : $word;
    }

    /**
     * The icon on a provider's card.
     *
     * Kept here rather than on the classes so the payment page can draw a
     * provider it has never heard of - a name it does not know gets the
     * generic card, which is right far more often than nothing at all.
     */
    /**
     * The company behind the button, for somebody who needs to know.
     *
     * The label says "Card" because that is what a customer is choosing, and
     * the name of the company processing it is not something most of them care
     * about. But the panel's owner does - it is the account the money lands in
     * - so it is on the card in small type rather than nowhere.
     */
    public static function provider(string $key): string
    {
        return match ($key) {
            'stripe' => 'Stripe',
            'paypal' => 'PayPal',
            'mollie' => 'Mollie',
            default => ucfirst($key),
        };
    }

    /**
     * Ask one provider whether it will talk to us.
     *
     * The whole of this class of problem is that a wrong key looks exactly like
     * a working one until a customer presses Pay - and what they get then is
     * "the payment could not be opened", which sends everybody to read code
     * instead of a dashboard. On a live panel the stored PayPal client id
     * turned out to be the dashboard's own truncated display text, ellipsis and
     * all, and finding that took a log, an SSH session and half an hour.
     *
     * So: a button that spends one request finding out, beside the fields.
     * Read-only - it authenticates and asks nothing to be created, so pressing
     * it costs nobody anything and can be pressed as often as it takes.
     *
     * @return array{ok: bool, said: string}
     */
    public static function check(string $key): array
    {
        $gateway = self::get($key);

        if ($gateway === null) {
            return ['ok' => false, 'said' => Theme::trans('shop.check_off')];
        }

        if (!$gateway->enabled()) {
            return ['ok' => false, 'said' => Theme::trans('shop.check_off')];
        }

        try {
            $said = $gateway->check();
        } catch (Throwable $exception) {
            report($exception);

            return ['ok' => false, 'said' => $exception->getMessage()];
        }

        return $said === null
            ? ['ok' => true, 'said' => Theme::trans('shop.check_good')]
            : ['ok' => false, 'said' => $said];
    }

    public static function icon(string $key): string
    {
        return match ($key) {
            'paypal' => 'tabler-brand-paypal',
            'mollie' => 'tabler-building-bank',
            default => 'tabler-credit-card',
        };
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
