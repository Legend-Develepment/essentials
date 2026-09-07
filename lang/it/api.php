<?php

/*
 * Italiano. Scritto a mano.
 *
 * Una via d'ingresso da fuori il pannello.
 *
 * Due tipi di lettori in un solo file, e vogliono cose opposte. Un
 * amministratore che legge questa pagina sta decidendo se affidare una chiave a
 * qualcuno, quindi ogni riga dice cosa una chiave raggiunge e non come si
 * chiama. Chi ne chiede una vuole sapere cosa gli mettono in mano e cosa
 * succede se la perde, ed è per questo che la frase sul fatto che una chiave si
 * vede una volta sola non è una nota a piè di pagina.
 *
 * Da nessuna parte qui si dice «token». «Chiave» è la parola sulla pagina
 * account di Pelican stesso, e un pannello che dà due nomi alla stessa cosa è un
 * pannello in cui qualcuno cerca quella sbagliata.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Chiavi che permettono a qualcosa fuori dal pannello di chiedere ciò che questo plugin sa. Sola lettura — nulla qui può avviare, arrestare o raggiungere un server.',

    'my_title' => 'Accesso API',
    'my_nav_label' => 'Accesso API',
    'my_subheading' => 'Una chiave tua, per un bot o uno script. Risponde solo per i server che puoi già aprire.',

    // ---- cos'è una chiave, detto una volta, dove conta -------------------
    'address' => 'L\'indirizzo',
    'address_helper' => 'Manda la chiave come intestazione Authorization: :example',

    /*
     * L'unica cosa che qualcuno deve aver letto prima di chiudere la finestra.
     * Scritta come cosa fare invece che come avvertimento, perché «tienila al
     * sicuro» è un consiglio con cui nessuno può fare niente e «incollala
     * adesso dove il bot la legge» sì.
     */
    'once' => 'Questa è l\'unica volta che questa chiave viene mostrata',
    'once_body' => 'Viene conservata come hash, quindi nessuno — nemmeno chi gestisce questo pannello — può rileggerla. Incollala adesso dove il bot o lo script la legge. Se va persa, revoca questa e chiedine un\'altra.',
    'copy' => 'Copia',
    'copied' => 'Copiata',

    // ---- gli stati -------------------------------------------------------
    'state' => 'Stato',
    'state_pending' => 'In attesa',
    'state_active' => 'Attiva',
    'state_refused' => 'Rifiutata',
    'state_revoked' => 'Revocata',

    'state_pending_body' => 'Qualcuno deve concederla prima che risponda a qualsiasi cosa.',
    'state_refused_body' => 'È stata respinta. Non è stato rilasciato nulla.',
    'state_revoked_body' => 'Questa chiave è stata tolta e non risponde più.',

    // ---- le portate ------------------------------------------------------
    'scope' => 'Raggiunge',
    'scope_person' => 'I propri server',
    'scope_panel' => 'Tutto il pannello',

    'scope_person_helper' => 'Risponde solo per i server che il suo proprietario può già aprire, chiesti allo stesso modo in cui li chiede il pannello. Perdere questa chiave non perde nulla che il suo proprietario non potesse già vedere.',
    'scope_panel_helper' => 'Risponde alle domande che riguardano tutto il pannello — ogni nodo, la capacità, il watchdog, la macchina del pannello stessa. Per un bot che riferisce sul pannello invece che per una persona.',

    // ---- la tabella ------------------------------------------------------
    'column_name' => 'A che serve',
    'column_owner' => 'Di chi',
    'column_prefix' => 'Chiave',
    'column_asked' => 'Chiesta',
    'column_used' => 'Ultimo uso',
    'column_expires' => 'Scade',

    'never_used' => 'Mai',
    'no_expiry' => 'Finché non viene revocata',

    'tab_waiting' => 'In attesa',
    'tab_active' => 'Attive',
    'tab_all' => 'Tutte',

    'empty' => 'Ancora nessuna chiave',
    'empty_body' => 'Nessuno ne ha chiesta una e non ne è stata rilasciata nessuna. Questa pagina si riempie da sé man mano che la gente lo fa.',

    'my_empty' => 'Non hai nessuna chiave',
    'my_empty_body' => 'Chiedine una e comparirà qui con quello che le è stato risposto.',

    // ---- chiedere --------------------------------------------------------
    'ask' => 'Chiedi una chiave',
    'ask_name' => 'A cosa serve',
    'ask_name_helper' => 'Qualche parola, così più avanti distingui due delle tue e chi la concede sa cosa sta concedendo.',
    'ask_reason' => 'Qualcosa che valga la pena aggiungere',
    'ask_reason_helper' => 'Facoltativo. Letto da chi decide.',
    'ask_sent' => 'Chiesta',
    'ask_sent_body' => 'Compare qui sotto appena qualcuno ha risposto.',
    'ask_granted' => 'Ecco la tua chiave',
    'ask_open' => 'Ne hai già una in attesa di risposta',
    'ask_open_body' => 'Una richiesta alla volta. Annulla quella se era uno sbaglio.',
    'ask_failed' => 'Non è stato possibile chiederla',

    'cancel' => 'Annulla',
    'cancel_confirm' => 'Ritira la richiesta. Non è stato rilasciato nulla, quindi non smette di funzionare nulla.',

    // ---- decidere --------------------------------------------------------
    'grant' => 'Concedi',
    'grant_confirm' => 'Rilascia una chiave che risponde per i server di questa persona, e la mostra una volta. Lei vede già tutto ciò che la chiave riferirà — qui si decide se qualcosa fuori dal pannello possa chiederlo per suo conto.',
    'granted' => 'Concessa',

    'refuse' => 'Rifiuta',
    'refuse_answer' => 'Cosa dirgli',
    'refuse_answer_helper' => 'Facoltativo, e mostrato sulla sua pagina. Un rifiuto senza motivo è un rifiuto che viene richiesto di nuovo la settimana dopo.',
    'refused' => 'Rifiutata',

    'revoke' => 'Revoca',
    'revoke_confirm' => 'La chiave smette di rispondere all\'istante e il suo hash viene rimosso, quindi non si può riportare indietro. Tutto ciò che la usa si ferma. Chiedine una nuova invece di provare a disfare questo.',
    'revoked' => 'Revocata',

    'mint' => 'Nuova chiave',
    'mint_body' => 'Per un bot e non per una persona. Viene concessa nel momento stesso in cui è creata, perché sei tu quello che l\'avrebbe approvata.',
    'mint_owner' => 'Di chi è',
    'mint_owner_helper' => 'Una chiave risponde a nome di qualcuno. Per una chiave che copre tutto il pannello quello è solo chi ne risponde; per una personale è anche ciò che la chiave può vedere.',
    'minted' => 'Creata',

    // ---- cosa imposta un amministratore ----------------------------------
    'settings' => 'Come funziona',
    'approval' => 'Le richieste aspettano di essere concesse',
    'approval_helper' => 'Acceso, chi chiede una chiave la riceve quando qualcuno dice di sì. Spento, la riceve subito — il che è ragionevole su un pannello dove chiunque abbia un account è già di fiducia, e vale la pena sceglierlo invece di ritrovarcisi.',
    'rate' => 'Richieste al minuto, per chiave',
    'rate_helper' => 'Un bot che chiede a quaranta server chi sta giocando sono quaranta domande a quaranta server di gioco. Questo è il tetto che impedisce a un ciclo scritto alle tre di notte di diventare un test di carico.',
    'days' => 'Una chiave concessa dura',
    'days_helper' => 'In giorni. Zero vuol dire finché non viene revocata, ed è l\'impostazione predefinita — una chiave che scade mentre nessuno guarda è un bot che si ferma di notte senza che da nessuna parte ci sia scritto perché.',
    'days_never' => 'Finché non viene revocata',

    /*
     * Detto sulla pagina invece che lasciato da scoprire. Pelican annulla le
     * migrazioni di un plugin quando lo si disinstalla, e l'unica tabella di
     * questo plugin se ne va con loro.
     */
    'uninstall_note' => 'Rimuovere questo plugin rimuove con sé ogni chiave. È voluto — una chiave che sopravvive a ciò che le risponde è una credenziale che nessuno può più revocare.',
];
