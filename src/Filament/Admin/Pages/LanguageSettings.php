<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Settings;

/**
 * Which languages this plugin answers in.
 *
 * A tab rather than a section, for the same reason Minecraft has one: this is
 * the first thing about languages and not the last, and the list grows by one
 * row every time a translation is contributed.
 *
 * The tab is about the plugin and not about the panel. Pelican already lets
 * every person pick their own language, and already sets the application locale
 * from it before anything here runs - nothing on this page changes that or
 * should. What it decides is narrower and worth being clear about: which of
 * those choices this plugin's own strings will honour.
 *
 * Everything a settings page does is in SettingsPage. What is its own is which
 * sections it shows and where it sits.
 */
class LanguageSettings extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = 'tabler-language';

    protected static ?string $slug = 'essentials-languages';

    protected static ?int $navigationSort = 8;

    protected static function key(): string
    {
        return Features::LANGUAGES;
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    protected function groups(): array
    {
        return Settings::languageGroups();
    }
}
