<?php

/*
 * Italiano. Scritto a mano.
 *
 * Credito, rimborsi e note di credito.
 *
 * Qui sotto due parole vengono tenute distinte apposta, dappertutto.
 *
 * Il «credito» è denaro che il negozio tiene da parte per qualcuno. Viene
 * scalato da solo dalla loro prossima fattura, prima ancora che gli venga
 * chiesto di pagare.
 *
 * Un «rimborso» è l'atto di restituire denaro, e ha due destinazioni: la carta
 * da cui è arrivato, oppure l'account come credito. Le parole dicono sempre
 * quale delle due, perché un cliente a cui si dice «sei stato rimborsato» e
 * che poi non trova niente in banca scrive, e fa bene.
 *
 * Una «nota di credito» è il documento. Ne viene scritta una in tutti e due i
 * casi, perché è la traccia che quel denaro non è più dovuto al negozio - non
 * dice dove è andato.
 */

return [
    // ---- che cosa vede un cliente ----------------------------------------
    'yours' => 'Il tuo credito',
    'yours_body' => 'Viene scalato automaticamente dalla tua prossima fattura. Non devi farci niente.',
    'applied' => 'Pagato con il tuo credito',
    'payable' => 'Ancora da pagare',

    // ---- il registro, nella finestra del cliente -------------------------
    'held' => 'Credito',
    'none_held' => 'Niente sull\'account',
    'movements' => 'Credito',
    'column' => 'Credito',
    'none' => 'Niente',

    // ---- darne un po' ----------------------------------------------------
    'give' => 'Credito',
    'give_helper' => 'Questo account ha :held. Quello che ci metti viene scalato da solo dalla loro prossima fattura. Un importo negativo toglie di nuovo credito, e tutti e due i movimenti restano nello storico.',
    'amount' => 'Importo',
    'amount_helper' => 'Un importo negativo toglie credito invece di darlo.',
    'reason' => 'Motivo',
    'reason_helper' => 'Il cliente lo vede accanto all\'importo, quindi scrivilo per lui e non per l\'archivio.',
    'given' => ':amount di credito per :who',
    'bad_amount' => 'Quello non è un importo.',
    'give_failed' => 'Il credito non è stato dato',
    'give_failed_body' => 'Non è stato scritto niente. Riprova, e se continua a succedere guarda nel log.',
    'take_failed' => 'Il credito non è stato tolto',
    'take_failed_body' => 'Sull\'account c\'è meno di quanto hai chiesto di togliere. Un saldo non scende mai sotto zero.',

    // ---- che cosa dice un movimento --------------------------------------
    'spent_on' => 'Fattura :number',
    'returned' => 'Rimesso: non è stato possibile scrivere la fattura per cui era',
    'note_line' => 'Nota di credito per la fattura :number',
    'refund_description' => 'Rimborso della fattura :number',

    // ---- restituirlo -----------------------------------------------------
    'refund' => 'Rimborsa',
    'refund_helper' => 'Di questa fattura :left non è ancora stato restituito. In ogni caso viene scritta una nota di credito, così ne resta traccia da tutte e due le parti.',
    'refund_amount_helper' => 'Va bene anche solo una parte. Quello che resta si può restituire più avanti.',
    'refund_reason_helper' => 'Viene stampato sulla nota di credito che il cliente può aprire.',
    'where' => 'Dove va il denaro',
    'where_provider' => 'Indietro, come hanno pagato',
    'where_provider_helper' => 'Il servizio di pagamento lo rimanda alla carta o al conto da cui è arrivato. Possono volerci alcuni giorni perché si veda, e possono rifiutare - un pagamento vecchio, o un metodo che non si inverte.',
    'where_balance' => 'Sul loro account qui',
    'where_balance_helper' => 'Diventa credito e viene scalato dalla loro prossima fattura. Non esce niente dalla banca, e non può fallire.',
    'refunded' => ':amount rimborsati',
    'refunded_body' => 'È stata scritta la nota di credito :number.',
    'refund_failed' => 'Non è stato rimborsato niente',

    // ---- e perché no, un motivo alla volta -------------------------------
    'refused_off' => 'Il credito e i rimborsi sono disattivati per questo pannello.',
    'refused_amount' => 'È più di quanto resta su questa fattura.',
    'refused_no_payment' => 'Nessun pagamento su questa fattura ha ancora tanto dentro, quindi non c\'è niente che un servizio di pagamento possa invertire. Mettilo invece sul loro account.',
    'refused_no_gateway' => 'Il servizio di pagamento con cui è stata pagata non è più acceso, quindi non gli si può chiedere di invertire niente. Mettilo invece sul loro account.',
    'refused_refused' => 'Il servizio di pagamento ha rifiutato. Di solito è un pagamento vecchio o un metodo che non si inverte; il motivo che hanno dato sta nel log. Mettilo invece sul loro account.',
    'refused_note_failed' => 'Il denaro si è mosso ma la nota di credito non si è lasciata scrivere, quindi non è stato registrato niente. Guarda nel log prima di riprovare.',

    // ---- metterci del denaro ---------------------------------------------
    'topup' => 'Aggiungi credito',
    'topup_helper' => 'Hai :held sull\'account. Quello che aggiungi qui viene scalato da solo dalla tua prossima fattura, e qualsiasi fattura che hai già aperta viene saldata con questo appena arriva.',
    'topup_go' => 'Vai al pagamento',
    'topup_amount_helper' => 'Tra :least e :most.',
    'topup_bad' => 'Quell\'importo non si può pagare',
    'topup_failed' => 'Non è stato possibile avviare il pagamento. Riprova, e se continua a succedere segnalalo a chi gestisce questo pannello.',
    'topup_line' => 'Credito aggiunto sull\'account',
    'topup_reason' => 'Aggiunto sulla fattura :number',

    // ---- dove viene mostrato ---------------------------------------------
    'menu' => ':amount di credito',
    'held_helper' => 'Viene scalato da solo dalla tua prossima fattura. Puoi aggiungerne nella pagina delle fatture.',
];
