<?php

/*
 * Magyar. Kézzel írva.
 *
 * Az áttekintő blokkja: a gép, amelyen maga a panel fut, és minden node.
 *
 * A node-ok számai a Pelican sajátjai, az egyes node-ok daemonjáról olvasva. A
 * panel sora a /proc-ból származik, ami más kérdés - lásd Support\SystemStatus.
 *
 * A „node” marad: ez a Pelican szava mindenütt, és egy fordítás csak egy második
 * név lenne ugyanarra.
 */

return [
    // A blokk címe magának a bővítménynek a neve, futásidőben olvasva, így arra
    // nincs itt szöveg.
    'panel' => 'Ez a panel',
    'offline' => 'nem válaszol',
    'maintenance' => 'karbantartás',
    'cpu' => 'CPU',
    'memory' => 'Memória',
    'disk' => 'Lemez',
    'load' => 'Terhelés',
];
