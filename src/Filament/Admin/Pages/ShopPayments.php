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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Payment;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Gateways;
use LegendDevelopment\Theme\Support\Shop\Refunds;
use LegendDevelopment\Theme\Support\Shop\Tables;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Every attempt to pay, and what the provider said about it.
 *
 * One row per attempt rather than per invoice, because that is what actually
 * happened: somebody pressing Pay twice makes two, and a payment that failed
 * and was retried is two facts rather than one changed one.
 *
 * The button that matters is **Re-check**. A webhook blocked by a firewall in
 * front of the panel leaves a payment sitting open while the money is long
 * gone from the customer's account, and the fix is to ask the provider again -
 * which is the same code the webhook runs, so a re-check that says paid builds
 * the server exactly as the webhook would have.
 */
class ShopPayments extends Page implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithForms;
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-credit-card';

    protected static ?string $slug = 'essentials-payments';

    protected static ?int $navigationSort = 4;

    public static function canAccess(): bool
    {
        try {
            return Features::maySee(Features::PAYMENTS) && Tables::ready();
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
        return Theme::trans('payments.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('payments.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('payments.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return Theme::name() . ' CMS';
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.payments';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Payment::query()->with('invoice'))
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('invoice.number')
                    ->label(Theme::trans('payments.column_invoice'))
                    ->searchable()
                    ->placeholder(Theme::trans('payments.gone_invoice'))
                    ->description(static fn (Payment $record): ?string => $record->created_at?->diffForHumans()),

                TextColumn::make('gateway')
                    ->label(Theme::trans('payments.column_gateway'))
                    ->formatStateUsing(static fn (Payment $record): string => Gateways::label((string) $record->gateway))
                    ->sortable(),

                TextColumn::make('gateway_id')
                    ->label(Theme::trans('payments.column_reference'))
                    ->searchable()
                    ->copyable()
                    ->limit(24)
                    ->fontFamily('mono'),

                TextColumn::make('amount')
                    ->label(Theme::trans('payments.column_amount'))
                    ->formatStateUsing(static fn (Payment $record): string => Money::format(
                        (int) $record->amount,
                        (string) $record->currency,
                    )),

                TextColumn::make('state')
                    ->label(Theme::trans('payments.column_state'))
                    ->badge()
                    ->formatStateUsing(static fn (Payment $record): string => Theme::trans('payments.state_' . $record->state))
                    ->color(static fn (Payment $record): string => match ($record->state) {
                        Payment::PAID => 'success',
                        Payment::OPEN => 'warning',
                        Payment::FAILED => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label(Theme::trans('payments.column_updated'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('state')
                    ->label(Theme::trans('payments.column_state'))
                    ->options([
                        Payment::OPEN => Theme::trans('payments.state_open'),
                        Payment::PAID => Theme::trans('payments.state_paid'),
                        Payment::FAILED => Theme::trans('payments.state_failed'),
                        Payment::CANCELLED => Theme::trans('payments.state_cancelled'),
                    ]),

                SelectFilter::make('gateway')
                    ->label(Theme::trans('payments.column_gateway'))
                    ->options(static fn (): array => array_map(
                        static fn (string $key): string => Gateways::label($key),
                        array_combine(array_keys(Gateways::all()), array_keys(Gateways::all())),
                    )),
            ])
            ->recordActions([
                Action::make('ld_recheck')
                    ->label(Theme::trans('payments.recheck'))
                    ->icon('tabler-refresh')
                    ->color('warning')
                    ->visible(static fn (Payment $record): bool => Features::mayManage(Features::PAYMENTS)
                        && $record->state !== Payment::PAID)
                    ->action(fn (Payment $record) => $this->recheck($record)),

                /*
                 * Giving this one back.
                 *
                 * The same action as on the invoices page and the same class
                 * behind it, offered here because this is where somebody ends
                 * up when the question started with the payment rather than
                 * with the document - "he says he paid twice" is asked from a
                 * list of payments.
                 *
                 * What is left in a payment is what it took less what has
                 * already gone back out of it, which is not the same as what is
                 * left on its invoice: an invoice can hold more than one.
                 */
                Action::make('ld_refund')
                    ->label(Theme::trans('credit.refund'))
                    ->icon('tabler-arrow-back-up')
                    ->color('warning')
                    ->visible(static fn (Payment $record): bool => Features::mayManage(Features::CREDIT)
                        && $record->state === Payment::PAID
                        && self::left($record) > 0)
                    ->modalWidth(Width::Medium)
                    ->modalDescription(static fn (Payment $record): string => Theme::trans('credit.refund_helper', [
                        'left' => Money::format(self::left($record), (string) $record->currency),
                    ]))
                    ->fillForm(static fn (Payment $record): array => [
                        'amount' => Money::toInput(self::left($record)),
                        'where' => Refunds::PROVIDER,
                    ])
                    ->schema([
                        TextInput::make('amount')
                            ->label(Theme::trans('credit.amount'))
                            ->helperText(Theme::trans('credit.refund_amount_helper'))
                            ->prefix(static fn (Payment $record): string => Money::symbol((string) $record->currency))
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
                    ->action(fn (Payment $record, array $data) => $this->refund($record, $data)),

                Action::make('ld_raw')
                    ->label(Theme::trans('payments.answer'))
                    ->icon('tabler-code')
                    ->color('gray')
                    ->modalWidth(Width::Large)
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel(Theme::trans('payments.close'))
                    ->modalContent(fn (Payment $record) => view(Theme::id() . '::modals.payment', [
                        'lines' => self::answer($record),
                    ])),
            ])
            ->emptyStateHeading(Theme::trans('payments.empty'))
            ->emptyStateDescription(Theme::trans('payments.empty_body'))
            ->emptyStateIcon('tabler-credit-card');
    }

    /**
     * The provider's last answer, flattened to lines a person can read.
     *
     * Not a dump of json: an administrator looking at a payment that will not
     * settle wants six words, and a pretty-printed object is six words hidden
     * inside a wall of brackets.
     *
     * @return array<string, string>
     */
    private static function answer(Payment $record): array
    {
        $raw = is_array($record->raw) ? $record->raw : [];
        $out = [];

        foreach ($raw as $key => $value) {
            if (is_array($value)) {
                $value = implode(' ', array_map(
                    static fn (mixed $part): string => is_scalar($part) ? (string) $part : '',
                    $value,
                ));
            }

            $out[(string) $key] = trim(is_scalar($value) ? (string) $value : '');
        }

        return $out === [] ? [Theme::trans('payments.no_answer') => ''] : $out;
    }

    /**
     * Ask the provider again.
     *
     * The same settle() a webhook runs, so nothing about the outcome depends
     * on which of the two got here - and a payment whose provider has since
     * been switched off says so rather than doing nothing quietly.
     */
    /** What this payment still holds: what it took, less what has gone back. */
    private static function left(Payment $record): int
    {
        return max(0, (int) $record->amount - (int) $record->refunded);
    }

    /**
     * Give part of a payment back, through the invoice it belongs to.
     *
     * Through the invoice because that is where the paperwork lives: a credit
     * note is written against a document, not against an attempt. A payment
     * whose invoice has gone is a payment nothing can be written about, which
     * is a refusal rather than a silence.
     *
     * @param  array<string, mixed>  $data
     */
    private function refund(Payment $record, array $data): void
    {
        abort_unless(Features::mayManage(Features::CREDIT), 403);

        $invoice = $record->invoice;
        $amount = Money::fromInput($data['amount'] ?? null);

        if (!$invoice instanceof Invoice) {
            Notification::make()
                ->title(Theme::trans('credit.refund_failed'))
                ->body(Theme::trans('credit.refused_no_payment'))
                ->danger()
                ->send();

            return;
        }

        if ($amount === null || $amount <= 0 || $amount > self::left($record)) {
            Notification::make()->title(Theme::trans('credit.bad_amount'))->danger()->send();

            return;
        }

        $result = Refunds::give(
            $invoice,
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

    private function recheck(Payment $record): void
    {
        abort_unless(Features::mayManage(Features::PAYMENTS), 403);

        $provider = Gateways::get((string) $record->gateway);

        if ($provider === null) {
            Notification::make()
                ->title(Theme::trans('payments.no_gateway'))
                ->body(Theme::trans('payments.no_gateway_body'))
                ->warning()
                ->send();

            return;
        }

        try {
            $paid = $provider->settle($record);
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('payments.recheck_failed'))
                ->body(Theme::trans('payments.recheck_failed_body'))
                ->danger()
                ->send();

            return;
        }

        if ($paid) {
            Notification::make()
                ->title(Theme::trans('payments.settled'))
                ->body(Theme::trans('payments.settled_body'))
                ->success()
                ->send();

            return;
        }

        Notification::make()
            ->title(Theme::trans('payments.rechecked'))
            ->body(Theme::trans('payments.rechecked_body'))
            ->info()
            ->send();
    }
}
