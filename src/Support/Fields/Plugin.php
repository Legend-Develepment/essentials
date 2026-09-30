<?php

namespace LegendDevelopment\Theme\Support\Fields;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Utilities\Get;
use LegendDevelopment\Theme\Filament\Admin\Pages\ModuleSettings;
use LegendDevelopment\Theme\Jobs\UpdateFromChannel;
use LegendDevelopment\Theme\Support\Channels;
use LegendDevelopment\Theme\Support\NavIcon;
use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Support\Workers;
use Throwable;

/**
 * The plugin's own page: which releases it follows, and a way to its parts.
 *
 * Not a question about the panel's looks, which is why it is not on any
 * of the pages that answer those. It asks what this plugin is doing: which channel
 * it follows, whether it installs on its own, and where the switches live.
 *
 * Lifted out of Settings, which had every form in it and was three thousand
 * lines long. What stays there is what a setting *is*: read it, sanitise it,
 * write it. What moved here is what a setting *looks like*, which is a
 * different question and belongs next to the page that asks it.
 */
class Plugin
{
    /**
     * The plugin's own page: which releases it follows, and what it adds.
     *
     * These two stay together and stay off the sidebar as rows of their own.
     * Everything else answers "what does the panel look like"; these answer
     * "what is this plugin doing", which is one question.
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function groups(): array
    {
        return [
            /*
             * The row this plugin puts in the sidebar, and the picture on
             * it. Here rather than under Look -> Brand: Brand is about how
             * the panel looks, and this is about how this plugin appears in
             * it - which is the question this page answers.
             */
            Part::section('identity', 'tabler-photo', [
                FileUpload::make('nav_icon')
                    ->label(fn () => Theme::trans('settings.identity.nav_icon'))
                    ->helperText(fn () => Theme::trans('settings.identity.nav_icon_helper'))
                    ->disk('public')
                    ->directory('theme')
                    /*
                     * The three types by mime rather than ->image(), which would
                     * turn .ico away - browsers do not agree on what to call it and
                     * Filament's image rule does not include it. Both of the names
                     * an .ico arrives under are listed for the same reason.
                     */
                    ->acceptedFileTypes(NavIcon::MIMES)
                    ->maxFiles(1)
                    /*
                     * The same eight megabytes every other upload here
                     * takes. It was one, on the reasoning that a twenty
                     * pixel icon needs nothing more - which is true about
                     * the icon and wrong about the files people actually
                     * have. A logo exported as SVG with a raster embedded
                     * in it is megabytes, and turning that away while the
                     * background image field next door accepts eight is
                     * not a rule, it is an inconsistency.
                     *
                     * It costs one download per browser rather than one
                     * per page, because this is served as a file. The help
                     * text says so rather than leaving it as a surprise.
                     */
                    ->maxSize(8192)
                    ->columnSpanFull(),
            ])
                ->description(fn () => Theme::trans('settings.groups.identity_helper')),

            Part::section('updates', 'tabler-cloud-download', self::channelFields())
                ->description(fn () => Theme::trans('settings.groups.updates_helper'))
                ->columns(['default' => 1, 'sm' => 2]),

