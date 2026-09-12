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
     * Which styles people may choose for themselves, comma separated. Empty
     * means nobody chooses anything and the panel has one look, which is what a
     * panel that updates to this release keeps.
     *
     * What is ALLOWED rather than what is not, and that is the opposite of
     * features_off on purpose: a feature added later should arrive switched on,
     * a style added later should not arrive as something everyone may suddenly
     * repaint the panel with.
     */
    'user_themes' => env('LEGEND_THEME_USER_THEMES', ''),

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
    'card_style' => env('LEGEND_THEME_CARD_STYLE', 'glass'),

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
    'radius' => env('LEGEND_THEME_RADIUS', 'round'),

    /*
     * Force dark mode. When false the panel defaults to dark, but users keep the
     * light/dark switcher in their user menu.
     */
    'force_dark' => env('LEGEND_THEME_FORCE_DARK', true),

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

    'background_angle' => env('LEGEND_THEME_BG_ANGLE', '135'),

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

    'server_controls_label' => env('LEGEND_THEME_SERVER_CONTROLS_LABEL', 'icon'),

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
     * Where the dev feed lives. Empty reads it from the repository the dev
     * channel is published from, which is a private one of its own - see
     * Support\Channels::DEV_REPO - through the GitHub API, because a private
     * repository does not answer raw.githubusercontent.com. Dev builds are only
     * offered on panels served from the domain in Support\Channels::DEV_DOMAIN.
     */
    'dev_url' => env('LEGEND_THEME_DEV_URL', ''),

    /*
     * The token that repository is read with: the feed, the list of releases and
     * the download all go through it.
     *
     * A fine-grained personal access token with read access to the contents of
     * that one repository is enough, and is all it should have. Nothing else on
     * this panel uses it, and it is left out of an exported settings file for
     * the same reason the payment keys are: that file is made to be handed to
     * somebody else.
     *
     * Empty on every panel but the development one, where the dev channel is the
     * only thing that needs it.
     */
    'dev_token' => env('LEGEND_THEME_DEV_TOKEN', ''),

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
     * Asking a game server who is on it, which is the only thing in this
     * plugin that opens a socket of its own. Off unless switched on: whether
     * the panel can even reach a node's game port depends on how somebody's
     * network is arranged, and a feature that quietly tries and fails is
     * worse than one that was never turned on.
     */
    'minecraft_live' => env('LEGEND_THEME_MINECRAFT_LIVE', false),

    /*
     * Languages this plugin will not answer in, as a comma-separated list.
     *
     * What is off rather than what is on, so a translation added in a later
     * release arrives working instead of arriving invisible because it was not
     * in a list written before it existed.
     */
    'languages_off' => env('LEGEND_THEME_LANGUAGES_OFF', ''),

    /*
     * The language to answer in when a reader's own cannot be honoured - either
     * because this plugin does not carry it or because it has been switched
     * off. English unless somebody chooses otherwise.
     */
    'languages_main' => env('LEGEND_THEME_LANGUAGES_MAIN', 'en'),

    /*
     * What each language is called in the picker, as code=Label pairs. Empty
     * leaves every language with the name this plugin knows it by, or its code
     * when it does not know one.
     */
    'language_labels' => env('LEGEND_THEME_LANGUAGE_LABELS', ''),

    /*
     * Your own picture on the Essentials settings row, in place of the
     * tabler icon. A path on the public disk; empty means the icon this
     * plugin ships with.
     */
    'nav_icon' => env('LEGEND_THEME_NAV_ICON', ''),

    /*
     * Whether this plugin's language decision applies to the whole panel rather
     * than only to its own strings. On by default: the alternative is two
     * languages on one screen, which is what happens when a language is
     * switched off here and Pelican goes on speaking it.
     */
    'languages_panel' => env('LEGEND_THEME_LANGUAGES_PANEL', true),

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
     * IGDB, through Twitch, for egg artwork that is not on Steam.
     *
     * Empty by default and the feature says so rather than nagging: Steam needs
     * no credentials and covers most of a panel, so this is the half somebody
     * opts into.
     */
    'igdb_client_id' => env('LEGEND_THEME_IGDB_ID', ''),
    'igdb_client_secret' => env('LEGEND_THEME_IGDB_SECRET', ''),

    /*
     * The watchdog.
     *
     * How often it runs, which channels it uses, and where each threshold sits.
     * Email is the one channel that is off by default: a mailer that is not
     * configured fails silently, and silent is the one thing a watchdog may not
     * be.
     */
    'alert_every' => env('LEGEND_THEME_ALERT_EVERY', 'fifteen'),
    'alert_discord' => env('LEGEND_THEME_ALERT_DISCORD', false),
    'alert_webhook' => env('LEGEND_THEME_ALERT_WEBHOOK', ''),
    'alert_panel' => env('LEGEND_THEME_ALERT_PANEL', true),
    'alert_email' => env('LEGEND_THEME_ALERT_EMAIL', ''),
    'alert_repeat' => env('LEGEND_THEME_ALERT_REPEAT', 0),
    'alert_disk' => env('LEGEND_THEME_ALERT_DISK', 90),
    'alert_memory' => env('LEGEND_THEME_ALERT_MEMORY', 90),
    'alert_maintenance_hours' => env('LEGEND_THEME_ALERT_MAINTENANCE', 0),
    'alert_versions' => env('LEGEND_THEME_ALERT_VERSIONS', true),
    'alert_worker' => env('LEGEND_THEME_ALERT_WORKER', true),


    /*
     * And whether a job the queue gave up on is worth a message.
     *
     * Laravel records one and says nothing. What it recorded is a thing that
     * was supposed to happen and did not.
     */
    'alert_failed' => env('LEGEND_THEME_ALERT_FAILED', true),    /*
     * The public status page.
     *
     * Nothing here is public until a server has been named, and the list starts
     * empty - which is the whole opt-in, and cheaper than a second kind of
     * feature switch. Publish::enabled() is false while it is empty however the
     * feature itself is set.
     */
    'status_servers' => env('LEGEND_THEME_STATUS_SERVERS', ''),
    'status_nodes' => env('LEGEND_THEME_STATUS_NODES', ''),
    'status_user_pages' => env('LEGEND_THEME_STATUS_USER_PAGES', false),

    /*
     * How the public page looks.
     *
     * Its own accent rather than the panel's, because the two are read by
     * different people in different places: the panel is a tool your staff live
     * in, and this is a page in somebody's community. An empty accent follows
     * the panel, which is the sensible default and not a limitation.
     */
    /*
     * Which eggs answer Valve's server query.
     *
     * One list for Rust, ARK, Valheim, 7 Days to Die and everything else that
     * speaks it, rather than one per game: they all answer the same question
     * and the reply says which game it is.
     */
    'query_eggs' => env('LEGEND_THEME_QUERY_EGGS', ''),

    'status_every' => env('LEGEND_THEME_STATUS_EVERY', '1m'),
    'status_style' => env('LEGEND_THEME_STATUS_STYLE', 'panel'),
    'status_title' => env('LEGEND_THEME_STATUS_TITLE', ''),
    'status_note' => env('LEGEND_THEME_STATUS_NOTE', ''),
    'status_link' => env('LEGEND_THEME_STATUS_LINK', true),

    /*
     * A signed webhook of your own, for something that is not Discord - a bot
     * that would otherwise have to poll the API every minute to learn what the
     * watchdog already knows. Nothing is sent without a secret: the body is
     * hashed with it and the hash travels in a header, so the receiver can
     * refuse anything that did not come from this panel.
     */
    'alert_bot' => env('LEGEND_THEME_ALERT_BOT', false),
    'alert_bot_url' => env('LEGEND_THEME_ALERT_BOT_URL', ''),
    'alert_bot_secret' => env('LEGEND_THEME_ALERT_BOT_SECRET', ''),

    'alert_backups' => env('LEGEND_THEME_ALERT_BACKUPS', false),
    'alert_backup_days' => env('LEGEND_THEME_ALERT_BACKUP_DAYS', 7),

    /*
     * The API - see roadmap/api.md. Note what is not here: no key and no
     * secret. Those are rows in essentials_api_keys, hashed, because a token
     * in .env is a token in every settings export and every backup of one.
     *
     * 'api_approval' on means a person's request waits for somebody to say yes.
     * On by default: a panel where anybody mints themselves a key the moment
     * they sign in is a reasonable thing to want and a bad thing to arrive at
     * without having chosen it.
     *
     * 'api_rate' is requests a minute per key, and 'api_days' is how long a
     * granted key lasts - zero meaning until it is revoked, which is the honest
     * default. A key that expires while nobody is watching is a bot that stops
     * overnight with no message anywhere saying why.
     */
    'api_approval' => env('LEGEND_THEME_API_APPROVAL', true),

    /*
     * Whether Pelican's own API keys tab is hidden from the account profile.
     *
     * Off by default. It hides rather than removes - Pelican offers no way to
     * take a tab off that page, so this is a stylesheet rule and the keys, the
     * address and the API behind them all keep working exactly as before.
     */
    'api_hide_pelican' => env('LEGEND_THEME_API_HIDE_PELICAN', false),
    'api_rate' => env('LEGEND_THEME_API_RATE', 60),
    'api_days' => env('LEGEND_THEME_API_DAYS', 0),

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
     * Which eggs are Minecraft, as a comma-separated list of ids.
     *
     * Empty by default and deliberately so. A plugin cannot know what somebody
     * has called their Paper egg, and a guessed list would be wrong on a panel
     * the week it shipped - so the Minecraft page appears on nothing until an
     * administrator says which eggs it is for.
     */
    'minecraft_eggs' => env('LEGEND_THEME_MINECRAFT_EGGS', ''),

    /*
     * Which eggs are ARK, as a comma-separated list of ids.
     *
     * Empty by default, like the Minecraft one and for the same reason. This
     * list is asked separately from the one that decides who answers Valve's
     * query, and the difference matters: that question is "does this speak
     * A2S", which Rust and Valheim also do, and this one is "does this keep
     * GameUserSettings.ini where ARK keeps it", which only ARK does.
     */
    /*
     * Whether the watchdog reports a scheduled task that has stopped.
     *
     * Off by default like every other check: this one reads every active
     * schedule on the panel on each run, and a panel that installs the plugin
     * and changes nothing should not start doing that on its own.
     */
    'alert_schedules' => env('LEGEND_THEME_ALERT_SCHEDULES', false),

    /*
     * Whether the shop owner is told when a package runs out.
     *
     * Off by default like every other check. It costs one query per pass and
     * only reads packages that have a cap at all, so a shop selling nothing
     * with a limit on it pays for an empty result and nothing else.
     */
    'alert_stock' => env('LEGEND_THEME_ALERT_STOCK', false),

    /*
     * How few are left before that counts as nearly sold out.
     *
     * Nought is a number here and not an absence: it says to keep quiet until a
     * package is actually gone. The warning is worth having above that, because
     * it is the only one of the two that arrives while there is still something
     * the owner can do about it.
     */
    'alert_stock_left' => env('LEGEND_THEME_ALERT_STOCK_LEFT', 3),

    /*
     * Whether the owner of a server is told when its machine stops answering.
     *
     * Off by default, and more firmly than the rest: every other check here
     * writes to whoever configured it, and this one writes to the people whose
     * servers are on the panel. That is a decision somebody makes rather than
     * one they arrive at by installing a plugin.
     */
    'alert_owners' => env('LEGEND_THEME_ALERT_OWNERS', false),

    /*
     * Languages offered despite not being translated far enough, comma
     * separated.
     *
     * Its own value rather than a flag on languages_off, because that one
     * records what is switched off - so "never touched" and "deliberately on"
     * are the same value in it and a threshold cannot tell them apart. Empty on
     * every panel that has not made an exception, which is most of them.
     */
    'languages_partial' => env('LEGEND_THEME_LANGUAGES_PARTIAL', ''),

    'ark_eggs' => env('LEGEND_THEME_ARK_EGGS', ''),

    /*
     * Which eggs are Valheim, as a comma-separated list of ids.
     *
     * Same again. Where the three name lists live is worked out per server by
     * trying the known locations, because that depends on how the egg starts
     * the game rather than on which egg it is.
     */
    'valheim_eggs' => env('LEGEND_THEME_VALHEIM_EGGS', ''),

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

    /*
     * Which mode the panel opens in: 'dark', 'light' or 'system' to follow the
     * visitor's own machine.
     *
     * Its own setting since 2.47. It used to be half of force_dark, which chose
     * the mode and removed the switcher in one toggle - fine while the plugin
     * was only ever a dark theme, and in the way of a light style. force_dark
     * now only locks; this picks.
     */
    'theme_mode' => env('LEGEND_THEME_MODE', 'dark'),

    /*
     * The shop. One currency for every price, a tax rate in basis points
     * (2100 is twenty-one percent), how invoices are numbered, when a renewal
     * is invoiced and how long an unpaid one is tolerated before the server
     * is suspended, and the words on the public page.
     *
     * No payment provider keys here yet; those arrive with the providers and
     * are the half of these settings that never leaves the panel.
     */
    'shop_currency' => env('LEGEND_THEME_SHOP_CURRENCY', 'EUR'),
    'shop_tax' => env('LEGEND_THEME_SHOP_TAX', 0),
    'shop_invoice_prefix' => env('LEGEND_THEME_SHOP_PREFIX', 'INV-'),
    'shop_notice_days' => env('LEGEND_THEME_SHOP_NOTICE', 7),
    'shop_grace_days' => env('LEGEND_THEME_SHOP_GRACE', 7),
    'shop_heading' => env('LEGEND_THEME_SHOP_HEADING', ''),
    'shop_note' => env('LEGEND_THEME_SHOP_NOTE', ''),
    'shop_terms_url' => env('LEGEND_THEME_SHOP_TERMS', ''),


    /*
     * Who is issuing the invoice.
     *
     * The document said config('app.name') and the panel's address, and that is
     * not an invoice - it is a receipt. A business selling in the Netherlands
     * has to put its name, its address, its VAT number and its Chamber of
     * Commerce number on one, and the same is broadly true across the EU. A
     * customer's accountant will ask for exactly these.
     *
     * Empty falls back to the panel's name, so a panel that has not filled this
     * in looks the way it always did rather than printing blanks.
     */
    'shop_company_name' => env('LEGEND_THEME_SHOP_COMPANY', ''),

    /*
     * The address, as it should be printed. Written as lines rather than as
     * street, number, postcode and city in four fields, because every country
     * orders those differently and a form that insists on one order is a form
     * somebody has to fight.
     */
    'shop_company_address' => env('LEGEND_THEME_SHOP_ADDRESS', ''),

    'shop_company_vat' => env('LEGEND_THEME_SHOP_VAT', ''),

    'shop_company_coc' => env('LEGEND_THEME_SHOP_COC', ''),

    'shop_company_email' => env('LEGEND_THEME_SHOP_EMAIL', ''),

    /*
     * And which country it sells from, as a two-letter code.
     *
     * Not decoration: it is what decides whether a customer's VAT number is a
     * foreign one, and so whether the tax on their invoice is theirs to account
     * for rather than yours to charge. Empty means that question is never asked.
     */
    'shop_company_country' => env('LEGEND_THEME_SHOP_COUNTRY', ''),

    /*
     * How long somebody has to pay a new order's invoice.
     *
     * Zero is what this shop did before the setting existed: the invoice is
     * due the moment it is written. A number of days is what "within 14 days"
     * means on a document, and nothing about the server waits on it either way
     * - an order is built when it is paid, not when it is due.
     *
     * Renewals are not affected. Those are due on the day the service renews,
     * and how far ahead they are sent is shop_notice_days.
     */
    'shop_due_days' => env('LEGEND_THEME_SHOP_DUE_DAYS', 0),

    /*
     * Whether the price on a package already contains the tax.
     *
     * Off is what this shop has always done: a package costs what it says and
     * the tax is added at the till. On means the price on the card is what
     * somebody pays, with the tax inside it - which is what a shop selling to
     * consumers in the EU has to show, and what a shop selling to businesses
     * generally must not.
     *
     * Nothing about the package changes when this is switched. The number
     * typed on the packages page is the price; this decides whether the tax is
     * on top of it or already in it.
     */
    'shop_tax_inclusive' => env('LEGEND_THEME_SHOP_TAX_INCLUSIVE', false),

    /*
     * Whether a customer's VAT number is checked against the union's own
     * register before the tax comes off their invoice.
     *
     * On, and a number has to exist as well as be shaped correctly -
     * NL999999999B01 is a perfectly well-formed number belonging to nobody.
     * Off, a well-formed number is taken at its word, which is a decision to
     * trust customers with your own VAT liability.
     *
     * When the register cannot be reached the tax is charged either way. An
     * outage must not become a discount, and an invoice can be credited
     * afterwards while VAT cannot always be got back.
     */
    'shop_vat_check' => env('LEGEND_THEME_SHOP_VAT_CHECK', true),

    /*
     * What the pay page says when there is no provider switched on - a panel
     * taking bank transfers has somewhere to write its own instructions.
     */
    'shop_pay_note' => env('LEGEND_THEME_SHOP_PAY_NOTE', ''),

    /*
     * Where a ticket is actually answered: 'panel' or 'modora'.
     *
     * The panel's own is the fallback whenever the other is not usable, so a
     * key that stops working turns questions into panel tickets rather than
     * into an error page.
     */
    'tickets_via' => env('LEGEND_THEME_TICKETS_VIA', 'panel'),

    /* An integration key from Modora, with the five scopes this plugin uses. */
    'tickets_modora_key' => env('LEGEND_THEME_TICKETS_MODORA_KEY', ''),

    /* Which of their ticket panels to open on. Empty lets Modora choose. */
    'tickets_modora_panel' => env('LEGEND_THEME_TICKETS_MODORA_PANEL', ''),

    /*
     * The random part of the address Modora posts events to.
     *
     * The address is the credential: there is no request signature to check, so
     * knowing the address is what proves the caller is Modora. Made on the
     * tickets page, and making a new one is how the old address is revoked.
     */
    'tickets_hook_secret' => env('LEGEND_THEME_TICKETS_HOOK_SECRET', ''),

    /*
     * Whether a customer may start a new ticket.
     *
     * Off closes the intake and leaves every conversation already going exactly
     * where it is: people can still read and reply to what they opened. Ending
     * the ones in progress as well would be a different decision, and not one
     * a switch about a button should quietly make for somebody.
     */
    'tickets_open' => env('LEGEND_THEME_TICKETS_OPEN', true),

    /*
     * And whether the corner of every page carries a way to reach it.
     *
     * Its own switch rather than a consequence of the one above: a panel can
     * want the page without a button following people around, and that is a
     * question about the furniture rather than about the feature.
     */
    'tickets_button' => env('LEGEND_THEME_TICKETS_BUTTON', true),

    /*
     * Where every file this plugin keeps is put: 'panel', 's3' or 'cdn'.
     *
     * The panel's own disk is the default and needs nothing. The other two are
     * for a panel that would rather not hold this much, or that has a CDN in
     * front of one already.
     *
     * A destination that will not answer falls back to the panel's own disk
     * rather than losing the file. A misconfigured setting is a thing to fix;
     * somebody's upload is not a thing to lose over it.
     */
    'files_where' => env('LEGEND_THEME_FILES_WHERE', 'panel'),

    /*
     * Where those files are read from, which is not always where they were
     * written to. A CDN in front of a bucket is exactly this setting, and so is
     * a delivery host that differs from the API host - which is the ordinary
     * arrangement rather than an odd one. Empty lets each destination work its
     * own address out.
     */
    'files_read_from' => env('LEGEND_THEME_FILES_READ_FROM', ''),

    /*
     * An S3-compatible bucket. Anything speaking the protocol works: AWS,
     * Cloudflare R2, Backblaze, Wasabi, MinIO. The endpoint and the path-style
     * switch are what the ones that are not AWS need.
     */
    'files_s3_key' => env('LEGEND_THEME_FILES_S3_KEY', ''),
    'files_s3_secret' => env('LEGEND_THEME_FILES_S3_SECRET', ''),
    'files_s3_region' => env('LEGEND_THEME_FILES_S3_REGION', 'auto'),
    'files_s3_bucket' => env('LEGEND_THEME_FILES_S3_BUCKET', ''),
    'files_s3_endpoint' => env('LEGEND_THEME_FILES_S3_ENDPOINT', ''),
    'files_s3_path_style' => env('LEGEND_THEME_FILES_S3_PATH_STYLE', false),

    /*
     * Or a CDN speaking the Modora API: a base address, a server-to-server
     * token, and a folder under the account to keep this panel's files in so
     * one CDN can serve several panels without them treading on each other.
     */
    'files_cdn_base' => env('LEGEND_THEME_FILES_CDN_BASE', 'https://cdn.modora.xyz'),
    'files_cdn_token' => env('LEGEND_THEME_FILES_CDN_TOKEN', ''),
    'files_cdn_folder' => env('LEGEND_THEME_FILES_CDN_FOLDER', 'panel'),

    /*
     * How often the off-panel copy of an uploaded language is looked at, in
     * minutes.
     *
     * Looked at rather than sent: each one is hashed and compared with what was
     * last sent, so the ordinary pass reads a few files and stops. A minute is
     * therefore an affordable interval, which is why it is the default.
     */
    'files_mirror_minutes' => env('LEGEND_THEME_FILES_MIRROR_MINUTES', 1),

    /*
     * Whether the shop is the first thing somebody sees.
     *
     * Off by default, and that is not timidity: switching this on moves the
     * panel's landing page, and doing that to every panel that installs an
     * update is the kind of surprise nobody thanks you for. One toggle on the
     * shop settings page turns it on for the panel that wants it.
     */
    'shop_landing' => env('LEGEND_THEME_SHOP_LANDING', false),

    /*
     * Whether a customer may end their own service. Off by default: on a panel
     * that would rather be asked first, a cancel button is a support
     * conversation somebody skipped.
     */
    'shop_self_cancel' => env('LEGEND_THEME_SHOP_SELF_CANCEL', false),

    /*
     * Whether a customer may put several things in a basket and buy them on one
     * invoice.
     *
     * Off unless it is switched on, and that is not caution for its own sake: a
     * shared invoice is a shared debt, so an unpaid one suspends every service
     * on it, and a shop that starts doing that without anybody deciding to is a
     * shop that surprises its customers. Off, the shop sells one package at a
     * time exactly as it always has.
     */
    'shop_basket' => env('LEGEND_THEME_SHOP_BASKET', false),

    /*
     * Mollie.
     *
     * The switch travels in an exported settings file; the key does not - see
     * Portable::EXCLUDED. A settings file is made to be handed to somebody
     * else, and a payment key in one is a credential leaked by a feature that
     * was trying to be helpful.
     */
    'shop_mollie_on' => env('LEGEND_THEME_SHOP_MOLLIE_ON', false),
    'shop_mollie_key' => env('LEGEND_THEME_SHOP_MOLLIE_KEY', ''),

    /*
     * Stripe.
     *
     * Two secrets rather than one: the API key opens sessions, and the webhook
     * signing secret is what proves an event came from Stripe. They are
     * different values from different pages of their dashboard, and neither
     * travels in an exported settings file.
     */
    'shop_stripe_on' => env('LEGEND_THEME_SHOP_STRIPE_ON', false),
    'shop_stripe_key' => env('LEGEND_THEME_SHOP_STRIPE_KEY', ''),
    'shop_stripe_hook' => env('LEGEND_THEME_SHOP_STRIPE_HOOK', ''),

    /*
     * PayPal.
     *
     * Three secrets and a sandbox switch. The switch travels in an exported
     * settings file - it is a choice, not a credential - and the other three
     * do not, for the same reason as every key above.
     */
    'shop_paypal_on' => env('LEGEND_THEME_SHOP_PAYPAL_ON', false),
    'shop_paypal_sandbox' => env('LEGEND_THEME_SHOP_PAYPAL_SANDBOX', false),
    'shop_paypal_id' => env('LEGEND_THEME_SHOP_PAYPAL_ID', ''),
    'shop_paypal_secret' => env('LEGEND_THEME_SHOP_PAYPAL_SECRET', ''),
    'shop_paypal_hook' => env('LEGEND_THEME_SHOP_PAYPAL_HOOK', ''),
];
