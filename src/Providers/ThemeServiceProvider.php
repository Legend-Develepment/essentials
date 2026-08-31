<?php

namespace LegendDevelopment\Theme\Providers;

use App\Models\Role;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ServiceProvider;
use LegendDevelopment\Theme\Http\LayoutController;
use LegendDevelopment\Theme\Support\Areas;
use LegendDevelopment\Theme\Support\AutoUpdate;
use LegendDevelopment\Theme\Support\Background;
use LegendDevelopment\Theme\Support\Bars;
use LegendDevelopment\Theme\Support\CustomCss;
use LegendDevelopment\Theme\Support\Icons;
use LegendDevelopment\Theme\Support\Layout;
use LegendDevelopment\Theme\Support\Layouts;
use LegendDevelopment\Theme\Support\Login;
use LegendDevelopment\Theme\Support\NavLinks;
use LegendDevelopment\Theme\Support\Notice;
use LegendDevelopment\Theme\Support\Palette;
use LegendDevelopment\Theme\Support\Presets;
use LegendDevelopment\Theme\Support\Runtime;
use LegendDevelopment\Theme\Support\ServerConsole;
use LegendDevelopment\Theme\Support\ServerControls;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\ServerList;
use LegendDevelopment\Theme\Support\SidebarFooter;
use LegendDevelopment\Theme\Support\Terminal;
use LegendDevelopment\Theme\Support\Typography;
use LegendDevelopment\Theme\Support\UserTheme;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

class ThemeServiceProvider extends ServiceProvider
{
    /** The settings block, built once and handed back to every re-fire. */
    private static ?string $settings = null;

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // The permissions and the Theme page are registered either way, so the
        // theme can be switched back on from a panel that currently renders
        // completely untouched.
        $this->registerPermissions();
        $this->registerAutoUpdate();

        if (Presets::isDisabled()) {
            return;
        }

        // STYLES_AFTER puts the theme behind Pelican's own stylesheet, which is
        // registered on STYLES_BEFORE. Registering here rather than in the plugin
        // class means the hook is added once, not once per panel.
        FilamentView::registerRenderHook(
            PanelsRenderHook::STYLES_AFTER,
            // The administrator's own CSS goes last of all, so it needs no
            // !important to win from anything the theme itself emitted.
            fn () => new HtmlString(
                $this->stylesheet() . $this->settings() . CustomCss::style() . Runtime::script(),
            ),
        );

        FilamentView::registerRenderHook(
            PanelsRenderHook::SCRIPTS_AFTER,
            fn () => new HtmlString($this->script()),
        );

        // One line across the top of the panel. Static markup in the first
        // response, for the reason spelled out in Notice::html().
        FilamentView::registerRenderHook(
            PanelsRenderHook::PAGE_START,
            fn () => new HtmlString($this->notice()),
        );

        /*
         * The sign-in screen: a line above the form, and links under it.
         *
         * The hook names are written out rather than taken from
         * PanelsRenderHook, deliberately. A constant that a future Filament
         * renames is a fatal on every page; a string it no longer recognises is
         * simply a hook nobody renders. On a login screen, the second is the
         * only acceptable way to be wrong.
         */
        if (Features::enabled(Features::LOGIN)) {
            FilamentView::registerRenderHook(
                'panels::auth.login.form.before',
                fn () => new HtmlString($this->attempt(fn (): string => Login::above())),
            );

            FilamentView::registerRenderHook(
                'panels::auth.login.form.after',
                fn () => new HtmlString($this->attempt(fn (): string => Login::links())),
            );
        }

        // The bottom of the sidebar, which Pelican leaves empty. Wrapped like
        // the announcement bar: a hook that throws takes every page with it,
        // and a line of text is not worth that.
        FilamentView::registerRenderHook(
            SidebarFooter::HOOK,
            fn () => new HtmlString($this->attempt(fn (): string => SidebarFooter::html())),
        );

        if (Features::enabled(Features::BARS)) {
            Bars::register();
        }

        // The power buttons and the way back to the console, on every page
        // inside a server. Its own render hook, registered once here.
        ServerControls::register();

