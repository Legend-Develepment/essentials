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

### Full-page preview

The small panel answers "what does this token do". It does not answer "what does
my panel look like". A second mode opens the real panel in a pane with the
unsaved settings applied — the same CSS the render hook emits, sent to a preview
route instead of written to `.env`.

Saving is still saving. The preview never writes anything.

### The arranger, everywhere

The page arranger works on pages built from Filament's grid. Extending it means
teaching it the pages that are not — the console, the file manager — and giving
it a way to say "this page cannot be rearranged" instead of offering handles that
do nothing.

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
together would mean debugging a new feature and a 101-rule rewrite at the same
time.

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
