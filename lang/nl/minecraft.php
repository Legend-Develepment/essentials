<?php

/*
 * Nederlands. Met de hand geschreven.
 *
 * De spelmodi en moeilijkheidsgraden blijven onvertaald. Minecraft toont ze in
 * het spel zelf als Survival, Creative, Peaceful en Hard - ook in een
 * Nederlandse client is dat wat je in de wereld ziet - en een instelling die
 * anders heet dan het scherm waar hij vandaan komt is een instelling die je
 * twee keer moet opzoeken.
 *
 * Hetzelfde geldt voor de begrippen die in server.properties zelf staan:
 * whitelist, operator, seed, chunk, RCON, Query, resource pack en de Nether.
 */

return [
    /* ------------------------------------------------ de beheerderstab ---- */

    'nav_label' => 'Minecraft',
    'title' => 'Minecraft-instellingen',
    'subheading' => 'De eigen server.properties van de server, als formulier in plaats van als tekstbestand.',

    'section_helper' => 'Op welke eggs dit van toepassing is, en al het andere over Minecraft dat deze plugin doet.',

    'live' => 'Servers vragen wie er speelt',
    'live_helper' => 'Zet een live lijst met verbonden spelers op de spelerspagina, via dezelfde handshake die de Minecraft-client gebruikt om een server in zijn eigen lijst te tekenen. Standaard uit, omdat dit als enige hier een verbinding opent vanaf het panel rechtstreeks naar een spelpoort: kunnen jouw panel en je nodes elkaar niet bereiken, dan antwoordt er niets en verschijnt de regel eenvoudigweg niet. Op de gameserver zelf hoeft er niets te worden aangezet.',

    'eggs' => 'Welke eggs zijn Minecraft',
    'eggs_helper' => 'Vink de eggs aan die een Minecraft-server draaien — Vanilla, Paper, Purpur, Fabric, Forge, en hoe die van jou ook heten. De pagina verschijnt binnen servers die ze gebruiken en nergens anders. Er staat om te beginnen niets aangevinkt, en dat is met opzet: een plugin kan niet weten hoe jij je eggs hebt genoemd, en een geraden lijst zou al in de week van uitkomen op iemands panel fout zijn.',

    /* ----------------------------------------- de pagina in de server ----- */

    'groups' => [
        'general' => 'De server',
        'players' => 'Spelers',
        'world' => 'De wereld',
        'performance' => 'Prestaties',
        'access' => 'Toegang en extra\'s',
        'other' => 'Al het andere in het bestand',
    ],

    'other_helper' => 'Uit server.properties gelezen en precies zo gelaten. Mods en modpacks zetten hier hun eigen instellingen neer; ze worden getoond zodat je ziet dat ze bestaan, en je wijzigt ze via de bestandsbeheerder. Deze pagina opslaan raakt ze nooit aan.',

    'reload' => 'Bestand opnieuw lezen',

    'saved' => 'Opgeslagen in server.properties',
    'saved_helper' => 'Het gaat in de volgende keer dat de server start.',

    'running' => 'De server draait',
    'running_helper' => 'Minecraft leest server.properties bij het starten en schrijft hem bij het stoppen terug, dus alles wat je nu opslaat wordt er bij het afsluiten overheen geschreven. Stop de server en sla opnieuw op.',

    'missing' => 'Geen server.properties gevonden',
    'missing_helper' => 'Het bestand verschijnt zodra de server voor het eerst is gestart. Start hem één keer en kom dan terug.',

    'failed' => 'Kon niet opslaan',
    'failed_helper' => 'De daemon weigerde de schrijfactie. Mogelijk is de server gestart terwijl deze pagina openstond.',

    /* -------------------------------------- wat elke sleutel betekent ----- */

    'keys' => [
        'motd' => 'Bericht in de serverlijst',
        'gamemode' => 'Spelmodus',
        'difficulty' => 'Moeilijkheid',
        'hardcore' => 'Hardcore — de dood is definitief',
        'force_gamemode' => 'Iedereen bij het joinen terugzetten naar de standaardmodus',
        'pvp' => 'Spelers kunnen elkaar verwonden',

        'max_players' => 'Meeste spelers tegelijk',
        'white_list' => 'Alleen whitelist',
        'enforce_whitelist' => 'Iedereen die niet op de whitelist staat van de server sturen',
        'online_mode' => 'Accounts bij Mojang controleren',
        'player_idle_timeout' => 'Van de server sturen na minuten inactief',
        'op_permission_level' => 'Wat een operator mag (1–4)',

        'level_name' => 'Wereldmap',
        'level_seed' => 'Seed',
        'level_type' => 'Wereldtype',
        'allow_nether' => 'De Nether',
        'spawn_monsters' => 'Monsters spawnen',
        'spawn_protection' => 'Beschermde blokken rond spawn',

        'view_distance' => 'Kijkafstand in chunks',
        'simulation_distance' => 'Simulatieafstand in chunks',
        'max_tick_time' => 'Watchdog, in milliseconden (-1 is uit)',
        'sync_chunk_writes' => 'Chunks rechtstreeks naar schijf schrijven',

        'enable_command_block' => 'Command blocks',
        'allow_flight' => 'Vliegen toestaan',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'Adres van resource pack',
        'require_resource_pack' => 'Het resource pack is verplicht',
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
