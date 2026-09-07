<?php

/*
 * Slovenčina. Písané ručne.
 *
 * „Uzol" je slovo, ktorým Pelican po slovensky nazýva stroj, a je prevzaté sem;
 * na verejných stránkach, kde číta niekto, kto o Pelicane nikdy nepočul, stojí
 * „stroj".
 */

return [
    'nav_label' => 'Kapacita',
    'title' => 'Či sa zmestí ešte jeden server',
    'subheading' => 'Koľko je sľúbené na každom uzle proti tomu, koľko smie rozdať.',

    'how' => 'Sľúbené, nie spotrebované. Uzol môže byť zaťažený na dvadsať percent a pritom celkom plný, lebo „plný" je o rozdanom, nie o tom, čo beží — blok Stroje na nástenke odpovedá na tú druhú otázku a ostáva, kde je. Počet tu je počet samotného Pelicanu, prevzatý z metódy, ktorá rozhoduje, či server vôbec smie vzniknúť: kapacita krát jedna plus prealokácia, proti súčtu toho, čo bolo sľúbené každému serveru na uzle. Kapacita nula znamená bez obmedzenia a prealokácia pod nulou tiež — odtiaľ riadky bez percenta namiesto plného alebo prázdneho pásu.',

    'column_node' => 'Stroj',
    'column_fullest' => 'Najplnšie',
    'column_memory' => 'Pamäť',
    'column_disk' => 'Disk',
    'column_cpu' => 'Procesor',
    'column_at_limit' => 'Na hranici',

    'servers' => 'Serverov: :count',

    'filter_tight' => 'Takmer plné',

    'open' => 'Otvoriť stroj',

    'empty' => 'Žiadne stroje, na ktoré by ste dosiahli.',
];
