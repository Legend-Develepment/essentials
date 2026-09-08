<?php

/*
 * Italiano. Scritto a mano.
 *
 * Le impostazioni del negozio, e più avanti il negozio stesso.
 *
 * Due lettori condividono questo file di proposito. La metà delle impostazioni
 * la legge l'amministratore; la metà pubblica e quella del cliente - aggiunte
 * man mano che il negozio cresce - le legge gente che forse non ha mai sentito
 * parlare di Pelican, e ogni frase lì deve essere scritta per loro.
 */

return [
    'title' => 'Impostazioni del negozio',
    'nav_label' => 'Impostazioni del negozio',
    'subheading' => 'La valuta, la tassa, come vengono numerate le fatture e cosa dice la pagina pubblica. Quello che è in vendita sta nella pagina Pacchetti.',

    // ---- dov'è -----------------------------------------------------------
    'address' => 'Il negozio pubblico è su',
    'address_off' => 'La pagina pubblica è spenta. Accendi «Pagina pubblica del negozio» nell\'elenco delle funzioni nella pagina Impostazioni di Essentials e risponderà su :url.',

    // ---- generale --------------------------------------------------------
    'section_general' => 'Denaro',
    'section_general_helper' => 'Una valuta per tutto il negozio. Ogni prezzo di ogni pacchetto è un numero in essa.',
    'currency' => 'Valuta',
    'currency_helper' => 'Cambiarla non converte nulla: i prezzi sui pacchetti sono numeri, e dopo un cambio sono numeri nella nuova valuta.',
    'tax' => 'Tassa',
    'tax_helper' => 'Una percentuale aggiunta a ogni fattura come riga a sé. I prezzi sui pacchetti sono al netto. Zero per nessuna.',
    'tax_suffix' => '%',
    'prefix' => 'I numeri di fattura iniziano con',
    'prefix_helper' => 'Seguito da un numero che cresce. INV- dà INV-000001.',

    // ---- rinnovi ---------------------------------------------------------
    'section_renewals' => 'Rinnovi',
    'section_renewals_helper' => 'Per i pacchetti fatturati al mese, al trimestre o all\'anno. Un pacchetto una tantum non è mai toccato da questo.',
    'notice_days' => 'Fattura questi giorni prima della fine del periodo',
    'notice_days_helper' => 'Quando viene creata la fattura successiva e il cliente ne viene informato.',
    'grace' => 'Sospendi questi giorni dopo la scadenza di una fattura',
    'grace_helper' => 'Una fattura non pagata oltre questo sospende il server — la sospensione di Pelican stesso, tolta non appena la fattura è pagata. Il negozio non elimina mai nulla.',
    'days' => 'giorni',

    // ---- la pagina pubblica ----------------------------------------------
    'section_public' => 'La pagina pubblica',
    'section_public_helper' => 'La legge gente senza account. Se viene servita o no è l\'interruttore «Pagina pubblica del negozio» nell\'elenco delle funzioni.',
    'heading' => 'Titolo',
    'heading_helper' => 'Lasciato vuoto, viene usato il nome del pannello.',
    'note' => 'Una riga sopra i pacchetti',
    'note_helper' => 'Per dire chi sei, o cosa ottiene chi compra. Testo semplice.',
    'terms_url' => 'Condizioni',
    'terms_url_helper' => 'Un indirizzo https. Se impostato, comprare vuol dire spuntare una casella che vi rimanda.',

    // ---- pagare a mano ---------------------------------------------------
    'section_manual' => 'Pagare senza un fornitore',
    'section_manual_helper' => 'Mostrato su una fattura non pagata finché nessun fornitore di pagamento è acceso: coordinate bancarie, o dove mandare i soldi. Testo semplice.',
    'pay_note' => 'Come pagare',
    'pay_note_helper' => 'Lascialo vuoto e una fattura non pagata dice solo che non è pagata.',

    // ---- i pulsanti ------------------------------------------------------
    'save' => 'Salva',
    'saved' => 'Salvato',
    'save_failed' => 'Non è stato salvato nulla',

    /* ---------------------------------------------------------------------
     * Il negozio vero e proprio, da qui in giù.
     *
     * Un lettore del tutto diverso: qualcuno che compra un server, che forse
     * non ha mai sentito nominare Pelican e non sa che cosa sia un egg. Niente
     * qui sotto usa le parole del pannello, e ogni frase risponde alla domanda
     * che un cliente si fa davvero in quel punto della pagina.
     * ------------------------------------------------------------------- */

    // ---- il negozio ------------------------------------------------------
    'store_title' => 'Negozio',
    'store_nav_label' => 'Negozio',
    'store_subheading' => 'Scegli un server. Viene creato per te appena la fattura è pagata.',
    'store_empty' => 'In questo momento non c\'è niente in vendita',
    'store_empty_body' => 'Torna più tardi, oppure chiedi a chi tiene questo pannello.',

    'buy' => 'Compra',
    'sold_out' => 'Esaurito',
    'plus_setup' => 'più :amount una tantum',

    'spec_memory' => ':amount MiB di memoria',
    'spec_disk' => ':amount MiB di disco',
    'spec_cpu' => ':amount% di CPU',
    'spec_backups' => ':count backup',
    'spec_databases' => ':count database',

    // ---- la pagina pubblica ----------------------------------------------
    'public_empty' => 'In questo momento non c\'è niente in vendita',
    'public_empty_body' => 'Torna più tardi.',
    'to_panel' => 'Accedi',
    'terms' => 'Condizioni',
    'sign_in_note' => 'Scegli un server qui sotto. Accedi per concludere, e viene creato appena la fattura è pagata.',

    // ---- la cassa --------------------------------------------------------
    'checkout_title' => 'Cassa',
    'tax_line' => 'IVA (:rate%)',
    'coupon' => 'Codice sconto',
    'coupon_placeholder' => 'Se ne hai uno',
    'coupon_bad' => 'Quel codice non vale qui.',
    'coupon_good' => 'Codice applicato.',
    'agree' => 'Accetto le',
    'place_order' => 'Invia l\'ordine',
    'place_order_note' => 'Questo scrive una fattura. Non viene addebitato nulla finché non paghi, e il server viene creato appena è pagata.',
    'back_to_store' => 'Torna al negozio',

    'placed' => 'Ordine inviato',
    'placed_body' => 'La fattura :number ti aspetta nella tua pagina di fatturazione.',

    'refused' => 'Non è stato possibile comprarlo',
    'refused_gone' => 'Non è più in vendita.',
    'refused_sold_out' => 'L\'ultimo è andato.',
    'refused_bad_coupon' => 'Il codice sconto non vale per questo.',
    'refused_failed' => 'Qualcosa è andato storto scrivendo l\'ordine. Non è stato addebitato nulla. Riprova, e dillo a chi tiene questo pannello se continua a succedere.',

    // ---- fatturazione ----------------------------------------------------
    'billing_title' => 'Fatturazione',
    'billing_nav_label' => 'Fatturazione',
    'billing_subheading' => 'Quello che hai comprato e quello che devi.',
    'your_orders' => 'I tuoi ordini',
    'your_invoices' => 'Le tue fatture',
    'no_orders' => 'Non hai ancora comprato nulla',
    'no_orders_body' => 'Tutto quello che compri compare qui con il suo server e le sue date.',
    'no_invoices' => 'Ancora nessuna fattura',
    'to_store' => 'Vai al negozio',
    'renews' => 'Si rinnova il',
    'ask_how_to_pay' => 'Chiedi a chi tiene questo pannello come pagare. Qui non lo hanno ancora scritto.',
    'order_pending' => 'In attesa che la fattura venga pagata. Subito dopo il server viene creato.',
    'order_suspended' => 'Fermo per una fattura non pagata. Pagarla riavvia il server: non è stato cancellato nulla.',
];
