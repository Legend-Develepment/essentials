<?php

namespace LegendDevelopment\Theme\Http;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Palette;
use LegendDevelopment\Theme\Support\Shop\Billing;
use LegendDevelopment\Theme\Support\Shop\Packages;
use LegendDevelopment\Theme\Support\Shop\Delivery;
use LegendDevelopment\Theme\Support\Shop\Purchase;
use LegendDevelopment\Theme\Support\Shop\Tables;
use LegendDevelopment\Theme\Support\Status\Publish;
use LegendDevelopment\Theme\Support\Theme;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

/**
 * The two shop pages that are not inside the panel.
 *
 * The one at `/shop` is for somebody who has not signed in, and is the same
 * list the store page shows. It publishes nothing a customer could not see after
 * logging in, which is why it is one switch rather than a set of choices about
 * what to reveal. Off answers 404, the way the status page does: a 403 would
 * tell a scanner that this panel runs this plugin with the shop turned off.
 *
 * Buy sends somebody to the login with the checkout page as the intended
 * destination, so they arrive back where they were going. There is no public
 * registration here and this plugin does not add one - the panel's own
 * settings decide whether anybody can make an account.
 *
 * The one at `/essentials/invoice/{id}` is the printable invoice, behind auth.
 * Its own owner or somebody holding the invoices permission, and nobody else -
 * not even with the number, which people forward to each other. It is styled for
 * paper, so "print to PDF" in any browser gives a document worth keeping.
 */
class ShopController
{
    /** The public shop. */
    public function __invoke(Request $request): View
    {
        abort_unless($this->open(), 404);

        $currency = Packages::currency();
        $cards = [];

        foreach (Packages::live() as $package) {
            $cards[] = [
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
                // The number behind it, for sorting - see the panel's own store.
                'amount' => Packages::priceNow($package),
                'per' => Theme::trans('packages.per_' . Packages::period($package->period)),
                'setup' => (int) $package->setup_fee > 0
                    ? Theme::trans('shop.plus_setup', [
                        'amount' => Money::format((int) $package->setup_fee, $currency),
                    ])
                    : null,
                // The same list the panel's own store shows. It used to be
                // this one, three lines long, and the two drifted.
                'specs' => Packages::specs($package),
                'art' => Packages::art($package),
                'term' => Packages::termLabel($package),
                /*
                 * The game, from the egg. It labels the picture and it is what
                 * the filter row filters on, so a panel selling four games is
                 * four short lists rather than one long one.
                 */
                'group' => $this->game($package),
                'sold_out' => Purchase::refusal($package) !== null,
                /*
                 * Straight at the checkout, signed in or not.
                 *
                 * Somebody who is not signed in is bounced to the login by the
                 * panel's own auth middleware, which stores this address as
                 * the intended one - and Pelican's login response sends them
                 * to redirect()->intended(), so they land back on the checkout
                 * for the package they clicked.
                 *
                 * The first version of this pointed at /login with a redirect
                 * query of its own. Pelican reads no such parameter: it went
                 * to the dashboard and the package was lost between the click
                 * and the arrival.
                 */
                'url' => url('/checkout?package=' . (int) $package->id),
            ];
        }

        $style = Publish::style();
        $heading = trim((string) Theme::config('shop_heading', ''));
        $terms = trim((string) Theme::config('shop_terms_url', ''));
        $logo = trim((string) Theme::config('logo_url', ''));

        /*
         * The games, in the order the packages are already sorted in, each one
         * once. A shop selling one game gets no filter row at all - a control
         * with a single option is a control that only takes up space.
         */
        $groups = [];

        foreach ($cards as $card) {
            if ($card['group'] !== null && !in_array($card['group'], $groups, true)) {
                $groups[] = $card['group'];
            }
        }

        return view(Theme::id() . '::shop', [
            'title' => $heading !== '' ? $heading : (string) config('app.name', 'Shop'),
            'note' => trim((string) Theme::config('shop_note', '')),
            'cards' => $cards,
            'groups' => $groups,
            'terms' => str_starts_with($terms, 'https://') ? $terms : null,
            'panelUrl' => url('/'),
            /*
             * The panel's own name and logo, so the header on this page is the
             * header of the same panel rather than a bar that happens to be the
             * same colour. The logo is whatever the theme's brand setting
             * points at; without one the name stands on its own, which is what
             * a panel with no logo shows anyway.
             */
            'brand' => (string) config('app.name', 'Panel'),
            'logo' => $logo !== '' ? $logo : null,
            'logoHeight' => Theme::config('logo_height', '2'),
            /*
             * Which of the two labels the button carries. Somebody already
             * signed in is not being asked to sign in again, and the address is
             * the same either way - the panel bounces a guest to the login on
             * its own.
             */
            'signedIn' => $request->user() instanceof User,
            'accent' => $style['accent'],
            'mode' => $style['mode'],
            'surface' => $style['surface'],
            'card' => Palette::shift($style['surface'], 0.03),
            'line' => Palette::shift($style['surface'], 0.08),
            'radius' => match ($style['radius']) {
                'sharp' => '0',
                'round' => '0.9rem',
                default => '0.5rem',
            },
        ]);
    }

