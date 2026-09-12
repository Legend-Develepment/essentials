<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * ”Kone” itse sivulla, koska rivi puhuu raudasta eikä Pelicanin käsitteestä;
 * ”node” kuuluu asetuksiin, joissa sana on jo luettu.
 */

return [
    'nav_label' => 'Kapasiteetti',
    'title' => 'Mahtuuko vielä yksi palvelin',
    'subheading' => 'Mitä kullekin nodelle on luvattu, verrattuna siihen, mitä se saa jakaa.',

    'how' => 'Luvattu, ei käytetty. Node voi olla kaksikymmentä prosenttia kiireinen ja samalla aivan täynnä, koska täysi tarkoittaa sitä, mitä on jaettu, eikä sitä, mikä on käynnissä - yleisnäkymän Koneet-lohko on se toinen kysymys, ja se pysyy paikallaan. Laskutapa täällä on Pelicanin oma, siitä metodista, joka päättää saako palvelinta ylipäätään luoda: kapasiteetti kertaa yksi plus ylivaraus, verrattuna siihen summaan, joka noden jokaiselle palvelimelle on luvattu. Nollakapasiteetti tarkoittaa rajatonta, ja niin tarkoittaa myös nollaa pienempi ylivaraus - siksi joiltakin riveiltä puuttuu prosenttiluku sen sijaan, että ne näyttäisivät täyttä tai tyhjää palkkia.',

    'column_node' => 'Kone',
    'column_fullest' => 'Täysin',
    'column_memory' => 'Muisti',
    'column_disk' => 'Levy',
    'column_cpu' => 'Suoritin',
    'column_at_limit' => 'Rajalla',

    'servers' => 'Palvelimia: :count',

    'filter_tight' => 'Melkein täynnä',

    'open' => 'Avaa kone',

    'empty' => 'Ei koneita, joita tavoittaisit.',
];
