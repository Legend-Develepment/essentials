<?php

namespace LegendDevelopment\Theme;

use App\Contracts\Plugins\HasPluginSettings;
use Filament\Contracts\Plugin;
use Filament\Enums\ThemeMode;
use Filament\Panel;
use LegendDevelopment\Theme\Filament\Admin\Pages\Announcements;
use LegendDevelopment\Theme\Filament\Admin\Pages\ThemeSettings;
use LegendDevelopment\Theme\Support\Layout;
use LegendDevelopment\Theme\Support\NavLinks;
use LegendDevelopment\Theme\Support\Palette;
use LegendDevelopment\Theme\Support\Presets;
use LegendDevelopment\Theme\Support\Settings;
use LegendDevelopment\Theme\Support\Theme;

class ThemePlugin implements HasPluginSettings, Plugin
{
    public function getId(): string
    {
        return Theme::id();
    }

    public function register(Panel $panel): void
    {
        // The Theme page is registered even with the theme switched off, so it
        // can be switched back on.
        if ($panel->getId() === 'admin') {
            $panel->pages([ThemeSettings::class, Announcements::class]);
        }

        if (Presets::isDisabled()) {
            return;
        }

        $isForced = (bool) Theme::config('force_dark', false);

        $panel
            ->colors([
                'primary' => Palette::accent(),
            ])
            ->darkMode(true, isForced: $isForced)
            ->themeSwitcher(!$isForced)
            ->defaultThemeMode(ThemeMode::Dark);

        // Pelican sets these in its own panel provider, and plugins are loaded at
        // the end of it, so this overrides rather than fights.
        $height = (float) Theme::config('logo_height', 2);

        if ($height > 0) {
            $panel->brandLogoHeight(round(max(1, min(8, $height)), 2) . 'rem');
        }

        $logo = trim((string) Theme::config('logo_url', ''));

        if ($logo !== '') {
            $panel->brandLogo($logo);
        }

        // Extra rows in this panel's navigation. Here rather than in the
        // provider because which panel this is has to be known, and the
        // argument is the one place it is not a guess.
        NavLinks::apply($panel);
    }

    public function boot(Panel $panel): void
    {
        // Here rather than in register(): Pelican sets some of these itself
        // while building the panel - the admin panel makes its sidebar
        // collapsible - and boot runs after all of that, so this is the point
        // at which a choice made in the settings actually wins.
        Layout::apply($panel);
    }

    /**
     * @return array<string, mixed>
     */
    public function getSettingsFormData(): array
    {
        return Settings::data();
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public function getSettingsForm(): array
    {
        return Settings::fields();
    }

    /**
     * @param  array<mixed, mixed>  $data
     */
    public function saveSettings(array $data): void
    {
        Settings::persist($data);
    }
}
