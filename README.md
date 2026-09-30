# Essentials

A dark theme and a set of panel additions for [Pelican Panel](https://pelican.dev).
It covers all three panels: the admin area, the server list and the client area.

> **A community plugin by Legend Development.** It is not made, maintained or
> endorsed by the Pelican team, and nothing here is part of Pelican itself.

Pure CSS, a little JavaScript, and Filament's own APIs. **No Blade template is
overridden**, so a Pelican update cannot break the panel - at worst a selector
stops matching and you get Pelican's own look back.

Every part of it can be switched off, and every part has a permission of its own.

---

## What it does

### The look

| | |
| --- | --- |
| **Thirteen styles** | Ember, Legend, Midnight, Crimson, Forest, Nebula, Terminal, Console, Nord, Solarized, Mono, and two for light mode - Paper and Daylight. Each is drawn in the picker with its own colours. Or **None**, which turns the theme off and leaves Pelican exactly as it ships |
| **Save your own** | Keep the settings you have as a named style, offered beside the built-in ones |
| **Colour and shape** | Any accent colour, a surface colour, corner rounding, spacing, frosted glass and accent glow - each on or off |
| **Lettering** | Default, monospace, rounded, serif or the system's. Nothing is fetched from a font host |
| **Background** | The theme's own aurora - accent glows over a colour of your choosing - or a solid colour, a gradient, or your own picture with dim and blur. All four work in light mode as well as dark |
| **Timed looks** | A different style between two times of day, optionally on chosen days. It changes nothing that is saved, and a style somebody picked for themselves still wins over it |
| **Layout** | Sidebar, icon rail, top navigation, both, wide, or a narrow focused column. Set as a default - anyone who chose their own under Account keeps it |
| **Icons** | Line weight, size, accent colouring, a different icon set, and per-item overrides |
| **Per area** | Everything above applies everywhere; here you set one area apart - the terminal, the console, files, edit, server |
| **Custom CSS** | For whatever the settings do not cover. Loaded last, so it wins |
| **Live preview** | A card, a button and three meters beside the Look form, drawn by the same stylesheet as the panel from the settings on the page rather than the saved ones. Or the whole panel, from settings you have not saved yet |
| **Readability** | The accent picker says how legible the colour will be, measured on the shade the panel actually paints rather than on the one you typed |

### What it adds to the panel

| | |
| --- | --- |
| **Announcements** | A bar across the top of the panel. Several of them, scheduled, dismissible, scoped to the admin or client area |
| **Navigation links** | Your own rows in the sidebar, with an icon fetched from the site the link points at |
| **Login screen** | Its own picture, width, blur, position, a line of text and links under the card |
| **Sidebar footer** | Your own line, the panel version, and one link - in the space Pelican leaves empty |
| **Dashboard block** | Which version is installed, whether one is waiting, a change log, and every machine: this panel and each node, with what it is using |
| **System status** | A page for the machine the panel itself runs on - processor, memory, swap, every filesystem, load, uptime and versions. Read from `/proc`, never a shell command |
| **Console button** | A floating button on every page inside a server, with the console and the power buttons, reaching the node directly |
| **Server list** | Card artwork, condition markers, height, and how many fit across a wide screen |
| **Starred servers** | A star on each card, starred ones first. Kept in each person's own browser - nothing reaches the panel and it changes what they see and nobody else |
| **Duplicate a server** | Another server set up exactly like one you have, or several at once with numbered names. The free addresses on its node are found for you. Files, databases, backups and schedules are never copied |
| **Settings search** | A box above the settings forms that narrows the page to the sections holding what you type |
| **Page arranger** | Drag the blocks on any page into the order you want. Everyone can have their own, and administrators set the one everybody starts from |
| **Per-user styles** | Offer a few styles and let people pick their own. It changes what they see and nothing for anyone else |
| **Palworld settings** | Inside a Palworld server: its world settings as a form instead of an INI file. Read from the server's own file, and only editable while it is stopped |
| **Minecraft** | `server.properties` as a form, the four name lists as one table, a modpack installer, and a mod and plugin browser reading Modrinth. Optionally a live list of who is connected |
| **ARK, Terraria, Valheim** | ARK's `GameUserSettings.ini` and Terraria's `serverconfig.txt` as forms, and Valheim's admin, ban and permitted lists. All of them keep the rest of the file exactly as it was - your mod settings, the comments, the order of all of it. Terraria's page is read from the file rather than from a list, so it shows every setting the game understands rather than the ones somebody had time to write down |
| **Players, other games** | Who is connected to Rust, ARK, Valheim and anything else answering Valve's query, and how long they have been on |
| **Alerts** | A check on a timer for what the panel measures and tells nobody: a node that stopped answering, a disk filling up, a queue worker that died, a version falling behind. To Discord, the panel, or email |
| **Backups overview** | Every server by how long it has gone without one, the ones with none at the top. The inverse of Pelican's own page, which shows one server its own backups |
| **Panel activity** | Every logged event across the panel, newest first, with who did it and on which server. Pelican keeps this log and shows it one server at a time |
| **Public status page** | A page anybody can open without an account, showing which of your servers, machines and services are up. Nothing is published until you name something. Each person can have one of their own at an address they choose |
| **Servers by role** | Tie a role to servers and everyone holding it reaches them, kept true in Pelican's own subuser table. Losing the role loses the servers on the very next page |
| **Egg artwork** | A page listing every egg and a way to give each one its game's picture: from the Essentials artwork library, Steam or IGDB, or a file you upload. SVG, GIF and BMP are stored as WebP, so any picture works. A shop package with no picture of its own shows the same artwork |
| **Go to menu** | One control at the top of every page for jumping to a server or a starred page, with a search over your whole server list |
| **API** | An address outside the panel for what this plugin knows, behind a key. It cannot start, stop or reach a server, because Pelican's own client API already does that properly - the two things it writes are answering and closing a ticket, behind their own ability and their own audit trail. Anyone signed in can ask for a key that answers only for their own servers; granting and revoking is a permission |
| **Shop** | Sell what you run: packages, a basket, invoices, Stripe, Mollie and PayPal, renewals and suspension, credit, upgrades, extras, VAT with the reverse charge, and a public shop page. It makes its own tables and it takes money, so it is off until you say otherwise |
| **Support desk** | Tickets in the panel, beside the server they are about - or the same conversation answered in Discord through [Modora](https://modora.gg). See below |
| **Languages** | Answering each person in the language their account is set to, where this plugin has been translated into it. Pelican's own pages are filled in too, where Pelican's translation stops |

### Keeping it

| | |
| --- | --- |
| **Updates** | Stable, beta or dev, with an update button, an optional automatic check, and a countdown to the next one |
| **Install a version** | Any release on the channel, not only the newest - for going back when something new turns out worse |
| **Export and import** | Every setting to a JSON file and back, saying what it would change before it changes it |

---

## Working with Modora

[Modora](https://modora.gg) is a Discord bot. This plugin and Modora are built to
work together, and the two halves meet in two places.

### Tickets, answered where staff already are

A customer opens a ticket in the panel, beside the server they are asking about.
Whoever answers does it in Discord. It is not a second place to look: it is the
same conversation reachable from both ends, and either end works when the other
is not there.

- **Nothing depends on Modora being reachable.** The ticket and every message are
  in this panel's own tables before Modora is ever asked. A refusal leaves a row
  saying "not passed on yet" and a button to try again; it never loses what
  somebody typed.
- **Told and asked, both.** Modora fires events at an address this panel makes,
  which is how an answer appears while somebody is still reading the page.
  Underneath it, the message list is read when a ticket is opened and on a timer
  for the ones still open. Neither alone is enough - a webhook needs a panel
  Modora can reach from outside, and a poll alone means waiting a quarter of an
  hour to see a reply typed a minute ago. The two crossing is harmless by
  design: a unique index on (ticket, remote id) makes the same message arriving
  twice one row.
- **Discord accounts are offered, not insisted on.** A ticket is opened without
  naming one, which makes it a guest ticket and hands back a claim link. Follow
  it once and the ticket is tied to that Discord account; until then, the
  customer reads and replies from the panel and staff answer in the channel.

Switch it on under **Support**, pick Modora as the desk, and give it the key and
server id from your Modora dashboard.

### The API, and the Modora module

The plugin ships an HTTP API of its own, and a Modora module is being built
against it. The division is deliberate:

| | |
| --- | --- |
| **Modora owns Discord** | who typed, which server they are in, what the bot may say there |
| **This plugin owns the panel** | which servers exist, what they are doing, what somebody pays for, what the watchdog thinks |
| **Pelican owns control** | starting, stopping and reaching a server, through its own client API, with its own permissions and its own activity log |

That last row is why this API reads far more than it writes. A bot that wants to
restart a server uses **Pelican's** client API - and the key for it comes from
here: when somebody ties their Discord account to their panel account, this
plugin mints a real Pelican account key and hands it over once. The bot then
acts as that person, and Pelican checks the permissions and writes the log,
neither of which a second implementation would get right and keep right.

**What the API answers that neither Pelican API can:** who is connected to a
game server right now, which servers have no backup, whether another server
fits on a node, what the panel host's own disk is doing, what the watchdog
currently thinks is wrong, which schedules have stopped, what the shop took, and
what was asked and answered in a ticket.

**And it can answer a ticket back.** That is the one thing here that changes
anything a customer sees, so it sits behind an ability of its own,
`support.write`, and writes a row into Pelican's activity log naming the key
that did it. Always as staff and never as the customer: a panel-wide key belongs
to whoever runs the panel, so a reply it sends is an answer by definition.

Send an `Idempotency-Key` header with it. A bot that times out and retries posts
the same answer twice without one, and the second one is indistinguishable from
somebody being rude; with one, the retry gets the first answer back instead of
making a second message.

**And it tells you when something happens, rather than only when something
breaks.** The webhook under Alerts carries sixteen faults and six facts - an
invoice paid, a server built, a build that failed, a renewal notice, a
suspension, somebody writing in a ticket. The facts are off until you tick them,
so a panel that upgrades into this keeps sending exactly what it sent before.

**And it answers them by Discord id.** A bot knows who typed, not who that is in
the panel. So beside every `/me/...` question there is a `/connect/{discord}/...`
one: their servers, their services and when each renews, and which of their
servers is behind on backups. Without those a module would have to mint a key
per customer to answer "when does mine renew".

A key is granted, revoked and narrowed from **Admin -> API keys**. It can be
held to single groups of questions - proving it works, its owner's own servers,
the whole panel, the shop, asking a game server directly, or tying Discord
accounts to panel accounts - and `GET /health` tells a bot which of those it
holds, so a module can draw its menu instead of finding out by being refused.

**Holding Modora scopes beside these does not create an overlap to resolve.**
Modora names a permission after a resource and a verb, and across its twelve
products not one of them reaches a server, a node, a backup or an invoice:
`tickets.read`, `messages.write`, `panels.read` (the ticket panels configured in
a Discord server), `submissions.decide`, `levels.write`, `cases.create` and the
rest are all about Discord. Nothing here has a Modora equivalent and nothing
there has one here, which is the table above restated as permissions.

What that leaves a module author is two vocabularies rather than two ways of
saying the same thing:

| Ability | Reaches |
| --- | --- |
| `health` | the key itself, and nothing else |
| `me` | the key owner's servers, backups and services |
| `panel` | every node, backup, schedule, the watchdog and the panel host |
| `shop` | takings, what is owed, what is overdue |
| `live` | a game server or a daemon, asked directly, which is the only group that costs anything |
| `connect` | ties a Discord account to a panel account, and mints a Pelican key on it |

Every one is a read except `connect`, and `connect` is what makes the rest
answerable by Discord id.

The panel serves its own documentation: the API keys page has the whole
reference, a Markdown copy to download and an OpenAPI file for Postman, all
rendered from one array so they cannot drift from the routes.

---

## Installing

**Requires** Pelican Panel `v1.0.0-beta35` or newer, and Node with yarn on the
panel host - a theme's CSS is compiled into the panel's own build.

```bash
curl -fsSL https://deb.nodesource.com/setup_22.x | sudo -E bash -
sudo apt-get install -y nodejs && sudo npm install -g yarn
```

### Through the panel

**Admin → Plugins → Import from URL**, and paste:

```
https://raw.githubusercontent.com/Legend-Develepment/essentials/main/release/essentials.zip
```

That is the stable build, and the same address the plugin's own update check
reads - so installing this way and updating from inside the panel stay on the
same channel.

For beta, swap both `main` and the file name for `beta`:
`…/beta/release/essentials-beta.zip`.

The panel runs `yarn build` afterwards, which takes a minute or two.

> Dev builds are not here. They are cut from the working branch on every push,
> into a private repository of their own, and are not what to install unless you
> were asked to try one - see [The dev channel](#the-dev-channel).

### On the server

```bash
cd /var/www/pelican/plugins
git clone https://github.com/Legend-Develepment/essentials.git essentials
cd /var/www/pelican && php artisan p:plugin:install
```

> **The folder must be `essentials`, in lowercase.** Pelican requires it
> to match the `id` in `plugin.json`, and every path lookup uses the lowercased
> value - a folder with capitals passes the name check and then fails to
> autoload on a Linux server.

Caches are cleared for you, at the end of an install and again when the plugin
is removed. Switching it off again under **Admin → Plugins** gives you Pelican's
own look back, with every setting kept.

### Coming from an earlier name

The id has changed twice, and Pelican identifies an installed plugin by its id -
so to the panel each one is a different plugin and **the Update button cannot
carry you across**. Installing over the top would leave you with two, both
claiming the same PHP namespace.

| Up to | id was | folder was |
| --- | --- | --- |
| 2.46 | `legend-development-theme` | `legend-development-theme` |
| 2.53 | `pelican-essentials` | `pelican-essentials` |
| now | `essentials` | `essentials` |

One time, in this order:

1. **Admin → Plugins → the old entry → Uninstall.**
2. Install `essentials` by either route above.

> **If you updated instead of doing that, the panel will not load.** Pelican
> refuses a plugin whose folder name and `id` disagree, and with plugin dev mode
> on it stops the whole panel rather than marking that one plugin errored. The
> folder still carries the old name while the manifest carries the new one.
> Renaming the folder is the whole fix - use whichever old name you have:
>
> ```bash
> cd /var/www/pelican/plugins
> mv pelican-essentials essentials
> cd /var/www/pelican && php artisan optimize:clear
> ```

**Your settings survive this.** They live in `.env` and in
`storage/app/private/legend-theme/`, and neither is keyed by the id - your style,
announcements, links, saved layouts and everything else are read straight back.
Permissions survive too. What you lose is the two minutes it takes.

---

## Where things are

Everything sits in one sidebar group named after the plugin:

| Row | Holds |
| --- | --- |
| **Essentials settings** | Updates, and which parts of the plugin are switched on |
| **Look** | Style, colour, shape, lettering, brand, background, icons, sidebar footer |
| **Pages** | Server list, server pages, console, resource meters |
| **Advanced** | Custom CSS and per-area overrides |
| **Minecraft**, **Other games** | Which eggs are which game, and everything else about them |
| **Server access** | Roles tied to servers |
| **Announcements**, **Navigation links**, **Login screen**, **System status**, **Egg artwork**, **Alerts**, **Backups**, **Public status page**, **Activity**, **Languages** | A page each |

The same settings are also under **Admin → Plugins → Essentials →
Settings**, in one modal.

## Permissions

**Admin → Roles → a role → Permissions → Legend Theme.**

That section is called Legend Theme, not Essentials, and stays that way
on purpose: Pelican names it from the permission model, and renaming that would
revoke every permission an administrator has already granted.

`View` and `Update` cover everything - see the settings, and save them. Beside
them is a **pair** of permissions per feature, so looking and changing can be
handed out separately:

| | |
| --- | --- |
| `Notices` | open the announcements **and write them** |
| `View Notices` | open them, and save nothing |

Every one of the thirty-two areas has both halves: Look, Pages, Advanced,
Notices, Links, Login, Version, Machines, System, Duplicate, Minecraft, Games,
Access, Timed, Activity, Schedules, Capacity, Artwork, Alerts, Backups, Status,
Languages, API, Shop, Packages, Orders, Invoices, Payments, Coupons, Customers,
Takings and Terminate. `Arrange` covers the page arranger.

So a bookkeeper can be given `View Takings` and `View Invoices` and nothing
else: they read the money and cannot withdraw an invoice, cancel an order or
reach any other page. Being able to change something always implies being able
to see it, so the pair is never both needed.

> The plain name - `Notices`, `Orders`, `Takings` - is the one that has always
> existed and still means both halves. It was left alone deliberately: renaming
> it into a pair of new names would have left every role that already holds one
> with neither, the first time somebody saved it.

A few features carry no permission on purpose, and their absence is the point.
The starred servers, the go-to menu and the pages inside a game server are
reached through Pelican's own permissions or are a personal convenience; a
second permission on top of those could only take away something the panel had
already granted.

Granting a feature by its plain name means being allowed to manage it; granting
the `View` half means being allowed to look. Root Admin has everything.

The separate page exists so that the panel's looks can be delegated without the
`plugin` permissions, which also allow installing and deleting plugins.

## Updating

**Essentials settings → Updates** picks the channel - **Stable**, **Beta**, or
**Dev** on a panel served from the development domain. Stable and beta are both
published from this repository, a branch each, and their feed addresses are
worked out from the stable one in `plugin.json` - so there is nothing to fill in.

Automatic updates are off by default. With them on, the block on the dashboard
counts down to the next check.

### The dev channel

Dev is published from a separate, **private** repository - the working branch
lives there, so this one can stay public without every unfinished change coming
with it. A private repository does not answer an anonymous request, so the dev
channel does not read `raw.githubusercontent.com` like the other two: it goes
through the GitHub API and needs a token.

- **Essentials settings → Updates → Dev repository token** - a
  [fine-grained personal access token](https://github.com/settings/personal-access-tokens)
  with **Repository access:** only the dev repository, and **Repository
  permissions → Contents: Read-only**. That is enough for all three things the
  channel does: read `update-dev.json`, list the releases for the version
  picker, and download the build. Nothing else on the panel uses it.
- Or `LEGEND_THEME_DEV_TOKEN=` in the panel's `.env`, which is the same setting.
  Run `php artisan config:clear` after editing it by hand; saving the form does
  that for you.

The field only appears on a panel that may select the dev channel at all, which
is one served from the development domain. The token stays on that panel: it is
left out of an exported settings file, like the payment and artwork credentials.

Without one, **Check for updates** says so rather than reporting the 404 GitHub
answers a stranger with.

---

## Compatibility and reasoning

Why things are built the way they are - the panel's own APIs, what a theme can
and cannot reach, and what was tried and rejected - is in
[roadmap/](roadmap/). It is written to be argued with.

## Licence

Copyright © 2026 Legend Development.

**AGPL-3.0-or-later** - see [LICENSE](LICENSE) for the full text.

> This program is free software: you can redistribute it and/or modify it under
> the terms of the GNU Affero General Public License as published by the Free
> Software Foundation, either version 3 of the License, or (at your option) any
> later version. It is distributed in the hope that it will be useful, but
> **without any warranty**; without even the implied warranty of merchantability
> or fitness for a particular purpose.

The same licence Pelican Panel itself uses, which is the point: this plugin runs
inside Pelican, builds on its classes and is loaded into the same process, and
matching its licence is what keeps the combination straightforward.

What AGPL means here in practice: anyone may use it, change it and even charge
for it - and anyone who changes it and lets other people reach it **over a
network** has to publish their changes. That last part is what the AGPL adds
over the plain GPL, and it is the clause that matters for a web panel: a hosting
company cannot take this, improve it privately, and keep the improvements.

Everything here is written for this plugin. No code from another plugin is in
it, including the two whose ideas it took: the system status page and the
Palworld settings page were both built from the source they read - `/proc` and
the game's own file format - rather than ported.
