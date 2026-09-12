<?php

/*
 * Italiano. Scritto a mano.
 *
 * La pagina di stato pubblica.
 *
 * L'unica cosa che questo plugin serve a chi non ha effettuato l'accesso, e
 * l'unica pagina le cui parole vanno lette pensando che le vedrà uno
 * sconosciuto - perché le vedrà. Qui nulla dice quale nodo, quale proprietario
 * o quale indirizzo; un nome, se è in funzione, e quante persone ci sono.
 *
 * «Nodo» compare solo nelle impostazioni; sulla pagina pubblica è «macchina»,
 * perché lì legge qualcuno che di Pelican non ha mai sentito parlare.
 */

return [
    // ---- la pagina delle impostazioni -------------------------------------
    'title' => 'Pagina di stato pubblica',
    'nav_label' => 'Pagina di stato',
    'subheading' => 'Una pagina che chiunque può aprire, senza account, che mostra quali dei tuoi server sono in funzione. Non ci compare nulla finché non nomini un server qui sotto.',

    'address' => 'La tua pagina di stato è online su',
    'address_off' => 'Non viene ancora servito nulla. Aggiungi qui sotto un server, una macchina o un servizio e salva, e l\'indirizzo comparirà qui.',

    'which' => 'Cosa viene pubblicato',
    'which_helper' => 'La lista comincia vuota e nulla è pubblico finché non c\'è qualcosa dentro. Sono offerti solo i server che riesci già ad aprire.',
    'add' => 'Pubblica un server',
    'server' => 'Server',
    'shown_as' => 'Mostrato come',
    'shown_as_helper' => 'Ciò che il pubblico vede. Scrivilo invece di lasciare che il pannello usi il nome vero - «mc-prod-3 (non toccare)» è un appunto per te, non una cosa da mettere su un forum.',

    'look' => 'Testi',
    'look_helper' => 'Tutto ciò che sta su questa pagina è letto da gente che non ha un account.',
    'heading' => 'Titolo',
    'heading_helper' => 'Lasciato vuoto, viene usato il nome del pannello stesso.',
    'note' => 'Una riga sopra la lista',
    'note_helper' => 'Per dire cosa sta succedendo - una finestra di manutenzione, o dove chiedere. Testo semplice.',
    'link' => 'Link al pannello',
    'link_helper' => 'Una via di ritorno, in fondo alla pagina. Spegnilo se preferisci non annunciare dove sta il tuo pannello.',

    'save' => 'Salva',
    'saved' => 'Salvato',
    'save_failed' => 'Non è stato salvato nulla',
    'open' => 'Apri la pagina',

    // ---- numero di giocatori ----------------------------------------------
    'counts' => 'Numero di giocatori',
    'counts_helper' => 'Da dove arrivano i numeri accanto a un server. I server Minecraft rispondono al proprio handshake e si configurano sotto Minecraft; tutto ciò che sta qui sotto riguarda i giochi che rispondono alla query di Valve - Rust, ARK, Valheim, 7 Days to Die e quasi tutto il resto che gira su Source o Unreal.',
    'query_eggs' => 'Egg che rispondono alla query di Valve',
    'query_eggs_helper' => 'Spunta gli egg di quei giochi. La stessa lista decide anche quali server ottengono una pagina Giocatori dentro il pannello - una domanda posta per due motivi. Non viene chiesto nulla finché non lo dici tu: questa è l\'unica cosa qui che apre una connessione dal pannello direttamente a una porta di gioco, quindi è una scelta e non qualcosa che comincia a succedere da sé. Un server la cui porta non è raggiungibile dal pannello semplicemente non mostra un numero.',

    // ---- i nodi -----------------------------------------------------------
    'nodes' => 'Macchine',
    'nodes_helper' => 'In funzione o ferma, e nient\'altro. Non il carico e non quanto è pieno il disco - chi chiede se può giocare non ha bisogno di un rapporto sulla capacità del tuo hardware, e pubblicarne uno è disegnare la mappa di dove si stringe.',
    'add_node' => 'Pubblica una macchina',
    'node' => 'Macchina',
    'node_shown_as_helper' => 'Scrivilo. Un nodo di solito si chiama qualcosa tipo hetzner-fsn1-01, e quella è una frase intera su dove stanno le tue macchine.',

    // ---- i monitor HTTP ---------------------------------------------------
    'monitors' => 'Altri servizi',
    'monitors_helper' => 'Qualsiasi altra cosa di cui valga la pena sapere che è in funzione: il tuo sito, una API, l\'endpoint di salute di un bot. Il pannello interroga ciascuno con lo stesso ritmo dei server. Solo amministratori - un monitor fa sì che questo pannello vada a prendere un indirizzo, e lasciare che chiunque ne aggiunga uno lo trasforma in una sonda che si può puntare dove si vuole.',
    'add_monitor' => 'Aggiungi un servizio',
    'monitor_name' => 'Nome',
    'monitor_url' => 'Indirizzo',
    'monitor_url_helper' => 'Solo https. Se questo pannello andasse a prendere http in chiaro a intervalli, direbbe a chiunque stia sul percorso quali dei tuoi servizi esistono.',
    'monitor_expect' => 'Atteso',
    'monitor_expect_helper' => 'Lascia vuoto per «una risposta qualsiasi», che va bene per un sito che reindirizza o che risponde 403 a una richiesta nuda. Un numero serve per un endpoint scritto per dire esattamente quello e nient\'altro - messo troppo stretto, la riga resta rossa per sempre su un servizio che sta bene.',

    // ---- pagine per gli utenti --------------------------------------------
    'users' => 'Pagine per i tuoi utenti',
    'users_helper' => 'Se le persone con server su questo pannello possono pubblicare una pagina di stato loro.',
    'user_pages' => 'Lascia che gli utenti facciano la loro',
    'user_pages_helper' => 'Ognuno riceve un indirizzo suo su /status/il-suo-nome, che mostra solo i server che possiede, con i nomi che scrive lui. Nessuna macchina e nessun altro servizio su quelle - entrambe le cose sono solo tue. Con questo acceso, lo trovano sotto «Pagina di stato» nel menu del loro account, in qualunque pannello si trovino.',

    // ---- l'aspetto --------------------------------------------------------
    'every' => 'Controlla ogni',
    'every_helper' => 'Ogni quanto la pagina si ricostruisce, e ogni quanto si aggiorna da sola nel browser. Una pagina che la gente guarda durante un riavvio vuole secondi; una linkata da un forum che nessuno tiene aperta vuole un\'ora, e interrogare ogni nodo ogni minuto per lei è lavoro fatto per nessuno.',
    'every_realtime' => 'Tempo reale (10 secondi)',
    'every_30s' => '30 secondi',
    'every_1m' => '1 minuto',
    'every_5m' => '5 minuti',
    'every_10m' => '10 minuti',
    'every_30m' => '30 minuti',
    'every_60m' => '60 minuti',

    'style' => 'Stile',
    'style_helper' => 'Uno degli aspetti del pannello stesso, applicato a questa pagina: il suo colore, i grigi costruiti dalla sua superficie, e quanto sono arrotondati gli angoli. «Segui il pannello» vuol dire quello impostato oggi, comprese le modifiche successive.',
    'style_mine_helper' => 'Gli stili che questo pannello offre, applicati alla tua pagina: un colore, i grigi costruiti da esso, e quanto sono arrotondati gli angoli. Quali stili stanno in questa lista lo decide il proprietario del pannello - la stessa lista da cui puoi scegliere sotto Aspetto. «Segui il pannello» vuol dire quello impostato.',
    'style_panel' => 'Segui il pannello',

    // ---- la pagina di qualcuno --------------------------------------------
    'mine_title' => 'La mia pagina di stato',
    'mine_nav_label' => 'Pagina di stato',
    'mine_subheading' => 'Un indirizzo da dare alle persone che giocano sui tuoi server. Mostra i server che scegli e nient\'altro di questo pannello.',
    'mine_address' => 'Il tuo indirizzo',
    'mine_address_helper' => 'Prendi qualcosa di corto. Cambiarlo più avanti rompe qualsiasi link che qualcuno abbia già salvato.',
    'mine_address_off' => 'Scegli qui sotto un indirizzo e salva, e la tua pagina comparirà qui.',
    'slug' => 'Indirizzo',
    'slug_helper' => 'Minuscole, numeri e trattini. Tre caratteri o più.',
    'mine_heading' => 'Titolo',
    'mine_heading_helper' => 'Lasciato vuoto, viene usato il tuo indirizzo.',
    'mine_note_helper' => 'Per dire cosa sta succedendo - un riavvio, un evento, dove trovarti. Testo semplice, e letto da chiunque abbia il link.',
    'mine_which' => 'I tuoi server',
    'mine_which_helper' => 'Sono offerti solo i server che possiedi. Essere subuser altrove è accesso a una macchina, non il permesso di pubblicare che esiste.',
    'mine_shown_as_helper' => 'Ciò che vedono i visitatori. Scrivilo invece di usare il nome del pannello se quel nome è un appunto per te.',
    'mine_look_helper' => 'Come appare la tua pagina alle persone a cui la mandi.',
    'mine_remove' => 'Togli la mia pagina',
    'mine_remove_confirm' => 'Toglie la tua pagina e libera l\'indirizzo per qualcun altro. Tutto ciò che hai impostato va perso; i server in sé non vengono toccati.',
    'mine_removed' => 'La tua pagina è stata tolta',

    'why_slug' => 'Quell\'indirizzo non va. Minuscole, numeri e trattini, tre caratteri o più - e alcune parole sono riservate.',
    'why_taken' => 'Quell\'indirizzo ce l\'ha già qualcun altro.',
    'why_unwritable' => 'Non è stato possibile scriverlo. Controlla che storage/app appartenga all\'utente con cui gira il pannello.',

    // ---- i titoli sulla pagina stessa -------------------------------------
    'section_servers' => 'Server',
    'section_nodes' => 'Macchine',
    'section_monitors' => 'Servizi',

    // ---- la pagina stessa -------------------------------------------------
    'up' => 'Online',
    'down' => 'Offline',
    'starting' => 'In avvio',

    /*
     * Non «offline», e la differenza conta in pubblico.
     *
     * Il pannello non è riuscito a raggiungere il server. Di solito è un nodo
     * in manutenzione o un daemon che si riavvia - non è la stessa cosa di un
     * server spento, e dire a cento giocatori che il loro server è caduto
     * mentre è in funzione è peggio che ammettere di non saperlo.
     */
    'unknown' => 'Sconosciuto',

    'players' => 'Giocatori',
    'online_now' => 'stanno giocando adesso',
    'checked' => 'Controllato',
    'next_check' => 'al prossimo controllo',
    'just_now' => 'proprio adesso',
    'seconds_ago' => ':count secondi fa',
    'panel' => 'Accedi',

    'all_up' => 'Funziona tutto.',
    'some_down' => 'Qualcosa non funziona.',
    'empty' => 'Qui non viene ancora pubblicato nulla.',
];
