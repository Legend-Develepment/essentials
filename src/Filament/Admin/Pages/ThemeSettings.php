<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use App\Jobs\Plugin\UpdatePlugin;
use App\Models\Plugin;
use BackedEnum;
use Exception;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use LegendDevelopment\Theme\Support\Settings;
use LegendDevelopment\Theme\Support\Theme;

/**
 * A theme page of its own, so restyling the panel can be delegated without
 * handing out the plugin permissions - those also allow installing and deleting
 * plugins, which is a much bigger thing to give away.
 *
 * @property Schema $form
 */
class ThemeSettings extends Page implements HasSchemas
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-palette';

    protected static ?string $slug = 'theme';

    protected static ?int $navigationSort = 10;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public static function canAccess(): bool
    {
        return user()?->can(Theme::PERMISSION_VIEW) ?? false;
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.theme-settings';
    }

    public function getTitle(): string
    {
        return Theme::trans('page.title');
    }

    /**
     * The installed version, and whether a newer one is waiting. Pelican does
     * the version check itself and caches the result for ten minutes, so this
     * costs nothing per render.
     */
    public function getSubheading(): ?string
    {
        $plugin = $this->plugin();

        if (!$plugin) {
            return null;
        }

        return $plugin->isUpdateAvailable()
            ? Theme::trans('page.update_available') . ' — v' . $plugin->version
            : 'v' . $plugin->version;
    }

    protected function plugin(): ?Plugin
    {
        try {
            return Plugin::find(Theme::id());
        } catch (Exception) {
            return null;
        }
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('page.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        // Sit next to Pelican's own advanced pages, but do not invent a group
        // heading if that translation ever goes away.
        return trans()->has('admin/dashboard.advanced') ? trans('admin/dashboard.advanced') : null;
    }

    public function mount(): void
    {
        $this->form->fill(Settings::data());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Grouped so read-only access can disable every field at once.
                Group::make(Settings::fields())
                    ->disabled(fn () => !user()?->can(Theme::PERMISSION_UPDATE)),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        abort_unless(user()?->can(Theme::PERMISSION_UPDATE), 403);

        try {
            Settings::persist($this->form->getState());

            Notification::make()
                ->title(Theme::trans('page.saved'))
                ->success()
                ->send();

            // Reload, so the panel repaints with the colour that was just saved.
            $this->redirect(self::getUrl());
        } catch (Exception $exception) {
            Notification::make()
                ->title(Theme::trans('page.save_failed'))
                ->body($exception->getMessage())
                ->danger()
                ->send();
        }
    }

    /** @return array<Action> */
    protected function getHeaderActions(): array
    {
        return [
            // Mirrors the action on Admin -> Plugins: same job, same policy, so
            // updating from here behaves exactly the same as updating there.
            Action::make('update')
                ->label(fn () => Theme::trans('page.update'))
                ->icon('tabler-download')
                ->color('success')
                ->requiresConfirmation()
                ->modalDescription(fn () => Theme::trans('page.update_confirm'))
                ->visible(fn (): bool => (bool) $this->plugin()?->isUpdateAvailable())
                ->authorize(fn (): bool => ($plugin = $this->plugin()) !== null
                    && (user()?->can('update', $plugin) ?? false))
                ->action(function (): void {
                    $plugin = $this->plugin();

                    if (!$plugin) {
                        return;
                    }

                    try {
                        UpdatePlugin::dispatch(user(), $plugin->id);

                        Notification::make()
                            ->title(Theme::trans('page.update_started'))
                            ->body(Theme::trans('page.update_background'))
                            ->success()
                            ->send();
                    } catch (Exception $exception) {
                        Notification::make()
                            ->title(Theme::trans('page.update_failed'))
                            ->body($exception->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
            Action::make('save')
                ->label(Theme::trans('page.save'))
                ->icon('tabler-device-floppy')
                ->action('save')
                ->authorize(fn () => user()?->can(Theme::PERMISSION_UPDATE))
                ->keyBindings(['mod+s']),
        ];
    }
}
