<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * Spillmodusene og vanskelighetsgradene blir ikke oversatt. Minecraft viser dem
 * inne i spillet som Survival, Creative, Peaceful og Hard - og en innstilling
 * som heter noe annet enn skjermen den kommer fra, er en man slår opp to ganger.
 *
 * Det samme gjelder de uttrykkene som står i selve server.properties: whitelist,
 * operator, seed, chunk, RCON, query, resource pack og the Nether.
 */

return [
    /* --------------------------------------------- administratorfanen ---- */

    'nav_label' => 'Minecraft',
    'title' => 'Minecraft-innstillinger',
    'subheading' => 'Denne serverens egen server.properties, som et skjema i stedet for en tekstfil.',

    /*
     * Selve overskriften står ikke her. Hver innstillingsseksjon henter tittelen
     * sin fra settings.groups.<navn>, som group() bygger.
     */
    'section_helper' => 'Hvilke eggs det gjelder for, og alt annet dette pluginet gjør rundt Minecraft.',

    'live' => 'Spør serverne hvem som spiller',
    'live_helper' => 'Legger en levende liste over de tilkoblede til Spillere-siden, med det samme håndtrykket Minecraft-klienten gjør for å tegne en server i sin egen liste. Av som standard, fordi det er den eneste tingen her som åpner en forbindelse fra panelet rett til en spillport: ligger panelet og nodene dine på nett som ikke når hverandre, svarer ingenting, og linjen dukker rett og slett ikke opp. På selve spillserveren trenger ingenting å slås på.',

    'eggs' => 'Hvilke eggs er Minecraft',
    'eggs_helper' => 'Kryss av for de eggs som kjører en Minecraft-server - Vanilla, Paper, Purpur, Fabric, Forge, og hva dine ellers heter. Siden dukker opp inne i de serverne som bruker dem, og ingen andre steder. Ingenting er krysset av til å begynne med, og det er med vilje: et plugin kan ikke vite hva du har kalt eggene dine, og en gjettet liste ville vært feil på noens panel allerede den uken den kom ut.',

    /* ------------------------------------------------------- serversiden - */

    'groups' => [
        'general' => 'Serveren',
        'players' => 'Spillere',
        'world' => 'Verdenen',
        'performance' => 'Ytelse',
        'access' => 'Tilgang og ekstra',
        'other' => 'Alt annet i filen',
    ],

    'other_helper' => 'Lest fra server.properties og latt stå nøyaktig som det er. Mods og modpakker legger sine egne innstillinger her; de vises så du ser at de finnes, og de endres gjennom filbehandleren. Å lagre denne siden rører dem aldri.',

    'reload' => 'Les filen på nytt',

    'saved' => 'Lagret i server.properties',
    'saved_helper' => 'Det trer i kraft neste gang serveren starter.',

    'running' => 'Serveren kjører',
    'running_helper' => 'Minecraft leser server.properties når den starter og skriver den tilbake når den stopper, så noe som ble lagret nå, ville blitt overskrevet på vei ut. Stopp serveren og lagre på nytt.',

    'missing' => 'Fant ingen server.properties',
    'missing_helper' => 'Filen dukker opp når serveren startes første gang. Start den én gang, og kom så tilbake.',

    'failed' => 'Kunne ikke lagre',
    'failed_helper' => 'Daemonen avviste skrivingen. Serveren har kanskje startet mens denne siden var åpen.',

    /* --------------------------------------- hva hver nøkkel betyr ------- */

    'keys' => [
        'motd' => 'Melding i serverlisten',
        'gamemode' => 'Spillmodus',
        'difficulty' => 'Vanskelighetsgrad',
        'hardcore' => 'Hardcore - døden er endelig',
        'force_gamemode' => 'Sett alle tilbake til standardmodus når de kommer inn',
        'pvp' => 'Spillere kan skade hverandre',

        'max_players' => 'Flest spillere samtidig',
        'white_list' => 'Bare whitelist',
        'enforce_whitelist' => 'Kast ut alle som ikke står på whitelisten',
        'online_mode' => 'Sjekk kontoer hos Mojang',
        'player_idle_timeout' => 'Kast ut etter så mange minutter uten aktivitet',
        'op_permission_level' => 'Hva en operator får gjøre (1–4)',

        'level_name' => 'Verdensmappe',
        'level_seed' => 'Seed',
        'level_type' => 'Verdenstype',
        'allow_nether' => 'The Nether',
        'spawn_monsters' => 'Monstre dukker opp',
        'spawn_protection' => 'Beskyttede blokker rundt spawn',

        'view_distance' => 'Synsvidde i chunks',
        'simulation_distance' => 'Simuleringsvidde i chunks',
        'max_tick_time' => 'Watchdog, i millisekunder (-1 slår den av)',
        'sync_chunk_writes' => 'Skriv chunks rett til disk',

        'enable_command_block' => 'Kommandoblokker',
        'allow_flight' => 'Tillat å fly',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'Adresse til resource pack',
        'require_resource_pack' => 'Resource pack er påkrevd',
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
