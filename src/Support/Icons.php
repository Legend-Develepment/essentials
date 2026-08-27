<?php

namespace LegendDevelopment\Theme\Support;

use Throwable;

/**
 * Icon styling, and per menu item icon replacement.
 *
 * Filament reads a page's navigation icon from a static property on the page
 * class, so a plugin cannot swap it through configuration. What a plugin can do
 * is hide the rendered SVG's paths and mask the element with a different icon -
 * the result still inherits currentColor, so hover and active states keep
 * working. The chosen icon is rendered server side through Blade Icons, the same
 * factory Pelican itself uses to validate icon names.
 */
class Icons
{
    /**
     * Menu items are matched on part of their link, which is stable across
     * languages and server names.
     */
    private const SELECTORS = [
        '.fi-sidebar-item-btn',
        '.fi-topbar-item-btn',
    ];

    public static function css(): string
    {
        $stroke = self::oneOf(Theme::config('icon_stroke'), ['1.25', '2', '2.5'], '2');
        $scale = self::oneOf(Theme::config('icon_scale'), ['0.9', '1', '1.1', '1.25'], '1');

        $css = ":root{--ld-icon-stroke:{$stroke};--ld-icon-scale:{$scale};}";

        if (Theme::config('icon_accent', false)) {
            $css .= 'html.dark .fi-sidebar-item-btn>.fi-icon,html.dark .fi-topbar-item-btn>.fi-icon{color:var(--primary-400);}';
        }

        return $css . self::overrideCss();
    }

    /**
     * @return array<string, string>
     */
    public static function overrides(): array
    {
        $map = [];

        foreach (explode('|', (string) Theme::config('icon_overrides', '')) as $pair) {
            [$match, $icon] = array_pad(explode(':', $pair, 2), 2, null);

            $match = self::sanitiseMatch((string) $match);
            $icon = self::sanitiseIcon((string) $icon);

            if ($match === null || $icon === null) {
                continue;
            }

            $map[$match] = $icon;
        }

        return $map;
    }

    /**
     * The same pairs as rows, which is what a repeater of two fields hands
     * back - one row per replaced icon, so each can have a picker of its own.
     *
     * @return array<int, array{match: string, icon: string}>
     */
    public static function rows(): array
    {
        $rows = [];

        foreach (self::overrides() as $match => $icon) {
            $rows[] = ['match' => $match, 'icon' => $icon];
        }

        return $rows;
    }

    /**
     * Accepts either shape: rows from the repeater, or the flat map the older
     * key/value field produced - a saved .env from before this changed still
     * round-trips.
     *
     * @param  array<mixed, mixed>  $rows
     */
    public static function toStorage(array $rows): string
    {
        $pairs = [];

        foreach ($rows as $key => $row) {
            if (is_array($row)) {
                $match = self::sanitiseMatch((string) ($row['match'] ?? ''));
                $icon = self::sanitiseIcon((string) ($row['icon'] ?? ''));
            } else {
                $match = self::sanitiseMatch((string) $key);
                $icon = self::sanitiseIcon(is_string($row) ? $row : '');
            }

            if ($match === null || $icon === null) {
                continue;
            }

            $pairs[] = "{$match}:{$icon}";
        }

        return implode('|', array_unique($pairs));
    }

    private static function overrideCss(): string
    {
        $overrides = self::overrides();

        if ($overrides === []) {
            return '';
        }

        // Each icon is read off disk to build its data URI, so the result is
        // cached against the settings that produced it - and a cache that
        // cannot answer costs that work again, not the page it was rendering.
        try {
            return cache()->remember(
                'legend-theme.icons.' . md5(serialize($overrides)),
                now()->addDay(),
                static fn (): string => self::buildOverrideCss($overrides),
            );
        } catch (Throwable $exception) {
            report($exception);

            return self::buildOverrideCss($overrides);
        }
    }

    /**
     * @param  array<string, string>  $overrides
     */
    private static function buildOverrideCss(array $overrides): string
    {
        $css = '';

        foreach ($overrides as $match => $icon) {
            $uri = self::dataUri($icon);

            if ($uri === null) {
                continue;
            }

            $targets = array_map(
                fn (string $selector): string => "{$selector}[href*=\"/{$match}\"]>.fi-icon",
                self::SELECTORS,
            );

            $hidden = implode(',', array_map(fn (string $target): string => "{$target}>*", $targets));
            $masked = implode(',', $targets);

            $css .= "{$hidden}{display:none;}";
            $css .= "{$masked}{background-color:currentColor;"
                . "-webkit-mask:url(\"{$uri}\") center/contain no-repeat;"
                . "mask:url(\"{$uri}\") center/contain no-repeat;}";
        }

        return $css;
    }

    private static function dataUri(string $icon): ?string
    {
        // Whichever pack it came from - a registered Blade Icons set, or the
        // uploaded one. An unknown name leaves Pelican's own icon in place.
        $svg = IconPacks::svg($icon);

        if ($svg === null) {
            return null;
        }

        $svg = preg_replace('/\s+/', ' ', trim($svg)) ?? '';

        if ($svg === '') {
            return null;
        }

        return 'data:image/svg+xml,' . rawurlencode($svg);
    }

    private static function sanitiseMatch(string $match): ?string
    {
        $match = preg_replace('/[^a-z0-9\-_]/', '', strtolower(trim($match))) ?? '';

        return $match === '' ? null : $match;
    }

    /**
     * Dots and underscores are allowed as well as dashes: an uploaded pack is
     * named after its files, and those come as they come.
     */
    private static function sanitiseIcon(string $icon): ?string
    {
        $icon = strtolower(trim($icon));

        return preg_match('/^[a-z0-9._-]+$/', $icon) === 1 ? $icon : null;
    }

    /**
     * @param  array<int, string>  $allowed
     */
    private static function oneOf(mixed $value, array $allowed, string $fallback): string
    {
        $value = is_scalar($value) ? (string) $value : '';

        return in_array($value, $allowed, true) ? $value : $fallback;
    }
}
