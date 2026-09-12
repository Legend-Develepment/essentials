<?php

/*
 * Magyar. Kézzel írva.
 *
 * Egyenleg, visszatérítés és jóváíró számla.
 *
 * Két szót végig szándékosan tartunk külön.
 *
 * Az „egyenleg” olyan pénz, amelyet a bolt valaki helyett tart. Magától lejön
 * a következő számlájáról, még mielőtt bárki fizetésre kérné.
 *
 * A „visszatérítés” maga a visszaadás, és két irányba mehet: vissza arra a
 * kártyára, ahonnan jött, vagy a fiókra egyenlegként. A szöveg mindig
 * megmondja, melyik, mert az a vásárló, akinek azt írjuk, hogy
 * „visszatérítettük”, aztán semmit sem talál a bankjában, joggal ír vissza.
 *
 * A „jóváíró számla” a dokumentum. Mindkét esetben készül, mert az a nyoma
 * annak, hogy a pénz már nem a boltot illeti - nem arról szól, hová ment.
 */

return [
    // ---- amit a vásárló lát ----------------------------------------------
    'yours' => 'Az egyenleged',
    'yours_body' => 'Ez magától lejön a következő számládról. Nem kell vele semmit tenned.',
    'applied' => 'Egyenlegből fizetve',
    'payable' => 'Még fizetendő',

    // ---- a könyvelés, a vásárló ablakában --------------------------------
    'held' => 'Egyenleg',
    'none_held' => 'Nincs egyenleg',
    'movements' => 'Egyenleg',
    'column' => 'Egyenleg',
    'none' => 'Nincs',

    // ---- adni belőle -----------------------------------------------------
    'give' => 'Egyenleg',
    'give_helper' => 'Ezen a fiókon :held van. Amit ráteszel, magától lejön a következő számlájáról. A negatív összeg leveszi az egyenleget, és mindkét mozgás megmarad az előzményekben.',
    'amount' => 'Összeg',
    'amount_helper' => 'A negatív összeg elvesz az egyenlegből ahelyett, hogy adna.',
    'reason' => 'Indok',
    'reason_helper' => 'A vásárló ezt az összeg mellett látja, tehát neki írd, ne az aktának.',
    'given' => ':amount egyenleg :who részére',
    'bad_amount' => 'Ez nem összeg.',
    'give_failed' => 'Az egyenleg nem lett jóváírva',
    'give_failed_body' => 'Semmi sem íródott le. Próbáld újra, és ha továbbra is előfordul, nézz bele a naplóba.',
    'take_failed' => 'Az egyenleg nem lett levonva',
    'take_failed_body' => 'Kevesebb van a fiókon, mint amennyit le akartál venni. Az egyenleg soha nem megy nulla alá.',

    // ---- mit mond egy mozgás ---------------------------------------------
    'spent_on' => ':number számla',
    'returned' => 'Visszatéve: a számlát, amelyre ment volna, nem sikerült megírni',
    'note_line' => 'Jóváíró számla a(z) :number számlához',
    'refund_description' => 'A(z) :number számla visszatérítése',

    // ---- visszaadni ------------------------------------------------------
    'refund' => 'Visszatérítés',
    'refund_helper' => 'Ebből a számlából :left még nincs visszaadva. Jóváíró számla mindkét esetben készül, tehát mindkét oldalon marad róla nyom.',
    'refund_amount_helper' => 'Egy része is rendben van. Ami marad, később is visszaadható.',
    'refund_reason_helper' => 'Ez rákerül a jóváíró számlára, amelyet a vásárló megnyithat.',
    'where' => 'Hová megy a pénz',
    'where_provider' => 'Vissza oda, ahogy fizette',
    'where_provider_helper' => 'A szolgáltató arra a kártyára vagy számlára küldi, ahonnan jött. Napokba telhet, mire megjelenik, és el is utasíthatják - egy régi fizetést, vagy olyan módot, amely nem fordítható vissza.',
    'where_balance' => 'Az itteni fiókjára egyenlegként',
    'where_balance_helper' => 'Egyenleg lesz belőle, és lejön a következő számlájáról. Semmi sem hagyja el a bankot, és nem hiúsulhat meg.',
    'refunded' => ':amount visszatérítve',
    'refunded_body' => 'Készült hozzá egy :number jóváíró számla.',
    'refund_failed' => 'Semmi sem lett visszatérítve',

    // ---- és hogy miért nem, egyszerre egy ok -----------------------------
    'refused_off' => 'Az egyenleg és a visszatérítés ezen a panelen ki van kapcsolva.',
    'refused_amount' => 'Ez több, mint ami ebből a számlából hátravan.',
    'refused_no_payment' => 'Ezen a számlán egyetlen fizetésben sincs ennyi hátra, tehát nincs mit visszafordíttatni egy szolgáltatóval. Tedd inkább a fiókjára.',
    'refused_no_gateway' => 'Az a szolgáltató, amelyen keresztül ezt kifizették, már nincs bekapcsolva, tehát nem lehet megkérni semmi visszafordítására. Tedd inkább a fiókjára.',
    'refused_refused' => 'A szolgáltató elutasította. Ez általában régi fizetés, vagy olyan mód, amely nem fordítható vissza; az általuk adott indok a naplóban van. Tedd inkább a fiókjára.',
    'refused_note_failed' => 'A pénz elmozdult, de a jóváíró számlát nem sikerült megírni, így semmi sem lett rögzítve. Nézz bele a naplóba, mielőtt újrapróbálod.',

    // ---- pénzt tenni rá --------------------------------------------------
    'topup' => 'Egyenleg feltöltése',
    'topup_helper' => 'A fiókodon :held van. Amit itt teszel hozzá, magától lejön a következő számládról, és minden már nyitott számlád abból rendeződik, amint megérkezik.',
    'topup_go' => 'Tovább a fizetéshez',
    'topup_amount_helper' => ':least és :most között.',
    'topup_bad' => 'Ezt az összeget nem lehet kifizetni',
    'topup_failed' => 'A fizetést nem sikerült elindítani. Próbáld újra, és ha továbbra is előfordul, szólj annak, aki ezt a panelt üzemelteti.',
    'topup_line' => 'Egyenleg feltöltve',
    'topup_reason' => 'Feltöltve a(z) :number számlán',

    // ---- hol látszik -----------------------------------------------------
    'menu' => ':amount egyenleg',
    'held_helper' => 'Magától lejön a következő számládról. A Számlák oldalon tölthetsz rá.',
];
