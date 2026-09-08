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
    'collect' => 'Mostra la mia chiave',
    'state_ready_body' => 'Concessa. Premi Mostra la mia chiave per vederla — una volta sola, perché è conservata come hash e dopo non si può rileggere.',
    'replace' => 'Sostituisci',
    'replace_confirm' => 'Questa chiave smette di funzionare all\'istante e ne prende il posto una nuova, mostrata una volta sola. Non c\'è modo di andare a cercare la vecchia — non è mai stata conservata — quindi sostituirla è l\'unica risposta all\'averla persa.',
    'granted_body' => 'Se la prende da sé sulla propria pagina di accesso API. Qui non viene mostrata: una chiave appartiene a chi l\'ha chiesta, non a chi ha detto di sì.',

    'revoke' => 'Revoca',
    'revoke_confirm' => 'La chiave smette di rispondere all\'istante e il suo hash viene rimosso, quindi non si può riportare indietro. Tutto ciò che la usa si ferma. Chiedine una nuova invece di provare a disfare questo.',
    'revoked' => 'Revocata',
    'forget' => 'Rimuovi',
    'forget_confirm' => 'Toglie la riga da questa pagina per sempre. Ha già smesso di rispondere, quindi non si ferma nulla che stia funzionando - questo rimuove solo la traccia che sia esistita.',
    'forgotten' => 'Rimossa',

    'mint' => 'Nuova chiave',
    'mint_body' => 'Per un bot e non per una persona. Viene concessa nel momento stesso in cui è creata, perché sei tu quello che l\'avrebbe approvata.',
    'abilities' => 'Su cosa può chiedere',
    'abilities_helper' => 'All\'inizio è tutto spuntato, perché è così che era una chiave prima che questo esistesse. Togliere la spunta è l\'atto deliberato. Quello che viene conservato è l\'elenco di ciò che è permesso, quindi una capacità aggiunta in una versione successiva è spenta per le chiavi fatte prima - una capacità che nessuno ha spuntato è una capacità che nessuno ha concesso.',
    'ability_health' => 'Dimostrare che la chiave funziona',
    'ability_health_helper' => 'Non raggiunge nient\'altro. Si può chiamare a intervalli senza rischi.',
    'ability_me' => 'I propri server',
    'ability_me_helper' => 'I server che il suo proprietario può già aprire, e i loro backup. Non può mai vedere nessun altro.',
    'ability_panel' => 'Tutto il pannello',
    'ability_panel_helper' => 'Ogni nodo, ogni backup, le operazioni pianificate ferme, il watchdog e la macchina del pannello. Serve anche che sia una chiave che copre tutto il pannello.',
    'ability_live' => 'Chiedere direttamente a un server',
    'ability_live_helper' => 'Chi sta giocando, e se un server è in funzione. Le uniche domande che costano qualcosa — raggiungono un server di gioco o un daemon, e restano in cache dai quindici ai venti secondi.',
    'ability_connect' => 'Legare account Discord ad account del pannello',
    'ability_connect_helper' => 'L\'unico gruppo che non è una lettura. Crea chiavi API di Pelican sugli account di chi lo chiede e può chiudere un collegamento. Dalla solo al bot che ne ha bisogno.',
    'own_rate' => 'Richieste al minuto per questa chiave',
    'own_rate_helper' => 'Lascialo vuoto per seguire l\'impostazione del pannello. Un numero qui vale solo per questa chiave. Zero vuol dire nessun tetto — ragionevole per un bot sulla tua macchina, e un modo concreto di pentirsene se la chiave finisce altrove.',
    'own_rate_default' => 'Segue il pannello',
    'mint_owner' => 'Di chi è',
    'mint_owner_helper' => 'Una chiave risponde a nome di qualcuno. Per una chiave che copre tutto il pannello quello è solo chi ne risponde; per una personale è anche ciò che la chiave può vedere.',
    'minted' => 'Creata',
    'profile_tab' => 'API di Essentials',
    'profile_make' => 'Una chiave per l\'API di Essentials',
    'profile_make_helper' => 'Un\'API diversa da quella qui sopra: questa risponde su ciò che sa questo plugin — quali dei tuoi server sono senza backup, chi ci sta giocando, se sono in funzione. Risponde sempre solo per te e raggiunge solo i server che puoi già aprire.',
    'profile_create' => 'Crea',
    'profile_yours' => 'Le tue chiavi di Essentials',
    'profile_manage' => 'Revocare una chiave, vedere perché una è stata rifiutata e collegare Discord si fanno tutti nella pagina Accesso API, nella barra laterale.',
    'discord' => 'Discord',
    'discord_body' => 'Lega il tuo account Discord a questo, così un bot può rispondere per i tuoi server quando glielo chiedi. Quello che riceve è una chiave che raggiunge esattamente ciò che raggiungi tu e nient\'altro.',
    'discord_connect' => 'Collega Discord',
    'discord_code' => 'Scrivilo in Discord entro dieci minuti',
    'discord_code_body' => 'Manda :command in un canale che il bot può leggere. Il codice funziona una volta sola. Non può usarlo nessuno tranne l\'account per cui è stato fatto.',
    'discord_on' => 'Collegato come :name',
    'discord_since' => 'Dal :when',
    'discord_cut' => 'Scollegato',
    'discord_cut_confirm' => 'Chiude il collegamento e cancella la chiave che aveva creato, così il bot smette subito di rispondere per te. Puoi collegarti di nuovo quando vuoi.',
    'discord_off' => 'Non collegato',
    'discord_key_note' => 'Collegarsi crea sul tuo account una chiave API di Pelican chiamata «Discord (Essentials)». Puoi vederla, e revocarla, sotto Account → Chiavi API — questa pagina è solo una scorciatoia alla stessa cosa.',
    'docs_title' => 'Come si usa questa API',
    'docs_subheading' => 'A cosa risponde questo pannello, e agli indirizzi su cui risponde. Scritta a partire dalla stessa descrizione da cui è costruita l\'API, quindi non può restare indietro di una versione.',
    'docs_base' => 'Dove si trova',
    'docs_endpoints' => 'Endpoint',
    'docs_answers' => 'Cosa torna indietro',
    'docs_calls' => 'Chiavi che possono chiamarlo',
    'docs_params' => 'Cosa mandare',
    'docs_required' => 'obbligatorio',
    'docs_optional' => 'facoltativo',
    'docs_try' => 'Provalo',
    'docs_errors' => 'Quando qualcosa non va',
    'docs_hook' => 'Cosa ti manda il pannello',
    'docs_hook_body' => 'L\'altra direzione, e l\'unica parte di tutto questo che arriva senza essere chiesta. Si accende sotto Avvisi con un indirizzo e un segreto per la firma: un invio JSON quando il watchdog trova qualcosa e uno quando rientra, così un bot viene a sapere di un nodo caduto invece di chiedere ogni minuto se ce ne sia uno.',
    'docs_hook_verify' => 'Il corpo viene sottoposto a hash con il tuo segreto e l\'hash viaggia in X-Essentials-Signature come sha256=<hex>. Fai l\'hash del corpo grezzo, non di un oggetto riserializzato — qualsiasi differenza di spazi o di ordine delle chiavi dà un hash diverso, e la mancata corrispondenza sembra un attacco più che un errore.',
    'docs_download_md' => 'Scarica come Markdown',
    'docs_download_json' => 'Scarica come OpenAPI',

    // ---- cosa imposta un amministratore ----------------------------------
    'settings' => 'Come funziona',
    'approval' => 'Le richieste aspettano di essere concesse',
    'approval_helper' => 'Acceso, chi chiede una chiave la riceve quando qualcuno dice di sì. Spento, la riceve subito — il che è ragionevole su un pannello dove chiunque abbia un account è già di fiducia, e vale la pena sceglierlo invece di ritrovarcisi.',
    'rate' => 'Richieste al minuto, per chiave',
    'rate_helper' => 'Un bot che chiede a quaranta server chi sta giocando sono quaranta domande a quaranta server di gioco. Questo è il tetto che impedisce a un ciclo scritto alle tre di notte di diventare un test di carico.',
    'days' => 'Una chiave concessa dura',
    'days_helper' => 'In giorni. Zero vuol dire finché non viene revocata, ed è l\'impostazione predefinita — una chiave che scade mentre nessuno guarda è un bot che si ferma di notte senza che da nessuna parte ci sia scritto perché.',
    'days_never' => 'Finché non viene revocata',
    'hide_pelican' => 'Rimuovi la scheda Chiavi API del pannello',
    'hide_pelican_helper' => 'Toglie del tutto la scheda Chiavi API dal profilo dell\'account, così su quella pagina c\'è una cosa sola che si chiama Chiavi API. Viene rimossa dalla pagina invece che coperta, quindi non resta nessun indirizzo che la raggiunga. Una cosa che non può fare: l\'API client del pannello continuerà a creare una chiave dell\'account per qualunque cosa gliela chieda direttamente — la scheda è dove la gente ne fa una a mano, e questo toglie la mano. Le chiavi che esistono già continuano a funzionare.',

    /*
     * Detto sulla pagina invece che lasciato da scoprire. Pelican annulla le
     * migrazioni di un plugin quando lo si disinstalla, e l'unica tabella di
     * questo plugin se ne va con loro.
     */
    'uninstall_note' => 'Rimuovere questo plugin rimuove con sé ogni chiave. È voluto — una chiave che sopravvive a ciò che le risponde è una credenziale che nessuno può più revocare.',
];
