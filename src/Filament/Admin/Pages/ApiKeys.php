<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use LegendDevelopment\Theme\Filament\Concerns\OffersApiDocs;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use LegendDevelopment\Theme\Models\Key;
use LegendDevelopment\Theme\Support\Api\Keys;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Settings;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Every key the panel has issued, and everybody waiting for one.
 *
 * The administrator's whole view of the API: who holds a key, what it reaches,
 * when it was last used, and one button each to grant, refuse or take away. A
 * page rather than a section on the settings form, because the settings are the
 * small half - three fields - and the list is the half somebody comes back to.
 *
 * **What is not on this page is the point of it.** No key is readable here. A
 * granted key is shown once, in the box at the top, and stored as a hash - so
 * an administrator with this page open cannot read somebody's key any more than
 * an attacker with the database can. What they can do is end it, which is the
 * capability that actually matters.
 *
 * @property Schema $form
 */
class ApiKeys extends Page implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithForms;
    use InteractsWithTable;
    use OffersApiDocs;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-plug-connected';

    protected static ?string $slug = 'essentials-api';

    protected static ?int $navigationSort = 11;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    /**
     * A key that was granted a moment ago, held for exactly one render.
     *
     * It is never stored and never re-read: the hash in the table cannot
     * produce it, so if this is lost before somebody copies it the only way
     * forward is to revoke and issue another. The page says so beside it rather
     * than leaving it to be discovered.
     */
    public ?string $fresh = null;

    public static function canAccess(): bool
    {
        try {
            return Features::maySee(Features::API) && Keys::ready();
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('api.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('api.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('api.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return Theme::name();
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.api-keys';
    }

    public function mount(): void
    {
        $this->form->fill(Settings::apiData());
    }

    public function form(Schema $schema): Schema
    {
        $may = Features::mayManage(Features::API);

        return $schema
            ->components([
                Section::make(Theme::trans('api.settings'))
                    ->description(Theme::trans('api.uninstall_note'))
                    ->schema([
                        Toggle::make('api_approval')
                            ->label(Theme::trans('api.approval'))
                            ->helperText(Theme::trans('api.approval_helper'))
                            ->disabled(!$may),

                        TextInput::make('api_rate')
                            ->label(Theme::trans('api.rate'))
                            ->helperText(Theme::trans('api.rate_helper'))
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(1000)
                            ->disabled(!$may),

                        TextInput::make('api_days')
                            ->label(Theme::trans('api.days'))
                            ->helperText(Theme::trans('api.days_helper'))
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(3650)
                            ->placeholder(Theme::trans('api.days_never'))
                            ->disabled(!$may),
                    ])
                    ->columns(['default' => 1, 'sm' => 2, 'lg' => 3])
                    ->collapsed(),
            ])
            ->statePath('data');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Key::query()->with(['user', 'decider']))
            ->defaultPaginationPageOption(25)
            /*
             * Waiting first, then newest. The page exists to be acted on, and
             * the rows that need acting on are the ones nobody has answered.
             */
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('state')
                    ->label(Theme::trans('api.state'))
                    ->badge()
                    ->color(static fn (string $state): string => match ($state) {
                        Key::ACTIVE => 'success',
                        Key::PENDING => 'warning',
                        Key::REFUSED => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(static fn (string $state): string => Theme::trans('api.state_' . $state)),

                TextColumn::make('name')
                    ->label(Theme::trans('api.column_name'))
                    ->searchable()
                    ->wrap()
                    ->weight('medium')
                    ->description(static fn (Key $record): ?string => $record->reason ?: null),

                TextColumn::make('user.username')
                    ->label(Theme::trans('api.column_owner'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('scope')
                    ->label(Theme::trans('api.scope'))
                    ->formatStateUsing(static fn (string $state): string => Theme::trans('api.scope_' . $state))
                    ->tooltip(static fn (Key $record): string => Theme::trans('api.scope_' . $record->scope . '_helper')),

                /*
                 * The public half, shown so two of somebody's own keys can be
                 * told apart in a support conversation without either of them
                 * being readable.
                 */
                TextColumn::make('prefix')
                    ->label(Theme::trans('api.column_prefix'))
                    ->fontFamily('mono')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('last_used_at')
                    ->label(Theme::trans('api.column_used'))
                    ->since()
                    ->sortable()
                    ->placeholder(Theme::trans('api.never_used')),

                TextColumn::make('expires_at')
                    ->label(Theme::trans('api.column_expires'))
                    ->date()
                    ->sortable()
                    ->placeholder(Theme::trans('api.no_expiry')),

                TextColumn::make('created_at')
                    ->label(Theme::trans('api.column_asked'))
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('state')
                    ->label(Theme::trans('api.state'))
                    ->options([
                        Key::PENDING => Theme::trans('api.state_pending'),
                        Key::ACTIVE => Theme::trans('api.state_active'),
                        Key::REFUSED => Theme::trans('api.state_refused'),
                        Key::REVOKED => Theme::trans('api.state_revoked'),
                    ]),
            ])
            ->recordActions([
                Action::make('ld_grant')
                    ->label(Theme::trans('api.grant'))
                    ->icon('tabler-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalDescription(Theme::trans('api.grant_confirm'))
                    ->visible(static fn (Key $record): bool => $record->state === Key::PENDING && Features::mayManage(Features::API))
                    ->action(fn (Key $record) => $this->grant($record)),

                Action::make('ld_refuse')
                    ->label(Theme::trans('api.refuse'))
                    ->icon('tabler-x')
                    ->color('danger')
                    ->schema([
                        Textarea::make('answer')
                            ->label(Theme::trans('api.refuse_answer'))
                            ->helperText(Theme::trans('api.refuse_answer_helper'))
                            ->maxLength(500),
                    ])
                    ->visible(static fn (Key $record): bool => $record->state === Key::PENDING && Features::mayManage(Features::API))
                    ->action(fn (Key $record, array $data) => $this->refuse($record, (string) ($data['answer'] ?? ''))),

                Action::make('ld_revoke')
                    ->label(Theme::trans('api.revoke'))
                    ->icon('tabler-plug-connected-x')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalDescription(Theme::trans('api.revoke_confirm'))
                    ->visible(static fn (Key $record): bool => $record->state === Key::ACTIVE && Features::mayManage(Features::API))
                    ->action(fn (Key $record) => $this->revoke($record)),

                /*
                 * And then off the page entirely.
                 *
                 * Offered only for a key that has already stopped answering.
                 * Revoking is the act that stops something working, and it
                 * should not be possible to make a working key disappear
                 * without that having happened first - which also leaves the
                 * revocation on the page for as long as anybody wants to see
                 * it. A refusal may go straight away: nothing was ever issued.
                 */
                Action::make('ld_forget')
                    ->label(Theme::trans('api.forget'))
                    ->icon('tabler-trash')
                    ->color('gray')
                    ->requiresConfirmation()
                    ->modalDescription(Theme::trans('api.forget_confirm'))
                    ->visible(static fn (Key $record): bool => in_array($record->state, [Key::REVOKED, Key::REFUSED], true)
                        && Features::mayManage(Features::API))
                    ->action(fn (Key $record) => $this->forget($record)),
            ])
            ->emptyStateHeading(Theme::trans('api.empty'))
            ->emptyStateDescription(Theme::trans('api.empty_body'))
            ->emptyStateIcon('tabler-plug-connected');
    }

    /** @return array<int, Action> */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('ld_mint')
                ->label(Theme::trans('api.mint'))
                ->icon('tabler-plus')
                ->modalDescription(Theme::trans('api.mint_body'))
                ->visible(static fn (): bool => Features::mayManage(Features::API))
                ->schema([
                    TextInput::make('name')
                        ->label(Theme::trans('api.ask_name'))
                        ->helperText(Theme::trans('api.ask_name_helper'))
                        ->required()
                        ->maxLength(60),

                    Select::make('user_id')
                        ->label(Theme::trans('api.mint_owner'))
                        ->helperText(Theme::trans('api.mint_owner_helper'))
                        ->options(static fn (): array => User::query()
                            ->orderBy('username')
                            ->limit(200)
                            ->pluck('username', 'id')
                            ->all())
                        ->searchable()
                        ->required(),

                    Select::make('scope')
                        ->label(Theme::trans('api.scope'))
                        ->options([
                            Key::PERSON => Theme::trans('api.scope_person'),
                            Key::PANEL => Theme::trans('api.scope_panel'),
                        ])
                        ->default(Key::PERSON)
                        ->selectablePlaceholder(false)
                        ->required(),
                ])
                ->action(fn (array $data) => $this->mint($data)),

            Action::make('ld_save')
                ->label(Theme::trans('alerts.save'))
                ->icon('tabler-device-floppy')
                ->color('gray')
                ->visible(static fn (): bool => Features::mayManage(Features::API))
                ->action(fn () => $this->save()),

            // The documentation is folded into this page rather than given a
            // sidebar row of its own; these take it away as a file.
            ...$this->apiDocsActions(),
        ];
    }

    public function save(): void
    {
        abort_unless(Features::mayManage(Features::API), 403);

        try {
            Settings::persistApi($this->form->getState());
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('alerts.save_failed'))
                ->body($exception->getMessage())
                ->danger()
                ->persistent()
                ->send();

            return;
        }

        Notification::make()->title(Theme::trans('alerts.saved'))->success()->send();
    }

    private function grant(Key $record): void
    {
        abort_unless(Features::mayManage(Features::API), 403);

        $this->attempt(function () use ($record): void {
            $this->fresh = Keys::grant($record, $this->actor());

            Notification::make()->title(Theme::trans('api.granted'))->success()->send();
        });
    }

    private function refuse(Key $record, string $answer): void
    {
        abort_unless(Features::mayManage(Features::API), 403);

        $this->attempt(function () use ($record, $answer): void {
            Keys::refuse($record, $this->actor(), $answer);

            Notification::make()->title(Theme::trans('api.refused'))->success()->send();
        });
    }

    private function revoke(Key $record): void
    {
        abort_unless(Features::mayManage(Features::API), 403);

        $this->attempt(function () use ($record): void {
            Keys::revoke($record);

            Notification::make()->title(Theme::trans('api.revoked'))->success()->send();
        });
    }

    private function forget(Key $record): void
    {
        abort_unless(Features::mayManage(Features::API), 403);

        $this->attempt(function () use ($record): void {
            if (!Keys::forget($record)) {
                return;
            }

            Notification::make()->title(Theme::trans('api.forgotten'))->success()->send();
        });
    }

    /** @param  array<string, mixed>  $data */
    private function mint(array $data): void
    {
        abort_unless(Features::mayManage(Features::API), 403);

        $this->attempt(function () use ($data): void {
            $owner = User::query()->find($data['user_id'] ?? null);

            if ($owner === null) {
                return;
            }

            $this->fresh = Keys::mint($owner, (string) ($data['name'] ?? ''), (string) ($data['scope'] ?? Key::PERSON));

            Notification::make()->title(Theme::trans('api.minted'))->success()->send();
        });
    }

    /**
     * Whoever is signed in, for the record of who decided.
     *
     * Not optional and not guessed: every caller of this is behind
     * mayManage(), which cannot be true without somebody being signed in.
     */
    private function actor(): User
    {
        /** @var User $user */
        $user = auth()->user();

        return $user;
    }

    /**
     * Run one of the four, and say so rather than failing quietly.
     *
     * Named for what it does rather than borrowed from the attempt() helpers
     * elsewhere in this plugin - tools/check-attempt.js exists because two
     * different shapes of that name once got mixed up, and this page does not
     * need to be the third.
     */
    private function attempt(callable $work): void
    {
        try {
            $work();
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('alerts.save_failed'))
                ->body($exception->getMessage())
                ->danger()
                ->persistent()
                ->send();
        }
    }
}
