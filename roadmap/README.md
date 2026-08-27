# Roadmap

Where this plugin is going, and why.

Each file below is one release. They are written to be argued with: if a plan
turns out to rest on something Pelican does not actually do, the plan is wrong
and gets rewritten — not worked around.

| | | |
| --- | --- | --- |
| [What is possible](00-what-is-possible.md) | — | The levers, and their limits. Read this first. |
| [2.14](2.14-server-list.md) | Server list | The page everyone lands on, made to look like a product |
| [2.15](2.15-console.md) | Console | The page people actually live in |
| [2.16](2.16-shell.md) | Shell | Announcements, custom links, quick actions |
| [2.17](2.17-presets.md) | Presets | Export, import, share, and more to start from |
| [3.0](3.0-live-preview.md) | Live preview | Seeing the change before saving it |
| [Backlog](backlog.md) | — | Ideas without a slot yet |

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

## How a release is cut

1. Everything lands on `DEV` first and is tried on a real panel.
2. `beta` and `main` follow only when it has earned it.
3. Each dev push cuts its own release automatically, so any build can be gone
   back to.

See the Publishing section of the [README](../README.md) for the mechanics.

## What "done" means here

A feature is done when it is:

- **Configurable from inside the panel.** No files to edit, no `.env` for
  anything the settings page could ask for.
- **Safe when it fails.** A missing icon, an unreachable feed, a cache that
  cannot be written: none of them may take a page down. There is history here —
  see the cache work in 2.13.3.
- **Good on a phone.** Not "it fits", but pleasant to use one-handed.
- **English.** Every string in the plugin.
- **Explained.** In the README, in the release notes, and in the code comment
  that says *why* rather than *what*.
