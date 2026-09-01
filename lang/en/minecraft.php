<?php

return [
    /* ------------------------------------------------- the admin tab ----- */

    'nav_label' => 'Minecraft',
    'title' => 'Minecraft settings',
    'subheading' => 'The server\'s own server.properties, as a form instead of a text file.',

    'section' => 'Minecraft',
    'section_helper' => 'Which eggs this applies to, and everything else about Minecraft this plugin does.',

    'eggs' => 'Which eggs are Minecraft',
    'eggs_helper' => 'Tick the eggs that run a Minecraft server — Vanilla, Paper, Purpur, Fabric, Forge, and whatever yours are called. The page appears inside servers using them and nowhere else. Nothing is ticked to begin with, on purpose: a plugin cannot know what you have named your eggs, and a guessed list would be wrong on somebody\'s panel the week it shipped.',

    /* ---------------------------------------------- the server's page ---- */

    'groups' => [
        'general' => 'The server',
        'players' => 'Players',
        'world' => 'The world',
        'performance' => 'Performance',
        'access' => 'Access and extras',
        'other' => 'Everything else in the file',
    ],

    'other_helper' => 'Read from server.properties and left exactly as it is. Mods and modpacks put their own settings here; they are shown so you can see they exist, and changed through the file manager. Saving this page never touches them.',

    'reload' => 'Read the file again',

    'saved' => 'Saved to server.properties',
    'saved_helper' => 'It takes effect the next time the server starts.',

    'running' => 'The server is running',
    'running_helper' => 'Minecraft reads server.properties when it starts and writes it back when it stops, so anything saved now would be overwritten on the way out. Stop the server and save again.',

    'missing' => 'No server.properties found',
    'missing_helper' => 'The file appears when the server is started for the first time. Start it once, then come back.',

    'failed' => 'Could not save',
    'failed_helper' => 'The daemon refused the write. The server may have started while this page was open.',

    /* --------------------------------------------- what each key means --- */

    'keys' => [
        'motd' => 'Message in the server list',
        'gamemode' => 'Game mode',
        'difficulty' => 'Difficulty',
        'hardcore' => 'Hardcore — death is permanent',
        'force_gamemode' => 'Put everyone back to the default mode on joining',
        'pvp' => 'Players can hurt each other',

        'max_players' => 'Most players at once',
        'white_list' => 'Whitelist only',
        'enforce_whitelist' => 'Kick anyone not on the whitelist',
        'online_mode' => 'Check accounts with Mojang',
        'player_idle_timeout' => 'Kick after minutes idle',
        'op_permission_level' => 'What an operator may do (1–4)',

        'level_name' => 'World folder',
        'level_seed' => 'Seed',
        'level_type' => 'World type',
        'allow_nether' => 'The Nether',
        'spawn_monsters' => 'Monsters spawn',
        'spawn_protection' => 'Blocks protected around spawn',

        'view_distance' => 'View distance in chunks',
        'simulation_distance' => 'Simulation distance in chunks',
        'max_tick_time' => 'Watchdog, in milliseconds (-1 is off)',
        'sync_chunk_writes' => 'Write chunks straight to disk',

        'enable_command_block' => 'Command blocks',
        'allow_flight' => 'Allow flying',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'Resource pack address',
        'require_resource_pack' => 'The resource pack is required',
    ],

    'values' => [
        'survival' => 'Survival',
        'creative' => 'Creative',
        'adventure' => 'Adventure',
        'spectator' => 'Spectator',
        'peaceful' => 'Peaceful',
        'easy' => 'Easy',
        'normal' => 'Normal',
        'hard' => 'Hard',
    ],
];
