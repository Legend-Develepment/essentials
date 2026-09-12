<?php

namespace LegendDevelopment\Theme\Filament\Concerns;

use Filament\Notifications\Notification;
use LegendDevelopment\Theme\Filament\App\Pages\MyTickets;
use LegendDevelopment\Theme\Filament\App\Pages\Pay;
use LegendDevelopment\Theme\Models\Addon;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Models\OrderAddon;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Shop\Addons;
use LegendDevelopment\Theme\Support\Shop\Customers;
use LegendDevelopment\Theme\Support\Shop\Orders;
use LegendDevelopment\Theme\Support\Shop\Summary;
use LegendDevelopment\Theme\Support\Shop\Upgrades;
use LegendDevelopment\Theme\Support\Tickets\Board;
use LegendDevelopment\Theme\Support\Theme;

/**
 * The things a customer can do to their own service.
 *
 * **Not in Support, and that is the whole reason this is a trait.** Every
 * method here ends in a notification or a redirect, which is page work: it
 * needs the Livewire component it is running on. What these methods *decide*
 * lives in Support\Shop - Upgrades, Addons, Orders - and is reached from here.
 *
 * Shared by the list of services and by the page for one of them, so pressing
 * the same button in two places cannot do two different things. The views reach
 * them by wire:click, so the signatures are part of the markup: extra(id,
 * addon), unextra(id, line), change(id, package), give(id, when). **No gate
 * checks a wire:click**, and nothing in the toolchain parses a Blade file, so a
 * renamed argument here is found by a customer.
 *
 * Whoever uses this must declare canAccess(); every method below asks it again
 * rather than trusting that a button was drawn, because whether a button was
 * drawn is a decision about drawing.
 */
trait ManagesServices
{
    /**
     * Buy an extra for a service that is already running.
     *
     * The price is worked out here rather than trusted from the page, for the
     * reason a package change is: what a card said five minutes ago is not what
     * the shop owes anybody now.
     */
    public function extra(int $order, int $addon): void
    {
        abort_unless(self::canAccess(), 403);

        $row = $this->mine($order);
        $what = Addon::query()->find($addon);

        if ($row === null || !$what instanceof Addon) {
            $this->refuse();

            return;
        }

        $result = Addons::buy($row, $what, 1, (string) (Customers::profile((int) (user()?->id ?? 0))->vat ?? ''));

        if (!$result['ok']) {
            Notification::make()
                ->title(Theme::trans('addons.refused'))
                ->body(Theme::trans('addons.refused_' . $result['reason']))
                ->danger()
                ->send();

            return;
        }

        if ($result['invoice'] instanceof Invoice) {
            $this->redirect(Pay::getUrl(['invoice' => (int) $result['invoice']->id]));

            return;
        }

        Notification::make()
            ->title(Theme::trans('addons.added', ['name' => (string) $what->name]))
            ->body(Theme::trans('addons.added_body'))
            ->success()
            ->send();
    }

    /** Give one up, and get the unused part of it back. */
    public function unextra(int $order, int $line): void
    {
        abort_unless(self::canAccess(), 403);

        $row = $this->mine($order);
        $what = OrderAddon::query()->find($line);

        if ($row === null || !$what instanceof OrderAddon) {
            $this->refuse();

            return;
        }

        $result = Addons::drop($row, $what);

        if (!$result['ok']) {
            Notification::make()
                ->title(Theme::trans('addons.refused'))
                ->body(Theme::trans('addons.refused_' . $result['reason']))
                ->danger()
                ->send();

            return;
        }

        Notification::make()
            ->title(Theme::trans('addons.dropped', ['name' => (string) $what->name]))
            ->body(Theme::trans('addons.dropped_body'))
            ->success()
            ->send();
    }

    /**
     * Move this service to another package.
     *
     * The quote is worked out again here rather than trusted from the page:
     * what a card said five minutes ago is not what the shop owes anybody now,
     * and a form posting a price is a form somebody can edit.
     */
    public function change(int $order, int $package): void
    {
        abort_unless(self::canAccess(), 403);

        $row = $this->mine($order);
        $to = Package::query()->find($package);

        if ($row === null) {
            $this->refuse();

            return;
        }

        if (!$to instanceof Package) {
            $this->refuse();

            return;
        }

        $result = Upgrades::start($row, $to, (string) (Customers::profile((int) $row->user_id)->vat ?? ''));

        if (!$result['ok']) {
            Notification::make()
                ->title(Theme::trans('upgrades.refused'))
                ->body(Theme::trans('upgrades.refused_' . $result['reason']))
                ->danger()
                ->send();

            return;
        }

        // Something to pay: straight to the page that takes it, like a purchase.
        if ($result['invoice'] instanceof Invoice) {
            $this->redirect(Pay::getUrl(['invoice' => (int) $result['invoice']->id]));

            return;
        }

        Notification::make()
            ->title(Theme::trans('upgrades.done', ['name' => (string) $to->name]))
            ->body(Theme::trans('upgrades.done_body'))
            ->success()
            ->send();
    }

    /**
     * Give one up, at the end of the term or now.
     *
     * Both roads are the ones an administrator's buttons take - Orders::cancel
     * and Orders::terminate - because a customer ending a service and an
     * administrator ending it are the same event, and two implementations of
     * that would drift apart on the day one of them is fixed.
     */
    public function give(int $order, string $when): void
    {
        abort_unless(self::canAccess(), 403);

        $row = $this->mine($order);

        if ($row === null) {
            $this->refuse();

            return;
        }

        if (!Summary::mayCancel($row)) {
            $this->refuse();

            return;
        }

        // Written down as the customer's own doing, which is the whole of what
        // an administrator wants to know when they open the order afterwards.
        $done = $when === 'now'
            ? Orders::terminate($row, Order::BY_CUSTOMER)
            : Orders::cancel($row, Order::BY_CUSTOMER);

        if (!$done) {
            $this->refuse();

            return;
        }

        Notification::make()
            ->title(Theme::trans($when === 'now' ? 'shop.gave_now' : 'shop.gave_end'))
            ->body(Theme::trans($when === 'now' ? 'shop.gave_now_body' : 'shop.gave_end_body'))
            ->success()
            ->send();
    }

    /** One sentence when it could not be done, and no detail about why. */
    protected function refuse(): void
    {
        Notification::make()
            ->title(Theme::trans('shop.gave_refused'))
            ->body(Theme::trans('shop.gave_refused_body'))
            ->warning()
            ->send();
    }

    /**
     * An order that is this customer's, or null.
     *
     * Theirs and only theirs. The sentence itself lives on Orders, because it
     * was written out four times across three pages and that is three chances
     * for one of them to be written slightly differently.
     */
    protected function mine(int $order): ?Order
    {
        return Orders::mine($order, (int) (user()?->id ?? 0));
    }

    /** Where to go to ask about this service, or null when nobody can. */
    protected function askUrl(Order $order): ?string
    {
        // The page being reachable is not the same as new questions being
        // taken. A card that offered to start one while the intake is closed
        // is a card that sends somebody to a page with no button on it.
        if (!MyTickets::canAccess() || !Board::opening()) {
            return null;
        }

        return MyTickets::getUrl(['about' => (int) $order->id]);
    }
}
