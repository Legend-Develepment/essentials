<?php

namespace LegendDevelopment\Theme\Support;

use Throwable;

/**
 * The whole panel, with settings that have not been saved.
 *
 * The box beside the Look form answers "what does this token do". It does not
 * answer "what does my panel look like" - that needs a sidebar, a table, a
 * modal, a terminal and everything else at once, which is the panel.
 *
 * **It is a tab and not a pane, and that is Pelican's decision rather than a
 * preference.** The plan called for the panel in a pane beside the form.
 * Pelican's SetSecurityHeaders middleware sends `X-Frame-Options: DENY`, so the
 * panel refuses to be framed - by itself included. Overriding that would mean a
 * theme plugin weakening a security header to draw a picture, which is not a
 * trade worth making. A tab is also the better answer: full width, real
 * conditions, and nothing squeezed.
 *
 * Nothing is written. The values live in the session for a quarter of an hour,
 * and the stylesheet is built from them for that one request through
 * Theme::using() - the same mechanism a person's own style uses, and the same
 * reason: it is released in a finally, so a value cannot be left standing where
 * a form would later read it back as the panel's own and save it there.
 */
class FullPreview
{
    /** What the address says when a page should be drawn from pending values. */
    public const QUERY = 'ld-preview';

    private const KEY = 'legend-theme.preview';

    /**
     * Long enough to look around a panel, short enough that a session left open
     * overnight is showing what is actually saved by morning.
     */
    private const TTL = 900;

    /** @var array<string, mixed>|null */
    private static ?array $memo = null;

    private static bool $read = false;

    /**
     * Keep a form's unsaved state for the next request to draw from.
     *
     * @param  array<string, mixed>  $values
     */
    public static function remember(array $values): bool
    {
        try {
            session()->put(self::KEY, [
                'at' => time(),
                'values' => $values,
            ]);

            self::$read = false;
            self::$memo = null;

            return true;
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }
    }

    public static function forget(): void
    {
        try {
            session()->forget(self::KEY);
        } catch (Throwable) {
            // A preview that outlives its welcome by a quarter of an hour is
            // not worth failing a save over.
        }

        self::$read = false;
        self::$memo = null;
    }

    /**
     * What is being held, whether or not this request is drawing from it.
     *
     * Separate from values() so the settings page can put a form back exactly
     * as it was left when somebody returns from looking at the panel. Without
     * that, going to see the preview and coming back would lose the very
     * changes that were being previewed.
     *
     * @return array<string, mixed>|null
     */
    public static function pending(): ?array
    {
        if (self::$read) {
            return self::$memo;
        }

        self::$read = true;
        self::$memo = null;

        try {
            $held = session()->get(self::KEY);

            if (!is_array($held) || !is_array($held['values'] ?? null)) {
                return null;
            }

            if (!is_int($held['at'] ?? null) || time() - $held['at'] > self::TTL) {
                self::forget();
                self::$read = true;

                return null;
            }

            return self::$memo = $held['values'];
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * The values this request should be drawn from, or null for the ordinary
     * panel.
     *
     * Three things have to be true, and the permission is not the least of
     * them: the address has to ask, something has to be held, and whoever is
     * asking has to be allowed to change these settings anyway. Otherwise a
     * link with a query string on it would be a way to show somebody a panel
     * that is not theirs.
     *
     * @return array<string, mixed>|null
     */
    public static function values(): ?array
    {
        try {
            if (!request()->boolean(self::QUERY)) {
                return null;
            }

            if (!Features::mayManage(Features::PREVIEW)) {
                return null;
            }

            return self::pending();
        } catch (Throwable) {
            return null;
        }
    }

    public static function active(): bool
    {
        return self::values() !== null;
    }

    /**
     * The address of a panel page drawn from the pending values.
     *
     * The admin dashboard, because it carries more of the panel at once than
     * any other single page - a sidebar, a topbar, widgets, cards and a table -
     * which is what somebody wants to see before saving a colour.
     */
    public static function url(): string
    {
        try {
            $base = rtrim(\Filament\Facades\Filament::getPanel('admin')->getUrl(), '/');

            return $base . '?' . self::QUERY . '=1';
        } catch (Throwable) {
            return '#';
        }
    }

    /**
     * The bar across the top of a previewed page.
     *
     * Static markup rather than a component, for the reason the announcements
     * are: this has to appear on every page of the panel, the console included,
     * and nothing of this theme's own that arrives after a page has painted may
     * go above a terminal.
     */
    public static function html(): string
    {
        if (!self::active()) {
            return '';
        }

        try {
            $back = rtrim(\Filament\Facades\Filament::getPanel('admin')->getUrl(), '/')
                . '/essentials-look';

            return '<div class="ld-notice ld-notice--accent ld-preview-bar" role="status">'
                . '<span class="ld-notice__text">' . e(Theme::trans('settings.preview.bar')) . '</span>'
                . '<a class="ld-notice__link" href="' . e($back) . '">'
                . e(Theme::trans('settings.preview.bar_back'))
                . '</a>'
                . '</div>';
        } catch (Throwable) {
            return '';
        }
    }
}
