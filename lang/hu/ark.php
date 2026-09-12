<?php

/*
 * Magyar. Kézzel írva.
 *
 * A „GameUserSettings.ini” és a „Startup” úgy íródik, ahogy a játékban és a
 * Pelicanban áll - ezeket a neveket keresi az ember.
 */

return [
    /* ------------------------------------------------------- az admin fül */

    /*
     * Maga a cím nincs itt. Minden beállításszakasz a settings.groups.<név>
     * kulcsból veszi a címét, amit a group() épít fel.
     */
    'section_helper' => 'Mely eggek futtatnak ARK-ot. Semmi más - egy ARK-szerver többi részét az indítóváltozói állítják be, és a Pelican saját Startup oldala már szerkeszti azokat.',

    'eggs' => 'Mely eggek az ARK',
    'eggs_helper' => 'Pipáld ki azokat az eggeket, amelyek ARK-szervert futtatnak. Egy Világbeállítások oldal jelenik meg az ezeket használó szervereken belül, és sehol máshol. Ez más kérdés, mint az állapotoldalé: az azt kérdezi, mely eggek válaszolnak a Valve lekérdezésére, amit a Rust és a Valheim is megtesz, ez pedig azt, mely eggek tartják a GameUserSettings.ini fájlt ott, ahol az ARK tartja, amit csak az ARK tesz. Kezdetben semmi sincs kipipálva, szándékosan - egy bővítmény nem tudhatja, minek nevezted el az eggjeidet.',

    /* --------------------------------------------------- a szerver oldala */

    'nav_label' => 'Világbeállítások',
    'title' => 'ARK világbeállítások',
    'subheading' => 'Azok a beállítások, amelyeket az emberek valóban megváltoztatnak, a GameUserSettings.ini fájlból.',

    'group_server' => 'A szerver',
    'group_server_helper' => 'Hogy hívják a szervert, ki csatlakozhat, és hányan.',
    'group_rates' => 'Szorzók',
    'group_rates_helper' => 'Milyen gyorsan történnek a dolgok. Az 1.0 a játék úgy, ahogy érkezik; a 2.0 kétszer olyan gyors.',
    'group_rules' => 'Szabályok',
    'group_rules_helper' => 'Mit tehetnek a játékosok, és mit mutat nekik a játék.',

    'keeps' => 'Tizenöt beállítás egy több százat tartalmazó fájlból. Minden más benne - a mod-beállításaid, olyan kulcsok, amelyekről ez a bővítmény soha nem hallott, a megjegyzések és mindezek sorrendje - pontosan úgy marad, ahogy van, amikor mentesz.',
    'missing' => 'Ezen a szerveren még nincs GameUserSettings.ini. A játék az első futásakor írja meg, tehát indítsd el egyszer a szervert, és ez az oldal kitöltődik.',
    'read_only' => 'Ezt a fájlt olvashatod, de nem írhatod, így itt semmit sem lehet megváltoztatni.',

    'save' => 'Mentés',
    'saved' => 'Mentve',
    'saved_restart' => 'Az ARK indításkor olvassa ezt a fájlt, tehát indítsd újra a szervert, hogy a változtatás érvénybe lépjen.',
    'failed' => 'Nem sikerült menteni',
    'failed_write' => 'A daemon elutasította az írást. Ellenőrizd, hogy a szerver elérhető-e, és hogy a fájl nem írásvédett-e.',
];
