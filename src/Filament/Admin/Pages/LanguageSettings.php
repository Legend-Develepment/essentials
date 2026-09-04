<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Languages;
use LegendDevelopment\Theme\Support\Settings;
use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Support\Translations;

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
     * The download, as a button on the page rather than inside the form.
     *
     * It was in the form's own schema, which is the wrong place for two
     * reasons. An action there rendered as a bare icon with no words on it -
     * which is not a button anybody would press on purpose - and it returns a
     * response, which is a header action's normal job and an odd thing to hand
     * back from the middle of a form that is about to re-render.
     *
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('download_language')
                ->label(fn (): string => Theme::trans('settings.languages.download'))
                ->icon('tabler-file-download')
                ->color('gray')
                ->schema([
                    Select::make('from')
                        ->label(fn (): string => Theme::trans('settings.languages.download_from'))
                        ->helperText(fn (): string => Theme::trans('settings.languages.download_from_helper'))
                        ->options(fn (): array => Languages::options())
                        ->default(Languages::BASE)
                        ->selectablePlaceholder(false),
                ])
                ->action(function (array $data) {
                    $code = is_string($data['from'] ?? null) ? $data['from'] : Languages::BASE;

                    /*
                     * Streamed rather than written anywhere. The file is built
                     * from what is already in memory, so putting it on disk
                     * first would only make something to clean up afterwards.
                     */
                    return response()->streamDownload(
                        fn () => print Translations::json($code),
                        Theme::id() . '-' . $code . '.json',
                        ['Content-Type' => 'application/json'],
                    );
                }),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    protected function groups(): array
    {
        return Settings::languageGroups();
    }
}
