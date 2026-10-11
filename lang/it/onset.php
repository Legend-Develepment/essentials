<?php

/*
 * Onset, and only what is about Onset.
 *
 * Six strings, which is what a game costs. The words the page itself uses are
 * in games.php and shared with every game that edits a file, which is what
 * makes the next one cheap. See roadmap/games.md.
 */

return [
    /* ------------------------------------------- the settings page ------ */

    'section_helper' => 'Quali egg eseguono Onset. Nient\'altro: il resto si configura con le variabili di avvio, che la pagina Startup di Pelican già modifica.',
    'eggs' => 'Quali egg sono Onset',
    'eggs_helper' => 'Spunta gli egg che eseguono un server Onset. Nei server che li usano compare una pagina Impostazioni server, e da nessunaltra parte. Niente è spuntato allinizio, di proposito.',

    /* ------------------------------------------ the server's page ------- */

    'nav_label' => 'Impostazioni server',
    'title' => 'Impostazioni del server Onset',
];
