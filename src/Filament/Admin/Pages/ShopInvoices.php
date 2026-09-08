<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
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
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Invoices;
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

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Invoice::query()->with(['user', 'order']))
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

                TextColumn::make('order_id')
                    ->label(Theme::trans('invoices.column_order'))
                    ->formatStateUsing(static fn (Invoice $record): string => $record->order_id === null
                        ? Theme::trans('invoices.no_order')
                        : '#' . (int) $record->order_id),

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
