<?php

/*
 * Italiano. Scritto a mano.
 *
 * Fatture: il documento, la pagina che le elenca e la mail.
 *
 * Tre lettori si dividono questo file. Chi amministra legge la tabella e preme
 * «segna come pagata»; un cliente legge il documento stampabile e la mail; e il
 * documento stesso lo legge mesi dopo chi tiene la contabilità. È per
 * quest'ultimo che le righe doc_ sono asciutte e formali: una fattura non è il
 * posto per il tono del resto del pannello.
 */

return [
    'title' => 'Fatture',
    'nav_label' => 'Fatture',
    'subheading' => 'Quello che è dovuto e quello che è stato pagato. Segnarne una pagata qui fa tutto quello che farebbe pagarla: il server viene creato, uno sospeso torna.',

    // ---- la tabella ------------------------------------------------------
    'column_number' => 'Fattura',
    'column_customer' => 'Cliente',
    'column_order' => 'Ordine',
    'column_total' => 'Totale',
    'column_state' => 'Stato',
    'column_due' => 'Scadenza',

    'kind_order' => 'Prima fattura',
    'kind_renewal' => 'Rinnovo',

    'state_unpaid' => 'Non pagata',
    'state_paid' => 'Pagata',
    'state_cancelled' => 'Ritirata',

    'no_order' => 'Nessun ordine',
    'no_due' => 'Nessuna data',
    'gone_customer' => 'Account eliminato',
    'discount_of' => ':amount di sconto con :code',
    'paid_via' => 'tramite :how',
    'emailed' => 'Inviata',
    'not_emailed' => 'Non inviata',
    'filter_overdue' => 'Scadute',

    // ---- i pulsanti ------------------------------------------------------
    'open' => 'Apri',
    'mark_paid' => 'Segna come pagata',
    'mark_paid_confirm' => 'Registra che il denaro è arrivato. Il server viene creato, uno sospeso riparte e la prossima scadenza avanza, esattamente come se lo avesse detto un servizio di pagamento.',
    'paid' => 'Segnata come pagata',
    'paid_body' => 'Tutto quello che aspettava questa fattura è in arrivo.',
    'already_paid' => 'Era già pagata',

    'withdraw' => 'Ritira',
    'withdraw_confirm' => 'Toglie la fattura dai conti. Si può ritirare solo una non pagata; una fattura pagata è la traccia di un denaro che ha cambiato mani.',
    'withdrawn' => 'Ritirata',
    'withdraw_refused' => 'Si può ritirare solo una fattura non pagata',

    'empty' => 'Ancora nessuna fattura',
    'empty_body' => 'Ne viene scritta una appena qualcuno compra, e poi una per ogni periodo per tutto ciò che si rinnova.',

    // ---- il documento ----------------------------------------------------
    'doc_title' => 'Fattura',
    'doc_number' => 'Numero',
    'doc_issued' => 'Emessa il',
    'doc_due' => 'Scadenza',
    'doc_paid_on' => 'Pagata il',
    'doc_billed_to' => 'Intestata a',
    'doc_from' => 'Da',
    'doc_description' => 'Descrizione',
    'doc_amount' => 'Importo',
    'doc_subtotal' => 'Imponibile',
    'doc_discount' => 'Sconto',
    'doc_total' => 'Totale',
    'doc_how_to_pay' => 'Come pagare',
    'doc_print' => 'Stampa o salva in PDF',
    'doc_back' => 'Torna al pannello',

    // ---- la mail ---------------------------------------------------------
    'mail_subject' => 'Fattura :number',
    'mail_hello' => 'Ciao :name,',
    'mail_intro' => 'Ecco la fattura :number.',
    'mail_open' => 'Apri la fattura',
    'mail_foot' => 'Puoi rileggere questa fattura quando vuoi nella tua pagina di fatturazione.',

    // ---- la campanella ---------------------------------------------------
    'bell_new' => 'Fattura :number',
    'bell_new_body' => 'Ci sono :total da pagare. Apri la tua pagina di fatturazione per farlo.',
    'bell_reminder' => 'La fattura :number è scaduta',
    'bell_reminder_body' => 'È ancora aperta per :total. Il server che paga si ferma il :date se non viene saldata entro allora, e quando succede non viene cancellato nulla di ciò che c\'è sopra.',
];