            /*
             * Which parts of this plugin exist at all is no longer asked here.
             *
             * It was fifty-three checkboxes in one alphabetical column on a page
             * about colours, which is two questions on one screen: what should
             * this panel look like, and what should this plugin be. The second
             * one has a page now, where each group says what it is for before it
             * says what is in it, and where a switch can say that it is on and
             * showing nothing.
             *
             * What stays here is the way to it. A section that only points
             * somewhere is worth its room exactly once: when somebody who knew
             * where the switches were comes looking for them.
             */
            Part::section('features', 'tabler-toggle-right', [
                Actions::make([
                    Action::make('ld_modules')
                        ->label(fn (): string => Theme::trans('settings.groups.features_open'))
                        ->icon('tabler-layout-grid')
                        ->color('primary')
                        ->url(fn (): ?string => self::modulesUrl())
                        // Not offered to somebody who may not open it: a button
                        // that leads to a refusal is worse than no button.
                        ->visible(fn (): bool => ModuleSettings::canAccess() && self::modulesUrl() !== null),
                ]),
            ])
                ->description(fn () => Theme::trans('settings.groups.features_helper')),
        ];
    }

    /**
     * Where the switches live now.
     *
     * Asked of Filament rather than written down, because a panel mounted
     * somewhere other than /admin would otherwise be sent to a page that is not
     * there. Null when it cannot be worked out, and then the button is not
     * offered at all rather than offering a link to nowhere.
     */
    public static function modulesUrl(): ?string
    {
        try {
            return ModuleSettings::getUrl();
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function channelFields(): array
    {
        return [
            // Every feed is worked out from the stable one, branch included, so
            // there is no address to fill in and no field asking for one. The
            // address in use is named underneath instead - which also makes an
            // override left in .env visible rather than silently in charge.
            Select::make('channel')
                ->label(fn () => Theme::trans('settings.channel.label'))
                ->helperText(fn (): string => Theme::trans('settings.channel.helper')
                    . ' - ' . (Channels::feed() ?? '?'))
                ->options(fn () => Channels::options())
                ->selectablePlaceholder(false)
                ->required()
                ->live(),
            // A switch of its own rather than an "off" among the intervals: off
            // is a decision, and turning it back on should not mean choosing an
            // interval again.
            Toggle::make('auto_update_enabled')
                ->label(fn () => Theme::trans('settings.channel.auto.label'))
                ->helperText(fn () => Theme::trans('settings.channel.auto.helper'))
                ->live(),
            Select::make('auto_update')
                ->label(fn () => Theme::trans('settings.channel.auto.interval'))
                ->options(fn () => Channels::autoUpdateOptions())
                ->selectablePlaceholder(false)
                ->required()
                ->visible(fn (Get $get): bool => (bool) $get('auto_update_enabled')),

            /*
             * The one address in this section that cannot be worked out, because
             * it is not an address: the dev channel is served from a private
             * repository and a private repository asks who is reading.
             *
             * Only where dev is offered at all. Anywhere else the field would
             * ask for a credential to reach a channel that panel cannot select,
             * and a field like that is one somebody fills in anyway.
             *
             * Revealable, like the other pasted credentials here: a field that
             * cannot be read back is a field nobody can check they pasted right.
             */
            TextInput::make('dev_token')
                ->label(fn () => Theme::trans('settings.channel.token'))
                ->helperText(fn () => Theme::trans('settings.channel.token_helper'))
                ->maxLength(128)
                ->password()
                ->revealable()
                ->visible(fn (): bool => Channels::devAllowed())
                ->columnSpanFull(),

            /*
             * Any release on the channel, not only the newest - for going back
             * when something new turns out to be worse, or forward to a build
             * you were told to try.
             *
             * Only while updates are not installing themselves, and that is not
             * tidiness either: pinning a version with auto-update on would last
             * until the next run, which on "every minute" is a minute. Rather
             * than have the two fight, the picker is not there while the other
             * one is in charge.
             */
            Select::make('install_version')
                ->label(fn () => Theme::trans('settings.channel.version'))
                ->helperText(fn () => Theme::trans('settings.channel.version_helper'))
                ->options(fn () => Channels::releaseOptions())
                ->placeholder(fn () => Theme::trans('settings.channel.version_placeholder'))
                ->searchable()
                ->live()
                ->visible(fn (Get $get): bool => !$get('auto_update_enabled')
                    && Channels::releaseOptions() !== [])
                ->columnSpanFull(),

            Actions::make([
                Action::make('install_version')
                    ->label(fn () => Theme::trans('settings.channel.version_install'))
                    ->icon('tabler-download')
                    ->requiresConfirmation()
                    ->modalDescription(fn () => Theme::trans('settings.channel.version_confirm'))
                    ->disabled(fn (Get $get): bool => blank($get('install_version')))
                    ->action(fn (Get $get) => self::install($get('install_version'))),
            ])
                ->visible(fn (Get $get): bool => !$get('auto_update_enabled')
                    && Channels::releaseOptions() !== []),
        ];
    }

    /**
     * Install one particular release.
     *
     * The value is the download address itself rather than a version string, so
     * what gets installed can only be something releaseOptions() offered - the
     * list is built from the releases, and a value that is not in it is refused
     * here rather than fetched.
     */
    public static function install(mixed $url): void
    {
        $url = is_string($url) ? $url : '';
        $options = Channels::releaseOptions();

        if (!user()?->can(Theme::PERMISSION_UPDATE) || !array_key_exists($url, $options)) {
            return;
        }

        $version = '?';

        foreach (Channels::releases() as $release) {
            if ($release['download_url'] === $url) {
                $version = $release['version'];

                break;
            }
        }

        UpdateFromChannel::dispatch(user(), $url, $version);

        Notification::make()
            ->title(Theme::trans('page.update_started'))
            ->body(Workers::body())
            ->success()
            ->send();
    }
}
