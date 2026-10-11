<?php

namespace LegendDevelopment\Theme\Support\Fields;

use Closure;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use LegendDevelopment\Theme\Support\Cdn\Uploads;
use LegendDevelopment\Theme\Support\Languages;
use LegendDevelopment\Theme\Support\Saved\Files as SavedFiles;
use LegendDevelopment\Theme\Support\Theme;

/**
 * Where this plugin keeps what people upload.
 *
 * Four sections that are really one question asked four times: the
 * panel's own disk, a bucket, a CDN in front of it, and a mirror for the
 * translations. Every one of them falls back to the panel rather than losing an
 * upload.
 *
 * Lifted out of Settings, which had every form in it and was three thousand
 * lines long. What stays there is what a setting *is*: read it, sanitise it,
 * write it. What moved here is what a setting *looks like*, which is a
 * different question and belongs next to the page that asks it.
 */
class Files
{
    /**
     * The Languages tab.
     *
     * Offers what is on, and stores what is off. That inversion is the same one
     * the feature switches use and it is deliberate: a translation contributed
     * in a later release should arrive working, rather than arrive invisible
     * because it was not in a list written before it existed.
     *
     * English is not in the list. Everything falls back to it, and a panel that
     * had switched off its own fallback would show its readers key names.
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function groups(): array
    {
        return [
            Part::section('files_where', 'tabler-cloud-upload', [
                Select::make('files_where')
                    ->label(fn () => Theme::trans('settings.files.where'))
                    ->helperText(fn () => Theme::trans('settings.files.where_helper'))
                    ->options(fn (): array => [
                        Uploads::PANEL => Theme::trans('settings.files.panel'),
                        Uploads::BUCKET => Theme::trans('settings.files.s3'),
                        Uploads::CDN => Theme::trans('settings.files.cdn'),
                    ])
                    ->selectablePlaceholder(false)
                    ->live()
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('files_read_from')
                    ->label(fn () => Theme::trans('settings.files.read_from'))
                    ->helperText(fn () => Theme::trans('settings.files.read_from_helper'))
                    ->placeholder('https://cdn.example.com')
                    ->maxLength(2048)
                    /*
                     * Said here as well as enforced in Uploads::readFrom().
                     *
                     * The reader refuses an address with no scheme, because one
                     * without is a path on this panel rather than a host. That
                     * is the right thing to do and it is silent: the setting
                     * saves, nothing uses it, and the pictures come out blank.
                     * A rule on the box is where somebody finds out while they
                     * can still fix it.
                     *
                     * A closure rather than `starts_with:https://`, because the
                     * box is optional and that rule fails an empty one.
                     */
                    ->rule(static fn (): Closure => static function (
                        string $attribute,
                        mixed $value,
                        Closure $fail,
                    ): void {
                        $typed = trim((string) $value);

                        if ($typed !== '' && !str_starts_with($typed, 'https://')) {
                            $fail(Theme::trans('settings.files.read_from_https'));
                        }
                    })
                    /*
                     * Shown for both destinations, because both have the same
                     * arrangement: a bucket behind a CDN, or an API on one host
                     * and delivery on another.
                     */
                    ->visible(fn (Get $get): bool => in_array(
                        $get('files_where'),
                        [Uploads::BUCKET, Uploads::CDN],
                        true,
                    ))
                    ->columnSpanFull(),
            ]),

            Part::section('files_bucket', 'tabler-database', [
                TextInput::make('files_s3_key')
                    ->label(fn () => Theme::trans('settings.files.bucket_key'))
                    ->password()
                    ->revealable()
                    ->maxLength(191),

                /*
                 * Filled empty, like the CDN token below: what a form is filled
                 * with is in the page's HTML. The placeholder says one is on
                 * file, and empty on save keeps it. See SavedFiles::SECRETS.
                 */
                TextInput::make('files_s3_secret')
                    ->placeholder(fn (): ?string => SavedFiles::kept('files_s3_secret')
                        ? Theme::trans('page.secret_kept')
                        : null)
                    ->label(fn () => Theme::trans('settings.files.bucket_secret'))
                    ->password()
                    ->revealable()
                    ->maxLength(191),

                TextInput::make('files_s3_bucket')
                    ->label(fn () => Theme::trans('settings.files.bucket_name'))
                    ->maxLength(191),

                TextInput::make('files_s3_region')
                    ->label(fn () => Theme::trans('settings.files.bucket_region'))
                    ->helperText(fn () => Theme::trans('settings.files.bucket_region_helper'))
                    ->placeholder('auto')
                    ->maxLength(64),

                TextInput::make('files_s3_endpoint')
                    ->label(fn () => Theme::trans('settings.files.bucket_endpoint'))
                    ->helperText(fn () => Theme::trans('settings.files.bucket_endpoint_helper'))
                    ->placeholder('https://<account>.r2.cloudflarestorage.com')
                    ->maxLength(2048)
                    ->columnSpanFull(),

                Toggle::make('files_s3_path_style')
                    ->label(fn () => Theme::trans('settings.files.bucket_path_style'))
                    ->helperText(fn () => Theme::trans('settings.files.bucket_path_style_helper'))
                    ->columnSpanFull(),
            ])->visible(fn (Get $get): bool => $get('files_where') === Uploads::BUCKET),

            Part::section('files_cdn', 'tabler-world', [
                TextInput::make('files_cdn_base')
                    ->label(fn () => Theme::trans('settings.files.cdn_base'))
                    ->helperText(fn () => Theme::trans('settings.files.cdn_base_helper'))
                    ->placeholder('https://cdn.modora.xyz')
                    ->maxLength(2048)
                    ->columnSpanFull(),

                TextInput::make('files_cdn_token')
                    ->placeholder(fn (): ?string => SavedFiles::kept('files_cdn_token')
                        ? Theme::trans('page.secret_kept')
                        : null)
                    ->label(fn () => Theme::trans('settings.files.cdn_token'))
                    ->helperText(fn () => Theme::trans('settings.files.cdn_token_helper'))
                    ->password()
                    ->revealable()
                    ->maxLength(400)
                    ->columnSpanFull(),

                TextInput::make('files_cdn_folder')
                    ->label(fn () => Theme::trans('settings.files.cdn_folder'))
                    ->helperText(fn () => Theme::trans('settings.files.cdn_folder_helper'))
                    ->placeholder('panel')
                    ->maxLength(191)
                    ->columnSpanFull(),
            ])->visible(fn (Get $get): bool => $get('files_where') === Uploads::CDN),

            Part::section('files_mirror', 'tabler-language', [
                TextInput::make('files_mirror_minutes')
                    ->label(fn () => Theme::trans('settings.files.mirror_minutes'))
                    ->helperText(fn () => Theme::trans('settings.files.mirror_minutes_helper'))
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(1440)
                    ->columnSpanFull(),
            ])->visible(fn (Get $get): bool => in_array(
                $get('files_where'),
                [Uploads::BUCKET, Uploads::CDN],
                true,
            )),
        ];
    }
}
