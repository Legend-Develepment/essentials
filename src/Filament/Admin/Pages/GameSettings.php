<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Settings;

/**
 * The other games, in one place.
 *
 * One row rather than one per game, on the same argument the Minecraft tab
 * makes: a sidebar with a row per game is a sidebar about games. ARK and Valheim
 * are two sections here, and a third game is a third section rather than
 * another row.
 *
 * It holds one question per game - which eggs are it - and that question is
 * asked rather than guessed for the reason the Minecraft page gives at length:
 * a plugin cannot know what somebody has called their egg. It is asked
 * separately from the list on the status page, which answers "does this speak
 * Valve's query" rather than "does this keep the file this page edits" - Rust
 * and Valheim both answer the first and only ARK answers the second.
 *
 * Everything a settings page does is in SettingsPage. What is its own is which
 * sections it shows and where it sits.
 */
class GameSettings extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = 'tabler-device-gamepad-2';

    protected static ?string $slug = 'essentials-games';

    protected static ?int $navigationSort = 8;

    protected static function key(): string
    {
        return Features::GAMES;
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    protected function groups(): array
    {
        return Settings::gameGroups();
    }
}
