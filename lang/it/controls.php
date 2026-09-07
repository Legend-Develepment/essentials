<?php

/*
 * Italiano. Scritto a mano.
 *
 * La barra dei controlli su una pagina di server. Un file suo e non un angolo
 * di settings.php, perché questo lo legge chi usa il pannello e non chi
 * configura il tema.
 *
 * Lo stato accanto ai pulsanti è la parola di Pelican stesso, presa dall'enum
 * ContainerStatus, così la barra e la pagina della console non si contraddicono
 * mai su cosa sta facendo un server.
 *
 * "Kill" resta in inglese: è il nome del pulsante di Pelican e il nome del
 * comando, e non è la stessa cosa di arrestare.
 */

return [
    'console' => 'Console',
    'full_page' => 'Nuova finestra',
    'close' => 'Chiudi',

    'start' => 'Avvia',
    'restart' => 'Riavvia',
    'stop' => 'Arresta',
    'kill' => 'Kill',

    'kill_confirm' => 'Kill arresta il container all\'istante. Tutto ciò che il server non ha ancora scritto su disco va perso. Continuare?',

    'sent_title' => 'Azione di alimentazione',
    'sent_body' => ':action è stato inviato a :name.',
    'failed' => 'Il nodo non è raggiungibile.',
];
