<?php

namespace LegendDevelopment\Theme\Support\Fields;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use LegendDevelopment\Theme\Support\Languages;
use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Support\Translations;

/**
 * Which languages this plugin answers in, and how one is added.
 *
 * The longest single section in the plugin, because adding a language
 * is three questions - a file, a code, and whether it is offered - and each of
 * them can be answered wrongly in a way worth catching before it is saved.
 *
 * Lifted out of Settings, which had every form in it and was three thousand
 * lines long. What stays there is what a setting *is*: read it, sanitise it,
 * write it. What moved here is what a setting *looks like*, which is a
 * different question and belongs next to the page that asks it.
 */
class Words
{
    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function groups(): array
    {
        return [
            Part::section('languages', 'tabler-language', [
                TextInput::make('language_code')
                    ->label(fn () => Theme::trans('settings.languages.code'))
                    ->helperText(fn () => Theme::trans('settings.languages.code_helper'))
                    ->placeholder('fr')
                    ->maxLength(32)
                    /*
                     * A name rather than a locale. Anything that can be a
                     * directory name will do - Gaming-NL as readily as nl - and
                     * the helper text says what the difference costs: only a
                     * real locale can be somebody's account language, so a made
                     * up one is reachable as the main language and not
                     * otherwise.
                     */
                    ->rule('regex:/^[A-Za-z][A-Za-z0-9_-]{1,31}$/')
                    ->columnSpanFull(),

                TextInput::make('language_url')
                    ->label(fn () => Theme::trans('settings.languages.url'))
                    ->helperText(fn () => Theme::trans('settings.languages.url_helper'))
                    ->placeholder('https://cdn.example.com/gaming-nl.json')
                    ->url()
                    ->maxLength(2048)
                    ->columnSpanFull(),
                FileUpload::make('language_file')
                    ->label(fn () => Theme::trans('settings.languages.upload'))
                    ->helperText(fn () => Theme::trans('settings.languages.upload_helper'))
                    /*
                     * Loose, because a .json file arrives under whichever of
                     * these the browser and the operating system happen to
                     * agree on - and one that reported something else was
                     * refused with a message about mime types, which says
                     * nothing to the person who exported it. What the file is
                     * gets decided by reading it: it either parses as the
                     * object this produced or it does not, and that answer is
                     * both certain and worth saying.
                     */
                    ->acceptedFileTypes([
                        'application/json',
                        'text/json',
                        'text/plain',
                        'application/octet-stream',
                    ])
                    ->maxFiles(1)
                    ->maxSize((int) (Translations::MAX_BYTES / 1024))
                    // Held rather than stored: it is read on save and the file
                    // itself is of no further use, the same as an icon pack.
                    ->storeFiles(false)
                    ->columnSpanFull(),

                Repeater::make('language_labels')
                    ->label(fn () => Theme::trans('settings.languages.labels'))
                    ->helperText(fn () => Theme::trans('settings.languages.labels_helper'))
                    ->schema([
                        TextInput::make('code')
                            ->label(fn () => Theme::trans('settings.languages.labels_code'))
                            // The row names a language that exists; it is not
                            // where one is created, which is what the upload is.
                            ->disabled()
                            ->dehydrated(),
                        TextInput::make('label')
                            ->label(fn () => Theme::trans('settings.languages.labels_name'))
                            // What it is called without a name of this panel's,
                            // not name(), which is whatever is already typed here.
                            ->placeholder(fn (Get $get): string => Languages::derived((string) ($get('code') ?? '')))
                            ->maxLength(60),
                    ])
                    ->columns(['default' => 1, 'sm' => 2])
                    ->addable(false)
                    ->deletable(false)
                    ->reorderable(false)
                    ->columnSpanFull(),
                Select::make('languages_main')
                    ->label(fn () => Theme::trans('settings.languages.main'))
                    ->helperText(fn () => Theme::trans('settings.languages.main_helper'))
                    ->options(fn (): array => Languages::options())
                    ->selectablePlaceholder(false)
                    ->columnSpanFull(),
                Toggle::make('languages_panel')
                    ->label(fn () => Theme::trans('settings.languages.panel'))
                    ->helperText(fn () => Theme::trans('settings.languages.panel_helper'))
                    ->columnSpanFull(),
                CheckboxList::make('languages_on')
                    ->label(fn () => Theme::trans('settings.languages.label'))
                    ->helperText(fn () => Theme::trans('settings.languages.helper'))
                    ->options(function (): array {
                        $options = [];

                        foreach (Languages::options() as $code => $name) {
                            // Neither the main language nor English is a tick:
                            // everything falls back to them, and a panel that
                            // had switched off its own fallback would show its
                            // readers key names.
                            if ($code === Languages::BASE || $code === Languages::main()) {
                                continue;
                            }

                            /*
                             * How much of it is done, beside its name.
                             *
                             * A partial translation is the normal state here
                             * rather than a fault - Laravel falls back per
                             * missing key, so a language that is half finished
                             * is half in that language and half in English, and
                             * works either way. Hiding the number would be the
                             * dishonest option: somebody switching on a language
                             * that is a third done should find that out before
                             * their users do.
                             */
                            $done = Languages::completeness($code);

                            $options[$code] = $name . '  -  ' . Theme::trans('settings.languages.done', [
                                'percent' => $done,
                            ]) . (Languages::partial($code)
                                ? '  ·  ' . Theme::trans('settings.languages.under')
                                : '');
                        }

                        return $options;
                    })
                    ->bulkToggleable()
                    ->columns(['default' => 1, 'sm' => 2])
                    ->columnSpanFull(),
            ])
                ->description(fn () => Theme::trans('settings.languages.section_helper')),
        ];
    }
}
