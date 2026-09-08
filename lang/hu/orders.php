<?php

/*
 * Magyar. Kézzel írva.
 *
 * Rendelések: mit vett valaki, és mi lett belőle.
 *
 * A lenti négy állapot a pénzről szól, nem a szerverről. Hogy a szerver éppen
 * fut-e, az a Pelican saját kérdése, és a Pelican saját oldalain kap választ.
 * Az itteni szavak külön tartják a kettőt.
 */

return [
    'title' => 'Rendelések',
    'nav_label' => 'Rendelések',
    'subheading' => 'Minden, amit megvettek, a szerver, ami lett belőle, és hogy hol tart.',

    // ---- a táblázat ------------------------------------------------------
    'column_order' => 'Rendelés',
    'column_customer' => 'Vásárló',
    'column_package' => 'Csomag',
    'column_server' => 'Szerver',
    'column_state' => 'Állapot',
    'column_due' => 'Következő esedékesség',

    'no_server' => 'Még nincs megépítve',
    'no_due' => 'Egyszeri',
    'gone_customer' => 'Fiók törölve',
    'gone_package' => 'Csomag törölve',
    'overdue_days' => ':days napja lejárt',

    'state_pending' => 'Várakozik',
    'state_active' => 'Aktív',
    'state_suspended' => 'Felfüggesztve',
    'state_cancelled' => 'Lemondva',

    // ---- a gombok --------------------------------------------------------
    'retry' => 'Építés újra',
    'retry_confirm' => 'Még egyszer sorba állítja az építést. Semmi más nem változik, és a számla fizetett marad.',
    'retrying' => 'Sorba állítva',

    'suspend' => 'Felfüggesztés',
    'suspend_confirm' => 'Megállítja a szervert a Pelican saját felfüggesztésével. A fájlok, adatbázisok és mentések ott maradnak, ahol vannak, és a számla kifizetése feloldja.',
    'suspended' => 'Felfüggesztve',

    'unsuspend' => 'Felfüggesztés feloldása',
    'unsuspended' => 'Megint fut',

    'change_due' => 'Esedékesség módosítása',
    'change_due_helper' => 'Mikor íródik a következő számla. Üresen hagyva soha - a rendelés abbahagyja a megújulást anélkül, hogy le lenne mondva.',

    'cancel' => 'Lemondás',
    'cancel_confirm' => 'Leállítja a megújulásokat és visszaadja a helyet a készletben. A szerver marad: törölni a Pelicanban kell, ahová ez tartozik.',
    'cancelled' => 'Lemondva',

    'saved' => 'Mentve',
    'refused' => 'Semmi sem változott',
    'refused_body' => 'A rendelés nincs olyan állapotban, amiben ez menne. Töltsd újra az oldalt, és nézd meg még egyszer.',

    // ---- amit a vásárló hall ---------------------------------------------
    'bell_ready' => 'A szervered készen áll',
    'bell_ready_body' => 'A(z) :server létrejött, és arra vár, hogy elindítsd.',
    'bell_suspended' => 'A szervered fel lett függesztve',
    'bell_suspended_body' => 'Egy számla kifizetetlen maradt a türelmi időn túl is. A kifizetése újraindítja a szervert; semmi sem lett törölve.',

    // ---- amit az adminisztrátor hall -------------------------------------
    'bell_failed' => 'A(z) :number rendelést nem sikerült megépíteni',
    'no_allocation' => 'Ebben a csomagban egyetlen node-nak sincs szabad allocationje. Vegyél fel egyet, és építsd újra.',
    'no_reason' => 'A panel elutasította, de nem mondta meg, miért.',

    // ---- a szerver, ami lesz belőle --------------------------------------
    'server_description' => 'Boltban vásárolva, rendelés: :number.',
    'server_fallback' => 'Szerver',

    'empty' => 'Még semmit nem vettek',
    'empty_body' => 'A rendelések itt jelennek meg, amint valaki vesz egy csomagot.',
];
