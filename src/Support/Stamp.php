<?php

namespace LegendDevelopment\Theme\Support;

use Illuminate\Support\Facades\Storage;
use Throwable;

/**
 * One value that changes whenever anything the stylesheet reads changes.
 *
 * The panel's settings block is built from fifteen classes, several of which
 * read a file from storage, and it was rebuilt from scratch on every page - up
 * to three times over on a page where somebody has a style of their own and a
 * timed window is open. None of it was kept between requests. This is what lets
 * it be.
 *
 * **A written value rather than a derived one.** The alternative is to hash the
 * settings and the files on every request, which is most of the work the cache
 * exists to avoid. This is read on every page and written when somebody presses
 * Save, so it is worth being cheap on the read and doing the work on the write.
 *
 * **And it must be bumped by every writer.** That is the whole risk of this
 * mechanism and it is not theoretical: the icon stylesheet was keyed on the
 * overrides alone, so installing a pack left a day of pages drawing the old
 * icons. tools/check-stamp.js is the answer to it - every class the stylesheet
 * reads from storage has to bump this where it writes, and the gate says so.
 *
 * The failure is bounded on purpose. With no file - a fresh panel, or a storage
 * directory the web user cannot write - the value changes every hour instead of
 * never, so the worst a broken disk costs is an hour of staleness rather than
 * a panel frozen at whatever it looked like when the cache was filled.
 */
class Stamp
{
    private const PATH = 'legend-theme/stamp';

    private static ?string $current = null;

    /**
     * The value, read once per request.
     *
     * Every page asks at least once and a page with a window and a personal
     * style asks three times, all inside the same request, and the answer
     * cannot change while one is being served.
     */
    public static function current(): string
    {
        if (self::$current !== null) {
            return self::$current;
        }

        try {
            $disk = Storage::disk('local');

            if ($disk->exists(self::PATH)) {
                $held = trim((string) $disk->get(self::PATH));

                if ($held !== '') {
                    return self::$current = $held;
                }
            }
        } catch (Throwable) {
            // Falls through to the hourly value.
        }

        // Nothing has been saved yet, or the file could not be read. An hour,
        // so a panel in that state still picks a change up on its own.
        return self::$current = 'h' . floor(time() / 3600);
    }

    /**
     * Say that something the stylesheet reads has changed.
     *
     * Milliseconds rather than a counter: a counter has to be read before it
     * can be written, and two saves landing together would then read the same
     * number and write the same one back - which is a stamp that did not move.
     */
    public static function bump(): void
    {
        self::$current = null;

        try {
            Storage::disk('local')->put(self::PATH, (string) now()->getTimestampMs());
        } catch (Throwable) {
            /*
             * A stamp that cannot be written leaves the key on the hourly
             * fallback, which is a rebuild an hour rather than a stale panel
             * for ever - the right way round for a failure nobody will see.
             */
        }
    }

    /**
     * A cache key for one block of the settings stylesheet.
     *
     * @param  string  $part  Which block: the panel's, a window's, a person's.
     * @param  array<int, string|bool|null>  $extra  What else it varies by.
     */
    public static function key(string $part, array $extra = []): string
    {
        return 'legend-theme.settings.' . md5(implode('|', array_merge(
            [self::VERSION, $part, self::current()],
            array_map(static fn (mixed $value): string => match (true) {
                is_bool($value) => $value ? '1' : '0',
                $value === null => '',
                default => (string) $value,
            }, $extra),
        )));
    }

    /**
     * Bumped by hand when the *shape* of the CSS changes rather than a setting.
     *
     * The stamp cannot see a release that changes what a rule emits: the
     * settings are the same, the files are the same, and every cached entry is
     * wrong. Icons carries the same constant for the same reason - see
     * Support\Icons::CACHE_VERSION - and it is bumped in the commit that
     * changes the output, not afterwards.
     */
    private const VERSION = 1;
}
