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
}
