<?php

/*
 * The filename must match the plugin id: Pelican loads this as
 * config('<id>') from plugins/<id>/config/<id>.php.
 */

return [
    /*
     * The selected look. 'none' turns the theme off entirely and leaves Pelican
     * as it ships; any other value is one of the presets in Support\Presets.
     */
    'preset' => env('LEGEND_THEME_PRESET', 'ember'),

    /*
     * How the panel is arranged, as opposed to what colour it is:
     *
     *   default  Pelican's own - a full sidebar, content held to a column
     *   rail     the sidebar as a rail of icons that opens when wanted
     *   top      no sidebar; the navigation runs across the top
     *   mixed    a topbar and the sidebar, Pelican's own third option
     *   wide     sidebar stays, content uses the whole screen
     *   focus    a narrow column, sidebar able to fold away entirely
     *
     * Applies to all three panels. Where the navigation goes is a default:
     * Pelican offers that per person under Account -> Navigation, and anyone
     * who has chosen there keeps their choice.
     */
    'layout' => env('LEGEND_THEME_LAYOUT', 'default'),

    /*
     * The sidebar: 'default', 'floating' (a card of its own), 'flat' (no chrome)
     * or 'bordered' (a line instead of a surface).
     */
    'nav_style' => env('LEGEND_THEME_NAV_STYLE', 'default'),

    /*
     * The topbar: 'default', 'floating' (a detached bar), 'flush' (flat, no
     * blur) or 'hidden' (gone on desktop; it always stays on a phone, where it
     * holds the only way back to the menu).
     */
    'topbar_style' => env('LEGEND_THEME_TOPBAR_STYLE', 'default'),

    /*
     * How cards are drawn: 'default', 'flat', 'outline', 'glass' or 'sharp'.
     * Applies to sections, widgets, server cards and the console's stat blocks.
     */
    'card_style' => env('LEGEND_THEME_CARD_STYLE', 'default'),

    /*
     * Accent colour of the panel. Any hex value works - the full 50..950 ramp is
     * built around it, see LegendDevelopment\Theme\Support\Palette.
     */
    'accent' => env('LEGEND_THEME_ACCENT', '#ffa500'),

    /*
     * Colour of the cards and panels. Empty follows the theme's own warm dark
     * surfaces; a hex value replaces them, with lighter and darker shades
     * derived from it.
     */
    'surface' => env('LEGEND_THEME_SURFACE', ''),

    /*
     * Corner rounding: 'sharp', 'normal' or 'round'.
     */
    'radius' => env('LEGEND_THEME_RADIUS', 'normal'),

    /*
     * Force dark mode. When false the panel defaults to dark, but users keep the
     * light/dark switcher in their user menu.
     */
    'force_dark' => env('LEGEND_THEME_FORCE_DARK', false),

    /*
     * Translucent, blurred topbar and modal backdrops.
     */
    'glass' => env('LEGEND_THEME_GLASS', true),

    /*
     * Accent glow on primary buttons, active navigation and the login card.
     */
    'glow' => env('LEGEND_THEME_GLOW', true),

    /*
     * 'comfortable' keeps Filament's default spacing, 'compact' tightens it so
     * more rows fit on screen.
     */
    'density' => env('LEGEND_THEME_DENSITY', 'comfortable'),

    /*
     * The panel's lettering: 'default' leaves Filament's own stack alone, and
     * mono, rounded, serif and system pick a family the operating system
     * already has. Nothing is fetched from a font host.
     */
    'font' => env('LEGEND_THEME_FONT', 'default'),

    /*
     * Page background: 'aurora' (the theme's own accent glows), 'solid',
     * 'gradient' or 'image'.
     */
    'background' => env('LEGEND_THEME_BACKGROUND', 'aurora'),

    'background_color' => env('LEGEND_THEME_BG_COLOR', '#14110e'),

    'background_color_end' => env('LEGEND_THEME_BG_COLOR_END', '#2b1c08'),

    'background_angle' => env('LEGEND_THEME_BG_ANGLE', '160'),

    /*
     * Uploaded image, stored on the public disk. Takes precedence over the URL.
     */
    'background_image' => env('LEGEND_THEME_BG_IMAGE', ''),

    'background_image_url' => env('LEGEND_THEME_BG_URL', ''),

    /*
     * How far the image is dimmed (0-90%) and blurred (0-24px). Without a dim,
     * white text on a bright photo is unreadable.
     */
    'background_dim' => env('LEGEND_THEME_BG_DIM', 55),

    'background_blur' => env('LEGEND_THEME_BG_BLUR', 0),

    /*
     * The server list. Whether the cards are a grid or a list is each person's
     * own choice under Account -> Dashboard layout; these decide how one card is
     * drawn, in either.
     *
     *   server_art       'faded' (a wash behind the text), 'cover' (across the
     *                    top of the card) or 'off'
     *   server_art_dim   how far the cover is darkened, 0-80
     *   server_status    where the condition colour goes: 'bar' down the left,
     *                    'edge' across the top, 'dot' in the corner, or 'off'
     *   server_density   'comfortable' or 'compact'
     *   server_columns   how many cards may sit across a wide screen: 2, 3 or 4.
     *                    Pelican's own maximum is 2.
     */
    'server_art' => env('LEGEND_THEME_SERVER_ART', 'faded'),

    'server_art_dim' => env('LEGEND_THEME_SERVER_ART_DIM', 35),

    'server_status' => env('LEGEND_THEME_SERVER_STATUS', 'bar'),

    'server_density' => env('LEGEND_THEME_SERVER_DENSITY', 'comfortable'),

    'server_columns' => env('LEGEND_THEME_SERVER_COLUMNS', '2'),

    /*
     * Whether Pelican's own filter button gets a label. The list is already
     * filterable by egg and by owner, server side and across every page, but
     * the way in is an unlabelled icon beside the search box.
     */
    'server_filter_label' => env('LEGEND_THEME_SERVER_FILTER_LABEL', true),

    /*
     * The floating console button on every page inside a server: 'full' (the
     * console and the power buttons), 'console' or 'off'.
     *
     * Pelican's own power buttons live on the console page because that page
     * holds the websocket they talk over. This bar posts straight to the node
     * instead - the route the server list already uses - so it works on files,
     * backups, schedules and the rest. It is never shown on the console page.
     */
    'server_controls' => env('LEGEND_THEME_SERVER_CONTROLS', 'full'),

    /*
     * Where the floating button sits: 'top', 'right' or 'bottom'. And whether
     * it wears its name: 'text' or 'icon'.
     */
    'server_controls_position' => env('LEGEND_THEME_SERVER_CONTROLS_POSITION', 'right'),

    'server_controls_label' => env('LEGEND_THEME_SERVER_CONTROLS_LABEL', 'text'),

    /*
     * The six blocks above the console: 'tiles' (label, figure and an icon),
     * 'plain' (as Pelican draws them) or 'off'. The terminal's own font, size
     * and height are each person's own choice under Account.
     */
    'console_stats' => env('LEGEND_THEME_CONSOLE_STATS', 'tiles'),

    /*
     * The terminal. These are handed to xterm rather than to the browser: the
     * console draws its glyphs to a canvas through the WebGL addon, so CSS
     * cannot reach them.
     *
     *   terminal_scheme      'theme' derives the colours from the accent, which
     *                        is why the interception exists. Any other value is
     *                        one of the schemes in Support\Terminal.
     *   terminal_cursor      'underline' (Pelican's own), 'block' or 'bar'
     *   terminal_blink       whether the cursor blinks
     *   terminal_scrollback  how many lines the buffer keeps. Held in the
     *                        browser, so it is memory on someone's machine.
     *
     * All three take effect when the terminal is built, which means on the next
     * page load rather than the moment they are saved.
     */
    'terminal_scheme' => env('LEGEND_THEME_TERMINAL_SCHEME', 'theme'),

    'terminal_cursor' => env('LEGEND_THEME_TERMINAL_CURSOR', 'underline'),

    'terminal_blink' => env('LEGEND_THEME_TERMINAL_BLINK', false),

    'terminal_scrollback' => env('LEGEND_THEME_TERMINAL_SCROLLBACK', '1000'),

    /*
     * How the terminal is drawn: 'webgl' (Pelican's own, and much faster on a
     * wall of scrolling output) or 'dom'.
     *
     * A browser keeps only so many GPU contexts alive at once - fewer on a
     * phone - and takes the oldest away when the limit is passed. The WebGL
     * renderer then draws nothing at all, with no error and with the terminal's
     * buffer, socket and geometry all still correct. 'dom' is slower and always
     * draws.
     */
    'terminal_renderer' => env('LEGEND_THEME_TERMINAL_RENDERER', 'webgl'),

    /*
     * Resource meters. 'green' keeps a healthy bar green, 'accent' uses the
     * accent colour for it. The thresholds are percentages: at or above the
     * warning level a bar turns amber, at or above the danger level red.
     */
    'bar_base' => env('LEGEND_THEME_BAR_BASE', 'green'),

    'bar_warning' => env('LEGEND_THEME_BAR_WARNING', 50),

    'bar_danger' => env('LEGEND_THEME_BAR_DANGER', 80),

    /*
     * Which releases the Theme page offers: 'stable', 'beta' or 'dev'.
     */
    'channel' => env('LEGEND_THEME_CHANNEL', 'stable'),

    /*
     * Whether new releases install themselves at all. Off leaves updating to
     * whoever presses the button.
     *
     * Unset it inherits from auto_update: before this switch existed, naming an
     * interval was how you turned it on.
     */
    'auto_update_enabled' => env('LEGEND_THEME_AUTO_UPDATE_ENABLED', null),

    /*
     * How often to look, when the switch above is on: 'minute', 'five_minutes',
     * 'ten_minutes', 'thirty_minutes', 'hourly', 'daily' or 'weekly'. Anything
     * else, 'off' included, falls back to daily - off is the switch's job, not
     * this one's.
     *
     * Runs on the scheduler Pelican already needs, so nothing extra has to be
     * set up - and does nothing at all if that cron is not running.
     */
    'auto_update' => env('LEGEND_THEME_AUTO_UPDATE', 'off'),

    /*
     * Where the beta feed lives. Empty works it out from update_url: the branch
     * becomes the beta branch and update.json becomes update-beta.json. Set it
     * only for a feed published somewhere that cannot be worked out.
     */
    'beta_url' => env('LEGEND_THEME_BETA_URL', ''),

    /*
     * Where the dev feed lives. Same derivation as beta. Dev builds are only
     * offered on panels served from the domain in Support\Channels::DEV_DOMAIN.
     */
    'dev_url' => env('LEGEND_THEME_DEV_URL', ''),

    /*
     * The page arranger. Off means no button for anyone and the endpoint it
     * saves to refuses as well - saved arrangements stay in place.
     */
    'arranger' => env('LEGEND_THEME_ARRANGER', true),

    /*
     * And whether anyone signed in may arrange their own pages, or only the
     * roles holding the arrange permission. Their arrangement is theirs alone;
     * setting the one everyone starts from stays with the permission.
     */
    'arranger_users' => env('LEGEND_THEME_ARRANGER_USERS', false),

    /*
     * Brand. The logo height applies everywhere it is rendered; leave the URL
     * empty to keep whatever Pelican's own settings point at.
     */
    'logo_height' => env('LEGEND_THEME_LOGO_HEIGHT', '2'),

    'logo_url' => env('LEGEND_THEME_LOGO_URL', ''),

    /*
     * The login screen. Without an image of its own it keeps showing the panel
     * background.
     */
    'login_image' => env('LEGEND_THEME_LOGIN_IMAGE', ''),

    'login_image_url' => env('LEGEND_THEME_LOGIN_URL', ''),

    'login_dim' => env('LEGEND_THEME_LOGIN_DIM', 45),

    'login_width' => env('LEGEND_THEME_LOGIN_WIDTH', '28'),

    'login_blur' => env('LEGEND_THEME_LOGIN_BLUR', 0),

    /*
     * Which part of the background picture survives being cropped to the
     * screen: center, top, bottom, left or right.
     */
    'login_position' => env('LEGEND_THEME_LOGIN_POSITION', 'center'),

    /*
     * Where the card sits across the screen: center, start or end.
     */
    'login_align' => env('LEGEND_THEME_LOGIN_ALIGN', 'center'),

    /*
     * How solid the card is over the picture behind it, 30 to 100.
     */
    'login_opacity' => env('LEGEND_THEME_LOGIN_OPACITY', 92),

    /*
     * The accent halo around the card. Off leaves the edge and the depth.
     */
    'login_glow' => env('LEGEND_THEME_LOGIN_GLOW', true),

    /*
     * Hide Filament's heading above the form, and Pelican's footer below it.
     */
    'login_hide_heading' => env('LEGEND_THEME_LOGIN_HIDE_HEADING', false),

    'login_hide_footer' => env('LEGEND_THEME_LOGIN_HIDE_FOOTER', false),

    /*
     * One line of text under the card. Plain text, at most 160 characters.
     */
    'login_above' => env('LEGEND_THEME_LOGIN_ABOVE', ''),

    'login_notice' => env('LEGEND_THEME_LOGIN_NOTICE', ''),

    /*
     * Per-area overrides on top of everything above, as
     * "area:key=value,key=value|area:...". Areas are terminal, console, files,
     * edit and server; keys are accent, surface, radius and density.
     */
    'areas' => env('LEGEND_THEME_AREAS', ''),

    /*
     * Icon line weight and size, applied to every icon in the panel.
     */
    'icon_stroke' => env('LEGEND_THEME_ICON_STROKE', '2'),

    'icon_scale' => env('LEGEND_THEME_ICON_SCALE', '1'),

    'icon_accent' => env('LEGEND_THEME_ICON_ACCENT', false),

    /*
     * Which set the icon picker draws from: the prefix of any icon set
     * registered with Blade Icons ('tabler', 'heroicon', ...) or 'custom' for a
     * pack of SVG files uploaded through the settings page. Empty picks Tabler,
     * which is the set Pelican's own icons come from.
     *
     * It only decides what the picker offers - saved icon names are fully
     * qualified, so changing this never repoints an icon already chosen.
     */
    'icon_pack' => env('LEGEND_THEME_ICON_PACK', ''),

    /*
     * Per menu item icon overrides as "match:icon|match:icon", where match is a
     * part of the item's link. Example: "files:tabler-folder|backups:tabler-box".
     */
    'icon_overrides' => env('LEGEND_THEME_ICONS', ''),

    /*
     * Which parts of the plugin are switched off, comma separated, from
     * announcements, nav_links, login, bars, dashboard_status, dashboard_nodes
     * and system_status. Empty leaves everything on.
     *
     * What is OFF rather than what is on, deliberately: a feature added in a
     * later release is absent from an existing list and so arrives switched on,
     * rather than being invisible to every panel that saved its settings before
     * that feature existed.
     *
     * The styling itself is not in here. It has its own off switch and always
     * has: set 'preset' to 'none' and the panel renders untouched.
     */
    'features_off' => env('LEGEND_THEME_FEATURES_OFF', ''),

    /*
     * How often that page reads again, in seconds, or 'off' to read only when
     * it is opened.
     */
    'system_status_refresh' => env('LEGEND_THEME_SYSTEM_REFRESH', '10'),

    /*
     * Which readings that page HIDES, comma separated, from cpu, memory,
     * swap, disk, load, uptime, system and version. Empty shows all of them.
     *
     * What is hidden rather than what is shown, for the same reason as
     * features_off above: a reading added in a later release is absent from an
     * existing list and so arrives shown. LEGEND_THEME_SYSTEM_BLOCKS was the
     * other way round and is no longer read.
     */
    'system_status_hidden' => env('LEGEND_THEME_SYSTEM_HIDDEN', ''),

    /*
     * Which nodes get a card of their own on that page, as ids, comma
     * separated. Empty shows none - the panel host is what the page is for, and
     * the dashboard already has a block that shows every node.
     */
    'system_status_nodes' => env('LEGEND_THEME_SYSTEM_NODES', ''),

    /*
     * The bottom of the sidebar, which Pelican leaves empty. All three are off
     * until they are filled in, so a panel that updates looks as it did.
     *
     *   footer_text        one line of your own, plain text, 120 characters
     *   footer_version     whether the panel's own version is shown
     *   footer_link_*      one link: a label, and an http/https address or a
     *                      path of the panel's own
     */
    'footer_text' => env('LEGEND_THEME_FOOTER_TEXT', ''),

    'footer_version' => env('LEGEND_THEME_FOOTER_VERSION', false),

    'footer_link_label' => env('LEGEND_THEME_FOOTER_LABEL', ''),

    'footer_link_url' => env('LEGEND_THEME_FOOTER_URL', ''),
];
