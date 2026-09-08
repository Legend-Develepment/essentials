<?php

/*
 * La página que responde a «cuál de los míos va atrasado». Escrita para
 * quien es dueño de los servidores, no para quien lleva el panel - por eso
 * aquí no se habla de nodes, y no hay ningún número con el que no pueda
 * hacer nada. Cada línea nombra un servidor que puede abrir o dice qué hacer
 * con él.
 */

return [
    'title' => 'Necesitan atención',
    'nav_label' => 'Necesitan atención',
    'subheading' => 'Tus servidores, ordenados por lo que va atrasado y no por nombre. Una copia se considera caducada a los :days días.',
    'column_server' => 'Servidor',
    'column_last' => 'Última copia',
    'column_kept' => 'Guardadas',
    'column_schedules' => 'Tareas paradas',
    'never' => 'Nunca',
    'filter_none' => 'Nunca respaldados',
    'filter_stale' => 'La copia está caducada',
    'open' => 'Copias de seguridad',
    'empty' => 'Nada va atrasado',
    'empty_body' => 'Todos los servidores que puedes alcanzar tienen una copia reciente y ninguna tarea parada. Esta página se llena sola cuando eso deje de ser cierto.',
];
