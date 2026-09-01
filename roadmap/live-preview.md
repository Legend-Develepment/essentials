# Live preview

Sixty settings, and the only way to see what one does is to save it and look at
the panel. Save, look, go back, adjust, save again. Every setting in this plugin
has been chosen through that loop, and it is a bad loop.

This is the release that fixes it, and it is a major version because it changes
what the settings page *is*.

## What ships

### A panel that is not the panel

A preview beside the form: a small, fake panel — sidebar, topbar, a card, a
table row, a button, a meter, a terminal line — rendered from the same custom
properties the real theme reads, and updated as a field changes rather than when
it is saved.

It works because of a decision made early and kept: **every effect in the theme
is read through a custom property.** Turning off the glow redefines a token
rather than fighting the rules that use it. A preview is therefore not a
reimplementation of the theme — it is the same stylesheet, scoped to a box, with
the tokens fed from the form instead of from `.env`.

That is the whole trick, and it is only available because the theme was built
that way. Nothing here works if the preview has to be kept in sync by hand.

### What it previews

- Accent, surface, radius, density, glass, glow — the appearance settings.
- Card style, sidebar style, topbar style — the shape settings from 2.13.5.
- The background, including an uploaded picture.
- The meters at all three levels, so the thresholds can be set by eye.
- A terminal line in the chosen scheme.

### Full-page preview — shipped in 2.53.1

The small panel answers "what does this token do". It does not answer "what does
my panel look like". A second mode opens the real panel with the unsaved
settings applied — the same CSS the render hook emits, from values held for the
request instead of written to `.env`.

Saving is still saving. The preview never writes anything.

**It is a tab and not a pane, and Pelican decided that.** This section said "in a
pane beside the form" until it was built. Pelican's `SetSecurityHeaders`
middleware sends `X-Frame-Options: DENY`, so the panel refuses to be framed by
anything, itself included. Overriding that would be a theme plugin weakening a
security header to draw a picture. A tab is the better answer anyway: full
width, real conditions, nothing squeezed — which is the third time a plan here
has been rewritten by what the panel actually does rather than worked around.

What shipped:

- **The values live in the session for fifteen minutes**, and the stylesheet is
  built from them through `Theme::using()` — the same mechanism a person's own
  style uses, released in a `finally`, so a pending value cannot be left standing
  where a form would read it back as the panel's own and save it there. Only the
  stylesheet is built from them; every other reader in the request sees what is
  stored.
- **Three things have to be true** before a page draws from them: the address
  asks, something is held, and whoever is asking may change these settings
  anyway. Otherwise a link with a query string on it would be a way to show
  somebody a panel that is not theirs.
- **A bar on every previewed page**, outside the announcements switch, because a
  panel showing colours that are not saved has to say so even where
  announcements are off — otherwise the preview is indistinguishable from the
  panel and somebody spends an afternoon wondering why a setting will not stick.
  It sticks to the top: the preview is for scrolling around, and the sentence
  saying none of it is real cannot be the first thing to leave the screen.
- **Coming back loses nothing.** The Look page fills from the pending values, so
  going to look and returning is the same as never having left. Saving forgets
  them, because after a save the bar would be a lie.
- **A person's own style is skipped while previewing.** The question is what the
  panel looks like; answering it with somebody's personal override on top
  answers a different one.

### The arranger, everywhere

**Half of this shipped in 2.53.2, and the other half turns out to be blocked by
the markup rather than by effort.**

The half that shipped is the one that was a fault rather than a feature: the
launch button appeared on every page and opened an editor with nothing in it on
the pages the arranger cannot touch. It now appears only where there is
something to move, and looks again after a Livewire navigation because the
blocks arrive after the event — three fixed moments rather than a
MutationObserver, because the console streams output continuously and watching
the body there would run the check on every line that arrives, for ever, to
answer a question that settles in half a second.

**The console cannot be reached, and the reason is more specific than this file
used to claim.** It said the console is "not built from Filament's grid". It is:
`filament/server/pages/console.blade.php` renders `<x-filament-widgets::widgets>`,
which is a grid. Two things stop the arranger anyway, and only the second is
fatal:

- The container is `.fi-wi`, not `.fi-grid`, and the widgets are its direct
  children with no `.fi-grid-col` wrapper. That alone is one selector.
- **The widgets have no stable identity in the DOM.** The arranger addresses a
  block by `wire:partial` or by the path inside a `wire:key`, because those
  survive a request. A console widget's `wire:key` is the class name with no
  path — `keyOf()` requires at least three dot-separated parts and gets one —
  and its `wire:id` is regenerated every request. There is nothing to write an
  `order` rule against.

