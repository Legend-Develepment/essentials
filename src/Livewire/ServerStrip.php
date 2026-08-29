<?php

namespace LegendDevelopment\Theme\Livewire;

use App\Models\Server;
use Illuminate\Contracts\View\View;
use LegendDevelopment\Theme\Support\Theme;

/**
 * The band across the top of the console opened as a window of its own.
 *
 * The state, the server's name and the power buttons - the same reading as the
 * pop-out's header, from the same partial.
 *
 * A class of its own for one reason: it must not be lazy. A lazy component is
 * fetched after the page has painted, and everything that has ever arrived
 * above that terminal has moved it - a moved terminal is re-fitted, and a
 * re-fit empties it. Three releases went that way. PHP attributes are not
 * inherited, so extending the bar and leaving #[Lazy] off is all it takes to
 * be part of the first response instead.
 *
 * Everything else - reading the status, checking the permissions, sending the
 * power action - is the bar's, unchanged, so the two cannot drift apart.
 */
class ServerStrip extends ServerControls
{
    public function render(): View
    {
        $server = $this->server();

        if (!$server instanceof Server) {
            return $this->blank();
        }

        $status = $this->status($server);

        /*
         * The power buttons whatever the mode says about them: this window has
         * no sidebar, no page header and no way back, so there is nowhere else
         * to start or stop the server from. Turning the controls off entirely
         * still turns it off, because then nothing renders this at all.
         *
         * No console button either - this is the console.
         */
        $buttons = $this->buttons($server, $status);

        if ($buttons === [] && $status === null) {
            return $this->blank();
        }

        return view(Theme::id() . '::livewire.server-strip', [
            'buttons' => $buttons,
            'status' => $status,
            'serverName' => $server->name,
            // The console's own socket is in this very document, so a state
            // change arrives on the console-status event the bar already
            // listens for. The timer is the fallback for what it misses.
            'poll' => $buttons !== [],
        ]);
    }
}
