<?php

/*
 * Español. Escrito a mano.
 *
 * «Cron» se queda en inglés: así se llama en el host y en la documentación de
 * Pelican, y es justo lo que hace falta saber cuando esta página dice que no
 * está en marcha.
 */

return [
    'nav_label' => 'Tareas programadas',
    'title' => 'Qué tarea programada se ha parado',
    'subheading' => 'Todas las tareas programadas del panel, las peores primero - atascadas más de :hours horas, atrasadas, o que nunca se han ejecutado.',

    'how' => 'Pelican muestra las tareas programadas dentro de cada servidor, y su propio estado tiene tres palabras para ellas: inactiva, procesando, activa. Ninguna dice «esta se ha parado». Una ejecución que se cayó a medias se queda en «procesando» para siempre y se dibuja igual que una que está corriendo ahora; una tarea cuya hora pasó hace horas porque el cron murió sigue llamándose activa. Esta página hace la otra pregunta. Solo lectura - todo lo que edita, ejecuta o borra una tarea se queda en la página de Pelican para ese servidor.',

    'column_state' => 'Estado',
    'column_name' => 'Tarea',
    'column_server' => 'Servidor',
    'column_last' => 'Última ejecución',
    'column_next' => 'Próxima ejecución',

    /*
     * Los cinco veredictos. Escritos como lo que es cierto y no como una
     * instrucción, porque tres de ellos son cosas que mirar y dos no.
     */
    'state_stuck' => 'Atascada',
    'state_overdue' => 'Atrasada',
    'state_never' => 'Nunca ejecutada',
    'state_healthy' => 'Bien',
    'state_off' => 'Inactiva',

    'filter_stuck' => 'Atascadas',
    'filter_overdue' => 'Atrasadas',
    'filter_never' => 'Nunca ejecutadas',
    'filter_off' => 'Desactivadas',

    'open' => 'Abrir en el servidor',

    'empty' => 'No hay tareas programadas en ningún servidor que puedas alcanzar - o ninguna parada, si tienes un filtro puesto.',
];
