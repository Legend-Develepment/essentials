<?php

namespace LegendDevelopment\Theme\Support;

use Filament\Support\Colors\Color;

/**
 * Builds a Filament colour ramp around a single accent colour.
 *
 * Filament's own Color::hex() keeps only the hue of the colour you give it and
 * pins every shade to a fixed lightness/chroma, so #ffa500 would never actually
 * appear in the panel. This ramp anchors the accent at shade 500 and derives the
 * rest from it, which keeps the configured colour exact.
 */
class Palette
{
    public const DEFAULT_ACCENT = '#ffa500';

    /**
     * Lightness offset and chroma multiplier per shade, relative to the accent.
     *
     * @var array<int, array{float, float}>
     */
    private const RAMP = [
        50 => [0.19, 0.12],
        100 => [0.16, 0.25],
        200 => [0.12, 0.45],
        300 => [0.08, 0.7],
        400 => [0.04, 0.88],
        500 => [0.0, 1.0],
        600 => [-0.09, 0.97],
        700 => [-0.18, 0.88],
        800 => [-0.3, 0.74],
        900 => [-0.38, 0.6],
        // Deep enough that Filament can pick it as accessible text on a 500/600
        // background - it resolves those pairings from this palette at runtime.
        950 => [-0.55, 0.35],
    ];

    /**
     * The configured accent as a full palette.
     *
     * @return array<int, string>
     */
    public static function accent(): array
    {
        return self::fromHex(self::sanitize(Theme::config('accent')));
    }

    /**
     * @return array<int, string>
     */
    public static function fromHex(string $color): array
    {
        $oklch = sscanf(Color::convertToOklch(self::sanitize($color)), 'oklch(%f %f %f)');

        // convertToOklch() returns 'oklch(l c h)' for every supported input, but
        // fall back to the default accent rather than emitting broken CSS.
        if (!is_array($oklch) || count($oklch) < 3) {
            $oklch = [0.7896, 0.1652, 70.08];
        }

        [$lightness, $chroma, $hue] = $oklch;

        $hue = round((float) $hue, 3);

        return array_map(function (array $shade) use ($lightness, $chroma, $hue): string {
            [$lightnessOffset, $chromaMultiplier] = $shade;

            $shadeLightness = round(max(0.1, min(0.99, (float) $lightness + $lightnessOffset)), 4);
            $shadeChroma = round(max(0.0, (float) $chroma * $chromaMultiplier), 4);

            return "oklch($shadeLightness $shadeChroma $hue)";
        }, self::RAMP);
    }

    /**
     * The accent ramp as the custom properties Filament reads.
     *
     * Filament is handed this same array through $panel->colors() and writes
     * each shade out as --primary-<n>, so restating them here restates exactly
     * what it would have written - which is what lets a person's own accent
     * reach Filament's own buttons and not only this theme's chrome.
     */
    public static function variables(string $accent): string
    {
        $css = '';

        foreach (self::fromHex($accent) as $shade => $colour) {
            $css .= '--primary-' . $shade . ':' . $colour . ';';
        }

        return $css === '' ? '' : ':root{' . $css . '}';
    }

    /**
     * The same colour, lighter or darker. Used to derive a raised and a sunken
     * surface from the single colour someone picks for an area.
     */
    public static function shift(string $color, float $lightness): string
    {
        $oklch = sscanf(Color::convertToOklch(self::sanitize($color)), 'oklch(%f %f %f)');

        if (!is_array($oklch) || count($oklch) < 3) {
            return self::sanitize($color);
        }

        [$l, $c, $h] = $oklch;

        $l = round(max(0.03, min(0.99, (float) $l + $lightness)), 4);

        return 'oklch(' . $l . ' ' . round((float) $c, 4) . ' ' . round((float) $h, 3) . ')';
    }

