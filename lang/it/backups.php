<?php

/*
 * Italiano. Scritto a mano.
 *
 * I backup, su tutto il pannello.
 *
 * Pelican risponde a «quali backup ha questo server». Questa pagina risponde
 * all'inverso, che è la domanda che un amministratore ha davvero e che il
 * pannello non ha dove mettere: quali dei miei non ne hanno nessuno.
 */

return [
    'title' => 'Backup',
    'nav_label' => 'Backup',
    'subheading' => 'Tutti i server che riesci a raggiungere, con da quanto tempo sono senza backup. Quelli che non ne hanno mai avuto uno stanno in cima; oltre :days giorni un backup conta come scaduto.',

    // ---- la tabella -------------------------------------------------------
    'column_server' => 'Server',
    'column_last' => 'Ultimo backup',
    'column_kept' => 'Conservati',
    'column_size' => 'Dimensione',
    'column_failed' => 'Falliti',

    'never' => 'Mai',

    'filter_none' => 'Mai con backup',
    'filter_stale' => 'Scaduti',
    'filter_failed' => 'In errore',

    'open' => 'Apri in Pelican',
];
