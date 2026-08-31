# Backlog

Ideas without a release yet. Some are small and will get folded into whatever
ships next; some are waiting on a decision; a few are here so they stop being
suggested.

## Done

- **Reduced motion** — shipped in 2.45.0. Covers the whole page rather than only
  this theme's own transitions: the preference is about motion, not about who
  wrote which rule, and half a panel still sliding is worse than none of it. The
  durations go to almost nothing rather than to `none`, so anything listening for
  `transitionend` still gets its event.
- **Light mode, first pass** — shipped in 2.45.0, and it was worse than "has had
  less attention". Nine surface tokens existed only under `html.dark`, and every
  block this plugin draws itself is unscoped markup of its own. In light mode
  they found no `--ld-surface` and fell back to a near-black grey: the plugin's
  own cards were black boxes on a white page. There are light values for all of
  them now, and text names one of three ink tokens instead of a fixed shade — a
  shade cannot flip, ink can. Forty-one rules; the ten greys left are scrims and
  bar tracks, which are neutral in both modes and correct as they are.

  **Paper is still not unblocked.** Making the plugin's own components correct in
  light mode is not the same as the panel having a light *preset*: that needs a
  default-mode setting, since the plugin forces `defaultThemeMode(Dark)`.

## Small, will land somewhere
- **Contrast.** The accent ramp is built around whatever hex is entered, and a
  pale accent can produce unreadable text on a raised surface. The picker should
  say so — a warning next to the field, not a refusal.
- **Print.** A page printed from the panel currently prints the dark background.
- **Focus states.** Handled with an outline everywhere because Filament draws its
  focus ring as a box-shadow and the theme replaces box-shadows. It works; it has
  not been checked against a keyboard end to end.
- **A settings search.** Sixty settings across nine folded sections. Typing
  "terminal" should open the one that holds it.

## Shipped from outside the roadmap

- **System status** (2.30.0). Asked for after seeing
  [olligatorugef/pelican_plugins](https://github.com/olligatorugef/pelican_plugins)'
  System Status Monitor (v1.2.2, MIT). Built here rather than vendored: it is
  fifty lines of `/proc` reading, and a page inside this plugin gets the theme's
  own sidebar group, permission model, translation namespace and `.env` storage
  for nothing, where a second plugin would carry a second copy of all of it.

  The one thing worth carrying over from reading theirs: **no shell commands**.
  `nproc`, `uptime` and `free` are the obvious way to get every figure on that
  page, and every one of them needs `exec()` — which a hardened panel host has
  every reason to have switched off. `/proc` and PHP's own functions answer all
  of it and fail quietly on a host that has neither.

## Waiting on a decision

- **Per-user themes.** See [Presets](presets.md) — the storage question has no
  obviously right answer yet.
- **Dutch, and other languages.** Everything in the plugin is English by request.
  Whether that stays true if other people run it is a different question, and the
  translation files are already structured for it.
- **Per-role layouts.** Related to the arranger work in [Live preview](live-preview.md).
  Shows an administrator and a subuser different pages, which is what people
  usually mean when they ask to "hide things from users".
- **Scheduled themes.** A different look at night, or during a maintenance
  window. The scheduler is already there for auto-updates. Whether anyone wants
  their panel changing under them is the open question.

## Learned the expensive way

Kept because each of these cost a release, and each is available to make again.

- **Check Pelican first.** Four card layouts, a filter box and terminal font
  settings were all built against something the panel already had. A copy of the
  source sits in `pelican-panel-files/` and reading it has been cheaper than
  guessing every single time.
- **Read the markup, do not infer it from a screenshot.** The console stat
  blocks, the Egg tab's collapsed grid and the card heights each took two wrong
  attempts and one five-minute read.
- **A setting that always reads back as its default is a type mismatch.** PHP
  turns numeric string array keys into integers, so `['2' => '2']` offers an
  integer and a strict comparison against strings rejects it.
- **Where Pelican offers something per person, it wins.** The theme sets the
  default; the person overrides it. See
  [What is possible](00-what-is-possible.md).

## Considered and rejected

- **Overriding Blade templates.** It is the answer to a third of the requests in
  this file and it is still no. See [What is possible](00-what-is-possible.md).
- **A rich text announcement bar.** Administrator-entered HTML on every page of
  the panel. Plain text with a separately validated link does the job.
- **Bundling an icon font.** The pack picker reads the icon sets already
  installed, plus an upload. Shipping another set means shipping megabytes for
  the four icons someone changes.
- **A theme marketplace.** Export and import in [Presets](presets.md) covers
  handing a look to someone. Hosting other people's files is a different project
  with a different set of problems.

## Known rough edges

Written down so they are not rediscovered:

- **Server card selectors are structural.** `[wire\:id]:has(> .fi-color)` works
  because the card has no class of its own. It is the most fragile thing in the
  stylesheet and every layout in [the server list](server-list.md) leans on it.
- **One rule reaches every element in the server grid.** Making a card fill its
  cell means stretching every wrapper between the grid and the card. Those
  wrappers were named twice and wrong twice, so it is now `*:has(…)` — which
  finds them whatever they are called and costs the browser more. Worth
  revisiting if a long list ever feels slow.
- **The terminal rides on one interception.** Colours, size and (later) schemes
  all depend on Pelican assigning `window.Xterm` as a global. An ES module
  import instead would stop all of them at once, silently.
- **The update job runs the previous version's seeder.** A queue worker holds a
  class for the life of the process. `queue:restart` is called at the end of
  every install to deal with it — but only from 2.11.5 onwards, and only where
  something supervises the workers.
- **Custom CSS has no validation.** It goes into the page as typed. That is the
  point of it, and it means a stray `}` can break the panel's styling until it is
  fixed. A parse check before saving would be cheap and is not done.
