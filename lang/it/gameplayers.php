<?php

/*
 * Italiano. Scritto a mano.
 *
 * Chi è su un server, per i giochi che rispondono alla query di Valve.
 *
 * Una sola pagina per Rust, ARK, Valheim e gli altri, perché rispondono allo
 * stesso pacchetto. Ciò che cambia da gioco a gioco è cosa puoi fare a
 * qualcuno — espellere è `kick "nome"` su uno e `KickPlayer <id>` su un altro —
 * ed è per questo che questa pagina legge e non agisce.
 */

return [
    'title' => 'Giocatori',
    'nav_label' => 'Giocatori',
    'subheading' => 'Chi è collegato, chiesto al gioco stesso e non al pannello.',

    'refresh' => 'Chiedi di nuovo',

    'count' => ':count collegati',
    'score' => 'Punteggio',

    'just_joined' => 'appena entrato',
    'minutes' => ':count min',
    'hours' => ':count h',
    'hours_minutes' => ':hours h :minutes min',

    'empty' => 'Non c\'è nessuno su questo server.',

    /*
     * Non «non c'è nessuno», e la differenza conta.
     *
     * Il pannello e la porta di gioco spesso stanno su reti che non si
     * raggiungono, e disegnare questo come una lista vuota sarebbe questa
     * pagina che dice qualcosa che non sa.
     */
    'unreachable' => 'Il server non ha risposto. Potrebbe essere in avvio, oppure il pannello potrebbe non raggiungere la sua porta di gioco da dove gira — che non è la stessa cosa di non avere nessuno dentro.',
];
