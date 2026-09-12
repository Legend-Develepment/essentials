<?php

/*
 * Magyar. Kézzel írva.
 *
 * Ki van fent egy szerveren, azoknál a játékoknál, amelyek válaszolnak a Valve
 * lekérdezésére.
 *
 * Egy oldal a Rustnak, az ARK-nak, a Valheimnek és a többinek, mert ugyanarra a
 * csomagra válaszolnak. Játékonként az tér el, mit lehet valakivel tenni - a
 * kirúgás az egyikben `kick "név"`, a másikban `KickPlayer <id>` - és ezért van
 * az, hogy ez az oldal olvas és nem cselekszik.
 */

return [
    'title' => 'Játékosok',
    'nav_label' => 'Játékosok',
    'subheading' => 'Ki van csatlakozva, magától a játéktól kérdezve, nem a paneltől.',

    'refresh' => 'Kérdezd újra',

    'count' => ':count csatlakozva',
    'score' => 'Pontszám',

    'just_joined' => 'most lépett be',
    'minutes' => ':count perc',
    'hours' => ':count óra',
    'hours_minutes' => ':hours óra :minutes perc',

    'empty' => 'Senki sincs ezen a szerveren.',

    /*
     * Nem „senki sincs fent”, és a különbség számít.
     *
     * A panel és a játékport gyakran olyan hálózatokon vannak, amelyek nem érik
     * el egymást, és ezt üres listaként rajzolni azt jelentené, hogy ez az
     * oldal olyat állít, amit nem tud.
     */
    'unreachable' => 'A szerver nem válaszolt. Lehet, hogy indul, vagy a panel nem éri el a játékportját onnan, ahol fut - ez más dolog, mint az, hogy senki sincs fent.',
];
