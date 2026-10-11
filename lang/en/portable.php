<?php

/*
 * The settings as a file: out, and back in again.
 *
 * The uploads are deliberately not in it - see Support\Portable for why saying
 * so beats quietly leaving them out.
 */

return [
    'export' => 'Export settings',
    'records' => 'Export the records',
    'records_helper' => 'Every package, order, invoice, payment and ticket, as one file. Removing this plugin deletes all of it and Pelican asks nothing first, so this is the copy to take beforehand. The API keys are left out: a key cannot be restored from a file, only issued again.',
    'import' => 'Import settings',
    'apply' => 'Import',

    'file' => 'Settings file',
    'file_helper' => 'A file exported from this plugin. Pictures and icon packs are not in it - those are files on a disk, and they stay as they are.',

    'summary' => 'What this would change',
    'summary_none' => 'Choose a file to see what it would change.',
    'summary_unreadable' => 'That is not a settings file from this plugin, or it holds nothing this panel recognises.',
    'summary_same' => 'Nothing. Every setting in that file already matches this panel.',
    'summary_count' => '{1} One setting would change.|[2,*] :count settings would change.',
    'summary_more' => '· and :count more',

    'imported' => 'Settings imported',
    'missing' => 'These pictures are not on this panel and are left out: :files',
    'failed' => 'Could not import that file',
    'no_file' => 'No file arrived. An upload waiting too long before Apply is pressed is cleared away by the panel - choose the file again and apply it straight after.',
    'denied' => 'You do not have permission to change these settings.',
];
