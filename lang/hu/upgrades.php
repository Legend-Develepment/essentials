<?php

/*
 * Magyar. Kézzel írva.
 *
 * Egy futó szolgáltatás átvitele az egyik csomagról a másikra.
 *
 * A szövegek végig egy dolgot tartanak külön: az, hogy egy csomag mennyibe
 * kerül, és az, hogy a rá váltás ma mennyibe kerül, két különböző szám. Az
 * első a polcon van; a második attól függ, hol tart ez a szolgáltatás a
 * kifizetett időszakban, és ehhez mond igent az, aki megnyomja a gombot.
 *
 * Az „upgrade” szó nem szerepel abban, amit a vásárló olvas, mert ezeknek a
 * váltásoknak a fele lefelé megy. Itt csere a neve.
 */

return [
    // ---- a szolgáltatás kártyáján ----------------------------------------
    'change' => 'Csomag cseréje',
    'change_body' => 'A már kifizetett időszakodból hátralévő rész lejön, és ugyanazokat a napokat az új áron számoljuk. A szerveredről semmi sem vész el.',
    'change_to' => 'Váltás erre: :name',
    'change_confirm' => 'Lecseréled ezt a szolgáltatást erre: :name?',
    'change_free' => 'Nincs mit fizetni',
    'costs_now' => 'most :amount',
    'gives_back' => ':amount vissza',
    'waiting' => 'Csere elfogadva',
    'waiting_for' => 'Egy :name csomagra váltás egy kifizetetlen számlára vár.',

    // ---- mi történik utána -----------------------------------------------
    'done' => 'Átkerült ide: :name',
    'done_body' => 'A szolgáltatásod az új csomagon van. Ami visszajárt, az az egyenlegeden van.',
    'refused' => 'A csere nem történt meg',

    // ---- és hogy miért nem, egyszerre egy ok -----------------------------
    'refused_off' => 'A csomagcsere ezen a panelen ki van kapcsolva.',
    'refused_not_active' => 'Csak futó szolgáltatást lehet lecserélni. Egy várakozón, felfüggesztetten vagy véget érőn nincs mit elszámolni.',
    'refused_gone' => 'A csomag, amelyen ez a szolgáltatás van, már nem létezik, tehát nincs mihez hasonlítani.',
    'refused_same' => 'Ez az a csomag, amelyen már rajta van.',
    'refused_egg' => 'Az a csomag más szoftvert futtat. Nem nagyobb szerver lenne belőle, hanem másik, tehát azt külön kell megvenni.',
    'refused_period' => 'Azt a csomagot más időszakonként számlázzuk, és az nem nagyobb megállapodás, hanem másik.',
    'refused_stock' => 'Az a csomag elfogyott.',
    'refused_waiting' => 'Ehhez a szolgáltatáshoz már vár egy csere egy kifizetetlen számlára. Előbb azt fizesd ki vagy mondd le.',
    'refused_failed' => 'Semmi sem íródott le, tehát semmi sem változott. Próbáld újra, és ha továbbra is előfordul, szólj annak, aki ezt a panelt üzemelteti.',
    'refused_server' => 'A szerver nem kapta meg az új korlátokat, így a szolgáltatás pontosan úgy maradt, ahogy volt. Aki ezt a panelt üzemelteti, értesítést kapott.',

    // ---- mit mondanak a dokumentumok -------------------------------------
    'line' => 'Csere erről: :from erre: :to, az időszakból hátralévő :days napra',
    'credit_reason' => 'Váltás erre: :name',

    // ---- és mit hall a tulajdonos ----------------------------------------
    'bell_failed' => 'Egy csomagcsere meghiúsult a(z) :number rendelésen',
    'cold_title' => 'Egy csomagcsere eljutott a panelig, a node-ig nem, a(z) :number rendelésen',
    'cold_body' => 'A szolgáltatás a(z) :name csomagon van, és az új korlátok rögzítve vannak. A node még nem vette át őket, és akkor olvassa be, amikor az a szerver legközelebb elindul, tehát addig a vásárlónál még a régi méret van. Nézd meg a node-ot.',
    'gone' => 'A csomag, amelyre a váltás ment volna, már nem létezik.',
    'refused_by_node' => 'A szerver nem fogadta el az új korlátokat: :why',

    // ---- helyrehozni egyet -----------------------------------------------
    'retry' => 'Csere újrapróbálása',
    'retry_confirm' => 'Próbáld újra a csomagcserét. A hozzá tartozó számla már ki van fizetve, tehát semmit nem számlázunk kétszer.',
    'retried' => 'A csere sikerült',
    'retry_failed' => 'Ismét meghiúsult. Az ok a rendelésen van.',
];
