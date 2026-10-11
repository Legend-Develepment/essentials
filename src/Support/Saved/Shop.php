<?php

namespace LegendDevelopment\Theme\Support\Saved;

use App\Traits\EnvironmentWriterTrait;
use LegendDevelopment\Theme\Support\Clean;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Settings;
use LegendDevelopment\Theme\Support\Portable;
use LegendDevelopment\Theme\Support\Shop\Billing;
use LegendDevelopment\Theme\Support\Shop\Cart;
use LegendDevelopment\Theme\Support\Shop\Purchase;
use LegendDevelopment\Theme\Support\Theme;

/**
 * The shop: currency, tax, what a purchase does next, read and written.
 *
 * Lifted out of Settings whole rather than rewritten. That file answered for
 * ten pages at once and every change to one of them went through it; this is
 * the same code, in the file named after the page that owns it.
 *
 * Settings::shopData() and Settings::persistShop() are still there and still
 * work: they hand over to these two. Nothing that called them had to change,
 * which is the point of moving the body and leaving the name.
 */
class Shop
{
    use EnvironmentWriterTrait;

    /**
     * The settings that are credentials, and the variable each is kept in.
     *
     * Never filled into the settings form, and an empty one written back keeps
     * what .env holds: see read() and write(). Not encrypted, because the only
     * key there is to encrypt them with is APP_KEY, and that sits in the same
     * .env - somebody who can read one can read the other.
     */
    public const SECRETS = [
        'shop_mollie_key' => 'LEGEND_THEME_SHOP_MOLLIE_KEY',
        'shop_stripe_key' => 'LEGEND_THEME_SHOP_STRIPE_KEY',
        'shop_stripe_hook' => 'LEGEND_THEME_SHOP_STRIPE_HOOK',
        'shop_paypal_secret' => 'LEGEND_THEME_SHOP_PAYPAL_SECRET',
    ];

    /**
     * The shop's own settings.
     *
     * The currency, the tax, how invoices are numbered, the renewal timing and
     * the words on the public page. Nearly all of it travels in a settings
     * export - none of it is a secret and all of it is what a second panel
     * copying this one would want. The payment providers' keys and ids are the
     * exception and are in Portable::EXCLUDED.
     *
     * **The four SECRETS are read as empty.** A form's state is a public
     * Livewire property, and a public property travels in the page's HTML:
     * filling the form with the Stripe key put it in the source of the page,
     * readable by anybody allowed to open it - including somebody who may only
     * look, because a section hidden from them decides what is drawn and not
     * what is filled. The field says "saved" instead, from hasSecret().
     *
     * The tax is kept as basis points - 2100 for twenty-one percent - so a rate
     * with two decimals is an integer in .env and integer arithmetic on every
     * invoice. The form shows and takes a percentage.
     *
     * @return array<string, mixed>
     */
    public static function read(): array
    {
        return [
            'shop_currency' => Money::currency(Theme::config('shop_currency', Money::DEFAULT)),
            'shop_tax' => Clean::clamp(Theme::config('shop_tax', 0), 0, 10000, 0) / 100,
            'shop_invoice_prefix' => (string) Theme::config('shop_invoice_prefix', 'INV-'),
            'shop_notice_days' => (int) Theme::config('shop_notice_days', 7),
            'shop_grace_days' => (int) Theme::config('shop_grace_days', 7),
            'shop_heading' => (string) Theme::config('shop_heading', ''),
            'shop_note' => Settings::unfold(Theme::config('shop_note', '')),
            'shop_terms_url' => (string) Theme::config('shop_terms_url', ''),
            'shop_company_name' => (string) Theme::config('shop_company_name', ''),
            'shop_company_address' => (string) Theme::config('shop_company_address', ''),
            'shop_company_vat' => (string) Theme::config('shop_company_vat', ''),
            'shop_company_coc' => (string) Theme::config('shop_company_coc', ''),
            'shop_company_email' => (string) Theme::config('shop_company_email', ''),
            'shop_company_country' => (string) Theme::config('shop_company_country', ''),
            'shop_due_days' => Billing::dueDays(),
            'shop_pay_note' => Settings::unfold(Theme::config('shop_pay_note', '')),
            'shop_landing' => (bool) Theme::config('shop_landing', false),
            'shop_self_cancel' => (bool) Theme::config('shop_self_cancel', false),
            'shop_wait' => (bool) Theme::config('shop_wait', true),
            'shop_basket' => Cart::allowed(),
            'shop_tax_inclusive' => Purchase::inclusive(),
            'shop_vat_check' => (bool) Theme::config('shop_vat_check', true),
            'shop_mollie_on' => (bool) Theme::config('shop_mollie_on', false),
            // Never the stored credential - see above. Empty keeps what is saved.
            'shop_mollie_key' => '',
            'shop_stripe_on' => (bool) Theme::config('shop_stripe_on', false),
            'shop_stripe_key' => '',
            'shop_stripe_hook' => '',
            'shop_paypal_on' => (bool) Theme::config('shop_paypal_on', false),
            'shop_paypal_sandbox' => (bool) Theme::config('shop_paypal_sandbox', false),
            'shop_paypal_id' => (string) Theme::config('shop_paypal_id', ''),
            'shop_paypal_secret' => '',
            'shop_paypal_hook' => (string) Theme::config('shop_paypal_hook', ''),
        ];
    }

