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
    'grace_helper' => 'Una fattura non pagata oltre questo sospende il server — la sospensione di Pelican stesso, tolta non appena la fattura è pagata. La sospensione in sé non elimina nulla.',
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
    'to_account' => 'Il mio account',
    'filter_all' => 'Tutto',
    'filter_label' => 'Mostra',
    'includes' => 'Include',
    'public_count' => ':count in vendita',

    // ---- la cassa --------------------------------------------------------
    'checkout_title' => 'Cassa',
    'tax_line' => 'IVA (:rate%)',
    'coupon' => 'Codice sconto',
    'asks' => 'Il tuo server',
    'upload_default' => 'Il tuo file',
    'upload_help' => 'Un file zip. Va nel tuo server quando viene creato.',
    'upload_busy' => 'Caricamento…',
    'what_is_this' => 'Che cos\'è?',
    'refused_no_file' => 'Questo pacchetto ha bisogno di un file, e non ne è stato scelto nessuno.',
    'refused_not_zip' => 'Quello deve essere un file zip.',
    'refused_too_big' => 'Quel file è troppo grande perché questo pannello lo prenda.',
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
    'order_ending' => 'Termina il :date. Non viene più fatturato, e quel giorno viene eliminato tutto quello che c\'è sopra.',
    'order_ending_open' => 'Annullato. Non viene più fatturato e resta in funzione finché non viene rimosso.',

    // ---- pagare ----------------------------------------------------------
    'pay_with' => 'Paga con',
    'pay_now' => 'Paga',
    'pay_description' => 'Fattura :number',
    'pay_thanks' => 'Grazie. La fattura è pagata.',
    'pay_pending' => 'Il servizio non lo ha ancora confermato. Questa pagina si aggiorna appena lo fa.',
    'pay_refused' => 'Non è partito',
    'pay_refused_body' => 'Non è stato possibile aprire il pagamento. Prova in un altro modo, oppure chiedi a chi tiene questo pannello.',
    'gateway_mollie' => 'Mollie',

    // ---- le impostazioni del servizio ------------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'Accetta iDEAL, carte, Bancontact e il resto con un unico account. Test e live sono la stessa impostazione: è la chiave stessa a dire a quale account appartiene.',
    'mollie_on' => 'Offri Mollie',
    'mollie_on_helper' => 'Spento toglie il pulsante da ogni fattura. Quello che è già pagato resta pagato.',
    'mollie_key' => 'Chiave API',
    'mollie_key_helper' => 'Dalla sezione Developers del tuo pannello Mollie. Non viene mai scritta in un file di impostazioni esportato.',
    'mollie_hook' => 'Indirizzo del webhook',
    'mollie_hook_helper' => 'Mollie scriverà a :url - il tuo pannello deve essere raggiungibile lì da internet.',

    'gateway_stripe' => 'Carta',

    'section_stripe' => 'Stripe',
    'section_stripe_helper' => 'Accetta carte su una pagina disegnata da Stripe, così nessun numero di carta arriva mai a questo pannello. Test e live stanno nel prefisso della chiave, non in un interruttore.',
    'stripe_on' => 'Offri Stripe',
    'stripe_on_helper' => 'Spento toglie il pulsante da ogni fattura. Quello che è già pagato resta pagato.',
    'stripe_key' => 'Chiave segreta',
    'stripe_key_helper' => 'Quella che inizia con sk_, in Developers, API keys. Non viene mai scritta in un file di impostazioni esportato.',
    'stripe_hook' => 'Segreto di firma',
    'stripe_hook_key_helper' => 'Il valore whsec_ che Stripe mostra quando aggiungi l\'indirizzo qui sotto. Senza di esso i loro messaggi non si possono dimostrare autentici e vengono ignorati.',
    'stripe_hook_helper' => 'Aggiungi :url come endpoint in Developers, webhooks, per l\'evento checkout.session.completed.',

    'gateway_paypal' => 'PayPal',

    'section_paypal' => 'PayPal',
    'section_paypal_helper' => 'L\'unico servizio in cui il denaro si muove al ritorno del cliente e non mentre è ancora su PayPal: una scheda chiusa lascia quindi una fattura non pagata, non un pagamento perso.',
    'paypal_on' => 'Offri PayPal',
    'paypal_on_helper' => 'Spento toglie il pulsante da ogni fattura. Quello che è già pagato resta pagato.',
    'paypal_sandbox' => 'Sandbox',
    'paypal_sandbox_helper' => 'Parla con l\'account di prova di PayPal invece che con quello vero. I loro client id si somigliano nei due casi, ed è proprio per questo che esiste questo interruttore.',
    'paypal_id' => 'Client ID',
    'paypal_secret' => 'Secret',
    'paypal_id_helper' => 'Dall\'app che hai creato in Apps & Credentials. Controlla che la scheda corrisponda all\'interruttore qui sopra.',
    'paypal_secret_helper' => 'Accanto al client ID, dietro Show. Non viene mai scritto in un file di impostazioni esportato.',
    'paypal_hook' => 'ID del webhook',
    'paypal_hook_id_helper' => 'L\'ID che PayPal dà al webhook dopo che lo aggiungi, non l\'indirizzo. Senza di esso i loro messaggi non si possono far verificare da loro e vengono ignorati.',
    'paypal_hook_helper' => 'Aggiungi :url come webhook su quell\'app, per PAYMENT.CAPTURE.COMPLETED, poi incolla qui l\'ID ricevuto.',

    // ---- la pagina di pagamento ------------------------------------------
    'pay_title' => 'Paga',
    'pay_subheading' => 'Quello che devi, e i modi per saldarlo.',
    'pay_choose' => 'Come vuoi pagare?',
    'pay_choose_body' => 'Qualunque cosa scegli, concludi sulla loro pagina e torni qui subito dopo.',
    'pay_safe' => 'Per pagare vieni mandato dal servizio. I dati della tua carta non arrivano mai a questo pannello.',
    'pay_no_ways' => 'Appena il denaro arriva, la fattura passa a pagata e il tuo server viene preparato.',
    'free' => 'Niente da pagare',
    'free_body' => 'Un codice sconto ha coperto tutta questa fattura, quindi non c\'è nulla da pagare. Premi il pulsante ed è fatta.',
    'free_go' => 'Concludi',
    'free_done' => 'Saldata',
    'free_done_body' => 'Non c\'era nulla da pagare, quindi è chiusa. Il tuo server viene preparato ora.',
    'pay_gone' => 'Quella fattura non esiste',
    'pay_gone_body' => 'Potrebbe essere stata ritirata, oppure l\'indirizzo è sbagliato.',
    'pay_already' => 'Questa è già pagata',
    'pay_already_body' => 'Niente altro da fare. Tutto quello che la aspettava è già in arrivo.',
    'pay_withdrawn' => 'Questa è stata ritirata',
    'pay_withdrawn_body' => 'È fuori dai conti e non va pagata. Chiedi a chi tiene questo pannello se ti sembra strano.',
    'back_to_billing' => 'Torna alla fatturazione',

    'gateway_mollie_note' => 'iDEAL, Bancontact, carta e altro',
    'gateway_stripe_note' => 'Visa, Mastercard, American Express',
    'gateway_paypal_note' => 'Il tuo saldo PayPal, o una carta tramite PayPal',

    // ---- servizi e fatture, separati -------------------------------------
    'services_title' => 'I miei servizi',
    'services_nav_label' => 'I miei servizi',
    'services_subheading' => 'Quello per cui stai pagando, e il server nato da ciascuno.',
    'open_server' => 'Apri il server',
    'no_server_yet' => 'In preparazione',

    'invoices_title' => 'Fatture',
    'invoices_subheading' => 'Quello che ti è stato fatturato e quello che resta da pagare.',
    'no_invoices_body' => 'Tutto quello che compri viene fatturato qui, e qui resta anche dopo essere stato pagato.',

    // ---- il negozio come pagina iniziale ---------------------------------
    'section_landing' => 'Dove sta il negozio',
    'section_landing_helper' => 'Se il negozio è la porta d\'ingresso del pannello, per i clienti e per chi non ha fatto l\'accesso.',
    'landing' => 'Apri prima il negozio',
    'landing_helper' => 'Acceso, il negozio è la prima pagina dopo l\'accesso e l\'elenco dei server si sposta accanto. I tuoi servizi e le tue fatture restano a un clic, nell\'intestazione del negozio e nel menu dell\'account. Chi non ha fatto l\'accesso trova il negozio pubblico al posto del modulo di accesso, e gli viene chiesto di accedere solo quando ha scelto un pacchetto - quindi serve accesa anche la pagina pubblica del negozio. Spento, il pannello si apre sull\'elenco dei server come lo disegna Pelican, chi non ha fatto l\'accesso trova il modulo di accesso, e il negozio è una pagina come le altre.',
];
