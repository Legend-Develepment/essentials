<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use Exception;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Preview;
use LegendDevelopment\Theme\Support\Settings;
use LegendDevelopment\Theme\Support\Theme;

/**
 * What every settings page of this plugin has in common.
 *
 * The settings are one flat set stored in .env, but they are edited across
 * several pages, and that is the whole reason this class exists. A form that
 * shows a quarter of the fields hands back a quarter of the state, and writing
 * that would blank the other three quarters - the same trap persistLogin() and
 * persistSystemStatus() each had to be written around.
 *
 * So saving merges: the complete stored set first, this page's fields over the
 * top. A page can only ever change what it shows, and the values it never drew
 * are written back exactly as they were read.
 *
 * @property Schema $form
 */
abstract class SettingsPage extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    /**
     * The sections this page shows.
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    abstract protected function groups(): array;

    /** The translation key under settings.pages for the title and the row. */
    abstract protected static function key(): string;

    /**
     * The page key doubles as the feature key, so a page is reachable to
     * anyone holding the broad view permission or that one feature.
     */
    public static function canAccess(): bool
    {
        return Features::maySee(static::key());
    }

    /**
     * Switched off takes the row out of the sidebar and no further: the page
     * keeps its address, so the switch that hid it is never out of reach.
     */
    public static function shouldRegisterNavigation(): bool
    {
        return Features::maySee(static::key()) && parent::shouldRegisterNavigation();
    }

    /**
     * Whether this page draws the preview box beside its form.
     *
     * Only Look does. The preview shows what the appearance tokens paint -
     * colour, corners, spacing, glass, glow - and those are all on that page;
     * beside a form about the server list it would be a box that never changes,
     * which reads as broken rather than as not applicable.
     */
    public function hasPreview(): bool
    {
        return false;
    }

    /**
     * The preview's tokens, built from what is in the form right now rather than
     * from what is stored - which is the entire point of it.
     *
     * @return array{css: string, dark: bool}
     */
    public function previewData(): array
    {
        $data = is_array($this->data) ? $this->data : [];

        return [
            'css' => Preview::css($data),
            'dark' => Preview::isDark($data['mode'] ?? null),
        ];
    }

    public function getView(): string
    {
        // The same view all four use: a form, and a Save that stays within
        // reach of it however far down the page you are.
        return Theme::id() . '::pages.theme-settings';
    }

    public function getTitle(): string
    {
        return Theme::trans('settings.pages.' . static::key());
    }

    public function getSubheading(): ?string
    {
        $helper = Theme::trans('settings.pages.' . static::key() . '_helper');

        // trans() hands back the key it could not find, which is not a
        // subheading anybody wants to read.
        return str_contains($helper, 'settings.pages.') ? null : $helper;
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('settings.pages.' . static::key());
    }

    public static function getNavigationGroup(): ?string
    {
        // Every page this plugin adds sits under one heading, named after the
        // plugin itself - read from plugin.json, so renaming the plugin renames
        // the heading rather than leaving a row of classes saying the old one.
        return Theme::name();
    }

    public function mount(): void
    {
        // The whole set, not just this page's share: the fields not on this
        // page still have to be here to be written back on save.
        $this->form->fill(Settings::data());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Grouped so read-only access can disable every field at once.
                Group::make($this->groups())
                    ->disabled(fn () => !Features::mayManage(static::key())),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        abort_unless(Features::mayManage(static::key()), 403);

        try {
            /*
             * Read again rather than trusting what was filled at mount: another
             * page saved in another tab five minutes ago should not be undone
             * by this one, and re-reading costs a config lookup.
             */
            Settings::persist(array_merge(Settings::data(), $this->form->getState()));

            Notification::make()
                ->title(Theme::trans('page.saved'))
                ->success()
                ->send();

            // Reload, so the panel repaints with the colour that was just saved.
            $this->redirect(static::getUrl());
        } catch (Exception $exception) {
            Notification::make()
                ->title(Theme::trans('page.save_failed'))
                ->body($exception->getMessage())
                ->danger()
                ->send();
        }
    }
}
