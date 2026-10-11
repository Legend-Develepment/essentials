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

    'section_helper' => 'Quels eggs font tourner Terraria. Rien d\'autre : le reste d un serveur Terraria se configure par ses variables de démarrage, que la page Startup de Pelican édite déjà.',
    'eggs' => 'Quels eggs sont Terraria',
    'eggs_helper' => 'Cochez les eggs qui font tourner un serveur Terraria, vanilla ou tModLoader. Une page Réglages du serveur apparaît dans les serveurs qui les utilisent, et nulle part ailleurs. Rien n est coché au départ, volontairement : un plugin ne peut pas savoir comment vous avez nommé vos eggs.',

    /* ------------------------------------------ the server's page ------- */

    'nav_label' => 'Réglages du serveur',
    'title' => 'Réglages du serveur Terraria',
];
