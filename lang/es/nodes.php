<?php

/*
 * Español. Escrito a mano.
 *
 * El bloque del panel de control: la máquina en la que está el panel, y cada
 * nodo.
 *
 * Las cifras de los nodos son las del propio Pelican, leídas del daemon de cada
 * nodo. La fila del panel se lee de /proc, que es otra pregunta - véase
 * Support\SystemStatus.
 */

return [
    // El título del bloque es el nombre del propio plugin, leído en tiempo de
    // ejecución: por eso aquí no hay texto para él.
    'panel' => 'Este panel',
    'offline' => 'no responde',
    'maintenance' => 'mantenimiento',
    'cpu' => 'CPU',
    'memory' => 'Memoria',
    'disk' => 'Disco',
    'load' => 'Carga',
];
