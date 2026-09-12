<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Livewire\WithFileUploads;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use LegendDevelopment\Theme\Models\Ticket;
use LegendDevelopment\Theme\Support\Access\RoleServers;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Settings;
use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Support\Tickets\Board;
use LegendDevelopment\Theme\Support\Tickets\Files;
use LegendDevelopment\Theme\Support\Tickets\Desks;
use LegendDevelopment\Theme\Support\Tickets\Desks\Modora;
use LegendDevelopment\Theme\Support\Tickets\Hook;
use LegendDevelopment\Theme\Support\Tickets\Tables as TicketTables;
use Throwable;

/**
 * What customers have asked.
 *
 * Waiting first, whatever order they arrived in. A list sorted by date puts
 * yesterday's finished conversation above this morning's unanswered question,
 * and the only thing anybody opens this page to find is the second one.
 *
 * Reading a ticket pulls whatever the far end has to say before it draws, so
 * opening one is always the freshest view there is. That costs a request per
 * open ticket somebody looks at, which is the right place to spend it: a timer
 * that polled everything every minute would spend far more of them on
 * conversations nobody is reading.
 */
class SupportTickets extends Page implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithForms;
    use InteractsWithTable;
    use WithFileUploads;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-lifebuoy';

    protected static ?string $slug = 'essentials-tickets';

    protected static ?int $navigationSort = 8;

    /** What is being typed into the reply box of whichever window is open. */
    public string $reply = '';

    /**
     * And a file, while it is still in the browser's hands.
     *
     * Beside the text rather than instead of it: an answer is usually words,
     * and a screenshot is usually words plus a screenshot. Any file, not only
     * a picture - a support ticket is where somebody sends a crash log as often
     * as a screenshot of one.
     */
    public mixed $upload = null;

    public static function canAccess(): bool
    {
        try {
            return Features::maySee(Features::TICKETS) && TicketTables::ready();
        } catch (Throwable) {
            return false;
        }
    }

    public static function shouldRegisterNavigation(): bool
    {
        return self::canAccess() && parent::shouldRegisterNavigation();
    }

    public function getTitle(): string
    {
        return Theme::trans('tickets.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('tickets.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('tickets.nav_label');
    }

    /** How many are waiting, on the menu row itself. */
    public static function getNavigationBadge(): ?string
    {
        $waiting = Board::waiting();

        return $waiting > 0 ? (string) $waiting : null;
    }

    public static function getNavigationGroup(): ?string
    {
        return Theme::name() . ' CMS';
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.tickets';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Ticket::query()->with(['user', 'claimer', 'group']))
            /*
             * Waiting first, then answered, then closed - and newest within
             * each. The raw expression is three states in a fixed order, which
             * is one line here and a column that could disagree with the state
             * if it were stored.
             */
            ->defaultSort('last_at', 'desc')
            ->modifyQueryUsing(static fn (Builder $query): Builder => $query->orderByRaw(
                "CASE state WHEN 'open' THEN 0 WHEN 'answered' THEN 1 ELSE 2 END",
            ))
            ->columns([
                TextColumn::make('subject')
                    ->label(Theme::trans('tickets.column_subject'))
                    ->searchable()
                    ->weight('medium')
                    /*
                     * The number the channel is named after, where there is
                     * one, so this row and Discord say the same thing. Ours is
                     * the fallback and not the other way round: a customer
                     * quoting a number is quoting whichever one they can see.
                     */
                    ->description(static fn (Ticket $record): string => $record->number()
                        . ' - ' . (string) ($record->user?->username ?? '')),

                TextColumn::make('state')
                    ->label(Theme::trans('tickets.column_state'))
                    ->badge()
                    ->formatStateUsing(static fn (Ticket $record): string => Theme::trans(
                        'tickets.state_' . $record->state,
                    ))
                    ->color(static fn (Ticket $record): string => match ($record->state) {
                        Ticket::OPEN => 'warning',
                        Ticket::ANSWERED => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('priority')
                    ->label(Theme::trans('tickets.column_priority'))
                    ->formatStateUsing(static fn (Ticket $record): string => Theme::trans(
                        'tickets.priority_' . $record->priority,
                    ))
                    ->color(static fn (Ticket $record): string => $record->priority === Ticket::HIGH
                        ? 'danger'
                        : 'gray'),

                /*
                 * Who has it, and which group it belongs to - two columns.
                 *
                 * They were one, with the group as a grey sub-line under "Picked
                 * up by", and that was wrong in a way only a real board shows:
                 * a role is called Admin or blackdragon, a person is called
                 * bryan, and stacked under a heading that says who picked this
                 * up the second line reads as another name. A column says what
                 * a thing is; a sub-line only says it is related to something.
                 *
                 * ->state() rather than the column's own value, because the
                 * value is an id and the answer is a name. Both relations are
                 * eager loaded above, so this is no queries rather than two per
                 * row.
                 */
                TextColumn::make('claimed_by')
                    ->label(Theme::trans('tickets.column_claimed'))
                    ->state(static fn (Ticket $record): string => (string) ($record->claimer?->username
                        ?? Theme::trans('tickets.claimed_nobody')))
                    ->color(static fn (Ticket $record): string => $record->claimed() ? 'gray' : 'warning'),

                TextColumn::make('role_id')
                    ->label(Theme::trans('tickets.column_group'))
                    ->badge()
                    ->state(static fn (Ticket $record): string => (string) ($record->group?->name
                        ?? Theme::trans('tickets.group_none')))
                    ->color(static fn (Ticket $record): string => $record->role_id === null ? 'gray' : 'info'),

                TextColumn::make('last_at')
                    ->label(Theme::trans('tickets.column_last'))
                    ->since()
                    ->sortable(),

                /*
                 * Whether it reached the desk that answers it.
                 *
                 * Only worth a column when there is a far end at all: on a
                 * panel answering its own tickets every row would say the same
                 * thing, which is a column that teaches nobody anything.
                 */
                TextColumn::make('remote')
                    ->label(Theme::trans('tickets.column_pushed'))
                    ->visible(static fn (): bool => Desks::current()->key() === Modora::KEY)
                    ->formatStateUsing(static fn (Ticket $record): string => Theme::trans(
                        $record->pushed() ? 'tickets.pushed_yes' : 'tickets.pushed_no',
                    ))
                    ->color(static fn (Ticket $record): string => $record->pushed() ? 'gray' : 'warning'),
            ])
            ->filters([
                SelectFilter::make('state')
                    ->label(Theme::trans('tickets.column_state'))
                    ->options([
                        Ticket::OPEN => Theme::trans('tickets.state_open'),
                        Ticket::ANSWERED => Theme::trans('tickets.state_answered'),
                        Ticket::CLOSED => Theme::trans('tickets.state_closed'),
                    ]),

                SelectFilter::make('priority')
                    ->label(Theme::trans('tickets.column_priority'))
                    ->options([
                        Ticket::LOW => Theme::trans('tickets.priority_low'),
                        Ticket::NORMAL => Theme::trans('tickets.priority_normal'),
                        Ticket::HIGH => Theme::trans('tickets.priority_high'),
                    ]),

                /*
                 * The group, as a filter rather than as a wall.
                 *
                 * Moving a ticket to a group does not hide it from anybody who
                 * could already see it. Filing something wrongly and thereby
                 * hiding a customer's question from half the staff is a worse
                 * failure than the one that would prevent, so the group is what
                 * somebody chooses to look at rather than what they are allowed
                 * to.
                 */
                /*
                 * With "no group" in the list, because that is the one staff
                 * actually want: a filter that can be turned on and never
                 * turned back to the unfiled rows is half a filter.
                 *
                 * Its own query, because a select posts a string and there is
                 * no string that means null. The key below is a word rather
                 * than an empty value for the same reason.
                 */
                SelectFilter::make('role_id')
                    ->label(Theme::trans('tickets.column_group'))
                    ->options(static fn (): array => ['none' => Theme::trans('tickets.group_none')]
                        + RoleServers::roleOptions())
                    ->query(static function (Builder $query, array $data): Builder {
                        $picked = (string) ($data['value'] ?? '');

                        if ($picked === '') {
                            return $query;
                        }

                        return $picked === 'none'
                            ? $query->whereNull('role_id')
                            : $query->where('role_id', (int) $picked);
                    }),

                Filter::make('ld_mine')
                    ->label(Theme::trans('tickets.only_mine'))
                    ->query(static fn (Builder $query): Builder => $query->where(
                        'claimed_by',
                        (int) (user()?->id ?? 0),
                    )),
            ])
            ->recordActions([
                /*
                 * Read in a window rather than under the table.
                 *
                 * A conversation that opened below a list left somebody
                 * scrolling past twenty rows to find what they had just clicked
                 * on, and the list moved under them whenever a reply changed a
                 * ticket's place in it.
                 *
                 * The far end is asked for anything new as the window opens -
                 * in mountUsing rather than in the content, because the content
                 * is a render and a render should not make a network call.
                 */
                Action::make('ld_read')
                    ->label(Theme::trans('tickets.read'))
                    ->icon('tabler-message')
                    ->color('gray')
                    ->modalWidth(Width::ThreeExtraLarge)
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel(Theme::trans('tickets.shut'))
                    ->modalHeading(static fn (Ticket $record): string => $record->number()
                        . ' - ' . (string) $record->subject)
                    ->mountUsing(function (Ticket $record): void {
                        Board::pull($record);

                        $this->reply = '';
                        $this->upload = null;
                    })
                    ->modalContent(fn (Ticket $record) => view(Theme::id() . '::modals.ticket', [
                        'ticket' => $record,
                        'said' => $this->talk($record),
                        'answerable' => $record->live() && Features::mayManage(Features::TICKETS),
                        // Which method the box calls, so one template serves
                        // both sides of the conversation.
                        'method' => 'answer',
                        'answering' => true,
                        // And what staff may change from inside it. Null on the
                        // customer's page, which is the only difference between
                        // the two windows.
                        'controls' => $this->controls($record),
                    ])),

                /*
                 * Picking one up, so two people do not both start typing.
                 *
                 * Announced in the channel, because Modora has no assign
                 * endpoint - none of these three do - and a claim nobody in the
                 * channel can see is a claim that stops nothing.
                 */
                Action::make('ld_claim')
                    ->label(static fn (Ticket $record): string => Theme::trans(match (true) {
                        (int) ($record->claimed_by ?? 0) === (int) (user()?->id ?? 0)
                            && $record->claimed() => 'tickets.release',
                        $record->claimed() => 'tickets.take_over',
                        default => 'tickets.take',
                    }))
                    ->icon(static fn (Ticket $record): string => $record->claimed()
                        ? 'tabler-user-minus'
                        : 'tabler-user-plus')
                    ->color('gray')
                    ->visible(static fn (Ticket $record): bool => Features::mayManage(Features::TICKETS)
                        && $record->live())
                    ->action(fn (Ticket $record) => $this->take($record)),

                /*
                 * Which team it belongs to. The groups are the roles, because
                 * Pelican has no notion of a team and the people who answer
                 * billing questions are already a role - that is how they were
                 * given the permission to read this page.
                 */
                Action::make('ld_group')
                    ->label(Theme::trans('tickets.group'))
                    ->icon('tabler-users-group')
                    ->color('gray')
                    ->modalWidth(Width::Medium)
                    ->modalDescription(Theme::trans('tickets.group_helper'))
                    ->modalSubmitActionLabel(Theme::trans('tickets.group_move'))
                    ->fillForm(static fn (Ticket $record): array => ['role_id' => $record->role_id])
                    ->schema([
                        /*
                         * Deliberately not ->searchable(), and it is not a
                         * matter of taste.
                         *
                         * Filament 5 draws a plain <select> with the options in
                         * the page, until something makes it stop: searchable,
                         * multiple or html all swap it for a dropdown built in
                         * the browser, which then fetches its options back over
                         * Livewire when it opens. Inside an action's modal that
                         * fetch comes back with nothing, so the list a person
                         * sees is empty - which is exactly what happened here.
                         *
                         * A panel has a handful of roles. There was nothing to
                         * search through, and the search box cost the list.
                         */
                        Select::make('role_id')
                            ->label(Theme::trans('tickets.column_group'))
                            ->options(static fn (): array => RoleServers::roleOptions())
                            ->placeholder(Theme::trans('tickets.group_none')),
                    ])
                    ->visible(static fn (Ticket $record): bool => Features::mayManage(Features::TICKETS)
                        && $record->live())
                    ->action(fn (Ticket $record, array $data) => $this->move($record, $data)),

                /*
                 * How urgent it turned out to be.
                 *
                 * A customer says how urgent they think it is and is often
                 * right; the times they are not are exactly why this is here.
                 */
                Action::make('ld_urgency')
                    ->label(Theme::trans('tickets.priority'))
                    ->icon('tabler-flag')
                    ->color('gray')
                    ->modalWidth(Width::Medium)
                    ->modalSubmitActionLabel(Theme::trans('tickets.priority_set'))
                    ->fillForm(static fn (Ticket $record): array => ['priority' => $record->priority])
                    ->schema([
                        Select::make('priority')
                            ->label(Theme::trans('tickets.priority'))
                            ->options([
                                Ticket::LOW => Theme::trans('tickets.priority_low'),
                                Ticket::NORMAL => Theme::trans('tickets.priority_normal'),
                                Ticket::HIGH => Theme::trans('tickets.priority_high'),
                            ])
                            ->selectablePlaceholder(false)
                            ->required(),
                    ])
                    ->visible(static fn (Ticket $record): bool => Features::mayManage(Features::TICKETS)
                        && $record->live())
                    ->action(fn (Ticket $record, array $data) => $this->urgency($record, $data)),

                Action::make('ld_retry')
                    ->label(Theme::trans('tickets.retry'))
                    ->icon('tabler-refresh')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalDescription(Theme::trans('tickets.retry_confirm'))
                    /*
                     * Shown when anything about this ticket has not reached the
                     * desk - not only when the ticket itself has not.
                     *
                     * It used to ask only whether the ticket was pushed, which
                     * hid the button in the one case that needs it most: the
                     * ticket goes through, the first message is refused because
                     * Modora has not made the channel yet, and the row looks
                     * entirely fine while the question sits here unsent.
                     */
                    ->visible(static fn (Ticket $record): bool => Features::mayManage(Features::TICKETS)
                        && Desks::current()->key() === Modora::KEY
                        && $record->live()
                        && Board::waitingOn($record))
                    ->action(fn (Ticket $record) => $this->push($record)),

                Action::make('ld_close')
                    ->label(Theme::trans('tickets.close'))
                    ->icon('tabler-circle-check')
                    ->requiresConfirmation()
                    ->modalDescription(Theme::trans('tickets.close_confirm'))
                    ->visible(static fn (Ticket $record): bool => Features::mayManage(Features::TICKETS)
                        && $record->live())
                    ->action(fn (Ticket $record) => $this->finish($record)),
            ])
            ->emptyStateHeading(Theme::trans('tickets.empty'))
            ->emptyStateDescription(Theme::trans('tickets.empty_body'))
            ->emptyStateIcon('tabler-lifebuoy');
    }

    /** @return array<int, Action> */
    protected function getHeaderActions(): array
    {
        if (!Features::mayManage(Features::TICKETS)) {
            return [];
        }

        return [
            Action::make('ld_desk')
                ->label(Theme::trans('tickets.settings'))
                ->icon('tabler-settings')
                ->color('gray')
                ->modalWidth(Width::Large)
                ->modalDescription(Theme::trans('tickets.settings_helper'))
                ->fillForm(static fn (): array => [
                    'tickets_open' => (bool) Theme::config('tickets_open', true),
                    'tickets_button' => (bool) Theme::config('tickets_button', true),
                    'tickets_via' => (string) Theme::config('tickets_via', 'panel'),
                    'tickets_modora_key' => (string) Theme::config('tickets_modora_key', ''),
                    'tickets_modora_panel' => (string) Theme::config('tickets_modora_panel', ''),
                ])
                ->schema([
                    /*
                     * Two switches about the customer's side, above the one
                     * about where answers happen, because they are the ones an
                     * owner reaches for: closing the intake for a week is a
                     * decision people make, and swapping the desk is not.
                     */
                    Toggle::make('tickets_open')
                        ->label(Theme::trans('tickets.taking'))
                        ->helperText(Theme::trans('tickets.taking_helper'))
                        ->default(true),

                    Toggle::make('tickets_button')
                        ->label(Theme::trans('tickets.corner'))
                        ->helperText(Theme::trans('tickets.corner_helper'))
                        ->default(true),

                    Select::make('tickets_via')
                        ->label(Theme::trans('tickets.via'))
                        ->helperText(Theme::trans('tickets.via_helper'))
                        ->options(Desks::options())
                        ->selectablePlaceholder(false)
                        ->live()
                        ->required(),

                    Section::make(Theme::trans('tickets.modora'))
                        ->description(Theme::trans('tickets.modora_helper'))
                        ->visible(static fn (Get $get): bool => $get('tickets_via') === Modora::KEY)
                        ->schema([
                            TextInput::make('tickets_modora_key')
                                ->label(Theme::trans('tickets.modora_key'))
                                ->helperText(Theme::trans('tickets.modora_key_helper'))
                                ->password()
                                ->revealable()
                                ->maxLength(400),

                            /*
                             * Chosen from what Modora actually has, rather than
                             * typed.
                             *
                             * It was a text box, somebody put the panel's name
                             * in it, and every ticket came back 422: the field
                             * wants an integer. A list cannot be typed wrong,
                             * and it is one request to a scope the key already
                             * carries.
                             *
                             * Empty when the key cannot read panels, which is a
                             * key without `panels.read` - and that is allowed:
                             * leaving this unset lets Modora choose, which is
                             * what most panels want anyway.
                             */
                            Select::make('tickets_modora_panel')
                                ->label(Theme::trans('tickets.modora_panel'))
                                ->helperText(Theme::trans('tickets.modora_panel_helper'))
                                ->options(static fn (): array => (new Modora())->panels())
                                ->placeholder(Theme::trans('tickets.modora_panel_any')),

                            /*
                             * The address Modora posts events to.
                             *
                             * Read-only and copyable rather than a field: it is
                             * built from this panel's own URL and a secret this
                             * panel made, so there is nothing here for anybody
                             * to type. The button beside the form is what makes
                             * one, and making a new one is how an old address is
                             * revoked.
                             */
                            Placeholder::make('ld_hook')
                                ->label(Theme::trans('tickets.hook'))
                                ->content(static fn (): string => Hook::address()
                                    ?? Theme::trans('tickets.hook_none'))
                                ->helperText(Theme::trans('tickets.hook_helper')),
                        ]),

                ])
                ->action(fn (array $data) => $this->settings($data)),

            /*
             * Making the address, and revoking it.
             *
             * One button for both, because they are the same act: a new secret
             * is a new address, and the old one stops answering the moment it
             * exists. The confirmation says so rather than leaving somebody to
             * discover it when their events stop arriving.
             */
            Action::make('ld_hook_new')
                ->label(static fn (): string => Theme::trans(
                    Hook::secret() === '' ? 'tickets.hook_make' : 'tickets.hook_renew',
                ))
                ->icon('tabler-link')
                ->color('gray')
                ->requiresConfirmation(static fn (): bool => Hook::secret() !== '')
                ->modalDescription(Theme::trans('tickets.hook_renew_confirm'))
                ->action(fn () => $this->address()),

            /*
             * What actually arrived.
             *
             * Here because Modora's payload shape and their signing are not
             * written down anywhere I could read, and the honest way to learn
             * them is to look at a real delivery. It is a setting-up tool: once
             * the shape is settled this stays useful for the other question -
             * "is it reaching us at all" - which is the first thing anybody
             * asks when an answer does not appear.
             */
            Action::make('ld_hook_seen')
                ->label(Theme::trans('tickets.hook_seen'))
                ->icon('tabler-inbox')
                ->color('gray')
                ->modalWidth(Width::FourExtraLarge)
                ->modalSubmitAction(false)
                ->modalCancelActionLabel(Theme::trans('tickets.shut'))
                ->modalContent(fn () => view(Theme::id() . '::modals.hook', [
                    'deliveries' => Hook::deliveries(),
                    'address' => Hook::address(),
                ])),

            /*
             * Always offered, and that is the point of it.
             *
             * It hid itself until the desk was already switched to Modora,
             * which is a test you can only run once you no longer need it:
             * the moment to find out that a key is wrong is while it is being
             * pasted in, not after every customer's question has started going
             * somewhere that refuses them.
             *
             * With no key at all it answers "there is no integration key yet",
             * which is a useful thing to be told rather than a failure.
             */
            Action::make('ld_check')
                ->label(Theme::trans('tickets.check'))
                ->icon('tabler-plug-connected')
                ->color('gray')
                ->action(fn () => $this->probe()),
        ];
    }

    /**
     * One conversation, ready to draw.
     *
     * Built by Board rather than here, because the customer's page draws the
     * same conversation and every line of this that lived on both would be a
     * line that could drift. The one real difference is who "mine" is, and
     * here the reader is staff: an answer is theirs.
     *
     * @return array<int, array<string, mixed>>
     */
    public function talk(Ticket $ticket): array
    {
        return Board::drawn($ticket, true);
    }

    /**
     * What staff may change from inside the window.
     *
     * Here rather than in the template because it is a decision about who may
     * do what, and a template that worked that out for itself would be a second
     * place to get it wrong.
     *
     * @return array<string, mixed>|null
     */
    private function controls(Ticket $record): ?array
    {
        if (!Features::mayManage(Features::TICKETS) || !$record->live()) {
            return null;
        }

        return [
            'level' => (string) $record->priority,
            'levels' => [
                Ticket::LOW => Theme::trans('tickets.priority_low'),
                Ticket::NORMAL => Theme::trans('tickets.priority_normal'),
                Ticket::HIGH => Theme::trans('tickets.priority_high'),
            ],
            'group' => $record->role_id === null ? 0 : (int) $record->role_id,
            'groups' => RoleServers::roleOptions(),
        ];
    }

    /**
     * How urgent it is, changed from the window rather than from a second one.
     *
     * Public because the window calls it directly, and it repeats the
     * permission check for the same reason every other handler here does:
     * whether a control was drawn is a decision about drawing.
     */
    public function rank(int $id, string $level): void
    {
        abort_unless(Features::mayManage(Features::TICKETS), 403);

        $ticket = $this->find($id);

        if ($ticket === null || !Board::urgency($ticket, $level)) {
            return;
        }

        $this->dispatch('ld-said');
    }

    /** And which group answers it. */
    public function team(int $id, string $role): void
    {
        abort_unless(Features::mayManage(Features::TICKETS), 403);

        $ticket = $this->find($id);

        if ($ticket === null || !Board::hand($ticket, (int) $role > 0 ? (int) $role : null)) {
            return;
        }

        $this->dispatch('ld-said');
    }

    /**
     * Put an answer on one.
     *
     * Takes the id rather than reading a property the window set, because the
     * window is the only thing that knows which ticket it is showing - and a
     * property that has to be kept in step with what is on the screen is a
     * property that will one day disagree with it.
     */
    public function answer(int $id): void
    {
        abort_unless(Features::mayManage(Features::TICKETS), 403);

        $ticket = $this->find($id);
        $said = trim($this->reply);

        // A file on its own is an answer. Insisting on words beside it would be
        // insisting on ceremony.
        if ($ticket === null || ($said === '' && $this->upload === null)) {
            return;
        }

        if (Board::say($ticket, user(), $said, true, $this->upload) === null) {
            Notification::make()->title(Theme::trans('tickets.not_sent'))->danger()->send();

            return;
        }

        $this->reply = '';
        $this->upload = null;

        // So the window scrolls to what was just said rather than leaving it
        // below the fold, which is what a chat does and a log does not.
        $this->dispatch('ld-said');

        Notification::make()->title(Theme::trans('tickets.sent'))->success()->send();
    }

    /**
     * A ticket by its id.
     *
     * No ownership check, and that is deliberate here rather than an omission:
     * this is the administrator's page and it is already behind the tickets
     * permission. The customer's own page does check, because there it is the
     * only thing standing between somebody and another person's conversation.
     */
    private function find(int $id): ?Ticket
    {
        try {
            $ticket = Ticket::query()->find($id);
        } catch (Throwable) {
            return null;
        }

        return $ticket instanceof Ticket ? $ticket : null;
    }

    private function push(Ticket $record): void
    {
        abort_unless(Features::mayManage(Features::TICKETS), 403);

        if (Board::retry($record)) {
            Notification::make()->title(Theme::trans('tickets.retried'))->success()->send();

            return;
        }

        /*
         * What Modora said, where they said anything.
         *
         * "The reason is in the log" sends somebody to a terminal to read a
         * sentence that arrived in the body and could have been on their
         * screen. It is still the fallback, for a failure that produced no
         * message of its own.
         */
        $why = trim(Modora::problem());

        Notification::make()
            ->title(Theme::trans('tickets.retry_failed'))
            ->body($why !== '' ? $why : Theme::trans('tickets.retry_failed_body'))
            ->danger()
            ->persistent()
            ->send();
    }

    /**
     * Put a name on it, or take one off.
     *
     * One handler for both, because they are one decision: whether this ticket
     * is mine. Pressing it on somebody else's takes it over, which is a thing
     * that happens on a shift change and is announced in the channel like every
     * other change here.
     */
    private function take(Ticket $record): void
    {
        abort_unless(Features::mayManage(Features::TICKETS), 403);

        $me = user();
        $mine = $record->claimed() && (int) ($record->claimed_by ?? 0) === (int) ($me?->id ?? 0);

        if (!Board::claim($record, $mine ? null : $me)) {
            Notification::make()->title(Theme::trans('tickets.claim_failed'))->danger()->send();

            return;
        }

        Notification::make()
            ->title(Theme::trans($mine ? 'tickets.released' : 'tickets.taken'))
            ->success()
            ->send();
    }

    /** @param array<string, mixed> $data */
    private function move(Ticket $record, array $data): void
    {
        abort_unless(Features::mayManage(Features::TICKETS), 403);

        $role = (int) ($data['role_id'] ?? 0);

        if (!Board::hand($record, $role > 0 ? $role : null)) {
            Notification::make()->title(Theme::trans('tickets.group_failed'))->danger()->send();

            return;
        }

        Notification::make()->title(Theme::trans('tickets.group_moved'))->success()->send();
    }

    /** @param array<string, mixed> $data */
    private function urgency(Ticket $record, array $data): void
    {
        abort_unless(Features::mayManage(Features::TICKETS), 403);

        if (!Board::urgency($record, (string) ($data['priority'] ?? ''))) {
            Notification::make()->title(Theme::trans('tickets.priority_failed'))->danger()->send();

            return;
        }

        Notification::make()->title(Theme::trans('tickets.priority_done'))->success()->send();
    }

    private function finish(Ticket $record): void
    {
        abort_unless(Features::mayManage(Features::TICKETS), 403);

        if (!Board::close($record)) {
            Notification::make()->title(Theme::trans('tickets.close_failed'))->danger()->send();

            return;
        }

        Notification::make()->title(Theme::trans('tickets.closed'))->success()->send();
    }

    /** @param array<string, mixed> $data */
    private function settings(array $data): void
    {
        abort_unless(Features::mayManage(Features::TICKETS), 403);

        try {
            Settings::persistTickets([
                'tickets_open' => (bool) ($data['tickets_open'] ?? true),
                'tickets_button' => (bool) ($data['tickets_button'] ?? true),
                'tickets_via' => in_array($data['tickets_via'] ?? '', [Modora::KEY, 'panel'], true)
                    ? (string) $data['tickets_via']
                    : 'panel',
                'tickets_modora_key' => trim((string) ($data['tickets_modora_key'] ?? '')),
                'tickets_modora_panel' => trim((string) ($data['tickets_modora_panel'] ?? '')),
            ]);

            Notification::make()->title(Theme::trans('tickets.saved'))->success()->send();
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()->title(Theme::trans('tickets.save_failed'))->danger()->send();
        }
    }

    /** Make an address for Modora to post to, or replace the one there is. */
    private function address(): void
    {
        abort_unless(Features::mayManage(Features::TICKETS), 403);

        if (Hook::renew() === null) {
            Notification::make()->title(Theme::trans('tickets.save_failed'))->danger()->send();

            return;
        }

        Notification::make()
            ->title(Theme::trans('tickets.hook_made'))
            ->body(Theme::trans('tickets.hook_made_body'))
            ->success()
            ->persistent()
            ->send();
    }

    /** Ask the desk whether its key works, and say what came back. */
    private function probe(): void
    {
        abort_unless(Features::mayManage(Features::TICKETS), 403);

        $wrong = Desks::check();

        if ($wrong === null) {
            Notification::make()
                ->title(Theme::trans('tickets.check_ok'))
                ->body(Theme::trans('tickets.check_ok_body'))
                ->success()
                ->send();

            return;
        }

        Notification::make()
            ->title(Theme::trans('tickets.check_bad'))
            ->body($wrong)
            ->danger()
            ->persistent()
            ->send();
    }
}
