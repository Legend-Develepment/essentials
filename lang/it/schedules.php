<?php

/*
 * Italiano. Scritto a mano.
 *
 * «Cron» resta in inglese: è così che si chiama sull'host e nella
 * documentazione di Pelican, ed è esattamente ciò che serve sapere quando
 * questa pagina dice che non sta girando.
 */

return [
    'nav_label' => 'Operazioni pianificate',
    'title' => 'Quale operazione pianificata si è fermata',
    'subheading' => 'Tutte le operazioni pianificate del pannello, le peggiori per prime — bloccate da più di :hours ore, in ritardo, oppure mai eseguite.',

    'how' => 'Pelican mostra le operazioni pianificate dentro ogni server, e il suo stato ha tre parole per loro: inattiva, in elaborazione, attiva. Nessuna dice «questa si è fermata». Un\'esecuzione caduta a metà resta «in elaborazione» per sempre e viene disegnata esattamente come una che sta girando adesso; un\'operazione la cui ora è passata da ore perché il cron è morto continua a chiamarsi attiva. Questa pagina fa l\'altra domanda. Sola lettura — tutto ciò che modifica, esegue o cancella un\'operazione resta sulla pagina di Pelican di quel server.',

    'column_state' => 'Stato',
    'column_name' => 'Operazione',
    'column_server' => 'Server',
    'column_last' => 'Ultima esecuzione',
    'column_next' => 'Prossima esecuzione',

    /*
     * I cinque verdetti. Scritti come ciò che è vero e non come un'istruzione,
     * perché tre di essi sono cose da guardare e due no.
     */
    'state_stuck' => 'Bloccata',
    'state_overdue' => 'In ritardo',
    'state_never' => 'Mai eseguita',
    'state_healthy' => 'A posto',
    'state_off' => 'Inattiva',

    'filter_stuck' => 'Bloccate',
    'filter_overdue' => 'In ritardo',
    'filter_never' => 'Mai eseguite',
    'filter_off' => 'Disattivate',

    'open' => 'Apri sul server',

    'empty' => 'Nessuna operazione pianificata su un server che tu possa raggiungere — o nessuna ferma, se hai un filtro attivo.',
];
