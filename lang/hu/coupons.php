<?php

/*
 * Magyar. Kézzel írva.
 *
 * Kuponok: kódok, amelyek levesznek valamit az első számlából.
 *
 * Csak az elsőből, szándékosan, és a szöveg ezt ott mondja ki, ahol számít. Egy
 * kód, amely minden megújítást is olcsóbbá tenne, lejárati dátummal ellátott
 * árváltozás lenne, és aki ezt akarja, változtassa meg az árat.
 */

return [
    'title' => 'Kuponok',
    'nav_label' => 'Kuponok',
    'subheading' => 'Kódok, amelyek százalékot vagy összeget vesznek le az első számlából. A megújítások a csomag árán mennek.',

    // ---- a táblázat ------------------------------------------------------
    'column_code' => 'Kód',
    'column_value' => 'Érték',
    'column_uses' => 'Felhasználva',
    'column_expires' => 'Lejár',
    'column_packages' => 'Erre vonatkozik',
    'column_live' => 'Aktív',

    'never_expires' => 'Nincs lejárat',
    'all_packages' => 'Mindenre',
    'some_packages' => ':count csomagra',
    'usable' => 'Most használható',
    'unusable' => 'Kikapcsolva, lejárt vagy elfogyott',

    // ---- a gombok --------------------------------------------------------
    'new' => 'Új kupon',
    'edit' => 'Szerkesztés',
    'delete' => 'Törlés',
    'delete_confirm' => 'Eltávolítja a kódot. Azok a számlák, amelyek már használták, megtartják a kedvezményüket - mindegyik maga őrzi, mennyit vontak le róla.',
    'deleted' => 'Kupon törölve',
    'saved' => 'Kupon mentve',
    'save_failed' => 'A kupont nem sikerült menteni',
    'taken' => 'Ezt a kódot már használja valami más.',
    'invalid' => 'A százalék 1 és 100 közötti egész szám. Az összeget így írjuk: 12.50 vagy 12,50.',

    // ---- az űrlap --------------------------------------------------------
    'section_code' => 'A kód',
    'section_code_helper' => 'Amit a vásárló a rendeléskor beír.',
    'code' => 'Kód',
    'code_helper' => 'Nagybetűvel, szóközök nélkül tároljuk és hasonlítjuk össze, hogy akárhogy is írja be valaki, működjön.',
    'live' => 'Aktív',
    'live_helper' => 'Kikapcsolva a kód működése megszűnik anélkül, hogy törölnénk: kikerül a forgalomból, miközben a kedvezmény, amit adott, ott marad azokon a számlákon, amelyeken volt.',

    'section_worth' => 'Mennyit vesz le',
    'section_worth_helper' => 'Csak az első számlából. Soha nem viszi a számlát nulla alá.',
    'kind' => 'Fajta',
    'kind_helper' => 'Az ár egy része, vagy egy rögzített összeg.',
    'kind_percent' => 'Százalék',
    'kind_fixed' => 'Rögzített összeg',
    'value' => 'Érték',
    'value_percent_helper' => '1 és 100 közötti egész szám.',
    'value_fixed_helper' => 'A bolt pénznemében. Így írd: 12.50 vagy 12,50.',

    'section_limits' => 'Korlátok',
    'section_limits_helper' => 'Itt minden szabadon hagyható. Egy kód, amelyen egyik sincs beállítva, mindenre, mindenkinek, örökre érvényes.',
    'max_uses' => 'Hányszor használható fel',
    'max_uses_helper' => 'A rendelés leadásakor számolódik, nem a számla kifizetésekor - különben egy tíz felhasználásos kódot egy éjszaka alatt százszor le lehetne adni.',
    'expires' => 'Lejár',
    'expires_helper' => 'Ez után az időpont után a kód már nem működik. Üresen hagyva ez soha nem következik be.',
    'packages' => 'Csomagok',
    'packages_helper' => 'Semmi sincs kipipálva: minden csomag, most és később is.',

    'empty' => 'Még nincsenek kuponok',
    'empty_body' => 'Készíts egyet, és rendeléskor működik, amint aktív lesz.',
];
