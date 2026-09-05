<?php

namespace LegendDevelopment\Theme\Filament\Server\Pages;

use App\Enums\SubuserPermission;
use App\Models\Server;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Facades\Filament;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use LegendDevelopment\Theme\Support\Games\Names;
use LegendDevelopment\Theme\Support\Games\Valheim;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Valheim's three name lists: admins, banned, permitted.
 *
 * No settings form beside them, and that is a finding rather than a gap. A
 * Valheim server is configured by its start-up arguments - name, world,
 * password, crossplay - and Pelican's Startup page already edits every one of
 * them. These three files are what Pelican has no answer for, so these three
 * files are the page.
 *
 * Each list is a set of identifiers rather than lines, which is why the form
 * uses chips: two of the same admin is a mistake, and the order they were added
 * in is not information. The comment header the game writes above them is kept -
 * see Support\Games\Names.
 *
 * @property Schema $form
 */
class ValheimLists extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-users-group';

    protected static ?string $slug = 'valheim-lists';

    protected static ?int $navigationSort = 7;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    /**
     * Each list as its file holds it, or null for a file that is not there.
     *
     * Held for two reasons: saving writes the names back into the file that was
     * read, so the game's own comment header survives, and a list that is null
     * is a file the server has never written - which the page says rather than
     * showing an empty box that looks like an empty list.
     *
     * @var array<string, string|null>
     */
    public array $files = [];

    public static function canAccess(): bool
    {
        try {
            $server = Filament::getTenant();

            return $server instanceof Server
                && Valheim::detect($server)
                && (user()?->can(SubuserPermission::FileReadContent, $server) ?? false);
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('valheim.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('valheim.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('valheim.nav_label');
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.valheim-lists';
    }

    public function mount(): void
    {
        $this->read();
    }

    public function mayEdit(): bool
    {
        try {
            $server = $this->server();

            return $server !== null
                && (user()?->can(SubuserPermission::FileUpdate, $server) ?? false);
        } catch (Throwable) {
            return false;
        }
    }

    /** Whether the server has written any of these files yet. */
    public function found(): bool
    {
        foreach ($this->files as $contents) {
            if ($contents !== null) {
                return true;
            }
        }

        return false;
    }

    /** Where the lists were found, for the page to say so. */
    public function where(): string
    {
        $server = $this->server();

        return $server === null ? '' : Valheim::dir($server);
    }

    public function read(): void
    {
        $server = $this->server();

        if ($server === null) {
            return;
        }

        $state = [];

        foreach (array_keys(Valheim::LISTS) as $list) {
            $contents = Valheim::contents($server, $list);

            $this->files[$list] = $contents;
            $state[$list] = $contents === null ? [] : Names::parse($contents);
        }

        $this->form->fill($state);
    }

    public function form(Schema $schema): Schema
    {
        // Disabled on the field rather than on the schema: every Filament field
        // carries disabled(), and whether the schema itself does is something
        // this codebase cannot check - a call that does not exist is a 500 on
        // the page rather than a form that ignores it.
        $may = $this->mayEdit();
        $sections = [];

        foreach (array_keys(Valheim::LISTS) as $list) {
            $sections[] = Section::make(fn (): string => Theme::trans('valheim.' . $list))
                ->description(fn (): string => Theme::trans('valheim.' . $list . '_helper'))
                ->schema([
                    TagsInput::make($list)
                        ->label(fn (): string => Theme::trans('valheim.ids'))
                        ->placeholder(fn (): string => Theme::trans('valheim.ids_placeholder'))
                        // Space and tab as well as a comma, so a list pasted
                        // from somewhere else arrives as a list rather than as
                        // one very long identifier.
                        ->splitKeys(['Tab', ' ', ','])
                        ->separator()
                        ->disabled(!$may)
                        ->columnSpanFull(),
                ]);
        }

        return $schema->components($sections)->statePath('data');
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

    /**
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        if (!$this->mayEdit()) {
            return [];
        }

        return [
            Action::make('ld_save')
                ->label(Theme::trans('valheim.save'))
                ->icon('tabler-device-floppy')
                ->action(fn () => $this->save()),
        ];
    }

    public function save(): void
    {
        $server = $this->server();

        abort_unless($server !== null && $this->mayEdit(), 403);

        $written = 0;
        $failed = [];

        try {
            $state = $this->form->getState();

            foreach (array_keys(Valheim::LISTS) as $list) {
                $names = $state[$list] ?? [];
                $names = is_array($names) ? $names : [];

                /*
                 * Only the lists that changed.
                 *
                 * Three writes on every save would rewrite two files nobody
                 * touched, and one of those is a ban list - the last file to
                 * rewrite for no reason.
                 */
                if (Names::same($this->files[$list] ?? '', $names)) {
                    continue;
                }

                if (Valheim::write($server, $list, $names)) {
                    $written++;

                    continue;
                }

                $failed[] = Theme::trans('valheim.' . $list);
            }
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('valheim.failed'))
                ->body($exception->getMessage())
                ->danger()
                ->persistent()
                ->send();

            return;
        }

        if ($failed !== []) {
            Notification::make()
                ->title(Theme::trans('valheim.failed'))
                ->body(Theme::trans('valheim.failed_lists', ['lists' => implode(', ', $failed)]))
                ->danger()
                ->persistent()
                ->send();

            return;
        }

        if ($written === 0) {
            Notification::make()
                ->title(Theme::trans('valheim.unchanged'))
                ->send();

            return;
        }

        // Read back, so the page shows the files rather than what was sent to
        // them - and so a duplicate the form allowed is visibly gone.
        $this->read();

        Notification::make()
            ->title(Theme::trans('valheim.saved'))
            ->body(Theme::trans('valheim.saved_reload'))
            ->success()
            ->send();
    }
}
