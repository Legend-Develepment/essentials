<?php

namespace LegendDevelopment\Theme\Support;

use Illuminate\Support\Facades\Storage;

/**
 * Builds the CSS for the page background.
 *
 * 'aurora' emits nothing at all - that is what the stylesheet already paints.
 * The other modes override the stylesheet's own `.fi-body` rule, which works
 * because this CSS is written into a <style> tag that follows the stylesheet
 * link, at equal specificity.
 */
class Background
{
    public static function css(): string
    {
        return match ((string) Theme::config('background', 'aurora')) {
            'solid' => self::solid(),
            'gradient' => self::gradient(),
            'image' => self::image(),
            default => '',
        };
    }

    private static function solid(): string
    {
        $color = Palette::sanitize(Theme::config('background_color'), '#14110e');

        return "html.dark .fi-body{background-color:{$color};background-image:none;}" . self::neutraliseLoginPage();
    }

    private static function gradient(): string
    {
        $from = Palette::sanitize(Theme::config('background_color'), '#14110e');
        $to = Palette::sanitize(Theme::config('background_color_end'), '#2b1c08');
        $angle = self::clamp(Theme::config('background_angle'), 0, 360, 160);

        return "html.dark .fi-body{background-color:{$from};background-image:linear-gradient({$angle}deg,{$from},{$to});background-attachment:fixed;}"
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
            $css = "html.dark .fi-body{"
                . "background-image:linear-gradient(rgb(0 0 0 / {$dim}%),rgb(0 0 0 / {$dim}%)),url(\"{$url}\");"
                . 'background-size:cover,cover;background-position:center,center;'
                . 'background-attachment:fixed,fixed;background-repeat:no-repeat,no-repeat;}';
        } else {
            $css = 'html.dark .fi-body{background-image:none;}'
                . 'html.dark .fi-body::before{content:"";position:fixed;inset:0;z-index:-1;pointer-events:none;'
                . "background-image:url(\"{$url}\");background-size:cover;background-position:center;"
                . "filter:blur({$blur}px);transform:scale(1.08);}"
                . 'html.dark .fi-body::after{content:"";position:fixed;inset:0;z-index:-1;pointer-events:none;'
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
        return 'html.dark .fi-simple-layout{background-color:transparent;background-image:none;}';
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

        return 'html.dark .fi-simple-layout{'
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
