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
     * Resource meters. 'green' keeps a healthy bar green, 'accent' uses the
     * accent colour for it. The thresholds are percentages: at or above the
     * warning level a bar turns amber, at or above the danger level red.
     */
    'bar_base' => env('LEGEND_THEME_BAR_BASE', 'green'),

    'bar_warning' => env('LEGEND_THEME_BAR_WARNING', 50),

    'bar_danger' => env('LEGEND_THEME_BAR_DANGER', 80),

    /*
     * Which releases the Theme page offers: 'stable' or 'beta'.
     */
    'channel' => env('LEGEND_THEME_CHANNEL', 'stable'),

    /*
     * Where the beta feed lives. Empty derives it from update_url by swapping
     * update.json for update-beta.json; set it when betas are published from a
     * separate branch or host.
     */
    'beta_url' => env('LEGEND_THEME_BETA_URL', ''),

    /*
     * The page arranger. Off means no button for anyone and the endpoint it
     * saves to refuses as well - saved arrangements stay in place.
     */
    'arranger' => env('LEGEND_THEME_ARRANGER', true),

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
     * Per menu item icon overrides as "match:icon|match:icon", where match is a
     * part of the item's link. Example: "files:tabler-folder|backups:tabler-box".
     */
    'icon_overrides' => env('LEGEND_THEME_ICONS', ''),
];
