<?php

/*
 * Română. Scrisă de mână.
 *
 * Modurile de joc și nivelurile de dificultate nu se traduc. Minecraft le arată
 * în joc drept Survival, Creative, Peaceful și Hard - iar o setare care se
 * numește altfel decât ecranul din care vine este una pe care o cauți de două
 * ori.
 *
 * La fel și expresiile care stau chiar în server.properties: whitelist,
 * operator, seed, chunk, RCON, query, resource pack și the Nether.
 */

return [
    /* ------------------------------------------- fila de administrare ---- */

    'nav_label' => 'Minecraft',
    'title' => 'Setări Minecraft',
    'subheading' => 'Chiar server.properties al acestui server, ca formular în loc de fișier text.',

    /*
     * Titlul însuși nu este aici. Fiecare secțiune de setări își ia titlul din
     * settings.groups.<nume>, pe care îl construiește group().
     */
    'section_helper' => 'La care egg-uri se aplică și tot ce mai face acest plugin în jurul Minecraft.',

    'live' => 'Întreabă serverele cine joacă',
    'live_helper' => 'Adaugă o listă vie a celor conectați în pagina Jucători, cu aceeași strângere de mână pe care o face clientul Minecraft ca să deseneze un server în propria lui listă. Oprit din start, pentru că este singurul lucru de aici care deschide o conexiune de la panou direct către un port de joc: dacă panoul și node-urile tale sunt în rețele care nu ajung una la cealaltă, nu răspunde nimic, iar rândul pur și simplu nu apare. Pe serverul de joc nu trebuie pornit nimic.',

    'eggs' => 'Care egg-uri sunt Minecraft',
    'eggs_helper' => 'Bifează egg-urile care rulează un server Minecraft - Vanilla, Paper, Purpur, Fabric, Forge, și cum le-oi mai fi numit pe ale tale. Pagina apare în interiorul serverelor care le folosesc și nicăieri altundeva. La început nu este nimic bifat, și asta intenționat: un plugin nu poate ști cum ți-ai numit egg-urile, iar o listă ghicită ar fi greșită pe panoul cuiva chiar din săptămâna lansării.',

    /* ------------------------------------------------ pagina serverului -- */

    'groups' => [
        'general' => 'Serverul',
        'players' => 'Jucători',
        'world' => 'Lumea',
        'performance' => 'Performanță',
        'access' => 'Acces și suplimente',
        'other' => 'Tot restul din fișier',
    ],

    'other_helper' => 'Citit din server.properties și lăsat exact cum este. Modurile și modpack-urile își pun aici propriile setări; se arată ca să vezi că există și se schimbă prin managerul de fișiere. Salvarea acestei pagini nu se atinge niciodată de ele.',

    'reload' => 'Citește fișierul din nou',

    'saved' => 'Salvat în server.properties',
    'saved_helper' => 'Intră în vigoare la următoarea pornire a serverului.',

    'running' => 'Serverul rulează',
    'running_helper' => 'Minecraft citește server.properties la pornire și îl scrie înapoi la oprire, deci ce s-ar salva acum ar fi suprascris la ieșire. Oprește serverul și salvează din nou.',

    'missing' => 'Nu s-a găsit niciun server.properties',
    'missing_helper' => 'Fișierul apare când serverul este pornit prima oară. Pornește-l o dată și revino.',

    'failed' => 'Nu s-a putut salva',
    'failed_helper' => 'Daemonul a refuzat scrierea. Se poate ca serverul să fi pornit cât timp pagina era deschisă.',

    /* -------------------------------------- ce înseamnă fiecare cheie ---- */

    'keys' => [
        'motd' => 'Mesaj în lista de servere',
        'gamemode' => 'Mod de joc',
        'difficulty' => 'Dificultate',
        'hardcore' => 'Hardcore - moartea este definitivă',
        'force_gamemode' => 'Pune-i pe toți înapoi în modul implicit la intrare',
        'pvp' => 'Jucătorii se pot răni între ei',

        'max_players' => 'Cel mult atâția jucători deodată',
        'white_list' => 'Doar whitelist',
        'enforce_whitelist' => 'Dă afară pe oricine nu este pe whitelist',
        'online_mode' => 'Verifică conturile la Mojang',
        'player_idle_timeout' => 'Dă afară după atâtea minute de inactivitate',
        'op_permission_level' => 'Ce poate face un operator (1–4)',

        'level_name' => 'Folderul lumii',
        'level_seed' => 'Seed',
        'level_type' => 'Tipul lumii',
        'allow_nether' => 'The Nether',
        'spawn_monsters' => 'Apar monștri',
        'spawn_protection' => 'Blocuri protejate în jurul spawn-ului',

        'view_distance' => 'Distanța de vedere în chunk-uri',
        'simulation_distance' => 'Distanța de simulare în chunk-uri',
        'max_tick_time' => 'Watchdog, în milisecunde (-1 îl oprește)',
        'sync_chunk_writes' => 'Scrie chunk-urile direct pe disc',

        'enable_command_block' => 'Blocuri de comandă',
        'allow_flight' => 'Permite zborul',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'Adresa pachetului de resurse',
        'require_resource_pack' => 'Pachetul de resurse este obligatoriu',
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