    /**
     * What game a package is for, as somebody would say it.
     *
     * The egg's name, because that is the thing an administrator already
     * writes carefully and the thing a customer recognises. Null when the egg
     * is gone, which leaves the card without a label rather than with a blank
     * one - and Packages::live() already leaves those packages out.
     */
    private function game(Package $package): ?string
    {
        try {
            $name = trim((string) $package->egg?->name);
        } catch (Throwable) {
            return null;
        }

        return $name !== '' ? $name : null;
    }

    /**
     * The customer's uploaded file, for the daemon to collect.
     *
     * No session and no user: a daemon has neither. What stands in for both is
     * the signature Laravel put on the address, which the `signed` middleware
     * has already checked by the time this runs - unforgeable without the app
     * key, and expired an hour after it was made.
     *
     * 404 for everything else, including an order that has already had its file
     * delivered. There is nothing here to enumerate: an id that answers
     * differently depending on whether it exists is a way to count the orders
     * this panel has taken.
     */
    public function upload(Request $request, int $order): StreamedResponse
    {
        abort_unless(Features::enabled(Features::SHOP) && Tables::ready(), 404);

        $row = Order::query()->find($order);

        abort_unless($row instanceof Order, 404);

        $path = trim((string) $row->upload_path);

        abort_if($path === '' || $row->delivered_at !== null, 404);

        try {
            abort_unless(Storage::disk(Delivery::DISK)->exists($path), 404);

            return Storage::disk(Delivery::DISK)->download($path, Delivery::NAME);
        } catch (Throwable) {
            abort(404);
        }
    }

    /**
     * One invoice, laid out for printing.
     *
     * 404 rather than 403 for somebody else's invoice, for the same reason the
     * status page does: an id that answers differently depending on whether it
     * exists is a way to count how many invoices this panel has written.
     */
    public function invoice(Request $request, int $id): View
    {
        abort_unless(Features::enabled(Features::SHOP) && Tables::ready(), 404);

        $user = $request->user();

        abort_if(!$user instanceof User, 404);

        try {
            $invoice = Invoice::query()->find($id);
        } catch (Throwable) {
            abort(404);
        }

        abort_if(!$invoice instanceof Invoice, 404);

        $mine = (int) $invoice->user_id === (int) $user->id;
        $admin = $this->mayReadAny($user);

        abort_unless($mine || $admin, 404);

        $currency = (string) $invoice->currency;

        return view(Theme::id() . '::invoice', [
            'invoice' => $invoice,
            'currency' => $currency,
            'lines' => is_array($invoice->lines) ? $invoice->lines : [],
            'money' => static fn (int $minor): string => Money::format($minor, $currency),
            // Name, address, VAT and Chamber of Commerce - see Billing::issuer(),
            // which is the one place all three documents read it from.
            'issuer' => Billing::issuer(),
            'payNote' => $invoice->open() ? trim((string) Theme::config('shop_pay_note', '')) : '',
            'panelUrl' => url('/'),
        ]);
    }

    /** Whether the public page is switched on at all. */
    private function open(): bool
    {
        try {
            return Features::enabled(Features::SHOP)
                && Features::enabled(Features::PUBLIC_SHOP)
                && Tables::ready();
        } catch (Throwable) {
            return false;
        }
    }

    /** Whether this person may read anybody's invoice. */
    private function mayReadAny(User $user): bool
    {
        try {
            // Either half. Reading somebody's invoice is looking at it, so
            // the view-only grant is exactly the one that should open this.
            return $user->can(Theme::PERMISSION_VIEW)
                || $user->can(Features::permission(Features::INVOICES))
                || $user->can(Features::viewPermission(Features::INVOICES));
        } catch (Throwable) {
            return false;
        }
    }
}
