<?php

namespace LegendDevelopment\Theme\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Tickets\Board;
use LegendDevelopment\Theme\Support\Tickets\Files;
use LegendDevelopment\Theme\Support\Tickets\Hook;
use Throwable;

/**
 * The one address Modora posts to.
 *
 * Thin on purpose: everything it does is in Hook, which is where the caution
 * about what a stranger's POST may and may not do is written down. This decides
 * two things and no more - whether the feature is on at all, and what status to
 * answer with.
 *
 * **It answers 200 for anything it understood**, including a delivery it could
 * do nothing with. A provider that gets an error retries, and a retry loop over
 * an event this panel was never going to act on is somebody else's server
 * hammering this one for a week. A wrong address gets 404, which is the honest
 * answer and gives a guesser nothing to work from.
 */
class TicketController
{
    public function hook(Request $request, string $secret): JsonResponse
    {
        try {
            if (!Features::enabled(Features::TICKETS) || !Board::ready()) {
                return response()->json(['ok' => false], 404);
            }

            $took = Hook::take($request, $secret);
        } catch (Throwable $exception) {
            report($exception);

            /*
             * Five hundred, and this is the one case where a retry is welcome:
             * something here broke rather than something about the delivery,
             * so the same delivery arriving again may well work.
             */
            return response()->json(['ok' => false], 500);
        }

        if (!$took['ok']) {
            // A bad address and a body too big are both "there is nothing at
            // this address", said the same way. Telling them apart out loud
            // would tell a guesser which half they got right.
            return response()->json(['ok' => false], 404);
        }

        return response()->json(['ok' => true, 'did' => $took['did']]);
    }

    /**
     * A picture somebody attached to a ticket.
     *
     * Answered as the type this panel decided it was when it was stored, never
     * as anything a request claims, and with nosniff so a browser cannot decide
     * differently either. Those two together are what keep an upload box from
     * becoming somebody else's script running on this panel's own address.
     *
     * `inline`, because it is meant to be looked at. Cached hard: the name is
     * random and the bytes behind a given one never change, so there is nothing
     * a stale copy can be wrong about.
     */
    public function file(string $token): Response
    {
        try {
            if (!Features::enabled(Features::TICKETS) || !Board::ready()) {
                abort(404);
            }

            $found = Files::read($token);
        } catch (Throwable $exception) {
            report($exception);

            abort(404);
        }

        if ($found === null) {
            abort(404);
        }

        /*
         * A picture is shown; everything else is saved.
         *
         * Files decides which, from an ending it controls itself - anything
         * that did not open as a picture had a picture's ending taken off it
         * on the way in. So there is no list to keep in step here, and nothing
         * a name can talk this route into.
         *
         * nosniff matters most on the second branch: without it a browser is
         * free to decide for itself that the bytes look like html, and serve
         * somebody else's page from this panel's own address.
         */
        return response($found['body'], 200, [
            'Content-Type' => $found['type'],
            'Content-Disposition' => ($found['inline'] ? 'inline' : 'attachment')
                . '; filename="' . $found['name'] . '"',
            'X-Content-Type-Options' => 'nosniff',
            'Cache-Control' => 'private, max-age=31536000, immutable',
        ]);
    }
}
