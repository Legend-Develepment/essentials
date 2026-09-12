<?php

namespace LegendDevelopment\Theme\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Shop\Tables;
use LegendDevelopment\Theme\Support\Theme;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * A visitor with no account lands on the shop, not on the login form.
 *
 * "Open the shop first" moves the store onto the panel's front door, and the
 * front door belongs to a panel that requires an account - so a stranger
 * following a link to the shop was met by a sign-in form, which is the one
 * thing a shop must not do. Somebody who has not bought anything yet has
 * nothing to sign in to.
 *
 * So they are sent to /shop instead, the public page, which lists the same
 * packages and puts them at the checkout when they pick one. The panel bounces
 * them to the login at *that* point, with the checkout stored as where they
 * were going - which is the right moment to ask, because by then there is a
 * reason to have an account.
 *
 * **Guarded so it costs nothing on any other request.** The two cheapest
 * questions are asked first, and they are string comparisons: is this a GET,
 * and is it the panel's front door. Everything else - the features, the tables,
 * the setting - is only reached by a request that already passed those.
 *
 * The address is read from Filament rather than written down, because the
 * panel a customer sits in is mounted at the site root on a default install and
 * somewhere else on a panel that was set up differently. Nothing here assumes
 * which.
 */
class ShopFirst
{
    /** Where a stranger is sent, and the one address this must never guard. */
    private const SHOP = 'shop';

    public function handle(Request $request, Closure $next): Response
    {
        if ($this->sendToShop($request)) {
            return redirect('/' . self::SHOP);
        }

        return $next($request);
    }

    /**
     * Whether this particular request is a stranger at the front door.
     *
     * Every no is a reason to leave the request alone, and they are ordered by
     * what they cost to ask.
     */
    private function sendToShop(Request $request): bool
    {
        try {
            // A form post, a Livewire update, a fetch for JSON: none of them are
            // somebody arriving, and redirecting any of them breaks a page.
            if (!$request->isMethod('GET') || $request->ajax() || $request->wantsJson()) {
                return false;
            }

            if (!$this->atFrontDoor($request)) {
                return false;
            }

            // Somebody signed in has a panel to be in. This is only about the
            // people who have not got one yet.
            if ($request->user() !== null) {
                return false;
            }

            /*
             * Both switches, because this sends people to a page the public
             * shop switch is what publishes. With that one off there is no
             * /shop to send anybody to, and the login is then the correct
             * answer rather than a worse one.
             */
            if (!Features::enabled(Features::SHOP) || !Features::enabled(Features::PUBLIC_SHOP)) {
                return false;
            }

            if (!(bool) Theme::config('shop_landing', false)) {
                return false;
            }

            return Tables::ready();
        } catch (Throwable) {
            // A question that could not be answered leaves the panel doing what
            // it did before this file existed.
            return false;
        }
    }

    /** Whether this address is the root of the panel a customer signs in to. */
    private function atFrontDoor(Request $request): bool
    {
        $here = trim($request->path(), '/');

        // Laravel answers "/" for the site root, and the trim above makes that
        // the empty string - which is also what a panel mounted at the root
        // gives for its own path.
        $panel = trim((string) (Filament::getPanel('app')?->getPath() ?? ''), '/');

        /*
         * A panel mounted at /shop would be sent to itself, forever. It is not
         * a sensible way to set a panel up and this plugin's own route would be
         * arguing with it either way, but an endless redirect on the front door
         * is the one failure here worth a line of code to make impossible.
         */
        if ($panel === self::SHOP) {
            return false;
        }

        return $here === $panel;
    }
}
