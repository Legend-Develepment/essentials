<?php

/*
 * Español. Escrito a mano.
 *
 * «Whitelist» y «operator» se quedan en inglés: son las palabras que el propio
 * Minecraft escribe en server.properties, en whitelist.json y en ops.json, y
 * son las que se vuelven a teclear en la consola.
 */

return [
    'nav_label' => 'Jugadores',
    'title' => 'Jugadores',
    'subheading' => 'La whitelist, los operators, los baneos, y todos los que este servidor ha visto.',

    /*
     * Dicho una vez, cerca del principio, porque explica tanto lo que la página
     * puede hacer como por qué una cosa que no hace no es un fallo. Cada cambio
     * se emite como comando de consola, que es como hay que decírselo a
     * Minecraft - el juego hace el cambio y escribe su propio archivo, así que
     * los dos nunca se contradicen.
     */
    'how' => 'Los cambios se envían al servidor como comandos de consola, así que los hace el juego y es él quien escribe sus archivos. Para eso el servidor tiene que estar en marcha.',
    'needs_running' => 'El servidor tiene que estar en marcha. Estos cambios los hace el juego, no se hacen editando sus archivos por debajo.',

    'name' => 'Nombre del jugador',
    'reason' => 'Motivo (opcional)',

    'whitelist' => 'Añadir a la whitelist',
    'unwhitelist' => 'Quitar de la whitelist',
    'op' => 'Hacer operator',
    'deop' => 'Quitar operator',
    'ban' => 'Banear',
    'pardon' => 'Desbanear',
    'kick' => 'Expulsar',

    'sent' => 'Comando enviado',
    'sent_body' => 'El servidor lo aplica y actualiza sus propios archivos. Recarga la página para ver cambiar las listas.',
    'refused' => 'Eso no se envió',

    'flag_op' => 'Operator',
    'flag_whitelisted' => 'En la whitelist',
    'flag_banned' => 'Baneado',
    'flag_seen' => 'Ha jugado aquí',

    'online' => 'En línea ahora',
    'online_count' => ':online de :max',
    'online_none' => 'No hay nadie conectado.',

    'players' => 'Jugadores',
    'ips' => 'Direcciones baneadas',
    'ips_empty' => 'No hay ninguna dirección baneada.',

    /*
     * Lo que significa una página vacía, que normalmente no es «no hay
     * jugadores» sino «este servidor no ha arrancado nunca». Minecraft no crea
     * ninguno de estos archivos hasta su primera ejecución.
     */
    'empty' => 'Todavía no hay nada que mostrar. Minecraft escribe estas listas él mismo, y no las crea hasta que el servidor ha arrancado por primera vez.',

    'level' => 'Nivel :level',

    /*
     * Lo único que esta página no hace, dicho en vez de dejarlo para que se
     * descubra. Un estado en vivo necesita una segunda conexión al juego mismo,
     * que es otra función con sus propios requisitos.
     */
    'not_live' => 'Esto es lo que el servidor ha anotado, no quién está conectado ahora mismo.',
];
