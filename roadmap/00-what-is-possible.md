# What is possible

Before planning anything, an honest account of what a theme plugin can and
cannot do to Pelican. Every plan in this roadmap is built on these four levers,
and stops where they stop.

## Lever 1 — CSS

What the plugin has been doing so far. Colours, spacing, shape, the terminal and
the file editor through their own variables, and layout as far as CSS can carry
it (the icon rail in 2.13.5 is a CSS rail, because Filament's own collapse was
already on).

**Reaches:** anything with a class or a stable position in the markup.
**Stops at:** anything that is not rendered at all.

## Lever 2 — Filament's panel API

`maxContentWidth()`, `topNavigation()`, `sidebarFullyCollapsibleOnDesktop()`,
`navigationItems()`, `userMenuItems()`, `widgets()`, `brandLogo()`, and the rest.
Called from the plugin's `boot()`, which runs after Pelican has finished building
the panel — that is the point at which a setting wins.

**Reaches:** the shape of the shell, and adding navigation entries and widgets.
**Stops at:** anything Pelican has hard-coded rather than configured. And it is
worth checking first whether Pelican already sets what you are about to set —
the rail spent a release doing nothing for exactly that reason.

## Lever 3 — Render hooks

**This is the lever the plugin has barely touched, and it is the one that changes
what is possible.**

Filament exposes **83 named points** where a plugin can inject HTML without
replacing a template. The plugin currently uses two of them (`styles.after` and
`scripts.after`) purely to load a stylesheet and a script.

The ones this roadmap builds on:

| Hook | What it opens up |
| --- | --- |
| `panels::content.start` | A banner above every page — announcements, maintenance notices |
| `panels::page.header.actions.before/after` | Extra buttons beside a page's own |
| `panels::topbar.start` / `topbar.end` | Quick actions, a status pill, anything in the bar |
| `panels::sidebar.nav.start` / `nav.end` | Content above or below the menu |
| `panels::sidebar.footer` | Version, links, a support line |
| `panels::resource.pages.list-records.table.before` | A toolbar above the server list |
| `panels::page.header-widgets.before/after` | Cards above a page's content |
| `panels::auth.login.form.before/after` | Content on the sign-in screen itself |
| `panels::user-menu.before/after` | Entries in the account menu |
| `panels::body.end` | Anything that has to sit outside the layout |

Hooks can be **scoped** to a specific page or resource, so a toolbar can appear
on the server list and nowhere else.

**Reaches:** adding real components — not styled versions of Pelican's, but new
ones, rendered by us, in the right place.
**Stops at:** the hook has to exist where you want the thing. There is no hook
*inside* a server card, so a card cannot be rebuilt from within.

## Lever 4 — Livewire components and Filament pages

A plugin can register its own Livewire components, Filament pages and widgets.
The Theme page is already one. Combined with lever 3, anything we render can be
interactive and can talk to the server.

**Reaches:** genuinely new features, not just new looks.
**Stops at:** the plugin's own permissions. Nothing here should reach further
into a panel than the person using it already can.

## Lever 5 — what Pelican already does

**Not a lever for adding anything. The one to check before reaching for the other
four, and the one that has cost the most by being skipped.**

Pelican stores nine preferences per person in `App\Enums\CustomizationKey`, and
several of them are things this roadmap proposed to build:

| Key | What it already does |
| --- | --- |
| `TopNavigation` | sidebar, topbar, or both — per person |
| `DashboardLayout` | the server list as a grid or a list — per person |
| `ConsoleFont`, `ConsoleFontSize`, `ConsoleRows` | the terminal, per person |
| `ConsoleGraphPeriod`, `ButtonStyle`, `RedirectToAdmin` | — |

The server list is also already filterable **by egg and by owner**, server side
and across every page, and searchable by name the same way. All three sit in
`ListServers::table()`.

And two of Pelican's own defaults come from config that reads `.env`, which the
plugin already writes:

```php
'display-width'      => env('FILAMENT_WIDTH', 'screen-2xl'),
'default-navigation' => env('FILAMENT_DEFAULT_NAVIGATION', 'sidebar'),
```

### What this costs when it is skipped

Three features were built on the assumption that Pelican lacked something it
had. Each had to be undone:

- Four card layouts for the server list — Pelican has two, per person.
- A filter box above that list — a worse copy of Pelican's search, and it could
  not offer eggs at all, because a card carries the egg's picture and not its
  name.
- Terminal font settings — already in Account, and the theme was quietly
  overriding them instead of respecting them.

### The rule that follows

**Where Pelican offers something per person, the theme sets the default and the
person overrides it.**

Doing that takes one piece of care: `getCustomization()` merges the enum's
defaults in before answering, so it always says something — which makes "chose
sidebar" and "never chose" the same answer. The stored `customization` column
does not, and that difference is the whole of the rule.

## Where the line actually falls

The comparison that started this roadmap was a screenshot of a different panel —
cards with cover art per game, coloured status badges, stat tiles with icon
squares, a console that slides out over the page.

Honestly sorted:

**Reachable.** Cover art on server cards, status as a badge, stat tiles with
icons, a toolbar above the list, an announcement bar, quick actions in the
topbar, a fullscreen console, custom links in the sidebar, a search that filters
as you type. All of it is lever 1 plus lever 3.

**Reachable but expensive.** A console that slides over the page as a drawer:
the console is a Livewire component on its own page, and moving it means
rendering our own and talking to the same websocket. Possible, not cheap, and it
would have to be kept working through Pelican's changes.

**Not reachable, and should not be faked.** Changing what a server card *is* —
its markup, its fields, what it links to. There is no hook inside it, and the
only way in is to override the template, which is the one thing this plugin does
not do. A card can be restyled past recognition; it cannot be rebuilt.

So: can this turn Pelican into a different panel? **The shell, yes — completely.
The pages, largely. The components Pelican renders, only as far as CSS goes.**
That is the honest shape of it, and the plans below stay inside it.
