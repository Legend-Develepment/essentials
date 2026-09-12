<?php

namespace LegendDevelopment\Theme\Support;

use Throwable;

/**
 * Amounts, as integers.
 *
 * Every price in the shop is a number of minor units - cents, pence, øre -
 * and a three-letter currency the panel sets once. Never a float: 0.1 + 0.2 is
 * a famous number and an invoice for it is a support ticket. What comes in from
 * a form is a string with a comma or a point in it, and it becomes an integer
 * here before anything else sees it.
 *
 * Twelve currencies, and all twelve have two decimals at every provider this
 * plugin talks to. That is not a coincidence: a currency with none (JPY) or
 * three (KWD) needs a different `decimal()` for every gateway, and none of them
 * is offered here until somebody needs it.
 *
 * No `intl`. The panel may not have the extension, tools/check-imports.js
 * refuses a bare `use NumberFormatter`, and the plugin already formats every
 * other number with number_format(). What differs by language is only whether
 * the decimal mark is a comma, and that is a list rather than a library.
 */
class Money
{
    /** @var array<string, string> ISO code => the sign shown before the amount. */
    public const CURRENCIES = [
        'EUR' => '€',
        'USD' => '$',
        'GBP' => '£',
        'CHF' => 'CHF',
        'SEK' => 'kr',
        'DKK' => 'kr',
        'NOK' => 'kr',
        'PLN' => 'zł',
        'CZK' => 'Kč',
        'AUD' => 'A$',
        'CAD' => 'C$',
        'NZD' => 'NZ$',
    ];

    public const DEFAULT = 'EUR';

    /**
     * Languages that write twelve euros fifty as 12,50.
     *
     * Everything this plugin ships that is not on this list writes 12.50 -
     * English, the Chinese and Japanese and Korean, Arabic in its Latin digits.
     *
     * @var array<int, string>
     */
    private const COMMA = [
        'nl', 'de', 'fr', 'es', 'it', 'pt', 'pt_BR', 'pl', 'cs', 'sk', 'da', 'no',
        'sv', 'fi', 'hu', 'ro', 'bg', 'sr', 'ru', 'uk', 'be', 'lt', 'el', 'tr',
        'id', 'vi',
    ];

    /** A code the panel may be set to, or the default. */
    public static function currency(mixed $code): string
    {
        $code = is_string($code) ? strtoupper(trim($code)) : '';

        return array_key_exists($code, self::CURRENCIES) ? $code : self::DEFAULT;
    }

    public static function symbol(string $currency): string
    {
        return self::CURRENCIES[self::currency($currency)];
    }

    /**
     * For reading: "€ 12,50" or "$ 12.50", by the reader's language.
     */
    public static function format(int $minor, string $currency): string
    {
        return self::symbol($currency) . ' ' . self::plain($minor);
    }

    /**
     * For reading, without the sign - a table column with the currency in its
     * heading does not want it twelve times.
     */
    public static function plain(int $minor): string
    {
        $comma = self::commaDecimal();

        return number_format($minor / 100, 2, $comma ? ',' : '.', $comma ? '.' : ',');
    }

    /**
     * For a provider: "12.50", always a point, no sign, no grouping. This is
     * what Mollie and PayPal take as an amount and what Stripe takes divided
     * by a hundred.
     */
    public static function decimal(int $minor): string
    {
        return number_format($minor / 100, 2, '.', '');
    }

