<?php

/*
 * Italiano. Scritto a mano.
 *
 * «Queue worker», «scheduler», «cron», «canale» e i percorsi come storage/app
 * restano come sono: sono i nomi con cui si ritrovano sul server e nella
 * documentazione di Pelican, ed è esattamente ciò che serve quando compare uno
 * di questi messaggi.
 */

return [
    'title' => 'Impostazioni di Essentials',
    'nav_label' => 'Impostazioni di Essentials',
    'save' => 'Salva',
    'saved' => 'Impostazioni salvate',
    'save_failed' => 'Non è stato possibile salvare le impostazioni',
    'secret_kept' => 'Salvato. Lascia vuoto per mantenerlo o scrivine uno nuovo per sostituirlo.',
    'update_background' => 'Gira in secondo piano e richiede un minuto o due.',

    /*
     * Il queue worker e lo scheduler, da cui dipendono ogni lavoro in
     * background e ogni attività pianificata. Detti a parte perché falliscono
     * separatamente e la cura è diversa per ciascuno.
     */
    'worker_missing' => 'Nessun queue worker ha risposto. Le installazioni di modpack, le mail e gli altri lavori in background vengono messi in coda ed eseguiti da un processo worker, quindi finché non ne gira uno restano annotati e non vengono mai eseguiti, senza alcun errore da nessuna parte. O non c\'è nessun worker, oppure ce n\'è uno avviato prima che questo plugin fosse installato e che non riesce a caricarne il codice - entrambi si risolvono riavviandolo sull\'host del pannello. Imposta il suo servizio perché si riavvii da solo, o questo ritorna dopo ogni aggiornamento.',

    'cron_missing' => 'Lo scheduler del pannello non gira da :for minuti. I rinnovi e i controlli del watchdog aspettano lui. La riga di cron sta nella documentazione di Pelican.',

    /*
     * Chiamato con il nome della causa e non del sintomo, perché il sintomo è
     * «non è successo nulla» ed è quello che lo rendeva difficile da collocare:
     * gli annunci, i link di navigazione, gli stili salvati e le disposizioni
     * delle pagine sono tutti file sotto storage/app, e una directory in cui il
     * pannello non riesce a scrivere li perde tutti senza una parola.
     */
    'storage_failed' => 'Il pannello non è riuscito a scrivere nella sua directory storage, quindi questo non è stato salvato. Controlla che storage/app appartenga all\'utente con cui gira il pannello. Il motivo è in storage/logs.',
];
