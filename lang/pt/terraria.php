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

    'section_helper' => 'Que eggs executam Terraria. Nada mais: o resto de um servidor Terraria configura-se pelas variáveis de arranque, que a página Startup do Pelican já edita.',
    'eggs' => 'Que eggs são Terraria',
    'eggs_helper' => 'Marca os eggs que executam um servidor Terraria, vanilla ou tModLoader. Nos servidores que os usam aparece uma página Definições do servidor, e em mais lado nenhum. Nada está marcado ao início, de propósito: um plugin não pode saber como chamaste os teus eggs.',

    /* ------------------------------------------ the server's page ------- */

    'nav_label' => 'Definições do servidor',
    'title' => 'Definições do servidor Terraria',
];
