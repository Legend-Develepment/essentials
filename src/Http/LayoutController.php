<?php

namespace LegendDevelopment\Theme\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use LegendDevelopment\Theme\Support\Layouts;
use LegendDevelopment\Theme\Support\Theme;

/**
 * Saves what the page arranger produced.
 *
 * A controller rather than a closure route on purpose: closures cannot be
 * serialised, so a panel that runs `route:cache` would refuse to cache at all.
 */
class LayoutController
{
    public function __invoke(Request $request): JsonResponse
    {
        // Both halves are checked here as well as when the button is rendered:
        // switching the arranger off has to close the endpoint too, not just
        // hide its button.
        abort_unless(Theme::canArrange(), 403);

        $validated = $request->validate([
            'page' => ['required', 'string', 'max:255'],
            'scope' => ['nullable', 'string', 'in:' . Layouts::SHARED . ',' . Layouts::OWN],
            'items' => ['array', 'max:' . Layouts::MAX_ITEMS],
            'items.*.o' => ['nullable', 'integer', 'min:1', 'max:999'],
            'items.*.h' => ['nullable', 'boolean'],
        ]);

        $scope = $validated['scope'] ?? Layouts::OWN;

        /*
         * Saving your own needs only the arranger; saving the one everyone
         * starts from needs the permission. Checked here rather than trusted
         * from the request - the scope arrives from the browser, and a person
         * allowed to arrange their own page must not be able to arrange
         * everybody's by editing a field.
         */
        abort_if($scope === Layouts::SHARED && !Theme::canArrangeForEveryone(), 403);

        Layouts::save($validated['page'], $validated['items'] ?? [], $scope);

        return response()->json(['saved' => true, 'scope' => $scope]);
    }
}
