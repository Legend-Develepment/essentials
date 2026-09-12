<?php

/*
 * Italiano. Scritto a mano.
 *
 * «Mod», «plugin», «loader», «jar» e i nomi di cartella mods/ e plugins/
 * restano come sono: sono le parole che compaiono su Modrinth, nel gestore file
 * e in qualsiasi guida si trovi in proposito.
 */

return [
    'nav_label' => 'Mod e plugin',
    'title' => 'Mod e plugin',
    'subheading' => 'Uno alla volta, da Modrinth, dentro questo server.',

    'section' => 'Trovare qualcosa',
    'section_helper' => 'La pagina dei modpack installa un pack intero in una volta. Questa installa una singola mod o un singolo plugin, che è quello che si vuole molto più spesso.',

    'kind' => 'Cosa stai aggiungendo',
    /*
     * Chiesto e non ricavato. Un egg si chiama come lo ha chiamato un
     * amministratore, e diversi loader leggono entrambe le cartelle, quindi da
     * qui non c'è modo onesto di indovinarlo - e indovinare male scrive una jar
     * in una cartella che nessuno legge.
     */
    'kind_helper' => 'Una mod va in mods/ ed è per Fabric, Forge o NeoForge. Un plugin va in plugins/ ed è per Bukkit, Spigot o Paper. Questo decide anche in quale metà di Modrinth si cerca.',
    'kind_mod' => 'Una mod (mods/)',
    'kind_plugin' => 'Un plugin (plugins/)',

    'search' => 'Cerca',
    'search_helper' => 'Scrivi un nome e clicca fuori dal campo. I risultati escono per numero di download.',

    'project' => 'Mod o plugin',
    'version' => 'Versione',
    'version_helper' => 'Ogni riga porta il numero di versione, le versioni di Minecraft per cui è compilata e i loader che supporta. Scegline una che vada bene per il tuo server - qui nessuno lo controlla per te.',

    'install' => 'Installa',
    'install_confirm' => 'Il file viene scaricato dal nodo direttamente da Modrinth e messo nella cartella. Nulla di ciò che c\'è già viene rimosso.',
    'installed' => 'Installato',
    'installed_helper' => 'Si carica al prossimo avvio del server.',

    'change' => 'Cambia versione',
    'change_helper' => 'Mette un\'altra versione dello stesso progetto al posto di questo file. La nuova viene scaricata prima che la vecchia sia cancellata, quindi un download fallito ti lascia con quello che avevi già.',
    'change_project_helper' => 'Fisso per tutto ciò che è stato installato da questa pagina. Cambiarlo non sarebbe un cambio di versione - sarebbe un\'altra mod con lo stesso nome di file.',
    'change_lookup_helper' => 'Questo file era già nella cartella, quindi qui nessuno sa cosa sia. Cercalo una volta e verrà ricordato.',
    'changed' => 'Versione cambiata',

    'check' => 'Cerca aggiornamenti',
    'checked' => 'Controllato',
    'checked_none' => 'Tutto ciò che è conosciuto è alla sua versione più recente.',
    'checked_some' => ':count hanno una versione più recente. Sono segnalati nella lista.',
    'update_ready' => 'v:number disponibile',
    /*
     * Detto accanto al distintivo e non in un suggerimento, perché cambia cosa
     * il distintivo significa: qui nessuno sa quale versione di Minecraft né
     * quale loader il server faccia girare.
     */
    'check_note' => 'Più recente vuol dire più recente su Modrinth. Qui nessuno sa quale versione di Minecraft né quale loader il tuo server faccia girare, quindi controlla che la versione che scegli dichiari di andare bene prima di avviare il server.',
    'unknown' => 'Non installato da qui - usa «Cambia versione» per dire cos\'è',

    'remove' => 'Rimuovi',
    'remove_confirm' => 'Il file viene cancellato dal server. Da qui non si può annullare.',
    'removed' => 'Rimosso',

    'running' => 'Il server è in esecuzione',
    'running_helper' => 'Minecraft legge mods/ e plugins/ una sola volta, all\'avvio. Un file aggiunto adesso si caricherebbe solo dopo un riavvio, e uno tolto da sotto i piedi a un gioco in esecuzione può portarsi via il gioco. Ferma prima il server.',

    'failed' => 'Non ha funzionato',
    'failed_version' => 'Quella versione non ha nessuna jar che questo possa installare. Alcuni rilasci portano solo i sorgenti, o solo una build client.',
    'failed_write' => 'Il nodo ha rifiutato il download. Potrebbe non essere riuscito a raggiungere Modrinth.',

    'installed_title' => 'Installati',
    'installed_mods' => 'In mods/',
    'installed_plugins' => 'In plugins/',
    /*
     * Detto perché una lista vuota è ambigua: di solito vuol dire che questo
     * server quella cartella non la usa affatto, e non che manchi qualcosa.
     */
    'installed_empty' => 'Qui non c\'è nulla. Un server usa solo una di queste due cartelle, quindi che una sia vuota è normale.',
    'installed_note' => 'Sono elencati solo i file .jar. Le cartelle di configurazione e i file disattivati vengono lasciati in pace e non sono mostrati.',
];
