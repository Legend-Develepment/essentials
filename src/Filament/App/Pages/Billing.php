<?php

namespace LegendDevelopment\Theme\Filament\App\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Page;
use Filament\Schemas\Contracts\HasSchemas;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Gateways;
use LegendDevelopment\Theme\Support\Shop\Invoices;
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
            $out[] = [
                'number' => (string) $invoice->number,
                'kind' => Theme::trans('invoices.kind_' . $invoice->kind),
                'state' => Theme::trans('invoices.state_' . $invoice->state),
                'colour' => match (true) {
                    $invoice->paid() => 'success',
                    $invoice->overdue() => 'danger',
                    $invoice->open() => 'warning',
                    default => 'gray',
                },
                'total' => Money::format((int) $invoice->total, (string) $invoice->currency),
                'due' => $invoice->due_at?->toFormattedDateString(),
                'open' => $invoice->open(),
                'url' => Invoices::address($invoice),
                'id' => (int) $invoice->id,
            ];
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

        if (Store::canAccess()) {
            $out[] = Action::make('ld_store')
                ->label(Theme::trans('shop.store_nav_label'))
                ->icon('tabler-shopping-bag')
                ->color('gray')
                ->url(Store::getUrl());
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
