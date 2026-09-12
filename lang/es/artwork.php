<?php

/*
 * Español. Escrito a mano.
 *
 * «Steam App ID», «IGDB», «Twitch client ID» y «client secret» se quedan en
 * inglés: son exactamente las palabras que aparecen en las páginas de las que
 * salen esos valores.
 */

return [
    'title' => 'Imágenes de los eggs',
    'nav_label' => 'Imágenes de los eggs',
    'subheading' => 'Imágenes de juego para tus eggs, traídas de Steam y de IGDB. Un egg sin imagen muestra el pájaro de Pelican en cada tarjeta de servidor que lo use.',

    // ---- la tabla ---------------------------------------------------------
    'column_name' => 'Egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'Bloqueada',

    'locked' => 'Bloqueada',
    'unlocked' => 'Libre',

    // ---- qué puedes hacer con una fila ------------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'El número de la dirección de un juego en Steam - store.steampowered.com/app/892970 es 892970. Traerla por identificador bloquea la imagen, porque teclear un número es una decisión y una pasada masiva posterior no debe deshacerla.',

    'fetch_igdb' => 'IGDB',
    'search_term' => 'Buscar',
    'search_term_helper' => 'El nombre del egg viene puesto, pero rara vez es como se llama el juego - «Paper 1.20.4» es Minecraft. Escribe el juego.',

    'lock' => 'Bloquear',
    'unlock' => 'Desbloquear',
    'locked_done' => 'Bloqueada - una pasada masiva dejará esta en paz',
    'unlocked_done' => 'Desbloqueada - una pasada masiva puede reemplazar esta imagen',

    'clear' => 'Borrar',
    'clear_confirm' => 'Quita la imagen y el Steam App ID. El egg vuelve al pájaro de Pelican, y la siguiente pasada masiva lo intentará de nuevo.',
    'cleared' => 'Imagen quitada',

    // ---- resultados -------------------------------------------------------
    'fetched' => 'Imagen guardada',
    'failed' => 'No se guardó ninguna imagen',

    /*
     * Un motivo para cada uno, porque son problemas distintos.
     *
     * Una descarga que falló por una errata y otra que falló porque el disco
     * está lleno no deberían decir las dos «falló» - la primera se arregla
     * mirando el número, la segunda mirando el servidor.
     */
    'why_bad_id' => 'Eso no es un Steam App ID.',
    'why_not_found' => 'Steam no tiene nada en esa dirección. Comprueba el App ID - un juego sin página de tienda tampoco tiene imagen de cabecera.',
    'why_no_match' => 'No se encontró nada con ese nombre. Prueba con el nombre real del juego en vez de con el del egg.',
    'why_no_name' => 'No hay nada que buscar.',
    'why_no_token' => 'Twitch no emitió ningún token. Comprueba el client ID y el secret en «Credenciales».',
    'why_not_configured' => 'IGDB necesita un Twitch client ID y un secret. Ponlos en «Credenciales».',
    'why_empty' => 'La respuesta estaba vacía.',
    'why_large' => 'Esa imagen es mucho más grande que un icono y no se guardó.',
    'why_not_an_image' => 'Lo que llegó no es una imagen. Eso suele querer decir que una página de error respondió con un código de éxito.',
    'why_wrong_format' => 'Esa imagen está en un formato que este panel no almacena. Pelican conserva PNG, JPEG y WebP.',
    'why_unwritable' => 'La imagen no se pudo escribir. Comprueba que storage/app/public pertenece al usuario con el que se ejecuta el panel, y que se ha ejecutado php artisan storage:link.',
    'why_unknown' => 'No funcionó, y el motivo no es uno al que esto sepa poner nombre.',

    // ---- todo de golpe ----------------------------------------------------
    'bulk' => 'Traer todas las que faltan',
    'bulk_confirm_steam' => 'Busca en Steam por nombre para cada egg que no tenga imagen y no esté bloqueado. Los eggs bloqueados y los que ya tienen imagen se dejan en paz. Esto se ejecuta en segundo plano - se te avisará al terminar.',
    'bulk_confirm_both' => 'Busca en Steam por nombre para cada egg que no tenga imagen y no esté bloqueado, y después prueba con IGDB lo que Steam no haya encontrado. Los eggs bloqueados y los que ya tienen imagen se dejan en paz. Esto se ejecuta en segundo plano - se te avisará al terminar.',

    'bulk_started' => 'Descargando en segundo plano',
    'bulk_started_body' => 'En un panel grande esto puede tardar varios minutos. Recibirás una notificación cuando termine, y puedes salir de esta página.',

    'bulk_done' => 'Imágenes de los eggs terminadas',
    'bulk_done_body' => ':fetched traídas, :skipped dejadas en paz, :failed sin encontrar nada. Un egg se deja en paz si está bloqueado o si ya tiene imagen.',

    'bulk_failed' => 'La pasada masiva no se ejecutó',
    'bulk_failed_queue' => 'No se pudo entregar a la cola. Esto necesita un queue worker - comprueba que pelican-queue está en marcha.',

    // ---- credenciales de IGDB ---------------------------------------------
    'credentials' => 'Credenciales',
    'credentials_helper' => 'Steam funciona sin nada de esto. Estos datos son solo para IGDB, que cubre los juegos de los que Steam no ha oído hablar nunca - Minecraft y todas sus variantes, todo lo que salió en consola, la mayoría de los eggs con mods.',
    'credentials_where' => 'Crea una aplicación en dev.twitch.tv/console, genera un client secret y pega los dos aquí. Es gratis.',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => 'Credenciales guardadas',
    'credentials_failed' => 'No se pudieron guardar las credenciales',
];
