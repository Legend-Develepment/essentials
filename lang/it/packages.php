<?php

/*
 * Italiano. Scritto a mano.
 *
 * Pacchetti: un server che qualcuno può comprare.
 *
 * Lo legge chi allestisce il negozio. Ogni parola qui riguarda il modello e il
 * prezzo; quello che vede un cliente sta in shop.php, perché i due lettori
 * vogliono frasi diverse sulla stessa riga.
 *
 * «egg», «node», «swap», «io» e le parole di Minecraft restano in inglese: sono
 * le parole del modulo server di Pelican, e un pacchetto è quel modulo messo
 * da parte per dopo.
 */

return [
    'title' => 'Pacchetti',
    'nav_label' => 'Pacchetti',
    'subheading' => 'Quello che è in vendita. Ognuno è un modello di server con sopra un prezzo; un cliente ne compra uno e il pannello crea il server.',

    // ---- la tabella ------------------------------------------------------
    'column_name' => 'Pacchetto',
    'column_egg' => 'Egg',
    'column_price' => 'Prezzo',
    'column_stock' => 'Disponibilità',
    'column_live' => 'In vendita',
    'column_orders' => 'Venduti',

    'live' => 'In vendita',
    'offline' => 'Non in vendita',
    'no_egg' => 'Nessun egg — non può essere costruito',

    'stock_unlimited' => 'Illimitata',
    'stock_left' => 'Ne restano :count',
    'stock_out' => 'Esaurito',

    // ---- periodi ---------------------------------------------------------
    'period_once' => 'Una tantum',
    'period_month' => 'Mensile',
    'period_quarter' => 'Trimestrale',
    'period_year' => 'Annuale',

    // Dopo un prezzo: «€ 12,50 al mese».
    'per_once' => 'una volta',
    'per_month' => 'al mese',
    'per_quarter' => 'a trimestre',
    'per_year' => 'all\'anno',

    // ---- azioni ----------------------------------------------------------
    'new' => 'Nuovo pacchetto',
    'edit' => 'Modifica',
    'duplicate' => 'Duplica',
    'copy_suffix' => ' (copia)',
    'go_live' => 'Metti in vendita',
    'go_offline' => 'Togli dalla vendita',
    'delete' => 'Elimina',
    'delete_confirm' => 'Rimuove il pacchetto. Ciò che è già stato comprato non viene toccato: gli ordini conservano la propria copia di ciò che erano.',
    'delete_refused' => 'Non eliminato',
    'delete_refused_body' => 'Su questo pacchetto sono stati fatti degli ordini, e puntano a esso. Toglilo piuttosto dalla vendita; resta per i registri e nessuno può comprarlo.',
    'deleted' => 'Pacchetto eliminato',
    'saved' => 'Pacchetto salvato',
    'save_failed' => 'Impossibile salvare il pacchetto',
    'price_invalid' => 'Questo non è un importo. Scrivilo come 12.50 o 12,50.',

    // ---- il modulo: che cos'è --------------------------------------------
    'section_basics' => 'Il pacchetto',
    'section_basics_helper' => 'Quello che un cliente vede sulla scheda.',
    'name' => 'Nome',
    'name_helper' => 'Come si chiama nel negozio.',
    'slug' => 'Indirizzo',
    'slug_helper' => 'Minuscole, cifre e trattini. Lasciato vuoto viene ricavato dal nome. Cambiarlo dopo rompe un link che qualcuno ha salvato.',
    'description' => 'Descrizione',
    'description_helper' => 'Qualche riga sotto il nome. Testo semplice.',
    'live_field' => 'In vendita',
    'live_helper' => 'Disattivato tiene il pacchetto qui e non lo mostra a nessuno. Un pacchetto senza egg non viene mai mostrato, qualunque cosa dica questo.',
    'sort' => 'Ordine',
    'sort_helper' => 'Più basso viene prima nel negozio.',

    // ---- il modulo: cosa diventa -----------------------------------------
    'section_server' => 'Il server che diventa',
    'section_server_helper' => 'Le stesse domande che fa Pelican quando crei un server a mano, risposte una volta qui e usate a ogni vendita.',
    'egg' => 'Egg',
    'egg_helper' => 'Sceglierne uno riempie l\'immagine, il comando di avvio e ogni variabile con i valori predefiniti dell\'egg. Cambiali dopo come vuoi.',
    'image' => 'Immagine Docker',
    'image_helper' => 'Una delle immagini che l\'egg offre.',
    'image_default' => 'La prima immagine dell\'egg',
    'startup' => 'Comando di avvio',
    'startup_helper' => 'Uno dei comandi che l\'egg offre.',
    'startup_default' => 'Il primo comando dell\'egg',
    'environment' => 'Variabili',
    'environment_helper' => 'Le variabili dell\'egg e il loro valore. Tutto ciò che l\'egg ha e non è elencato qui prende il suo valore predefinito quando il server viene creato.',
    'env_key' => 'Variabile',
    'env_value' => 'Valore',
    'nodes' => 'Node',
    'nodes_helper' => 'Dove un server di questo pacchetto può essere creato, provati in quest\'ordine finché uno ha un indirizzo libero. Niente spuntato significa qualsiasi node.',

    // ---- il modulo: limiti -----------------------------------------------
    'section_limits' => 'Limiti',
    'section_limits_helper' => 'Quello che riceve il server. Gli stessi campi del modulo server di Pelican, nelle stesse unità.',
    'memory' => 'Memoria',
    'disk' => 'Disco',
    'cpu' => 'CPU',
    'cpu_helper' => 'Percentuale di un core: 100 è un core, 200 sono due, 0 è nessun limite.',
    'swap' => 'Swap',
    'swap_helper' => '0 è nessuna, -1 è illimitata.',
    'io' => 'Peso IO a blocchi',
    'io_helper' => 'Il valore predefinito di Pelican è 500. Lascialo lì a meno che tu non sappia perché no.',
    'threads' => 'CPU pinning',
    'threads_helper' => 'Quali core, come li scrive Pelican: 0,1 oppure 0-3. Vuoto è qualsiasi.',
    'oom_killer' => 'OOM killer',
    'oom_killer_helper' => 'Se il kernel può terminare il server quando finisce la memoria.',
    'databases' => 'Database',
    'allocations' => 'Allocation aggiuntive',
    'backups' => 'Backup',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- il modulo: i soldi ----------------------------------------------
    'section_price' => 'Prezzo e disponibilità',
    'section_price_helper' => 'Nella valuta del negozio, impostata nella pagina Impostazioni del negozio. Al netto delle tasse: la tassa viene aggiunta in fattura come riga a sé.',
    'price' => 'Prezzo',
    'price_helper' => 'Per periodo. Scrivilo come 12.50 o 12,50.',
    'setup_fee' => 'Costo di attivazione',
    'setup_fee_helper' => 'Addebitato una volta, sulla prima fattura. Zero per nessuno.',
    'period' => 'Fatturato',
    'period_helper' => 'Una tantum si paga una volta e si tiene. Gli altri ricevono una nuova fattura ogni periodo; una non pagata sospende il server dopo il periodo di tolleranza nella pagina Impostazioni del negozio.',
    'stock' => 'Disponibilità',
    'stock_helper' => 'Quanti possono essere venduti contemporaneamente, contando ogni ordine non annullato. Vuoto è illimitato.',
    'term' => 'Durata minima',
    'term_helper' => 'Per quanto tempo qualcuno si impegna una volta comprato. Zero è nessun impegno: può annullare e si ferma alla fine del periodo che ha pagato.',
    'term_unit' => 'Contata in',
    'term_unit_helper' => 'Giorni, mesi o anni. Un ordine annullato arriva fino alla fine di questa durata e quel giorno il server viene eliminato.',
    'unit_day' => 'Giorni',
    'unit_month' => 'Mesi',
    'unit_year' => 'Anni',
    'term_day' => 'Durata minima: :count giorni',
    'term_month' => 'Durata minima: :count mesi',
    'term_year' => 'Durata minima: :count anni',
    'section_art' => 'Immagine',
    'section_art_helper' => 'L\'immagine sulla scheda del pacchetto, nel negozio e nei servizi di un cliente. Lasciali vuoti entrambi e viene usata l\'immagine dell\'egg stesso, che la maggior parte dei pacchetti ha già.',
    'art_file' => 'Carica un\'immagine',
    'art_file_helper' => 'Larga più che alta: la scheda la ritaglia a 16:9. Fino a 8 MB.',
    'art_url' => 'Oppure un indirizzo di immagine',
    'art_url_helper' => 'Un indirizzo https completo. Usato quando sopra non è stato caricato nulla.',

    'empty' => 'Ancora nessun pacchetto',
    'empty_body' => 'Creane uno e appare nel negozio non appena viene messo in vendita.',
];
