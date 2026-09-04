<?php

namespace LegendDevelopment\Theme\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use LegendDevelopment\Theme\Support\Favourites as Store;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Quick;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Everything one person has starred, on one page.
 *
 * The switcher in the top bar is for going somewhere. This is for seeing what
 * you have - which is a different question, and the one that gets asked when a
 * list has grown past the point where a dropdown is a good way to look at it.
 * It is also where things get taken off the list, because a dropdown you have
 * to open in order to un-star something in is an awkward place to tidy up.
 *
 * Its own namespace rather than Admin\Pages or App\Pages, because it is
 * registered in both. Nothing about it is particular to either: it lists what
 * this person starred, and where those things live is their business rather
 * than the page's.
 *
 * No permission. It shows one person their own list of shortcuts to places they
 * can already reach - there is nothing here to grant, and gating it would take
 * the list away from exactly the ordinary users it is for. That is the same
 * mistake the star on the server cards made for two releases.
 */
class Favourites extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'tabler-star';

    protected static ?string $slug = Quick::SLUG;

    /**
     * Near the bottom, above Appearance.
     *
     * It is a page people arrive at from the top bar rather than from the
     * sidebar, so it does not need to be high - but it is not a settings page
     * either, and burying it entirely would make "where did my favourites go"
     * a question with no answer for somebody who has never opened the switcher.
     */
    protected static ?int $navigationSort = 89;

    /** @var array<int, array{id: string, name: string}> */
    public array $servers = [];

    /** @var array<int, array{path: string, label: string}> */
    public array $pages = [];

    public static function canAccess(): bool
    {
        try {
            return Features::maySee(Features::QUICK) && user() !== null;
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('quick.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('quick.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('quick.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return null;
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.favourites';
    }

    public function mount(): void
    {
        $this->load();
    }

    /**
     * Both lists, with the servers given their names back.
     *
     * Quick::starred() is asked rather than Favourites::for(), because a stored
     * id is not something to put on a page: it drops a starred server that has
     * since been deleted rather than drawing a row that reads `a1b2c3d4` and
     * answers a click with a 404.
     */
    public function load(): void
    {
        $starred = Quick::starred();

        $this->servers = $starred['servers'];
        $this->pages = $starred['pages'];
    }

    /** Where a starred server lives, built the same way the switcher builds it. */
    public function serverUrl(string $id): string
    {
        return rtrim(url('/server'), '/') . '/' . $id;
    }

    /**
     * Take one server off the list.
     *
     * A whole-list write, like everywhere else this is touched: there is no
     * merge to get wrong, and what is drawn afterwards comes from what was
     * stored rather than from what was asked for.
     */
    public function forgetServer(string $id): void
    {
        Store::put(array_values(array_filter(
            Store::for(),
            static fn (string $held): bool => $held !== $id,
        )));

        $this->load();
    }

    public function forgetPage(string $path): void
    {
        Store::putPages(array_values(array_filter(
            Store::pages(),
            static fn (array $page): bool => $page['path'] !== $path,
        )));

        $this->load();
    }
}
