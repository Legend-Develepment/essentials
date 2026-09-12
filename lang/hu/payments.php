<?php

/*
 * Magyar. Kézzel írva.
 *
 * Fizetések: minden fizetési kísérlet, és amit a szolgáltató mondott róla.
 *
 * Egy sor kísérletenként, nem számlánként, mert így történt. Az a szó, amit ez
 * az oldal ismételget, a „kísérlet": egy meghiúsult fizetés megőrzésre méltó
 * tény, nem elrejtendő hiba.
 */

return [
    'title' => 'Fizetések',
    'nav_label' => 'Fizetések',
    'subheading' => 'Minden fizetési kísérlet, minden szolgáltatónál. Az Újraellenőrzés még egyszer megkérdezi a szolgáltatót - pontosan azt, amit a webhookjuk tesz, amikor megérkezik.',

    // ---- a táblázat ------------------------------------------------------
    'column_invoice' => 'Számla',
    'column_gateway' => 'Szolgáltató',
    'column_reference' => 'Az ő hivatkozásuk',
    'column_amount' => 'Összeg',
    'column_state' => 'Állapot',
    'column_updated' => 'Utoljára hallottunk róla',

    'gone_invoice' => 'Számla törölve',

    'state_open' => 'Várakozik',
    'state_paid' => 'Kifizetve',
    'state_failed' => 'Meghiúsult',
    'state_cancelled' => 'Félbehagyva',

    // ---- a gombok --------------------------------------------------------
    'recheck' => 'Újraellenőrzés',
    'rechecked' => 'Megkérdeztük újra',
    'rechecked_body' => 'A szolgáltató továbbra sem mondja, hogy ki van fizetve. Semmi sem változott.',
    'settled' => 'Ki van fizetve',
    'settled_body' => 'A számla rendezve, és minden, ami rá várt, úton van.',
    'recheck_failed' => 'Nem sikerült megkérdezni',
    'recheck_failed_body' => 'A szolgáltató nem válaszolt. Próbáld újra egy perc múlva; ha ismétlődik, ellenőrizd a kulcsot a Bolt beállításai oldalon.',
    'no_gateway' => 'Az a szolgáltató ki van kapcsolva',
    'no_gateway_body' => 'Kapcsold vissza, hogy rá lehessen kérdezni erre a fizetésre, vagy jelöld a számlát kifizetettnek kézzel.',

    'answer' => 'A válaszuk',
    'no_answer' => 'Semmi sincs feljegyezve',
    'close' => 'Bezárás',

    'empty' => 'Még senki sem fizetett szolgáltatón keresztül',
    'empty_body' => 'A kísérletek abban a pillanatban megjelennek itt, amikor valaki megnyomja a Fizetés gombot - akár végigviszi, akár nem.',
];
