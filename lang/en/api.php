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

    'revoke' => 'Revoke',
    'revoke_confirm' => 'The key stops answering immediately and its hash is removed, so it cannot be brought back. Anything using it stops. Ask for a new one instead of undoing this.',
    'revoked' => 'Revoked',

    'forget' => 'Remove',
    'forget_confirm' => 'Takes the row off this page for good. It has already stopped answering, so nothing that is working stops - this only removes the record that it existed.',
    'forgotten' => 'Removed',

    'mint' => 'New key',
    'mint_body' => 'For a bot rather than a person. It is granted the moment it is made, because you are the person who would have approved it.',
    'mint_owner' => 'Whose it is',
    'mint_owner_helper' => 'A key answers as somebody. For a panel-wide key this is only who is answerable for it; for a personal one it is also what the key can see.',
    'minted' => 'Made',

    // ---- the documentation -----------------------------------------------
    'docs_title' => 'How to use this API',
    'docs_subheading' => 'What this panel answers, at the addresses it answers on. Written from the same description the API is built from, so it cannot be a release behind it.',

    'docs_base' => 'Where it lives',
    'docs_endpoints' => 'Endpoints',
    'docs_answers' => 'What comes back',
    'docs_calls' => 'Keys that may call it',

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

    /*
     * Said on the page rather than left to be found out. Pelican rolls a
     * plugin's migrations back when it is uninstalled, and this plugin's one
     * table goes with them.
     */
    'uninstall_note' => 'Removing this plugin removes every key with it. That is deliberate — a key outliving the thing that answers it is a credential nobody can revoke.',
];
