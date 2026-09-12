<?php

/*
 * Español. Escrito a mano.
 *
 * Quién está en un servidor, para los juegos que responden a la consulta de
 * Valve.
 *
 * Una sola página para Rust, ARK, Valheim y el resto, porque responden al mismo
 * paquete. Lo que cambia de un juego a otro es lo que puedes hacerle a alguien
 * - expulsar es `kick "nombre"` en uno y `KickPlayer <id>` en otro - y por eso
 * esta página lee y no actúa.
 */

return [
    'title' => 'Jugadores',
    'nav_label' => 'Jugadores',
    'subheading' => 'Quién está conectado, preguntado al juego mismo y no al panel.',

    'refresh' => 'Preguntar de nuevo',

    'count' => ':count conectados',
    'score' => 'Puntuación',

    'just_joined' => 'acaba de entrar',
    'minutes' => ':count min',
    'hours' => ':count h',
    'hours_minutes' => ':hours h :minutes min',

    'empty' => 'No hay nadie en este servidor.',

    /*
     * No «no hay nadie», y la diferencia importa.
     *
     * El panel y el puerto del juego suelen estar en redes que no se alcanzan
     * entre sí, y dibujar eso como una lista vacía sería decir algo que esta
     * página no sabe.
     */
    'unreachable' => 'El servidor no respondió. Puede que esté arrancando, o que el panel no alcance su puerto de juego desde donde se ejecuta - que no es lo mismo que no haya nadie dentro.',
];
