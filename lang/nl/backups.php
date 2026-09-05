<?php

/*
 * Back-ups, panel-breed.
 *
 * Pelican beantwoordt "welke back-ups heeft deze server". Deze pagina
 * beantwoordt het omgekeerde, en dat is de vraag die een beheerder echt heeft:
 * welke van de mijne heeft er geen.
 */

return [
    'title' => 'Back-ups',
    'nav_label' => 'Back-ups',
    'subheading' => 'Elke server die je kunt bereiken, met hoe lang hij het zonder gedaan heeft. Servers die nooit een back-up hebben gehad staan bovenaan; alles ouder dan :days dagen telt als verouderd.',

    // ---- de tabel ---------------------------------------------------------
    'column_server' => 'Server',
    'column_last' => 'Laatste back-up',
    'column_kept' => 'Bewaard',
    'column_size' => 'Grootte',
    'column_failed' => 'Mislukt',

    'never' => 'Nooit',

    'filter_none' => 'Nooit geback-upt',
    'filter_stale' => 'Verouderd',
    'filter_failed' => 'Mislukt',

    'open' => 'Openen in Pelican',
];
