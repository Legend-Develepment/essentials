<?php

/*
 * Magyar. Kézzel írva.
 *
 * Ügyfelek: a bolt, csak az ember felé fordítva a sor helyett.
 *
 * A rendelések, a számlák és a fizetések mindegyike lista arról, mi történt.
 * Ez az oldal azt a kérdést teszi fel, amelyik egy hibajegyet kezelőnek
 * tényleg van: ki ez, mije van, mit fizetett, és mi maradt hátra.
 */

return [
    'title' => 'Ügyfelek',
    'nav_label' => 'Ügyfelek',
    'subheading' => 'Mindenki, aki vásárolt valamit, azzal, amije van, amit kifizetett, és amivel még tartozik.',

    // ---- a táblázat ------------------------------------------------------
    'column_customer' => 'Ügyfél',
    'column_services' => 'Szolgáltatások',
    'column_spent' => 'Kifizetve',
    'column_outstanding' => 'Hátralék',

    'of_orders' => ':count rendelésből',
    'nothing_owed' => 'Semmi',

    'filter_owing' => 'Tartozik valamivel',
    'filter_active' => 'Van aktív szolgáltatása',

    // ---- egyikük ---------------------------------------------------------
    'open' => 'Megnyitás',
    'close' => 'Bezárás',
    'servers' => 'Szerverek',
    'since' => 'Ügyfél ekkortól',
    'their_services' => 'Szolgáltatások',
    'their_invoices' => 'Számlák',
    'no_services' => 'Semmi aktív, és semmi, ami építésre várna.',
    'no_invoices' => 'Ehhez a fiókhoz nem íródott számla.',

    'empty' => 'Még senki sem vásárolt semmit',
    'empty_body' => 'Itt azok szerepelnek, akik rendeltek, nem mindenki, akinek fiókja van - így az első eladással telik meg.',
];
