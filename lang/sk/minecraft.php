<?php

/*
 * Slovenčina. Písané ručne.
 *
 * Herné režimy a obtiažnosti sa neprekladajú. Minecraft ich v samotnej hre
 * ukazuje ako Survival, Creative, Peaceful a Hard — a nastavenie pomenované
 * inak ako obrazovka, z ktorej pochádza, je nastavenie, ktoré sa hľadá dvakrát.
 *
 * To isté platí pre pojmy, ktoré stoja priamo v server.properties: whitelist,
 * operator, seed, chunk, RCON, query, resource pack a Nether.
 */

return [
    /* --------------------------------------------- karta administrátora -- */

    'nav_label' => 'Minecraft',
    'title' => 'Nastavenia Minecraftu',
    'subheading' => 'server.properties tohto servera — ako formulár namiesto textového súboru.',

    /*
     * Samotný nadpis tu nie je. Každá sekcia nastavení berie nadpis zo
     * settings.groups.<meno>, a to stavia group().
     */
    'section_helper' => 'Na ktoré eggs sa to vzťahuje a všetko ostatné, čo tento plugin okolo Minecraftu robí.',

    'live' => 'Pýtať sa serverov, kto hrá',
    'live_helper' => 'Pridá na stránku Hráči živý zoznam pripojených, tým istým handshakom, akým klient Minecraftu kreslí server vo vlastnom zozname. V predvolenom stave vypnuté, lebo je to jediná vec tu, ktorá otvára spojenie z panela rovno na herný port: keď panel a uzly stoja v sieťach, ktoré na seba nedosiahnu, nikto neodpovie a riadok sa jednoducho neobjaví. Na samotnom hernom serveri netreba zapínať nič.',

    'eggs' => 'Ktoré eggs sú Minecraft',
    'eggs_helper' => 'Zaškrtnite eggs, ktoré spúšťajú server Minecraftu — Vanilla, Paper, Purpur, Fabric, Forge a akokoľvek sa volajú tie vaše. Stránka sa objaví vnútri serverov, ktoré ich používajú, a nikde inde. Na začiatku nie je zaškrtnuté nič, a to naschvál: plugin nemôže vedieť, ako ste svoje eggs pomenovali, a uhádnutý zoznam by bol na niečom paneli zlý už ten týždeň, keď vyšiel.',

    /* ------------------------------------------------- stránka servera --- */

    'groups' => [
        'general' => 'Server',
        'players' => 'Hráči',
        'world' => 'Svet',
        'performance' => 'Výkon',
        'access' => 'Prístup a doplnky',
        'other' => 'Všetko ostatné v súbore',
    ],

    'other_helper' => 'Načítané zo server.properties a ponechané presne tak, ako je. Mody a modpacky si sem ukladajú vlastné nastavenia; ukazujú sa, aby ste vedeli, že existujú, a menia sa cez správcu súborov. Uloženie tejto stránky sa ich nikdy nedotkne.',

    'reload' => 'Načítať súbor znova',

    'saved' => 'Uložené do server.properties',
    'saved_helper' => 'Začne platiť pri najbližšom spustení servera.',

    'running' => 'Server beží',
    'running_helper' => 'Minecraft číta server.properties pri štarte a pri zastavení ho zapisuje späť, takže to, čo by sa uložilo teraz, by sa cestou von prepísalo. Zastavte server a uložte znova.',

    'missing' => 'Žiadny server.properties sa nenašiel',
    'missing_helper' => 'Súbor sa objaví, keď sa server prvýkrát spustí. Raz ho spustite a vráťte sa sem.',

    'failed' => 'Nepodarilo sa uložiť',
    'failed_helper' => 'Daemon zápis odmietol. Server možno nabehol, kým bola táto stránka otvorená.',

    /* --------------------------------------- čo ktorý kľúč znamená ------- */

    'keys' => [
        'motd' => 'Správa v zozname serverov',
        'gamemode' => 'Herný režim',
        'difficulty' => 'Obtiažnosť',
        'hardcore' => 'Hardcore — smrť je definitívna',
        'force_gamemode' => 'Pri pripojení vrátiť všetkých do predvoleného režimu',
        'pvp' => 'Hráči si môžu ubližovať',

        'max_players' => 'Najviac hráčov naraz',
        'white_list' => 'Len whitelist',
        'enforce_whitelist' => 'Vyhodiť každého, kto nie je na whiteliste',
        'online_mode' => 'Overovať účty u Mojangu',
        'player_idle_timeout' => 'Vyhodiť po toľkých minútach nečinnosti',
        'op_permission_level' => 'Čo smie operator (1–4)',

        'level_name' => 'Priečinok sveta',
        'level_seed' => 'Seed',
        'level_type' => 'Typ sveta',
        'allow_nether' => 'Nether',
        'spawn_monsters' => 'Objavujú sa príšery',
        'spawn_protection' => 'Chránené bloky okolo spawnu',

        'view_distance' => 'Dohľadnosť v chunkoch',
        'simulation_distance' => 'Dosah simulácie v chunkoch',
        'max_tick_time' => 'Watchdog, v milisekundách (-1 vypína)',
        'sync_chunk_writes' => 'Zapisovať chunky rovno na disk',

        'enable_command_block' => 'Príkazové bloky',
        'allow_flight' => 'Povoliť lietanie',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'Adresa resource packu',
        'require_resource_pack' => 'Resource pack je povinný',
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
