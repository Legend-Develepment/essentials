<?php

/*
 * Español. Escrito a mano.
 *
 * «Modpack», «loader», «egg», «daemon», «mods» y «config» se quedan en inglés:
 * son las palabras que aparecen en Modrinth, en el gestor de archivos y en
 * cualquier guía que se encuentre sobre esto.
 */

return [
    'nav_label' => 'Modpacks',
    'title' => 'Modpacks',
    'subheading' => 'Instalar un modpack de Modrinth en este servidor.',

    'section' => 'Buscar un pack',
    'section_helper' => 'Solo Modrinth, y solo packs para servidor. No pide cuenta ni clave de API, y por eso es la única fuente aquí - las demás quieren una clave pegada en algún sitio antes de que aparezca nada.',

    'search' => 'Buscar',
    'search_helper' => 'Déjalo vacío para los más descargados. Buscar consulta a Modrinth, así que ocurre al salir del campo y no mientras escribes.',

    'pack' => 'Pack',
    'pack_helper' => 'Solo se listan los packs que dicen funcionar en un servidor.',

    'version' => 'Versión',
    'version_helper' => 'La versión del juego y el loader se muestran junto a cada una. Elige el loader que ya ejecuta el egg de este servidor - esto instala archivos y no cambia tu egg ni tu comando de arranque.',

    'downloads' => 'descargas',

    'install' => 'Instalar este pack',
    'install_go' => 'Instalarlo',
    'install_confirm' => 'Los archivos del pack se añaden a este servidor. **No se borra nada** - ni tu mundo, ni tus mods antiguos, ni una config. Un pack instalado encima de otro deja los dos, así que quita tú primero los mods del pack anterior si es lo que quieres. El servidor tiene que estar detenido, y sigue detenido.',

    'started' => 'Instalando',
    'started_helper' => 'El pack se está descargando y descomprimiendo. Unos cientos de archivos tardan unos minutos, y recibes una notificación al terminar - sigue aunque salgas de esta página.',

    'running' => 'El servidor está en marcha',
    'running_helper' => 'Minecraft carga sus mods al arrancar, así que un pack instalado ahora dejaría un servidor que no es ni el pack viejo ni el nuevo hasta que se reinicie. Detenlo y vuelve a intentarlo.',

    'done' => ':pack instalado',
    'done_body' => ':files archivos descargados y :overrides elementos de la carpeta propia del pack colocados. Arranca el servidor cuando quieras.',
    'done_refused' => 'Se omitieron :count archivos porque el pack los pedía desde un sitio del que aquí no se descarga.',

    'failed' => 'El pack no se instaló',
    'failed_fetch' => 'No se pudo descargar o descomprimir el pack. Puede que el daemon no sea alcanzable, o que el servidor se haya quedado sin disco.',
    'failed_index' => 'El pack se descargó pero no traía ningún índice legible, así que no había nada que instalar.',
    'failed_version' => 'Esa versión ya no tiene archivo de pack que descargar. Elige otra.',
    'failed_queue' => 'La instalación no se pudo encolar. Esto necesita un queue worker en marcha en el panel.',
];
