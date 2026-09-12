<?php

/*
 * La pagina che risponde a «quale dei miei è indietro». Scritta per chi
 * possiede i server, non per chi manda avanti il pannello - perciò qui non
 * si parla di node e non compare nessun numero su cui non possa fare nulla.
 * Ogni riga o nomina un server che può aprire, o dice cosa farne.
 */

return [
    'title' => 'Richiede attenzione',
    'nav_label' => 'Richiede attenzione',
    'subheading' => 'I tuoi server, ordinati per quanto sono indietro invece che per nome. Oltre :days giorni un backup conta come scaduto.',
    'column_server' => 'Server',
    'column_last' => 'Ultimo backup',
    'column_kept' => 'Conservati',
    'column_schedules' => 'Operazioni ferme',
    'never' => 'Mai',
    'filter_none' => 'Mai con backup',
    'filter_stale' => 'Backup scaduto',
    'open' => 'Backup',
    'empty' => 'Non c\'è niente indietro',
    'empty_body' => 'Ogni server che riesci a raggiungere ha un backup recente e nessuna operazione ferma. Questa pagina si riempie da sé quando questo smette di essere vero.',
];
