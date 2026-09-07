<?php

/*
 * Español. Escrito a mano.
 *
 * «Nodo» es la palabra que usa Pelican en español para una máquina, y es la que
 * se recoge aquí; en las páginas públicas, donde lee alguien que nunca ha oído
 * hablar de Pelican, es «máquina».
 */

return [
    'nav_label' => 'Capacidad',
    'title' => 'Si cabe otro servidor',
    'subheading' => 'Lo que se ha prometido en cada nodo, frente a lo que puede repartir.',

    'how' => 'Prometido, no consumido. Un nodo puede estar al veinte por ciento de trabajo y completamente lleno, porque «lleno» habla de lo repartido y no de lo que está en marcha — el bloque Máquinas del panel de control responde a la otra pregunta, y se queda donde está. La cuenta que se hace aquí es la del propio Pelican, tomada del método que decide si un servidor puede crearse siquiera: la capacidad por uno más la sobreasignación, frente a la suma de lo prometido a cada servidor del nodo. Una capacidad de cero significa ilimitado, y una sobreasignación por debajo de cero también: de ahí las filas sin porcentaje, en lugar de una barra llena o vacía.',

    'column_node' => 'Máquina',
    'column_fullest' => 'Lo más lleno',
    'column_memory' => 'Memoria',
    'column_disk' => 'Disco',
    'column_cpu' => 'Procesador',
    'column_at_limit' => 'En un límite',

    'servers' => ':count servidores',

    'filter_tight' => 'Casi llenos',

    'open' => 'Abrir la máquina',

    'empty' => 'No hay máquinas que puedas alcanzar.',
];
