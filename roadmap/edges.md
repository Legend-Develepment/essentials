# The edges

Leaving, proving, and the person on the other side.

This plugin is careful about running. Sixteen tables that are install tasks
rather than migrations so an upgrade cannot strand a panel; invoices that
snapshot their customer so a renamed account cannot change a document; a switch
that never deletes what it wrote and a card that says what is left; thirty gates
and thirty-four suites that refuse a build over a missing translation, a
counting sentence without conditions, a job that would inherit the last one's
memory.

It is thin about everything **around** running. Four things were surveyed against
the code in September 2026 and then checked a second time by hand; what follows
is what survived both.

| | |
| --- | --- |
| PHP in `src/` | 79,183 lines over 239 files |
| Pages | 34 admin, 12 client, 8 per-server |
| Parts (`Features::`) | 53, in 7 modules |
| Settings | 176 |
| Languages | 32 directories: English and 31 translations |
| Gates and suites | 30 `check-*.js`, 34 `*.test.js` |

---

## Part 1 - Leaving

**Uninstalling this plugin corrupts its own database, and then loses the
billing history it did manage to remove.**

Pelican gives a plugin exactly one hook on the way out:
`rollbackPluginMigrations()`, the first thing `uninstallPlugin()` does. This
plugin uses it in
[2026_09_08_000000_essentials_shop.php:37-56](../database/migrations/2026_09_08_000000_essentials_shop.php#L37),
and that `down()` names seven tables:

```
essentials_customers   essentials_invoice_orders   essentials_payments
essentials_invoices    essentials_orders           essentials_coupons
essentials_packages
```

The shop has twelve. `essentials_addons`, `essentials_credit`,
`essentials_order_addons`, `essentials_upgrades` and `essentials_waitlist` were
added later, by `Tables::install()`, and nobody went back to the migration. That
is not only untidy, it is a failure: four of the five hold foreign keys into
tables the migration does drop -
[Tables.php:898](../src/Support/Shop/Tables.php#L898),
[:929](../src/Support/Shop/Tables.php#L929),
[:995](../src/Support/Shop/Tables.php#L995),
[:815](../src/Support/Shop/Tables.php#L815) - so MySQL refuses the drop. The
refusal lands in a `catch (Throwable)` whose comment says "a table left behind is
tidied by hand", which is true of one table and not of a half-emptied shop.

What it *does* succeed in dropping is every invoice and payment record the panel
ever wrote, and nothing offers to export them first. For a hosting company that
is the accounting history.

Three other things outlive the moment they should not:

- **Ticket attachments are never deleted by anything.**
  [Files.php](../src/Support/Tickets/Files.php) has `keep()` and no counterpart;
  nothing in the tree calls a delete. The file survives the ticket, the account
  cascading away and an erasure request, and its address is a capability URL on
  a route with `throttle` and no `auth`
  ([ThemeServiceProvider.php:695](../src/Providers/ThemeServiceProvider.php#L695)).
  The unguessable name is a reasonable design for serving it. It is not a
  reasonable answer to "delete everything you hold about me".
- **Per-person layout and style files are named by user id** and are never
  removed when the account is.
- **`essentials_connections` survives uninstall**, and the Pelican API keys it
  minted are never revoked.

**The work.** One list of what this plugin owns, in dependency order, used by
both the install task and the `down()` migration, so the two cannot drift again -
and a gate that fails the build when a table exists in `Tables.php` and not in
that list. An export offered before the drop. A delete path for attachments and
per-user files, reachable from the account deletion Pelican already performs.

---

## Part 2 - Proof

**Nothing runs this plugin's PHP before it reaches three channels.**

There is no PHP on the build machine, no `composer.json` and no vendor
directory. [`tools/lint-php.js`](../tools/lint-php.js) says so in its own header
and is honest about being a character scanner rather than a parser: it checks
for an unescaped apostrophe closing a single-quoted string, which is the one
mistake a file full of English prose invites. It cannot check anything else, and
the release workflow runs no gate at all.

This is not hypothetical. On 13 September 2026 a fatal reached a finished build
with all thirty gates and all thirty-four suites green:

```php
use LegendDevelopment\Theme\Support\Fields\Login;   // new
'login_position' => Login::position(),              // meant Support\Login
```

An import wins over the namespace a file is in, silently. Both names resolve,
the file parses, and thirteen login settings came back as *Call to undefined
method*. It was found by `php -l` run by hand on the panel.

Two gates came out of that day and both are in: `check-uses.js` now refuses an
unaliased import whose short name already belongs to the file's own namespace,
and it reads the name in a `catch` as a class. That second rule found eight live
`catch (Throwable)` clauses in namespaced files with no `use Throwable;` - which
resolve to a class that does not exist and therefore never match. Their own
comments say what they were for: *"the upload as bytes, or nothing at all rather
than an exception"*, and a `modulesUrl()` whose whole job was to answer null
instead of offering a link to nowhere. Both threw instead.

What still escapes has a consistent shape. Anything needing to know what a class
*is* rather than what it is *called*: does this method exist on it, is this the
class this name means in a position the checker does not read. Anything inside a
Blade template. Anything about the artefact rather than the source.

**The work.** Get a real parse into the gate. The panel has PHP and is already
where every probe runs; a build step that lints the tree there, or a container
in the release workflow, turns the strongest remaining class of failure into a
refused build. After that, a check that a method named on one of this plugin's
own classes exists on it - the same argument `check-uses.js` already makes about
class names, one level down.

---

## Part 3 - The person on the other side

The roadmap said this plugin was an administrator's plugin and that 3.0 would
finish the other thought. It largely did: 12 client pages and 8 per-server pages
against 34 admin ones. What did not get finished is the way in.

Pelican's client panel sets `->navigation(false)`. The plugin knows this and
works around it with account-menu rows, but **two of its twelve client pages
never got one and nothing else links to them**, so the pages written for the
person whose servers they are cannot be found at all.

The second pattern costs more. The shop tells a customer the truth right up to
the point where something fails, and then hands them a support ticket:

- an order that was paid and whose build was refused still shows the invoice as
  unpaid;
- a paid upgrade that did not apply tells them to open a ticket;
- both retries exist, and both are admin-only buttons.

Under that sit smaller versions of the same thing: seven of the eight per-server
game pages stay invisible until an administrator types egg ids by hand while the
eighth finds itself; a customer cannot close their own ticket, and a closed one
cannot be answered; the customer never learns that a backup went stale or a
schedule stopped, which is the one thing the watchdog knows and they would care
about.

**The work.** A way in for the pages that have none. Then: every failure the
shop can reach should either resolve itself or say, to the customer, what is
happening and who is doing it. A retry that only an administrator can press is a
retry that waits for somebody to notice.

---

## Part 4 - Switches that mean what they say, and what has drifted

The permission layer is in better shape than the switches. Of the 37 gated
features exactly one carries a pair nothing reads, and the 16 without a
permission of their own are correctly without one: every per-server page reaches
Pelican's own `SubuserPermission` rather than skipping a check.

Three shop switches change billing in ways their own descriptions deny:

- **`ADDONS` off** stops charging for extras customers still have.
- **`PAYMENTS` off** closes every way to pay while invoicing and suspension
  carry on.
- **`SHOP` off** removes the renewal pass entirely.

And the API is a second front door onto six features whose switches it never
consults.

The drift found beside that is the residue of refactors that landed well: 20
orphaned `settings.pages.*` strings, translated into 31 languages and no longer
reachable, whose helper text has since diverged from the `settings.features.*`
copies actually on screen - 640 dead strings, and the better-written half is the
dead one. The arranger's old `.env` key is still written by `persist()` while
`Theme.php` says it is no longer read. Three comments promise seven parts that
arrive on and draw nothing while `Modules::waitingFor()` has six arms, and the
missing one is the public status page that answers 404 while the Modules card
calls it healthy.

**The work.** Make each of those three switches either stop the billing it is
part of or say in its own description that it does not. Give the API the same
switch checks the pages have. Delete the dead strings and the dead key, and give
`waitingFor()` its seventh arm.

---

## How you check it works

Per part, on the real panel, as `www-data`:

1. **Part 1:** install the plugin on a scratch panel, make a package, an order
   and an invoice, uninstall, and look at what is left in the database. Today
   that leaves a half-dropped shop; it should leave nothing, after offering the
   export.
2. **Part 2:** push a file with a deliberate parse error and watch the build
   refuse it. It does not today.
3. **Part 3:** sign in as somebody who is not an administrator and try to reach
   all twelve client pages without typing a URL.
4. **Part 4:** switch off `ADDONS` on a panel with an order that has one, and
   compare the next invoice against the one before it.

## What applies everywhere

The house rules in [README](README.md) stand: no Blade template is overridden,
one `Features::` constant per part with a label and a description, tables through
`Tables::install()` and never a migration, strings in every language, and the
first line of a commit is what the reader sees in their changelog.

One thing this survey adds. **Every claim here was read in the code and then
checked a second time against the same files, and the ones that drive the plan
were measured or reproduced by hand.** Two findings did not survive that and are
not here; one that did survive turned out to be worth a third of what it looked
like - `Languages::completeness()` recomputing on every page view for a
non-English reader measures 4.4 ms once per request, on a cold CLI opcache,
which is an upper bound and not the headline it first appeared to be.
