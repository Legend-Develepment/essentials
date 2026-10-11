# Roadmap

Where this plugin is going, and why.

Each file below is one piece of work. They are written to be argued with: if a
plan turns out to rest on something Pelican does not actually do - or on
something it *already* does - the plan is wrong and gets rewritten, not worked
around. That has happened three times now, which is why
[What is possible](00-what-is-possible.md) comes first.

| | | |
| --- | --- | --- |
| [What is possible](00-what-is-possible.md) | - | The levers, and their limits. Read this first. |
| [Server list](server-list.md) | shipped | The page everyone lands on |
| [Console](console.md) | shipped | The page people actually live in |
| [Shell](shell.md) | shipped | Announcements, custom links, the sign-in screen, the sidebar footer |
| [Presets](presets.md) | shipped | Export, import, share, and more to start from |
| [Live preview](live-preview.md) | shipped | Seeing the change before saving it |
| [The next major number](next-major.md) | shipped | What 3.0.0 is for, and what has to be true before it may be called that |
| [The API, and Discord](api.md) | shipped | A way in from outside the panel. The bot lives in its own repository |
| [What 1.0.0 means for the API](api-one.md) | built | The five things that cannot be changed afterwards |
| [The API after 1.0.0](api-next.md) | built |  What a bot still cannot do, and none of it breaking |
| [More games than ARK](games.md) | eleven built | Which games earn a settings section, and the arithmetic that decides how many |
| [The edges](edges.md) | shipped | Leaving, proving, and the person on the other side |
| [What this costs](weight.md) | answered | Where the time, the queries and the bytes actually go |
| [The shop, audited](shop.md) | shipped | Twenty-four defects that survived being argued with, and four more the fixing found |
| [Backlog](backlog.md) | - | Ideas without a slot, and what was turned down |

**The files are named by topic, not by version.** They were numbered 2.14 to 3.0
once; shipping the first of them took eight releases and the numbering was wrong
by the end of the week. What ships when is in the git tags.

## The one rule

**No Blade template is overridden.** Everything is CSS, a little JavaScript,
Filament's panel API, and Filament's render hooks.

That is not caution for its own sake. A theme that replaces Pelican's templates
is a theme that breaks on the next panel update, silently, on somebody's live
server - and the person it breaks for is running game servers, not debugging
Blade. Every plan here is checked against that rule before it gets written down.

The cost is real and worth naming: the plugin can restyle and add, but it cannot
remove or restructure what Pelican renders. See
[What is possible](00-what-is-possible.md) for where that line actually falls.

## The rule that had to be learned

**Read Pelican's source before building anything.** A copy of the panel sits in
`no-git/pelican-panel-files/` for exactly this - beside the other plugins kept
for reference, in the one folder `.gitignore` already excludes and the build
already leaves out.

It is not in the repository and must not be, so it goes missing: it did in
September, and three faults that month came from using an API without checking
its signature. If it is not there, put it back before planning anything.

Three features were built against a guess about markup that turned out to be
wrong, and three more duplicated something the panel already had. Every one of
them cost a release to undo. Five minutes of reading has been cheaper than a
guess every single time it has been tried.

## How a release is cut

1. Everything lands on `dev` first and is tried on a real panel. That branch is
   in a repository of its own - a private one - so the public repository can be
   read by anybody without the unfinished work being readable with it.
2. `beta` and `main` follow, in the public repository, only when it has earned
   it. Both are source; neither carries a build.
3. A panel gets a release from Pelican Hub and from nowhere else. `.\build.ps1`
   (or `build.sh`) runs every gate and suite and builds
   `dist/essentials-<version>.zip`, and that archive is what is uploaded to the
   Hub, which reviews it before any panel can install it. A beta goes through
   the Hub's Publish to beta. Pelican installs both under Admin → Plugins, from
   the feed `plugin.json` names.

Up to 3.225 the plugin fetched and installed its own releases, from GitHub and
from a private dev feed. The Hub rejected it for that, and it is gone for good:
`tools/check-distribution.js` fails the build on an update_url that is not the
Hub's feed, a release archive or update feed in the repository, a publishing
workflow, a GitHub download address in a shipped file, a call into Pelican's
plugin importer or installer, or an archive extracted whole. It catches the
usual ways back in, not every one: a review is still what keeps it this way.

### The first line of a commit says what changed

It is what somebody reads first in the history, and the Hub's notes for a
version are written from those lines. Not a style preference: it is the
interface.

### The version says how far along it is

One minor number per cycle, and the stage is part of the number:

| | |
| --- | --- |
| `2.47.1-dev`, `2.47.2-dev`, … | every change on `dev`, counting up; only ever on a test panel |
| `2.47.7-beta` | promoting to `beta` keeps the number it had reached |
| `2.47.0` | promoting to `main`, and the sub-versions stop there |

So a version answers "how far along is this" without anyone having to look it
up, and `main` carries one number per cycle instead of twenty. The next cycle
opens at `2.48.1-dev`.

PHP's `version_compare`, which is what Pelican's update check uses, orders
`dev` below `beta` below no suffix at all, so `2.47.1-dev` < `2.47.7-beta` <
`2.47.7`. `2.47.0` is *below* `2.47.7-dev`: a test panel on dev is not offered
the stable release of the same cycle, which is correct, since it is already
ahead of it.

## What "done" means here

A feature is done when it is:

- **Not already in Pelican.** Checked, not assumed.
- **Configurable from inside the panel.** No files to edit, no `.env` for
  anything the settings page could ask for.
- **Safe when it fails.** A missing icon, an unreachable feed, a cache that
  cannot be written, a wrapper that Filament renamed: none of them may take a
  page down.
- **Good on a phone.** Not "it fits", but pleasant to use one-handed.
- **Translated.** English first, then the same key in the other 31 languages.
  `check-lang.js` reports each one's percentage and fails on a key that exists
  in a translation and not in English.
- **Explained.** In the README, in the release notes, and in the code comment
  that says *why* rather than *what*.
