# The API after 1.0.0

[What 1.0.0 means for the API](api-one.md) is about the things that cannot be
changed afterwards. This file is about the things that can, which is why it
comes second and why none of it is urgent.

It has one organising question: **what can a bot still not do?** Not "what could
be added" - that list is endless and most of it is a second reader of something
a page already works out. What a module author actually runs into.

## What is true today

Read before writing any of this down, because the last plan that guessed cost a
release.

| | |
| --- | --- |
| Endpoints | 19: seventeen GET, one POST (`/connect/claim`), one DELETE |
| Abilities | six groups: `health`, `me`, `panel`, `shop`, `live`, `connect` |
| Writes | one, and it creates a connection rather than changing a server |
| Outbound events | one https address, panel-wide, sixteen names, every one of them a fault |
| Who fires them | `Watchdog::run()`, and the Test button on the alerts page |
| Rate limit | per key or panel default, visible only in a 429 |

The division the README draws holds and nothing here challenges it: **Modora
owns Discord, this plugin owns the panel, Pelican owns control.** Everything
below is on the panel side of that line.

---

## 1 - The panel only tells a bot when something is wrong - done

This was the largest gap and the one a module noticed first.

`Support\Alerts\Notifier` posts to one address, and every one of its sixteen
events is an alarm: a node unreachable, a disk line crossed, backups stale,
orders paid and unbuilt. A bot that wants to say **"your server is ready"** or
**"Bryan just bought a Minecraft package"** cannot be told. It has to poll
`/shop` on a timer and diff it against what it saw last, which is how a bot ends
up announcing an order four minutes late and twice.

What makes this tractable is that the envelope already carries what a receiver
branches on. 1.0.0 added `event`, `kind` and `subject` beside the sentence,
precisely so a receiver would not have to match on translated prose. Adding a
second class of event is filling in names, not designing a protocol.

**The events worth having, and where each one hangs.** Every site named here is
a single writer that already exists:

| Event | Where | Why it cannot be polled for |
| --- | --- | --- |
| `shop.paid` | `Invoices::markPaid()` | The one transition, already idempotent by a conditional update |
| `shop.built` | `Jobs\ProvisionServer` | The moment a customer is waiting for |
| `shop.failed` | the same job's failure path | Somebody paid and has nothing |
| `service.due` | `Renewals::remind()`, inside `Renewals::run()` | A warning is only a warning if it is early |
| `service.suspended` | `Renewals::suspend()` | The customer is asking in Discord right now |
| `ticket.said` | `Tickets\Board::say()` | Only matters on a panel whose desk is its own - see item 2 |

**The design question, answered: `class`.** `good` means "the all-clear rather
than the alarm", which says nothing about an event that was never an alarm, so a
receiver branching on it gets `shop.paid` wrong. Every payload now carries
`class`, **alarm** or **fact**, and it is the first thing to read: an alarm is
raised and later cleared, where a fact happens once and is never taken back.
`good` keeps exactly the meaning it had for the alarms and answers, on a fact,
whether the thing that happened was welcome - true for a sale, false for a build
that failed.

**And the entry point is not `send()`.** That fans out to every switched-on
channel, so a paid invoice would have posted a Discord embed, belled every
administrator holding the alerts permission, and sent an email. A panel that
wired up alerts to hear about dead nodes did not ask to be emailed about every
sale. `Notifier::fact()` goes to the bot and nowhere else, because the bot is
the one channel that is a program rather than a person.

**One address, with a list beside it.** A checkbox per fact under Alerts, and
**every one of them starts unticked**. That is the opposite of how the feature
switches work, where the store holds what is off so a feature added later
arrives switched on, and the reason is the opposite too: an address that has
been posting outages for a year should not begin receiving sales because the
plugin updated. A panel that upgrades into this release sends exactly what it
sent before, which was checked on a live panel rather than argued.

The event names are the labels on that page, untranslated. `shop.paid` is
`shop.paid` in every language: it is the string a receiver matches on, and
translating it would put a word on the form that appears nowhere in the payload.

