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

    'section_helper' => 'Qué eggs ejecutan Terraria. Nada más: el resto de un servidor Terraria se configura con sus variables de arranque, y la página Startup de Pelican ya las edita.',
    'eggs' => 'Qué eggs son Terraria',
    'eggs_helper' => 'Marca los eggs que ejecutan un servidor Terraria, vanilla o tModLoader. Dentro de los servidores que los usan aparece una página Ajustes del servidor, y en ningún otro sitio. Nada está marcado al principio, a propósito: un plugin no puede saber cómo has llamado tus eggs.',

    /* ------------------------------------------ the server's page ------- */

    'nav_label' => 'Ajustes del servidor',
    'title' => 'Ajustes del servidor Terraria',
];
