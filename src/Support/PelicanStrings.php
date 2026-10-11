<?php

namespace LegendDevelopment\Theme\Support;

use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

/**
 * Pelican's own words, in the languages Pelican has not finished.
 *
 * Pelican's translations are its community's, and most of them are far from
 * done: against 1.0.0-beta38, a Finnish reader met English in 1595 of the
 * panel's 1822 strings, and 27,517 were missing across the thirty-one languages
 * this plugin speaks. This plugin carries translations of exactly those, one
 * file per language under resources/pelican, worded the way Pelican's own
 * translation in each language words things, and writes them where Laravel
 * looks for translations.
 *
 * **Pelican's own always wins.** Only what the panel's Pelican does not have is
 * written, worked out on this panel against the files that are here, and worked
 * out again when Pelican or this plugin changes. A string Pelican's translators
 * finish later replaces ours at the next pass, rather than ours covering theirs.
 * That matters because Laravel lays every registered path over the one before,
 * so a stale file here would win over Pelican: the pass is what keeps it honest.
 *
 * **Data in, PHP out, on the panel.** The files carried here are JSON; the PHP
 * files Laravel reads are written from them with var_export(), so nothing that
 * arrives as text is ever executed as it arrived.
 *
 * **Not beside Essentials Core.** That module carries the same files and does
 * the same thing under its own switch. Two plugins writing the same strings to
 * two places is two answers to keep in step, so this one stands down entirely
 * once Core is running: it neither writes nor registers anything.
 */
class PelicanStrings
{
    /**
     * Where the written files go, one directory per language.
     *
     * Under private storage rather than base_path('lang'): Pelican lists every
     * directory under its own lang path as a language somebody can pick, and
     * this is not a language of its own.
     */
    public const PATH = 'legend-theme/languages/pelican';

    /** What the files were last written against. See stamp(). */
    private const STAMP = 'legend-theme/languages/pelican.stamp';

    private const LOCALE = '/^[a-z]{2,3}(_[A-Za-z]{2,4})?$/D';

    private const GROUP = '/^[a-z0-9_-]+(\/[a-z0-9_-]+)*$/Di';

    /**
     * Whether the directory has been handed to the translator in this process.
     *
     * Laravel appends a path every time it is given one, so a second call would
     * have every group read twice for the rest of the request.
     */
    private static bool $registered = false;

    /**
     * Hand the directory to the translator.
     *
     * Laravel reads a group from every translation path in turn and lays each
     * over the one before, so this could replace Pelican's words. It does not,
     * because what was written holds only what Pelican lacks.
     */
    public static function register(): void
    {
        if (self::$registered) {
            return;
        }

        try {
            if (!Features::enabled(Features::PELICAN_STRINGS)) {
                return;
            }

            $path = Storage::disk('local')->path(self::PATH);

            if (is_dir($path)) {
                app('translator')->addPath($path);
                self::$registered = true;
            }
        } catch (Throwable) {
            // A panel that cannot take the path reads Pelican as it shipped.
        }
    }

