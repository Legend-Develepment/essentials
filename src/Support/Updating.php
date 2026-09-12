<?php

namespace LegendDevelopment\Theme\Support;

use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\HtmlString;
use Throwable;

/**
 * A line at the top of the page while this plugin replaces itself.
 *
 * **Say what this is not, first, because the obvious version of it cannot be
 * built and the reason is worth writing down.**
 *
 * It is not Laravel's maintenance mode. `artisan down` pauses the queue worker
 * - the check is at the top of the worker's loop, before it takes a job - and
 * Pelican runs its worker as `queue:work --tries=3` with no `--force`. The
 * update *is* a queued job, so putting the panel down from inside it stops the
 * very process that has to finish it and then take it back up. Nothing expires
 * the down file: it is an ordinary file that survives a reboot, and only
 * `artisan up` removes it. That is a panel locked until somebody with a
 * terminal comes along.
 *
 * It is not a page shown *during* the swap either, and no arrangement of hooks
 * or middleware would be. A release is extracted, the assets are rebuilt, and
 * only then is the meta block written back into plugin.json - and until it is,
 * Pelican reads this plugin as not installed and loads none of it. For those
 * seconds there is no provider, no middleware, no render hook and no view of
 * ours to reach. The plugin is simply absent while the thing it would be
 * describing is happening.
 *
 * **So this is what is left, and it is smaller than it sounds.** One record
 * that says an update is under way or has just finished, and a line drawn from
 * it on either side of the gap. Its real audience is the person who got a
 * half-drawn page, waited, and came back: the line tells them what they saw.
 *
 * **It cannot leave anybody stuck**, which is the one property that matters.
 * There is no middleware, no lock and no file to remove: the record is a cache
 * entry with its expiry written into it, so it lapses on its own with nothing
 * having to run. A worker killed outright between two lines leaves a record
 * that is gone ten minutes later without anybody being told.
 */
class Updating
{
    /** The same namespace as the auto-update's own record. */
    private const KEY = 'legend-theme.updating';

    public const WORKING = 'working';

    public const DONE = 'done';

    /**
     * Ten minutes, and only ever as a backstop.
     *
     * The working record is read only before the swap - after it, nothing of
     * ours is loaded to read anything. Its whole job is to bound how long "an
     * update is installing" may stand after an attempt that never finished. The
     * download itself is capped at a minute and the extract is seconds, so this
     * is generous; it is ten minutes because that is how long the schedule lets
     * one attempt be in flight before it starts another.
     */
    private const WORKING_TTL = 600;

    /**
     * And five after it finished. Long enough for somebody who met the error,
     * went to make tea and came back; short enough that nobody reads it as a
     * banner the panel simply has.
     */
    private const DONE_TTL = 300;

    /** @var array<string, mixed>|null */
    private static ?array $memo = null;

    private static bool $read = false;

    /** An update has begun. */
    public static function started(?string $version): void
    {
        self::put(self::WORKING, $version, self::WORKING_TTL);
    }

    /** And it got there. */
    public static function finished(?string $version): void
    {
        self::put(self::DONE, $version, self::DONE_TTL);
    }

    /**
     * Take down a record that says an update is under way.
     *
     * Called from the job's own unwind, so an attempt that threw does not leave
     * the line standing for ten minutes. A finished record is left alone: that
     * one is the point.
     *
     * This does not run when the worker is killed outright, which is exactly
     * why the record carries its own expiry rather than relying on anybody
     * remembering to clear it.
     */
    public static function settle(): void
    {
        try {
            $record = self::state();

            if ($record !== null && $record['state'] === self::WORKING) {
                cache()->forget(self::KEY);
                self::$memo = null;
                self::$read = false;
            }
        } catch (Throwable) {
            // A cache that will not answer is a line that is not drawn, which
            // is the same thing that happens when there is nothing to say.
        }
    }

    /**
     * What is going on, or nothing.
     *
     * Read live and memoised per request. Never through the stamped cache the
     * settings block uses: that keeps an entry for a day, which would pin a
     * stale line up for a day and hide a real one for just as long.
     *
     * Anything that is not the shape this class writes is treated as nothing. A
     * record left by an older shape of this must not become a line with an
     * empty sentence in it.
     *
     * @return array{state: string, at: int, version: string|null}|null
     */
    public static function state(): ?array
    {
        if (self::$read) {
            /** @var array{state: string, at: int, version: string|null}|null */
            return self::$memo;
        }

        self::$read = true;
        self::$memo = null;

        try {
            $found = cache()->get(self::KEY);
        } catch (Throwable) {
            return null;
        }

        if (!is_array($found)) {
            return null;
        }

        $state = $found['state'] ?? null;
        $version = $found['version'] ?? null;

        if (!in_array($state, [self::WORKING, self::DONE], true)) {
            return null;
        }

        if (!is_int($found['at'] ?? null) || ($version !== null && !is_string($version))) {
            return null;
        }

        /** @var array{state: string, at: int, version: string|null} $record */
        $record = ['state' => $state, 'at' => (int) $found['at'], 'version' => $version];

        return self::$memo = $record;
    }