    /**
     * Normalise user input to a six digit hex colour. Anything the browser (or
     * Filament) could not parse falls back - which matters beyond tidiness,
     * because these values are written straight into a stylesheet.
     */
    public static function sanitize(mixed $color, ?string $fallback = null): string
    {
        $fallback ??= self::DEFAULT_ACCENT;

        if (!is_string($color)) {
            return $fallback;
        }

        $color = ltrim(trim($color), '#');

        if (preg_match('/^[0-9a-f]{3}$/i', $color)) {
            $color = $color[0] . $color[0] . $color[1] . $color[1] . $color[2] . $color[2];
        }

        if (!preg_match('/^[0-9a-f]{6}$/i', $color)) {
            return $fallback;
        }

        return '#' . strtolower($color);
    }

    /**
     * The surface an accent is read against when nothing has been chosen.
     *
     * These two are the theme's own defaults, and they are written out here
     * rather than read from the stylesheet because CSS is not something PHP can
     * ask. They have to stay in step with `--ld-raised` in theme.css - light is
     * #fff, dark is the raised surface derived from #1c1917, which is the same
     * fallback ThemeServiceProvider uses when no surface is set.
     */
    public const PAPER = '#ffffff';

    public const INK = '#1c1917';

    /**
     * How readable one colour is on another, as WCAG counts it.
     *
     * Returns the contrast ratio, 1 (identical) to 21 (black on white). 4.5 is
     * the threshold for body text, 3 for large text; below 3 an accent is not
     * being read, it is being guessed at.
     *
     * Done in sRGB rather than in the OKLCH the ramp is built in, deliberately.
     * OKLCH lightness describes how light a colour looks, which is the useful
     * thing for deriving a ramp, and WCAG's ratio is a different measure with
     * its own weighting per channel. Using the perceptual number here would give
     * a figure that sounds like a contrast ratio and is not one.
     */
    public static function contrast(string $a, string $b): float
    {
        $first = self::luminance($a);
        $second = self::luminance($b);

        $light = max($first, $second);
        $dark = min($first, $second);

        return round(($light + 0.05) / ($dark + 0.05), 2);
    }

    /**
     * Relative luminance of a hex colour, per WCAG 2.
     */
    private static function luminance(string $hex): float
    {
        $hex = ltrim(self::sanitize($hex), '#');

        $channel = static function (int $value): float {
            $c = $value / 255;

            return $c <= 0.03928
                ? $c / 12.92
                : (($c + 0.055) / 1.055) ** 2.4;
        };

        return 0.2126 * $channel((int) hexdec(substr($hex, 0, 2)))
            + 0.7152 * $channel((int) hexdec(substr($hex, 2, 2)))
            + 0.0722 * $channel((int) hexdec(substr($hex, 4, 2)));
    }

    /**
     * How readable the accent will be, per mode.
     *
     * Returns the contrast ratio of accent text on the surface it lands on, for
     * a dark panel and a light one. Below 3 is the number that matters: the
     * accent is used for buttons, borders, icons and links rather than for
     * paragraphs, which is what WCAG calls a user interface component, and 3 is
     * its threshold for those.
     *
     * **The shade, not the colour that was typed.** That distinction is the
     * whole reason this is more than four lines. #ffa500 measured against white
     * scores 1.97, which sounds like a verdict and is not one - the panel never
     * paints that colour on white. It paints shade 600, nine points of OKLCH
     * lightness darker, which scores 2.73. Against a dark panel it paints shade
     * 400 and scores 10.03. Warning on the colour as entered would have called
     * the theme's own default unreadable in the mode where it is fine.
     *
     * Which is also why the default does not trip this: the panel opens dark
     * unless told otherwise, and only somebody who has moved it to light gets
     * told that orange is hard to read there - which is true, and useful, and
     * the only moment it is worth saying.
     *
     * @return array{dark: float, light: float}
     */
    public static function readability(string $accent, string $surface = ''): array
    {
        $accent = self::sanitize($accent);
        $surface = self::sanitize($surface, '');

        // A surface of one's own applies to both modes, so it stands in for
        // both defaults. The raised surface a card actually uses is a shade off
        // this, which is not enough to move a ratio into or out of trouble.
        $dark = $surface === '' ? self::INK : $surface;
        $light = $surface === '' ? self::PAPER : $surface;

        return [
            'dark' => self::contrast(self::shade($accent, 400), $dark),
            'light' => self::contrast(self::shade($accent, 600), $light),
        ];
    }

