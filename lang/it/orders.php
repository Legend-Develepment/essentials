<?php

/*
 * Italiano. Scritto a mano.
 *
 * Ordini: che cosa qualcuno ha comprato e che cosa ne è venuto fuori.
 *
 * I quattro stati qui sotto parlano di soldi, non del server. Se il server in
 * questo momento sia acceso è la domanda di Pelican, e trova risposta nelle
 * pagine di Pelican. Le parole qui tengono le due cose separate.
 */

return [
    'title' => 'Ordini',
    'nav_label' => 'Ordini',
    'subheading' => 'Tutto quello che è stato comprato, il server che ne è nato e a che punto sta.',

    // ---- la tabella ------------------------------------------------------
    'column_order' => 'Ordine',
    'column_customer' => 'Cliente',
    'column_package' => 'Pacchetto',
    'column_server' => 'Server',
    'column_state' => 'Stato',
    'column_due' => 'Prossima scadenza',

    'no_server' => 'Non ancora creato',
    'no_due' => 'Una tantum',
    'gone_customer' => 'Account eliminato',
    'gone_package' => 'Pacchetto eliminato',
    'overdue_days' => ':days giorni di ritardo',

    'state_pending' => 'In attesa',
    'state_active' => 'Attivo',
    'state_suspended' => 'Sospeso',
    'state_cancelled' => 'Annullato',

    // ---- i pulsanti ------------------------------------------------------
    'retry' => 'Crea di nuovo',
    'retry_confirm' => 'Rimette la creazione in coda. Non cambia nient\'altro e la fattura resta pagata.',
    'retrying' => 'Messo in coda',

    'suspend' => 'Sospendi',
    'suspend_confirm' => 'Ferma il server con la sospensione di Pelican. File, database e backup restano dove sono, e pagare la fattura la toglie.',
    'suspended' => 'Sospeso',

    'unsuspend' => 'Togli la sospensione',
    'unsuspended' => 'È di nuovo in funzione',

    'change_due' => 'Cambia la scadenza',
    'change_due_helper' => 'Quando viene scritta la prossima fattura. Vuoto significa mai: l\'ordine smette di rinnovarsi senza essere annullato.',

    'cancel' => 'Annulla',
    'cancel_confirm' => 'Il servizio resta attivo fino al :date e non viene più fatturato. Quel giorno il server viene cancellato, con tutto quello che contiene. Il cliente viene avvisato di entrambe le cose adesso.',
    'cancelled' => 'Annullato',

    'saved' => 'Salvato',
    'refused' => 'Non è cambiato nulla',
    'refused_body' => 'L\'ordine non è in uno stato che lo permetta. Ricarica la pagina e guardalo di nuovo.',

    // ---- che cosa sente il cliente ---------------------------------------
    'bell_ready' => 'Il tuo server è pronto',
    'bell_ready_body' => ':server è stato creato e aspetta che tu lo avvii.',
    'bell_suspended' => 'Il tuo server è stato sospeso',
    'bell_suspended_body' => 'Una fattura è rimasta non pagata oltre il periodo di tolleranza. Pagarla riavvia il server; non è stato cancellato nulla.',

    // ---- che cosa sente chi amministra ------------------------------------
    'bell_failed' => 'L\'ordine :number non è stato creato',
    'no_allocation' => 'Nessun node di questo pacchetto ha una allocation libera. Aggiungine una e riprova a creare.',
    'no_reason' => 'Il pannello ha rifiutato senza dire perché.',
    'not_paid' => 'A questo ordine non corrisponde nessuna fattura pagata, quindi non è stato creato niente. Se invece è stato pagato, la fattura su cui è stato pagato non elenca questo ordine - segnalalo a chi gestisce questo pannello.',

    // ---- il server che ne nasce ------------------------------------------
    'server_description' => 'Comprato nel negozio, ordine :number.',
    'server_fallback' => 'Server',
    'state_ending' => 'In chiusura',
    'ends_on' => 'Termina il :date',
    'no_more_dues' => 'Non viene più fatturato',
    'cancel_confirm_open' => 'Ferma subito i rinnovi e restituisce il posto nella disponibilità. Il server resta in funzione: questo pacchetto non ha una durata minima, quindi non c\'è una data a cui arrivare. Cancella il server in Pelican quando il cliente ha finito con esso.',
    'terminate' => 'Ferma ed elimina',
    'terminate_heading' => 'Eliminare questo server?',
    'terminate_confirm' => 'Il server viene eliminato adesso, con i suoi file, i suoi database e i suoi backup. Non c\'è modo di tornare indietro e non si aspetta la fine del contratto. Annulla invece, se il cliente deve tenerlo fino alla data che gli è stata data.',
    'terminate_go' => 'Eliminalo',
    'terminated' => 'Eliminato',
    'terminated_body' => 'Il server non c\'è più e l\'ordine è chiuso.',
    'bell_ending' => 'Il tuo :package termina il :date',
    'bell_ending_open' => 'Il tuo :package è stato annullato',
    'bell_ending_body' => 'Non ti verrà più fatturato. Tutto quello che c\'è sul server viene cancellato quando si ferma, quindi fai una copia di quello che vuoi tenere.',
    'bell_ended' => 'Il tuo :package è terminato',
    'bell_ended_body' => 'Il contratto è arrivato alla fine e il server è stato eliminato.',
    'bell_undeleted' => 'L\'ordine :number non è stato eliminato',
    'bell_undeleted_body' => 'Il pannello ha rifiutato di eliminare il server. L\'ordine è chiuso e nessuno verrà fatturato per esso, ma il server è ancora lì e va rimosso in Pelican.',
    'bell_undelivered' => 'Il file dell\'ordine :number è ancora qui',
    'bell_undelivered_body' => 'Il server è stato creato, ma non è stato possibile metterci dentro il file caricato dal cliente. È ancora nello storage del pannello, e il motivo è in storage/logs.',
    'by_customer' => 'Terminato dal cliente',
    'by_admin' => 'Terminato da noi',
    'filter_by' => 'Chi ha terminato',
    'details' => 'Dettagli',
    'details_of' => 'Ordine :number',
    'close' => 'Chiudi',
    'detail_package' => 'Pacchetto',
    'detail_placed' => 'Ordinato',
    'detail_built' => 'Server creato',
    'detail_due' => 'Prossima scadenza',
    'detail_ends' => 'Termina',
    'detail_suspended' => 'Sospeso',
    'detail_cancelled' => 'Annullato',
    'detail_file_in' => 'File inserito',
    'detail_file_waiting' => 'File',
    'detail_file_waiting_value' => 'Caricato, in attesa che il server venga creato.',
    'detail_note' => 'Ultimo problema',

    'empty' => 'Non è ancora stato comprato nulla',
    'empty_body' => 'Gli ordini compaiono qui appena qualcuno compra un pacchetto.',

    // ---- rinnovi ---------------------------------------------------------
    'filter_late' => 'In ritardo con una fattura',
    'run_renewals' => 'Esegui i rinnovi adesso',
    'run_renewals_confirm' => 'Fa quello che fa il passaggio notturno: scrive la fattura successiva per tutto ciò che scade a breve, e ferma i server dietro a una fattura rimasta non pagata oltre il periodo di tolleranza.',
    'renewals_queued' => 'Messo in coda',
    'renewals_queued_body' => 'Gira in coda. Ricarica tra un momento per vedere cosa è cambiato.',
];