A second delivery system - per-key addresses, retries, a delivery log - is still
a bigger thing than the gap, and still waits until one address has proved too
few.

**What the work turned out to be.** Not the sending, which was an afternoon. It
was finding the one line per event that already runs exactly once, because a bot
that announces one order twice is worse than one that announces it late:

- `shop.paid` sits behind the conditional update in `Invoices::markPaid()`, the
  one that stopped a provider's webhook and a customer's return page building
  two servers from one payment.
- `shop.built` is behind `build()`'s early return and its per-order lock.
- `service.due` is behind the `reminded_at` stamp, which is written before
  anything is sent and refuses to go on if it will not write.
- `ticket.said` is behind a plain insert, and fires only for what is written in
  the panel: a message arriving from Modora is written by `Hook` rather than by
  `Board::say()`, so a bot is never told about a message it posted itself.

Two had nothing behind them at all, and one of those was a fault rather than a
missing event. **`Orders::suspend()` read the state into memory and wrote with
`WHERE id = ?`**, so the nightly sweep and an administrator pressing Suspend
could both pass the check and both write - a customer told twice that their
service had been suspended, with no event involved. It uses the conditional
update now. And `shop.failed` has no natural guard, because Rebuild is a button
a customer can press against a node that is full, so it is held to once an hour
per order with `Cache::add()`.

---

## 2 - Tickets are invisible to a bot - done, and this item was wrong

The support desk is an interface with two implementations
(`Tickets\Desk`): Modora, and the panel's own.

**On a Modora panel this is already solved and nothing should be built.** The
ticket is mirrored into Modora, and a module reads it there with `tickets.read`
and `messages.read`. Adding a second way to read the same conversation is the
mistake the roadmap has made before: building what something else already does.

**On a panel whose desk is its own, a bot can see nothing at all.** No endpoint
here mentions tickets. The panel that chose to answer its own tickets is exactly
the panel where staff are not already in a Modora dashboard, so "somebody
opened a ticket" is the notification they most want in Discord and the one they
cannot have.

So: `GET /tickets` and `GET /tickets/{id}` under a new `support` ability, plus
`ticket.said` from item 1. Reading only. The reply that would make it a
conversation is item 3, and it should not be hurried into this one.

**The question this item left open had a false premise, and the answer is
neither of the two it offered.** It asked what a ticket belonging to the Modora
desk should answer here, and preferred a 409, because serving a hollow row for a
conversation that lives elsewhere invites a module to read the same thing twice.

There is no hollow row. `Tickets\Board` writes the ticket and every message on
it to this panel's own tables **before** a desk is asked to mirror them - that
is the whole design of the desk interface, and it is why nothing here depends on
Modora being reachable. This panel is the answer whichever desk is switched on,
so refusing would have been refusing to serve the authoritative copy.

What is real is a question of timing, and `remote` answers it: a reply typed in
Discord is written here when the webhook lands or the next pull runs, so this
can be minutes behind that channel and is never ahead of it. A module holding
both ends matches the two on that id rather than posting a message twice. Said
in the endpoint's own detail, where somebody writing the receiver will read it.

**Done**, as `/tickets` and `/tickets/{ticket}` under a new `support` ability.
Both swept against a real ticket on a live panel and agreeing field for field
with what they publish.

One decision that was not in this item at all: **staff notes are never served**.
A message flagged `inside` is what staff wrote to each other about a customer,
and the first use anybody has for this endpoint is posting a conversation into a
channel that customer can read. There is no key width that changes it, which is
easier to reason about than a flag somebody has to get right.

And one thing deliberately not built: a `/connect/{discord}/tickets` beside the
`/me` family. The argument for this item was staff who are not in a Modora
dashboard wanting "somebody opened a ticket" in a channel, and that is answered
by the panel-wide list plus `ticket.said` from item 1. A customer asking a bot
about their own ticket is a different feature, and it should be asked for rather
than guessed at.

---

## 3 - A write needs two things this API does not have - done

1.0.0 deliberately shipped no writes beyond `/connect/claim`, and named the two
reasons. Both are still true, and both are prerequisites rather than features:

