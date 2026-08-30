<?php

namespace LegendDevelopment\Theme\Support;

use Throwable;

/**
 * The bottom of the sidebar, which Pelican leaves empty.
 *
 * A good place for the things that have nowhere else to go: which panel version
 * this is, a line of your own, and one link to wherever people should be sent
 * when they need help. All three are off until they are filled in, so a panel
 * that updates to this release looks exactly as it did.
 *
 * Everything is escaped and static. There is no Livewire here and no markup a
 * setting can introduce: the text is text, and the link is built from a label
 * and a validated address, separately. That restriction is the feature - this
 * renders on every page of the panel, which makes it exactly the wrong place to
 * accept HTML.
 */
class SidebarFooter
{
    /**
     * Written out rather than taken from PanelsRenderHook.
     *
     * The same reasoning as the sign-in hooks: a constant a future Filament
     * renames is a fatal on every page, while a string it no longer recognises
     * is simply a hook nobody renders. One of those is recoverable from.
     */
    public const HOOK = 'panels::sidebar.footer';

    private const MAX_TEXT = 120;

    private const MAX_LABEL = 40;

    public static function enabled(): bool
    {
        return Features::enabled(Features::SIDEBAR_FOOTER);
    }

    public static function text(): string
    {
        return mb_substr(trim((string) Theme::config('footer_text', '')), 0, self::MAX_TEXT);
    }

    public static function showVersion(): bool
    {
        return (bool) Theme::config('footer_version', false);
    }

    public static function linkLabel(): string
    {
        return mb_substr(trim((string) Theme::config('footer_link_label', '')), 0, self::MAX_LABEL);
    }

    public static function linkUrl(): string
    {
        return trim((string) Theme::config('footer_link_url', ''));
    }

    /**
     * The markup, or nothing at all.
     *
     * Nothing at all is the important half: an empty container still takes
     * space at the bottom of the sidebar, and a footer nobody asked for should
     * not push the navigation up by a line.
     */
    public static function html(): string
    {
        if (!self::enabled()) {
            return '';
        }

        $lines = [];

        $text = self::text();

        if ($text !== '') {
            $lines[] = '<span class="ld-foot__text">' . e($text) . '</span>';
        }

        $version = self::version();

        if ($version !== '') {
            $lines[] = '<span class="ld-foot__version">' . e($version) . '</span>';
        }

        $link = self::link();

        if ($link !== '') {
            $lines[] = $link;
        }

        return $lines === []
            ? ''
            : '<div class="ld-foot">' . implode('', $lines) . '</div>';
    }

    /**
     * The panel's version, from Pelican's own service.
     *
     * Pelican's, not this plugin's: the plugin says its own version on the
     * dashboard, and the question somebody asks at the bottom of the sidebar is
     * which panel they are looking at.
     */
    private static function version(): string
    {
        if (!self::showVersion()) {
            return '';
        }

        try {
            $installed = Versions::panel()['installed'];

            return $installed === '?' ? '' : 'v' . $installed;
        } catch (Throwable) {
            return '';
        }
    }

    private static function link(): string
    {
        $label = self::linkLabel();
        $url = self::url();

        if ($label === '' || $url === '') {
            return '';
        }

        // rel is not decoration. This opens in a new tab, and without it the
        // page opened is handed a reference back to the panel.
        return '<a class="ld-foot__link" href="' . e($url)
            . '" target="_blank" rel="noopener noreferrer">' . e($label) . '</a>';
    }

    /**
     * The address, or nothing.
     *
     * http and https only. A javascript: or data: address in an href is the one
     * way a field of plain text could still become code, and the panel's own
     * pages are reachable by writing a path rather than a URL.
     */
    public static function url(): string
    {
        $url = self::linkUrl();

        if ($url === '') {
            return '';
        }

        // A path of the panel's own is allowed and needs no scheme check.
        if (str_starts_with($url, '/') && !str_starts_with($url, '//')) {
            return $url;
        }

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            return '';
        }

        $scheme = strtolower((string) parse_url($url, PHP_URL_SCHEME));

        return in_array($scheme, ['http', 'https'], true) ? $url : '';
    }
}
