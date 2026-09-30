# Modularization inventory

Snapshot: `25f037a0187804bc0edabe5ff2f6da9fbadfb113`, Essentials 3.215.0-dev, reviewed 2026-09-17. The existing local change in `tools/weigh.php` is included in the working-tree inventory and was not changed.

This inventory covers 2288 tracked files. It combines a repository-wide static dependency scan with focused review of registration, permissions, persistence, queues, announcements and the domain boundaries. It is not a claim that every execution path has been exercised. Vendored/reference code under `no-git/` and built ZIP contents are not application source reviewed here.

The requested repositories reserve the eight module boundaries below. They initially contain repository documentation and the existing licence, not installable plugins. Runtime extraction remains staged, beginning with Announcements. No separate API or theme-preset repositories are created.

## Created repositories

All eight repositories were created under Legend-Develepment. GitHub readback confirmed private visibility, default branch dev, five committed files and the same commit as the clean local working copy. Each contains README.md, MIGRATION.md, AGENTS.md, LICENSE and .gitignore.

Local checkouts: `F:/GitHub/Essentials-standalone/<repository-name>`.

| Repository | Visibility | Default branch | Initial commit |
| --- | --- | --- | --- |
| [v](https://github.com/Legend-Develepment/essentials-core) | private | dev | `821e69a6aabf` |
| [essentials-announcements](https://github.com/Legend-Develepment/essentials-announcements) | private | dev | `700e4de42f4c` |
| [essentials-appearance](https://github.com/Legend-Develepment/essentials-appearance) | private | dev | `05ab50b5bb3c` |
| [essentials-game-manager](https://github.com/Legend-Develepment/essentials-game-manager) | private | dev | `80e0a9a0d5f7` |
| [essentials-monitoring](https://github.com/Legend-Develepment/essentials-monitoring) | private | dev | `64e1b97510b9` |
| [essentials-server-tools](https://github.com/Legend-Develepment/essentials-server-tools) | private | dev | `15c8ec6572be` |
| [essentials-support](https://github.com/Legend-Develepment/essentials-support) | private | dev | `c10cb3202f34` |
| [essentials-shop](https://github.com/Legend-Develepment/essentials-shop) | private | dev | `c1b283cb7c75` |

The three roadmap inventories in Essentials-dev are local, uncommitted additions. No legacy remote branch was pushed. Runtime extraction is still outstanding and begins with Announcements; repository creation does not satisfy the standalone acceptance tests.

## Target ownership

| Target | Tracked files mapped | Boundary |
| --- | ---: | --- |
| essentials-announcements | 35 | Notices, admin form, schedule and scope, dismissal, owned translations and storage. |
| essentials-appearance | 165 | Appearance engine, styles, per-user appearance, layout, icons, backgrounds and login. |
| essentials-core | 74 | Optional module registry, shared language policy and Servers by Role. No Shop/Support tables. |
| documentation | 21 | Existing project documentation, licensing and repository configuration. |
| essentials-game-manager | 637 | All supported games, settings, live player queries, modpacks, resources and egg artwork. |
| legacy-api | 49 | Keep in the legacy plugin pending the API evaluation after Support. |
| legacy-build | 6 | Keep current manifests/releases with the legacy plugin; add module builds only with runtime code. |
| essentials-monitoring | 361 | Status, capacity, nodes, watchdog, backup and schedule overviews, activity and public status. |
| essentials-server-tools | 117 | Duplicate, favourites, go-to, console actions and page arrangement. Styling must be separated. |
| essentials-shop | 509 | Catalog, checkout, orders, invoices, payments, credits, billing and provisioning. |
| split | 176 | Mixed legacy infrastructure. Divide by responsibility before copying; this is not a Core assignment. |
| essentials-support | 52 | Panel tickets and optional Modora adapter, ticket tables, files and hooks. |
| tooling | 86 | Retain checks and select the relevant checks for each extraction. |

## Coupling that must be resolved

- `ThemePlugin` owns page registration across all modules. `ThemeServiceProvider` owns routes, render hooks, permissions and schedulers; copying either wholesale recreates the monolith.
- `Theme::id()` derives the config/view/translation namespace from the folder. `Theme::forgetDerived()` directly references many domains. New namespaces alone do not make packages independent.
- `Settings`, `Saved/*`, `Features`, `Modules`, `Portable`, `Held` and `Forgotten` share feature state, environment settings, export and worker caches. The seven existing UI modules are not the eight proposed plugins.
- `InstallTasks::schema()` and `Modules::arrive()` reach API, Shop and Support schema installers. Each extracted plugin must own only its tables. Existing table names and role permission identifiers must survive.
- The shared CSS and inline runtime contain announcements, tickets, controls and other behavior. They must be split by behavior; copying the full theme into every plugin is not isolation.
- `ThemeStatus` mixes host monitoring with updates. `Profile` mixes API and Shop. CDN/uploads are shared by several consumers. These are explicitly marked `split`.
- Core's role access service must retain the managed-subuser ledger and Pelican subuser/SFTP enforcement. Manual subusers must never be adopted during migration.

## Review findings

1. **Announcements and several utility hooks depend on styling being enabled.** `ThemeServiceProvider::boot()` returns for `Presets::isDisabled()` before the announcement hook and its CSS/runtime registration (source lines 160-184). A standalone Announcements plugin must register its own hooks and assets even when Appearance is absent or disabled. This is an existing coupling, not an extracted-plugin regression.
2. **Credit settlement is not atomic with the invoice update.** `Credits::settle()` computes the amount from an invoice snapshot, commits `spend()`, then saves the invoice credit (source lines 238-257). Two settlements with sufficient balance can debit twice while the invoice records one increment. The row lock inside `spend()` protects the balance, not the invoice. Validate with concurrent database transactions before Shop extraction; lock and refresh the invoice within the same transaction as the debit.
3. **Renewal workers are not protected by the scheduler callback lock.** `Shop/Schedule` locks the callback that dispatches `RunRenewals`; the queued job has no worker-level overlap lock. `Renewals::due()` checks for an existing bill before `invoiceMany()` inserts it without a locked recheck. Concurrent jobs can both select the same period and create separate bills. Validate with two workers; enforce idempotency at the job and invoice boundary.

The two concurrency findings are source-level findings, not reproduced failures against a running Pelican database. No unrelated fixes were applied.

## Validation

- Existing checks: 80 passed, 0 failed: the PHP character scanner, 40 `check-*.js` gates and 39 `*.test.js` suites.
- The real PHP parser compiled all 2,040 non-Blade PHP files. Binary: local Herd PHP 8.5.0RC1. This does not establish PHP 8.3 compatibility.
- Node version: 22.22.2. Translation and placeholder checks cover all 32 language directories.
- Many JavaScript suites model PHP behavior; they are not Laravel integration tests.
- A Pelican source reference exists under `no-git/pelican-panel-files`, but it has no `vendor/autoload.php`. Fresh install, permissions, queue/database concurrency, browser rendering and coexistence have not been run.
- No production code, database, settings, release assets or existing remote branches were changed by this preparation.

## Announcements first

Move the responsibility of `src/Support/Notice.php`, `src/Filament/Admin/Pages/Announcements.php`, `resources/views/pages/announcements.blade.php` and `lang/*/announcements.php`. Also extract the actually used `settings.notice.*` and `page.*` strings, announcement selectors from `theme.css`, dismissal code from `runtime.js`, permission registration and the feature switch. Replace references to global `Theme`, `Features` and `Stamp` with plugin-local responsibilities. Preserve the 10-row limit, scheduling, scopes, escaping, links and dismissal keys.

The new plugin must work without Core. Keep legacy notice storage readable, never delete the source, and transfer ownership only when the replacement is enabled and verified. Acceptance still requires installation, migration twice, non-root role permissions, enable/disable, uninstall/reinstall and coexistence checks on Pelican.

## Per-file index

Targets are proposed ownership, not completed moves. `split` requires more than copying a file. Dependencies list explicit PHP imports; fully qualified calls, Blade/JS references and dynamic lookups require the extraction review too. Signals are conservative direct source matches: an absent signal does not prove there is no transitive dependency. Risk describes migration complexity.

| Current file | Responsibility | Target | Risk | Direct signals | Explicit PHP imports |
| --- | --- | --- | --- | --- | --- |
| .gitattributes | .gitattributes | documentation | low | - | - |
| .github/workflows/dev-release.yml | Documentation, manifest or build configuration | documentation | low | - | - |
| .gitignore | .gitignore | documentation | low | - | - |
| LICENSE | LICENSE | documentation | low | - | - |
| README.md | Documentation, manifest or build configuration | documentation | low | - | - |
| build.ps1 | Documentation, manifest or build configuration | legacy-build | low | - | - |
| build.sh | Documentation, manifest or build configuration | legacy-build | low | - | - |
| config/essentials.php | essentials | legacy-build | low | env | - |
| database/Seeders/EssentialsSeeder.php | EssentialsSeeder | split | high | - | Illuminate\Database\Seeder; Legacy\Support\InstallTasks |
| database/Seeders/LegendDevelopmentSeeder.php | LegendDevelopmentSeeder | split | high | - | Illuminate\Database\Seeder; Legacy\Support\InstallTasks |
| database/migrations/2026_08_26_120000_legend_theme_clear_caches.php | 2026_08_26_120000_legend_theme_clear_caches | split | high | DB | Illuminate\Database\Migrations\Migration; Illuminate\Support\Facades\Artisan |
| database/migrations/2026_09_07_000000_essentials_api_keys.php | 2026_09_07_000000_essentials_api_keys | legacy-api | high | DB | Illuminate\Database\Migrations\Migration; Illuminate\Support\Facades\Schema |
| database/migrations/2026_09_08_000000_essentials_shop.php | 2026_09_08_000000_essentials_shop | essentials-shop | high | DB | Illuminate\Database\Migrations\Migration; Illuminate\Support\Facades\Schema |
| lang/ar/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/ar/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/ar/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/ar/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/ar/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/ar/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/ar/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/ar/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/ar/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/ar/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/ar/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/ar/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/ar/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/ar/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/ar/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/ar/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/ar/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/ar/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/ar/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/ar/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/ar/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/ar/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/ar/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/ar/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/ar/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/ar/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/ar/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/ar/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/ar/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/ar/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/ar/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/ar/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/ar/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/ar/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/ar/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/ar/page.php | Translation catalogue: page | split | high | - | - |
| lang/ar/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/ar/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/ar/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/ar/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/ar/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/ar/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/ar/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/ar/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/ar/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/ar/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/ar/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/ar/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/ar/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/ar/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/ar/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/ar/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/ar/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/ar/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/ar/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/be/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/be/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/be/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/be/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/be/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/be/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/be/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/be/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/be/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/be/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/be/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/be/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/be/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/be/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/be/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/be/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/be/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/be/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/be/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/be/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/be/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/be/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/be/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/be/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/be/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/be/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/be/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/be/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/be/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/be/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/be/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/be/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/be/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/be/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/be/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/be/page.php | Translation catalogue: page | split | high | - | - |
| lang/be/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/be/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/be/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/be/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/be/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/be/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/be/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/be/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/be/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/be/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/be/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/be/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/be/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/be/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/be/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/be/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/be/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/be/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/be/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/bg/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/bg/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/bg/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/bg/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/bg/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/bg/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/bg/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/bg/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/bg/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/bg/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/bg/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/bg/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/bg/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/bg/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/bg/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/bg/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/bg/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/bg/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/bg/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/bg/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/bg/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/bg/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/bg/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/bg/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/bg/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/bg/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/bg/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/bg/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/bg/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/bg/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/bg/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/bg/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/bg/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/bg/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/bg/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/bg/page.php | Translation catalogue: page | split | high | - | - |
| lang/bg/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/bg/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/bg/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/bg/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/bg/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/bg/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/bg/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/bg/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/bg/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/bg/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/bg/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/bg/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/bg/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/bg/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/bg/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/bg/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/bg/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/bg/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/bg/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/cs/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/cs/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/cs/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/cs/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/cs/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/cs/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/cs/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/cs/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/cs/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/cs/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/cs/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/cs/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/cs/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/cs/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/cs/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/cs/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/cs/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/cs/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/cs/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/cs/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/cs/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/cs/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/cs/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/cs/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/cs/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/cs/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/cs/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/cs/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/cs/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/cs/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/cs/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/cs/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/cs/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/cs/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/cs/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/cs/page.php | Translation catalogue: page | split | high | - | - |
| lang/cs/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/cs/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/cs/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/cs/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/cs/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/cs/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/cs/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/cs/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/cs/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/cs/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/cs/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/cs/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/cs/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/cs/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/cs/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/cs/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/cs/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/cs/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/cs/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/da/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/da/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/da/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/da/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/da/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/da/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/da/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/da/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/da/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/da/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/da/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/da/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/da/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/da/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/da/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/da/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/da/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/da/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/da/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/da/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/da/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/da/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/da/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/da/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/da/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/da/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/da/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/da/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/da/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/da/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/da/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/da/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/da/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/da/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/da/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/da/page.php | Translation catalogue: page | split | high | - | - |
| lang/da/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/da/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/da/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/da/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/da/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/da/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/da/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/da/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/da/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/da/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/da/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/da/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/da/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/da/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/da/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/da/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/da/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/da/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/da/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/de/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/de/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/de/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/de/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/de/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/de/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/de/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/de/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/de/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/de/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/de/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/de/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/de/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/de/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/de/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/de/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/de/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/de/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/de/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/de/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/de/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/de/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/de/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/de/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/de/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/de/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/de/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/de/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/de/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/de/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/de/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/de/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/de/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/de/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/de/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/de/page.php | Translation catalogue: page | split | high | - | - |
| lang/de/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/de/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/de/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/de/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/de/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/de/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/de/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/de/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/de/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/de/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/de/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/de/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/de/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/de/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/de/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/de/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/de/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/de/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/de/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/el/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/el/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/el/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/el/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/el/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/el/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/el/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/el/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/el/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/el/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/el/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/el/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/el/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/el/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/el/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/el/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/el/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/el/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/el/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/el/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/el/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/el/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/el/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/el/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/el/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/el/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/el/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/el/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/el/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/el/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/el/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/el/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/el/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/el/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/el/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/el/page.php | Translation catalogue: page | split | high | - | - |
| lang/el/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/el/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/el/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/el/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/el/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/el/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/el/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/el/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/el/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/el/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/el/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/el/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/el/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/el/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/el/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/el/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/el/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/el/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/el/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/en/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/en/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/en/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/en/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/en/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/en/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/en/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/en/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/en/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/en/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/en/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/en/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/en/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/en/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/en/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/en/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/en/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/en/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/en/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/en/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/en/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/en/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/en/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/en/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/en/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/en/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/en/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/en/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/en/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/en/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/en/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/en/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/en/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/en/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/en/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/en/page.php | Translation catalogue: page | split | high | - | - |
| lang/en/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/en/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/en/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/en/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/en/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/en/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/en/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/en/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/en/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/en/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/en/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/en/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/en/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/en/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/en/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/en/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/en/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/en/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/en/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/es/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/es/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/es/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/es/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/es/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/es/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/es/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/es/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/es/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/es/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/es/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/es/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/es/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/es/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/es/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/es/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/es/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/es/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/es/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/es/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/es/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/es/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/es/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/es/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/es/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/es/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/es/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/es/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/es/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/es/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/es/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/es/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/es/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/es/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/es/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/es/page.php | Translation catalogue: page | split | high | - | - |
| lang/es/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/es/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/es/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/es/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/es/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/es/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/es/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/es/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/es/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/es/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/es/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/es/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/es/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/es/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/es/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/es/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/es/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/es/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/es/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/fi/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/fi/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/fi/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/fi/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/fi/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/fi/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/fi/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/fi/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/fi/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/fi/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/fi/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/fi/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/fi/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/fi/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/fi/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/fi/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/fi/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/fi/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/fi/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/fi/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/fi/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/fi/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/fi/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/fi/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/fi/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/fi/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/fi/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/fi/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/fi/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/fi/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/fi/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/fi/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/fi/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/fi/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/fi/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/fi/page.php | Translation catalogue: page | split | high | - | - |
| lang/fi/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/fi/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/fi/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/fi/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/fi/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/fi/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/fi/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/fi/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/fi/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/fi/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/fi/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/fi/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/fi/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/fi/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/fi/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/fi/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/fi/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/fi/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/fi/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/fr/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/fr/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/fr/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/fr/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/fr/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/fr/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/fr/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/fr/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/fr/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/fr/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/fr/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/fr/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/fr/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/fr/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/fr/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/fr/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/fr/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/fr/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/fr/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/fr/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/fr/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/fr/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/fr/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/fr/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/fr/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/fr/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/fr/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/fr/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/fr/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/fr/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/fr/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/fr/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/fr/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/fr/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/fr/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/fr/page.php | Translation catalogue: page | split | high | - | - |
| lang/fr/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/fr/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/fr/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/fr/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/fr/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/fr/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/fr/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/fr/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/fr/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/fr/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/fr/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/fr/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/fr/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/fr/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/fr/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/fr/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/fr/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/fr/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/fr/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/hu/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/hu/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/hu/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/hu/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/hu/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/hu/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/hu/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/hu/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/hu/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/hu/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/hu/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/hu/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/hu/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/hu/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/hu/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/hu/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/hu/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/hu/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/hu/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/hu/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/hu/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/hu/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/hu/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/hu/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/hu/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/hu/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/hu/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/hu/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/hu/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/hu/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/hu/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/hu/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/hu/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/hu/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/hu/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/hu/page.php | Translation catalogue: page | split | high | - | - |
| lang/hu/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/hu/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/hu/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/hu/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/hu/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/hu/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/hu/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/hu/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/hu/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/hu/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/hu/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/hu/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/hu/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/hu/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/hu/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/hu/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/hu/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/hu/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/hu/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/id/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/id/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/id/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/id/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/id/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/id/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/id/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/id/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/id/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/id/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/id/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/id/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/id/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/id/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/id/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/id/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/id/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/id/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/id/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/id/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/id/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/id/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/id/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/id/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/id/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/id/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/id/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/id/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/id/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/id/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/id/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/id/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/id/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/id/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/id/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/id/page.php | Translation catalogue: page | split | high | - | - |
| lang/id/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/id/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/id/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/id/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/id/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/id/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/id/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/id/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/id/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/id/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/id/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/id/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/id/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/id/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/id/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/id/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/id/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/id/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/id/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/it/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/it/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/it/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/it/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/it/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/it/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/it/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/it/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/it/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/it/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/it/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/it/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/it/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/it/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/it/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/it/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/it/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/it/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/it/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/it/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/it/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/it/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/it/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/it/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/it/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/it/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/it/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/it/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/it/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/it/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/it/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/it/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/it/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/it/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/it/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/it/page.php | Translation catalogue: page | split | high | - | - |
| lang/it/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/it/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/it/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/it/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/it/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/it/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/it/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/it/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/it/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/it/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/it/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/it/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/it/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/it/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/it/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/it/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/it/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/it/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/it/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/ja/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/ja/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/ja/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/ja/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/ja/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/ja/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/ja/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/ja/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/ja/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/ja/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/ja/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/ja/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/ja/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/ja/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/ja/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/ja/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/ja/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/ja/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/ja/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/ja/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/ja/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/ja/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/ja/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/ja/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/ja/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/ja/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/ja/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/ja/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/ja/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/ja/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/ja/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/ja/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/ja/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/ja/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/ja/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/ja/page.php | Translation catalogue: page | split | high | - | - |
| lang/ja/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/ja/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/ja/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/ja/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/ja/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/ja/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/ja/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/ja/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/ja/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/ja/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/ja/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/ja/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/ja/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/ja/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/ja/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/ja/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/ja/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/ja/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/ja/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/ko/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/ko/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/ko/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/ko/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/ko/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/ko/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/ko/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/ko/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/ko/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/ko/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/ko/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/ko/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/ko/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/ko/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/ko/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/ko/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/ko/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/ko/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/ko/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/ko/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/ko/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/ko/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/ko/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/ko/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/ko/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/ko/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/ko/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/ko/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/ko/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/ko/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/ko/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/ko/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/ko/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/ko/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/ko/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/ko/page.php | Translation catalogue: page | split | high | - | - |
| lang/ko/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/ko/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/ko/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/ko/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/ko/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/ko/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/ko/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/ko/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/ko/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/ko/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/ko/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/ko/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/ko/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/ko/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/ko/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/ko/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/ko/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/ko/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/ko/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/lt/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/lt/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/lt/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/lt/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/lt/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/lt/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/lt/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/lt/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/lt/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/lt/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/lt/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/lt/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/lt/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/lt/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/lt/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/lt/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/lt/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/lt/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/lt/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/lt/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/lt/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/lt/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/lt/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/lt/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/lt/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/lt/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/lt/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/lt/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/lt/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/lt/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/lt/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/lt/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/lt/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/lt/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/lt/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/lt/page.php | Translation catalogue: page | split | high | - | - |
| lang/lt/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/lt/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/lt/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/lt/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/lt/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/lt/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/lt/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/lt/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/lt/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/lt/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/lt/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/lt/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/lt/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/lt/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/lt/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/lt/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/lt/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/lt/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/lt/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/nl/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/nl/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/nl/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/nl/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/nl/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/nl/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/nl/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/nl/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/nl/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/nl/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/nl/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/nl/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/nl/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/nl/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/nl/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/nl/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/nl/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/nl/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/nl/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/nl/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/nl/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/nl/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/nl/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/nl/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/nl/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/nl/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/nl/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/nl/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/nl/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/nl/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/nl/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/nl/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/nl/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/nl/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/nl/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/nl/page.php | Translation catalogue: page | split | high | - | - |
| lang/nl/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/nl/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/nl/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/nl/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/nl/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/nl/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/nl/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/nl/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/nl/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/nl/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/nl/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/nl/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/nl/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/nl/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/nl/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/nl/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/nl/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/nl/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/nl/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/no/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/no/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/no/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/no/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/no/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/no/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/no/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/no/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/no/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/no/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/no/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/no/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/no/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/no/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/no/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/no/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/no/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/no/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/no/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/no/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/no/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/no/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/no/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/no/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/no/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/no/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/no/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/no/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/no/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/no/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/no/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/no/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/no/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/no/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/no/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/no/page.php | Translation catalogue: page | split | high | - | - |
| lang/no/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/no/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/no/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/no/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/no/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/no/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/no/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/no/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/no/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/no/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/no/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/no/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/no/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/no/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/no/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/no/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/no/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/no/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/no/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/pl/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/pl/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/pl/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/pl/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/pl/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/pl/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/pl/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/pl/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/pl/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/pl/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/pl/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/pl/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/pl/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/pl/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/pl/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/pl/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/pl/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/pl/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/pl/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/pl/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/pl/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/pl/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/pl/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/pl/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/pl/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/pl/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/pl/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/pl/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/pl/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/pl/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/pl/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/pl/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/pl/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/pl/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/pl/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/pl/page.php | Translation catalogue: page | split | high | - | - |
| lang/pl/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/pl/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/pl/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/pl/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/pl/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/pl/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/pl/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/pl/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/pl/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/pl/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/pl/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/pl/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/pl/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/pl/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/pl/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/pl/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/pl/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/pl/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/pl/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/pt/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/pt/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/pt/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/pt/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/pt/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/pt/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/pt/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/pt/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/pt/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/pt/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/pt/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/pt/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/pt/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/pt/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/pt/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/pt/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/pt/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/pt/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/pt/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/pt/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/pt/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/pt/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/pt/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/pt/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/pt/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/pt/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/pt/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/pt/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/pt/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/pt/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/pt/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/pt/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/pt/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/pt/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/pt/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/pt/page.php | Translation catalogue: page | split | high | - | - |
| lang/pt/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/pt/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/pt/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/pt/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/pt/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/pt/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/pt/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/pt/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/pt/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/pt/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/pt/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/pt/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/pt/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/pt/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/pt/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/pt/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/pt/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/pt/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/pt/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/pt_BR/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/pt_BR/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/pt_BR/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/pt_BR/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/pt_BR/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/pt_BR/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/pt_BR/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/pt_BR/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/pt_BR/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/pt_BR/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/pt_BR/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/pt_BR/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/pt_BR/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/pt_BR/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/pt_BR/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/pt_BR/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/pt_BR/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/pt_BR/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/pt_BR/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/pt_BR/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/pt_BR/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/pt_BR/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/pt_BR/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/pt_BR/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/pt_BR/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/pt_BR/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/pt_BR/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/pt_BR/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/pt_BR/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/pt_BR/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/pt_BR/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/pt_BR/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/pt_BR/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/pt_BR/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/pt_BR/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/pt_BR/page.php | Translation catalogue: page | split | high | - | - |
| lang/pt_BR/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/pt_BR/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/pt_BR/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/pt_BR/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/pt_BR/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/pt_BR/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/pt_BR/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/pt_BR/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/pt_BR/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/pt_BR/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/pt_BR/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/pt_BR/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/pt_BR/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/pt_BR/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/pt_BR/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/pt_BR/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/pt_BR/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/pt_BR/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/pt_BR/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/ro/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/ro/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/ro/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/ro/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/ro/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/ro/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/ro/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/ro/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/ro/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/ro/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/ro/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/ro/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/ro/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/ro/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/ro/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/ro/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/ro/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/ro/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/ro/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/ro/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/ro/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/ro/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/ro/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/ro/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/ro/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/ro/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/ro/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/ro/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/ro/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/ro/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/ro/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/ro/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/ro/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/ro/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/ro/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/ro/page.php | Translation catalogue: page | split | high | - | - |
| lang/ro/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/ro/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/ro/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/ro/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/ro/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/ro/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/ro/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/ro/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/ro/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/ro/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/ro/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/ro/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/ro/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/ro/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/ro/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/ro/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/ro/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/ro/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/ro/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/ru/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/ru/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/ru/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/ru/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/ru/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/ru/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/ru/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/ru/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/ru/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/ru/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/ru/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/ru/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/ru/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/ru/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/ru/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/ru/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/ru/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/ru/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/ru/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/ru/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/ru/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/ru/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/ru/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/ru/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/ru/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/ru/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/ru/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/ru/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/ru/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/ru/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/ru/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/ru/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/ru/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/ru/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/ru/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/ru/page.php | Translation catalogue: page | split | high | - | - |
| lang/ru/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/ru/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/ru/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/ru/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/ru/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/ru/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/ru/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/ru/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/ru/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/ru/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/ru/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/ru/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/ru/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/ru/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/ru/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/ru/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/ru/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/ru/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/ru/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/sk/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/sk/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/sk/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/sk/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/sk/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/sk/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/sk/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/sk/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/sk/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/sk/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/sk/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/sk/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/sk/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/sk/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/sk/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/sk/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/sk/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/sk/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/sk/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/sk/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/sk/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/sk/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/sk/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/sk/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/sk/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/sk/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/sk/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/sk/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/sk/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/sk/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/sk/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/sk/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/sk/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/sk/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/sk/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/sk/page.php | Translation catalogue: page | split | high | - | - |
| lang/sk/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/sk/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/sk/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/sk/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/sk/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/sk/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/sk/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/sk/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/sk/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/sk/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/sk/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/sk/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/sk/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/sk/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/sk/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/sk/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/sk/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/sk/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/sk/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/sr/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/sr/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/sr/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/sr/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/sr/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/sr/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/sr/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/sr/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/sr/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/sr/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/sr/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/sr/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/sr/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/sr/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/sr/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/sr/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/sr/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/sr/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/sr/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/sr/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/sr/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/sr/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/sr/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/sr/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/sr/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/sr/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/sr/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/sr/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/sr/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/sr/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/sr/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/sr/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/sr/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/sr/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/sr/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/sr/page.php | Translation catalogue: page | split | high | - | - |
| lang/sr/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/sr/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/sr/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/sr/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/sr/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/sr/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/sr/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/sr/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/sr/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/sr/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/sr/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/sr/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/sr/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/sr/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/sr/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/sr/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/sr/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/sr/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/sr/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/sv/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/sv/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/sv/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/sv/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/sv/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/sv/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/sv/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/sv/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/sv/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/sv/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/sv/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/sv/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/sv/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/sv/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/sv/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/sv/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/sv/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/sv/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/sv/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/sv/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/sv/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/sv/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/sv/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/sv/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/sv/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/sv/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/sv/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/sv/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/sv/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/sv/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/sv/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/sv/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/sv/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/sv/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/sv/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/sv/page.php | Translation catalogue: page | split | high | - | - |
| lang/sv/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/sv/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/sv/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/sv/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/sv/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/sv/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/sv/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/sv/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/sv/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/sv/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/sv/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/sv/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/sv/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/sv/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/sv/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/sv/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/sv/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/sv/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/sv/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/tr/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/tr/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/tr/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/tr/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/tr/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/tr/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/tr/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/tr/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/tr/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/tr/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/tr/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/tr/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/tr/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/tr/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/tr/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/tr/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/tr/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/tr/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/tr/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/tr/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/tr/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/tr/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/tr/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/tr/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/tr/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/tr/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/tr/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/tr/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/tr/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/tr/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/tr/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/tr/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/tr/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/tr/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/tr/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/tr/page.php | Translation catalogue: page | split | high | - | - |
| lang/tr/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/tr/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/tr/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/tr/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/tr/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/tr/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/tr/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/tr/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/tr/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/tr/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/tr/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/tr/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/tr/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/tr/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/tr/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/tr/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/tr/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/tr/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/tr/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/uk/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/uk/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/uk/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/uk/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/uk/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/uk/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/uk/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/uk/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/uk/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/uk/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/uk/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/uk/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/uk/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/uk/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/uk/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/uk/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/uk/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/uk/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/uk/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/uk/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/uk/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/uk/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/uk/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/uk/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/uk/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/uk/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/uk/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/uk/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/uk/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/uk/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/uk/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/uk/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/uk/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/uk/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/uk/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/uk/page.php | Translation catalogue: page | split | high | - | - |
| lang/uk/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/uk/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/uk/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/uk/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/uk/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/uk/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/uk/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/uk/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/uk/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/uk/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/uk/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/uk/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/uk/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/uk/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/uk/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/uk/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/uk/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/uk/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/uk/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/vi/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/vi/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/vi/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/vi/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/vi/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/vi/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/vi/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/vi/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/vi/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/vi/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/vi/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/vi/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/vi/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/vi/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/vi/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/vi/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/vi/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/vi/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/vi/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/vi/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/vi/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/vi/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/vi/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/vi/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/vi/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/vi/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/vi/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/vi/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/vi/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/vi/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/vi/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/vi/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/vi/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/vi/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/vi/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/vi/page.php | Translation catalogue: page | split | high | - | - |
| lang/vi/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/vi/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/vi/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/vi/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/vi/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/vi/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/vi/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/vi/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/vi/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/vi/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/vi/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/vi/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/vi/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/vi/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/vi/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/vi/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/vi/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/vi/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/vi/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/zh_CN/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/zh_CN/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/zh_CN/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/zh_CN/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/zh_CN/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/zh_CN/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/zh_CN/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/zh_CN/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/zh_CN/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/zh_CN/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/zh_CN/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/zh_CN/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/zh_CN/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/zh_CN/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/zh_CN/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/zh_CN/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/zh_CN/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/zh_CN/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/zh_CN/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/zh_CN/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/zh_CN/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/zh_CN/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/zh_CN/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/zh_CN/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/zh_CN/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/zh_CN/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/zh_CN/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/zh_CN/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/zh_CN/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/zh_CN/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/zh_CN/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/zh_CN/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/zh_CN/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/zh_CN/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/zh_CN/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/zh_CN/page.php | Translation catalogue: page | split | high | - | - |
| lang/zh_CN/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/zh_CN/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/zh_CN/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/zh_CN/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/zh_CN/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/zh_CN/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/zh_CN/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/zh_CN/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/zh_CN/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/zh_CN/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/zh_CN/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/zh_CN/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/zh_CN/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/zh_CN/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/zh_CN/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/zh_CN/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/zh_CN/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/zh_CN/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/zh_CN/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| lang/zh_TW/access.php | Translation catalogue: access | essentials-core | low | - | - |
| lang/zh_TW/activity.php | Translation catalogue: activity | essentials-monitoring | low | - | - |
| lang/zh_TW/addons.php | Translation catalogue: addons | essentials-shop | low | - | - |
| lang/zh_TW/alerts.php | Translation catalogue: alerts | essentials-monitoring | low | - | - |
| lang/zh_TW/announcements.php | Translation catalogue: announcements | essentials-announcements | low | - | - |
| lang/zh_TW/api.php | Translation catalogue: api | legacy-api | low | - | - |
| lang/zh_TW/appearance.php | Translation catalogue: appearance | essentials-appearance | low | - | - |
| lang/zh_TW/ark.php | Translation catalogue: ark | essentials-game-manager | low | - | - |
| lang/zh_TW/artwork.php | Translation catalogue: artwork | essentials-game-manager | low | - | - |
| lang/zh_TW/backups.php | Translation catalogue: backups | essentials-monitoring | low | - | - |
| lang/zh_TW/capacity.php | Translation catalogue: capacity | essentials-monitoring | low | - | - |
| lang/zh_TW/changelog.php | Translation catalogue: changelog | split | high | - | - |
| lang/zh_TW/controls.php | Translation catalogue: controls | essentials-server-tools | low | - | - |
| lang/zh_TW/coupons.php | Translation catalogue: coupons | essentials-shop | low | - | - |
| lang/zh_TW/craftopia.php | Translation catalogue: craftopia | essentials-game-manager | low | - | - |
| lang/zh_TW/credit.php | Translation catalogue: credit | essentials-shop | low | - | - |
| lang/zh_TW/customers.php | Translation catalogue: customers | essentials-shop | low | - | - |
| lang/zh_TW/dontstarve.php | Translation catalogue: dontstarve | essentials-game-manager | low | - | - |
| lang/zh_TW/duplicate.php | Translation catalogue: duplicate | essentials-server-tools | low | - | - |
| lang/zh_TW/enshrouded.php | Translation catalogue: enshrouded | essentials-game-manager | low | - | - |
| lang/zh_TW/factorio.php | Translation catalogue: factorio | essentials-game-manager | low | - | - |
| lang/zh_TW/gameplayers.php | Translation catalogue: gameplayers | essentials-game-manager | low | - | - |
| lang/zh_TW/games.php | Translation catalogue: games | essentials-game-manager | low | - | - |
| lang/zh_TW/invoices.php | Translation catalogue: invoices | essentials-shop | low | - | - |
| lang/zh_TW/minecraft.php | Translation catalogue: minecraft | essentials-game-manager | low | - | - |
| lang/zh_TW/modpack.php | Translation catalogue: modpack | essentials-game-manager | low | - | - |
| lang/zh_TW/modules.php | Translation catalogue: modules | essentials-core | low | - | - |
| lang/zh_TW/mybackups.php | Translation catalogue: mybackups | essentials-monitoring | low | - | - |
| lang/zh_TW/myservers.php | Translation catalogue: myservers | essentials-monitoring | low | - | - |
| lang/zh_TW/navigation.php | Translation catalogue: navigation | essentials-appearance | low | - | - |
| lang/zh_TW/nodes.php | Translation catalogue: nodes | essentials-monitoring | low | - | - |
| lang/zh_TW/onset.php | Translation catalogue: onset | essentials-game-manager | low | - | - |
| lang/zh_TW/orders.php | Translation catalogue: orders | essentials-shop | low | - | - |
| lang/zh_TW/overview.php | Translation catalogue: overview | essentials-shop | low | - | - |
| lang/zh_TW/packages.php | Translation catalogue: packages | essentials-shop | low | - | - |
| lang/zh_TW/page.php | Translation catalogue: page | split | high | - | - |
| lang/zh_TW/palworld.php | Translation catalogue: palworld | essentials-game-manager | low | - | - |
| lang/zh_TW/payments.php | Translation catalogue: payments | essentials-shop | low | - | - |
| lang/zh_TW/players.php | Translation catalogue: players | essentials-game-manager | low | - | - |
| lang/zh_TW/portable.php | Translation catalogue: portable | split | high | - | - |
| lang/zh_TW/quick.php | Translation catalogue: quick | essentials-server-tools | low | - | - |
| lang/zh_TW/register.php | Translation catalogue: register | essentials-shop | low | - | - |
| lang/zh_TW/resources.php | Translation catalogue: resources | essentials-game-manager | low | - | - |
| lang/zh_TW/satisfactory.php | Translation catalogue: satisfactory | essentials-game-manager | low | - | - |
| lang/zh_TW/schedules.php | Translation catalogue: schedules | essentials-monitoring | low | - | - |
| lang/zh_TW/settings.php | Translation catalogue: settings | split | high | - | - |
| lang/zh_TW/shop.php | Translation catalogue: shop | essentials-shop | low | - | - |
| lang/zh_TW/status.php | Translation catalogue: status | essentials-monitoring | low | - | - |
| lang/zh_TW/system.php | Translation catalogue: system | essentials-monitoring | low | - | - |
| lang/zh_TW/terraria.php | Translation catalogue: terraria | essentials-game-manager | low | - | - |
| lang/zh_TW/tickets.php | Translation catalogue: tickets | essentials-support | low | - | - |
| lang/zh_TW/upgrades.php | Translation catalogue: upgrades | essentials-shop | low | - | - |
| lang/zh_TW/valheim.php | Translation catalogue: valheim | essentials-game-manager | low | - | - |
| lang/zh_TW/vrising.php | Translation catalogue: vrising | essentials-game-manager | low | - | - |
| lang/zh_TW/waitlist.php | Translation catalogue: waitlist | essentials-shop | low | - | - |
| plugin.json | Documentation, manifest or build configuration | legacy-build | low | - | - |
| release/essentials-dev.zip | Legacy release archive | legacy-build | low | - | - |
| resources/css/theme.css | theme.css | split | high | env | - |
| resources/icons/a_high_quality_3d_rendered_futuristic_tech_ui_icon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/cyberpunk_drive_mount_icon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/cyberpunk_logsökare_med_neonram.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/cyberpunk_neon_zoekicoon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/cyberpunk_taalvertalingsbol.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/cyberpunk_takenwachtrij_icoon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/futuristisch_rood_ondersteuningsticket_icoon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/futuristische_galerie_app_mit_neonrot.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/futuristische_neon_audit_zwischenablage.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/futuristische_neon_dashboard_ikone.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/futuristische_neon_eierincubatorbadge.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/futuristische_neonbel_icoon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/futuristische_neonrode_thuisknop.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/futuristische_rode_serverrack_icoon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/futuristische_servernest_met_neonaccenten.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/futuristisches_benutzergruppen_symbol.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/glanzend_cyberpunk_beveiligingscertificaat_icoon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/glanzend_neonrode_cyberpunk_mail_app_schaltfläche.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/glanzend_nieuwsicoon_met_megafoon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/glanzend_rood_beveiligingsschild_met_controlebadge.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/glanzend_rood_webhooks_netwerkpictogram.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/glanzende_neon_connector_icoon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/glanzende_neonrode_headset_badge.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/glanzende_neonrode_tandwielknop.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/glanzende_rode_back_updatabasepictogram.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/logo.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_analyserapport_dashboard_icoon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_api_sleutel_dashboard.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_archiefdoos_icoon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_backup_en_herstelschijf.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_cyberfirewall_schildicoon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_cyberidentiteit_hub.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_cyberprofiel_dashboard_icoon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_cyberpunk_2fa_beveiligingsbadge.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_cyberpunkwinkel_met_etalage.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_dashboard_analysepaneel.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_database_server_badge.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_documentinterface_in_sci_fi_frame.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_exportpictogram_met_lade_en_pijl.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_hartslagmonitor_dashboard.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_megafon_met_meldingsbadge.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_netwerkbol_badge.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_netzwerkserver_mit_portverteilung.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_puzzelplugin_icoon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_rode_kalender_met_klok.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_rode_wereldbolpictogram.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_rood_servernetwerkicoon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_server_upload_icon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_servermigratie_icoon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_serveronderhoud_icoon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_terminalsymbol_im_cyberpunk_stil.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_uitnodigingsbadge_met_gebruikersicoon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neon_wallet_met_glanzende_munten.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neonrode_cyberpunk_chat_appknop.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neonrode_cyberpunk_mailappico.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neonrode_importpictogram_met_tray.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neonrode_lanceerknop.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neonrode_ontwerperspalet_met_penseel.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neonrode_uptime_statusbadge.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neonrollenbadge_voor_gebruikersbeheer.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neonrood_futuristisch_bestandsicoon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/icons/neonrood_klok_en_planningsicoon.svg | SVG icon | essentials-appearance | low | - | - |
| resources/img/nav-icon.png | nav-icon.png | essentials-appearance | low | - | - |
| resources/inline/runtime.js | runtime.js | split | high | - | - |
| resources/js/arrange.js | arrange.js | essentials-server-tools | medium | - | - |
| resources/js/bars.js | bars.js | essentials-appearance | medium | - | - |
| resources/js/favourites.js | favourites.js | essentials-server-tools | medium | - | - |
| resources/js/quick.js | quick.js | essentials-server-tools | medium | - | - |
| resources/js/settings-search.js | settings-search.js | split | high | - | - |
| resources/views/components/api-docs.blade.php | Blade view: api-docs | legacy-api | low | - | - |
| resources/views/components/api-profile-keys.blade.php | Blade view: api-profile-keys | legacy-api | low | DB, Pelican | - |
| resources/views/components/my-backups.blade.php | Blade view: my-backups | essentials-monitoring | low | - | - |
| resources/views/components/preview.blade.php | Blade view: preview | essentials-appearance | low | - | - |
| resources/views/css-reference.blade.php | Blade view: css-reference | essentials-appearance | low | - | - |
| resources/views/invoice.blade.php | Blade view: invoice | essentials-shop | low | - | - |
| resources/views/livewire/server-controls-blank.blade.php | Blade view: server-controls-blank | essentials-server-tools | low | - | - |
| resources/views/livewire/server-controls-placeholder.blade.php | Blade view: server-controls-placeholder | essentials-server-tools | low | - | - |
| resources/views/livewire/server-controls-power.blade.php | Blade view: server-controls-power | essentials-server-tools | low | - | - |
| resources/views/livewire/server-controls.blade.php | Blade view: server-controls | essentials-server-tools | low | Pelican | - |
| resources/views/mail/invoice.blade.php | Blade view: invoice | essentials-shop | low | - | - |
| resources/views/modals/changelog.blade.php | Blade view: changelog | split | high | - | - |
| resources/views/modals/customer.blade.php | Blade view: customer | essentials-shop | low | - | - |
| resources/views/modals/hook.blade.php | Blade view: hook | essentials-support | low | - | - |
| resources/views/modals/order.blade.php | Blade view: order | essentials-shop | low | - | - |
| resources/views/modals/payment.blade.php | Blade view: payment | essentials-shop | low | - | - |
| resources/views/modals/ticket.blade.php | Blade view: ticket | essentials-support | low | - | - |
| resources/views/pages/activity.blade.php | Blade view: activity | essentials-monitoring | low | - | - |
| resources/views/pages/addons.blade.php | Blade view: addons | essentials-shop | low | - | - |
| resources/views/pages/alerts.blade.php | Blade view: alerts | essentials-monitoring | low | - | - |
| resources/views/pages/announcements.blade.php | Blade view: announcements | essentials-announcements | low | - | - |
| resources/views/pages/api-access.blade.php | Blade view: api-access | legacy-api | low | - | - |
| resources/views/pages/api-keys.blade.php | Blade view: api-keys | legacy-api | low | - | - |
| resources/views/pages/ark-config.blade.php | Blade view: ark-config | essentials-game-manager | low | - | - |
| resources/views/pages/backups.blade.php | Blade view: backups | essentials-monitoring | low | - | - |
| resources/views/pages/basket.blade.php | Blade view: basket | essentials-shop | low | Pelican | - |
| resources/views/pages/billing.blade.php | Blade view: billing | essentials-shop | low | - | - |
| resources/views/pages/capacity.blade.php | Blade view: capacity | essentials-monitoring | low | - | - |
| resources/views/pages/checkout.blade.php | Blade view: checkout | essentials-shop | low | Pelican | - |
| resources/views/pages/coupons.blade.php | Blade view: coupons | essentials-shop | low | - | - |
| resources/views/pages/customers.blade.php | Blade view: customers | essentials-shop | low | - | - |
| resources/views/pages/egg-artwork.blade.php | Blade view: egg-artwork | essentials-game-manager | low | - | - |
| resources/views/pages/favourites.blade.php | Blade view: favourites | essentials-server-tools | low | - | - |
| resources/views/pages/game-config.blade.php | Blade view: game-config | essentials-game-manager | low | - | - |
| resources/views/pages/game-players.blade.php | Blade view: game-players | essentials-game-manager | low | - | - |
| resources/views/pages/invoices.blade.php | Blade view: invoices | essentials-shop | low | - | - |
| resources/views/pages/login-screen.blade.php | Blade view: login-screen | essentials-appearance | low | - | - |
| resources/views/pages/modules.blade.php | Blade view: modules | split | high | - | - |
| resources/views/pages/my-servers.blade.php | Blade view: my-servers | essentials-monitoring | low | - | - |
| resources/views/pages/my-status.blade.php | Blade view: my-status | essentials-monitoring | low | - | - |
| resources/views/pages/mytickets.blade.php | Blade view: mytickets | essentials-support | low | - | - |
| resources/views/pages/navigation-links.blade.php | Blade view: navigation-links | essentials-appearance | low | - | - |
| resources/views/pages/orders.blade.php | Blade view: orders | essentials-shop | low | - | - |
| resources/views/pages/overview.blade.php | Blade view: overview | essentials-shop | low | - | - |
| resources/views/pages/packages.blade.php | Blade view: packages | essentials-shop | low | - | - |
| resources/views/pages/pay.blade.php | Blade view: pay | essentials-shop | low | Pelican | - |
| resources/views/pages/payments.blade.php | Blade view: payments | essentials-shop | low | - | - |
| resources/views/pages/players.blade.php | Blade view: players | essentials-game-manager | low | - | - |
| resources/views/pages/public-status.blade.php | Blade view: public-status | essentials-monitoring | low | - | - |
| resources/views/pages/resources.blade.php | Blade view: resources | essentials-game-manager | low | - | - |
| resources/views/pages/schedules.blade.php | Blade view: schedules | essentials-monitoring | low | - | - |
| resources/views/pages/server-access.blade.php | Blade view: server-access | essentials-core | low | - | - |
| resources/views/pages/service.blade.php | Blade view: service | essentials-shop | low | - | - |
| resources/views/pages/services.blade.php | Blade view: services | essentials-shop | low | Pelican | - |
| resources/views/pages/shop-settings.blade.php | Blade view: shop-settings | essentials-shop | low | - | - |
| resources/views/pages/store.blade.php | Blade view: store | essentials-shop | low | Pelican | - |
| resources/views/pages/system-status.blade.php | Blade view: system-status | essentials-monitoring | low | - | - |
| resources/views/pages/theme-settings.blade.php | Blade view: theme-settings | split | high | - | - |
| resources/views/pages/tickets.blade.php | Blade view: tickets | essentials-support | low | - | - |
| resources/views/pages/valheim-lists.blade.php | Blade view: valheim-lists | essentials-game-manager | low | - | - |
| resources/views/partials/said.blade.php | Blade view: said | split | high | - | - |
| resources/views/partials/service-does.blade.php | Blade view: service-does | essentials-shop | low | - | - |
| resources/views/partials/shop-tools.blade.php | Blade view: shop-tools | essentials-shop | low | - | - |
| resources/views/shop.blade.php | Blade view: shop | essentials-shop | low | - | - |
| resources/views/status.blade.php | Blade view: status | essentials-monitoring | low | - | - |
| resources/views/widgets/theme-status.blade.php | Blade view: theme-status | split | high | - | - |
| roadmap/00-what-is-possible.md | Documentation, manifest or build configuration | documentation | low | env, Pelican | - |
| roadmap/README.md | Documentation, manifest or build configuration | documentation | low | - | - |
| roadmap/api-next.md | Documentation, manifest or build configuration | documentation | low | Pelican | - |
| roadmap/api-one.md | Documentation, manifest or build configuration | documentation | low | routes | - |
| roadmap/api.md | Documentation, manifest or build configuration | documentation | low | DB, env, routes, Pelican | - |
| roadmap/backlog.md | Documentation, manifest or build configuration | documentation | low | queue | - |
| roadmap/console.md | Documentation, manifest or build configuration | documentation | low | - | - |
| roadmap/edges.md | Documentation, manifest or build configuration | documentation | low | - | Legacy\Support\Fields\Login |
| roadmap/games.md | Documentation, manifest or build configuration | documentation | low | - | - |
| roadmap/live-preview.md | Documentation, manifest or build configuration | documentation | low | - | - |
| roadmap/next-major.md | Documentation, manifest or build configuration | documentation | low | - | - |
| roadmap/presets.md | Documentation, manifest or build configuration | documentation | low | - | - |
| roadmap/server-list.md | Documentation, manifest or build configuration | documentation | low | - | - |
| roadmap/shell.md | Documentation, manifest or build configuration | documentation | low | hooks | - |
| roadmap/shop.md | Documentation, manifest or build configuration | documentation | low | - | - |
| roadmap/weight.md | Documentation, manifest or build configuration | documentation | low | - | - |
| src/Filament/Actions/OpenServer.php | OpenServer | essentials-server-tools | medium | DB, Pelican | App\Filament\Server\Pages\Console; App\Models\Server; Filament\Actions\Action; Illuminate\Database\Eloquent\Model; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/AdvancedSettings.php | Filament page: AdvancedSettings | essentials-appearance | medium | - | BackedEnum; Legacy\Support\Settings |
| src/Filament/Admin/Pages/Alerts.php | Filament page: Alerts | essentials-monitoring | medium | queue | BackedEnum; Carbon\CarbonImmutable; Filament\Actions\Action; Filament\Forms\Components\CheckboxList; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Components\Toggle; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Section; Filament\Schemas\Contracts\HasSchemas; Filament\Schemas\Schema; Legacy\Jobs\RunWatchdog; Legacy\Support\Alerts\Notifier; Legacy\Support\Alerts\State; Legacy\Support\Features; Legacy\Support\Settings; Legacy\Support\Theme; Legacy\Support\Workers; Throwable |
| src/Filament/Admin/Pages/Announcements.php | Filament page: Announcements | essentials-announcements | medium | - | BackedEnum; Filament\Actions\Action; Filament\Forms\Components\DateTimePicker; Filament\Forms\Components\Repeater; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Components\Toggle; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Contracts\HasSchemas; Filament\Schemas\Schema; Legacy\Support\Features; Legacy\Support\Notice; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/ApiKeys.php | Filament page: ApiKeys | legacy-api | medium | DB, Pelican | App\Models\User; BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Components\CheckboxList; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Components\Textarea; Filament\Forms\Components\Toggle; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Section; Filament\Schemas\Contracts\HasSchemas; Filament\Schemas\Schema; Filament\Tables\Columns\TextColumn; Filament\Tables\Concerns\InteractsWithTable; Filament\Tables\Contracts\HasTable; Filament\Tables\Filters\SelectFilter; Filament\Tables\Table; Illuminate\Database\Eloquent\Builder; Legacy\Filament\Concerns\OffersApiDocs; Legacy\Models\Key; Legacy\Support\Api\Docs; Legacy\Support\Api\Keys; Legacy\Support\Features; Legacy\Support\Settings; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/Backups.php | Filament page: Backups | essentials-monitoring | medium | DB, Pelican | App\Models\Server; BackedEnum; Carbon\CarbonImmutable; Filament\Actions\Action; Filament\Pages\Page; Filament\Tables\Columns\TextColumn; Filament\Tables\Concerns\InteractsWithTable; Filament\Tables\Contracts\HasTable; Filament\Tables\Filters\Filter; Filament\Tables\Table; Illuminate\Database\Eloquent\Builder; Legacy\Support\Backups as Store; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/Capacity.php | Filament page: Capacity | essentials-monitoring | medium | DB, Pelican | App\Models\Node; BackedEnum; Filament\Actions\Action; Filament\Pages\Page; Filament\Tables\Columns\TextColumn; Filament\Tables\Concerns\InteractsWithTable; Filament\Tables\Contracts\HasTable; Filament\Tables\Filters\Filter; Filament\Tables\Table; Illuminate\Database\Eloquent\Builder; Legacy\Support\Capacity as Store; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/DuplicateServer.php | Filament page: DuplicateServer | essentials-server-tools | medium | DB, Pelican | App\Models\Server; BackedEnum; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Section; Filament\Schemas\Components\Utilities\Get; Filament\Schemas\Components\Utilities\Set; Filament\Schemas\Contracts\HasSchemas; Filament\Schemas\Schema; Legacy\Support\Duplicate; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/EggArtwork.php | Filament page: EggArtwork | essentials-game-manager | medium | DB, queue, Pelican | App\Models\Egg; BackedEnum; Filament\Actions\Action; Filament\Forms\Components\TextInput; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Section; Filament\Tables\Columns\ImageColumn; Filament\Tables\Columns\TextColumn; Filament\Tables\Concerns\InteractsWithTable; Filament\Tables\Contracts\HasTable; Filament\Tables\Table; Legacy\Jobs\FetchArtwork; Legacy\Support\Artwork\Artwork; Legacy\Support\Artwork\Igdb; Legacy\Support\Artwork\Steam; Legacy\Support\Features; Legacy\Support\Settings; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/FileSettings.php | Filament page: FileSettings | split | high | - | BackedEnum; Filament\Actions\Action; Filament\Notifications\Notification; Legacy\Support\Cdn\Uploads; Legacy\Support\Features; Legacy\Support\Settings; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/GameSettings.php | Filament page: GameSettings | essentials-game-manager | medium | - | BackedEnum; Legacy\Support\Features; Legacy\Support\Settings |
| src/Filament/Admin/Pages/LanguageSettings.php | Filament page: LanguageSettings | essentials-core | medium | - | BackedEnum; Filament\Actions\Action; Filament\Forms\Components\Select; Filament\Notifications\Notification; Legacy\Support\Cdn\Mirror; Legacy\Support\Features; Legacy\Support\Languages; Legacy\Support\Settings; Legacy\Support\Theme; Legacy\Support\Translations |
| src/Filament/Admin/Pages/LoginScreen.php | Filament page: LoginScreen | essentials-appearance | medium | - | BackedEnum; Filament\Actions\Action; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Group; Filament\Schemas\Contracts\HasSchemas; Filament\Schemas\Schema; Legacy\Support\Features; Legacy\Support\Settings; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/Look.php | Filament page: Look | essentials-appearance | medium | - | BackedEnum; Filament\Actions\Action; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Notifications\Notification; Legacy\Support\Features; Legacy\Support\FullPreview; Legacy\Support\Presets; Legacy\Support\Settings; Legacy\Support\Theme |
| src/Filament/Admin/Pages/MinecraftSettings.php | Filament page: MinecraftSettings | essentials-game-manager | medium | - | BackedEnum; Legacy\Support\Features; Legacy\Support\Settings |
| src/Filament/Admin/Pages/ModuleSettings.php | Filament page: ModuleSettings | split | high | Pelican | BackedEnum; Filament\Notifications\Notification; Filament\Pages\Page; Legacy\Support\Features; Legacy\Support\Leftovers; Legacy\Support\Modules; Legacy\Support\Settings; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/NavigationLinks.php | Filament page: NavigationLinks | essentials-appearance | medium | - | BackedEnum; Filament\Actions\Action; Filament\Forms\Components\Repeater; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Components\Toggle; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Utilities\Get; Filament\Schemas\Contracts\HasSchemas; Filament\Schemas\Schema; Legacy\Support\Features; Legacy\Support\IconPacks; Legacy\Support\NavLinks; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/PanelActivity.php | Filament page: PanelActivity | essentials-monitoring | medium | DB, Pelican | App\Models\ActivityLog; App\Models\Server; BackedEnum; Filament\Actions\Action; Filament\Pages\Page; Filament\Tables\Columns\TextColumn; Filament\Tables\Concerns\InteractsWithTable; Filament\Tables\Contracts\HasTable; Filament\Tables\Filters\Filter; Filament\Tables\Filters\SelectFilter; Filament\Tables\Table; Illuminate\Database\Eloquent\Builder; Legacy\Support\Activity; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/PanelPages.php | Filament page: PanelPages | essentials-appearance | medium | - | BackedEnum; Legacy\Support\Settings |
| src/Filament/Admin/Pages/PanelSchedules.php | Filament page: PanelSchedules | essentials-monitoring | medium | DB, Pelican | App\Models\Schedule; BackedEnum; Carbon\CarbonImmutable; Filament\Actions\Action; Filament\Pages\Page; Filament\Tables\Columns\TextColumn; Filament\Tables\Concerns\InteractsWithTable; Filament\Tables\Contracts\HasTable; Filament\Tables\Filters\Filter; Filament\Tables\Table; Illuminate\Database\Eloquent\Builder; Legacy\Support\Features; Legacy\Support\Schedules; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/PublicStatus.php | Filament page: PublicStatus | essentials-monitoring | medium | DB, Pelican | App\Models\Node; App\Models\Server; BackedEnum; Filament\Actions\Action; Filament\Forms\Components\CheckboxList; Filament\Forms\Components\Repeater; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Components\Textarea; Filament\Forms\Components\Toggle; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Section; Filament\Schemas\Contracts\HasSchemas; Filament\Schemas\Schema; Legacy\Support\Features; Legacy\Support\Games\Games; Legacy\Support\Settings; Legacy\Support\Status\Monitors; Legacy\Support\Status\Publish; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/ServerAccess.php | Filament page: ServerAccess | essentials-core | medium | - | BackedEnum; Filament\Actions\Action; Filament\Forms\Components\CheckboxList; Filament\Forms\Components\Repeater; Filament\Forms\Components\Select; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Section; Filament\Schemas\Contracts\HasSchemas; Filament\Schemas\Schema; Legacy\Support\Access\RoleServers; Legacy\Support\Access\Sync; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/SettingsPage.php | Filament page: SettingsPage | split | high | - | Exception; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Group; Filament\Schemas\Contracts\HasSchemas; Filament\Schemas\Schema; Legacy\Support\Features; Legacy\Support\Preview; Legacy\Support\Settings; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/ShopAddons.php | Filament page: ShopAddons | essentials-shop | medium | DB | BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Components\CheckboxList; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Components\Textarea; Filament\Forms\Components\Toggle; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Section; Filament\Schemas\Contracts\HasSchemas; Filament\Support\Enums\Width; Filament\Tables\Columns\IconColumn; Filament\Tables\Columns\TextColumn; Filament\Tables\Concerns\InteractsWithTable; Filament\Tables\Contracts\HasTable; Filament\Tables\Filters\TernaryFilter; Filament\Tables\Table; Illuminate\Database\Eloquent\Builder; Legacy\Models\Addon; Legacy\Models\OrderAddon; Legacy\Models\Package; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Shop\Packages; Legacy\Support\Shop\Tables; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/ShopCoupons.php | Filament page: ShopCoupons | essentials-shop | medium | DB | BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Components\CheckboxList; Filament\Forms\Components\DateTimePicker; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Components\Toggle; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Section; Filament\Schemas\Components\Utilities\Get; Filament\Schemas\Contracts\HasSchemas; Filament\Support\Enums\Width; Filament\Tables\Columns\IconColumn; Filament\Tables\Columns\TextColumn; Filament\Tables\Concerns\InteractsWithTable; Filament\Tables\Contracts\HasTable; Filament\Tables\Filters\TernaryFilter; Filament\Tables\Table; Illuminate\Database\Eloquent\Builder; Legacy\Models\Coupon; Legacy\Models\Package; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Shop\Coupons; Legacy\Support\Shop\Packages; Legacy\Support\Shop\Tables; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/ShopCustomers.php | Filament page: ShopCustomers | essentials-shop | medium | DB, Pelican | App\Models\User; BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Components\TextInput; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Contracts\HasSchemas; Filament\Support\Enums\Width; Filament\Tables\Columns\TextColumn; Filament\Tables\Concerns\InteractsWithTable; Filament\Tables\Contracts\HasTable; Filament\Tables\Filters\Filter; Filament\Tables\Table; Illuminate\Database\Eloquent\Builder; Legacy\Models\Invoice; Legacy\Models\Order; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Shop\Credits; Legacy\Support\Shop\Customers; Legacy\Support\Shop\Packages; Legacy\Support\Shop\Tables; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/ShopInvoices.php | Filament page: ShopInvoices | essentials-shop | medium | DB, Pelican | BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Components\Radio; Filament\Forms\Components\TextInput; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Contracts\HasSchemas; Filament\Support\Enums\Width; Filament\Tables\Columns\TextColumn; Filament\Tables\Concerns\InteractsWithTable; Filament\Tables\Contracts\HasTable; Filament\Tables\Filters\Filter; Filament\Tables\Filters\SelectFilter; Filament\Tables\Table; Illuminate\Database\Eloquent\Builder; Legacy\Models\Invoice; Legacy\Models\Order; Legacy\Models\Payment; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Shop\Credits; Legacy\Support\Shop\Gateways; Legacy\Support\Shop\Invoices; Legacy\Support\Shop\Refunds; Legacy\Support\Shop\Tables; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/ShopOrders.php | Filament page: ShopOrders | essentials-shop | medium | DB, queue, Pelican | App\Models\Server; BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Components\DatePicker; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Contracts\HasSchemas; Filament\Tables\Columns\TextColumn; Filament\Tables\Concerns\InteractsWithTable; Filament\Tables\Contracts\HasTable; Filament\Tables\Filters\Filter; Filament\Tables\Filters\SelectFilter; Filament\Tables\Table; Illuminate\Database\Eloquent\Builder; Illuminate\Support\Carbon; Legacy\Filament\Actions\OpenServer; Legacy\Jobs\RunRenewals; Legacy\Models\Invoice; Legacy\Models\Order; Legacy\Models\Upgrade; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Shop\Addons; Legacy\Support\Shop\Invoices; Legacy\Support\Shop\Orders; Legacy\Support\Shop\Tables; Legacy\Support\Shop\Upgrades; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/ShopOverview.php | Filament page: ShopOverview | essentials-shop | medium | - | BackedEnum; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Concerns\InteractsWithForms; Filament\Pages\Page; Filament\Schemas\Contracts\HasSchemas; Legacy\Models\Invoice; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Shop\Tables; Legacy\Support\Shop\Takings; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/ShopPackages.php | Filament page: ShopPackages | essentials-shop | medium | DB, Pelican | App\Models\Node; BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Components\CheckboxList; Filament\Forms\Components\FileUpload; Filament\Forms\Components\KeyValue; Filament\Forms\Components\Placeholder; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Components\Textarea; Filament\Forms\Components\Toggle; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Section; Filament\Schemas\Components\Utilities\Get; Filament\Schemas\Components\Utilities\Set; Filament\Schemas\Contracts\HasSchemas; Filament\Support\Enums\Width; Filament\Tables\Columns\IconColumn; Filament\Tables\Columns\TextColumn; Filament\Tables\Concerns\InteractsWithTable; Filament\Tables\Contracts\HasTable; Filament\Tables\Filters\TernaryFilter; Filament\Tables\Table; Illuminate\Database\Eloquent\Builder; Legacy\Models\Package; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Shop\Packages; Legacy\Support\Shop\Ports; Legacy\Support\Shop\Tables; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/ShopPayments.php | Filament page: ShopPayments | essentials-shop | medium | DB, Pelican | BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Components\Radio; Filament\Forms\Components\TextInput; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Contracts\HasSchemas; Filament\Support\Enums\Width; Filament\Tables\Columns\TextColumn; Filament\Tables\Concerns\InteractsWithTable; Filament\Tables\Contracts\HasTable; Filament\Tables\Filters\SelectFilter; Filament\Tables\Table; Illuminate\Database\Eloquent\Builder; Legacy\Models\Invoice; Legacy\Models\Payment; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Shop\Gateways; Legacy\Support\Shop\Refunds; Legacy\Support\Shop\Tables; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/ShopSettings.php | Filament page: ShopSettings | essentials-shop | medium | - | BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Components\Placeholder; Filament\Forms\Components\Repeater; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Components\Textarea; Filament\Forms\Components\Toggle; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Section; Filament\Schemas\Components\Utilities\Get; Filament\Schemas\Contracts\HasSchemas; Filament\Schemas\Schema; Illuminate\Support\HtmlString; Legacy\Support\Features; Legacy\Support\Games\Games; Legacy\Support\Money; Legacy\Support\Settings; Legacy\Support\Shop\Gateways; Legacy\Support\Shop\Ports; Legacy\Support\Shop\Tables; Legacy\Support\Theme; Throwable |
| src/Filament/Admin/Pages/SupportTickets.php | Filament page: SupportTickets | essentials-support | medium | DB, Pelican | App\Models\Server; App\Models\User; BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Components\Placeholder; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Components\Textarea; Filament\Forms\Components\Toggle; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Section; Filament\Schemas\Components\Utilities\Get; Filament\Schemas\Contracts\HasSchemas; Filament\Support\Enums\Width; Filament\Tables\Columns\TextColumn; Filament\Tables\Concerns\InteractsWithTable; Filament\Tables\Contracts\HasTable; Filament\Tables\Filters\Filter; Filament\Tables\Filters\SelectFilter; Filament\Tables\Table; Illuminate\Database\Eloquent\Builder; Legacy\Filament\Actions\OpenServer; Legacy\Models\Ticket; Legacy\Support\Access\RoleServers; Legacy\Support\Features; Legacy\Support\Settings; Legacy\Support\Theme; Legacy\Support\Tickets\Board; Legacy\Support\Tickets\Desks; Legacy\Support\Tickets\Desks\Modora; Legacy\Support\Tickets\Files; Legacy\Support\Tickets\Hook; Legacy\Support\Tickets\Tables as TicketTables; Livewire\WithFileUploads; Throwable |
| src/Filament/Admin/Pages/SystemStatus.php | Filament page: SystemStatus | essentials-monitoring | medium | - | BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Components\CheckboxList; Filament\Forms\Components\Select; Filament\Forms\Components\Toggle; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Contracts\HasSchemas; Legacy\Support\Features; Legacy\Support\NodeHealth as Health; Legacy\Support\Settings; Legacy\Support\SystemStatus as Status; Legacy\Support\Theme; Legacy\Support\Versions; Throwable |
| src/Filament/Admin/Pages/ThemeSettings.php | Filament page: ThemeSettings | split | high | DB, queue, Pelican | App\Models\Plugin; BackedEnum; Exception; Filament\Actions\Action; Filament\Forms\Components\FileUpload; Filament\Forms\Concerns\InteractsWithForms; Filament\Infolists\Components\TextEntry; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Group; Filament\Schemas\Components\Utilities\Get; Filament\Schemas\Contracts\HasSchemas; Filament\Schemas\Schema; Illuminate\Contracts\Support\Htmlable; Legacy\Jobs\UpdateFromChannel; Legacy\Support\Changelog; Legacy\Support\Channels; Legacy\Support\NavIcon; Legacy\Support\Portable; Legacy\Support\Records; Legacy\Support\Settings; Legacy\Support\Theme; Legacy\Support\Workers; Livewire\Features\SupportFileUploads\TemporaryUploadedFile; Throwable |
| src/Filament/Admin/Widgets/ThemeStatus.php | ThemeStatus | split | high | queue, Pelican | Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Notifications\Notification; Filament\Schemas\Concerns\InteractsWithSchemas; Filament\Schemas\Contracts\HasSchemas; Filament\Widgets\Widget; Legacy\Jobs\UpdateFromChannel; Legacy\Support\AutoUpdate; Legacy\Support\Changelog; Legacy\Support\Channels; Legacy\Support\Features; Legacy\Support\Machines; Legacy\Support\Theme; Legacy\Support\Workers; Throwable |
| src/Filament/App/Pages/ApiAccess.php | Filament page: ApiAccess | legacy-api | medium | DB, Pelican | App\Models\User; BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Components\TextInput; Filament\Forms\Components\Textarea; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Contracts\HasSchemas; Illuminate\Support\Collection; Legacy\Filament\Concerns\OffersApiDocs; Legacy\Models\Connection; Legacy\Models\Key; Legacy\Support\Api\Connections; Legacy\Support\Api\Keys; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Filament/App/Pages/Appearance.php | Filament page: Appearance | essentials-appearance | medium | Pelican | BackedEnum; Filament\Actions\Action; Filament\Forms\Components\Select; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Section; Filament\Schemas\Contracts\HasSchemas; Filament\Schemas\Schema; Legacy\Support\Presets; Legacy\Support\Theme; Legacy\Support\UserTheme; Throwable |
| src/Filament/App/Pages/Basket.php | Filament page: Basket | essentials-shop | medium | DB, Pelican | App\Models\User; BackedEnum; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Contracts\HasSchemas; Legacy\Models\Coupon; Legacy\Models\Package; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Shop\Addons; Legacy\Support\Shop\Cart; Legacy\Support\Shop\Coupons; Legacy\Support\Shop\Customers; Legacy\Support\Shop\Invoices; Legacy\Support\Shop\Packages; Legacy\Support\Shop\Purchase; Legacy\Support\Shop\Tables; Legacy\Support\Shop\Vat; Legacy\Support\Theme; Throwable |
| src/Filament/App/Pages/Billing.php | Filament page: Billing | essentials-shop | medium | DB, Pelican | BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Components\TextInput; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Contracts\HasSchemas; Filament\Support\Enums\Width; Illuminate\Support\Collection; Legacy\Models\Credit; Legacy\Models\Invoice; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Shop\Credits; Legacy\Support\Shop\Gateways; Legacy\Support\Shop\Invoices; Legacy\Support\Shop\Packages; Legacy\Support\Shop\Tables; Legacy\Support\Theme; Throwable |
| src/Filament/App/Pages/Checkout.php | Filament page: Checkout | essentials-shop | medium | DB, Pelican | App\Models\User; BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Contracts\HasSchemas; Legacy\Models\Coupon; Legacy\Models\Package; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Shop\Addons; Legacy\Support\Shop\Cart; Legacy\Support\Shop\Coupons; Legacy\Support\Shop\Customers; Legacy\Support\Shop\Delivery; Legacy\Support\Shop\Invoices; Legacy\Support\Shop\Packages; Legacy\Support\Shop\Purchase; Legacy\Support\Shop\Tables; Legacy\Support\Theme; Livewire\Features\SupportFileUploads\TemporaryUploadedFile; Throwable |
| src/Filament/App/Pages/MyServers.php | Filament page: MyServers | essentials-monitoring | medium | DB, Pelican | App\Models\Server; BackedEnum; Carbon\CarbonImmutable; Filament\Actions\Action; Filament\Pages\Page; Filament\Tables\Columns\TextColumn; Filament\Tables\Concerns\InteractsWithTable; Filament\Tables\Contracts\HasTable; Filament\Tables\Filters\Filter; Filament\Tables\Table; Illuminate\Database\Eloquent\Builder; Legacy\Support\Attention; Legacy\Support\Backups as Store; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Filament/App/Pages/MyStatus.php | Filament page: MyStatus | essentials-monitoring | medium | DB, Pelican | App\Models\Server; BackedEnum; Filament\Actions\Action; Filament\Forms\Components\Repeater; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Components\Textarea; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Section; Filament\Schemas\Contracts\HasSchemas; Filament\Schemas\Schema; Legacy\Support\Status\Pages as Store; Legacy\Support\Status\Publish; Legacy\Support\Theme; Throwable |
| src/Filament/App/Pages/MyTickets.php | Filament page: MyTickets | essentials-support | medium | DB, Pelican | BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Components\Textarea; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Contracts\HasSchemas; Filament\Support\Enums\Width; Legacy\Models\Order; Legacy\Models\Ticket; Legacy\Support\Features; Legacy\Support\Shop\Orders; Legacy\Support\Theme; Legacy\Support\Tickets\Board; Legacy\Support\Tickets\Files; Livewire\WithFileUploads; Throwable |
| src/Filament/App/Pages/Pay.php | Filament page: Pay | essentials-shop | medium | DB, Pelican | App\Models\User; BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Contracts\HasSchemas; Legacy\Models\Invoice; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Shop\Gateways; Legacy\Support\Shop\Invoices; Legacy\Support\Shop\Tables; Legacy\Support\Theme; Throwable |
| src/Filament/App/Pages/Service.php | Filament page: Service | essentials-shop | medium | Pelican | BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Contracts\HasSchemas; Legacy\Filament\Concerns\ManagesServices; Legacy\Models\Order; Legacy\Models\Ticket; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Shop\Invoices; Legacy\Support\Shop\Orders; Legacy\Support\Shop\Renewals; Legacy\Support\Shop\Summary; Legacy\Support\Shop\Tables; Legacy\Support\Theme; Legacy\Support\Tickets\Board; Throwable |
| src/Filament/App/Pages/Services.php | Filament page: Services | essentials-shop | medium | Pelican | BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Concerns\InteractsWithForms; Filament\Pages\Page; Filament\Schemas\Contracts\HasSchemas; Legacy\Filament\Concerns\ManagesServices; Legacy\Support\Features; Legacy\Support\Shop\Summary; Legacy\Support\Shop\Tables; Legacy\Support\Theme; Throwable |
| src/Filament/App/Pages/Store.php | Filament page: Store | essentials-shop | medium | DB, Pelican | BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Contracts\HasSchemas; Illuminate\Support\Collection; Legacy\Models\Package; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Shop\Packages; Legacy\Support\Shop\Purchase; Legacy\Support\Shop\Tables; Legacy\Support\Shop\Waiting; Legacy\Support\Theme; Throwable |
| src/Filament/Auth/Register.php | Register | essentials-shop | medium | DB, Pelican | App\Models\User; Filament\Auth\Pages\Register as Base; Filament\Forms\Components\TextInput; Filament\Schemas\Components\Component; Illuminate\Database\Eloquent\Model; Legacy\Support\Registration; Legacy\Support\Theme; SensitiveParameter |
| src/Filament/Concerns/ManagesServices.php | ManagesServices | essentials-shop | medium | DB, Pelican | Filament\Notifications\Notification; Legacy\Filament\App\Pages\MyTickets; Legacy\Filament\App\Pages\Pay; Legacy\Models\Addon; Legacy\Models\Invoice; Legacy\Models\Order; Legacy\Models\OrderAddon; Legacy\Models\Package; Legacy\Support\Shop\Addons; Legacy\Support\Shop\Customers; Legacy\Support\Shop\Orders; Legacy\Support\Shop\Summary; Legacy\Support\Shop\Upgrades; Legacy\Support\Theme; Legacy\Support\Tickets\Board |
| src/Filament/Concerns/OffersApiDocs.php | OffersApiDocs | legacy-api | medium | - | Filament\Actions\Action; Legacy\Support\Api\Docs; Legacy\Support\Theme; Symfony\Component\HttpFoundation\StreamedResponse |
| src/Filament/Pages/Favourites.php | Filament page: Favourites | essentials-server-tools | medium | Pelican | BackedEnum; Filament\Pages\Page; Legacy\Support\Favourites as Store; Legacy\Support\Features; Legacy\Support\Quick; Legacy\Support\Theme; Throwable |
| src/Filament/Profile/ApiTab.php | ApiTab | legacy-api | medium | DB, Pelican | App\Models\User; Filament\Actions\Action; Filament\Forms\Components\TextInput; Filament\Notifications\Notification; Filament\Schemas\Components\Grid; Filament\Schemas\Components\Section; Filament\Schemas\Components\Tabs\Tab; Filament\Schemas\Components\Utilities\Get; Filament\Schemas\Components\View; Legacy\Models\Key; Legacy\Support\Api\Keys; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Filament/Profile/Profile.php | Profile | split | high | Pelican | App\Filament\Pages\Auth\EditProfile; Legacy\Support\Shop\Profile as Billing; Legacy\Support\Theme; Throwable |
| src/Filament/Server/Pages/ArkConfig.php | Filament page: ArkConfig | essentials-game-manager | medium | DB, Pelican | App\Enums\SubuserPermission; App\Models\Server; BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Facades\Filament; Filament\Forms\Components\TextInput; Filament\Forms\Components\Toggle; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Section; Filament\Schemas\Contracts\HasSchemas; Filament\Schemas\Schema; Legacy\Support\Games\Ark; Legacy\Support\Games\Ini; Legacy\Support\Theme; Throwable |
| src/Filament/Server/Pages/CraftopiaConfig.php | Filament page: CraftopiaConfig | essentials-game-manager | medium | DB, Pelican | App\Models\Server; BackedEnum; Legacy\Support\Games\Craftopia; Legacy\Support\Games\Ini |
| src/Filament/Server/Pages/DontStarveConfig.php | Filament page: DontStarveConfig | essentials-game-manager | medium | DB, Pelican | App\Models\Server; BackedEnum; Legacy\Support\Games\DontStarve; Legacy\Support\Games\Ini |
| src/Filament/Server/Pages/EnshroudedConfig.php | Filament page: EnshroudedConfig | essentials-game-manager | medium | DB, Pelican | App\Models\Server; BackedEnum; Legacy\Support\Games\Enshrouded; Legacy\Support\Games\Json |
| src/Filament/Server/Pages/FactorioConfig.php | Filament page: FactorioConfig | essentials-game-manager | medium | DB, Pelican | App\Models\Server; BackedEnum; Legacy\Support\Games\Factorio; Legacy\Support\Games\Json |
| src/Filament/Server/Pages/GameConfig.php | Filament page: GameConfig | essentials-game-manager | medium | DB, Pelican | App\Enums\SubuserPermission; App\Models\Server; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Facades\Filament; Filament\Forms\Components\TextInput; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Section; Filament\Schemas\Contracts\HasSchemas; Filament\Schemas\Schema; Legacy\Support\Games\Words; Legacy\Support\Theme; Throwable |
| src/Filament/Server/Pages/GamePlayers.php | Filament page: GamePlayers | essentials-game-manager | medium | DB, Pelican | App\Enums\SubuserPermission; App\Models\Server; BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Facades\Filament; Filament\Pages\Page; Legacy\Support\Games\A2S; Legacy\Support\Games\Games; Legacy\Support\Theme; Throwable |
| src/Filament/Server/Pages/MinecraftConfig.php | Filament page: MinecraftConfig | essentials-game-manager | medium | DB, Pelican | App\Enums\SubuserPermission; App\Models\Server; BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Facades\Filament; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Components\Textarea; Filament\Forms\Components\Toggle; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Section; Filament\Schemas\Contracts\HasSchemas; Filament\Schemas\Schema; Legacy\Support\Minecraft\Minecraft; Legacy\Support\Minecraft\Properties; Legacy\Support\Theme; Throwable |
| src/Filament/Server/Pages/Modpacks.php | Filament page: Modpacks | essentials-game-manager | medium | DB, queue, Pelican | App\Enums\SubuserPermission; App\Models\Server; BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Facades\Filament; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Section; Filament\Schemas\Components\Utilities\Get; Filament\Schemas\Components\Utilities\Set; Filament\Schemas\Contracts\HasSchemas; Filament\Schemas\Schema; Legacy\Jobs\InstallModpack; Legacy\Support\Minecraft\Minecraft; Legacy\Support\Minecraft\Modrinth; Legacy\Support\Theme; Throwable |
| src/Filament/Server/Pages/OnsetConfig.php | Filament page: OnsetConfig | essentials-game-manager | medium | DB, Pelican | App\Models\Server; BackedEnum; Legacy\Support\Games\Json; Legacy\Support\Games\Onset |
| src/Filament/Server/Pages/PalworldSettings.php | Filament page: PalworldSettings | essentials-game-manager | medium | DB, Pelican | App\Enums\SubuserPermission; App\Models\Server; BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Facades\Filament; Filament\Forms\Components\TextInput; Filament\Forms\Components\Toggle; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Section; Filament\Schemas\Contracts\HasSchemas; Filament\Schemas\Schema; Legacy\Support\Palworld\OptionSettings; Legacy\Support\Palworld\Palworld; Legacy\Support\Theme; Throwable |
| src/Filament/Server/Pages/Players.php | Filament page: Players | essentials-game-manager | medium | DB, Pelican | App\Enums\SubuserPermission; App\Models\Server; BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Facades\Filament; Filament\Forms\Components\TextInput; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Contracts\HasSchemas; Legacy\Support\Minecraft\Minecraft; Legacy\Support\Minecraft\Ping; Legacy\Support\Minecraft\Players as PlayerList; Legacy\Support\Theme; Throwable |
| src/Filament/Server/Pages/Resources.php | Filament page: Resources | essentials-game-manager | medium | DB, Pelican | App\Enums\SubuserPermission; App\Models\Server; BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Facades\Filament; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Section; Filament\Schemas\Components\Utilities\Get; Filament\Schemas\Components\Utilities\Set; Filament\Schemas\Contracts\HasSchemas; Filament\Schemas\Schema; Legacy\Support\Minecraft\Ledger; Legacy\Support\Minecraft\Minecraft; Legacy\Support\Minecraft\Modrinth; Legacy\Support\Minecraft\Resources as Store; Legacy\Support\Theme; Throwable |
| src/Filament/Server/Pages/SatisfactoryConfig.php | Filament page: SatisfactoryConfig | essentials-game-manager | medium | DB, Pelican | App\Models\Server; BackedEnum; Legacy\Support\Games\Ini; Legacy\Support\Games\Satisfactory |
| src/Filament/Server/Pages/TerrariaConfig.php | Filament page: TerrariaConfig | essentials-game-manager | medium | DB, Pelican | App\Models\Server; BackedEnum; Legacy\Support\Games\Terraria; Legacy\Support\Minecraft\Properties |
| src/Filament/Server/Pages/VRisingConfig.php | Filament page: VRisingConfig | essentials-game-manager | medium | DB, Pelican | App\Models\Server; BackedEnum; Legacy\Support\Games\Json; Legacy\Support\Games\VRising |
| src/Filament/Server/Pages/ValheimLists.php | Filament page: ValheimLists | essentials-game-manager | medium | DB, Pelican | App\Enums\SubuserPermission; App\Models\Server; BackedEnum; Filament\Actions\Action; Filament\Actions\Concerns\InteractsWithActions; Filament\Actions\Contracts\HasActions; Filament\Facades\Filament; Filament\Forms\Components\TagsInput; Filament\Forms\Concerns\InteractsWithForms; Filament\Notifications\Notification; Filament\Pages\Page; Filament\Schemas\Components\Section; Filament\Schemas\Contracts\HasSchemas; Filament\Schemas\Schema; Legacy\Support\Games\Names; Legacy\Support\Games\Valheim; Legacy\Support\Theme; Throwable |
| src/Http/ApiController.php | ApiController | legacy-api | medium | DB, routes, Pelican | App\Enums\SubuserPermission; App\Facades\Activity; App\Models\Server; App\Models\User; Carbon\CarbonImmutable; DateTimeInterface; Illuminate\Http\JsonResponse; Illuminate\Http\Request; Illuminate\Support\Collection; Illuminate\Support\Facades\RateLimiter; Legacy\Models\Key; Legacy\Models\Order; Legacy\Models\Ticket; Legacy\Models\TicketMessage; Legacy\Support\Alerts\State; Legacy\Support\Api\Connections; Legacy\Support\Api\Docs; Legacy\Support\Api\Keys; Legacy\Support\Api\Writes; Legacy\Support\Backups; Legacy\Support\Capacity; Legacy\Support\Channels; Legacy\Support\Features; Legacy\Support\Games\A2S; Legacy\Support\Games\Games; Legacy\Support\Minecraft\Minecraft; Legacy\Support\Minecraft\Ping; Legacy\Support\NodeHealth; Legacy\Support\Schedules; Legacy\Support\Shop\Tables as ShopTables; Legacy\Support\Shop\Takings; Legacy\Support\SystemStatus; Legacy\Support\Tickets\Board; RuntimeException; Symfony\Component\HttpKernel\Exception\ConflictHttpException; Symfony\Component\HttpKernel\Exception\NotFoundHttpException; Throwable |
| src/Http/FavouriteController.php | FavouriteController | essentials-server-tools | medium | - | Illuminate\Http\JsonResponse; Illuminate\Http\Request; Legacy\Support\Favourites; Legacy\Support\Features |
| src/Http/LayoutController.php | LayoutController | essentials-server-tools | medium | - | Illuminate\Http\JsonResponse; Illuminate\Http\Request; Legacy\Support\Layouts; Legacy\Support\Theme |
| src/Http/Middleware/ShopFirst.php | ShopFirst | essentials-shop | medium | Pelican | Closure; Filament\Facades\Filament; Illuminate\Http\Request; Legacy\Support\Features; Legacy\Support\Shop\Tables; Legacy\Support\Theme; Symfony\Component\HttpFoundation\Response; Throwable |
| src/Http/PanelLanguage.php | PanelLanguage | essentials-core | medium | - | Closure; Illuminate\Http\Request; Legacy\Support\Languages; Legacy\Support\PermissionLabel; Throwable |
| src/Http/PayController.php | PayController | essentials-shop | medium | DB, Pelican | App\Models\User; Filament\Notifications\Notification; Illuminate\Http\JsonResponse; Illuminate\Http\RedirectResponse; Illuminate\Http\Request; Legacy\Filament\App\Pages\Billing; Legacy\Models\Invoice; Legacy\Models\Payment; Legacy\Support\Shop\Gateways; Legacy\Support\Theme; Throwable |
| src/Http/QuickController.php | QuickController | essentials-server-tools | medium | - | Illuminate\Http\JsonResponse; Illuminate\Http\Request; Legacy\Support\Features; Legacy\Support\Quick |
| src/Http/ShopController.php | ShopController | essentials-shop | medium | DB, storage, Pelican | App\Models\User; Illuminate\Contracts\View\View; Illuminate\Http\Request; Illuminate\Support\Facades\Storage; Legacy\Models\Invoice; Legacy\Models\Order; Legacy\Models\Package; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Palette; Legacy\Support\Shop\Billing; Legacy\Support\Shop\Delivery; Legacy\Support\Shop\Packages; Legacy\Support\Shop\Purchase; Legacy\Support\Shop\Tables; Legacy\Support\Status\Publish; Legacy\Support\Theme; Symfony\Component\HttpFoundation\StreamedResponse; Throwable |
| src/Http/StatusController.php | StatusController | essentials-monitoring | medium | Pelican | Illuminate\Contracts\View\View; Illuminate\Http\JsonResponse; Illuminate\Http\Request; Legacy\Support\Palette; Legacy\Support\Status\Pages; Legacy\Support\Status\Publish; Legacy\Support\Theme |
| src/Http/TicketController.php | TicketController | essentials-support | medium | - | Illuminate\Http\JsonResponse; Illuminate\Http\Request; Illuminate\Http\Response; Legacy\Support\Features; Legacy\Support\Tickets\Board; Legacy\Support\Tickets\Files; Legacy\Support\Tickets\Hook; Throwable |
| src/Jobs/EnsureEnabled.php | Background job: EnsureEnabled | split | high | DB, queue, Pelican | App\Enums\PluginStatus; App\Models\Plugin; App\Services\Helpers\PluginService; Illuminate\Bus\Queueable; Illuminate\Contracts\Queue\ShouldBeUnique; Illuminate\Contracts\Queue\ShouldQueue; Illuminate\Foundation\Bus\Dispatchable; Illuminate\Queue\InteractsWithQueue; Illuminate\Queue\SerializesModels; Illuminate\Support\Facades\Log; Legacy\Support\Held; Legacy\Support\Theme; Throwable |
| src/Jobs/FetchArtwork.php | Background job: FetchArtwork | essentials-game-manager | medium | DB, queue, Pelican | App\Models\Egg; App\Models\User; Filament\Notifications\Notification; Illuminate\Bus\Queueable; Illuminate\Contracts\Queue\ShouldQueue; Illuminate\Foundation\Bus\Dispatchable; Illuminate\Queue\InteractsWithQueue; Illuminate\Queue\SerializesModels; Illuminate\Support\Facades\Log; Legacy\Support\Artwork\Artwork; Legacy\Support\Artwork\Igdb; Legacy\Support\Artwork\Steam; Legacy\Support\Held; Legacy\Support\Theme; Throwable |
| src/Jobs/Heartbeat.php | Background job: Heartbeat | split | high | queue | Illuminate\Bus\Queueable; Illuminate\Contracts\Queue\ShouldQueue; Illuminate\Foundation\Bus\Dispatchable; Illuminate\Queue\InteractsWithQueue; Illuminate\Queue\SerializesModels; Legacy\Support\Held; Legacy\Support\Workers |
| src/Jobs/InstallModpack.php | Background job: InstallModpack | essentials-game-manager | medium | DB, queue, Pelican | App\Models\Server; Filament\Notifications\Notification; Illuminate\Bus\Queueable; Illuminate\Contracts\Queue\ShouldQueue; Illuminate\Foundation\Bus\Dispatchable; Illuminate\Queue\InteractsWithQueue; Illuminate\Queue\SerializesModels; Illuminate\Support\Facades\Log; Legacy\Support\Held; Legacy\Support\Minecraft\Installer; Legacy\Support\Minecraft\Modpack; Legacy\Support\Theme; Throwable |
| src/Jobs/ProvisionServer.php | Background job: ProvisionServer | essentials-shop | medium | queue | Illuminate\Bus\Queueable; Illuminate\Contracts\Queue\ShouldQueue; Illuminate\Foundation\Bus\Dispatchable; Illuminate\Queue\InteractsWithQueue; Illuminate\Queue\SerializesModels; Legacy\Support\Held; Legacy\Support\Shop\Provision |
| src/Jobs/RunRenewals.php | Background job: RunRenewals | essentials-shop | medium | queue | Illuminate\Bus\Queueable; Illuminate\Contracts\Queue\ShouldQueue; Illuminate\Foundation\Bus\Dispatchable; Illuminate\Queue\InteractsWithQueue; Illuminate\Queue\SerializesModels; Illuminate\Support\Facades\Log; Legacy\Support\Features; Legacy\Support\Held; Legacy\Support\Shop\Credits; Legacy\Support\Shop\Renewals; Legacy\Support\Shop\Tables; Legacy\Support\Theme; Throwable |
| src/Jobs/RunWatchdog.php | Background job: RunWatchdog | essentials-monitoring | medium | queue | Illuminate\Bus\Queueable; Illuminate\Contracts\Queue\ShouldQueue; Illuminate\Foundation\Bus\Dispatchable; Illuminate\Queue\InteractsWithQueue; Illuminate\Queue\SerializesModels; Illuminate\Support\Facades\Log; Legacy\Support\Alerts\Watchdog; Legacy\Support\Held; Throwable |
| src/Jobs/UpdateFromChannel.php | Background job: UpdateFromChannel | split | high | DB, storage, queue, Pelican | App\Enums\PluginStatus; App\Models\Plugin; App\Models\User; App\Services\Helpers\PluginService; Exception; Filament\Notifications\Notification; Illuminate\Bus\Queueable; Illuminate\Contracts\Queue\ShouldBeUnique; Illuminate\Contracts\Queue\ShouldQueue; Illuminate\Foundation\Bus\Dispatchable; Illuminate\Http\UploadedFile; Illuminate\Queue\InteractsWithQueue; Illuminate\Queue\SerializesModels; Illuminate\Support\Facades\Http; Illuminate\Support\Facades\Log; Illuminate\Support\Facades\Storage; Illuminate\Support\Str; Legacy\Support\Channels; Legacy\Support\Held; Legacy\Support\Theme; Legacy\Support\Updating |
| src/Livewire/ServerControls.php | ServerControls | essentials-server-tools | medium | DB, Pelican | App\Enums\ContainerStatus; App\Enums\SubuserPermission; App\Filament\Server\Pages\Console; App\Filament\Server\Widgets\ServerConsole as PelicanConsole; App\Models\Server; App\Repositories\Daemon\DaemonServerRepository; Filament\Notifications\Notification; Illuminate\Contracts\View\View; Legacy\Support\IconPacks; Legacy\Support\ServerControls as Controls; Legacy\Support\Theme; Livewire\Attributes\Lazy; Livewire\Attributes\Locked; Livewire\Attributes\On; Livewire\Component; Throwable |
| src/Mail/InvoiceMail.php | InvoiceMail | essentials-shop | medium | - | Illuminate\Bus\Queueable; Illuminate\Mail\Mailable; Illuminate\Queue\SerializesModels; Legacy\Models\Invoice; Legacy\Support\Money; Legacy\Support\Shop\Invoices; Legacy\Support\Theme |
| src/Models/Addon.php | Persistent model: Addon | essentials-shop | medium | DB | Illuminate\Database\Eloquent\Model; Legacy\Support\Shop\Tables |
| src/Models/Connection.php | Persistent model: Connection | legacy-api | medium | DB, Pelican | App\Models\User; Illuminate\Database\Eloquent\Model; Illuminate\Database\Eloquent\Relations\BelongsTo |
| src/Models/Coupon.php | Persistent model: Coupon | essentials-shop | medium | DB | Illuminate\Database\Eloquent\Model |
| src/Models/Credit.php | Persistent model: Credit | essentials-shop | medium | DB, Pelican | App\Models\User; Illuminate\Database\Eloquent\Model; Illuminate\Database\Eloquent\Relations\BelongsTo; Legacy\Support\Shop\Tables |
| src/Models/Customer.php | Persistent model: Customer | essentials-shop | medium | DB, Pelican | App\Models\User; Illuminate\Database\Eloquent\Model; Illuminate\Database\Eloquent\Relations\BelongsTo; Legacy\Support\Shop\Tables |
| src/Models/Invoice.php | Persistent model: Invoice | essentials-shop | medium | DB, Pelican | App\Models\User; Illuminate\Database\Eloquent\Model; Illuminate\Database\Eloquent\Relations\BelongsTo; Illuminate\Database\Eloquent\Relations\BelongsToMany; Illuminate\Database\Eloquent\Relations\HasMany; Illuminate\Support\Collection; Legacy\Support\Shop\Tables; Throwable |
| src/Models/Key.php | Persistent model: Key | legacy-api | medium | DB, Pelican | App\Models\User; Illuminate\Database\Eloquent\Model; Illuminate\Database\Eloquent\Relations\BelongsTo |
| src/Models/Order.php | Persistent model: Order | essentials-shop | medium | DB, Pelican | App\Models\Server; App\Models\User; Illuminate\Database\Eloquent\Model; Illuminate\Database\Eloquent\Relations\BelongsTo; Illuminate\Database\Eloquent\Relations\BelongsToMany; Illuminate\Database\Eloquent\Relations\HasMany; Legacy\Support\Shop\Tables |
| src/Models/OrderAddon.php | Persistent model: OrderAddon | essentials-shop | medium | DB | Illuminate\Database\Eloquent\Model; Illuminate\Database\Eloquent\Relations\BelongsTo; Legacy\Support\Shop\Tables |
| src/Models/Package.php | Persistent model: Package | essentials-shop | medium | DB, Pelican | App\Models\Egg; Illuminate\Database\Eloquent\Model; Illuminate\Database\Eloquent\Relations\BelongsTo; Illuminate\Database\Eloquent\Relations\HasMany |
| src/Models/Payment.php | Persistent model: Payment | essentials-shop | medium | DB | Illuminate\Database\Eloquent\Model; Illuminate\Database\Eloquent\Relations\BelongsTo |
| src/Models/Ticket.php | Persistent model: Ticket | essentials-support | medium | DB, Pelican | App\Models\Role; App\Models\Server; App\Models\User; Illuminate\Database\Eloquent\Model; Illuminate\Database\Eloquent\Relations\BelongsTo; Illuminate\Database\Eloquent\Relations\HasMany; Legacy\Support\Tickets\Tables as TicketTables |
| src/Models/TicketMessage.php | Persistent model: TicketMessage | essentials-support | medium | DB, Pelican | App\Models\User; Illuminate\Database\Eloquent\Model; Illuminate\Database\Eloquent\Relations\BelongsTo; Legacy\Support\Tickets\Tables as TicketTables |
| src/Models/Upgrade.php | Persistent model: Upgrade | essentials-shop | medium | DB | Illuminate\Database\Eloquent\Model; Illuminate\Database\Eloquent\Relations\BelongsTo; Legacy\Support\Shop\Tables |
| src/Models/Waitlist.php | Persistent model: Waitlist | essentials-shop | medium | DB, Pelican | App\Models\User; Illuminate\Database\Eloquent\Model; Illuminate\Database\Eloquent\Relations\BelongsTo; Legacy\Support\Shop\Tables |
| src/Providers/ThemeServiceProvider.php | ThemeServiceProvider | split | high | DB, scheduler, routes, hooks, Pelican | App\Models\Role; App\Models\Server; App\Models\User; BladeUI\Icons\Factory as IconFactory; Filament\Support\Facades\FilamentView; Filament\View\PanelsRenderHook; Illuminate\Auth\Events\Login as SignedIn; Illuminate\Console\Scheduling\Schedule; Illuminate\Database\Eloquent\Builder; Illuminate\Support\Facades\Blade; Illuminate\Support\Facades\Event; Illuminate\Support\Facades\Route; Illuminate\Support\HtmlString; Illuminate\Support\ServiceProvider; Legacy\Filament\Profile\ApiTab; Legacy\Http\ApiController; Legacy\Http\FavouriteController; Legacy\Http\LayoutController; Legacy\Http\PayController; Legacy\Http\QuickController; Legacy\Http\ShopController; Legacy\Http\StatusController; Legacy\Http\TicketController; Legacy\Support\Access\RoleServers; Legacy\Support\Access\Sync; Legacy\Support\Alerts\Schedule as AlertSchedule; Legacy\Support\Api\Keys; Legacy\Support\Areas; Legacy\Support\Attention; Legacy\Support\AutoUpdate; Legacy\Support\Background; Legacy\Support\Bars; Legacy\Support\Cdn\Mirror; Legacy\Support\CustomCss; Legacy\Support\Favourites; Legacy\Support\Features; Legacy\Support\Forgotten; Legacy\Support\FullPreview; Legacy\Support\IconPacks; Legacy\Support\Icons; Legacy\Support\InstallTasks; Legacy\Support\Layout; Legacy\Support\Layouts; Legacy\Support\Login; Legacy\Support\NavLinks; Legacy\Support\Notice; Legacy\Support\Presets; Legacy\Support\Preview; Legacy\Support\Quick; Legacy\Support\Runtime; Legacy\Support\ServerConsole; Legacy\Support\ServerControls; Legacy\Support\ServerList; Legacy\Support\Shop\Schedule as ShopSchedule; Legacy\Support\Shop\Tables; Legacy\Support\SidebarFooter; Legacy\Support\Stamp; Legacy\Support\Terminal; Legacy\Support\Theme; Legacy\Support\Tickets\Board; Legacy\Support\Tickets\Button as TicketButton; Legacy\Support\Typography; Legacy\Support\Updating; Legacy\Support\UserTheme; Legacy\Support\Windows; Legacy\Support\Workers; Throwable |
| src/Support/Access/RoleServers.php | RoleServers | essentials-core | high | DB, storage, Pelican | App\Enums\SubuserPermission; App\Models\Role; App\Models\Server; Illuminate\Support\Facades\Storage; Legacy\Support\Features; RuntimeException; Throwable |
| src/Support/Access/Sync.php | Sync | essentials-core | high | DB, storage, queue, scheduler, Pelican | App\Jobs\RevokeSftpAccessJob; App\Models\Role; App\Models\Server; App\Models\Subuser; Illuminate\Console\Scheduling\Schedule as Scheduler; Illuminate\Support\Facades\Cache; Illuminate\Support\Facades\Storage; RuntimeException; Throwable |
| src/Support/Activity.php | Activity | essentials-monitoring | medium | DB, Pelican | App\Models\ActivityLog; App\Models\Server; App\Models\User; Illuminate\Database\Eloquent\Builder; Throwable |
| src/Support/Alerts/Notifier.php | Notifier | essentials-monitoring | medium | DB, storage, Pelican | App\Models\User; Filament\Notifications\Notification; Illuminate\Support\Facades\Http; Illuminate\Support\Facades\Mail; Illuminate\Support\Facades\Storage; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Support/Alerts/Owners.php | Owners | essentials-monitoring | medium | DB, Pelican | App\Models\Server; App\Models\User; Filament\Notifications\Notification; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Support/Alerts/Schedule.php | Schedule | essentials-monitoring | medium | queue, scheduler | Illuminate\Console\Scheduling\Schedule as Scheduler; Legacy\Jobs\RunWatchdog; Legacy\Support\Features; Legacy\Support\Status\Pages; Legacy\Support\Status\Publish; Legacy\Support\Theme; Legacy\Support\Workers; Throwable |
| src/Support/Alerts/State.php | State | essentials-monitoring | medium | storage | Illuminate\Support\Facades\Storage; Throwable |
| src/Support/Alerts/Watchdog.php | Watchdog | essentials-monitoring | medium | DB | Illuminate\Support\Facades\DB; Illuminate\Support\Facades\Schema; Legacy\Support\Backups; Legacy\Support\Features; Legacy\Support\Modules; Legacy\Support\NodeHealth; Legacy\Support\Schedules; Legacy\Support\Shop\Orders; Legacy\Support\Shop\Packages; Legacy\Support\Shop\Ports; Legacy\Support\Shop\Tables; Legacy\Support\Theme; Legacy\Support\Versions; Legacy\Support\Workers; Throwable |
| src/Support/Api/Connections.php | Connections | legacy-api | high | DB, Pelican | App\Models\ApiKey; App\Models\User; Illuminate\Database\Schema\Blueprint; Illuminate\Support\Carbon; Illuminate\Support\Facades\Cache; Illuminate\Support\Facades\Schema; Illuminate\Support\Str; Legacy\Models\Connection; Throwable |
| src/Support/Api/Docs.php | Docs | legacy-api | high | - | Legacy\Http\ApiController; Legacy\Models\Key; Legacy\Support\Alerts\Notifier; Throwable |
| src/Support/Api/Keys.php | Keys | legacy-api | high | DB, Pelican | App\Models\User; Illuminate\Database\Schema\Blueprint; Illuminate\Support\Carbon; Illuminate\Support\Facades\Schema; Illuminate\Support\Str; Legacy\Models\Key; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Support/Api/Writes.php | Writes | legacy-api | high | DB | Illuminate\Database\Schema\Blueprint; Illuminate\Support\Carbon; Illuminate\Support\Facades\DB; Illuminate\Support\Facades\Schema; Legacy\Models\Key; Throwable |
| src/Support/Areas.php | Areas | essentials-appearance | medium | - | - |
| src/Support/Artwork/Artwork.php | Artwork | essentials-game-manager | medium | DB, storage, Pelican | App\Models\Egg; Illuminate\Support\Facades\Storage; Throwable |
| src/Support/Artwork/Igdb.php | Igdb | essentials-game-manager | medium | DB, Pelican | App\Models\Egg; Illuminate\Support\Facades\Cache; Illuminate\Support\Facades\Http; Legacy\Support\Theme; Throwable |
| src/Support/Artwork/Steam.php | Steam | essentials-game-manager | medium | DB, Pelican | App\Models\Egg; Illuminate\Support\Facades\Http; Throwable |
| src/Support/Attention.php | Attention | essentials-monitoring | medium | DB, Pelican | App\Models\Server; Throwable |
| src/Support/AutoUpdate.php | AutoUpdate | split | high | queue, scheduler, Pelican | App\Services\Helpers\PluginService; Illuminate\Console\Scheduling\Schedule; Legacy\Jobs\UpdateFromChannel; Throwable |
| src/Support/Background.php | Background | essentials-appearance | medium | - | Legacy\Support\Cdn\Uploads |
| src/Support/Backups.php | Backups | essentials-monitoring | medium | DB, Pelican | App\Models\Server; App\Models\User; Illuminate\Database\Eloquent\Builder; Throwable; WeakMap |
| src/Support/Bars.php | Bars | essentials-appearance | medium | Pelican | App\Filament\Components\Tables\Columns\ProgressBarColumn; App\Filament\Components\Tables\Columns\ServerEntryColumn; Filament\Support\Facades\FilamentColor |
| src/Support/Capacity.php | Capacity | essentials-monitoring | medium | DB, Pelican | App\Models\Node; App\Models\Server; Illuminate\Database\Eloquent\Builder; Throwable |
| src/Support/Cdn/Mirror.php | Mirror | split | high | storage | Illuminate\Support\Facades\Http; Illuminate\Support\Facades\Storage; Legacy\Support\Channels; Legacy\Support\Languages; Legacy\Support\Theme; Legacy\Support\Translations; Throwable |
| src/Support/Cdn/Uploads.php | Uploads | split | high | storage | Illuminate\Contracts\Filesystem\Filesystem; Illuminate\Support\Facades\Http; Illuminate\Support\Facades\Storage; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Support/Changelog.php | Changelog | split | high | - | Filament\Actions\Action; Illuminate\Support\Str; Throwable |
| src/Support/Channels.php | Channels | split | high | DB, Pelican | App\Models\Plugin; Illuminate\Support\Facades\Http; Throwable |
| src/Support/Clean.php | Clean | split | high | - | - |
| src/Support/CustomCss.php | CustomCss | essentials-appearance | medium | storage | Illuminate\Support\Facades\Storage; Throwable |
| src/Support/Duplicate.php | Duplicate | essentials-server-tools | medium | DB, Pelican | App\Models\Allocation; App\Models\Server; App\Services\Servers\ServerCreationService; Illuminate\Support\Arr; Throwable |
| src/Support/Favourites.php | Favourites | essentials-server-tools | medium | storage, routes, Pelican | Illuminate\Support\Facades\Route; Illuminate\Support\Facades\Storage; Throwable |
| src/Support/Features.php | Features | split | high | env, queue, Pelican | App\Traits\EnvironmentWriterTrait; Illuminate\Support\Facades\Artisan; Illuminate\Support\Facades\Log; Throwable |
| src/Support/Fields/Advanced.php | Advanced | essentials-appearance | medium | Pelican | App\Enums\EditorLanguages; App\Filament\Components\Forms\Fields\MonacoEditor; Filament\Actions\Action; Filament\Forms\Components\ColorPicker; Filament\Forms\Components\Repeater; Filament\Forms\Components\Select; Filament\Forms\Components\Textarea; Filament\Schemas\Components\Actions; Legacy\Support\Areas; Legacy\Support\CustomCss; Legacy\Support\Theme |
| src/Support/Fields/Doorway.php | Doorway | essentials-appearance | medium | - | Filament\Forms\Components\FileUpload; Filament\Forms\Components\Placeholder; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Components\Toggle; Filament\Schemas\Components\Utilities\Get; Legacy\Support\Registration; Legacy\Support\Theme |
| src/Support/Fields/Eggs.php | Eggs | essentials-game-manager | medium | - | Filament\Forms\Components\CheckboxList; Filament\Forms\Components\Toggle; Legacy\Support\Games\Games; Legacy\Support\Minecraft\Minecraft; Legacy\Support\Theme |
| src/Support/Fields/Files.php | Files | split | high | - | Closure; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Components\Toggle; Filament\Schemas\Components\Utilities\Get; Legacy\Support\Cdn\Uploads; Legacy\Support\Languages; Legacy\Support\Theme |
| src/Support/Fields/Look.php | Look | essentials-appearance | medium | - | Filament\Actions\Action; Filament\Forms\Components\CheckboxList; Filament\Forms\Components\ColorPicker; Filament\Forms\Components\FileUpload; Filament\Forms\Components\Repeater; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Components\Toggle; Filament\Schemas\Components\Actions; Filament\Schemas\Components\Utilities\Get; Filament\Schemas\Components\Utilities\Set; Legacy\Support\Features; Legacy\Support\IconPacks; Legacy\Support\Icons; Legacy\Support\Layout; Legacy\Support\Mode; Legacy\Support\NavIcon; Legacy\Support\Palette; Legacy\Support\Presets; Legacy\Support\Theme; Legacy\Support\Typography; Legacy\Support\UserTheme; Legacy\Support\Windows |
| src/Support/Fields/Pages.php | Pages | essentials-appearance | medium | - | Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Components\Toggle; Filament\Schemas\Components\Section; Filament\Schemas\Components\Utilities\Get; Legacy\Support\ServerConsole; Legacy\Support\ServerControls; Legacy\Support\ServerList; Legacy\Support\Terminal; Legacy\Support\Theme |
| src/Support/Fields/Part.php | Part | split | high | - | Filament\Schemas\Components\Section; Legacy\Support\Theme |
| src/Support/Fields/Plugin.php | Plugin | split | high | queue, Pelican | Filament\Actions\Action; Filament\Forms\Components\FileUpload; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Components\Toggle; Filament\Notifications\Notification; Filament\Schemas\Components\Actions; Filament\Schemas\Components\Utilities\Get; Legacy\Filament\Admin\Pages\ModuleSettings; Legacy\Jobs\UpdateFromChannel; Legacy\Support\Channels; Legacy\Support\NavIcon; Legacy\Support\Theme; Legacy\Support\Workers; Throwable |
| src/Support/Fields/Words.php | Words | essentials-core | medium | - | Filament\Forms\Components\CheckboxList; Filament\Forms\Components\FileUpload; Filament\Forms\Components\Repeater; Filament\Forms\Components\Select; Filament\Forms\Components\TextInput; Filament\Forms\Components\Toggle; Filament\Schemas\Components\Utilities\Get; Legacy\Support\Languages; Legacy\Support\Theme; Legacy\Support\Translations |
| src/Support/Forgotten.php | Forgotten | split | high | DB, Pelican | App\Models\User; Illuminate\Support\Facades\DB; Legacy\Support\Status\Pages as StatusPages; Legacy\Support\Tickets\Files; Legacy\Support\Tickets\Tables as TicketTables; Throwable |
| src/Support/FullPreview.php | FullPreview | essentials-appearance | medium | - | Throwable |
| src/Support/Games/A2S.php | A2S | essentials-game-manager | medium | DB, Pelican | App\Models\Server; Throwable |
| src/Support/Games/Ark.php | Ark | essentials-game-manager | medium | DB, Pelican | App\Models\Server; App\Repositories\Daemon\DaemonFileRepository; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Support/Games/Craftopia.php | Craftopia | essentials-game-manager | medium | DB, Pelican | App\Models\Server; App\Repositories\Daemon\DaemonFileRepository; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Support/Games/DontStarve.php | DontStarve | essentials-game-manager | medium | DB, Pelican | App\Models\Server; App\Repositories\Daemon\DaemonFileRepository; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Support/Games/Enshrouded.php | Enshrouded | essentials-game-manager | medium | DB, Pelican | App\Models\Server; App\Repositories\Daemon\DaemonFileRepository; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Support/Games/Factorio.php | Factorio | essentials-game-manager | medium | DB, Pelican | App\Models\Server; App\Repositories\Daemon\DaemonFileRepository; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Support/Games/Games.php | Games | essentials-game-manager | medium | DB, Pelican | App\Models\Egg; App\Models\Server; Legacy\Support\Theme; Throwable |
| src/Support/Games/Ini.php | Ini | essentials-game-manager | medium | - | - |
| src/Support/Games/Json.php | Json | essentials-game-manager | medium | - | - |
| src/Support/Games/Names.php | Names | essentials-game-manager | medium | - | - |
| src/Support/Games/Onset.php | Onset | essentials-game-manager | medium | DB, Pelican | App\Models\Server; App\Repositories\Daemon\DaemonFileRepository; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Support/Games/Satisfactory.php | Satisfactory | essentials-game-manager | medium | DB, Pelican | App\Models\Server; App\Repositories\Daemon\DaemonFileRepository; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Support/Games/Terraria.php | Terraria | essentials-game-manager | medium | DB, Pelican | App\Models\Server; App\Repositories\Daemon\DaemonFileRepository; Legacy\Support\Features; Legacy\Support\Minecraft\Properties; Legacy\Support\Theme; Throwable |
| src/Support/Games/VRising.php | VRising | essentials-game-manager | medium | DB, Pelican | App\Models\Server; App\Repositories\Daemon\DaemonFileRepository; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Support/Games/Valheim.php | Valheim | essentials-game-manager | medium | DB, Pelican | App\Models\Server; App\Repositories\Daemon\DaemonFileRepository; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Support/Games/Words.php | Words | essentials-game-manager | medium | - | - |
| src/Support/Held.php | Held | split | high | - | Legacy\Support\Access\Sync; Legacy\Support\Alerts\Notifier; Legacy\Support\Alerts\State; Legacy\Support\Shop\Credits; Legacy\Support\Shop\Tables as ShopTables; Legacy\Support\Shop\Upgrades; Legacy\Support\Tickets\Tables as TicketTables; Throwable |
| src/Support/IconPacks.php | IconPacks | essentials-appearance | medium | storage, Pelican | BladeUI\Icons\Factory as IconFactory; Illuminate\Support\Facades\Storage; Livewire\Features\SupportFileUploads\TemporaryUploadedFile; Throwable; ZipArchive |
| src/Support/Icons.php | Icons | essentials-appearance | medium | storage | Illuminate\Support\Facades\Storage; Throwable |
| src/Support/InstallTasks.php | InstallTasks | split | high | storage, env, queue, Pelican | App\Services\Helpers\PluginService; Illuminate\Support\Facades\Artisan; Legacy\Jobs\EnsureEnabled; Legacy\Support\Api\Keys; Legacy\Support\Channels; Legacy\Support\Features; Legacy\Support\Settings; Legacy\Support\Shop\Tables; Legacy\Support\Theme; Throwable |
| src/Support/Languages.php | Languages | essentials-core | medium | Pelican | Throwable |
| src/Support/Layout.php | Layout | essentials-appearance | medium | Pelican | Filament\Panel; Filament\Support\Enums\Width; Throwable |
| src/Support/Layouts.php | Layouts | essentials-server-tools | medium | DB, storage, Pelican | App\Models\Role; Illuminate\Support\Facades\Storage; RuntimeException; Throwable |
| src/Support/Leftovers.php | Leftovers | split | high | - | Legacy\Support\Access\Sync; Legacy\Support\Status\Pages as StatusPages; Throwable |
| src/Support/Login.php | Login | essentials-appearance | medium | - | - |
| src/Support/Machines.php | Machines | essentials-monitoring | medium | DB, Pelican | App\Models\Node; Throwable |
| src/Support/Minecraft/Installer.php | Installer | essentials-game-manager | medium | DB, Pelican | App\Models\Server; App\Repositories\Daemon\DaemonFileRepository; Throwable |
| src/Support/Minecraft/Ledger.php | Ledger | essentials-game-manager | medium | DB, storage, Pelican | App\Models\Server; Illuminate\Support\Facades\Storage; Throwable |
| src/Support/Minecraft/Minecraft.php | Minecraft | essentials-game-manager | medium | DB, Pelican | App\Enums\ContainerStatus; App\Models\Egg; App\Models\Server; App\Repositories\Daemon\DaemonFileRepository; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Support/Minecraft/Modpack.php | Modpack | essentials-game-manager | medium | - | Throwable |
| src/Support/Minecraft/Modrinth.php | Modrinth | essentials-game-manager | medium | - | Illuminate\Support\Facades\Http; Legacy\Support\Theme; Throwable |
| src/Support/Minecraft/Ping.php | Ping | essentials-game-manager | medium | DB, Pelican | App\Models\Server; Throwable |
| src/Support/Minecraft/Players.php | Players | essentials-game-manager | medium | DB, Pelican | App\Models\Server; App\Repositories\Daemon\DaemonFileRepository; Throwable |
| src/Support/Minecraft/Properties.php | Properties | essentials-game-manager | medium | - | - |
| src/Support/Minecraft/Resources.php | Resources | essentials-game-manager | medium | DB, Pelican | App\Models\Server; App\Repositories\Daemon\DaemonFileRepository; Throwable |
| src/Support/Mode.php | Mode | essentials-appearance | medium | - | Filament\Enums\ThemeMode; Filament\Panel; Throwable |
| src/Support/Modules.php | Modules | split | high | - | Legacy\Support\Access\RoleServers; Legacy\Support\Api\Connections; Legacy\Support\Api\Keys; Legacy\Support\Api\Writes; Legacy\Support\Shop\Tables as ShopTables; Legacy\Support\Status\Publish; Legacy\Support\Tickets\Tables as TicketTables; Throwable |
| src/Support/Money.php | Money | essentials-shop | medium | - | Throwable |
| src/Support/NavIcon.php | NavIcon | essentials-appearance | medium | storage, Pelican | Illuminate\Support\Facades\Storage; Illuminate\Support\HtmlString; Legacy\Support\Cdn\Uploads; Throwable |
| src/Support/NavLinks.php | NavLinks | essentials-appearance | medium | storage | Filament\Navigation\NavigationItem; Filament\Panel; Illuminate\Support\Facades\Http; Illuminate\Support\Facades\Storage; RuntimeException; Throwable |
| src/Support/NodeHealth.php | NodeHealth | essentials-monitoring | medium | DB, Pelican | App\Models\Node; Throwable |
| src/Support/Notice.php | Notice | essentials-announcements | medium | storage | Filament\Facades\Filament; Illuminate\Support\Facades\Storage; RuntimeException; Throwable |
| src/Support/Palette.php | Palette | essentials-appearance | medium | - | Filament\Support\Colors\Color |
| src/Support/Palworld/OptionSettings.php | OptionSettings | essentials-game-manager | medium | - | - |
| src/Support/Palworld/Palworld.php | Palworld | essentials-game-manager | medium | DB, Pelican | App\Enums\ContainerStatus; App\Models\Server; App\Repositories\Daemon\DaemonFileRepository; Legacy\Support\Features; Throwable |
| src/Support/PermissionLabel.php | PermissionLabel | essentials-core | medium | - | Illuminate\Support\Facades\Lang; Throwable |
| src/Support/Pictures.php | Pictures | essentials-appearance | medium | - | Throwable |
| src/Support/Portable.php | Portable | split | high | - | Throwable |
| src/Support/Presets.php | Presets | essentials-appearance | medium | storage | Illuminate\Support\Facades\Storage; RuntimeException; Throwable |
| src/Support/Preview.php | Preview | essentials-appearance | medium | - | Throwable |
| src/Support/Quick.php | Quick | essentials-server-tools | medium | DB, Pelican | App\Models\Server; Filament\Facades\Filament; Illuminate\Database\Eloquent\Builder; Throwable |
| src/Support/Records.php | Records | split | high | DB | Illuminate\Support\Facades\DB; Illuminate\Support\Facades\Schema; Throwable |
| src/Support/Registration.php | Registration | essentials-shop | medium | env, Pelican | App\Extensions\OAuth\OAuthService; Throwable |
| src/Support/Runtime.php | Runtime | split | high | storage, Pelican | - |
| src/Support/Saved/Alerts.php | Alerts | essentials-monitoring | medium | env, Pelican | App\Traits\EnvironmentWriterTrait; Legacy\Support\Alerts\Notifier; Legacy\Support\Clean; Legacy\Support\Theme |
| src/Support/Saved/Api.php | Api | legacy-api | medium | env, Pelican | App\Traits\EnvironmentWriterTrait; Legacy\Support\Api\Keys; Legacy\Support\Clean; Legacy\Support\Stamp; Legacy\Support\Theme |
| src/Support/Saved/Artwork.php | Artwork | essentials-game-manager | medium | env, Pelican | App\Traits\EnvironmentWriterTrait; Legacy\Support\Clean; Legacy\Support\Theme |
| src/Support/Saved/Files.php | Files | split | high | env, Pelican | App\Traits\EnvironmentWriterTrait; Legacy\Support\Clean; Legacy\Support\Stamp; Legacy\Support\Theme |
| src/Support/Saved/Login.php | Login | essentials-appearance | medium | env, Pelican | App\Traits\EnvironmentWriterTrait; Legacy\Support\Clean; Legacy\Support\Login as LoginScreen; Legacy\Support\Pictures; Legacy\Support\Registration; Legacy\Support\Stamp; Legacy\Support\Theme; Legacy\Support\Uploaded |
| src/Support/Saved/Shop.php | Shop | essentials-shop | medium | env, Pelican | App\Traits\EnvironmentWriterTrait; Legacy\Support\Clean; Legacy\Support\Money; Legacy\Support\Portable; Legacy\Support\Settings; Legacy\Support\Shop\Billing; Legacy\Support\Shop\Cart; Legacy\Support\Shop\Purchase; Legacy\Support\Theme |
| src/Support/Saved/Status.php | Status | essentials-monitoring | medium | env, Pelican | App\Traits\EnvironmentWriterTrait; Legacy\Support\Clean; Legacy\Support\Games\Games; Legacy\Support\Status\Monitors; Legacy\Support\Status\Publish; Legacy\Support\Theme |
| src/Support/Saved/SystemStatus.php | SystemStatus | essentials-monitoring | medium | env, Pelican | App\Traits\EnvironmentWriterTrait; Legacy\Support\Features; Legacy\Support\Modules; Legacy\Support\SystemStatus as StatusPage |
| src/Support/Saved/Tickets.php | Tickets | essentials-support | medium | env, Pelican | App\Traits\EnvironmentWriterTrait; Legacy\Support\Theme |
| src/Support/Schedules.php | Schedules | essentials-monitoring | medium | DB, Pelican | App\Models\Schedule; Illuminate\Database\Eloquent\Builder; Throwable |
| src/Support/ServerConsole.php | ServerConsole | essentials-appearance | medium | - | Throwable |
| src/Support/ServerControls.php | ServerControls | essentials-server-tools | medium | DB, hooks, Pelican | App\Models\Server; Filament\Facades\Filament; Filament\Support\Facades\FilamentView; Filament\View\PanelsRenderHook; Illuminate\Support\Facades\Blade; Illuminate\Support\HtmlString; Throwable |
| src/Support/ServerList.php | ServerList | essentials-appearance | medium | - | - |
| src/Support/Settings.php | Settings | split | high | env, Pelican | App\Traits\EnvironmentWriterTrait; Filament\Notifications\Notification; Illuminate\Support\Arr; Illuminate\Support\Facades\Http; Legacy\Support\Alerts\Notifier; Legacy\Support\Cdn\Mirror; Legacy\Support\Cdn\Uploads; Legacy\Support\Fields\Advanced; Legacy\Support\Fields\Doorway; Legacy\Support\Fields\Eggs; Legacy\Support\Fields\Files; Legacy\Support\Fields\Look; Legacy\Support\Fields\Pages; Legacy\Support\Fields\Plugin; Legacy\Support\Fields\Words; Legacy\Support\Games\Ark; Legacy\Support\Games\Craftopia; Legacy\Support\Games\DontStarve; Legacy\Support\Games\Enshrouded; Legacy\Support\Games\Factorio; Legacy\Support\Games\Games; Legacy\Support\Games\Onset; Legacy\Support\Games\Satisfactory; Legacy\Support\Games\Terraria; Legacy\Support\Games\VRising; Legacy\Support\Games\Valheim; Legacy\Support\Languages; Legacy\Support\Minecraft\Minecraft; Legacy\Support\NavIcon; Legacy\Support\Pictures; Legacy\Support\Registration; Legacy\Support\Shop\Billing; Legacy\Support\Shop\Cart; Legacy\Support\Shop\Purchase; Legacy\Support\Status\Monitors; Legacy\Support\Status\Publish; Livewire\Features\SupportFileUploads\TemporaryUploadedFile; Throwable |
| src/Support/Shop/Addons.php | Addons | essentials-shop | high | DB | Illuminate\Support\Collection; Legacy\Models\Addon; Legacy\Models\Invoice; Legacy\Models\Order; Legacy\Models\OrderAddon; Legacy\Models\Package; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Theme; Throwable |
| src/Support/Shop/Billing.php | Billing | essentials-shop | high | DB, Pelican | App\Models\User; Filament\Notifications\Notification; Illuminate\Support\Carbon; Illuminate\Support\Facades\Mail; Legacy\Mail\InvoiceMail; Legacy\Models\Invoice; Legacy\Models\Order; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Theme; Throwable |
| src/Support/Shop/Cart.php | Cart | essentials-shop | high | DB | Illuminate\Support\Str; Legacy\Models\Coupon; Legacy\Models\Package; Legacy\Support\Theme; Throwable |
| src/Support/Shop/Coupons.php | Coupons | essentials-shop | high | DB | Legacy\Models\Coupon; Legacy\Models\Package; Legacy\Support\Money; Throwable |
| src/Support/Shop/Credits.php | Credits | essentials-shop | high | DB, Pelican | App\Models\User; Illuminate\Support\Collection; Illuminate\Support\Facades\DB; Legacy\Models\Credit; Legacy\Models\Invoice; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Support/Shop/Customers.php | Customers | essentials-shop | high | DB, Pelican | App\Models\User; Illuminate\Database\Eloquent\Builder; Legacy\Models\Credit; Legacy\Models\Customer; Legacy\Models\Invoice; Legacy\Models\Order; Legacy\Support\Money; Legacy\Support\Theme; Throwable |
| src/Support/Shop/Delivery.php | Delivery | essentials-shop | high | DB, storage, Pelican | App\Models\Server; App\Repositories\Daemon\DaemonFileRepository; Illuminate\Support\Facades\Storage; Illuminate\Support\Facades\URL; Legacy\Models\Order; Legacy\Support\Theme; RuntimeException; Throwable |
| src/Support/Shop/Gateway.php | Gateway | essentials-shop | high | - | Illuminate\Http\Request; Legacy\Models\Invoice; Legacy\Models\Payment |
| src/Support/Shop/Gateways.php | Gateways | essentials-shop | high | DB | Legacy\Models\Invoice; Legacy\Models\Payment; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Theme; Throwable |
| src/Support/Shop/Gateways/Mollie.php | Mollie | essentials-shop | high | DB | Illuminate\Http\Request; Illuminate\Support\Facades\Http; Legacy\Models\Invoice; Legacy\Models\Payment; Legacy\Support\Money; Legacy\Support\Shop\Gateway; Legacy\Support\Shop\Gateways; Legacy\Support\Shop\Invoices; Legacy\Support\Theme; RuntimeException; Throwable |
| src/Support/Shop/Gateways/PayPal.php | PayPal | essentials-shop | high | DB | Illuminate\Http\Request; Illuminate\Support\Facades\Cache; Illuminate\Support\Facades\Http; Legacy\Models\Invoice; Legacy\Models\Payment; Legacy\Support\Money; Legacy\Support\Shop\Gateway; Legacy\Support\Shop\Gateways; Legacy\Support\Shop\Invoices; Legacy\Support\Theme; RuntimeException; Throwable |
| src/Support/Shop/Gateways/Stripe.php | Stripe | essentials-shop | high | DB | Illuminate\Http\Request; Illuminate\Support\Facades\Http; Legacy\Models\Invoice; Legacy\Models\Payment; Legacy\Support\Money; Legacy\Support\Shop\Gateway; Legacy\Support\Shop\Gateways; Legacy\Support\Shop\Invoices; Legacy\Support\Theme; RuntimeException; Throwable |
| src/Support/Shop/Invoices.php | Invoices | essentials-shop | high | DB, queue, Pelican | App\Enums\SuspendAction; App\Models\Server; App\Services\Servers\SuspensionService; Illuminate\Support\Carbon; Illuminate\Support\Collection; Legacy\Jobs\ProvisionServer; Legacy\Models\Invoice; Legacy\Models\Order; Legacy\Models\Package; Legacy\Support\Alerts\Notifier; Legacy\Support\Money; Legacy\Support\Theme; Legacy\Support\Workers; Throwable |
| src/Support/Shop/Orders.php | Orders | essentials-shop | high | DB, queue, Pelican | App\Enums\SuspendAction; App\Models\Server; App\Services\Servers\ServerDeletionService; App\Services\Servers\SuspensionService; Illuminate\Database\Eloquent\Builder; Illuminate\Support\Carbon; Legacy\Jobs\ProvisionServer; Legacy\Models\Invoice; Legacy\Models\Order; Legacy\Support\Alerts\Notifier; Legacy\Support\Shop\Provision; Legacy\Support\Theme; Legacy\Support\Workers; Throwable |
| src/Support/Shop/Packages.php | Packages | essentials-shop | high | DB, storage, Pelican | App\Models\Egg; Illuminate\Support\Arr; Illuminate\Support\Collection; Illuminate\Support\Facades\Storage; Illuminate\Support\Str; Legacy\Models\Order; Legacy\Models\Package; Legacy\Support\Money; Legacy\Support\Theme; Livewire\Features\SupportFileUploads\TemporaryUploadedFile; Throwable |
| src/Support/Shop/Periods.php | Periods | essentials-shop | high | - | Illuminate\Support\Carbon; Legacy\Models\Order; Legacy\Models\Package |
| src/Support/Shop/Ports.php | Ports | essentials-shop | high | DB, Pelican | App\Models\Allocation; App\Models\Node; App\Services\Allocations\AssignmentService; Legacy\Models\Package; Throwable |
| src/Support/Shop/Profile.php | Profile | essentials-shop | high | Pelican | Filament\Forms\Components\Placeholder; Filament\Forms\Components\TextInput; Filament\Forms\Components\Textarea; Filament\Notifications\Notification; Filament\Schemas\Components\Section; Legacy\Models\Customer; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Theme; Throwable |
| src/Support/Shop/Provision.php | Provision | essentials-shop | high | DB, Pelican | App\Models\Allocation; App\Models\Node; App\Services\Servers\ServerCreationService; Illuminate\Support\Arr; Illuminate\Support\Carbon; Illuminate\Support\Facades\Cache; Legacy\Models\Invoice; Legacy\Models\Order; Legacy\Models\Package; Legacy\Support\Alerts\Notifier; Legacy\Support\Shop\Delivery; Legacy\Support\Theme; Throwable |
| src/Support/Shop/Purchase.php | Purchase | essentials-shop | high | DB, Pelican | App\Models\User; Illuminate\Support\Facades\DB; Legacy\Models\Coupon; Legacy\Models\Invoice; Legacy\Models\Order; Legacy\Models\Package; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Theme; RuntimeException; Throwable |
| src/Support/Shop/Refunds.php | Refunds | essentials-shop | high | - | Legacy\Models\Invoice; Legacy\Models\Payment; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Support/Shop/Renewals.php | Renewals | essentials-shop | high | DB | Closure; Illuminate\Database\Eloquent\Builder; Illuminate\Support\Carbon; Illuminate\Support\Collection; Legacy\Models\Invoice; Legacy\Models\Order; Legacy\Support\Alerts\Notifier; Legacy\Support\Money; Legacy\Support\Theme; Throwable |
| src/Support/Shop/Schedule.php | Schedule | essentials-shop | high | queue, scheduler | Illuminate\Console\Scheduling\Schedule as Scheduler; Legacy\Jobs\RunRenewals; Legacy\Support\Features; Legacy\Support\Workers; Throwable |
| src/Support/Shop/Servers.php | Servers | essentials-shop | high | DB, Pelican | App\Models\Server; App\Repositories\Daemon\DaemonServerRepository; App\Services\Servers\BuildModificationService; Throwable |
| src/Support/Shop/Summary.php | Summary | essentials-shop | high | DB, Pelican | App\Enums\ServerState; App\Models\Server; Illuminate\Support\Collection; Legacy\Models\Invoice; Legacy\Models\Order; Legacy\Models\Package; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Theme; Throwable |
| src/Support/Shop/Tables.php | Tables | essentials-shop | high | DB | Illuminate\Database\Schema\Blueprint; Illuminate\Support\Facades\DB; Illuminate\Support\Facades\Schema; Legacy\Models\Coupon; Legacy\Models\Invoice; Legacy\Models\Order; Legacy\Models\Package; Legacy\Models\Payment; Throwable |
| src/Support/Shop/Takings.php | Takings | essentials-shop | high | DB | Illuminate\Support\Carbon; Illuminate\Support\Collection; Legacy\Models\Invoice; Legacy\Models\Order; Legacy\Models\Package; Legacy\Support\Shop\Orders; Legacy\Support\Theme; Throwable |
| src/Support/Shop/Upgrades.php | Upgrades | essentials-shop | high | DB | Illuminate\Support\Carbon; Legacy\Models\Invoice; Legacy\Models\Order; Legacy\Models\Package; Legacy\Models\Upgrade; Legacy\Support\Features; Legacy\Support\Money; Legacy\Support\Theme; Throwable |
| src/Support/Shop/Vat.php | Vat | essentials-shop | high | - | Illuminate\Support\Facades\Http; Legacy\Support\Theme; Throwable |
| src/Support/Shop/Waiting.php | Waiting | essentials-shop | high | DB, Pelican | App\Models\User; Legacy\Models\Package; Legacy\Models\Waitlist; Legacy\Support\Features; Legacy\Support\Theme; Throwable |
| src/Support/SidebarFooter.php | SidebarFooter | essentials-appearance | medium | - | Throwable |
| src/Support/Stamp.php | Stamp | split | high | storage | Illuminate\Support\Facades\Storage; Throwable |
| src/Support/Status/Monitors.php | Monitors | essentials-monitoring | medium | storage | Illuminate\Support\Facades\Http; Illuminate\Support\Facades\Storage; Throwable |
| src/Support/Status/Pages.php | Pages | essentials-monitoring | medium | DB, storage, Pelican | App\Models\Server; Illuminate\Support\Facades\Storage; Legacy\Support\Features; Legacy\Support\Theme; Legacy\Support\UserTheme; Throwable |
| src/Support/Status/Publish.php | Publish | essentials-monitoring | medium | DB, Pelican | App\Enums\ContainerStatus; App\Models\Server; Illuminate\Support\Facades\Cache; Legacy\Support\Features; Legacy\Support\Games\A2S; Legacy\Support\Games\Games; Legacy\Support\Minecraft\Minecraft; Legacy\Support\Minecraft\Ping; Legacy\Support\NodeHealth; Legacy\Support\Palette; Legacy\Support\Presets; Legacy\Support\Theme; Legacy\Support\UserTheme; Throwable |
| src/Support/SystemStatus.php | SystemStatus | essentials-monitoring | medium | storage | Throwable |
| src/Support/Terminal.php | Terminal | essentials-server-tools | medium | - | - |
| src/Support/Theme.php | Theme | split | high | storage, Pelican | - |
| src/Support/Tickets/Board.php | Board | essentials-support | high | DB, Pelican | App\Models\Role; App\Models\User; Illuminate\Support\Carbon; Illuminate\Support\Collection; Legacy\Models\Order; Legacy\Models\Ticket; Legacy\Models\TicketMessage; Legacy\Support\Alerts\Notifier; Legacy\Support\Features; Legacy\Support\Shop\Billing; Legacy\Support\Theme; Throwable |
| src/Support/Tickets/Button.php | Button | essentials-support | high | Pelican | Filament\Facades\Filament; Legacy\Support\Theme; Throwable |
| src/Support/Tickets/Desk.php | Desk | essentials-support | high | - | Legacy\Models\Ticket; Legacy\Models\TicketMessage |
| src/Support/Tickets/Desks.php | Desks | essentials-support | high | - | Legacy\Support\Theme; Legacy\Support\Tickets\Desks\Modora; Legacy\Support\Tickets\Desks\Panel; Throwable |
| src/Support/Tickets/Desks/Modora.php | Modora | essentials-support | high | DB | GuzzleHttp\TransferStats; Illuminate\Support\Facades\Http; Legacy\Models\Ticket; Legacy\Models\TicketMessage; Legacy\Support\Theme; Legacy\Support\Tickets\Desk; Legacy\Support\Tickets\Files; RuntimeException; Throwable |
| src/Support/Tickets/Desks/Panel.php | Panel | essentials-support | high | - | Legacy\Models\Ticket; Legacy\Models\TicketMessage; Legacy\Support\Tickets\Desk |
| src/Support/Tickets/Files.php | Files | essentials-support | high | DB, storage | Illuminate\Support\Facades\Storage; Legacy\Models\TicketMessage; Legacy\Support\Cdn\Uploads; Legacy\Support\Theme; Livewire\Features\SupportFileUploads\TemporaryUploadedFile; Throwable |
| src/Support/Tickets/Hook.php | Hook | essentials-support | high | DB, storage | Illuminate\Http\Request; Illuminate\Support\Facades\Storage; Legacy\Models\Ticket; Legacy\Models\TicketMessage; Legacy\Support\Settings; Legacy\Support\Shop\Billing; Legacy\Support\Theme; Legacy\Support\Tickets\Files; Throwable |
| src/Support/Tickets/Markdown.php | Markdown | essentials-support | high | - | - |
| src/Support/Tickets/Tables.php | Tables | essentials-support | high | DB | Illuminate\Database\Schema\Blueprint; Illuminate\Support\Facades\DB; Illuminate\Support\Facades\Schema; Legacy\Models\Order; Throwable |
| src/Support/Translations.php | Translations | essentials-core | medium | storage, Pelican | Illuminate\Support\Facades\Storage; Throwable |
| src/Support/Typography.php | Typography | essentials-appearance | medium | - | - |
| src/Support/Updating.php | Updating | split | high | hooks | Filament\Support\Facades\FilamentView; Filament\View\PanelsRenderHook; Illuminate\Support\HtmlString; Throwable |
| src/Support/Uploaded.php | Uploaded | split | high | storage | Filament\Notifications\Notification; Illuminate\Support\Arr; Illuminate\Support\Facades\Storage; Legacy\Support\Cdn\Uploads; Livewire\Features\SupportFileUploads\TemporaryUploadedFile; Throwable |
| src/Support/UserTheme.php | UserTheme | essentials-appearance | medium | storage, Pelican | Illuminate\Support\Facades\Storage; RuntimeException; Throwable |
| src/Support/Versions.php | Versions | split | high | Pelican | App\Services\Helpers\SoftwareVersionService; Throwable |
| src/Support/Windows.php | Windows | essentials-appearance | medium | storage | Illuminate\Support\Facades\Storage; RuntimeException; Throwable |
| src/Support/Workers.php | Workers | split | high | queue | Legacy\Jobs\Heartbeat; Throwable |
| src/ThemePlugin.php | ThemePlugin | split | high | Pelican | App\Contracts\Plugins\HasPluginSettings; App\Filament\App\Resources\Servers\ServerResource; Exception; Filament\Actions\Action; Filament\Contracts\Plugin; Filament\Facades\Filament; Filament\Panel; Legacy\Filament\Admin\Pages\AdvancedSettings; Legacy\Filament\Admin\Pages\Alerts; Legacy\Filament\Admin\Pages\Announcements; Legacy\Filament\Admin\Pages\ApiKeys; Legacy\Filament\Admin\Pages\Backups; Legacy\Filament\Admin\Pages\Capacity; Legacy\Filament\Admin\Pages\DuplicateServer; Legacy\Filament\Admin\Pages\EggArtwork; Legacy\Filament\Admin\Pages\FileSettings; Legacy\Filament\Admin\Pages\GameSettings; Legacy\Filament\Admin\Pages\LanguageSettings; Legacy\Filament\Admin\Pages\LoginScreen; Legacy\Filament\Admin\Pages\Look; Legacy\Filament\Admin\Pages\MinecraftSettings; Legacy\Filament\Admin\Pages\ModuleSettings; Legacy\Filament\Admin\Pages\NavigationLinks; Legacy\Filament\Admin\Pages\PanelActivity; Legacy\Filament\Admin\Pages\PanelPages; Legacy\Filament\Admin\Pages\PanelSchedules; Legacy\Filament\Admin\Pages\PublicStatus; Legacy\Filament\Admin\Pages\ServerAccess; Legacy\Filament\Admin\Pages\ShopAddons; Legacy\Filament\Admin\Pages\ShopCoupons; Legacy\Filament\Admin\Pages\ShopCustomers; Legacy\Filament\Admin\Pages\ShopInvoices; Legacy\Filament\Admin\Pages\ShopOrders; Legacy\Filament\Admin\Pages\ShopOverview; Legacy\Filament\Admin\Pages\ShopPackages; Legacy\Filament\Admin\Pages\ShopPayments; Legacy\Filament\Admin\Pages\ShopSettings; Legacy\Filament\Admin\Pages\SupportTickets; Legacy\Filament\Admin\Pages\SystemStatus; Legacy\Filament\Admin\Pages\ThemeSettings; Legacy\Filament\Admin\Widgets\ThemeStatus; Legacy\Filament\App\Pages\ApiAccess; Legacy\Filament\App\Pages\Appearance; Legacy\Filament\App\Pages\Basket; Legacy\Filament\App\Pages\Billing; Legacy\Filament\App\Pages\Checkout; Legacy\Filament\App\Pages\MyServers; Legacy\Filament\App\Pages\MyStatus; Legacy\Filament\App\Pages\MyTickets; Legacy\Filament\App\Pages\Pay; Legacy\Filament\App\Pages\Service; Legacy\Filament\App\Pages\Services; Legacy\Filament\App\Pages\Store; Legacy\Filament\Auth\Register; Legacy\Filament\Pages\Favourites; Legacy\Filament\Profile\Profile; Legacy\Filament\Server\Pages\ArkConfig; Legacy\Filament\Server\Pages\CraftopiaConfig; Legacy\Filament\Server\Pages\DontStarveConfig; Legacy\Filament\Server\Pages\EnshroudedConfig; Legacy\Filament\Server\Pages\FactorioConfig; Legacy\Filament\Server\Pages\GamePlayers; Legacy\Filament\Server\Pages\MinecraftConfig; Legacy\Filament\Server\Pages\Modpacks; Legacy\Filament\Server\Pages\OnsetConfig; Legacy\Filament\Server\Pages\PalworldSettings; Legacy\Filament\Server\Pages\Players; Legacy\Filament\Server\Pages\Resources; Legacy\Filament\Server\Pages\SatisfactoryConfig; Legacy\Filament\Server\Pages\TerrariaConfig; Legacy\Filament\Server\Pages\VRisingConfig; Legacy\Filament\Server\Pages\ValheimLists; Legacy\Http\Middleware\ShopFirst; Legacy\Http\PanelLanguage; Legacy\Support\Access\Sync; Legacy\Support\Features; Legacy\Support\Layout; Legacy\Support\Mode; Legacy\Support\Money; Legacy\Support\NavLinks; Legacy\Support\Palette; Legacy\Support\Presets; Legacy\Support\Quick; Legacy\Support\Registration; Legacy\Support\Settings; Legacy\Support\Shop\Credits; Legacy\Support\Shop\Packages; Legacy\Support\Status\Pages as StatusPages; Legacy\Support\Theme; Legacy\Support\UserTheme; RuntimeException; Throwable |
| tools/a2s.test.js | Existing test suite | tooling | low | - | - |
| tools/access.test.js | Existing test suite | tooling | low | - | - |
| tools/addons.test.js | Existing test suite | tooling | low | routes | - |
| tools/alerts.test.js | Existing test suite | tooling | low | - | - |
| tools/api-sweep.php | api-sweep | tooling | low | - | Illuminate\Contracts\Http\Kernel; Illuminate\Http\Request; Legacy\Http\ApiController; Legacy\Support\Api\Docs |
| tools/api.test.js | Existing test suite | tooling | low | - | - |
| tools/artwork.test.js | Existing test suite | tooling | low | - | - |
| tools/background.test.js | Existing test suite | tooling | low | - | - |
| tools/basket.test.js | Existing test suite | tooling | low | - | - |
| tools/capacity.test.js | Existing test suite | tooling | low | - | - |
| tools/check-accumulate.js | Existing static build gate | tooling | low | - | - |
| tools/check-api-docs.js | Existing static build gate | tooling | low | routes | - |
| tools/check-api-render.js | Existing static build gate | tooling | low | - | - |
| tools/check-attempt.js | Existing static build gate | tooling | low | - | - |
| tools/check-backdrop.js | Existing static build gate | tooling | low | - | - |
| tools/check-banned.js | Existing static build gate | tooling | low | storage | - |
| tools/check-breakpoints.js | Existing static build gate | tooling | low | - | - |
| tools/check-choice.js | Existing static build gate | tooling | low | - | - |
| tools/check-classes.js | Existing static build gate | tooling | low | - | - |
| tools/check-columns.js | Existing static build gate | tooling | low | - | - |
| tools/check-controls.js | Existing static build gate | tooling | low | - | - |
| tools/check-dashes.js | Existing static build gate | tooling | low | - | - |
| tools/check-docblocks.js | Existing static build gate | tooling | low | - | - |
| tools/check-dupes.js | Existing static build gate | tooling | low | - | - |
| tools/check-export.js | Existing static build gate | tooling | low | - | - |
| tools/check-features.js | Existing static build gate | tooling | low | - | - |
| tools/check-fields.js | Existing static build gate | tooling | low | - | - |
| tools/check-focus.js | Existing static build gate | tooling | low | - | - |
| tools/check-games.js | Existing static build gate | tooling | low | env | - |
| tools/check-gates.js | Existing static build gate | tooling | low | - | - |
| tools/check-icons.js | Existing static build gate | tooling | low | - | - |
| tools/check-imports.js | Existing static build gate | tooling | low | - | - |
| tools/check-inherit.js | Existing static build gate | tooling | low | - | - |
| tools/check-invoice-lines.js | Existing static build gate | tooling | low | - | - |
| tools/check-jobs.js | Existing static build gate | tooling | low | - | - |
| tools/check-lang.js | Existing static build gate | tooling | low | - | - |
| tools/check-memos.js | Existing static build gate | tooling | low | - | - |
| tools/check-migrations.js | Existing static build gate | tooling | low | DB | - |
| tools/check-modules.js | Existing static build gate | tooling | low | - | - |
| tools/check-panels.js | Existing static build gate | tooling | low | - | - |
| tools/check-parse.js | Existing static build gate | tooling | low | - | - |
| tools/check-persist.js | Existing static build gate | tooling | low | - | - |
| tools/check-save.js | Existing static build gate | tooling | low | - | - |
| tools/check-self.js | Existing static build gate | tooling | low | env | - |
| tools/check-show.js | Existing static build gate | tooling | low | - | - |
| tools/check-stamp.js | Existing static build gate | tooling | low | - | - |
| tools/check-statics.js | Existing static build gate | tooling | low | - | - |
| tools/check-teardown.js | Existing static build gate | tooling | low | DB | - |
| tools/check-uses.js | Existing static build gate | tooling | low | - | - |
| tools/check-watchdog.js | Existing static build gate | tooling | low | DB, Pelican | - |
| tools/class-load.php | class-load | tooling | low | - | - |
| tools/coupons.test.js | Existing test suite | tooling | low | - | - |
| tools/credit.test.js | Existing test suite | tooling | low | - | - |
| tools/css.test.js | Existing test suite | tooling | low | - | - |
| tools/feeds.test.js | Existing test suite | tooling | low | - | - |
| tools/iconpacks.test.js | Existing test suite | tooling | low | - | - |
| tools/ini.test.js | Existing test suite | tooling | low | - | - |
| tools/json.test.js | Existing test suite | tooling | low | - | - |
| tools/languages.test.js | Existing test suite | tooling | low | - | - |
| tools/layouts.test.js | Existing test suite | tooling | low | - | - |
| tools/lint-php.js | lint-php.js | tooling | low | - | - |
| tools/make-game.js | make-game.js | tooling | low | env | - |
| tools/make-lang.js | make-lang.js | tooling | low | - | - |
| tools/owners.test.js | Existing test suite | tooling | low | - | - |
| tools/palette.test.js | Existing test suite | tooling | low | - | - |
| tools/perms.test.js | Existing test suite | tooling | low | - | - |
| tools/ping.test.js | Existing test suite | tooling | low | - | - |
| tools/players.test.js | Existing test suite | tooling | low | - | - |
| tools/portable.test.js | Existing test suite | tooling | low | - | - |
| tools/ports.test.js | Existing test suite | tooling | low | - | - |
| tools/resources.test.js | Existing test suite | tooling | low | - | - |
| tools/runtime.test.js | Existing test suite | tooling | low | - | - |
| tools/sanitise.test.js | Existing test suite | tooling | low | - | - |
| tools/schedules.test.js | Existing test suite | tooling | low | - | - |
| tools/shop.test.js | Existing test suite | tooling | low | - | - |
| tools/shrink-icon-pack.ps1 | Documentation, manifest or build configuration | tooling | low | - | - |
| tools/stamp.test.js | Existing test suite | tooling | low | - | - |
| tools/status.test.js | Existing test suite | tooling | low | - | - |
| tools/stock.test.js | Existing test suite | tooling | low | - | - |
| tools/tickets.test.js | Existing test suite | tooling | low | - | - |
| tools/upgrades.test.js | Existing test suite | tooling | low | routes | - |
| tools/valheim.test.js | Existing test suite | tooling | low | - | - |
| tools/versions.test.js | Existing test suite | tooling | low | - | - |
| tools/weigh.php | weigh | tooling | low | DB, Pelican | Illuminate\Contracts\Http\Kernel; Illuminate\Http\Request; Illuminate\Support\Facades\DB |
| tools/windows.test.js | Existing test suite | tooling | low | - | - |
| tools/words.test.js | Existing test suite | tooling | low | - | - |
| update-dev.json | Documentation, manifest or build configuration | legacy-build | low | - | - |
