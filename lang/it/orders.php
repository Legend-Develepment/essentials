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
    'cancel_confirm' => 'Ferma i rinnovi e restituisce il posto nella disponibilità. Il server resta dov\'è: cancellarlo si fa in Pelican, dove è il suo posto.',
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

    // ---- il server che ne nasce ------------------------------------------
    'server_description' => 'Comprato nel negozio, ordine :number.',
    'server_fallback' => 'Server',

    'empty' => 'Non è ancora stato comprato nulla',
    'empty_body' => 'Gli ordini compaiono qui appena qualcuno compra un pacchetto.',

    // ---- rinnovi ---------------------------------------------------------
    'filter_late' => 'In ritardo con una fattura',
    'run_renewals' => 'Esegui i rinnovi adesso',
    'run_renewals_confirm' => 'Fa quello che fa il passaggio notturno: scrive la fattura successiva per tutto ciò che scade a breve, e ferma i server dietro a una fattura rimasta non pagata oltre il periodo di tolleranza.',
    'renewals_queued' => 'Messo in coda',
    'renewals_queued_body' => 'Gira in coda. Ricarica tra un momento per vedere cosa è cambiato.',
];
