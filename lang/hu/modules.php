<?php

/*
 * Magyar. Kézzel írva.
 *
 * A modulok oldala.
 *
 * Saját fájl, nem a settings.php egyik sarka, ami már most is a bővítmény
 * legnagyobb nyelvi fájlja.
 */

return [
    'title' => 'Modulok',
    'nav_label' => 'Modulok',
    'subheading' => 'Mi ez a bővítmény ezen a panelen. Itt minden kikapcsolható, és a kikapcsolás soha nem törli azt, amit már feljegyzett.',

    'first_title' => 'Mire való ez a panel?',
    'first_helper' => 'Válaszolj egyszer, és a hozzá illő részek bekapcsolnak. Semmi nem dől el vele: alább minden kapcsoló a tiéd marad, és valamit kikapcsolni soha nem törli azt, amit már feljegyzett.',
    'first_look' => 'Főleg ahogy kinéz',
    'first_look_helper' => 'Színek, a bejelentkezőképernyő, a közlemények, a saját hivatkozásaid és az oldalak, ahol ezeket módosítod. Semmi, ami elad, válaszol vagy kinyúlik.',
    'first_run' => 'Kiszolgálókat üzemeltetni, magamnak vagy egy csapatnak',
    'first_run_helper' => 'A kinézet, plusz hogy mit mutat egy kiszolgáló és mi telt meg vagy állt le. Bolt nélkül, jegypult nélkül, és bármi nélkül, ami időzítve levelet küld.',
    'first_sell' => 'Tárhelyet eladni ügyfeleknek',
    'first_sell_helper' => 'Mindet. Egy bolt, ahol nincs hol válaszolni a kérdésekre, és nincs semmi, ami a node-okat figyeli, fél bolt.',
    'first_skip' => 'Majd én választom ki',

    'first_left' => 'Úgy hagyva. A kapcsolók mind lentebb vannak.',
    'go' => 'Állítsd be',

    'state_on' => 'Be',
    'state_part' => 'Részben be',
    'state_off' => 'Ki',

    'count' => '{1} :of részből :on bekapcsolva|[2,*] :of részből :on bekapcsolva',
    'parts' => '{1} Az egyetlen rész|[2,*] Mind a :count rész',

    'health_tables' => 'A táblái még nincsenek meg. Bármit menteni ezen az oldalon létrehozza őket.',
    'health_missing' => '{1} Egy résznek kell valami, ami ki van kapcsolva|[2,*] :count résznek kell valami, ami ki van kapcsolva',
    'health_waiting' => '{1} Egy rész be van kapcsolva, és még nem mutat semmit|[2,*] :count rész be van kapcsolva, és még nem mutat semmit',

    'left_access' => '{1} Egy embernek még van innen adott kiszolgálója|[2,*] :count embernek még van innen adott kiszolgálója',
    'left_public_status' => '{1} Egy közzétett oldal és a címe megmarad|[2,*] :count közzétett oldal és a címük megmarad',
    'left_arranger' => '{1} Egy mentett elrendezés megmarad|[2,*] :count mentett elrendezés megmarad',
    'left_user_themes' => '{1} Egy ember választott stílusa megmarad|[2,*] :count ember választott stílusa megmarad',
    'left_unknown' => 'Maradt itt valami, és a panel nem tudta elolvasni, mennyi.',
    'cleared' => '{1} Egy visszavéve|[2,*] :count visszavéve',
    'clear_failed' => 'Ezt nem sikerült kitakarítani',

    'turn_on' => 'Bekapcsolás',
    'turn_off' => 'Kikapcsolás',

    'saved' => 'Mentve',
    'brought' => 'Vele együtt bekapcsolva, mert ezek nélkül itt semmi sem működik: :names.',
    'save_failed' => 'Ezt nem sikerült menteni',
    'read_only' => 'Ezt megnézheted, de nem módosíthatod. Ahhoz, hogy megváltoztasd, mit kínál a panel, a bővítményre vonatkozó tágabb jog kell.',
];
