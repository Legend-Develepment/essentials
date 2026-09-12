<?php

/*
 * Čeština. Psáno ručně.
 *
 * „Uzel" je slovo, kterým Pelican česky nazývá stroj, a je převzato sem; na
 * veřejných stránkách, kde čte někdo, kdo o Pelicanu nikdy neslyšel, stojí
 * „stroj".
 */

return [
    'nav_label' => 'Kapacita',
    'title' => 'Jestli se vejde ještě jeden server',
    'subheading' => 'Kolik je slíbeno na každém uzlu proti tomu, kolik smí rozdat.',

    'how' => 'Slíbeno, ne spotřebováno. Uzel může být zatížený na dvacet procent a přitom úplně plný, protože „plný" je o rozdaném, ne o tom, co běží - blok Stroje na nástěnce odpovídá na tu druhou otázku a zůstává, kde je. Počet tady je počet samotného Pelicanu, převzatý z metody, která rozhoduje, jestli server vůbec smí vzniknout: kapacita krát jedna plus přealokace, proti součtu toho, co bylo slíbeno každému serveru na uzlu. Kapacita nula znamená bez omezení a přealokace pod nulou taky - odtud řádky bez procenta místo plného nebo prázdného pruhu.',

    'column_node' => 'Stroj',
    'column_fullest' => 'Nejplnější',
    'column_memory' => 'Paměť',
    'column_disk' => 'Disk',
    'column_cpu' => 'Procesor',
    'column_at_limit' => 'Na hranici',

    'servers' => 'Serverů: :count',

    'filter_tight' => 'Téměř plné',

    'open' => 'Otevřít stroj',

    'empty' => 'Žádné stroje, na které byste dosáhli.',
];
