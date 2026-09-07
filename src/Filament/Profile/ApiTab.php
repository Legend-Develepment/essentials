<?php

namespace LegendDevelopment\Theme\Filament\Profile;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\View;
use LegendDevelopment\Theme\Models\Key;
use LegendDevelopment\Theme\Support\Api\Keys;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * A key for this plugin, on the page where people look for API keys.
 *
 * **Where somebody looks is not where this plugin put it.** Pelican keeps API
 * keys under the account profile, at `?tab=api-keys::data::tab`, and this
 * plugin kept its own on a page of its own in the client area. Both are real
 * keys for real APIs and only one of them was findable, which meant the answer
 * to "where do I get a key" depended on knowing there were two kinds.
 *
 * So it is offered here as well. The page in the client area stays - it is
 * where the Discord connection lives and where a refusal comes back with its
 * reason - and this is the shortcut for the one thing most people want.
 *
 * **Through Pelican's own extension point.** EditProfile carries
 * CanCustomizeTabs, so a tab there is a supported API taking a Tab object -
 * not a selector against somebody else's form.
 *
 * **Always a personal key.** There is no scope picker here and there will not
 * be: a key made from an account page answers for that account, reaching the
 * servers its owner can already open and nothing else. A panel-wide key is a
 * different act with a different consequence, and it stays on the page that
 * needs a permission to reach.
 *
 * And it does not talk its way past the approval setting. Where requests wait
 * to be granted, one made here waits too - a second door into the same room
 * has to have the same lock, or the setting is decoration.
 */
class ApiTab
{
    /**
     * Built with closures throughout.
     *
     * This is constructed while the plugin boots, which is before the panel has
     * finished being built - so a label resolved now is a translation asked for
     * before the reader's language is known. Every one of them is a closure,
     * evaluated when the tab is drawn.
     */
    public static function make(): Tab
    {
        return Tab::make('essentials_api')
            ->label(fn (): string => Theme::trans('api.profile_tab'))
            ->icon('tabler-plug-connected')
            ->visible(static fn (): bool => self::offered())
            ->schema([
                Grid::make(['default' => 1, 'lg' => 5])
                    ->schema([
                        Section::make(fn (): string => Theme::trans('api.profile_make'))
                            ->description(fn (): string => Theme::trans('api.profile_make_helper'))
                            ->columnSpan(3)
                            ->schema([
                                TextInput::make('ld_api_name')
                                    ->label(fn (): string => Theme::trans('api.ask_name'))
                                    ->helperText(fn (): string => Theme::trans('api.ask_name_helper'))
                                    ->maxLength(60)
                                    ->live(),
                            ])
                            ->headerActions([
                                Action::make('ld_api_create')
                                    ->label(fn (): string => Theme::trans('api.profile_create'))
                                    ->icon('tabler-plus')
                                    ->disabled(fn (Get $get): bool => trim((string) $get('ld_api_name')) === '')
                                    ->action(fn (Get $get) => self::create((string) $get('ld_api_name'))),
                            ]),

                        Section::make(fn (): string => Theme::trans('api.profile_yours'))
                            ->columnSpan(2)
                            ->schema([
                                View::make(Theme::id() . '::components.api-profile-keys'),
                            ]),
                    ]),
            ]);
    }

    /** Whether there is anything to offer: the feature on, and a table to write to. */
    private static function offered(): bool
    {
        try {
            return Features::enabled(Features::API) && Keys::ready() && user() !== null;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * Make one, or ask for one.
     *
     * Which of the two depends on the panel's own setting rather than on where
     * the button was pressed. The key is shown in a notification that stays
     * until it is dismissed - which is what Pelican does with its own on this
     * same page, so the two behave alike rather than each having a idea of its
     * own about where a secret goes.
     */
    private static function create(string $name): void
    {
        try {
            /** @var User|null $person */
            $person = user();

            if ($person === null || !self::offered()) {
                return;
            }

            // One waiting at a time, the same rule the client page follows.
            $waiting = Key::query()
                ->where('user_id', $person->id)
                ->where('state', Key::PENDING)
                ->exists();

            if ($waiting) {
                Notification::make()
                    ->title(Theme::trans('api.ask_open'))
                    ->body(Theme::trans('api.ask_open_body'))
                    ->warning()
                    ->send();

                return;
            }

            $key = Keys::ask($person, $name);

            if (Keys::approvalNeeded()) {
                Notification::make()
                    ->title(Theme::trans('api.ask_sent'))
                    ->body(Theme::trans('api.ask_sent_body'))
                    ->success()
                    ->send();

                return;
            }

            Notification::make()
                ->title(Theme::trans('api.ask_granted'))
                ->body(Keys::grant($key, $person))
                ->persistent()
                ->success()
                ->send();
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('api.ask_failed'))
                ->danger()
                ->send();
        }
    }
}
