<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use LegendDevelopment\Theme\Support\Settings;

/**
 * One of the settings pages. Everything it does is in SettingsPage; all that is
 * its own is which sections it shows and where it sits in the sidebar.
 */
class PanelPages extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = 'tabler-layout-navbar';

    protected static ?string $slug = 'essentials-pages';

    protected static ?int $navigationSort = 3;

    protected static function key(): string
    {
        return 'pages';
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    protected function groups(): array
    {
        return Settings::pageGroups();
    }
}
