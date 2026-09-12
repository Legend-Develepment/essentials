<?php

/*
 * Italiano. Scritto a mano.
 *
 * Extra venduti insieme a un pacchetto.
 *
 * Qui due parole vengono tenute distinte. Quanto *costa* un extra è il suo
 * prezzo, ed è quello che viene addebitato ogni volta. Quanto *costa oggi* è
 * una parte di quello, perché chi ne compra uno a metà mese paga mezzo mese.
 * I testi rivolti al cliente dicono sempre quale dei due intendono.
 *
 * «Non aggiunge niente al server» è una risposta vera e viene detta ad alta
 * voce invece di essere lasciata in bianco, perché l'assistenza prioritaria è
 * una cosa normale da vendere e una casella vuota si legge come un errore.
 */

return [
    'title' => 'Extra',
    'nav_label' => 'Extra',
    'subheading' => 'Cose vendute insieme a un pacchetto: più memoria, un altro slot di backup, oppure qualcosa che è solo una riga sulla fattura.',

    // ---- la tabella -------------------------------------------------------
    'column_name' => 'Extra',
    'column_price' => 'Prezzo',
    'column_adds' => 'Aggiunge',
    'column_sold' => 'In uso',
    'column_live' => 'In vendita',
    'adds_nothing' => 'Niente sul server',

    // ---- il modulo --------------------------------------------------------
    'section_what' => 'Che cos\'è',
    'section_what_helper' => 'Il nome e il prezzo che vede un cliente, e con quali pacchetti si può comprare.',
    'name' => 'Nome',
    'price' => 'Prezzo',
    'price_helper' => 'Quanto costa ogni volta che viene addebitato. Comprato a metà di un periodo, un cliente ne paga una parte, e dal rinnovo successivo il prezzo intero.',
    'billing' => 'Addebitato',
    'billing_helper' => 'Con il servizio significa che torna a ogni rinnovo, finché lo tengono. Una volta sola significa che viene addebitato sulla fattura che lo porta per la prima volta e mai più.',
    'billing_with' => 'A ogni rinnovo',
    'billing_once' => 'Una volta sola',
    'max' => 'Al massimo per servizio',
    'max_helper' => 'Quanti se ne possono avere di questo. Uno è il caso normale; alzalo per qualcosa che si vende a gigabyte.',
    'description' => 'Descrizione',
    'description_helper' => 'Una riga sotto il nome alla cassa. Scrivi cosa fa, non come si chiama.',
    'packages' => 'Pacchetti',
    'packages_helper' => 'Con quali pacchetti si può comprare questo. Niente spuntato significa con tutti, che è quello che di solito sono un\'opzione di assistenza o uno slot di backup.',

    'section_adds' => 'Che cosa aggiunge al server',
    'section_adds_helper' => 'Questi si sommano a quello che il pacchetto dà già, non lo sostituiscono: 4096 nella memoria rende il server più grande di 4 GiB. Due extra uguali si sommano. Lasciali tutti a zero per qualcosa che è solo una riga sulla fattura. Un numero negativo toglie qualcosa, il che è permesso ed è ogni tanto proprio quello che qualcuno vuole.',
    'sort' => 'Ordine',
    'sort_helper' => 'Più basso viene prima alla cassa. A numeri uguali decide il prezzo.',
    'live' => 'In vendita',
    'live_helper' => 'Disattivato, non viene offerto da nessuna parte. Chi ce l\'ha già lo tiene e continua a pagarlo.',

    // ---- i pulsanti -------------------------------------------------------
    'new' => 'Nuovo extra',
    'edit' => 'Modifica',
    'delete' => 'Elimina',
    'delete_confirm' => 'Questo non ce l\'ha nessuno. Eliminarlo lo toglie dall\'elenco per sempre.',
    'delete_sold' => ':count servizi hanno questo. Lo tengono, tengono i limiti che gli ha dato e continuano a pagarlo - quello che sparisce è la voce nell\'elenco, così non può più comprarlo nessuno.',
    'go_live' => 'Metti in vendita',
    'go_offline' => 'Togli dalla vendita',
    'saved' => 'Salvato',
    'deleted' => 'L\'extra è sparito',
    'save_failed' => 'Non salvato',
    'save_failed_body' => 'Non è stato scritto niente. Riprova, e se continua a succedere guarda nel log.',
    'invalid' => 'Un extra ha bisogno di un nome e di un prezzo.',
    'empty' => 'Ancora nessun extra',
    'empty_body' => 'Un extra è qualcosa venduto accanto a un pacchetto: un altro gigabyte, un secondo slot di backup, oppure un servizio che al server non aggiunge proprio niente.',

    // ---- che cosa vede un cliente -----------------------------------------
    'choose' => 'Extra',
    'choose_helper' => 'Sono facoltativi, e puoi aggiungerli o toglierli più avanti.',
    'yours' => 'Extra su questo servizio',
    'add' => 'Aggiungi un extra',
    'add_helper' => 'Adesso paghi quello che resta di questo periodo, e dal rinnovo successivo il prezzo intero.',
    'add_to' => 'Aggiungi :name',
    'add_confirm' => 'Vuoi aggiungere :name a questo servizio?',
    'drop' => 'Togli',
    'drop_confirm' => 'Vuoi togliere :name? La parte non usata di quello che hai pagato torna sul tuo account, e il tuo server cambia subito.',
    'costs_now' => ':amount adesso',
    'free_now' => 'Adesso niente da pagare',
    'then' => 'poi :amount a ogni rinnovo',
    'once_only' => ':amount, una volta sola',
    'each' => 'ciascuno',
    'added' => ':name aggiunto',
    'added_body' => 'Al tuo server è stato dato quello che aggiunge.',
    'dropped' => ':name tolto',
    'dropped_body' => 'Tutto quello che avevi pagato e non usato è sul tuo account.',

    // ---- e quando non si può ----------------------------------------------
    'refused' => 'Non è stato possibile farlo',
    'refused_off' => 'Gli extra sono disattivati per questo pannello.',
    'refused_not_active' => 'Solo a un servizio in funzione si possono aggiungere extra.',
    'refused_gone' => 'Quell\'extra non è più in vendita.',
    'refused_wrong_package' => 'Quell\'extra non si vende con questo pacchetto.',
    'refused_enough' => 'Ne hai già quanti ne può tenere questo servizio.',
    'refused_failed' => 'Non è stato annotato niente, quindi non è cambiato niente. Riprova, e se continua a succedere segnalalo a chi gestisce questo pannello.',
    'refused_server' => 'Il server non ha accettato i nuovi limiti, quindi non è stato cambiato niente e non è stato addebitato niente.',
    'refused_not_yours' => 'Quell\'extra non sta su questo servizio.',

    // ---- che cosa dicono i documenti --------------------------------------
    'line' => ':name × :many, per i :days giorni che restano di questo periodo',
    'credit_reason' => 'Tolto: :name',
    'bell_failed' => 'Non è stato possibile dare un extra al server sull\'ordine :number',

    // ---- le unità, per la tabella di chi amministra -----------------------
    'unit_memory' => 'MiB di memoria',
    'unit_swap' => 'MiB di swap',
    'unit_disk' => 'MiB di disco',
    'unit_cpu' => '% CPU',
    'unit_database_limit' => 'database',
    'unit_allocation_limit' => 'allocation',
    'unit_backup_limit' => 'backup',
];
