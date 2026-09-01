<?php

namespace LegendDevelopment\Theme\Filament\Server\Pages;

use App\Enums\SubuserPermission;
use App\Models\Server;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use LegendDevelopment\Theme\Jobs\InstallModpack;
use LegendDevelopment\Theme\Support\Minecraft\Minecraft;
use LegendDevelopment\Theme\Support\Minecraft\Modrinth;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Modpacks from Modrinth, onto this server.
 *
 * Same eggs as the Minecraft page - the list an administrator ticked - because
 * the question "is this a Minecraft server" has one answer and asking it twice
 * would let the two drift.
 *
 * @property Schema $form
 */
class Modpacks extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-package';

    protected static ?string $slug = 'modpacks';

    protected static ?int $navigationSort = 9;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public static function canAccess(): bool
    {
        try {
            $server = Filament::getTenant();

            return $server instanceof Server
                && Minecraft::detect($server)
                && (user()?->can(SubuserPermission::FileUpdate, $server) ?? false);
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('modpack.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('modpack.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('modpack.nav_label');
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.theme-settings';
    }

    public function mount(): void
    {
        $this->form->fill(['search' => '']);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(fn (): string => Theme::trans('modpack.section'))
                    ->description(fn (): string => Theme::trans('modpack.section_helper'))
                    ->icon('tabler-package')
                    ->iconColor('primary')
                    ->columns(2)
                    ->schema([
                        TextInput::make('search')
                            ->label(fn () => Theme::trans('modpack.search'))
                            ->helperText(fn () => Theme::trans('modpack.search_helper'))
                            // On blur, not on every keystroke: each change is a
                            // request to somebody else's API, and Modrinth is
                            // being asked a favour rather than paid for one.
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set) => $set('pack', null))
                            ->columnSpanFull(),

                        Select::make('pack')
                            ->label(fn () => Theme::trans('modpack.pack'))
                            ->options(fn (Get $get): array => Modrinth::options((string) ($get('search') ?? '')))
                            ->helperText(fn () => Theme::trans('modpack.pack_helper'))
                            ->searchable()
                            ->live()
                            ->afterStateUpdated(fn (Set $set) => $set('version', null))
                            ->columnSpanFull(),

                        Select::make('version')
                            ->label(fn () => Theme::trans('modpack.version'))
                            ->helperText(fn () => Theme::trans('modpack.version_helper'))
                            ->options(fn (Get $get): array => is_string($get('pack')) && $get('pack') !== ''
                                ? Modrinth::versionOptions($get('pack'))
                                : [])
                            ->searchable()
                            ->live()
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data');
    }

    /**
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('install')
                ->label(fn () => Theme::trans('modpack.install'))
                ->icon('tabler-download')
                ->requiresConfirmation()
                ->modalDescription(fn () => Theme::trans('modpack.install_confirm'))
                ->modalSubmitActionLabel(fn () => Theme::trans('modpack.install_go'))
                ->visible(fn (): bool => is_string($this->data['version'] ?? null)
                    && ($this->data['version'] ?? '') !== '')
                ->action(fn () => $this->install()),
        ];
    }

    public function install(): void
    {
        $server = $this->server();

        if ($server === null) {
            return;
        }

        abort_unless(user()?->can(SubuserPermission::FileUpdate, $server) ?? false, 403);

        /*
         * Stopped only. A pack drops mods into a folder the running game has
         * open, and Minecraft loads its mods once at start - so installing over
         * a running server gives a server that is neither the old pack nor the
         * new one until it is restarted, and possibly one that will not start.
         */
        if (!Minecraft::isStopped($server)) {
            Notification::make()
                ->title(Theme::trans('modpack.running'))
                ->body(Theme::trans('modpack.running_helper'))
                ->warning()
                ->send();

            return;
        }

        $slug = (string) ($this->data['pack'] ?? '');
        $versionId = (string) ($this->data['version'] ?? '');

        $version = $versionId === '' ? null : Modrinth::version($slug, $versionId);
        $pack = $version === null ? null : Modrinth::pack($version);

        if ($pack === null) {
            Notification::make()
                ->title(Theme::trans('modpack.failed'))
                ->body(Theme::trans('modpack.failed_version'))
                ->danger()
                ->send();

            return;
        }

        try {
            InstallModpack::dispatch(
                (int) $server->id,
                user()?->id === null ? null : (int) user()->id,
                $pack['url'],
                $pack['filename'],
                (string) ($version['name'] ?? $versionId),
            );
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('modpack.failed'))
                ->body(Theme::trans('modpack.failed_queue'))
                ->danger()
                ->send();

            return;
        }

        Notification::make()
            ->title(Theme::trans('modpack.started'))
            ->body(Theme::trans('modpack.started_helper'))
            ->success()
            ->send();
    }

    private function server(): ?Server
    {
        try {
            $server = Filament::getTenant();

            return $server instanceof Server ? $server : null;
        } catch (Throwable) {
            return null;
        }
    }
}
