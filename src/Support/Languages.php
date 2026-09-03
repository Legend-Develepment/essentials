<?php

namespace LegendDevelopment\Theme\Support;

use Throwable;

/**
 * Which language this plugin speaks to each person, and which of them are on.
 *
 * Most of this was already there and it is worth saying what, because the part
 * that had to be written is small and the part that did not is the reason it
 * works at all. Pelican stores a language on every user and its
 * LanguageMiddleware calls setLocale() with it on every request, so
 * app()->getLocale() is already the reader's own choice rather than the
 * server's. Laravel's translator already falls back to the fallback locale per
 * missing key rather than per missing file, so a half-translated language is a
 * working language: what has been translated appears, and the rest is English.
 *
 * That last property is why this is built around partial translations rather
 * than treating them as a defect. A plugin with seven hundred strings is never
 * finished in every language at once, and a design that only worked at a
 * hundred per cent would mean shipping nothing until then.
 *
 * So what is added here is the switch. A language being present is not the same
 * as it being wanted: somebody running an English-speaking team on a panel where
 * one person's account is set to German does not necessarily want half of one
 * page in German. Turning a language off sends those readers back to English for
 * this plugin's strings and leaves the rest of the panel alone.
 */
class Languages
{
    /** What everything falls back to, and the one language that cannot be off. */
    public const BASE = 'en';

    /**
     * Names in the language itself rather than in English.
     *
     * Somebody looking for their own language in a list scans for the word they
     * would use for it, which is "Nederlands" and not "Dutch". The English name
     * is beside it for whoever is administering the panel and does not read it.
     */
    private const NAMES = [
        'ar' => 'العربية (Arabic)',
        'be' => 'Беларуская (Belarusian)',
        'bg' => 'Български (Bulgarian)',
        'cs' => 'Čeština (Czech)',
        'da' => 'Dansk (Danish)',
        'de' => 'Deutsch (German)',
        'el' => 'Ελληνικά (Greek)',
        'en' => 'English',
        'es' => 'Español (Spanish)',
        'fi' => 'Suomi (Finnish)',
        'fr' => 'Français (French)',
        'hu' => 'Magyar (Hungarian)',
        'id' => 'Bahasa Indonesia',
        'it' => 'Italiano (Italian)',
        'ja' => '日本語 (Japanese)',
        'ko' => '한국어 (Korean)',
        'lt' => 'Lietuvių (Lithuanian)',
        'nl' => 'Nederlands (Dutch)',
        'no' => 'Norsk (Norwegian)',
        'pl' => 'Polski (Polish)',
        'pt' => 'Português (Portuguese)',
        'pt_BR' => 'Português do Brasil',
        'ro' => 'Română (Romanian)',
        'ru' => 'Русский (Russian)',
        'sk' => 'Slovenčina (Slovak)',
        'sv' => 'Svenska (Swedish)',
        'th' => 'ไทย (Thai)',
        'tr' => 'Türkçe (Turkish)',
        'uk' => 'Українська (Ukrainian)',
        'vi' => 'Tiếng Việt (Vietnamese)',
        'zh' => '中文 (Chinese)',
    ];

    /** @var array<string, array<int, string>>|null */
    private static ?array $scanned = null;

    private static ?string $current = null;

    /**
     * Which languages this plugin actually carries, found by looking.
     *
     * A directory under lang/ rather than a list in code: adding a translation
     * should be adding files, and a list would be a second place to remember.
     *
     * @return array<int, string>
     */
    public static function available(): array
    {
        if (self::$scanned !== null) {
            return self::$scanned['codes'];
        }

        $codes = [self::BASE];

        try {
            $directory = plugin_path(Theme::id() . '/lang');

            foreach ((array) glob($directory . '/*', GLOB_ONLYDIR) as $path) {
                $code = basename((string) $path);

                // Only the ones this class can name. An unrecognised directory
                // is more likely a mistake than a language, and a picker with a
                // bare code in it helps nobody.
                if ($code !== self::BASE && array_key_exists($code, self::NAMES)) {
                    $codes[] = $code;
                }
            }
        } catch (Throwable) {
            // Nothing readable, which leaves English - the one that is compiled
            // into every install and cannot be missing.
        }

        self::$scanned = ['codes' => $codes];

        return $codes;
    }

    /**
     * The picker's options: every language carried, named.
     *
     * @return array<string, string>
     */
    public static function options(): array
    {
        $options = [];

        foreach (self::available() as $code) {
            $options[$code] = self::NAMES[$code] ?? $code;
        }

        asort($options);

        return $options;
    }

    public static function name(string $code): string
    {
        return self::NAMES[$code] ?? $code;
    }

