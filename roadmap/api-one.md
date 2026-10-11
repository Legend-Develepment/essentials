# What 1.0.0 means for the API

The API was at `0.0.2` and the owner wanted to call it `1.0.0`. This is what had
to be true first, and all of it now is: **the API is 1.0.0.**

**Named by topic, like everything else here**, and for the reason the last
version-shaped plan had to argue: the topic is *what earns the number*, which
outlives being wrong about which number it turns out to be.

## The two versions, and which one this is about

There are two, and they mean different things:

| | |
| --- | --- |
| `v1` in the path | the shape of what comes back |
| `api` in the body | this implementation, now `0.0.2` |

A bot reads the second and refuses to be surprised by it. That was written into
the first release and it is still right.

**So 1.0.0 is not a feature count. It is the moment `v1` stops being a
placeholder.** Until now the path said `v1` and nothing was promised by it: the
shapes could still move, because nothing had been called finished. Calling the
implementation 1.0.0 says the shape is settled, and from that day the only way to
change a shape is `v2` - a second path, both served, everybody's bot rewritten.

That single fact decides the whole plan. **Everything that has to change about a
shape has to change before 1.0.0.** Everything that is only an addition can wait,
because adding a field breaks nobody.

Which is why the list below is short and unglamorous. It is not what would be
nice to have. It is what we would be stuck with.

## How this was worked out

Six readers, one per dimension of the question: what we would regret promising,
what silently truncates, what the HTTP contract owes a caller, what a key
promises, what is missing, and what should be writable. Every proposal then went
to a second reader told to throw it out unless it survived five questions - is
the problem real, does Pelican already do it, is it actually breaking, is it a
second reader of an answer that exists, and would the person running this panel
be better off.

Twenty-four proposals. Ten survived. Fourteen were thrown out, and the good ones
are named at the bottom, because a plan that only records what it kept teaches
nothing.

## Where it stands

All five blockers are done. What is left before 1.0.0 may be called that is one
decision nobody had put to anybody, which is the section under them.

| | |
| --- | --- |
| Blocker 1 - shapes that disagree | done |
| Blocker 2 - one timestamp format | done |
| Blocker 3 - fields that come and go | done |
| Blocker 4 - lists that stop short | done |
| Blocker 5 - a knowable, closed grant | done |
| The ability names | closed: the reads keep theirs, a write says so in its own |
| **Called 1.0.0** | **done** |

Four faults were found while doing them that were not 1.0.0 questions at all, and
each went out the day it was found. They are listed at the bottom.

## Already fixed, because they were not plans

Three of the findings were live faults rather than 1.0.0 questions, and went out
in the same release as this file:

- **HEAD walked past the ability check.** `Route::get` registers GET and HEAD
  together; every entry in `Docs::endpoints()` says GET; so `abilityFor()` found
  nothing for a HEAD, returned an empty string, and the guard reads an empty
  ability as "not behind one". Proved on the live panel: one key, told in as many
  words that it may not read the shop, answered **403 to `GET /shop` and 200 to
  `HEAD /shop`**. No figure left, because HTTP drops the body of a HEAD. What did
  leave is the answer to "does this exist and would it have worked", from a key
  that was refused.
- **A 404 from an endpoint left as a 503.** Two endpoints `abort(404)` for a
  server the key's owner cannot open, inside a closure whose `catch (Throwable)`
  turns everything into 503 unavailable. 503 tells a well-behaved client to back
  off and retry a request that can never succeed.
- **A key set to unlimited was throttled to one request a minute.** `rate` of
  nought means no ceiling, which was handed straight to
  `tooManyAttempts($bucket, 0)`: the first request of each minute found the
  counter reset and went through, every one after it was refused.

---

## Blocker 1 - the documented shape and the real shape already disagree

Three endpoints return a body that is not the body the panel page, the Markdown
download and the OpenAPI file all describe, and `tools/check-api-docs.js` reports
everything in order because it compares paths and names, never fields.

`/nodes` and `/system` hand back whatever their support class returns:
`NodeHealth::read()` and `SystemStatus::all()` were written for a dashboard card,
and publishing them means a card cannot be reshaped without it being a `v2`.

