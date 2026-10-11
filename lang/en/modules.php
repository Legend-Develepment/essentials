<?php

/*
 * The modules page.
 *
 * Its own file rather than a corner of settings.php, which is already the
 * largest language file this plugin has: sixty-four kilobytes that Laravel
 * loads whole the moment anything asks for one key in it.
 */

return [
    'title' => 'Modules',
    'nav_label' => 'Modules',
    'subheading' => 'What this plugin is on this panel. Everything here can be switched off, and switching something off never removes anything it has already written down.',

    'first_title' => 'What is this panel for?',
    'first_helper' => 'Answer once and the parts that suit it are switched on. Nothing is settled by it: every switch below stays yours afterwards, and switching something off never removes what it has already written down.',
    'first_look' => 'Mostly how it looks',
    'first_look_helper' => 'Colours, the sign-in screen, announcements, your own links, and the pages for changing them. Nothing that sells, answers or reaches outside.',
    'first_run' => 'Running servers, for me or a team',
    'first_run_helper' => 'The look, plus what a server shows and what is full or stopped. No shop, no ticket desk, and nothing sending mail on a timer.',
    'first_sell' => 'Selling hosting to customers',
    'first_sell_helper' => 'All of it. A shop without somewhere to answer questions, and with nothing watching the nodes, is half a shop.',
    'first_skip' => 'I will pick them myself',

    'first_left' => 'Left as it is. The switches are all below.',

    'go' => 'Set it up',

    'state_on' => 'On',
    'state_part' => 'Partly on',
    'state_off' => 'Off',

    'count' => '{1} :on of :of part on|[2,*] :on of :of parts on',
    'parts' => '{1} The one part|[2,*] All :count parts',

    'health_tables' => 'Its tables are not there yet. Saving anything on this page makes them.',
    'health_missing' => '{1} One part needs something that is switched off|[2,*] :count parts need something that is switched off',
    'health_waiting' => '{1} One part is on and showing nothing yet|[2,*] :count parts are on and showing nothing yet',

    'left_access' => '{1} One person still has a server this granted|[2,*] :count people still have servers this granted',
    'left_public_status' => '{1} One published page and its address are still kept|[2,*] :count published pages and their addresses are still kept',
    'left_arranger' => '{1} One saved arrangement is still kept|[2,*] :count saved arrangements are still kept',
    'left_user_themes' => '{1} One person\'s chosen style is still kept|[2,*] :count people\'s chosen styles are still kept',
    'left_unknown' => 'Something is still kept here, and the panel could not read how much.',
    'cleared' => '{1} One taken back|[2,*] :count taken back',
    'clear_failed' => 'That could not be cleared',

    'turn_on' => 'Turn on',
    'turn_off' => 'Turn off',

    'saved' => 'Saved',
    'brought' => 'Switched on with it, because nothing here works without them: :names.',
    'save_failed' => 'That could not be saved',

    'read_only' => 'You may look at this and not change it. Changing what the panel offers needs the broader permission on this plugin.',
];
