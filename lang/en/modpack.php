<?php

return [
    'nav_label' => 'Modpacks',
    'title' => 'Modpacks',
    'subheading' => 'Install a modpack from Modrinth onto this server.',

    'section' => 'Find a pack',
    'section_helper' => 'Modrinth only, and server-side packs only. It needs no account and no API key, which is why it is the one source here — the others each want a key pasted in before anything appears.',

    'search' => 'Search',
    'search_helper' => 'Leave it empty for the most downloaded. Searching asks Modrinth, so it happens when you leave the field rather than as you type.',

    'pack' => 'Pack',
    'pack_helper' => 'Only packs that say they run on a server are listed.',

    'version' => 'Version',
    'version_helper' => 'The game version and loader are shown beside each one. Pick the loader this server\'s egg already runs — this installs files and does not change your egg or your startup command.',

    'downloads' => 'downloads',

    'install' => 'Install this pack',
    'install_go' => 'Install it',
    'install_confirm' => 'The pack\'s files are added to this server. **Nothing is deleted** — not your world, not your old mods, not a config. A pack installed on top of another leaves both, so remove the previous pack\'s mods yourself first if that is what you want. The server must be stopped, and it stays stopped.',

    'started' => 'Installing',
    'started_helper' => 'The pack is being fetched and unpacked. A few hundred files takes a few minutes, and you get a notification when it is done — it keeps going if you leave this page.',

    'running' => 'The server is running',
    'running_helper' => 'Minecraft loads its mods when it starts, so a pack installed now would leave a server that is neither the old pack nor the new one until it restarts. Stop it and try again.',

    'done' => ':pack installed',
    'done_body' => ':files files fetched and :overrides items from the pack\'s own folder put in place. Start the server when you are ready.',
    'done_refused' => ':count files were skipped because the pack asked for them from somewhere this will not download from.',

    'failed' => 'The pack was not installed',
    'failed_fetch' => 'The pack could not be fetched or unpacked. The daemon may be unreachable, or the server may be out of disk.',
    'failed_index' => 'The pack was fetched but had no readable index in it, so there was nothing to install.',
    'failed_version' => 'That version has no pack file to download any more. Pick another.',
    'failed_queue' => 'The install could not be queued. This needs a queue worker running on the panel.',
];
