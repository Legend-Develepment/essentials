<?php

namespace LegendDevelopment\Theme\Support\Fields;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Toggle;
use LegendDevelopment\Theme\Support\Games\Games;
use LegendDevelopment\Theme\Support\Minecraft\Minecraft;
use LegendDevelopment\Theme\Support\Theme;

/**
 * Which eggs are which game.
 *
 * Minecraft, Ark and Valheim, together because they are the same
 * question with three answers: nothing here draws anything until somebody says
 * which of their eggs is which, and the modules page says so rather than leaving a
 * switch that looks like it works.
 *
 * Lifted out of Settings, which had every form in it and was three thousand
 * lines long. What stays there is what a setting *is*: read it, sanitise it,
 * write it. What moved here is what a setting *looks like*, which is a
 * different question and belongs next to the page that asks it.
 */
class Eggs
{
    /**
     * The Minecraft tab.
     *
     * One section today and room for more, which is the point of it having a
     * tab at all - see Filament\Admin\Pages\MinecraftSettings.
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function minecraft(): array
    {
        return [
            Part::section('minecraft', 'tabler-brand-minecraft', [
                CheckboxList::make('minecraft_eggs')
                    ->label(fn () => Theme::trans('minecraft.eggs'))
                    ->helperText(fn () => Theme::trans('minecraft.eggs_helper'))
                    ->options(fn (): array => Minecraft::eggOptions())
                    ->bulkToggleable()
                    ->searchable()
                    ->columns(['default' => 1, 'sm' => 2])
                    ->columnSpanFull(),
                Toggle::make('minecraft_live')
                    ->label(fn () => Theme::trans('minecraft.live'))
                    ->helperText(fn () => Theme::trans('minecraft.live_helper'))
                    ->columnSpanFull(),
            ])
                ->description(fn () => Theme::trans('minecraft.section_helper')),
        ];
    }

    /**
     * The other games: which eggs they are, and nothing else.
     *
     * Two questions on one page rather than a page each, for the same reason
     * the Minecraft settings are one tab: a sidebar with a row per game is a
     * sidebar about games. What is not here is any setting for the games
     * themselves - both of them are configured by their start-up variables and
     * Pelican's own Startup page already edits those.
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function games(): array
    {
        return [
            Part::section('ark', 'tabler-dna-2', [
                CheckboxList::make('ark_eggs')
                    ->label(fn () => Theme::trans('ark.eggs'))
                    ->helperText(fn () => Theme::trans('ark.eggs_helper'))
                    ->options(fn (): array => Games::eggOptions())
                    ->bulkToggleable()
                    ->searchable()
                    ->columns(['default' => 1, 'sm' => 2])
                    ->columnSpanFull(),
            ])
                ->description(fn () => Theme::trans('ark.section_helper')),
            Part::section('dontstarve', 'tabler-campfire', [
                CheckboxList::make('dontstarve_eggs')
                    ->label(fn () => Theme::trans('dontstarve.eggs'))
                    ->helperText(fn () => Theme::trans('dontstarve.eggs_helper'))
                    ->options(fn (): array => Games::eggOptions())
                    ->bulkToggleable()
                    ->searchable()
                    ->columns(['default' => 1, 'sm' => 2])
                    ->columnSpanFull(),
            ])
                ->description(fn () => Theme::trans('dontstarve.section_helper')),
            Part::section('enshrouded', 'tabler-cloud-fog', [
                CheckboxList::make('enshrouded_eggs')
                    ->label(fn () => Theme::trans('enshrouded.eggs'))
                    ->helperText(fn () => Theme::trans('enshrouded.eggs_helper'))
                    ->options(fn (): array => Games::eggOptions())
                    ->bulkToggleable()
                    ->searchable()
                    ->columns(['default' => 1, 'sm' => 2])
                    ->columnSpanFull(),
            ])
                ->description(fn () => Theme::trans('enshrouded.section_helper')),
            Part::section('factorio', 'tabler-settings-automation', [
                CheckboxList::make('factorio_eggs')
                    ->label(fn () => Theme::trans('factorio.eggs'))
                    ->helperText(fn () => Theme::trans('factorio.eggs_helper'))
                    ->options(fn (): array => Games::eggOptions())
                    ->bulkToggleable()
                    ->searchable()
                    ->columns(['default' => 1, 'sm' => 2])
                    ->columnSpanFull(),
            ])
                ->description(fn () => Theme::trans('factorio.section_helper')),
            Part::section('satisfactory', 'tabler-building-factory', [
                CheckboxList::make('satisfactory_eggs')
                    ->label(fn () => Theme::trans('satisfactory.eggs'))
                    ->helperText(fn () => Theme::trans('satisfactory.eggs_helper'))
                    ->options(fn (): array => Games::eggOptions())
                    ->bulkToggleable()
                    ->searchable()
                    ->columns(['default' => 1, 'sm' => 2])
                    ->columnSpanFull(),
            ])
                ->description(fn () => Theme::trans('satisfactory.section_helper')),
            Part::section('terraria', 'tabler-tree', [
                CheckboxList::make('terraria_eggs')
                    ->label(fn () => Theme::trans('terraria.eggs'))
                    ->helperText(fn () => Theme::trans('terraria.eggs_helper'))
                    ->options(fn (): array => Games::eggOptions())
                    ->bulkToggleable()
                    ->searchable()
                    ->columns(['default' => 1, 'sm' => 2])
                    ->columnSpanFull(),
            ])
                ->description(fn () => Theme::trans('terraria.section_helper')),
            Part::section('vrising', 'tabler-droplet', [
                CheckboxList::make('vrising_eggs')
                    ->label(fn () => Theme::trans('vrising.eggs'))
                    ->helperText(fn () => Theme::trans('vrising.eggs_helper'))
                    ->options(fn (): array => Games::eggOptions())
                    ->bulkToggleable()
                    ->searchable()
                    ->columns(['default' => 1, 'sm' => 2])
                    ->columnSpanFull(),
            ])
                ->description(fn () => Theme::trans('vrising.section_helper')),
            Part::section('onset', 'tabler-car', [
                CheckboxList::make('onset_eggs')
                    ->label(fn () => Theme::trans('onset.eggs'))
                    ->helperText(fn () => Theme::trans('onset.eggs_helper'))
                    ->options(fn (): array => Games::eggOptions())
                    ->bulkToggleable()
                    ->searchable()
                    ->columns(['default' => 1, 'sm' => 2])
                    ->columnSpanFull(),
            ])
                ->description(fn () => Theme::trans('onset.section_helper')),
            Part::section('craftopia', 'tabler-pick', [
                CheckboxList::make('craftopia_eggs')
                    ->label(fn () => Theme::trans('craftopia.eggs'))
                    ->helperText(fn () => Theme::trans('craftopia.eggs_helper'))
                    ->options(fn (): array => Games::eggOptions())
                    ->bulkToggleable()
                    ->searchable()
                    ->columns(['default' => 1, 'sm' => 2])
                    ->columnSpanFull(),
            ])
                ->description(fn () => Theme::trans('craftopia.section_helper')),
            Part::section('valheim', 'tabler-axe', [
                CheckboxList::make('valheim_eggs')
                    ->label(fn () => Theme::trans('valheim.eggs'))
                    ->helperText(fn () => Theme::trans('valheim.eggs_helper'))
                    ->options(fn (): array => Games::eggOptions())
                    ->bulkToggleable()
                    ->searchable()
                    ->columns(['default' => 1, 'sm' => 2])
                    ->columnSpanFull(),
            ])
                ->description(fn () => Theme::trans('valheim.section_helper')),
        ];
    }
}
