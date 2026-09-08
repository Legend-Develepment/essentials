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
    'update' => 'Aggiorna',
    'update_available' => 'È disponibile un aggiornamento',
    'update_confirm' => 'Il pannello scarica la nuova versione, ricostruisce i suoi asset e svuota le sue cache. Le tue impostazioni vengono mantenute.',
    'update_started' => 'Aggiornamento avviato',
    'update_background' => 'Gira in secondo piano e richiede un minuto o due.',
    'update_failed' => 'Non è stato possibile aggiornare il tema',
    'update_done' => 'Tema aggiornato',
    'check' => 'Cerca aggiornamenti',
    'check_failed' => 'Non è stato possibile leggere il feed degli aggiornamenti',
    'check_failed_body' => 'Il pannello non ci è arrivato, oppure non ha restituito JSON valido.',
    'up_to_date' => 'Sei sulla versione più recente',
    'reinstall' => 'Reinstalla',

    'auto_on' => 'Gli aggiornamenti si installano da soli',

    /*
     * Cosa ha fatto l'ultimo controllo automatico. Ognuna di queste righe nomina
     * la parte che andrebbe guardata, perché da un browser i tre modi in cui
     * questo va storto sembrano tutti uguali: un numero che scende.
     */
    'auto_never' => 'Non c\'è ancora stato nessun controllo. Gli aggiornamenti automatici richiedono lo scheduler del pannello — la voce di cron che esegue php artisan schedule:run ogni minuto. Senza di essa non succede nulla di ciò che è pianificato.',
    'auto_ago' => 'Ultimo controllo :ago',
    'auto_just_now' => 'proprio adesso',
    'auto_minutes' => 'minuti fa',
    'auto_current' => 'non c\'è nulla di più recente su questo canale.',
    'auto_installed' => 'La v:version è stata installata qui, dal controllo pianificato stesso. Lo fa quando nessun queue worker risponde, così l\'aggiornamento avviene comunque — ma un pannello senza worker è un pannello in cui nemmeno il resto del lavoro in coda sta avvenendo.',
    'auto_queued' => 'La v:version è stata passata al queue worker. Se la versione qui sopra non cambia entro qualche minuto, il worker sta prendendo i lavori ma su questo fallisce — di solito si risolve riavviandolo, e il motivo è in storage/logs.',
    'auto_unreachable' => 'non è stato possibile leggere il feed degli aggiornamenti. Viene scaricato da internet, quindi di solito è un problema di rete o di DNS sull\'host del pannello.',
    'auto_error' => 'il controllo è fallito. Il motivo è in storage/logs.',

    /*
     * Il queue worker, che è ciò che esegue davvero un aggiornamento. Detto a
     * parte rispetto al controllo qui sopra perché falliscono separatamente e
     * la cura è diversa per ciascuno.
     */
    'worker_missing' => 'Nessun queue worker ha risposto. Gli aggiornamenti, le installazioni di modpack e questi controlli vengono messi in coda ed eseguiti da un processo worker, quindi finché non ne gira uno restano annotati e non vengono mai eseguiti, senza alcun errore da nessuna parte. O non c\'è nessun worker, oppure ce n\'è uno avviato prima che questo plugin fosse installato e che non riesce a caricarne il codice — entrambi si risolvono riavviandolo sull\'host del pannello. Imposta il suo servizio perché si riavvii da solo, o questo ritorna dopo ogni aggiornamento.',

    'next_check' => 'Prossimo controllo tra',
    'due_now' => 'previsto adesso',

    /*
     * Chiamato con il nome della causa e non del sintomo, perché il sintomo è
     * «non è successo nulla» ed è quello che lo rendeva difficile da collocare:
     * gli annunci, i link di navigazione, gli stili salvati e le disposizioni
     * delle pagine sono tutti file sotto storage/app, e una directory in cui il
     * pannello non riesce a scrivere li perde tutti senza una parola.
     */
    'storage_failed' => 'Il pannello non è riuscito a scrivere nella sua directory storage, quindi questo non è stato salvato. Controlla che storage/app appartenga all\'utente con cui gira il pannello. Il motivo è in storage/logs.',

    /*
     * Detto dopo ogni aggiornamento fallito e non solo dopo una discordanza di
     * identificativi. Il messaggio qui sopra nomina già la causa; questo nomina
     * l'unico rimedio che non si ricava da «atteso X, ottenuto Y».
     */
    'update_renamed' => 'Se qui c\'è scritto che due identificativi non coincidono, il plugin è stato rinominato, e nessun aggiornamento attraversa quello — Pelican riconosce un plugin installato dal suo identificativo. Disinstalla la voce vecchia in Admin → Plugin e installa questo da capo. Le tue impostazioni sopravvivono: vivono nel .env e in storage/app/private/legend-theme, e nessuno dei due è indicizzato per identificativo.',
];
