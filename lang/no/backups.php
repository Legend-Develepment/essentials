<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * Sikkerhetskopier, på tvers av hele panelet.
 *
 * Pelican svarer på «hvilke kopier har denne serveren». Denne siden svarer på
 * det motsatte, og det er det spørsmålet en administrator faktisk har, og som
 * panelet ikke har noe sted å legge: hvilke av mine har ingen.
 */

return [
    'title' => 'Sikkerhetskopier',
    'nav_label' => 'Sikkerhetskopier',
    'subheading' => 'Alle servere du kan nå, med hvor lenge de har vært uten en kopi. De som aldri har hatt en, står øverst; eldre enn :days dager teller som foreldet.',

    // ---- tabellen ---------------------------------------------------------
    'column_server' => 'Server',
    'column_last' => 'Siste kopi',
    'column_kept' => 'Beholdt',
    'column_size' => 'Størrelse',
    'column_failed' => 'Mislykkede',

    'never' => 'Aldri',

    'filter_none' => 'Aldri kopiert',
    'filter_stale' => 'Foreldede',
    'filter_failed' => 'Feiler',

    'open' => 'Åpne i Pelican',
];
