# Roadmap

Where this plugin is going, and why.

Each file below is one piece of work. They are written to be argued with: if a
plan turns out to rest on something Pelican does not actually do — or on
something it *already* does — the plan is wrong and gets rewritten, not worked
around. That has happened three times now, which is why
[What is possible](00-what-is-possible.md) comes first.

| | | |
| --- | --- | --- |
| [What is possible](00-what-is-possible.md) | — | The levers, and their limits. Read this first. |
| [Server list](server-list.md) | mostly shipped | The page everyone lands on |
| [Console](console.md) | shipped | The page people actually live in |
| [Shell](shell.md) | shipped | Announcements, custom links, the sign-in screen, the sidebar footer |
| [Presets](presets.md) | shipped | Export, import, share, and more to start from |
| [Live preview](live-preview.md) | prototyped | Seeing the change before saving it |
| [Backlog](backlog.md) | — | Ideas without a slot, and what was turned down |

**The files are named by topic, not by version.** They were numbered 2.14 to 3.0
once; shipping the first of them took eight releases and the numbering was wrong
by the end of the week. What ships when is in the git tags.

## The one rule

**No Blade template is overridden.** Everything is CSS, a little JavaScript,
Filament's panel API, and Filament's render hooks.

That is not caution for its own sake. A theme that replaces Pelican's templates
is a theme that breaks on the next panel update, silently, on somebody's live
server — and the person it breaks for is running game servers, not debugging
Blade. Every plan here is checked against that rule before it gets written down.

The cost is real and worth naming: the plugin can restyle and add, but it cannot
remove or restructure what Pelican renders. See
[What is possible](00-what-is-possible.md) for where that line actually falls.

## The rule that had to be learned

**Read Pelican's source before building anything.** A copy of the panel sits in
`pelican-panel-files/` for exactly this.

Three features were built against a guess about markup that turned out to be
wrong, and three more duplicated something the panel already had. Every one of
them cost a release to undo. Five minutes of reading has been cheaper than a
guess every single time it has been tried.

## How a release is cut

1. Everything lands on `DEV` first and is tried on a real panel.
2. `beta` and `main` follow only when it has earned it.
3. Each dev push cuts its own release automatically, so any build can be gone
   back to.

### The version says which channel it is

One minor number per cycle, and the channel is part of the number:

| | |
| --- | --- |
| `2.47.1-dev`, `2.47.2-dev`, … | every push to `DEV`, counting up |
| `2.47.7-beta` | promoting to `beta` keeps the number it had reached |
| `2.47.0` | promoting to `main`, and the sub-versions stop there |

So a version answers "which channel is this and how far along" without anyone
having to look it up, and `main` carries one number per cycle instead of
twenty. The next cycle opens at `2.48.1-dev`.

**The ordering this produces is deliberate and worth knowing.** PHP's
`version_compare` — which is what the update check uses — orders `dev` below
`beta` below no suffix at all, so `2.47.1-dev` < `2.47.7-beta` < `2.47.7`. But
`2.47.0` is *below* `2.47.7-dev`, which means a panel on dev is not offered the
stable release of the same cycle. That is correct: it is already ahead of it,
and the next thing it will be offered is `2.48.1-dev`.

The tag, the release asset and the manifest all carry the same string, so
nothing has to add or strip a suffix on the way through.

## What "done" means here

A feature is done when it is:

- **Not already in Pelican.** Checked, not assumed.
- **Configurable from inside the panel.** No files to edit, no `.env` for
  anything the settings page could ask for.
- **Safe when it fails.** A missing icon, an unreachable feed, a cache that
  cannot be written, a wrapper that Filament renamed: none of them may take a
  page down.
- **Good on a phone.** Not "it fits", but pleasant to use one-handed.
- **English.** Every string in the plugin.
- **Explained.** In the README, in the release notes, and in the code comment
  that says *why* rather than *what*.
