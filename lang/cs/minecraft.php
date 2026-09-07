<?php

/*
 * Čeština. Psáno ručně.
 *
 * Herní režimy a obtížnosti se nepřekládají. Minecraft je v samotné hře ukazuje
 * jako Survival, Creative, Peaceful a Hard — a nastavení pojmenované jinak než
 * obrazovka, ze které pochází, je nastavení, které se hledá dvakrát.
 *
 * Totéž platí pro pojmy, které stojí přímo v server.properties: whitelist,
 * operator, seed, chunk, RCON, query, resource pack a Nether.
 */

return [
    /* --------------------------------------------- karta administrátora -- */

    'nav_label' => 'Minecraft',
    'title' => 'Nastavení Minecraftu',
    'subheading' => 'server.properties tohohle serveru — jako formulář místo textového souboru.',

    /*
     * Samotný nadpis tu není. Každá sekce nastavení bere nadpis ze
     * settings.groups.<jméno>, a to staví group().
     */
    'section_helper' => 'Na které eggs se to vztahuje a všechno ostatní, co tenhle plugin kolem Minecraftu dělá.',

    'live' => 'Ptát se serverů, kdo hraje',
    'live_helper' => 'Přidá na stránku Hráči živý seznam připojených, týmž handshakem, jakým klient Minecraftu kreslí server ve svém vlastním seznamu. Ve výchozím stavu vypnuto, protože je to jediná věc tady, která otevírá spojení z panelu rovnou na herní port: když panel a uzly stojí v sítích, které na sebe nedosáhnou, nikdo neodpoví a řádek se prostě neobjeví. Na samotném herním serveru není potřeba zapínat nic.',

    'eggs' => 'Které eggs jsou Minecraft',
    'eggs_helper' => 'Zaškrtněte eggs, které spouštějí server Minecraftu — Vanilla, Paper, Purpur, Fabric, Forge a jakkoli se jmenují ty vaše. Stránka se objeví uvnitř serverů, které je používají, a nikde jinde. Na začátku není zaškrtnuto nic, a to schválně: plugin nemůže vědět, jak jste své eggs pojmenovali, a uhodnutý seznam by byl na něčím panelu špatně už ten týden, kdy vyšel.',

    /* ------------------------------------------------- stránka serveru --- */

    'groups' => [
        'general' => 'Server',
        'players' => 'Hráči',
        'world' => 'Svět',
        'performance' => 'Výkon',
        'access' => 'Přístup a doplňky',
        'other' => 'Všechno ostatní v souboru',
    ],

    'other_helper' => 'Načteno ze server.properties a ponecháno přesně tak, jak je. Mody a modpacky si sem ukládají vlastní nastavení; ukazují se, abyste věděli, že existují, a mění se přes správce souborů. Uložení téhle stránky se jich nikdy nedotkne.',

    'reload' => 'Načíst soubor znovu',

    'saved' => 'Uloženo do server.properties',
    'saved_helper' => 'Začne platit při příštím spuštění serveru.',

    'running' => 'Server běží',
    'running_helper' => 'Minecraft čte server.properties při startu a při zastavení ho zapisuje zpátky, takže to, co by se uložilo teď, by se cestou ven přepsalo. Zastavte server a uložte znovu.',

    'missing' => 'Žádný server.properties se nenašel',
    'missing_helper' => 'Soubor se objeví, až se server poprvé spustí. Jednou ho spusťte a vraťte se sem.',

    'failed' => 'Nepodařilo se uložit',
    'failed_helper' => 'Daemon zápis odmítl. Server možná naběhl, zatímco byla tahle stránka otevřená.',

    /* --------------------------------------- co který klíč znamená ------- */

    'keys' => [
        'motd' => 'Zpráva v seznamu serverů',
        'gamemode' => 'Herní režim',
        'difficulty' => 'Obtížnost',
        'hardcore' => 'Hardcore — smrt je definitivní',
        'force_gamemode' => 'Při připojení vrátit všechny do výchozího režimu',
        'pvp' => 'Hráči si mohou ubližovat',

        'max_players' => 'Nejvíc hráčů najednou',
        'white_list' => 'Jen whitelist',
        'enforce_whitelist' => 'Vyhodit každého, kdo není na whitelistu',
        'online_mode' => 'Ověřovat účty u Mojangu',
        'player_idle_timeout' => 'Vyhodit po tolika minutách nečinnosti',
        'op_permission_level' => 'Co smí operator (1–4)',

        'level_name' => 'Složka světa',
        'level_seed' => 'Seed',
        'level_type' => 'Typ světa',
        'allow_nether' => 'Nether',
        'spawn_monsters' => 'Objevují se příšery',
        'spawn_protection' => 'Chráněné bloky okolo spawnu',

        'view_distance' => 'Dohlednost v chuncích',
        'simulation_distance' => 'Dosah simulace v chuncích',
        'max_tick_time' => 'Watchdog, v milisekundách (-1 vypíná)',
        'sync_chunk_writes' => 'Zapisovat chunky rovnou na disk',

        'enable_command_block' => 'Příkazové bloky',
        'allow_flight' => 'Povolit létání',
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
