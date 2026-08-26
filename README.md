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
git clone https://github.com/Legend-Develepment/prlican-theame.git legend-development-theme
cd /var/www/pelican
php artisan p:plugin:install
```

After installing, the theme is **Enabled**. You can always switch it off again
under **Admin → Plugins**, and the panel falls back to its own look.

The plugin clears the panel's caches for you, at the end of an install and again
when it is uninstalled — no `php artisan optimize:clear` by hand. It uses the two
hooks Pelican offers for this: a seeder named after the plugin, which runs on
every install, and a migration whose `down()` runs when the plugin is removed.
Note that `optimize:clear` also flushes the application cache, so the panel
re-fetches things like egg and version data once afterwards.

## Updating

**Admin → Theme** shows the installed version under the title, and says so when
a newer one is out. The **Update** button next to it downloads it, rebuilds the
assets and clears the caches — your settings are kept. The same version marker
and update action appear on **Admin → Plugins**, because both use Pelican's own
mechanism rather than anything invented here.

### Channels

**Theme → Updates → Update channel** picks between **Stable** and **Beta**, plus
**Dev** on a panel served from the dev domain. The version line and the Update
button on the Theme page follow whichever is selected; the button on Admin →
Plugins always follows stable, because that one is Pelican's own and it has no
notion of channels.

Every feed is worked out from the stable one in `plugin.json`, branch included —
`…/main/update.json` becomes `…/beta/update-beta.json` and
`…/DEV/update-dev.json` — so **there is no address to fill in**, and no field
asking for one. The address in use is named under the channel picker.

**Dev** only appears on a panel served from the dev domain: the host in
`APP_URL`, or the one the page was requested on, has to be that domain or a
subdomain of it — `l3g3clan.nl`, `panel.l3g3clan.nl` and `server.l3g3clan.nl`
all count. Anywhere else the option is not offered, and a `.env` that names the
dev channel anyway falls back to stable. The domain is `DEV_DOMAIN` in
`src/Support/Channels.php`.

For a channel published somewhere this cannot work out, `LEGEND_THEME_BETA_URL`
and `LEGEND_THEME_DEV_URL` in `.env` still override the derived address. Saving
the settings form leaves them alone, and the address under the channel picker
shows which one is winning.

### Updating automatically

**Theme → Updates → Install updates automatically** installs new releases from
the selected channel on its own: hourly, daily at 04:00, or Monday at 04:00. Off
by default.

It rides on the scheduler Pelican already needs — the cron entry that runs
`php artisan schedule:run` — so there is nothing extra to set up, and nothing
happens at all if that cron is not running. The update runs on the queue, the
same way the button does, and the plugin comes back enabled if it was enabled.

### Publishing

Each channel is served from its own branch, so publishing to one leaves the
others exactly as they were:

| Channel | Branch | Manifest | Download |
| --- | --- | --- | --- |
| Dev | `DEV` | `update-dev.json` | `release/<id>-dev.zip` |
| Beta | `beta` | `update-beta.json` | `release/<id>-beta.zip` |
| Stable | `main` | `update.json` | `release/<id>.zip` |

The flow is dev first: build and commit on `DEV`, try it there, and only merge
to `beta` or `main` when it has earned it. A panel set to the dev channel finds
that branch on its own — the branch is part of what the feed address is derived
from, so nothing needs pointing anywhere.

**Every push to `DEV` leaves a release behind**, cut by
`.github/workflows/dev-release.yml`: it reads the version from `plugin.json`,
tags `v<version>-dev` and attaches the committed dev zip as a pre-release.
Pushing the same version again refreshes that zip instead of failing on a tag
that is taken, so a new dev release starts with a version bump. Beta and stable
releases stay manual — see below.

1. Bump `version` in `plugin.json`.
2. Build for the channel you are publishing to:

   ```powershell
   .\build.ps1          # stable: release/<id>.zip      + update.json
   .\build.ps1 -Beta    # beta:   release/<id>-beta.zip + update-beta.json
   .\build.ps1 -Dev     # dev:    release/<id>-dev.zip  + update-dev.json
   ```

   On Linux: `./build.sh`, `./build.sh --beta` and `./build.sh --dev`.
3. Commit and push the `release/` file and the manifest.

The two channels are separate files, so cutting a beta never changes what stable
panels are offered. Panels re-check at most every ten minutes.

Panels check `update.json` at most every ten minutes, so the button can take a
moment to appear.

**The update URL has to be publicly reachable.** Pelican fetches it with a plain
GET and no credentials, so a private repository will not work: the download
returns GitHub's login page instead of a zip. Either make the repository public,
or host `update.json` and the zip somewhere public — your own web server is
fine — and point `$publishBase` in `build.ps1` (and `publish_base` in
`build.sh`) at it, plus `update_url` in `plugin.json`.

## Permissions

The plugin registers a **Legend Theme** section in the role editor
(**Admin → Roles → a role → Permissions**) with three checkboxes:

| Permission | What it grants |
| --- | --- |
| `view legendTheme` | Sees the **Theme** page in the admin area |
| `update legendTheme` | May save changes there |
| `arrange legendTheme` | May rearrange pages with the page arranger |

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
| Legend | Fire red bleeding into electric blue, hard edges, bold icons |
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

### Arranging a page

Anyone with `arrange legendTheme` gets an **Arrange page** button in the bottom
corner of every panel page — provided the arranger is switched on under
**Theme → Brand**. Switching it off hides the button for everyone and closes the
endpoint it saves to; arrangements already saved keep applying.

It outlines the blocks that can be moved, gives each one a grip and an eye, and
rearranging happens on the page itself — what you drag is what you get. Save
applies it for everyone; Reset page clears it.

A layout is stored per page rather than per record, so arranging one server's
console arranges all of them. Record ids in the URL are folded away for that.

How it works: Filament stamps every schema block with a stable key
(`wire:partial="schema-component::form.APP_NAME"`, or a `wire:key` ending in that
same path) and those blocks are grid items — so a layout is an `order` per key,
which the server emits as plain CSS. Visitors run no JavaScript for this and
never see the blocks jump into place; the editor is the only scripted part.

Two limits worth knowing, both because this is CSS rather than markup:

- A block only moves **within the container it already sits in**. Moving one
  into a different column would mean overriding Pelican's own Blade, which is
  exactly what keeps this theme surviving panel updates.
- `order` changes the *visual* order. Keyboard focus and screen readers keep
  following the original one, so reordering a long form is worth thinking about.

Blocks without a stable key of their own get no grip. That is deliberate: a key
that cannot be matched again would produce a layout that silently does nothing.

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
| `src/Support/Runtime.php` | Inlines the head script below |
| `src/Support/Layouts.php` | Saved page arrangements, and the CSS that applies them |
| `src/Http/LayoutController.php` | The endpoint the arranger saves to |
| `resources/js/bars.js` | Decides the level of each resource meter |
| `resources/js/arrange.js` | The drag-and-drop page arranger |
| `resources/inline/runtime.js` | Stamps the area and themes the terminal |
| `config/legend-development-theme.php` | Defaults, read from `.env` |
| `database/Seeders/LegendDevelopmentSeeder.php` | Clears the panel caches after an install |
| `database/migrations/…_clear_caches.php` | Clears them again when the plugin is removed |

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

**The terminal is reached through JavaScript, the editor is not.** xterm renders
on a WebGL canvas, so CSS cannot touch its colours, and Pelican builds it inside
a Livewire script block that never exposes the instance — but it does build it
from the global `window.Xterm` bundle. So
[resources/inline/runtime.js](resources/inline/runtime.js) intercepts the
assignment of that bundle and swaps in a `Terminal` subclass that merges the
theme's colours in. The values come from custom properties, converted from oklch
to hex through a canvas — the one colour converter every browser already ships.
That script is inlined in the head and deliberately lives outside
`resources/js`, the directory Vite globs for entries: both of its jobs are races
it has to win.

Monaco was handled the same way at first, and that was a mistake. It styles
itself through `--vscode-*` custom properties, which is exactly the mechanism
this theme already uses, so the stylesheet can recolour it directly — no timing,
no interception, and nothing of ours in the code path that builds the editor.
Monaco injects its stylesheet at runtime, after this one, so those overrides
carry `!important`: a later rule of equal specificity, not a fight with inline
styles.

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

## Compatibility

Verified against `v1.0.0-beta38` and against `main` at 23 commits past it. Of the
files that changed upstream in between, the ones this theme touches changed only
in ways that do not reach it: the server card swapped `address` for
`display_address`, the Monaco view gained a `readOnly` option, and the panel
providers gained an unrelated render hook. Filament stayed on `^5.7`, and the
plugin manifest fields are unchanged.

Almost everything here rides on Filament's own `fi-*` classes and CSS variables,
which is why a panel update rarely matters. The exceptions are the handful of
Pelican internals below — worth a look after a big update, and each fails quietly
rather than breaking the page:

| What the theme uses | Where it lives upstream | If it changes |
| --- | --- | --- |
| Server card structure (a Livewire root whose first child is the condition bar) | `resources/views/livewire/server-entry.blade.php` | Cards fall back to Pelican's own look |
| `role="progressbar"` markup and its inline width | `resources/views/livewire/columns/progress-bar-column.blade.php` | Meters keep Pelican's colours |
| Bar colours and thresholds | `app/Filament/Components/Tables/Columns/{ServerEntryColumn,ProgressBarColumn}.php` | Base colours revert to the accent |
| `window.Xterm` being the global the console is built from | `resources/js/console.js` | Terminal keeps its own colours |
| Monaco's `--vscode-*` properties and `fme-*` wrappers | `resources/views/filament/components/monaco-editor.blade.php` | Editor keeps its blue-grey |
| `#terminal` and `#send-command` | `resources/views/filament/components/server-console.blade.php` | Console frame unstyled |
| The Vite globs over `plugins/*/resources/{css,js}` | `vite.config.js` | Stylesheet and scripts stop loading |
| Plugin manifest fields, `HasPluginSettings`, `Role::registerCustomPermissions` | `app/Models/Plugin.php`, `app/Contracts/Plugins`, `app/Models/Role.php` | Plugin fails to load — the panel reports it |

To check after an update, diff your version against the one this was verified
against and see whether any of those files appear:

```bash
gh api repos/pelican-dev/panel/compare/v1.0.0-beta38...v<your-version> \
  --paginate --jq '.files[].filename' | grep -E 'server-entry|progress-bar|console|monaco|vite.config|Plugin'
```

## Requirements

- Pelican Panel `v1.0.0-beta35` or newer (Filament v5, Tailwind v4)
- Node and yarn on the panel host, because the CSS is built during installation

The constraint is `panel_version` in `plugin.json`. On an older beta the panel
reports the plugin as incompatible.

## Licence

GPL-3.0 — see [LICENSE](LICENSE).
