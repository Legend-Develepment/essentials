# What this costs

Measured, on a live panel, before anything in here is proposed.

The last plan ([The edges](edges.md)) was about what this plugin does not do.
This one is about what it does too much of. It is written after the measuring
rather than before, because the two times this repository guessed at
performance it guessed wrong: `theme.css` at 250 KB looked like the problem and
goes through Vite minified and cached, and `Sync::revokeStale()` looked like it
ran on every request and costs two cached reads. Both are written down in
[edges.md](edges.md) as things not to work on.

Parts 1 to 3 below have since been answered. The answers are in place of the
questions, with what was done about each.

## How these numbers were taken

One real request per PHP process, through the HTTP kernel, as a signed-in
administrator, with the query log on and each request inside a transaction that
is rolled back. One per process because a first attempt ran nine requests
through one kernel and three of them returned 500 from state left behind by the
one before, which is a fault in the harness and not in the panel. Every figure
below was taken again after that was fixed.

| Page | Time | Queries | Ours | In SQL | HTML |
| --- | --- | --- | --- | --- | --- |
| Server list (app) | 199 ms | 24 | 1 | 28 ms | 212 KB |
| Dashboard (admin) | 398 ms | 21 | 1 | 14 ms | 322 KB |
| Look | 398 ms | 18 | 1 | 7 ms | 575 KB |
| Backups | 278 ms | 23 | 1 | 20 ms | 574 KB |
| Schedules | 312 ms | 28 | 1 | 27 ms | 481 KB |
| Capacity | 270 ms | 24 | 1 | 14 ms | 336 KB |
| Customers | 267 ms | 20 | 3 | 10 ms | 361 KB |
| Shop overview | 214 ms | 27 | 9 | 16 ms | 301 KB |
| My services | 213 ms | 17 | 11 | 13 ms | 194 KB |
| Invoices | 104 ms | 6 | 4 | 3 ms | 154 KB |

**The database is not where the time goes.** Every page above spends between
three and twenty-seven milliseconds in SQL, out of two to four hundred. Most
admin pages run exactly one query of this plugin's own; the rest are Pelican
building its panel. Anybody looking here for a slow query will not find one.

### How the plugin was switched off to compare

Pelican loads every plugin through one object it resolves from the container, so
a process that binds a `PluginService` doing nothing runs the panel with this
plugin absent. No row is touched, no file is moved, and the next request loads
the plugin exactly as before. Individual features are switched the same way, by
adding to `essentials.features_off` in memory rather than writing `.env`.

**The trap, written down because it cost a day's numbers.** The first version
bound that stub in a `booting` callback, which is one step too late: Pelican
loads its plugins from `AppServiceProvider::register()`, so the plugin's own
provider, its config, its routes and its listeners were all in place before the
stub existed, and only its Filament pages were kept out. It reported the plugin
costing 10.2 MB. Bound before the `RegisterProviders` bootstrapper, which is the
first moment that works and still has the config files read, the same
measurement says 15.5 MB. Features are different: they are read while the panel
is built, so for those a `booting` callback is early enough.

### What the command line does and does not tell you

Every figure was taken with the CLI binary, which has `opcache.enable_cli` off
and therefore compiles all 241 of this plugin's files on every single run.
PHP-FPM, which is what actually serves the panel, keeps compiled code in shared
memory and pays that once. **So the memory and time figures below are ceilings,
not what a reader pays.** The byte counts are exact and machine-independent, and
so are the ratios between the parts, which is what the bisection is for. For
scale, a real request over HTTPS to this panel's login page takes 128 ms at
best and 137 ms at the median, all of it included.

## What was already fixed while measuring

**My services ran 80 queries, 74 of them ours.** Sixty-six were the same
query, twice per order, for every order the customer had ever had:

    33 x  Upgrades::waiting  <-  Summary::pending  <-  Summary::card
    33 x  Upgrades::stuck    <-  Summary::stuck    <-  Services::rows

Thirty-two of those thirty-three orders were cancelled and cannot have a change
waiting on them. One query for the lot, memoised per request, took it to 17
queries and 11 of ours - and half of the sixty-six were a day old, added when
the refused-change notice went onto that list. Shipped in 3.145.0-dev.

**The inline runtime script was 36.2 KB of which 23 were comments.** It has to
run before the first paint, so Vite cannot touch it and nothing stripped it. It
now goes out at 13.2 KB, by dropping whole lines that are nothing but comment
and only whole lines. Shipped in 3.147.0-dev, with `tools/runtime.test.js`
holding the sixteen cases the first character-by-character version got wrong.

---

## Part 1 - The page weight, answered

The plugin adds **148.3 KB of HTML to the admin dashboard, 12.5 KB of it after
gzip.** Same page, same user, plugin absent against plugin present:

