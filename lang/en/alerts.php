<?php

/*
 * The watchdog.
 *
 * Every message here is read on a phone, at three in the morning, by somebody
 * who was asleep a minute ago. So each one says which machine, what is wrong,
 * and nothing else - the detail belongs on the page they will open next, not in
 * the line that woke them.
 *
 * A recovery is written as news rather than as an afterthought. "Is it back yet"
 * is the question somebody would otherwise get up to answer.
 */

return [
    'title' => 'Alerts',
    'nav_label' => 'Alerts',
    'subheading' => 'The panel already knows when a node stops answering, a disk fills up or the queue stops. This is what tells you.',

    // ---- the channels, and what they last did ----------------------------
    'channels' => 'Where messages go',
    'channels_helper' => 'What each channel did the last time it was asked to send something. A channel that is switched on and quietly refusing looks exactly like a panel with nothing wrong, which is why this is the first thing on the page.',

    'state_off' => 'Off',
    'state_untried' => 'Nothing sent yet',
    'state_ok' => 'Delivered',
    'state_failed' => 'Refused',

    // ---- when ------------------------------------------------------------
    'when' => 'How often',
    'when_helper' => 'The checks run in the background, so they need a queue worker. Without one nothing is sent and nothing says so - use Send a test, which does not go through the queue.',

    'every' => 'Check every',
    'every_helper' => 'Every check reaches each node\'s daemon, so this is a request per node per run. Fifteen minutes is enough to hear about an outage while it is still an outage.',
    'every_off' => 'Off - no checks at all',
    'every_five' => '5 minutes',
    'every_fifteen' => '15 minutes',
    'every_thirty' => '30 minutes',
    'every_hourly' => 'Hour',
    'every_daily' => 'Day',

    'repeat' => 'Remind me while it lasts',
    'repeat_helper' => 'A message is sent when something changes, and again when it recovers. This adds a reminder while a problem is still going. Zero means no reminders - a channel that repeats itself every fifteen minutes is a channel people mute.',
    'hours' => 'hours',

    // ---- where -----------------------------------------------------------
    'where' => 'Channels',
    'where_helper' => 'More than one is sensible. They fail differently.',

    'discord' => 'Discord',
    'discord_helper' => 'Where a message is actually read by somebody who is not looking at the panel.',
    'webhook' => 'Webhook address',
    'webhook_helper' => 'In Discord: Server Settings → Integrations → Webhooks → New Webhook → Copy Webhook URL. Held to https, because this posts which of your machines is down and how full its disk is.',

    'bot' => 'A bot of your own',
    'bot_helper' => 'One signed JSON post to an address you run, so something outside the panel hears about a dead node instead of asking every minute whether there is one. The webhooks Pelican ships cannot carry this: they fire on models and on the activity log, and a node that stopped answering writes neither.',
    'bot_url' => 'Where to post it',
    'bot_url_helper' => 'Held to https, because this posts which of your machines is down to an address on the internet.',
    'bot_secret' => 'Signing secret',
    'bot_secret_helper' => 'Shared with whatever receives this. The body is hashed with it and the hash travels in X-Essentials-Signature as sha256=<hex>, so your bot can refuse anything that did not come from this panel. Nothing is sent while this is empty - a signature that is optional is one nobody checks.',
    'facts' => 'Also tell the bot when something happens',
    'facts_helper' => 'Everything above is a fault. These are not: they are things that simply happened. Each one is off until you tick it, so upgrading changes nothing, and they go to the bot address only - never to Discord, the bell or email.',

    'panel' => 'In the panel',
    'panel_helper' => 'A notification for everyone holding this permission. Always works, needs nothing set up, and is invisible to anybody who is not signed in.',

    'email' => 'Email',
    'email_helper' => 'Comma separated. Uses the panel\'s own mailer - reliable when that is configured and completely silent when it is not, which is the one failure a watchdog must not have. Leave empty to switch it off.',

    // ---- what ------------------------------------------------------------
    'what' => 'What to watch',
    'what_helper' => 'Every reading here is one the panel already takes. Nothing on this page opens a connection the System status page does not.',

    'percent_helper' => 'Zero switches this check off.',
    'disk' => 'Warn when a node\'s disk is over',
    'memory' => 'Warn when a node\'s memory is over',

    'maintenance' => 'Warn about maintenance left on for',
    'maintenance_helper' => 'A node in maintenance is skipped by every other check, which is right - and is also how one gets forgotten for a fortnight. Zero switches this off.',

    'versions' => 'Panel and Wings versions',
    'versions_helper' => 'One message when something falls behind, and one when it is current again. No reminders - a version is not an outage.',

    'backups' => 'Backups falling behind',
    'backups_helper' => 'One message naming the servers rather than one per server - when a schedule stops, every server goes stale at once, and forty separate messages about one cause is a channel people mute. Off by default: a panel that backs up by hand rather than on a schedule would be told off for it daily.',
    'backup_days' => 'Call a backup stale after',
    'backup_days_helper' => 'Also what the Backups page uses. A server backed up weekly should not be reported at eight days.',
    'days' => 'days',

    'stock' => 'Packages running out',

    'unbuilt_switch_helper' => 'An order whose invoice is settled and whose server a node refused. The only check here where somebody is out of pocket while nothing says so: everything else on this list is a machine that stopped. Off until switched on, like the rest.',

    'unbuilt_switch' => 'Paid and not built',
    'stock_helper' => 'One message naming the packages rather than one per package, and never a reminder: something being sold out is an ordinary state of a shop rather than an outage, and hearing about it every four hours is how this stops being read. Only packages with a cap are looked at, so a shop that sells everything without a limit costs nothing to watch. Off by default, like the rest.',
    'stock_left' => 'Warn when this many are left',
    'stock_left_helper' => 'Counted against the cap on the package. A package has to drop to this number to be warned about and reach two above it to be called well again, so one that a purchase and a cancellation push back and forth says nothing. Nought is a number here rather than an absence: it keeps the warning quiet and leaves only the message that says a package has gone.',
    'stock_left_suffix' => 'left',

    'worker' => 'Queue worker',
    'worker_helper' => 'Whether anything is running this plugin\'s background work. Note the circularity: the check itself runs on the queue, so a panel that has never had a worker cannot report it. The line at the top of this page can.',

    // ---- the buttons -----------------------------------------------------
    'save' => 'Save',
    'saved' => 'Saved',
    'save_failed' => 'Nothing was saved',

    'test' => 'Send a test',
    'test_one' => 'Test',
    'test_off' => 'That channel is off',
    'test_off_body' => 'Switch it on and save, and it will be tested along with the rest.',
    'test_title' => 'Test message',
    'test_body' => 'If you are reading this, alerts from your Pelican panel will arrive here. Nothing is wrong.',
    'test_sent' => 'Sent to every channel that is on',
    'test_failed' => 'At least one channel refused it',
    'test_none' => 'Nothing to send to',
    'test_none_body' => 'No channel is switched on, so a real alert would go nowhere either.',

    /*
     * What to do about a refusal.
     *
     * A provider's own reason is terse and correct, and useless on its own. The
     * two that come up almost every time are named, because neither is guessable
     * from the code: a 553 is about the sender and not the recipient, and a 401
     * from Discord is a URL that has been revoked or mistyped.
     */
    'hint_email_sender' => 'Your SMTP server refused the address the panel sends from, not the address it was sending to. In Admin → Settings → Mail, the From address has to be a mailbox your SMTP account is allowed to send as. Nothing to do with this plugin - Pelican\'s own test mail on that page will fail the same way.',
    'hint_email' => 'Check Admin → Settings → Mail. The test mail button on that page uses the same settings and will say the same thing.',
    'hint_discord_url' => 'Discord did not recognise that webhook. It has been deleted, regenerated, or pasted with something missing - make a new one under Server Settings → Integrations → Webhooks and copy the whole URL.',
    'hint_discord' => 'The panel could not reach Discord. If this panel is behind a firewall that blocks outgoing requests, this channel cannot work from here.',
    'hint_panel' => 'Nobody holds the permission for this, or the notification could not be stored. Check Roles.',

    'run_now' => 'Run the checks now',
    'run_started' => 'Checking in the background',
    'run_failed' => 'The checks could not be started',

    'reset' => 'Forget what it knows',
    'reset_confirm' => 'Clears what every check last said. The next run learns from scratch and sends nothing, so a problem that is still going will be reported again on the run after that. Use this after decommissioning a node the watchdog keeps insisting about.',
    'reset_done' => 'Cleared',

    // ---- the messages themselves ------------------------------------------
    'still' => 'Still going after :for.',
    'cleared_body' => 'It had been that way for :for.',
    'modules_switch' => 'A module that is on and not working',
    'modules_switch_helper' => 'One message per module rather than one for all of them, because what is wrong with each is different and the sentence has to say which. Two things it reports: a module whose tables are missing, which is an install that could not finish, and a module with parts switched on that are waiting for something to be filled in. The modules page shows both on the card; this is for the panels where nobody goes and looks. Off by default, like the rest.',
    'module_tables_title' => ':module is on and its tables are missing',
    'module_tables' => 'The pages belonging to :module are hiding themselves because the tables they read are not there, which is usually an install that could not finish. Open the Modules page and switch it off and on again, and the tables are made.',
    'module_waiting_title' => ':module is on and part of it is waiting',
    'module_waiting' => '{1} One part of :module is switched on and showing nothing until something is filled in - the eggs it applies to, the styles on offer, the servers a public page should show. The Modules page names which, on the card.|[2,*] :count parts of :module are switched on and showing nothing until something is filled in - the eggs they apply to, the styles on offer, the servers a public page should show. The Modules page names which, on the card.',
    'module_cleared' => ':module is working again',
    'ports_switch' => 'Ports running out',
    'ports_switch_helper' => 'One message per package rather than one for all of them, because the range and the count are the useful part and a list of names is not. Only packages with a range set are looked at, so a shop that lets purchases take any free port costs nothing to watch. Off by default, like the rest.',
    'ports_title' => 'Nearly out of ports for :game',
    'ports_body' => ':game buys land on :from to :to, and only :free of :total are still free. A purchase that finds none is paid for and then refused, so add allocations on the node, or widen the range on the package, before that happens.',
    'ports_none_title' => 'No ports left for :game',
    'ports_none' => ':game buys land on :from to :to and every one of the :total is taken. The next purchase of this game will be paid for and then refused with no allocation. Add allocations on the node, or widen the range on the package itself.',
    'ports_empty_title' => 'No ports exist for :game',
    'ports_empty' => ':game buys land on :from to :to, and there is not one allocation in that range on any node it may use. Every purchase of this game will be paid for and then refused. Make the allocations on the node, or widen the range on the package itself.',
    'ports_cleared' => 'Ports free again for :game',

    'for_unknown' => 'a while',
    'for_minutes' => '{1} a minute|[2,*] :count minutes',
    'for_hours' => '{1} an hour|[2,*] :count hours',
    'for_days' => '{1} a day|[2,*] :count days',

    'node_down' => ':node is not answering',
    'node_down_body' => 'The panel cannot reach the daemon on :node. Servers on it will not start, stop or report anything until it is back.',
    'node_up' => ':node is answering again',

    'node_disk' => ':node is running out of disk',
    'node_disk_body' => 'Disk on :node is :percent% full, over the :limit% you set. Backups and server installs are the first things to fail when this reaches the top.',
    'node_disk_over' => 'Disk on :node is back under the limit',

    'node_memory' => ':node is running out of memory',
    'node_memory_body' => 'Memory on :node is :percent% used, over the :limit% you set. Servers on it may be killed by the kernel before anything reports a problem.',
    'node_memory_over' => 'Memory on :node is back under the limit',

    'node_maintenance' => ':node has been in maintenance a long time',
    'node_maintenance_body' => ':node has been in maintenance for more than :hours hours. Nothing else about it is being checked while it is, which is the point - but it is worth knowing it is still there.',
    'node_maintenance_over' => ':node is out of maintenance',

    'wings_behind' => 'Wings on :node is out of date',
    'wings_behind_body' => ':node is running Wings :installed and :latest is out. Update it on the node itself - the panel has no way to.',
    'wings_current' => 'Wings on :node is up to date',

    'panel_behind' => 'The panel is out of date',
    'panel_behind_body' => 'This panel is running :installed and :latest is out.',
    'panel_current' => 'The panel is up to date',

    'and_more' => 'and :count more',


    'owner_down' => '{1} One of your servers is offline|[2,*] :count of your servers are offline',
    'owner_down_body' => 'The machine they are on has stopped answering. Somebody has been told. Affected: :servers',
    'owner_up' => '{1} Your server is back|[2,*] :count of your servers are back',
    'owner_up_body' => 'The machine is answering again. Back: :servers',

    'schedules' => 'Scheduled tasks that have stopped',
    'schedules_helper' => 'A schedule stuck part way through a run, one whose time passed because the cron is not running, or one that has never run at all. Pelican has no word for any of those - a crashed run stays "processing" for ever and is drawn exactly like one running now. Reads every active schedule on the panel each time it checks.',

    'schedule_stopped' => '{1} A scheduled task has stopped|[2,*] :count scheduled tasks have stopped',
    'schedule_stopped_body' => 'Stuck for over :hours hours, overdue, never run, or holding no tasks at all: :schedules',
    'schedule_running' => 'Every schedule is running again',

    'unbuilt_over' => 'Every paid order has its server',

    'unbuilt_body' => 'Somebody paid and has nothing to show for it. Open Orders and build them, or read why they were refused: :orders',

    'unbuilt' => '{1} A paid order has no server|[2,*] :count paid orders have no server',

    'stock_out' => '{1} A package has sold out|[2,*] :count packages have sold out',
    'stock_out_body' => 'Still on sale, and there is nothing left to sell: :packages',
    'stock_low' => '{1} A package is nearly sold out|[2,*] :count packages are nearly sold out',
    'stock_low_body' => 'At or under :limit left: :packages',
    'stock_back' => '{1} A package is back on sale|[2,*] :count packages are back on sale',
    'stock_back_body' => 'There is something to sell again: :packages',

    'backup_none' => '{1} A server has never been backed up|[2,*] :count servers have never been backed up',
    'backup_none_body' => 'Nothing has ever been backed up on: :servers',
    'backup_none_over' => 'Every server has a backup now',

    'backup_stale' => '{1} A server has not been backed up lately|[2,*] :count servers have not been backed up lately',
    'backup_stale_body' => 'No successful backup in :days days on: :servers',
    'backup_stale_over' => 'Every server has been backed up recently',

    'backup_failed' => '{1} Backups are failing on a server|[2,*] Backups are failing on :count servers',
    'backup_failed_body' => 'A backup finished unsuccessfully on: :servers',
    'backup_failed_over' => 'No backups are failing any more',

    'worker_missing' => 'Nothing is running the queue',
    'worker_missing_body' => 'A job was queued and nothing picked it up. Plugin updates, modpack installs and these checks all stop until a worker is running - try systemctl status pelican-queue on the panel\'s machine.',
    'worker_back' => 'The queue is being worked again',
    'failed_title' => '{1} A job has failed since the last check|[2,*] :count jobs have failed since the last check',
    'failed_body' => 'Something the panel was told to do did not happen and will not be tried again - a server not built, an invoice not written, a mail not sent. They are in the failed_jobs table; `php artisan queue:retry all` puts them back, once whatever stopped them is fixed.',
    'failed_back' => 'Nothing has failed since the last check',
    'failed' => 'Tell me when a queued job fails',
    'failed_helper' => 'Laravel records a job it has given up on and says nothing about it. This says something. Counted rather than listed: twenty failures in one night are usually one cause.',

    'health_interval_off' => 'Alerts are switched on, but the interval is Off, so the watchdog never runs.',
    'health_owners_unwatched' => 'Owner alerts are on, but the watchdog is not running, so owners are never told about an outage.',
    'health_no_channel' => 'The watchdog runs, but every way of telling somebody is switched off.',
    'health_discord' => 'Discord alerts are on, but no valid https webhook is saved.',
    'health_bot' => 'Bot alerts are on, but the https address or the signing secret is missing.',
    'health_email' => 'Alert emails are on, but there is no valid address, or the panel\'s mailer only writes to its log.',
];