        $this->registerLayoutRoute();
    }

    /**
     * The announcement bar. Wrapped, because a render hook that throws takes
     * every page with it, and a line of text is not worth that.
     */
    private function notice(): string
    {
        if (!Features::enabled(Features::ANNOUNCEMENTS)) {
            return '';
        }

        return $this->attempt(fn (): string => Notice::html());
    }

    /**
     * @param  callable(): string  $render
     */
    private function attempt(callable $render): string
    {
        try {
            return $render();
        } catch (Throwable) {
            return '';
        }
    }

    /**
     * Hands the automatic update check to the scheduler, and only where the
     * scheduler exists - resolving it for every web request would be building
     * something nothing is going to read.
     */
    private function registerAutoUpdate(): void
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        // After booting: the schedule is resolved once the rest of the panel is
        // up, so reading the setting cannot land before config is in place.
        $this->app->booted(function (): void {
            try {
                AutoUpdate::schedule($this->app->make(Schedule::class));
            } catch (Throwable) {
                // Never let a scheduling problem stop artisan from running.
            }
        });
    }

    /**
     * Where the page arranger saves to. Registered outside the panels because it
     * is a plain endpoint, not a page.
     */
    private function registerLayoutRoute(): void
    {
        try {
            Route::middleware(['web', 'auth'])
                ->post('/legend-theme/layout', LayoutController::class);
        } catch (Throwable) {
            // Routes are cached; `php artisan optimize:clear` brings it back.
        }
    }

    /**
     * Adds a "Legend Theme" section with View and Update checkboxes to the role
     * editor. Pelican creates the permission records itself the first time a
     * role is saved with them ticked, so there is nothing to seed.
     */
    private function registerPermissions(): void
    {
        /*
         * The three broad ones, and then one per feature.
         *
         * view and update still open everything, which is what keeps this from
         * being a breaking change: a role that could reach the plugin before
         * can still reach all of it. The per-feature permissions are the narrow
         * way in - somebody who should write announcements and touch nothing
         * else gets "announcements" and no more.
         */
        Role::registerCustomPermissions([
            Theme::PERMISSION_MODEL => array_merge(
                ['view', 'update', 'arrange'],
                Features::permissions(),
            ),
        ]);

        Role::registerCustomModelIcon(Theme::PERMISSION_MODEL, 'tabler-adjustments');
    }

    /**
     * The compiled theme. Vite picks the file up through the glob over
     * plugins/<id>/resources/css in the panel's vite.config.js, so `yarn build`
     * is all that is needed.
     */
    private function stylesheet(): string
    {
        $asset = 'plugins/' . Theme::directory() . '/resources/css/theme.css';

        try {
            return Blade::render("@vite(['{$asset}'])");
        } catch (Throwable) {
            // Assets have not been built yet - `yarn build` in the panel directory
            // fixes it. Never take the panel down over a stylesheet.
            return '';
        }
    }

    /**
     * The bar levelling script, and - only for someone who may edit the layout -
     * the page arranger with what it needs to start.
     */
    private function script(): string
    {
        $directory = Theme::directory();
        $assets = ["plugins/{$directory}/resources/js/bars.js"];
        $bootstrap = '';

        // Only where the box it drives can appear. The script is inert without
        // it, so this is about not shipping bytes to every page of the panel for
        // a feature that lives on four of them.
        if (Features::maySee(Features::SETTINGS_SEARCH)) {
            $assets[] = "plugins/{$directory}/resources/js/settings-search.js";
        }

        if (Theme::canArrange()) {
            $assets[] = "plugins/{$directory}/resources/js/arrange.js";

            $path = request()->path();
            $canShare = Theme::canArrangeForEveryone();

            $bootstrap = '<script>window.__ldArrange=' . json_encode([
                'canEdit' => true,
                // Whether the editor offers "for everyone" at all. Checked again
                // on the way in - this only decides what is drawn.
                'canShare' => $canShare,
                'url' => url('/legend-theme/layout'),
                'page' => Layouts::pageKey($path),
                // Each scope on its own, so switching between them shows what
                // that scope holds rather than the two added together.
                'merged' => (object) Layouts::for($path),
                'shared' => (object) ($canShare ? Layouts::scoped($path, Layouts::SHARED) : []),
            ], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) . ';</script>';
        }

        try {
            $list = implode("','", $assets);

            return $bootstrap . Blade::render("@vite(['{$list}'])");
        } catch (Throwable) {
            return '';
        }
    }

    /**
     * The panel's own settings block, and then - for anyone who has chosen a
     * style of their own - the same block built from theirs.
     *
     * Twice rather than once with the values swapped in, because a second block
     * after the first is the whole mechanism: everything in it wins by being
     * later, and a person who has chosen nothing gets exactly the page they got
     * before this existed. It costs a few kilobytes on the pages of the people
     * who asked for it.
     */
    private function settings(): string
    {
        /*
         * Built once per request.
         *
         * Render hooks re-fire inside Livewire responses - the lesson the blank
         * console cost a week - so this closure runs again on every interaction
         * with the page, not only on the page. Everything it reads is fixed for
         * the life of the request: the settings, who is asking, and the path.
         * Building it twice was already waste; building it twice over, once for
         * the panel and once for somebody's own style, is twice that.
         */
        if (self::$settings !== null) {
            return self::$settings;
        }

        $panel = $this->settingsCss();

        $own = $this->attempt(fn (): string => UserTheme::css(fn (): string => $this->settingsCss()));

        return self::$settings = '<style>' . $panel . $own . '</style>';
    }

    /**
     * Settings that the stylesheet reads as custom properties, plus the opt-outs
     * for the effects that are toggled off.
     */
    private function settingsCss(): string
    {
        $accent = Palette::sanitize(Theme::config('accent'));
        $density = Theme::config('density', 'comfortable') === 'compact' ? '0.72' : '1';

        // The stylesheet reads every effect through a custom property, so turning
        // one off is a matter of redefining the token rather than fighting the
        // rules that use it.
        $css = ":root{--ld-accent:{$accent};--ld-density:{$density};}";

        $radius = (string) Theme::config('radius', 'normal');

        if (array_key_exists($radius, Areas::RADII)) {
            [$large, $small] = Areas::RADII[$radius];

            $css .= ":root{--ld-radius:{$large};--ld-radius-sm:{$small};}";
        }

        $surface = trim((string) Theme::config('surface', ''));

        if ($surface !== '') {
            $surface = Palette::sanitize($surface, '#1c1917');

            /*
             * :root and not html.dark.
             *
             * It was dark-only, which was invisible while the panel was always
             * dark and is a setting that silently does nothing the moment it is
             * not. The two shifts hold in both directions: raised is lighter
             * than the surface and sunken is darker, whichever end of the scale
             * the surface sits at.
             */
            $css .= ':root{'
                . "--ld-surface:{$surface};"
                . '--ld-raised:' . Palette::shift($surface, 0.035) . ';'
                . '--ld-sunken:' . Palette::shift($surface, -0.03) . ';'
                . '}';
        }

        if (!Theme::config('glass', true)) {
            $css .= ':root{--ld-blur:none;}html.dark{--ld-topbar-bg:var(--gray-900);}';
        }

        if (!Theme::config('glow', true)) {
            $css .= ':root{--ld-glow:none;--ld-glow-strong:none;}';
        }

        $css .= Background::css();
        $css .= Icons::css();
        $css .= Bars::css();

        // The shape of the panel: the rail, and the sidebar, topbar and card
        // styles. Before the per-area block, so an area can still override it.
        $css .= Layout::css();

        // How a server card is drawn, before the per-area block below.
        $css .= ServerList::css();
        $css .= ServerConsole::css();

        // The panel's lettering, and nothing at all when it has not been
        // changed - see Typography::css() for why that is the whole rule rather
        // than a custom property.
        $css .= Typography::css();

        // The terminal's own colours and behaviour. Emitted as custom
        // properties that the inlined runtime reads back, because xterm draws
        // to a canvas and a stylesheet cannot reach the glyphs.
        $css .= Terminal::css();

        // A console page opened as a window of its own, stripped to the
        // console. After the layout, since it undoes most of it.
        $css .= ServerControls::bareCss();

        // Which notice this is, so a browser can tell a new one from the one it
        // closed - read before the first paint, so nothing flashes.
        $css .= Features::enabled(Features::ANNOUNCEMENTS) ? Notice::css() : '';

        // The fetched favicons, painted over the icon Filament rendered for
        // each link. Stored data, so nothing here reaches out to a network.
        $css .= Features::enabled(Features::NAV_LINKS) ? NavLinks::css() : '';

        $css .= Features::enabled(Features::LOGIN) ? Login::css() : '';

        // Last, so a per-area override wins from every global setting above.
        $css .= Areas::css();

        // The saved page arrangement. Emitted server side, so the blocks are in
        // place on the first paint rather than jumping once a script runs.
        $css .= Layouts::css(request()->path());

        // The rules only, with no <style> around them: settings() wraps the two
        // blocks it builds together in one.
        return $css;
    }

    /**
     * The login screen: its own picture, card width and card blur.
     */
}
