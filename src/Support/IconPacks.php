<?php

namespace LegendDevelopment\Theme\Support;

use BladeUI\Icons\Factory as IconFactory;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Throwable;
use ZipArchive;

/**
 * Where the icons to choose from come from.
 *
 * Two kinds of source. Every icon set registered with Blade Icons is already
 * on the server - Pelican ships Tabler, and another plugin may have added more -
 * and those are listed by reading the set's directory. Beyond that a pack of
 * plain SVG files can be uploaded, which is the way to use a set nobody has
 * packaged for Laravel.
 *
 * A pack only decides what the picker offers. Icon names stay fully qualified
 * either way - tabler-folder, heroicon-o-folder, custom-folder - so switching
 * packs never silently repoints an icon that was already chosen.
 */
class IconPacks
{
    public const CUSTOM = 'custom';

    /** Where an uploaded pack is unpacked to, on the local disk. */
    private const DIRECTORY = 'legend-theme/icons';

    /**
     * Four limits, and they guard different things - which is why raising one
     * and not the others would only move where a pack fails.
     *
     * The zip is the only one a person sees before uploading, so it is the
     * loosest: sixty-four mebibytes takes any real icon set with room to spare.
     * For scale, the whole Tabler set is about three megabytes zipped, so a pack
     * near this ceiling is carrying something that is not icons.
     */
    public const MAX_ZIP_BYTES = 67108864;

    /** More than any set has, and the picker is searched rather than scrolled. */
    private const MAX_FILES = 4000;

    /** One icon. A quarter of a megabyte of SVG is a drawing, not a glyph. */
    private const MAX_SVG_BYTES = 262144;

    /**
     * What the entries expand to, which is the real ceiling and the reason the
     * zip limit is not the whole story.
     *
     * Everything taken is held in memory before any of it is written, so that a
     * pack which fails half way through leaves the previous one intact rather
     * than a mixture. That makes this a limit on PHP's memory rather than on
     * disk, and why it is well under the zip's: SVG is text and compresses
     * about five to one, so a sixty-four mebibyte zip can easily hold three
     * hundred megabytes of it - which is past what a panel is configured to
     * hold and would be killed rather than refused.
     */
    private const MAX_EXPANDED_BYTES = 100663296;

    /**
     * The packs on offer: every registered Blade Icons set, plus the uploaded
     * one once there is something in it.
     *
     * @return array<string, string>
     */
    public static function options(): array
    {
        $options = [];

        foreach (self::sets() as $prefix => $label) {
            $options[$prefix] = $label;
        }

        $options[self::CUSTOM] = Theme::trans('settings.icons.pack_custom')
            . (self::customCount() > 0 ? ' (' . self::customCount() . ')' : '');

        return $options;
    }

    /**
     * Registered sets, as prefix => a readable name.
     *
     * @return array<string, string>
     */
    public static function sets(): array
    {
        $sets = [];

        try {
            foreach (app(IconFactory::class)->all() as $name => $set) {
                $prefix = (string) ($set['prefix'] ?? '');

                if ($prefix === '') {
                    continue;
                }

                $sets[$prefix] = ucfirst(is_string($name) && $name !== 'default' ? $name : $prefix);
            }
        } catch (Throwable) {
            // No factory means no sets to offer; the custom pack still works.
        }

        ksort($sets);

        return $sets;
    }

    /**
     * The pack the picker is showing. Falls back to whichever set Pelican's own
     * icons come from, so the list is never empty on a fresh install.
     */
    public static function current(): string
    {
        $pack = (string) Theme::config('icon_pack', '');

        if ($pack === self::CUSTOM) {
            return self::CUSTOM;
        }

        $sets = self::sets();

        if ($pack !== '' && array_key_exists($pack, $sets)) {
            return $pack;
        }

        return array_key_exists('tabler', $sets) ? 'tabler' : (string) array_key_first($sets);
    }

    /**
     * Icon names in a pack, fully qualified.
     *
     * Reading a set means listing a directory of several thousand files, so the
     * answer is held for the request and cached beyond it - and a cache that
     * cannot answer costs the listing again, not the page.
     *
     * @return array<int, string>
     */
    public static function names(?string $pack = null): array
    {
        $pack = $pack ?? self::current();

        if ($pack === self::CUSTOM) {
            return self::customNames();
        }

        try {
            return cache()->remember(
                'legend-theme.iconpack.' . $pack,
                now()->addDay(),
                static fn (): array => self::readNames($pack),
            );
        } catch (Throwable) {
            return self::readNames($pack);
        }
    }

