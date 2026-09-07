<?php

/*
 * Magyar. Kézzel írva.
 *
 * Magán az oldalon „gép”, mert a sor a vasról szól és nem a Pelican
 * fogalmáról; a „node” a beállításokba való, ahol a szót már olvasták.
 */

return [
    'nav_label' => 'Kapacitás',
    'title' => 'Elfér-e még egy szerver',
    'subheading' => 'Mennyi van ígérve az egyes node-okon, szemben azzal, amennyit kioszthatnak.',

    'how' => 'Ígérve, nem használva. Egy node lehet húsz százalékban elfoglalt és közben teljesen tele, mert a tele arról szól, mennyit osztottak ki, nem arról, mi fut — az áttekintő Gépek blokkja a másik kérdés, és az marad, ahol van. A számolás itt a Pelican sajátja, abból a metódusból, amely eldönti, létrehozható-e egyáltalán egy szerver: a kapacitás szorozva eggyel plusz a túlfoglalás, szemben azzal az összeggel, amennyit a node minden szerverének ígértek. A nulla kapacitás korlátlant jelent, és így van a nullánál kisebb túlfoglalással is — ezért van néhány sornál százalék helyett semmi, ahelyett hogy tele vagy üres csík lenne.',

    'column_node' => 'Gép',
    'column_fullest' => 'Legteltebb',
    'column_memory' => 'Memória',
    'column_disk' => 'Lemez',
    'column_cpu' => 'Processzor',
    'column_at_limit' => 'Határon',

    'servers' => ':count szerver',

    'filter_tight' => 'Majdnem tele',

    'open' => 'Gép megnyitása',

    'empty' => 'Nincs elérhető géped.',
];
