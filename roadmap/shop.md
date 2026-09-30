# The shop, audited

What twenty-six claims about the order lifecycle turned into after each one was
handed to a second reader whose job was to refute it.

Twenty-four survived, and all twenty-four are fixed. They are grouped below by
what was actually wrong rather than by where each was found, because five of them
were one mistake made in five places.

Four more came out of the fixing rather than the audit, and every one of them was
worse than anything the audit found:

- **Five invoices printing a price with no description**, one a credit note.
- **Six customer messages stuck for ever** between two readers that disagreed
  about an empty string.
- **`cancelled` stored as `cancelle`**, because the column was one character too
  narrow, so every question about withdrawn invoices matched nothing.
- **Schema changes keyed on Pelican's version**, so the plugin's own column
  changes ran once and then never again - which is how the one above survived
  four releases that were supposed to fix it. And underneath that, a
  `SHOW COLUMNS ... LIKE ?` that MariaDB cannot prepare, which silently skipped
  every statement after it in the same try.

That is the argument for auditing by tracing rather than by reading: three of the
four were found by testing a fix, not by looking for a fault.

**Why this file exists at all.** The first pass over this ground happened in a
conversation and the findings were never written down, so they were lost and had
to be found again. That is the whole argument for a file: work that only exists
in somebody's head is work that will be done twice.

## How it was audited

Nine readers, one per stage of the lifecycle: provisioning, upgrades,
termination, payments, VAT, uploads, admin visibility, arithmetic, concurrency.
Each was told to report at most three defects and only ones it could trace end to
end, and each finding then went to a separate reader told to **refute** it: find
the guard, the catch, the transaction or the earlier check that makes the
described sequence impossible, and default to refuted when unsure.

Two were refuted and are worth naming, because both are plausible and neither is
real:

- **terminate() reporting a deletion that did not happen.** It does report
  failure; `Orders::remove()` returns false and the notification follows it.
- **A checkout upload failing silently.** The write is checked and the purchase
  is refused with a message.

## Fixed already

| | |
| --- | --- |
| Invoice lines that print nothing | The document and the email read `$line['text']`; the addon, upgrade, top-up and credit-note writers stored `description`. Five invoices on a live panel had a price and an empty description, one of them a credit note. Writers brought back into line, both documents fall back so the rows already issued still print, and `tools/check-invoice-lines.js` refuses the shape. |
| Renewals never reverse-charged | `Renewals` called `Purchase::money($lines)` with no VAT number, so the reverse-charge branch never ran. The first invoice was right and every renewal after it charged VAT to a business that does not owe it. |
| Revising an invoice added VAT back | Same omission in `Invoices::revise()`, now passing the invoice's own `customer_vat` snapshot rather than today's profile: a bill is revised on the terms it was issued on. |
| A VIES outage remembered as a refusal | `ask()` returned false for "not valid" and for "did not answer" alike, and `check()` cached it for twenty-four hours. One minute of VIES being unreachable became a day of charging VAT. It now returns null for no-answer, which is not cached. |
| Payments off took the payment addresses away | The webhook and return routes were registered under `Features::PAYMENTS`, which by its own note is about the admin page and the credentials. `Gateways::enabled()` asks only about the shop, so the Pay buttons stayed live while both addresses answered 404. The money was taken and nothing in the panel heard about it. |
| Ticket messages with an empty remote id | `pushed()` compares the text and calls an empty one unsent; `Board::behind()` asks `whereNull` and cannot see it. Six customer messages on a live panel were stuck between the two, never pushed and never listed. A mutator refuses the value and the install pass heals the rows. |
| Six docblocks describing the wrong thing | `tools/check-docblocks.js` only looked for a block opening on a line of its own, so a one-line docblock after a closing block was missed. Widened, and the six it then found are reattached. |

### And the second pass, which is all of part 1, part 5 and most of part 4

| | |
| --- | --- |
| Withdrawing an invoice left the change it was for | `Invoices::cancel()` now clears the PENDING upgrade that named it, through `Upgrades::withdrawn()`. A row left standing locked the service out of every future change, for the customer and the administrator both, with a hand edit of the database the only way out. |
| Withdrawing an invoice kept the credit it had spent | `cancel()` puts it back, and rings when it cannot. The order is deliberate: the document is closed and its credit zeroed first, because `Credits::add()` puts what it adds onto whatever else is open and an invoice still readable as unpaid would take it again. |
| A withdrawn invoice could still be paid | `markPaid()` accepted anything that was not already PAID. It now takes only an UNPAID one, and a payment arriving for a withdrawn document rings rather than passing in silence. |
| Two settles of one invoice built two servers | The UNPAID to PAID transition is now one conditional update, so the database decides which of the two writers goes on. `Provision::run()` holds a per-order lock as well, which also covers two presses of Rebuild. |
| Refunding a top-up gave the cash back and kept the credit | `Refunds::give()` takes the credit off first, refuses when the customer has already spent it, refuses the circular case of refunding a top-up onto the balance, and puts the credit back if the provider then refuses. |
| Retry erased the reason before it knew anything was queued | A dispatch that throws now leaves the order exactly as it found it. Without that the customer had a service that looked like it was still being made, for ever, with no reason and no button. |
| A ticket attachment over 8 MB was dropped in silence | `Board::say()` told the two callers apart: a picture offered and not kept is a refusal, not an absence. The sender is told the size limit rather than "try again". |
| `files_read_from` took an address with no scheme | Stored verbatim and handed to an img src, where a string without `https://` is a path on this panel. `Uploads::readFrom()` now applies the rule `base()` beside it already had, and the settings box says so while it can still be fixed. |
| The Late filter and the lateness in days both missed shared invoices | Both asked only `invoices` and not `billedOn`, which is the pair `Renewals::overdue()` already asks. A customer with three services on one monthly bill could be months late and appear nowhere. |

