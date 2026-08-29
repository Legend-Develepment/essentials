<?php

namespace LegendDevelopment\Theme\Http;

use Closure;
use Illuminate\Http\Request;
use LegendDevelopment\Theme\Support\ServerControls;

/**
 * Lets the panel put its own console page inside its own pop-out.
 *
 * Pelican sends X-Frame-Options: DENY on everything, which is the right
 * default - it is what stops another site putting the panel in a frame and
 * collecting clicks meant for it. This narrows that to SAMEORIGIN, and only on
 * the one address that is a console stripped to the console: the mark the
 * pop-out puts on it, on a page that is already this panel's own.
 *
 * SAMEORIGIN and not more. Another site framing the panel is still refused by
 * the browser; the only thing now allowed is the panel framing itself.
 */
class FrameSameOrigin
{
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);

        if ($request->query(ServerControls::BARE) !== ServerControls::BARE_VALUE) {
            return $response;
        }

        // Set rather than added: Pelican's own header middleware skips a header
        // that is already there, and this one runs inside it.
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        return $response;
    }
}