| | absent | present | difference |
| --- | --- | --- | --- |
| Dashboard (admin) | 150.5 KB / 19.5 KB zipped | 298.8 KB / 32.0 KB zipped | +148.3 / +12.5 |
| Dashboard (client) | 164.1 KB / 17.1 KB zipped | 230.5 KB / 26.5 KB zipped | +66.4 / +9.4 |
| Server list | 344.0 KB / 28.2 KB zipped | 489.2 KB / 40.2 KB zipped | +145.2 / +12.0 |

Where the 148.3 KB on the dashboard goes:

| | absent | present |
| --- | --- | --- |
| stylesheet | 6.0 KB | 48.4 KB |
| script | 1.9 KB | 15.6 KB |
| icons, inline SVG | 23.7 KB in 45 | 44.9 KB in 82 |
| everything else | 118.9 KB | 189.9 KB |

**The stylesheet is not worth moving out.** It is 42.4 KB, already fully
minified: stripping comments and whitespace from it reclaims 0%, because there
are none. It is also extremely repetitive, so it gzips to **2.8 KB**. Serving it
as a cached file instead of inline saves those 2.8 KB per navigation and buys a
cache-invalidation story and a round trip on the first load. Not taken.

**The rest is navigation for pages.** 34 of the admin panel's 39 pages are this
plugin's, and every one of them is markup and an icon on every admin page. That
is the lever, and it is the modules plan rather than a minifier: see what
changed, below.

## Part 2 - The four hundred milliseconds, answered

**Almost none of it is the painting.** With the preset set to `none`, which
makes the plugin render no stylesheet, no colours and no scripts at all, nine
runs per variant with the minimum taken:

| Page | painted | not painted |
| --- | --- | --- |
| Dashboard (admin) | 200.3 ms | 199.2 ms |
| Server list | 274.1 ms | 297.8 ms |
| Look | 349.7 ms | 364.4 ms |

Twice out of three the painted page came out faster, which is the shape of a
difference that is not there. The four hundred milliseconds on Look are Filament
building a form with 169 settings in it, and they are not this plugin's to give
back.

**What the plugin does cost is fixed and paid at boot.** On the admin
dashboard, plugin absent against present, one request per process:

| | absent | present | difference |
| --- | --- | --- | --- |
| booting | 265 ms | 354 ms | +89 ms |
| the request | 198 ms | 253 ms | +55 ms |
| routes registered | 271 | 351 | +80 |
| our classes loaded | 0 | 123 | +123 |

Loading all 241 files costs 4.5 MB and the time to compile them on a cold
command line; the heaviest are `Settings` at 281.7 KB, `InvoiceMail` at
266.8 KB, `Packages` at 174.7 KB and `Look` at 139.2 KB. Under FPM that
compilation happens once for the whole server rather than once per request, so
most of the 89 ms above is an artefact of how it was measured. The part that is
real is the 80 routes and the 123 classes, and both follow from how many
features are on.

## Part 3 - Memory, answered

Same comparison, same page. The plugin costs **15.5 MB**, of which 13.3 MB is
paid before the request starts:

| | absent | present | difference |
| --- | --- | --- | --- |
| booting | 44.8 MB | 58.1 MB | +13.3 MB |
| the request | 9.1 MB | 11.3 MB | +2.2 MB |

**Nine and a half of those megabytes are features, and features are switchable.**
Each module switched off on top of what this panel already has off, on the admin
dashboard:

| Module | Memory | HTML | Routes |
| --- | --- | --- | --- |
| Shop | 5.6 MB | 21.5 KB | 21 |
| Servers | 1.1 MB | 19.2 KB | 13 |
| Appearance | 0.6 MB | 38.4 KB | 1 |
| Outside world | 0.6 MB | 8.9 KB | 16 |
| Support | 0.5 MB | 2.4 KB | 4 |
| Panel | 0.1 MB | 15.0 KB | 0 |
| Alerts | 0.0 MB | 2.4 KB | 0 |
| **all seven** | **9.1 MB** | **110.5 KB** | **55** |

Two things to read off that table. **The shop is more than half of it**, on a
page that is not the shop, and no single one of its fourteen switches accounts
for it: turning off any one saves a tenth of a megabyte, turning off all
fourteen saves 5.6. That is what a module is for. And **appearance is the
cheapest in memory and the dearest in markup**, which is the stylesheet, and is
the one thing every panel that installs this plugin actually wants.

The remaining **5.0 MB is the base**: the config file, the provider, the
listeners, the routes that are not behind a feature, and the classes that go
with them. It is paid by a panel with all fifty-three features switched off, and
it was 6.0 MB before the change below.

