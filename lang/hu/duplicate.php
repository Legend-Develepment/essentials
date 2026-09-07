<?php

/*
 * Magyar. Kézzel írva.
 *
 * Az „egg” és az „allokáció” marad: ezek a Pelican szavai, és ezeket keresi az
 * ember a node oldalán.
 */

return [
    'title' => 'Szerver másolása',
    'nav_label' => 'Szerver másolása',
    'subheading' => 'Még egy szerver pontosan úgy beállítva, mint egy meglévő, vagy több egyszerre.',

    'section' => 'Mi másolódik',
    'section_helper' => 'A tulajdonos, az egg, az indítóparancs, a korlátok és minden változó másolódik. A fájlok, adatbázisok, mentések és ütemezések nem — egy futó szerver fájljainak másolata az állapotának a másolata, és ritkán ezt jelenti az, hogy „még egy ilyet”.',

    'source' => 'Másolás innen',
    'source_helper' => 'A másolatok ugyanarra a node-ra kerülnek, mint ez a szerver, mert ott vannak a szabad címei.',

    'name' => 'Nevezd el a másolatot',
    'name_helper' => 'Ha egynél többet készítesz, számozza őket: „Bot 1”, „Bot 2”, és így tovább.',

    'copies' => 'Hány darab',
    'copies_helper' => 'Előbb válassz szervert.',
    'room' => ':count szabad cím van a(z) :node node-on, tehát most ennél többet nem lehet készíteni.',
    'no_room' => 'A(z) :node node-on nem maradt szabad cím. Egy másolatnak sajátra van szüksége, ezért előbb adj hozzá egy allokációt ahhoz a node-hoz.',

    /*
     * A sikerek megszámolva és nem felsorolva, a hibák pedig felsorolva - és ez
     * az a sorrend, amelyik segít: tíz név, amelyik sikerült, olyan szövegfal,
     * amelyet senki sem olvas el, és az az egy, amelyik nem, az egyetlen, amit
     * érdemes elolvasni.
     */
    'made' => ':count másolat elkészült',
    'partly_failed' => ':count másolatot nem sikerült elkészíteni',
    'failed' => 'Semmi sem másolódott',
];
