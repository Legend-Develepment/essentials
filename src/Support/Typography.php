<?php

namespace LegendDevelopment\Theme\Support;

/**
 * The panel's own typeface.
 *
 * Sixty settings and no way to change the lettering was a real gap, and it is
 * the one thing a "terminal" look cannot be built without.
 *
 * Every stack is made of faces the operating system already has. Nothing here
 * fetches a font: a panel that reaches out to a font host on every page is a
 * panel that leaks who is looking at it and stops rendering correctly when that
 * host is unreachable, and neither is worth a nicer letter shape.
 */
class Typography
{
    public const DEFAULT = 'default';

    /**
     * The families, as CSS.
     *
     * ui-* comes first in each: on the systems that have them these are the
     * faces the rest of the operating system is set in, which is the whole point
     * of asking for a monospace or a rounded panel rather than naming one font.
     *
     * @var array<string, string>
     */
    private const FONTS = [
        self::DEFAULT => '',
        'mono' => 'ui-monospace, "SF Mono", SFMono-Regular, Menlo, Consolas, "Liberation Mono", "Courier New", monospace',
        'rounded' => 'ui-rounded, "SF Pro Rounded", "Segoe UI Variable Display", system-ui, sans-serif',
        'serif' => 'ui-serif, Georgia, Cambria, "Times New Roman", serif',
        'system' => 'system-ui, -apple-system, "Segoe UI", Roboto, sans-serif',
    ];

    public static function current(): string
    {
        $font = (string) Theme::config('font', self::DEFAULT);

        return array_key_exists($font, self::FONTS) ? $font : self::DEFAULT;
    }

    public static function sanitise(mixed $value): string
    {
        $value = is_scalar($value) ? (string) $value : '';

        return array_key_exists($value, self::FONTS) ? $value : self::DEFAULT;
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        $options = [];

        foreach (array_keys(self::FONTS) as $font) {
            $options[$font] = Theme::trans('settings.font.' . $font);
        }

        return $options;
    }

    /**
     * The whole rule, or nothing at all.
     *
     * Nothing at all for the default, and the rule rather than a custom property
     * for the rest. A property with a fallback would mean a rule that always
     * applies - and its fallback, whatever it was, would become the panel's font
     * on every install that never chose one. Emitting nothing is the only way
     * for "default" to mean Filament's own stack, untouched.
     *
     * `html body` rather than `body`, to outweigh the class Filament sets its
     * own family with, without reaching for !important.
     */
    public static function css(): string
    {
        $font = self::FONTS[self::current()] ?? '';

        return $font === '' ? '' : 'html body,html .fi-body{font-family:' . $font . ';}';
    }
}
