<?php

namespace LegendDevelopment\Theme\Support;

use App\Models\Server;
use Filament\Facades\Filament;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Throwable;

/**
 * Whether every page inside a server carries the controls bar, and where it is
 * put.
 *
 * The component itself is Livewire\ServerControls; this is the setting, the
 * decision about which pages get it, and the one render hook that puts it
 * there.
 *
 * PAGE_START rather than the topbar: it is the hook Pelican itself renders a
 * Livewire component into, so it is known to work in this panel, and it is
 * above the page's own heading on every page including the ones whose header
 * has no actions of its own. It also survives the theme's own layouts - a
 * hidden topbar or a folded sidebar moves the shell, not the page.
 */
class ServerControls
{
    public const FULL = 'full';

    public const POWER = 'power';

    public const CONSOLE = 'console';

    public const OFF = 'off';

    private const MODES = [self::FULL, self::POWER, self::CONSOLE, self::OFF];

    /**
     * Livewire needs a name it can resolve on the way back in, and a class in a
     * plugin's namespace is not one it would find on its own.
     */
    public const COMPONENT = 'legend-theme-server-controls';

    public static function mode(): string
    {
        return self::sanitise(Theme::config('server_controls', self::FULL));
    }

    public static function sanitise(mixed $value): string
    {
        $value = is_scalar($value) ? (string) $value : '';

        return in_array($value, self::MODES, true) ? $value : self::FULL;
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        $options = [];

        foreach (self::MODES as $mode) {
            $options[$mode] = Theme::trans('settings.controls.mode_' . $mode);
        }

        return $options;
    }

    /**
     * The mark on the console page's address that says "a window with nothing
     * in it but the console".
     */
    public const BARE = 'ld';

    public const BARE_VALUE = 'console';

    /**
     * A console page stripped to the console.
     *
     * Emitted server side rather than stamped by a script, so the window opens
     * as what it is instead of showing a whole panel for a frame and then
     * throwing most of it away.
     *
     * Everything hidden here is hidden by selector, and every one of those
     * selectors is already relied on elsewhere in the stylesheet. If a future
     * Filament renames one, the window shows more than it should - which is a
     * window that still works.
     */
    public static function bareCss(): string
    {
        try {
            if (request()->query(self::BARE) !== self::BARE_VALUE) {
                return '';
            }
        } catch (Throwable) {
            return '';
        }

        return
            // The shell. Nothing here has anywhere to go in a window that holds
            // one thing.
            '.fi-sidebar,.fi-topbar,.fi-header,.fi-sidebar-close-overlay,'
            . 'body > footer,.fi-main-ctn > footer{display:none!important;}'

            // What is left gets the whole window.
            . '.fi-main{max-width:none!important;padding:0.5rem!important;}'
            . '.fi-main-ctn{padding:0!important;margin:0!important;}'
            . '.fi-page,.fi-console-page{gap:0.5rem!important;}'

            // Of the widgets on the page, the one holding the terminal. The
            // others are the overview blocks and the three graphs, which are
            // the page's job and not this window's.
            . '.fi-wi > *:not(:has(#terminal)){display:none!important;}'

            // The terminal takes the height rather than its thirty rows.
            . '#terminal{height:calc(100dvh - 4.5rem)!important;}';
    }

    public static function register(): void
    {
        if (self::mode() === self::OFF) {
            return;
        }

        try {
            \Livewire\Livewire::component(self::COMPONENT, \LegendDevelopment\Theme\Livewire\ServerControls::class);

            FilamentView::registerRenderHook(
                PanelsRenderHook::PAGE_START,
                fn () => new HtmlString(self::render()),
            );
        } catch (Throwable) {
            // Livewire or the render hook API is not where it was. The panel
            // keeps working; it simply has no bar.
        }
    }

    /**
     * The bar, but only where it belongs: inside a server, and not on the page
     * that already has these buttons.
     */
    private static function render(): string
    {
        try {
            // The tenant is a Server in the server panel and nothing at all in
            // the other two, which is the whole test - no panel id needed.
            $server = Filament::getTenant();

            if (!$server instanceof Server || self::onConsole($server)) {
                return '';
            }

            $id = (int) $server->id;

            return Blade::render(sprintf(
                '@livewire("%s", ["serverId" => %d], "%s")',
                self::COMPONENT,
                $id,
                self::COMPONENT . '-' . $id,
            ));
        } catch (Throwable) {
            return '';
        }
    }

    /**
     * Pelican's console page carries its own power buttons, in its header,
     * talking over the websocket it is the only page to hold open. A second set
     * beside them would be two buttons doing the same thing by two different
     * routes.
     */
    private static function onConsole(Server $server): bool
    {
        $here = self::path(url()->current());

        // The page's own slug, whatever Filament made of it, and the plain
        // ending as a second net - a bar that turns up beside Pelican's own
        // power buttons is worse than one missing from a page it could be on.
        if (str_ends_with($here, '/console')) {
            return true;
        }

        try {
            $console = \App\Filament\Server\Pages\Console::getUrl(panel: 'server', tenant: $server);

            return self::path($console) === $here;
        } catch (Throwable) {
            return false;
        }
    }

    private static function path(string $url): string
    {
        return rtrim((string) (parse_url($url, PHP_URL_PATH) ?: '/'), '/');
    }
}
