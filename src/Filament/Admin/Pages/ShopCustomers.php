<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
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
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Credits;
use LegendDevelopment\Theme\Support\Shop\Customers;
use LegendDevelopment\Theme\Support\Shop\Packages;
use LegendDevelopment\Theme\Support\Shop\Tables;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * The shop, facing the person instead of the row.
 *
 * Orders, invoices and payments are each a list of things that happened. This
 * is the same information asked the question somebody answering a ticket
 * actually has: who is this, what do they hold, what have they paid, what is
 * still outstanding. Answering that by reading three tables and doing the
 * arithmetic in your head is how mistakes get made in front of a customer.
 *
 * **Only people who have bought.** A panel with four hundred users and nine
 * customers shows nine rows, because the list is built from the orders rather
 * than from the users - a customer is somebody who ordered, not somebody who
 * signed up.
 *
 * Opening one shows their services and their invoices side by side, which is
 * the other half of the same question: not "what happened" but "what does this
 * person have right now".
 */
class ShopCustomers extends Page implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithForms;
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-users';

    protected static ?string $slug = 'essentials-customers';

    protected static ?int $navigationSort = 6;

    public static function canAccess(): bool
    {
        try {
            return Features::maySee(Features::CUSTOMERS) && Tables::ready();
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
        return Theme::trans('customers.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('customers.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('customers.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return Theme::name() . ' CMS';
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.customers';
    }

    public function table(Table $table): Table
    {
        $currency = Packages::currency();

        return $table
            ->query(fn (): Builder => Customers::query())
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('username')
                    ->label(Theme::trans('customers.column_customer'))
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->description(static fn (User $record): ?string => $record->email),

                TextColumn::make('ld_services')
                    ->label(Theme::trans('customers.column_services'))
                    ->state(static fn (User $record): string => (string) Customers::of((int) $record->id)['services'])
                    ->description(static fn (User $record): string => Theme::trans('customers.of_orders', [
                        'count' => Customers::of((int) $record->id)['orders'],
                    ])),

                TextColumn::make('ld_spent')
                    ->label(Theme::trans('customers.column_spent'))
                    ->state(static fn (User $record): string => Money::format(
                        Customers::of((int) $record->id)['spent'],
                        $currency,
                    )),

                TextColumn::make('ld_outstanding')
                    ->label(Theme::trans('customers.column_outstanding'))
                    ->state(static function (User $record) use ($currency): string {
                        $owed = Customers::of((int) $record->id)['outstanding'];

                        return $owed > 0
                            ? Money::format($owed, $currency)
                            : Theme::trans('customers.nothing_owed');
                    })
                    ->color(static fn (User $record): string => Customers::of((int) $record->id)['outstanding'] > 0
                        ? 'warning'
                        : 'gray'),

                /*
                 * What the shop is holding for them.
                 *
                 * Beside what they owe on purpose: those two are the same
                 * question asked from opposite ends, and somebody about to
                 * chase an unpaid invoice should be able to see in the same
                 * row that the money is already here.
                 */
                TextColumn::make('ld_credit')
                    ->label(Theme::trans('credit.column'))
                    ->visible(static fn (): bool => Features::maySee(Features::CREDIT))
                    ->state(function (User $record) use ($currency): string {
                        $held = Credits::balance((int) $record->id);

                        return $held > 0 ? Money::format($held, $currency) : Theme::trans('credit.none');
                    })
                    ->color(static fn (User $record): string => Credits::balance((int) $record->id) > 0
                        ? 'success'
                        : 'gray'),
            ])
            ->filters([
                /*
                 * The two questions worth a filter, and both are about money
                 * rather than about people: who owes something, and who is
                 * paying for something right now.
                 */
                Filter::make('owing')
                    ->label(Theme::trans('customers.filter_owing'))
                    ->query(static fn (Builder $query): Builder => $query->whereIn(
                        'id',
                        Invoice::query()->select('user_id')->where('state', Invoice::UNPAID)->distinct(),
                    )),

                Filter::make('active')
                    ->label(Theme::trans('customers.filter_active'))
                    ->query(static fn (Builder $query): Builder => $query->whereIn(
                        'id',
                        Order::query()->select('user_id')->where('state', Order::ACTIVE)->distinct(),
                    )),
            ])
            ->recordActions([
                Action::make('ld_open')
                    ->label(Theme::trans('customers.open'))
                    ->icon('tabler-eye')
                    ->color('gray')
                    ->slideOver()
                    ->modalWidth(Width::TwoExtraLarge)
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel(Theme::trans('customers.close'))
                    ->modalHeading(static fn (User $record): string => (string) $record->username)
                    ->modalContent(fn (User $record) => view(Theme::id() . '::modals.customer', [
                        'summary' => Customers::of((int) $record->id),
                        'services' => Customers::services((int) $record->id),
                        'invoices' => Customers::invoices((int) $record->id),
                        'currency' => $currency,
                        // Who they are, beside what they have bought. An
                        // address is the one thing on this page that is not
                        // derived from their orders, and the one thing a
                        // question about an invoice usually turns out to be.
                        'profile' => Customers::profile((int) $record->id),

                        // What the shop holds for them, and where it came
                        // from. In the same window as their invoices because
                        // "why is this one cheaper" is answered by the two
                        // read together.
                        'credit' => Credits::balance((int) $record->id),
                        'movements' => Credits::history((int) $record->id, 12),
                    ])),

                /*
                 * Putting money on somebody's account.
                 *
                 * Its own permission and not the invoices one, and that gap is
                 * deliberate: marking an invoice paid records that money
                 * arrived, and this hands money out. A shop may well want the
                 * first in more hands than the second.
                 *
                 * There is no button here to take credit off again. The way to
                 * undo a mistake is to give the negative of it, which leaves
                 * both movements in the history - and a ledger somebody can
                 * quietly edit is not a ledger.
                 */
                Action::make('ld_credit')
                    ->label(Theme::trans('credit.give'))
                    ->icon('tabler-wallet')
                    ->color('gray')
                    ->visible(static fn (): bool => Features::mayManage(Features::CREDIT))
                    ->modalWidth(Width::Medium)
                    ->modalDescription(fn (User $record): string => Theme::trans('credit.give_helper', [
                        'held' => Money::format(Credits::balance((int) $record->id), $currency),
                    ]))
                    ->schema([
                        TextInput::make('amount')
                            ->label(Theme::trans('credit.amount'))
                            ->helperText(Theme::trans('credit.amount_helper'))
                            ->prefix(Money::symbol($currency))
                            ->required(),

                        TextInput::make('reason')
                            ->label(Theme::trans('credit.reason'))
                            ->helperText(Theme::trans('credit.reason_helper'))
                            ->maxLength(191),
                    ])
                    ->action(fn (User $record, array $data) => $this->giveCredit($record, $data)),
            ])
            ->emptyStateHeading(Theme::trans('customers.empty'))
            ->emptyStateDescription(Theme::trans('customers.empty_body'))
            ->emptyStateIcon('tabler-users');
    }

    /**
     * An amount that is allowed to be negative.
     *
     * Money::fromInput() refuses a minus sign, and it is right to: everywhere
     * else in this panel it reads a price, and a price below nothing is a typo.
     * Here the minus is the whole point, so the sign is taken off the front and
     * put back afterwards rather than loosening that rule for every price field
     * in the plugin.
     */
    private static function signed(mixed $typed): ?int
    {
        $text = trim((string) (is_scalar($typed) ? $typed : ''));
        $negative = str_starts_with($text, '-');

        $amount = Money::fromInput($negative ? ltrim(mb_substr($text, 1)) : $text);

        return $amount === null ? null : ($negative ? -$amount : $amount);
    }

    /**
     * Put money on an account, or take it off.
     *
     * A negative amount is allowed and is the only way to undo a mistake: both
     * movements stay in the history, which is what a ledger is for. Nought is
     * refused because it would be a row saying nothing happened.
     *
     * @param  array<string, mixed>  $data
     */
    private function giveCredit(User $record, array $data): void
    {
        abort_unless(Features::mayManage(Features::CREDIT), 403);

        $amount = self::signed($data['amount'] ?? null);
        $reason = trim((string) ($data['reason'] ?? ''));

        if ($amount === null || $amount === 0) {
            Notification::make()->title(Theme::trans('credit.bad_amount'))->danger()->send();

            return;
        }

        $done = $amount > 0
            ? Credits::add((int) $record->id, $amount, $reason, null, (int) (user()?->id ?? 0))
            : Credits::spend((int) $record->id, -$amount, $reason);

        if (!$done) {
            Notification::make()
                ->title(Theme::trans($amount > 0 ? 'credit.give_failed' : 'credit.take_failed'))
                ->body(Theme::trans($amount > 0 ? 'credit.give_failed_body' : 'credit.take_failed_body'))
                ->danger()
                ->send();

            return;
        }

        Notification::make()
            ->title(Theme::trans('credit.given', [
                'amount' => Money::format(abs($amount), Packages::currency()),
                'who' => (string) $record->username,
            ]))
            ->success()
            ->send();
    }
}
