<?php

namespace LegendDevelopment\Theme\Support;

/**
 * The server list - the page everyone lands on.
 *
 * Pelican already offers two shapes for it, grid and list, chosen by each person
 * under Account -> Dashboard layout. Nothing here replaces that: these settings
 * decide how a card is drawn, whichever shape it is drawn in.
 *
 * Everything is matched against the markup in Pelican's own
 * resources/views/livewire/server-entry.blade.php:
 *
 *   div[wire:id]                              the Livewire root
 *   |- div.absolute…fi-color…fi-bg-color-600  the condition bar, colour in --bg
 *   `- div.flex-1.rounded-lg.overflow-hidden  the card body
 *      |- div[style*=background]              the egg's artwork, inline styles
 *      |- div.flex.items-center.gap-2         icon, name, power actions
 *      |- div.text-left…                      the description, if there is one
 *      `- div.flex.justify-between…           three meters and the address
 *
 * That card has no class of its own, so it is reached structurally. If Pelican
 * ever changes it, none of this matches and the list is Pelican's own - which is
 * the failure mode to have.
 */
class ServerList
{
    /** How the egg's artwork is used. */
    private const ARTWORKS = ['faded', 'cover', 'off'];

    /**
     * Where the condition colour is shown.
     *
     * All four are the same element moved: the colour lives in --bg on the bar
     * itself, and a custom property cannot be read by a sibling, so anything
     * wearing the condition colour has to *be* that element.
     */
    private const STATUSES = ['bar', 'edge', 'dot', 'off'];

    private const DENSITIES = ['comfortable', 'compact'];

    /** How many cards may sit across a wide screen. Pelican's own cap is two. */
    private const COLUMNS = ['2', '3', '4'];

    /**
     * The card body's padding, per density. The cover artwork bleeds back out
     * of it to reach the card's edges, so the two have to agree - which is why
     * the numbers live here rather than being written twice.
     *
     * @var array<string, array{0: string, 1: string}>
     */
    private const PADDING = [
        'comfortable' => ['1rem', '1.15rem'],
        'compact' => ['0.6rem', '0.85rem'],
    ];

    public static function artwork(): string
    {
        return self::oneOf(Theme::config('server_art'), self::ARTWORKS, 'faded');
    }

    public static function status(): string
    {
        return self::oneOf(Theme::config('server_status'), self::STATUSES, 'bar');
    }

    public static function density(): string
    {
        return self::oneOf(Theme::config('server_density'), self::DENSITIES, 'comfortable');
    }

    public static function columns(): string
    {
        return self::oneOf(Theme::config('server_columns'), self::COLUMNS, '2');
    }

    public static function dim(): int
    {
        $value = Theme::config('server_art_dim', 35);

        return is_numeric($value) ? max(0, min(80, (int) $value)) : 35;
    }

    public static function sanitiseArtwork(mixed $value): string
    {
        return self::oneOf($value, self::ARTWORKS, 'faded');
    }

    public static function sanitiseStatus(mixed $value): string
    {
        return self::oneOf($value, self::STATUSES, 'bar');
    }

    public static function sanitiseDensity(mixed $value): string
    {
        return self::oneOf($value, self::DENSITIES, 'comfortable');
    }

    public static function sanitiseColumns(mixed $value): string
    {
        return self::oneOf($value, self::COLUMNS, '2');
    }

    /**
     * @return array<string, string>
     */
    public static function artworkOptions(): array
    {
        return self::labels(self::ARTWORKS, 'settings.servers.art_');
    }

    /**
     * @return array<string, string>
     */
    public static function statusOptions(): array
    {
        return self::labels(self::STATUSES, 'settings.servers.status_');
    }

    /**
     * @return array<string, string>
     */
    public static function densityOptions(): array
    {
        return self::labels(self::DENSITIES, 'settings.servers.density_');
    }

    /**
     * @return array<string, string>
     */
    public static function columnOptions(): array
    {
        return ['2' => '2', '3' => '3', '4' => '4'];
    }

