<?php

namespace LegendDevelopment\Theme\Support\Shop;

use Illuminate\Support\Facades\Http;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * A customer's VAT number, and whether the tax is theirs to account for.
 *
 * The rule this exists for is one sentence of European tax law: when a business
 * in one member state sells a service to a VAT-registered business in another,
 * the seller charges no VAT and the buyer accounts for it themselves. On the
 * invoice it reads "VAT reverse-charged", and getting it wrong costs the seller
 * rather than the buyer - which is why every decision here leans towards
 * charging the tax.
 *
 * Three things have to be true before the tax comes off: the number has to be
 * shaped like a VAT number for the country it claims, that country has to be in
 * the union, and it has to be a *different* country from the one the shop sells
 * from. A Dutch number at a Dutch shop is an ordinary domestic sale with
 * ordinary Dutch VAT on it.
 *
 * **The format check is not a validity check**, and the difference matters.
 * NL999999999B01 is shaped correctly and belongs to nobody. That is what
 * check() is for: the union publishes a service that answers whether a number
 * is real, and this asks it. When that service cannot be reached the answer is
 * to charge the tax - an outage must not become a discount, and a shop can
 * always credit an invoice afterwards while it cannot always get VAT back.
 */
class Vat
{
    /**
     * The member states, and what a VAT number looks like in each.
     *
     * Written out rather than fetched, because the shape of a Dutch VAT number
     * is not something that changes on a Tuesday - and a shop that cannot take
     * a business order because a list would not download is worse than one
     * carrying a list that is a year out of date.
     *
     * Greece is EL here and not GR. That is the VAT prefix; the country code is
     * the other one, and mixing them up is the single most common reason a
     * perfectly good Greek number is refused.
     *
     * @var array<string, string>
     */
    private const SHAPES = [
        'AT' => '/^U[0-9]{8}$/',
        'BE' => '/^[01][0-9]{9}$/',
        'BG' => '/^[0-9]{9,10}$/',
        'CY' => '/^[0-9]{8}[A-Z]$/',
        'CZ' => '/^[0-9]{8,10}$/',
        'DE' => '/^[0-9]{9}$/',
        'DK' => '/^[0-9]{8}$/',
        'EE' => '/^[0-9]{9}$/',
        'EL' => '/^[0-9]{9}$/',
        'ES' => '/^[A-Z0-9][0-9]{7}[A-Z0-9]$/',
        'FI' => '/^[0-9]{8}$/',
        'FR' => '/^[A-Z0-9]{2}[0-9]{9}$/',
        'HR' => '/^[0-9]{11}$/',
        'HU' => '/^[0-9]{8}$/',
        'IE' => '/^([0-9]{7}[A-W]|[0-9][A-Z*+][0-9]{5}[A-W]|[0-9]{7}[A-W][AH])$/',
        'IT' => '/^[0-9]{11}$/',
        'LT' => '/^([0-9]{9}|[0-9]{12})$/',
        'LU' => '/^[0-9]{8}$/',
        'LV' => '/^[0-9]{11}$/',
        'MT' => '/^[0-9]{8}$/',
        'NL' => '/^[0-9]{9}B[0-9]{2}$/',
        'PL' => '/^[0-9]{10}$/',
        'PT' => '/^[0-9]{9}$/',
        'RO' => '/^[0-9]{2,10}$/',
        'SE' => '/^[0-9]{12}$/',
        'SI' => '/^[0-9]{8}$/',
        'SK' => '/^[0-9]{10}$/',
    ];

    /** How long an answer from the union's service is believed. */
    private const REMEMBER_HOURS = 24;

    /**
     * As it should be stored and printed: no spaces, no dots, upper case.
     *
     * People paste these off letterheads, where they are written NL 1234.56.789
     * B01 to be readable. That is the same number.
     */
    public static function normalise(mixed $value): string
    {
        $value = is_scalar($value) ? (string) $value : '';

        return mb_strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $value) ?? '');
    }

    /** The two letters in front, which say which country's rules apply. */
    public static function country(string $vat): string
    {
        return mb_substr(self::normalise($vat), 0, 2);
    }

    /** Whether it is shaped like a number of the country it claims to be from. */
    public static function looksValid(string $vat): bool
    {
        $vat = self::normalise($vat);
        $country = mb_substr($vat, 0, 2);
        $rest = mb_substr($vat, 2);

        if (!isset(self::SHAPES[$country]) || $rest === '') {
            return false;
        }

        return (bool) preg_match(self::SHAPES[$country], $rest);
    }

    /** Where this shop sells from, as the prefix a VAT number would carry. */
    public static function home(): string
    {
        $country = mb_strtoupper(trim((string) Theme::config('shop_company_country', '')));

        // A Greek shop writes GR in its address and EL on its VAT number.
        return $country === 'GR' ? 'EL' : $country;
    }

    /**
     * Whether this number takes the tax off this shop's invoice.
     *
     * Deliberately false when the shop has not said which country it is in.
     * Without that, "a different country" cannot be answered at all, and
     * guessing at it would be guessing with somebody's tax return.
     */
    public static function reverses(string $vat): bool
    {
        $home = self::home();

        if ($home === '' || !isset(self::SHAPES[$home])) {
            return false;
        }

        if (!self::looksValid($vat)) {
            return false;
        }

        // A domestic sale is a domestic sale, however business-like the buyer.
        return self::country($vat) !== $home;
    }

    /**
     * Ask the union whether the number is real.
     *
     * Answers true only for a number the service confirms. Everything else -
     * refused, unreachable, timed out, an answer that does not parse - is
     * false, because the safe direction is to charge the tax. A shop can credit
     * an invoice; it cannot always get VAT back out of one.
     *
     * Held for a day: a VAT registration does not come and go by the hour, and
     * a customer who mistypes should not put a hundred requests through a
     * service that is doing this for the whole of Europe.
     */
    public static function check(string $vat): bool
    {
        $vat = self::normalise($vat);

        if (!self::looksValid($vat)) {
            return false;
        }

        // Switched off, and then a well-formed number is as far as this goes.
        // Said plainly on the setting: it is the difference between a number
        // that looks right and one that exists.
        if (!(bool) Theme::config('shop_vat_check', true)) {
            return true;
        }

        $key = 'legend-theme.vat.' . md5($vat);

        try {
            $held = cache()->get($key);

            if (is_bool($held)) {
                return $held;
            }
        } catch (Throwable) {
            // A cache that will not answer costs a request, not the check.
        }

        $answer = self::ask($vat);

        try {
            cache()->put($key, $answer, now()->addHours(self::REMEMBER_HOURS));
        } catch (Throwable) {
            // Same again.
        }

        return $answer;
    }

    /** One question to the union's own service. */
    private static function ask(string $vat): bool
    {
        $country = mb_substr($vat, 0, 2);
        $number = mb_substr($vat, 2);

        try {
            $response = Http::timeout(6)
                ->connectTimeout(3)
                ->acceptJson()
                ->get('https://ec.europa.eu/taxation_customs/vies/rest-api/ms/' . $country . '/vat/' . $number);
        } catch (Throwable) {
            return false;
        }

        if (!$response->successful()) {
            return false;
        }

        return $response->json('isValid') === true;
    }
}
