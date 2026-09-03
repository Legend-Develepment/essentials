<?php

namespace LegendDevelopment\Theme\Support;

use Illuminate\Support\Facades\Storage;
use Throwable;

/**
 * Making a language without touching the plugin.
 *
 * Download a JSON of every string, translate the values, upload it back. That
 * is the whole of it, and the two halves are shaped by where the result has to
 * live.
 *
 * Not in the plugin's own lang directory, which is the obvious place and the
 * wrong one: installing an update replaces the plugin folder entire, so a
 * translation kept there would be thrown away by the next release - silently,
 * and at the moment somebody is least expecting it. Laravel already has a place
 * for exactly this. A namespaced translation is overridden by
 * lang/vendor/<namespace>/<locale>/<group>.php in the application, which sits
 * outside the plugin and is merged over it per key. So an uploaded language can
 * also be a partial one: what it translates wins, and the rest falls back the
 * way every other language here does.
 *
 * The file covers the panel's own strings too, so one download and one upload
 * is the whole of a language rather than half of it. The two halves are told
 * apart by the prefix Laravel itself uses: this plugin's keys are addressed as
 * `essentials::page.title` in code and appear that way in the file, and the
 * panel's own are bare - `activity.description`, `admin/node.title`.
 *
 * They are also written to different places, and the difference matters. A
 * namespaced translation is merged over the plugin's per key, so a partial file
 * is a partial language. The panel's own are not namespaced and Laravel does not
 * merge those: `lang/nl/activity.php` replaces the file. So the panel half is
 * read, merged over, and written back whole - otherwise uploading five Dutch
 * strings would throw away the several hundred Pelican already ships.
 *
 * One thing that cannot be helped and is worth knowing: updating Pelican
 * replaces its own lang files, and the panel half of an upload lives in them.
 * The plugin half is outside the plugin and survives everything.
 *
 * Flat keys in the JSON rather than nested objects, because it is meant to be
 * edited by a person in a text editor and a flat list is one you can search,
 * sort and diff. It is expanded back into the nested arrays PHP wants on the
 * way in.
 */
class Translations
{
    /**
     * The JSON is written and read by hand, so this is a real ceiling rather
     * than a formality: the file is about a hundred kilobytes with every string
     * in it, and anything much past that is not a translation of this plugin.
     */
    public const MAX_BYTES = 2097152;

    /**
     * Every string, flattened, with the values of one language in them.
     *
     * English when the code is unknown or not asked for, which is what makes
     * this a template: somebody starting a new language gets the English text
     * to translate rather than a file of empty strings, and can see what each
     * key is for.
     *
     * @return array<string, string>
     */
    public static function template(?string $code = null): array
    {
        $out = [];
        $existing = $code !== null && $code !== Languages::BASE;

        // This plugin's, under the prefix its keys actually carry in code.
        foreach (self::groups() as $group => $english) {
            $theirs = $existing ? self::read($code, $group) : [];

            foreach (self::flatten($english) as $key => $value) {
                $out[self::prefix() . $group . '.' . $key] = self::pluck($theirs, $key) ?? $value;
            }
        }

        // The panel's own, bare, which is how Laravel addresses them.
        foreach (self::panelGroups() as $group => $english) {
            $theirs = $existing ? self::panelRead($code, $group) : [];

            foreach (self::flatten($english) as $key => $value) {
                $out[$group . '.' . $key] = self::pluck($theirs, $key) ?? $value;
            }
        }

        ksort($out);

        return $out;
    }

    /**
     * The template as the file people are handed.
     *
     * Unescaped slashes and unicode so a translator reads their own alphabet in
     * the file rather than a run of escapes, and pretty-printed because they are
     * going to open it.
     */
    public static function json(?string $code = null): string
    {
        return (string) json_encode(
            self::template($code),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
        );
    }

    /* ------------------------------------------------------- installing --- */

