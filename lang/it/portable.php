<?php

/*
 * Italiano. Scritto a mano.
 *
 * Le impostazioni come file: fuori, e di nuovo dentro.
 *
 * I file caricati non ci sono di proposito - vedi Support\Portable per capire
 * perché dirlo è meglio che lasciarli fuori in silenzio.
 */

return [
    'export' => 'Esporta le impostazioni',
    'records' => 'Esporta i registri',
    'records_helper' => 'Tutti i pacchetti, gli ordini, le fatture, i pagamenti e i ticket in un file. Rimuovere questo plugin cancella tutto e Pelican non chiede nulla prima, quindi questa è la copia da fare in anticipo. Le chiavi API restano fuori: una chiave non si ripristina da un file, si riemette.',
    'import' => 'Importa le impostazioni',
    'apply' => 'Importa',

    'file' => 'File delle impostazioni',
    'file_helper' => 'Un file esportato da questo plugin. Le immagini e i pacchetti di icone non ci sono - sono file su un disco, e restano come stanno.',

    'summary' => 'Cosa cambierebbe',
    'summary_none' => 'Scegli un file per vedere cosa cambierebbe.',
    'summary_unreadable' => 'Quello non è un file di impostazioni di questo plugin, oppure non contiene nulla che questo pannello riconosca.',
    'summary_same' => 'Nulla. Ogni impostazione di quel file corrisponde già a questo pannello.',
    'summary_count' => '{1} Cambierebbe un\'impostazione.|[2,*] Cambierebbero :count impostazioni.',
    'summary_more' => '· e altre :count',

    'imported' => 'Impostazioni importate',
    'missing' => 'Queste immagini non sono su questo pannello e vengono lasciate fuori: :files',
    'failed' => 'Non è stato possibile importare quel file',
    'no_file' => 'Non è arrivato nessun file. Un caricamento che aspetta troppo prima che si prema Importa viene cancellato dal pannello - scegli di nuovo il file e importalo subito dopo.',
    'denied' => 'Non hai il permesso di modificare queste impostazioni.',
];
