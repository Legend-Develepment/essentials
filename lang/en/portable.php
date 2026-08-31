<?php

/*
 * The settings as a file: out, and back in again.
 *
 * The uploads are deliberately not in it - see Support\Portable for why saying
 * so beats quietly leaving them out.
 */

return [
    'export' => 'Export settings',
    'import' => 'Import settings',
    'apply' => 'Import',

    'file' => 'Settings file',
    'file_helper' => 'A file exported from this plugin. Pictures and icon packs are not in it — those are files on a disk, and they stay as they are.',

    'summary' => 'What this would change',
    'summary_none' => 'Choose a file to see what it would change.',
    'summary_unreadable' => 'That is not a settings file from this plugin, or it holds nothing this panel recognises.',
    'summary_same' => 'Nothing. Every setting in that file already matches this panel.',
    'summary_count' => ':count settings would change.',
    'summary_more' => '· and :count more',

    'imported' => 'Settings imported',
    'failed' => 'Could not import that file',
    'no_file' => 'No file arrived. An upload waiting too long before Apply is pressed is cleared away by the panel — choose the file again and apply it straight after.',
    'denied' => 'You do not have permission to change these settings.',
];
