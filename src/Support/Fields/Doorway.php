<?php

namespace LegendDevelopment\Theme\Support\Fields;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use LegendDevelopment\Theme\Support\Registration;
use LegendDevelopment\Theme\Support\Theme;

/**
 * The login screen, which is the one page a visitor sees signed out.
 *
 * Its own page and its own writer, because it is the only form here
 * whose result is drawn for somebody who has no account - so nothing on it may
 * depend on who is reading.
 *
 * Lifted out of Settings, which had every form in it and was three thousand
 * lines long. What stays there is what a setting *is*: read it, sanitise it,
 * write it. What moved here is what a setting *looks like*, which is a
 * different question and belongs next to the page that asks it.
 */
class Doorway
{
    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function loginFields(): array
    {
        return [
            FileUpload::make('login_image')
                ->label(fn () => Theme::trans('settings.login.image'))
                ->helperText(fn () => Theme::trans('settings.login.image_helper'))
                ->disk('public')
                ->directory('theme')
                ->image()
                ->maxFiles(1)
                ->maxSize(8192)
                ->columnSpanFull(),
            TextInput::make('login_image_url')
                ->label(fn () => Theme::trans('settings.login.url'))
                ->url()
                ->maxLength(2048)
                ->columnSpanFull(),
            TextInput::make('login_dim')
                ->label(fn () => Theme::trans('settings.background.dim'))
                ->numeric()
                ->minValue(0)
                ->maxValue(90)
                ->suffix('%'),
            TextInput::make('login_blur')
                ->label(fn () => Theme::trans('settings.login.blur'))
                ->helperText(fn () => Theme::trans('settings.login.blur_helper'))
                ->numeric()
                ->minValue(0)
                ->maxValue(24)
                ->suffix('px'),
            TextInput::make('login_width')
                ->label(fn () => Theme::trans('settings.login.width'))
                ->numeric()
                ->minValue(20)
                ->maxValue(60)
                ->suffix('rem'),
            Select::make('login_position')
                ->label(fn () => Theme::trans('settings.login.position'))
                ->helperText(fn () => Theme::trans('settings.login.position_helper'))
                ->options(fn () => [
                    'center' => Theme::trans('settings.login.position_center'),
                    'top' => Theme::trans('settings.login.position_top'),
                    'bottom' => Theme::trans('settings.login.position_bottom'),
                    'left' => Theme::trans('settings.login.position_left'),
                    'right' => Theme::trans('settings.login.position_right'),
                ])
                ->selectablePlaceholder(false),
            Select::make('login_align')
                ->label(fn () => Theme::trans('settings.login.align'))
                ->helperText(fn () => Theme::trans('settings.login.align_helper'))
                ->options(fn () => [
                    'center' => Theme::trans('settings.login.align_center'),
                    'start' => Theme::trans('settings.login.align_start'),
                    'end' => Theme::trans('settings.login.align_end'),
                ])
                ->selectablePlaceholder(false),
            TextInput::make('login_opacity')
                ->label(fn () => Theme::trans('settings.login.opacity'))
                ->helperText(fn () => Theme::trans('settings.login.opacity_helper'))
                ->numeric()
                ->minValue(30)
                ->maxValue(100)
                ->suffix('%'),
            Toggle::make('login_glow')
                ->label(fn () => Theme::trans('settings.login.glow'))
                ->helperText(fn () => Theme::trans('settings.login.glow_helper')),
            Toggle::make('login_hide_heading')
                ->label(fn () => Theme::trans('settings.login.hide_heading'))
                ->helperText(fn () => Theme::trans('settings.login.hide_heading_helper')),
            Toggle::make('login_hide_footer')
                ->label(fn () => Theme::trans('settings.login.hide_footer'))
                ->helperText(fn () => Theme::trans('settings.login.hide_footer_helper')),
            TextInput::make('login_above')
                ->label(fn () => Theme::trans('settings.login.above'))
                ->helperText(fn () => Theme::trans('settings.login.above_helper'))
                ->maxLength(160)
                ->columnSpanFull(),
            TextInput::make('login_notice')
                ->label(fn () => Theme::trans('settings.login.notice'))
                ->helperText(fn () => Theme::trans('settings.login.notice_helper'))
                ->maxLength(160)
                ->columnSpanFull(),

            /*
             * The signup door, on the login page because that is where it is
             * seen and because that is the page it puts a link on.
             *
             * Off by default and said plainly in the helper, since a setting
             * that opens a panel to strangers should not be one somebody flips
             * while looking for something else.
             */
            Toggle::make('register_open')
                ->label(fn () => Theme::trans('settings.login.register'))
                ->helperText(fn () => Theme::trans('settings.login.register_helper'))
                ->live()
                ->columnSpanFull(),
            TextInput::make('register_note')
                ->label(fn () => Theme::trans('settings.login.register_note'))
                ->helperText(fn () => Theme::trans('settings.login.register_note_helper'))
                ->maxLength(160)
                ->visible(fn (Get $get): bool => (bool) $get('register_open'))
                ->columnSpanFull(),

            /*
             * The other door, which this page does not own.
             *
             * Pelican makes an account on a first OAuth sign-in when the
             * provider has "create missing users" switched on, and the toggle
             * above knows nothing about that. An administrator who turns the
             * form off and believes the panel is shut has been misled by this
             * page, so the page says what is actually true instead.
             *
             * Drawn only when there is something to say: a panel with no such
             * provider gets no paragraph about providers.
             */
            Placeholder::make('register_oauth')
                ->label(fn () => Theme::trans('settings.login.register_oauth'))
                ->content(fn (): string => Theme::trans('settings.login.register_oauth_body', [
                    'names' => implode(', ', array_map('ucfirst', Registration::providers())),
                ]))
                ->visible(fn (): bool => Registration::providers() !== [])
                ->columnSpanFull(),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function fields(): array
    {
        return self::loginFields();
    }
}
