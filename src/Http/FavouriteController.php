<?php

namespace LegendDevelopment\Theme\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use LegendDevelopment\Theme\Support\Favourites;
use LegendDevelopment\Theme\Support\Features;

/**
 * Saves one person's starred servers and starred pages.
 *
 * A controller rather than a closure route, for the same reason the arranger
 * has one: closures cannot be serialised, so a panel that runs `route:cache`
 * would refuse to cache at all.
 *
 * There is no user id in the request and there must not be. The list belongs to
 * whoever is signed in, which the session already says - accepting an id here
 * would be offering to write into somebody else's file, and no amount of
 * checking it afterwards is as safe as never having asked.
 *
 * One endpoint for both lists rather than two, and what makes that work is that
 * a missing key means *untouched* rather than *empty*. The stars on the server
 * cards send only `ids` and the top bar sends only `pages`; either arriving
 * alone must not clear the other, and it is the same file.
 */
class FavouriteController
{
    public function __invoke(Request $request): JsonResponse
    {
        // Checked here as well as where the star is drawn: switching the
        // feature off has to close the endpoint too, not only hide the button.
        abort_unless(
            Features::maySee(Features::FAVOURITES) || Features::maySee(Features::QUICK),
            403,
        );

        $validated = $request->validate([
            'ids' => ['array', 'max:' . Favourites::MAX],
            // The shape of a Pelican short id. Favourites::put() checks this
            // again before writing - the rule here is so a bad request is a 422
            // with a reason rather than a silent list that came back shorter
            // than it went out.
            'ids.*' => ['string', 'regex:/^[A-Za-z0-9-]{4,64}$/'],

            'pages' => ['array', 'max:' . Favourites::MAX],
            'pages.*' => ['array'],
            // A path inside this panel and nothing else. Checked again in
            // Favourites::cleanPages() before it is written, for the same
            // reason: this one is here to make a refusal legible.
            'pages.*.path' => ['required', 'string', 'max:191', 'regex:#^/[A-Za-z0-9/_-]*$#'],
            'pages.*.label' => ['required', 'string', 'max:191'],
        ]);

        /*
         * Both halves, and honest about a half that did not land.
         *
         * A page starred while the disk is full has to come back as a failure
         * even though the servers were fine - the top bar redraws from this
         * answer, and reporting success for a write that did not happen is how
         * a star comes to sit there lit until the next reload takes it away.
         */
        $saved = true;

        if (array_key_exists('ids', $validated)) {
            $saved = Favourites::put($validated['ids']) && $saved;
        }

        if (array_key_exists('pages', $validated)) {
            $saved = Favourites::putPages($validated['pages']) && $saved;
        }

        /*
         * The stored lists come back, always.
         *
         * The browser drew its stars before asking, so this is what makes the
         * two agree afterwards: a list that was capped, or one where something
         * was dropped for not being an id, returns shorter than it was sent and
         * the page redraws from the answer rather than from its own hope.
         */
        return response()->json([
            'saved' => $saved,
            'ids' => Favourites::for(),
            'pages' => array_values(Favourites::pages()),
        ], $saved ? 200 : 500);
    }
}
