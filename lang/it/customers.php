<?php

/*
 * Italiano. Scritto a mano.
 *
 * Clienti: il negozio, ma rivolto alla persona invece che alla riga.
 *
 * Ordini, fatture e pagamenti sono ciascuno un elenco di quello che è
 * successo. Questa pagina pone la domanda che ha davvero chi sta rispondendo a
 * un ticket: chi è, che cosa ha, che cosa ha pagato e che cosa resta da
 * pagare. Le parole qui sono scelte per quel momento, non per un rapporto.
 */

return [
    'title' => 'Clienti',
    'nav_label' => 'Clienti',
    'subheading' => 'Tutti quelli che hanno comprato qualcosa, con quello che hanno, quello che hanno pagato e quello che resta da pagare.',

    // ---- la tabella ------------------------------------------------------
    'column_customer' => 'Cliente',
    'column_services' => 'Servizi',
    'column_spent' => 'Pagato',
    'column_outstanding' => 'Da pagare',

    'of_orders' => 'su :count ordinati',
    'nothing_owed' => 'Niente',

    'filter_owing' => 'Ha qualcosa da pagare',
    'filter_active' => 'Ha un servizio attivo',

    // ---- uno di loro -----------------------------------------------------
    'open' => 'Apri',
    'close' => 'Chiudi',
    'servers' => 'Server',
    'since' => 'Cliente dal',
    'their_services' => 'Servizi',
    'their_invoices' => 'Fatture',
    'no_services' => 'Niente di attivo, e niente in attesa di essere creato.',
    'no_invoices' => 'Per questo account non è stata scritta nessuna fattura.',

    'empty' => 'Nessuno ha ancora comprato niente',
    'empty_body' => 'Qui compare chi ha ordinato, non chiunque abbia un account, quindi si riempie con la prima vendita.',
    'who' => 'Chi è',
];
