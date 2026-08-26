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
            'items' => ['array', 'max:' . Layouts::MAX_ITEMS],
            'items.*.o' => ['nullable', 'integer', 'min:1', 'max:999'],
            'items.*.h' => ['nullable', 'boolean'],
        ]);

        Layouts::save($validated['page'], $validated['items'] ?? []);

        return response()->json(['saved' => true]);
    }
}
