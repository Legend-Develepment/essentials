<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * Valdymo juosta serverio puslapyje. Atskiras failas, o ne settings.php kampas,
 * nes tai skaito tie, kas naudojasi skydeliu, o ne tas, kas derina temą.
 *
 * Būsena šalia mygtukų yra paties Pelican žodis jai, paimtas iš ContainerStatus
 * sąrašo, kad juosta ir konsolės puslapis niekada nesiskirtų dėl to, ką serveris
 * daro.
 *
 * „Kill“ lieka angliškai: taip vadinasi paties Pelican mygtukas ir taip vadinasi
 * komanda, o tai yra kas kita nei stabdymas.
 */

return [
    'console' => 'Konsolė',
    'full_page' => 'Naujas langas',
    'close' => 'Uždaryti',

    'start' => 'Paleisti',
    'restart' => 'Paleisti iš naujo',
    'stop' => 'Sustabdyti',
    'kill' => 'Kill',

    'kill_confirm' => 'Kill sustabdo konteinerį vietoje. Viskas, ko serveris dar neįrašė į diską, prarandama. Tęsiame?',

    'sent_title' => 'Maitinimo komanda',
    'sent_body' => ':action išsiųsta į :name.',
    'failed' => 'Node nepasiektas.',
];
