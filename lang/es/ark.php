<?php

/*
 * Español. Escrito a mano.
 *
 * «Egg», «GameUserSettings.ini» y «daemon» se quedan en inglés: son las
 * palabras que aparecen en Pelican, en el gestor de archivos y en todo lo que
 * se escribe sobre ARK.
 */

return [
    /* ------------------------------------------- la pestaña de admin ----- */

    /*
     * El título de la sección no está aquí. Cada sección de ajustes toma su
     * título de settings.groups.<nombre>, que es lo que construye group().
     */
    'section_helper' => 'Qué eggs ejecutan ARK. Nada más — el resto de un servidor ARK se configura con sus variables de arranque, y la página Arranque de Pelican ya las edita.',

    'eggs' => 'Qué eggs son ARK',
    'eggs_helper' => 'Marca los eggs que ejecutan un servidor ARK. Dentro de los servidores que los usan aparece una página de Ajustes de mundo, y en ningún otro sitio. Es una pregunta distinta de la de la página de estado: aquella pregunta qué eggs responden a la consulta de Valve, cosa que Rust y Valheim también hacen, y esta pregunta qué eggs guardan GameUserSettings.ini donde lo guarda ARK, cosa que solo hace ARK. Al principio no hay nada marcado, y es a propósito — un plugin no puede saber cómo has llamado a tus eggs.',

    /* --------------------------------------- la página del servidor ------ */

    'nav_label' => 'Ajustes de mundo',
    'title' => 'Ajustes de mundo de ARK',
    'subheading' => 'Los ajustes que la gente cambia de verdad, de GameUserSettings.ini.',

    'group_server' => 'El servidor',
    'group_server_helper' => 'Cómo se llama el servidor, quién puede entrar y cuántos.',
    'group_rates' => 'Tasas',
    'group_rates_helper' => 'A qué velocidad pasan las cosas. 1.0 es el juego tal cual viene; 2.0 es el doble de rápido.',
    'group_rules' => 'Reglas',
    'group_rules_helper' => 'Qué pueden hacer los jugadores y qué les muestra el juego.',

    'keeps' => 'Quince ajustes de un archivo que tiene cientos. Todo lo demás — los ajustes de tus mods, claves de las que este plugin no ha oído hablar nunca, los comentarios y el orden de todo ello — se queda exactamente como está al guardar.',
    'missing' => 'Este servidor todavía no tiene GameUserSettings.ini. El juego lo escribe la primera vez que se ejecuta, así que arranca el servidor una vez y esta página se rellenará.',
    'read_only' => 'Puedes leer este archivo pero no escribirlo, así que aquí no se puede cambiar nada.',

    'save' => 'Guardar',
    'saved' => 'Guardado',
    'saved_restart' => 'ARK lee este archivo al arrancar, así que reinicia el servidor para que el cambio surta efecto.',
    'failed' => 'No se pudo guardar',
    'failed_write' => 'El daemon rechazó la escritura. Comprueba que el servidor es alcanzable y que el archivo no es de solo lectura.',
];
