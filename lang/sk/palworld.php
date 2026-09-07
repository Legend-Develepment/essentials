<?php

/*
 * Slovenčina. Písané ručne.
 *
 * Nastavenia sveta Palworldu — na stránke namiesto v súbore.
 *
 * Nič tu nepomenúva jednotlivé nastavenie. Každý popis na tej stránke sa
 * odvodzuje z kľúča, ktorý má v sebe súbor samotného servera — prečo by zoznam
 * názvov bol horší ako žiadny, pozri Support\Palworld\Palworld::label().
 */

return [
    'title' => 'Nastavenia Palworldu',
    'nav_label' => 'Palworld',
    'subheading' => 'Nastavenia sveta z PalWorldSettings.ini tohto servera, načítané pri otvorení tejto stránky. Upravovať sa dajú len pri zastavenom serveri.',

    'reload' => 'Načítať súbor znova',

    'save_confirm' => 'Súbor sa prepíše týmito hodnotami. Každé nastavenie, ktoré táto stránka neukázala, sa zapíše späť presne tak, ako bolo, a rovnako aj všetko ostatné v súbore.',
    'saved' => 'Nastavenia uložené',
    'saved_body' => 'Začnú platiť pri najbližšom spustení servera.',
    'save_failed' => 'Súbor sa nepodarilo zapísať',

    'running' => 'Server beží',
    'running_body' => 'Palworld drží tieto nastavenia v pamäti a pri zastavení súbor prepisuje, takže uložené teraz by sa bez jediného slova vrátilo späť. Najprv server zastavte.',

    'groups' => [
        'server' => 'Server a pripojenie',
        'world' => 'Svet a pomery',
        'pals' => 'Palovia',
        'players' => 'Hráči',
        'building' => 'Stavanie, predmety a zber',
        'guild' => 'Cechy',
        'other' => 'Ostatné',
    ],
];
