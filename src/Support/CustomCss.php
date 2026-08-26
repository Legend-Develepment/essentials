<?php

namespace LegendDevelopment\Theme\Support;

use Illuminate\Support\Facades\Storage;
use Throwable;

/**
 * Free-form CSS, written by an administrator and injected last.
 *
 * It lives in storage rather than in .env: stylesheets are multi-line and full
 * of characters dotenv would mangle. Everything the theme emits comes before it,
 * so anything written here wins without needing !important.
 */
class CustomCss
{
    public const MAX_BYTES = 102400;

    private const PATH = 'legend-theme/custom.css';

    private static ?string $cached = null;

    public static function get(): string
    {
        if (self::$cached !== null) {
            return self::$cached;
        }

        try {
            $disk = Storage::disk('local');

            self::$cached = $disk->exists(self::PATH) ? (string) $disk->get(self::PATH) : '';
        } catch (Throwable) {
            self::$cached = '';
        }

        return self::$cached;
    }

    public static function put(string $css): void
    {
        $css = trim($css);

        if (strlen($css) > self::MAX_BYTES) {
            $css = substr($css, 0, self::MAX_BYTES);
        }

        try {
            Storage::disk('local')->put(self::PATH, $css);
        } catch (Throwable) {
            // Nothing to do - the setting simply does not stick, and the panel
            // keeps rendering.
        }

        self::$cached = $css;
    }

    /**
     * A closing tag inside the stylesheet would end the style element early and
     * spill the rest into the document as markup, so that one sequence is broken
     * up. It is the only thing that needs escaping in a CSS context.
     */
    public static function style(): string
    {
        $css = self::get();

        if ($css === '') {
            return '';
        }

        return '<style>' . str_ireplace('</style', '<\\/style', $css) . '</style>';
    }
}
