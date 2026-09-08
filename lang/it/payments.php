<?php

/*
 * Italiano. Scritto a mano.
 *
 * Pagamenti: ogni tentativo di pagare e cosa ne ha detto il servizio.
 *
 * Una riga per tentativo invece che per fattura, perché è quello che è
 * successo. La parola che questa pagina ripete è «tentativo»: un pagamento
 * fallito è un fatto che vale la pena tenere, non un errore da nascondere.
 */

return [
    'title' => 'Pagamenti',
    'nav_label' => 'Pagamenti',
    'subheading' => 'Ogni tentativo di pagare, con ogni servizio. Ricontrolla lo richiede di nuovo al servizio, che è la stessa cosa che fa il loro webhook quando arriva.',

    // ---- la tabella ------------------------------------------------------
    'column_invoice' => 'Fattura',
    'column_gateway' => 'Servizio',
    'column_reference' => 'Loro riferimento',
    'column_amount' => 'Importo',
    'column_state' => 'Stato',
    'column_updated' => 'Ultime notizie',

    'gone_invoice' => 'Fattura eliminata',

    'state_open' => 'In attesa',
    'state_paid' => 'Pagato',
    'state_failed' => 'Fallito',
    'state_cancelled' => 'Abbandonato',

    // ---- i pulsanti ------------------------------------------------------
    'recheck' => 'Ricontrolla',
    'rechecked' => 'Richiesto di nuovo',
    'rechecked_body' => 'Il servizio continua a non dire che è pagato. Non è cambiato nulla.',
    'settled' => 'È pagato',
    'settled_body' => 'La fattura è saldata e tutto quello che la aspettava è in arrivo.',
    'recheck_failed' => 'Non è stato possibile chiedere',
    'recheck_failed_body' => 'Il servizio non ha risposto. Riprova tra un minuto; se continua, controlla la chiave nella pagina Impostazioni del negozio.',
    'no_gateway' => 'Quel servizio è spento',
    'no_gateway_body' => 'Riaccendilo per chiedere di questo pagamento, oppure segna la fattura pagata a mano.',

    'answer' => 'La loro risposta',
    'no_answer' => 'Niente registrato',
    'close' => 'Chiudi',

    'empty' => 'Nessuno ha ancora pagato tramite un servizio',
    'empty_body' => 'I tentativi compaiono qui appena qualcuno preme Paga, che vadano a buon fine o no.',
];