    /**
     * The languages an administrator has switched off.
     *
     * Stored as what is off rather than what is on, for the same reason the
     * feature switches are: a translation added in a later release should
     * arrive working rather than arrive invisible because it was not in a list
     * written before it existed.
     *
     * @return array<int, string>
     */
    public static function disabled(): array
    {
        try {
            $held = Theme::config('languages_off', '');

            if (!is_string($held) || trim($held) === '') {
                return [];
            }

            $off = [];

            foreach (explode(',', $held) as $code) {
                $code = trim($code);

                // English is never off. Everything falls back to it, and a panel
                // that had switched off its own fallback would show keys.
                if ($code !== '' && $code !== self::BASE && array_key_exists($code, self::NAMES)) {
                    $off[] = $code;
                }
            }

            return array_values(array_unique($off));
        } catch (Throwable) {
            return [];
        }
    }

    public static function enabled(string $code): bool
    {
        return $code === self::BASE || !in_array($code, self::disabled(), true);
    }

    /**
     * What to write the settings form's answer back as.
     *
     * The form offers what is on, so this is inverted on the way in - and it is
     * inverted against what is *available*, not against what was ticked, so
     * unticking everything really does mean everything off rather than nothing
     * changed.
     */
    public static function sanitise(mixed $on): string
    {
        $on = is_array($on) ? array_filter($on, 'is_string') : [];

        $off = [];

        foreach (self::available() as $code) {
            if ($code !== self::BASE && !in_array($code, $on, true)) {
                $off[] = $code;
            }
        }

        return implode(',', $off);
    }

    /**
     * The locale this plugin should answer in, for whoever is reading.
     *
     * Pelican has already set the application locale from the user's own
     * account by the time anything here runs, so this is only ever deciding
     * whether to honour it: a language this plugin does not carry, or one an
     * administrator has switched off, comes back as English.
     *
     * Note what this does not do - it does not change the application locale.
     * The rest of the panel goes on speaking whatever the reader chose; only
     * this plugin's own strings are affected, which is what "switch off a
     * language" can honestly mean from inside a plugin.
     */
    public static function current(): string
    {
        /*
         * Held for the request, and that is not a micro-optimisation.
         *
         * Every single Theme::trans() call asks this, and the settings pages
         * draw four hundred strings each - so without it, one page view meant
         * four hundred config reads, four hundred explode() calls and four
         * hundred array_unique() passes to answer a question whose answer
         * cannot change while the request is running. Neither the reader's
         * account nor the panel's settings move mid-request.
         */
        if (self::$current !== null) {
            return self::$current;
        }

        try {
            $locale = (string) app()->getLocale();

            if ($locale === '' || !in_array($locale, self::available(), true)) {
                return self::$current = self::BASE;
            }

            return self::$current = (self::enabled($locale) ? $locale : self::BASE);
        } catch (Throwable) {
            return self::$current = self::BASE;
        }
    }

    /**
     * Cleared when the setting is saved, because the settings page goes on to
     * re-render itself in the same request that changed it - and would
     * otherwise re-render in the language it had on the way in.
     */
    public static function forget(): void
    {
        self::$current = null;
        self::$scanned = null;
    }

    /**
     * How much of a language is actually translated, as a percentage.
     *
     * Shown in the settings list because a partial translation is normal here
     * and hiding that would be the dishonest option: somebody switching on a
     * language that is a third done should be able to see that before their
     * users do, rather than after.
     *
     * Counted against English, which is the only complete one by definition.
     */
    public static function completeness(string $code): int
    {
        if ($code === self::BASE) {
            return 100;
        }

        try {
            $base = self::count(self::BASE);

            if ($base === 0) {
                return 0;
            }

            return (int) min(100, round(self::count($code) / $base * 100));
        } catch (Throwable) {
            return 0;
        }
    }

    /**
     * Every leaf string in a language, counted.
     *
     * The files are included rather than parsed. They are this plugin's own
     * files, they are PHP returning an array, and a parser here would be a
     * second implementation of something the language already does - the build
     * has one for a different reason and does not need company.
     */
    private static function count(string $code): int
    {
        static $counted = [];

        if (array_key_exists($code, $counted)) {
            return $counted[$code];
        }

        $total = 0;

        try {
            $directory = plugin_path(Theme::id() . '/lang/' . $code);

            foreach ((array) glob($directory . '/*.php') as $file) {
                $values = @include (string) $file;

                if (is_array($values)) {
                    $total += self::leaves($values);
                }
            }
        } catch (Throwable) {
            $total = 0;
        }

        return $counted[$code] = $total;
    }

    /** @param  array<mixed>  $values */
    private static function leaves(array $values): int
    {
        $total = 0;

        foreach ($values as $value) {
            $total += is_array($value) ? self::leaves($value) : 1;
        }

        return $total;
    }
}
