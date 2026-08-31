# Presets, export, and sharing

By this point the plugin has around sixty settings. Six presets and a Save button
is no longer enough of an answer to "make my panel look good".

## What ships

### Export and import — shipped in 2.38.0

**Export** writes every setting to a JSON file. Not the uploads — the pictures
and the icon pack are files, and a settings file that quietly does not include
them is worse than one that says so.

**Import** reads it back, shows what would change before changing it, and applies
it in one save.

Both are on the plugin's own page, beside the update button. What shipped, and
why:

- **Unknown keys are dropped on the way in**, not passed along. `persist()`
  writes an explicit list of environment variables and would ignore them anyway,
  but dropping them at the door is what lets the summary report honestly on what
  the file will actually do.
- **A bare settings object is accepted** as well as a full export. Somebody who
  edited the file down to the part they wanted should not be told it is the
  wrong file — while a file carrying another plugin's marker still is.
- **The comparison is loose.** `'2'` from a file and `2` from the form are the
  same setting, and reporting that as a change would fill the summary with
  entries that do nothing.
- **Twelve changes are named and the rest counted.** A list of sixty is not
  read.

What it is actually for:

- Moving a look from a test panel to a live one without setting sixty fields
  twice.
- Keeping a copy before trying something, and getting back if it goes wrong.
- Handing your look to someone else as a file.

Every value goes through the same sanitisers as the form does. An imported file
is a file from outside, and gets the treatment an uploaded icon pack gets.

### More presets — four of five shipped in 2.39.0

Six today. The gap is not the number, it is the range — they are all warm dark
panels with a different accent.

Worth adding, chosen for being *different* rather than for another hue:

| | |
| --- | --- |
| **Terminal** | Monospace, sharp corners, green on near-black — shipped |
| **Console** | Rounded, tall cards, big touch targets — a panel used on a tablet — shipped |
| **Nord / Solarized** | Two schemes people already know, done properly — shipped |
| **Paper** | Light, high contrast, flat. For a panel used in daylight — **deferred** |

Presets fill in the fields rather than hiding them, which is already how they
work and is worth keeping: after picking one, everything it did is visible and
changeable.

**Terminal needed a font setting**, which is now its own thing under Look →
Appearance: default, monospace, rounded, serif, or the system's. Every option is
a family the machine already has — a panel that fetches a font on every page
leaks who is looking at it and stops rendering correctly when that host is
unreachable, and neither is worth a nicer letter shape. Choosing "default"
emits no rule at all, so Filament's own stack is genuinely untouched rather than
replaced with a copy of itself.

**Paper is deferred, and to the right place.** It is the only light preset, and
this file's own rule is that a preset which only looks right at the defaults is
not finished. Light mode already has a line in [the backlog](backlog.md) saying
it has had a fraction of the attention dark has and wants a pass of its own.
Shipping a light preset on top of that would be shipping the half of it that
looks done. It goes in with that pass.

### Preset previews — shipped in 2.39.0

The picker names presets and shows nothing. Each option gets a small swatch — the
background, the surface and the accent, in the preset's own corner radius — drawn
from the preset's own values, so a new preset needs no new artwork and draws
itself. "None" gets no swatch, because it is the absence of one.

### A preset of your own — shipped in 2.40.0

**Save current settings as a preset**, named, stored alongside the built-in ones,
and offered in the picker. Combined with export, a preset becomes something you
can hand to someone.

Two buttons on **Look**, which is the page the picker is on. What shipped:

- **It saves what is on the page, not what was last saved.** "Save this as a
  style" is said about what you are looking at.
- **A preset is a look, not a backup.** It captures the eighteen fields a
  built-in preset may set — colours, corners, background, lettering, icons,
  meter thresholds — and nothing else. Which channel you follow and what your
  announcements say are not part of a look; export is the thing that carries
  those.
- **Every key of your own is prefixed `my-`**, so one can never shadow a
  built-in preset and leave no way back to it. A name reused replaces the one
  that had it, which is what somebody doing that means.
- **Deleting the one the panel is set to says so.** The settings it applied are
  already in the form and are not touched — silently falling back to the default
  on the next read is the version of this that loses an afternoon.

## Answered, and shipped in 2.43.0

**Per-user themes** — each person picking their own accent, or their own preset,
rather than the panel having one.

It is the most-asked-for thing in every theme for every panel, and it was held
back because it needed somewhere to store a choice per user. The two options
written down here were:

- **`localStorage`** — no server involvement, but the panel flashes the
  administrator's theme before the browser applies the user's own, and that flash
  is worse than not having the feature.
- **A user preference on the server** — no flash, but it means a table and a
  migration, and the plugin has been careful to keep its state in `.env` and one
  storage file precisely so that uninstalling leaves nothing behind.

**The page arranger answered it in passing.** The second option was read as
meaning a table, and it does not: the arranger keeps a file per person under
`storage/app/legend-theme`, no table and no migration, and a request reads only
its own reader's. The same shape works here, with no flash — the choice is read
on the server and the stylesheet is built from it before the page is sent. An
uninstall still leaves nothing behind.

What shipped:

- **Two decisions, kept separate.** Which styles may be chosen is the
  administrator's; which of them a person uses is theirs. Nothing ticked means
  nobody chooses anything, so a panel updating to this release keeps one look.
- **Stored as what is allowed**, the opposite of `features_off` and for the
  opposite reason. A feature added later should arrive switched on; a style added
  later should not arrive as something everyone may suddenly repaint the panel
  with.
- **A withdrawn style takes people back to the panel's**, rather than leaving
  them on something no longer offered.
- **Filament's own palette is restated, not only this theme's tokens.**
  `$panel->colors()` was handed the panel's accent long before anyone signed in,
  so without that the buttons keep the administrator's colour while everything
  around them changes — which reads as a broken page rather than as a choice.
- **The override is deliberately awkward to reach.** It is a closure released in
  a `finally`, because a global left standing would make the settings form show
  somebody's personal style as though it were the panel's, and saving that form
  would then write it there.

## Risks

**Import is a settings-shaped hole into `.env`.** Every value has to be validated
as if it had been typed into the form, because that is exactly what it is. The
sanitisers already exist and are already shared between the page and the plugin
modal; import becomes the third caller and must not be given its own path.

**A preset that fills sixty fields can undo an afternoon's work.** Picking one
asks first, and export exists so there is something to go back to.

## Done when

- Exported and re-imported settings produce a byte-identical `.env` block.
- An import file with a value the form would reject is rejected the same way,
  with the same message.
- Every preset is legible at all four card styles and all five layouts — a preset
  that only looks right at the defaults is not finished.
