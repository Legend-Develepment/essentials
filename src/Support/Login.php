<?php

namespace LegendDevelopment\Theme\Support;

/**
 * The sign-in screen.
 *
 * It is the one page of the panel that people who have no account see, so it is
 * the one worth being able to make your own. Everything here is CSS: no Blade
 * template is overridden, so a Pelican update cannot break the way in.
 */
class Login
{
    private const POSITIONS = ['center', 'top', 'bottom', 'left', 'right'];

    private const ALIGNMENTS = ['center', 'start', 'end'];

    /** Where the background picture sits when it is cropped. */
    public static function position(): string
    {
        $value = (string) Theme::config('login_position', 'center');

        return in_array($value, self::POSITIONS, true) ? $value : 'center';
    }

    /** Where the card sits across the screen. */
    public static function align(): string
    {
        $value = (string) Theme::config('login_align', 'center');

        return in_array($value, self::ALIGNMENTS, true) ? $value : 'center';
    }

    public static function opacity(): int
    {
        $value = Theme::config('login_opacity', 92);

        return is_numeric($value) ? max(30, min(100, (int) $value)) : 92;
    }

    public static function glow(): bool
    {
        $value = Theme::config('login_glow', true);

        return $value === null ? true : filter_var($value, FILTER_VALIDATE_BOOL);
    }

    public static function css(): string
    {
        $width = self::clamp(Theme::config('login_width'), 20, 60, 28);
        $blur = self::clamp(Theme::config('login_blur'), 0, 24, 0);

        $css = ":root{--ld-login-width:{$width}rem;--ld-login-blur:{$blur}px;}";

        $css .= Background::login();

        $opacity = self::opacity();

        $css .= 'html.dark .fi-simple-layout .fi-simple-main{'
            . "background-color:color-mix(in oklab,var(--ld-surface) {$opacity}%,transparent);}";

        if (!self::glow()) {
            // The card keeps its edge and its depth; only the accent halo goes.
            $css .= 'html.dark .fi-simple-main{box-shadow:'
                . 'inset 0 1px 0 0 var(--ld-edge),'
                . '0 0 0 1px var(--ld-border-strong),'
                . 'var(--ld-shadow-lg);}';
        }

        $align = self::align();

        if ($align !== 'center') {
            // Two ways to be centred and no way to tell from here which one is
            // in use: an auto margin, or the alignment of a flex item. Both are
            // answered, and whichever is not in play does nothing.
            $margin = $align === 'start' ? '0 auto' : 'auto 0';

            $css .= 'html.fi .fi-simple-layout .fi-simple-main{'
                . "align-self:flex-{$align};"
                . "margin-inline:{$margin};}";
        }

        if (Theme::config('login_hide_heading', false)) {
            $css .= '.fi-simple-layout .fi-simple-header{display:none;}';
        }

        if (Theme::config('login_hide_footer', false)) {
            $css .= '.fi-simple-layout footer{display:none;}';
        }

        $css .= self::noticeCss();

        return $css;
    }

    /**
     * A line under the card - "authorised users only", a support address, a
     * maintenance notice. Written through CSS content, so nothing has to be
     * added to a page that belongs to Pelican.
     */
    private static function noticeCss(): string
    {
        $notice = trim((string) Theme::config('login_notice', ''));

        if ($notice === '') {
            return '';
        }

        // Cut before escaping, so a long line cannot be truncated mid-escape.
        $notice = mb_substr($notice, 0, 160);

        // Everything a CSS string can be closed or broken with: a quote, a
        // backslash, and a newline - which ends the declaration outright.
        $notice = str_replace(
            ['\\', '"', "\r\n", "\n", "\r"],
            ['\\\\', '\\"', ' ', ' ', ' '],
            $notice,
        );

        return 'html.dark .fi-simple-main::after{'
            . "content:\"{$notice}\";"
            . 'display:block;'
            . 'margin-top:1.25rem;'
            . 'padding-top:1rem;'
            . 'border-top:1px solid var(--ld-border);'
            . 'color:var(--gray-400);'
            . 'font-size:0.8125rem;'
            . 'line-height:1.25rem;'
            . 'text-align:center;}';
    }

    private static function clamp(mixed $value, int $min, int $max, int $fallback): int
    {
        return is_numeric($value) ? max($min, min($max, (int) $value)) : $fallback;
    }
}
