<?php

namespace LegendDevelopment\Theme\Filament\App\Pages;

use BackedEnum;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Contracts\HasSchemas;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
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
 * While no payment provider is switched on, an unpaid invoice shows whatever
 * the administrator wrote in the shop settings - bank details, or where to
 * send the money. That is the whole of paying on a panel without gateways, and
 * it is a supported way to run this rather than a placeholder: the invoice is
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
        return Theme::trans('shop.billing_title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('shop.billing_subheading');
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
     * This person's orders, newest first.
     *
     * @return array<int, array<string, mixed>>
     */
    public function orders(): array
    {
        $out = [];

        try {
            $orders = Order::query()
                ->where('user_id', $this->userId())
                ->with('server')
                ->orderByDesc('id')
                ->limit(100)
                ->get();
        } catch (Throwable) {
            return [];
        }

        foreach ($orders as $order) {
            $spec = is_array($order->spec) ? $order->spec : [];

            $out[] = [
                'id' => (int) $order->id,
                'name' => trim((string) ($spec['name'] ?? '')) ?: Theme::trans('orders.gone_package'),
                'state' => Theme::trans('orders.state_' . $order->state),
                'colour' => match ($order->state) {
                    Order::ACTIVE => 'success',
                    Order::PENDING => 'warning',
                    Order::SUSPENDED => 'danger',
                    default => 'gray',
                },
                'server' => $order->server?->name,
                'price' => Money::format((int) $order->price, (string) $order->currency)
                    . ' ' . Theme::trans('packages.per_' . $order->period),
                'due' => $order->next_due_at?->toFormattedDateString(),
                // Only the two states a customer can do anything about.
                'note' => match ($order->state) {
                    Order::PENDING => Theme::trans('shop.order_pending'),
                    Order::SUSPENDED => Theme::trans('shop.order_suspended'),
                    default => null,
                },
            ];
        }

        return $out;
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
     * The providers somebody can pay with right now.
     *
     * Empty is the normal case on a panel that takes bank transfers, and the
     * page says so with the administrator's own words rather than with an
     * empty row of buttons.
     *
     * @return array<string, string>
     */
    public function ways(): array
    {
        $out = [];

        foreach (array_keys(Gateways::enabled()) as $key) {
            $out[$key] = Gateways::label($key);
        }

        return $out;
    }

    /**
     * Send somebody to a provider.
     *
     * Everything is checked again here rather than trusted from the button:
     * the invoice is this person's, it is still unpaid, and the provider is
     * still switched on. A page open in a tab for an hour has no claim on any
     * of the three.
     */
    public function pay(int $invoice, string $gateway): void
    {
        abort_unless(self::canAccess(), 403);

        $provider = Gateways::get($gateway);

        try {
            $row = Invoice::query()->find($invoice);
        } catch (Throwable) {
            $row = null;
        }

        if ($provider === null || !$row instanceof Invoice) {
            $this->refuse();

            return;
        }

        if ((int) $row->user_id !== $this->userId() || !$row->open()) {
            $this->refuse();

            return;
        }

        try {
            $url = $provider->start(
                $row,
                url('/essentials/pay/' . $gateway . '/return/' . (int) $row->id),
                url('/essentials/pay/' . $gateway . '/webhook'),
            );
        } catch (Throwable $exception) {
            report($exception);

            $url = null;
        }

        if ($url === null) {
            /*
             * A provider that is on but misconfigured is a sentence, never a
             * 500. The customer is told to try another way; the administrator
             * finds the reason on the Payments page and in the log.
             */
            $this->refuse();

            return;
        }

        $this->redirect($url);
    }

    private function refuse(): void
    {
        Notification::make()
            ->title(Theme::trans('shop.pay_refused'))
            ->body(Theme::trans('shop.pay_refused_body'))
            ->warning()
            ->persistent()
            ->send();
    }
}
