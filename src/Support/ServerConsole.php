<?php

namespace LegendDevelopment\Theme\Support;

use Throwable;

/**
 * The six blocks above the console.
 *
 * Pelican builds them in App\Filament\Server\Widgets\ServerOverview, in a fixed
 * order, each one a SmallStatBlock rendering
 * resources/views/filament/components/server-small-data-block.blade.php:
 *
 *   1 Name   2 Status   3 Address   4 CPU   5 Memory   6 Disk
 *
 * That order is what lets each block wear the right icon, since nothing in the
 * markup says which is which - the label is text, and CSS cannot read text. It
 * is a bet on the order staying as it is, and it fails safe: a block that ends
 * up matching nothing simply has no icon.
 */
class ServerConsole
{
    private const STATS = ['tiles', 'plain', 'off'];

    /**
     * Which icon goes with which position, in Pelican's order.
     *
     * @var array<int, string>
     */
    private const ICONS = [
        1 => 'tabler-server',
        2 => 'tabler-heartbeat',
        3 => 'tabler-network',
        4 => 'tabler-cpu',
        5 => 'tabler-device-sd-card',
        6 => 'tabler-database',
    ];

    /** The widget, told apart from every other stats widget in the panel. */
    private const WIDGET = 'html.dark .fi-wi-stats-overview:has(.fi-small-stat-block)';

    public static function stats(): string
    {
        $value = (string) Theme::config('console_stats', 'tiles');

        return in_array($value, self::STATS, true) ? $value : 'tiles';
    }

    public static function sanitiseStats(mixed $value): string
    {
        $value = is_scalar($value) ? (string) $value : '';

        return in_array($value, self::STATS, true) ? $value : 'tiles';
    }

    /**
     * @return array<string, string>
     */
    public static function statsOptions(): array
    {
        $options = [];

        foreach (self::STATS as $value) {
            $options[$value] = Theme::trans('settings.console.stats_' . $value);
        }

        return $options;
    }

    public static function css(): string
    {
        return match (self::stats()) {
            // On the console page, the console is the point. Someone who knows
            // their server's address does not need it in front of them every
            // time, and hiding all six gives the terminal the height back.
            'off' => self::WIDGET . '{display:none;}',

            'tiles' => self::tilesCss(),

            default => '',
        };
    }

    /**
     * Label above, figure below, and the icon it is about beside them.
     *
     * Reading six icons off disk is not work to repeat on every page, so the
     * result is cached against the accent it was built for - and a cache that
     * cannot answer costs that work again, not the page.
     */
    private static function tilesCss(): string
    {
        try {
            return cache()->remember(
                'legend-theme.console.tiles',
                now()->addDay(),
                static fn (): string => self::buildTilesCss(),
            );
        } catch (Throwable) {
            return self::buildTilesCss();
        }
    }

    private static function buildTilesCss(): string
    {
        $block = self::WIDGET . ' .fi-small-stat-block';

        $css = "{$block}{"
            . 'position:relative;'
            . 'padding:0.9rem 1rem;'
            // Room on the right for the icon, so a long server name wraps
            // before it reaches it rather than running underneath.
            . 'padding-inline-end:3.4rem;}'
            // The label reads as a heading for the figure rather than as the
            // first half of a sentence with it.
            . "{$block} > span > span:first-child{"
            . 'display:block;'
            . 'font-size:0.6875rem;'
            . 'font-weight:600;'
            . 'letter-spacing:0.08em;'
            . 'text-transform:uppercase;'
            . 'color:var(--gray-400);}'
            . "{$block} > span > span:last-child{"
            . 'display:block;'
            . 'font-size:1.05rem;'
            . 'font-weight:600;'
            . 'line-height:1.4rem;}';

        // The tile the icon sits in: the accent at low strength, so it reads as
        // part of the card rather than as a button on it.
        $css .= "{$block}::after{"
            . 'content:"";'
            . 'position:absolute;'
            . 'inset-block-start:50%;'
            . 'inset-inline-end:0.85rem;'
            . 'translate:0 -50%;'
            . 'width:2.1rem;'
            . 'height:2.1rem;'
            . 'border-radius:var(--ld-radius-sm);'
            . 'background-color:color-mix(in oklab,var(--primary-500) 16%,transparent);'
            . 'box-shadow:inset 0 0 0 1px var(--ld-border);}';

        foreach (self::ICONS as $position => $icon) {
            $uri = IconPacks::dataUri($icon);

            if ($uri === null) {
                continue;
            }

            /*
             * Matched by the position of whatever holds the block, because
             * Filament wraps each stat in a schema component of its own - so
             * the blocks are not siblings and nth-child on them counts to one.
             * Both shapes are written out: if a future Filament stops wrapping,
             * the first selector takes over and the second matches nothing.
             */
            $nth = "{$block}:nth-child({$position})::before,"
                . self::WIDGET . " *:has(> .fi-small-stat-block):nth-child({$position}) .fi-small-stat-block::before";

            $css .= "{$nth}{"
                . 'content:"";'
                . 'position:absolute;'
                . 'inset-block-start:50%;'
                . 'inset-inline-end:1.28rem;'
                . 'translate:0 -50%;'
                . 'z-index:1;'
                . 'width:1.25rem;'
                . 'height:1.25rem;'
                . 'background-color:var(--primary-400);'
                . "-webkit-mask:url(\"{$uri}\") center/contain no-repeat;"
                . "mask:url(\"{$uri}\") center/contain no-repeat;}";
        }

        // A phone has no room beside the figure, and the icon is decoration
        // rather than information - the label already says which block it is.
        return $css . '@media (max-width:639px){'
            . "{$block}{padding-inline-end:1rem;}"
            . "{$block}::after,{$block}::before{display:none;}"
            . self::WIDGET . ' *:has(> .fi-small-stat-block) .fi-small-stat-block::before{display:none;}'
            . '}';
    }
}
