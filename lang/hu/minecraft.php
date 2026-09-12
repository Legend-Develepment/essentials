<?php

/*
 * Magyar. Kézzel írva.
 *
 * A játékmódokat és a nehézségi fokozatokat nem fordítjuk. A Minecraft a
 * játékon belül Survival, Creative, Peaceful és Hard néven mutatja őket - és
 * egy beállítás, amelynek más a neve, mint annak a képernyőnek, ahonnan
 * származik, olyan, amelyet kétszer keres ki az ember.
 *
 * Ugyanez áll azokra a kifejezésekre, amelyek magában a server.properties
 * fájlban állnak: whitelist, operator, seed, chunk, RCON, query, resource pack
 * és the Nether.
 */

return [
    /* ----------------------------------------------------- az admin fül -- */

    'nav_label' => 'Minecraft',
    'title' => 'Minecraft-beállítások',
    'subheading' => 'Ennek a szervernek a saját server.properties fájlja, űrlapként szövegfájl helyett.',

    /*
     * Maga a cím nincs itt. Minden beállításszakasz a settings.groups.<név>
     * kulcsból veszi a címét, amit a group() épít fel.
     */
    'section_helper' => 'Mely eggekre vonatkozik, és minden más, amit ez a bővítmény a Minecraft körül tesz.',

    'live' => 'Kérdezd meg a szervereket, kik játszanak',
    'live_helper' => 'Élő listát tesz a csatlakozottakról a Játékosok oldalra, ugyanazzal a kézfogással, amellyel a Minecraft-kliens rajzol ki egy szervert a saját listáján. Alapból ki, mert ez itt az egyetlen dolog, amely a paneltől közvetlenül egy játékporthoz nyit kapcsolatot: ha a paneled és a node-jaid olyan hálózatokon vannak, amelyek nem érik el egymást, semmi sem válaszol, és a sor egyszerűen nem jelenik meg. Magán a játékszerveren semmit sem kell bekapcsolni.',

    'eggs' => 'Mely eggek a Minecraft',
    'eggs_helper' => 'Pipáld ki azokat az eggeket, amelyek Minecraft-szervert futtatnak - Vanilla, Paper, Purpur, Fabric, Forge, és ahogy a tieidet egyébként hívják. Az oldal az ezeket használó szervereken belül jelenik meg, és sehol máshol. Kezdetben semmi sincs kipipálva, és ez szándékos: egy bővítmény nem tudhatja, minek nevezted el az eggjeidet, és egy kitalált lista már a megjelenése hetében rossz lenne valakinek a panelén.',

    /* ---------------------------------------------------- a szerver oldala */

    'groups' => [
        'general' => 'A szerver',
        'players' => 'Játékosok',
        'world' => 'A világ',
        'performance' => 'Teljesítmény',
        'access' => 'Hozzáférés és extrák',
        'other' => 'Minden más a fájlban',
    ],

    'other_helper' => 'A server.properties fájlból olvasva és pontosan úgy hagyva, ahogy van. A modok és a modpackok ide teszik a saját beállításaikat; azért látszanak, hogy lásd, léteznek, és a fájlkezelőn keresztül lehet őket módosítani. Ennek az oldalnak a mentése soha nem nyúl hozzájuk.',

    'reload' => 'Olvasd újra a fájlt',

    'saved' => 'Elmentve a server.properties fájlba',
    'saved_helper' => 'A szerver következő indításakor lép életbe.',

    'running' => 'A szerver fut',
    'running_helper' => 'A Minecraft indításkor olvassa a server.properties fájlt, és leálláskor visszaírja, tehát amit most mentesz, azt kilépéskor felülírná. Állítsd le a szervert, és ments újra.',

    'missing' => 'Nem található server.properties',
    'missing_helper' => 'A fájl akkor jelenik meg, amikor a szervert először elindítják. Indítsd el egyszer, és gyere vissza.',

    'failed' => 'Nem sikerült menteni',
    'failed_helper' => 'A daemon elutasította az írást. Lehet, hogy a szerver elindult, amíg ez az oldal nyitva volt.',

    /* ----------------------------------------- mit jelent az egyes kulcsok */

    'keys' => [
        'motd' => 'Üzenet a szerverlistán',
        'gamemode' => 'Játékmód',
        'difficulty' => 'Nehézség',
        'hardcore' => 'Hardcore - a halál végleges',
        'force_gamemode' => 'Belépéskor mindenkit vissza az alapmódba',
        'pvp' => 'A játékosok sérthetik egymást',

        'max_players' => 'Legfeljebb ennyi játékos egyszerre',
        'white_list' => 'Csak whitelist',
        'enforce_whitelist' => 'Dobj ki mindenkit, aki nincs a whitelisten',
        'online_mode' => 'Ellenőrizd a fiókokat a Mojangnál',
        'player_idle_timeout' => 'Dobj ki ennyi tétlen perc után',
        'op_permission_level' => 'Mit tehet egy operator (1–4)',

        'level_name' => 'Világmappa',
        'level_seed' => 'Seed',
        'level_type' => 'Világtípus',
        'allow_nether' => 'The Nether',
        'spawn_monsters' => 'Szörnyek jelennek meg',
        'spawn_protection' => 'Védett blokkok a spawn körül',

        'view_distance' => 'Látótávolság chunkokban',
        'simulation_distance' => 'Szimulációs távolság chunkokban',
        'max_tick_time' => 'Watchdog, ezredmásodpercben (a -1 kikapcsolja)',
        'sync_chunk_writes' => 'Írd a chunkokat egyenesen lemezre',

        'enable_command_block' => 'Parancsblokkok',
        'allow_flight' => 'Repülés engedélyezése',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'A resource pack címe',
        'require_resource_pack' => 'A resource pack kötelező',
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
