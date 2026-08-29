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
     * How the controls sit on the page.
     *
     * 'bar' is a row above the page's own heading, with the state, the console
     * and the power buttons in it.
     *
     * 'floating' leaves one button on the page and nothing else. Everything the
     * bar carried - the state, start, restart, stop - moves into the pop-out
     * that button opens, which is where it was going to be looked at anyway.
     */
    public const BAR = 'bar';

    public const FLOATING = 'floating';

    private const STYLES = [self::BAR, self::FLOATING];

    /** Where the floating button sits: against the top, the right or the bottom. */
    private const POSITIONS = ['top', 'right', 'bottom'];

    public static function style(): string
    {
        // Nothing to float when the console button is not among the things
        // being shown.
        if (self::mode() === self::POWER) {
            return self::BAR;
        }

        return self::oneOf(Theme::config('server_controls_style', self::BAR), self::STYLES, self::BAR);
    }

    public static function position(): string
    {
        return self::oneOf(Theme::config('server_controls_position', 'right'), self::POSITIONS, 'right');
    }

    public static function sanitiseStyle(mixed $value): string
    {
        return self::oneOf($value, self::STYLES, self::BAR);
    }

    public static function sanitisePosition(mixed $value): string
    {
        return self::oneOf($value, self::POSITIONS, 'right');
    }

    /**
     * @return array<string, string>
     */
    public static function styleOptions(): array
    {
        $options = [];

        foreach (self::STYLES as $style) {
            $options[$style] = Theme::trans('settings.controls.style_' . $style);
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

    public static function bareCss(): string
    {
        if (!self::isBare()) {
            return '';
        }

        return
            // The shell. Nothing here has anywhere to go in a window that holds
            // one thing - Pelican's page header included, which is where its
            // own power buttons live. The bar below carries those instead.
            '.fi-sidebar,.fi-topbar,.fi-header,.fi-sidebar-close-overlay,'
            . 'body > footer,.fi-main-ctn > footer{display:none!important;}'

            // What is left gets the whole window, minus the strip the bar sits
            // in. Reserved here rather than by the bar itself: the bar loads a
            // moment after the page and anything it pushed would move the
            // terminal, and a moved terminal is re-fitted.
            . '.fi-main{max-width:none!important;padding:0.5rem!important;'
            . 'padding-block-start:3.4rem!important;}'
            . '.fi-main-ctn{padding:0!important;margin:0!important;}'
            . '.fi-page,.fi-console-page{gap:0.5rem!important;}'

            // Of the widgets on the page, the one holding the terminal. The
            // others are the overview blocks and the three graphs, which are
            // the page's job and not this window's.
            . '.fi-wi > *:not(:has(#terminal)){display:none!important;}'

            /*
             * The controls, which theme.css keeps off every console page - and
             * has to, since a bar landing above a terminal moves it. Here it is
             * wanted and it cannot move anything: the strip is already reserved
             * above, and the bar is taken out of the flow into it.
             *
             * This is the one console page with no other way to start or stop
             * the server, so it is the one that needs them.
             */
            . '.fi-console-page .ld-controls{display:flex!important;'
            . 'position:fixed;inset-block-start:0;inset-inline:0;z-index:50;'
            . 'margin:0;padding:0.45rem 0.75rem;'
            . 'background:var(--ld-sunken);box-shadow:inset 0 -1px 0 var(--ld-border);}'

            // The terminal takes what is left: the strip, the padding and the
            // command box under it.
            . '#terminal{height:calc(100dvh - 7.2rem)!important;}';
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
        if (self::mode() === self::POWER) {
            return '';
        }

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
        // Except the one opened as a window of its own. That window has no
        // page header and no sidebar, so the bar is the only way to see what
        // the server is doing or to start and stop it.
        if (self::isBare()) {
            return false;
        }

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
