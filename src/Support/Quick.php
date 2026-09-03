<?php

namespace LegendDevelopment\Theme\Support;

use App\Models\Server;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

/**
 * One control in the top bar: where you are going next.
 *
 * It answers two questions people ask constantly and the panel answers slowly.
 * *Which server?* - today that means going back to the server list, waiting for
 * it to draw, finding the card and clicking it, from wherever you happen to be.
 * And *where were those settings?* - which means remembering which of eleven
 * pages under Essentials holds the thing you want.
 *
 * Both are the same gesture, so they are one control rather than two buttons
 * crowding a bar that is already carrying a logo, a bell and an avatar. It
 * opens onto what you starred, with a search box focused and waiting: your
 * favourite servers first, then your starred pages, then anything the search
 * finds.
 *
 * Three decisions worth keeping.
 *
 * **The server list is searched on the panel, not in the browser.** Handing the
 * whole list over would be simpler and it would quietly break for exactly the
 * people who need this most: an administrator with viewAny sees every server on
 * every node they can reach, which on a real panel is thousands. A list capped
 * at five hundred with a browser-side filter looks like it works and cannot
 * find server 501 - and never says so. Asking the panel means the answer is
 * right at any size.
 *
 * **Nothing is fetched until it is opened.** The first response carries an
 * address, a token and some words. A person who never opens this pays for
 * nothing, on every page of the panel.
 *
 * **A starred page stores its own name.** There is no way to work out what
 * /admin/essentials-languages is called from the path alone - not in the
 * reader's language, and not at all from a request in a different panel. So the
 * browser sends the heading it can see, and Favourites keeps it.
 */
class Quick
{
    /**
     * How many servers one search answers with.
     *
     * Enough that the thing you meant is nearly always in it, few enough that
     * the list stays a list. Typing one more letter is the intended way to get
     * past it, and the answer says when it has been reached rather than
     * pretending the list is complete.
     */
    public const LIMIT = 25;

    /** The slug the Favourites page is registered under, in both panels. */
    public const SLUG = 'favourites';

    /**
     * The markup, put into the top bar by a render hook.
     *
     * Static, and in the first response. The script that drives it is loaded
     * with the rest of them; if it never arrives, this is a button that opens a
     * box with a search field in it and nothing to search - visibly inert
     * rather than invisibly missing.
     */
    public static function html(): string
    {
        if (!Features::maySee(Features::QUICK)) {
            return '';
        }

        $open = e(Theme::trans('quick.open'));
        $search = e(Theme::trans('quick.search'));
        $label = e(Theme::trans('quick.label'));
        $star = e(Theme::trans('quick.star_page'));
        $all = e(Theme::trans('quick.all'));
        $loading = e(Theme::trans('quick.loading'));

        return '<div class="ld-quick" data-ld-quick>'
            . '<button type="button" class="ld-quick__btn" aria-haspopup="dialog" aria-expanded="false"'
            . ' title="' . $open . '" aria-label="' . $open . '">'
            . self::icon()
            . '<span class="ld-quick__btn-text">' . $label . '</span>'
            . '</button>'
            . '<div class="ld-quick__pop" role="dialog" aria-label="' . $open . '" hidden>'
            . '<input type="search" class="ld-quick__input" placeholder="' . $search . '"'
            . ' aria-label="' . $search . '" autocomplete="off" spellcheck="false">'
            . '<div class="ld-quick__list" role="listbox" tabindex="-1">'
            . '<p class="ld-quick__note">' . $loading . '</p>'
            . '</div>'
            . '<div class="ld-quick__foot">'
            . '<button type="button" class="ld-quick__star" aria-pressed="false">' . $star . '</button>'
            . '<a class="ld-quick__all" href="' . e(self::pageUrl()) . '">' . $all . '</a>'
            . '</div>'
            . '</div>'
            . '</div>';
    }

    /**
     * What the script needs to start, and no more.
     *
     * @return array<string, mixed>
     */
    public static function bootstrap(): array
    {
        return [
            'ask' => url('/legend-theme/quick'),
            'save' => url('/legend-theme/favourites'),
            'token' => csrf_token(),
            'page' => self::pageUrl(),

            /*
             * Where a server lives, said rather than assumed.
             *
             * The browser would otherwise build it from its own origin, which
             * is right until Pelican is served from a subdirectory - and then
             * every row in this list is a 404 for the people whose setup is
             * least standard and who would have the hardest time telling why.
             */
            'serverBase' => rtrim(url('/server'), '/'),

            'servers' => Theme::trans('quick.servers'),
            'pages' => Theme::trans('quick.pages'),
            'favourites' => Theme::trans('quick.favourites'),
            'empty' => Theme::trans('quick.empty'),
            'more' => Theme::trans('quick.more'),
            'failed' => Theme::trans('quick.failed'),
            'starPage' => Theme::trans('quick.star_page'),
            'unstarPage' => Theme::trans('quick.unstar_page'),
            'loading' => Theme::trans('quick.loading'),
        ];
    }

