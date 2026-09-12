<?php

/*
 * Español. Escrito a mano.
 *
 * Los ajustes de mundo de Palworld, en una página en vez de en un archivo.
 *
 * Aquí no se nombra ningún ajuste. Cada etiqueta de esa página se deduce de la
 * clave que contiene el archivo del propio servidor - véase
 * Support\Palworld\Palworld::label() para entender por qué una lista de nombres
 * sería peor que ninguna.
 */

return [
    'title' => 'Ajustes de Palworld',
    'nav_label' => 'Palworld',
    'subheading' => 'Los ajustes de mundo del PalWorldSettings.ini de este servidor, leídos al abrir esta página. Solo se pueden editar con el servidor detenido.',

    'reload' => 'Leer el archivo otra vez',

    'save_confirm' => 'El archivo se reescribe con estos valores. Cada ajuste que esta página no mostró se reescribe exactamente como estaba, y todo lo demás del archivo también.',
    'saved' => 'Ajustes guardados',
    'saved_body' => 'Surten efecto la próxima vez que arranque el servidor.',
    'save_failed' => 'No se pudo escribir el archivo',

    'running' => 'El servidor está en marcha',
    'running_body' => 'Palworld guarda estos ajustes en memoria y reescribe el archivo al detenerse, así que un cambio guardado ahora se desharía sin decir nada. Detén primero el servidor.',

    'groups' => [
        'server' => 'Servidor y conexión',
        'world' => 'Mundo y tasas',
        'pals' => 'Pals',
        'players' => 'Jugadores',
        'building' => 'Construcción, objetos y recolección',
        'guild' => 'Gremios',
        'other' => 'Otros',
    ],
];
