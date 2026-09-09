<?php

namespace LegendDevelopment\Theme\Filament\App\Pages;

use App\Enums\ServerState;
use App\Models\Server;
use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Contracts\HasSchemas;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Orders;
use LegendDevelopment\Theme\Support\Shop\Packages;
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
                ->with(['server', 'package.egg'])
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
                    Order::ENDING => 'info',
                    default => 'gray',
                },
                'server' => $server?->name,
                /*
                 * What the panel knows about the machine, which is a different
                 * question from what the order says. An order can be active
                 * while its server is still installing, and somebody looking at
                 * "Active" and a server that will not start needs the second
                 * sentence rather than a support ticket.
                 *
                 * The panel's own state and not the daemon's: asking the node
                 * whether each server is running is one network call per card,
                 * on a page somebody opens to look at a list.
                 */
                'server_state' => self::serverState($server),
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
                /*
                 * Both ways out, or neither. Ending is the ordinary one - it
                 * runs to the date they were told and nothing is deleted before
                 * then. Now is the other, and it is only offered because being
                 * unable to leave is its own kind of trap; the confirmation
                 * says what it costs in the plainest words there are.
                 */
                'may_cancel' => $this->mayCancel($order),
                'ends_on' => Orders::endsAt($order)?->toFormattedDateString(),
                /*
                 * The card keeps the package's picture, so a service looks
                 * like the thing that was bought. From the package rather than
                 * the snapshot: a picture is decoration, and showing today's
                 * one costs nobody anything.
                 */
                'art' => $order->package instanceof Package ? Packages::art($order->package) : null,
                'note' => match ($order->state) {
                    Order::PENDING => Theme::trans('shop.order_pending'),
                    Order::SUSPENDED => Theme::trans('shop.order_suspended'),
                    // The one sentence somebody with notice on their service
                    // actually needs: the day it stops.
                    Order::ENDING => $order->ends_at === null
                        ? Theme::trans('shop.order_ending_open')
                        : Theme::trans('shop.order_ending', [
                            'date' => $order->ends_at->toFormattedDateString(),
                        ]),
                    default => null,
                },
            ];
        }

        return $out;
    }

    /**
     * What the panel knows about the machine behind one order.
     *
     * Null when there is nothing to say, which is a server doing what a server
     * ordinarily does: the card already says the order is active, and repeating
     * "running" under it is a line nobody needs.
     */
    private static function serverState(?Server $server): ?string
    {
        if (!$server instanceof Server) {
            return null;
        }

        try {
            $state = $server->status;

            if ($state === null) {
                return null;
            }

            return match ($state) {
                ServerState::Installing => Theme::trans('shop.server_installing'),
                ServerState::InstallFailed, ServerState::ReinstallFailed => Theme::trans('shop.server_failed'),
                ServerState::Suspended => Theme::trans('shop.server_suspended'),
                ServerState::RestoringBackup => Theme::trans('shop.server_restoring'),
            };
        } catch (Throwable) {
            // A state this panel does not recognise is a state not worth
            // guessing at on somebody's billing page.
            return null;
        }
    }

    /**
     * Whether this person may give this service up themselves.
     *
     * Off unless the panel says so: on a panel that would rather be asked
     * first, a cancel button is a support process somebody skipped. An order
     * that is already ending or already closed has nothing to give up.
     */
    private function mayCancel(Order $order): bool
    {
        try {
            if (!(bool) Theme::config('shop_self_cancel', false)) {
                return false;
            }

            return !in_array($order->state, [Order::CANCELLED, Order::ENDING], true);
        } catch (Throwable) {
            return false;
        }
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

        $user = user();
        $row = Order::query()->find($order);

        // Theirs, and only theirs. A page left open in a tab has no claim on
        // an id somebody typed into it.
        if (!$user instanceof User || !$row instanceof Order || (int) $row->user_id !== (int) $user->id) {
            $this->refuse();

            return;
        }

        if (!$this->mayCancel($row)) {
            $this->refuse();

            return;
        }

        $done = $when === 'now' ? Orders::terminate($row) : Orders::cancel($row);

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
    private function refuse(): void
    {
        Notification::make()
            ->title(Theme::trans('shop.gave_refused'))
            ->body(Theme::trans('shop.gave_refused_body'))
            ->warning()
            ->send();
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