That same panel still receives 37.8 KB more HTML than one without the plugin,
and it is worth knowing what that is, because it is not the pages:

| | plugin absent | plugin present, everything off |
| --- | --- | --- |
| stylesheet | 6.0 KB | 27.0 KB |
| script | 1.9 KB | 14.3 KB |
| icons | 23.8 KB in 45 | 23.4 KB in 44 |
| everything else | 118.9 KB | 123.7 KB |

**33.4 of the 37.8 KB is the stylesheet and the runtime script**, and both of
those follow the preset rather than the feature switches: `preset = none` is
what turns them off, and that is Part 2's measurement, where it saved no time at
all. The other 4.4 KB is the rest of the plugin put together.

## What changed because of this

**Twenty-one admin pages now follow their feature.** With every feature off,
these registered themselves anyway: Look, Pages, Advanced, Announcements,
Navigation links, Login screen, System status, Duplicate server, Minecraft,
Games, Server access, Activity, Schedules, Capacity, Languages, Files, Egg
artwork, Alerts, Backups, Public status and API keys. The shop's nine pages
already followed this rule and the client and server panels already registered
nothing at all, so this is the admin side catching up with both. Theme settings
and Modules stay whatever happens, because switching everything off has to leave
the page that switches it back on.

Measured on the same panel, with every feature off, before against after:

| | before | after |
| --- | --- | --- |
| our admin pages registered | 23 | 2 |
| routes | 296 | 275 |
| memory | 59.9 MB | 58.9 MB |
| HTML | 188.3 KB | 188.4 KB |

**The HTML did not move, and the first version of this write-up said it would.**
It claimed those twenty-one pages were 37.8 KB of navigation on every admin
page. They were not: `canAccess()` already returned false for every one of them
with its feature off, so Filament built no navigation entry and the pages cost
nothing in markup. What they did cost is twenty-one routes, twenty-one classes
loaded on every request, and the megabyte above. The lesson is the one this plan
opens with, and it caught the plan's own author: the 37.8 KB was measured
correctly and attributed to the wrong thing, which is exactly what happens when
a difference is explained instead of bisected.

## Part 4 - The things that are already cheap, written down so nobody optimises them

Measured and confirmed to cost nothing worth reclaiming:

- `Features::disabled()`, `Languages::current()`, `Api\Keys::ready()`,
  `Shop\Tables::ready()`: 0.0 ms and no queries, memoised per request.
- `Quick::bootstrap()`: 0.3 ms, no queries, even with starred pages.
- `Favourites::for()`: 0.6 ms, no queries.
- `Backups::all()`: 2.4 ms, no queries.
- `Orders::unbuilt()`: 1.7 ms, one query.

The two largest of the cheap ones are `Layouts::for()` at 4.6 ms and 0.55 MB,
which runs on every page, and `Takings::all()` at 11.4 ms and eight queries,
which runs on one.

And now, from the parts above:

- **The inline stylesheet.** 42.4 KB, 0% reclaimable by minifying, 2.8 KB over
  the wire. Leave it inline.
- **The painting.** No measurable time at all.
- **The queries.** Three to twenty-seven milliseconds out of four hundred.

### The server list, added later, and the trap it sprang

It was named in the plan as one of the three heaviest pages and then never
measured, because the script that produced this table was not kept. It is now:
`tools/weigh.php`, which does not ship with the plugin and lives beside the
gates.

The first reading was **4406 ms** and it was wrong. It was the first request
after the file was copied onto the panel, so opcache had to compile the panel
from source; the next five ran 198 to 425 ms. Which makes the rule worth
writing next to the numbers rather than only in a commit message:

**Throw the first one away.** A cold opcache is a twenty-fold difference and it
looks exactly like a slow page. Measure five and take the shape of them, not
the first.

Once warm, the page everybody lands on is the cheapest admin-sized page here:
199 ms, 24 queries, one of them this plugin's, 28 ms of that in SQL. It is not
where the time goes either.

## How you check it works

Per part, on the real panel, as `www-data`, with
`sudo -u www-data php plugins/essentials/tools/weigh.php <path>`, which is the
script that produced the table above:

1. **Part 1:** the same pages, measured again, with the HTML size as the
   number that has to move.
2. **Parts 2 and 3:** the same pages, with time and memory as the numbers. A
   change that moves neither is a change to undo.
3. Every figure taken one request per process, because anything else measures
   the harness.
4. Anything that switches the plugin off to compare is bound before
   `RegisterProviders`, or it is measuring only half of it.

## What applies everywhere

The rule this plan exists to keep: **measure, then change, then measure again.**
four of the five things this repository has previously believed about its own
performance were wrong, and every one of them was wrong in the direction of
working on the thing that was already fine.
