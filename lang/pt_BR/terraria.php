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

    'section_helper' => 'Quais eggs executam Terraria. Nada mais: o resto de um servidor Terraria se configura pelas variáveis de inicialização, que a página Startup do Pelican já edita.',
    'eggs' => 'Quais eggs são Terraria',
    'eggs_helper' => 'Marque os eggs que executam um servidor Terraria, vanilla ou tModLoader. Nos servidores que os usam aparece uma página Configurações do servidor, e em nenhum outro lugar. Nada vem marcado, de propósito: um plugin não pode saber como você nomeou seus eggs.',

    /* ------------------------------------------ the server's page ------- */

    'nav_label' => 'Configurações do servidor',
    'title' => 'Configurações do servidor Terraria',
];
