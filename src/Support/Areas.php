<?php

namespace LegendDevelopment\Theme\Support;

/**
 * Per-area overrides on top of the global settings.
 *
 * The whole theme is driven by custom properties, so overriding an area is a
 * matter of redefining those properties inside a narrower selector - every rule
 * in the stylesheet then follows along, including anything Filament renders
 * inside that area.
 *
 * Which area a page belongs to is decided from the URL by a small inline script
 * in the head (see script()), because Filament only gives resource pages a class
 * of their own and the console page has none. Stamping it before first paint
 * avoids the flash a deferred module would cause, and it survives SPA
 * navigation.
 */
class Areas
{
    /**
     * @var array<string, string>
     */
    private const SELECTORS = [
        // The console itself, on whichever page it is rendered.
        'terminal' => '#terminal,div:has(> #send-command)',
        'console' => "html[data-ld-area='console'] .fi-page",
        'files' => "html[data-ld-area='files'] .fi-page",
        'edit' => "html[data-ld-area='edit'] .fi-page",
        'server' => "html[data-ld-area='server'] .fi-page",
    ];

    /**
     * The tokens the stylesheet derives from the accent, repeated verbatim so
     * they recompute against a scoped --primary-*.
     */
    private const DERIVED_FROM_ACCENT =
        '--ld-tint-subtle:color-mix(in oklab, var(--primary-500) 6%, transparent);'
        . '--ld-tint:color-mix(in oklab, var(--primary-500) 12%, transparent);'
        . '--ld-hairline:color-mix(in oklab, var(--primary-500) 14%, transparent);'
        . '--ld-border:color-mix(in oklab, var(--primary-500) 13%, transparent);'
        . '--ld-border-strong:color-mix(in oklab, var(--primary-500) 28%, transparent);'
        . '--ld-glow:0 6px 20px -10px color-mix(in oklab, var(--primary-500) 60%, transparent);'
        . '--ld-glow-strong:0 10px 30px -10px color-mix(in oklab, var(--primary-500) 70%, transparent);'
        . '--ld-surface:color-mix(in oklab, var(--gray-900) 94%, var(--primary-950) 6%);';

    public const RADII = [
        'sharp' => ['0.35rem', '0.25rem'],
        'normal' => ['1rem', '0.7rem'],
        'round' => ['1.5rem', '1rem'],
    ];

    /**
     * @return array<int, string>
     */
    public static function names(): array
    {
        return array_keys(self::SELECTORS);
    }

    public static function css(): string
    {
        $css = '';

        foreach (self::overrides() as $area => $override) {
            $selector = self::SELECTORS[$area] ?? null;

            if ($selector === null) {
                continue;
            }

            $declarations = self::declarations($override);

            if ($declarations === '') {
                continue;
            }

            $css .= $selector . '{' . $declarations . '}';
        }

        return $css;
    }

    /**
     * @return array<string, array<string, string>>
     */
    public static function overrides(): array
    {
        $areas = [];

        foreach (explode('|', (string) Theme::config('areas', '')) as $chunk) {
            [$area, $settings] = array_pad(explode(':', $chunk, 2), 2, null);

            $area = is_string($area) ? trim($area) : '';

            if (!array_key_exists($area, self::SELECTORS) || !is_string($settings)) {
                continue;
            }

            $areas[$area] = self::parseSettings($settings);
        }

        return $areas;
    }

    /**
     * @param  array<mixed, mixed>  $rows
     */
    public static function toStorage(array $rows): string
    {
        $chunks = [];

        foreach ($rows as $row) {
            if (!is_array($row)) {
                continue;
            }

            $area = is_string($row['area'] ?? null) ? $row['area'] : '';

            if (!array_key_exists($area, self::SELECTORS)) {
                continue;
            }

            $settings = [];

            foreach (['accent', 'surface'] as $key) {
                $value = $row[$key] ?? null;

                if (is_string($value) && trim($value) !== '') {
                    $settings[] = $key . '=' . ltrim(Palette::sanitize($value), '#');
                }
            }

            if (array_key_exists($row['radius'] ?? '', self::RADII)) {
                $settings[] = 'radius=' . $row['radius'];
            }

            if (in_array($row['density'] ?? null, ['comfortable', 'compact'], true)) {
                $settings[] = 'density=' . $row['density'];
            }

            if ($settings === []) {
                continue;
            }

            $chunks[$area] = $area . ':' . implode(',', $settings);
        }

        return implode('|', $chunks);
    }

    /**
     * The stored form, as rows for the repeater.
     *
     * @return array<int, array<string, string>>
     */
    public static function rows(): array
    {
        $rows = [];

        foreach (self::overrides() as $area => $override) {
            $rows[] = [
                'area' => $area,
                'accent' => isset($override['accent']) ? '#' . $override['accent'] : null,
                'surface' => isset($override['surface']) ? '#' . $override['surface'] : null,
                'radius' => $override['radius'] ?? null,
                'density' => $override['density'] ?? null,
            ];
        }

        return $rows;
    }

    /**
     * @param  array<string, string>  $override
     */
    private static function declarations(array $override): string
    {
        $css = '';

        if (isset($override['accent'])) {
            foreach (Palette::fromHex($override['accent']) as $shade => $value) {
                $css .= "--primary-{$shade}:{$value};";
            }

            // A custom property is substituted where it is declared, not where it
            // is used, so every token derived from the accent has to be declared
            // again inside this scope to pick up the new one.
            $css .= self::DERIVED_FROM_ACCENT;
        }

        if (isset($override['surface'])) {
            $surface = Palette::sanitize($override['surface']);

            $css .= '--ld-surface:' . $surface . ';';
            $css .= '--ld-raised:' . Palette::shift($surface, 0.035) . ';';
            $css .= '--ld-sunken:' . Palette::shift($surface, -0.03) . ';';
        }

        if (isset($override['radius'], self::RADII[$override['radius']])) {
            [$radius, $small] = self::RADII[$override['radius']];

            $css .= "--ld-radius:{$radius};--ld-radius-sm:{$small};";
        }

        if (isset($override['density'])) {
            $css .= '--ld-density:' . ($override['density'] === 'compact' ? '0.72' : '1') . ';';
        }

        return $css;
    }

    /**
     * @return array<string, string>
     */
    private static function parseSettings(string $settings): array
    {
        $parsed = [];

        foreach (explode(',', $settings) as $pair) {
            [$key, $value] = array_pad(explode('=', $pair, 2), 2, null);

            $key = is_string($key) ? trim($key) : '';
            $value = is_string($value) ? trim($value) : '';

            if ($value === '') {
                continue;
            }

            $parsed[$key] = match ($key) {
                'accent', 'surface' => ltrim(Palette::sanitize($value), '#'),
                'radius' => array_key_exists($value, self::RADII) ? $value : '',
                'density' => in_array($value, ['comfortable', 'compact'], true) ? $value : '',
                default => '',
            };

            if ($parsed[$key] === '') {
                unset($parsed[$key]);
            }
        }

        return $parsed;
    }
}
