<?php

namespace LegendDevelopment\Theme\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Quick;

/**
 * What the top bar's switcher shows when it is opened, and what it finds when
 * something is typed into it.
 *
 * A GET rather than the POST beside it, because it changes nothing - and read
 * only, so the panel can answer it as often as somebody types without any of
 * the care a write needs.
 *
 * Which servers come back is Pelican's own answer to who may see what, asked
 * through accessibleServers(). Nothing here decides that; this is a search box
 * over a list somebody already has, not a new way into one they do not.
 */
class QuickController
{
    public function __invoke(Request $request): JsonResponse
    {
        abort_unless(Features::maySee(Features::QUICK), 403);

        /*
         * The query is taken as a string and clipped rather than validated.
         *
         * A search box is not a form: somebody who pastes four hundred
         * characters into it should get no results, which is true, rather than
         * a 422 the box has nowhere to show. It goes into a LIKE pattern that
         * Quick::search() escapes and into a bound parameter, so a long or odd
         * one is a failed search and not a problem.
         */
        $query = $request->query('q');
        $query = is_string($query) ? mb_substr($query, 0, 100) : '';

        $found = Quick::search($query);

        return response()->json([
            'servers' => $found['servers'],
            'more' => $found['more'],
            // Only on the first ask. A search is over everything the person can
            // reach, so re-sending what they starred with every keystroke would
            // be sending the same rows to be filtered out again.
            'favourites' => $query === '' ? Quick::starred() : null,
        ]);
    }
}
