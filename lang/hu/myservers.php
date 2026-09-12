<?php

/*
 * Az oldal, amely arra válaszol, hogy „melyik az enyémek közül van
 * lemaradva”. Annak írva, akié a szerverek, nem annak, aki a panelt
 * üzemelteti - ezért nem esik itt szó node-okról, és nem szerepel olyan
 * szám, amivel nem tud mit kezdeni. Minden sor vagy megnevez egy szervert,
 * amit meg tud nyitni, vagy megmondja, mit tegyen vele.
 */

return [
    'title' => 'Figyelmet igényel',
    'nav_label' => 'Figyelmet igényel',
    'subheading' => 'A szervereid, aszerint rendezve, mi van lemaradva, nem pedig név szerint. Egy mentést :days nap után nevezünk elavultnak.',
    'column_server' => 'Szerver',
    'column_last' => 'Utolsó mentés',
    'column_kept' => 'Megtartva',
    'column_schedules' => 'Megállt feladatok',
    'never' => 'Soha',
    'filter_none' => 'Soha nem lett mentve',
    'filter_stale' => 'A mentés elavult',
    'open' => 'Mentések',
    'empty' => 'Semmi sincs lemaradva',
    'empty_body' => 'Minden szerverednek, amelyet elérsz, van friss mentése, és nincs megállt feladata. Ez az oldal magától telik meg, amint ez már nem igaz.',
];
