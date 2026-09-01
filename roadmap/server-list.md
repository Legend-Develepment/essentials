# The server list

The page everyone lands on, and the one that decides what the panel feels like.

**Mostly shipped.** What follows is what went in, what it cost to learn, and the
one piece still outstanding.

## What shipped

**Theme → Server list**, in eight releases across `2.14.0`–`2.14.7`:

| | |
| --- | --- |
| **Game artwork** | Faded (Pelican's own wash), Cover (behind the name, fading out), or off — with a darkening slider |
| **Condition marker** | Bar down the left, Edge across the top, Dot in the corner, or off |
| **Card height** | Comfortable or compact |
| **Cards across a wide screen** | 2, 3 or 4 — Pelican's own ceiling is 2 |
| **Label the filter button** | Puts the word on Pelican's own filter, which is where the egg dropdown lives |

Plus, without being settings: cards in a grid all the same height, the meters
pushed to the card's bottom edge so they line up across a row, and the three
meters level with each other inside a card.

## What the plan got wrong

Worth keeping, because the same mistakes are available to the next piece of work.

**Four card layouts were planned. Pelican already has two** — grid and list, per
person under Account → Dashboard layout, each with its own table configuration.
Building four would have fought a preference that already exists. The release
became "style both properly and add what Pelican does not have" instead.

**A filter box was built and then removed.** It duplicated Pelican's own search,
which asks the server and reaches every page, and it could not have offered eggs
at all: a card carries the egg's picture but not its name. Pelican already
filters by egg *and* by owner — behind an unlabelled icon that nobody finds. The
word on that button is worth more than the box was.

**Three fixes were guessed at before the markup was read.** The stat blocks, the
Egg tab's grid, and the card's own height. Every one of them took two attempts
guessing and one attempt reading. The reading took five minutes each time.

## Still outstanding — favourites

A star on each card, stored in the viewer's own browser, starred sorting to the
top. Deliberately browser-only: no table, no migration, no permission, nothing on
the server to go wrong.

**Shipped in 2.53.3.** All three problems below turned out to be real, and the
third was answered by doing less rather than by solving it. What was read to get
there: `livewire/server-entry.blade.php`, `columns/server-entry-column.blade.php`
and `ListServers::contentGrid()`.

- **The star goes in as the first child of the card's header row**, found by the
  `h2` holding the server's name rather than by a utility class — an `h2` is what
  something is, `flex items-center gap-2` is how it looks. That row is a flex
  line with the condition icon, the name and the power buttons, so a new first
  child needs no position of its own and can collide with none of them.
- **Which server a card is comes from where it sends you.** `wire:id` is
  regenerated every request, so the card cannot say. Pelican's `redirectUrl()`
  sits in the click handler and carries the short id, which does not change.
- **The fifteen-second poll is watched rather than fought.** A MutationObserver
  on the list, coalesced to one pass per frame: a replaced card is many
  mutations and re-reading once afterwards answers all of them.
- **Sorting happens in grid mode and nowhere else.** `contentGrid()` is called
  with two columns for the grid layout and `null` for the list, so grid records
  are grid items and `order` moves them while list records are not. Making them
  so would mean restructuring Pelican's own list. In list mode the star marks
  and does not move, which is half of what the feature says on one layout —
  better than rearranging somebody's page by force.
- **Every step gives up rather than guesses.** No card found, no star; no
  identity readable, no star for that one. The failure mode is Pelican's list
  exactly as it ships, which is the only failure mode this was allowed to have.

The original note, kept because the reasoning still stands:

It was meant to ship with the filter box and did not, because it is a harder
problem than it looks:

- **The star has to go inside the card**, and there is no hook there. It has to
  be put into Pelican's markup by script — which the page arranger already does,
  so there is precedent, but it is the first time this plugin would do it to
  something that is not its own.
- **Livewire morphs those cards every fifteen seconds.** Anything injected has to
  survive that, or be put back after it.
- **Sorting differs by layout.** In grid mode the records are grid items and
  `order` works. In list mode they are not, so the container would have to become
  a flex column first — a structural change to Pelican's own list.

None of that is a reason not to do it. It is a reason for it to have its own
slice rather than be rushed in behind something else.

## Risks that remain

**The card is matched structurally.** `[wire\:id]:has(> .fi-color)` works because
the card has no class of its own, and every setting above hangs off it. If
Pelican changes that card, nothing matches and the list is Pelican's own — which
has to stay the failure mode.

**One rule reaches every element in the grid.** Making the card fill its cell
takes stretching every wrapper between them, and those wrappers were named twice
and wrong twice. It is now `*:has(…)`, which finds them whatever they are called
and costs the browser more. That trade was made on purpose and is worth
revisiting if a big list ever feels slow.