    /**
     * Write an uploaded translation into the application's override directory.
     *
     * Answers with what it did, because a translation is nearly always partial
     * and the person who made it is the one who can tell whether the number is
     * the number they expected.
     *
     * @param  array<string, mixed>  $flat
     * @return array{written: int, skipped: int, unknown: array<int, string>}
     */
    public static function install(string $code, array $flat): array
    {
        $known = self::template();
        $nested = [];
        $panel = [];
        $written = 0;
        $skipped = 0;
        $unknown = [];
        $prefix = self::prefix();

        foreach ($flat as $key => $value) {
            if (!is_string($key) || !is_string($value) || trim($value) === '') {
                $skipped++;

                continue;
            }

            /*
             * Only keys English has.
             *
             * A key nothing asks for is dead weight at best, and at worst it is
             * a misspelling of a real one - which means that string is not
             * actually translated while looking as though it is. The same rule
             * the build applies to the translations shipped here.
             */
            /*
             * A file downloaded before the panel's strings were in it has this
             * plugin's keys without the prefix. Accepting those is a small
             * kindness that costs one lookup: a translation somebody spent an
             * evening on should not be refused wholesale for a naming change.
             */
            if (!array_key_exists($key, $known) && array_key_exists($prefix . $key, $known)) {
                $key = $prefix . $key;
            }

            if (!array_key_exists($key, $known)) {
                if (count($unknown) < 20) {
                    $unknown[] = $key;
                }

                $skipped++;

                continue;
            }

            $mine = str_starts_with($key, $prefix);
            $parts = explode('.', $mine ? substr($key, strlen($prefix)) : $key);
            $group = array_shift($parts);

            if ($parts === []) {
                $skipped++;

                continue;
            }

            if ($mine) {
                self::put($nested[$group] ??= [], $parts, $value);
            } else {
                self::put($panel[$group] ??= [], $parts, $value);
            }

            $written++;
        }

        if ($nested !== []) {
            self::write($code, $nested);
        }

        if ($panel !== []) {
            self::panelWrite($code, $panel);
        }

        return ['written' => $written, 'skipped' => $skipped, 'unknown' => $unknown];
    }

