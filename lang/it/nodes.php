<?php

/*
 * Italiano. Scritto a mano.
 *
 * Il blocco della dashboard: la macchina su cui sta il pannello, e ogni nodo.
 *
 * I numeri dei nodi sono quelli di Pelican stesso, letti dal daemon di ciascun
 * nodo. La riga del pannello è letta da /proc, che è un'altra domanda - vedi
 * Support\SystemStatus.
 */

return [
    // Il titolo del blocco è il nome del plugin stesso, letto a runtime: per
    // questo qui non c'è un testo per lui.
    'panel' => 'Questo pannello',
    'offline' => 'non risponde',
    'maintenance' => 'manutenzione',
    'cpu' => 'CPU',
    'memory' => 'Memoria',
    'disk' => 'Disco',
    'load' => 'Carico',
];