    /**
     * Names matching what has been typed, with the icon itself alongside so the
     * list can be read by eye rather than by name.
     *
     * @return array<string, string>
     */
    public static function search(string $term, ?string $pack = null, int $limit = 40): array
    {
        $term = trim(strtolower($term));
        $results = [];

        foreach (self::names($pack) as $name) {
            if ($term !== '' && !str_contains($name, $term)) {
                continue;
            }

            $results[$name] = self::label($name);

            if (count($results) >= $limit) {
                break;
            }
        }

        return $results;
    }

    /**
     * One option: the icon, drawn small, and its name.
     */
    public static function label(string $name): string
    {
        $svg = self::svg($name);
        $safe = e($name);

        if ($svg === null) {
            return $safe;
        }

        return '<span class="fi-ld-icon-option">'
            . '<span class="fi-ld-icon-preview">' . $svg . '</span>'
            . '<span>' . $safe . '</span>'
            . '</span>';
    }

    /**
     * The markup for one icon, from whichever source it belongs to. Sanitised
     * either way: an uploaded file is not trusted, and the result is put
     * straight into a page.
     */
    public static function svg(string $name): ?string
    {
        if (str_starts_with($name, self::CUSTOM . '-')) {
            return self::customSvg(substr($name, strlen(self::CUSTOM) + 1));
        }

        try {
            return self::sanitise(app(IconFactory::class)->svg($name)->toHtml());
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * One icon as a data URI, ready to be masked into a background.
     *
     * The same path the icon replacement takes: whatever CSS wears an icon in
     * this theme is a mask over currentColor, so the icon follows the accent
     * and every hover state without knowing anything about them.
     */
    public static function dataUri(string $name): ?string
    {
        $svg = self::svg($name);

        if ($svg === null) {
            return null;
        }

        $svg = preg_replace('/\s+/', ' ', trim($svg)) ?? '';

        return $svg === '' ? null : 'data:image/svg+xml,' . rawurlencode($svg);
    }

    /**
     * Unpacks an uploaded zip of SVG files, replacing whatever was there.
     *
     * Answers with what it did rather than with a count, because a count cannot
     * say what a pack is missing. Every limit here used to skip in silence, so
     * a pack that ran into one arrived with holes in it and nothing to explain
     * them - and the person who packed it is the only one who can tell whether
     * that matters.
     *
     * @return array{installed: int, skipped: array{big: int, unusable: int, duplicate: int}, stopped: string|null}
     *
     * @throws \RuntimeException
     */
    public static function install(TemporaryUploadedFile $file): array
    {
        throw_if(
            $file->getSize() > self::MAX_ZIP_BYTES,
            new \RuntimeException('The icon pack is larger than ' . round(self::MAX_ZIP_BYTES / 1048576) . ' MiB.'),
        );

        $path = $file->getRealPath();

        throw_if(
            $path === false || !is_file($path),
            new \RuntimeException('The upload could not be read from disk.'),
        );

        $zip = new ZipArchive();

        throw_unless(
            $zip->open($path) === true,
            new \RuntimeException('That file could not be opened as a zip.'),
        );

        $icons = [];

        // What the entries expand to, which is the number the compressed size
        // says nothing about: a few kilobytes of zip can hold a gigabyte of
        // repeated whitespace.
        $expanded = 0;

        /*
         * What was left behind, so it can be said rather than discovered.
         *
         * Every one of these was a silent skip: a pack that hit a limit was
         * installed as far as it got, with no word about the rest, and the only
         * symptom was a picker missing icons the person knew they had packed.
         */
        $skipped = ['big' => 0, 'unusable' => 0, 'duplicate' => 0];
        $stopped = null;

        try {
            for ($i = 0; $i < $zip->numFiles; $i++) {
                if (count($icons) >= self::MAX_FILES) {
                    $stopped = 'files';

                    break;
                }

                $entry = (string) $zip->getNameIndex($i);

                if (!str_ends_with(strtolower($entry), '.svg')) {
                    continue;
                }

                $stat = $zip->statIndex($i) ?: [];
                $size = (int) ($stat['size'] ?? 0);

                if ($size > self::MAX_SVG_BYTES) {
                    $skipped['big']++;

                    continue;
                }

                $expanded += $size;

                if ($expanded > self::MAX_EXPANDED_BYTES) {
                    $stopped = 'size';

                    break;
                }

                // Only the file's own name is kept, so no entry can write
                // outside the icons directory however it was packed.
                $name = self::slug(basename($entry, '.svg'));

                if ($name === null || array_key_exists($name, $icons)) {
                    // Two files whose names slug to the same thing, which is one
                    // icon however it was packed.
                    $skipped['duplicate']++;

                    continue;
                }

                $svg = self::sanitise((string) $zip->getFromIndex($i));

                if ($svg === null) {
                    // Not SVG this will serve: sanitise() refuses anything it
                    // cannot make safe, which is the point of it.
                    $skipped['unusable']++;

                    continue;
                }

                $icons[$name] = $svg;
            }
        } finally {
            $zip->close();
        }

        throw_if($icons === [], new \RuntimeException('No usable SVG files were found in that zip.'));

        $disk = Storage::disk('local');

        // Replacing rather than merging: a pack is one set, and leaving the
        // previous one behind would make the list a mix of two.
        $disk->deleteDirectory(self::DIRECTORY);

        foreach ($icons as $name => $svg) {
            $disk->put(self::DIRECTORY . '/' . $name . '.svg', $svg);
        }

        self::forget();

        return [
            'installed' => count($icons),
            'skipped' => $skipped,
            'stopped' => $stopped,
        ];
    }

    public static function customCount(): int
    {
        return count(self::customNames());
    }

    /**
     * @return array<int, string>
     */
    private static function customNames(): array
    {
        try {
            $files = Storage::disk('local')->files(self::DIRECTORY);
        } catch (Throwable) {
            return [];
        }

        $names = [];

        foreach ($files as $file) {
            if (str_ends_with($file, '.svg')) {
                $names[] = self::CUSTOM . '-' . basename($file, '.svg');
            }
        }

        sort($names);

        return $names;
    }

    private static function customSvg(string $name): ?string
    {
        $name = self::slug($name);

        if ($name === null) {
            return null;
        }

        try {
            $path = self::DIRECTORY . '/' . $name . '.svg';
            $disk = Storage::disk('local');

            // Already sanitised on the way in; read back as it was stored.
            return $disk->exists($path) ? (string) $disk->get($path) : null;
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * @return array<int, string>
     */
    private static function readNames(string $pack): array
    {
        $names = [];

        try {
            foreach (app(IconFactory::class)->all() as $set) {
                if ((string) ($set['prefix'] ?? '') !== $pack) {
                    continue;
                }

                foreach ((array) ($set['paths'] ?? []) as $path) {
                    foreach (glob(rtrim((string) $path, '/') . '/*.svg') ?: [] as $file) {
                        $names[] = $pack . '-' . basename($file, '.svg');
                    }
                }
            }
        } catch (Throwable) {
            return [];
        }

        $names = array_values(array_unique($names));
        sort($names);

        return $names;
    }

    /**
     * Icon file names become part of a CSS selector and a storage path, so they
     * are held to the same shape a plugin id is.
     */
    private static function slug(string $name): ?string
    {
        $name = strtolower(trim($name));
        $name = preg_replace('/[^a-z0-9._-]+/', '-', $name) ?? '';
        $name = trim($name, '-.');

        return $name === '' || strlen($name) > 120 ? null : $name;
    }

    /**
     * Whatever is left has to be safe to drop into a page: an uploaded pack is
     * a file from outside, and an SVG is a document that can carry script.
     */
    private static function sanitise(string $svg): ?string
    {
        $svg = trim($svg);

        if ($svg === '' || !preg_match('/<svg[\s>]/i', $svg)) {
            return null;
        }

        // Anything before the root element - an XML declaration, a doctype, a
        // comment - is dropped rather than trusted.
        $start = stripos($svg, '<svg');

        if ($start === false) {
            return null;
        }

        $svg = substr($svg, $start);

        $svg = preg_replace('#<script\b[^>]*>.*?</script>#is', '', $svg) ?? '';
        $svg = preg_replace('#<(script|foreignObject|iframe|use|image)\b[^>]*/?>#i', '', $svg) ?? '';
        // on… handlers, in either quoting style or none at all.
        $svg = preg_replace('/\son[a-z-]+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $svg) ?? '';
        $svg = preg_replace('/(href|xlink:href)\s*=\s*("|\')?\s*javascript:[^"\'>\s]*("|\')?/i', '', $svg) ?? '';

        return trim($svg) === '' ? null : $svg;
    }

    private static function forget(): void
    {
        try {
            foreach (array_keys(self::sets()) as $prefix) {
                cache()->forget('legend-theme.iconpack.' . $prefix);
            }
        } catch (Throwable) {
            // Nothing worth failing a save over.
        }
    }
}
