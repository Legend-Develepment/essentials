<?php

return [
    'title' => 'Essentials settings',
    'nav_label' => 'Essentials settings',
    'save' => 'Save',
    'saved' => 'Settings saved',
    'save_failed' => 'Could not save the settings',
    'update' => 'Update',
    'update_available' => 'An update is available',
    'update_confirm' => 'The panel downloads the new version, rebuilds its assets and clears its caches. Your settings are kept.',
    'update_started' => 'Update started',
    'update_background' => 'It runs in the background and takes a minute or two.',
    'update_failed' => 'Could not update the theme',
    'update_done' => 'Theme updated',
    'check' => 'Check for updates',
    'check_failed' => 'Could not read the update feed',
    'check_failed_body' => 'The panel could not reach it, or it did not return valid JSON.',
    'up_to_date' => 'You are on the latest version',
    'reinstall' => 'Reinstall',

    'auto_on' => 'Updates install themselves',
    'next_check' => 'Next check in',
    'due_now' => 'due now',

    /*
     * Named after the cause rather than the symptom, because the symptom is
     * "nothing happened" and that is what made this hard to place: announcements,
     * navigation links, saved styles and page layouts are all files under
     * storage/app, and a directory the panel cannot write to loses every one of
     * them without a word.
     */
    'storage_failed' => 'The panel could not write to its storage directory, so this was not saved. Check that storage/app belongs to the user the panel runs as. The reason is in storage/logs.',

    /*
     * Said after every failed update rather than only after a mismatch. The
     * message above already names the cause; this names the one cure a person
     * cannot work out from "expected X, got Y".
     */
    'update_renamed' => 'If this says two ids do not match, the plugin has been renamed and no update can cross that — Pelican knows an installed plugin by its id. Uninstall the old entry under Admin → Plugins and install this one fresh. Your settings survive: they live in .env and storage/app/private/legend-theme, and neither is keyed by the id.',
];
