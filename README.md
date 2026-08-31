# Pelican Essentials

A dark theme and a set of panel additions for [Pelican Panel](https://pelican.dev),
built as an official plugin. It covers all three panels: the admin area, the
server list and the client area.

Pure CSS, a little JavaScript, and Filament's own APIs. **No Blade template is
overridden**, so a Pelican update cannot break the panel — at worst a selector
stops matching and you get Pelican's own look back.

Every part of it can be switched off, and every part has a permission of its own.

---

## What it does

### The look

| | |
| --- | --- |
| **Eleven styles** | Ember, Legend, Midnight, Crimson, Forest, Nebula, Terminal, Console, Nord, Solarized, Mono — each drawn in the picker with its own colours. Or **None**, which turns the theme off and leaves Pelican exactly as it ships |
| **Save your own** | Keep the settings you have as a named style, offered beside the built-in ones |
| **Colour and shape** | Any accent colour, a surface colour, corner rounding, spacing, frosted glass and accent glow — each on or off |
| **Lettering** | Default, monospace, rounded, serif or the system's. Nothing is fetched from a font host |
| **Background** | The theme's own aurora, a solid colour, a gradient, or your own picture with dim and blur |
| **Layout** | Sidebar, icon rail, top navigation, both, wide, or a narrow focused column. Set as a default — anyone who chose their own under Account keeps it |
| **Icons** | Line weight, size, accent colouring, a different icon set, and per-item overrides |
| **Per area** | Everything above applies everywhere; here you set one area apart — the terminal, the console, files, edit, server |
| **Custom CSS** | For whatever the settings do not cover. Loaded last, so it wins |

### What it adds to the panel

| | |
| --- | --- |
| **Announcements** | A bar across the top of the panel. Several of them, scheduled, dismissible, scoped to the admin or client area |
| **Navigation links** | Your own rows in the sidebar, with an icon fetched from the site the link points at |
| **Login screen** | Its own picture, width, blur, position, a line of text and links under the card |
| **Sidebar footer** | Your own line, the panel version, and one link — in the space Pelican leaves empty |
| **Dashboard block** | Which version is installed, whether one is waiting, a change log, and every machine: this panel and each node, with what it is using |
| **System status** | A page for the machine the panel itself runs on — processor, memory, swap, every filesystem, load, uptime and versions. Read from `/proc`, never a shell command |
| **Console button** | A floating button on every page inside a server, with the console and the power buttons, reaching the node directly |
| **Server list** | Card artwork, condition markers, height, and how many fit across a wide screen |
| **Page arranger** | Drag the blocks on any page into the order you want. Everyone can have their own, and administrators set the one everybody starts from |
| **Per-user styles** | Offer a few styles and let people pick their own. It changes what they see and nothing for anyone else |
| **Palworld settings** | Inside a Palworld server: its world settings as a form instead of an INI file. Read from the server's own file, and only editable while it is stopped |

### Keeping it

| | |
| --- | --- |
| **Updates** | Stable, beta or dev, with an update button, an optional automatic check, and a countdown to the next one |
| **Install a version** | Any release on the channel, not only the newest — for going back when something new turns out worse |
| **Export and import** | Every setting to a JSON file and back, saying what it would change before it changes it |

---

## Installing

**Requires** Pelican Panel `v1.0.0-beta35` or newer, and Node with yarn on the
panel host — a theme's CSS is compiled into the panel's own build.

```bash
curl -fsSL https://deb.nodesource.com/setup_22.x | sudo -E bash -
sudo apt-get install -y nodejs && sudo npm install -g yarn
```

### Through the panel

**Admin → Plugins → Import from URL**, and paste:

```
https://raw.githubusercontent.com/Legend-Develepment/prlican-theame/main/release/legend-development-theme.zip
```

That is the stable build, and the same address the plugin's own update check
reads — so installing this way and updating from inside the panel stay on the
same channel.

For beta, swap both `main` and the file name for `beta`:
`…/beta/release/legend-development-theme-beta.zip`.

The panel runs `yarn build` afterwards, which takes a minute or two.

> The **Releases** page carries `-dev` builds only. Those are cut from the
> working branch on every push and are not what to install unless you were
> asked to try one.

### On the server

```bash
cd /var/www/pelican/plugins
git clone https://github.com/Legend-Develepment/prlican-theame.git legend-development-theme
cd /var/www/pelican && php artisan p:plugin:install
```

> **The folder must be `legend-development-theme`, in lowercase.** Pelican
> requires it to match the `id` in `plugin.json`, and every path lookup uses the
> lowercased value — a folder with capitals passes the name check and then fails
> to autoload on a Linux server. The plugin is *called* Pelican Essentials; the
> id stays as it is because it is also the config and translation namespace, and
> renaming it would cost an uninstall and a reinstall to nobody's benefit.

Caches are cleared for you, at the end of an install and again when the plugin
is removed. Switching it off again under **Admin → Plugins** gives you Pelican's
own look back, with every setting kept.

---

## Where things are

Everything sits in one sidebar group named after the plugin:

| Row | Holds |
| --- | --- |
| **Essentials settings** | Updates, and which parts of the plugin are switched on |
| **Look** | Style, colour, shape, lettering, brand, background, icons, sidebar footer |
| **Pages** | Server list, server pages, console, resource meters |
| **Advanced** | Custom CSS and per-area overrides |
| **Announcements**, **Navigation links**, **Login screen**, **System status** | A page each |

The same settings are also under **Admin → Plugins → Pelican Essentials →
Settings**, in one modal.

## Permissions

**Admin → Roles → a role → Permissions → Legend Theme.**

That section is called Legend Theme, not Pelican Essentials, and stays that way
on purpose: Pelican names it from the permission model, and renaming that would
revoke every permission an administrator has already granted.

`View` and `Update` cover everything — see the settings, and save them. Beside
them is one permission per feature (Announcements, Links, Login, Meters,
Version, Machines, System, Footer, Palworld, and the three settings pages), for
handing out one part without handing over the rest. `Arrange` covers the page
arranger.

Granting a feature means being allowed to manage it. Root Admin has everything.

The separate page exists so that the panel's looks can be delegated without the
`plugin` permissions, which also allow installing and deleting plugins.

## Updating

**Essentials settings → Updates** picks the channel — **Stable**, **Beta**, or
**Dev** on a panel served from the development domain. Every feed address is
worked out from the stable one in `plugin.json`, so there is nothing to fill in.

Automatic updates are off by default. With them on, the block on the dashboard
counts down to the next check.

---

## Compatibility and reasoning

Why things are built the way they are — the panel's own APIs, what a theme can
and cannot reach, and what was tried and rejected — is in
[roadmap/](roadmap/). It is written to be argued with.

## Licence

Copyright © 2026 Legend Development.

GPL-3.0-or-later — see [LICENSE](LICENSE), which is the full GNU General Public
License version 3.

Pelican Panel itself is **AGPL-3.0**. Combining the two is allowed: AGPL-3.0
section 13 permits linking with GPLv3 work. Whether this plugin should be AGPL
too is a judgement rather than a requirement — AGPL is the licence written for
software people reach over a network, which is what a panel is.

Everything here is written for this plugin. No code from another plugin is in
it, including the two whose ideas it took: the system status page and the
Palworld settings page were both built from the source they read — `/proc` and
the game's own file format — rather than ported.
