<?php

/*
 * Polski. Napisane ręcznie.
 *
 * Tryby gry i poziomy trudności nie są tłumaczone. Minecraft pokazuje je w
 * samej grze jako Survival, Creative, Peaceful i Hard — a ustawienie nazwane
 * inaczej niż ekran, z którego pochodzi, to ustawienie, którego szuka się dwa
 * razy.
 *
 * To samo dotyczy terminów, które stoją w samym server.properties: whitelist,
 * operator, seed, chunk, RCON, query, resource pack i Nether.
 */

return [
    /* ------------------------------------------------ zakładka admina ---- */

    'nav_label' => 'Minecraft',
    'title' => 'Ustawienia Minecrafta',
    'subheading' => 'Plik server.properties tego serwera, jako formularz zamiast pliku tekstowego.',

    /*
     * Samego nagłówka tu nie ma. Każda sekcja ustawień bierze tytuł z
     * settings.groups.<nazwa>, a to buduje group().
     */
    'section_helper' => 'Do których eggów to się stosuje i wszystko inne, co ta wtyczka robi wokół Minecrafta.',

    'live' => 'Pytaj serwery, kto gra',
    'live_helper' => 'Dodaje do strony Gracze listę na żywo tych, którzy są połączeni, tym samym handshakiem, jaki wykonuje klient Minecrafta, żeby narysować serwer na własnej liście. Domyślnie wyłączone, bo to jedyna rzecz tutaj, która otwiera połączenie z panelu prosto do portu gry: jeśli panel i węzły są w sieciach, które się nie widzą, nic nie odpowie i wiersz po prostu się nie pojawi. Na samym serwerze gry nie trzeba niczego włączać.',

    'eggs' => 'Które eggi to Minecraft',
    'eggs_helper' => 'Zaznacz eggi, które uruchamiają serwer Minecrafta — Vanilla, Paper, Purpur, Fabric, Forge i jakkolwiek nazywają się Twoje. Strona pojawia się w serwerach, które ich używają, i nigdzie indziej. Na początku nic nie jest zaznaczone i to celowo: wtyczka nie może wiedzieć, jak nazwałeś swoje eggi, a zgadnięta lista byłaby błędna na czyimś panelu już w tygodniu, w którym wyszła.',

    /* --------------------------------------------------- strona serwera -- */

    'groups' => [
        'general' => 'Serwer',
        'players' => 'Gracze',
        'world' => 'Świat',
        'performance' => 'Wydajność',
        'access' => 'Dostęp i dodatki',
        'other' => 'Cała reszta pliku',
    ],

    'other_helper' => 'Czytane z server.properties i zostawione dokładnie tak, jak jest. Mody i modpacki wpisują tu własne ustawienia; są pokazywane, żebyś wiedział, że istnieją, a zmienia się je przez menedżer plików. Zapis tej strony nigdy ich nie rusza.',

    'reload' => 'Wczytaj plik jeszcze raz',

    'saved' => 'Zapisano do server.properties',
    'saved_helper' => 'Zadziała przy następnym uruchomieniu serwera.',

    'running' => 'Serwer działa',
    'running_helper' => 'Minecraft czyta server.properties przy starcie i zapisuje go z powrotem przy zatrzymaniu, więc to, co zapisano by teraz, zostałoby przy wyjściu nadpisane. Zatrzymaj serwer i zapisz ponownie.',

    'missing' => 'Nie znaleziono server.properties',
    'missing_helper' => 'Plik pojawia się, gdy serwer zostanie uruchomiony po raz pierwszy. Uruchom go raz i wróć tutaj.',

    'failed' => 'Nie udało się zapisać',
    'failed_helper' => 'Daemon odrzucił zapis. Serwer mógł wystartować, gdy ta strona była otwarta.',

    /* --------------------------------------- co znaczy każdy z kluczy ---- */

    'keys' => [
        'motd' => 'Wiadomość na liście serwerów',
        'gamemode' => 'Tryb gry',
        'difficulty' => 'Poziom trudności',
        'hardcore' => 'Hardcore — śmierć jest ostateczna',
        'force_gamemode' => 'Przy wejściu wracaj wszystkim do trybu domyślnego',
        'pvp' => 'Gracze mogą się nawzajem ranić',

        'max_players' => 'Najwięcej graczy naraz',
        'white_list' => 'Tylko whitelist',
        'enforce_whitelist' => 'Wyrzucaj każdego spoza whitelisty',
        'online_mode' => 'Sprawdzaj konta u Mojanga',
        'player_idle_timeout' => 'Wyrzucaj po tylu minutach bezczynności',
        'op_permission_level' => 'Co może operator (1–4)',

        'level_name' => 'Katalog świata',
        'level_seed' => 'Seed',
        'level_type' => 'Typ świata',
        'allow_nether' => 'Nether',
        'spawn_monsters' => 'Pojawiają się potwory',
        'spawn_protection' => 'Chronione bloki wokół spawnu',

        'view_distance' => 'Zasięg widzenia w chunkach',
        'simulation_distance' => 'Zasięg symulacji w chunkach',
        'max_tick_time' => 'Watchdog, w milisekundach (-1 wyłącza)',
        'sync_chunk_writes' => 'Zapisuj chunki prosto na dysk',

        'enable_command_block' => 'Bloki poleceń',
        'allow_flight' => 'Pozwól latać',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'Adres resource packa',
        'require_resource_pack' => 'Resource pack jest obowiązkowy',
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
