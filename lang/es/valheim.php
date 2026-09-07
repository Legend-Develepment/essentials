<?php

/*
 * Español. Escrito a mano.
 *
 * «Egg», «daemon», «SteamID64» y «PlayFab ID» se quedan en inglés: son las
 * palabras de Pelican y las del juego, y es con esos nombres con los que se
 * vuelven a encontrar.
 */

return [
    /* ------------------------------------------- la pestaña de admin ----- */

    'section_helper' => 'Qué eggs ejecutan Valheim. Nada más — un servidor de Valheim se configura con sus variables de arranque, y la página Arranque de Pelican ya las edita.',

    'eggs' => 'Qué eggs son Valheim',
    'eggs_helper' => 'Marca los eggs que ejecutan un servidor de Valheim. Dentro de los servidores que los usan aparece una página de Listas de jugadores, y en ningún otro sitio. Dónde viven esas listas cambia según el egg, así que se averigua servidor por servidor mirando en los sitios que usa el juego. Al principio no hay nada marcado, y es a propósito — un plugin no puede saber cómo has llamado a tus eggs.',

    /* --------------------------------------- la página del servidor ------ */

    'nav_label' => 'Listas de jugadores',
    'title' => 'Listas de jugadores de Valheim',
    'subheading' => 'Los admins, los baneados y la lista de permitidos, como tres listas en vez de tres archivos de texto.',

    'admin' => 'Admins',
    'admin_helper' => 'Todos los que estén aquí pueden usar los comandos de admin dentro del juego.',
    'banned' => 'Baneados',
    'banned_helper' => 'A todos los que estén aquí se les rechaza cuando intentan entrar.',
    'permitted' => 'Permitidos',
    'permitted_helper' => 'Si esta lista tiene a alguien, solo esas personas pueden entrar. Una lista vacía deja entrar a todo el mundo — que es lo que quieren casi todos los servidores, así que déjala vacía salvo que lo digas en serio.',

    'ids' => 'Identificadores de jugador',
    'ids_placeholder' => 'Pega un identificador y pulsa espacio',

    'how' => 'Un identificador por jugador — un SteamID64 en un servidor de Steam, un PlayFab ID en uno con juego cruzado. Pégalos y pulsa espacio, tabulador o coma. Lo que el juego haya escrito como comentario encima de la lista se queda donde está.',
    'where' => 'Leído de :dir.',
    'missing' => 'Este servidor todavía no tiene ninguno de estos archivos. El juego los escribe cuando los necesita por primera vez, y guardar aquí creará los que rellenes.',
    'read_only' => 'Puedes leer estos archivos pero no escribirlos, así que aquí no se puede cambiar nada.',

    'save' => 'Guardar',
    'saved' => 'Guardado',
    'saved_reload' => 'Valheim relee estas listas mientras está en marcha, así que el cambio se aplica sin reiniciar.',
    'unchanged' => 'No había cambiado nada, así que no se escribió nada',
    'failed' => 'No se pudo guardar',
    'failed_lists' => 'El daemon rechazó la escritura de: :lists. Comprueba que el servidor es alcanzable y que los archivos no son de solo lectura.',
];
