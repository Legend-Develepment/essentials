<?php

/*
 * Italiano. Scritto a mano.
 *
 * «Egg», «nodo», «subuser», «Wings», «queue», «webhook», «topbar», «cron» e i
 * formati di file restano come sono: sono le parole che si ritrovano in Pelican
 * stesso, sull'host e in tutto ciò che si scrive su di loro. Anche i nomi degli
 * stili non sono tradotti — uno stile si chiama come si chiama, e un nome
 * tradotto sarebbe un secondo nome per la stessa cosa.
 */

return [
    'css_warning' => 'Salvato, ma questo CSS sembra sbagliato',
    'css_unclosed' => 'Una regola aperta alla riga :line non viene mai chiusa. Tutto ciò che segue sta dentro quella regola e non verrà applicato.',
    'css_extra' => 'C\'è una parentesi graffa di chiusura alla riga :line senza nulla di aperto. Tutto ciò che segue resta fuori da ogni regola e verrà ignorato.',
    'css_comment' => 'Un commento aperto alla riga :line non viene mai chiuso, quindi il resto del file sta dentro di esso.',

    'groups' => [
        'appearance' => 'Aspetto',
        'servers' => 'Lista dei server',
        'windows' => 'Stili a orario',
        'windows_helper' => 'Uno stile diverso tra due ore del giorno. Non succede nulla finché non ne aggiungi uno. L\'orologio è quello del pannello stesso, dalla sua impostazione di fuso orario, e non quello di ciascun lettore — un pannello che apparisse diverso a due persone nello stesso momento sembrerebbe rotto e non pianificato. Una finestra cambia l\'aspetto che il pannello ha già, quindi non fa nulla finché lo stile è su «Nessuno». Uno stile che qualcuno ha scelto per sé continua a vincere.',
        'minecraft' => 'Minecraft',
        'ark' => 'ARK',
        'valheim' => 'Valheim',
        'languages' => 'Lingue',
        'servers_helper' => 'Come viene disegnata una scheda di server. Se compaiano a griglia o a lista è la scelta di ciascuno, sotto Account → Disposizione della dashboard.',
        'server_pages' => 'Pagine del server',
        'server_pages_helper' => 'Cosa porta ogni pagina dentro un server, qualunque pagina sia.',
        'console' => 'Pagina della console',
        'console_helper' => 'Il carattere del terminale, la dimensione e l\'altezza sono la scelta di ciascuno, sotto Account.',
        'background' => 'Sfondo',
        'background_helper' => 'Vale per tutto il pannello, compresa la schermata di accesso.',
        'icons' => 'Icone',
        'bars' => 'Indicatori delle risorse',
        'bars_helper' => 'Le barre di processore, memoria e disco sulle schede dei server.',
        'updates' => 'Aggiornamenti',
        'updates_helper' => 'Quali rilasci offre la pagina del tema, e dove li cerca.',
        'brand' => 'Marchio',
        'login' => 'Schermata di accesso',
        'login_helper' => 'Vale per le schermate di accesso, di reimpostazione della password e a due fattori.',
        'advanced' => 'CSS personalizzato',
        'advanced_helper' => 'Per tutto ciò che le impostazioni qui sopra non coprono. Viene caricato dopo tutto il resto, quindi vince.',
        'areas' => 'Per area',
        'areas_helper' => 'Tutto ciò che sta sopra vale dappertutto. Qui puoi mettere un\'area a parte; ciò che lasci vuoto continua a seguire l\'impostazione generale.',
        'footer' => 'Piede della barra laterale',
        'footer_helper' => 'Il fondo della barra laterale, che Pelican lascia vuoto. Tutto qui è spento finché non lo riempi.',
        'features' => 'Cosa aggiunge questo plugin',
        'features_helper' => 'Togliere una spunta lo toglie del tutto dal pannello. Le sue impostazioni vengono conservate e la sua pagina mantiene l\'indirizzo, quindi non si perde nulla a spegnere qualcosa per vedere cosa faceva. La maggior parte ha anche un permesso suo sotto Ruoli, per consegnarne uno senza consegnare il resto. Non tutti: gli indicatori delle risorse, il piede della barra laterale e la ricerca nelle impostazioni sono disegnati per chiunque e non sono amministrati da nessuno, la stella su una scheda di server appartiene a chi l\'ha cliccata, e le pagine di Palworld e Minecraft dentro un server seguono i permessi di quel server e non uno di questi. L\'aspetto in sé non è in questa lista — ha un interruttore suo, sotto Aspetto → Aspetto → Stile → Nessuno.',
        'identity' => 'Questo plugin nella barra laterale',
        'identity_helper' => 'La voce che questo plugin aggiunge alla barra laterale, e l\'immagine che porta.',
    ],

    /*
     * Le pagine delle impostazioni, ciascuna una voce nel gruppo proprio del
     * plugin nella barra laterale. Raggruppate per la domanda a cui si risponde
     * e non per la classe che le implementa.
     */
    'pages' => [
        'look' => 'Aspetto',
        'look_helper' => 'Il colore, la forma e come si chiama il pannello.',
        'pages' => 'Pagine',
        'pages_helper' => 'La lista dei server, le pagine dentro un server, e il terminale.',
        'advanced' => 'Avanzate',
        'advanced_helper' => 'Le due uscite di sicurezza: il tuo CSS, e le impostazioni che valgono per una sola area.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Quali egg sono Minecraft, e tutto il resto in proposito.',
        'artwork' => 'Immagini degli egg',
        'artwork_helper' => 'Una pagina con tutti gli egg, e un modo per prendere l\'immagine del gioco da Steam o da IGDB. Scrive negli egg stessi — l\'immagine, e due tag che annotano di quale gioco si tratta e se l\'immagine è stata scelta a mano — e per questo porta un permesso suo.',
        'alerts' => 'Avvisi',
        'alerts_helper' => 'Un controllo a intervalli per le cose che il pannello già misura ma non dice a nessuno: un nodo che smette di rispondere, un disco che si riempie, un queue worker che si è fermato, una versione che resta indietro. Manda su Discord, nel pannello, o via email. Permesso suo, perché raggiunge ogni nodo a intervalli e pubblica verso un indirizzo che qualcuno ha digitato.',
        'backups' => 'Panoramica dei backup',
        'backups_helper' => 'Una pagina con tutti i server e da quanto tempo sono senza backup, ordinata perché quelli che non ne hanno nessuno stiano in cima. Sola lettura — tutto ciò che agisce su un backup resta sulla pagina di Pelican di quel server. Permesso suo, perché la lista è una mappa di dove stanno i buchi.',
        'public_status' => 'Pagina di stato pubblica',
        'public_status_helper' => 'Una pagina che chiunque può aprire senza account, che mostra quali dei tuoi server sono in funzione e quante persone ci sono. Non viene pubblicato nulla finché non nomini un server, una macchina o un servizio — le tre liste cominciano vuote, e finché lo sono l\'indirizzo risponde 404. Permesso suo, perché decide cosa esce dal pannello.',
        'game_players' => 'Giocatori, altri giochi',
        'capacity' => 'Capacità',
        'capacity_helper' => 'Quanto è stato promesso su ogni macchina contro quanto può distribuire, per vedere se ci sta un altro server. La lista dei nodi di Pelican mostra un nome e un numero di server, e il blocco Macchine della dashboard mostra cosa sta girando - questa è la terza domanda, e il conto è quello di Pelican stesso. Sola lettura. Permesso suo.',
        'schedules' => 'Operazioni pianificate',
        'schedules_helper' => 'Tutte le operazioni pianificate del pannello con quali di esse si sono fermate: bloccate a metà esecuzione, in ritardo perché il cron non gira, o mai eseguite. Pelican mostra le operazioni dentro ogni server e il suo stato non ha una parola per nessuno di quei casi. Sola lettura. Permesso suo.',
        'activity' => 'Attività',
        'activity_helper' => 'Ogni evento che il pannello registra, in una lista invece che un server alla volta. Pelican tiene il registro e lo mostra per server; questo interroga lo stesso registro al contrario. Sola lettura. Permesso suo, perché un elenco di chi ha fatto cosa è una cosa che si consegna di proposito.',
        'access' => 'Accesso ai server',
        'access_helper' => 'Legare un ruolo a dei server, così che chiunque lo abbia possa raggiungerli. Funziona tenendo aggiornati i subuser di Pelican stesso, che è ciò che la lista dei server e ogni controllo dei permessi già leggono. Permesso suo, perché è l\'unica pagina qui che dà accesso alle cose.',
        'games' => 'Altri giochi',
        'games_helper' => 'I file che ARK e Valheim tengono accanto al mondo, come moduli: le impostazioni di mondo di ARK, e le liste di admin, bannati e permessi di Valheim. Quali server le ricevono è la lista di egg su quella pagina, quindi una lista vuota è già un interruttore per gioco.',
        'game_players_helper' => 'Una pagina dentro Rust, ARK, Valheim e tutto ciò che risponde alla query di Valve, che mostra chi è collegato e da quanto tempo. Sola lettura — cosa puoi fare a qualcuno cambia da gioco a gioco, e quello è un rilascio a sé. Quali egg contano è la stessa lista che usa la pagina di stato.',
        'api' => 'API',
        'api_helper' => 'Le chiavi che la gente ha, chi ne ha chiesta una, e cosa ciascuna di esse può vedere.',
        'languages' => 'Lingue',
        'languages_helper' => 'In quali lingue risponde questo plugin.',
    ],

    'features' => [
        'look' => 'Impostazioni di aspetto',
        'look_helper' => 'La voce della barra laterale per colore, forma e marchio.',
        'pages' => 'Impostazioni delle pagine',
        'pages_helper' => 'La voce della barra laterale per la lista dei server, le pagine del server e il terminale.',
        'advanced' => 'Impostazioni avanzate',
        'advanced_helper' => 'La voce della barra laterale per il tuo CSS e le eccezioni per area.',
        'announcements' => 'Annunci',
        'announcements_helper' => 'La striscia in cima al pannello.',
        'nav_links' => 'Link di navigazione',
        'nav_links_helper' => 'Le tue voci nella barra laterale.',
        'login' => 'Schermata di accesso',
        'login_helper' => 'L\'immagine, l\'avviso e i link della schermata di accesso.',
        'bars' => 'Indicatori delle risorse',
        'bars_helper' => 'Le barre ricolorate di processore, memoria e disco.',
        'dashboard_status' => 'Riga della versione',
        'dashboard_status_helper' => 'La cima del blocco della dashboard: quale versione è installata e se ce n\'è una in attesa.',
        'dashboard_nodes' => 'Macchine',
        'dashboard_nodes_helper' => 'Il resto del blocco della dashboard: questo pannello e ogni nodo, con quanto sta usando ciascuno.',
        'system_status' => 'Pagina di stato del sistema',
        'system_status_helper' => 'La pagina della macchina su cui gira il pannello stesso.',
        'sidebar_footer' => 'Piede della barra laterale',
        'sidebar_footer_helper' => 'La tua riga di testo, la versione del pannello e un link, in fondo alla barra laterale.',
        'api' => 'API',
        'api_helper' => 'Una via d’ingresso da fuori il pannello: un indirizzo a cui un bot Discord o uno script tuo può chiedere ciò che questo plugin sa — chi sta giocando, quali server non hanno backup, se un altro ci sta su un nodo. Spento non registra nessuna rotta invece di una che rifiuta, il che è meno superficie invece di una quantità più educata di essa. Chiunque abbia effettuato l’accesso può chiedere una chiave che risponde solo per i propri server; concederne una, rifiutarne una, revocarne una che ha qualcun altro e rilasciarne una che copre tutto il pannello richiedono tutte il permesso.',
        'languages' => 'Lingue',
        'languages_helper' => 'Rispondere a ciascuno nella lingua impostata sul suo account, dove questo plugin è stato tradotto. Con questo spento tutti ricevono l\'inglese.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Una scheda Minecraft nella barra laterale, e una pagina dentro ogni server Minecraft per modificarne il server.properties come modulo. Quali egg contano lo dici tu.',
        'palworld' => 'Impostazioni di Palworld',
        'palworld_helper' => 'Una pagina dentro un server Palworld per modificarne le impostazioni di mondo. Non compare su nessun altro server, e mai mentre quel server è in esecuzione.',
        'settings_search' => 'Ricerca nelle impostazioni',
        'settings_search_helper' => 'Il campo sopra questi moduli che li restringe alle sezioni che contengono ciò che scrivi.',
        'preview' => 'Anteprima dal vivo',
        'preview_helper' => 'Il riquadro accanto al modulo Aspetto che mostra cosa fanno i colori, gli angoli e le spaziature prima che tu li salvi.',
        'duplicate' => 'Duplica server',
        'duplicate_helper' => 'Una pagina per allestire un altro server esattamente come uno che hai già, oppure diversi in una volta. I file non vengono mai copiati.',
        'favourites' => 'Server contrassegnati',
        'favourites_helper' => 'Una stella su ogni scheda di server. Quelli contrassegnati vengono per primi, e la lista di ciascuno è tenuta sul pannello — così le sue stelle lo seguono ovunque accederà la prossima volta. Cambia ciò che vede lui e nulla per gli altri. Stare sul pannello vuol dire però che è un file sotto storage, che chiunque abbia accesso alla macchina può leggere.',
        'artwork' => 'Immagini degli egg',
        'artwork_helper' => 'La pagina di amministrazione che prende l\'immagine di ogni egg da Steam o da IGDB e la scrive nell\'egg stesso.',
        'alerts' => 'Avvisi',
        'alerts_helper' => 'Il controllo a intervalli per un nodo che ha smesso di rispondere, un disco che si riempie, un queue worker morto o una versione che resta indietro, e il messaggio Discord, di pannello o email che manda.',
        'backups' => 'Panoramica dei backup',
        'backups_helper' => 'La pagina di amministrazione che elenca tutti i server per quanto tempo sono senza backup. Sola lettura.',
        'public_status' => 'Pagina di stato pubblica',
        'public_status_helper' => 'La pagina che chiunque può aprire senza account. Con questo spento l\'indirizzo risponde 404 qualunque cosa ci sia in lista.',
        'game_players' => 'Giocatori, altri giochi',
        'game_players_helper' => 'Una pagina dentro Rust, ARK, Valheim e tutto ciò che risponde alla query di Valve, che mostra chi è collegato e da quanto tempo.',
        'owner_alerts' => 'Avvisa le persone che il loro server è offline',
        'owner_alerts_helper' => 'L\'unica parte di questo plugin che scrive a persone che non sono amministratori: una notifica nel pannello quando la macchina di uno dei loro server smette di rispondere, e un\'altra quando torna. Spento finché non viene acceso qui e sulla pagina Avvisi, in entrambe - scrive ai tuoi clienti, quindi richiede due decisioni e non una.',
        'my_backups' => 'Avviso sui backup nella lista dei server',
        'my_backups_helper' => 'Una riga sopra la lista dei server di ciascuno quando uno dei suoi non ha mai avuto un backup o non ne ha da un po\'. Le schede di Pelican dicono cosa sta facendo un server adesso; nulla lì dice che un backup non gira da tre settimane. Viene disegnata solo quando qualcosa è indietro, e non nomina nessun server che quella persona non potesse già aprire.',
        'capacity' => 'Panoramica della capacità',
        'capacity_helper' => 'La pagina di amministrazione che mostra memoria, disco e processore promessi contro disponibili su ogni macchina, con i server rimasti senza backup, senza database o senza allocazioni. Promesso e non consumato - un nodo può essere affollato e vuoto, o fermo e pieno.',
        'schedules' => 'Panoramica delle operazioni pianificate',
        'schedules_helper' => 'La pagina di amministrazione che elenca tutte le operazioni pianificate del pannello, le peggiori per prime - bloccate, in ritardo, o mai eseguite. Sola lettura; tutto ciò che ne modifica o ne esegue una resta sulla pagina di Pelican di quel server.',
        'activity' => 'Attività del pannello',
        'activity_helper' => 'La pagina di amministrazione che elenca ogni evento registrato del pannello, il più recente per primo, con chi lo ha fatto e su quale server. Sola lettura - non cancella nulla, e l\'impostazione di Pelican stesso continua a decidere per quanto tempo le righe restano.',
        'access' => 'Accesso ai server per ruolo',
        'access_helper' => 'Una pagina per legare un ruolo a dei server, tenuta esatta nella tabella dei subuser di Pelican stesso. Non concede nulla finché non abbini qualcosa. Spegnerla ferma la riconciliazione; l\'accesso già concesso resta, e la pagina ha un pulsante per ritirarlo.',
        'scheduled' => 'Stili a orario',
        'scheduled_helper' => 'La sezione della pagina Aspetto per dare al pannello uno stile diverso tra due ore del giorno. Non cambia nulla di ciò che è salvato — una finestra viene messa sopra le impostazioni mentre la pagina viene disegnata e lasciata subito dopo — quindi spegnerla ripristina l\'aspetto proprio del pannello all\'istante e non perde nulla.',
        'games' => 'Altri giochi',
        'games_helper' => 'Le impostazioni di mondo di ARK, e le liste di admin, bannati e permessi di Valheim, come moduli invece che come file nel gestore file. Quali server le ricevono è la lista di egg sulla pagina Altri giochi.',
        'quick' => 'Menu «Vai a»',
        'quick_helper' => 'Un controllo in cima a ogni pagina per saltare a un server o a una pagina contrassegnata, con un campo di ricerca su tutta la tua lista di server. Contrassegna anche la pagina su cui sei. Ciò che qualcuno trova con esso è ciò che poteva già raggiungere, quindi non concede nulla - spegnerlo toglie la scorciatoia e la pagina Preferiti con essa.',
    ],

    /*
     * Il campo di ricerca sopra i moduli delle impostazioni. Filtra ciò che è
     * già sulla pagina dentro il browser e non chiede nulla al server, quindi
     * non c'è uno stato «sto cercando» da descrivere né un modo per fallire.
     */
    /*
     * Il riquadro di anteprima. Tutto ciò che contiene è un segnaposto e non un
     * campione del tuo pannello, e le parole lo dicono - un riquadro che
     * nominasse un server vero o una cifra vera verrebbe letto come tale.
     */
    'preview' => [
        'label' => 'Anteprima',
        'card' => 'Una scheda',
        'card_helper' => 'Disegnata con le stesse regole del pannello, con le impostazioni di questa pagina invece di quelle salvate.',
        'button' => 'Un pulsante',
        'field' => 'Un campo',
        'meter_ok' => 'A posto',
        'meter_warning' => 'Attenzione',
        'meter_danger' => 'Pericolo',

        /*
         * L'anteprima a pagina intera. Una scheda e non un pannello, perché
         * Pelican manda X-Frame-Options: DENY e rifiuta di essere incorniciato
         * da qualsiasi cosa, sé stesso compreso - vedi Support\FullPreview.
         */
        'full' => 'Vedi tutto il pannello',
        'full_confirm' => 'Apre il pannello disegnato dalle impostazioni di questa pagina invece che da quelle salvate. Non viene scritto nulla — i valori vengono tenuti quindici minuti e il pannello torna normale quando lasci l\'anteprima o salvi.',
        'full_go' => 'Mostramelo',
        'full_failed' => 'Non è stato possibile avviare l\'anteprima',
        'bar' => 'Stai guardando impostazioni non salvate. Nulla di questo è stato scritto.',
        'bar_back' => 'Torna alle impostazioni',
    ],

    'search' => [
        'placeholder' => 'Cerca nelle impostazioni',
        'label' => 'Cerca in queste impostazioni',
        'none' => 'Su questa pagina non corrisponde nulla. Le impostazioni sono sparse su quattro pagine — prova Aspetto, Pagine, Avanzate, o Impostazioni di Essentials.',
    ],

    'footer' => [
        'text' => 'La tua riga',
        'text_helper' => 'Testo semplice, al massimo 120 caratteri. Viene reso innocuo, come la striscia degli annunci — questo viene disegnato su ogni pagina del pannello, il che ne fa il posto sbagliato per accettare del markup.',
        'version' => 'Mostra la versione del pannello',
        'version_helper' => 'La versione di Pelican, non quella di questo plugin. Il plugin dice la sua sulla dashboard; ciò che la gente cerca in fondo a una barra laterale è quale pannello ha davanti.',
        'link_label' => 'Testo del link',
        'link_url' => 'Indirizzo del link',
        'link_url_helper' => 'Un indirizzo http o https, oppure un percorso del pannello stesso come /account. Si apre in una nuova scheda.',
    ],

    'layout' => [
        'label' => 'Disposizione',
        'helper' => 'Come è organizzato il pannello, e non di che colore è. Vale allo stesso modo per l\'area di amministrazione, la lista dei server e l\'area cliente. Dove va la navigazione è un valore predefinito: chi ha impostato il suo sotto Account → Navigazione lo mantiene.',
        'default' => 'Barra laterale — quella di Pelican',
        'rail' => 'Guida di icone — stretta, si apre al passaggio',
        'top' => 'Navigazione in alto — nessuna barra laterale',
        'mixed' => 'Barra in alto e barra laterale — entrambe',
        'wide' => 'Larga — il contenuto usa tutto lo schermo',
        'focus' => 'Concentrata — colonna stretta, la barra laterale si ripiega',

        'nav_label' => 'Stile della barra laterale',
        'nav_helper' => 'Come viene disegnata la barra laterale stessa.',
        'nav_default' => 'Predefinito',
        'nav_floating' => 'Fluttuante — una scheda a parte',
        'nav_flat' => 'Piatta — nessuno sfondo',
        'nav_bordered' => 'Bordata — una linea, non una superficie',

        'topbar_label' => 'Stile della topbar',
        'topbar_helper' => '«Nascosta» vale solo su computer — su un telefono la topbar porta l\'unica via di ritorno al menu.',
        'topbar_default' => 'Predefinito',
        'topbar_floating' => 'Fluttuante — una barra staccata',
        'topbar_flush' => 'A filo — piatta, senza sfocatura',
        'topbar_hidden' => 'Nascosta su computer',

        'card_label' => 'Stile delle schede',
        'card_helper' => 'Le sezioni, i widget, le schede dei server e i blocchi sopra la console.',
        'card_default' => 'Predefinito — sollevata, con bordo morbido',
        'card_flat' => 'Piatta — senza rilievo',
        'card_outline' => 'Contorno — un bordo e nulla dietro',
        'card_glass' => 'Smerigliata — lo sfondo traspare',
        'card_sharp' => 'Squadrata — angoli retti',
    ],

    'servers' => [
        /*
         * La stella su una scheda. Passata allo script invece che scritta
         * dentro di esso, così i testi restano nell'unico posto dove i testi
         * vivono.
         */
        'favourite' => 'Contrassegna questo server',
        'favourited' => 'Contrassegnato — compare per primo',

        /*
         * La pastiglia accanto alle schede di Pelican. Chiamata per ciò che fa
         * alla lista e non come una quarta scheda, perché filtra la scheda
         * scelta invece di sostituirla.
         */
        'favourites_tab' => 'Preferiti',
        'favourites_empty' => 'Non c\'è nulla di contrassegnato su questa pagina. Usa la stella su una scheda di server per aggiungerne uno — e nota che questo filtra i server già elencati qui: un server contrassegnato su una pagina successiva non viene nascosto, semplicemente non sta su questa.',
        'favourites_failed' => 'Non è stato possibile salvare i tuoi server contrassegnati, quindi sono stati riportati all\'ultimo stato che il pannello aveva. La console del browser dice cosa ha risposto la richiesta.',

        'art' => 'Immagine del gioco',
        'art_helper' => 'Pelican disegna l\'immagine dell\'egg su ogni scheda. Questo decide cosa farne.',
        'art_faded' => 'Sbiadita — un velo dietro il testo',
        'art_cover' => 'Coprente — dietro il nome, sfumando via',
        'art_off' => 'Spenta',
        'art_dim' => 'Scurisci l\'immagine',
        'art_dim_helper' => 'L\'immagine di un gioco è un cielo chiaro e quella di un altro è una caverna.',

        'status' => 'Marcatore di stato',
        'status_helper' => 'Dove viene mostrato il colore di in funzione / in avvio / fermo.',
        'status_bar' => 'Barra — lungo il bordo sinistro',
        'status_edge' => 'Bordo — di traverso in cima',
        'status_dot' => 'Punto — nell\'angolo',
        'status_off' => 'Spento',

        'density' => 'Altezza delle schede',
        'density_comfortable' => 'Comoda',
        'density_compact' => 'Compatta — per molti server',

        'filter_label' => 'Metti il testo sul pulsante del filtro',
        'filter_label_helper' => 'Pelican filtra già questa lista per egg e per proprietario, su tutte le pagine - ma l\'ingresso è un\'icona senza testo accanto al campo di ricerca. Questo ci mette la parola.',
        'filter_button' => 'Filtri',

        'columns' => 'Schede affiancate su schermo largo',
        'columns_helper' => 'Vale solo per la griglia, e solo da 1280px in su. Il massimo di Pelican stesso è due.',
    ],

    'controls' => [
        'mode' => 'Pulsante console su ogni pagina del server',
        'mode_helper' => 'Un pulsante fluttuante, su ogni pagina dentro un server. Apre la console sopra ciò che stavi facendo, con lo stato e i pulsanti di alimentazione nella sua intestazione — raggiungendo il nodo direttamente, come fa la lista dei server, e non tramite il websocket della pagina della console. Non compare mai sulla pagina della console, che ha già tutto questo.',
        'mode_full' => 'Console e pulsanti di alimentazione',
        'mode_console' => 'Solo la console',
        'mode_off' => 'Spento',

        'label' => 'Il pulsante mostra',
        'label_text' => 'Icona e nome',
        'label_icon' => 'Solo l\'icona',

        'position' => 'Dove fluttua',
        'position_helper' => 'Contro il bordo che meno probabilmente stai leggendo.',
        'position_top' => 'In alto',
        'position_right' => 'A destra',
        'position_bottom' => 'In basso',
    ],

    'console' => [
        'stats' => 'Blocchi sopra la console',
        'stats_helper' => 'Pelican mostra il nome, lo stato, l\'indirizzo e le tre cifre di utilizzo sopra il terminale. Nasconderli restituisce l\'altezza alla console.',
        'stats_tiles' => 'Riquadri — etichetta, cifra e un\'icona',
        'stats_plain' => 'Semplici — come li disegna Pelican',
        'stats_off' => 'Nascosti',
    ],

    'terminal' => [
        'helper' => 'Vengono consegnati al terminale stesso, quindi valgono dal caricamento successivo della pagina e non nel momento in cui li salvi.',

        'renderer' => 'Disegnato da',
        'renderer_helper' => 'Pelican disegna il terminale sulla GPU, il che è molto più veloce davanti a un muro di output che scorre. Un browser tiene vivi solo un certo numero di contesti GPU alla volta — meno su un telefono — e toglie il più vecchio quando il limite viene superato; il terminale allora non disegna più nulla, senza alcun errore. Se la tua console diventa bianca mentre tutto il resto sembra a posto, è questa l\'impostazione da cambiare.',
        'renderer_webgl' => 'La GPU — quella di Pelican, più veloce',
        'renderer_dom' => 'Il browser — più lento, disegna sempre',

        'scheme' => 'Schema di colori',
        'scheme_helper' => 'L\'unica impostazione del terminale che Pelican non offre. «Segui il tema» ricava i colori dall\'accento, ed è per questo che questo esiste.',
        'scheme_theme' => 'Segui il tema',
        'scheme_dracula' => 'Dracula',
        'scheme_nord' => 'Nord',
        'scheme_solarized' => 'Solarized Dark',
        'scheme_gruvbox' => 'Gruvbox Dark',
        'scheme_one_dark' => 'One Dark',
        'scheme_tokyo_night' => 'Tokyo Night',
        'scheme_catppuccin' => 'Catppuccin Mocha',
        'scheme_monokai' => 'Monokai',

        'cursor' => 'Cursore',
        'cursor_helper' => 'La console non accetta digitazione — il campo dei comandi sta sotto — quindi questo è dove l\'output si è fermato, e non dove sei tu.',
        'cursor_underline' => 'Sottolineatura — quella di Pelican',
        'cursor_block' => 'Blocco',
        'cursor_bar' => 'Barra',

        'blink' => 'Cursore lampeggiante',

        'scrollback' => 'Cronologia a scorrimento',
        'scrollback_helper' => 'Fin dove si può risalire nella console. Ogni riga resta nel browser, quindi un server chiacchierone con un valore alto è memoria vera sulla macchina che sta leggendo.',
        'scrollback_lines' => ':lines righe',
    ],

    'notice' => [
        'text' => 'Messaggio',
        'text_helper' => 'Una riga, fino a 200 caratteri. Viene resa innocua in entrata e in uscita, quindi non può portare markup su una pagina che altre persone caricano.',
        'style' => 'Tono',
        'style_info' => 'Informazione',
        'style_warning' => 'Attenzione',
        'style_danger' => 'Urgente',
        'style_accent' => 'Colore d\'accento',
        'scope' => 'Mostrato a',
        'scope_all' => 'Tutti',
        'scope_client' => 'Solo fuori dall\'area di amministrazione',
        'scope_admin' => 'Solo nell\'area di amministrazione',
        'link_label' => 'Testo del pulsante',
        'link_url' => 'Indirizzo del pulsante',
        'link_url_helper' => 'https:// oppure un percorso dentro questo pannello, come /account. Tutto il resto viene ignorato — un link in una striscia presente su ogni pagina non è un posto per uno schema che nessuno si aspetta.',
        'dismissible' => 'Può essere chiuso',
        'dismissible_helper' => 'Che sia stato chiuso viene ricordato per browser, e solo per questo messaggio: cambia il testo e torna per tutti.',
        'dismiss' => 'Chiudi',
    ],

    'preset' => [
        'label' => 'Stile',
        'helper' => 'Scegli un aspetto da cui partire. Riempie tutto ciò che sta sotto, che poi puoi cambiare. «Nessuno» spegne il tema e lascia il pannello esattamente come Pelican lo consegna.',
        'options' => [
            'none' => 'Nessuno - senza tema',
            'legend' => 'Legend - fuoco rosso verso fulmine blu',
            'ember' => 'Ember - nero caldo, accento arancione',
            'midnight' => 'Midnight - blu profondo, calmo',
            'crimson' => 'Crimson - rosso, angoli retti, compatto',
            'forest' => 'Forest - verde, arrotondato, senza bagliore',
            'nebula' => 'Nebula - viola con uno sfondo sfumato',
            'terminal' => 'Terminal - verde su nero, monospaziato, netto',
            'console' => 'Console - tondo e spazioso, per un tablet',
            'nord' => 'Nord - la palette Nord, smorzata',
            'solarized' => 'Solarized - Solarized dark, accento ciano',
            'paper' => 'Paper - chiaro, molto contrasto, piatto',
            'daylight' => 'Daylight - chiaro e caldo, con un velo morbido',
            'mono' => 'Mono - scala di grigi, piatto e denso',
        ],

        'save' => 'Salva come stile',
        'save_confirm' => 'Conserva i colori, gli angoli, lo sfondo, i caratteri, le icone e le soglie degli indicatori che hai adesso sullo schermo — sotto un nome tuo, nel selettore accanto a quelli inclusi. Salva ciò che sta sulla pagina, e non ciò che è stato salvato l\'ultima volta.',
        'save_name' => 'Nome',
        'save_name_helper' => 'Come si chiamerà nel selettore. Salvare con un nome già usato sostituisce quello.',
        'saved' => 'Stile salvato',
        'save_failed' => 'Non è stato possibile salvare quello stile',
        'save_full' => 'C\'è posto per :max stili tuoi. Cancellane prima uno.',

        'delete' => 'Cancella uno stile',
        'delete_which' => 'Quale',
        'delete_confirm' => 'Si possono cancellare solo gli stili tuoi; quelli inclusi no. Non cambia nulla dell\'aspetto attuale del pannello — uno stile è un punto di partenza, e ogni valore che ha impostato è già nelle impostazioni qui sotto.',
        'deleted' => 'Stile cancellato',
        'deleted_current' => 'Era quello su cui era impostato questo pannello. Le sue impostazioni sono invariate e restano su questa pagina — scegli uno stile, oppure salvale di nuovo sotto un nome.',
    ],

    'user_themes' => [
        'label' => 'Stili che le persone possono scegliere per sé',
        'helper' => 'Gli stili spuntati compaiono su una pagina Aspetto nell\'area cliente, dove chiunque abbia effettuato l\'accesso può sceglierne uno per sé. Cambia ciò che vede lui e nulla per gli altri. Nulla di spuntato vuol dire che nessuno sceglie nulla e il pannello mantiene un solo aspetto — che è quello che fa adesso.',
    ],

    'mode' => [
        'label' => 'Modalità del pannello',
        'helper' => 'In quale modalità si apre il pannello. Chi non ha scelto per sé riceve questa; l\'interruttore nel menu utente gli permette comunque di cambiarla, a meno che tu non la blocchi qui sotto.',
        'dark' => 'Scura',
        'light' => 'Chiara',
        'system' => 'Sistema — segui l\'impostazione del visitatore',
    ],

    'font' => [
        'label' => 'Caratteri del pannello',
        'helper' => 'Ogni opzione è una famiglia che il sistema operativo ha già — non viene scaricato nulla da un fornitore di caratteri. Il terminale non è toccato: il suo carattere è la scelta di ciascuno, sotto Account.',
        'default' => 'Predefinito - quello di Pelican',
        'mono' => 'Monospaziato',
        'rounded' => 'Arrotondato',
        'serif' => 'Con grazie',
        'system' => 'Sistema - quello che usa questa macchina',
    ],

    'surface' => [
        'label' => 'Colore delle superfici',
        'helper' => 'Le schede e i pannelli. Le tonalità più chiare e più scure ne derivano.',
        'placeholder' => 'Segui il tema',
    ],

    'radius' => [
        'label' => 'Angoli',
    ],

    'accent' => [
        'label' => 'Colore d\'accento',
        'helper' => 'Usato per i pulsanti, i link, la voce di navigazione attiva e gli anelli di focus.',

        /*
         * Detto, non imposto. Un colore su cui questo avvisa viene salvato lo
         * stesso: è il pannello di qualcuno, la cifra misura una cosa sola, e ci
         * sono buoni motivi per volere un accento che vada male. Il selettore
         * dice ciò che vede e si toglie di mezzo.
         */
        'contrast_dark' => 'Leggibilità: :ratio contro un pannello scuro. Sotto 3 un accento è difficile da leggere come pulsante o come link — uno più chiaro lo solleva.',
        'contrast_light' => 'Leggibilità: :ratio contro un pannello chiaro. Sotto 3 un accento è difficile da leggere come pulsante o come link — uno più scuro lo solleva.',
    ],
    'density' => [
        'label' => 'Densità',
        'helper' => 'Compatta stringe le spaziature così che stiano più righe sullo schermo.',
        'comfortable' => 'Comoda',
        'compact' => 'Compatta',
    ],
    'force_dark' => [
        'label' => 'Forza la modalità scura',
        'helper' => 'Nasconde l\'interruttore chiaro/scuro e tiene tutti gli utenti sul tema scuro.',
    ],
    'glass' => [
        'label' => 'Topbar smerigliata',
        'helper' => 'Sfoca la topbar e gli sfondi delle finestre modali. Spegnila su dispositivi modesti.',
    ],
    'glow' => [
        'label' => 'Bagliore d\'accento',
        'helper' => 'Un\'ombra d\'accento morbida sui pulsanti principali, sulla navigazione attiva e sulla scheda di accesso.',
    ],

    'background' => [
        'label' => 'Tipo di sfondo',
        'helper' => 'Aurora è lo sfondo proprio del tema: bagliori d\'accento con una grana fine.',
        'aurora' => 'Aurora (predefinito)',
        'solid' => 'Un solo colore',
        'gradient' => 'Sfumatura',
        'image' => 'Immagine',
        'color' => 'Colore',
        'base' => 'Colore dietro i bagliori',
        'base_helper' => 'Su cosa poggia la pagina prima che i bagliori d\'accento vengano dipinti sopra. Lascia vuoto per tenere il valore predefinito del pannello, quasi nero nello scuro e quasi bianco nel chiaro. Impostalo e uno schema mantiene il proprio colore notturno e resta comunque illuminato.',
        'color_end' => 'Secondo colore',
        'angle' => 'Direzione',
        'upload' => 'Carica un\'immagine',
        'upload_helper' => 'Fino a 8 MB. Un\'immagine caricata ha la precedenza sull\'URL qui sotto.',
        'url' => 'Oppure un URL',
        'url_helper' => 'Deve cominciare con https:// ed essere raggiungibile dall\'esterno.',
        'dim' => 'Scurisci',
        'dim_helper' => 'Senza scurire, il testo bianco su una foto chiara non si legge.',
        'blur' => 'Sfocatura',
    ],

    'channel' => [
        'installed' => 'installata',
        'version' => 'Installa una versione precisa',
        'version_helper' => 'Qualsiasi rilascio di questo canale, non solo il più recente — per tornare indietro quando qualcosa di nuovo si rivela peggiore, o avanti verso una build che ti hanno detto di provare. Solo finché gli aggiornamenti non si installano da soli: con quello acceso, ciò che scegli durerebbe fino al controllo successivo.',
        'version_placeholder' => 'Scegli una versione',
        'version_install' => 'Installa questa versione',
        'version_confirm' => 'Il pannello scarica quel rilascio, ricostruisce i suoi asset e svuota le sue cache. Le tue impostazioni vengono mantenute. Tornare a una versione più vecchia è permesso e non viene annullato da solo — riscegli quella più recente per andare avanti.',
        'label' => 'Canale di aggiornamento',
        'helper' => 'Quali rilasci offre la pagina del tema. Beta riceve le versioni nuove per prima, e anche gli spigoli per primi.',
        'stable' => 'Stabile',
        'beta' => 'Beta',
        'dev' => 'Dev (ramo di lavoro)',
        'auto' => [
            'label' => 'Installa gli aggiornamenti automaticamente',
            'helper' => 'Spento lascia l\'aggiornamento a te. Acceso, il pannello controlla il canale scelto e installa tutto ciò che è più recente - ricostruisce i suoi asset mentre lo fa e resta indisponibile per qualche minuto, per questo giornaliero e settimanale vanno alle 04:00. Richiede il cron del pannello attivo.',
            'interval' => 'Controlla ogni',
            'minute' => 'Ogni minuto',
            'five_minutes' => 'Ogni 5 minuti',
            'ten_minutes' => 'Ogni 10 minuti',
            'thirty_minutes' => 'Ogni 30 minuti',
            'hourly' => 'Ogni ora',
            'daily' => 'Ogni giorno (04:00)',
            'weekly' => 'Ogni settimana (lunedì 04:00)',
        ],
    ],

    /*
     * La scheda Lingue.
     *
     * Attenta a ciò che afferma. Pelican lascia già che ciascuno scelga una
     * lingua per tutto il proprio account e la applica già; nulla qui cambia
     * questo né dovrebbe. Questo decide soltanto se i testi propri di questo
     * plugin seguono quella scelta.
     */
    'languages' => [
        'section_helper' => 'Pelican lascia già che ciascuno scelga una lingua per il proprio account, e questo plugin la segue ovunque sia stato tradotto. Qui decidi a quali di esse darà retta. La maggior parte delle lingue sta a una percentuale bassa di proposito: ciò che viene tradotto per primo è la parte che tutti vedono su ogni pagina — i pulsanti di alimentazione sopra una console e gli indicatori dei nodi — e il resto arriva man mano che le persone contribuiscono.',
        'panel' => 'Lascia che questo decida la lingua di tutto il pannello',
        'panel_helper' => 'Acceso, una lingua che questo plugin non porta — o una spenta qui sotto — mette tutto il pannello in inglese per quel lettore, e non solo queste pagine. Spento, solo questo plugin segue la lista e Pelican continua a parlare ciò che l\'account ha impostato, il che vuol dire che un lettore può incontrare due lingue su una sola schermata. Nessun account viene modificato in nessuno dei due casi: riaccendi una lingua e la riavrà.',
        'label' => 'Lingue in cui rispondere',
        'helper' => 'Togliere la spunta a una rimanda all\'inglese, solo per questo plugin, i lettori che l\'hanno impostata sull\'account — il resto del pannello continua a parlare la loro lingua. L\'inglese non è in lista perché tutto ricade su di esso.',
        'under' => 'non viene offerta finché non sarà più avanti — spuntala per offrirla comunque',
        'done' => ':percent % tradotto',
        'main' => 'Lingua principale',
        'main_helper' => 'Ciò che un lettore riceve quando la sua lingua non può essere usata — o questo plugin non la porta, oppure è senza spunta qui sotto. È sempre stato l\'inglese; in una squadra che non lavora in inglese quella era una risposta sbagliata data con sicurezza. Non si può togliere la spunta qui sotto, perché tutto ricade su di essa.',
        'labels' => 'Come si chiama ogni lingua',
        'labels_helper' => 'Il nome che lettori e amministratori vedono nei selettori. Lasciane uno vuoto per tenere il nome con cui questo plugin la conosce. Una lingua caricata con un nome tuo non ne ha nessuno, quindi comparirebbe con il suo codice finché non gliene dai uno qui.',
        'labels_code' => 'Codice',
        'labels_name' => 'Mostrata come',
        'download' => 'Scarica un file di traduzione',
        'download_from' => 'Parti da',
        'download_from_helper' => 'Un JSON con tutti i testi di questo plugin. Scegli l\'inglese per una lingua che nessuno ha cominciato, oppure una esistente per proseguire ciò che è già tradotto.',
        'code' => 'Codice della lingua',
        'code_helper' => 'Il codice a cui il file corrisponde. Un locale vero, così come lo usano gli account — fr, de, pt_BR — raggiunge i lettori che ce l\'hanno impostato, e deve corrispondere esattamente o non li raggiungerà. Un nome tuo, come Gaming-IT, è permesso e funziona in modo diverso: Pelican lascia che un account abbia solo un locale vero, quindi il tuo nessuno può selezionarlo. È raggiungibile come lingua principale qui sopra, che è ciò che riceve chiunque la cui lingua non può essere usata.',
        'url' => 'Oppure prendilo da un indirizzo',
        'url_helper' => 'Un indirizzo https che il pannello riesce a raggiungere — un CDN, un bucket, un file grezzo su un repository. Viene preso una volta al salvataggio e scritto come lo sarebbe un caricamento, quindi cambiare il file a quell\'indirizzo più avanti non fa nulla finché non salvi di nuovo. Un file scelto qui sopra vince su un indirizzo lasciato in questo campo.',
        'upload' => 'Carica un file di traduzione',
        'upload_helper' => 'Il JSON di sopra, con i valori tradotti. Viene scritto fuori dal plugin, quindi un aggiornamento non lo butta via, e viene fuso sopra l\'inglese chiave per chiave — un file con metà dei testi ti dà mezza lingua e l\'inglese per il resto.',
        'uploaded' => ':count testi installati per :code',
        'uploaded_halves' => 'Di questi, :mine sono testi propri di questo plugin e :panel sono del pannello. Zero da uno dei due lati vuol dire che quella metà del file non conteneva nulla — le chiavi del plugin cominciano con essentials:: e quelle del pannello no.',
        'uploaded_skipped' => ':count sono stati saltati: vuoti, oppure chiavi che questo plugin non ha. I primi: :keys',
        'upload_failed' => 'Non è stato possibile leggere quel file',
        'upload_failed_body' => 'Deve essere il JSON dal download di sopra — un oggetto piatto di chiavi e testi. Controlla che un editor non lo abbia salvato come qualcos\'altro.',
    ],

    'windows' => [
        'add' => 'Aggiungi una finestra',
        'from' => 'Dalle',
        'to' => 'Fino alle',
        'to_helper' => 'Prima dell\'inizio vuol dire che attraversa la mezzanotte — dalle 22:00 alle 06:00 è la notte.',
        'preset' => 'Stile',
        'days' => 'Giorni',
        'days_helper' => 'Lasciali tutti senza spunta per tutti i giorni. Una finestra che attraversa la mezzanotte appartiene al giorno in cui comincia, quindi venerdì dalle 22:00 alle 06:00 copre la mattina di sabato.',
        'day_mon' => 'Lunedì',
        'day_tue' => 'Martedì',
        'day_wed' => 'Mercoledì',
        'day_thu' => 'Giovedì',
        'day_fri' => 'Venerdì',
        'day_sat' => 'Sabato',
        'day_sun' => 'Domenica',
    ],

    'arranger' => [
        'label' => 'Organizzatore delle pagine',
        'helper' => 'Il pulsante «Organizza la pagina», su ogni pagina del pannello. Chi ha il permesso Organizza lo riceve e può anche fissare la disposizione da cui tutti gli altri partono, oppure una per un ruolo. Spento lo nasconde a tutti; le disposizioni già salvate restano dove sono.',
        'roles' => 'Una disposizione non è un permesso. Un blocco che un ruolo nasconde resta un blocco che qualcuno potrebbe raggiungere digitando l\'indirizzo — ciò che lo impedisce sono i permessi di Pelican stesso, sulla pagina dei ruoli. Si applicano tre strati in quest\'ordine: quello di partenza comune, poi il ruolo del lettore, poi ciò che ha spostato lui stesso.',
        'users' => 'Lascia che ciascuno organizzi le proprie pagine',
        'users_helper' => 'Acceso, chiunque abbia effettuato l\'accesso può riordinare e nascondere blocchi sulle pagine che già vede, solo per sé — non cambia nulla per nessun altro. Fissare la disposizione di partenza comune resta legato al permesso Organizza.',
    ],

    'brand' => [
        'logo_height' => 'Altezza del logo',
        'logo_height_helper' => 'Pelican consegna 2rem. Valori più grandi alzano con sé l\'intestazione della barra laterale.',
        'logo_url' => 'Sostituisci il logo',
        'logo_url_helper' => 'Lascia vuoto per tenere ciò a cui puntano le impostazioni di Pelican stesso.',
    ],

    'login' => [
        'image' => 'Immagine di sfondo',
        'image_helper' => 'Solo per la schermata di accesso. Senza di essa continua a mostrare lo sfondo del pannello.',
        'url' => 'Oppure un URL',
        'blur' => 'Sfocatura della scheda',
        'blur_helper' => 'Smeriglia la scheda così che l\'immagine dietro traspaia.',
        'width' => 'Larghezza della scheda',
        'position' => 'Inquadratura dell\'immagine',
        'position_helper' => 'Quale parte dell\'immagine sopravvive al ritaglio sullo schermo.',
        'position_center' => 'Centro',
        'position_top' => 'In alto',
        'position_bottom' => 'In basso',
        'position_left' => 'A sinistra',
        'position_right' => 'A destra',
        'align' => 'Posizione della scheda',
        'align_helper' => 'Dove si colloca la scheda di accesso attraverso lo schermo.',
        'align_center' => 'Centro',
        'align_start' => 'A sinistra',
        'align_end' => 'A destra',
        'opacity' => 'Opacità della scheda',
        'opacity_helper' => 'Più bassa lascia passare più immagine attraverso la scheda.',
        'glow' => 'Bagliore d\'accento',
        'glow_helper' => 'L\'alone attorno alla scheda. Spento le lascia il bordo e la profondità.',
        'hide_heading' => 'Nascondi il titolo',
        'hide_heading_helper' => 'Toglie il titolo sopra il modulo, lasciando il modulo da solo.',
        'hide_footer' => 'Nascondi il piede',
        'hide_footer_helper' => 'Toglie la riga sotto la scheda che rimanda a pelican.dev.',
        'above' => 'Riga sopra il modulo',
        'above_helper' => 'Una riga, mostrata a chiunque arrivi alla schermata di accesso. Lascia vuoto per nessuna.',
        'notice' => 'Avviso sotto la scheda',
        'notice_helper' => 'Una riga, mostrata a chiunque arrivi alla schermata di accesso. Lascia vuoto per nessuno.',
    ],

    'advanced' => [
        'css' => 'CSS personalizzato',
        'css_helper' => 'Fino a 100 KB. Salvato in storage, non nel .env.',
        'reference' => 'Riferimento CSS',
        'reference_helper' => 'Ogni variabile e ogni classe che questo tema e il pannello espongono.',
    ],

    'areas' => [
        'add' => 'Aggiungi un\'area',
        'area' => 'Area',
        'inherit' => 'Generale',
        'radius' => 'Angoli',
        'radius_sharp' => 'Retti',
        'radius_normal' => 'Normali',
        'radius_round' => 'Arrotondati',
        'surface' => 'Colore delle superfici',
        'surface_helper' => 'Le schede e i pannelli dentro quest\'area; le tonalità più chiare e più scure ne derivano.',
        'names' => [
            'terminal' => 'Terminale',
            'console' => 'Console (il resto della pagina)',
            'files' => 'Pagina dei file',
            'edit' => 'Pagina di modifica',
            'server' => 'Altre pagine e schede del server',
        ],
    ],

    'bars' => [
        'base' => 'Colore di base',
        'base_green' => 'Verde',
        'base_accent' => 'Colore d\'accento',
        'warning' => 'Ambra a partire da',
        'danger' => 'Rosso a partire da',
    ],

    'icons' => [
        'stroke' => 'Spessore del tratto',
        'stroke_thin' => 'Sottile',
        'stroke_normal' => 'Normale',
        'stroke_bold' => 'Grosso',
        'scale' => 'Dimensione',
        'accent' => 'Icone del menu nel colore d\'accento',
        'accent_helper' => 'Vale per le icone della barra laterale e della topbar.',
        'pack' => 'Pacchetto di icone',
        'pack_helper' => 'Da quale insieme attinge il selettore qui sotto. Sono offerti tutti gli insiemi di icone installati sul server, più l\'insieme Essentials che arriva con questo plugin e qualsiasi pacchetto tu carichi. C\'è una differenza che vale la pena sapere: un\'icona a tratto viene disegnata nel colore del menu e segue il passaggio del mouse e la voce attiva, mentre le icone di Essentials sono immagini e mantengono i propri colori. Lo decide cos\'è il file, non l\'insieme da cui è arrivato.',
        'pack_custom' => 'Pacchetto caricato',
        'pack_shipped' => 'Icone di Essentials',
        'use_shipped' => 'Usa le icone di Essentials dappertutto',
        'use_shipped_confirm' => 'Imposta il pacchetto sulle icone di Essentials e riempie ogni voce di menu qui sotto con l\'icona disegnata per essa — la console riceve il terminale, l\'avvio riceve il pulsante di lancio, e così via. Sostituisce le voci che hai adesso, e non viene salvato nulla finché non premi Salva, quindi chiudere la pagina annulla tutto.',
        'pack_upload' => 'Carica un pacchetto',
        'pack_upload_helper' => 'Uno .zip di file SVG. Ogni file diventa un\'icona con il suo nome — logo.svg diventa custom-logo. Caricarne uno sostituisce il pacchetto che c\'è adesso. I file oltre 256 KB e tutto ciò che supera le 4.000 icone restano fuori, e ti viene detto quanti: per dare una scala, l\'intero insieme Tabler sfiora le seimila icone in circa tre megabyte, quindi un pacchetto molto più grande porta qualcosa che non sono icone e la maggior parte verrà saltata. Un caricamento grande può anche essere rifiutato prima che questo campo dica qualsiasi cosa, da upload_max_filesize e post_max_size nel php.ini dell\'host del pannello — nessuna impostazione qui può alzarli.',
        'pack_partial' => ':count icone installate, ma non tutte',
        'pack_partial_body' => 'Saltate: :big troppo grandi per un\'icona, :unusable non utilizzabili come SVG, :duplicate con un nome già occupato, :empty senza nulla da disegnare una volta ripulite. Un SVG oltre 256 KB è quasi sempre un\'immagine avvolta in uno e non un disegno — esportalo alla dimensione di un\'icona e occuperà qualche kilobyte. Un\'icona senza nulla da disegnare conteneva solo qualcosa che qui non viene servito — se è un pacchetto intero, vale la pena segnalarlo.',
        'pack_stopped_files' => 'Si è fermato anche al limite di quante icone un pacchetto può contenere.',
        'pack_stopped_size' => 'Si è fermato anche perché il resto del pacchetto, scompattato, supera ciò che il pannello tiene in memoria in una volta — lo zip può essere più piccolo, dato che l\'SVG comprime circa cinque a uno.',
        'overrides' => 'Sostituisci le icone',
        'overrides_helper' => 'Una riga per ogni icona che vuoi cambiare. Scegli la voce di menu, poi scegli un\'icona dal pacchetto qui sopra, dai un indirizzo, oppure carica un\'immagine tua. Se ne è compilato più di uno, vince il caricamento, poi l\'indirizzo, poi il pacchetto.',
        'overrides_key' => 'Voce di menu',
        'overrides_value' => 'Icona dal pacchetto',
        'overrides_url' => 'Oppure un indirizzo',
        'overrides_url_helper' => 'Un indirizzo https di un\'immagine che ospiti tu — un CDN, un bucket, qualsiasi posto che il browser raggiunga. Non viene copiato nulla sul pannello, quindi sostituire il file a quell\'indirizzo cambia l\'icona senza toccare questa pagina; il rovescio è un\'icona che sparisce quando sparisce l\'indirizzo. Mantiene i propri colori, come un\'immagine caricata.',
        'overrides_file' => 'Oppure carica un\'immagine',
        /*
         * Dice in cosa consiste davvero la differenza, perché non è ovvia ed è
         * il motivo per cui qualcuno sceglierebbe l'una invece dell'altra.
         */
        'overrides_file_helper' => 'PNG, SVG o ICO. Un\'icona dal pacchetto viene disegnata nel colore del menu e segue il passaggio del mouse e la voce attiva; un\'immagine caricata mantiene i propri colori e non lo fa. Per un logo di solito è ciò che si vuole.',
        'overrides_add' => 'Sostituisci un\'altra icona',
        'overrides_search' => 'Scrivi un nome, oppure la voce di menu…',
    ],

    /*
     * Non sotto «Marchio». Il marchio parla di come appare il pannello; questo
     * parla di come questo plugin ci compare dentro, che è un'altra domanda e
     * viene risposta su un'altra pagina.
     */
    'identity' => [
        'nav_icon' => 'Icona per la voce «Impostazioni di Essentials»',
        'nav_icon_helper' => 'PNG, SVG o ICO, fino a 8 MB. Sostituisce l\'icona di quella sola voce nella barra laterale; lascia vuoto per quella che questo plugin porta con sé. Viene disegnata come immagine e non come icona, quindi mantiene i propri colori invece di seguire il testo — che è di solito ciò che vuole un logo. Il file viene servito invece che incorporato, quindi ogni browser lo scarica una volta sola, ma vale comunque la pena esportare qualcosa di piccolo: qualche kilobyte basta e avanza per una voce alta venti pixel. Se un caricamento fallisce prima che questo campo dica qualsiasi cosa, il limite contro cui ha sbattuto è upload_max_filesize nel php.ini del pannello.',
    ],
];
