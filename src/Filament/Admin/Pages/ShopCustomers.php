<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
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
                    ])),
            ])
            ->emptyStateHeading(Theme::trans('customers.empty'))
            ->emptyStateDescription(Theme::trans('customers.empty_body'))
            ->emptyStateIcon('tabler-users');
    }
}
