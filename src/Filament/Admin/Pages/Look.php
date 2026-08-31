<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Presets;
use LegendDevelopment\Theme\Support\Settings;
use LegendDevelopment\Theme\Support\Theme;

/**
 * Colour, shape and branding - and where a look of your own is made.
 *
 * Everything a settings page does is in SettingsPage. What is its own is which
 * sections it shows, where it sits in the sidebar, and the two buttons for
 * keeping a preset: this is the page the style picker is on, so it is the page
 * "save this as a style" belongs to.
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

    /**
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('save_preset')
                ->label(fn () => Theme::trans('settings.preset.save'))
                ->icon('tabler-bookmark')
                ->color('gray')
                ->visible(fn (): bool => Features::mayManage(self::key()))
                ->modalDescription(fn () => Theme::trans('settings.preset.save_confirm'))
                ->schema([
                    TextInput::make('label')
                        ->label(fn () => Theme::trans('settings.preset.save_name'))
                        ->helperText(fn () => Theme::trans('settings.preset.save_name_helper'))
                        ->maxLength(40)
                        ->required(),
                ])
                ->action(function (array $data): void {
                    if (!Features::mayManage(self::key())) {
                        return;
                    }

                    /*
                     * From the form rather than from what is stored. "Save this
                     * as a style" is said about what you are looking at, and a
                     * button that saved the last thing you pressed Save on
                     * instead would be a poor one.
                     */
                    $key = Presets::saveCustom(
                        (string) ($data['label'] ?? ''),
                        (array) $this->form->getState(),
                    );

                    if ($key === null) {
                        Notification::make()
                            ->title(Theme::trans('settings.preset.save_failed'))
                            ->body(Theme::trans('settings.preset.save_full', ['max' => Presets::MAX_CUSTOM]))
                            ->danger()
                            ->send();

                        return;
                    }

                    Notification::make()
                        ->title(Theme::trans('settings.preset.saved'))
                        ->success()
                        ->send();

                    // Reloaded, so the picker is drawn again with the new style
                    // in it rather than showing the list it was built from.
                    $this->redirect(self::getUrl());
                }),

            Action::make('delete_preset')
                ->label(fn () => Theme::trans('settings.preset.delete'))
                ->icon('tabler-trash')
                ->color('gray')
                // Nothing of your own means nothing to delete, and a button that
                // opens onto an empty list is a button that should not be there.
                ->visible(fn (): bool => Features::mayManage(self::key())
                    && Presets::customOptions() !== [])
                ->requiresConfirmation()
                ->modalDescription(fn () => Theme::trans('settings.preset.delete_confirm'))
                ->schema([
                    Select::make('preset')
                        ->label(fn () => Theme::trans('settings.preset.delete_which'))
                        ->options(fn () => Presets::customOptions())
                        ->selectablePlaceholder(false)
                        ->required(),
                ])
                ->action(function (array $data): void {
                    if (!Features::mayManage(self::key())) {
                        return;
                    }

                    $key = (string) ($data['preset'] ?? '');

                    Presets::deleteCustom($key);

                    /*
                     * A panel set to the style just deleted would fall back to
                     * the default on the next read, silently. Said out loud
                     * instead, and left to be picked again deliberately.
                     */
                    if (Presets::current() !== $key) {
                        Notification::make()
                            ->title(Theme::trans('settings.preset.deleted'))
                            ->success()
                            ->send();
                    } else {
                        Notification::make()
                            ->title(Theme::trans('settings.preset.deleted'))
                            ->body(Theme::trans('settings.preset.deleted_current'))
                            ->warning()
                            ->send();
                    }

                    $this->redirect(self::getUrl());
                }),
        ];
    }
}
