<?php

/*
 * Slovenčina. Písané ručne.
 *
 * Zálohy v celom paneli.
 *
 * Pelican odpovedá na „aké zálohy má tento server". Táto stránka odpovedá
 * naopak, a to je tá otázka, ktorú administrátor naozaj má a pre ktorú panel
 * nemá miesto: ktorý z mojich nemá žiadnu.
 */

return [
    'title' => 'Zálohy',
    'nav_label' => 'Zálohy',
    'subheading' => 'Všetky servery, na ktoré dosiahnete, a ako dlho sú bez zálohy. Tie, ktoré ju nikdy nemali, stoja hore; staršia ako :days dní sa počíta ako prepadnutá.',

    // ---- tabuľka ----------------------------------------------------------
    'column_server' => 'Server',
    'column_last' => 'Posledná záloha',
    'column_kept' => 'Uchované',
    'column_size' => 'Veľkosť',
    'column_failed' => 'Neúspešné',

    'never' => 'Nikdy',

    'filter_none' => 'Bez jedinej zálohy',
    'filter_stale' => 'Prepadnuté',
    'filter_failed' => 'S chybami',

    'open' => 'Otvoriť v Pelicane',
];
