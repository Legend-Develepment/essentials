<?php

/*
 * Español. Escrito a mano.
 *
 * «Egg» se queda en inglés: es la palabra que usa Pelican en toda su interfaz,
 * y un ajuste con un nombre distinto al de la pantalla de la que viene es un
 * ajuste que hay que buscar dos veces.
 */

return [
    'title' => 'Duplicar un servidor',
    'nav_label' => 'Duplicar servidor',
    'subheading' => 'Otro servidor montado exactamente igual que uno que ya tienes, o varios a la vez.',

    'section' => 'Qué se copia',
    'section_helper' => 'Se copian el propietario, el egg, el comando de arranque, los límites y todas las variables. Los archivos, las bases de datos, las copias de seguridad y las tareas programadas no — copiar los archivos de un servidor en marcha es copiar su estado, que rara vez es lo que quiere decir «otro como este».',

    'source' => 'Copiar desde',
    'source_helper' => 'Las copias aterrizan en el mismo nodo que este servidor, porque ahí están sus direcciones libres.',

    'name' => 'Nombre de la copia',
    'name_helper' => 'Hacer más de una las numera: «Bot 1», «Bot 2», y así.',

    'copies' => 'Cuántas',
    'copies_helper' => 'Elige primero un servidor.',
    'room' => ':count direcciones libres en :node, así que eso es lo máximo que puede hacerse ahora mismo.',
    'no_room' => 'No queda ninguna dirección libre en :node. Una copia necesita la suya, así que añade primero una asignación a ese nodo.',

    /*
     * Contadas y no enumeradas para los aciertos, y enumeradas para los fallos,
     * que es el sentido que ayuda: diez nombres que funcionaron son un muro de
     * texto que nadie lee, y el que no funcionó es lo único que merece leerse.
     */
    'made' => ':count copias creadas',
    'partly_failed' => 'No se pudieron crear :count copias',
    'failed' => 'No se copió nada',
];
