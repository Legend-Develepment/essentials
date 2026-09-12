<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use LegendDevelopment\Theme\Support\Cdn\Mirror;
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
            /*
             * Send the off-panel copy now, rather than waiting for the timer.
             *
             * Here and not on the storage page because it is about languages:
             * somebody who has just finished editing one wants to know it is
             * safe, and that is the moment they are looking at this page.
             */
            Action::make('mirror_push')
                ->label(fn (): string => Theme::trans('settings.files.mirror_now'))
                ->icon('tabler-cloud-upload')
                ->color('gray')
                ->visible(fn (): bool => Mirror::ready())
                ->action(function (): void {
                    $done = Mirror::push();

                    Notification::make()
                        ->title(Theme::trans('settings.files.mirror_done'))
                        ->body(Theme::trans('settings.files.mirror_done_body', [
                            'looked' => (string) $done['looked'],
                            'sent' => (string) $done['sent'],
                            'failed' => (string) $done['failed'],
                        ]))
                        ->success()
                        ->send();
                }),

            /*
             * And put it back, which is a thing somebody means rather than a
             * thing that happens to them.
             *
             * A restore writes over what is on this panel, and there is no way
             * to remove an installed language afterwards - so it asks first,
             * and it is never on a timer.
             */
            Action::make('mirror_pull')
                ->label(fn (): string => Theme::trans('settings.files.mirror_restore'))
                ->icon('tabler-cloud-download')
                ->color('gray')
                ->requiresConfirmation()
                ->modalDescription(fn (): string => Theme::trans('settings.files.mirror_restore_confirm'))
                ->visible(fn (): bool => Mirror::known() !== [])
                ->action(function (): void {
                    $done = Mirror::pull();

                    Notification::make()
                        ->title(Theme::trans('settings.files.mirror_back'))
                        ->body(Theme::trans('settings.files.mirror_back_body', [
                            'found' => (string) $done['found'],
                            'put' => (string) $done['put'],
                            'failed' => (string) $done['failed'],
                        ]))
                        ->success()
                        ->persistent()
                        ->send();
                }),

            /*
             * And take one out again, which only an uploaded language can be.
             *
             * Next to the restore rather than beside the upload field, because
             * both of these are things somebody means: one writes over what is
             * here and the other takes it away, and neither belongs among the
             * settings that a save applies.
             *
             * Hidden entirely when there is nothing it could remove, so a panel
             * that has only the languages the plugin ships never shows a button
             * whose every answer would be no.
             */
            Action::make('remove_language')
                ->label(fn (): string => Theme::trans('settings.languages.remove'))
                ->icon('tabler-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->modalDescription(fn (): string => Theme::trans('settings.languages.remove_confirm'))
                ->visible(fn (): bool => Features::mayManage(Features::LANGUAGES)
                    && Translations::uploaded() !== [])
                ->schema([
                    Select::make('code')
                        ->label(fn (): string => Theme::trans('settings.languages.remove_which'))
                        ->helperText(fn (): string => Theme::trans('settings.languages.remove_which_helper'))
                        /*
                         * Only what was uploaded, and deliberately not
                         * Languages::options(): that list holds the shipped
                         * ones too, and offering a choice that is then refused
                         * is a worse answer than not offering it.
                         */
                        ->options(fn (): array => collect(Translations::uploaded())
                            ->mapWithKeys(static fn (string $code): array => [$code => Languages::name($code)])
                            ->all())
                        ->required(),
                ])
                ->action(function (array $data): void {
                    $code = is_string($data['code'] ?? null) ? $data['code'] : '';
                    $why = Translations::remove($code);

                    if ($why !== null) {
                        Notification::make()
                            ->title(Theme::trans('settings.languages.remove_refused'))
                            ->body(Theme::trans('settings.languages.remove_refused_' . $why))
                            ->danger()
                            ->persistent()
                            ->send();

                        return;
                    }

                    // So a restore does not walk it back in an hour later.
                    Mirror::forget($code);
                    Languages::forget();

                    Notification::make()
                        ->title(Theme::trans('settings.languages.removed', ['code' => $code]))
                        ->body(Theme::trans('settings.languages.removed_body'))
                        ->success()
                        ->persistent()
                        ->send();
                }),

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