    /**
     * What somebody typed into a price field, as minor units.
     *
     * Accepts 12, 12.5, 12.50, 12,50 and 1.234,56 - the last one because a
     * Dutch reader will type it, and a form that refuses it is a form they
     * have to guess at. When both marks appear the last one is the decimal
     * mark; when one appears it is the decimal mark unless it is followed by
     * exactly three digits and nothing else, which is a thousands group.
     *
     * Anything else is null, and the form says so rather than storing zero.
     */
    public static function fromInput(mixed $typed): ?int
    {
        $text = is_string($typed) || is_numeric($typed) ? trim((string) $typed) : '';
        $text = str_replace(' ', '', $text);

        if ($text === '' || preg_match('/^[0-9.,]+$/', $text) !== 1) {
            return null;
        }

        $point = strrpos($text, '.');
        $comma = strrpos($text, ',');

        if ($point !== false && $comma !== false) {
            $decimal = max($point, $comma);
            $whole = str_replace(['.', ','], '', substr($text, 0, $decimal));
            $fraction = substr($text, $decimal + 1);
        } elseif ($point !== false || $comma !== false) {
            $at = $point !== false ? $point : $comma;
            $after = substr($text, $at + 1);

            // 1.234 is a thousand and a bit, not one point two three four.
            if (strlen($after) === 3 && substr_count($text, $point !== false ? '.' : ',') === 1) {
                $whole = str_replace(['.', ','], '', $text);
                $fraction = '';
            } else {
                $whole = substr($text, 0, $at);
                $fraction = $after;
            }
        } else {
            $whole = $text;
            $fraction = '';
        }

        if ($whole === '' || preg_match('/^[0-9]*$/', $whole) !== 1 || preg_match('/^[0-9]{0,2}$/', $fraction) !== 1) {
            return null;
        }

        $fraction = str_pad($fraction, 2, '0');

        // Twenty digits of euros is not a price, it is a typo.
        if (strlen($whole) > 12) {
            return null;
        }

        return (int) ($whole === '' ? '0' : $whole) * 100 + (int) $fraction;
    }

    /**
     * For a form that is showing a stored price back: "12.50" or "12,50".
     */
    public static function toInput(int $minor): string
    {
        return number_format($minor / 100, 2, self::commaDecimal() ? ',' : '.', '');
    }

    /**
     * Tax on an amount, from a rate in basis points, half up.
     *
     * 2100 is twenty-one percent. Integer arithmetic throughout: the product is
     * exact, and adding half the divisor before dividing is what makes 12.345
     * round to 12.35 rather than fall to 12.34.
     */
    public static function tax(int $amount, int $basisPoints): int
    {
        if ($amount <= 0 || $basisPoints <= 0) {
            return 0;
        }

        return intdiv($amount * $basisPoints + 5000, 10000);
    }

    /**
     * The tax already inside an amount, rather than the tax to add to it.
     *
     * A shop that prices in tax says 12.10 and means 10.00 plus 21%. Working
     * back out of it is not the same sum as working forward into it: 12.10
     * times 21% is 2.54, and the answer is 2.10. It is amount minus
     * amount/(1+rate), and it is done in integers so no cent is invented.
     *
     * Never more than the amount itself, whatever rate somebody types.
     */
    public static function taxIn(int $amount, int $basisPoints): int
    {
        if ($amount <= 0 || $basisPoints <= 0) {
            return 0;
        }

        // The net part, half up, and the tax is what is left - so the two
        // always add back up to exactly what came in.
        $net = intdiv($amount * 10000 + intdiv(10000 + $basisPoints, 2), 10000 + $basisPoints);

        return max(0, min($amount, $amount - $net));
    }

    /**
     * A percentage of an amount, half up, for a coupon.
     */
    public static function percent(int $amount, int $percent): int
    {
        if ($amount <= 0 || $percent <= 0) {
            return 0;
        }

        return min($amount, intdiv($amount * min(100, $percent) + 50, 100));
    }

    /**
     * The part of an amount that belongs to a part of a period.
     *
     * Twelve euro over thirty days, nineteen of them unused, is 7.60. Integer
     * arithmetic with half the divisor added before dividing, like tax() above,
     * so no cent is invented and none is lost.
     *
     * A part at or past the whole is the whole amount rather than more than it:
     * a period whose length somebody has edited underneath an order should not
     * be able to charge a customer more than the price of it.
     *
     * @param  int  $part   How much of the period this is about.
     * @param  int  $whole  How long the period is, in the same unit.
     */
    public static function share(int $amount, int $part, int $whole): int
    {
        if ($amount <= 0 || $part <= 0 || $whole <= 0) {
            return 0;
        }

        if ($part >= $whole) {
            return $amount;
        }

        return intdiv($amount * $part + intdiv($whole, 2), $whole);
    }

    private static function commaDecimal(): bool
    {
        try {
            return in_array(Languages::current(), self::COMMA, true);
        } catch (Throwable) {
            return false;
        }
    }
}
