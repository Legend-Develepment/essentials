<?php

namespace LegendDevelopment\Theme\Http;

use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use LegendDevelopment\Theme\Support\Palette;
use LegendDevelopment\Theme\Support\Status\Pages;
use LegendDevelopment\Theme\Support\Status\Publish;
use LegendDevelopment\Theme\Support\Theme;

/**
 * The two pages this plugin serves to somebody who is not signed in.
 *
 * /status is the panel's own - the servers, the nodes and the monitors an
 * administrator chose. /status/<slug> is one person's, showing the servers they
 * own and nothing else.
 *
 * Both go through here because they are the same page with a different list
 * behind them, and because the one rule that matters is easier to keep in one
 * place than two: **nothing is rendered that was not put there on purpose.** An
 * empty list is a 404, not an empty page, in both cases.
 *
 * A 404 rather than a 403, deliberately. A 403 says "there is a page here and
 * you may not have it", which tells somebody scanning a host that this panel
 * runs this plugin with this feature switched off - and for a user slug it
 * would tell them which slugs exist. Nothing is gained by saying either.
 */
class StatusController
{
    /** The panel's own page. */
    public function __invoke(Request $request): View|JsonResponse
    {
        // abort() rather than a rendered error view: a status page that 500s
        // because the 404 template it named was not there would be its own
        // joke.
        abort_unless(Publish::enabled(), 404);

        return $this->answer($request, Publish::read(), (string) config('app.name', 'Status'));
    }

    /**
     * Somebody's own page.
     *
     * The slug is resolved through an index rather than by scanning every
     * user's file - see Status\Pages. A slug that is not in it, a page whose
     * owner has since gone, or a page with nothing on it are all the same
     * answer: 404. Telling them apart in public would be a way to ask this
     * panel which of its users exist.
     */
    public function user(Request $request, string $slug): View|JsonResponse
    {
        abort_unless(Pages::enabled(), 404);

        $userId = Pages::owner($slug);

        abort_if($userId === null, 404);

        $snapshot = Publish::read($userId);

        abort_if($snapshot['servers'] === [], 404);

        return $this->answer($request, $snapshot, $slug);
    }

    /**
     * The page, or the same thing as JSON.
     *
     * One route for both rather than a second one beside it. The page refreshes
     * itself every minute by asking its own address for JSON, which means the
     * data and the document cannot drift apart, the throttle covers both, and
     * there is no second endpoint to remember when the shape changes.
     *
     * @param  array<string, mixed>  $snapshot
     */
    private function answer(Request $request, array $snapshot, string $fallbackTitle): View|JsonResponse
    {
        if (!$request->wantsJson()) {
            return $this->draw($snapshot, $fallbackTitle);
        }

        /*
         * Exactly what is on the page and nothing more.
         *
         * Not the whole snapshot: a JSON endpoint invites being read by things
         * that are not this page, and anything in it is as public as the
         * rendered version. So it is built from the same three lists rather
         * than handed the array the builder happened to produce.
         */
        $at = (int) ($snapshot['at'] ?? time());
        $every = (int) ($snapshot['every'] ?? Publish::every());

        return response()->json([
            'at' => $at,
            'in' => Publish::due($at, $every),
            'every' => $every,
            'servers' => $snapshot['servers'] ?? [],
            'nodes' => $snapshot['nodes'] ?? [],
            'monitors' => $snapshot['monitors'] ?? [],
        ]);
    }

    /**
     * One page, whichever it is.
     *
     * @param  array<string, mixed>  $snapshot
     */
    private function draw(array $snapshot, string $fallbackTitle): View
    {
        $title = trim((string) ($snapshot['title'] ?? ''));

        /*
         * From the snapshot where there is one, and resolved fresh where there
         * is not.
         *
         * A snapshot written by an older release has no style in it, and a page
         * that fell back to nothing would be black text on black.
         */
        $style = is_array($snapshot['style'] ?? null)
            ? $snapshot['style']
            : Publish::style();

        // The page's own interval, for the countdown. From the snapshot, so a
        // page still showing an older build counts down to when that one is
        // actually due rather than to a number from the settings.
        $every = (int) ($snapshot['every'] ?? Publish::every());

        return view(Theme::id() . '::status', [
            'servers' => $snapshot['servers'] ?? [],
            'nodes' => $snapshot['nodes'] ?? [],
            'monitors' => $snapshot['monitors'] ?? [],
            'at' => (int) ($snapshot['at'] ?? time()),
            // How often the panel rebuilds, so the page can count down to it.
            // Telling somebody when the next check lands is the difference
            // between a page that looks stale and one that is obviously working.
            'every' => $every,
            'in' => Publish::due((int) ($snapshot['at'] ?? time()), $every),
            'title' => $title !== '' ? $title : $fallbackTitle,
            'note' => trim((string) ($snapshot['note'] ?? '')),

            /*
             * Whether to offer the way back in.
             *
             * A status page is linked from a forum or a Discord, and the people
             * reading it are players rather than administrators. So the link to
             * the panel is offered rather than assumed, and somebody who would
             * rather not advertise where their panel lives can leave it off.
             */
            'panelUrl' => (bool) Theme::config('status_link', true) ? url('/') : null,

            /*
             * The accent, and nothing else from the theme.
             *
             * This page does not load the panel's stylesheet. That file is
             * built by the panel's Vite and is the best part of a hundred
             * kilobytes of rules for components none of which are here - on a
             * page whose whole job is to answer one question quickly, for
             * somebody who may be on a phone on mobile data during an outage.
             *
             * sanitize() and not Palette::accent(). accent() answers with the
             * whole eleven-shade ramp Filament wants, as an array, and echoing
             * an array in Blade is a 500 - which is how this page shipped
             * broken once already, on the one route with no login in front of
             * it to soften the landing.
             *
             * The page's own style now, resolved by Publish::style() - one
             * place, so an administrator's page and somebody's own read an
             * empty accent the same way: follow the panel.
             */
            'accent' => $style['accent'],
            'mode' => $style['mode'],

            /*
             * The greys, derived from the style's surface rather than fixed.
             *
             * Palette::shift() is the same function the panel's own stylesheet
             * uses to build a raised and a sunken tone from one colour, so a
             * status page set to a style looks like the panel set to it -
             * rather than like a separate page that happens to share an accent.
             */
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
}