    /**
     * Where the Favourites page lives, from wherever this is being drawn.
     *
     * The page is registered in the admin and client panels. Inside a server
     * there is a third panel with a tenant in its address and no such page, so
     * from there this points at the client panel's copy - the same reasoning,
     * and the same construction, as the user-menu row for Appearance.
     */
    public static function pageUrl(): string
    {
        try {
            $panel = Filament::getCurrentPanel();
            $id = $panel?->getId();

            $base = ($panel !== null && in_array($id, ['admin', 'app'], true))
                ? $panel->getUrl()
                : Filament::getPanel('app')->getUrl();

            return rtrim((string) $base, '/') . '/' . self::SLUG;
        } catch (Throwable) {
            return url('/' . self::SLUG);
        }
    }

    /**
     * Servers this person may open, narrowed by what they typed.
     *
     * accessibleServers() is Pelican's own answer to "whose servers are these",
     * including the node-scoped rights an administrator has, so this asks it
     * rather than deciding for itself who may see what.
     *
     * @return array{servers: array<int, array{id: string, name: string}>, more: bool}
     */
    public static function search(string $query = ''): array
    {
        try {
            $builder = user()?->accessibleServers();

            if ($builder === null) {
                return ['servers' => [], 'more' => false];
            }

            $query = trim($query);

            if ($query !== '') {
                /*
                 * Escaped by hand, because these are going into a LIKE and not
                 * into an equality: a name with a per cent sign in it would
                 * otherwise match everything, and one with an underscore would
                 * match one character of anything. The bindings still go
                 * through the query builder - this is about the pattern, not
                 * about injection.
                 */
                $like = '%' . str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $query) . '%';

                $builder->where(function (Builder $inner) use ($like): void {
                    $inner->where('servers.name', 'like', $like)
                        ->orWhere('servers.uuid_short', 'like', $like);
                });
            }

            // One more than asked for, which is how "there are others" is known
            // without counting the whole table.
            $rows = $builder->orderBy('servers.name')->limit(self::LIMIT + 1)->get();
            $more = $rows->count() > self::LIMIT;

            return [
                'servers' => $rows->take(self::LIMIT)
                    ->map(static fn (Server $server): array => [
                        'id' => (string) $server->uuid_short,
                        'name' => (string) $server->name,
                    ])
                    ->values()
                    ->all(),
                'more' => $more,
            ];
        } catch (Throwable) {
            // A search that cannot run is an empty list, not a broken top bar.
            return ['servers' => [], 'more' => false];
        }
    }

    /**
     * The starred things, with the servers given their names back.
     *
     * A starred server that has since been deleted resolves to nothing and is
     * dropped. It is not put back in the list as an id, because a row that
     * says `a1b2c3d4` and 404s when clicked is worse than a row that is gone.
     *
     * @return array{servers: array<int, array{id: string, name: string}>, pages: array<int, array{path: string, label: string}>}
     */
    public static function starred(): array
    {
        $ids = Favourites::for();
        $servers = [];

        if ($ids !== []) {
            try {
                $found = user()?->accessibleServers()
                    ->whereIn('servers.uuid_short', $ids)
                    ->get()
                    ->keyBy('uuid_short');

                // In the order they were starred rather than the order the
                // database happened to answer in: the list is the person's, and
                // it should not reshuffle itself between page loads.
                foreach ($ids as $id) {
                    $server = $found?->get($id);

                    if ($server !== null) {
                        $servers[] = ['id' => $id, 'name' => (string) $server->name];
                    }
                }
            } catch (Throwable) {
                $servers = [];
            }
        }

        return ['servers' => $servers, 'pages' => array_values(Favourites::pages())];
    }

    /** A grid of squares - the panel's own shorthand for "somewhere to go". */
    private static function icon(): string
    {
        return '<svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true" fill="none"'
            . ' stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">'
            . '<rect x="4" y="4" width="6" height="6" rx="1.5"/>'
            . '<rect x="14" y="4" width="6" height="6" rx="1.5"/>'
            . '<rect x="4" y="14" width="6" height="6" rx="1.5"/>'
            . '<rect x="14" y="14" width="6" height="6" rx="1.5"/>'
            . '</svg>';
    }
}
