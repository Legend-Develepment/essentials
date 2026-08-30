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
     * The card body's padding, per density. Comfortable is what the stylesheet
     * already sets and is here to be read against, not written.
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

    /**
     * Whether Pelican's own filter button is given a label.
     *
     * The panel already filters this list by egg and by owner, server side and
     * across every page - but the way in is an icon with a number on it, next
     * to the search box, and nobody finds it. This puts the word on the button.
     */
    public static function labelFilters(): bool
    {
        $value = Theme::config('server_filter_label', true);

        return $value === null ? true : filter_var($value, FILTER_VALIDATE_BOOL);
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
        return self::equalHeightCss()
            . self::artworkCss()
            . self::statusCss()
            . self::densityCss()
            . self::columnCss()
            . self::filterCss();
    }

    /**
     * Pelican's filters, made findable.
     *
     * The list is already filterable by egg and by owner - server side, across
     * every page, searchable and preloaded. It sits behind an icon button with
     * a count badge beside the search box, which is where nobody looks.
     *
     * Turning that square icon into a labelled pill is the whole change. The
     * word comes from the translation file rather than being written into CSS,
     * which is why this is emitted from PHP.
     */
    private static function filterCss(): string
    {
        if (!self::labelFilters()) {
            return '';
        }

        $label = addcslashes(Theme::trans('settings.servers.filter_button'), '"\\');
        $trigger = '.fi-ta-filters-trigger-action-ctn > .fi-icon-btn';

        return "{$trigger}{"
            . 'width:auto;'
            . 'gap:0.45rem;'
            . 'padding-inline:0.85rem;'
            . 'border-radius:9999px;}'
            . "{$trigger}::after{"
            . "content:\"{$label}\";"
            . 'font-size:0.875rem;'
            . 'font-weight:500;'
            . 'white-space:nowrap;}'
            . 'html.dark ' . $trigger . '{'
            . 'background-color:var(--ld-sunken);'
            . 'box-shadow:inset 0 1px 0 0 var(--ld-edge),0 0 0 1px var(--ld-border);}'
            // On a phone the row is tight enough already; the icon says enough
            // once you have found it once.
            . "@media (max-width:639px){{$trigger}::after{display:none;}"
            . "{$trigger}{padding-inline:0;}}";
    }

    /**
     * Every card in a row the same height, and the meters across a row on one
     * line.
     *
     * A grid stretches its items by default, but the card here is a Livewire
     * root inside that item and stops at its own content - so one server with a
     * description and one without gave a row two heights.
     *
     * Height alone does not line the meters up, though: a name that wraps onto
     * two lines pushes them down, and next to a name that does not they sit a
     * row of text lower. The body becomes a column and the meters are pushed to
     * the bottom of it, so what lines them up is the card's edge rather than
     * however long a server's name happens to be.
     */
    private static function equalHeightCss(): string
    {
        $grid = '.fi-ta-content-grid ';
        $root = $grid . self::rootSelector();
        $body = self::rootSelector() . ' > .fi-color + div';

        /*
         * A grid stretches its cells, so a row's cells are already equal - but
         * the card sits several wrappers down inside one, and height:100%
         * resolves against a parent that has a height of its own. One wrapper
         * without it breaks the chain, and the card falls back to its content.
         *
         * Every ancestor of a card within the grid, rather than the four this
         * was written against. Naming them was cheaper for the browser and
         * wrong twice: it holds only while Filament's markup and Pelican's
         * column both stay as they are, and there is no version of "the card is
         * a different size than its neighbours" that is worth that trade.
         */
        $chain = "{$grid}*:has(" . self::rootSelector() . ')';

        /*
         * And the three meters level with each other inside the card.
         *
         * Pelican lays that row out with items-center, so each of CPU, memory
         * and disk is centred on its own height - and a figure that wraps onto
         * two lines makes its column taller, which pushes its bar up while the
         * other two stay put. Three bars at three heights, from nothing but how
         * long a number happened to be.
         *
         * Aligned to the top instead: the bars start on one line and the
         * figures hang below them, however many lines each one needs.
         */
        $meters = self::rootSelector() . ' div:has(> div > .fi-ta-text)';

        return "{$chain},{$root},{$root} > .fi-color + div{height:100%;}"
            . "{$body}{display:flex;flex-direction:column;}"
            // The meters are the last thing in the card; the artwork above them
            // is out of flow, so it is not in the running for :last-child.
            . "{$body} > div:last-child{margin-top:auto;}"
            . "{$meters}{align-items:flex-start;}";
    }

    private static function rootSelector(): string
    {
        return '[wire\\:id]:has(> .fi-color)';
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

        /*
         * Behind the name and the description rather than above them, and it
         * stays out of the flow while doing it - which is the whole reason it is
         * absolute. A cover that takes up room makes a card with artwork taller
         * than a card without, and a row of cards then has two heights.
         *
         * It fades out downward so the text over it stays readable whatever the
         * picture is, and the name is painted after it in the markup, so nothing
         * needs a z-index to sit on top.
         */
        $css = "{$art}{"
            . 'inset:0 0 auto 0 !important;'
            . 'max-width:none !important;'
            . 'max-height:none !important;'
            . 'opacity:1 !important;'
            . 'background-size:cover !important;'
            . 'background-position:center !important;'
            . 'height:6.5rem;'
            . "filter:brightness({$brightness});"
            /*
             * The card's own top corners, given rather than inherited.
             *
             * The body it sits in has overflow:hidden and would clip this, but
             * it is not positioned - so the picture's containing block is the
             * root above it and the body's clipping never applies. Squared-off
             * corners on a rounded card is what that looks like.
             */
            . 'border-radius:var(--ld-radius) var(--ld-radius) 0 0;'
            . '-webkit-mask-image:linear-gradient(to bottom,#000 0%,rgb(0 0 0 / 0.6) 55%,transparent 100%);'
            . 'mask-image:linear-gradient(to bottom,#000 0%,rgb(0 0 0 / 0.6) 55%,transparent 100%);'
            . '}';

        /*
         * "Behind" has to be arranged, not assumed.
         *
         * The artwork is positioned and everything it is meant to sit behind -
         * the name, the description, the meters - is in normal flow, and a
         * positioned element paints after in-flow content whatever the order in
         * the markup. So the picture covered the very text it is a backdrop for.
         *
         * The content is lifted rather than the picture pushed down. A negative
         * z-index would work until the card is hovered, where the theme's lift
         * gives the root a transform and therefore a stacking context of its
         * own, and the picture would vanish behind the card for as long as the
         * pointer was on it.
         */
        $content = self::card(' > .fi-color + div > div:not([style*=\'background-size\'])');

        $css .= "{$content}{position:relative;z-index:1;}";

        /*
         * The power button loses its own ground.
         *
         * Pelican wraps that dropdown in a panel of its own, which the theme
         * gives a raised surface so it does not sit on the page as a grey box.
         * Over a picture it is the box again - and the button is a red power
         * symbol that needs nothing behind it to be read.
         */
        $power = self::card(' .rounded-b-lg:has(> .fi-dropdown)');

        $css .= "{$power}{background-color:transparent;}";

        // A phone shows one card at a time and its height is the scarce thing,
        // so the picture takes less of it.
        return $css . '@media (max-width:639px){' . $art . '{height:5rem;}}';
    }

    private static function statusCss(): string
    {
        $status = self::status();

        if ($status === 'bar') {
            return '';
        }

        $bar = self::card(' > .fi-color');

        return match ($status) {
            /*
             * Across the top rather than down the side - in a grid of cards a
             * left edge is easy to miss.
             *
             * Held in from the sides rather than run full width: the card's
             * corners are rounded and the marker is not inside the element that
             * clips them, so a full-width line cut straight across the curve.
             * A short rounded line reads as part of the card instead of as
             * something laid over it.
             */
            'edge' => "{$bar}{"
                . 'inset:0.45rem 0.9rem auto 0.9rem !important;'
                . 'width:auto !important;'
                . 'height:3px !important;'
                . 'border-radius:9999px;'
                . 'box-shadow:0 0 10px -1px var(--bg);}',

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

        // Three meters share a card that is now a third or a quarter of the
        // width, and "0.11 GB / 10.24 GB" does not fit across a hundred pixels.
        // The figures come down with the card, since it is this setting that
        // made them narrow.
        $figures = $columns === 4 ? '0.6875rem' : '0.75rem';

        return "@media (min-width:{$from}px){"
            . ".fi-ta-content-grid{grid-template-columns:repeat({$columns},minmax(0,1fr));}"
            . '.fi-ta-content-grid ' . self::rootSelector() . " .fi-ta-text{font-size:{$figures};}"
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
     * Cast before comparing, which is not tidiness but a fix.
     *
     * The column choices are '2', '3' and '4', and PHP turns numeric string
     * array keys into integers - so the options this offers have integer keys,
     * Filament hands an integer back, and a strict comparison against a list of
     * strings said no to every one of them. The setting saved and then read as
     * the default, every time.
     *
     * @param  array<int, string>  $allowed
     */
    private static function oneOf(mixed $value, array $allowed, string $fallback): string
    {
        $value = is_scalar($value) ? (string) $value : '';

        return in_array($value, $allowed, true) ? $value : $fallback;
    }
}
