<?php

/*
 * Italiano. Scritto a mano.
 *
 * «Steam App ID», «IGDB», «Twitch client ID» e «client secret» restano in
 * inglese: sono esattamente le parole che compaiono sulle pagine da cui quei
 * valori arrivano.
 */

return [
    'title' => 'Immagini degli egg',
    'nav_label' => 'Immagini degli egg',
    'subheading' => 'Immagini di gioco per i tuoi egg, prese da Steam e da IGDB. Un egg senza immagine mostra l\'uccello di Pelican su ogni scheda di server che lo usa.',

    // ---- la tabella -------------------------------------------------------
    'column_name' => 'Egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'Bloccata',

    'locked' => 'Bloccata',
    'unlocked' => 'Libera',

    // ---- cosa si può fare su una riga -------------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'Il numero nell\'indirizzo Steam di un gioco — store.steampowered.com/app/892970 fa 892970. Prendere l\'immagine tramite identificativo la blocca, perché digitare un numero è una decisione e una passata in blocco successiva non deve annullarla.',

    'fetch_igdb' => 'IGDB',
    'search_term' => 'Cerca',
    'search_term_helper' => 'Il nome dell\'egg è già compilato, ma raramente è il nome del gioco — «Paper 1.20.4» è Minecraft. Scrivi il gioco.',

    'lock' => 'Blocca',
    'unlock' => 'Sblocca',
    'locked_done' => 'Bloccata — una passata in blocco lascerà in pace questa',
    'unlocked_done' => 'Sbloccata — una passata in blocco può sostituire questa immagine',

    'clear' => 'Cancella',
    'clear_confirm' => 'Toglie l\'immagine e lo Steam App ID. L\'egg torna all\'uccello di Pelican, e la prossima passata in blocco riproverà.',
    'cleared' => 'Immagine tolta',

    // ---- esiti ------------------------------------------------------------
    'fetched' => 'Immagine salvata',
    'failed' => 'Non è stata salvata nessuna immagine',

    /*
     * Un motivo per ciascuno, perché sono problemi diversi.
     *
     * Un recupero fallito per un errore di battitura e uno fallito perché il
     * disco è pieno non dovrebbero dire entrambi «fallito» — il primo si
     * risolve guardando il numero, il secondo guardando il server.
     */
    'why_bad_id' => 'Quello non è uno Steam App ID.',
    'why_not_found' => 'Steam non ha nulla a quell\'indirizzo. Controlla l\'App ID — un gioco senza pagina di negozio non ha nemmeno un\'immagine di testata.',
    'why_no_match' => 'Non è stato trovato nulla con quel nome. Prova con il nome vero del gioco invece che con quello dell\'egg.',
    'why_no_name' => 'Non c\'è nulla da cercare.',
    'why_no_token' => 'Twitch non ha rilasciato nessun token. Controlla il client ID e il secret sotto «Credenziali».',
    'why_not_configured' => 'IGDB richiede un Twitch client ID e un secret. Inseriscili sotto «Credenziali».',
    'why_empty' => 'La risposta era vuota.',
    'why_large' => 'Quell\'immagine è molto più grande di un\'icona e non è stata salvata.',
    'why_not_an_image' => 'Ciò che è tornato non è un\'immagine. Di solito vuol dire che una pagina di errore ha risposto con un codice di successo.',
    'why_wrong_format' => 'Quell\'immagine è in un formato che questo pannello non conserva. Pelican tiene PNG, JPEG e WebP.',
    'why_unwritable' => 'Non è stato possibile scrivere l\'immagine. Controlla che storage/app/public appartenga all\'utente con cui gira il pannello, e che php artisan storage:link sia stato eseguito.',
    'why_unknown' => 'Non ha funzionato, e il motivo non è uno a cui questo sappia dare un nome.',

    // ---- tutto insieme ----------------------------------------------------
    'bulk' => 'Prendi tutte quelle che mancano',
    'bulk_confirm_steam' => 'Cerca su Steam per nome ogni egg che non ha un\'immagine e non è bloccato. Gli egg bloccati e quelli che hanno già un\'immagine restano in pace. Questo gira in secondo piano — ti verrà detto quando finisce.',
    'bulk_confirm_both' => 'Cerca su Steam per nome ogni egg che non ha un\'immagine e non è bloccato, poi prova IGDB per ciò che Steam non ha trovato. Gli egg bloccati e quelli che hanno già un\'immagine restano in pace. Questo gira in secondo piano — ti verrà detto quando finisce.',

    'bulk_started' => 'Recupero in secondo piano',
    'bulk_started_body' => 'Su un pannello grande può richiedere diversi minuti. Ricevi una notifica quando è finito, e puoi lasciare questa pagina.',

    'bulk_done' => 'Immagini degli egg completate',
    'bulk_done_body' => ':fetched prese, :skipped lasciate in pace, :failed senza nulla di trovato. Un egg resta in pace quando è bloccato o ha già un\'immagine.',

    'bulk_failed' => 'La passata in blocco non è partita',
    'bulk_failed_queue' => 'Non è stato possibile consegnarla alla coda. Questo richiede un queue worker — controlla che pelican-queue stia girando.',

    // ---- credenziali IGDB -------------------------------------------------
    'credentials' => 'Credenziali',
    'credentials_helper' => 'Steam funziona senza nulla di tutto questo. Questi dati servono solo a IGDB, che copre i giochi di cui Steam non ha mai sentito parlare — Minecraft e ognuna delle sue varianti, tutto ciò che è uscito su console, la maggior parte degli egg con mod.',
    'credentials_where' => 'Crea un\'applicazione su dev.twitch.tv/console, genera un client secret, e incolla entrambi qui. È gratuito.',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => 'Credenziali salvate',
    'credentials_failed' => 'Non è stato possibile salvare le credenziali',
];
