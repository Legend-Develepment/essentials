<?php

namespace LegendDevelopment\Theme\Support;

use Filament\Enums\ThemeMode;
use Filament\Panel;
use Throwable;

/**
 * Whether the panel opens dark, light, or however the visitor's machine is set.
 *
 * This existed as one toggle - "force dark" - which did two things at once: it
 * picked the mode and it took the switcher away. Two jobs in one switch is fine
 * while there is only one mode worth having, and this plugin has been a dark
 * theme. A light style needs the panel to open light, so the two are separated:
 * this picks, and force_dark now only locks.
 *
 * The setting key stays `force_dark` deliberately. Renaming it would reset the
 * choice on every panel that had made one, and what it does is unchanged for
 * anybody who never touches the new setting: mode defaults to dark, so an
 * install that updates behaves exactly as it did.
 */
class Mode
{
    public const DARK = 'dark';

    public const LIGHT = 'light';

    public const SYSTEM = 'system';

    private const MODES = [self::DARK, self::LIGHT, self::SYSTEM];

    public static function current(): string
    {
        $mode = (string) Theme::config('theme_mode', self::DARK);

        return in_array($mode, self::MODES, true) ? $mode : self::DARK;
    }

    public static function sanitise(mixed $value): string
    {
        $value = is_scalar($value) ? (string) $value : '';

        return in_array($value, self::MODES, true) ? $value : self::DARK;
    }

    /** Whether people may switch for themselves. */
    public static function locked(): bool
    {
        return (bool) Theme::config('force_dark', false);
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        $options = [];

        foreach (self::MODES as $mode) {
            $options[$mode] = Theme::trans('settings.mode.' . $mode);
        }

        return $options;
    }

    /**
     * Tell the panel which mode it opens in, and whether that can be changed.
     */
    public static function apply(Panel $panel): void
    {
        $mode = self::current();
        $locked = self::locked();

        /*
         * Locked to light is the one case that is not "pick a default": Filament
         * has no isForced for light, so the way to say it is to switch dark off
         * entirely. Which is also the honest description - there is no dark mode
         * on that panel, rather than one nobody may reach.
         */
        if ($mode === self::LIGHT && $locked) {
            $panel->darkMode(false);

            return;
        }

        $panel
            ->darkMode(true, isForced: $locked && $mode === self::DARK)
            ->themeSwitcher(!$locked)
            ->defaultThemeMode(self::filament($mode));
    }

    /**
     * Filament's own enum, looked up by value rather than by case name.
     *
     * ThemeMode::Dark is proven here - it is what this plugin has always set -
     * and the other two are read from the backed value instead of written as
     * constants. A case name this plugin guessed wrong would be a fatal on every
     * page; a value it guesses wrong is a fallback to dark.
     */
    private static function filament(string $mode): ThemeMode
    {
        try {
            return ThemeMode::tryFrom($mode) ?? ThemeMode::Dark;
        } catch (Throwable) {
            return ThemeMode::Dark;
        }
    }
}
