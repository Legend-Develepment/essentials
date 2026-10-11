<?php

namespace LegendDevelopment\Theme\Filament\Actions;

use App\Filament\Server\Pages\Console;
use App\Models\Server;
use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Straight into a customer's own server, from wherever their name came up.
 *
 * An administrator dealing with somebody is on an order or on a ticket, and the
 * thing they need next is nearly always the server itself: is it running, what
 * does the console say, did the thing the customer is describing actually
 * happen. Pelican's own server list has this - `ViewConsoleAction` - and its own
 * server list is the one place an administrator working through the shop is not.
 * Getting there meant reading the server name off the order, opening the server
 * list, and searching for it.
 *
 * **Pelican's page and Pelican's permission.** The address is `Console::getUrl()`
 * rather than a path written out, so a panel that moves its server panel moves
 * this with it; and whether the row is offered at all is `canAccessTenant()`,
 * which is the same question Pelican asks before letting anybody in. Nothing
 * here decides who may look.
 *
 * **A new tab**, which is where this differs from Pelican's version. Theirs is
 * on the server list, where going in is the errand. This one is beside an
 * invoice or halfway down a conversation, and losing that place to look at a
 * console is losing the thing the console was for.
 */
class OpenServer
{
    /**
     * @param  callable(Model): ?Server  $of  The server on this row, or null.
     */
    public static function make(callable $of, string $name = 'ld_open_server'): Action
    {
        return Action::make($name)
            ->label(fn (): string => Theme::trans('shop.open_server'))
            ->icon('tabler-external-link')
            ->color('gray')
            ->openUrlInNewTab()
            ->url(static fn (Model $record): ?string => self::address($of($record)))
            /*
             * Hidden rather than shown and refused. A row with no server is an
             * order still waiting to be built or a ticket about something else,
             * and a button that is there and does nothing is a button somebody
             * presses twice before believing it.
             */
            ->visible(static function (Model $record) use ($of): bool {
                $server = $of($record);

                return $server instanceof Server
                    && self::address($server) !== null
                    && (bool) user()?->canAccessTenant($server);
            });
    }

    /**
     * The console's own address, or null when it cannot be had.
     *
     * Caught, because getUrl() reads the panel's registered routes and a panel
     * mid-install has none. A missing button is the right outcome there; an
     * exception on a table that draws forty rows is not.
     */
    private static function address(?Server $server): ?string
    {
        if (!$server instanceof Server) {
            return null;
        }

        try {
            return Console::getUrl(panel: 'server', tenant: $server);
        } catch (Throwable) {
            return null;
        }
    }
}
