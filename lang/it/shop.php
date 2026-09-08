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
];
