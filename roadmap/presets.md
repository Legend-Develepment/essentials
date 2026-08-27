# Presets, export, and sharing

By this point the plugin has around sixty settings. Six presets and a Save button
is no longer enough of an answer to "make my panel look good".

## What ships

### Export and import

**Export** writes every setting to a JSON file. Not the uploads — the pictures
and the icon pack are files, and a settings file that quietly does not include
them is worse than one that says so.

**Import** reads it back, shows what would change before changing it, and applies
it in one save.

What it is actually for:

- Moving a look from a test panel to a live one without setting sixty fields
  twice.
- Keeping a copy before trying something, and getting back if it goes wrong.
- Handing your look to someone else as a file.

Every value goes through the same sanitisers as the form does. An imported file
is a file from outside, and gets the treatment an uploaded icon pack gets.

### More presets

Six today. The gap is not the number, it is the range — they are all warm dark
panels with a different accent.

Worth adding, chosen for being *different* rather than for another hue:

| | |
| --- | --- |
| **Paper** | Light, high contrast, flat. For a panel used in daylight |
| **Terminal** | Monospace, sharp corners, green on near-black |
| **Console** | Rounded, tall cards, big touch targets — a panel used on a tablet |
| **Nord / Solarized** | Two schemes people already know, done properly |

Presets fill in the fields rather than hiding them, which is already how they
work and is worth keeping: after picking one, everything it did is visible and
changeable.

### Preset previews

The picker names presets and shows nothing. Each option gets a small swatch — the
accent, the surface, the corner radius — drawn from the preset's own values, so a
new preset needs no new artwork.

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
