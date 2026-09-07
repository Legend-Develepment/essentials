<?php

/*
 * Svenska. Skriven för hand.
 *
 * Säkerhetskopior, för hela panelen.
 *
 * Pelican svarar på «vilka säkerhetskopior har den här servern». Den här sidan
 * svarar på det omvända, som är den fråga en administratör faktiskt har och som
 * panelen inte har någonstans att lägga: vilken av mina har ingen alls.
 */

return [
    'title' => 'Säkerhetskopior',
    'nav_label' => 'Säkerhetskopior',
    'subheading' => 'Varje server du når, med hur länge den har varit utan en. Servrar som aldrig har säkerhetskopierats står överst; allt äldre än :days dagar räknas som föråldrat.',

    // ---- tabellen ---------------------------------------------------------
    'column_server' => 'Server',
    'column_last' => 'Senaste kopian',
    'column_kept' => 'Sparade',
    'column_size' => 'Storlek',
    'column_failed' => 'Misslyckade',

    'never' => 'Aldrig',

    'filter_none' => 'Aldrig kopierad',
    'filter_stale' => 'Föråldrad',
    'filter_failed' => 'Misslyckas',

    'open' => 'Öppna i Pelican',
];
