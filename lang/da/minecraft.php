<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * Spiltilstandene og sværhedsgraderne bliver ikke oversat. Minecraft viser dem
 * inde i spillet som Survival, Creative, Peaceful og Hard — og en indstilling,
 * der hedder noget andet end den skærm, den kommer fra, er en, man slår op to
 * gange.
 *
 * Det samme gælder de udtryk, der står i selve server.properties: whitelist,
 * operator, seed, chunk, RCON, query, resource pack og the Nether.
 */

return [
    /* ---------------------------------------------- administratorfanen --- */

    'nav_label' => 'Minecraft',
    'title' => 'Minecraft-indstillinger',
    'subheading' => 'Denne servers egen server.properties, som en formular i stedet for en tekstfil.',

    /*
     * Selve overskriften står ikke her. Hvert indstillingsafsnit tager sin titel
     * fra settings.groups.<navn>, som group() bygger.
     */
    'section_helper' => 'Hvilke eggs det gælder for, og alt andet, dette plugin gør omkring Minecraft.',

    'live' => 'Spørg serverne, hvem der spiller',
    'live_helper' => 'Lægger en levende liste over de tilsluttede til Spillere-siden, med det samme håndtryk, som Minecraft-klienten laver for at tegne en server på sin egen liste. Slået fra som standard, fordi det er det eneste her, der åbner en forbindelse fra panelet direkte til en spilport: ligger dit panel og dine noder på net, der ikke kan nå hinanden, svarer intet, og linjen dukker slet ikke op. På selve spilserveren skal der ikke slås noget til.',

    'eggs' => 'Hvilke eggs er Minecraft',
    'eggs_helper' => 'Sæt hak ved de eggs, der kører en Minecraft-server — Vanilla, Paper, Purpur, Fabric, Forge, og hvad dine ellers hedder. Siden dukker op inde i de servere, der bruger dem, og ingen andre steder. Der er ikke sat hak ved noget til at begynde med, og det er med vilje: et plugin kan ikke vide, hvad du har kaldt dine eggs, og en gættet liste ville være forkert på nogens panel allerede den uge, den udkom.',

    /* ------------------------------------------------------ serverside --- */

    'groups' => [
        'general' => 'Serveren',
        'players' => 'Spillere',
        'world' => 'Verdenen',
        'performance' => 'Ydelse',
        'access' => 'Adgang og ekstra',
        'other' => 'Alt andet i filen',
    ],

    'other_helper' => 'Læst fra server.properties og ladt stå præcis som det er. Mods og modpakker lægger deres egne indstillinger her; de vises, så du kan se, at de findes, og de ændres gennem filhåndteringen. At gemme denne side rører dem aldrig.',

    'reload' => 'Læs filen igen',

    'saved' => 'Gemt i server.properties',
    'saved_helper' => 'Det træder i kraft, næste gang serveren starter.',

    'running' => 'Serveren kører',
    'running_helper' => 'Minecraft læser server.properties, når den starter, og skriver den tilbage, når den stopper, så noget, der blev gemt nu, ville blive overskrevet på vej ud. Stop serveren og gem igen.',

    'missing' => 'Ingen server.properties fundet',
    'missing_helper' => 'Filen dukker op, når serveren startes første gang. Start den én gang, og kom så tilbage.',

    'failed' => 'Kunne ikke gemme',
    'failed_helper' => 'Daemonen afviste skrivningen. Serveren er måske startet, mens denne side var åben.',

    /* -------------------------------------- hvad hver nøgle betyder ------ */

    'keys' => [
        'motd' => 'Besked på serverlisten',
        'gamemode' => 'Spiltilstand',
        'difficulty' => 'Sværhedsgrad',
        'hardcore' => 'Hardcore — døden er endelig',
        'force_gamemode' => 'Sæt alle tilbage til standardtilstanden, når de kommer ind',
        'pvp' => 'Spillere kan skade hinanden',

        'max_players' => 'Flest spillere ad gangen',
        'white_list' => 'Kun whitelist',
        'enforce_whitelist' => 'Smid alle ud, der ikke er på whitelisten',
        'online_mode' => 'Tjek konti hos Mojang',
        'player_idle_timeout' => 'Smid ud efter så mange minutters stilstand',
        'op_permission_level' => 'Hvad en operator må (1–4)',

        'level_name' => 'Verdensmappe',
        'level_seed' => 'Seed',
        'level_type' => 'Verdenstype',
        'allow_nether' => 'The Nether',
        'spawn_monsters' => 'Monstre dukker op',
        'spawn_protection' => 'Beskyttede blokke omkring spawn',

        'view_distance' => 'Synsvidde i chunks',
        'simulation_distance' => 'Simulationsvidde i chunks',
        'max_tick_time' => 'Watchdog, i millisekunder (-1 slår den fra)',
        'sync_chunk_writes' => 'Skriv chunks direkte til disken',

        'enable_command_block' => 'Kommandoblokke',
        'allow_flight' => 'Tillad at flyve',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'Adresse på resource pack',
        'require_resource_pack' => 'Resource pack er påkrævet',
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
