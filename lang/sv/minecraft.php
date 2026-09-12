<?php

/*
 * Svenska. Skriven för hand.
 *
 * Spellägena och svårighetsgraderna översätts inte. Minecraft visar dem inne i
 * spelet som Survival, Creative, Peaceful och Hard - och en inställning som
 * heter något annat än den skärm den kommer från är en man slår upp två gånger.
 *
 * Detsamma gäller de uttryck som står i själva server.properties: whitelist,
 * operator, seed, chunk, RCON, query, resource pack och the Nether.
 */

return [
    /* -------------------------------------------- administratörsfliken ---- */

    'nav_label' => 'Minecraft',
    'title' => 'Minecraft-inställningar',
    'subheading' => 'Den här serverns egen server.properties, som ett formulär i stället för en textfil.',

    /*
     * Själva rubriken står inte här. Varje inställningsavsnitt hämtar sin titel
     * ur settings.groups.<namn>, som group() bygger.
     */
    'section_helper' => 'Vilka eggs det gäller, och allt annat det här pluginet gör kring Minecraft.',

    'live' => 'Fråga servrarna vilka som spelar',
    'live_helper' => 'Lägger en levande lista över de anslutna på Spelare-sidan, med samma handskakning som Minecraft-klienten gör för att rita en server i sin egen lista. Av som standard, för det är det enda här som öppnar en anslutning från panelen rakt till en spelport: ligger panelen och dina noder på nät som inte når varandra svarar ingenting, och raden dyker helt enkelt inte upp. På själva spelservern behöver ingenting slås på.',

    'eggs' => 'Vilka eggs är Minecraft',
    'eggs_helper' => 'Kryssa i de eggs som kör en Minecraft-server - Vanilla, Paper, Purpur, Fabric, Forge, och vad dina annars heter. Sidan dyker upp inne i de servrar som använder dem, och ingen annanstans. Ingenting är ikryssat till att börja med, och det är med flit: ett plugin kan inte veta vad du har döpt dina eggs till, och en gissad lista vore fel på någons panel redan den vecka den kom ut.',

    /* ------------------------------------------------------ serversidan -- */

    'groups' => [
        'general' => 'Servern',
        'players' => 'Spelare',
        'world' => 'Världen',
        'performance' => 'Prestanda',
        'access' => 'Åtkomst och extra',
        'other' => 'Allt annat i filen',
    ],

    'other_helper' => 'Läst ur server.properties och lämnat precis som det är. Mods och modpacks lägger sina egna inställningar här; de visas så att du ser att de finns, och de ändras via filhanteraren. Att spara den här sidan rör dem aldrig.',

    'reload' => 'Läs filen igen',

    'saved' => 'Sparat i server.properties',
    'saved_helper' => 'Det träder i kraft nästa gång servern startar.',

    'running' => 'Servern kör',
    'running_helper' => 'Minecraft läser server.properties när den startar och skriver tillbaka den när den stoppar, så något som sparas nu skulle skrivas över på vägen ut. Stoppa servern och spara om.',

    'missing' => 'Hittade ingen server.properties',
    'missing_helper' => 'Filen dyker upp när servern startas första gången. Starta den en gång, och kom sedan tillbaka.',

    'failed' => 'Det gick inte att spara',
    'failed_helper' => 'Daemonen nekade skrivningen. Servern kan ha startat medan den här sidan var öppen.',

    /* -------------------------------------- vad varje nyckel betyder ----- */

    'keys' => [
        'motd' => 'Meddelande i serverlistan',
        'gamemode' => 'Spelläge',
        'difficulty' => 'Svårighetsgrad',
        'hardcore' => 'Hardcore - döden är slutgiltig',
        'force_gamemode' => 'Sätt alla tillbaka till standardläget när de kommer in',
        'pvp' => 'Spelare kan skada varandra',

        'max_players' => 'Flest spelare samtidigt',
        'white_list' => 'Bara whitelist',
        'enforce_whitelist' => 'Kasta ut alla som inte står på whitelisten',
        'online_mode' => 'Kontrollera konton hos Mojang',
        'player_idle_timeout' => 'Kasta ut efter så här många minuter utan aktivitet',
        'op_permission_level' => 'Vad en operator får göra (1–4)',

        'level_name' => 'Världsmapp',
        'level_seed' => 'Seed',
        'level_type' => 'Världstyp',
        'allow_nether' => 'The Nether',
        'spawn_monsters' => 'Monster dyker upp',
        'spawn_protection' => 'Skyddade block runt spawn',

        'view_distance' => 'Siktavstånd i chunks',
        'simulation_distance' => 'Simuleringsavstånd i chunks',
        'max_tick_time' => 'Watchdog, i millisekunder (-1 stänger av den)',
        'sync_chunk_writes' => 'Skriv chunks rakt till disk',

        'enable_command_block' => 'Kommandoblock',
        'allow_flight' => 'Tillåt att flyga',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'Adress till resource pack',
        'require_resource_pack' => 'Resource pack krävs',
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
