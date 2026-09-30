# Settings migration map

Snapshot: `25f037a0187804bc0edabe5ff2f6da9fbadfb113`. These are proposed owners, not implemented migrations. No environment values or credentials were read. Every top-level key below comes from `config/essentials.php`; the environment names and `Settings`/`Saved` writer references come from source.

Keep the current key name under each module's own config namespace initially. Read a new module value if explicitly present; otherwise use the legacy config value, then the legacy default. Copy only after validation and record completion. Never delete legacy values. Mixed feature flags must be partitioned by feature instead of copied to Core. Release credentials and channels stay with the owning release pipeline.

The export column records whether `Portable::EXCLUDED` blocks this key today. 'Review' is deliberately not a blanket claim that exporting a value is safe. Asset paths and personal data need migration-specific handling too.

| Legacy key | Environment source | Proposed owner | Proposed new key/path | Existing writer | Secret/sensitive | Export |
| --- | --- | --- | --- | --- | --- | --- |
| preset | LEGEND_THEME_PRESET | essentials-appearance | essentials-appearance.preset | src/Support/Settings.php | No credential identified by name | Review before export |
| user_themes | LEGEND_THEME_USER_THEMES | essentials-appearance | essentials-appearance.user_themes | src/Support/Settings.php | No credential identified by name | Review before export |
| layout | LEGEND_THEME_LAYOUT | essentials-appearance | essentials-appearance.layout | src/Support/Settings.php | No credential identified by name | Review before export |
| nav_style | LEGEND_THEME_NAV_STYLE | essentials-appearance | essentials-appearance.nav_style | src/Support/Settings.php | No credential identified by name | Review before export |
| topbar_style | LEGEND_THEME_TOPBAR_STYLE | essentials-appearance | essentials-appearance.topbar_style | src/Support/Settings.php | No credential identified by name | Review before export |
| card_style | LEGEND_THEME_CARD_STYLE | essentials-appearance | essentials-appearance.card_style | src/Support/Settings.php | No credential identified by name | Review before export |
| accent | LEGEND_THEME_ACCENT | essentials-appearance | essentials-appearance.accent | src/Support/Settings.php | No credential identified by name | Review before export |
| surface | LEGEND_THEME_SURFACE | essentials-appearance | essentials-appearance.surface | src/Support/Settings.php | No credential identified by name | Review before export |
| radius | LEGEND_THEME_RADIUS | essentials-appearance | essentials-appearance.radius | src/Support/Settings.php | No credential identified by name | Review before export |
| force_dark | LEGEND_THEME_FORCE_DARK | essentials-appearance | essentials-appearance.force_dark | src/Support/Settings.php | No credential identified by name | Review before export |
| glass | LEGEND_THEME_GLASS | essentials-appearance | essentials-appearance.glass | src/Support/Settings.php | No credential identified by name | Review before export |
| glow | LEGEND_THEME_GLOW | essentials-appearance | essentials-appearance.glow | src/Support/Settings.php | No credential identified by name | Review before export |
| density | LEGEND_THEME_DENSITY | essentials-appearance | essentials-appearance.density | src/Support/Settings.php | No credential identified by name | Review before export |
| font | LEGEND_THEME_FONT | essentials-appearance | essentials-appearance.font | src/Support/Settings.php | No credential identified by name | Review before export |
| background | LEGEND_THEME_BACKGROUND | essentials-appearance | essentials-appearance.background | src/Support/Settings.php | No credential identified by name | Review before export |
| background_color | LEGEND_THEME_BG_COLOR | essentials-appearance | essentials-appearance.background_color | src/Support/Settings.php | No credential identified by name | Review before export |
| background_color_end | LEGEND_THEME_BG_COLOR_END | essentials-appearance | essentials-appearance.background_color_end | src/Support/Settings.php | No credential identified by name | Review before export |
| background_angle | LEGEND_THEME_BG_ANGLE | essentials-appearance | essentials-appearance.background_angle | src/Support/Settings.php | No credential identified by name | Review before export |
| background_image | LEGEND_THEME_BG_IMAGE | essentials-appearance | essentials-appearance.background_image | src/Support/Settings.php | No credential identified by name | Excluded by Portable |
| background_image_url | LEGEND_THEME_BG_URL | essentials-appearance | essentials-appearance.background_image_url | src/Support/Settings.php | No credential identified by name | Review before export |
| background_dim | LEGEND_THEME_BG_DIM | essentials-appearance | essentials-appearance.background_dim | src/Support/Settings.php | No credential identified by name | Review before export |
| background_blur | LEGEND_THEME_BG_BLUR | essentials-appearance | essentials-appearance.background_blur | src/Support/Settings.php | No credential identified by name | Review before export |
| server_art | LEGEND_THEME_SERVER_ART | essentials-appearance | essentials-appearance.server_art | src/Support/Settings.php | No credential identified by name | Review before export |
| server_art_dim | LEGEND_THEME_SERVER_ART_DIM | essentials-appearance | essentials-appearance.server_art_dim | src/Support/Settings.php | No credential identified by name | Review before export |
| server_status | LEGEND_THEME_SERVER_STATUS | essentials-appearance | essentials-appearance.server_status | src/Support/Settings.php | No credential identified by name | Review before export |
| server_density | LEGEND_THEME_SERVER_DENSITY | essentials-appearance | essentials-appearance.server_density | src/Support/Settings.php | No credential identified by name | Review before export |
| server_columns | LEGEND_THEME_SERVER_COLUMNS | essentials-appearance | essentials-appearance.server_columns | src/Support/Settings.php | No credential identified by name | Review before export |
| server_filter_label | LEGEND_THEME_SERVER_FILTER_LABEL | essentials-appearance | essentials-appearance.server_filter_label | src/Support/Settings.php | No credential identified by name | Review before export |
| server_controls | LEGEND_THEME_SERVER_CONTROLS | essentials-server-tools | essentials-server-tools.server_controls | src/Support/Settings.php | No credential identified by name | Review before export |
| server_controls_position | LEGEND_THEME_SERVER_CONTROLS_POSITION | essentials-server-tools | essentials-server-tools.server_controls_position | src/Support/Settings.php | No credential identified by name | Review before export |
| server_controls_label | LEGEND_THEME_SERVER_CONTROLS_LABEL | essentials-server-tools | essentials-server-tools.server_controls_label | src/Support/Settings.php | No credential identified by name | Review before export |
| console_stats | LEGEND_THEME_CONSOLE_STATS | essentials-appearance | essentials-appearance.console_stats | src/Support/Settings.php | No credential identified by name | Review before export |
| terminal_scheme | LEGEND_THEME_TERMINAL_SCHEME | essentials-appearance | essentials-appearance.terminal_scheme | src/Support/Settings.php | No credential identified by name | Review before export |
| terminal_cursor | LEGEND_THEME_TERMINAL_CURSOR | essentials-appearance | essentials-appearance.terminal_cursor | src/Support/Settings.php | No credential identified by name | Review before export |
| terminal_blink | LEGEND_THEME_TERMINAL_BLINK | essentials-appearance | essentials-appearance.terminal_blink | src/Support/Settings.php | No credential identified by name | Review before export |
| terminal_scrollback | LEGEND_THEME_TERMINAL_SCROLLBACK | essentials-server-tools | essentials-server-tools.terminal_scrollback | src/Support/Settings.php | No credential identified by name | Review before export |
| terminal_renderer | LEGEND_THEME_TERMINAL_RENDERER | essentials-server-tools | essentials-server-tools.terminal_renderer | src/Support/Settings.php | No credential identified by name | Review before export |
| bar_base | LEGEND_THEME_BAR_BASE | essentials-appearance | essentials-appearance.bar_base | src/Support/Settings.php | No credential identified by name | Review before export |
| bar_warning | LEGEND_THEME_BAR_WARNING | essentials-appearance | essentials-appearance.bar_warning | src/Support/Settings.php | No credential identified by name | Review before export |
| bar_danger | LEGEND_THEME_BAR_DANGER | essentials-appearance | essentials-appearance.bar_danger | src/Support/Settings.php | No credential identified by name | Review before export |
| channel | LEGEND_THEME_CHANNEL | split | Retain legacy pending boundary review | src/Support/Settings.php | No credential identified by name | Review before export |
| auto_update_enabled | LEGEND_THEME_AUTO_UPDATE_ENABLED | split | Retain legacy pending boundary review | src/Support/Settings.php | No credential identified by name | Review before export |
| auto_update | LEGEND_THEME_AUTO_UPDATE | split | Retain legacy pending boundary review | src/Support/Settings.php | No credential identified by name | Review before export |
| beta_url | LEGEND_THEME_BETA_URL | essentials-appearance | essentials-appearance.beta_url | src/Support/Settings.php | No credential identified by name | Review before export |
| dev_url | LEGEND_THEME_DEV_URL | essentials-appearance | essentials-appearance.dev_url | src/Support/Settings.php | No credential identified by name | Review before export |
| dev_token | LEGEND_THEME_DEV_TOKEN | split | Retain legacy pending boundary review | src/Support/Settings.php | Yes; handle locally | Excluded by Portable |
| arranger_users | LEGEND_THEME_ARRANGER_USERS | essentials-server-tools | essentials-server-tools.arranger_users | src/Support/Settings.php | No credential identified by name | Review before export |
| minecraft_live | LEGEND_THEME_MINECRAFT_LIVE | essentials-game-manager | essentials-game-manager.minecraft_live | src/Support/Settings.php | No credential identified by name | Review before export |
| languages_off | LEGEND_THEME_LANGUAGES_OFF | essentials-core | essentials-core.languages_off | src/Support/Settings.php | No credential identified by name | Review before export |
| languages_main | LEGEND_THEME_LANGUAGES_MAIN | essentials-core | essentials-core.languages_main | src/Support/Settings.php | No credential identified by name | Review before export |
| language_labels | LEGEND_THEME_LANGUAGE_LABELS | essentials-core | essentials-core.language_labels | src/Support/Settings.php | No credential identified by name | Review before export |
| nav_icon | LEGEND_THEME_NAV_ICON | essentials-appearance | essentials-appearance.nav_icon | src/Support/Settings.php | No credential identified by name | Review before export |
| languages_panel | LEGEND_THEME_LANGUAGES_PANEL | essentials-core | essentials-core.languages_panel | src/Support/Settings.php | No credential identified by name | Review before export |
| logo_height | LEGEND_THEME_LOGO_HEIGHT | essentials-appearance | essentials-appearance.logo_height | src/Support/Settings.php | No credential identified by name | Review before export |
| logo_url | LEGEND_THEME_LOGO_URL | essentials-appearance | essentials-appearance.logo_url | src/Support/Settings.php | No credential identified by name | Review before export |
| login_image | LEGEND_THEME_LOGIN_IMAGE | essentials-appearance | essentials-appearance.login_image | src/Support/Saved/Login.php; src/Support/Settings.php | No credential identified by name | Excluded by Portable |
| login_image_url | LEGEND_THEME_LOGIN_URL | essentials-appearance | essentials-appearance.login_image_url | src/Support/Saved/Login.php | No credential identified by name | Review before export |
| login_dim | LEGEND_THEME_LOGIN_DIM | essentials-appearance | essentials-appearance.login_dim | src/Support/Saved/Login.php | No credential identified by name | Review before export |
| login_width | LEGEND_THEME_LOGIN_WIDTH | essentials-appearance | essentials-appearance.login_width | src/Support/Saved/Login.php | No credential identified by name | Review before export |
| login_blur | LEGEND_THEME_LOGIN_BLUR | essentials-appearance | essentials-appearance.login_blur | src/Support/Saved/Login.php | No credential identified by name | Review before export |
| login_position | LEGEND_THEME_LOGIN_POSITION | essentials-appearance | essentials-appearance.login_position | src/Support/Saved/Login.php | No credential identified by name | Review before export |
| login_align | LEGEND_THEME_LOGIN_ALIGN | essentials-appearance | essentials-appearance.login_align | src/Support/Saved/Login.php | No credential identified by name | Review before export |
| login_opacity | LEGEND_THEME_LOGIN_OPACITY | essentials-appearance | essentials-appearance.login_opacity | src/Support/Saved/Login.php | No credential identified by name | Review before export |
| login_glow | LEGEND_THEME_LOGIN_GLOW | essentials-appearance | essentials-appearance.login_glow | src/Support/Saved/Login.php | No credential identified by name | Review before export |
| login_hide_heading | LEGEND_THEME_LOGIN_HIDE_HEADING | essentials-appearance | essentials-appearance.login_hide_heading | src/Support/Saved/Login.php | No credential identified by name | Review before export |
| login_hide_footer | LEGEND_THEME_LOGIN_HIDE_FOOTER | essentials-appearance | essentials-appearance.login_hide_footer | src/Support/Saved/Login.php | No credential identified by name | Review before export |
| login_above | LEGEND_THEME_LOGIN_ABOVE | essentials-appearance | essentials-appearance.login_above | src/Support/Saved/Login.php | No credential identified by name | Review before export |
| login_notice | LEGEND_THEME_LOGIN_NOTICE | essentials-appearance | essentials-appearance.login_notice | src/Support/Saved/Login.php | No credential identified by name | Review before export |
| register_open | LEGEND_THEME_REGISTER_OPEN | essentials-appearance | essentials-appearance.register_open | src/Support/Saved/Login.php | No credential identified by name | Review before export |
| register_note | LEGEND_THEME_REGISTER_NOTE | essentials-appearance | essentials-appearance.register_note | src/Support/Saved/Login.php | No credential identified by name | Review before export |
| areas | LEGEND_THEME_AREAS | essentials-appearance | essentials-appearance.areas | src/Support/Settings.php | No credential identified by name | Review before export |
| icon_stroke | LEGEND_THEME_ICON_STROKE | essentials-appearance | essentials-appearance.icon_stroke | src/Support/Settings.php | No credential identified by name | Review before export |
| icon_scale | LEGEND_THEME_ICON_SCALE | essentials-appearance | essentials-appearance.icon_scale | src/Support/Settings.php | No credential identified by name | Review before export |
| icon_accent | LEGEND_THEME_ICON_ACCENT | essentials-appearance | essentials-appearance.icon_accent | src/Support/Settings.php | No credential identified by name | Review before export |
| icon_pack | LEGEND_THEME_ICON_PACK | essentials-appearance | essentials-appearance.icon_pack | src/Support/Settings.php | No credential identified by name | Review before export |
| icon_overrides | LEGEND_THEME_ICONS | essentials-appearance | essentials-appearance.icon_overrides | src/Support/Settings.php | No credential identified by name | Review before export |
| igdb_client_id | LEGEND_THEME_IGDB_ID | essentials-game-manager | essentials-game-manager.igdb_client_id | src/Support/Saved/Artwork.php | Yes; handle locally | Excluded by Portable |
| igdb_client_secret | LEGEND_THEME_IGDB_SECRET | essentials-game-manager | essentials-game-manager.igdb_client_secret | src/Support/Saved/Artwork.php | Yes; handle locally | Excluded by Portable |
| alert_every | LEGEND_THEME_ALERT_EVERY | essentials-monitoring | essentials-monitoring.alert_every | src/Support/Saved/Alerts.php | No credential identified by name | Review before export |
| alert_discord | LEGEND_THEME_ALERT_DISCORD | essentials-monitoring | essentials-monitoring.alert_discord | src/Support/Saved/Alerts.php | No credential identified by name | Review before export |
| alert_webhook | LEGEND_THEME_ALERT_WEBHOOK | essentials-monitoring | essentials-monitoring.alert_webhook | src/Support/Saved/Alerts.php | Yes; handle locally | Excluded by Portable |
| alert_panel | LEGEND_THEME_ALERT_PANEL | essentials-monitoring | essentials-monitoring.alert_panel | src/Support/Saved/Alerts.php | No credential identified by name | Review before export |
| alert_email | LEGEND_THEME_ALERT_EMAIL | essentials-monitoring | essentials-monitoring.alert_email | src/Support/Saved/Alerts.php | Yes; handle locally | Excluded by Portable |
| alert_repeat | LEGEND_THEME_ALERT_REPEAT | essentials-monitoring | essentials-monitoring.alert_repeat | src/Support/Saved/Alerts.php | No credential identified by name | Review before export |
| alert_disk | LEGEND_THEME_ALERT_DISK | essentials-monitoring | essentials-monitoring.alert_disk | src/Support/Saved/Alerts.php | No credential identified by name | Review before export |
| alert_memory | LEGEND_THEME_ALERT_MEMORY | essentials-monitoring | essentials-monitoring.alert_memory | src/Support/Saved/Alerts.php | No credential identified by name | Review before export |
| alert_maintenance_hours | LEGEND_THEME_ALERT_MAINTENANCE | essentials-monitoring | essentials-monitoring.alert_maintenance_hours | src/Support/Saved/Alerts.php | No credential identified by name | Review before export |
| alert_versions | LEGEND_THEME_ALERT_VERSIONS | essentials-monitoring | essentials-monitoring.alert_versions | src/Support/Saved/Alerts.php | No credential identified by name | Review before export |
| alert_worker | LEGEND_THEME_ALERT_WORKER | essentials-monitoring | essentials-monitoring.alert_worker | src/Support/Saved/Alerts.php | No credential identified by name | Review before export |
| alert_facts | LEGEND_THEME_ALERT_FACTS | essentials-monitoring | essentials-monitoring.alert_facts | src/Support/Saved/Alerts.php | No credential identified by name | Review before export |
| alert_failed | LEGEND_THEME_ALERT_FAILED | essentials-monitoring | essentials-monitoring.alert_failed | src/Support/Saved/Alerts.php | No credential identified by name | Review before export |
| status_servers | LEGEND_THEME_STATUS_SERVERS | essentials-monitoring | essentials-monitoring.status_servers | src/Support/Saved/Status.php | No credential identified by name | Excluded by Portable |
| status_nodes | LEGEND_THEME_STATUS_NODES | essentials-monitoring | essentials-monitoring.status_nodes | src/Support/Saved/Status.php | No credential identified by name | Excluded by Portable |
| status_user_pages | LEGEND_THEME_STATUS_USER_PAGES | essentials-monitoring | essentials-monitoring.status_user_pages | src/Support/Saved/Status.php | No credential identified by name | Review before export |
| query_eggs | LEGEND_THEME_QUERY_EGGS | essentials-game-manager | essentials-game-manager.query_eggs | src/Support/Saved/Status.php | No credential identified by name | Review before export |
| status_every | LEGEND_THEME_STATUS_EVERY | essentials-monitoring | essentials-monitoring.status_every | src/Support/Saved/Status.php | No credential identified by name | Review before export |
| status_style | LEGEND_THEME_STATUS_STYLE | essentials-monitoring | essentials-monitoring.status_style | src/Support/Saved/Status.php | No credential identified by name | Review before export |
| status_title | LEGEND_THEME_STATUS_TITLE | essentials-monitoring | essentials-monitoring.status_title | src/Support/Saved/Status.php | No credential identified by name | Review before export |
| status_note | LEGEND_THEME_STATUS_NOTE | essentials-monitoring | essentials-monitoring.status_note | src/Support/Saved/Status.php | No credential identified by name | Review before export |
| status_link | LEGEND_THEME_STATUS_LINK | essentials-monitoring | essentials-monitoring.status_link | src/Support/Saved/Status.php | No credential identified by name | Review before export |
| alert_bot | LEGEND_THEME_ALERT_BOT | essentials-monitoring | essentials-monitoring.alert_bot | src/Support/Saved/Alerts.php | No credential identified by name | Review before export |
| alert_bot_url | LEGEND_THEME_ALERT_BOT_URL | essentials-monitoring | essentials-monitoring.alert_bot_url | src/Support/Saved/Alerts.php | No credential identified by name | Review before export |
| alert_bot_secret | LEGEND_THEME_ALERT_BOT_SECRET | essentials-monitoring | essentials-monitoring.alert_bot_secret | src/Support/Saved/Alerts.php | Yes; handle locally | Review before export |
| alert_backups | LEGEND_THEME_ALERT_BACKUPS | essentials-monitoring | essentials-monitoring.alert_backups | src/Support/Saved/Alerts.php | No credential identified by name | Review before export |
| alert_backup_days | LEGEND_THEME_ALERT_BACKUP_DAYS | essentials-monitoring | essentials-monitoring.alert_backup_days | src/Support/Saved/Alerts.php | No credential identified by name | Review before export |
| api_approval | LEGEND_THEME_API_APPROVAL | legacy-api | Retain legacy pending boundary review | src/Support/Saved/Api.php | No credential identified by name | Review before export |
| api_hide_pelican | LEGEND_THEME_API_HIDE_PELICAN | legacy-api | Retain legacy pending boundary review | src/Support/Saved/Api.php | No credential identified by name | Review before export |
| api_rate | LEGEND_THEME_API_RATE | legacy-api | Retain legacy pending boundary review | src/Support/Saved/Api.php | No credential identified by name | Review before export |
| api_days | LEGEND_THEME_API_DAYS | legacy-api | Retain legacy pending boundary review | src/Support/Saved/Api.php | No credential identified by name | Review before export |
| features_off | LEGEND_THEME_FEATURES_OFF | split | Retain legacy pending boundary review | src/Support/Saved/SystemStatus.php; src/Support/Settings.php | No credential identified by name | Review before export |
| modules_fresh | LEGEND_THEME_MODULES_FRESH | split | Retain legacy pending boundary review | src/Support/Settings.php | No credential identified by name | Review before export |
| modules_asked | LEGEND_THEME_MODULES_ASKED | split | Retain legacy pending boundary review | src/Support/Settings.php | No credential identified by name | Review before export |
| minecraft_eggs | LEGEND_THEME_MINECRAFT_EGGS | essentials-game-manager | essentials-game-manager.minecraft_eggs | src/Support/Settings.php | No credential identified by name | Review before export |
| alert_schedules | LEGEND_THEME_ALERT_SCHEDULES | essentials-monitoring | essentials-monitoring.alert_schedules | src/Support/Saved/Alerts.php | No credential identified by name | Review before export |
| alert_unbuilt | LEGEND_THEME_ALERT_UNBUILT | essentials-monitoring | essentials-monitoring.alert_unbuilt | src/Support/Saved/Alerts.php | No credential identified by name | Review before export |
| alert_stock | LEGEND_THEME_ALERT_STOCK | essentials-monitoring | essentials-monitoring.alert_stock | src/Support/Saved/Alerts.php | No credential identified by name | Review before export |
| alert_ports | LEGEND_THEME_ALERT_PORTS | essentials-monitoring | essentials-monitoring.alert_ports | src/Support/Saved/Alerts.php | No credential identified by name | Review before export |
| alert_modules | LEGEND_THEME_ALERT_MODULES | essentials-monitoring | essentials-monitoring.alert_modules | src/Support/Saved/Alerts.php | No credential identified by name | Review before export |
| alert_stock_left | LEGEND_THEME_ALERT_STOCK_LEFT | essentials-monitoring | essentials-monitoring.alert_stock_left | src/Support/Saved/Alerts.php | No credential identified by name | Review before export |
| languages_partial | LEGEND_THEME_LANGUAGES_PARTIAL | essentials-core | essentials-core.languages_partial | src/Support/Settings.php | No credential identified by name | Review before export |
| ark_eggs | LEGEND_THEME_ARK_EGGS | essentials-game-manager | essentials-game-manager.ark_eggs | src/Support/Settings.php | No credential identified by name | Review before export |
| terraria_eggs | LEGEND_THEME_TERRARIA_EGGS | essentials-game-manager | essentials-game-manager.terraria_eggs | src/Support/Settings.php | No credential identified by name | Review before export |
| vrising_eggs | LEGEND_THEME_VRISING_EGGS | essentials-game-manager | essentials-game-manager.vrising_eggs | src/Support/Settings.php | No credential identified by name | Review before export |
| enshrouded_eggs | LEGEND_THEME_ENSHROUDED_EGGS | essentials-game-manager | essentials-game-manager.enshrouded_eggs | src/Support/Settings.php | No credential identified by name | Review before export |
| factorio_eggs | LEGEND_THEME_FACTORIO_EGGS | essentials-game-manager | essentials-game-manager.factorio_eggs | src/Support/Settings.php | No credential identified by name | Review before export |
| dontstarve_eggs | LEGEND_THEME_DONTSTARVE_EGGS | essentials-game-manager | essentials-game-manager.dontstarve_eggs | src/Support/Settings.php | No credential identified by name | Review before export |
| satisfactory_eggs | LEGEND_THEME_SATISFACTORY_EGGS | essentials-game-manager | essentials-game-manager.satisfactory_eggs | src/Support/Settings.php | No credential identified by name | Review before export |
| onset_eggs | LEGEND_THEME_ONSET_EGGS | essentials-game-manager | essentials-game-manager.onset_eggs | src/Support/Settings.php | No credential identified by name | Review before export |
| craftopia_eggs | LEGEND_THEME_CRAFTOPIA_EGGS | essentials-game-manager | essentials-game-manager.craftopia_eggs | src/Support/Settings.php | No credential identified by name | Review before export |
| valheim_eggs | LEGEND_THEME_VALHEIM_EGGS | essentials-game-manager | essentials-game-manager.valheim_eggs | src/Support/Settings.php | No credential identified by name | Review before export |
| system_status_refresh | LEGEND_THEME_SYSTEM_REFRESH | essentials-monitoring | essentials-monitoring.system_status_refresh | src/Support/Saved/SystemStatus.php | No credential identified by name | Review before export |
| system_status_hidden | LEGEND_THEME_SYSTEM_HIDDEN | essentials-monitoring | essentials-monitoring.system_status_hidden | src/Support/Saved/SystemStatus.php | No credential identified by name | Review before export |
| system_status_nodes | LEGEND_THEME_SYSTEM_NODES | essentials-monitoring | essentials-monitoring.system_status_nodes | src/Support/Saved/SystemStatus.php | No credential identified by name | Review before export |
| footer_text | LEGEND_THEME_FOOTER_TEXT | essentials-appearance | essentials-appearance.footer_text | src/Support/Settings.php | No credential identified by name | Review before export |
| footer_version | LEGEND_THEME_FOOTER_VERSION | essentials-appearance | essentials-appearance.footer_version | src/Support/Settings.php | No credential identified by name | Review before export |
| footer_link_label | LEGEND_THEME_FOOTER_LABEL | essentials-appearance | essentials-appearance.footer_link_label | src/Support/Settings.php | No credential identified by name | Review before export |
| footer_link_url | LEGEND_THEME_FOOTER_URL | essentials-appearance | essentials-appearance.footer_link_url | src/Support/Settings.php | No credential identified by name | Review before export |
| theme_mode | LEGEND_THEME_MODE | essentials-appearance | essentials-appearance.theme_mode | src/Support/Settings.php | No credential identified by name | Review before export |
| shop_currency | LEGEND_THEME_SHOP_CURRENCY | essentials-shop | essentials-shop.shop_currency | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_tax | LEGEND_THEME_SHOP_TAX | essentials-shop | essentials-shop.shop_tax | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_invoice_prefix | LEGEND_THEME_SHOP_PREFIX | essentials-shop | essentials-shop.shop_invoice_prefix | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_notice_days | LEGEND_THEME_SHOP_NOTICE | essentials-shop | essentials-shop.shop_notice_days | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_grace_days | LEGEND_THEME_SHOP_GRACE | essentials-shop | essentials-shop.shop_grace_days | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_heading | LEGEND_THEME_SHOP_HEADING | essentials-shop | essentials-shop.shop_heading | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_note | LEGEND_THEME_SHOP_NOTE | essentials-shop | essentials-shop.shop_note | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_terms_url | LEGEND_THEME_SHOP_TERMS | essentials-shop | essentials-shop.shop_terms_url | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_company_name | LEGEND_THEME_SHOP_COMPANY | essentials-shop | essentials-shop.shop_company_name | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_company_address | LEGEND_THEME_SHOP_ADDRESS | essentials-shop | essentials-shop.shop_company_address | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_company_vat | LEGEND_THEME_SHOP_VAT | essentials-shop | essentials-shop.shop_company_vat | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_company_coc | LEGEND_THEME_SHOP_COC | essentials-shop | essentials-shop.shop_company_coc | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_company_email | LEGEND_THEME_SHOP_EMAIL | essentials-shop | essentials-shop.shop_company_email | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_company_country | LEGEND_THEME_SHOP_COUNTRY | essentials-shop | essentials-shop.shop_company_country | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_due_days | LEGEND_THEME_SHOP_DUE_DAYS | essentials-shop | essentials-shop.shop_due_days | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_tax_inclusive | LEGEND_THEME_SHOP_TAX_INCLUSIVE | essentials-shop | essentials-shop.shop_tax_inclusive | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_vat_check | LEGEND_THEME_SHOP_VAT_CHECK | essentials-shop | essentials-shop.shop_vat_check | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_pay_note | LEGEND_THEME_SHOP_PAY_NOTE | essentials-shop | essentials-shop.shop_pay_note | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| tickets_via | LEGEND_THEME_TICKETS_VIA | essentials-support | essentials-support.tickets_via | src/Support/Saved/Tickets.php | No credential identified by name | Review before export |
| tickets_modora_key | LEGEND_THEME_TICKETS_MODORA_KEY | essentials-support | essentials-support.tickets_modora_key | src/Support/Saved/Tickets.php | Yes; handle locally | Excluded by Portable |
| tickets_modora_panel | LEGEND_THEME_TICKETS_MODORA_PANEL | essentials-support | essentials-support.tickets_modora_panel | src/Support/Saved/Tickets.php | No credential identified by name | Review before export |
| tickets_hook_secret | LEGEND_THEME_TICKETS_HOOK_SECRET | essentials-support | essentials-support.tickets_hook_secret | src/Support/Saved/Tickets.php | Yes; handle locally | Excluded by Portable |
| tickets_open | LEGEND_THEME_TICKETS_OPEN | essentials-support | essentials-support.tickets_open | src/Support/Saved/Tickets.php | No credential identified by name | Review before export |
| tickets_button | LEGEND_THEME_TICKETS_BUTTON | essentials-support | essentials-support.tickets_button | src/Support/Saved/Tickets.php | No credential identified by name | Review before export |
| files_where | LEGEND_THEME_FILES_WHERE | split | Retain legacy pending boundary review | src/Support/Saved/Files.php | No credential identified by name | Review before export |
| files_read_from | LEGEND_THEME_FILES_READ_FROM | split | Retain legacy pending boundary review | src/Support/Saved/Files.php | No credential identified by name | Review before export |
| files_s3_key | LEGEND_THEME_FILES_S3_KEY | split | Retain legacy pending boundary review | src/Support/Saved/Files.php | Yes; handle locally | Excluded by Portable |
| files_s3_secret | LEGEND_THEME_FILES_S3_SECRET | split | Retain legacy pending boundary review | src/Support/Saved/Files.php | Yes; handle locally | Excluded by Portable |
| files_s3_region | LEGEND_THEME_FILES_S3_REGION | split | Retain legacy pending boundary review | src/Support/Saved/Files.php | No credential identified by name | Review before export |
| files_s3_bucket | LEGEND_THEME_FILES_S3_BUCKET | split | Retain legacy pending boundary review | src/Support/Saved/Files.php | No credential identified by name | Review before export |
| files_s3_endpoint | LEGEND_THEME_FILES_S3_ENDPOINT | split | Retain legacy pending boundary review | src/Support/Saved/Files.php | No credential identified by name | Review before export |
| files_s3_path_style | LEGEND_THEME_FILES_S3_PATH_STYLE | split | Retain legacy pending boundary review | src/Support/Saved/Files.php | No credential identified by name | Review before export |
| files_cdn_base | LEGEND_THEME_FILES_CDN_BASE | split | Retain legacy pending boundary review | src/Support/Saved/Files.php | No credential identified by name | Review before export |
| files_cdn_token | LEGEND_THEME_FILES_CDN_TOKEN | split | Retain legacy pending boundary review | src/Support/Saved/Files.php | Yes; handle locally | Excluded by Portable |
| files_cdn_folder | LEGEND_THEME_FILES_CDN_FOLDER | split | Retain legacy pending boundary review | src/Support/Saved/Files.php | No credential identified by name | Review before export |
| files_mirror_minutes | LEGEND_THEME_FILES_MIRROR_MINUTES | split | Retain legacy pending boundary review | src/Support/Saved/Files.php | No credential identified by name | Review before export |
| shop_landing | LEGEND_THEME_SHOP_LANDING | essentials-shop | essentials-shop.shop_landing | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_self_cancel | LEGEND_THEME_SHOP_SELF_CANCEL | essentials-shop | essentials-shop.shop_self_cancel | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_wait | LEGEND_THEME_SHOP_WAIT | essentials-shop | essentials-shop.shop_wait | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_basket | LEGEND_THEME_SHOP_BASKET | essentials-shop | essentials-shop.shop_basket | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_mollie_on | LEGEND_THEME_SHOP_MOLLIE_ON | essentials-shop | essentials-shop.shop_mollie_on | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_mollie_key | LEGEND_THEME_SHOP_MOLLIE_KEY | essentials-shop | essentials-shop.shop_mollie_key | src/Support/Saved/Shop.php | Yes; handle locally | Excluded by Portable |
| shop_stripe_on | LEGEND_THEME_SHOP_STRIPE_ON | essentials-shop | essentials-shop.shop_stripe_on | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_stripe_key | LEGEND_THEME_SHOP_STRIPE_KEY | essentials-shop | essentials-shop.shop_stripe_key | src/Support/Saved/Shop.php | Yes; handle locally | Excluded by Portable |
| shop_stripe_hook | LEGEND_THEME_SHOP_STRIPE_HOOK | essentials-shop | essentials-shop.shop_stripe_hook | src/Support/Saved/Shop.php | Yes; handle locally | Excluded by Portable |
| shop_paypal_on | LEGEND_THEME_SHOP_PAYPAL_ON | essentials-shop | essentials-shop.shop_paypal_on | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_paypal_sandbox | LEGEND_THEME_SHOP_PAYPAL_SANDBOX | essentials-shop | essentials-shop.shop_paypal_sandbox | src/Support/Saved/Shop.php | No credential identified by name | Review before export |
| shop_paypal_id | LEGEND_THEME_SHOP_PAYPAL_ID | essentials-shop | essentials-shop.shop_paypal_id | src/Support/Saved/Shop.php | Yes; handle locally | Excluded by Portable |
| shop_paypal_secret | LEGEND_THEME_SHOP_PAYPAL_SECRET | essentials-shop | essentials-shop.shop_paypal_secret | src/Support/Saved/Shop.php | Yes; handle locally | Excluded by Portable |
| shop_paypal_hook | LEGEND_THEME_SHOP_PAYPAL_HOOK | essentials-shop | essentials-shop.shop_paypal_hook | src/Support/Saved/Shop.php | Yes; handle locally | Excluded by Portable |

## Values stored outside the config file

`Settings::data()` also composes storage-backed values such as custom CSS, preset rows, theme windows, area overrides and icon overrides. `Portable` additionally exports announcement and navigation rows. Their owning files and concrete locations are in [storage-migration-map.md](storage-migration-map.md). Upload fields are actions rather than persistent config and must not be replayed on import. Preserve the existing data/read and write/sanitizer pair in `Settings` and `Saved/*` for each migrated value.

Permission identifiers are a separate migration boundary: retain `legendTheme` permissions and each feature's existing permission model until an explicit role migration is tested. New namespaces do not require renamed role permissions.