    /**
     * One shade of the ramp, as a hex colour.
     *
     * fromHex() builds the ramp in OKLCH because that is what goes into the
     * stylesheet. Reading a contrast ratio needs sRGB, so this walks the same
     * offsets and converts back.
     */
    public static function shade(string $accent, int $shade): string
    {
        [$lightness, $chroma, $hue] = self::oklch(self::sanitize($accent));

        [$lightnessOffset, $chromaMultiplier] = self::RAMP[$shade] ?? [0.0, 1.0];

        return self::hex(
            max(0.1, min(0.99, $lightness + $lightnessOffset)),
            max(0.0, $chroma * $chromaMultiplier),
            $hue,
        );
    }

    /**
     * A hex colour as OKLCH.
     *
     * Its own conversion rather than Filament's, so that this and hex() below
     * are one pair that round-trips exactly - checked against #ffa500, #4f46e5,
     * #1f6feb, #f5f5f5 and black, each of which comes back unchanged. Mixing one
     * library's forward conversion with another's reverse gives a colour that is
     * nearly right, and "nearly" is not a thing to build a warning on.
     *
     * @return array{0: float, 1: float, 2: float}
     */
    private static function oklch(string $hex): array
    {
        $hex = ltrim($hex, '#');

        $linear = static function (int $value): float {
            $c = $value / 255;

            return $c <= 0.04045 ? $c / 12.92 : (($c + 0.055) / 1.055) ** 2.4;
        };

        $r = $linear((int) hexdec(substr($hex, 0, 2)));
        $g = $linear((int) hexdec(substr($hex, 2, 2)));
        $b = $linear((int) hexdec(substr($hex, 4, 2)));

        $l = ($r * 0.4122214708 + $g * 0.5363325363 + $b * 0.0514459929) ** (1 / 3);
        $m = ($r * 0.2119034982 + $g * 0.6806995451 + $b * 0.1073969566) ** (1 / 3);
        $s = ($r * 0.0883024619 + $g * 0.2817188376 + $b * 0.6299787005) ** (1 / 3);

        $lightness = 0.2104542553 * $l + 0.7936177850 * $m - 0.0040720468 * $s;
        $a = 1.9779984951 * $l - 2.4285922050 * $m + 0.4505937099 * $s;
        $bb = 0.0259040371 * $l + 0.7827717662 * $m - 0.8086757660 * $s;

        $hue = atan2($bb, $a) * 180 / M_PI;

        return [$lightness, sqrt($a * $a + $bb * $bb), $hue < 0 ? $hue + 360 : $hue];
    }

    /**
     * OKLCH back to a hex colour, clamped into sRGB.
     */
    private static function hex(float $lightness, float $chroma, float $hue): string
    {
        $a = $chroma * cos($hue * M_PI / 180);
        $b = $chroma * sin($hue * M_PI / 180);

        $l = ($lightness + 0.3963377774 * $a + 0.2158037573 * $b) ** 3;
        $m = ($lightness - 0.1055613458 * $a - 0.0638541728 * $b) ** 3;
        $s = ($lightness - 0.0894841775 * $a - 1.2914855480 * $b) ** 3;

        $channels = [
            4.0767416621 * $l - 3.3077115913 * $m + 0.2309699292 * $s,
            -1.2684380046 * $l + 2.6097574011 * $m - 0.3413193965 * $s,
            -0.0041960863 * $l - 0.7034186147 * $m + 1.7076147010 * $s,
        ];

        $hex = '';

        foreach ($channels as $channel) {
            $channel = $channel <= 0.0031308
                ? 12.92 * $channel
                : 1.055 * ($channel ** (1 / 2.4)) - 0.055;

            $hex .= str_pad(
                dechex((int) round(max(0.0, min(1.0, $channel)) * 255)),
                2,
                '0',
                STR_PAD_LEFT,
            );
        }

        return '#' . $hex;
    }
}
