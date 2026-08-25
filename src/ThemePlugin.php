<?php

namespace LegendDevelopment\Theme;

use App\Contracts\Plugins\HasPluginSettings;
use Filament\Contracts\Plugin;
use Filament\Enums\ThemeMode;
use Filament\Panel;
use LegendDevelopment\Theme\Filament\Admin\Pages\ThemeSettings;
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
            $panel->pages([ThemeSettings::class]);
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
    }

    public function boot(Panel $panel): void
    {
        //
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
