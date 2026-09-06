<?php

namespace LegendDevelopment\Theme\Support;

use Illuminate\Support\Facades\Storage;

/**
 * Builds the CSS for the page background.
 *
 * 'aurora' emits only its base colour - the glows over it are what the
 * stylesheet already paints, in whichever mode the panel is in. The other three
 * override the stylesheet's own `.fi-body` rule outright, which works because
 * this CSS is written into a <style> tag that follows the stylesheet link, at
 * equal specificity.
 *
 * **Both modes, and that was a real fault.** Every rule in this class was
 * scoped to `html.dark`, so a light panel got nothing from any of them: a
 * chosen colour did nothing, a gradient did nothing, an uploaded picture did
 * nothing, and neither did the sign-in photograph. Four settings that silently
 * had no effect for anybody who had moved their panel to light. See MODES for
 * how the replacement keeps the specificity it needs.
 */
class Background
{
    /**
     * A selector that matches either mode, at the weight of one.
     *
     * The stylesheet's own backdrop rules are scoped to a mode -
     * `:is(html.dark, .ld-preview--dark) .fi-body` and its light counterpart -
     * which weighs (0,2,1). A bare `.fi-body` is (0,1,0) and would lose to them
     * however late it came. This weighs the same and comes later, which is the
     * whole mechanism, and it says "either mode" rather than naming one.
     */
    private const MODES = ':is(html.dark,html:not(.dark))';

    /** The same, for the sign-in screen, which paints its own layer. */
    private const SIMPLE = ':is(html.dark,html:not(.dark)) .fi-simple-layout';

    public static function css(): string
    {
        return match ((string) Theme::config('background', 'aurora')) {
            'solid' => self::solid(),
            'gradient' => self::gradient(),
            'image' => self::image(),
            // The glows are the stylesheet's, but the colour under them is a
            // setting - and it is what lets a scheme keep its own night colour.
            default => self::base(),
        };
    }

    /**
     * The backdrop's base colour, when one has been chosen.
     *
     * A custom property rather than a rule, so it feeds both the dark backdrop
     * and the light one without this class having to know which is showing.
     * Empty means "whatever the mode's default is", which is --gray-950 dark and
     * --gray-50 light - the same two colours Filament paints, so a panel that
     * has chosen nothing looks exactly as it did.
     */
    private static function base(): string
    {
        $color = trim((string) Theme::config('background_color', ''));

        if ($color === '') {
            return '';
        }

        return ':root{--ld-backdrop:' . Palette::sanitize($color, '#14110e') . ';}';
    }

    private static function solid(): string
    {
        $color = Palette::sanitize(Theme::config('background_color'), '#14110e');

        return self::MODES . " .fi-body{background-color:{$color};background-image:none;}"
            . self::neutraliseLoginPage();
    }

    private static function gradient(): string
    {
        $from = Palette::sanitize(Theme::config('background_color'), '#14110e');
        $to = Palette::sanitize(Theme::config('background_color_end'), '#2b1c08');
        $angle = self::clamp(Theme::config('background_angle'), 0, 360, 160);

        return self::MODES . " .fi-body{background-color:{$from};background-image:linear-gradient({$angle}deg,{$from},{$to});background-attachment:fixed;}"
            . self::neutraliseLoginPage();
    }

    private static function image(): string
    {
        $url = self::url();

        if ($url === null) {
            return '';
        }

        $dim = self::clamp(Theme::config('background_dim'), 0, 90, 55);
        $blur = self::clamp(Theme::config('background_blur'), 0, 24, 0);

        // Without blur the image is just another background layer, which needs no
        // assumptions about stacking. Blur cannot be applied to a background layer,
        // so that variant moves the image into a fixed pseudo element behind the
        // content - the body keeps an opaque colour, which the browser propagates
        // to the canvas, so a negative z-index still lands above it.
        if ($blur === 0) {
            $css = self::MODES . ' .fi-body{'
                . "background-image:linear-gradient(rgb(0 0 0 / {$dim}%),rgb(0 0 0 / {$dim}%)),url(\"{$url}\");"
                . 'background-size:cover,cover;background-position:center,center;'
                . 'background-attachment:fixed,fixed;background-repeat:no-repeat,no-repeat;}';
        } else {
            $css = self::MODES . ' .fi-body{background-image:none;}'
                . self::MODES . ' .fi-body::before{content:"";position:fixed;inset:0;z-index:-1;pointer-events:none;'
                . "background-image:url(\"{$url}\");background-size:cover;background-position:center;"
                . "filter:blur({$blur}px);transform:scale(1.08);}"
                . self::MODES . ' .fi-body::after{content:"";position:fixed;inset:0;z-index:-1;pointer-events:none;'
                . "background-color:rgb(0 0 0 / {$dim}%);}";
        }

        return $css . self::neutraliseLoginPage();
    }

    /**
     * The login page paints its own background over the body, so it has to be
     * cleared for any of this to show through there.
     */
    private static function neutraliseLoginPage(): string
    {
        return self::SIMPLE . '{background-color:transparent;background-image:none;}';
    }

    /**
     * A picture just for the login screen. Without one the login page keeps
     * showing whatever the panel background is.
     */
    public static function login(): string
    {
        $url = self::sanitiseUrl(self::loginSource());

        if ($url === null) {
            return '';
        }

        $dim = self::clamp(Theme::config('login_dim'), 0, 90, 45);

        // Which part of the picture survives the crop. A portrait shot of a
        // building loses its roof to a centred crop on a wide screen.
        $position = Login::position();

        return self::SIMPLE . '{'
            . "background-image:linear-gradient(rgb(0 0 0 / {$dim}%),rgb(0 0 0 / {$dim}%)),url(\"{$url}\");"
            . "background-size:cover,cover;background-position:center,{$position};"
            . 'background-attachment:fixed,fixed;background-repeat:no-repeat,no-repeat;}';
    }

    private static function loginSource(): string
    {
        $path = trim((string) Theme::config('login_image', ''));

        if ($path !== '') {
            return Storage::disk('public')->url($path);
        }

        return trim((string) Theme::config('login_image_url', ''));
    }

    /**
     * An uploaded file wins over a typed URL. Returns null when there is neither,
     * or when the value could not be trusted inside a CSS url().
     */
    private static function url(): ?string
    {
        $path = trim((string) Theme::config('background_image', ''));

        if ($path !== '') {
            return self::sanitiseUrl(Storage::disk('public')->url($path));
        }

        return self::sanitiseUrl(trim((string) Theme::config('background_image_url', '')));
    }

    private static function sanitiseUrl(string $url): ?string
    {
        // Anything that could close the url() or the <style> block is dropped
        // rather than escaped - this string is written straight into a stylesheet.
        $url = preg_replace('/[\s"\'()<>\\\\]/', '', $url) ?? '';

        if ($url === '') {
            return null;
        }

        $isRelative = str_starts_with($url, '/');
        $isAbsolute = str_starts_with($url, 'https://') || str_starts_with($url, 'http://');

        return ($isRelative || $isAbsolute) ? $url : null;
    }

    private static function clamp(mixed $value, int $min, int $max, int $fallback): int
    {
        if (!is_numeric($value)) {
            return $fallback;
        }

        return max($min, min($max, (int) $value));
    }
}