**Done.** `/nodes` and `/system` name every field they publish, in the endpoint,
and the names are the ones already on the wire - correcting the documentation to
the wire breaks nobody, where correcting the wire to the documentation would
break whoever read it off a real answer. `NodeHealth::read()` and
`SystemStatus::all()` can be reshaped for a card again without it being a v2.

Two things came out of it that the plan had not seen. `/system` published eight
fields and documented three, and inside them `cores` and `processes` were present
on most panels and absent on some, because the reader only adds what it could
read - so a caller had to test for two fields that come and go. Every key is
always there now, null where unknown. And the four uuids in the examples were
eight characters, which is not a uuid: anybody copying one landed in a 404 they
could not explain.

## Blocker 2 - one timestamp format, said once

`last_backup_at` is the only `*_at` in the API that leaves without a UTC offset,
because it is whatever the database driver printed. `new Date('2026-09-05
03:00:00')` is invalid in Safari and local time in Node, so the same backup reads
as a different hour depending on where the bot runs - which is how a fresh backup
gets reported as stale.

**Done.** One helper, called at both emission points, the examples corrected, and
the promise said once in the documentation: **every timestamp in this API is
ISO-8601 with an offset**. That sentence is the part that makes it a 1.0.0 item
rather than a bug fix - it is breaking to add after callers have written against
a mix, and it is what stops endpoint twenty reintroducing the drift.

## Blocker 3 - fields that come and go

`/servers/{server}/players` returns three different shapes depending on which
branch answered, and `online` means two different quantities: the length of a
list on one branch and a declared count on another. A caller cannot write one
parser.

**Done.** Six fields on every branch, null where that game did not say, never
absent - and `online` is the server's own declared figure on both branches rather
than `count($rows)` on one of them. The documentation says the sentence a bot
author actually needs: the list may be shorter than the number, because some
games answer the player query with fewer rows than they are running.

## Blocker 4 - a list that stops short without saying so

Five endpoints return a list with no ceiling at all, and one of them,
`/backups`, hydrates every server on the panel to report the handful with no
backup. The others stop at a constant and the caller cannot tell a short list
from a complete one.

**Done.** A ceiling of a hundred rows on each, and a `*_total` beside every list
saying how many there really were. No cursor: the queries behind these are
ordered by computed columns and a cursor cannot be built honestly over an order
the database works out per row. The count is the better answer anyway - "47
servers have no backup" is what a bot posts, not a list of 47.

The ceiling matters most on `/connect/{discord}/servers`, which asks Pelican four
permission questions per row: on a panel with nine hundred servers an
administrator's key was three thousand six hundred of them in one request.

## Blocker 5 - what a key may do has to be knowable and closed

Two halves of one problem.

A key cannot read its own grant: there is no way to ask what abilities it holds,
so a caller discovers a refusal by being refused. `/health` is the endpoint for
it, and what it publishes must be the **effective** list - what the key holds,
narrowed by what its scope can reach - because that is the rule the code already
enforces and anything else is a promise that is not kept.

And an empty ability list currently means *everything the scope allows*. That
rule was written for a column added mid-life and is right for reads. The moment
1.0.0 grows a write ability, every key already issued holds it without anybody
having granted it, and after 1.0.0 there is no compatible way out: leave it and
each release hands new powers to old keys, close it and narrow keys that are
working.

**Done, and the second half turned out to be a live hole rather than a
precaution.** `/health` publishes the effective list - what the key holds,
narrowed to what its scope can reach.

And an empty list now means nothing. It used to fall in with null and mean
everything, so **unticking every box on the key form handed back a key that
answered the shop, the nodes and the watchdog**: the narrowing control did the
opposite of its name at its far end. Proved on a live panel rather than argued.
`mint()` folded the empty array to null on the way in and `may()` read null as
consent; the two are told apart now, and no key that exists changes behaviour,
because no row could hold an empty list until today.

---

## The one thing still open - what the ability groups are called

This was not in the first version of this plan, because it took reading Modora's
own developer portal to see it.

Their platform is twelve products, each at `api/<product>/v1`, each behind a
module switch, and the permissions on a key are **dotted pairs of a resource and
a verb**: `tickets.read`, `tickets.create`, `messages.write`, `panels.read`. A key
carries a set of those, a new key gets a stated `default_scopes`, and `/ping`
tells a key what it holds.

