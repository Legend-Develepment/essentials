<?php

/*
 * Game artwork for eggs, from Steam and IGDB.
 *
 * A fresh Pelican draws the same grey bird on every server card. See
 * Support\Artwork for where the two facts per egg are kept, and why in tags.
 */

return [
    'title' => 'Egg artwork',
    'nav_label' => 'Egg artwork',
    'subheading' => 'Game pictures for your eggs: from the Essentials artwork library, Steam or IGDB, or one of your own. An egg with no picture shows Pelican\'s own bird on every server card using it.',

    // ---- the table -------------------------------------------------------
    'column_name' => 'Egg',
    'column_library' => 'Library',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'Locked',

    'locked' => 'Locked',
    'unlocked' => 'Open',
    'fetch_library' => 'Library',
    'library_logo' => 'Logo',
    'library_logo_helper' => 'Type to search the Essentials artwork library. The logo whose name is this egg\'s is filled in when there is one. Choosing one locks the picture, so a bulk fetch will not replace it.',
    'upload' => 'Upload',
    'upload_file' => 'Picture',
    'upload_file_helper' => 'Any picture up to 4 MB, an SVG drawing included; anything but PNG, JPEG or WebP is made into WebP. An uploaded picture is locked, so a bulk fetch will not replace it.',

    // ---- what you can do to one row --------------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'The number in a game\'s Steam store address - store.steampowered.com/app/892970 is 892970. Fetching by id locks the picture, because typing a number is a decision and a later bulk run must not undo it.',

    'fetch_igdb' => 'IGDB',
    'search_term' => 'Search for',
    'search_term_helper' => 'The egg\'s name is filled in, but it is rarely what the game is called - "Paper 1.20.4" is Minecraft. Type the game.',

    'lock' => 'Lock',
    'unlock' => 'Unlock',
    'locked_done' => 'Locked - a bulk fetch will leave this one alone',
    'unlocked_done' => 'Unlocked - a bulk fetch may replace this picture',

    'clear' => 'Clear',
    'clear_confirm' => 'Removes the picture, the Steam App ID and the library logo. The egg goes back to Pelican\'s own bird, and the next bulk fetch will try again.',
    'cleared' => 'Picture removed',

    // ---- outcomes --------------------------------------------------------
    'fetched' => 'Picture saved',
    'failed' => 'No picture was saved',

    /*
     * One reason each, because they are different problems.
     *
     * A fetch that failed on a typo and one that failed because the disk is
     * full should not both say "failed" - the first is fixed by looking at the
     * number, the second by looking at the server.
     */
    'why_bad_id' => 'That is not a Steam App ID.',
    'why_not_found' => 'Steam has nothing at that address. Check the App ID - a game with no store page has no header picture either.',
    'why_no_match' => 'Nothing was found under that name. Try what the game is actually called rather than what the egg is called.',
    'why_no_name' => 'There is nothing to search for.',
    'why_no_token' => 'Twitch would not issue a token. Check the client ID and secret under Credentials.',
    'why_not_configured' => 'IGDB needs a Twitch client ID and secret. Set them under Credentials.',
    'why_empty' => 'The answer was empty.',
    'why_large' => 'That picture is far larger than an icon and was not saved.',
    'why_not_an_image' => 'What came back is not a picture. That usually means an error page answered with a success code.',
    'why_wrong_format' => 'That picture is in a format this panel does not store. Pelican keeps PNG, JPEG and WebP.',
    'why_unwritable' => 'The picture could not be written. Check that storage/app/public belongs to the user the panel runs as, and that php artisan storage:link has been run.',
    'why_unknown' => 'It did not work, and the reason is not one this knows a name for.',
    'why_library_gone' => 'The artwork library did not hand over that picture. It may have been removed, or the library could not be reached.',

    // ---- everything at once ----------------------------------------------
    'bulk' => 'Fetch all missing',
    'bulk_confirm_steam' => 'Looks up every egg that has no picture and is not locked in the Essentials artwork library, then searches Steam by name for what the library does not have. Locked eggs and eggs that already have a picture are left alone. This runs in the background - you will be told when it finishes.',
    'bulk_confirm_both' => 'Looks up every egg that has no picture and is not locked in the Essentials artwork library, searches Steam by name for what the library does not have, then tries IGDB for whatever is left. Locked eggs and eggs that already have a picture are left alone. This runs in the background - you will be told when it finishes.',

    'bulk_started' => 'Fetching in the background',
    'bulk_started_body' => 'This can take several minutes on a large panel. You will get a notification when it is done, and you can leave this page.',

    'bulk_done' => 'Egg artwork finished',
    'bulk_done_body' => ':fetched fetched, :skipped left alone, :failed with nothing found. An egg is left alone when it is locked or already has a picture.',

    'bulk_failed' => 'The bulk fetch did not run',
    'bulk_failed_queue' => 'It could not be handed to the queue. This needs a queue worker - check that pelican-queue is running.',

    // ---- IGDB credentials ------------------------------------------------
    'credentials' => 'Credentials',
    'credentials_helper' => 'The artwork library and Steam work without any of this. These are only for IGDB, which covers the games neither has - anything that shipped on a console, most modded eggs.',
    'credentials_where' => 'Make an application at dev.twitch.tv/console, generate a client secret, and paste both here. It is free.',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => 'Credentials saved',
    'credentials_failed' => 'The credentials could not be saved',
];
