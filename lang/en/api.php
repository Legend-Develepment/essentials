<?php

/*
 * A way in from outside the panel.
 *
 * Two audiences in one file, and they want opposite things. An administrator
 * reading this page is deciding whether to trust somebody with a key, so every
 * line here says what a key can reach rather than what it is called. A person
 * asking for one wants to know what they are being handed and what happens if
 * they lose it, which is why the sentence about a key being shown once is not
 * a footnote.
 *
 * Nothing here says "token". A key is the word on Pelican's own account page,
 * and a panel that calls the same thing two names is a panel where somebody
 * looks for the wrong one.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Keys that let something outside the panel ask what this plugin knows. Read only — nothing here can start, stop or reach a server.',

    'my_title' => 'API access',
    'my_nav_label' => 'API access',
    'my_subheading' => 'A key of your own, for a bot or a script. It answers only for the servers you can already open.',

    // ---- what a key is, said once, where it matters ----------------------
    'address' => 'The address',
    'address_helper' => 'Send the key as an Authorization header: :example',

    /*
     * The one thing somebody must read before closing the dialog. Written as
     * what to do rather than as a warning, because "keep it safe" is advice
     * nobody can act on and "paste it where the bot reads it, now" is.
     */
    'once' => 'This is the only time this key is shown',
    'once_body' => 'It is stored as a hash, so nobody — including whoever runs this panel — can read it back. Paste it where the bot or script reads it now. If it is lost, revoke this one and ask for another.',
    'copy' => 'Copy',
    'copied' => 'Copied',

    // ---- the states ------------------------------------------------------
    'state' => 'State',
    'state_pending' => 'Waiting',
    'state_active' => 'Active',
    'state_refused' => 'Refused',
    'state_revoked' => 'Revoked',

    'state_pending_body' => 'Somebody has to grant this before it answers anything.',
    'state_refused_body' => 'This was turned down. Nothing was issued.',
    'state_revoked_body' => 'This key has been taken away and no longer answers.',

    // ---- the scopes ------------------------------------------------------
    'scope' => 'Reaches',
    'scope_person' => 'Their own servers',
    'scope_panel' => 'The whole panel',

    'scope_person_helper' => 'Answers only for the servers its owner can already open, asked the same way the panel asks it. Losing this key loses nothing its owner could not already see.',
    'scope_panel_helper' => 'Answers the panel-wide questions — every node, capacity, the watchdog, the panel host itself. For a bot that reports on the panel rather than for a person.',

    // ---- the table -------------------------------------------------------
    'column_name' => 'What for',
    'column_owner' => 'Whose',
    'column_prefix' => 'Key',
    'column_asked' => 'Asked',
    'column_used' => 'Last used',
    'column_expires' => 'Expires',

    'never_used' => 'Never',
    'no_expiry' => 'Until revoked',

    'tab_waiting' => 'Waiting',
    'tab_active' => 'Active',
    'tab_all' => 'All',

    'empty' => 'No keys yet',
    'empty_body' => 'Nobody has asked for one, and none has been issued. This page fills itself in as people do.',

    'my_empty' => 'You have no key',
    'my_empty_body' => 'Ask for one and it will appear here with whatever it has been told.',

    // ---- asking ----------------------------------------------------------
    'ask' => 'Ask for a key',
    'ask_name' => 'What is it for',
    'ask_name_helper' => 'A few words, so you can tell two of your own apart later and whoever grants it knows what they are granting.',
    'ask_reason' => 'Anything worth adding',
    'ask_reason_helper' => 'Optional. Read by whoever decides.',
    'ask_sent' => 'Asked',
    'ask_sent_body' => 'It appears below as soon as somebody has answered.',
    'ask_granted' => 'Here is your key',
    'ask_open' => 'You already have one waiting to be answered',
    'ask_open_body' => 'One request at a time. Cancel that one if it was a mistake.',
    'ask_failed' => 'That could not be asked for',

    'cancel' => 'Cancel',
    'cancel_confirm' => 'Withdraws the request. Nothing was issued, so nothing stops working.',

    // ---- deciding --------------------------------------------------------
    'grant' => 'Grant',
    'grant_confirm' => 'Issues a key that answers for this person\'s own servers, and shows it once. They can already see everything it will report — this decides whether something outside the panel may ask on their behalf.',
    'granted' => 'Granted',

    'refuse' => 'Refuse',
    'refuse_answer' => 'What to tell them',
    'refuse_answer_helper' => 'Optional, and shown on their own page. A refusal with no reason is one that gets asked again next week.',
    'refused' => 'Refused',

    'collect' => 'Show my key',
    'state_ready_body' => 'Granted. Press Show my key to see it — once, because it is stored as a hash and cannot be read back afterwards.',

    'replace' => 'Replace',
    'replace_confirm' => 'This key stops working immediately and a new one takes its place, shown once. There is no way to look the old one up — it was never stored — so replacing it is the only answer to having lost it.',

    'granted_body' => 'They collect it themselves on their own API access page. It is not shown here: a key belongs to the person who asked for it, not to whoever said yes.',

    'revoke' => 'Revoke',
    'revoke_confirm' => 'The key stops answering immediately and its hash is removed, so it cannot be brought back. Anything using it stops. Ask for a new one instead of undoing this.',
    'revoked' => 'Revoked',

    'forget' => 'Remove',
    'forget_confirm' => 'Takes the row off this page for good. It has already stopped answering, so nothing that is working stops - this only removes the record that it existed.',
    'forgotten' => 'Removed',

    'mint' => 'New key',
    'mint_body' => 'For a bot rather than a person. It is granted the moment it is made, because you are the person who would have approved it.',
    'abilities' => 'What it may ask about',
    'abilities_helper' => 'Everything is ticked to begin with, because that is what a key was before this existed. Unticking is the deliberate act. What is stored is the allowed list, so an ability added in a later release is off for keys made before it - a capability nobody ticked is a capability nobody granted.',

    'ability_health' => 'Prove the key works',
    'ability_health_helper' => 'Reaches nothing else. Safe to call on a timer.',
    'ability_me' => 'Its own servers',
    'ability_me_helper' => 'The servers its owner can already open, and their backups. It can never see anybody else.',
    'ability_panel' => 'The whole panel',
    'ability_panel_helper' => 'Every node, every backup, the stopped schedules, the watchdog and the panel host. Needs a panel-wide key as well.',
    'ability_live' => 'Ask a server directly',
    'ability_live_helper' => 'Who is playing, and whether a server is running. The only questions that cost something — they reach a game server or a daemon, cached fifteen to twenty seconds.',
    'ability_connect' => 'Tie Discord accounts to panel accounts',
    'ability_connect_helper' => 'The one group that is not a reading. It creates Pelican API keys on the accounts of people who ask for it and can end a connection. Give it only to the bot that needs it.',

    'own_rate' => 'Requests a minute for this key',
    'own_rate_helper' => 'Leave empty to follow the panel setting. A number here applies to this key alone. Zero means no ceiling at all — reasonable for a bot on your own machine, and a real way to be sorry if the key goes anywhere else.',
    'own_rate_default' => 'Follows the panel',

    'mint_owner' => 'Whose it is',
    'mint_owner_helper' => 'A key answers as somebody. For a panel-wide key this is only who is answerable for it; for a personal one it is also what the key can see.',
    'minted' => 'Made',

    // ---- on Pelican's own profile page ------------------------------------
    'profile_tab' => 'Essentials API',
    'profile_make' => 'A key for the Essentials API',
    'profile_make_helper' => 'A different API from the one above: this one answers what this plugin knows — which of your servers has no backup, who is playing on them, whether they are running. It always answers for you alone and reaches only the servers you can already open.',
    'profile_create' => 'Create',
    'profile_yours' => 'Your Essentials keys',
    'profile_manage' => 'Revoking a key, seeing why one was refused, and connecting Discord are all on the API access page in the sidebar.',

    // ---- Discord ---------------------------------------------------------
    'discord' => 'Discord',
    'discord_body' => 'Tie your Discord account to this one, so a bot can answer for your servers when you ask it to. What it gets is a key that reaches exactly what you can reach and nothing more.',
    'discord_connect' => 'Connect Discord',
    'discord_code' => 'Type this in Discord within ten minutes',
    'discord_code_body' => 'Send :command in a channel the bot can read. The code works once. Nobody can use it but the account it was made for.',
    'discord_on' => 'Connected as :name',
    'discord_since' => 'Since :when',
    'discord_cut' => 'Disconnected',
    'discord_cut_confirm' => 'Ends the connection and deletes the key it made, so the bot stops answering for you immediately. You can connect again whenever you like.',
    'discord_off' => 'Not connected',
    'discord_key_note' => 'Connecting creates a Pelican API key on your account called "Discord (Essentials)". You can see it, and revoke it, under Account → API keys — this page is only a shortcut to the same thing.',

    // ---- the documentation -----------------------------------------------
    'docs_title' => 'How to use this API',
    'docs_subheading' => 'What this panel answers, at the addresses it answers on. Written from the same description the API is built from, so it cannot be a release behind it.',

    'docs_base' => 'Where it lives',
    'docs_endpoints' => 'Endpoints',
    'docs_answers' => 'What comes back',
    'docs_calls' => 'Keys that may call it',

    'docs_params' => 'What to send',
    'docs_required' => 'required',
    'docs_optional' => 'optional',
    'docs_try' => 'Try it',
    'docs_errors' => 'When something is wrong',

    'docs_hook' => 'What the panel posts to you',
    'docs_hook_body' => 'The other direction, and the only part of this that arrives without being asked for. Switched on under Alerts with an address and a signing secret: one JSON post when the watchdog finds something and one when it clears, so a bot hears about a dead node rather than asking every minute whether there is one.',
    'docs_hook_verify' => 'The body is hashed with your secret and the hash travels in X-Essentials-Signature as sha256=<hex>. Hash the raw body, not a re-serialised object — any difference in spacing or key order gives a different hash, and the mismatch reads like an attack rather than a bug.',

    'docs_download_md' => 'Download as Markdown',
    'docs_download_json' => 'Download as OpenAPI',

    // ---- what an administrator sets --------------------------------------
    'settings' => 'How this works',
    'approval' => 'Requests wait to be granted',
    'approval_helper' => 'On, a person asking for a key gets one when somebody says yes. Off, they get one straight away — which is reasonable on a panel where everybody with an account is already trusted, and is worth choosing rather than arriving at.',
    'rate' => 'Requests a minute, per key',
    'rate_helper' => 'A bot asking forty servers who is playing is forty questions to forty game servers. This is the ceiling that stops a loop somebody wrote at three in the morning from becoming a load test.',
    'days' => 'A granted key lasts',
    'days_helper' => 'In days. Zero means until it is revoked, which is the default — a key that expires while nobody is watching is a bot that stops overnight with nothing anywhere saying why.',
    'days_never' => 'Until revoked',

    'hide_pelican' => 'Remove the panel own API keys tab',
    'hide_pelican_helper' => 'Takes the API keys tab off the account profile entirely, so there is only one thing called API keys on that page. It is removed from the page rather than painted over, so there is no address left that reaches it. One thing it cannot do: the panel own client API will still make an account key for anything that asks it directly — the tab is where people make one by hand, and this takes away the hand. Keys that already exist keep working.',

    /*
     * Said on the page rather than left to be found out. Pelican rolls a
     * plugin's migrations back when it is uninstalled, and this plugin's one
     * table goes with them.
     */
    'uninstall_note' => 'Removing this plugin removes every key with it. That is deliberate — a key outliving the thing that answers it is a credential nobody can revoke.',
];