    public static function css(): string
    {
        return self::artworkCss() . self::statusCss() . self::densityCss() . self::columnCss();
    }

    /** The card, wherever it is: the root, its body, and the artwork inside it. */
    private static function card(string $suffix = ''): string
    {
        return 'html.dark [wire\\:id]:has(> .fi-color)' . $suffix;
    }

    private static function artworkCss(): string
    {
        $artwork = self::artwork();

        if ($artwork === 'faded') {
            return '';
        }

        // Pelican writes the artwork's placement as inline styles - position,
        // inset, size, opacity and a max of 680x140 - so this is one of the two
        // places in the theme where !important is the only way through. The
        // other is the resource meters, for the same reason.
        $art = self::card(' [style*=\'background-size\']');

        if ($artwork === 'off') {
            return "{$art}{display:none !important;}";
        }

        $brightness = round((100 - self::dim()) / 100, 2);
        [$padY, $padX] = self::PADDING[self::density()];

        // Out of the corner and into the flow, bled back out of the card's own
        // padding so it reaches the edges - which is why the padding is read
        // from the same place the density rules write it. The body already clips
        // its corners, so the top two come for free.
        return "{$art}{"
            . 'position:relative !important;'
            . 'inset:auto !important;'
            . 'max-width:none !important;'
            . 'max-height:none !important;'
            . 'opacity:1 !important;'
            . 'background-size:cover !important;'
            . 'background-position:center !important;'
            . 'height:7.5rem;'
            . "margin:-{$padY} -{$padX} 0.85rem;"
            . "filter:brightness({$brightness});"
            // The fade belongs to the other mode; here the picture is the point.
            . '-webkit-mask-image:none;mask-image:none;'
            . '}';
    }

    private static function statusCss(): string
    {
        $status = self::status();

        if ($status === 'bar') {
            return '';
        }

        $bar = self::card(' > .fi-color');

        return match ($status) {
            // Across the top of the card rather than down its side. In a grid of
            // cards a left edge is easy to miss; a top edge is not.
            'edge' => "{$bar}{"
                . 'inset:0 0 auto 0 !important;'
                . 'width:auto !important;'
                . 'height:3px !important;'
                . 'border-radius:var(--ld-radius) var(--ld-radius) 0 0;'
                . 'box-shadow:0 0 12px 0 var(--bg);}',

            'dot' => "{$bar}{"
                . 'inset:0.9rem auto auto 0.9rem !important;'
                . 'width:0.55rem !important;'
                . 'height:0.55rem !important;'
                . 'border-radius:9999px;'
                . 'box-shadow:0 0 10px 0 var(--bg);}',

            'off' => "{$bar}{display:none !important;}",

            default => '',
        };
    }

    private static function densityCss(): string
    {
        if (self::density() !== 'compact') {
            return '';
        }

        [$padY, $padX] = self::PADDING['compact'];

        // Half the height, for someone running forty servers: less padding, a
        // smaller name, and the meters' figures brought in.
        return self::card(' > .fi-color + div') . "{padding:{$padY} {$padX};}"
            . self::card(' h2') . '{font-size:1rem;}'
            . self::card(' .fi-ta-text') . '{font-size:0.75rem;}'
            . self::card(' [role=\'progressbar\']') . '{height:0.4rem;}';
    }

    private static function columnCss(): string
    {
        $columns = (int) self::columns();

        if ($columns < 3) {
            return '';
        }

        /*
         * Pelican's table is built with contentGrid(['default' => 1, 'md' => 2]),
         * so two is its ceiling and there is no lg: class to raise it with a
         * custom property. The grid template is set directly instead - and only
         * from a width where a third card is not a squeeze.
         */
        $from = $columns === 4 ? 1536 : 1280;

        return "@media (min-width:{$from}px){"
            . ".fi-ta-content-grid{grid-template-columns:repeat({$columns},minmax(0,1fr));}"
            . '}';
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
    private static function oneOf(mixed $value, array $allowed, string $fallback): string
    {
        return in_array($value, $allowed, true) ? (string) $value : $fallback;
    }
}
