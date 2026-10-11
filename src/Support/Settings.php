<?php

namespace LegendDevelopment\Theme\Support;

use App\Traits\EnvironmentWriterTrait;
use LegendDevelopment\Theme\Support\Alerts\Notifier;
use LegendDevelopment\Theme\Support\Fields\Advanced;
use LegendDevelopment\Theme\Support\Fields\Files;
use LegendDevelopment\Theme\Support\Fields\Eggs;
use LegendDevelopment\Theme\Support\Fields\Words;
use LegendDevelopment\Theme\Support\Fields\Doorway;
use LegendDevelopment\Theme\Support\Fields\Look;
use LegendDevelopment\Theme\Support\Fields\Pages;
use LegendDevelopment\Theme\Support\Fields\Plugin;
use LegendDevelopment\Theme\Support\Games\Ark;
use LegendDevelopment\Theme\Support\Games\DontStarve;
use LegendDevelopment\Theme\Support\Games\Enshrouded;
use LegendDevelopment\Theme\Support\Games\Factorio;
use LegendDevelopment\Theme\Support\Games\Games;
use LegendDevelopment\Theme\Support\Games\Satisfactory;
use LegendDevelopment\Theme\Support\Games\Terraria;
use LegendDevelopment\Theme\Support\Games\VRising;
use LegendDevelopment\Theme\Support\Games\Onset;
use LegendDevelopment\Theme\Support\Games\Craftopia;
use LegendDevelopment\Theme\Support\Games\Valheim;
use LegendDevelopment\Theme\Support\Registration;
use LegendDevelopment\Theme\Support\Status\Monitors;
use LegendDevelopment\Theme\Support\Status\Publish;
use LegendDevelopment\Theme\Support\Minecraft\Minecraft;
use Filament\Notifications\Notification;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use LegendDevelopment\Theme\Support\Cdn\Mirror;
use LegendDevelopment\Theme\Support\Cdn\Uploads;
use LegendDevelopment\Theme\Support\Languages;
use LegendDevelopment\Theme\Support\Shop\Billing;
use LegendDevelopment\Theme\Support\Shop\Cart;
use LegendDevelopment\Theme\Support\Shop\Purchase;
use LegendDevelopment\Theme\Support\NavIcon;
use LegendDevelopment\Theme\Support\Pictures;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Throwable;

/**
 * The theme's settings, in one place.
 *
 * Both entry points use this: the plugin settings modal under Admin -> Plugins
 * (which needs the panel-wide plugin permissions) and the dedicated Theme page
 * (which needs only this plugin's own permissions).
 */
class Settings
{
    use EnvironmentWriterTrait;

    private const BACKGROUNDS = ['aurora', 'solid', 'gradient', 'image'];

