# Legend Development — a theme for Pelican Panel

A dark theme with a configurable accent for [Pelican Panel](https://pelican.dev),
built as an official Pelican plugin (`category: theme`). It covers all three
panels: the admin area, the server list and the client area.

- Six ready-made styles, or build your own from the same settings
- Everything configurable from inside the panel — no files to edit
- Dark by default; light still works, or force dark for everyone
- Mobile: bigger tap targets, safe-area padding for the iPhone home bar,
  buttons that stack instead of squeezing, tables that wrap
- Desktop: frosted topbar, accent bar on the active menu item, soft glow on
  primary buttons, tidy scrollbars

Pure CSS and a few lines of JavaScript. No Blade templates are overridden, so a
Pelican update cannot break the panel — at worst a selector stops matching.

## Quick start

1. **Admin → Plugins → Import**, pick the zip, then **Install**.
2. **Admin → Theme**, choose a **Style**, hit save. Done.

Everything below is optional.

## The folder must be named `legend-development-theme`

Pelican requires the folder under `plugins/` to match the `id` in `plugin.json`
exactly, and to be **entirely lowercase**. The second part is not in the docs but
follows from the code: `Plugin::getRows()` lowercases the id, and every path
lookup after that (`plugin_path()`) uses that value. A folder with capitals
passes the name check but the autoloader will then fail to find
`plugins/legend-development-theme/src/` on a Linux server.

If the name is wrong the panel shows the plugin as **errored** under the
*plugin* category instead of *theme*, with the mismatch as its description —
that is the fallback row `getRows()` builds when reading `plugin.json` throws.

## Installing

### Option 1 — import through the panel (easiest)

1. Build the zip:

   ```powershell
   .\build.ps1
   ```

   That produces `dist/legend-development-theme-<version>.zip`.

2. In the panel go to **Admin → Plugins → Import**, pick the zip, then click
   **Install**. The importer places the folder correctly based on the `id`. The
   panel then runs `yarn build`, which takes a minute or two.

Node and yarn have to be available on the panel host — a theme's CSS is compiled
into the panel's own Vite build. On a plain Debian/Ubuntu install:

```bash
curl -fsSL https://deb.nodesource.com/setup_22.x | sudo -E bash -
sudo apt-get install -y nodejs
sudo npm install -g yarn
sudo -u www-data yarn --version   # must print a version
```

### Option 2 — by hand on the server

```bash
cd /var/www/pelican/plugins
git clone https://github.com/L3G3CLAN/prlican-theame.git legend-development-theme
cd /var/www/pelican
php artisan p:plugin:install
```

After installing, the theme is **Enabled**. You can always switch it off again
under **Admin → Plugins**, and the panel falls back to its own look.

## Permissions

The plugin registers a **Legend Theme** section in the role editor
(**Admin → Roles → a role → Permissions**) with two checkboxes:

| Permission | What it grants |
| --- | --- |
| `view legendTheme` | Sees the **Theme** page in the admin area |
| `update legendTheme` | May save changes there |

With only *view*, the form renders disabled — look, but do not touch. Root Admin
has everything automatically.

The point of the separate page: the same settings are reachable through
Admin → Plugins → Settings, but that route needs the `plugin` permissions, and
anyone holding those can also install and delete plugins. These two permissions
hand over the panel's looks and nothing else.

Nothing needs seeding: Pelican creates the permission record itself the first
time a role is saved with the box ticked.

## Settings

**Admin → Theme**, or **Admin → Plugins → Legend Development → Settings**.

### Style

The first field. Picking a style fills in every setting below it, so it is a
starting point rather than a hidden layer — you can see exactly what it did and
change any part of it afterwards.

| Style | Look |
| --- | --- |
| None | Theme off. The panel renders exactly as Pelican ships it. |
| Ember | Warm near-black, orange accent, aurora backdrop |
| Midnight | Deep blue, thin icons, calm |
| Crimson | Red, sharp corners, compact rows, no frosted glass |
| Forest | Green, rounded, no glow |
| Nebula | Purple with a gradient backdrop, larger icons |
| Mono | Greyscale, flat and dense |

**None** is a real off switch: no stylesheet, no scripts, no colour registration.
Your settings stay where they are, so switching back restores them.

### Appearance

| Setting | Default | What it does |
| --- | --- | --- |
| Accent colour | `#ffa500` | Buttons, links, active menu item, focus rings |
| Surface colour | follows the theme | The cards and panels |
| Corners | Normal | Sharp, normal or round |
| Density | Comfortable | Compact tightens the spacing |
| Force dark mode | Off | Hides the light/dark switcher |
| Frosted topbar | On | Blur on the topbar and modal backdrops |
| Accent glow | On | Soft glow on primary buttons and navigation |

### Background

`Aurora` (the theme's own accent glows), `Single colour`, `Gradient` or `Image`.
For an image you can upload (up to 8 MB, stored on the `public` disk in
`storage/app/public/theme`) or give a URL; an upload wins. Dim defaults to 55% —
without it, white text on a bright photo is unreadable. Blur goes up to 24px.

Uploaded background staying black? The symlink is missing:

```bash
cd /var/www/pelican && sudo -u www-data php artisan storage:link
```

### Resource meters

The CPU, memory and disk bars on the server cards. Green by default (or the
accent colour), amber from 50% and red from 80%; both thresholds are settings.

Pelican colours these differently: `ServerEntryColumn::setUp()` uses `primary` as
the healthy colour — which is why every bar is the accent colour out of the box —
and `ListServers` chains the 0.7 and 0.9 thresholds onto the column *after*
`make()`, so `configureUsing()` cannot override them. The base colours are
therefore swapped server side, and the level itself is decided in the browser
([resources/js/bars.js](resources/js/bars.js)) from the percentage the bar already
carries. If that script finds no bars, Pelican's own colours simply stay.

### Icons

Line weight (thin/normal/bold), size (90–125%) and whether menu icons take the
accent colour. Below that you can replace individual icons: on the left part of
the menu item's link (`files`, `backups`, `console`, …), on the right a Tabler
name (`tabler-folder`). An unknown name leaves Pelican's own icon in place.

### Per area

Everything above applies everywhere; this section sets one area apart. Add a row
for **Terminal**, **Console** (the rest of that page), **Files page**, **Edit
page** or **Other server pages and tabs**, and give it its own accent, surface
colour, corner radius or density. Anything left empty keeps following the global
setting.

## How it works

| File | Role |
| --- | --- |
| `plugin.json` | The manifest Pelican reads (id, namespace, class, version constraint) |
| `src/ThemePlugin.php` | Filament plugin: colours and default theme mode per panel, and it registers the Theme page |
| `src/Providers/ThemeServiceProvider.php` | Hangs the stylesheet on the `STYLES_AFTER` render hook, plus the settings as CSS variables and the role permissions |
| `src/Filament/Admin/Pages/ThemeSettings.php` | The **Theme** page, behind the permissions above |
| `src/Support/Presets.php` | The ready-made styles |
| `src/Support/Settings.php` | The fields, the values and writing them — shared by the page and the plugin modal |
| `src/Support/Palette.php` | Builds a 50–950 ramp around the accent |
| `src/Support/Background.php` | CSS for a colour, gradient or image background |
| `src/Support/Bars.php` | Colours and thresholds for the resource meters |
| `src/Support/Icons.php` | Line weight, size and replacing individual menu icons |
| `src/Support/Areas.php` | Per-area overrides, plus the script that stamps the area |
| `src/Support/Theme.php` | Derives the plugin id from the install path, and holds the permission names |
| `resources/css/theme.css` | The theme itself |
| `resources/js/bars.js` | Decides the level of each resource meter |
| `config/legend-development-theme.php` | Defaults, read from `.env` |

A few decisions worth knowing about:

**The accent colour is exact.** Filament's own `Color::hex()` keeps only the
*hue* of the colour you give it and pins lightness and chroma to fixed values —
you get orange, but never `#ffa500`. `Palette` anchors your colour at shade 500
and derives the rest from it.

**No Tailwind in the stylesheet.** Vite treats `resources/css/theme.css` as its
own entry (the panel globs `plugins/*/resources/css/**/*.css`), so an
`@import 'tailwindcss'` would ship a second copy of the whole framework.
Filament's own styles live in cascade layers, and unlayered rules beat them
without a single `!important`.

**The id lives in one place.** `Theme::id()` reads the folder name from the
file's own path, and the config keys, translation keys and Vite path hang off
that. Renaming the plugin only means changing `plugin.json`, the folder and the
config filename. Permission names are deliberately a fixed literal — those are
stored against roles in the database, and renaming the folder must not silently
revoke what an administrator already granted.

**Icons are replaced with a mask.** Filament reads a page's navigation icon from
a static property on the page class, so a plugin cannot swap it through
configuration. What it can do is hide the rendered SVG's paths and mask the
element with a different icon, rendered server side through Blade Icons — the
same factory Pelican uses to validate icon names — and inlined as a data URI. The
replacement inherits `currentColor`, so hover and active states keep working.

**Areas are scoped custom properties.** The whole theme is variable driven, so an
area is nothing more than the same variables redeclared inside a narrower
selector. One catch is handled explicitly: a custom property is substituted where
it is *declared*, not where it is used, so tokens derived from the accent
(`--ld-border`, `--ld-tint`, `--ld-glow`) are written out again inside such a
scope. Which page belongs to which area is decided by a small inline script in
the head, which sets `data-ld-area` on `<html>` before first paint and updates it
on `livewire:navigated`.

## Developing

The theme leans on Filament's CSS variables (`--primary-*`, `--gray-*`) and the
`fi-*` classes. After changing the CSS or JS:

```bash
cd /var/www/pelican
sudo -u www-data yarn build
sudo -u www-data php artisan optimize:clear
```

Set `PANEL_PLUGIN_DEV_MODE=true` in `.env` to make plugin errors throw instead of
being logged away — a real time saver while building.

Your editor will complain about `config()` and `Filament\...` classes in this
repo: those come from the panel's `vendor/`, and a Pelican plugin deliberately
has no `composer.json` of its own. On the server the panel's autoloader resolves
them.

Settings are written to `.env` (`LEGEND_THEME_PRESET`, `LEGEND_THEME_ACCENT`, …)
and the config cache is cleared, so colours apply on the next request without a
rebuild. You can also set them by hand:

```dotenv
LEGEND_THEME_PRESET=ember
LEGEND_THEME_ACCENT="#ffa500"
LEGEND_THEME_RADIUS=normal
```

Quote the hex — unquoted, dotenv may read the `#` as the start of a comment. The
settings form does this for you.

## Requirements

- Pelican Panel `v1.0.0-beta35` or newer (Filament v5, Tailwind v4)
- Node and yarn on the panel host, because the CSS is built during installation

The constraint is `panel_version` in `plugin.json`. On an older beta the panel
reports the plugin as incompatible.

## Licence

GPL-3.0 — see [LICENSE](LICENSE).