    /**
     * Draw it, on the page rather than on the body.
     *
     * Inside the page content, where this theme's announcement bar already
     * sits, rather than directly in the body - which is behind a fixed sidebar
     * on one side and under a sticky topbar on the other, and putting a notice
     * right would mean moving both of them.
     */
    public static function register(): void
    {
        if (!Features::enabled(Features::UPDATING)) {
            return;
        }

        try {
            FilamentView::registerRenderHook(
                PanelsRenderHook::PAGE_START,
                static fn () => new HtmlString(self::html()),
            );

            // And the sign-in screen, which is a simple page and has never
            // been reached by the hook above.
            FilamentView::registerRenderHook(
                PanelsRenderHook::SIMPLE_PAGE_START,
                static fn () => new HtmlString(self::html()),
            );
        } catch (Throwable) {
            // Filament's hook API is not where it was. The panel keeps
            // working; it simply has no line.
        }
    }

    /** The line, with its own styling, or nothing at all. */
    public static function html(): string
    {
        try {
            $record = self::state();

            return $record === null ? '' : self::css() . self::bar($record);
        } catch (Throwable) {
            /*
             * Filament calls a render hook without a try of its own, so an
             * exception in here is a five hundred on every page of the panel
             * rather than a missing notice.
             */
            return '';
        }
    }

    /** @param  array{state: string, at: int, version: string|null}  $record */
    private static function bar(array $record): string
    {
        $done = $record['state'] === self::DONE;
        $version = trim((string) ($record['version'] ?? ''));

        $html = '<div class="ld-updating' . ($done ? ' ld-updating--done' : '') . '" role="status">'
            . '<span class="ld-updating__text">'
            . e($done ? Theme::trans('page.updating_done') : Theme::trans('page.updating_now'))
            . '</span>';

        if ($version !== '') {
            $html .= '<span class="ld-updating__version">' . e('v' . $version) . '</span>';
        }

        return $html . '</div>';
    }

    /**
     * Its own colours, written out rather than taken from the theme.
     *
     * Two reasons, and both are about the moment this is shown. The stylesheet
     * this plugin compiles lives in the directory an update empties, so a line
     * styled from there is unstyled exactly when it appears. And the theme's
     * own colour tokens are only emitted when the styling is switched on - a
     * panel with the look turned off still gets updated, and would have none of
     * them.
     *
     * So: plain colours, no tokens, no media queries.
     */
    private static function css(): string
    {
        return '<style>'
            . '.ld-updating{display:flex;align-items:center;gap:.6rem;margin:0 0 .75rem;'
            . 'padding:.55rem .85rem;border-radius:.5rem;font-size:.875rem;line-height:1.35;'
            . 'color:#7c4a03;background:#fef3c7;box-shadow:inset 0 0 0 1px #f0cd84}'
            . '.ld-updating--done{color:#14532d;background:#dcfce7;box-shadow:inset 0 0 0 1px #92d7ab}'
            . '.ld-updating__version{margin-inline-start:auto;font-variant-numeric:tabular-nums;opacity:.75}'
            . ':is(html.dark,.ld-preview--dark) .ld-updating{color:#fde68a;background:#3f2d06;'
            . 'box-shadow:inset 0 0 0 1px #6b4c0d}'
            . ':is(html.dark,.ld-preview--dark) .ld-updating--done{color:#bbf7d0;background:#0b2f18;'
            . 'box-shadow:inset 0 0 0 1px #1d5432}'
            . '</style>';
    }

    private static function put(string $state, ?string $version, int $ttl): void
    {
        try {
            cache()->put(self::KEY, [
                'state' => $state,
                'at' => time(),
                'version' => $version === null ? null : mb_substr(trim($version), 0, 32),
            ], $ttl);

            // So a process that writes and then draws in the same request is
            // not answered out of a memo taken before it wrote.
            self::$memo = null;
            self::$read = false;
        } catch (Throwable) {
            // A cache that will not answer is a line that is not drawn. The
            // update itself is unaffected, which is the part that matters.
        }
    }
}
