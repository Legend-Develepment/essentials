<?php

return [
    'nav_label' => 'Mods & plugins',
    'title' => 'Mods and plugins',
    'subheading' => 'One at a time, from Modrinth, into this server.',

    'section' => 'Find something',
    'section_helper' => 'The modpack page installs a whole pack at once. This installs a single mod or plugin, which is the thing you want far more often.',

    'kind' => 'What are you adding',
    /*
     * Asked rather than worked out. An egg is called whatever an administrator
     * called it, and several loaders read both folders, so there is no honest
     * way to guess this from here - and guessing wrong writes a jar into a
     * folder nothing reads.
     */
    'kind_helper' => 'A mod goes into mods/ and is for Fabric, Forge or NeoForge. A plugin goes into plugins/ and is for Bukkit, Spigot or Paper. This also decides which half of Modrinth is searched.',
    'kind_mod' => 'A mod (mods/)',
    'kind_plugin' => 'A plugin (plugins/)',

    'search' => 'Search',
    'search_helper' => 'Type a name and click away from the box. Results are the most downloaded first.',

    'project' => 'Mod or plugin',
    'version' => 'Version',
    'version_helper' => 'Each line is the version number, the Minecraft versions it is built for, and the loaders it supports. Pick one that matches your server — nothing here checks that for you.',

    'install' => 'Install',
    'install_confirm' => 'The file is fetched by the node directly from Modrinth and put in the folder. Nothing already there is removed.',
    'installed' => 'Installed',
    'installed_helper' => 'It loads the next time the server starts.',

    'remove' => 'Remove',
    'remove_confirm' => 'The file is deleted from the server. This cannot be undone from here.',
    'removed' => 'Removed',

    'running' => 'The server is running',
    'running_helper' => 'Minecraft reads mods/ and plugins/ once, when it starts. A file added now would not load until a restart, and one taken away from under a running game can take the game with it. Stop the server first.',

    'failed' => 'That did not work',
    'failed_version' => 'That version has no jar this can install. Some releases carry only sources, or only a client build.',
    'failed_write' => 'The node refused the download. It may not have been able to reach Modrinth.',

    'installed_title' => 'Installed',
    'installed_mods' => 'In mods/',
    'installed_plugins' => 'In plugins/',
    /*
     * Said because an empty list is ambiguous: it usually means this server
     * does not use that folder at all, rather than that something is missing.
     */
    'installed_empty' => 'Nothing here. A server only uses one of these two folders, so one being empty is normal.',
    'installed_note' => 'Only .jar files are listed. Configuration folders and disabled files are left alone and are not shown.',
];
