<?php

namespace LegendDevelopment\Theme\Support;

use Filament\Panel;
use Filament\Support\Enums\Width;
use Throwable;

/**
 * The shape of the panel, as opposed to its colour.
 *
 * Four choices, and they compose: where the navigation sits, what the sidebar
 * looks like, what the topbar looks like, and how cards are drawn. Between them
 * a panel can be made to look like a different application without a single
 * Blade template being replaced.
 *
 * Where Filament's own panel API can do the work it does - maxContentWidth for
 * the width, sidebarFullyCollapsibleOnDesktop for a sidebar that folds away.
 * Where it cannot, the rules are emitted as CSS. The rail is the clearest case:
 * Pelican already turns Filament's collapsible sidebar on, so asking for it
 * again changes nothing, and a rail that is actually a rail has to be drawn.
 */
class Layout
{
    public const DEFAULT = 'default';

    /** Icons only, opening to the full menu when the pointer reaches it. */
    public const RAIL = 'rail';

    /** No sidebar - the navigation moves into the topbar. */
    public const TOP = 'top';

    /** The sidebar stays; the content stops being held to a column. */
    public const WIDE = 'wide';

    /** A narrow column and a sidebar that folds away entirely. */
    public const FOCUS = 'focus';

    private const LAYOUTS = [
        self::DEFAULT,
        self::RAIL,
        self::TOP,
        self::WIDE,
        self::FOCUS,
    ];

    private const NAV_STYLES = ['default', 'floating', 'flat', 'bordered'];

    private const TOPBAR_STYLES = ['default', 'floating', 'flush', 'hidden'];

    private const CARD_STYLES = ['default', 'flat', 'outline', 'glass', 'sharp'];

    /** How wide the rail is when nothing is pointing at it. */
    private const RAIL_WIDTH = '4.75rem';

    public static function current(): string
    {
        return self::oneOf(Theme::config('layout'), self::LAYOUTS);
    }

    public static function navStyle(): string
    {
        return self::oneOf(Theme::config('nav_style'), self::NAV_STYLES);
    }

    public static function topbarStyle(): string
    {
        return self::oneOf(Theme::config('topbar_style'), self::TOPBAR_STYLES);
    }

    public static function cardStyle(): string
    {
        return self::oneOf(Theme::config('card_style'), self::CARD_STYLES);
    }

    public static function sanitise(mixed $value): string
    {
        return self::oneOf($value, self::LAYOUTS);
    }

    public static function sanitiseNav(mixed $value): string
    {
        return self::oneOf($value, self::NAV_STYLES);
    }

    public static function sanitiseTopbar(mixed $value): string
    {
        return self::oneOf($value, self::TOPBAR_STYLES);
    }

    public static function sanitiseCard(mixed $value): string
    {
        return self::oneOf($value, self::CARD_STYLES);
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return self::labels(self::LAYOUTS, 'settings.layout.');
    }

    /**
     * @return array<string, string>
     */
    public static function navOptions(): array
    {
        return self::labels(self::NAV_STYLES, 'settings.layout.nav_');
    }

    /**
     * @return array<string, string>
     */
    public static function topbarOptions(): array
    {
        return self::labels(self::TOPBAR_STYLES, 'settings.layout.topbar_');
    }

    /**
     * @return array<string, string>
     */
    public static function cardOptions(): array
    {
        return self::labels(self::CARD_STYLES, 'settings.layout.card_');
    }

    /**
     * The part Filament's own API can do. Called from the plugin's boot, after
     * Pelican has finished building the panel.
     */
    public static function apply(Panel $panel): void
    {
        try {
            match (self::current()) {
                self::WIDE => $panel->maxContentWidth(Width::Full),

                self::FOCUS => $panel
                    ->maxContentWidth(Width::FiveExtraLarge)
                    ->sidebarFullyCollapsibleOnDesktop(),

                // Filament moves the navigation into the topbar. A panel with
                // no navigation of its own - Pelican's client area sets
                // navigation(false) - has nothing to move, so it is left alone
                // rather than losing its sidebar for nothing.
                self::TOP => $panel->hasNavigation() ? $panel->topNavigation() : $panel,

                default => null,
            };
        } catch (Throwable) {
            // A panel API that moved on is not worth taking the panel down for;
            // the layout stays as Pelican built it.
        }
    }

    /**
     * Everything the panel API cannot express.
     */
    public static function css(): string
    {
        return self::layoutCss() . self::navCss() . self::topbarCss() . self::cardCss();
    }

    private static function layoutCss(): string
    {
        $layout = self::current();

        if ($layout === self::RAIL) {
            $rail = self::RAIL_WIDTH;

            // Only on a desktop: on a phone the sidebar is already a drawer
            // that slides over the page, and a rail there would be a menu with
            // no way to read it.
            return '@media (min-width:1024px){'
                . "html.fi{--sidebar-width:{$rail};}"
                . '.fi-sidebar{'
                . "width:{$rail};"
                . 'overflow-x:hidden;'
                . 'transition:width 200ms var(--ld-ease);'
                . 'z-index:30;}'
                // Reaching it with a pointer or with the keyboard opens it over
                // the page rather than pushing the page across.
                . '.fi-sidebar:hover,.fi-sidebar:focus-within{'
                . 'width:16rem;'
                . 'box-shadow:0 0 50px -12px rgb(0 0 0 / 0.8);}'
                . '.fi-sidebar:not(:hover):not(:focus-within) .fi-sidebar-item-label,'
                . '.fi-sidebar:not(:hover):not(:focus-within) .fi-sidebar-group-label,'
                . '.fi-sidebar:not(:hover):not(:focus-within) .fi-sidebar-item-grouped-border,'
                . '.fi-sidebar:not(:hover):not(:focus-within) .fi-badge{'
                . 'opacity:0;'
                . 'pointer-events:none;'
                . 'transition:opacity 120ms var(--ld-ease);}'
                . '.fi-sidebar-item-btn{white-space:nowrap;}'
                . '}';
        }

        if ($layout === self::TOP) {
            // The topbar is carrying the navigation now, so it gets room for it
            // and the content starts at the edge the sidebar has left.
            return '@media (min-width:1024px){'
                . '.fi-topbar>nav{gap:0.5rem;}'
                . '.fi-topbar-item-btn{padding-inline:0.85rem;}'
                . '}';
        }

        if ($layout === self::WIDE) {
            return '@media (min-width:1024px){.fi-main{padding-inline:2rem;}}';
        }

        return '';
    }

