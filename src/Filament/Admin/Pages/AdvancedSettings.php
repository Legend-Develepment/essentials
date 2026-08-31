<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use LegendDevelopment\Theme\Support\Settings;

/**
 * One of the settings pages. Everything it does is in SettingsPage; all that is
 * its own is which sections it shows and where it sits in the sidebar.
 */
class AdvancedSettings extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = 'tabler-code';

    protected static ?string $slug = 'essentials-advanced';

    protected static ?int $navigationSort = 4;

    protected static function key(): string
    {
        return 'advanced';
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    protected function groups(): array
    {
        return Settings::advancedGroups();
    }
}
