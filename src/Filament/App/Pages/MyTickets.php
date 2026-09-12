<?php

namespace LegendDevelopment\Theme\Filament\App\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Livewire\WithFileUploads;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Support\Enums\Width;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Models\Ticket;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Shop\Orders;
use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Support\Tickets\Board;
use Throwable;

/**
 * Where a customer asks, and reads what came back.
 *
 * One page rather than a list and a detail page: somebody with three tickets
 * does not need navigation, and somebody with thirty is not the customer this
 * is for. The conversation opens in a window over the list, and it is the same
 * window staff read it in - the same template, the same partial, the same
 * builder. Two templates for one conversation is two places for it to drift.
 *
 * **A ticket may name a service**, and the form offers the ones they hold. That
 * is the whole reason this exists next to a Discord server that already works:
 * "my server will not start" is a different question when whoever reads it can
 * already see which server, what package it is and whether the last invoice was
 * paid.
 */
class MyTickets extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;
    use WithFileUploads;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-lifebuoy';

    protected static ?string $slug = 'tickets';

    protected static ?int $navigationSort = 4;

    public string $reply = '';

    /** And a file, while it is still in the browser's hands. */
    public mixed $upload = null;

    public static function canAccess(): bool
    {
        try {
            return user() !== null && Board::ready();
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
        return Theme::trans('tickets.mine_title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('tickets.mine_subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('tickets.mine_nav_label');
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.mytickets';
    }

    /**
     * Open the ask window on arrival, when the address says to.
     *
     * What the corner button links to. It saves the one step that would
     * otherwise make that button pointless: landing somebody on a list they
     * then have to find a button on has moved the problem rather than solved
     * it.
     *
     * Guarded, because mounting an action is Filament's business and a panel
     * where that has changed should still get its list.
     */
    public function mount(): void
    {
        if (!request()->boolean('ask') || !Board::opening()) {
            return;
        }

        try {
            $this->mountAction('ld_ask');
        } catch (Throwable) {
            // The page draws, the button in the header still works.
        }
    }

    /** @return array<int, Action> */
    protected function getHeaderActions(): array
    {
        if (!Board::opening()) {
            return [];
        }

        return [
            Action::make('ld_ask')
                ->label(Theme::trans('tickets.ask'))
                ->icon('tabler-message-plus')
                ->modalWidth(Width::Large)
                ->modalDescription(Theme::trans('tickets.ask_helper'))
                ->modalSubmitActionLabel(Theme::trans('tickets.ask_send'))
                ->schema([
                    TextInput::make('subject')
                        ->label(Theme::trans('tickets.subject'))
                        ->helperText(Theme::trans('tickets.subject_helper'))
                        ->required()
                        ->maxLength(191),

                    /*
                     * Which service it is about, where it is about one. Not
                     * required: a question about an invoice or about buying
                     * something is a question with no server behind it.
                     */
                    Select::make('order')
                        ->label(Theme::trans('tickets.about'))
                        ->helperText(Theme::trans('tickets.about_helper'))
                        ->options(fn (): array => $this->services())
                        /*
                         * Chosen already when the customer came from a service
                         * card, which is where most of these start. The card
                         * links here with the order in the address, so pressing
                         * Ask is the only thing left to do.
                         */
                        ->default(fn (): ?int => $this->asked())
                        ->visible(fn (): bool => $this->services() !== []),

                    Select::make('priority')
                        ->label(Theme::trans('tickets.priority'))
                        ->options([
                            Ticket::LOW => Theme::trans('tickets.priority_low'),
                            Ticket::NORMAL => Theme::trans('tickets.priority_normal'),
                            Ticket::HIGH => Theme::trans('tickets.priority_high'),
                        ])
                        ->default(Ticket::NORMAL)
                        ->selectablePlaceholder(false),

                    Textarea::make('body')
                        ->label(Theme::trans('tickets.body'))
                        ->helperText(Theme::trans('tickets.body_helper'))
                        ->rows(6)
                        ->required()
                        ->maxLength(20000),
                ])
                ->action(fn (array $data) => $this->ask($data)),

            /*
             * Reading one, in the same window staff get.
             *
             * Mounted from the list with the ticket's id as an argument rather
             * than from a property, so the window and the row that opened it
             * cannot disagree about which conversation is on the screen.
             */
            Action::make('ld_open')
                ->label(Theme::trans('tickets.read'))
                ->modalWidth(Width::ThreeExtraLarge)
                ->modalSubmitAction(false)
                ->modalCancelActionLabel(Theme::trans('tickets.shut'))
                ->modalHeading(fn (array $arguments): string => (string) ($this->find(
                    (int) ($arguments['ticket'] ?? 0),
                )?->subject ?? ''))
                ->mountUsing(function (array $arguments): void {
                    $ticket = $this->find((int) ($arguments['ticket'] ?? 0));

                    if ($ticket !== null) {
                        Board::pull($ticket);
                    }

                    $this->reply = '';
                    $this->upload = null;
                })
                ->modalContent(function (array $arguments) {
                    $ticket = $this->find((int) ($arguments['ticket'] ?? 0));

                    if ($ticket === null) {
                        return null;
                    }

                    return view(Theme::id() . '::modals.ticket', [
                        'ticket' => $ticket,
                        'said' => $this->conversation($ticket),
                        'answerable' => $ticket->live(),
                        'method' => 'say',
                        'answering' => false,
                        // A customer does not route their own ticket, so the
                        // composer draws how urgent it is and nothing to press.
                        'controls' => null,
                    ]);
                }),
        ];
    }

    /**
     * This customer's tickets, ready to draw.
     *
     * @return array<int, array<string, mixed>>
     */
    public function tickets(): array
    {
        $out = [];

        foreach (Board::mine((int) (user()?->id ?? 0)) as $ticket) {
            $out[] = [
                'id' => (int) $ticket->id,
                'subject' => (string) $ticket->subject,
                'state' => Theme::trans('tickets.state_' . $ticket->state),
                'colour' => match ($ticket->state) {
                    Ticket::OPEN => 'amber',
                    Ticket::ANSWERED => 'green',
                    default => 'grey',
                },
                'when' => $ticket->last_at?->diffForHumans(),
                'live' => $ticket->live(),
                /*
                 * Where a guest claims the ticket with their Discord account.
                 * Offered rather than pressed: everything works from this page
                 * without it, and following it means the same conversation is
                 * also in their Discord.
                 */
                'claim' => trim((string) ($ticket->claim_url ?? '')) ?: null,
            ];
        }

        return $out;
    }

    /**
     * The conversation on the open one.
     *
     * The same builder the staff page uses, with the one thing that differs
     * passed in: here the reader is the customer, so their own questions are
     * the ones on their side of the window.
     *
     * @return array<int, array<string, mixed>>
     */
    public function conversation(Ticket $ticket): array
    {
        return Board::drawn($ticket, false);
    }

    /** Say something more on the open one. */
    public function say(int $id): void
    {
        abort_unless(self::canAccess(), 403);

        $ticket = $this->find($id);
        $said = trim($this->reply);

        // A file on its own is a message: somebody sending a screenshot of an
        // error has said what they came to say.
        if ($ticket === null || ($said === '' && $this->upload === null)) {
            return;
        }

        if (Board::say($ticket, user(), $said, false, $this->upload) === null) {
            Notification::make()->title(Theme::trans('tickets.not_sent'))->danger()->send();

            return;
        }

        $this->reply = '';
        $this->upload = null;

        // So the window scrolls to what was just said rather than leaving it
        // below the fold.
        $this->dispatch('ld-said');

        Notification::make()->title(Theme::trans('tickets.sent'))->success()->send();
    }

    /** @param array<string, mixed> $data */
    private function ask(array $data): void
    {
        abort_unless(self::canAccess(), 403);

        $user = user();
        $order = $this->order((int) ($data['order'] ?? 0));

        $ticket = Board::open(
            $user,
            (string) ($data['subject'] ?? ''),
            (string) ($data['body'] ?? ''),
            $order,
            (string) ($data['priority'] ?? Ticket::NORMAL),
        );

        if (!$ticket instanceof Ticket) {
            Notification::make()
                ->title(Theme::trans('tickets.not_asked'))
                ->body(Theme::trans('tickets.not_asked_body'))
                ->danger()
                ->send();

            return;
        }

        Notification::make()
            ->title(Theme::trans('tickets.asked'))
            ->body(Theme::trans('tickets.asked_body'))
            ->success()
            ->send();
    }

    /**
     * The service named in the address, when it is one of theirs.
     *
     * A number typed into a query string is not a claim on anything: it is
     * checked against this customer's own orders like every other id on this
     * page.
     */
    private function asked(): ?int
    {
        $order = $this->order((int) request()->integer('about'));

        return $order === null ? null : (int) $order->id;
    }

    /**
     * The services this customer holds, as options.
     *
     * Cancelled ones are in the list on purpose: a question about a service
     * that has just ended is a question people actually have.
     *
     * @return array<int, string>
     */
    private function services(): array
    {
        try {
            $orders = Order::query()
                ->where('user_id', (int) (user()?->id ?? 0))
                ->orderByDesc('id')
                ->limit(50)
                ->get();
        } catch (Throwable) {
            return [];
        }

        $out = [];

        foreach ($orders as $order) {
            $spec = is_array($order->spec) ? $order->spec : [];
            $name = trim((string) ($spec['name'] ?? '')) ?: Theme::trans('orders.gone_package');

            $out[(int) $order->id] = '#' . (int) $order->id . ' - ' . $name;
        }

        return $out;
    }

    /** One of theirs, or null. */
    private function order(int $id): ?Order
    {
        return Orders::mine($id, (int) (user()?->id ?? 0));
    }

    /**
     * A ticket, and only if it is theirs.
     *
     * A page left open in a tab has no claim on an id somebody typed into it.
     */
    private function find(int $id): ?Ticket
    {
        try {
            $ticket = Ticket::query()->find($id);
        } catch (Throwable) {
            return null;
        }

        return $ticket instanceof Ticket && (int) $ticket->user_id === (int) (user()?->id ?? 0)
            ? $ticket
            : null;
    }
}