**Idempotency.** A webhook that is not acknowledged is retried; a bot that times
out retries. Replying to a ticket twice is two messages in front of a customer.
`Invoices::markPaid()` solves the same problem with a conditional update and can
because a state transition is its own guard - a reply has no such guard. So an
`Idempotency-Key` header, a small table of keys seen in the last day or so, and
a repeat answering the first result rather than doing the work again.

**An audit trail of its own.** A read that goes wrong is a wrong answer. A write
that goes wrong is a thing that happened, and "which key did this" has to be
answerable afterwards. Pelican has an activity log and the house rule applies
before anything is built here: **read whether a plugin may write to it** before
designing a second one.

**Both are here, and two of the three writes with them.**

`Api\Writes` keeps what each key already answered for an `Idempotency-Key`, for
a day. What is kept is the answer rather than a marker: a caller retrying has
not seen any reply at all yet, so telling it the work happened without telling
it what happened leaves it no better off. The same header with a different body
is a mistake rather than a retry, and gets a 409. Proved on a live panel - the
same request twice made one message, a different body under the same header was
refused, and a different header made a second.

The audit trail is **Pelican's own activity log**, through its own facade. The
house rule was read first, and it answered twice: `App\Facades\Activity` is
public, and `Activity::subject()` is a polymorphic relation the panel enforces a
morph map over - so handing it a model of this plugin's throws, which is how the
first version wrote nothing at all while every write succeeded. The ticket id
goes in as a property beside the key prefix instead. A plugin has no business
claiming an alias in the panel's own morph map.

**Two writes, not three.** Answer a ticket and close one, both always as staff:
a panel-wide key belongs to whoever runs the panel, so a reply it sends is an
answer by definition, and letting it choose would be letting it write a sentence
into a customer's mouth. Marking an invoice paid by hand was left out, and
deliberately: it is the one write here that grants a service without money
having arrived, it is a thing no Discord bot does, and it is available to
anybody who wants it as an addition rather than as something that shipped
because a plan listed it.

**And the naming question is settled in the only direction that breaks nothing.**
The six read groups keep their names and a write says so in its own:
`support.write`. Renaming the reads is still available and still breaking; this
needed neither. The cost is one line - Laravel reads a dot in a translation key
as a step into a nested array, so the key is flattened where it is looked up and
the name on the wire does not bend for it.

---

## 4 - The rate limit is invisible until it bites - done

**And this item was wrong about why, which is worth keeping rather than
tidying away.** It said a caller learns its allowance by being refused. The
documentation had said the opposite for several releases: the rate-limiting note
promised `rate.limit` and `rate.remaining` on *every* response. Neither was
right. `/health` built a `rate` into its own body and nothing else carried one,
so a module pacing itself on `rate.remaining` read undefined on sixteen of the
seventeen endpoints it could call, having been told in writing that it would not.

That is a worse fault than the one this item described. A gap somebody discovers
is a gap; a gap somebody was told is not there is an afternoon.

Fixed by making the sentence true rather than withdrawing it: `rate` sits beside
`as_of` in the envelope in `ApiController::answer()`, so every answer carries it,
and `/health` stopped building its own. Nineteen published examples gained it,
which is how the promise stays checkable - `tools/api-sweep.php` compares them
field by field.

Not done, and deliberately: **when the window resets.** The counter is a
per-minute cache key with no stored expiry to read back, so saying when it turns
over means storing a timestamp that nothing else needs. `remaining` and a minute
is enough to pace against.

---

## 5 - A key cannot be replaced without a gap - done

**Half of this item was already built when it was written**, and saying so is
cheaper than somebody building it twice. `/health` has published
`key.expires_at` since the abilities landed beside it, so a bot can already warn
its owner. This file claimed otherwise because it was written from the plan
above it rather than from the endpoint.

What is actually missing is the other half: **rotation.** `Key::usable()` checks
`expires_at` and that is the whole of it, so replacing a key means minting the
new one, changing the bot, and hoping the two moments are close enough together.
There is no way to have both answer at once.

