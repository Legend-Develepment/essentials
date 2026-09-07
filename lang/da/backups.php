<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * Sikkerhedskopier, på tværs af hele panelet.
 *
 * Pelican svarer på „hvilke kopier har denne server". Denne side svarer på det
 * omvendte, og det er det spørgsmål, en administrator faktisk har, og som
 * panelet ikke har noget sted at lægge: hvilke af mine har ingen.
 */

return [
    'title' => 'Sikkerhedskopier',
    'nav_label' => 'Sikkerhedskopier',
    'subheading' => 'Alle servere, du kan nå, og hvor længe de har været uden en kopi. De, der aldrig har fået en, står øverst; ældre end :days dage tæller som forældet.',

    // ---- tabellen ---------------------------------------------------------
    'column_server' => 'Server',
    'column_last' => 'Seneste kopi',
    'column_kept' => 'Gemt',
    'column_size' => 'Størrelse',
    'column_failed' => 'Mislykkede',

    'never' => 'Aldrig',

    'filter_none' => 'Aldrig kopieret',
    'filter_stale' => 'Forældede',
    'filter_failed' => 'Fejler',

    'open' => 'Åbn i Pelican',
];
