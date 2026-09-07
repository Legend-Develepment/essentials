# The next major number

What 3.0.0 is for, and what has to be true before it is allowed to be called
that.

**Named by topic rather than by version, like every other file here** — and this
one had to argue for it, because it is about a version. It keeps the topic name
because the topic is *what earns a major number*, which outlives being wrong
about which number it turns out to be. The last time this roadmap wrote versions
into filenames it was wrong by the end of the week.

## What a major number has to mean

The version scheme already says what a minor is: one cycle, one number on `main`.
Nothing anywhere says what a major is, and 2.x has now run ninety-three dev
cycles without needing one — because every one of them was the same shape. A
page, a setting, a widget, a language, a fix. More of what was already there.

A major number is worth spending once, on the release where the shape changes.
Three things change shape here, and any one of them alone would be a large 2.x:

1. **The plugin becomes reachable from outside the panel.** Everything until now
   is a page somebody opens while signed in, plus one public status page built
   from a snapshot. An API is a different kind of surface carrying a different
   kind of risk.
2. **The plugin owns data for the first time.** Ninety-three cycles with no
   table. That was right every time and is wrong for a token somebody has to be
   able to revoke.
3. **It stops being only an administrator's plugin.** Twenty-one admin pages
   against three things on the client side. The backup warning in 2.83 was the
   first thing built for the person whose servers they are; 3.0 finishes that
   thought.

**The honest test, to be applied before promoting anything:** if 3.0.0 could have
shipped as 2.94.0 and nobody would have noticed the difference, the number was
wrong. What makes it not 2.94.0 is that afterwards this plugin has a surface
outside the panel and data of its own — two things that change what "safe when it
fails" has to mean.

## Pillar 1 — a way in from outside

All of it is in [The API, and Discord](api.md), including the finding that
decides most of it: Pelican already has a client API, an application API, and
webhooks with a Discord type. The plan is mostly about what not to build.

The short version: this plugin answers the questions nothing else can — who is
playing, what has no backup, whether another server fits, what the watchdog
thinks — and links a Discord account to a panel account. It does not control
servers. Control goes through Pelican's own client API, which already enforces
permissions and writes the activity log.

## Pillar 2 — the person's side catches up

The asymmetry, counted: `src/Filament/Admin` has twenty-one pages.
`src/Filament/App` has two pages and one widget. This is an administrator's
plugin that happens to be installed for everybody.

**What this is not: a second server list.** Pelican's list is good, it is already
searchable and filterable server-side, and there is no hook inside a card — see
[What is possible](00-what-is-possible.md). Building one would be the fourth
thing on that list of features undone for duplicating the panel.

What is missing is the question the list *cannot* answer: **which of mine needs
attention.** That is the same relationship the Backups overview has to Pelican's
per-server backup page, which the README already describes as its inverse.

Two pieces:

- **The warning above the list grows past backups.** It says stale backups today.
  The same widget can say: a schedule that has stopped, a machine that is not
  answering, a server that has been offline a week. One line, still drawn only
  when something is wrong, still silent on a healthy panel — which is the rule
  that makes anybody read it.
- **A page that lists a person's servers by what is wrong with them**, with
  players online, last backup, next schedule and the health of the machine
  underneath. Every figure on it already exists in `src/Support` and is already
  scoped by `accessibleServers()`.

And the half that reaches them when they are not looking: `OWNER_ALERTS` today
tells somebody their node is down. It could tell them their backup has not run —
which is the thing people find out on the day they need one. Same rules as the
existing one: the bell rather than email, no reminders, subusers not told.

## Pillar 3 — finishing what the definition of done already requires

The roadmap's own list of what "done" means says: *Good on a phone. Not "it fits",
but pleasant to use one-handed.* Ten pages are named in the backlog as failing
it, and 2.76 only did the half that can be checked from here. Focus states are
the same shape — 2.84 gated what a script can see, and whether a ring is visible
against what is behind it needs a keyboard and a screen.

A major release that opens a new surface while leaving its own definition of done
unmet is a major release that skipped its own rules. This is the pillar that will
feel like the least fun and is the least optional.

The named list, from the backlog: ARK world settings, Valheim player lists, Game
players, Server access, Backups overview, Public status admin, My status, the
Other games tab, Panel activity, and the timed-looks section on Look.

## What is deliberately not in 3.0

- **Overriding a Blade template.** Still no, and a major number is not permission
  to. It is the one rule, and the reason a Pelican update cannot break a panel
  running this.
- **The console as a drawer.** [What is possible](00-what-is-possible.md) calls
  it reachable but expensive: our own component against the same websocket, kept
  working through every Pelican change. A release already spending its risk on a
  new outside surface should not also spend it here.
- **A theme marketplace.** Rejected in the backlog, rejected still.
- **Anything Pelican's API or webhooks already do.** See [api.md](api.md).

## The numbering, and the trap in it

The 3.0 cycle runs `3.0.1-dev`, `3.0.2-dev`, … on `DEV`, promotes to `3.0.n-beta`
keeping the number it reached, and lands on `main` as `3.0.0`. That is the scheme
the roadmap already describes, with a bigger first digit.

**The trap is on the far side.** `build.ps1` refuses a pre-release that does not
outrank stable, comparing on the number with the suffix stripped — which is what
stops the fault `2.48.3-dev` shipped, where every panel on the channel was
offered an update that never went away. After `3.0.0` is on `main`, the next dev
build must be `3.1.1-dev`. Not `3.0.2-dev`: that sorts *below* the stable release
it follows, and the build will say so.

## The order, and why

1. **[api.md](api.md) steps 1 and 2** — the tables, the token, the admin page,
   one endpoint. The structural, riskiest thing first, while there is a whole
   cycle left to be wrong about it. A first table discovered to be wrong in
   `3.0.9-dev` is a migration somebody has already run.
2. **Pillar 3's phone pass, alongside it.** It needs a phone in one hand rather
   than a keyboard, so it does not compete for the same hours.
3. **[api.md](api.md) steps 3 and 4** — the link, and the per-person endpoints.
4. **Pillar 2**, which is the part people will actually notice, and which is
   easier to design once the API has made us say out loud what a person's own
   servers look like as data.
5. **The bot**, in its own repository, once the API has stopped moving.
6. **Promote when it has earned it**, which is the same rule as every other
   release and not a date.

## What could make this plan wrong

Kept here so it is checked rather than assumed, in the spirit of the rest of the
roadmap:

- **Pelican ships an account-link or a player list.** Then most of pillar 1 goes,
  and the honest move is to delete it rather than keep a worse copy. Check before
  each step, not once at the start.
- **The first table turns out to be avoidable.** If linking can be made
  single-writer per person and the reverse lookup is not needed — it is, but it
  is worth being sure — then no table, and one of the three arguments for a major
  number goes with it.
- **Nobody wants a bot.** The API's read half stands on its own and the link half
  does not. If the bot is the only caller and the bot never gets written, this is
  a large amount of surface for nothing, and it should be cut back to the read
  endpoints and left there.
