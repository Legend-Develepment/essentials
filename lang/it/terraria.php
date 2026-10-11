<?php

/*
 * Terraria, and only what is about Terraria.
 *
 * Six strings. The words the page itself uses - Save, what to say when the file
 * is not there, what the raw field names mean - are in games.php and shared with
 * every game, which is what makes a third one cheap. See roadmap/games.md.
 */

return [
    /* ------------------------------------------- the settings page ------ */

    'section_helper' => 'Quali egg eseguono Terraria. Nient\'altro: il resto di un server Terraria si configura con le variabili di avvio, che la pagina Startup di Pelican già modifica.',
    'eggs' => 'Quali egg sono Terraria',
    'eggs_helper' => 'Spunta gli egg che eseguono un server Terraria, vanilla o tModLoader. Nei server che li usano compare una pagina Impostazioni server, e da nessunaltra parte. Niente è spuntato allinizio, di proposito: un plugin non può sapere come hai chiamato i tuoi egg.',

    /* ------------------------------------------ the server's page ------- */

    'nav_label' => 'Impostazioni server',
    'title' => 'Impostazioni del server Terraria',
];
