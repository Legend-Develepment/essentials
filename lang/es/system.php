<?php

/*
 * Español. Escrito a mano.
 *
 * «Swap», «Load average», «Wings» y «Uptime» se quedan en inglés: son los
 * nombres con los que se encuentran en el host y en la propia interfaz de
 * Pelican.
 */

return [
    'title' => 'Estado del sistema',
    'nav_label' => 'Estado del sistema',
    'subheading' => 'La máquina en la que se ejecuta el propio panel, lo que tiene en marcha, y al lado cada nodo que hayas pedido.',

    'options' => 'Opciones',
    'enabled' => 'Mostrar en la barra lateral',
    'enabled_helper' => 'Desactivado quita la entrada de la barra lateral. La página conserva su propia dirección, así que siempre está ahí para volver a activarla.',

    'refresh' => 'Volver a leer cada',
    'refresh_helper' => 'La página entera se vuelve a pedir con este intervalo. Desactivado la deja como estaba al abrirla.',
    'refresh_off' => 'Solo cuando la abro',
    'refresh_seconds' => ':seconds segundos',

    'blocks' => 'Mostrar',
    'blocks_helper' => 'Marcado quiere decir visible. «Disco» es una tarjeta por sistema de archivos, así que una partición raíz llena no se esconde detrás de un montaje de datos medio vacío.',
    'block_cpu' => 'Procesador',
    'block_memory' => 'Memoria',
    'block_swap' => 'Swap',
    'block_disk' => 'Disco',
    'block_load' => 'Load average',
    'block_uptime' => 'Uptime',
    'block_system' => 'Sistema',
    'block_version' => 'Versión del panel',
    // No se muestra nunca - una tarjeta de nodo lleva el nombre del propio nodo
    // - pero blank() lo pide, y una clave que falta e imprime su propio nombre
    // es un mal recurso.
    'block_node' => 'Nodo',

    'nodes' => 'Nodos que mostrar',
    'nodes_helper' => 'Una tarjeta cada uno, junto al host del panel. Nada marcado no muestra ninguno — el panel de control ya tiene un bloque con todos los nodos. A cada uno se le pregunta a su propio daemon, así que un intervalo corto y una lista larga son muchas peticiones.',

    'section_usage' => 'Uso',
    'section_host' => 'Este panel',
    'section_nodes' => 'Nodos',

    'disk_panel' => 'Aquí vive el panel',
    'wings' => 'Wings :version',
    'version_installed' => 'Instalada',
    'version_latest' => 'Última',
    'version_current' => 'Al día',
    'version_update' => 'Actualización disponible',
    'version_unknown' => 'No se pudo comprobar',

    /*
     * Lo que ofrece una tarjeta que va por detrás.
     *
     * Un enlace a la publicación en vez de un botón que actualice, porque desde
     * aquí no hay nada que actualizar: Pelican no tiene comando de
     * actualización, y Wings no tiene un endpoint que reemplace su propio
     * binario. La indicación dice dónde ocurre el trabajo de verdad, para que
     * nadie busque un botón que nunca fue posible.
     */
    'version_release' => 'Qué hay de nuevo',
    'version_how_panel' => 'Abre las notas de versión. El panel se actualiza en la máquina en la que se ejecuta - el panel no puede reemplazar sus propios archivos, y ningún plugin puede ejecutar comandos de shell.',
    'version_how_wings' => 'Abre las notas de versión. Wings se actualiza en el nodo mismo - el panel no tiene ningún canal hacia un programa que se ejecuta en otra máquina.',

    'wings_latest' => 'Última :version',
    'load_cores' => ':percent % de :cores procesadores',
    'load_windows' => ':five en 5 min · :fifteen en 15 min',
    'uptime_since' => 'Desde :date',
    'unavailable' => 'No disponible en este host',

    'fact_os' => 'Sistema operativo',
    'fact_hostname' => 'Nombre de host',
    'fact_php' => 'PHP',
    'fact_cores' => 'Procesadores',
    'fact_processes' => 'Procesos',
];
