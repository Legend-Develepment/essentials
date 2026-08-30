<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Settings;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * The sign-in screen, on a page of its own.
 *
 * It is the one page of the panel that people without an account see, it has
 * thirteen settings of its own, and none of them affect anything else. Reaching
 * it by scrolling past the server list and the terminal's colours was never
 * right.
 *
 * @property Schema $form
 */
class LoginScreen extends Page implements HasSchemas
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-login';

    protected static ?string $slug = 'login-screen';

    /** Last in the plugin's own group. */
    protected static ?int $navigationSort = 4;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    /**
     * Switched off under Features takes the row out of the sidebar, and no
     * further: the page keeps its address, so the settings on it are still
     * reachable to switch it back on.
     */
    public static function shouldRegisterNavigation(): bool
    {
        return Features::enabled(Features::LOGIN) && parent::shouldRegisterNavigation();
    }

    public static function canAccess(): bool
    {
        return user()?->can(Theme::PERMISSION_VIEW) ?? false;
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.login-screen';
    }

    public function getTitle(): string
    {
        return Theme::trans('settings.groups.login');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('settings.groups.login_helper');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('settings.groups.login');
    }

    public static function getNavigationGroup(): ?string
    {
        // Every page this plugin adds sits under one heading, named after the
        // plugin itself - read from plugin.json, so renaming the plugin renames
        // the heading rather than leaving four classes saying the old one.
        return Theme::name();
    }

    public function mount(): void
    {
        $this->form->fill(Settings::loginData());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Grouped so read-only access can disable every field at once,
                // the way the theme's own settings page does it.
                Group::make(Settings::loginSection())
                    ->columns(2)
                    ->disabled(fn () => !user()?->can(Theme::PERMISSION_UPDATE)),
            ])
            ->statePath('data');
    }

    /**
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label(fn () => Theme::trans('page.save'))
                ->icon('tabler-device-floppy')
                ->action('save')
                ->visible(fn () => user()?->can(Theme::PERMISSION_UPDATE) ?? false),
        ];
    }

    public function save(): void
    {
        if (!user()?->can(Theme::PERMISSION_UPDATE)) {
            return;
        }

        try {
            /*
             * Only this page's own keys. The theme's settings write every key
             * they know about and treat a missing one as "put it back to the
             * default" - right when the whole form is on one page, ruinous when
             * it is not.
             */
            Settings::persistLogin($this->form->getState());

            Notification::make()
                ->title(Theme::trans('page.saved'))
                ->success()
                ->send();
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('page.save_failed'))
                ->danger()
                ->send();
        }
    }
}