    /**
     * @return array<string, mixed>
     */
    public static function data(): array
    {
        return [
            'preset' => Presets::current(),
            'user_themes' => UserTheme::allowed(),
            'layout' => Layout::current(),
            'nav_style' => Layout::navStyle(),
            'topbar_style' => Layout::topbarStyle(),
            'card_style' => Layout::cardStyle(),
            'accent' => Palette::sanitize(Theme::config('accent')),
            'surface' => ($surface = (string) Theme::config('surface', '')) !== ''
                ? Palette::sanitize($surface, '')
                : null,
            'radius' => array_key_exists((string) Theme::config('radius'), Areas::RADII)
                ? (string) Theme::config('radius')
                : 'normal',
            'density' => Theme::config('density', 'comfortable') === 'compact' ? 'compact' : 'comfortable',
            'font' => Typography::current(),
            'mode' => Mode::current(),
            'force_dark' => (bool) Theme::config('force_dark', false),
            'glass' => (bool) Theme::config('glass', true),
            'glow' => (bool) Theme::config('glow', true),

            'background' => in_array(Theme::config('background'), self::BACKGROUNDS, true)
                ? Theme::config('background')
                : 'aurora',
            'background_color' => Palette::sanitize(Theme::config('background_color'), '#14110e'),
            'background_color_end' => Palette::sanitize(Theme::config('background_color_end'), '#2b1c08'),
            'background_angle' => (string) Theme::config('background_angle', '135'),
            'background_image' => (string) Theme::config('background_image', ''),
            'background_image_url' => (string) Theme::config('background_image_url', ''),
            'background_dim' => (int) Theme::config('background_dim', 55),
            'background_blur' => (int) Theme::config('background_blur', 0),

            'server_art' => ServerList::artwork(),
            'server_art_dim' => ServerList::dim(),
            'server_status' => ServerList::status(),
            'server_density' => ServerList::density(),
            'server_columns' => ServerList::columns(),
            'server_filter_label' => ServerList::labelFilters(),
            'server_controls' => ServerControls::mode(),
            'server_controls_label' => ServerControls::label(),
            'server_controls_position' => ServerControls::position(),

            'console_stats' => ServerConsole::stats(),
            'terminal_renderer' => Terminal::renderer(),
            'terminal_scheme' => Terminal::scheme(),
            'terminal_cursor' => Terminal::cursor(),
            'terminal_blink' => Terminal::blink(),
            'terminal_scrollback' => Terminal::scrollback(),

            'bar_base' => Theme::config('bar_base', 'green') === 'accent' ? 'accent' : 'green',
            'bar_warning' => Bars::warning(),
            'bar_danger' => Bars::danger(),

            'icon_stroke' => (string) Theme::config('icon_stroke', '2'),
            'icon_scale' => (string) Theme::config('icon_scale', '1'),
            'icon_accent' => (bool) Theme::config('icon_accent', false),
            'icon_pack' => IconPacks::current(),
            'icon_pack_file' => null,
            'icon_overrides' => Icons::rows(),

            'arranger_users' => (bool) Theme::config('arranger_users', false),
            'logo_height' => (string) Theme::config('logo_height', '2'),
            'logo_url' => (string) Theme::config('logo_url', ''),
            'nav_icon' => (string) Theme::config('nav_icon', ''),

            // The sign-in screen's own settings are not here: they have a page
            // of their own, and a key written from two forms is a key the
            // second one to be saved silently puts back. See persistLogin().
            'custom_css' => CustomCss::get(),
            'theme_windows' => Windows::rows(),

            'footer_text' => SidebarFooter::text(),
            'footer_version' => SidebarFooter::showVersion(),
            'footer_link_label' => SidebarFooter::linkLabel(),
            'footer_link_url' => SidebarFooter::linkUrl(),

            'areas' => Areas::rows(),

            /*
             * Ticked is on. What is stored is the inverse - see Features for
             * why - and the form never has to know that.
             *
             * Twice, saying the same thing: flat, which is what an export
             * written before the list was grouped carries and what one written
             * now still carries, and once per module, which is what the page
             * draws. persist() prefers the grouped keys and falls back to the
             * flat one, so an old backup restores the list it was taken with.
             */
            'features' => Features::current(),
            ...self::featuresByModule(),

            /*
             * Which eggs count as Minecraft. In the main set rather than behind
             * a persist() of its own, which is not tidiness: a group with its
             * own persister has to be added to the export by hand, and that is
             * exactly how the settings file came to be missing a quarter of its
             * settings for twelve releases. Everything here leaves the panel
             * because everything here is here.
             */
            'minecraft_eggs' => Minecraft::eggs(),
            'minecraft_live' => Minecraft::live(),
            'ark_eggs' => Ark::eggs(),
            'terraria_eggs' => Terraria::eggs(),
            'vrising_eggs' => VRising::eggs(),
            'enshrouded_eggs' => Enshrouded::eggs(),
            'factorio_eggs' => Factorio::eggs(),
            'dontstarve_eggs' => DontStarve::eggs(),
            'satisfactory_eggs' => Satisfactory::eggs(),
            'onset_eggs' => Onset::eggs(),
            'craftopia_eggs' => Craftopia::eggs(),
            'valheim_eggs' => Valheim::eggs(),
            // The form offers what is on; the store holds what is off.
            /*
              * What is actually offered, which is not the same as what is not
              * switched off any more.
              *
              * A language under the threshold starts unticked however untouched
              * it is, so the list shows the truth: eighteen strings of German
              * is not a language this panel offers, and the box being ticked
              * would have said it was.
              */
            'languages_on' => array_values(array_filter(
                array_diff(Languages::available(), Languages::disabled(), [Languages::BASE]),
                static fn (string $code): bool => Languages::enabled($code),
            )),
            'languages_panel' => Languages::leads(),
            'languages_main' => Languages::main(),
            'language_labels' => Languages::labelRows(),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function fields(): array
    {
        /*
         * Everything, for Admin -> Plugins -> Settings, which is one modal and
         * has nowhere to send you.
         *
         * The sidebar splits the same sections across four pages instead, and
         * each of those four is a class under Fields. A page is a better home
         * for eleven foldable sections than a single scroll was: the row you
         * want is in the sidebar, named, one click away, rather than somewhere
         * down a page you have to hunt.
         */
        return array_merge(
            self::mainGroups(),
            self::lookGroups(),
            self::pageGroups(),
            self::advancedGroups(),
        );
    }

    /**
     * The plugin's own page: its version, whether Pelican has an update for it,
     * and a way to its parts.
     *
     * Built in Fields\Plugin. The way in stays here so the pages that draw
     * these keep asking one class what a setting is and what it looks like.
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function mainGroups(): array
    {
        return Plugin::groups();
    }

    /**
     * The Look page: what the panel is made of and what colour it is.
     *
     * Built in Fields\Look. The way in stays here so the pages that draw
     * these keep asking one class what a setting is and what it looks like.
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function lookGroups(): array
    {
        return Look::groups();
    }

    /**
     * Where this plugin keeps what people upload.
     *
     * Built in Fields\Files. The way in stays here so the pages that draw
     * these keep asking one class what a setting is and what it looks like.
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function fileGroups(): array
    {
        return Files::groups();
    }

    /**
     * Which languages this plugin answers in.
     *
     * Built in Fields\Words. The way in stays here so the pages that draw
     * these keep asking one class what a setting is and what it looks like.
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function languageGroups(): array
    {
        return Words::groups();
    }

    /**
     * Which eggs are Minecraft.
     *
     * Built in Fields\Eggs. The way in stays here so the pages that draw
     * these keep asking one class what a setting is and what it looks like.
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function minecraftGroups(): array
    {
        return Eggs::minecraft();
    }

    /**
     * Which eggs are Ark and which are Valheim.
     *
     * Built in Fields\Eggs. The way in stays here so the pages that draw
     * these keep asking one class what a setting is and what it looks like.
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function gameGroups(): array
    {
        return Eggs::games();
    }

    /**
     * The Panel pages page: what a server's own pages show.
     *
     * Built in Fields\Pages. The way in stays here so the pages that draw
     * these keep asking one class what a setting is and what it looks like.
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function pageGroups(): array
    {
        return Pages::groups();
    }

    /**
     * The Advanced page: a stylesheet of your own, and where things sit.
     *
     * Built in Fields\Advanced. The way in stays here so the pages that draw
     * these keep asking one class what a setting is and what it looks like.
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function advancedGroups(): array
    {
        return Advanced::groups();
    }

    /**
     * What this save says is switched on.
     *
     * The page binds one list per module, so that is what a save carries. An
     * export written before the grouping carries one flat list instead, and it
     * says exactly the same thing, so it is still read - the grouped keys win
     * when they are there, because on a save they are the edited ones.
     *
     * A module the data does not mention keeps what it had rather than being
     * read as "everything in it is off". That is the trap this whole file is
     * written around: a form that does not carry every key must not write every
     * key, and an import is a form that does not carry every key.
     *
     * @param  array<mixed, mixed>  $data
     * @return array<int, string>
     */
    private static function featuresFrom(array $data): array
    {
        $grouped = false;

        foreach (Modules::ALL as $module) {
            if (array_key_exists('features_' . $module, $data)) {
                $grouped = true;

                break;
            }
        }

        if (!$grouped) {
            /*
             * Neither shape. That is not "everything off": it is a save that
             * does not carry the list at all, which is what the settings page
             * became the day the switches moved to the modules page. Reading it
             * as an empty list would switch off all fifty-three on the next
             * save of an unrelated colour.
             */
            if (!array_key_exists('features', $data)) {
                return Features::current();
            }

            return array_values((array) $data['features']);
        }

        $on = Features::current();
        $out = [];

        foreach (Modules::ALL as $module) {
            $held = Modules::holds($module);
            $key = 'features_' . $module;

            $out = array_merge($out, array_values(array_intersect(
                array_key_exists($key, $data) ? (array) $data[$key] : $on,
                $held,
            )));
        }

        return $out;
    }

    /**
     * What is switched on, per module, in the shape the form binds to.
     *
     * @return array<string, array<int, string>>
     */
    private static function featuresByModule(): array
    {
        $on = Features::current();
        $out = [];

        foreach (Modules::ALL as $module) {
            $out['features_' . $module] = array_values(
                array_intersect($on, Modules::holds($module)),
            );
        }

        return $out;
    }

    /**
     * Writes to .env and clears the config cache, so a saved colour applies on
     * the next request without a rebuild.
     *
     * @param  array<mixed, mixed>  $data
     */
    public static function persist(array $data): void
    {
        $preset = $data['preset'] ?? null;
        $surface = is_string($data['surface'] ?? null) ? trim($data['surface']) : '';

        (new self())->writeToEnvironment([
            'LEGEND_THEME_PRESET' => self::preset($preset),
            'LEGEND_THEME_ACCENT' => Palette::sanitize($data['accent'] ?? null),
            'LEGEND_THEME_SURFACE' => $surface === '' ? '' : Palette::sanitize($surface, ''),
            /*
             * is_string first, and not for tidiness: array_key_exists() throws
             * a TypeError when handed an array or a bool as the key, and this is
             * the only lookup in persist() that takes a value straight from the
             * caller rather than through a sanitiser. Every other value here
             * goes through one that accepts mixed. The form can only ever put a
             * string in this key - an imported file can put anything at all, and
             * import() hands its contents to this same method on purpose.
             */
            'LEGEND_THEME_RADIUS' => is_string($data['radius'] ?? null)
                && array_key_exists($data['radius'], Areas::RADII)
                    ? $data['radius']
                    : 'normal',
            'LEGEND_THEME_LAYOUT' => Layout::sanitise($data['layout'] ?? null),
            'LEGEND_THEME_NAV_STYLE' => Layout::sanitiseNav($data['nav_style'] ?? null),
            'LEGEND_THEME_TOPBAR_STYLE' => Layout::sanitiseTopbar($data['topbar_style'] ?? null),
            'LEGEND_THEME_CARD_STYLE' => Layout::sanitiseCard($data['card_style'] ?? null),
            'LEGEND_THEME_USER_THEMES' => UserTheme::sanitiseAllowed($data['user_themes'] ?? null),
            'LEGEND_THEME_MODE' => Mode::sanitise($data['mode'] ?? null),
            'LEGEND_THEME_FONT' => Typography::sanitise($data['font'] ?? null),
            'LEGEND_THEME_DENSITY' => ($data['density'] ?? null) === 'compact' ? 'compact' : 'comfortable',
            'LEGEND_THEME_FORCE_DARK' => ($data['force_dark'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_GLASS' => ($data['glass'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_GLOW' => ($data['glow'] ?? false) ? 'true' : 'false',

            'LEGEND_THEME_BACKGROUND' => in_array($data['background'] ?? null, self::BACKGROUNDS, true)
                ? $data['background']
                : 'aurora',
            'LEGEND_THEME_BG_COLOR' => Palette::sanitize($data['background_color'] ?? null, '#14110e'),
            'LEGEND_THEME_BG_COLOR_END' => Palette::sanitize($data['background_color_end'] ?? null, '#2b1c08'),
            'LEGEND_THEME_BG_ANGLE' => (string) Clean::clamp($data['background_angle'] ?? null, 0, 360, 135),
            'LEGEND_THEME_BG_IMAGE' => Uploaded::stored($data['background_image'] ?? null, Pictures::BACKDROP),
            'LEGEND_THEME_BG_URL' => Clean::url($data['background_image_url'] ?? null),
            'LEGEND_THEME_BG_DIM' => (string) Clean::clamp($data['background_dim'] ?? null, 0, 90, 55),
            'LEGEND_THEME_BG_BLUR' => (string) Clean::clamp($data['background_blur'] ?? null, 0, 24, 0),

            'LEGEND_THEME_SERVER_ART' => ServerList::sanitiseArtwork($data['server_art'] ?? null),
            'LEGEND_THEME_SERVER_ART_DIM' => (string) Clean::clamp($data['server_art_dim'] ?? null, 0, 80, 35),
            'LEGEND_THEME_SERVER_STATUS' => ServerList::sanitiseStatus($data['server_status'] ?? null),
            'LEGEND_THEME_SERVER_DENSITY' => ServerList::sanitiseDensity($data['server_density'] ?? null),
            'LEGEND_THEME_SERVER_FILTER_LABEL' => ($data['server_filter_label'] ?? true) ? 'true' : 'false',
            'LEGEND_THEME_SERVER_CONTROLS' => ServerControls::sanitise($data['server_controls'] ?? null),
            'LEGEND_THEME_SERVER_CONTROLS_LABEL' => ServerControls::sanitiseLabel($data['server_controls_label'] ?? null),
            'LEGEND_THEME_SERVER_CONTROLS_POSITION' => ServerControls::sanitisePosition($data['server_controls_position'] ?? null),

            'LEGEND_THEME_CONSOLE_STATS' => ServerConsole::sanitiseStats($data['console_stats'] ?? null),
            'LEGEND_THEME_SERVER_COLUMNS' => ServerList::sanitiseColumns($data['server_columns'] ?? null),

            'LEGEND_THEME_TERMINAL_RENDERER' => Terminal::sanitiseRenderer($data['terminal_renderer'] ?? null),
            'LEGEND_THEME_TERMINAL_SCHEME' => Terminal::sanitiseScheme($data['terminal_scheme'] ?? null),
            'LEGEND_THEME_TERMINAL_CURSOR' => Terminal::sanitiseCursor($data['terminal_cursor'] ?? null),
            'LEGEND_THEME_TERMINAL_BLINK' => ($data['terminal_blink'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_TERMINAL_SCROLLBACK' => Terminal::sanitiseScrollback($data['terminal_scrollback'] ?? null),

            'LEGEND_THEME_BAR_BASE' => ($data['bar_base'] ?? null) === 'accent' ? 'accent' : 'green',
            'LEGEND_THEME_BAR_WARNING' => (string) Clean::clamp($data['bar_warning'] ?? null, 2, 98, Bars::DEFAULT_WARNING),
            'LEGEND_THEME_BAR_DANGER' => (string) Clean::clamp($data['bar_danger'] ?? null, 3, 99, Bars::DEFAULT_DANGER),

            'LEGEND_THEME_ICON_STROKE' => in_array($data['icon_stroke'] ?? null, ['1.25', '2', '2.5'], true)
                ? $data['icon_stroke']
                : '2',
            'LEGEND_THEME_ICON_SCALE' => in_array($data['icon_scale'] ?? null, ['0.9', '1', '1.1', '1.25'], true)
                ? $data['icon_scale']
                : '1',
            'LEGEND_THEME_ICON_ACCENT' => ($data['icon_accent'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_ICON_PACK' => Clean::iconPack($data['icon_pack'] ?? null),
            /*
             * The uploads inside the repeater are turned into paths here rather
             * than in Icons, so the one place that knows how to get a path out
             * of a Filament upload stays the one place. Filament has usually
             * stored them by now and the state is already a path; storedPath()
             * answers the same either way, which is the point of going through
             * it rather than assuming.
             */
            'LEGEND_THEME_ICONS' => Icons::toStorage(array_map(
                static function (mixed $row): mixed {
                    if (is_array($row) && array_key_exists('file', $row)) {
                        $row['file'] = Uploaded::stored($row['file'], Pictures::ICON);
                    }

                    return $row;
                },
                (array) ($data['icon_overrides'] ?? []),
            )),

            'LEGEND_THEME_ARRANGER_USERS' => ($data['arranger_users'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_LOGO_HEIGHT' => (string) Clean::clampFloat($data['logo_height'] ?? null, 1, 8, 2),
            'LEGEND_THEME_LOGO_URL' => Clean::path($data['logo_url'] ?? null),
            'LEGEND_THEME_FOOTER_TEXT' => mb_substr(trim((string) ($data['footer_text'] ?? '')), 0, 120),
            'LEGEND_THEME_FOOTER_VERSION' => ($data['footer_version'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_FOOTER_LABEL' => mb_substr(trim((string) ($data['footer_link_label'] ?? '')), 0, 40),
            'LEGEND_THEME_FOOTER_URL' => Clean::url($data['footer_link_url'] ?? null),

            'LEGEND_THEME_AREAS' => Areas::toStorage((array) ($data['areas'] ?? [])),

            // Ticked is on, and what is written is what is off. This form
            // offers every feature, so unticked really does mean off here -
            // unlike the one on the System status page, which changes one and
            // leaves the rest as they were.
            // Routes are decided from this list, so Features::changed() is
            // called below once the write has happened.
            'LEGEND_THEME_FEATURES_OFF' => $featuresOff = Features::sanitise(self::featuresFrom($data)),
            'LEGEND_THEME_MINECRAFT_EGGS' => Minecraft::sanitiseEggs($data['minecraft_eggs'] ?? []),
            'LEGEND_THEME_MINECRAFT_LIVE' => ($data['minecraft_live'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_ARK_EGGS' => Ark::sanitise($data['ark_eggs'] ?? []),
            'LEGEND_THEME_TERRARIA_EGGS' => Terraria::sanitise($data['terraria_eggs'] ?? []),
            'LEGEND_THEME_VRISING_EGGS' => VRising::sanitise($data['vrising_eggs'] ?? []),
            'LEGEND_THEME_ENSHROUDED_EGGS' => Enshrouded::sanitise($data['enshrouded_eggs'] ?? []),
            'LEGEND_THEME_FACTORIO_EGGS' => Factorio::sanitise($data['factorio_eggs'] ?? []),
            'LEGEND_THEME_DONTSTARVE_EGGS' => DontStarve::sanitise($data['dontstarve_eggs'] ?? []),
            'LEGEND_THEME_SATISFACTORY_EGGS' => Satisfactory::sanitise($data['satisfactory_eggs'] ?? []),
            'LEGEND_THEME_ONSET_EGGS' => Onset::sanitise($data['onset_eggs'] ?? []),
            'LEGEND_THEME_CRAFTOPIA_EGGS' => Craftopia::sanitise($data['craftopia_eggs'] ?? []),
            'LEGEND_THEME_VALHEIM_EGGS' => Valheim::sanitise($data['valheim_eggs'] ?? []),
            'LEGEND_THEME_LANGUAGES_OFF' => Languages::sanitise($data['languages_on'] ?? []),
            // The exceptions: a language ticked despite being under the
            // threshold. Only those - a finished one needs no exception, and
            // storing one would leave a line saying nothing the moment somebody
            // finishes translating it.
            'LEGEND_THEME_LANGUAGES_PARTIAL' => Languages::sanitisePartial($data['languages_on'] ?? []),
            'LEGEND_THEME_LANGUAGES_PANEL' => ($data['languages_panel'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_LANGUAGES_MAIN' => Languages::sanitiseMain($data['languages_main'] ?? null),
            'LEGEND_THEME_LANGUAGE_LABELS' => Languages::sanitiseLabels($data['language_labels'] ?? []),
            'LEGEND_THEME_NAV_ICON' => Uploaded::stored($data['nav_icon'] ?? null, Pictures::ICON),
        ]);

        /*
         * Straight after the write, not at the end of the method.
         *
         * The feature list decides which routes exist and the cached ones do
         * not know that yet, so something has to clear them. It used to be the
         * last line, with a stylesheet, a window layout, an icon pack and a
         * stamp in between - five things that touch storage and any one of
         * which can throw. A save that fell over on the icon pack left the
         * switch written into .env and the route cache still holding the old
         * answer, which is the original fault exactly: the switch was flipped
         * and the panel behaved as though it had not been.
         *
         * It also patches the config for the rest of this request, so what runs
         * below reads the list that was just saved rather than the one the
         * request booted with.
         */
        Features::changed($featuresOff);

        // Not an environment value: a stylesheet does not survive a .env round
        // trip, so it goes to storage instead.
        $css = is_string($data['custom_css'] ?? null) ? $data['custom_css'] : '';

        CustomCss::put($css);

        // Also storage rather than .env, and for the same reason: a list of
        // rows with a list inside each of them is not a string anybody wants to
        // parse back out of an environment variable.
        if (array_key_exists('theme_windows', $data)) {
            Windows::save(is_array($data['theme_windows']) ? $data['theme_windows'] : []);
        }

        /*
         * Saved first, then looked at.
         *
         * The order is the whole policy. This field exists so somebody can
         * write something this plugin has not thought of, so it always takes
         * what was typed - and then says what it noticed, which is the only
         * place in the plugin where a typo takes the panel's styling down until
         * somebody finds it.
         */
        $wrong = CustomCss::check($css);

        if ($wrong !== null) {
            try {
                Notification::make()
                    ->title(Theme::trans('settings.css_warning'))
                    ->body($wrong)
                    ->warning()
                    ->persistent()
                    ->send();
            } catch (Throwable) {
                // Saving is what was asked for and it happened. A notification
                // that will not send is not worth failing that over.
            }
        }

        self::installIconPack($data['icon_pack_file'] ?? null);

        /*
         * Last, and it covers everything above it.
         *
         * Every setting this method writes ends up in the stylesheet, which is
         * now built once and kept until this moves. One bump for the whole
         * save rather than one per value: the block is composed from all of
         * them together, so there is nothing finer to invalidate.
         *
         * After installIconPack() rather than before, because that has a stamp
         * of its own to bump and doing it in this order means one write to the
         * file instead of two.
         */
        Stamp::bump();

        // The same reason as on the modules page: a module switched on here
        // needs its tables before the page that uses them is asked for.
        Modules::arrive();

        self::installLanguage(
            $data['language_code'] ?? null,
            $data['language_file'] ?? null,
            $data['language_url'] ?? null,
        );

        /*
         * The language answer is held for the request, and this request is not
         * over: the settings page re-renders itself after saving, and without
         * this it would re-render in the language it had on the way in - so
         * switching your own language off would appear to have done nothing
         * until the next page load.
         */
        Languages::forget();

        // Same reason: the sidebar is redrawn in this request and would
        // otherwise redraw with the icon it had on the way in.
        NavIcon::forget();
    }

    /** @param  array<mixed, mixed>  $data */
    public static function persistLogin(array $data): void
    {
        Saved\Login::write($data);
    }

    /**
     * Move the pictures still on this panel to wherever files now go.
     *
     * Three settings and no more: the sidebar icon, the panel backdrop and the
     * sign-in backdrop. Those are the ones this plugin holds, one address each,
     * and between them every byte a visitor loads before they have signed in.
     *
     * Each is written through its own persister, because each belongs to a
     * different page and the big writer would take every key it did not see as
     * "put it back to the default".
     *
     * @return array{moved: int, looked: int, failed: int}
     */
    public static function moveFiles(): array
    {
        $keys = [
            'background_image' => (string) Theme::config('background_image', ''),
            'nav_icon' => (string) Theme::config('nav_icon', ''),
            'login_image' => (string) Theme::config('login_image', ''),
        ];

        $done = Uploads::move($keys);

        foreach ($done['moved'] as $key => $url) {
            match ($key) {
                'background_image' => (new self())->writeToEnvironment(['LEGEND_THEME_BG_IMAGE' => $url]),
                'nav_icon' => (new self())->writeToEnvironment(['LEGEND_THEME_NAV_ICON' => $url]),
                'login_image' => (new self())->writeToEnvironment(['LEGEND_THEME_LOGIN_IMAGE' => $url]),
                default => null,
            };
        }

        if ($done['moved'] !== []) {
            // What the cached stylesheet says a backdrop is at has just changed.
            Stamp::bump();
        }

        return [
            'moved' => count($done['moved']),
            'looked' => $done['looked'],
            'failed' => $done['failed'],
        ];
    }

    /** @return array<string, mixed> */
    public static function filesData(): array
    {
        return Saved\Files::read();
    }

    /** @param  array<mixed, mixed>  $data */
    public static function persistFiles(array $data): void
    {
        Saved\Files::write($data);
    }

    /**
     * Cross out an old switch whose answer has been carried into the features.
     *
     * One key, written on its own, and that is the whole point of it. The
     * carry-over used to do this through persist(), which writes the entire
     * settings block - every colour, every URL, every list - read out of the
     * configuration this process happens to hold. During an install that
     * process can be the queue worker, hours old, holding what it booted with.
     * Crossing out one key is not worth re-writing a hundred settings from an
     * hour-old copy, and doing so cost a panel its page-arranger setting twice
     * in one night.
     *
     * Not called persist*, deliberately: those are the settings pages' writers,
     * they are exported and imported as a set, and the gates in tools/ have
     * things to say about them that are true of a form and not of this.
     */
    public static function clearOldSwitch(string $key, string $to = 'true'): void
    {
        (new self())->writeToEnvironment([$key => $to]);
    }

    /**
     * Write the feature list and nothing else.
     *
     * Its own writer because the modules page carries no other setting, and
     * persist() would take every key it did not see as "put it back to the
     * default" - which is the trap SettingsPage documents at length and which
     * this page would walk straight into, having a form of no fields at all.
     *
     * The list arrives already computed. Features::withMany() decides what the
     * stored value becomes; this only puts it down and tells the panel to stop
     * believing the old one.
     *
     * The second argument is written by the installer once, and by nothing
     * else: see InstallTasks::firstChoice() for what it answers.
     */
    public static function persistFeatures(
        string $off,
        ?string $chosen = null,
        ?bool $fresh = null,
        ?bool $asked = null,
    ): void {
        $write = ['LEGEND_THEME_FEATURES_OFF' => $off];

        /*
         * And the three notes about how this panel came to have that list, when
         * the caller knows any of them. In the same write because two writes to
         * .env are two chances to end up with one of them and not the other,
         * and what matters is the pair.
         *
         * chosen: which release wrote a list here first, so an empty list stops
         *         meaning both "I wanted everything" and "nobody ever asked".
         * fresh:  whether that first write was on a panel that had never seen
         *         this plugin. Only those are offered the question, because
         *         asking a panel that has been selling for a year what it is
         *         for - and acting on the answer - is a way to switch off a
         *         shop somebody is using.
         * asked:  whether a person has answered it, or waved it away.
         */
        if ($chosen !== null) {
            $write['LEGEND_THEME_MODULES_CHOSEN'] = $chosen;
        }

        if ($fresh !== null) {
            $write['LEGEND_THEME_MODULES_FRESH'] = $fresh ? 'true' : 'false';
        }

        if ($asked !== null) {
            $write['LEGEND_THEME_MODULES_ASKED'] = $asked ? 'true' : 'false';
        }

        (new self())->writeToEnvironment($write);

        Features::changed($off);

        /*
         * And whatever the modules that are on need in order to work.
         *
         * Here rather than at install: a module that was just switched on has
         * no tables until something makes them, and the page that would make
         * them is the page it hides until they exist.
         */
        Modules::arrive();

        /*
         * And the stylesheet, because several of these are drawn by it. The
         * meters are recoloured there, the sidebar footer is painted there, and
         * the console button's bare form is part of the cached block's own key.
         * Switching one of those leaves a panel that is right in the settings
         * and wrong on the screen until the block is rebuilt.
         */
        Stamp::bump();
    }

    /** @return array<string, mixed> */
    public static function ticketsData(): array
    {
        return Saved\Tickets::read();
    }

    /** @param  array<mixed, mixed>  $data */
    public static function persistTickets(array $data): void
    {
        Saved\Tickets::write($data);
    }

    /** @param  array<mixed, mixed>  $data */
    public static function persistSystemStatus(array $data): void
    {
        Saved\SystemStatus::write($data);
    }

    /** @return array<string, mixed> */
    public static function statusData(): array
    {
        return Saved\Status::read();
    }

    /** @param  array<mixed, mixed>  $data */
    public static function persistStatus(array $data): void
    {
        Saved\Status::write($data);
    }

    /** @return array<string, mixed> */
    public static function alertsData(): array
    {
        return Saved\Alerts::read();
    }

    /** @param  array<mixed, mixed>  $data */
    public static function persistAlerts(array $data): void
    {
        Saved\Alerts::write($data);
    }

    /** @return array<string, mixed> */
    public static function apiData(): array
    {
        return Saved\Api::read();
    }

    /** @param  array<mixed, mixed>  $data */
    public static function persistApi(array $data): void
    {
        Saved\Api::write($data);
    }

    /** @return array<string, mixed> */
    public static function shopData(): array
    {
        return Saved\Shop::read();
    }

    /** The other half of text(): the newline markers become newlines again. */
    public static function unfold(mixed $value): string
    {
        return str_replace('\\n', "\n", is_string($value) ? $value : '');
    }

    /** @param  array<mixed, mixed>  $data */
    public static function persistShop(array $data): void
    {
        Saved\Shop::write($data);
    }

    /** @return array<string, mixed> */
    public static function artworkData(): array
    {
        return Saved\Artwork::read();
    }

    /** @param  array<mixed, mixed>  $data */
    public static function persistArtwork(array $data): void
    {
        Saved\Artwork::write($data);
    }

    /** @return array<string, mixed> */
    public static function loginData(): array
    {
        return Saved\Login::read();
    }

    /**
     * Below this, an accent stops being read and starts being guessed at.
     *
     * 3, which is WCAG's threshold for a user interface component rather than
     * the 4.5 it asks of body text. The accent paints buttons, borders, icons
     * and links here, not paragraphs, so 3 is the honest bar - holding it to
     * 4.5 would warn about accents that are perfectly usable.
     */
    private const CONTRAST_FLOOR = 3.0;

    /**
     * The preset to write, which is never the default just because the name was
     * not recognised.
     *
     * It used to be. `$name is known ? $name : Presets::DEFAULT` reads as a
     * sanitiser and behaves as a shredder, because of where the list of known
     * names comes from: the built-in presets, plus whatever
     * Presets::customRows() reads out of storage/app/private/legend-theme/presets.json -
     * and that reader answers every failure it meets with "there are no custom
     * presets". Unreadable file, unwritable disk, a permission changed by a
     * recovery command run as root: all of them, silently, the same answer.
     *
     * So a panel set to a style of its owner's making showed Ember, which is bad
     * enough on its own. Then the next save of any setting on any of the four
     * pages wrote Ember over it, and the style was gone rather than hidden -
     * turning a problem that would have ended when the file could be read again
     * into a permanent one.
     *
     * Keeping what is stored is right in both readings. A name this cannot place
     * is far more likely to be a file it could not read this second than a person
     * inventing one, because the picker has no field to invent it in.
     */
    private static function preset(mixed $preset): string
    {
        if (is_string($preset)
            && ($preset === Presets::NONE || in_array($preset, Presets::names(), true))) {
            return $preset;
        }

        // What .env already holds. Writing it back is a no-op, which is the
        // point: an unreadable list costs the panel its look until the list can
        // be read, and costs it nothing afterwards.
        $stored = Theme::config('preset', Presets::DEFAULT);

        return is_string($stored) && $stored !== '' ? $stored : Presets::DEFAULT;
    }

    /** @return array<string, mixed> */
    public static function systemStatusData(): array
    {
        return Saved\SystemStatus::read();
    }

    /**
     * The login screen, the one page a visitor sees signed out.
     *
     * Built in Fields\Doorway. The way in stays here so the pages that draw
     * these keep asking one class what a setting is and what it looks like.
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function loginSection(): array
    {
        return Doorway::fields();
    }

    /**
     * A translation file from somewhere else.
     *
     * https only, and bounded twice - by how long it may take and by how much
     * may come back. Both matter: this runs while somebody is waiting for a
     * settings page to save, and an address that answers slowly or endlessly
     * would hold the whole request rather than fail.
     *
     * No redirects followed. An address that answers with one is an address
     * pointing somewhere else, and following it would mean fetching from a host
     * nobody typed.
     */
    private static function fetchLanguage(string $url): ?string
    {
        if (!str_starts_with(strtolower($url), 'https://') || filter_var($url, FILTER_VALIDATE_URL) === false) {
            return null;
        }

        try {
            $response = Http::timeout(20)
                ->connectTimeout(5)
                ->withoutRedirecting()
                ->get($url);

            if (!$response->successful()) {
                return null;
            }

            $body = $response->body();

            return strlen($body) > Translations::MAX_BYTES ? null : $body;
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * Write an uploaded translation into the panel's override directory.
     *
     * Both halves or neither: a file with no code has nowhere to go, and a code
     * with no file is somebody who filled one box and left. Saying nothing in
     * that second case is deliberate - the field is on a page people save for
     * other reasons, and a complaint every time would be noise.
     */
    private static function installLanguage(mixed $code, mixed $file, mixed $url = null): void
    {
        if (is_array($file)) {
            $file = Arr::first($file);
        }

        $url = is_string($url) ? trim($url) : '';
        $uploaded = $file instanceof TemporaryUploadedFile;

        if ((!$uploaded && $url === '') || !is_string($code) || trim($code) === '') {
            return;
        }

        $code = trim($code);
        $decoded = null;

        try {
            /*
             * The upload wins over the address, the same way it does everywhere
             * else here: a file somebody just chose is the most recent thing
             * they did, and an address left in the box beside it is a field
             * they did not think to clear rather than a change of mind.
             */
            $contents = $uploaded ? $file->get() : self::fetchLanguage($url);

            if (is_string($contents) && $contents !== '') {
                $decoded = json_decode($contents, true);
            }
        } catch (Throwable) {
            $decoded = null;
        }

        if (!is_array($decoded) || $decoded === []) {
            Notification::make()
                ->title(Theme::trans('settings.languages.upload_failed'))
                ->body(Theme::trans('settings.languages.upload_failed_body'))
                ->danger()
                ->persistent()
                ->send();

            return;
        }

        // Anything thrown here fails the save, which is right: the alternative
        // is telling somebody their language was installed while the picker
        // will not have it.
        $result = Translations::install($code, $decoded);

        Languages::forget();

        Notification::make()
            ->title(Theme::choice('settings.languages.uploaded', $result['written'], [
                'code' => $code,
            ]))
            // Both halves, always. A file with all of one and none of the other
            // installs, works, and leaves half the panel untranslated - and a
            // single total says nothing about which half that was.
            ->body(Theme::trans('settings.languages.uploaded_halves', [
                'mine' => $result['mine'],
                'panel' => $result['panel'],
            ])
            // And the lines that already said what the panel says, which were
            // left alone. Without this a file of eight hundred lines with two
            // edits in it reports "2 strings installed" and looks broken.
            . ($result['same'] === 0 ? '' : ' ' . Theme::choice('settings.languages.uploaded_same', $result['same']))
            /*
             * And the lines that were left out, by name and with why. A file
             * with one misspelled key or one dropped :name installs and works,
             * and that string then says nothing or prints a colon; this is the
             * only moment anybody would find out.
             */
            . ($result['skipped'] === 0 ? '' : ' ' . Theme::choice('settings.languages.uploaded_skipped', $result['skipped'])
                . ' ' . implode('; ', array_slice($result['dropped'], 0, 5))))
            ->status($result['written'] === 0 || $result['skipped'] > 0 ? 'warning' : 'success')
            ->persistent()
            ->send();

        self::mirrorNow();
    }

    /**
     * Send the off-panel copy the moment a language arrives, rather than at the
     * next turn of the timer.
     *
     * A language that is here and not there is the window this closes. It is a
     * minute at most, and a minute is long enough to upload a translation and
     * then do the thing that loses it.
     *
     * It costs one request. The copy is sent per language and only when that
     * language has changed, so the thirty-odd that have not are hashed and
     * passed over. A failure is reported rather than thrown: the language is
     * installed either way, and the timer will try again.
     */
    private static function mirrorNow(): void
    {
        try {
            if (!Mirror::ready()) {
                return;
            }

            $done = Mirror::push();
        } catch (Throwable $exception) {
            report($exception);

            return;
        }

        if ($done['sent'] === 0 && $done['failed'] === 0) {
            return;
        }

        Notification::make()
            ->title(Theme::trans('settings.files.mirror_done'))
            ->body(Theme::trans('settings.files.mirror_done_body', [
                'looked' => (string) $done['looked'],
                'sent' => (string) $done['sent'],
                'failed' => (string) $done['failed'],
            ]))
            ->status($done['failed'] === 0 ? 'success' : 'warning')
            ->send();
    }

    /**
     * An uploaded icon pack, unpacked into storage. The zip itself is kept as
     * the upload rather than stored, so this is the only chance to read it.
     *
     * Failing here fails the save: the alternative is telling someone their
     * pack was accepted when the picker will still be empty.
     */
    private static function installIconPack(mixed $file): void
    {
        if (is_array($file)) {
            $file = Arr::first($file);
        }

        if (!$file instanceof TemporaryUploadedFile) {
            return;
        }

        $result = IconPacks::install($file);

        $left = array_sum($result['skipped']) + ($result['stopped'] === null ? 0 : 1);

        /*
         * Only when something was left behind.
         *
         * A pack that came in whole needs no notification - the save already
         * says it saved. This is for the case that used to pass in silence: a
         * zip that ran into one of the limits was installed as far as it got,
         * and the only symptom was a picker missing icons somebody knew they
         * had packed.
         */
        if ($left === 0) {
            return;
        }

        Notification::make()
            ->title(Theme::choice('settings.icons.pack_partial', $result['installed']))
            ->body(Theme::trans('settings.icons.pack_partial_body', [
                'big' => $result['skipped']['big'],
                'unusable' => $result['skipped']['unusable'],
                'duplicate' => $result['skipped']['duplicate'],
                'empty' => $result['skipped']['empty'],
            ]) . ($result['stopped'] === null
                ? ''
                : ' ' . Theme::trans('settings.icons.pack_stopped_' . $result['stopped'])))
            ->warning()
            ->persistent()
            ->send();
    }

}
