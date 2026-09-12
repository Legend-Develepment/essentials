<?php

/*
 * Italiano. Scritto a mano.
 *
 * «Egg», «GameUserSettings.ini» e «daemon» restano in inglese: sono le parole
 * che compaiono in Pelican, nel gestore file e in tutto ciò che si scrive su
 * ARK.
 */

return [
    /* ------------------------------------------------ la scheda admin ---- */

    /*
     * Il titolo della sezione non è qui. Ogni sezione di impostazioni prende il
     * titolo da settings.groups.<nome>, che è quello che group() costruisce.
     */
    'section_helper' => 'Quali egg fanno girare ARK. Nient\'altro - il resto di un server ARK si configura con le sue variabili di avvio, e la pagina Avvio di Pelican le modifica già.',

    'eggs' => 'Quali egg sono ARK',
    'eggs_helper' => 'Spunta gli egg che fanno girare un server ARK. Dentro i server che li usano compare una pagina Impostazioni del mondo, e da nessun\'altra parte. È una domanda diversa da quella della pagina di stato: quella chiede quali egg rispondono alla query di Valve, cosa che fanno anche Rust e Valheim, e questa chiede quali egg tengono GameUserSettings.ini dove lo tiene ARK, cosa che fa solo ARK. All\'inizio non c\'è nulla di spuntato, ed è voluto - un plugin non può sapere che nomi hai dato ai tuoi egg.',

    /* ---------------------------------------------- la pagina del server - */

    'nav_label' => 'Impostazioni del mondo',
    'title' => 'Impostazioni di mondo di ARK',
    'subheading' => 'Le impostazioni che la gente cambia davvero, da GameUserSettings.ini.',

    'group_server' => 'Il server',
    'group_server_helper' => 'Come si chiama il server, chi può entrare, e quanti.',
    'group_rates' => 'Tassi',
    'group_rates_helper' => 'Quanto in fretta succedono le cose. 1.0 è il gioco così come esce; 2.0 è il doppio più veloce.',
    'group_rules' => 'Regole',
    'group_rules_helper' => 'Cosa possono fare i giocatori e cosa il gioco mostra loro.',

    'keeps' => 'Quindici impostazioni da un file che ne ha centinaia. Tutto il resto - le impostazioni delle tue mod, chiavi di cui questo plugin non ha mai sentito parlare, i commenti e l\'ordine di tutto quanto - resta esattamente com\'è quando salvi.',
    'missing' => 'Questo server non ha ancora un GameUserSettings.ini. Il gioco lo scrive la prima volta che gira, quindi avvia il server una volta e questa pagina si riempirà.',
    'read_only' => 'Puoi leggere questo file ma non scriverlo, quindi qui non si può cambiare nulla.',

    'save' => 'Salva',
    'saved' => 'Salvato',
    'saved_restart' => 'ARK legge questo file all\'avvio, quindi riavvia il server perché la modifica abbia effetto.',
    'failed' => 'Non è stato possibile salvare',
    'failed_write' => 'Il daemon ha rifiutato la scrittura. Controlla che il server sia raggiungibile e che il file non sia in sola lettura.',
];
