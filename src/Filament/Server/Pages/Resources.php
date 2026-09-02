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
use LegendDevelopment\Theme\Support\Minecraft\Minecraft;
use LegendDevelopment\Theme\Support\Minecraft\Modrinth;
use LegendDevelopment\Theme\Support\Minecraft\Resources as Store;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * One mod or one plugin, and what is already installed.
 *
 * The other half of the modpack page. A pack is one archive holding a manifest
 * and a few hundred files; this is one jar into one folder, and it is what
 * people want far more often - somebody wants Vault on their Paper server, not
 * a two-hundred-mod pack.
 *
 * Same eggs, same permission and same rule about the server being stopped as
 * the modpack page, for the same reason in each case. The mods folder is read
 * once when the game starts, so a jar dropped in beside a running server does
 * nothing until a restart and is only confusing until then.
 *
 * @property Schema $form
 */
class Resources extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-puzzle';

    protected static ?string $slug = 'resources';

    protected static ?int $navigationSort = 10;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    /**
     * What is in mods/ and plugins/ now.
     *
     * Both, always, rather than only the folder matching whatever is selected
     * above: which one a server uses is the question being answered, and a
     * Forge server showing an empty plugins list says something true about it.
     *
     * @var array<string, array<int, array{name: string, size: int}>>
     */
    public array $installed = ['mod' => [], 'plugin' => []];

    public bool $running = false;

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
        return Theme::trans('resources.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('resources.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('resources.nav_label');
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.resources';
    }

    public function mount(): void
    {
        $this->form->fill(['kind' => 'mod', 'search' => '']);
        $this->load();
    }

    public function load(): void
    {
        $server = $this->server();

        if ($server === null) {
            return;
        }

        $this->installed = [
            'mod' => Store::installed($server, 'mod'),
            'plugin' => Store::installed($server, 'plugin'),
        ];

        $this->running = !Minecraft::isStopped($server);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(fn (): string => Theme::trans('resources.section'))
                    ->description(fn (): string => Theme::trans('resources.section_helper'))
                    ->icon('tabler-puzzle')
                    ->iconColor('primary')
                    ->schema([
                        /*
                         * Mod or plugin, chosen rather than guessed.
                         *
                         * It decides both which half of Modrinth is searched
                         * and which folder the jar lands in, and there is no
                         * reliable way to work it out from here: an egg's name
                         * is whatever an administrator called it, and plenty of
                         * servers run a loader that reads both folders.
                         */
                        Select::make('kind')
                            ->label(fn () => Theme::trans('resources.kind'))
                            ->helperText(fn () => Theme::trans('resources.kind_helper'))
                            ->options(fn (): array => [
                                'mod' => Theme::trans('resources.kind_mod'),
                                'plugin' => Theme::trans('resources.kind_plugin'),
                            ])
                            ->default('mod')
                            ->selectablePlaceholder(false)
                            ->live()
                            ->afterStateUpdated(function (Set $set): void {
                                $set('project', null);
                                $set('version', null);
                            })
                            ->columnSpanFull(),

                        TextInput::make('search')
                            ->label(fn () => Theme::trans('resources.search'))
                            ->helperText(fn () => Theme::trans('resources.search_helper'))
                            // On blur rather than per keystroke: every change is
                            // a request to somebody else's API, and Modrinth is
                            // being asked a favour rather than paid for one.
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set): void {
                                $set('project', null);
                                $set('version', null);
                            })
                            ->columnSpanFull(),

                        Select::make('project')
                            ->label(fn () => Theme::trans('resources.project'))
                            ->options(fn (Get $get): array => Modrinth::options(
                                (string) ($get('search') ?? ''),
                                (string) ($get('kind') ?? 'mod'),
                            ))
                            ->searchable()
                            ->live()
                            ->afterStateUpdated(fn (Set $set) => $set('version', null))
                            ->columnSpanFull(),

                        Select::make('version')
                            ->label(fn () => Theme::trans('resources.version'))
                            ->helperText(fn () => Theme::trans('resources.version_helper'))
                            ->options(fn (Get $get): array => is_string($get('project')) && $get('project') !== ''
                                ? Modrinth::jarOptions($get('project'))
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
                ->label(fn () => Theme::trans('resources.install'))
                ->icon('tabler-download')
                ->requiresConfirmation()
                ->modalDescription(fn () => Theme::trans('resources.install_confirm'))
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

        if (!$this->stopped($server)) {
            return;
        }

        $kind = (string) ($this->data['kind'] ?? 'mod');
        $slug = (string) ($this->data['project'] ?? '');
        $versionId = (string) ($this->data['version'] ?? '');

        $version = $versionId === '' ? null : Modrinth::version($slug, $versionId);
        $jar = $version === null ? null : Modrinth::jar($version);

        if ($jar === null) {
            Notification::make()
                ->title(Theme::trans('resources.failed'))
                ->body(Theme::trans('resources.failed_version'))
                ->danger()
                ->send();

            return;
        }

        $done = Store::install($server, $kind, $jar['filename'], $jar['url']);

        Notification::make()
            ->title(Theme::trans($done ? 'resources.installed' : 'resources.failed'))
            ->body($done ? Theme::trans('resources.installed_helper') : Theme::trans('resources.failed_write'))
            ->status($done ? 'success' : 'danger')
            ->send();

        $this->load();
    }

    /**
     * Take one back out.
     *
     * The name comes from the list drawn on the page, and is checked again
     * inside Store::remove() rather than trusted for having been there - what a
     * Livewire component is handed is what the browser sent, and the browser is
     * not this page.
     */
    public function removeAction(): Action
    {
        return Action::make('remove')
            ->label(fn () => Theme::trans('resources.remove'))
            ->icon('tabler-trash')
            ->color('danger')
            ->requiresConfirmation()
            ->modalDescription(fn () => Theme::trans('resources.remove_confirm'))
            ->action(function (array $arguments): void {
                $server = $this->server();

                if ($server === null) {
                    return;
                }

                abort_unless(user()?->can(SubuserPermission::FileDelete, $server) ?? false, 403);

                if (!$this->stopped($server)) {
                    return;
                }

                $done = Store::remove(
                    $server,
                    (string) ($arguments['kind'] ?? ''),
                    (string) ($arguments['name'] ?? ''),
                );

                Notification::make()
                    ->title(Theme::trans($done ? 'resources.removed' : 'resources.failed'))
                    ->status($done ? 'success' : 'danger')
                    ->send();

                $this->load();
            });
    }

    /**
     * Both writing paths need this and both need to say the same thing, so it
     * is said once.
     *
     * Minecraft reads mods/ and plugins/ when it starts. A jar added or removed
     * beside a running server changes nothing until a restart, and a jar pulled
     * out from under a running game can take the game with it.
     */
    private function stopped(Server $server): bool
    {
        if (Minecraft::isStopped($server)) {
            return true;
        }

        Notification::make()
            ->title(Theme::trans('resources.running'))
            ->body(Theme::trans('resources.running_helper'))
            ->warning()
            ->send();

        return false;
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
