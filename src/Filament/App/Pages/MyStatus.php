<?php

namespace LegendDevelopment\Theme\Filament\App\Pages;

use App\Models\Server;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use LegendDevelopment\Theme\Support\Status\Pages as Store;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * A status page of your own, for the people who play on your servers.
 *
 * In the client panel rather than in admin, because this belongs to whoever
 * owns the servers. Somebody running four Minecraft servers for their friends
 * wants one address to put in a Discord, showing their four - and should not
 * have to ask the panel's owner every time they add one.
 *
 * No permission of its own. It publishes servers this person already owns,
 * under names they type, and an administrator who does not want any of it can
 * switch user pages off in one place. Gating it per role would mean every
 * ordinary user needing to be granted something before they could make a page
 * about their own machines, which is the same mistake the star on a server card
 * made for two releases.
 *
 * What it will not let anybody do is on the other side, in Status\Pages: their
 * own servers only, no nodes, no HTTP monitors.
 *
 * @property Schema $form
 */
class MyStatus extends Page implements HasSchemas
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-world-share';

    protected static ?string $slug = 'my-status';

    protected static ?int $navigationSort = 91;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public static function canAccess(): bool
    {
        try {
            return Store::enabled() && user() !== null;
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('status.mine_title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('status.mine_subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('status.mine_nav_label');
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.my-status';
    }

    public function mount(): void
    {
        $this->form->fill(Store::of($this->userId()));
    }

    private function userId(): int
    {
        return (int) (user()?->id ?? 0);
    }

    /** Where this person's page is, or null while they have no slug. */
    public function address(): ?string
    {
        $slug = Store::of($this->userId())['slug'];

        return $slug === '' ? null : url('/status/' . $slug);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(Theme::trans('status.mine_address'))
                    ->description(Theme::trans('status.mine_address_helper'))
                    ->schema([
                        TextInput::make('slug')
                            ->label(Theme::trans('status.slug'))
                            ->helperText(Theme::trans('status.slug_helper'))
                            ->prefix(rtrim(url('/status'), '/') . '/')
                            ->maxLength(32)
                            /*
                             * Checked here for the message, and again in
                             * Status\Pages before anything is written. The rule
                             * here is so a bad slug is a red field with a reason
                             * rather than a save that quietly did nothing.
                             */
                            ->rule('regex:/^[a-z0-9](?:[a-z0-9-]{1,30}[a-z0-9])?$/')
                            ->required(),

                        TextInput::make('title')
                            ->label(Theme::trans('status.mine_heading'))
                            ->helperText(Theme::trans('status.mine_heading_helper'))
                            ->maxLength(60),

                        Textarea::make('note')
                            ->label(Theme::trans('status.note'))
                            ->helperText(Theme::trans('status.mine_note_helper'))
                            ->maxLength(300)
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make(Theme::trans('status.look'))
                    ->description(Theme::trans('status.mine_look_helper'))
                    ->schema([
                        ColorPicker::make('accent')
                            ->label(Theme::trans('status.accent'))
                            ->helperText(Theme::trans('status.accent_helper')),

                        Select::make('mode')
                            ->label(Theme::trans('status.mode'))
                            ->helperText(Theme::trans('status.mode_helper'))
                            ->options([
                                'dark' => Theme::trans('status.mode_dark'),
                                'light' => Theme::trans('status.mode_light'),
                                'auto' => Theme::trans('status.mode_auto'),
                            ])
                            ->selectablePlaceholder(false),
                    ])
                    ->columns(2),

                Section::make(Theme::trans('status.mine_which'))
                    ->description(Theme::trans('status.mine_which_helper'))
                    ->schema([
                        Repeater::make('servers')
                            ->label('')
                            ->addActionLabel(Theme::trans('status.add'))
                            ->schema([
                                Select::make('id')
                                    ->label(Theme::trans('status.server'))
                                    ->options(fn (): array => $this->mine())
                                    ->searchable()
                                    ->required(),

                                TextInput::make('name')
                                    ->label(Theme::trans('status.shown_as'))
                                    ->helperText(Theme::trans('status.mine_shown_as_helper'))
                                    ->maxLength(60)
                                    ->required(),
                            ])
                            ->columns(2)
                            ->maxItems(Store::MAX_SERVERS)
                            ->defaultItems(0),
                    ]),
            ])
            ->statePath('data');
    }

    /**
     * The servers this person owns.
     *
     * owner_id, not accessibleServers(). Being a subuser on somebody else's
     * machine is access, and access is not the same as the right to publish
     * that the machine exists, under a name of your choosing, to the internet.
     *
     * @return array<int, string>
     */
    private function mine(): array
    {
        try {
            return Server::query()
                ->where('owner_id', $this->userId())
                ->orderBy('name')
                ->limit(200)
                ->get()
                ->mapWithKeys(static fn (Server $server): array => [(int) $server->id => (string) $server->name])
                ->all();
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        $actions = [
            Action::make('ld_save')
                ->label(Theme::trans('status.save'))
                ->icon('tabler-device-floppy')
                ->action(fn () => $this->save()),
        ];

        if ($this->address() !== null) {
            $actions[] = Action::make('ld_open')
                ->label(Theme::trans('status.open'))
                ->icon('tabler-external-link')
                ->color('gray')
                ->url($this->address())
                ->openUrlInNewTab();

            $actions[] = Action::make('ld_remove')
                ->label(Theme::trans('status.mine_remove'))
                ->icon('tabler-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->modalDescription(Theme::trans('status.mine_remove_confirm'))
                ->action(fn () => $this->remove());
        }

        return $actions;
    }

    public function save(): void
    {
        $problem = Store::put($this->userId(), $this->form->getState());

        if ($problem === null) {
            Notification::make()->title(Theme::trans('status.saved'))->success()->send();

            return;
        }

        /*
         * Written out rather than built from the reason.
         *
         * tools/check-lang.js can only verify a literal, and 'status.why_' .
         * $problem would hide three keys from the check that exists because two
         * of them once shipped broken and rendered as their own names.
         */
        $why = match ($problem) {
            'slug' => Theme::trans('status.why_slug'),
            'taken' => Theme::trans('status.why_taken'),
            default => Theme::trans('status.why_unwritable'),
        };

        Notification::make()
            ->title(Theme::trans('status.save_failed'))
            ->body($why)
            ->danger()
            ->send();
    }

    private function remove(): void
    {
        Store::forget($this->userId());

        $this->form->fill(Store::of($this->userId()));

        Notification::make()->title(Theme::trans('status.mine_removed'))->success()->send();
    }
}
