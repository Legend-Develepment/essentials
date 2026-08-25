<?php

namespace LegendDevelopment\Theme\Support;

/**
 * Ready-made looks.
 *
 * Picking one fills in every setting below it, so it is a starting point rather
 * than a hidden layer - you can see exactly what it did and change any part of
 * it afterwards. 'none' is the off switch: the plugin then renders nothing at
 * all and the panel looks like stock Pelican.
 */
class Presets
{
    public const NONE = 'none';

    public const DEFAULT = 'ember';

    /**
     * @var array<string, array<string, mixed>>
     */
    private const PRESETS = [
        // Warm near-black with an orange accent and the theme's own aurora.
        'ember' => [
            'accent' => '#ffa500',
            'surface' => '',
            'radius' => 'normal',
            'density' => 'comfortable',
            'glass' => true,
            'glow' => true,
            'background' => 'aurora',
            'icon_stroke' => '2',
            'icon_scale' => '1',
            'icon_accent' => false,
            'bar_base' => 'green',
        ],
        // Cool blue, the calmest of the set.
        'midnight' => [
            'accent' => '#3b82f6',
            'surface' => '#141821',
            'radius' => 'normal',
            'density' => 'comfortable',
            'glass' => true,
            'glow' => true,
            'background' => 'aurora',
            'icon_stroke' => '1.25',
            'icon_scale' => '1',
            'icon_accent' => false,
            'bar_base' => 'green',
        ],
        // Tight and punchy: sharp corners, compact rows, no frosted glass.
        'crimson' => [
            'accent' => '#ef4444',
            'surface' => '#1a1214',
            'radius' => 'sharp',
            'density' => 'compact',
            'glass' => false,
            'glow' => true,
            'background' => 'aurora',
            'icon_stroke' => '2.5',
            'icon_scale' => '1',
            'icon_accent' => true,
            'bar_base' => 'green',
        ],
        // Soft green, rounded, no glow - restful for long sessions.
        'forest' => [
            'accent' => '#22c55e',
            'surface' => '#111a15',
            'radius' => 'round',
            'density' => 'comfortable',
            'glass' => true,
            'glow' => false,
            'background' => 'aurora',
            'icon_stroke' => '2',
            'icon_scale' => '1',
            'icon_accent' => false,
            'bar_base' => 'accent',
        ],
        // Purple with a gradient backdrop, the loudest of the set.
        'nebula' => [
            'accent' => '#a855f7',
            'surface' => '#17121f',
            'radius' => 'round',
            'density' => 'comfortable',
            'glass' => true,
            'glow' => true,
            'background' => 'gradient',
            'background_color' => '#120d1c',
            'background_color_end' => '#241436',
            'background_angle' => '160',
            'icon_stroke' => '1.25',
            'icon_scale' => '1.1',
            'icon_accent' => true,
            'bar_base' => 'green',
        ],
        // Greyscale, flat, dense. Nothing competes with the content.
        'mono' => [
            'accent' => '#a1a1aa',
            'surface' => '#151517',
            'radius' => 'sharp',
            'density' => 'compact',
            'glass' => false,
            'glow' => false,
            'background' => 'solid',
            'background_color' => '#0f0f11',
            'icon_stroke' => '1.25',
            'icon_scale' => '1',
            'icon_accent' => false,
            'bar_base' => 'green',
        ],
    ];

    /**
     * @return array<int, string>
     */
    public static function names(): array
    {
        return array_keys(self::PRESETS);
    }

    public static function current(): string
    {
        $preset = (string) Theme::config('preset', self::DEFAULT);

        if ($preset === self::NONE || array_key_exists($preset, self::PRESETS)) {
            return $preset;
        }

        return self::DEFAULT;
    }

    /**
     * With no preset selected the theme renders nothing: no stylesheet, no
     * colours, no scripts. The settings stay where they are, so switching back
     * restores them.
     */
    public static function isDisabled(): bool
    {
        return self::current() === self::NONE;
    }

    /**
     * Every setting a preset fills in, ready to hand to the form.
     *
     * @return array<string, mixed>
     */
    public static function values(string $preset): array
    {
        $values = self::PRESETS[$preset] ?? [];

        if ($values === []) {
            return [];
        }

        // Fields a preset does not mention are reset to their neutral value, so
        // leftovers from a previous preset cannot linger.
        return [
            'background_color' => '#14110e',
            'background_color_end' => '#2b1c08',
            'background_angle' => '160',
            'bar_warning' => Bars::DEFAULT_WARNING,
            'bar_danger' => Bars::DEFAULT_DANGER,
            'force_dark' => false,
            ...$values,
        ];
    }
}
