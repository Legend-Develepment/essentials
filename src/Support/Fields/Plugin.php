<?php

namespace LegendDevelopment\Theme\Support\Fields;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Actions;
use LegendDevelopment\Theme\Filament\Admin\Pages\ModuleSettings;
use LegendDevelopment\Theme\Support\NavIcon;
use LegendDevelopment\Theme\Support\AutoUpdater;
use LegendDevelopment\Theme\Support\Installed;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * The plugin's own page: which version is installed, and a way to its parts.
 *
 * Not a question about the panel's looks, which is why it is not on any
 * of the pages that answer those. It asks what this plugin is doing: which
 * version runs, whether Pelican has found a newer one, and where the switches
 * live.
 *
 * Lifted out of Settings, which had every form in it and was three thousand
 * lines long. What stays there is what a setting *is*: read it, sanitise it,
 * write it. What moved here is what a setting *looks like*, which is a
 * different question and belongs next to the page that asks it.
 */
class Plugin
{
    /**
     * The plugin's own page: which version is installed, and what it adds.
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

            Part::section('updates', 'tabler-cloud-download', self::updateFields())
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
     * What is installed, and the update state the Essentials Auto Updater
     * reports for it when that plugin is installed.
     *
     * Only something to read: nothing on this page checks for, downloads or
     * installs a release.
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function updateFields(): array
    {
        return [
            Placeholder::make('installed_version')
                ->label(fn () => Theme::trans('settings.updates.installed'))
                ->content(fn (): string => 'v' . Installed::version()),

            // What the Auto Updater says, in its own words, when it is here.
            Placeholder::make('update_state')
                ->label(fn () => Theme::trans('settings.updates.state'))
                ->content(fn (): string => (string) (AutoUpdater::plugin(Theme::id())['sentence'] ?? ''))
                ->visible(fn (): bool => AutoUpdater::plugin(Theme::id()) !== null),

            Actions::make([
                Action::make('ld_updater')
                    ->label(fn (): string => (string) (AutoUpdater::status()['label'] ?? ''))
                    ->icon('tabler-cloud-download')
                    ->color('gray')
                    ->url(fn (): ?string => AutoUpdater::status()['url'] ?? null),
            ])
                ->visible(fn (): bool => (AutoUpdater::status()['url'] ?? null) !== null)
                ->columnSpanFull(),
        ];
    }
}
