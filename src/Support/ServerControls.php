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

    public const CONSOLE = 'console';

    public const OFF = 'off';

    private const MODES = [self::FULL, self::CONSOLE, self::OFF];

    /**
     * Power buttons on their own used to be a mode of its own, back when these
     * were a row across the page. There is no row any more - the buttons live
     * in the console the floating button opens - so a saved 'power' is read as
     * 'full' rather than as nothing at all.
     */
    private const LEGACY_MODES = ['power' => self::FULL];

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
        $value = self::LEGACY_MODES[$value] ?? $value;

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

    /** Where the floating button sits: against the top, the right or the bottom. */
    private const POSITIONS = ['top', 'right', 'bottom'];

    /** Whether it wears its name or only its icon. */
    private const LABELS = ['text', 'icon'];

    public static function position(): string
    {
        return self::oneOf(Theme::config('server_controls_position', 'right'), self::POSITIONS, 'right');
    }

    public static function label(): string
    {
        return self::oneOf(Theme::config('server_controls_label', 'text'), self::LABELS, 'text');
    }

    public static function sanitisePosition(mixed $value): string
    {
        return self::oneOf($value, self::POSITIONS, 'right');
    }

    public static function sanitiseLabel(mixed $value): string
    {
        return self::oneOf($value, self::LABELS, 'text');
    }

    /**
     * @return array<string, string>
     */
    public static function labelOptions(): array
    {
        $options = [];

        foreach (self::LABELS as $label) {
            $options[$label] = Theme::trans('settings.controls.label_' . $label);
        }

        return $options;
    }

    /**
     * @return array<string, string>
     */
    public static function positionOptions(): array
    {
        $options = [];

        foreach (self::POSITIONS as $position) {
            $options[$position] = Theme::trans('settings.controls.position_' . $position);
        }

        return $options;
    }

    /**
     * @param  array<int, string>  $allowed
     */
    private static function oneOf(mixed $value, array $allowed, string $fallback): string
    {
        $value = is_scalar($value) ? (string) $value : '';

        return in_array($value, $allowed, true) ? $value : $fallback;
    }

    /**
     * The mark on the console page's address that says "a window with nothing
     * in it but the console".
     */
    public const BARE = 'ld';

    public const BARE_VALUE = 'console';

    /**
     * Whether this request is the console opened as a window of its own.
     */
    public static function isBare(): bool
    {
        try {
            return request()->query(self::BARE) === self::BARE_VALUE;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * A console page stripped to the console.
     *
     * Every rule here moves or hides markup Pelican already sent in the first
     * response. Nothing is added, and nothing of the theme's own is put on this
     * page - see render(), which explains at what cost that was learned.
     */
    public static function bareCss(): string
    {
        if (!self::isBare()) {
            return '';
        }

        return
            /*
             * The shell, and the theme's own controls with it. Nothing here has
             * anywhere to go in a window that holds one thing.
             */
            '.fi-sidebar,.fi-topbar,.fi-sidebar-close-overlay,.ld-controls,'
            . 'body > footer,.fi-main-ctn > footer{display:none!important;}'

            // What is left gets the whole window.
            . '.fi-main{max-width:none!important;padding:0.5rem!important;}'
            . '.fi-main-ctn{padding:0!important;margin:0!important;}'
            . '.fi-page,.fi-console-page{gap:0.4rem!important;}'

            /*
             * Pelican's page header holds start, restart and stop, so it stays
             * - in the flow, where it was. It was pinned over the row below it
             * for one release, and pinning one row over another is how they end
             * up on top of each other. Only its title goes.
             */
            . '.fi-header-heading,.fi-header-subheading{display:none!important;}'
            . '.fi-header{padding:0!important;margin:0!important;'
            . 'min-height:0!important;}'

            // The three graphs are the page's job, not this window's.
            . '.fi-wi-chart,.fi-wi > *:has(.fi-wi-chart){display:none!important;}'

            /*
             * The blocks stay, all six, and are tightened rather than thinned
             * out. Picking some of them out by position has now been tried
             * twice and matched nothing both times, which is how all six ended
             * up under the buttons in the first place.
             */
            . '.fi-small-stat-block{padding:0.5rem 0.7rem!important;}'

            /*
             * And the terminal keeps whatever height xterm gave it, from the
             * rows each person set under Account. Forcing one here means
             * guessing how tall the blocks wrapped to at three widths, and a
             * guess that is short leaves a gap while a guess that is tall
             * leaves the command box off screen. The window scrolls instead.
             */
            . '';
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

            if (!$server instanceof Server) {
                return '';
            }

            $id = (int) $server->id;

            /*
             * Never on a console page, the one opened as a window of its own
             * included.
             *
             * Four attempts now, and every one of them emptied that terminal:
             * in the flow, out of the flow, with the space reserved, and
             * finally not lazy at all - which was the last theory I had and
             * was wrong too. Whatever this component does to that page, it is
             * not the timing, and I am not shipping a fifth guess into a
             * window that has to work.
             *
             * Its controls come from markup Pelican already sent instead. See
             * bareCss().
             */
            if (self::onConsole($server)) {
                return '';
            }

            return self::consoleAssets() . Blade::render(sprintf(
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
     * The console's own script and stylesheet, on the page that offers to open
     * one.
     *
     * resources/js/console.js is what assigns window.Xterm, and Pelican asks
     * for it from inside the console widget, wrapped in @assets. On the console
     * page that is in the first response, so it has loaded long before the
     * widget's script reads it. In the pop-out the widget arrives through a
     * Livewire response instead, and the script that does
     *
     *     const { Terminal, ... } = window.Xterm;
     *
     * runs against a module that may still be on its way. When it loses that
     * race there is no terminal and no socket - and what is left on screen is
     * the command box under an empty box, which is exactly the report.
     *
     * It also explains why it used to work: anyone who had opened the console
     * page first already had the bundle, and a Livewire navigation keeps it.
     *
     * Asking for the same two files here costs one cached request and takes the
     * race away.
     */
    private static function consoleAssets(): string
    {
        // Every mode that renders anything at all can open a console now, and
        // the one that cannot - off - never reaches this.
        try {
            return Blade::render(
                "@vite(['resources/js/console.js', 'resources/css/console.css'])",
            );
        } catch (Throwable) {
            // Assets are not built. The console page is in the same state, so
            // this is not the thing to take the panel down over.
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
        $console = null;

        try {
            $console = self::path(
                \App\Filament\Server\Pages\Console::getUrl(panel: 'server', tenant: $server),
            );
        } catch (Throwable) {
            // The page's own slug could not be had; the plain ending below is
            // then the only test, which is why there are two of them.
        }

        foreach (self::addresses() as $address) {
            $path = self::path($address);

            if (str_ends_with($path, '/console') || ($console !== null && $path === $console)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Which addresses this render might belong to.
     *
     * A render hook does not only run while the page is being built. Filament
     * emits it again inside every Livewire response for that page - and the
     * console page produces one about a second in, when the node's first stats
     * frame arrives. On those the request is /livewire/update, so a test
     * against the current url says "not the console page" and the bar is
     * injected into the one page it must never appear on. The referer is what
     * that request actually came from.
     *
     * @return array<int, string>
     */
    private static function addresses(): array
    {
        $addresses = [];

        try {
            $addresses[] = url()->current();

            /*
             * The referer, but only on a Livewire round trip.
             *
             * On one of those it is the page the request came from, which is
             * the page being rendered - the whole point. On an ordinary page
             * load it is the page you came *from*, and treating that as where
             * you are hides the bar on every page you happen to reach from the
             * console. Which is what it did.
             */
            $request = request();

            if (!$request->headers->has('x-livewire')) {
                return $addresses;
            }

            $referer = $request->headers->get('referer');

            if (is_string($referer) && $referer !== '') {
                $addresses[] = $referer;
            }
        } catch (Throwable) {
            // No request to read. Nothing is rendered from a console page then
            // either.
        }

        return $addresses;
    }

    private static function path(string $url): string
    {
        return rtrim((string) (parse_url($url, PHP_URL_PATH) ?: '/'), '/');
    }
}
