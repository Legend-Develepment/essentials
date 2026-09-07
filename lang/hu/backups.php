<?php

/*
 * Magyar. Kézzel írva.
 *
 * Mentések az egész panelen.
 *
 * A Pelican arra válaszol, hogy „milyen mentései vannak ennek a szervernek”. Ez
 * az oldal a fordítottjára válaszol, arra a kérdésre, ami egy adminisztrátornak
 * valójában van, és amelynek a panelben nincs helye: melyiknek nincs egy sem.
 */

return [
    'title' => 'Mentések',
    'nav_label' => 'Mentések',
    'subheading' => 'Minden szerver, amelyet elérsz, azzal együtt, mióta van nélküle. A soha nem mentett szerverek vannak felül; minden :days napnál régebbi elavultnak számít.',

    // ---- a táblázat -------------------------------------------------------
    'column_server' => 'Szerver',
    'column_last' => 'Utolsó mentés',
    'column_kept' => 'Megtartva',
    'column_size' => 'Méret',
    'column_failed' => 'Sikertelen',

    'never' => 'Soha',

    'filter_none' => 'Soha nem mentett',
    'filter_stale' => 'Elavult',
    'filter_failed' => 'Hibázik',

    'open' => 'Megnyitás a Pelicanban',
];
