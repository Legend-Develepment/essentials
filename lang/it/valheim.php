<?php

/*
 * Italiano. Scritto a mano.
 *
 * «Egg», «daemon», «SteamID64» e «PlayFab ID» restano in inglese: sono le
 * parole di Pelican e quelle del gioco, ed è con quei nomi che si ritrovano.
 */

return [
    /* ------------------------------------------------ la scheda admin ---- */

    'section_helper' => 'Quali egg fanno girare Valheim. Nient\'altro — un server Valheim si configura con le sue variabili di avvio, e la pagina Avvio di Pelican le modifica già.',

    'eggs' => 'Quali egg sono Valheim',
    'eggs_helper' => 'Spunta gli egg che fanno girare un server Valheim. Dentro i server che li usano compare una pagina Liste di giocatori, e da nessun\'altra parte. Dove stanno quelle liste cambia da egg a egg, quindi viene ricavato server per server, guardando nei posti che il gioco usa. All\'inizio non c\'è nulla di spuntato, ed è voluto — un plugin non può sapere che nomi hai dato ai tuoi egg.',

    /* ---------------------------------------------- la pagina del server - */

    'nav_label' => 'Liste di giocatori',
    'title' => 'Liste di giocatori di Valheim',
    'subheading' => 'Gli admin, i bannati e la lista dei permessi, come tre liste invece che tre file di testo.',

    'admin' => 'Admin',
    'admin_helper' => 'Tutti quelli che stanno qui possono usare i comandi da admin dentro il gioco.',
    'banned' => 'Bannati',
    'banned_helper' => 'Tutti quelli che stanno qui vengono rifiutati quando provano a entrare.',
    'permitted' => 'Permessi',
    'permitted_helper' => 'Se questa lista contiene qualcuno, solo quelle persone possono entrare. Una lista vuota fa entrare tutti — che è ciò che vuole la maggior parte dei server, quindi lasciala vuota a meno che tu non lo intenda davvero.',

    'ids' => 'Identificativi dei giocatori',
    'ids_placeholder' => 'Incolla un identificativo e premi spazio',

    'how' => 'Un identificativo per giocatore — uno SteamID64 su un server Steam, un PlayFab ID su uno in crossplay. Incollali e premi spazio, tab o virgola. Ciò che il gioco ha scritto come commento sopra la lista resta dov\'è.',
    'where' => 'Letto da :dir.',
    'missing' => 'Questo server non ha ancora nessuno di questi file. Il gioco li scrive quando ne ha bisogno la prima volta, e salvare qui creerà quelli che riempi.',
    'read_only' => 'Puoi leggere questi file ma non scriverli, quindi qui non si può cambiare nulla.',

    'save' => 'Salva',
    'saved' => 'Salvato',
    'saved_reload' => 'Valheim rilegge queste liste mentre gira, quindi la modifica vale senza riavviare.',
    'unchanged' => 'Non era cambiato nulla, quindi non è stato scritto nulla',
    'failed' => 'Non è stato possibile salvare',
    'failed_lists' => 'Il daemon ha rifiutato la scrittura di: :lists. Controlla che il server sia raggiungibile e che i file non siano in sola lettura.',
];
