<?php

namespace LegendDevelopment\Theme\Support\Fields;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\ServerConsole;
use LegendDevelopment\Theme\Support\ServerControls;
use LegendDevelopment\Theme\Support\ServerList;
use LegendDevelopment\Theme\Support\Terminal;
use LegendDevelopment\Theme\Support\Theme;

/**
 * The Panel pages form: what a server's own pages show.
 *
 * The server list, the page a server opens on, the console and the
 * meters. Grouped by the page that draws them rather than by what they change,
 * which is the same seam the sidebar uses.
 *
 * Lifted out of Settings, which had every form in it and was three thousand
 * lines long. What stays there is what a setting *is*: read it, sanitise it,
 * write it. What moved here is what a setting *looks like*, which is a
 * different question and belongs next to the page that asks it.
 */
class Pages
{
    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function groups(): array
    {
        return [
            Part::section('servers', 'tabler-server', self::serverFields())
                ->description(fn () => Theme::trans('settings.groups.servers_helper'))
                ->columns(['default' => 1, 'sm' => 2]),
            Part::section('server_pages', 'tabler-layout-navbar', self::serverPageFields())
                ->description(fn () => Theme::trans('settings.groups.server_pages_helper'))
                ->columns(['default' => 1, 'sm' => 2])
                ->collapsed(),
            Part::section('console', 'tabler-terminal-2', self::consoleFields())
                ->description(fn () => Theme::trans('settings.groups.console_helper'))
                ->columns(['default' => 1, 'sm' => 2])
                ->collapsed(),
            // Out of sight while the meters are switched off. What it holds is
            // kept on save: see the footer section on the Look page.
            Part::section('bars', 'tabler-chart-bar', self::barFields())
                ->description(fn () => Theme::trans('settings.groups.bars_helper'))
                ->visible(fn (): bool => Features::enabled(Features::BARS))
                ->columns(['default' => 1, 'sm' => 2, 'lg' => 3])
                ->collapsed(),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function barFields(): array
    {
        return [
            Select::make('bar_base')
                ->label(fn () => Theme::trans('settings.bars.base'))
                ->options(fn () => [
                    'green' => Theme::trans('settings.bars.base_green'),
                    'accent' => Theme::trans('settings.bars.base_accent'),
                ])
                ->selectablePlaceholder(false),
            TextInput::make('bar_warning')
                ->label(fn () => Theme::trans('settings.bars.warning'))
                ->numeric()
                ->minValue(2)
                ->maxValue(98)
                ->suffix('%'),
            TextInput::make('bar_danger')
                ->label(fn () => Theme::trans('settings.bars.danger'))
                ->numeric()
                ->minValue(3)
                ->maxValue(99)
                ->suffix('%'),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function serverFields(): array
    {
        return [
            Select::make('server_art')
                ->label(fn () => Theme::trans('settings.servers.art'))
                ->helperText(fn () => Theme::trans('settings.servers.art_helper'))
                ->options(fn () => ServerList::artworkOptions())
                ->selectablePlaceholder(false)
                ->required()
                ->live(),
            TextInput::make('server_art_dim')
                ->label(fn () => Theme::trans('settings.servers.art_dim'))
                ->helperText(fn () => Theme::trans('settings.servers.art_dim_helper'))
                ->numeric()
                ->minValue(0)
                ->maxValue(80)
                ->suffix('%')
                // Only the cover uses it; the faded wash has a dim of its own.
                ->visible(fn (Get $get): bool => $get('server_art') === 'cover'),
            Select::make('server_status')
                ->label(fn () => Theme::trans('settings.servers.status'))
                ->helperText(fn () => Theme::trans('settings.servers.status_helper'))
                ->options(fn () => ServerList::statusOptions())
                ->selectablePlaceholder(false)
                ->required(),
            Select::make('server_density')
                ->label(fn () => Theme::trans('settings.servers.density'))
                ->options(fn () => ServerList::densityOptions())
                ->selectablePlaceholder(false)
                ->required(),
            Toggle::make('server_filter_label')
                ->label(fn () => Theme::trans('settings.servers.filter_label'))
                ->helperText(fn () => Theme::trans('settings.servers.filter_label_helper'))
                ->columnSpanFull(),
            Select::make('server_columns')
                ->label(fn () => Theme::trans('settings.servers.columns'))
                ->helperText(fn () => Theme::trans('settings.servers.columns_helper'))
                ->options(fn () => ServerList::columnOptions())
                ->selectablePlaceholder(false)
                ->required()
                ->columnSpanFull(),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function serverPageFields(): array
    {
        return [
            Select::make('server_controls')
                ->label(fn () => Theme::trans('settings.controls.mode'))
                ->helperText(fn () => Theme::trans('settings.controls.mode_helper'))
                ->options(fn () => ServerControls::options())
                ->selectablePlaceholder(false)
                ->live()
                ->required()
                ->columnSpanFull(),

            Select::make('server_controls_position')
                ->label(fn () => Theme::trans('settings.controls.position'))
                ->helperText(fn () => Theme::trans('settings.controls.position_helper'))
                ->options(fn () => ServerControls::positionOptions())
                ->selectablePlaceholder(false)
                ->required()
                ->visible(fn (Get $get): bool => $get('server_controls') !== ServerControls::OFF),

            Select::make('server_controls_label')
                ->label(fn () => Theme::trans('settings.controls.label'))
                ->options(fn () => ServerControls::labelOptions())
                ->selectablePlaceholder(false)
                ->required()
                ->visible(fn (Get $get): bool => $get('server_controls') !== ServerControls::OFF),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function consoleFields(): array
    {
        return [
            Select::make('console_stats')
                ->label(fn () => Theme::trans('settings.console.stats'))
                ->helperText(fn () => Theme::trans('settings.console.stats_helper'))
                ->options(fn () => ServerConsole::statsOptions())
                ->selectablePlaceholder(false)
                ->required()
                ->columnSpanFull(),

            // The terminal is a different thing from the page around it - these
            // reach xterm, everything above reaches the browser - so they are
            // set apart rather than mixed into the same run of dropdowns.
            Section::make(fn () => Theme::trans('settings.areas.names.terminal'))
                ->description(fn () => Theme::trans('settings.terminal.helper'))
                ->columns(['default' => 1, 'sm' => 2])
                ->columnSpanFull()
                ->schema([
                    Select::make('terminal_renderer')
                        ->label(fn () => Theme::trans('settings.terminal.renderer'))
                        ->helperText(fn () => Theme::trans('settings.terminal.renderer_helper'))
                        ->options(fn () => Terminal::rendererOptions())
                        ->selectablePlaceholder(false)
                        ->required()
                        ->columnSpanFull(),

                    Select::make('terminal_scheme')
                        ->label(fn () => Theme::trans('settings.terminal.scheme'))
                        ->helperText(fn () => Theme::trans('settings.terminal.scheme_helper'))
                        ->options(fn () => Terminal::schemeOptions())
                        ->selectablePlaceholder(false)
                        ->required()
                        ->columnSpanFull(),

                    Select::make('terminal_cursor')
                        ->label(fn () => Theme::trans('settings.terminal.cursor'))
                        ->helperText(fn () => Theme::trans('settings.terminal.cursor_helper'))
                        ->options(fn () => Terminal::cursorOptions())
                        ->selectablePlaceholder(false)
                        ->required(),

                    Select::make('terminal_scrollback')
                        ->label(fn () => Theme::trans('settings.terminal.scrollback'))
                        ->helperText(fn () => Theme::trans('settings.terminal.scrollback_helper'))
                        ->options(fn () => Terminal::scrollbackOptions())
                        ->selectablePlaceholder(false)
                        ->required(),

                    Toggle::make('terminal_blink')
                        ->label(fn () => Theme::trans('settings.terminal.blink'))
                        ->columnSpanFull(),
                ]),
        ];
    }
}
