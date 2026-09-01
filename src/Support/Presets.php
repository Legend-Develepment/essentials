<?php

namespace LegendDevelopment\Theme\Support;

use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

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
        // Built around the Legend Gaming logo: fire red on the left of the
        // backdrop bleeding into the electric blue on its right, chrome-white
        // headings, and the hard angular edges of the wordmark.
        'legend' => [
            'accent' => '#ef2b23',
            'surface' => '#17101a',
            'radius' => 'sharp',
            'density' => 'comfortable',
            'glass' => true,
            'glow' => true,
            'background' => 'gradient',
            'background_color' => '#1c0a0d',
            'background_color_end' => '#120f33',
            'background_angle' => '100',
            'icon_stroke' => '2.5',
            'icon_scale' => '1.1',
            'icon_accent' => true,
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
        /*
         * The four below were added because the gap in the set was never the
         * number of presets - it was the range. Everything above is a warm dark
         * panel with a different accent in it.
         */

        // Green on near-black, in the panel's own monospace. Sharp, flat, and
        // nothing lit up: a terminal is not a place with a glow in it.
        'terminal' => [
            'accent' => '#22d36b',
            'surface' => '#0d1210',
            'radius' => 'sharp',
            'density' => 'compact',
            'glass' => false,
            'glow' => false,
            'background' => 'solid',
            'background_color' => '#080b0a',
            'font' => 'mono',
            'icon_stroke' => '1.25',
            'icon_scale' => '1',
            'icon_accent' => false,
            'bar_base' => 'accent',
        ],

        // For a panel on a tablet: round, roomy, and everything big enough to
        // hit with a thumb.
        'console' => [
            'accent' => '#38bdf8',
            'surface' => '#151a22',
            'radius' => 'round',
            'density' => 'comfortable',
            'glass' => true,
            'glow' => true,
            'background' => 'aurora',
            'font' => 'rounded',
            'icon_stroke' => '2',
            'icon_scale' => '1.25',
            'icon_accent' => false,
            'bar_base' => 'green',
        ],

        // Nord, from its own palette: polar night for the surfaces, frost blue
        // for the accent. Muted on purpose - it is a scheme built to be quiet.
        'nord' => [
            'accent' => '#88c0d0',
            'surface' => '#3b4252',
            'radius' => 'normal',
            'density' => 'comfortable',
            'glass' => false,
            'glow' => false,
            'background' => 'solid',
            'background_color' => '#2e3440',
            'icon_stroke' => '1.75',
            'icon_scale' => '1',
            'icon_accent' => false,
            'bar_base' => 'accent',
        ],

        // Solarized dark, likewise: base03 behind, base02 for the cards, and
        // the cyan that scheme is known for.
        'solarized' => [
            'accent' => '#2aa198',
            'surface' => '#073642',
            'radius' => 'normal',
            'density' => 'comfortable',
            'glass' => false,
            'glow' => false,
            'background' => 'solid',
            'background_color' => '#002b36',
            'icon_stroke' => '1.75',
            'icon_scale' => '1',
            'icon_accent' => true,
            'bar_base' => 'accent',
        ],

        /*
         * The one light preset, and the reason the panel now has a mode setting
         * at all: everything else here opens dark because the plugin told it to.
         *
         * High contrast and flat on purpose. A light panel with soft shadows and
         * a glow reads as washed out in the daylight it exists for, so there is
         * neither - just ink on paper and a blue that stays legible on it.
         */
        'paper' => [
            'accent' => '#2563eb',
            'surface' => '#ffffff',
            'radius' => 'sharp',
            'density' => 'comfortable',
            'glass' => false,
            'glow' => false,
            'background' => 'solid',
            'background_color' => '#f4f4f5',
            'mode' => 'light',
            'icon_stroke' => '1.75',
            'icon_scale' => '1',
            'icon_accent' => false,
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

    /** Where a preset of your own is kept. */
    private const PATH = 'legend-theme/presets.json';

    /** Enough to be useful, few enough that the picker stays a picker. */
    public const MAX_CUSTOM = 20;

    /**
     * What a preset is made of, and so what saving one captures.
     *
     * The list a built-in preset may set, which is deliberately not every
     * setting: a preset is a look, not a backup. Which channel you follow, what
     * your announcements say and where your links point are not part of one -
     * export is the thing that carries those.
     */
    public const CAPTURED = [
        'accent', 'surface', 'radius', 'density', 'glass', 'glow', 'font', 'mode',
        'background', 'background_color', 'background_color_end', 'background_angle',
        'icon_stroke', 'icon_scale', 'icon_accent',
        'bar_base', 'bar_warning', 'bar_danger', 'force_dark',
    ];

    /** @var array<string, array<string, mixed>>|null */
    private static ?array $custom = null;

    /**
     * @return array<int, string>
     */
    public static function names(): array
    {
        return [...array_keys(self::PRESETS), ...array_keys(self::customRows())];
    }

    public static function current(): string
    {
        $preset = (string) Theme::config('preset', self::DEFAULT);

        if ($preset === self::NONE || self::exists($preset)) {
            return $preset;
        }

        return self::DEFAULT;
    }

    public static function exists(string $preset): bool
    {
        return array_key_exists($preset, self::PRESETS)
            || array_key_exists($preset, self::customRows());
    }

    public static function isCustom(string $preset): bool
    {
        return array_key_exists($preset, self::customRows());
    }

    /**
     * The name to show. Built-in presets are translated; one of your own is
     * called whatever you called it.
     */
    public static function label(string $preset): string
    {
        $rows = self::customRows();

        if (array_key_exists($preset, $rows)) {
            return (string) ($rows[$preset]['label'] ?? $preset);
        }

        return Theme::trans('settings.preset.options.' . $preset);
    }

    /* -------------------------------------------------------- your own --- */

    /**
     * Save what is on screen as a preset of your own.
     *
     * Only the fields a preset is made of, taken from what the form is holding
     * rather than from what is stored: "save this as a preset" is said about
     * what you are looking at, and it would be a poor button that saved the
     * last thing you pressed Save on instead.
     *
     * @param  array<string, mixed>  $values
     * @return string|null  The key it was stored under, or null if it could not be.
     */
    public static function saveCustom(string $label, array $values): ?string
    {
        $label = trim(mb_substr($label, 0, 40));

        if ($label === '') {
            return null;
        }

        $rows = self::customRows();
        $key = self::keyFor($label, $rows);

        if ($key === null) {
            return null;
        }

        $rows[$key] = [
            'label' => $label,
            'values' => array_intersect_key($values, array_flip(self::CAPTURED)),
        ];

        return self::write($rows) ? $key : null;
    }

    public static function deleteCustom(string $key): void
    {
        $rows = self::customRows();

        if (!array_key_exists($key, $rows)) {
            return;
        }

        unset($rows[$key]);
        self::write($rows);
    }

    /**
     * @return array<string, string>
     */
    public static function customOptions(): array
    {
        $options = [];

        foreach (self::customRows() as $key => $row) {
            $options[$key] = (string) ($row['label'] ?? $key);
        }

        return $options;
    }

    /**
     * A key that is stable, readable in .env, and cannot collide with a
     * built-in one - which would let a preset of your own quietly shadow
     * Nord and leave no way to get it back.
     *
     * @param  array<string, array<string, mixed>>  $rows
     */
    private static function keyFor(string $label, array $rows): ?string
    {
        $base = trim(preg_replace('/[^a-z0-9]+/', '-', mb_strtolower($label)) ?? '', '-');
        $base = $base === '' ? 'preset' : mb_substr($base, 0, 24);
        $key = 'my-' . $base;

        // Saving over one of your own with the same name is replacing it, which
        // is what somebody doing that means.
        if (array_key_exists($key, $rows) || count($rows) < self::MAX_CUSTOM) {
            return $key;
        }

        return null;
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private static function customRows(): array
    {
        if (self::$custom !== null) {
            return self::$custom;
        }

        self::$custom = [];

        try {
            $disk = Storage::disk('local');

            if ($disk->exists(self::PATH)) {
                $decoded = json_decode((string) $disk->get(self::PATH), true);

                if (is_array($decoded)) {
                    foreach ($decoded as $key => $row) {
                        // A key that is not ours, or a row that is not a row,
                        // is dropped rather than drawn.
                        if (is_string($key)
                            && preg_match('/^my-[a-z0-9-]{1,24}$/', $key) === 1
                            && is_array($row)
                            && is_array($row['values'] ?? null)) {
                            self::$custom[$key] = $row;
                        }
                    }
                }
            }
        } catch (Throwable $exception) {
            /*
             * Reported, not only swallowed.
             *
             * Answering "there are no custom presets" to a failure is right for
             * rendering - a panel that cannot read a file should still draw -
             * but it is indistinguishable from there genuinely being none, and
             * that silence is what made a panel quietly showing Ember instead of
             * somebody's own style impossible to explain. This runs once per
             * request, memoised above, so it cannot flood a log.
             */
            report($exception);

            self::$custom = [];
        }

        return self::$custom;
    }

    /**
     * @param  array<string, array<string, mixed>>  $rows
     */
    /**
     * Two things this used to get wrong, and both of them were silent.
     *
     * Storage::put() answers **false** when the write does not happen - an
     * unwritable directory, a disk with nothing left on it - and only throws for
     * the smaller class of problems. Catching Throwable and returning true
     * therefore reported every ordinary failure as a success.
     *
     * And the memo was filled in before the write rather than after, so for the
     * rest of that request the preset existed: the picker listed it, the form
     * showed it saved, persist() wrote its name into .env. The next request read
     * the file, found nothing, and fell back to Ember - with .env still naming a
     * style that was never written anywhere. Which is exactly the report that
     * led here.
     */
    private static function write(array $rows): bool
    {
        try {
            if (Storage::disk('local')->put(self::PATH, (string) json_encode($rows, JSON_PRETTY_PRINT)) === false) {
                report(new RuntimeException(
                    'Could not write ' . self::PATH . ' to the local disk. Check that '
                    . storage_path('app') . ' belongs to the user the panel runs as.',
                ));

                return false;
            }
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }

        // Only now. A memo filled in before the write is a promise the disk did
        // not make.
        self::$custom = $rows;

        return true;
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
        $values = self::PRESETS[$preset] ?? self::customRows()[$preset]['values'] ?? [];

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
            'font' => Typography::DEFAULT,
            'mode' => Mode::DARK,
            ...$values,
        ];
    }

    /**
     * A preset as three colours and a corner, for the picker to draw.
     *
     * From the preset's own values, so a preset added later needs no artwork -
     * which is the only version of this worth having. The one thing a name
     * cannot tell you is what the thing looks like.
     *
     * @return array{accent: string, surface: string, background: string, radius: string}|null
     */
    public static function swatch(string $preset): ?array
    {
        $values = self::PRESETS[$preset] ?? self::customRows()[$preset]['values'] ?? null;

        if (!is_array($values) || $values === []) {
            return null;
        }

        $surface = (string) ($values['surface'] ?? '');
        $background = (string) ($values['background_color'] ?? '');

        return [
            'accent' => (string) ($values['accent'] ?? '#ffa500'),
            // Empty means "follow the theme's own", which is the warm near-black
            // the default preset is built on.
            'surface' => $surface !== '' ? $surface : '#1b1714',
            'background' => $background !== '' ? $background : '#14110e',
            'radius' => match ($values['radius'] ?? 'normal') {
                'sharp' => '0',
                'round' => '999px',
                default => '3px',
            },
        ];
    }
}
