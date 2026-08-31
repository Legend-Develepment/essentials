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

    /** Pelican's own third option: a topbar, with the sidebar still there. */
    public const MIXED = 'mixed';

    /** The sidebar stays; the content stops being held to a column. */
    public const WIDE = 'wide';

    /** A narrow column and a sidebar that folds away entirely. */
    public const FOCUS = 'focus';

    private const LAYOUTS = [
        self::DEFAULT,
        self::RAIL,
        self::TOP,
        self::MIXED,
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

                self::TOP => self::applyTopNavigation($panel, mixed: false),

                self::MIXED => self::applyTopNavigation($panel, mixed: true),

                default => null,
            };
        } catch (Throwable) {
            // A panel API that moved on is not worth taking the panel down for;
            // the layout stays as Pelican built it.
        }
    }

    /**
     * Moving the navigation, without walking over someone who has already said
     * where they want it.
     *
     * Pelican offers this per person under Account -> Navigation, and reads it
     * from two closures: one deciding whether the navigation goes into the
     * topbar, and a second deciding whether there is a topbar at all. Both have
     * to be answered. Setting only the first is what made this layout appear to
     * do nothing but remove the sidebar - the navigation moved into a bar that
     * the second closure was still saying no to.
     *
     * Mixed is Pelican's own third option: the topbar appears and the sidebar
     * stays.
     */
    private static function applyTopNavigation(Panel $panel, bool $mixed): Panel
    {
        // Nothing to move on a panel without navigation - Pelican's client area
        // sets navigation(false) - so it keeps what it has rather than losing a
        // sidebar for nothing.
        if (!$panel->hasNavigation() || self::userChoseNavigation()) {
            return $panel;
        }

        return $mixed
            ? $panel->topbar(true)
            : $panel->topNavigation(true)->topbar(true);
    }

    /**
     * Whether this person has picked their own navigation.
     *
     * getCustomization() merges the enum's defaults in before answering, so it
     * always says something - which makes "chose sidebar" and "never chose"
     * indistinguishable. The stored column does not, and that difference is the
     * whole of "the theme sets the default and the person overrides it".
     */
    private static function userChoseNavigation(): bool
    {
        try {
            $stored = user()?->customization;
            $stored = is_string($stored) ? json_decode($stored, true) : $stored;

            return is_array($stored) && array_key_exists('top_navigation', $stored);
        } catch (Throwable) {
            // Unreadable means unchosen, which leaves the theme's choice
            // standing - the same answer as a fresh account.
            return false;
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
                . '.fi-sidebar:not(:hover):not(:focus-within) .fi-badge,'
                // The sidebar footer is a label like the rest: it belongs on
                // this list rather than in a rule of its own that would have to
                // be kept in step with it.
                . '.fi-sidebar:not(:hover):not(:focus-within) .ld-foot{'
                . 'opacity:0;'
                . 'pointer-events:none;'
                . 'transition:opacity 120ms var(--ld-ease);}'
                . '.fi-sidebar-item-btn{white-space:nowrap;}'
                . '}';
        }

        if ($layout === self::TOP || $layout === self::MIXED) {
            /*
             * The topbar is carrying the whole navigation now, which is a very
             * different job from holding a search box and an avatar. On a panel
             * with a dozen pages it will wrap onto a second row, so the rows are
             * given room rather than left to collide, and every item is a pill
             * of its own so a wrapped row still reads as navigation.
             */
            return '@media (min-width:1024px){'
                . '.fi-topbar{padding-block:0.4rem;}'
                . '.fi-topbar>nav{'
                . 'flex-wrap:wrap;'
                . 'row-gap:0.35rem;'
                . 'column-gap:0.15rem;'
                . 'align-items:center;}'
                // A hairline under the bar, so the navigation and the page are
                // told apart without the sidebar's edge doing it.
                . 'html.dark .fi-topbar{'
                . 'box-shadow:inset 0 -1px 0 0 var(--ld-border),var(--ld-shadow);}'
                . '.fi-topbar-item-btn{'
                . 'border-radius:9999px;'
                . 'padding-inline:0.8rem;'
                . 'white-space:nowrap;}'
                . 'html.dark .fi-topbar-item:not(.fi-active)>.fi-topbar-item-btn:hover{'
                . 'background-color:var(--ld-tint-subtle);}'
                // Only when the sidebar has gone: the page then starts where it
                // used to, and needs gutters of its own rather than running to
                // the window edge. With the sidebar still there it already has
                // them.
                . ($layout === self::TOP ? '.fi-main{padding-inline:1.75rem;}' : '')
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
        $style = self::cardStyle();

        if ($style === self::DEFAULT) {
            return '';
        }

        /*
         * Everything that reads as a card: sections, widgets, the server cards
         * on the list, and the small blocks above the console.
         *
         * html.fi.dark rather than html.dark, and the server card's hover state
         * spelled out. The stylesheet gives that card a lift on hover with a
         * rule of its own, which is more specific than its resting one - so a
         * style set here held until the pointer touched it and then snapped
         * back, which reads as the setting doing nothing at all.
         */
        $cards = 'html.fi.dark .fi-section:not(.fi-section-not-contained),'
            . 'html.fi.dark .fi-wi-stats-overview-stat,'
            . 'html.fi.dark .fi-small-stat-block,'
            . 'html.fi.dark [wire\\:id]:has(> .fi-color) > .fi-color + div,'
            . 'html.fi.dark [wire\\:id]:has(> .fi-color):hover > .fi-color + div';

        return match ($style) {
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
