<?php

/*
 * Español. Escrito a mano.
 *
 * Las copias de seguridad, en todo el panel.
 *
 * Pelican responde a «qué copias tiene este servidor». Esta página responde a
 * lo contrario, que es la pregunta que de verdad se hace un administrador y que
 * el panel no tiene dónde poner: cuáles de los míos no tienen ninguna.
 */

return [
    'title' => 'Copias de seguridad',
    'nav_label' => 'Copias de seguridad',
    'subheading' => 'Todos los servidores que puedes alcanzar, con el tiempo que llevan sin una copia. Los que nunca se han respaldado están arriba; a partir de :days días una copia cuenta como caducada.',

    // ---- la tabla ---------------------------------------------------------
    'column_server' => 'Servidor',
    'column_last' => 'Última copia',
    'column_kept' => 'Guardadas',
    'column_size' => 'Tamaño',
    'column_failed' => 'Fallidas',

    'never' => 'Nunca',

    'filter_none' => 'Nunca respaldados',
    'filter_stale' => 'Caducadas',
    'filter_failed' => 'Fallando',

    'open' => 'Abrir en Pelican',
];