    /** Take a language back out again. */
    public static function remove(string $code): bool
    {
        $directory = self::path($code);

        if ($directory === null || !is_dir($directory)) {
            return false;
        }

        try {
            self::disk()?->deleteDirectory($code);

            return !is_dir($directory);
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * The codes somebody has uploaded, which are languages this plugin can
     * answer in even though it ships nothing for them.
     *
     * @return array<int, string>
     */
    public static function uploaded(): array
    {
        $codes = [];

        try {
            $disk = self::disk();

            if ($disk === null) {
                return [];
            }

            foreach ($disk->directories() as $directory) {
                $code = basename((string) $directory);

                // A directory with nothing in it is a language somebody started
                // and did not finish, not one this can answer in.
                if ($disk->files($code) !== []) {
                    $codes[] = $code;
                }
            }
        } catch (Throwable) {
            return [];
        }

        return $codes;
    }

    /* ------------------------------------------------------------ inside --- */

    /**
     * The application's override directory for this plugin, or null.
     *
     * lang_path() rather than anywhere inside the plugin: this has to outlive an
     * update, and an update replaces the plugin folder.
     */
    private static function path(?string $code): ?string
    {
        try {
            $base = lang_path('vendor/' . Theme::id());

            if ($code === null) {
                return $base;
            }

            // A code becomes a directory name, so it is held to the shape of a
            // locale and nothing else.
            return preg_match('/^[A-Za-z]{2,3}(_[A-Za-z0-9]{2,8})?$/D', $code) === 1
                ? $base . '/' . $code
                : null;
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * A disk rooted on the override directory, or null.
     *
     * Built rather than configured, because this is one directory used by one
     * feature and a named disk in the panel's config would be a thing every
     * other plugin could see. Everything that writes goes through it: mkdir,
     * file_put_contents, unlink and rmdir are all names Pelican Hub refuses,
     * and this plugin has been turned away over exactly that before.
     */
    private static function disk(): ?\Illuminate\Contracts\Filesystem\Filesystem
    {
        try {
            $root = self::path(null);

            return $root === null ? null : Storage::build(['driver' => 'local', 'root' => $root]);
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * @param  array<string, array<string, mixed>>  $groups
     *
     * @throws \RuntimeException
     */
    private static function write(string $code, array $groups): void
    {
        $directory = self::path($code);

        throw_if($directory === null, new \RuntimeException('That is not a language code this can use.'));

        $disk = self::disk();

        throw_if(
            $disk === null,
            new \RuntimeException('The panel could not open its lang directory to write to.'),
        );

        foreach ($groups as $group => $values) {
            /*
             * var_export rather than building the PHP by hand.
             *
             * These strings are full of apostrophes and accents, and hand-rolled
             * escaping of exactly this kind has broken this plugin before - a
             * single unescaped apostrophe in a lang file took the whole panel
             * down in 2.48. var_export is the language's own answer and cannot
             * get it wrong.
             */
            $php = "<?php\n\n"
                . "/*\n"
                . " * Written by the Languages tab from an uploaded translation.\n"
                . " *\n"
                . " * Outside the plugin on purpose: an update replaces the plugin folder,\n"
                . " * and Laravel merges this over what the plugin ships, per key.\n"
                . " */\n\n"
                . 'return ' . var_export($values, true) . ";\n";

            $name = preg_replace('/[^a-z0-9_-]/', '', strtolower($group));

            throw_if(
                $name === null || $name === '',
                new \RuntimeException('A group in that file has no usable name.'),
            );

            /*
             * put() answers false for the ordinary failures - an unwritable
             * directory, a full disk - and throws only for the rarer ones, so a
             * caller watching for an exception alone would report success for
             * the common way this goes wrong. The directory is created for us.
             */
            throw_if(
                $disk->put($code . '/' . $name . '.php', $php) === false,
                new \RuntimeException(
                    'Could not write the ' . $group . ' file. The panel needs to be able to write to its lang directory.',
                ),
            );
        }
    }

    /** The prefix this plugin's own keys carry, which is how code addresses them. */
    private static function prefix(): string
    {
        return Theme::id() . '::';
    }

    /**
     * The panel's own English files, by group.
     *
     * One level of directories as well as the files at the top, because Laravel
     * addresses a file in a subdirectory as `admin/node.title` - and Pelican
     * keeps most of its strings that way.
     *
     * @return array<string, array<string, mixed>>
     */
    private static function panelGroups(): array
    {
        $groups = [];

        try {
            $root = lang_path(Languages::BASE);

            foreach ((array) glob($root . '/*.php') as $file) {
                $values = @include (string) $file;

                if (is_array($values)) {
                    $groups[basename((string) $file, '.php')] = $values;
                }
            }

            foreach ((array) glob($root . '/*', GLOB_ONLYDIR) as $directory) {
                $name = basename((string) $directory);

                foreach ((array) glob($directory . '/*.php') as $file) {
                    $values = @include (string) $file;

                    if (is_array($values)) {
                        $groups[$name . '/' . basename((string) $file, '.php')] = $values;
                    }
                }
            }
        } catch (Throwable) {
            // A panel whose own lang directory cannot be read still gets this
            // plugin's half, which is better than nothing at all.
            return [];
        }

        ksort($groups);

        return $groups;
    }

    /**
     * One group of the panel's own translation for a locale.
     *
     * @return array<string, mixed>
     */
    private static function panelRead(string $code, string $group): array
    {
        if (!self::locale($code) || !self::group($group)) {
            return [];
        }

        $file = lang_path($code . '/' . $group . '.php');

        if (!is_file($file)) {
            return [];
        }

        $values = @include $file;

        return is_array($values) ? $values : [];
    }

    /**
     * Write the panel half, merged over whatever is already there.
     *
     * Merged rather than replaced, and this is the difference between the two
     * halves. Laravel merges a namespaced override per key, so the plugin half
     * can be partial and the rest falls back. It does not do that for the
     * panel's own files - lang/nl/activity.php is the file - so writing five
     * translated strings on their own would throw away the several hundred
     * Pelican already ships in that language.
     *
     * @param  array<string, array<string, mixed>>  $groups
     *
     * @throws \RuntimeException
     */
    private static function panelWrite(string $code, array $groups): void
    {
        throw_if(!self::locale($code), new \RuntimeException('That is not a language code this can use.'));

        $disk = self::panelDisk();

        throw_if(
            $disk === null,
            new \RuntimeException('The panel could not open its own lang directory to write to.'),
        );

        foreach ($groups as $group => $values) {
            if (!self::group($group)) {
                continue;
            }

            $merged = array_replace_recursive(self::panelRead($code, $group), $values);

            $php = "<?php\n\n"
                . "/*\n"
                . " * The panel's own strings for this language, with an uploaded\n"
                . " * translation merged over them by the Languages tab.\n"
                . " *\n"
                . " * Updating Pelican replaces this file. The plugin's own half of the\n"
                . " * same upload lives outside the plugin and survives that.\n"
                . " */\n\n"
                . 'return ' . var_export($merged, true) . ";\n";

            throw_if(
                $disk->put($code . '/' . $group . '.php', $php) === false,
                new \RuntimeException(
                    'Could not write the ' . $group . ' file. The panel needs to be able to write to its lang directory.',
                ),
            );
        }
    }

    private static function panelDisk(): ?\Illuminate\Contracts\Filesystem\Filesystem
    {
        try {
            return Storage::build(['driver' => 'local', 'root' => lang_path()]);
        } catch (Throwable) {
            return null;
        }
    }

    /** The shape of a locale, checked before it becomes a directory name. */
    private static function locale(string $code): bool
    {
        return preg_match('/^[A-Za-z]{2,3}(_[A-Za-z0-9]{2,8})?$/D', $code) === 1;
    }

    /**
     * A group name, which may carry one directory - `admin/node`.
     *
     * Checked because it becomes a path. One level and no more: Pelican nests
     * exactly that far, and allowing deeper would allow a great deal else.
     */
    private static function group(string $group): bool
    {
        return preg_match('/^[a-z0-9_-]+(\/[a-z0-9_-]+)?$/D', $group) === 1;
    }

    /**
     * The English files, by group.
     *
     * @return array<string, array<string, mixed>>
     */
    private static function groups(): array
    {
        $groups = [];

        try {
            foreach ((array) glob(plugin_path(Theme::directory(), 'lang/' . Languages::BASE) . '/*.php') as $file) {
                $values = @include (string) $file;

                if (is_array($values)) {
                    $groups[basename((string) $file, '.php')] = $values;
                }
            }
        } catch (Throwable) {
            return [];
        }

        ksort($groups);

        return $groups;
    }

    /**
     * One group of one uploaded language, if there is one.
     *
     * @return array<string, mixed>
     */
    private static function read(string $code, string $group): array
    {
        $directory = self::path($code);

        if ($directory === null) {
            return [];
        }

        $file = $directory . '/' . $group . '.php';

        if (!is_file($file)) {
            return [];
        }

        $values = @include $file;

        return is_array($values) ? $values : [];
    }

    /**
     * @param  array<string, mixed>  $values
     * @return array<string, string>
     */
    private static function flatten(array $values, string $prefix = ''): array
    {
        $out = [];

        foreach ($values as $key => $value) {
            $path = $prefix === '' ? (string) $key : $prefix . '.' . $key;

            if (is_array($value)) {
                $out += self::flatten($value, $path);

                continue;
            }

            // Only strings are translatable. A boolean or a number in a lang
            // file is a setting that happens to live there.
            if (is_string($value)) {
                $out[$path] = $value;
            }
        }

        return $out;
    }

    /**
     * @param  array<string, mixed>  $values
     */
    private static function pluck(array $values, string $key): ?string
    {
        foreach (explode('.', $key) as $part) {
            if (!is_array($values) || !array_key_exists($part, $values)) {
                return null;
            }

            $values = $values[$part];
        }

        return is_string($values) ? $values : null;
    }

    /**
     * @param  array<string, mixed>  $target
     * @param  array<int, string>  $parts
     */
    private static function put(array &$target, array $parts, string $value): void
    {
        $key = array_shift($parts);

        if ($parts === []) {
            $target[$key] = $value;

            return;
        }

        if (!is_array($target[$key] ?? null)) {
            $target[$key] = [];
        }

        self::put($target[$key], $parts, $value);
    }
}
