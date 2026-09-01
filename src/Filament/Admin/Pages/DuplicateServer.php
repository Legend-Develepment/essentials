<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use App\Models\Server;
use BackedEnum;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
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
use LegendDevelopment\Theme\Support\Duplicate;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Another server exactly like one that already exists, or eight of them.
 *
 * A page rather than a button on the server itself, and that is a limit rather
 * than a preference: this plugin overrides no Blade template, and Pelican's
 * server pages are its own. A page is what can be added without touching them.
 *
 * What it does not do is copy the disk. See Support\Duplicate - the form says
 * so as well, because a button that quietly did or did not copy somebody's
 * world save would be worse than either.
 *
 * @property Schema $form
 */
class DuplicateServer extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-copy';

    protected static ?string $slug = 'essentials-duplicate';

    protected static ?int $navigationSort = 6;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public static function canAccess(): bool
    {
        return Features::maySee(Features::DUPLICATE);
    }

    public static function shouldRegisterNavigation(): bool
    {
        return Features::maySee(Features::DUPLICATE) && parent::shouldRegisterNavigation();
    }

    public function getTitle(): string
    {
        return Theme::trans('duplicate.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('duplicate.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('duplicate.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return Theme::name();
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.theme-settings';
    }

    public function mount(): void
    {
        $this->form->fill(['copies' => 1]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(fn () => Theme::trans('duplicate.section'))
                    ->description(fn () => Theme::trans('duplicate.section_helper'))
                    ->icon('tabler-copy')
                    ->iconColor('primary')
                    ->columns(2)
                    ->schema([
                        Select::make('server')
                            ->label(fn () => Theme::trans('duplicate.source'))
                            ->helperText(fn () => Theme::trans('duplicate.source_helper'))
                            ->options(fn (): array => self::servers())
                            ->searchable()
                            ->required()
                            ->live()
                            // Naming the copy after the source is what somebody
                            // was going to type anyway, and it is one fewer
                            // field to fill in before pressing the button.
                            ->afterStateUpdated(function (mixed $state, Set $set): void {
                                $source = self::server($state);

                                if ($source !== null) {
                                    $set('name', mb_substr($source->name . ' copy', 0, 191));
                                }
                            })
                            ->columnSpanFull(),

                        TextInput::make('name')
                            ->label(fn () => Theme::trans('duplicate.name'))
                            ->helperText(fn () => Theme::trans('duplicate.name_helper'))
                            ->maxLength(191)
                            ->required(),

                        Select::make('copies')
                            ->label(fn () => Theme::trans('duplicate.copies'))
                            ->helperText(fn (Get $get): string => self::roomHelper($get('server')))
                            ->options(fn (Get $get): array => self::counts($get('server')))
                            ->selectablePlaceholder(false)
                            ->live()
                            ->required(),
                    ]),
            ])
            ->statePath('data');
    }

    /** @var array<int, string>|null */
    private static ?array $servers = null;

    /** @var array<int, Server|null> */
    private static array $looked = [];

    /**
     * Every server, named with the node it is on.
     *
     * Three things here are about not doing the same work repeatedly, and each
     * was measurable rather than tidy:
     *
     * `with('node')` because `$server->node->name` inside the loop is one query
     * per server. A panel with two hundred servers ran two hundred and one
     * queries to fill one picker; it runs two.
     *
     * `select` because nothing here needs a server's startup command, its
     * docker labels or its limits - only its name and where it lives. Hydrating
     * the rest is memory spent on columns that are never read.
     *
     * And memoised, because Filament evaluates an options closure more than
     * once while a page is built and this answer cannot change in between.
     *
     * @return array<int, string>
     */
    private static function servers(): array
    {
        if (self::$servers !== null) {
            return self::$servers;
        }

        try {
            return self::$servers = Server::query()
                ->select(['id', 'name', 'node_id'])
                ->with('node:id,name')
                ->orderBy('name')
                ->get()
                ->mapWithKeys(fn (Server $server): array => [
                    $server->id => $server->name . ' — ' . ($server->node->name ?? '?'),
                ])
                ->all();
        } catch (Throwable) {
            return self::$servers = [];
        }
    }

    /**
     * One server, looked up once.
     *
     * The helper text under the count asks for this on every render, and so
     * does the name field when the picker changes. Without the memo that was a
     * query each time, for a row that cannot have changed inside one request.
     */
    private static function server(mixed $id): ?Server
    {
        if (!is_numeric($id)) {
            return null;
        }

        $id = (int) $id;

        if (array_key_exists($id, self::$looked)) {
            return self::$looked[$id];
        }

        try {
            return self::$looked[$id] = Server::query()->find($id);
        } catch (Throwable) {
            return self::$looked[$id] = null;
        }
    }

    /**
     * How many copies the node has room for, as the picker's options.
     *
     * @return array<int, string>
     */
    private static function counts(mixed $id): array
    {
        $source = self::server($id);
        $room = $source === null ? 0 : Duplicate::room($source);

        $counts = [];

        for ($i = 1; $i <= max(1, $room); $i++) {
            $counts[$i] = (string) $i;
        }

        return $counts;
    }

    private static function roomHelper(mixed $id): string
    {
        $source = self::server($id);

        if ($source === null) {
            return Theme::trans('duplicate.copies_helper');
        }

        $free = count(Duplicate::freeAllocations($source));

        return $free === 0
            ? Theme::trans('duplicate.no_room', ['node' => $source->node->name ?? '?'])
            : Theme::trans('duplicate.room', [
                'count' => $free,
                'node' => $source->node->name ?? '?',
            ]);
    }

    public function save(): void
    {
        abort_unless(Features::mayManage(Features::DUPLICATE), 403);

        $state = $this->form->getState();
        $source = self::server($state['server'] ?? null);

        if ($source === null) {
            return;
        }

        $copies = max(1, (int) ($state['copies'] ?? 1));

        /*
         * Read again here rather than trusting what the picker offered. The
         * list was built when the page was drawn, and somebody else creating a
         * server in the meantime is the ordinary case on a busy panel, not the
         * unlucky one.
         */
        $free = array_keys(Duplicate::freeAllocations($source));

        if (count($free) < $copies) {
            Notification::make()
                ->title(Theme::trans('duplicate.failed'))
                ->body(Theme::trans('duplicate.no_room', ['node' => $source->node->name ?? '?']))
                ->danger()
                ->send();

            return;
        }

        try {
            $result = Duplicate::make(
                $source,
                (string) ($state['name'] ?? $source->name),
                array_slice($free, 0, $copies),
            );
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('duplicate.failed'))
                ->body($exception->getMessage())
                ->danger()
                ->send();

            return;
        }

        if ($result['made'] !== []) {
            Notification::make()
                ->title(Theme::trans('duplicate.made', ['count' => count($result['made'])]))
                ->body(implode(', ', $result['made']))
                ->success()
                ->send();
        }

        // Both, when some worked and some did not. A count of successes on its
        // own would leave somebody counting servers to find out what happened.
        if ($result['failed'] !== []) {
            Notification::make()
                ->title(Theme::trans('duplicate.partly_failed', ['count' => count($result['failed'])]))
                ->body(implode("\n", $result['failed']))
                ->danger()
                ->persistent()
                ->send();
        }
    }
}
