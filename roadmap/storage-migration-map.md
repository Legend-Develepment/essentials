# Storage migration map

Snapshot: `25f037a0187804bc0edabe5ff2f6da9fbadfb113`. Paths below are source constants, not a listing of a live panel's storage. They are relative to their configured Laravel disk; confirm the disk in each owner before migration. The legacy local disk is normally `storage/app/private`. Ticket attachments and uploaded assets require separate public/private disk handling.

For each owned path: use a present new value first; otherwise validate and copy the legacy value; otherwise use defaults. Record migration completion, preserve the old file and make retries idempotent. During coexistence there must be exactly one writer. Never use private-role or user data as public assets. Cache stamps and staging directories should be rebuilt instead of treated as user content.

| Current path | Current owner | Proposed plugin | Proposed destination | Migration concern |
| --- | --- | --- | --- | --- |
| legend-theme/role-servers.json | src/Support/Access/RoleServers.php | essentials-core | essentials/core/role-servers.json | Retain mappings, permission unions and manual-subuser exclusions |
| legend-theme/access-managed.json | src/Support/Access/Sync.php | essentials-core | essentials/core/access-managed.json | Preserve exact managed-subuser ownership; reconcile with Pelican before writes |
| legend-theme/alerts/channels.json | src/Support/Alerts/Notifier.php | essentials-monitoring | essentials/monitoring/alerts/channels.json | Validate, copy once and retain legacy source |
| legend-theme/alerts/state.json | src/Support/Alerts/State.php | essentials-monitoring | essentials/monitoring/alerts/state.json | Validate, copy once and retain legacy source |
| legend-theme/translation-mirror.json | src/Support/Cdn/Mirror.php | split | Split or rebuild per consumer | Validate, copy once and retain legacy source |
| legend-theme/custom.css | src/Support/CustomCss.php | essentials-appearance | essentials/appearance/custom.css | Validate, copy once and retain legacy source |
| legend-theme/favourites | src/Support/Favourites.php | essentials-server-tools | essentials/server-tools/favourites | Keep role/user identity and per-user access restrictions |
| legend-theme/icons | src/Support/IconPacks.php | essentials-appearance | essentials/appearance/icons | Validate, copy once and retain legacy source |
| legend-theme/icons-staging | src/Support/IconPacks.php | essentials-appearance | essentials/appearance/icons-staging | Rebuild derived state; do not overwrite user content |
| legend-theme/icons-stamp | src/Support/IconPacks.php | essentials-appearance | essentials/appearance/icons-stamp | Rebuild derived state; do not overwrite user content |
| legend-theme/layouts.json | src/Support/Layouts.php | essentials-server-tools | essentials/server-tools/layouts.json | Keep role/user identity and per-user access restrictions |
| legend-theme/layouts/%d.json | src/Support/Layouts.php | essentials-server-tools | essentials/server-tools/layouts/%d.json | Keep role/user identity and per-user access restrictions |
| legend-theme/layouts/role-%d.json | src/Support/Layouts.php | essentials-server-tools | essentials/server-tools/layouts/role-%d.json | Keep role/user identity and per-user access restrictions |
| legend-theme/layouts/roles.json | src/Support/Layouts.php | essentials-server-tools | essentials/server-tools/layouts/roles.json | Keep role/user identity and per-user access restrictions |
| legend-theme/resources | src/Support/Minecraft/Ledger.php | essentials-game-manager | essentials/game-manager/resources | Validate, copy once and retain legacy source |
| legend-theme/navigation.json | src/Support/NavLinks.php | essentials-appearance | essentials/appearance/navigation.json | Validate, copy once and retain legacy source |
| legend-theme/announcements.json | src/Support/Notice.php | essentials-announcements | essentials/announcements/announcements.json | Validate, copy once and retain legacy source |
| legend-theme/presets.json | src/Support/Presets.php | essentials-appearance | essentials/appearance/presets.json | Validate, copy once and retain legacy source |
| legend-theme/stamp | src/Support/Stamp.php | split | Split or rebuild per consumer | Rebuild derived state; do not overwrite user content |
| legend-theme/stamp-layouts | src/Support/Stamp.php | split | Split or rebuild per consumer | Rebuild derived state; do not overwrite user content |
| legend-theme/status/monitors.json | src/Support/Status/Monitors.php | essentials-monitoring | essentials/monitoring/status/monitors.json | Validate, copy once and retain legacy source |
| legend-theme/status/pages | src/Support/Status/Pages.php | essentials-monitoring | essentials/monitoring/status/pages | Validate, copy once and retain legacy source |
| legend-theme/status/slugs.json | src/Support/Status/Pages.php | essentials-monitoring | essentials/monitoring/status/slugs.json | Validate, copy once and retain legacy source |
| legend-theme/tickets | src/Support/Tickets/Files.php | essentials-support | essentials/support/tickets | Preserve private attachments and webhook deduplication |
| legend-theme/ticket-hooks.json | src/Support/Tickets/Hook.php | essentials-support | essentials/support/ticket-hooks.json | Preserve private attachments and webhook deduplication |
| legend-theme/themes/%d.json | src/Support/UserTheme.php | essentials-appearance | essentials/appearance/themes/%d.json | Keep role/user identity and per-user access restrictions |
| legend-theme/windows.json | src/Support/Windows.php | essentials-appearance | essentials/appearance/windows.json | Validate, copy once and retain legacy source |

## Other persistence

- Shop, Support and API SQL tables remain under their existing `essentials_*` names. `Shop/Tables`, `Tickets/Tables`, `Api/Keys`, `Api/Connections` and `Api/Writes` currently own their schema logic. Core must not adopt these installers.
- `Pictures`/`Uploaded`, `Saved/Files` and `Cdn/Uploads` manage configured disk paths and external object storage. Resolve each asset's owner and URLs before copying; never assume all uploads live on the local disk.
- Artwork modifies Pelican's Egg records and icon assets; game editors read and write files on Wings, not in this plugin's local storage.
- Cart and client preference/dismissal state also exist in sessions or browser storage. Keep dismissal identities during Announcements migration and namespace new browser keys deliberately.
- Cache locks, heartbeat keys, queued class names and scheduler names must change with an ownership handover, not by starting duplicate jobs. Drain/restart workers when queued PHP namespaces change.
