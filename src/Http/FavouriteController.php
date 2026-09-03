<?php

namespace LegendDevelopment\Theme\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use LegendDevelopment\Theme\Support\Favourites;
use LegendDevelopment\Theme\Support\Features;

/**
 * Saves one person's starred servers.
 *
 * A controller rather than a closure route, for the same reason the arranger
 * has one: closures cannot be serialised, so a panel that runs `route:cache`
 * would refuse to cache at all.
 *
 * There is no user id in the request and there must not be. The list belongs to
 * whoever is signed in, which the session already says - accepting an id here
 * would be offering to write into somebody else's file, and no amount of
 * checking it afterwards is as safe as never having asked.
 */
class FavouriteController
{
    public function __invoke(Request $request): JsonResponse
    {
        // Checked here as well as where the star is drawn: switching the
        // feature off has to close the endpoint too, not only hide the button.
        abort_unless(Features::maySee(Features::FAVOURITES), 403);

        $validated = $request->validate([
            'ids' => ['array', 'max:' . Favourites::MAX],
            // The shape of a Pelican short id. Favourites::put() checks this
            // again before writing - the rule here is so a bad request is a 422
            // with a reason rather than a silent list that came back shorter
            // than it went out.
            'ids.*' => ['string', 'regex:/^[A-Za-z0-9-]{4,64}$/'],
        ]);

        $saved = Favourites::put($validated['ids'] ?? []);

        /*
         * The stored list comes back, always.
         *
         * The browser drew its stars before asking, so this is what makes the
         * two agree afterwards: a list that was capped, or one where something
         * was dropped for not being an id, returns shorter than it was sent and
         * the page redraws from the answer rather than from its own hope.
         */
        return response()->json([
            'saved' => $saved,
            'ids' => Favourites::for(),
        ], $saved ? 200 : 500);
    }
}
