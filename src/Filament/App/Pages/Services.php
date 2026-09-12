<?php

namespace LegendDevelopment\Theme\Filament\App\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Page;
use Filament\Schemas\Contracts\HasSchemas;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Filament\Concerns\ManagesServices;
use LegendDevelopment\Theme\Support\Shop\Summary;
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
 *
 * **What a service is** is answered by Shop\Summary and **what can be done to
 * one** by the ManagesServices trait, because the page for a single service
 * asks both of the same questions. Two copies of either would be two answers to
 * one question, and only one of them would ever be fixed.
 */
class Services extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;
    use ManagesServices;

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
     * What somebody still has.
     *
     * A service that has been closed is not one of these. It is not a thing
     * they can do anything with, it has no server behind it and no bill in
     * front of it, and a page called My services that fills up with them is a
     * page where the two servers somebody actually runs get harder to find
     * every month. They are still on the page - under their own heading, at the
     * bottom - because a customer needs to be able to point at one and say
     * "that one, in March".
     *
     * @return array<int, array<string, mixed>>
     */
    public function services(): array
    {
        return $this->rows(false);
    }

    /**
     * And what they had. Cancelled only, newest first.
     *
     * @return array<int, array<string, mixed>>
     */
    public function ended(): array
    {
        return $this->rows(true);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function rows(bool $closed): array
    {
        $out = [];

        foreach (Summary::listFor((int) (user()?->id ?? 0), $closed) as $order) {
            $row = Summary::card($order);

            /*
             * The two keys that name another page, added here because Summary
             * knows nothing about pages - which is what lets the same
             * description be read by a card, by a page and by anything after
             * them.
             */
            $row['ask'] = $this->askUrl($order);
            $row['page'] = Service::getUrl(['order' => (int) $order->id]);

            $out[] = $row;
        }

        return $out;
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

        /*
         * And somewhere to ask, from the page where the question usually
         * starts. The per-card link carries the service with it; this one is
         * for the question that is not about any one of them.
         */
        if (MyTickets::canAccess()) {
            $out[] = Action::make('ld_help')
                ->label(Theme::trans('tickets.mine_nav_label'))
                ->icon('tabler-lifebuoy')
                ->color('gray')
                ->url(MyTickets::getUrl());
        }

        $out[] = Action::make('ld_invoices')
            ->label(Theme::trans('shop.billing_nav_label'))
            ->icon('tabler-file-invoice')
            ->color('gray')
            ->url(Billing::getUrl());

        return $out;
    }
}
