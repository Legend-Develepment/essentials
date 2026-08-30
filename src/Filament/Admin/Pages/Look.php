<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use LegendDevelopment\Theme\Support\Settings;

/**
 * One of the settings pages. Everything it does is in SettingsPage; all that is
 * its own is which sections it shows and where it sits in the sidebar.
 */
class Look extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = 'tabler-palette';

    protected static ?string $slug = 'essentials-look';

    protected static ?int $navigationSort = 2;

    protected static function key(): string
    {
        return 'look';
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    protected function groups(): array
    {
        return Settings::lookGroups();
    }
}
