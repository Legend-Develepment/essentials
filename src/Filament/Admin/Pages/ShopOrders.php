<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use LegendDevelopment\Theme\Jobs\RunRenewals;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Invoices;
use LegendDevelopment\Theme\Support\Shop\Orders;
use LegendDevelopment\Theme\Support\Shop\Tables;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Everything that has been bought, and what became of it.
 *
 * An order is about the money rather than about the server: pending means
 * nothing has been built yet, active means the account is in good standing,
 * suspended means this plugin stopped the server over an invoice, cancelled
 * means it is finished. Whether the server happens to be running right now is
 * Pelican's own question and is asked on Pelican's own pages.
 *
 * The four buttons are the four things an administrator actually needs when
 * something has gone sideways: stop one, start it again, build it again after
 * a node was full, and give a customer more time.
 */
class ShopOrders extends Page implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithForms;
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-receipt';

    protected static ?string $slug = 'essentials-orders';

    protected static ?int $navigationSort = 2;

    public static function canAccess(): bool
    {
        try {
            return Features::maySee(Features::ORDERS) && Tables::ready();
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
        return Theme::trans('orders.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('orders.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('orders.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return Theme::name() . ' CMS';
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.orders';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Order::query()->with(['user', 'package', 'server']))
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->label(Theme::trans('orders.column_order'))
                    ->formatStateUsing(static fn (Order $record): string => '#' . (int) $record->id)
                    ->sortable()
                    ->description(static fn (Order $record): ?string => $record->created_at?->diffForHumans()),

                TextColumn::make('user.username')
                    ->label(Theme::trans('orders.column_customer'))
                    ->searchable()
                    ->sortable()
                    ->placeholder(Theme::trans('orders.gone_customer'))
                    ->description(static fn (Order $record): ?string => $record->user?->email),

                TextColumn::make('package.name')
                    ->label(Theme::trans('orders.column_package'))
                    ->searchable()
                    // The order's own copy, so a package that was renamed or
                    // deleted still says what somebody actually bought.
                    ->formatStateUsing(static fn (Order $record): string => self::bought($record))
                    ->description(static fn (Order $record): string => Money::format(
                        (int) $record->price,
                        (string) $record->currency,
                    ) . ' ' . Theme::trans('packages.per_' . $record->period)),

                TextColumn::make('server.name')
                    ->label(Theme::trans('orders.column_server'))
                    ->placeholder(Theme::trans('orders.no_server'))
                    ->searchable()
                    ->wrap()
                    ->description(static fn (Order $record): ?string => $record->note ?: null)
                    ->color(static fn (Order $record): string => $record->note ? 'danger' : 'gray'),

                TextColumn::make('state')
                    ->label(Theme::trans('orders.column_state'))
                    ->badge()
                    ->formatStateUsing(static fn (Order $record): string => Theme::trans('orders.state_' . $record->state))
                    ->color(static fn (Order $record): string => match ($record->state) {
                        Order::ACTIVE => 'success',
                        Order::PENDING => 'warning',
                        Order::SUSPENDED => 'danger',
                        Order::ENDING => 'info',
                        default => 'gray',
                    })
                    /*
                     * Who ended it, under the badge.
                     *
                     * "Cancelled" answers what happened and not the question
                     * anybody actually has, which is whether the customer left
                     * or somebody here ended it - and that is the difference
                     * between a refund conversation and a support one.
                     */
                    ->description(static fn (Order $record): ?string => match ((string) $record->cancelled_by) {
                        Order::BY_CUSTOMER => Theme::trans('orders.by_customer'),
                        Order::BY_ADMIN => Theme::trans('orders.by_admin'),
                        default => null,
                    })
                    ->sortable(),

                TextColumn::make('next_due_at')
                    ->label(Theme::trans('orders.column_due'))
                    ->date()
                    ->sortable()
                    ->placeholder(static fn (Order $record): string => $record->ending()
                        ? Theme::trans('orders.no_more_dues')
                        : Theme::trans('orders.no_due'))
                    ->description(static function (Order $record): ?string {
                        /*
                         * An order with notice on it says when it stops, not
                         * how late it is - it will never be billed again, so
                         * lateness is not the thing anybody wants to read.
                         */
                        if ($record->ending() && $record->ends_at !== null) {
                            return Theme::trans('orders.ends_on', [
                                'date' => $record->ends_at->toFormattedDateString(),
                            ]);
                        }

                        $late = Orders::overdueDays($record);

                        return $late === null ? null : Theme::trans('orders.overdue_days', ['days' => $late]);
                    }),
            ])
            ->filters([
                SelectFilter::make('state')
                    ->label(Theme::trans('orders.column_state'))
                    ->options([
                        Order::PENDING => Theme::trans('orders.state_pending'),
                        Order::ACTIVE => Theme::trans('orders.state_active'),
                        Order::SUSPENDED => Theme::trans('orders.state_suspended'),
                        Order::ENDING => Theme::trans('orders.state_ending'),
                        Order::CANCELLED => Theme::trans('orders.state_cancelled'),
                    ]),

                // The one question a state filter cannot answer.
                SelectFilter::make('ld_by')
                    ->label(Theme::trans('orders.filter_by'))
                    ->attribute('cancelled_by')
                    ->options([
                        Order::BY_CUSTOMER => Theme::trans('orders.by_customer'),
                        Order::BY_ADMIN => Theme::trans('orders.by_admin'),
                    ]),

                /*
                 * The ones with a bill nobody has paid.
                 *
                 * Asked of the invoices rather than of the order's own date:
                 * the invoice is the thing that went unpaid, and it carries
                 * when it should have been settled.
                 */
                Filter::make('late')
                    ->label(Theme::trans('orders.filter_late'))
                    ->query(static fn (Builder $query): Builder => $query->whereHas(
                        'invoices',
                        static fn (Builder $q) => $q
                            ->where('state', Invoice::UNPAID)
                            ->whereNotNull('due_at')
                            ->where('due_at', '<', now()),
                    )),
            ])
            ->recordActions([
                /*
                 * What is actually on this order, in one place.
                 *
                 * The table can hold six columns before it stops being
                 * readable, and an order now carries more than six things worth
                 * knowing: what the customer answered to the package's own
                 * questions, whether their file went in, the contract dates,
                 * and the reason the last build failed. Somebody answering a
                 * ticket needs all of it and needs it without leaving the row.
                 *
                 * Read-only. Everything on this page that changes an order is
                 * its own action with its own confirmation, and a panel where
                 * one of them is hidden inside a details box is a panel where
                 * somebody cancels a service while reading it.
                 */
                Action::make('ld_details')
                    ->label(Theme::trans('orders.details'))
                    ->icon('tabler-list-details')
                    ->color('gray')
                    ->modalHeading(fn (Order $record): string => Theme::trans('orders.details_of', [
                        'number' => '#' . (int) $record->id,
                    ]))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel(Theme::trans('orders.close'))
                    ->modalContent(fn (Order $record) => view(
                        Theme::id() . '::modals.order',
                        ['rows' => Orders::detail($record)],
                    ))
                    ->visible(static fn (): bool => Features::maySee(Features::ORDERS)),

                Action::make('ld_retry')
                    ->label(Theme::trans('orders.retry'))
                    ->icon('tabler-refresh')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalDescription(Theme::trans('orders.retry_confirm'))
                    ->visible(static fn (Order $record): bool => Features::mayManage(Features::ORDERS)
                        && $record->state === Order::PENDING
                        && $record->server_id === null)
                    ->action(fn (Order $record) => $this->retry($record)),

                Action::make('ld_suspend')
                    ->label(Theme::trans('orders.suspend'))
                    ->icon('tabler-player-pause')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalDescription(Theme::trans('orders.suspend_confirm'))
                    ->visible(static fn (Order $record): bool => Features::mayManage(Features::ORDERS)
                        && $record->state === Order::ACTIVE)
                    ->action(fn (Order $record) => $this->suspend($record)),

                Action::make('ld_unsuspend')
                    ->label(Theme::trans('orders.unsuspend'))
                    ->icon('tabler-player-play')
                    ->color('success')
                    ->visible(static fn (Order $record): bool => Features::mayManage(Features::ORDERS)
                        && $record->state === Order::SUSPENDED)
                    ->action(fn (Order $record) => $this->unsuspend($record)),

                Action::make('ld_due')
                    ->label(Theme::trans('orders.change_due'))
                    ->icon('tabler-calendar')
                    ->color('gray')
                    ->schema([
                        DatePicker::make('next_due_at')
                            ->label(Theme::trans('orders.column_due'))
                            ->helperText(Theme::trans('orders.change_due_helper'))
                            ->native(false),
                    ])
                    ->fillForm(static fn (Order $record): array => [
                        'next_due_at' => $record->next_due_at,
                    ])
                    ->visible(static fn (Order $record): bool => Features::mayManage(Features::ORDERS)
                        && $record->recurring()
                        && $record->state !== Order::CANCELLED)
                    ->action(fn (Order $record, array $data) => $this->due($record, $data)),

                Action::make('ld_cancel')
                    ->label(Theme::trans('orders.cancel'))
                    ->icon('tabler-ban')
                    ->color('warning')
                    ->requiresConfirmation()
                    /*
                     * The confirmation names the date. Cancelling does not
                     * stop a service, it says when it will stop, and an
                     * administrator pressing this should read the day the
                     * customer is about to be told.
                     */
                    ->modalDescription(static function (Order $record): string {
                        $ends = Orders::endsAt($record);

                        return $ends === null
                            ? Theme::trans('orders.cancel_confirm_open')
                            : Theme::trans('orders.cancel_confirm', [
                                'date' => $ends->toFormattedDateString(),
                            ]);
                    })
                    ->visible(static fn (Order $record): bool => Features::mayManage(Features::ORDERS)
                        && !in_array($record->state, [Order::CANCELLED, Order::ENDING], true))
                    ->action(fn (Order $record) => $this->cancelOrder($record)),

                /*
                 * And the one that does not wait.
                 *
                 * Its own permission, because it is the only irreversible
                 * thing on this page: a suspension lifts, a date moves, a
                 * cancellation has a notice period, and this deletes files.
                 * The confirmation says so in those words.
                 */
                Action::make('ld_terminate')
                    ->label(Theme::trans('orders.terminate'))
                    ->icon('tabler-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading(Theme::trans('orders.terminate_heading'))
                    ->modalDescription(Theme::trans('orders.terminate_confirm'))
                    ->modalSubmitActionLabel(Theme::trans('orders.terminate_go'))
                    ->visible(static fn (Order $record): bool => Features::mayManage(Features::TERMINATE)
                        && $record->server_id !== null)
                    ->action(fn (Order $record) => $this->terminateOrder($record)),
            ])
            ->emptyStateHeading(Theme::trans('orders.empty'))
            ->emptyStateDescription(Theme::trans('orders.empty_body'))
            ->emptyStateIcon('tabler-receipt');
    }

    /** What the order says it bought, whatever happened to the package since. */
    private static function bought(Order $record): string
    {
        $spec = is_array($record->spec) ? $record->spec : [];
        $name = trim((string) ($spec['name'] ?? ''));

        return $name !== '' ? $name : (string) ($record->package?->name ?? Theme::trans('orders.gone_package'));
    }

    /**
     * The pass that normally runs on the cron, run now.
     *
     * Here because a panel whose cron is not set up has no other way to find
     * that out, and because somebody who has just changed the notice or grace
     * days wants to see what that does without waiting until tomorrow.
     *
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        if (!Features::mayManage(Features::ORDERS)) {
            return [];
        }

        return [
            Action::make('ld_renewals')
                ->label(Theme::trans('orders.run_renewals'))
                ->icon('tabler-calendar-repeat')
                ->color('gray')
                ->requiresConfirmation()
                ->modalDescription(Theme::trans('orders.run_renewals_confirm'))
                ->action(fn () => $this->renewals()),
        ];
    }

    private function renewals(): void
    {
        abort_unless(Features::mayManage(Features::ORDERS), 403);

        try {
            RunRenewals::dispatch();
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()->title(Theme::trans('orders.refused'))->warning()->send();

            return;
        }

        Notification::make()
            ->title(Theme::trans('orders.renewals_queued'))
            ->body(Theme::trans('orders.renewals_queued_body'))
            ->success()
            ->send();
    }

    private function retry(Order $record): void
    {
        abort_unless(Features::mayManage(Features::ORDERS), 403);

        if (Orders::retry($record)) {
            Notification::make()->title(Theme::trans('orders.retrying'))->success()->send();

            return;
        }

        $this->refused();
    }

    private function suspend(Order $record): void
    {
        abort_unless(Features::mayManage(Features::ORDERS), 403);

        if (Orders::suspend($record)) {
            Notification::make()->title(Theme::trans('orders.suspended'))->success()->send();

            return;
        }

        $this->refused();
    }

    private function unsuspend(Order $record): void
    {
        abort_unless(Features::mayManage(Features::ORDERS), 403);

        Invoices::unsuspend($record);

        Notification::make()->title(Theme::trans('orders.unsuspended'))->success()->send();
    }

    /** @param  array<string, mixed>  $data */
    private function due(Order $record, array $data): void
    {
        abort_unless(Features::mayManage(Features::ORDERS), 403);

        $when = $data['next_due_at'] ?? null;

        try {
            $when = $when === null || $when === '' ? null : Carbon::parse((string) $when);
        } catch (Throwable) {
            $when = null;
        }

        if (Orders::due($record, $when)) {
            Notification::make()->title(Theme::trans('orders.saved'))->success()->send();

            return;
        }

        $this->refused();
    }

    /**
     * Called cancelOrder rather than cancel: Filament's own page already has a
     * cancel, and a method that quietly replaces one of its is a bug that
     * shows up somewhere else entirely.
     */
    private function cancelOrder(Order $record): void
    {
        abort_unless(Features::mayManage(Features::ORDERS), 403);

        if (Orders::cancel($record)) {
            Notification::make()->title(Theme::trans('orders.cancelled'))->success()->send();

            return;
        }

        $this->refused();
    }

    /**
     * Stop it now and delete the server.
     *
     * Called terminateOrder for the same reason cancelOrder is: a method that
     * quietly replaces one of Filament's own is a bug that surfaces somewhere
     * else entirely.
     */
    private function terminateOrder(Order $record): void
    {
        abort_unless(Features::mayManage(Features::TERMINATE), 403);

        if (Orders::terminate($record)) {
            Notification::make()
                ->title(Theme::trans('orders.terminated'))
                ->body(Theme::trans('orders.terminated_body'))
                ->success()
                ->send();

            return;
        }

        $this->refused();
    }

    private function refused(): void
    {
        Notification::make()
            ->title(Theme::trans('orders.refused'))
            ->body(Theme::trans('orders.refused_body'))
            ->warning()
            ->send();
    }
}