Ours are six coarse groups named after who is asking rather than what is being
asked: `health`, `me`, `panel`, `shop`, `live`, `connect`.

**Both are defensible and only one of them can be chosen after 1.0.0.** Renaming
an ability breaks every key that holds it and every bot that reads `/health`, so
this is the last release it is free in.

The case for changing:

- `resource.verb` says what it permits. `panel` says who is asking.
- The first write ability this API ever grows will want a verb in its name, and
  `connect` already sits awkwardly as the one group that is not a reading.

The case for leaving it:

- Six groups fit on a form somebody ticks. Twenty do not, and the page that
  grants a key is read by a panel administrator rather than by a developer.
- The groups are not arbitrary: `me` and `panel` are a *scope* distinction that
  a resource name cannot carry, and the shop group exists because money is
  different from machines, which `shop.read` would say less clearly.
- Nothing about matching a partner's vocabulary makes a bot easier to write. The
  bot reads our documentation either way.

**And one argument for changing was withdrawn after reading their scope list
rather than their scope format.** It said that somebody building a module writes
against both vocabularies at once and would get them confused. They do not
overlap at all: across all twelve products Modora publishes nothing that reaches
a server, a node, a backup or an invoice. `panels.read` is not a hosting panel -
it lists the ticket panels configured in a Discord server. Every scope they have
is about Discord and every ability here is about the panel, which is the
division the README already draws, restated as permissions.

That cuts both ways and is worth being honest about. Two vocabularies that never
name the same thing are not a thing to get confused about, so the strongest
argument for renaming is gone; and matching the *shape* of a vocabulary whose
*contents* share nothing is decoration rather than interoperability.

**My reading is to leave them**, and the README now says what each group reaches
beside the fact that Modora has no equivalent for any of it. The groups answer
the question a panel administrator is actually asking - who may see the money,
who may reach a game server - and that is who ticks the boxes.

**Closed, in the one direction that breaks nothing.** The six read groups keep
their names, and a write says so in its own: the first write ability this API
grew is `support.write`, shipped with the ticket writes in
[api-next.md](api-next.md). That is the half of the dotted-name argument worth
having - a verb where there is a verb - without renaming a single ability any
key already holds.

Renaming the six reads is still available and still breaking, so it is still
Bryan's if he ever wants it. This needed neither, which is why it went first.

One thing it cost, written down because the next person will meet it: Laravel
reads a dot in a translation key as a step into a nested array, so
`api.ability_support.write` asks for a `write` inside an `ability_support` that
does not exist. The name on the wire is the contract and does not bend for that;
the key is flattened where it is looked up.

---

## Not blockers, and why they can wait

Each of these is an addition. Adding a field breaks nobody, so they can land at
1.1 without a second thought - and holding 1.0.0 for them would be spending the
version number on the wrong thing.

- **The rate limit on every answer rather than only in a 429.** Worth doing, and
  additive: a `rate` beside `as_of` in the envelope.
- **`due_soon` as a real count** rather than the length of a capped list.
- **More readings**: the ticket desk, the watchdog's history rather than its
  current verdict, a customer's invoices, capacity per package. Every one of them
  is a second reader of something a page already works out, and every one of them
  is an addition.

## Deliberately not in 1.0.0

- **Writes.** The plugin still does not control servers: Pelican's client API
  does, with its own permissions and its own activity log, and the bot already
  holds a real Pelican key from `/connect/claim`. The one write that was argued
  for - replying to a ticket - was thrown out for 1.0.0 because a write needs
  idempotency against a webhook arriving twice and an audit trail of its own, and
  neither exists yet. Restraint has served this API well and 1.0.0 is not the
  release to spend it.
- **Cursor paging.** See blocker 4.
- **CORS.** Nothing browser-based calls this, and a header that says who may is a
  promise about who does.
- **A second contract version.** `v2` is the thing 1.0.0 exists to avoid needing.

## Thrown out, and worth knowing why

