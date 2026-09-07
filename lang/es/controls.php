<?php

/*
 * Español. Escrito a mano.
 *
 * La barra de controles de la página de un servidor. Un archivo propio y no un
 * rincón de settings.php, porque esto lo lee quien usa el panel, no quien
 * configura el tema.
 *
 * El estado que aparece junto a los botones es la palabra del propio Pelican,
 * tomada del enum ContainerStatus, de modo que la barra y la página de consola
 * nunca se contradicen sobre lo que está haciendo un servidor.
 *
 * "Kill" se queda en inglés: así se llama el botón de Pelican y así se llama el
 * comando, y no es lo mismo que detener.
 */

return [
    'console' => 'Consola',
    'full_page' => 'Ventana nueva',
    'close' => 'Cerrar',

    'start' => 'Iniciar',
    'restart' => 'Reiniciar',
    'stop' => 'Detener',
    'kill' => 'Kill',

    'kill_confirm' => 'Kill detiene el contenedor de inmediato. Todo lo que el servidor aún no haya escrito en el disco se pierde. ¿Continuar?',

    'sent_title' => 'Acción de encendido',
    'sent_body' => ':action se envió a :name.',
    'failed' => 'No se pudo contactar con el nodo.',
];
