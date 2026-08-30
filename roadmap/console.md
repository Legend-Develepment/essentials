# The console

The page people actually live in. It has had attention already — the terminal is
themed through xterm's own options, the stat blocks are readable on a phone — and
it still has the most left to give.

**Shipped.** Rewritten from the original plan, which proposed four settings
Pelican already has. The stat tiles landed in 2.16.0 and the terminal's own
colours, cursor and scrollback in 2.16.1. Fullscreen arrived by another door and
is not being built — see below for why that is a decision rather than an
omission.

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

### Stat tiles — shipped in 2.16.0

The six blocks above the console are labelled text in a rounded box. They become
tiles: an icon square in the accent, the label small above, the figure large
below.

The icon is chosen by which block it is — CPU, memory, disk, name, status,
address — matched on position, since Pelican does not label them. A structural
bet that fails safe: no icon, and the tile is what it is now.

**A setting to hide them.** On the console page, the console is the point.
Someone who knows their server's address does not need it in front of them every
time, and hiding all six gives the terminal another 120 pixels.

### Terminal colour schemes — shipped in 2.16.1

The theme derives the terminal's colours from the accent. A dropdown of schemes
people already know — and **Follow theme** stays the default, because that is why
the interception was built.

Each scheme is sixteen ANSI colours plus a background and a foreground, handed to
xterm the same way the accent already is. This is the one terminal setting
Pelican does *not* offer, which is what makes it worth adding.

**How it reaches the terminal, in the end:** as custom properties. The runtime is
inlined verbatim and never rebuilt per request, so a setting cannot be written
into it — but the stylesheet *is* rebuilt per request, and the script can read it
back. `--ld-term-0` to `--ld-term-15` in ANSI order, mapped onto xterm's key
names by position. It also means the browser resolves the colours, which the
theme's own oklch tokens need and xterm cannot do.

### Fullscreen — arrived by another door, and is not being built

The plan was a button in the console page's header that took the terminal to
the whole viewport: the console page, minus everything that is not the console.

That is exactly what the **New window** button already opens. `?ld=console` is a
console page with the sidebar, the topbar, the page title and the graphs taken
out and the terminal given the height — in a window of its own, which is better
than fullscreen, because it can sit beside the page you were working on.

So this is done, by something built for another reason. What is left of the
original plan is a keyboard shortcut, and that is in the backlog rather than
here.

**It is also not worth building now, and that is the more important half.** The
plan was to inject a button into the console page. Four attempts at putting a
component of this theme's on that page emptied the terminal every time — in the
flow, out of the flow, with the space reserved, and finally not lazy at all.
The cause is still not known. Until it is, nothing of this theme's goes on a
console page, and a feature whose whole design is "inject something into the
console page" does not get a fifth attempt.

### Cursor and scrollback — shipped in 2.16.1

The two of the original five that Pelican does *not* offer as a preference. Block,
bar or underline; blinking or not; and how far back the buffer keeps.

Both are construction-time options, applied on the next page load, and the
settings page has to say so — changing them later needs a refit, and the refit is
Pelican's.

Two things the panel source settled that guessing would not have:

- Pelican **does** set the cursor, to `underline`, and sets `cursorInactiveStyle`
  with it. Setting only the first changes nothing visible, because stdin is
  disabled and the console never has focus. So both, and `underline` is the
  default here rather than xterm's `block` — otherwise the console changes shape
  for someone who never asked it to.
- Scrollback is left at xterm's own 1000. The ceiling is 25,000 and the settings
  page says whose memory it is.

## Risks

**Scrollback costs memory.** A large buffer on a chatty server is real memory in
someone's browser. Cap it, and say what the cap is.

**Everything here rides on one interception.** If Pelican stops assigning
`window.Xterm` — an ES module import instead of a global would do it — the
colours, the size and the schemes all stop at once, silently. Worth a note in the
settings page rather than a mystery.

**And one that was paid for rather than predicted.** Anything of this theme's
own put onto a console page empties the terminal. Four shapes were tried and all
four did it, so the rule now is simply: the console page gets CSS from this
theme and nothing else. The window opened by **New window** is built entirely
from markup Pelican already sent, for that reason.

## Done when

- Every terminal setting survives a Livewire navigation away and back. ✓
- Hiding the stat tiles gives the terminal the space rather than leaving a gap. ✓
- Nothing here overrides a choice made in Account. **Follow theme** and Pelican's
  own font settings stay the defaults. ✓
