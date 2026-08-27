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
| [Console](console.md) | next | The page people actually live in |
| [Shell](shell.md) | planned | Announcements, custom links, quick actions |
| [Presets](presets.md) | planned | Export, import, share, and more to start from |
| [Live preview](live-preview.md) | planned | Seeing the change before saving it |
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

See the Publishing section of the [README](../README.md) for the mechanics.

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
