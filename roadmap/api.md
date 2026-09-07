# The API, and Discord

A way in from outside the panel, and a bot that can use it.

**Step 1 shipped in 3.0.1-dev.** This is the piece that earns the next major
number — see [The next major number](next-major.md) — and it is written first
because most of its design is decided by what Pelican already does.

## What Pelican already does

Read before planning, per the rule at the top of the roadmap. All three of these
are in `no-git/pelican-panel-files`, and all three are finished work:

| | |
| --- | --- |
| **Client API** | `/api/client`, routed in `routes/api-client.php`. Power, resources, the websocket, files, backups, schedules, databases, subusers. Authenticated with an `ApiKey` of `TYPE_ACCOUNT` through Sanctum, and every server route runs `AuthenticateServerAccess` — so a key can only ever reach what its owner can. |
| **Application API** | `/api/application`, routed in `routes/api-application.php`. Users, nodes, servers, allocations, eggs, mounts. `TYPE_APPLICATION` keys with an ACL over each. |
| **Webhooks** | `WebhookConfiguration`, global or per server, fired by `DispatchWebhooks` from eloquent events and the activity log and queued through `ProcessWebhook`. `WebhookType` already carries a **Discord** case, and there are admin *and* server pages to configure them. |

**So this plan is mostly about what not to build.** No power endpoints. No second
webhook system. No second permission model. A bot that wants to restart a server
uses Pelican's client API, which already checks subuser permissions and already
writes the activity log — two things a second implementation would have to get
right and then keep right through every Pelican release.

This is the fourth time reading Pelican first has deleted most of a plan. The
three before it are in [What is possible](00-what-is-possible.md), and every one
of those was read *after* the code had been written.

## What is actually missing

Four things, each missing for a reason rather than by oversight.

**1. The questions only this plugin can answer.** Neither Pelican API knows who
is connected to a game server right now, which servers have no backup, whether
another server fits on a node, what the panel host's own disk is doing, what the
watchdog currently thinks is wrong, or which schedules have stopped. Every one of
those is a method that already exists in `src/Support`, worked out for a page
somebody looks at. An endpoint is a second reader of an answer that already
exists.

**2. An identity for a bot.** Pelican's account keys belong to a person and its
application keys are an administrator. A bot is neither: it acts for many people
at once, and the panel should be able to see it, throttle it and revoke it as one
thing.

**3. A link between a Discord account and a panel account.** This is the whole
difference between a bot that is useful and a bot that is a demonstration.
`/servers` has to list the servers of the person who typed it.

**4. Events Pelican's webhooks cannot see.** They fire on models and on the
activity log. "The node stopped answering" writes neither.
`Support\Alerts\Watchdog` already works out exactly those transitions and already
posts them to a Discord webhook URL. What it cannot do is hand one to a bot in a
shape a bot can act on.

## The shape

### The plugin does not control servers

The decision everything else follows from. Linking mints a Pelican account key
for that person, and the bot uses it against `/api/client`. This plugin answers
questions and holds the link. It never grows a power endpoint — so there is never
a power endpoint here to secure, to audit, or to get wrong.

Minting a key on somebody's behalf is a real capability and is worth naming as
one. What makes it acceptable is that all five of these are true at once:

- the person does it themselves, from a page that says in plain words what it
  will create
- it is a real Pelican key, so it appears in their own **Account → API keys** and
  can be revoked there without this plugin's help
- the memo says where it came from
- `expires_at` is set, so a link somebody forgot about dies on its own
- **this plugin stores the key's `identifier`, never the token.** Pelican's
  identifier is the public half: enough to revoke a key, not enough to use one.
  A compromise of the panel side leaks no credential.

### Two kinds of caller

`/api/essentials/v1/…`, versioned in the path from the first release, because a
bot living in somebody else's repository cannot be redeployed by us.

| Caller | Sends | Gets |
| --- | --- | --- |
| A bot | `Authorization: Bearer <bot token>` | the panel-wide questions |
| A bot acting for a person | the same, plus `X-Essentials-Actor: discord:<id>` | the same questions, narrowed to that person's servers |

Each endpoint is a reader of something that already exists:

