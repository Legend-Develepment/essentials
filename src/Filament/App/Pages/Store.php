<?php

namespace LegendDevelopment\Theme\Filament\App\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Page;
use Filament\Schemas\Contracts\HasSchemas;
use Illuminate\Support\Collection;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Packages;
use LegendDevelopment\Theme\Support\Shop\Purchase;
use LegendDevelopment\Theme\Support\Shop\Tables;
use Filament\Notifications\Notification;
use LegendDevelopment\Theme\Support\Shop\Waiting;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * What is for sale, to somebody who is signed in.
 *
 * The same list the public page shows, drawn inside the panel so that buying
 * is one click rather than a trip through a login. Nothing here is a decision:
 * every card leads to the checkout page, and the checkout page is where the
 * total and the terms are.
 *
 * No permission of its own, like the other client pages. What it shows is
 * public by definition - it is a shop - and gating it per role would mean an
 * administrator having to grant every customer the right to give them money.
 * The master switch is the shop feature, in one place.
 */
class Store extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-shopping-bag';

    protected static ?string $slug = 'store';

    protected static ?int $navigationSort = 80;

    /**
     * Take the panel's landing page, or give it back.
     *
     * Mirrors Pelican's own ServerResource::embedServerList(), which is the
     * other half of this: that method moves the server list off the root and
     * puts it in the navigation, and this one moves the shop onto it. Neither
     * is any use without the other, so they are called together.
     *
     * An empty slug is a route path of '/', which is the panel root. The
     * setting is read once while the panel is being built, not per request -
     * routes are registered once and a slug that changed underneath them would
     * be a page at an address nothing links to.
     */
    public static function asLanding(bool $landing = true): void
    {
        self::$slug = $landing ? '' : 'store';
    }

    public static function canAccess(): bool
    {
        try {
            return Features::enabled(Features::SHOP) && Tables::ready() && user() !== null;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * Ask to be told when this one is for sale again.
     *
     * The refusal is a word rather than a sentence, and the page turns it into
     * one: the reasons are the same on both sides of the shop and a second copy
     * of the wording would drift from the first.
     */
    public function wait(int $package): void
    {
        abort_unless(self::canAccess(), 403);

        $row = Package::query()->find($package);
        $me = (int) (user()?->id ?? 0);

        if (!$row instanceof Package) {
            $this->refused(Waiting::GONE);

            return;
        }

        $why = Waiting::join($row, $me);

        if ($why !== null) {
            $this->refused($why);

            return;
        }

        Notification::make()
            ->title(Theme::trans('shop.wait_joined'))
            ->body(Theme::trans('shop.wait_joined_body', ['name' => (string) $row->name]))
            ->success()
            ->send();
    }

    /**
     * And off it again.
     *
     * Takes the id straight from the page and never checks it, which is safe
     * for the reason written on Waiting::leave(): it only ever deletes the
     * caller's own row. That is also what lets somebody leave the list for a
     * package that has since been withdrawn from sale.
     */
    public function unwait(int $package): void
    {
        abort_unless(self::canAccess(), 403);

        Waiting::leave($package, (int) (user()?->id ?? 0));

        Notification::make()
            ->title(Theme::trans('shop.wait_left'))
            ->success()
            ->send();
    }

    private function refused(string $why): void
    {
        Notification::make()
            ->title(Theme::trans('shop.wait_refused'))
            ->body(Theme::trans('shop.wait_refused_' . $why))
            ->warning()
            ->send();
    }

    public function getTitle(): string
    {
        return Theme::trans('shop.store_title');
    }

    public function getSubheading(): ?string
    {
        $note = trim((string) Theme::config('shop_note', ''));

        return $note !== '' ? $note : Theme::trans('shop.store_subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('shop.store_nav_label');
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.store';
    }

    /**
     * The customer's own things, from the page they land on.
     *
     * Header actions rather than a sidebar row, because the client panel has
     * no sidebar - and because when this page is the landing page these are
     * the only signposts to a customer's services and invoices there are.
     *
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        $out = [];

        if (Services::canAccess()) {
            $out[] = Action::make('ld_services')
                ->label(Theme::trans('shop.services_nav_label'))
                ->icon('tabler-server-2')
                ->color('gray')
                ->url(Services::getUrl());
        }

        if (Billing::canAccess()) {
            $out[] = Action::make('ld_invoices')
                ->label(Theme::trans('shop.billing_nav_label'))
                ->icon('tabler-file-invoice')
                ->color('gray')
                ->url(Billing::getUrl());
        }

        return $out;
    }

    /**
     * The cards, already answered.
     *
     * Everything the card needs is worked out here rather than in the view -
     * the price as a sentence, whether there is one left, where Buy goes - so
     * the Blade file is markup and the decisions are somewhere they can be
     * read.
     *
     * @return array<int, array<string, mixed>>
     */
    public function cards(): array
    {
        // Once for the page. Every card asks about the same person.
        $me = (int) (user()?->id ?? 0);

        $currency = Packages::currency();
        $out = [];

        /** @var Collection<int, Package> $packages */
        $packages = Packages::live();

        foreach ($packages as $package) {
            $left = Packages::stockLeft($package);

            $out[] = [
                'id' => (int) $package->id,
                'name' => (string) $package->name,
                'description' => trim((string) $package->description),
                'price' => Money::format(Packages::priceNow($package), $currency),
                /*
                 * What it cost before the offer, for the line drawn through it.
                 * Null when there is no offer or when the offer only starts
                 * further into the basket - a struck-out price beside a price
                 * somebody cannot have yet is a shop telling a small lie.
                 */
                'was' => Packages::onOffer($package) && Packages::offerNeeds($package) <= 1
                    ? Money::format((int) $package->price, $currency)
                    : null,
                /*
                 * Where an offer waits for a fuller basket, the amount and the
                 * condition go in one sentence: "Save 2.50 from 2 items".
                 *
                 * The card used to name the condition and not the amount, which
                 * is the weakest of the three things it could say - somebody
                 * reads a rule they have to follow with no idea what following
                 * it is worth. Saying both is not a promise the card cannot
                 * keep, because the condition is right there in it.
                 */
                'offer_from' => Packages::offerNeeds($package) > 1
                    ? Theme::trans('shop.offer_from', [
                        'count' => Packages::offerNeeds($package),
                        'amount' => Money::format(
                            Packages::offerOff($package, Packages::offerNeeds($package)),
                            $currency,
                        ),
                    ])
                    : null,
                'on_offer' => Packages::onOffer($package),
                /*
                 * And what that is worth in money, which is the number somebody
                 * actually reads. "25% off" is arithmetic somebody has to do;
                 * "Save 2.50" is the answer.
                 *
                 * Null where the offer waits for a fuller basket, for the same
                 * reason the struck-out price is: it is not a saving this card
                 * can promise yet.
                 */
                'saved' => Packages::onOffer($package) && Packages::offerNeeds($package) <= 1
                    ? Theme::trans('shop.saved_amount', [
                        'amount' => Money::format(Packages::offerOff($package), $currency),
                    ])
                    : null,
                'popular' => (bool) $package->popular,
                /*
                 * The same amount as a number, for sorting by.
                 *
                 * The formatted one carries a currency symbol and a decimal
                 * separator that depend on where somebody is, and sorting a
                 * list of strings like that puts "1 000,00" beside "10,00".
                 * Minor units are what the database holds and what sorts.
                 */
                'amount' => Packages::priceNow($package),
                'per' => Theme::trans('packages.per_' . Packages::period($package->period)),
                'setup' => (int) $package->setup_fee > 0
                    ? Theme::trans('shop.plus_setup', [
                        'amount' => Money::format((int) $package->setup_fee, $currency),
                    ])
                    : null,
                'specs' => Packages::specs($package),
                'art' => Packages::art($package),
                'term' => Packages::termLabel($package),
                'left' => $left,
                'sold_out' => Purchase::refusal($package) !== null,
                /*
                 * And whether there is a list to join, or one already joined.
                 *
                 * Both asked per card rather than once for the page, because
                 * both are about this package: one of them is whether it has
                 * run out at all.
                 */
                'waitable' => Waiting::may($package, $me) === null,
                'waiting' => Waiting::listed((int) $package->id, $me),
                'url' => Checkout::getUrl(['package' => (int) $package->id]),
            ];
        }

        return $out;
    }

    /**
     * The three or four numbers somebody actually compares.
     *
     * Memory, disk and CPU, in the units the panel uses everywhere else, plus
     * backups and databases when there are any. Not the whole limit list: a
     * card that lists eleven fields is a card nobody reads.
     *
     * @return array<int, string>
     */
}
