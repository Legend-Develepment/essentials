<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use App\Models\Server;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Settings;
use LegendDevelopment\Theme\Support\Status\Publish;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Who gets to see what, on the one page that has no login in front of it.
 *
 * Every field here is a decision about what leaves the panel, so the page is
 * shaped around that rather than around the settings. The list of servers comes
 * first and is empty; until something is in it there is no public page at all,
 * whatever else is set.
 *
 * The name is typed rather than chosen, and that is the important one. A server
 * called "mc-prod-3 (Bryan's, do not touch)" is an internal note, and a status
 * page that helpfully used the real name would publish it. So the field is
 * blank, it is required, and a row without one is dropped rather than filled in
 * from somewhere.
 *
 * @property Schema $form
 */
class PublicStatus extends Page implements HasSchemas
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-world-share';

    protected static ?string $slug = 'essentials-status';

    protected static ?int $navigationSort = 11;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public static function canAccess(): bool
    {
        try {
            return Features::maySee(Features::PUBLIC_STATUS);
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('status.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('status.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('status.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return Theme::name();
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.public-status';
    }

    public function mount(): void
    {
        $this->form->fill(Settings::statusData());
    }

    /** Where the page is, for the link on this one. */
    public function address(): string
    {
        return url('/status');
    }

    public function live(): bool
    {
        try {
            return Publish::enabled();
        } catch (Throwable) {
            return false;
        }
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(Theme::trans('status.which'))
                    ->description(Theme::trans('status.which_helper'))
                    ->schema([
                        Repeater::make('status_servers')
                            ->label('')
                            ->addActionLabel(Theme::trans('status.add'))
                            ->schema([
                                Select::make('id')
                                    ->label(Theme::trans('status.server'))
                                    ->options(fn (): array => self::options())
                                    ->searchable()
                                    ->required(),

                                TextInput::make('name')
                                    ->label(Theme::trans('status.shown_as'))
                                    ->helperText(Theme::trans('status.shown_as_helper'))
                                    ->maxLength(60)
                                    ->required(),
                            ])
                            ->columns(2)
                            ->reorderable(false)
                            ->defaultItems(0),
                    ]),

                Section::make(Theme::trans('status.look'))
                    ->description(Theme::trans('status.look_helper'))
                    ->schema([
                        TextInput::make('status_title')
                            ->label(Theme::trans('status.heading'))
                            ->helperText(Theme::trans('status.heading_helper'))
                            ->maxLength(60),

                        Toggle::make('status_link')
                            ->label(Theme::trans('status.link'))
                            ->helperText(Theme::trans('status.link_helper'))
                            ->inline(false),

                        Textarea::make('status_note')
                            ->label(Theme::trans('status.note'))
                            ->helperText(Theme::trans('status.note_helper'))
                            ->maxLength(300)
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ])
            ->disabled(!Features::mayManage(Features::PUBLIC_STATUS))
            ->statePath('data');
    }

    /**
     * Which servers may be chosen.
     *
     * accessibleServers(), so somebody can only publish a server they could
     * already open. The name shown here is the real one - this is the admin
     * side, where knowing which server you are picking is the point.
     *
     * @return array<int, string>
     */
    private static function options(): array
    {
        try {
            return user()?->accessibleServers()
                ->orderBy('servers.name')
                ->limit(500)
                ->get()
                ->mapWithKeys(static fn (Server $server): array => [(int) $server->id => (string) $server->name])
                ->all() ?? [];
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        $actions = [];

        if (Features::mayManage(Features::PUBLIC_STATUS)) {
            $actions[] = Action::make('ld_save')
                ->label(Theme::trans('status.save'))
                ->icon('tabler-device-floppy')
                ->action(fn () => $this->save());
        }

        // Only when there is one to open. A link to a 404 is worse than no link.
        if ($this->live()) {
            $actions[] = Action::make('ld_open')
                ->label(Theme::trans('status.open'))
                ->icon('tabler-external-link')
                ->color('gray')
                ->url($this->address())
                ->openUrlInNewTab();
        }

        return $actions;
    }

    public function save(): void
    {
        abort_unless(Features::mayManage(Features::PUBLIC_STATUS), 403);

        try {
            Settings::persistStatus($this->form->getState());
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('status.save_failed'))
                ->body($exception->getMessage())
                ->danger()
                ->persistent()
                ->send();

            return;
        }

        Notification::make()->title(Theme::trans('status.saved'))->success()->send();
    }
}
