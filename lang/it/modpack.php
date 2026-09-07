<?php

/*
 * Italiano. Scritto a mano.
 *
 * «Modpack», «loader», «egg», «daemon», «mod» e «config» restano in inglese:
 * sono le parole che compaiono su Modrinth, nel gestore file e in qualsiasi
 * guida si trovi in proposito.
 */

return [
    'nav_label' => 'Modpack',
    'title' => 'Modpack',
    'subheading' => 'Installare un modpack da Modrinth su questo server.',

    'section' => 'Trovare un pack',
    'section_helper' => 'Solo Modrinth, e solo i pack lato server. Non chiede né account né chiave API, ed è per questo che è l\'unica fonte qui — le altre vogliono tutte una chiave incollata da qualche parte prima che compaia qualcosa.',

    'search' => 'Cerca',
    'search_helper' => 'Lascia vuoto per i più scaricati. Cercare interroga Modrinth, quindi succede quando esci dal campo e non mentre scrivi.',

    'pack' => 'Pack',
    'pack_helper' => 'Sono elencati solo i pack che dichiarano di girare su un server.',

    'version' => 'Versione',
    'version_helper' => 'La versione del gioco e il loader compaiono accanto a ciascuna. Scegli il loader che l\'egg di questo server già fa girare — questo installa file e non cambia il tuo egg né il tuo comando di avvio.',

    'downloads' => 'download',

    'install' => 'Installa questo pack',
    'install_go' => 'Installalo',
    'install_confirm' => 'I file del pack vengono aggiunti a questo server. **Non viene cancellato nulla** — né il tuo mondo, né le tue vecchie mod, né una config. Un pack installato sopra un altro li lascia entrambi, quindi togli prima tu le mod del pack precedente se è ciò che vuoi. Il server deve essere fermo, e resta fermo.',

    'started' => 'Installazione in corso',
    'started_helper' => 'Il pack sta venendo scaricato e scompattato. Qualche centinaio di file richiede qualche minuto, e ricevi una notifica alla fine — continua anche se lasci questa pagina.',

    'running' => 'Il server è in esecuzione',
    'running_helper' => 'Minecraft carica le sue mod all\'avvio, quindi un pack installato adesso lascerebbe un server che non è né il pack vecchio né quello nuovo finché non riavvia. Fermalo e riprova.',

    'done' => ':pack installato',
    'done_body' => ':files file scaricati e :overrides elementi dalla cartella propria del pack messi al loro posto. Avvia il server quando vuoi.',
    'done_refused' => ':count file sono stati saltati perché il pack li chiedeva da un posto da cui qui non si scarica.',

    'failed' => 'Il pack non è stato installato',
    'failed_fetch' => 'Non è stato possibile scaricare o scompattare il pack. Il daemon potrebbe essere irraggiungibile, oppure il server potrebbe essere rimasto senza disco.',
    'failed_index' => 'Il pack è stato scaricato ma non conteneva alcun indice leggibile, quindi non c\'era nulla da installare.',
    'failed_version' => 'Quella versione non ha più un file di pack da scaricare. Scegline un\'altra.',
    'failed_queue' => 'Non è stato possibile mettere in coda l\'installazione. Questo richiede un queue worker attivo sul pannello.',
];
