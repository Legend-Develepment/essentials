<?php

/*
 * The words every game settings page uses.
 *
 * Shared because that is where the cost of a game turned out to be. A page's
 * own list of settings costs nothing to translate - a key in a config file is
 * the same string in every language, and the two pages that exist both derive
 * their field names from it. What a game actually costs is its page: the title,
 * the sentence under it, what to say when the file is not there yet, and what
 * to say when the daemon refuses a write.
 *
 * None of that is about any particular game, so none of it is repeated per
 * game. A third game needs six strings of its own rather than eighteen.
 *
 * See roadmap/games.md.
 */

return [
    'save' => 'Guardar',
    'saved' => 'Guardado',
    'restart' => 'El juego lee este archivo al arrancar, así que reinicia el servidor para que el cambio surta efecto.',
    'failed' => 'No se pudo guardar',
    'failed_write' => 'El daemon rechazó la escritura. Comprueba que el servidor sea accesible y que el archivo no sea de solo lectura.',
    'read_only' => 'Puedes leer este archivo pero no escribirlo, así que aquí no se puede cambiar nada.',
    'missing' => 'Este servidor aún no tiene archivo de configuración. El juego lo escribe en el primer arranque, así que inicia el servidor una vez y esta página se rellenará.',
    'keeps' => 'Todo lo demás del archivo - los comentarios, las líneas vacías, el orden y cada clave que este plugin no conoce - queda exactamente igual al guardar.',
    'raw' => 'Los nombres aquí son los del juego, en el orden del archivo. Nada se traduce ni se agrupa, porque esta página lee el archivo en vez de una lista escrita a mano: muestra cada ajuste que el juego entiende.',
    'unset' => 'Sin definir. El juego lo menciona como ejemplo; rellenarlo lo añade.',
    'group_all' => 'Ajustes',
    'group_all_helper' => 'Todo lo que menciona este archivo.',
    'subheading' => 'Construido a partir de :files en vez de una lista escrita a mano.',
];