- **Renaming the resource fields to carry their units.** `memory_bytes`,
  `cpu_absolute` and the rest are not this plugin's convention - they come
  verbatim from Pelican's own stats. Renaming them would make this API disagree
  with the panel it reads from.
- **A `page` object on every list from day one.** The cursor cannot be built over
  the queries it would name: they are ordered by computed columns.
- **`as_of` meaning when the answer was worked out rather than when the panel
  replied.** The premise did not survive reading the support classes; most of
  them do not serve a held answer.
- **Making expiry observable, and fixing key rotation.** Both real, both smaller
  than claimed, and neither breaking - so they are 1.1 work, not 1.0.0 work.
- **Deleting the IP allowlist, or giving it ranges.** A judgement about somebody
  else's network, on a feature nobody has complained about.

## The order, and why

1. **Blocker 5's `/health` half first**, because a caller that cannot read its
   own grant cannot be told what changed in the ones below.
2. **Blockers 1, 2 and 3 together**, which are all "say what you actually
   return". They touch the same two files and the same documentation array.
3. **Blocker 4**, which is the one that needs a decision per endpoint rather than
   a rule, and is best done when the shapes above have stopped moving.
4. **Blocker 5's closing half**, last of the five, because it is the only one that
   changes what an existing key can do and should land on a surface that is
   otherwise settled.
5. ~~**Then call it 1.0.0**~~ - done, and not before, because after this the
   list above costs a `v2`. What the number promises is the shape rather than
   the contents: fields and endpoints will be added, and a bot that treats a
   field it has never seen as a reason to stop is a bot that will stop. What
   will not happen inside `v1` is a field changing meaning, changing type, or
   going away.

## How you check it works

1. Every endpoint called with a real key, and its body compared field by field
   to the `answers` block the panel publishes for it. That is the whole of
   blockers 1 to 3, and it was going to be a morning with `curl` until it became
   `tools/api-sweep.php`, which does it in ten seconds:

       sudo -u www-data php tools/api-sweep.php <key> [server-uuid] [discord-id]

   It is not a build gate and cannot be one: comparing fields needs a running
   panel and a real key, where every gate in `tools/` reasons about the source
   from the outside. It is what somebody runs before calling a release 1.0.0.

   Read one result rather than counting it. A list that is empty on the panel
   you run it against proves nothing about its rows, so a healthy panel reports
   the five fields of a stopped schedule as documented and absent. That is the
   panel being well.

   **Done, and it found eight things.** Six were omissions made the same day, in
   the course of the blockers above: a `*_total` added to an endpoint and not to
   its published example, four times over. One was older - `/backups` showed a
   stale list that was empty, so the four fields a stale row carries were written
   down nowhere.

   The eighth is the reason the sweep now takes ids. It only called the eleven
   endpoints whose paths carry no id, and reported that as a clean sweep; the
   other six were skipped in silence. `/connect/{discord}/backups` was in that
   six, and it had both faults the sweep was written to catch - a documented row
   missing a field it sends, and `stale_after_days` present on one branch and
   absent on the other. Give it a server uuid and a connected Discord id and it
   covers all seventeen; leave them out and it prints the skip.

   The last run: seventeen endpoints, three differences, two of which were the
   empty-list result above and one of which was real. Worth saying plainly,
   because it is the shape of every one of these: **the sweep found nothing that
   a person had not already been wrong about in writing.**
2. A key granted one ability, checked against every endpoint with **both** GET
   and HEAD. That is how the HEAD hole was found, and it is the only test that
   would have found it.
3. A list endpoint on a panel with more rows than its ceiling, checked for the
   count beside it.
4. A key with no abilities recorded, before and after the change, against an
   endpoint that has one.

## What could make this plan wrong

- **Somebody writes a bot against 0.0.2 before this lands.** Then blockers 1 to 3
  stop being free and start being a break, and the honest answer is to do them
  anyway and say so in the release, because the alternative is carrying the wrong
  shape for the life of `v1`.
- **The bot needs a write sooner than expected.** Then blocker 5's closing half
  moves to the front, because it is the thing that makes a write grantable rather
  than automatic.
- **Pelican grows one of these itself.** The house rule then applies exactly as
  it always has: read their source, and delete the part of this plan that
  duplicates it.
