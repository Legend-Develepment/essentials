<?php

namespace LegendDevelopment\Theme\Support;

use Filament\Panel;
use Filament\Support\Enums\Width;
use Throwable;

/**
 * How the panel is laid out, as opposed to what colour it is.
 *
 * Five arrangements, each built from Filament's own panel API rather than from
 * CSS that fights it: where the navigation lives, whether the sidebar is a rail
 * or a full menu, and how wide the content is allowed to run. A layout that
 * Filament itself understands keeps working when Pelican changes its markup.
 *
 * Applied per panel, so the admin area, the server list and the client area all
 * follow the same choice.
 */
class Layout
{
    public const DEFAULT = 'default';

    /** Icons only, opening to the full menu when it is wanted. */
    public const RAIL = 'rail';

    /** No sidebar at all - the navigation runs across the top. */
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

    public static function current(): string
    {
        $value = (string) Theme::config('layout', self::DEFAULT);

        return in_array($value, self::LAYOUTS, true) ? $value : self::DEFAULT;
    }

    public static function sanitise(mixed $value): string
    {
        return in_array($value, self::LAYOUTS, true) ? (string) $value : self::DEFAULT;
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        $options = [];

        foreach (self::LAYOUTS as $layout) {
            $options[$layout] = Theme::trans('settings.layout.' . $layout);
        }

        return $options;
    }

    public static function apply(Panel $panel): void
    {
        $layout = self::current();

        if ($layout === self::DEFAULT) {
            return;
        }

        try {
            match ($layout) {
                // A rail of icons that opens on demand. Collapsible rather than
                // fully collapsible: the icons stay, so it is still navigation
                // and not a hidden menu.
                self::RAIL => $panel->sidebarCollapsibleOnDesktop(),

                // Filament moves the navigation into the topbar and the content
                // takes the whole width, which is what the sidebar was holding.
                self::TOP => $panel->topNavigation(),

                self::WIDE => $panel->maxContentWidth(Width::Full),

                // Narrow enough to read a line of text without moving your head,
                // with the sidebar able to go away completely.
                self::FOCUS => $panel
                    ->maxContentWidth(Width::FiveExtraLarge)
                    ->sidebarFullyCollapsibleOnDesktop(),

                default => null,
            };
        } catch (Throwable) {
            // A panel API that moved on is not worth taking the panel down for;
            // the layout simply stays as Pelican built it.
        }
    }
}
