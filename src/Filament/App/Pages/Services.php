<?php

namespace LegendDevelopment\Theme\Filament\App\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Page;
use Filament\Schemas\Contracts\HasSchemas;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Tables;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * What this customer is paying for, and which server each of them became.
 *
 * Split out of the billing page, which held services and invoices in one
 * column and made both harder to read. They are different questions asked at
 * different times: "what do I have" is asked when something is wrong with a
 * server, and "what do I owe" is asked once a month.
 *
 * This one leads to the servers. Every card that has been built carries a link
 * straight into it, because somebody who came here from a shop that told them
 * their server was ready wants the server, not a receipt.
 *
 * Scoped by user id in the query rather than filtered in the view, so there is
 * no arrangement of the page that shows somebody else's.
 */
class Services extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-server-2';

    protected static ?string $slug = 'services';

    protected static ?int $navigationSort = 80;

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
        return Theme::trans('shop.services_title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('shop.services_subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('shop.services_nav_label');
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.services';
    }

    /**
     * Everything this person bought, newest first.
     *
     * @return array<int, array<string, mixed>>
     */
    public function services(): array
    {
        $out = [];

        try {
            $orders = Order::query()
                ->where('user_id', (int) (user()?->id ?? 0))
                ->with('server')
                ->orderByDesc('id')
                ->limit(100)
                ->get();
        } catch (Throwable) {
            return [];
        }

        foreach ($orders as $order) {
            $spec = is_array($order->spec) ? $order->spec : [];
            $server = $order->server;

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
                'server' => $server?->name,
                /*
                 * Straight into the server, by the uuid Pelican's own server
                 * panel is addressed by. Built as a path rather than resolved
                 * through that panel's routes, because those belong to a panel
                 * this page is not on.
                 */
                'url' => $server === null ? null : url('/server/' . $server->uuid_short),
                'price' => Money::format((int) $order->price, (string) $order->currency)
                    . ' ' . Theme::trans('packages.per_' . $order->period),
                'due' => $order->next_due_at?->toFormattedDateString(),
                'specs' => $this->specs($spec),
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
     * The three numbers somebody compares, from the order's own snapshot.
     *
     * @param  array<string, mixed>  $spec
     * @return array<int, string>
     */
    private function specs(array $spec): array
    {
        return [
            Theme::trans('shop.spec_memory', ['amount' => (int) ($spec['memory'] ?? 0)]),
            Theme::trans('shop.spec_disk', ['amount' => (int) ($spec['disk'] ?? 0)]),
            Theme::trans('shop.spec_cpu', ['amount' => (int) ($spec['cpu'] ?? 0)]),
        ];
    }

    /** @return array<int, Action> */
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

        $out[] = Action::make('ld_invoices')
            ->label(Theme::trans('shop.billing_nav_label'))
            ->icon('tabler-file-invoice')
            ->color('gray')
            ->url(Billing::getUrl());

        return $out;
    }
}