---

## Part 1 - Withdrawing an invoice has to undo what it caused

Four findings, one shape. `Invoices::cancel()` marks the document CANCELLED and
stops, while everything that document set in motion stays where it is.

- **A pending package change is never cleared.** `Upgrades::start()` writes an
  Upgrade row as PENDING and bills it. Withdraw the invoice and the row stays
  PENDING for ever: `Upgrades::waiting()` keeps returning it, the service card
  reads "waiting for X" instead of offering a change, and `change()` refuses with
  `waiting`. The administrator has no way out either, because `reupgrade()` only
  acts on REFUSED rows and Mark paid is only offered while the invoice is UNPAID.
  Only a hand edit of the database clears it.
- **Credit already spent is never returned.** `Credits::settle()` spends the
  customer's balance onto the invoice and records it in `credit`. Cancelling the
  invoice does not put it back, so the balance is gone and the document it went
  to can never be paid.
- **A withdrawn invoice can still be paid.** `markPaid()` refuses only a PAID
  invoice, so a checkout session opened before the withdrawal still settles a
  CANCELLED document. The money arrives, the order is already cancelled, and
  nothing is built and nothing is said.
- **None of it is visible.** A PENDING upgrade appears on no admin page, so the
  locked service is found only when the customer asks why they cannot upgrade.

**Done.** `Invoices::cancel()` now undoes what the invoice caused: it clears a
PENDING upgrade that names it, returns any credit it spent, and zeroes the credit
in the same write. `markPaid()` accepts only an UNPAID invoice and rings when a
payment arrives for a withdrawn one.

And a filter on the orders page for a change that was refused. The button to try
one again has always been on the row and nothing pointed at the rows, so on a
panel with three hundred services a change that failed overnight was found when
the customer asked. It reads the same memo the button does, so the two cannot
disagree about which rows are stuck.

## Part 2 - Money worked out twice, differently

Three findings where the same total is computed in two places and the two
disagree. The customer sees one number and is charged another.

- **The coupon base differs between the checkout page and the invoice it
  writes.** `Purchase::quote()` discounts the package price; `quoteMany()`
  discounts the package price plus addons plus setup. With a fixed code of
  twenty on a ten-pound package and a five-pound addon, the page says five to pay
  and the invoice says nothing to pay, and `settleFree()` then provisions the
  server for free. With a percentage code the same split is quieter and just as
  wrong.
- **Revising an invoice rebuilds only the package price.** A renewal invoice
  carries a package line plus each recurring addon; a first invoice carries the
  setup fee as well. `revise()` rebuilds one line per remaining order from
  `$billed->price`, so withdrawing one service from a shared invoice silently
  deletes the other services' addon charges and setup fees, and emails the
  customer the smaller document.
- **Turnover counts a top-up twice.** Once when the top-up invoice is paid, and
  again when the credit it created settles a later invoice, because the later
  invoice's `total` is summed whole while `credit` covered part of it.

**Done, all three.** `quote()` now says what a code may come off and
`quoteMany()` adds those up, so the rule lives where it is stated;
`tools/coupons.test.js` holds fourteen cases including the one that shipped, and
mirrors `Money::percent()` exactly rather than approximating it. A revision
rebuilds each kept service the way it was written, setup fee and extras and all.
And the discount on such a bill is scaled to what is left rather than carried
whole - which closes a second way to reach a total of nothing, and does change
what somebody is charged: cancel half a discounted basket and you keep half the
discount.

The turnover answer came out differently from the plan. Subtracting the credit
would have been wrong for a credit note, which is already handled and handled
correctly. A top-up is the one that was double counted, because it is money the
shop is holding rather than money it has earned - the earning is the bill that
credit later settles, and that bill was always in the sum. So a top-up is
excluded, the same way a credit note already was, in the shop's figure and in the
"spent" on a customer's page, which had the same fault and counted credit notes
upwards as well.

## Part 3 - Two things arriving at once

Three findings, one root: a state is read, a decision is made on it, and the
write that follows does not check that the state still holds.