    private static function navCss(): string
    {
        return match (self::navStyle()) {
            // The sidebar as a card of its own, floating clear of the page.
            'floating' => '@media (min-width:1024px){'
                . '.fi-sidebar{padding:0.75rem;}'
                . 'html.dark .fi-sidebar{background-color:transparent;border:0;box-shadow:none;}'
                . 'html.dark .fi-sidebar-nav{'
                . 'background-color:var(--ld-raised);'
                . 'border-radius:var(--ld-radius);'
                . 'box-shadow:inset 0 1px 0 0 var(--ld-edge),0 0 0 1px var(--ld-border),var(--ld-shadow-lg);'
                . 'padding:0.75rem;}'
                . '}',

            // No chrome at all: the items sit straight on the page.
            'flat' => 'html.dark .fi-sidebar{'
                . 'background-color:transparent;'
                . 'border-inline-end:0;'
                . 'box-shadow:none;'
                . '-webkit-backdrop-filter:none;backdrop-filter:none;}',

            // A plain line instead of a surface - the sidebar reads as part of
            // the page rather than as a panel on top of it.
            'bordered' => 'html.dark .fi-sidebar{'
                . 'background-color:transparent;'
                . 'box-shadow:none;'
                . 'border-inline-end:1px solid var(--ld-border-strong);}',

            default => '',
        };
    }

    private static function topbarCss(): string
    {
        return match (self::topbarStyle()) {
            'floating' => '@media (min-width:1024px){'
                . 'html.dark .fi-topbar{background-color:transparent;box-shadow:none;'
                . '-webkit-backdrop-filter:none;backdrop-filter:none;padding:0.75rem 1rem 0;}'
                . 'html.dark .fi-topbar>nav{'
                . 'background-color:var(--ld-topbar-bg);'
                . 'border-radius:9999px;'
                . 'box-shadow:inset 0 1px 0 0 var(--ld-edge),0 0 0 1px var(--ld-border),var(--ld-shadow);'
                . '-webkit-backdrop-filter:var(--ld-blur);backdrop-filter:var(--ld-blur);'
                . 'padding-inline:1rem;}'
                . '}',

            'flush' => 'html.dark .fi-topbar{'
                . 'background-color:var(--ld-surface);'
                . 'box-shadow:none;'
                . 'border-bottom:1px solid var(--ld-border);'
                . '-webkit-backdrop-filter:none;backdrop-filter:none;}',

            // Gone on a desktop, where the sidebar already carries everything.
            // Never on a phone: it holds the only way back to the menu.
            'hidden' => '@media (min-width:1024px){.fi-topbar{display:none;}}',

            default => '',
        };
    }

    private static function cardCss(): string
    {
        // Everything that reads as a card: sections, the widgets, the server
        // cards on the list, and the small blocks above the console.
        $cards = 'html.dark .fi-section:not(.fi-section-not-contained),'
            . 'html.dark .fi-wi-stats-overview-stat,'
            . 'html.dark .fi-small-stat-block,'
            . 'html.dark [wire\\:id]:has(> .fi-color) > .fi-color + div';

        return match (self::cardStyle()) {
            // No lift at all - the panel reads as one flat sheet.
            'flat' => "{$cards}{"
                . 'box-shadow:inset 0 0 0 1px var(--ld-border);'
                . 'background-color:color-mix(in oklab,var(--ld-surface) 60%,transparent);}',

            // An outline and nothing behind it.
            'outline' => "{$cards}{"
                . 'background-color:transparent;'
                . 'box-shadow:inset 0 0 0 1px var(--ld-border-strong);}',

            // Frosted, so a background picture carries through the whole panel.
            'glass' => "{$cards}{"
                . 'background-color:color-mix(in oklab,var(--ld-raised) 55%,transparent);'
                . '-webkit-backdrop-filter:var(--ld-blur);backdrop-filter:var(--ld-blur);'
                . 'box-shadow:inset 0 1px 0 0 var(--ld-edge),0 0 0 1px var(--ld-border);}',

            // Square corners everywhere, cards included.
            'sharp' => ':root{--ld-radius:0.25rem;--ld-radius-sm:0.2rem;}'
                . "{$cards}{border-radius:0.25rem;}",

            default => '',
        };
    }

    /**
     * @param  array<int, string>  $values
     * @return array<string, string>
     */
    private static function labels(array $values, string $prefix): array
    {
        $options = [];

        foreach ($values as $value) {
            $options[$value] = Theme::trans($prefix . $value);
        }

        return $options;
    }

    /**
     * @param  array<int, string>  $allowed
     */
    private static function oneOf(mixed $value, array $allowed): string
    {
        return in_array($value, $allowed, true) ? (string) $value : self::DEFAULT;
    }
}
