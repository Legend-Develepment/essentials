<?php

/*
 * Italiano. Scritto a mano.
 *
 * «Swap», «Load average», «Wings» e «Uptime» restano in inglese: sono i nomi
 * con cui si ritrovano sull'host e nell'interfaccia di Pelican stesso.
 */

return [
    'title' => 'Stato del sistema',
    'nav_label' => 'Stato del sistema',
    'subheading' => 'La macchina su cui gira il pannello stesso, cosa ci sta girando, e accanto ogni nodo che hai chiesto.',

    'options' => 'Opzioni',
    'enabled' => 'Mostra nella barra laterale',
    'enabled_helper' => 'Spento toglie la voce dalla barra laterale. La pagina mantiene il suo indirizzo, quindi è sempre lì per riaccenderla.',

    'refresh' => 'Rileggi ogni',
    'refresh_helper' => 'L\'intera pagina viene richiesta di nuovo con questo intervallo. Spento la lascia com\'era quando l\'hai aperta.',
    'refresh_off' => 'Solo quando la apro',
    'refresh_seconds' => ':seconds secondi',

    'blocks' => 'Mostra',
    'blocks_helper' => 'Spuntato vuol dire visibile. «Disco» è una scheda per filesystem, così una partizione radice piena non resta nascosta dietro un mount di dati mezzo vuoto.',
    'block_cpu' => 'Processore',
    'block_memory' => 'Memoria',
    'block_swap' => 'Swap',
    'block_disk' => 'Disco',
    'block_load' => 'Load average',
    'block_uptime' => 'Uptime',
    'block_system' => 'Sistema',
    'block_version' => 'Versione del pannello',
    // Non compare mai - una scheda di nodo porta il nome del nodo stesso - ma
    // blank() la chiede, e una chiave mancante che stampa il proprio nome è un
    // ripiego scadente.
    'block_node' => 'Nodo',

    'nodes' => 'Nodi da mostrare',
    'nodes_helper' => 'Una scheda ciascuno, accanto all\'host del pannello. Nulla di spuntato non ne mostra nessuno - la dashboard ha già un blocco con tutti i nodi. Ognuno viene chiesto al proprio daemon, quindi un intervallo corto e una lista lunga sono molte richieste.',

    'section_usage' => 'Utilizzo',
    'section_host' => 'Questo pannello',
    'section_nodes' => 'Nodi',

    'disk_panel' => 'Il pannello vive qui',
    'wings' => 'Wings :version',
    'version_installed' => 'Installata',
    'version_latest' => 'Più recente',
    'version_current' => 'Aggiornato',
    'version_update' => 'Aggiornamento disponibile',
    'version_unknown' => 'Non è stato possibile controllare',

    /*
     * Cosa offre una scheda rimasta indietro.
     *
     * Un link al rilascio invece di un pulsante che aggiorna, perché da qui non
     * c'è nulla da aggiornare: Pelican non ha un comando di aggiornamento, e
     * Wings non ha un endpoint che sostituisca il proprio binario. L'indicazione
     * dice dove il lavoro avviene davvero, così nessuno va a cercare un
     * pulsante che non è mai stato possibile.
     */
    'version_release' => 'Cosa c\'è di nuovo',
    'version_how_panel' => 'Apre le note di rilascio. Il pannello si aggiorna sulla macchina su cui gira - il pannello non può sostituire i propri file, e nessun plugin può eseguire comandi di shell.',
    'version_how_wings' => 'Apre le note di rilascio. Wings si aggiorna sul nodo stesso - il pannello non ha nessun canale verso un programma che gira su un\'altra macchina.',

    'wings_latest' => 'Più recente :version',
    'load_cores' => ':percent % di :cores processori',
    'load_windows' => ':five su 5 min · :fifteen su 15 min',
    'uptime_since' => 'Dal :date',
    'unavailable' => 'Non disponibile su questo host',

    'fact_os' => 'Sistema operativo',
    'fact_hostname' => 'Nome host',
    'fact_php' => 'PHP',
    'fact_cores' => 'Processori',
    'fact_processes' => 'Processi',
];
