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
use LegendDevelopment\Theme\Support\Minecraft\Ledger;
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

    /**
     * What the last update check found, keyed the way the ledger keys things.
     *
     * Empty until somebody presses the button. Not done on load: it is one
     * request per distinct project, and a page that quietly made sixty of them
     * every time it was opened would be a page that got this plugin blocked
     * rather than a page that was helpful.
     *
     * @var array<string, array{number: string, id: string}>
     */
    public array $updates = [];

    public bool $checked = false;

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

            // Beside Install rather than beside the list, because it is about
            // everything below it rather than about any one row.
            $this->checkAction(),
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

        if ($done) {
            // Written down at the one moment the project is known for certain.
            // Without this the file is a name in a folder and there is no such
            // thing as updating it. See Support\Minecraft\Ledger.
            Ledger::remember($server, $kind, $jar['filename'], $slug, $slug, $version);
        }

        Notification::make()
            ->title(Theme::trans($done ? 'resources.installed' : 'resources.failed'))
            ->body($done ? Theme::trans('resources.installed_helper') : Theme::trans('resources.failed_write'))
            ->status($done ? 'success' : 'danger')
            ->send();

        $this->load();
    }

    /**
     * Change which version of a mod or plugin is installed.
     *
     * The same modal answers three questions people ask separately - update
     * this, put it back to the old one, and what even is this - because they
     * are one operation: put a different version of the same project in this
     * file's place.
     *
     * The project is prefilled and fixed for anything installed from here. For
     * a jar that was already in the folder it has to be chosen once, and is
     * then remembered - Support\Minecraft\Ledger explains why it cannot be
     * worked out instead.
     */
    public function changeAction(): Action
    {
        return Action::make('change')
            ->label(fn () => Theme::trans('resources.change'))
            ->icon('tabler-refresh')
            ->iconButton()
            ->size('sm')
            ->tooltip(fn () => Theme::trans('resources.change'))
            ->modalDescription(fn () => Theme::trans('resources.change_helper'))
            ->fillForm(fn (array $arguments): array => [
                'project' => is_string($arguments['project'] ?? null) ? $arguments['project'] : null,
                'version' => null,
            ])
            ->schema([
                TextInput::make('lookup')
                    ->label(fn () => Theme::trans('resources.search'))
                    ->helperText(fn () => Theme::trans('resources.change_lookup_helper'))
                    // Only for a file nothing is known about. With the project
                    // already fixed there is nothing left to search for.
                    ->visible(fn (array $arguments): bool => !is_string($arguments['project'] ?? null))
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set): void {
                        $set('project', null);
                        $set('version', null);
                    }),

                Select::make('project')
                    ->label(fn () => Theme::trans('resources.project'))
                    ->helperText(fn () => Theme::trans('resources.change_project_helper'))
                    ->options(function (Get $get, array $arguments): array {
                        $known = is_string($arguments['project'] ?? null) ? $arguments['project'] : null;

                        /*
                         * A known file is offered only what it already is.
                         * Changing the project of an installed jar is not a
                         * version change - it is a different mod wearing this
                         * one's filename, and the ledger would then be a record
                         * of something untrue.
                         */
                        if ($known !== null) {
                            return [$known => $known];
                        }

                        return Modrinth::options(
                            (string) ($get('lookup') ?? ''),
                            (string) ($arguments['kind'] ?? 'mod'),
                        );
                    })
                    ->disabled(fn (array $arguments): bool => is_string($arguments['project'] ?? null))
                    ->searchable()
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn (Set $set) => $set('version', null)),

                Select::make('version')
                    ->label(fn () => Theme::trans('resources.version'))
                    ->helperText(fn () => Theme::trans('resources.version_helper'))
                    ->options(fn (Get $get): array => is_string($get('project')) && $get('project') !== ''
                        ? Modrinth::jarOptions($get('project'))
                        : [])
                    ->searchable()
                    ->required()
                    ->live(),
            ])
            ->action(fn (array $data, array $arguments) => $this->change($data, $arguments));
    }

    /**
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $arguments
     */
    private function change(array $data, array $arguments): void
    {
        $server = $this->server();

        if ($server === null) {
            return;
        }

        abort_unless(user()?->can(SubuserPermission::FileUpdate, $server) ?? false, 403);

        if (!$this->stopped($server)) {
            return;
        }

        $kind = (string) ($arguments['kind'] ?? '');
        $old = (string) ($arguments['name'] ?? '');
        $slug = (string) ($data['project'] ?? '');
        $versionId = (string) ($data['version'] ?? '');

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

        $done = Store::replace($server, $kind, $old, $jar['filename'], $jar['url']);

        if ($done) {
            Ledger::remember($server, $kind, $jar['filename'], $slug, $slug, $version);
        }

        Notification::make()
            ->title(Theme::trans($done ? 'resources.changed' : 'resources.failed'))
            ->body($done ? Theme::trans('resources.installed_helper') : Theme::trans('resources.failed_write'))
            ->status($done ? 'success' : 'danger')
            ->send();

        $this->load();
    }

    /**
     * Ask Modrinth what the newest version of each installed thing is.
     *
     * On a button rather than on load. It is one request per distinct project,
     * cached for ten minutes, and a page that quietly made sixty of them every
     * time somebody opened it would be a page that got this plugin blocked
     * rather than one that was being helpful.
     *
     * Only files the ledger knows can be checked at all. The rest are listed
     * with the same button, which asks what they are once and then knows.
     */
    public function checkAction(): Action
    {
        return Action::make('check')
            ->label(fn () => Theme::trans('resources.check'))
            ->icon('tabler-refresh')
            ->color('gray')
            ->action(function (): void {
                $found = [];
                $seen = [];

                foreach (['mod', 'plugin'] as $kind) {
                    foreach ($this->installed[$kind] ?? [] as $file) {
                        $slug = $file['project'] ?? null;

                        if (!is_string($slug) || $slug === '') {
                            continue;
                        }

                        // One lookup per project rather than per file: two jars
                        // of one project is unusual, not impossible.
                        $newest = $seen[$slug] ??= Modrinth::newest($slug);

                        if ($newest === null) {
                            continue;
                        }

                        $id = (string) ($newest['id'] ?? '');

                        if ($id !== '' && $id !== ($file['version'] ?? null)) {
                            $found[Store::folder($kind) . '/' . $file['name']] = [
                                'number' => (string) ($newest['version_number'] ?? $id),
                                'id' => $id,
                            ];
                        }
                    }
                }

                $this->updates = $found;
                $this->checked = true;

                Notification::make()
                    ->title(Theme::trans('resources.checked'))
                    ->body($found === []
                        ? Theme::trans('resources.checked_none')
                        : Theme::trans('resources.checked_some', ['count' => count($found)]))
                    ->success()
                    ->send();
            });
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
            // Icon-only, with the label as its tooltip, for the same reason as
            // the buttons on the players page: a word per button makes the row
            // wider than the page and the button ends up outside it.
            ->iconButton()
            ->size('sm')
            ->tooltip(fn () => Theme::trans('resources.remove'))
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
