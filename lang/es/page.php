<?php

/*
 * Español. Escrito a mano.
 *
 * «Queue worker», «scheduler», «cron», «canal» y las rutas como storage/app se
 * quedan como están: son los nombres con los que se encuentran en el servidor y
 * en la documentación de Pelican, y es justo lo que hace falta cuando aparece
 * uno de estos mensajes.
 */

return [
    'title' => 'Ajustes de Essentials',
    'nav_label' => 'Ajustes de Essentials',
    'save' => 'Guardar',
    'saved' => 'Ajustes guardados',
    'save_failed' => 'No se pudieron guardar los ajustes',
    'secret_kept' => 'Guardado. Déjalo vacío para conservarlo o escribe uno nuevo para cambiarlo.',
    'update_background' => 'Se ejecuta en segundo plano y tarda un minuto o dos.',

    /*
     * El queue worker y el scheduler, de los que depende cada tarea en segundo
     * plano y cada tarea programada. Dicho por separado porque fallan por
     * separado y cada uno se arregla de otra manera.
     */
    'worker_missing' => 'No respondió ningún queue worker. Las instalaciones de modpacks, los correos y otras tareas en segundo plano se encolan y las ejecuta un proceso worker, así que hasta que haya uno en marcha quedan anotadas y no se ejecutan nunca, sin ningún error en ninguna parte. O no hay worker, o hay uno que se arrancó antes de instalar este plugin y no puede cargar su código - las dos cosas se arreglan reiniciándolo en el host del panel. Configura su servicio para que se reinicie solo, o esto volverá después de cada actualización.',
    'cron_missing' => 'El scheduler del panel lleva :for minutos sin ejecutarse. Las renovaciones y las comprobaciones del watchdog dependen de él. La línea de cron está en la documentación de Pelican.',

    /*
     * Nombrado por la causa y no por el síntoma, porque el síntoma es «no ha
     * pasado nada» y eso es lo que hacía difícil situarlo: los anuncios, los
     * enlaces de navegación, los estilos guardados y las disposiciones de
     * páginas son todos archivos bajo storage/app, y un directorio en el que el
     * panel no puede escribir los pierde todos sin decir palabra.
     */
    'storage_failed' => 'El panel no pudo escribir en su directorio storage, así que esto no se guardó. Comprueba que storage/app pertenece al usuario con el que se ejecuta el panel. El motivo está en storage/logs.',
];
