<?php

/*
 * Magyar. Kézzel írva.
 *
 * A „SteamID64” és a „PlayFab ID” pontosan úgy marad, ahogy azokon a helyeken
 * írják, ahonnan az ember beszerzi őket. Az „admin” is marad: ez a játék saját
 * fájljának a szava.
 */

return [
    /* ------------------------------------------------------- az admin fül */

    'section_helper' => 'Mely eggek futtatnak Valheimet. Semmi más — egy Valheim-szervert az indítóváltozói állítanak be, és a Pelican saját Startup oldala már szerkeszti azokat.',

    'eggs' => 'Mely eggek a Valheim',
    'eggs_helper' => 'Pipáld ki azokat az eggeket, amelyek Valheim-szervert futtatnak. Egy Játékoslisták oldal jelenik meg az ezeket használó szervereken belül, és sehol máshol. Az, hogy hol vannak ezek a listák, eggenként eltér, ezért szerverenként állapítja meg azokon a helyeken keresve, amelyeket a játék használ. Kezdetben semmi sincs kipipálva, szándékosan — egy bővítmény nem tudhatja, minek nevezted el az eggjeidet.',

    /* --------------------------------------------------- a szerver oldala */

    'nav_label' => 'Játékoslisták',
    'title' => 'Valheim játékoslisták',
    'subheading' => 'Adminok, banok és az engedélyezettek listája, három listaként három szövegfájl helyett.',

    'admin' => 'Adminok',
    'admin_helper' => 'Itt mindenki használhatja az adminparancsokat a játékban.',
    'banned' => 'Bannolva',
    'banned_helper' => 'Itt mindenkit elutasít, amikor csatlakozni próbál.',
    'permitted' => 'Engedélyezve',
    'permitted_helper' => 'Ha ezen a listán van valaki, csak ők csatlakozhatnak. Az üres lista mindenkit beenged — a legtöbb szerver ezt akarja, ezért hagyd üresen, hacsak nem komolyan gondolod.',

    'ids' => 'Játékosazonosítók',
    'ids_placeholder' => 'Illessz be egy azonosítót, és nyomj szóközt',

    'how' => 'Játékosonként egy azonosító — SteamID64 egy Steam-szerveren, PlayFab ID egy crossplay szerveren. Illeszd be őket, és nyomj szóközt, tabot vagy vesszőt. Minden, amit a játék megjegyzésként a lista fölé írt, ott marad, ahol van.',
    'where' => 'Beolvasva innen: :dir.',
    'missing' => 'Ezen a szerveren még egyik fájl sincs meg. A játék akkor írja meg őket, amikor először szüksége van rájuk, és az itteni mentés létrehozza azokat, amelyeket kitöltesz.',
    'read_only' => 'Ezeket a fájlokat olvashatod, de nem írhatod, így itt semmit sem lehet megváltoztatni.',

    'save' => 'Mentés',
    'saved' => 'Mentve',
    'saved_reload' => 'A Valheim futás közben olvassa ezeket a listákat, így a változtatás újraindítás nélkül érvényesül.',
    'unchanged' => 'Semmi sem változott, így semmi sem lett kiírva',
    'failed' => 'Nem sikerült menteni',
    'failed_lists' => 'A daemon elutasította az írást ezekhez: :lists. Ellenőrizd, hogy a szerver elérhető-e, és hogy a fájlok nem írásvédettek-e.',
];
