<?php

/*
 * Italiano. Scritto a mano.
 *
 * Buoni sconto: codici che tolgono qualcosa dalla prima fattura.
 *
 * Solo dalla prima, di proposito, e il testo lo dice dove conta. Un codice che
 * scontasse anche ogni rinnovo sarebbe un cambio di prezzo con una data di
 * scadenza, e chi lo vuole dovrebbe cambiare il prezzo.
 */

return [
    'title' => 'Buoni sconto',
    'nav_label' => 'Buoni sconto',
    'subheading' => 'Codici che tolgono una percentuale o un importo dalla prima fattura. I rinnovi vanno al prezzo del pacchetto.',

    // ---- la tabella ------------------------------------------------------
    'column_code' => 'Codice',
    'column_value' => 'Valore',
    'column_uses' => 'Usato',
    'column_expires' => 'Scade',
    'column_packages' => 'Vale per',
    'column_live' => 'Attivo',

    'never_expires' => 'Senza data di fine',
    'all_packages' => 'Tutto',
    'some_packages' => ':count pacchetti',
    'usable' => 'Si può usare adesso',
    'unusable' => 'Spento, scaduto o esaurito',

    // ---- i pulsanti ------------------------------------------------------
    'new' => 'Nuovo buono',
    'edit' => 'Modifica',
    'delete' => 'Elimina',
    'delete_confirm' => 'Toglie il codice. Le fatture che lo hanno già usato tengono il loro sconto: ognuna conserva quello che le è stato tolto.',
    'deleted' => 'Buono eliminato',
    'saved' => 'Buono salvato',
    'save_failed' => 'Il buono non è stato salvato',
    'taken' => 'Qualcos\'altro usa già quel codice.',
    'invalid' => 'Una percentuale è un numero intero da 1 a 100. Un importo si scrive 12.50 oppure 12,50.',

    // ---- il modulo -------------------------------------------------------
    'section_code' => 'Il codice',
    'section_code_helper' => 'Quello che il cliente digita al momento di pagare.',
    'code' => 'Codice',
    'code_helper' => 'Viene salvato e confrontato in maiuscolo senza spazi, così funziona comunque lo si scriva.',
    'live' => 'Attivo',
    'live_helper' => 'Spento smette di funzionare senza essere eliminato: esce dall\'uso mentre lo sconto che ha dato resta sulle fatture che lo hanno avuto.',

    'section_worth' => 'Quello che toglie',
    'section_worth_helper' => 'Solo dalla prima fattura. Non porta mai una fattura sotto zero.',
    'kind' => 'Tipo',
    'kind_helper' => 'Una parte del prezzo, oppure un importo fisso.',
    'kind_percent' => 'Percentuale',
    'kind_fixed' => 'Importo fisso',
    'value' => 'Valore',
    'value_percent_helper' => 'Un numero intero da 1 a 100.',
    'value_fixed_helper' => 'Nella valuta del negozio. Scrivilo come 12.50 oppure 12,50.',

    'section_limits' => 'Limiti',
    'section_limits_helper' => 'Qui è tutto facoltativo. Un codice senza nessuno di questi vale per tutto, per chiunque, per sempre.',
    'max_uses' => 'Quante volte si può usare',
    'max_uses_helper' => 'Contato quando l\'ordine viene fatto, non quando la fattura viene pagata: altrimenti un codice da dieci usi si potrebbe mettere cento volte in una notte.',
    'expires' => 'Scade',
    'expires_helper' => 'Dopo questo momento il codice non funziona più. Vuoto significa che non succede mai.',
    'packages' => 'Pacchetti',
    'packages_helper' => 'Niente spuntato significa ogni pacchetto, ora e in futuro.',

    'empty' => 'Ancora nessun buono',
    'empty_body' => 'Creane uno e funziona alla cassa appena è attivo.',
];