So this is not a slice waiting to be built. It needs either something stable to
select on, or a different mechanism entirely for that page. Pelican's own
`Console::registerCustomWidgets(ConsoleWidgetPosition, …)` places widgets at four
named positions, which is a plugin API rather than a user preference — worth
knowing, and not the same feature.

Also: arrangements per role, so an administrator and a subuser can be shown
different pages, which is closer to what people ask for than a single layout for
everyone.

## Why this is a 3.0

The settings page stops being a form and becomes a tool. That is a change in what
the plugin is for, and the version number should say so.

It also has a real cost worth naming up front: **a preview is a second place the
theme can be wrong.** If the preview and the panel ever disagree, the preview is
worse than useless — it is a lie that costs an afternoon. Keeping them honest
means the preview may never contain a rule of its own. Everything it shows comes
from the same stylesheet and the same emitter as the panel, or it does not go in
the preview.

## Prototyped, and the answer is yes — with one change first

This file said the scoping was worth prototyping before committing to it. It was
prototyped by measuring `theme.css` rather than by writing a preview, because the
question is entirely about what the stylesheet is made of.

**The claim this release rests on holds.** Of 1024 declarations, 9 carry a
literal colour — and all nine are neutral: black scrims, a white sheen, the mask
gradients on the card artwork. They are correct in any theme and none of them
needs to change with a setting. Everything that answers to a setting reads a
token, of which there are 122 definitions. So a preview needs no rules of its
own, which is the condition the whole release depends on.

The token definitions divide into 5 root-level blocks and 25 element-level ones,
and the 25 are not a problem: they are this plugin's own components setting their
own variants — `.ld-nodes__meter[data-level='danger']`, `.ld-notice--warning` and
so on. Those come along inside the box for free, because the box contains them.

**The one thing in the way is the gate, not the tokens.** 101 of 315 rules are
written `html.dark …`, and `html` is not inside the preview box. A dark theme
previewed on a panel currently in light mode would get its tokens and none of the
101 rules that use them; a light theme previewed on a dark panel would get those
rules fighting it. That is not a scoping problem, it is a single selector.

The fix is mechanical and has no visible effect today:

```css
html.dark .fi-…            →    :is(html.dark, .ld-preview--dark) .fi-…
```

`:is()` rather than `:where()`, and the difference matters. `:where()` has zero
specificity and would quietly lower all 101 rules, changing which of them wins.
`:is()` takes the specificity of its most specific argument: `html.dark` is
(0,1,1), `.ld-preview--dark` is (0,1,0), so the result is (0,1,1) — exactly what
those rules have now. Nothing about the rendered panel changes, because nothing
carries `.ld-preview--dark` until the preview does.

So the sequence for 3.0 is: the selector change first, on its own, verified as
producing an identical panel — then the preview box on top of it. Doing them
together would mean debugging a new feature and a 146-line rewrite at the same
time. (101 is the count of top-level rules; 146 is the count of selector lines,
which is what was actually edited.)

**Both have now shipped** — the selector change in 2.50.2, the box in 2.51.1.

The box covers the token settings and only those: accent, surface, corner
rounding, density, glass and glow. That is the first bullet of *What it previews*
above, and the set people actually sit and adjust.

`Support\Preview` holds them and `ThemeServiceProvider` is its second caller
rather than keeping a copy — the panel asks for the tokens on `:root`, the box
asks for the same ones on its own class with the form's unsaved values standing
in. One body of code, so the two cannot drift, which is the only way this release
avoids becoming the second place the theme can be wrong.

What is not in the box is everything that is not a token. Layout, the server
list, the terminal and the rest emit rules against Filament's own classes, and a
selector does not follow a box. Those want the full-page mode below rather than a
second attempt at scoping.

Six fields are `live` and no others, which is the answer to the Livewire risk
below: not "apply the tokens in the browser", but "only ask about the settings
the box can draw". A select or a toggle is one interaction and one round trip;
the two colour pickers wait for blur, because a picker emits a value for every
pixel a cursor crosses.

## Risks

**Livewire round trips.** A preview that updates on every keystroke through the
server is slow and heavy. The tokens have to be applied in the browser, with
Livewire only involved when something genuinely has to be worked out on the
server.

**The selector change is 101 rules at once.** It is provably a no-op — same
specificity, and the added alternative matches nothing that exists — but "provably"
and "proven" are different words, and this is the stylesheet the whole panel
hangs on. It goes to DEV on its own, with nothing else in the release.

## Done when

- Every setting the preview shows is provably the same rule the panel uses.
- The preview never writes to `.env`, to storage, or to the cache.
- Turning the preview off leaves the settings page exactly as it is today, for
  anyone who preferred it.
