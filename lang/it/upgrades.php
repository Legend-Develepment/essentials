<?php

/*
 * Italiano. Scritto a mano.
 *
 * Spostare un servizio attivo da un pacchetto a un altro.
 *
 * Le parole qui tengono distinta una cosa per tutto il file: quanto costa un
 * pacchetto e quanto costa oggi passarci sono due numeri diversi. Il primo sta
 * sullo scaffale; il secondo dipende da quanto è avanti questo servizio nel
 * periodo già pagato, ed è quello a cui qualcuno dice di sì quando preme il
 * pulsante.
 *
 * Nei testi che legge un cliente si evita la parola «upgrade», perché metà di
 * questi spostamenti va nell'altra direzione. Qui si chiama cambio.
 */

return [
    // ---- sulla scheda del servizio ---------------------------------------
    'change' => 'Cambia pacchetto',
    'change_body' => 'Quello che resta del periodo che hai già pagato viene scalato, e gli stessi giorni vengono conteggiati al prezzo nuovo. Sul tuo server non si perde niente.',
    'change_to' => 'Passa a :name',
    'change_confirm' => 'Vuoi passare questo servizio a :name?',
    'change_free' => 'Niente da pagare',
    'costs_now' => ':amount adesso',
    'gives_back' => ':amount indietro',
    'waiting' => 'Cambio concordato',
    'waiting_for' => 'Un cambio a :name aspetta una fattura non pagata.',

    // ---- che cosa succede dopo -------------------------------------------
    'done' => 'Passato a :name',
    'done_body' => 'Il tuo servizio è sul pacchetto nuovo. Tutto quello che ti spettava è sul tuo account.',
    'refused' => 'Il cambio non è stato fatto',

    // ---- e perché no, un motivo alla volta -------------------------------
    'refused_off' => 'Il cambio di pacchetto è disattivato per questo pannello.',
    'refused_not_active' => 'Si può cambiare solo un servizio in funzione. Su uno in attesa, sospeso o in scadenza non c\'è niente da conteggiare.',
    'refused_gone' => 'Il pacchetto su cui sta questo servizio non esiste più, quindi non c\'è niente con cui confrontarlo.',
    'refused_same' => 'È il pacchetto su cui sta già.',
    'refused_egg' => 'Quel pacchetto fa girare un software diverso. Sarebbe un server diverso e non uno più grande, quindi va comprato come tale.',
    'refused_period' => 'Quel pacchetto viene fatturato su un periodo diverso, e quello è un accordo diverso e non uno più grande.',
    'refused_stock' => 'Quel pacchetto è esaurito.',
    'refused_waiting' => 'C\'è già un cambio che aspetta una fattura non pagata per questo servizio. Paga o annulla prima quella.',
    'refused_failed' => 'Non è stato annotato niente, quindi non è cambiato niente. Riprova, e se continua a succedere segnalalo a chi gestisce questo pannello.',
    'refused_server' => 'Al server non è stato possibile dare i nuovi limiti, quindi il servizio è rimasto esattamente com\'era. Chi gestisce questo pannello è stato avvisato.',

    // ---- che cosa dicono i documenti -------------------------------------
    'line' => 'Cambio da :from a :to, per i :days giorni che restano di questo periodo',
    'credit_reason' => 'Cambio a :name',

    // ---- e che cosa sente il proprietario --------------------------------
    'bell_failed' => 'Un cambio di pacchetto è fallito sull\'ordine :number',
    'cold_title' => 'Un cambio di pacchetto è arrivato al pannello ma non al node, sull\'ordine :number',
    'cold_body' => 'Il servizio è su :name e i nuovi limiti sono registrati. Il node non li ha ancora presi e li leggerà la prossima volta che quel server si avvia, quindi fino ad allora il cliente ha ancora la dimensione vecchia. Controlla il node.',
    'gone' => 'Il pacchetto verso cui si stava passando non esiste più.',
    'refused_by_node' => 'Il server non ha accettato i nuovi limiti: :why',

    // ---- rimettere le cose a posto ---------------------------------------
    'retry' => 'Riprova il cambio',
    'retry_confirm' => 'Riprova il cambio di pacchetto. La fattura relativa è già pagata, quindi non viene addebitato niente due volte.',
    'retried' => 'Il cambio è andato a buon fine',
    'retry_failed' => 'È fallito di nuovo. Il motivo sta sull\'ordine.',
];