| | |
| --- | --- |
| `GET /health` | whether the API is on, which version, what this token may do |
| `GET /nodes` | `Support\Machines`, `Support\NodeHealth` |
| `GET /nodes/{node}/capacity` | `Support\Capacity` |
| `GET /backups` | `Support\Backups` — none, stale, failing |
| `GET /schedules/stopped` | `Support\Schedules` |
| `GET /alerts` | `Support\Alerts\State`, which is a JSON file already, so this one is nearly free |
| `GET /system` | `Support\SystemStatus` |
| `GET /servers/{server}/players` | `Support\Games`, `Support\Minecraft` |
| `GET /me/servers`, `GET /me/backups` | the same questions, scoped to the actor |
| `POST /link/start`, `POST /link/claim`, `DELETE /link` | the link flow |

### The permission rule

**A bot may never see or do more than the person it is acting for.** Every
per-person endpoint goes through `accessibleServers()` — the same call
`Support\Backups::query()` already makes — rather than deciding for itself who
may see what. That is the rule the rest of the plugin follows, and the reason
none of it has ever shown somebody a server they could not open.

Panel-wide endpoints sit behind the bot token, which an administrator creates, so
they carry what an administrator may see and nothing about anybody's account.

### The link flow

Each side proves the identity it owns, which is the whole security property:

1. The person signs in to the panel — proving who they are there — opens
   **Account → Discord**, presses Connect, and gets a six-character code good for
   ten minutes and one use.
2. They type `/link <code>` in Discord — proving who they are there. The bot
   posts it to `POST /link/claim` along with the Discord id.
3. The plugin binds the two, mints the account key and returns it once. The bot
   stores it, and from then on talks to Pelican's client API directly.
4. Either side can cut it. Unlinking in the panel deletes the Pelican key, so the
   bot's copy is dead the same second — it does not depend on the bot behaving.

An unsolicited `/link` can create nothing: the code exists only because somebody
signed in and asked for one.

**The part that cannot be designed away:** a bot that restarts your server on a
Discord command holds something that lets it. No arrangement avoids that. What
can be decided is what that something is, how visible it is and how fast it can
be taken away — and the answers above are a real Pelican key, listed on the
person's own account page, revocable from both ends.

### Where it lives — the first table

Ninety-three dev cycles and no migration. Favourites, per-user layouts, per-user
styles and the watchdog's state are all files under
`storage/app/private/legend-theme`: each one a deliberate choice, each one still
right.

This is the first thing that is not, for three reasons that are all the same
property seen from different sides:

- **Two people can link at the same time.** A shared index file has a lost-update
  race, and a file per person cannot answer "which panel user is this Discord id"
  without reading every file on the disk.
- **Revocation has to be certain.** A file write that quietly failed is a token
  that still works.
- **An administrator has to be able to list them.** A table is a list; a
  directory is a scan.

Two tables: `essentials_bots` (memo, hashed token, scopes, allowed IPs, last
used, expiry) and `essentials_links` (panel user, Discord id, the Pelican key's
identifier, when, and which bot did it).

Considered and rejected: **Pelican's `users.external_id`.** The column exists and
has an endpoint of its own (`/api/application/users/external/{external_id}`),
which is exactly why it must not be taken — it is what billing integrations use,
and a panel running both would have them fight over one column.

Uninstall already has a path. `database/migrations/…clear_caches.php` exists only
for its `down()`, which is the one hook Pelican runs when a plugin is removed, so
the new tables get dropped there. That means **uninstalling the plugin unlinks
everybody.** It is the right behaviour, and it has to be said on the page rather
than discovered.

### The bot itself

**A separate repository.** This plugin installs into a panel and must not grow a
long-running Node process. What ships here is the API, the account page, the
admin page, and documentation precise enough that somebody could write their own
bot in an evening. What ships there is a discord.js bot using this API for the
questions and Pelican's client API for the commands.

## What it must not become

- a second way to start a server
- a second webhook system
- a way for a bot to reach past the person it is acting for
- a reason for the status page's rules to get looser

## Risks

- **The public surface more than doubles.** Today it is two throttled routes
  serving a snapshot, and the backlog already says those deserve rereading
  whenever anything near them changes. Authenticated is different from safer.
- **Tokens must not touch `.env`.** Everything in this plugin is stored there
  through `EnvironmentWriterTrait`, and none of this may be.
  `tools/check-export.js` exists to catch settings the export cannot see, so it
  will have to be taught that these are deliberately outside it.
