<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Settings;

/**
 * Everything about Minecraft, in one place.
 *
 * A tab of its own rather than a section on the Pages form, and that is a bet on
 * what comes next: server.properties is the first Minecraft thing here and not
 * the last, and six Minecraft rows in a sidebar is a sidebar about Minecraft.
 * One row that holds them is the arrangement that still works at six.
 *
 * Today it holds one question - which eggs are Minecraft - and that question is
 * the whole reason this cannot be guessed. The Palworld page matches on an egg
 * named "palworld", which works because there is one and it says so. Minecraft
 * has Vanilla, Paper, Purpur, Spigot, Fabric, Forge, NeoForge, Quilt and
 * whatever somebody has renamed theirs to, so the list is asked for rather than
 * assumed.
 *
 * Everything a settings page does is in SettingsPage. What is its own is which
 * sections it shows and where it sits.
 */
class MinecraftSettings extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = 'tabler-brand-minecraft';

    protected static ?string $slug = 'essentials-minecraft';

    protected static ?int $navigationSort = 7;

    protected static function key(): string
    {
        return Features::MINECRAFT;
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    protected function groups(): array
    {
        return Settings::minecraftGroups();
    }
}
