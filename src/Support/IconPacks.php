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

    /**
     * The set that comes with the plugin.
     *
     * A pack in the same sense as any Blade Icons set - chosen from the same
     * picker, searched the same way - and different in one respect the code has
     * to know about: these are pictures rather than drawings, so they are drawn
     * in their own colours. See Icons::buildOverrideCss, which decides that from
     * the file rather than from which pack it came out of.
     */
    public const SHIPPED = 'essentials';

    /** Where the shipped set lives inside the package. */
    private const SHIPPED_DIRECTORY = 'resources/icons';

    /**
     * Which of the shipped icons was drawn for which navigation row.
     *
     * Written down because it cannot be worked out. The files are named for
     * what they depict - a terminal, a launch button, a drive mount - and the
     * rows are named for what they do, so nothing matches by string: searching
     * the picker for "console" found nothing at all, which read as the pack
     * being empty rather than as the names not lining up.
     *
     * Two things use it. The picker searches these words as well as the file
     * name, so "console" finds the terminal icon. And the button beside the
     * repeater fills every row at once, which is the thing somebody actually
     * wants after choosing a set.
     */
    private const SUGGESTED = [
        'console' => 'neon_terminalsymbol_im_cyberpunk_stil',
        'files' => 'neonrood_futuristisch_bestandsicoon',
        'databases' => 'neon_database_server_badge',
        'schedules' => 'neonrood_klok_en_planningsicoon',
        'users' => 'futuristisches_benutzergruppen_symbol',
        'backups' => 'neon_backup_en_herstelschijf',
        'network' => 'neon_netzwerkserver_mit_portverteilung',
        'startup' => 'neonrode_lanceerknop',
        'mounts' => 'cyberpunk_drive_mount_icon',
        'activity' => 'futuristische_neon_audit_zwischenablage',
        'settings' => 'glanzende_neonrode_tandwielknop',
        'webhooks' => 'glanzend_rood_webhooks_netwerkpictogram',
    ];

    /**
     * The shipped set as one override per row, ready to be saved.
     *
     * Only the rows an icon was drawn for, and only icons that are still in the
     * package - so a set edited by hand produces a shorter list rather than
     * rows pointing at files that are not there.
     *
     * @return array<int, array{match: string, icon: string, file: array<int, string>}>
     */
    public static function suggestedRows(): array
    {
        $have = self::shippedNames();
        $rows = [];

        foreach (self::SUGGESTED as $match => $name) {
            $icon = self::SHIPPED . '-' . $name;

            if (in_array($icon, $have, true)) {
                $rows[] = ['match' => $match, 'icon' => $icon, 'file' => []];
            }
        }

        return $rows;
    }

    /**
     * The row an icon was drawn for, or null.
     *
     * Used by the search so a menu item's own word finds the icon meant for it.
     */
    private static function suggestedFor(string $icon): ?string
    {
        if (!str_starts_with($icon, self::SHIPPED . '-')) {
            return null;
        }

        $name = substr($icon, strlen(self::SHIPPED) + 1);

        foreach (self::SUGGESTED as $match => $candidate) {
            if ($candidate === $name) {
                return $match;
            }
        }

        return null;
    }

    /** Where an uploaded pack is unpacked to, on the local disk. */
    private const DIRECTORY = 'legend-theme/icons';

    /**
     * Where it is built first.
     *
     * The pack is written here entry by entry and only swapped into place once
     * the whole zip has been read. That is what keeps a failure half way
     * through from leaving a mixture of two packs - which is the property the
     * old design got by holding everything in memory, and the reason it could
     * not take a pack larger than the memory it was allowed.
     */
    private const STAGING = 'legend-theme/icons-staging';

    /**
     * A value that changes whenever the installed pack does.
     *
     * It exists because of one bug, and the bug is worth writing down. The
     * compiled icon-replacement CSS is cached for a day against the *settings*
     * that produced it - which override points at which icon - and that key
     * says nothing about the icons themselves. So replacing the pack changed
     * every file on disk and not one character of the key: the panel went on
     * serving CSS built from the icons that were there before, for a day.
     *
     * What that looked like from the front was a re-upload doing nothing at
     * all. The old CSS hid Pelican's own icon and masked with the old, empty
     * artwork, so the rows stayed blank and the new files sat unused. It also
     * meant a release that fixed how those icons are read appeared to change
     * nothing, because nothing was being read.
     */
    private const STAMP = 'legend-theme/icons-stamp';

    /**
     * Four limits, and they guard different things - which is why raising one
     * and not the others only moves where a pack fails. That has now happened
     * twice, so it is worth being exact about which does what.
     *
     * This one is a bound on the upload and nothing else. It is loose because
     * nothing downstream is troubled by a large zip any more: the entries are
     * written as they are read, so what matters is how many icons come out and
     * how big each one is, not how big the archive was.
     *
     * Loose is not an opinion that a pack this size is sensible. The whole
     * Tabler set - close to six thousand icons - is about three megabytes
     * zipped, so anything within sight of this ceiling is carrying something
     * that is not icons, and the two limits below are what will actually decide
     * how much of it becomes a pack.
     */
    public const MAX_ZIP_BYTES = 268435456;

    /**
     * The limit that does the real work on an oversized pack.
     *
     * More icons than any set has, and the picker is searched rather than
     * scrolled - so this is not a performance guard, it is a statement that a
     * folder with more than this in it is not an icon set.
     */
    private const MAX_FILES = 4000;

    /**
     * One icon. A quarter of a megabyte of SVG is a drawing, not a glyph, and
     * this is what quietly removes the bulk from a pack that is mostly
     * illustrations with a few icons in it.
     */
    private const MAX_SVG_BYTES = 262144;

    /**
     * What the entries expand to, which is now a bound on disk rather than on
     * memory.
     *
     * It used to be the tighter of the two and the reason a large pack could
     * not be accepted at all: everything taken was held in an array until the
     * whole zip had been read, so the pack had to fit in whatever PHP was
     * allowed. Icons are written as they are read now, into a staging directory
     * that is only swapped into place at the end - which keeps the property
     * that mattered, that a pack failing half way leaves the previous one
     * untouched, without paying for it in memory.
     *
     * What remains is a guard against a zip bomb: a few kilobytes of archive can
     * hold a gigabyte of repeated whitespace, and the compressed size says
     * nothing about that.
     */
    private const MAX_EXPANDED_BYTES = 536870912;

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

        $shipped = count(self::shippedNames());

        if ($shipped > 0) {
            $options[self::SHIPPED] = Theme::trans('settings.icons.pack_shipped') . ' (' . $shipped . ')';
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

        if ($pack === self::CUSTOM || $pack === self::SHIPPED) {
            return $pack;
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

        if ($pack === self::SHIPPED) {
            return self::shippedNames();
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
            /*
             * The file name, or the row it was drawn for.
             *
             * Somebody replacing the console icon types "console", and no icon
             * in the shipped set has that word in its name - they are named for
             * what they show. Without this the picker answered nothing and
             * looked broken.
             */
            if ($term !== '' && !str_contains($name, $term) && self::suggestedFor($name) !== $term) {
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
        $svg = self::read($name);

        /*
         * An icon with nothing in it is no icon, wherever it came from.
         *
         * Checked on the way out as well as on the way in, and the reason is
         * that a file already on disk cannot be checked on the way in ever
         * again. A panel that installed a pack under an older, over-broad
         * sanitiser is holding sixty-one empty <svg> shells, and no fix to the
         * sanitiser reaches them - the picture they were made from is gone.
         *
         * What this decides is what such a panel looks like. Answering with the
         * empty shell means the stylesheet hides Pelican's own icon and masks
         * with nothing, so the sidebar has blank rows. Answering with null means
         * the override is skipped and Pelican's icon stays, which is visibly the
         * feature not applying rather than invisibly the panel being broken.
         *
         * The second is the better way to be wrong, and it costs one regex.
         */
        return $svg !== null && self::drawable($svg) ? $svg : null;
    }

    private static function read(string $name): ?string
    {
        if (str_starts_with($name, self::CUSTOM . '-')) {
            return self::customSvg(substr($name, strlen(self::CUSTOM) + 1));
        }

        if (str_starts_with($name, self::SHIPPED . '-')) {
            return self::shippedSvg(substr($name, strlen(self::SHIPPED) + 1));
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
     * @return array{installed: int, skipped: array{big: int, unusable: int, duplicate: int, empty: int}, stopped: string|null}
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

        $disk = Storage::disk('local');

        // Anything left by a run that died part way through. Nothing here reads
        // it, but leaving it would waste the disk it takes.
        $disk->deleteDirectory(self::STAGING);

        /*
         * The names taken, not the icons themselves - each is already on disk by
         * the time it is recorded here. This is what makes the pack's size a
         * question about disk rather than about PHP's memory limit.
         */
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
        $skipped = ['big' => 0, 'unusable' => 0, 'duplicate' => 0, 'empty' => 0];
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

                /*
                 * Survived the sanitiser, and has nothing left in it.
                 *
                 * This is the check that was missing, and its absence cost a
                 * day. An older sanitiser dropped every <image> element, so a
                 * pack of icons exported from a design tool - which is to say
                 * an <svg> wrapping one base64 picture, and nothing else - came
                 * out as sixty-one 95-byte shells: a valid <svg> open tag, a
                 * close tag, and no content whatsoever.
                 *
                 * Every one of them installed. The picker listed them. The
                 * stylesheet hid Pelican's own icon and masked with nothing, so
                 * the sidebar had eight blank rows and the upload had said it
                 * worked.
                 *
                 * The sanitiser is fixed, but that is not the point: it will be
                 * changed again, and the next rule that is too broad should
                 * produce a number and a reason rather than silence. An SVG
                 * with nothing to draw is not an icon.
                 */
                if (!self::drawable($svg)) {
                    $skipped['empty']++;

                    continue;
                }

                /*
                 * Written now rather than kept.
                 *
                 * This is the whole change: one icon is in memory at a time
                 * instead of all of them, so the size of the pack stops being a
                 * question about PHP's memory limit and becomes one about disk.
                 * A pack of six thousand icons is a few megabytes on disk and
                 * was hundreds in an array.
                 */
                if ($disk->put(self::STAGING . '/' . $name . '.svg', $svg) === false) {
                    $disk->deleteDirectory(self::STAGING);

                    throw new \RuntimeException(
                        'Could not write the unpacked icons. Check that storage/app belongs to the user the panel runs as.',
                    );
                }

                $icons[$name] = true;
            }
        } finally {
            $zip->close();
        }

        if ($icons === []) {
            $disk->deleteDirectory(self::STAGING);

            throw new \RuntimeException('No usable SVG files were found in that zip.');
        }

        /*
         * The swap. Replacing rather than merging: a pack is one set, and
         * leaving the previous one behind would make the list a mix of two.
         *
         * Only now, with the zip read to the end - so a pack that failed part
         * way through leaves the one that was already installed untouched,
         * which is what the old design bought by building in memory.
         */
        $disk->deleteDirectory(self::DIRECTORY);

        foreach (array_keys($icons) as $name) {
            $disk->move(self::STAGING . '/' . $name . '.svg', self::DIRECTORY . '/' . $name . '.svg');
        }

        $disk->deleteDirectory(self::STAGING);

        self::forget();

        return [
            'installed' => count($icons),
            'skipped' => $skipped,
            'stopped' => $stopped,
        ];
    }

    /**
     * The names in the shipped set.
     *
     * Read from the package rather than from storage, so it is there the moment
     * the plugin is installed and cannot be half-removed. Held for the request
     * because the picker asks once per search and this is a directory listing.
     *
     * @return array<int, string>
     */
    public static function shippedNames(): array
    {
        if (self::$shipped !== null) {
            return self::$shipped;
        }

        $names = [];

        try {
            $directory = plugin_path(Theme::directory(), self::SHIPPED_DIRECTORY);

            foreach ((array) glob($directory . '/*.svg') as $file) {
                $name = self::slug(basename((string) $file, '.svg'));

                if ($name !== null) {
                    $names[] = self::SHIPPED . '-' . $name;
                }
            }
        } catch (Throwable) {
            return self::$shipped = [];
        }

        sort($names);

        return self::$shipped = $names;
    }

    /** One icon out of the shipped set, or null. */
    private static function shippedSvg(string $name): ?string
    {
        $name = self::slug($name);

        if ($name === null) {
            return null;
        }

        try {
            $file = plugin_path(Theme::directory(), self::SHIPPED_DIRECTORY, $name . '.svg');

            if (!is_file($file)) {
                return null;
            }

            $svg = file_get_contents($file);

            // Through the same sanitiser an uploaded pack goes through. These
            // ship with the plugin and are therefore trusted, which is exactly
            // the reasoning that lets a bad file through the one time it is
            // wrong - and the check costs nothing.
            return is_string($svg) ? self::sanitise($svg) : null;
        } catch (Throwable) {
            return null;
        }
    }

    /** @var array<int, string>|null */
    private static ?array $shipped = null;

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
    /**
     * Whether there is anything left to draw.
     *
     * Asked of the sanitised markup rather than the original, because the
     * question is about what will be served and not about what arrived. The
     * list is the elements that put marks on a canvas - a <defs> or a <title>
     * is real SVG and draws nothing on its own, so neither counts.
     */
    private static function drawable(string $svg): bool
    {
        return preg_match(
            '#<(path|image|circle|ellipse|rect|line|polyline|polygon|text|tspan)#i',
            $svg,
        ) === 1;
    }

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
        $svg = preg_replace('#<(script|foreignObject|iframe|use)\b[^>]*/?>#i', '', $svg) ?? '';

        /*
         * <image> is kept when it carries a picture and dropped when it carries
         * an address.
         *
         * It used to be dropped outright, alongside <use> and <iframe>, and the
         * reason was sound: an image whose source is a URL makes the browser
         * fetch it, which is a request going somewhere the panel did not choose
         * every time an icon is drawn. But a base64 picture is not an address.
         * It fetches nothing, runs nothing, and is the entire content of any
         * icon exported from a design tool - so the old rule turned every one of
         * those into an empty <svg> that installed, listed in the picker, and
         * drew nothing at all.
         *
         * Raster types only. data:image/svg+xml would be an SVG inside an SVG,
         * which is a second document this would have to reason about, and there
         * is no reason to accept one.
         */
        $svg = preg_replace_callback(
            '#<image\b[^>]*/?>#i',
            static function (array $tag): string {
                return preg_match(
                    '#(href|xlink:href)\s*=\s*("|\')data:image/(png|jpe?g|gif|webp);base64,#i',
                    $tag[0],
                ) === 1 ? $tag[0] : '';
            },
            $svg,
        ) ?? '';
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

        self::restamp();
    }

    /**
     * Say that the pack has changed.
     *
     * Written rather than derived from the directory, because deriving it means
     * listing several hundred files on every request that builds the CSS - and
     * this is read far more often than it is written.
     */
    private static function restamp(): void
    {
        self::$stamp = null;

        try {
            Storage::disk('local')->put(self::STAMP, (string) now()->getTimestampMs());
        } catch (Throwable) {
            /*
             * A stamp that cannot be written means the CSS cache is keyed on
             * the fallback below, which changes every hour. That is a rebuild
             * an hour rather than a stale page for a day - the right way round
             * for a failure nobody will see.
             */
        }
    }

    private static ?string $stamp = null;

    /** The current stamp, read once per request. */
    public static function stamp(): string
    {
        if (self::$stamp !== null) {
            return self::$stamp;
        }

        try {
            $disk = Storage::disk('local');

            if ($disk->exists(self::STAMP)) {
                $held = trim((string) $disk->get(self::STAMP));

                if ($held !== '') {
                    return self::$stamp = $held;
                }
            }
        } catch (Throwable) {
            // Falls through to the hourly value below.
        }

        // No pack has ever been installed, or the stamp could not be read.
        // An hour, so a panel in that state still picks up a change on its own.
        return self::$stamp = 'h' . floor(time() / 3600);
    }
}
