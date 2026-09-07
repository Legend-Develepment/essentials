<?php

/*
 * Magyar. Kézzel írva.
 *
 * A felső sáv váltója, és az oldal, ahová vezet.
 *
 * Egy vezérlő, amely két folyton feltett kérdésre válaszol - melyik szerver, és
 * hol voltak azok a beállítások - és egy oldal, amely felsorolja mindazt, amit
 * valaki megcsillagozott. Lásd Support\Quick.
 */

return [
    // ---- a vezérlő a felső sávban ----------------------------------------
    'label' => 'Ugrás ide',
    'open' => 'Ugrás egy szerverre vagy egy csillagozott oldalra',
    'search' => 'Szerverek keresése…',

    'favourites' => 'Kedvencek',
    'servers' => 'Szerverek',
    'pages' => 'Oldalak',

    'loading' => 'Keresés…',
    'empty' => 'Nem található semmi.',
    // Kimondva, nem elhallgatva: egy lista, amely csendben megáll
    // huszonötnél, olyan keresésnek látszik, amelyik nem találja meg a dolgokat.
    'more' => 'Több találat, mint amennyi ide fér — írj még egy kicsit.',
    'failed' => 'A panel nem volt elérhető, így ez a lista elavult lehet. A böngésző konzolja megmondja, mit válaszolt a kérés.',

    'star_page' => 'Csillagozd meg ezt az oldalt',
    'unstar_page' => 'Csillagozva — kattints az eltávolításhoz',
    'all' => 'Mutasd mind',

    // ---- az oldal --------------------------------------------------------
    'title' => 'Kedvencek',
    'nav_label' => 'Kedvencek',
    'subheading' => 'Minden, amit megcsillagoztál, egy helyen.',

    'how' => 'Egy szervert a szerverlistán a kártyáján lévő csillaggal csillagozol meg, egy oldalt pedig a képernyő tetején lévő Ugrás ide menü gombjával. A listád a panelen van, nem ebben a böngészőben, így elkísér oda, ahol legközelebb bejelentkezel.',
    'page_empty' => 'Még semmi sincs megcsillagozva.',
    'remove' => 'Eltávolítás a kedvencekből',
];
