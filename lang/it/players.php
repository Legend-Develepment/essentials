<?php

/*
 * Italiano. Scritto a mano.
 *
 * «Whitelist» e «operator» restano in inglese: sono le parole che Minecraft
 * stesso scrive in server.properties, in whitelist.json e in ops.json, e sono
 * quelle che si ridigitano nella console.
 */

return [
    'nav_label' => 'Giocatori',
    'title' => 'Giocatori',
    'subheading' => 'La whitelist, gli operator, i ban, e tutti quelli che questo server ha visto.',

    /*
     * Detto una volta, in alto, perché spiega sia cosa la pagina può fare sia
     * perché una cosa che non fa non è un difetto. Ogni modifica è emessa come
     * comando di console, che è il modo in cui Minecraft va avvisato - il gioco
     * fa la modifica e scrive il proprio file, così i due non si contraddicono
     * mai.
     */
    'how' => 'Le modifiche vengono inviate al server come comandi di console, quindi è il gioco a farle e a scrivere i propri file. Per questo serve che il server sia in esecuzione.',
    'needs_running' => 'Il server deve essere in esecuzione. Queste modifiche le fa il gioco, non si fanno modificandogli i file sotto i piedi.',

    'name' => 'Nome del giocatore',
    'reason' => 'Motivo (facoltativo)',

    'whitelist' => 'Aggiungi alla whitelist',
    'unwhitelist' => 'Togli dalla whitelist',
    'op' => 'Rendi operator',
    'deop' => 'Togli operator',
    'ban' => 'Banna',
    'pardon' => 'Sbanna',
    'kick' => 'Espelli',

    'sent' => 'Comando inviato',
    'sent_body' => 'Il server lo applica e aggiorna i propri file. Ricarica la pagina per vedere le liste cambiare.',
    'refused' => 'Non è stato inviato',

    'flag_op' => 'Operator',
    'flag_whitelisted' => 'In whitelist',
    'flag_banned' => 'Bannato',
    'flag_seen' => 'Ha già giocato qui',

    'online' => 'Online adesso',
    'online_count' => ':online su :max',
    'online_none' => 'Non c\'è nessuno collegato.',

    'players' => 'Giocatori',
    'ips' => 'Indirizzi bannati',
    'ips_empty' => 'Non c\'è nessun indirizzo bannato.',

    /*
     * Cosa vuol dire una pagina vuota, che di solito non è «non ci sono
     * giocatori» ma «questo server non è mai partito». Minecraft non crea
     * nessuno di questi file prima della prima esecuzione.
     */
    'empty' => 'Non c\'è ancora nulla da mostrare. Minecraft scrive queste liste da sé, e non le crea finché il server non è partito la prima volta.',

    'level' => 'Livello :level',

    /*
     * L'unica cosa che questa pagina non fa, detta invece che lasciata da
     * scoprire. Uno stato in diretta richiede una seconda connessione al gioco
     * stesso, che è un'altra funzione con requisiti suoi.
     */
    'not_live' => 'Questo è ciò che il server ha annotato, e non chi è collegato in questo momento.',
];
