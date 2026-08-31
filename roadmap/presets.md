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

### A preset of your own

**Save current settings as a preset**, named, stored alongside the built-in ones,
and offered in the picker. Combined with export, a preset becomes something you
can hand to someone.

## Under consideration, not committed

**Per-user themes** — each person picking their own accent, or their own preset,
rather than the panel having one.

It is the most-asked-for thing in every theme for every panel, and it is not in
this release because it needs somewhere to store a choice per user. The options:

- **`localStorage`** — no server involvement, but the panel flashes the
  administrator's theme before the browser applies the user's own, and that flash
  is worse than not having the feature.
- **A user preference on the server** — no flash, but it means a table and a
  migration, and the plugin has been careful to keep its state in `.env` and one
  storage file precisely so that uninstalling leaves nothing behind.

Neither is obviously right. It gets its own investigation before it gets a
release number.

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
