# Backlog

Ideas without a release yet. Some are small and will get folded into whatever
ships next; some are waiting on a decision; a few are here so they stop being
suggested.

## Done

- **Reduced motion** - shipped in 2.45.0. Covers the whole page rather than only
  this theme's own transitions: the preference is about motion, not about who
  wrote which rule, and half a panel still sliding is worse than none of it. The
  durations go to almost nothing rather than to `none`, so anything listening for
  `transitionend` still gets its event.
- **Light mode, first pass** - shipped in 2.45.0, and it was worse than "has had
  less attention". Nine surface tokens existed only under `html.dark`, and every
  block this plugin draws itself is unscoped markup of its own. In light mode
  they found no `--ld-surface` and fell back to a near-black grey: the plugin's
  own cards were black boxes on a white page. There are light values for all of
  them now, and text names one of three ink tokens instead of a fixed shade - a
  shade cannot flip, ink can. Forty-one rules; the ten greys left are scrims and
  bar tracks, which are neutral in both modes and correct as they are.

  **Paper followed in 2.47.3**, once the panel could open light at all - which
  needed the mode and the lock to stop being one setting.
- **A settings search** - shipped in 2.50.3. Seventy-seven settings by then, not
  sixty, which only made the case louder.

  Two decisions worth keeping. It is **not a form field**: a field would join the
  form's state, travel to the server on every keystroke and be handed to
  `persist()` on save, and none of that is a search box's business. And folded
  sections are opened **by CSS rather than by clicking their headers**, because
  Filament remembers the folded state per section - clicking would permanently
  rearrange the page as a side effect of looking for something.

  The honest weakness: the rule that overrides the folding could not be checked
  against Filament 5.7's own section view, which is not published at a path that
  serves that version. It covers both ways a fold is done, a display and a
  height. If it turns out to be neither, the search still narrows the page to the
  right section and that section stays folded - worse, not broken.
- **Contrast** - shipped in 2.50.4, and it took a wrong turn worth recording.

  The obvious build measures the colour that was typed against the surface. Doing
  that would have called the theme's own default accent unreadable: `#ffa500` on
  white scores **1.97**. But the panel never paints that colour on white - it
  paints shade 600, nine points of OKLCH lightness darker, which scores 2.73, and
  on a dark panel it paints shade 400 and scores 10.03. A warning built on the
  entered colour would have been confidently wrong about the shipped default.

  So the check measures the ramp shade the panel actually renders, which needs
  OKLCH back to sRGB - the ramp is built in one direction only. That conversion
  is its own pair rather than Filament's forward with a borrowed reverse, so it
  round-trips exactly.

  And it only speaks about the mode the panel opens in. Orange is genuinely hard
  to read on white; that is worth saying to somebody who has moved their panel to
  light, and worth saying to nobody else.
- **Print** - shipped in 2.50.4. One `@media print` block: paper-coloured tokens,
  no chrome, no artwork, folded sections opened because paper cannot be unfolded,
  and `break-inside: avoid` on cards so a heading never ends up on a different
  sheet from its figures.

- **Custom CSS validation** - shipped in 2.67.1. The field goes into the page as
  typed, which is the point of it, and that made it the one place where a typo
  took the panel's styling down until somebody found it.

  Two decisions worth keeping. It **warns and saves anyway**: the field exists so
  somebody can write what this plugin has not thought of, and a validator
  confident enough to reject would eventually reject something valid. And it
  **counts rather than parses** - braces and comment markers, skipping strings
  and comments - so half of `tools/css.test.js` is the false alarms a naive count
  would raise: a brace inside `content: "}"`, one inside a commented-out rule, an
  escaped quote, a url with a brace in it. A check that cries wolf on valid CSS
  is one people stop reading, which is worse than not having one.

## Small, will land somewhere
- **Focus states, the half a person has to do.** 2.84 did the checkable half:
  every control this plugin draws itself now has a ring, and
  `tools/check-focus.js` fails the build for one that does not. Seven had none
  - the console button, the arranger's toolbar and scope picker, the drag
  handles, and three links. What a gate cannot say is whether a ring is *visible
  against what is behind it*, which needs a keyboard and a screen.
- **The phone pass, second half.** 2.76 did the part that can be checked from
  here: the dense grids say what they do at each width now, in the API rather
  than in a media query written against markup this codebase cannot read, and
  the standing prose on the two admin pages that had three paragraphs each folds
  away. What is left is judgement, and it needs a phone in one hand: ARK world
  settings, Valheim player lists, Game players, Server access, Backups overview,
  Public status admin, My status page, the Other games tab, Panel activity, and
  the timed-looks section on Look.

## Shipped from outside the roadmap

