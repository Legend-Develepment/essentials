# The shell

The parts of the panel that are on every page. Up to now the theme has only
restyled them. This release starts *adding* to them, which is what render hooks
are for.

## What ships

### Announcements — shipped in 2.22.0, made a page of its own in 2.23.0

A line across the top of every page: a maintenance window, a Discord invite, a
notice that backups run at four. Injected at `panels::page.start`, which is the
hook Pelican itself renders into and is therefore the one known to work here.

**Static markup in the first response, not a Livewire component**, and that is
not a preference. This appears on every page there is, the console included, and
four attempts at putting a component of this theme's onto a console page emptied
the terminal. Anything that lands above a terminal after the page has painted
moves it, and a moved terminal is re-fitted.

Dismissal is an attribute on `<html>`, stamped by the inlined runtime from
`localStorage` before the first paint — a notice that shows for a frame and then
goes is worse than one that never showed. Only the server knows which
announcements exist, so it writes one hiding rule per announcement and the two
meet in the middle.

| Setting | |
| --- | --- |
| **Message** | Plain text, one line |
| **Style** | Info, warning, danger, or the accent |
| **Link** | Optional label and address, shown as a button |
| **Dismissible** | Whether it can be closed |
| **Where** | All panels, or only the client area, or only admin |
| **Show from / until** | Each optional and independent |

**One setting became a list, and the list needed a page.** The plan was a
section in the theme's settings. It is used as a list — one that stays up, one
that runs for an hour, one written three days before the window it is about —
and a list of records with dates on them is not a shape a form of single values
written to `.env` can hold. So: a page under Admin, and JSON in `storage`, the
way the custom CSS already goes.

Dismissal is per browser and per message. A notice that has to be
*acknowledged* is a different feature and does not belong in a theme.

The text is escaped on the way in and on the way out. It ends up in a page, and
an administrator typing a `<` should get a `<` rather than a surprise — the same
care the login notice already takes on its way into a CSS string.

### Custom navigation links — shipped in 2.24.0, on a page of its own in 2.24.1

Rows of your own in the sidebar and the topbar: label, icon (from the pack
picker that already exists), address, which panels, a group, and whether it
opens in a new tab.

`Panel::navigationItems()`, which is Filament's own API and therefore behaves
like every other entry — grouping, and the sidebar or the topbar, whichever this
panel is using.

Applied from the plugin's `register(Panel $panel)` rather than from a render
hook, so which panel this is comes off the argument. Every other thing in this
theme that had to know that worked it out from the request, and the request is
`/livewire/update` on every round trip after the first — which has cost two
releases. Here it is simply not a question.

Never marked active. A sidebar that highlights a link to another site is lying
about where you are.

The obvious ones people add by hand today: a Discord invite, a status page, a
knowledge base, a billing portal.

### Quick actions in the topbar

Injected at `panels::topbar.start`. Small, always-there buttons:

- **Back to servers** from anywhere in a server.
- **Theme switch** for a panel that allows light mode, brought out of the user
  menu where nobody finds it.
- **Custom links** marked as quick actions.

### Sidebar footer

`panels::sidebar.footer` is empty in Pelican. It is a good place for the things
that currently have nowhere to go: the panel version, a support link, your own
line of text. Off by default.

### Login screen additions

The login screen already has eight settings and no way to put anything *in* it.
`panels::auth.login.form.before` and `.after` change that: a line above the form,
links below it (terms, status, support), or a notice that registration is closed.

## How

Every item is a render hook returning escaped HTML built from a setting, except
the navigation links, which go through Filament's own API.

Nothing here needs Livewire. Dismissal is `localStorage`; everything else is
static once rendered.

## Risks

**Hooks stack.** Several plugins can register at the same hook and the order is
registration order. Nothing here may assume it is alone at a hook, and nothing
may render something that breaks the layout for whatever renders next.

**An announcement bar is a good place to put something dangerous.** It is
administrator-entered HTML on every page of the panel. It is plain text, escaped,
with the link built separately from a validated URL — not a rich text field. That
restriction is the feature.

## Done when

- Every addition is off by default. A panel that updates to this release looks
  exactly as it did.
- Nothing added here appears for someone who cannot already see the page it is
  on.
- The announcement bar cannot inject markup, whatever is typed into it.
- All of it works with the topbar hidden, the sidebar as a rail, and top
  navigation — the three layouts that move the shell around.
