<?php

namespace LegendDevelopment\Theme\Providers;

use App\Models\Role;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ServiceProvider;
use LegendDevelopment\Theme\Http\LayoutController;
use LegendDevelopment\Theme\Support\Areas;
use LegendDevelopment\Theme\Support\Background;
use LegendDevelopment\Theme\Support\Bars;
use LegendDevelopment\Theme\Support\CustomCss;
use LegendDevelopment\Theme\Support\Icons;
use LegendDevelopment\Theme\Support\Layouts;
use LegendDevelopment\Theme\Support\Palette;
use LegendDevelopment\Theme\Support\Presets;
use LegendDevelopment\Theme\Support\Runtime;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

class ThemeServiceProvider extends ServiceProvider
{
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

        Bars::register();

        $this->registerLayoutRoute();
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
        Role::registerCustomPermissions([
            Theme::PERMISSION_MODEL => ['view', 'update', 'arrange'],
        ]);

        Role::registerCustomModelIcon(Theme::PERMISSION_MODEL, 'tabler-palette');
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

        if (Theme::canArrange()) {
            $assets[] = "plugins/{$directory}/resources/js/arrange.js";

            $bootstrap = '<script>window.__ldArrange=' . json_encode([
                'canEdit' => true,
                'url' => url('/legend-theme/layout'),
                'page' => Layouts::pageKey(request()->path()),
                'layout' => (object) Layouts::for(request()->path()),
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
     * Settings that the stylesheet reads as custom properties, plus the opt-outs
     * for the effects that are toggled off.
     */
    private function settings(): string
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

            $css .= 'html.dark{'
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

        $css .= $this->loginCss();

        // Last, so a per-area override wins from every global setting above.
        $css .= Areas::css();

        // The saved page arrangement. Emitted server side, so the blocks are in
        // place on the first paint rather than jumping once a script runs.
        $css .= Layouts::css(request()->path());

        return '<style>' . $css . '</style>';
    }

    /**
     * The login screen: its own picture, card width and card blur.
     */
    private function loginCss(): string
    {
        $width = (int) Theme::config('login_width', 28);
        $width = max(20, min(60, $width));

        $blur = (int) Theme::config('login_blur', 0);
        $blur = max(0, min(24, $blur));

        return ":root{--ld-login-width:{$width}rem;--ld-login-blur:{$blur}px;}" . Background::login();
    }
}
