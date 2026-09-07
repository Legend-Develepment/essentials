<?php

/*
 * Čeština. Psáno ručně.
 *
 * Zálohy v celém panelu.
 *
 * Pelican odpovídá na „jaké zálohy má tenhle server". Tahle stránka odpovídá
 * obráceně, a to je ta otázka, kterou administrátor doopravdy má a pro kterou
 * panel nemá místo: který z mých nemá žádnou.
 */

return [
    'title' => 'Zálohy',
    'nav_label' => 'Zálohy',
    'subheading' => 'Všechny servery, na které dosáhnete, a jak dlouho jsou bez zálohy. Ty, které ji nikdy neměly, stojí nahoře; starší než :days dní se počítá jako prošlá.',

    // ---- tabulka ----------------------------------------------------------
    'column_server' => 'Server',
    'column_last' => 'Poslední záloha',
    'column_kept' => 'Uchováno',
    'column_size' => 'Velikost',
    'column_failed' => 'Neúspěšné',

    'never' => 'Nikdy',

    'filter_none' => 'Bez jediné zálohy',
    'filter_stale' => 'Prošlé',
    'filter_failed' => 'S chybami',

    'open' => 'Otevřít v Pelicanu',
];
