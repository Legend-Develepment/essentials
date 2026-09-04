<?php

namespace LegendDevelopment\Theme\Http;

use Illuminate\Contracts\View\View;
use LegendDevelopment\Theme\Support\Palette;
use LegendDevelopment\Theme\Support\Status\Publish;
use LegendDevelopment\Theme\Support\Theme;

/**
 * The one page this plugin serves to somebody who is not signed in.
 *
 * Which is why it is written more carefully than the rest. It has no session to
 * ask, no permission to check and no idea who is reading, so everything it can
 * say has to have been decided by an administrator in advance - see
 * Status\Publish, which does the deciding.
 *
 * A 404 when the feature is off rather than a 403, deliberately. A 403 says
 * "there is a page here and you may not have it", which tells somebody scanning
 * a host that this panel runs this plugin with this feature switched off.
 * Nothing is gained by saying so.
 */
class StatusController
{
    public function __invoke(): View
    {
        // abort() rather than a rendered error view: a status page that 500s
        // because the 404 template it named was not there would be its own
        // joke.
        abort_unless(Publish::enabled(), 404);

        $snapshot = Publish::read();
        $title = trim((string) Theme::config('status_title', ''));

        return view(Theme::id() . '::status', [
            'servers' => $snapshot['servers'],
            'at' => $snapshot['at'],
            'title' => $title !== '' ? $title : (string) config('app.name', 'Status'),
            'note' => trim((string) Theme::config('status_note', '')),

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
             * One colour carried over is enough for it to look like yours.
             */
            'accent' => Palette::accent(),
        ]);
    }
}
