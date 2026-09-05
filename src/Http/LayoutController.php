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
            // 'shared', 'me', or 'role:7'. A regex rather than in:, because
            // the third one carries an id - which is checked again below
            // against the roles that actually exist.
            'scope' => ['nullable', 'string', 'max:32', 'regex:/^(' . Layouts::SHARED . '|' . Layouts::OWN . '|' . Layouts::ROLE . ':[1-9][0-9]{0,9})$/'],
            'items' => ['array', 'max:' . Layouts::MAX_ITEMS],
            'items.*.o' => ['nullable', 'integer', 'min:1', 'max:999'],
            'items.*.h' => ['nullable', 'boolean'],
        ]);

        $scope = $validated['scope'] ?? Layouts::OWN;
        $roleId = Layouts::roleOf($scope);

        /*
         * Saving your own needs only the arranger; saving one that other people
         * get - everyone's, or a role's - needs the permission. Checked here
         * rather than trusted from the request: the scope arrives from the
         * browser, and a person allowed to arrange their own page must not be
         * able to arrange everybody's by editing a field.
         */
        abort_if(
            ($scope === Layouts::SHARED || $roleId !== null) && !Theme::canArrangeForEveryone(),
            403,
        );

        /*
         * And the role has to be one. Without this the endpoint would write a
         * file per number somebody sent, which is a way to fill a disk one
         * request at a time.
         */
        abort_if($roleId !== null && !array_key_exists($roleId, Layouts::roleOptions()), 404);

        Layouts::save($validated['page'], $validated['items'] ?? [], $scope);

        return response()->json(['saved' => true, 'scope' => $scope]);
    }
}