- **Rate limiting is not optional.** A bot asking forty servers for their player
  lists is forty A2S queries. `Support\Games` already caches; every response says
  how old the answer it carries is, and the API refuses to become a load
  generator pointed at somebody's game servers.
- **Pelican may grow its own.** If it adds a player list or an account link, this
  goes. That has happened three times, and the right move each time was to delete
  ours rather than keep a worse copy.

## Build order

Each step is shippable on DEV by itself, which is the point of the order.

1. ~~**The table, the key, the pages, and `GET /health` only.**~~ **Done in
   3.0.1-dev.** A surface that can be switched on, seen and revoked before it
   can answer anything.

   Three things came out differently from the plan, and all three are worth
   keeping:

   - **One table, not two.** `essentials_api_keys` holds a key and the request
     that becomes one, because they are the same row at two points in its life
     and a separate requests table would mean the administrator's page is a join
     of two lists that must never disagree. `essentials_links` waits for step 3,
     where something will actually write it — an unused table is a shape nobody
     has tested.
   - **People ask for their own.** Not in the original plan. Anybody signed in
     may ask for a key that answers only for the servers they can already open,
     and granting, refusing and revoking are the acts behind the permission. The
     approval step is a setting, on by default: a panel where anybody mints
     themselves a key on sign-in is a reasonable thing to want and a bad thing to
     arrive at without having chosen it.
   - **No middleware group, and that had to be read rather than assumed.**
     Pelican's own `api` group is `auth:sanctum` and four others, so using it
     would have put this behind a *Pelican* key and the plugin's own key would
     never have been looked at. `web` would have been worse. A throttle and
     nothing else is what an endpoint that authenticates itself wants.
2. ~~**The read endpoints**, over what `src/Support` already works out.~~
   **Done.** Seven of them: `/me/servers`, `/me/backups`, `/backups`, `/nodes`,
   `/system`, `/schedules`, `/alerts`. Two things came out of building them:

   - **The reader has to be a parameter.** `Backups::query()` scopes through
     `user()`, which is null on a request carrying a key - so it would have
     answered every bot with an empty list in a 200, which is the exact fault
     that silenced every backup alert for several releases.
     `Backups::forUser()` is the same scope with the reader passed in, and
     `tools/check-watchdog.js` now reads the API for that hazard as well as the
     watchdog. It was extended in the same commit as the first scoped endpoint,
     which is the only order that ever catches anything.
   - **Player lists are deliberately not here.** Every other endpoint reads
     something already worked out; a player list is forty A2S queries to forty
     game servers, and the rate limiting that makes that safe is a slice of its
     own rather than a line in this one.
3. ~~**The link flow** and the account page.~~ **Done.** The panel gives a
   six-character code to somebody who has signed in, Discord posts it back with
   the id of whoever typed it, and the panel mints a real Pelican account key -
   `identifier . token`, which is what `ApiKey::findToken()` reads - and hands
   it over once. Three things worth keeping:

   - **Only the identifier is stored.** Pelican's public half is enough to
     revoke a key and never enough to use one, so a panel whose database is read
     leaks no way to act as anybody.
   - **The three bot endpoints need a panel-wide key.** A personal one must not
     reach them: it would let whoever holds it bind arbitrary Discord accounts
     and read who else is connected.
   - **Ending it deletes the Pelican key first and the row after.** The worst
     case is then a row pointing at a key that is already gone, rather than a
     credential still working with nothing in the panel admitting it exists.

   The word itself is avoided throughout - `tools/check-banned.js` refuses it
   followed by a bracket, because Pelican Hub's scanner reads for it.
4. ~~**The per-person endpoints.**~~ **Done** - they landed with step two,
   scoped through the key's owner. What was held back until now is the one
   endpoint that asks a game rather than the panel:
   `GET /servers/{server}/players`.

   It was worth holding back and it turned out to need no new machinery. Both
   readers already cache on the address for twenty seconds, so a hundred bots
   asking at once is one query; the per-key ceiling caps how often any key may
   ask; and the answer carries `max_age_seconds`, so a bot can tell a held
   answer from a fresh one. The distinction that needed writing down is that
   **no answer is not an empty server** - a game that did not reply gives null,
   because a bot told "zero players" would report an outage as a quiet
   evening.
5. **The documentation**, and then the bot in its own repository.
6. **The watchdog's outbound target**, so a bot hears about a dead node instead
   of asking every minute whether one is.
