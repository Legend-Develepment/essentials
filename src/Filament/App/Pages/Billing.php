<?php

namespace LegendDevelopment\Theme\Filament\App\Pages;

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
use Illuminate\Support\Collection;
use LegendDevelopment\Theme\Models\Credit;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Credits;
use LegendDevelopment\Theme\Support\Shop\Gateways;
use LegendDevelopment\Theme\Support\Shop\Invoices;
use LegendDevelopment\Theme\Support\Shop\Packages;
use LegendDevelopment\Theme\Support\Shop\Tables;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Somebody's own orders and invoices.
 *
 * Scoped by user id in the query rather than filtered in the view, so there is
 * no arrangement of the page that can show somebody else's money. No
 * permission of its own: this is a person's own billing, the way the panel's
 * own account page is their own account.
 *
 * Invoices and nothing else. What somebody holds is on the services page, and
 * that split is not tidying: "what do I have" is asked when a server is
 * misbehaving and "what do I owe" is asked once a month, and one column
 * holding both made each of them harder to find.
 *
 * Paying happens on a page of its own again, so an unpaid invoice carries one
 * link across to it: choosing how to pay is a decision, and a decision
 * deserves more room than the end of a row.
 *
 * While no payment provider is switched on there is nothing to link to, and
 * the page shows whatever the administrator wrote about paying instead. That
 * is a supported way to run this rather than a placeholder: the invoice is
 * real, the admin marks it paid, and the server appears.
 */
class Billing extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-file-invoice';

    protected static ?string $slug = 'billing';

    protected static ?int $navigationSort = 81;

    public static function canAccess(): bool
    {
        try {
            return Features::enabled(Features::SHOP) && Tables::ready() && user() !== null;
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('shop.invoices_title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('shop.invoices_subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('shop.billing_nav_label');
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.billing';
    }

    private function userId(): int
    {
        return (int) (user()?->id ?? 0);
    }

    /**
     * This person's invoices, newest first.
     *
     * @return array<int, array<string, mixed>>
     */
    public function invoices(): array
    {
        $out = [];

        try {
            $invoices = Invoice::query()
                ->where('user_id', $this->userId())
                ->orderByDesc('id')
                ->limit(100)
                ->get();
        } catch (Throwable) {
            return [];
        }

        foreach ($invoices as $invoice) {
            $out[] = Invoices::row($invoice);
        }

        return $out;
    }

    /** Whether anything on this page is waiting to be paid. */
    public function owing(): bool
    {
        try {
            return Invoice::query()
                ->where('user_id', $this->userId())
                ->where('state', Invoice::UNPAID)
                ->exists();
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * How to pay, while there is no provider to press a button on.
     *
     * Empty is a real answer and the page says so: an invoice that is unpaid
     * and gives no way to pay it is a question somebody will ask in a ticket,
     * so the page tells them to ask rather than leaving a blank.
     */
    /**
     * Turn a typed amount into an invoice, and send them to pay it.
     *
     * The invoice is an ordinary one and the payment page is the ordinary one,
     * so a top-up goes through every provider the shop already has and settles
     * by the same webhook. What makes it a top-up is what paying it does, which
     * is in Invoices::markPaid() and not here.
     *
     * @param  array<string, mixed>  $data
     */
    public function topUp(array $data): void
    {
        abort_unless(self::canAccess() && Features::enabled(Features::CREDIT), 403);

        $amount = Money::fromInput($data['amount'] ?? null);

        if ($amount === null || $amount < Credits::LEAST || $amount > Credits::MOST) {
            Notification::make()
                ->title(Theme::trans('credit.topup_bad'))
                ->body(Theme::trans('credit.topup_amount_helper', [
                    'least' => Money::format(Credits::LEAST, Packages::currency()),
                    'most' => Money::format(Credits::MOST, Packages::currency()),
                ]))
                ->danger()
                ->send();

            return;
        }

        $invoice = Credits::topUp(user(), $amount);

        if (!$invoice instanceof Invoice) {
            Notification::make()->title(Theme::trans('credit.topup_failed'))->danger()->send();

            return;
        }

        $this->redirect(Pay::getUrl(['invoice' => (int) $invoice->id]));
    }

    /**
     * What the shop is holding for this customer, and where it came from.
     *
     * Nought and an empty list when the feature is off or nothing was ever
     * given, and the view draws nothing at all then. A panel that never uses
     * credit should not have a block on its billing page explaining that it has
     * none.
     *
     * @return array{held: int, currency: string, movements: Collection<int, Credit>}
     */
    public function credit(): array
    {
        $mine = (int) (user()?->id ?? 0);

        return [
            'held' => Credits::balance($mine),
            'currency' => Packages::currency(),
            'movements' => Credits::history($mine, 10),
        ];
    }

    public function payNote(): string
    {
        return trim((string) Theme::config('shop_pay_note', ''));
    }

    public function storeUrl(): ?string
    {
        return Store::canAccess() ? Store::getUrl() : null;
    }

    /**
     * The other half of what a customer has.
     *
     * Header actions rather than a line in the page, because these are the two
     * places somebody goes from here and the client panel has no sidebar to
     * put them in.
     *
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        $out = [];

        /*
         * Putting money on the account, first, because it is the only thing on
         * this page that does something rather than goes somewhere.
         *
         * Offered only where there is a way to pay it. A shop taking bank
         * transfers has no button that could work here, and a button that opens
         * a payment page with nothing on it is worse than no button.
         */
        if (Features::enabled(Features::CREDIT) && Gateways::any()) {
            $out[] = Action::make('ld_topup')
                ->label(Theme::trans('credit.topup'))
                ->icon('tabler-wallet')
                ->color('gray')
                ->modalWidth(Width::Medium)
                ->modalDescription(fn (): string => Theme::trans('credit.topup_helper', [
                    'held' => Money::format(Credits::mine(), Packages::currency()),
                ]))
                ->modalSubmitActionLabel(Theme::trans('credit.topup_go'))
                ->schema([
                    TextInput::make('amount')
                        ->label(Theme::trans('credit.amount'))
                        ->helperText(Theme::trans('credit.topup_amount_helper', [
                            'least' => Money::format(Credits::LEAST, Packages::currency()),
                            'most' => Money::format(Credits::MOST, Packages::currency()),
                        ]))
                        ->prefix(Money::symbol(Packages::currency()))
                        ->required(),
                ])
                ->action(fn (array $data) => $this->topUp($data));
        }

        if (Store::canAccess()) {
            $out[] = Action::make('ld_store')
                ->label(Theme::trans('shop.store_nav_label'))
                ->icon('tabler-shopping-bag')
                ->color('gray')
                ->url(Store::getUrl());
        }

        if (MyTickets::canAccess()) {
            $out[] = Action::make('ld_help')
                ->label(Theme::trans('tickets.mine_nav_label'))
                ->icon('tabler-lifebuoy')
                ->color('gray')
                ->url(MyTickets::getUrl());
        }

        if (Services::canAccess()) {
            $out[] = Action::make('ld_services')
                ->label(Theme::trans('shop.services_nav_label'))
                ->icon('tabler-server-2')
                ->color('gray')
                ->url(Services::getUrl());
        }

        return $out;
    }

    /**
     * Whether there is anything to press Pay for.
     *
     * A panel taking bank transfers has no providers, and there the page shows
     * the administrator's own words about how to pay instead of a button that
     * leads to a page with nothing on it.
     */
    public function payable(): bool
    {
        return Gateways::any();
    }

    /** Where the Pay button on one invoice goes. */
    public function payUrl(int $invoice): string
    {
        return Pay::getUrl(['invoice' => $invoice]);
    }

}