    /**
     * Whether a credential is on file, without handing it to anybody.
     *
     * What the settings form asks instead of the value: it is enough to say
     * "one is saved" in the field.
     */
    public static function hasSecret(string $key): bool
    {
        return array_key_exists($key, self::SECRETS) && trim((string) Theme::config($key, '')) !== '';
    }

    /**
     * Everything that reaches here is merged over read(), by the form and by a
     * settings import alike, so a credential arrives empty unless somebody
     * typed a new one. Empty therefore means "keep it" and is not written:
     * leaving the variable out leaves the value .env already holds. An import
     * never carries one either, because Portable::EXCLUDED keeps them out of
     * the file and parse() drops what the file does not export.
     *
     * @param  array<mixed, mixed>  $data
     */
    public static function write(array $data): void
    {
        $values = [
            'LEGEND_THEME_SHOP_CURRENCY' => Money::currency($data['shop_currency'] ?? null),
            // A percentage in, basis points out: 21.5 becomes 2150.
            'LEGEND_THEME_SHOP_TAX' => (string) (int) round(Clean::clampFloat($data['shop_tax'] ?? null, 0, 100, 0) * 100),
            'LEGEND_THEME_SHOP_PREFIX' => Clean::prefix($data['shop_invoice_prefix'] ?? null),
            'LEGEND_THEME_SHOP_NOTICE' => (string) Clean::clamp($data['shop_notice_days'] ?? null, 0, 90, 7),
            'LEGEND_THEME_SHOP_GRACE' => (string) Clean::clamp($data['shop_grace_days'] ?? null, 0, 365, 7),
            'LEGEND_THEME_SHOP_HEADING' => mb_substr(Clean::line($data['shop_heading'] ?? null), 0, 80),
            'LEGEND_THEME_SHOP_NOTE' => Clean::text($data['shop_note'] ?? null, 400),
            // https only: it is a link drawn on a page for strangers.
            'LEGEND_THEME_SHOP_TERMS' => Clean::secureUrl($data['shop_terms_url'] ?? null),
            'LEGEND_THEME_SHOP_COMPANY' => Clean::line($data['shop_company_name'] ?? null),
            // Kept as typed, newlines and all: it is an address, and an address
            // is lines. Billing::issuer() is what drops the empty ones.
            'LEGEND_THEME_SHOP_ADDRESS' => mb_substr(trim((string) ($data['shop_company_address'] ?? '')), 0, 600),
            'LEGEND_THEME_SHOP_VAT' => Clean::line($data['shop_company_vat'] ?? null),
            'LEGEND_THEME_SHOP_COC' => Clean::line($data['shop_company_coc'] ?? null),
            'LEGEND_THEME_SHOP_EMAIL' => Clean::line($data['shop_company_email'] ?? null),
            // Two letters, upper case. Anything else is not a country code, and
            // the reverse-charge question is answered with this.
            'LEGEND_THEME_SHOP_COUNTRY' => mb_strtoupper(preg_replace('/[^A-Za-z]/', '', (string) ($data['shop_company_country'] ?? '')) ?? ''),
            'LEGEND_THEME_SHOP_DUE_DAYS' => (string) Clean::clamp($data["shop_due_days"] ?? null, 0, 90, 0),
            'LEGEND_THEME_SHOP_PAY_NOTE' => Clean::text($data['shop_pay_note'] ?? null, 1000),
            'LEGEND_THEME_SHOP_LANDING' => ($data['shop_landing'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_SHOP_SELF_CANCEL' => ($data['shop_self_cancel'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_SHOP_WAIT' => ($data['shop_wait'] ?? true) ? 'true' : 'false',
            'LEGEND_THEME_SHOP_BASKET' => ($data['shop_basket'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_SHOP_TAX_INCLUSIVE' => ($data['shop_tax_inclusive'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_SHOP_VAT_CHECK' => ($data['shop_vat_check'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_SHOP_MOLLIE_ON' => ($data['shop_mollie_on'] ?? false) ? 'true' : 'false',
            // A credential: printable characters only, and never exported.
            'LEGEND_THEME_SHOP_MOLLIE_KEY' => Clean::credential($data['shop_mollie_key'] ?? null),
            'LEGEND_THEME_SHOP_STRIPE_ON' => ($data['shop_stripe_on'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_SHOP_STRIPE_KEY' => Clean::credential($data['shop_stripe_key'] ?? null),
            'LEGEND_THEME_SHOP_STRIPE_HOOK' => Clean::credential($data['shop_stripe_hook'] ?? null),
            'LEGEND_THEME_SHOP_PAYPAL_ON' => ($data['shop_paypal_on'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_SHOP_PAYPAL_SANDBOX' => ($data['shop_paypal_sandbox'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_SHOP_PAYPAL_ID' => Clean::credential($data['shop_paypal_id'] ?? null),
            'LEGEND_THEME_SHOP_PAYPAL_SECRET' => Clean::credential($data['shop_paypal_secret'] ?? null),
            'LEGEND_THEME_SHOP_PAYPAL_HOOK' => Clean::credential($data['shop_paypal_hook'] ?? null),
        ];

        foreach (self::SECRETS as $variable) {
            if ($values[$variable] === '') {
                unset($values[$variable]);
            }
        }

        (new self())->writeToEnvironment($values);
    }
}
