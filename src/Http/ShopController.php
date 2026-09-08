<?php

namespace LegendDevelopment\Theme\Http;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Palette;
use LegendDevelopment\Theme\Support\Shop\Packages;
use LegendDevelopment\Theme\Support\Shop\Purchase;
use LegendDevelopment\Theme\Support\Shop\Tables;
use LegendDevelopment\Theme\Support\Status\Publish;
use LegendDevelopment\Theme\Support\Theme;
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
                'price' => Money::format((int) $package->price, $currency),
                'per' => Theme::trans('packages.per_' . Packages::period($package->period)),
                'setup' => (int) $package->setup_fee > 0
                    ? Theme::trans('shop.plus_setup', [
                        'amount' => Money::format((int) $package->setup_fee, $currency),
                    ])
                    : null,
                'specs' => [
                    Theme::trans('shop.spec_memory', ['amount' => (int) $package->memory]),
                    Theme::trans('shop.spec_disk', ['amount' => (int) $package->disk]),
                    Theme::trans('shop.spec_cpu', ['amount' => (int) $package->cpu]),
                ],
                'sold_out' => Purchase::refusal($package) !== null,
                /*
                 * Straight to the login, carrying where they were going.
                 *
                 * Not to the checkout page itself: Filament would bounce them
                 * to the login and forget the package on the way, which is a
                 * customer landing on an empty panel wondering what happened
                 * to the thing they clicked.
                 */
                'url' => url('/login?redirect=' . urlencode('/checkout?package=' . (int) $package->id)),
            ];
        }

        $style = Publish::style();
        $heading = trim((string) Theme::config('shop_heading', ''));
        $terms = trim((string) Theme::config('shop_terms_url', ''));

        return view(Theme::id() . '::shop', [
            'title' => $heading !== '' ? $heading : (string) config('app.name', 'Shop'),
            'note' => trim((string) Theme::config('shop_note', '')),
            'cards' => $cards,
            'terms' => str_starts_with($terms, 'https://') ? $terms : null,
            'panelUrl' => url('/'),
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
            'issuer' => (string) config('app.name', 'Panel'),
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
            return $user->can(Theme::PERMISSION_VIEW)
                || $user->can(Features::permission(Features::INVOICES));
        } catch (Throwable) {
            return false;
        }
    }
}
