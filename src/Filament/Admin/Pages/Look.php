<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\FullPreview;
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
     * The one page the preview belongs on: every setting it shows is on this
     * form. Its own feature switch, so it can be turned off by anyone who would
     * rather have the width back.
     */
    public function hasPreview(): bool
    {
        return Features::maySee(Features::PREVIEW);
    }

    /**
     * Fill the form from what was being previewed, if anything.
     *
     * Going to look at the whole panel and coming back would otherwise lose the
     * changes that were being looked at, which is the one thing a preview may
     * not do. The pending values are the unsaved form state - putting them back
     * is the same act as never having left.
     */
    public function mount(): void
    {
        $pending = FullPreview::pending();

        $this->form->fill(
            is_array($pending) ? array_merge(Settings::data(), $pending) : Settings::data(),
        );
    }

    /**
     * Saving is the end of a preview: what was pending is now what is stored,
     * and a bar saying "not saved" on the next page would be a lie.
     */
    public function save(): void
    {
        parent::save();

        FullPreview::forget();
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
            /*
             * The whole panel, drawn from what is on this form.
             *
             * Same tab rather than a new one, and that is not laziness: opening
             * a tab from a Livewire action needs the state stored first, and
             * the two cannot be ordered without scripting the browser. Going
             * there and coming back loses nothing - mount() puts the form back
             * from the pending values - so the simple version is also the one
             * with fewer ways to be wrong.
             */
            Action::make('full_preview')
                ->label(fn () => Theme::trans('settings.preview.full'))
                ->icon('tabler-eye')
                ->color('gray')
                ->visible(fn (): bool => Features::mayManage(Features::PREVIEW))
                ->modalDescription(fn () => Theme::trans('settings.preview.full_confirm'))
                ->modalSubmitActionLabel(fn () => Theme::trans('settings.preview.full_go'))
                ->action(function () {
                    if (!FullPreview::remember($this->form->getState())) {
                        Notification::make()
                            ->title(Theme::trans('settings.preview.full_failed'))
                            ->body(Theme::trans('page.storage_failed'))
                            ->danger()
                            ->send();

                        return null;
                    }

                    return $this->redirect(FullPreview::url());
                }),

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
