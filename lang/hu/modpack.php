<?php

/*
 * Magyar. Kézzel írva.
 *
 * A „modpack”, „mod” és „loader” marad: ezek a Modrinth és a játék saját
 * szavai, és ezekre keres az ember.
 */

return [
    'nav_label' => 'Modpackok',
    'title' => 'Modpackok',
    'subheading' => 'Telepíts egy modpackot a Modrinthről erre a szerverre.',

    'section' => 'Keress egy packot',
    'section_helper' => 'Csak Modrinth, és csak szerveroldali packok. Nem kell hozzá fiók és API-kulcs, ezért ez itt az egyetlen forrás - a többi mind beillesztett kulcsot akar, mielőtt bármi megjelenne.',

    'search' => 'Keresés',
    'search_helper' => 'Hagyd üresen a legtöbbet letöltöttekért. A keresés a Modrintht kérdezi, ezért akkor történik, amikor kilépsz a mezőből, nem gépelés közben.',

    'pack' => 'Pack',
    'pack_helper' => 'Csak azok a packok szerepelnek, amelyek azt mondják, hogy szerveren futnak.',

    'version' => 'Verzió',
    'version_helper' => 'A játékverzió és a loader mindegyik mellett látszik. Válaszd azt a loadert, amelyet ennek a szervernek az eggje már futtat - ez fájlokat telepít, és nem változtatja meg sem az egget, sem az indítóparancsot.',

    'downloads' => 'letöltés',

    'install' => 'Telepítsd ezt a packot',
    'install_go' => 'Telepítés',
    'install_confirm' => 'A pack fájljai hozzáadódnak ehhez a szerverhez. **Semmi sem törlődik** - sem a világod, sem a régi modjaid, sem egy konfiguráció. Egy másik tetejére telepített pack mindkettőt meghagyja, ezért ha ezt szeretnéd, előbb magad távolítsd el az előző pack modjait. A szervernek leállítva kell lennie, és leállítva is marad.',

    'started' => 'Telepítés',
    'started_helper' => 'A pack letöltődik és kicsomagolódik. Néhány száz fájl néhány percet vesz igénybe, és értesítést kapsz, amikor kész - akkor is folytatódik, ha elhagyod ezt az oldalt.',

    'running' => 'A szerver fut',
    'running_helper' => 'A Minecraft indításkor tölti be a modjait, tehát egy most telepített pack olyan szervert hagyna maga után, amely sem a régi, sem az új pack nem lenne az újraindításig. Állítsd le, és próbáld újra.',

    'done' => ':pack telepítve',
    'done_body' => ':files fájl letöltve, és :overrides elem a pack saját mappájából a helyére téve. Indítsd el a szervert, amikor készen állsz.',
    'done_refused' => ':count fájl kimaradt, mert a pack olyan helyről kérte őket, ahonnan ez nem tölt le.',

    'failed' => 'A pack nem lett telepítve',
    'failed_fetch' => 'A packot nem sikerült letölteni vagy kicsomagolni. Lehet, hogy a daemon nem érhető el, vagy a szerveren elfogyott a lemez.',
    'failed_index' => 'A pack letöltődött, de nem volt benne olvasható index, így nem volt mit telepíteni.',
    'failed_version' => 'Ahhoz a verzióhoz már nincs letölthető packfájl. Válassz másikat.',
    'failed_queue' => 'A telepítést nem sikerült sorba állítani. Ehhez egy futó queue worker kell a panelen.',
];