- **`markPaid()` is a check-then-act.** It reads `state`, compares it to PAID in
  memory, and then saves with `WHERE id = ?` and no state predicate. A webhook
  and the customer's return page arriving in the same second both pass the check,
  both write PAID, and both settle the order.
- **`Provision::run()` guards on an unlocked read.** `server_id !== null` off a
  model loaded a few lines earlier, with no lock, no transaction and no
  intermediate state. Two settles, or two presses of Retry, build two servers.
  The order keeps one; the other is a running server no order points at, that
  renewals never bill and that cancel and terminate cannot remove, because
  `Orders::remove()` reads `$order->server`.
- **The nightly suspension loop acts on a list it read minutes earlier.** A
  customer who pays while the pass is still walking that list is suspended
  anyway.

`Credits::credited()` already carries a second guard for exactly this double
arrival and its docblock names the webhook-plus-return case, so the hazard is
known here; the order path simply has no equivalent.

**Done, for two of the three.** `Provision::run()` takes a `Cache::lock` on the
order id and bails when it is held, and the UNPAID to PAID transition is a
conditional update, so only the request that actually changed a row goes on to
settle.

**And the suspension loop asks again.** The pass reads the overdue list and then
walks it, minutes apart, sending mail and talking to nodes in between; a customer
who paid while that was going on was suspended anyway, and paying again does not
lift it. The question is now asked about that one order at the moment of acting,
through the same clause the list uses - written once, because every time it has
been copied one of the copies has drifted.

## Part 4 - A failure that says nothing

Six findings where something did not work and nobody was told.

- **Refunding a top-up gives the cash back and leaves the credit.** Nothing
  writes the balance down, so the customer has the money twice.
- **`retry()` erases the failure reason before it knows anything was queued.** A
  dispatch that throws leaves the order with no reason and no Rebuild button.
- **A paid addon is dropped in silence** when it went off sale, or no longer
  fits the package, between being billed and being paid.
- **A refused resize leaves the addon attached and billed** on every renewal,
  with no way to re-apply it.
- **A ticket attachment over the limit is dropped and the reply says it worked.**
- **`files_read_from` is never checked for a scheme**, so a bucket upload can be
  stored under an address nothing can read.

**Four of the six are done**: the top-up refund takes the credit back, retry puts
the reason back, the ticket attachment is refused and the sender is told the
size, and the read-from address must carry a scheme.

**And the two about addons.** A paid extra that could not be put on the service -
the service is gone, or the extra no longer fits it - now rings rather than
returning in silence, because the money is taken and the shop cannot put that
right on its own. A resize the node refused already rang; what was missing was
any way to try it again, since the invoice is paid and nothing reaches settle() a
second time. There is a button for it now, which charges nobody anything: it
re-sends limits the order already carries, so it is safe to press twice.

## Part 5 - What an administrator cannot find

- **A change stuck in PENDING appears nowhere.** See part 1.
- **The Late filter on the orders page misses every order billed through a
  shared invoice**, because it looks only at `invoices` and not at `billedOn`.
  Three services due the same day are one invoice, and none of the three is ever
  late.

**Done for the second of the two.** The filter and `Orders::overdueDays()` both
ask `invoices` and `billedOn` now, the pair `Renewals::overdue()` already asked.
The stuck-change filter is in part 1.

---

## What is left

Nothing from the audit. What it turned into, and what to hold the next pass to:

- **The whole shop path now has a test suite behind its arithmetic**,
  `tools/coupons.test.js` beside `tools/basket.test.js`, and both model the PHP
  rather than describing it. When one changes the other has to.
- **Four gates came out of this**: `check-invoice-lines.js` for the shape a
  document can print, `check-show.js` for a query MariaDB cannot prepare, a
  widened `check-docblocks.js`, and an honest percentage in `check-lang.js`.
- **The pattern worth naming** is in the last section of this file.

## How you check it works

On the real panel, as `www-data`, one request per process:

1. **Part 1:** withdraw an upgrade invoice, then try to upgrade that service
   again. It has to offer the change rather than say it is waiting.
2. **Part 2:** a basket with an addon and a fixed coupon. The total on the page
   and the total on the invoice are the same number, or the part is not done.
3. **Part 3:** two settles of one invoice at the same moment. One server.
4. **Part 4:** make each failure happen and check that somebody is told.
5. **Part 5:** three services on one invoice, unpaid and past grace. All three
   show as late.

## What applies everywhere

The rule this audit kept proving: **a state written in two places drifts, and a
state read without a lock is a guess.** Six of the twenty-four are one value
meaning two things to two readers, and three more are a read that was stale
before it was used.

And the rule the fixing added to it: **a silent failure hides the fault above
it.** Four separate faults were invisible because something upstream caught an
exception and carried on - a schema repair that skipped every statement after a
query MariaDB would not prepare, a column that truncated without complaining, a
reply that saved without its attachment, a gateway settling a document that no
longer existed. None of them would have been found by reading. Every one of them
was found by making the thing happen and then asking the database what it
actually held.
