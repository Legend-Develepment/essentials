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
    'updating_now' => 'Este panel está instalando una actualización. Alguna página puede verse rara un momento.',
    'updating_done' => 'La actualización está instalada. Si alguna página se veía rara hace un momento, recárgala.',
    'title' => 'Ajustes de Essentials',
    'nav_label' => 'Ajustes de Essentials',
    'save' => 'Guardar',
    'saved' => 'Ajustes guardados',
    'save_failed' => 'No se pudieron guardar los ajustes',
    'update' => 'Actualizar',
    'update_available' => 'Hay una actualización disponible',
    'update_confirm' => 'El panel descarga la versión nueva, reconstruye sus assets y vacía sus cachés. Tus ajustes se conservan.',
    'update_started' => 'Actualización iniciada',
    'update_background' => 'Se ejecuta en segundo plano y tarda un minuto o dos.',
    'update_failed' => 'No se pudo actualizar el tema',
    'update_done' => 'Tema actualizado',
    'check' => 'Buscar actualizaciones',
    'check_failed' => 'No se pudo leer el feed de actualizaciones',
    'check_failed_body' => 'El panel no llegó a él, o no devolvió un JSON válido.',
    'up_to_date' => 'Estás en la última versión',
    'reinstall' => 'Reinstalar',

    'auto_on' => 'Las actualizaciones se instalan solas',

    /*
     * Lo que hizo la última comprobación automática. Cada una de estas líneas
     * nombra la parte que habría que mirar, porque desde un navegador las tres
     * maneras en que esto sale mal se ven igual: un número que va bajando.
     */
    'auto_never' => 'Todavía no se ha hecho ninguna comprobación. Las actualizaciones automáticas necesitan el scheduler del panel - la entrada de cron que ejecuta php artisan schedule:run cada minuto. Sin ella no ocurre nada de lo programado.',
    'auto_ago' => 'Última comprobación :ago',
    'auto_just_now' => 'ahora mismo',
    'auto_minutes' => 'minutos',
    'auto_current' => 'no hay nada más nuevo en este canal.',
    'auto_installed' => 'La v:version se instaló aquí, desde la propia comprobación programada. Lo hace cuando no responde ningún queue worker, así que la actualización ocurre igualmente - pero un panel sin worker es un panel donde tampoco está ocurriendo el resto del trabajo encolado.',
    'auto_queued' => 'Se le pasó la v:version al queue worker. Si la versión de arriba no cambia en unos minutos, el worker está cogiendo trabajos pero fallando en este - reiniciarlo suele arreglarlo, y el motivo está en storage/logs.',
    'auto_unreachable' => 'no se pudo leer el feed de actualizaciones. Se descarga por internet, así que suele ser un problema de red o de DNS en el host del panel.',
    'auto_error' => 'la comprobación falló. El motivo está en storage/logs.',

    /*
     * El queue worker, que es lo que de verdad ejecuta una actualización. Dicho
     * aparte de la comprobación de arriba porque fallan por separado y cada uno
     * se arregla de otra manera.
     */
    'worker_missing' => 'No respondió ningún queue worker. Las actualizaciones, las instalaciones de modpacks y estas comprobaciones se encolan y las ejecuta un proceso worker, así que hasta que haya uno en marcha quedan anotadas y no se ejecutan nunca, sin ningún error en ninguna parte. O no hay worker, o hay uno que se arrancó antes de instalar este plugin y no puede cargar su código - las dos cosas se arreglan reiniciándolo en el host del panel. Configura su servicio para que se reinicie solo, o esto volverá después de cada actualización.',
    'cron_missing' => 'El scheduler del panel lleva :for minutos sin ejecutarse. Las renovaciones, las comprobaciones del watchdog y las actualizaciones automáticas dependen de él. La línea de cron está en la documentación de Pelican.',

    'next_check' => 'Próxima comprobación en',
    'due_now' => 'toca ahora',

    /*
     * Nombrado por la causa y no por el síntoma, porque el síntoma es «no ha
     * pasado nada» y eso es lo que hacía difícil situarlo: los anuncios, los
     * enlaces de navegación, los estilos guardados y las disposiciones de
     * páginas son todos archivos bajo storage/app, y un directorio en el que el
     * panel no puede escribir los pierde todos sin decir palabra.
     */
    'storage_failed' => 'El panel no pudo escribir en su directorio storage, así que esto no se guardó. Comprueba que storage/app pertenece al usuario con el que se ejecuta el panel. El motivo está en storage/logs.',

    /*
     * Dicho después de cada actualización fallida y no solo tras una
     * discrepancia de identificadores. El mensaje de arriba ya nombra la causa;
     * este nombra el único remedio que no se deduce de «esperaba X, obtuve Y».
     */
    'update_renamed' => 'Si esto dice que dos identificadores no coinciden, es que el plugin se ha renombrado, y ninguna actualización cruza eso - Pelican reconoce un plugin instalado por su identificador. Desinstala la entrada antigua en Admin → Plugins e instala este de nuevo. Tus ajustes sobreviven: viven en .env y en storage/app/private/legend-theme, y ninguno de los dos se indexa por el identificador.',
];
