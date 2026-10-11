<?php

return [
    'title' => 'Essentials settings',
    'nav_label' => 'Essentials settings',
    'save' => 'Save',
    'saved' => 'Settings saved',
    'save_failed' => 'Could not save the settings',
    'secret_kept' => 'Saved. Leave empty to keep it, or type a new one to replace it.',
    'update_background' => 'It runs in the background and takes a minute or two.',

    /*
     * The queue worker and the scheduler, which every background job and
     * timed task depends on. Said separately because they fail separately and
     * the cure is different for each.
     */
    'worker_missing' => 'No queue worker answered. Modpack installs, mails and other background jobs are queued and carried out by a worker process, so until one runs they are written down and never performed, with no error anywhere. Either there is no worker, or there is one that was started before this plugin was installed and cannot load its code - both are fixed by restarting it on the panel host. Set its service to restart on its own, or this returns after every update.',
    'cron_missing' => 'The panel\'s scheduler has not run for :for minutes. Renewals and watchdog checks wait on it. The cron line is in the Pelican documentation.',

    /*
     * Named after the cause rather than the symptom, because the symptom is
     * "nothing happened" and that is what made this hard to place: announcements,
     * navigation links, saved styles and page layouts are all files under
     * storage/app, and a directory the panel cannot write to loses every one of
     * them without a word.
     */
    'storage_failed' => 'The panel could not write to its storage directory, so this was not saved. Check that storage/app belongs to the user the panel runs as. The reason is in storage/logs.',
];