    /**
     * Write the files again when what they were written against has changed.
     *
     * Asked on every install and hourly. Written whether or not the switch is on,
     * so switching it on is instant rather than an hour away; the switch decides
     * whether the translator is told, which is the whole of what it has to do.
     */
    public static function refresh(): void
    {
        if (self::handedOver()) {
            return;
        }

        try {
            $disk = Storage::disk('local');

            if (!$disk->exists(self::STAMP) || $disk->get(self::STAMP) !== self::stamp()) {
                self::render();
            }
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    /**
     * Write every language again, from what this plugin carries minus what
     * Pelican has.
     *
     * @return int the number of strings written
     *
     * @throws RuntimeException when a file cannot be written
     */
    public static function render(): int
    {
        $disk = Storage::disk('local');
        $disk->deleteDirectory(self::PATH);
        $written = 0;

        foreach (self::sources() as $locale => $file) {
            $written += self::write($locale, $file);
        }

        $disk->put(self::STAMP, self::stamp());

        return $written;
    }

    /**
     * Write one language again, straight away.
     *
     * For the moment something has just written into Pelican's own copy of a
     * language: an uploaded translation merges its panel strings there. The
     * hourly pass would not notice, because changing a file inside a language
     * directory does not change the directory, and until it did the string
     * written here would be laid over the one just uploaded.
     */
    public static function again(string $locale): void
    {
        if (self::handedOver()) {
            return;
        }

        try {
            $file = self::sources()[$locale] ?? null;

            if ($file !== null) {
                self::write($locale, $file);
            }
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    /** Whether Essentials Core is doing this instead. */
    private static function handedOver(): bool
    {
        return Standalone::replacesFeature(Features::PELICAN_STRINGS);
    }

    /**
     * The files this plugin carries, by locale.
     *
     * @return array<string, string>
     */
    private static function sources(): array
    {
        $found = [];

        foreach (glob(plugin_path(Theme::directory(), 'resources/pelican') . '/*.json') ?: [] as $file) {
            $locale = basename($file, '.json');

            if (preg_match(self::LOCALE, $locale) === 1) {
                $found[$locale] = $file;
            }
        }

        return $found;
    }

    /**
     * One language, replacing whatever was written for it before.
     *
     * @throws RuntimeException when a file cannot be written
     */
    private static function write(string $locale, string $file): int
    {
        $disk = Storage::disk('local');
        $disk->deleteDirectory(self::PATH . '/' . $locale);

        $ours = json_decode((string) file_get_contents($file), true);

        if (!is_array($ours)) {
            return 0;
        }

        $written = 0;

        foreach (self::byGroup($ours) as $group => $lines) {
            $missing = array_diff_key($lines, self::pelican($locale, $group));

            if ($missing === []) {
                continue;
            }

            $php = "<?php\n\n"
                . "/*\n"
                . " * Written by Essentials from resources/pelican: Pelican's own strings\n"
                . " * that this panel's Pelican does not have in this language.\n"
                . " *\n"
                . " * Written again whenever Pelican or the plugin changes, so an edit here\n"
                . " * does not last.\n"
                . " */\n\n"
                . 'return ' . var_export(self::nest($missing), true) . ";\n";

            throw_if(
                $disk->put(self::PATH . '/' . $locale . '/' . $group . '.php', $php) === false,
                new RuntimeException(
                    'Could not write Pelican\'s ' . $group . ' strings for ' . $locale
                    . '. Check that storage/app belongs to the user the panel runs as.',
                ),
            );

            $written += count($missing);
        }

        return $written;
    }

    /**
     * What these files depend on: this plugin's version, because it carries
     * them, Pelican's, because its translations are what is subtracted, and when
     * Pelican's language directories last changed, for a panel that updates its
     * translations without a new version number.
     */
    private static function stamp(): string
    {
        $changed = 0;

        foreach (glob(lang_path('*'), GLOB_ONLYDIR) ?: [] as $directory) {
            $changed = max($changed, (int) @filemtime($directory));
        }

        return Installed::version() . '|' . (string) config('app.version') . '|' . $changed;
    }

    /**
     * The carried strings, keyed by group and then by dotted key.
     *
     * The file writes a key as "<group>\t<key>", because a group holds slashes
     * and a key holds dots and neither can separate the other.
     *
     * @param  array<mixed, mixed>  $ours
     * @return array<string, array<string, string>>
     */
    private static function byGroup(array $ours): array
    {
        $groups = [];

        foreach ($ours as $name => $text) {
            if (!is_string($name) || !is_string($text) || trim($text) === '' || !str_contains($name, "\t")) {
                continue;
            }

            [$group, $key] = explode("\t", $name, 2);

            if (preg_match(self::GROUP, $group) === 1 && $key !== '') {
                $groups[$group][$key] = $text;
            }
        }

        return $groups;
    }

    /**
     * Pelican's own strings for one group in one language, flat, and only the
     * ones that say something: an empty string is a gap, not a translation.
     *
     * @return array<string, string>
     */
    private static function pelican(string $locale, string $group): array
    {
        $file = lang_path($locale . '/' . $group . '.php');

        if (!is_file($file)) {
            return [];
        }

        try {
            $lines = @include $file;
        } catch (Throwable) {
            return [];
        }

        return is_array($lines) ? self::flat($lines) : [];
    }

    /**
     * @param  array<mixed, mixed>  $lines
     * @return array<string, string>
     */
    private static function flat(array $lines, string $prefix = ''): array
    {
        $out = [];

        foreach ($lines as $key => $value) {
            if (is_array($value)) {
                $out += self::flat($value, $prefix . $key . '.');
            } elseif (is_string($value) && trim($value) !== '') {
                $out[$prefix . $key] = $value;
            }
        }

        return $out;
    }

    /**
     * Dotted keys back into the nested arrays a language file holds.
     *
     * A key that would have to be a string and a list at once is left out
     * rather than allowed to replace the other.
     *
     * @param  array<string, string>  $lines
     * @return array<string, mixed>
     */
    private static function nest(array $lines): array
    {
        $out = [];

        foreach ($lines as $key => $text) {
            $parts = explode('.', $key);
            $last = array_pop($parts);
            $node = &$out;

            foreach ($parts as $part) {
                if (isset($node[$part]) && !is_array($node[$part])) {
                    unset($node);

                    continue 2;
                }

                $node[$part] ??= [];
                $node = &$node[$part];
            }

            if (!isset($node[$last]) || !is_array($node[$last])) {
                $node[$last] = $text;
            }

            unset($node);
        }

        return $out;
    }
}