**Done.** Replace hands out the successor first and lets the old one run out.
Both answer for a week, which is the whole point: the bot is changed at leisure
and the old key stops on its own, on a day that was said out loud. Proved end to
end on a live panel - the old key still usable and reporting `replaced_by`, the
successor active and waiting to be collected, a second rotation refused.

Three decisions inside it that were not obvious from here:

- **The successor carries the grant, copied rather than re-chosen.** A rotation
  that quietly widens or narrows what a key may do is one nobody can trust, and
  the one thing somebody is certain to do afterwards is change the secret and
  nothing else. The abilities are copied as stored, `null` included, because
  reading that as an empty list would silently narrow a key that was only being
  replaced - which is the fault blocker 5 of [api-one.md](api-one.md) fixed,
  arriving by a different door.
- **The secret is not shown to whoever pressed the button.** The successor is
  approved rather than granted, so its owner collects it on their own page. That
  is the rule the grant button beside it has always kept, and a rotation is not
  a reason to break it.
- **It brings an end forward and never pushes one back.** A key that already
  expires on Friday is not given until next week because somebody rotated it on
  Thursday. The date a key was issued with is a promise of its own.

The one column this added is `replaced_by`, and it holds the successor's prefix
rather than its id: a prefix is unique, it is the half of a key that is safe to
show, and a row pointing at a key somebody has since deleted still says
something true rather than being a broken join.

---

## Deliberately not here

- **Controlling servers.** Still Pelican's, still through the key
  `/connect/claim` mints, still for the same reason: their permissions and their
  activity log, neither of which a second implementation would keep right.
- **Cursor paging.** The queries are ordered by computed columns. See blocker 4
  of [api-one.md](api-one.md), which settled this by trying.
- **A second contract version.** `v2` is what 1.0.0 exists to avoid. Everything
  in this file is additive, and anything that turns out not to be does not
  belong in it.
- **Mirroring Modora's scope vocabulary.** Their twelve products publish nothing
  that reaches a server, a node, a backup or an invoice. Matching the shape of a
  vocabulary that shares no contents is decoration.
- **Per-key webhook addresses, retries, a delivery log.** A bigger machine than
  the gap. Revisit when one address has actually proved too few.

## The order, and why

1. ~~**Item 4**, the rate in the envelope.~~ Done, and it went first for the
   reason given: it touches the envelope every other item also touches, and was
   best done while nothing else was moving.
2. ~~**Item 1**, the events that are not alarms.~~ Done. The naming decision
   inside it was made once and is `class`.
3. ~~**Item 5**, rotation.~~ Done.
4. ~~**Item 2**, tickets, read-only.~~ Done.
5. ~~**Item 3**, writes.~~ Done, and last for the reason given: it is the only
   one where getting it wrong is visible to a customer rather than to a
   developer.

**All five are built.** What this file is for now is the record of what each one
turned out to be, which in three cases was not what it said.

## How you check it works

- `tools/api-sweep.php` after every one of these, with a server uuid and a
  connected Discord id, because six of the seventeen readable endpoints carry
  an id and were skipped in silence until they were not.
- An event fired at a receiver that logs the raw body, once per new event name.
  The signature is the part that gets broken by adding a field, and the test
  button on the alerts page does not exercise a payload with a `subject` in it.
- A write sent twice with the same `Idempotency-Key`, and the second answer
  compared to the first. Then twice with different ones, to prove the table is
  not swallowing real work.
- A key one day from expiry, read through `/health`.

## What could make this plan wrong

- **Nobody uses the panel's own ticket desk.** Then item 2 is work for a case
  that does not exist, and it should be dropped rather than built small.
- **Modora grows a hosting product.** Then the division the README draws moves,
  and this file gets rewritten rather than extended.
- **A bot needs a write before the events land.** Then item 3 comes first and
  item 1 waits, because polling is a workaround for a missing event and there is
  no workaround for a missing write.
- **Pelican grows outbound events of its own.** The house rule then applies
  exactly as always: read their source and delete the half of item 1 that
  duplicates it.
