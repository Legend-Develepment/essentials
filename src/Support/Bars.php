<?php

namespace LegendDevelopment\Theme\Support;

use App\Filament\Components\Tables\Columns\ProgressBarColumn;
use App\Filament\Components\Tables\Columns\ServerEntryColumn;
use Filament\Support\Facades\FilamentColor;

/**
 * Resource meters: green until the warning threshold, amber up to the danger
 * threshold, red above it.
 *
 * Pelican's own columns call setUp() with success = the panel's *primary*
 * colour, which is why every bar renders in the accent colour rather than
 * green. That part is fixed here through configureUsing(), which the component
 * manager runs straight after setUp().
 *
 * The thresholds cannot be fixed the same way: ListServers chains
 * ->warningThresholdPercent(0.7)->dangerThresholdPercent(0.9) onto the column
 * *after* make() has configured it, so anything set here is overwritten. The
 * levels are therefore applied in the browser (resources/js/bars.js) against the
 * percentages the bars already carry. Doing both means the first paint is
 * already green rather than flashing the accent colour first.
 */
class Bars
{
    public const DEFAULT_WARNING = 50;

    public const DEFAULT_DANGER = 80;

    /**
     * Base colours, matching the panel's own success/warning/danger palettes.
     */
    public static function css(): string
    {
        $base = Theme::config('bar_base', 'green') === 'accent' ? 'primary' : 'success';

        return ':root{'
            . "--ld-bar-ok:var(--{$base}-500);"
            . '--ld-bar-warn:var(--warning-500);'
            . '--ld-bar-crit:var(--danger-500);'
            . '--ld-bar-warning:' . self::warning() . ';'
            . '--ld-bar-danger:' . self::danger() . ';'
            . '}';
    }

    public static function register(): void
    {
        foreach ([ProgressBarColumn::class, ServerEntryColumn::class] as $column) {
            if (!class_exists($column)) {
                continue;
            }

            $column::configureUsing(static function (object $column): void {
                // Closures, so the colours resolve per panel at render time.
                $column
                    ->color(static fn () => self::color(
                        Theme::config('bar_base', 'green') === 'accent' ? 'primary' : 'success',
                        '#22c55e',
                    ))
                    ->warningColor(static fn () => self::color('warning', '#f59e0b'))
                    ->dangerColor(static fn () => self::color('danger', '#ef4444'));
            });
        }
    }

    public static function warning(): int
    {
        $warning = self::clamp(Theme::config('bar_warning'), self::DEFAULT_WARNING);

        // A warning level at or above the danger level would never be reached.
        return min($warning, self::danger() - 1);
    }

    public static function danger(): int
    {
        return self::clamp(Theme::config('bar_danger'), self::DEFAULT_DANGER);
    }

    /**
     * @return string|array<int|string, int|string>
     */
    private static function color(string $name, string $fallback): string|array
    {
        return FilamentColor::getColor($name) ?? $fallback;
    }

    private static function clamp(mixed $value, int $fallback): int
    {
        if (!is_numeric($value)) {
            return $fallback;
        }

        return max(2, min(99, (int) $value));
    }
}
