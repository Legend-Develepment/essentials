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
    /**
     * What is obviously wrong with this CSS, in a sentence, or null.
     *
     * The only place in this plugin where a typo takes the panel's styling down
     * until somebody finds it - the file goes into the page exactly as typed,
     * which is the point of it, and a stray brace therefore swallows every rule
     * after itself. The backlog has had this as a known rough edge since it was
     * written down.
     *
     * **A warning, never a refusal.** This field exists so somebody can write
     * something this plugin has not thought of, and a validator confident
     * enough to reject would eventually reject something valid. So it says what
     * it noticed and saves anyway - and it only notices two things, both of
     * which are counting rather than parsing:
     *
     *  - braces that do not balance, which is the fault that actually happens;
     *  - a comment that was opened and never closed, which swallows the rest of
     *    the file the same way and is invisible in an editor that does not
     *    colour it.
     *
     * Strings and comments are skipped while counting, because a brace inside
     * content: "}" is not a brace and neither is one in a URL.
     */
    public static function check(string $css): ?string
    {
        $depth = 0;
        $openedAt = 0;
        $line = 1;
        $length = strlen($css);

        for ($at = 0; $at < $length; $at++) {
            $char = $css[$at];

            if ($char === "\n") {
                $line++;

                continue;
            }

            // A comment runs to its close or to the end of the file, and one
            // that never closes is the second fault this looks for.
            if ($char === '/' && ($css[$at + 1] ?? '') === '*') {
                $end = strpos($css, '*/', $at + 2);

                if ($end === false) {
                    return Theme::trans('settings.css_comment', ['line' => $line]);
                }

                $line += substr_count(substr($css, $at, $end - $at), "\n");
                $at = $end + 1;

                continue;
            }

            if ($char === '"' || $char === "'") {
                $at = self::past($css, $at, $char, $line);

                continue;
            }

            if ($char === '{') {
                if ($depth === 0) {
                    $openedAt = $line;
                }

                $depth++;
            } elseif ($char === '}') {
                $depth--;

                /*
                 * More closes than opens.
                 *
                 * Reported where it happened rather than at the end, because a
                 * stray } on line 12 of a two-hundred-line file is not findable
                 * from "the braces do not balance".
                 */
                if ($depth < 0) {
                    return Theme::trans('settings.css_extra', ['line' => $line]);
                }
            }
        }

        return $depth > 0 ? Theme::trans('settings.css_unclosed', ['line' => $openedAt]) : null;
    }

    /**
     * Past the end of a quoted string, counting the lines inside it.
     *
     * A CSS string cannot span a line unescaped, but an unterminated one can
     * run to the end of the file - and this must not then read the rest of it
     * as a string and miss every brace after it. So an unterminated quote gives
     * up and returns where it started, and the counting carries on: a quote is
     * not what this check is about.
     */
    private static function past(string $css, int $at, string $quote, int &$line): int
    {
        $length = strlen($css);

        for ($i = $at + 1; $i < $length; $i++) {
            if ($css[$i] === '\\') {
                $i++;

                continue;
            }

            if ($css[$i] === "\n") {
                return $at;
            }

            if ($css[$i] === $quote) {
                return $i;
            }
        }

        return $at;
    }

    public static function style(): string
    {
        $css = self::get();

        if ($css === '') {
            return '';
        }

        return '<style>' . str_ireplace('</style', '<\\/style', $css) . '</style>';
    }
}
