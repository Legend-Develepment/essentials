<?php

/*
 * The words every game settings page uses.
 *
 * Shared because that is where the cost of a game turned out to be. A page's
 * own list of settings costs nothing to translate - a key in a config file is
 * the same string in every language, and the two pages that exist both derive
 * their field names from it. What a game actually costs is its page: the title,
 * the sentence under it, what to say when the file is not there yet, and what
 * to say when the daemon refuses a write.
 *
 * None of that is about any particular game, so none of it is repeated per
 * game. A third game needs six strings of its own rather than eighteen.
 *
 * See roadmap/games.md.
 */

return [
    'save' => 'Salva',
    'saved' => 'Salvato',
    'restart' => 'Il gioco legge questo file allavvio, quindi riavvia il server perché la modifica abbia effetto.',
    'failed' => 'Salvataggio non riuscito',
    'failed_write' => 'Il daemon ha rifiutato la scrittura. Controlla che il server sia raggiungibile e che il file non sia di sola lettura.',
    'read_only' => 'Puoi leggere questo file ma non scriverlo, quindi qui non si può cambiare nulla.',
    'missing' => 'Questo server non ha ancora un file di configurazione. Il gioco lo scrive al primo avvio: avvia il server una volta e questa pagina si riempirà.',
    'keeps' => 'Tutto il resto del file - i commenti, le righe vuote, lordine e ogni chiave che questo plugin non conosce - resta esattamente comera al salvataggio.',
    'raw' => 'I nomi qui sono quelli del gioco, nellordine del file. Niente viene tradotto o raggruppato, perché questa pagina legge il file invece di una lista scritta a mano: mostra ogni impostazione che il gioco conosce.',
    'unset' => 'Non impostato. Il gioco lo cita come esempio; compilarlo lo aggiunge.',
    'group_all' => 'Impostazioni',
    'group_all_helper' => 'Tutto ciò che questo file cita.',
    'subheading' => 'Costruito da :files invece che da una lista scritta a mano.',
];