- **System status** (2.30.0). Asked for after seeing
  [olligatorugef/pelican_plugins](https://github.com/olligatorugef/pelican_plugins)'
  System Status Monitor (v1.2.2, MIT). Built here rather than vendored: it is
  fifty lines of `/proc` reading, and a page inside this plugin gets the theme's
  own sidebar group, permission model, translation namespace and `.env` storage
  for nothing, where a second plugin would carry a second copy of all of it.

  The one thing worth carrying over from reading theirs: **no shell commands**.
  `nproc`, `uptime` and `free` are the obvious way to get every figure on that
  page, and every one of them needs `exec()` - which a hardened panel host has
  every reason to have switched off. `/proc` and PHP's own functions answer all
  of it and fail quietly on a host that has neither.

## Waiting on a decision

Nothing, at the moment. Everything that was here has been built, and leaving it
listed sent people to look for work that was finished.

- ~~**Dutch, and other languages.**~~ Built. 32 locales ship complete, each with
  its own admin page, a language per account and an upload for one of your own.
  The decision the entry was waiting on was made by building it.
- ~~**Per-role layouts.**~~ Shipped in 2.70 as a third scope in
  `Support\Layouts`, and the settings page says what an arrangement is not: a
  block a role hides is still a block somebody could reach by typing the address.
- ~~**Scheduled themes.**~~ Shipped in 2.71 as `Support\Windows`, and the open
  question - whether anybody wants their panel changing under them - was
  answered by leaving the list empty and letting them decide.

## Learned the expensive way

Kept because each of these cost a release, and each is available to make again.

- **Check Pelican first.** Four card layouts, a filter box and terminal font
  settings were all built against something the panel already had. A copy of the
  source sits in `no-git/pelican-panel-files/` and reading it has been cheaper
  than guessing every single time. It has also gone missing once, which is worth
  knowing: the month it was absent produced three faults from using an API
  without checking its signature.
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
  wrappers were named twice and wrong twice, so it is now `*:has(…)` - which
  finds them whatever they are called and costs the browser more. Worth
  revisiting if a long list ever feels slow.
- **The terminal rides on one interception.** Colours, size and (later) schemes
  all depend on Pelican assigning `window.Xterm` as a global. An ES module
  import instead would stop all of them at once, silently.
- **The update job runs the previous version's seeder.** A queue worker holds a
  class for the life of the process. `queue:restart` is called at the end of
  every install to deal with it - but only from 2.11.5 onwards, and only where
  something supervises the workers.
- **The public surface is seven routes, not two.** This entry used to say the
  status feature was the only one, with two routes in front of it. Counted
  against `ThemeServiceProvider` there are seven registered without Laravel's
  `auth`, and knowing which is the whole point of writing it down:

  | | |
  | --- | --- |
  | `GET /status` | the panel's own status page |
  | `GET /status/{slug}` | one person's |
  | `GET /shop` | the public shop |
  | `GET /essentials/tickets/file/{token}` | a ticket attachment, by token alone |
  | `POST /essentials/tickets/hook/{secret}` | the support desk's webhook |
  | `POST /essentials/pay/{gateway}/webhook` | a payment provider's |
  | `GET /essentials/upload/{order}` | a daemon fetching an upload, `signed` |

  Each of them is deliberate and each is switched off with its own feature. What
  the entry was right about stands: everything drawn on the status pages is
  opted into by name and built from a snapshot, `tools/status.test.js` covers
  those rules, and anything anybody can reach deserves rereading whenever
  something near it changes.

  **All seven were then traced**, one reader each, and every claim handed to a
  second reader whose job was to refute it. Two survived and both are fixed:

  - `Publish::build()` read its lock and then wrote it, which is a
    check-then-act, and gave it a lifetime equal to the page's display interval
    - so a build that ran longer than a minute let the next request start a
    second one, and the every-minute scheduled rebuild met its own previous lock
    about as often as it did not. That is what left the building on an anonymous
    request's path. It is `Cache::add()` now, released in a `finally`.
  - PayPal's webhook made an authenticated call to PayPal for any POST at all,
    including one with none of the five signature headers on it. Stripe checks
    its signature locally first and Mollie checks the shape of an id; PayPal now
    refuses locally what PayPal could never verify. Not a second opinion about
    the signature - that stays PayPal's - only that a signature which was not
    sent cannot be one.

  Six were refuted, and two of those are worth keeping because the mechanism is
  real and only the consequence was not:

  - **The markdown link pass can be made to break out of an `href`**, and cannot
    be reached: the only characters that do it come from the class's own fixed
    code-fence wrapper, never from what anybody typed. It is one changed wrapper
    away from being reachable.
  - **`Purchase::refusal()` counted the orders table once per package** to
    decide which cards to grey out, on both the public shop and the panel's own.
    Not a way in, but a page anybody can open should not run thirty counts. Both
    now hand it the map `stockLeftMany()` already builds.
