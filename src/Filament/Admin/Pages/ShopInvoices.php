<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Models\Payment;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Credits;
use LegendDevelopment\Theme\Support\Shop\Gateways;
use LegendDevelopment\Theme\Support\Shop\Invoices;
use LegendDevelopment\Theme\Support\Shop\Refunds;
use LegendDevelopment\Theme\Support\Shop\Tables;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * What is owed and what has been paid.
 *
 * The one button here that does something irreversible is **Mark paid**, and
 * it is the most important button in the plugin: on a panel with no payment
 * provider configured it is how every sale completes. Somebody sends money by
 * bank transfer, an administrator presses this, and the same code runs that a
 * gateway's webhook will run in the next release - the server gets built, a
 * suspended one comes back, the due date moves on.
 *
 * Which is why it has its own permission. Reading every invoice on the panel
 * and being able to declare one paid are different amounts of trust.
 */
class ShopInvoices extends Page implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithForms;
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-file-invoice';

    protected static ?string $slug = 'essentials-invoices';

    protected static ?int $navigationSort = 3;

    public static function canAccess(): bool
    {
        try {
            return Features::maySee(Features::INVOICES) && Tables::ready();
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
        return Theme::trans('invoices.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('invoices.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('invoices.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return Theme::name() . ' CMS';
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.invoices';
    }

    /**
     * The headline of the attempts column: how it was paid, or what was tried.
     */
    private static function attempts(Invoice $record): string
    {
        if ($record->state === Invoice::PAID) {
            // What actually took the money. paid_via is written by markPaid()
            // and is the only place that knows whether it was a provider, a
            // coupon that took the total to nothing, or somebody's hand.
            return Theme::trans('invoices.paid_by', [
                'how' => self::provider((string) $record->paid_via),
            ]);
        }

        $payments = $record->payments;

        if ($payments->isEmpty()) {
            return Theme::trans('invoices.attempts_none');
        }

        return Theme::trans('invoices.attempts_open', [
            'count' => (string) $payments->count(),
            'how' => implode(', ', array_map(
                static fn (string $key): string => self::provider($key),
                array_values(array_unique($payments->pluck('gateway')->map(
                    static fn (mixed $value): string => (string) $value,
                )->all())),
            )),
        ]);
    }

    /**
     * And the line under it: when the last attempt was, which is what says
     * whether somebody is at a checkout right now or gave up on Tuesday.
     */
    private static function attemptsNote(Invoice $record): ?string
    {
        $last = $record->payments->sortByDesc('created_at')->first();

        if (!$last instanceof Payment) {
            return null;
        }

        return Theme::trans('invoices.attempt_last', [
            'when' => (string) ($last->created_at?->diffForHumans() ?? ''),
            'state' => Theme::trans('invoices.attempt_' . $last->state),
        ]);
    }

    /**
     * A provider's own name where there is one. The column holds the key this
     * plugin files it under - paypal, stripe, manual - and PayPal is not
     * spelled Paypal by anybody who works there.
     */
    private static function provider(string $key): string
    {
        if ($key === '') {
            return Theme::trans('invoices.paid_by_unknown');
        }

        return match ($key) {
            Invoice::MANUAL, Invoice::FREE => Theme::trans('invoices.paid_by_' . $key),
            default => Gateways::provider($key),
        };
    }

    public function table(Table $table): Table
    {
        return $table
            // payments as well, because the attempts column below reads them on
            // every row - and a column that costs one query per row is a page
            // that gets slower the longer somebody has been selling.
            ->query(fn (): Builder => Invoice::query()->with(['user', 'order', 'orders', 'payments']))
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('number')
                    ->label(Theme::trans('invoices.column_number'))
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->description(static fn (Invoice $record): string => Theme::trans('invoices.kind_' . $record->kind)),

                TextColumn::make('user.username')
                    ->label(Theme::trans('invoices.column_customer'))
                    ->searchable()
                    ->sortable()
                    // The snapshot, not the account: an invoice says who it was
                    // written to, even after somebody renames themselves.
                    ->formatStateUsing(static fn (Invoice $record): string => (string) ($record->customer_name
                        ?: $record->user?->username
                        ?: Theme::trans('invoices.gone_customer')))
                    ->description(static fn (Invoice $record): ?string => $record->customer_email ?: null),

                /*
                 * Every order on it, not only the one in order_id.
                 *
                 * An invoice can bill a basket now, and "#41" on a document
                 * that charges for three services is a number that tells
                 * somebody the wrong thing rather than nothing.
                 */
                TextColumn::make('order_id')
                    ->label(Theme::trans('invoices.column_order'))
                    ->state(static function (Invoice $record): string {
                        $orders = $record->billed();

                        if ($orders->isEmpty()) {
                            return Theme::trans('invoices.no_order');
                        }

                        return implode(', ', $orders->map(
                            static fn (Order $order): string => '#' . (int) $order->id,
                        )->all());
                    })
                    ->description(static function (Invoice $record): ?string {
                        $count = $record->billed()->count();

                        // Only when there is more than one. A count of one is a
                        // line saying what the line above it already said.
                        return $count > 1
                            ? Theme::trans('invoices.order_count', ['count' => (string) $count])
                            : null;
                    }),

                TextColumn::make('total')
                    ->label(Theme::trans('invoices.column_total'))
                    ->sortable()
                    ->formatStateUsing(static fn (Invoice $record): string => Money::format(
                        (int) $record->total,
                        (string) $record->currency,
                    ))
                    ->description(static fn (Invoice $record): ?string => $record->discount > 0
                        ? Theme::trans('invoices.discount_of', [
                            'amount' => Money::format((int) $record->discount, (string) $record->currency),
                            'code' => (string) $record->coupon_code,
                        ])
                        : null),

                TextColumn::make('state')
                    ->label(Theme::trans('invoices.column_state'))
                    ->badge()
                    ->formatStateUsing(static fn (Invoice $record): string => Theme::trans('invoices.state_' . $record->state))
                    ->color(static fn (Invoice $record): string => match (true) {
                        $record->state === Invoice::PAID => 'success',
                        $record->overdue() => 'danger',
                        $record->state === Invoice::UNPAID => 'warning',
                        default => 'gray',
                    })
                    ->sortable()
                    ->description(static fn (Invoice $record): ?string => $record->paid_via
                        ? Theme::trans('invoices.paid_via', ['how' => (string) $record->paid_via])
                        : null),

                /*
                 * What was tried, and what worked.
                 *
                 * The state column says paid or not; this says how. Those are
                 * different questions, and the second one was only answerable
                 * from the database: an invoice that says unpaid after somebody
                 * swears they paid looks exactly like one nobody ever opened,
                 * and the difference - three attempts through PayPal, all still
                 * open - is the thing worth seeing.
                 *
                 * Not sortable and not searchable: it is read from rows this
                 * table does not join on, so both would quietly sort or search
                 * by something else.
                 */
                TextColumn::make('ld_attempts')
                    ->label(Theme::trans('invoices.column_attempts'))
                    ->badge()
                    ->state(static fn (Invoice $record): string => self::attempts($record))
                    ->color(static fn (Invoice $record): string => match (true) {
                        $record->state === Invoice::PAID => 'success',
                        $record->payments->isEmpty() => 'gray',
                        // Tried and not paid. Not an error - somebody may still
                        // be standing at the checkout - but the row worth
                        // looking at twice.
                        default => 'warning',
                    })
                    ->description(static fn (Invoice $record): ?string => self::attemptsNote($record)),

                TextColumn::make('due_at')
                    ->label(Theme::trans('invoices.column_due'))
                    ->date()
                    ->sortable()
                    ->placeholder(Theme::trans('invoices.no_due'))
                    // Whether it ever reached anybody. A panel whose mailer was
                    // never set up says so here rather than in a log.
                    ->description(static fn (Invoice $record): string => $record->emailed_at === null
                        ? Theme::trans('invoices.not_emailed')
                        : Theme::trans('invoices.emailed')),
            ])
            ->filters([
                SelectFilter::make('state')
                    ->label(Theme::trans('invoices.column_state'))
                    ->options([
                        Invoice::UNPAID => Theme::trans('invoices.state_unpaid'),
                        Invoice::PAID => Theme::trans('invoices.state_paid'),
                        Invoice::CANCELLED => Theme::trans('invoices.state_cancelled'),
                    ]),

                Filter::make('overdue')
                    ->label(Theme::trans('invoices.filter_overdue'))
                    ->query(static fn (Builder $query): Builder => $query
                        ->where('state', Invoice::UNPAID)
                        ->whereNotNull('due_at')
                        ->where('due_at', '<', now())),
            ])
            ->recordActions([
                Action::make('ld_open')
                    ->label(Theme::trans('invoices.open'))
                    ->icon('tabler-external-link')
                    ->color('gray')
                    ->url(static fn (Invoice $record): string => Invoices::address($record))
                    ->openUrlInNewTab(),

                Action::make('ld_paid')
                    ->label(Theme::trans('invoices.mark_paid'))
                    ->icon('tabler-cash')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalDescription(Theme::trans('invoices.mark_paid_confirm'))
                    ->visible(static fn (Invoice $record): bool => Features::mayManage(Features::INVOICES)
                        && $record->state === Invoice::UNPAID)
                    ->action(fn (Invoice $record) => $this->pay($record)),

                Action::make('ld_void')
                    ->label(Theme::trans('invoices.withdraw'))
                    ->icon('tabler-ban')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalDescription(Theme::trans('invoices.withdraw_confirm'))
                    ->visible(static fn (Invoice $record): bool => Features::mayManage(Features::INVOICES)
                        && $record->state === Invoice::UNPAID)
                    ->action(fn (Invoice $record) => $this->withdraw($record)),

                /*
                 * Giving some of it back.
                 *
                 * Only on a paid invoice, and only for what has not already
                 * been given back - Credits::refundable() is the whole invoice
                 * less every credit note already written against it, so two
                 * half refunds cannot become one and a half.
                 *
                 * The choice of where the money goes is asked rather than
                 * guessed. Back to the card and on to the account are different
                 * events, and only the person doing it knows which was agreed
                 * with the customer.
                 */
                Action::make('ld_refund')
                    ->label(Theme::trans('credit.refund'))
                    ->icon('tabler-arrow-back-up')
                    ->color('warning')
                    ->visible(static fn (Invoice $record): bool => Features::mayManage(Features::CREDIT)
                        && Credits::refundable($record) > 0)
                    ->modalWidth(Width::Medium)
                    ->modalDescription(static fn (Invoice $record): string => Theme::trans('credit.refund_helper', [
                        'left' => Money::format(Credits::refundable($record), (string) $record->currency),
                    ]))
                    ->fillForm(static fn (Invoice $record): array => [
                        'amount' => Money::toInput(Credits::refundable($record)),
                        'where' => Refunds::reversible($record, Credits::refundable($record))
                            ? Refunds::PROVIDER
                            : Refunds::BALANCE,
                    ])
                    ->schema([
                        TextInput::make('amount')
                            ->label(Theme::trans('credit.amount'))
                            ->helperText(Theme::trans('credit.refund_amount_helper'))
                            ->prefix(static fn (Invoice $record): string => Money::symbol((string) $record->currency))
                            ->required(),

                        Radio::make('where')
                            ->label(Theme::trans('credit.where'))
                            ->options([
                                Refunds::PROVIDER => Theme::trans('credit.where_provider'),
                                Refunds::BALANCE => Theme::trans('credit.where_balance'),
                            ])
                            ->descriptions([
                                Refunds::PROVIDER => Theme::trans('credit.where_provider_helper'),
                                Refunds::BALANCE => Theme::trans('credit.where_balance_helper'),
                            ])
                            ->required(),

                        TextInput::make('reason')
                            ->label(Theme::trans('credit.reason'))
                            ->helperText(Theme::trans('credit.refund_reason_helper'))
                            ->maxLength(191),
                    ])
                    ->action(fn (Invoice $record, array $data) => $this->refund($record, $data)),
            ])
            ->emptyStateHeading(Theme::trans('invoices.empty'))
            ->emptyStateDescription(Theme::trans('invoices.empty_body'))
            ->emptyStateIcon('tabler-file-invoice');
    }

    /**
     * Money arrived, by some route this panel cannot see.
     *
     * Everything that follows from that - building the server, lifting a
     * suspension, moving the date - is Invoices::markPaid()'s to decide, which
     * is what makes this button and a gateway's webhook the same event.
     */
    private function pay(Invoice $record): void
    {
        abort_unless(Features::mayManage(Features::INVOICES), 403);

        if (Invoices::markPaid($record, Invoice::MANUAL)) {
            Notification::make()
                ->title(Theme::trans('invoices.paid'))
                ->body(Theme::trans('invoices.paid_body'))
                ->success()
                ->send();

            return;
        }

        Notification::make()->title(Theme::trans('invoices.already_paid'))->warning()->send();
    }

    /**
     * Give part of an invoice back, and say plainly when it could not be.
     *
     * Every refusal has its own sentence rather than one "that did not work",
     * because the four of them are acted on differently: too much asked, no
     * payment to reverse, a provider that said no, and a document that would
     * not write. The second and third are the ones that end with somebody
     * choosing credit instead.
     *
     * @param  array<string, mixed>  $data
     */
    private function refund(Invoice $record, array $data): void
    {
        abort_unless(Features::mayManage(Features::CREDIT), 403);

        $amount = Money::fromInput($data['amount'] ?? null);

        if ($amount === null || $amount <= 0) {
            Notification::make()->title(Theme::trans('credit.bad_amount'))->danger()->send();

            return;
        }

        $result = Refunds::give(
            $record,
            $amount,
            (string) ($data['where'] ?? Refunds::BALANCE),
            trim((string) ($data['reason'] ?? '')),
            (int) (user()?->id ?? 0),
        );

        if (!$result['ok']) {
            Notification::make()
                ->title(Theme::trans('credit.refund_failed'))
                ->body(Theme::trans('credit.refused_' . $result['reason']))
                ->danger()
                ->send();

            return;
        }

        Notification::make()
            ->title(Theme::trans('credit.refunded', [
                'amount' => Money::format($amount, (string) $record->currency),
            ]))
            ->body(Theme::trans('credit.refunded_body', [
                'number' => (string) ($result['note']?->number ?? ''),
            ]))
            ->success()
            ->send();
    }

    private function withdraw(Invoice $record): void
    {
        abort_unless(Features::mayManage(Features::INVOICES), 403);

        if (Invoices::cancel($record)) {
            Notification::make()->title(Theme::trans('invoices.withdrawn'))->success()->send();

            return;
        }

        Notification::make()->title(Theme::trans('invoices.withdraw_refused'))->warning()->send();
    }
}
