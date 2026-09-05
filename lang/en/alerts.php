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
    'when_helper' => 'The checks run in the background, so they need a queue worker. Without one nothing is sent and nothing says so — use Send a test, which does not go through the queue.',

    'every' => 'Check every',
    'every_helper' => 'Every check reaches each node\'s daemon, so this is a request per node per run. Fifteen minutes is enough to hear about an outage while it is still an outage.',
    'every_off' => 'Off — no checks at all',
    'every_five' => '5 minutes',
    'every_fifteen' => '15 minutes',
    'every_thirty' => '30 minutes',
    'every_hourly' => 'Hour',
    'every_daily' => 'Day',

    'repeat' => 'Remind me while it lasts',
    'repeat_helper' => 'A message is sent when something changes, and again when it recovers. This adds a reminder while a problem is still going. Zero means no reminders — a channel that repeats itself every fifteen minutes is a channel people mute.',
    'hours' => 'hours',

    // ---- where -----------------------------------------------------------
    'where' => 'Channels',
    'where_helper' => 'More than one is sensible. They fail differently.',

    'discord' => 'Discord',
    'discord_helper' => 'Where a message is actually read by somebody who is not looking at the panel.',
    'webhook' => 'Webhook address',
    'webhook_helper' => 'In Discord: Server Settings → Integrations → Webhooks → New Webhook → Copy Webhook URL. Held to https, because this posts which of your machines is down and how full its disk is.',

    'panel' => 'In the panel',
    'panel_helper' => 'A notification for everyone holding this permission. Always works, needs nothing set up, and is invisible to anybody who is not signed in.',

    'email' => 'Email',
    'email_helper' => 'Comma separated. Uses the panel\'s own mailer — reliable when that is configured and completely silent when it is not, which is the one failure a watchdog must not have. Leave empty to switch it off.',

    // ---- what ------------------------------------------------------------
    'what' => 'What to watch',
    'what_helper' => 'Every reading here is one the panel already takes. Nothing on this page opens a connection the System status page does not.',

    'percent_helper' => 'Zero switches this check off.',
    'disk' => 'Warn when a node\'s disk is over',
    'memory' => 'Warn when a node\'s memory is over',

    'maintenance' => 'Warn about maintenance left on for',
    'maintenance_helper' => 'A node in maintenance is skipped by every other check, which is right — and is also how one gets forgotten for a fortnight. Zero switches this off.',

    'versions' => 'Panel and Wings versions',
    'versions_helper' => 'One message when something falls behind, and one when it is current again. No reminders — a version is not an outage.',

    'backups' => 'Backups falling behind',
    'backups_helper' => 'One message naming the servers rather than one per server — when a schedule stops, every server goes stale at once, and forty separate messages about one cause is a channel people mute. Off by default: a panel that backs up by hand rather than on a schedule would be told off for it daily.',
    'backup_days' => 'Call a backup stale after',
    'backup_days_helper' => 'Also what the Backups page uses. A server backed up weekly should not be reported at eight days.',
    'days' => 'days',

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
    'hint_email_sender' => 'Your SMTP server refused the address the panel sends from, not the address it was sending to. In Admin → Settings → Mail, the From address has to be a mailbox your SMTP account is allowed to send as. Nothing to do with this plugin — Pelican\'s own test mail on that page will fail the same way.',
    'hint_email' => 'Check Admin → Settings → Mail. The test mail button on that page uses the same settings and will say the same thing.',
    'hint_discord_url' => 'Discord did not recognise that webhook. It has been deleted, regenerated, or pasted with something missing — make a new one under Server Settings → Integrations → Webhooks and copy the whole URL.',
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

    'for_unknown' => 'a while',
    'for_minutes' => ':count minutes',
    'for_hours' => ':count hours',
    'for_days' => ':count days',

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
    'node_maintenance_body' => ':node has been in maintenance for more than :hours hours. Nothing else about it is being checked while it is, which is the point — but it is worth knowing it is still there.',
    'node_maintenance_over' => ':node is out of maintenance',

    'wings_behind' => 'Wings on :node is out of date',
    'wings_behind_body' => ':node is running Wings :installed and :latest is out. Update it on the node itself — the panel has no way to.',
    'wings_current' => 'Wings on :node is up to date',

    'panel_behind' => 'The panel is out of date',
    'panel_behind_body' => 'This panel is running :installed and :latest is out.',
    'panel_current' => 'The panel is up to date',

    'and_more' => 'and :count more',

    'backup_none' => ':count servers have never been backed up',
    'backup_none_body' => 'Nothing has ever been backed up on: :servers',
    'backup_none_over' => 'Every server has a backup now',

    'backup_stale' => ':count servers have not been backed up lately',
    'backup_stale_body' => 'No successful backup in :days days on: :servers',
    'backup_stale_over' => 'Every server has been backed up recently',

    'backup_failed' => 'Backups are failing on :count servers',
    'backup_failed_body' => 'A backup finished unsuccessfully on: :servers',
    'backup_failed_over' => 'No backups are failing any more',

    'worker_missing' => 'Nothing is running the queue',
    'worker_missing_body' => 'A job was queued and nothing picked it up. Plugin updates, modpack installs and these checks all stop until a worker is running — try systemctl status pelican-queue on the panel\'s machine.',
    'worker_back' => 'The queue is being worked again',
];
