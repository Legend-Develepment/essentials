<?php

/*
 * Italiano. Scritto a mano.
 *
 * Le modalità di gioco e le difficoltà non sono tradotte. Minecraft le mostra
 * dentro il gioco come Survival, Creative, Peaceful e Hard - e un'impostazione
 * con un nome diverso da quello della schermata da cui viene è
 * un'impostazione da cercare due volte.
 *
 * Lo stesso vale per i termini che stanno nel server.properties stesso:
 * whitelist, operator, seed, chunk, RCON, query, resource pack e il Nether.
 */

return [
    /* ------------------------------------------------ la scheda admin ---- */

    'nav_label' => 'Minecraft',
    'title' => 'Impostazioni di Minecraft',
    'subheading' => 'Il server.properties di questo server, come modulo invece che come file di testo.',

    /*
     * Il titolo in sé non è qui. Ogni sezione di impostazioni prende il titolo
     * da settings.groups.<nome>, che è quello che group() costruisce.
     */
    'section_helper' => 'A quali egg si applica, e tutto il resto che questo plugin fa attorno a Minecraft.',

    'live' => 'Chiedi ai server chi sta giocando',
    'live_helper' => 'Aggiunge alla pagina Giocatori un elenco in diretta di chi è collegato, con lo stesso handshake che il client di Minecraft fa per disegnare un server nella propria lista. Spento di default perché è l\'unica cosa qui che apre una connessione dal pannello direttamente a una porta di gioco: se il tuo pannello e i tuoi nodi stanno su reti che non si raggiungono, non risponde nulla e la riga semplicemente non compare. Sul server di gioco non c\'è nulla da attivare.',

    'eggs' => 'Quali egg sono Minecraft',
    'eggs_helper' => 'Spunta gli egg che fanno girare un server Minecraft - Vanilla, Paper, Purpur, Fabric, Forge, e comunque si chiamino i tuoi. La pagina compare dentro i server che li usano, e da nessun\'altra parte. All\'inizio non c\'è nulla di spuntato, ed è voluto: un plugin non può sapere che nomi hai dato ai tuoi egg, e una lista indovinata sarebbe sbagliata sul pannello di qualcuno già nella settimana in cui esce.',

    /* ---------------------------------------------- la pagina del server - */

    'groups' => [
        'general' => 'Il server',
        'players' => 'Giocatori',
        'world' => 'Il mondo',
        'performance' => 'Prestazioni',
        'access' => 'Accesso ed extra',
        'other' => 'Tutto il resto del file',
    ],

    'other_helper' => 'Letto dal server.properties e lasciato esattamente com\'è. Le mod e i modpack mettono qui le proprie impostazioni; sono mostrate perché tu veda che esistono, e si cambiano dal gestore file. Salvare questa pagina non le tocca mai.',

    'reload' => 'Rileggi il file',

    'saved' => 'Salvato nel server.properties',
    'saved_helper' => 'Vale dal prossimo avvio del server.',

    'running' => 'Il server è in esecuzione',
    'running_helper' => 'Minecraft legge il server.properties all\'avvio e lo riscrive quando si ferma, quindi ciò che venisse salvato adesso verrebbe sovrascritto in uscita. Ferma il server e salva di nuovo.',

    'missing' => 'Nessun server.properties trovato',
    'missing_helper' => 'Il file compare quando il server viene avviato la prima volta. Avvialo una volta, poi torna qui.',

    'failed' => 'Non è stato possibile salvare',
    'failed_helper' => 'Il daemon ha rifiutato la scrittura. Il server potrebbe essere partito mentre questa pagina era aperta.',

    /* -------------------------------- cosa significa ciascuna chiave ----- */

    'keys' => [
        'motd' => 'Messaggio nella lista dei server',
        'gamemode' => 'Modalità di gioco',
        'difficulty' => 'Difficoltà',
        'hardcore' => 'Hardcore - la morte è definitiva',
        'force_gamemode' => 'Rimetti tutti nella modalità predefinita all\'ingresso',
        'pvp' => 'I giocatori possono ferirsi tra loro',

        'max_players' => 'Massimo di giocatori insieme',
        'white_list' => 'Solo whitelist',
        'enforce_whitelist' => 'Espelli chi non è in whitelist',
        'online_mode' => 'Verifica gli account con Mojang',
        'player_idle_timeout' => 'Espelli dopo tot minuti di inattività',
        'op_permission_level' => 'Cosa può fare un operator (1–4)',

        'level_name' => 'Cartella del mondo',
        'level_seed' => 'Seed',
        'level_type' => 'Tipo di mondo',
        'allow_nether' => 'Il Nether',
        'spawn_monsters' => 'Compaiono i mostri',
        'spawn_protection' => 'Blocchi protetti attorno allo spawn',

        'view_distance' => 'Distanza di visuale in chunk',
        'simulation_distance' => 'Distanza di simulazione in chunk',
        'max_tick_time' => 'Watchdog, in millisecondi (-1 lo spegne)',
        'sync_chunk_writes' => 'Scrivi i chunk direttamente su disco',

        'enable_command_block' => 'Blocchi comando',
        'allow_flight' => 'Consenti di volare',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'Indirizzo del resource pack',
        'require_resource_pack' => 'Il resource pack è obbligatorio',
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
