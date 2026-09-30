<?php

namespace LegendDevelopment\Theme\Support;

/**
 * What a setting is allowed to be.
 *
 * Every one of these takes whatever arrived - from a form, from a copied .env,
 * from a restored backup - and answers with something the panel can store and
 * draw. They were private helpers at the bottom of Settings, which is where
 * they were right to start and the wrong place for them to stay: three thousand
 * lines of form schemas and persistence sat between the rule and anybody
 * looking for it, and these are exactly what somebody reads when a value comes
 * out wrong.
 *
 * Two things they have in common, and both are why they exist:
 *
 * **What arrives is not to be trusted**, not because the person typing is
 * suspect but because these end up in a .env line and from there in a CSS
 * string or an HTML attribute. A newline ends a .env value early and takes the
 * rest of the file with it; an angle bracket ends an attribute.
 *
 * **Refusing beats storing something odd.** A URL that is not a URL becomes
 * empty rather than being written down to fail later somewhere that cannot say
 * why.
 */
class Clean
{
    /**
     * A few lines of plain text bound for .env.
     *
     * Newlines are kept as a marker and put back on the way out, because a
     * bank transfer note has three lines in it and .env has one. Angle
     * brackets go, as they do from every other line this writes.
     */
    public static function text(mixed $value, int $max): string
    {
        $value = is_string($value) ? $value : '';
        $value = str_replace(["\r\n", "\r"], "\n", $value);
        $value = str_replace(['<', '>'], '', $value);
        $value = preg_replace('/[\t]+/', ' ', $value) ?? '';

        return trim(mb_substr(str_replace("\n", '\\n', trim($value)), 0, $max));
    }

    /**
     * One line of plain text bound for a .env value and, from there, a CSS
     * string. Newlines would end both early, and the angle brackets have no
     * business in either.
     */
    public static function line(mixed $value): string
    {
        $value = is_string($value) ? $value : '';
        $value = preg_replace('/[\r\n\t]+/', ' ', $value) ?? '';
        $value = str_replace(['<', '>'], '', $value);

        return trim(mb_substr($value, 0, 160));
    }

    public static function url(mixed $value): string
    {
        $value = is_string($value) ? trim($value) : '';

        if ($value === '') {
            return '';
        }

        return filter_var($value, FILTER_VALIDATE_URL) === false ? '' : $value;
    }

    public static function secureUrl(mixed $value): string
    {
        $value = self::url($value);

        return str_starts_with($value, 'https://') ? $value : '';
    }

    /**
     * A logo path or URL. Same rules as the background: it ends up in an
     * attribute, so nothing that could break out of it survives.
     */
    public static function path(mixed $value): string
    {
        $value = is_string($value) ? trim($value) : '';

        if ($value === '') {
            return '';
        }

        $value = preg_replace('/[\s"\'<>]/', '', $value) ?? '';

        $isRelative = str_starts_with($value, '/');
        $isAbsolute = str_starts_with($value, 'https://') || str_starts_with($value, 'http://');

        return ($isRelative || $isAbsolute) ? $value : '';
    }

    /**
     * An invoice number's prefix: letters, digits and a few separators, so a
     * number is a thing that can be typed into a bank transfer.
     */
    public static function prefix(mixed $value): string
    {
        $value = is_string($value) ? trim($value) : '';
        $value = preg_replace('/[^A-Za-z0-9._-]/', '', $value) ?? '';

        return $value === '' ? 'INV-' : mb_substr($value, 0, 12);
    }

    /**
     * A credential, held to what a credential can be.
     *
     * Twitch issues these as thirty-odd characters of lowercase hex, but this
     * does not insist on that - a service changing the shape of its own keys
     * should not need a release here. What it does insist on is that the value
     * is one line of printable characters, because it goes into .env and a
     * newline there ends the variable and starts something else.
     */
    public static function credential(mixed $value): string
    {
        $value = is_string($value) ? trim($value) : '';

        $value = preg_replace('/[^!-~]/', '', $value) ?? '';

        /*
         * The ellipsis a dashboard puts on a key it is too narrow to show.
         *
         * PayPal, Stripe and Mollie all display a truncated key with three
         * dots after it, and selecting the text takes the dots with it. What
         * gets pasted here then looks like a key, is stored like a key, and is
         * refused by the provider with a 401 that says nothing about why - so
         * the panel says "the payment could not be opened" and everybody looks
         * at the code.
         *
         * A real key is base64-ish and never ends in a dot, so trimming them is
         * safe and turns a silent afternoon into a key that is merely too short
         * - which is a thing somebody notices.
         */
        $value = rtrim($value, '.');

        return mb_substr($value, 0, 128);
    }

    public static function clamp(mixed $value, int $min, int $max, int $fallback): int
    {
        if (!is_numeric($value)) {
            return $fallback;
        }

        return max($min, min($max, (int) $value));
    }

    public static function clampFloat(mixed $value, float $min, float $max, float $fallback): float
    {
        if (!is_numeric($value)) {
            return $fallback;
        }

        return round(max($min, min($max, (float) $value)), 2);
    }

    /**
     * @param  array<int, string>  $allowed
     */
    public static function oneOf(mixed $value, array $allowed, string $fallback): string
    {
        return in_array($value, $allowed, true) ? (string) $value : $fallback;
    }

    public static function iconPack(mixed $value): string
    {
        $value = is_string($value) ? trim($value) : '';

        if ($value === IconPacks::CUSTOM) {
            return IconPacks::CUSTOM;
        }

        return array_key_exists($value, IconPacks::sets()) ? $value : '';
    }

    /**
     * Dev is only storable on a panel that is allowed it, so a copied .env
     * cannot put another panel onto working-branch builds.
     */
    public static function channel(mixed $value): string
    {
        if ($value === Channels::DEV && Channels::devAllowed()) {
            return Channels::DEV;
        }

        return $value === Channels::BETA ? Channels::BETA : Channels::STABLE;
    }

    /**
     * @param  array<mixed, mixed>  $data
     */
    public static function keptInterval(array $data): string
    {
        $interval = Channels::autoUpdateValue($data['auto_update'] ?? null);

        return $interval === Channels::AUTO_OFF ? Channels::autoUpdateInterval() : $interval;
    }

    /**
     * A URL the form no longer asks about: what was submitted if anything was,
     * otherwise whatever is already configured.
     *
     * @param  array<mixed, mixed>  $data
     */
    public static function keptUrl(array $data, string $key): string
    {
        return array_key_exists($key, $data)
            ? self::url($data[$key])
            : self::url(Theme::config($key, ''));
    }
}
