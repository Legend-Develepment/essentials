# The console

The page people actually live in. It has had attention already — the terminal is
themed through xterm's own options, the stat blocks are readable on a phone — and
it still has the most left to give.

**Next up.** Rewritten from the original plan, which proposed four settings
Pelican already has.

## What Pelican already does

Checked first this time. Under **Account**, per person:

| Key | Default |
| --- | --- |
| `ConsoleFont` | `monospace`, with uploaded fonts offered |
| `ConsoleFontSize` | 14 |
| `ConsoleRows` | 30 |
| `ConsoleGraphPeriod` | 30 |

The original plan listed font, size, line height, scrollback and cursor as things
to add. Three of those five exist and are the person's own choice. **The theme
already caps the size on a narrow screen and must keep treating that as a
ceiling on someone's setting rather than a setting of its own.**

The terminal is built in `resources/views/filament/components/server-console.blade.php`,
with `window.Xterm` assigned from `resources/js/console.js`. It loads the **WebGL
addon**, which is why none of this can be done in CSS: the glyphs are drawn to a
canvas from JavaScript options, and a stylesheet would move the text and leave
them behind. The interception in `resources/inline/runtime.js` is the way in, and
Pelican calls the fit addon on every window resize, which is what makes a revised
size take.

## What ships

### Stat tiles

The six blocks above the console are labelled text in a rounded box. They become
tiles: an icon square in the accent, the label small above, the figure large
below.

The icon is chosen by which block it is — CPU, memory, disk, name, status,
address — matched on position, since Pelican does not label them. A structural
bet that fails safe: no icon, and the tile is what it is now.

**A setting to hide them.** On the console page, the console is the point.
Someone who knows their server's address does not need it in front of them every
time, and hiding all six gives the terminal another 120 pixels.

### Terminal colour schemes

The theme derives the terminal's colours from the accent. A dropdown of schemes
people already know — and **Follow theme** stays the default, because that is why
the interception was built.

Each scheme is sixteen ANSI colours plus a background and a foreground, handed to
xterm the same way the accent already is. This is the one terminal setting
Pelican does *not* offer, which is what makes it worth adding.

### Fullscreen

A button in the page header, injected at
`panels::page.header.actions.before` scoped to the console page. It takes the
terminal to the full viewport — the console page, minus everything that is not
the console.

Escape leaves. It is CSS and a class on `<html>`; nothing about the terminal's
connection changes, so a server mid-boot stays mid-boot.

### Cursor and scrollback

The two of the original five that Pelican does *not* offer. Block, bar or
underline; blinking or not; and how far back the buffer keeps.

Both are construction-time options, applied on the next page load, and the
settings page has to say so — changing them later needs a refit, and the refit is
Pelican's.

## Risks

**Scrollback costs memory.** A large buffer on a chatty server is real memory in
someone's browser. Cap it, and say what the cap is.

**Everything here rides on one interception.** If Pelican stops assigning
`window.Xterm` — an ES module import instead of a global would do it — the
colours, the size and the schemes all stop at once, silently. Worth a note in the
settings page rather than a mystery.

## Done when

- Every terminal setting survives a Livewire navigation away and back.
- Fullscreen leaves the websocket alone.
- Hiding the stat tiles gives the terminal the space rather than leaving a gap.
- Nothing here overrides a choice made in Account. **Follow theme** and Pelican's
  own font settings stay the defaults.
