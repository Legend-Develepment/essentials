<?php

/*
 * Español. Escrito a mano.
 *
 * «Mod», «plugin», «loader», «jar» y los nombres de carpeta mods/ y plugins/ se
 * quedan como están: son las palabras que aparecen en Modrinth, en el gestor de
 * archivos y en cualquier guía que se encuentre sobre esto.
 */

return [
    'nav_label' => 'Mods y plugins',
    'title' => 'Mods y plugins',
    'subheading' => 'De uno en uno, desde Modrinth, a este servidor.',

    'section' => 'Buscar algo',
    'section_helper' => 'La página de modpacks instala un pack entero de golpe. Esto instala un solo mod o plugin, que es lo que se quiere mucho más a menudo.',

    'kind' => 'Qué estás añadiendo',
    /*
     * Preguntado y no deducido. Un egg se llama como lo haya llamado un
     * administrador, y varios loaders leen las dos carpetas, así que desde aquí
     * no hay forma honesta de adivinarlo - y adivinar mal escribe una jar en
     * una carpeta que no lee nadie.
     */
    'kind_helper' => 'Un mod va a mods/ y es para Fabric, Forge o NeoForge. Un plugin va a plugins/ y es para Bukkit, Spigot o Paper. Esto también decide en qué mitad de Modrinth se busca.',
    'kind_mod' => 'Un mod (mods/)',
    'kind_plugin' => 'Un plugin (plugins/)',

    'search' => 'Buscar',
    'search_helper' => 'Escribe un nombre y haz clic fuera del campo. Los resultados salen por descargas, de más a menos.',

    'project' => 'Mod o plugin',
    'version' => 'Versión',
    'version_helper' => 'Cada línea trae el número de versión, las versiones de Minecraft para las que está compilada y los loaders que admite. Elige una que encaje con tu servidor — aquí nadie lo comprueba por ti.',

    'install' => 'Instalar',
    'install_confirm' => 'El archivo lo descarga el nodo directamente de Modrinth y lo deja en la carpeta. No se quita nada de lo que ya haya.',
    'installed' => 'Instalado',
    'installed_helper' => 'Se carga la próxima vez que arranque el servidor.',

    'change' => 'Cambiar de versión',
    'change_helper' => 'Pone otra versión del mismo proyecto en lugar de este archivo. La nueva se descarga antes de borrar la vieja, así que una descarga fallida te deja con lo que ya tenías.',
    'change_project_helper' => 'Fijo para todo lo instalado desde esta página. Cambiarlo no sería un cambio de versión — sería otro mod con el mismo nombre de archivo.',
    'change_lookup_helper' => 'Este archivo ya estaba en la carpeta, así que aquí nadie sabe qué es. Búscalo una vez y quedará recordado.',
    'changed' => 'Versión cambiada',

    'check' => 'Buscar actualizaciones',
    'checked' => 'Comprobado',
    'checked_none' => 'Todo lo conocido está en su versión más nueva.',
    'checked_some' => ':count tienen una versión más nueva. Están marcados en la lista.',
    'update_ready' => 'v:number disponible',
    /*
     * Dicho junto a la insignia y no en un mensaje emergente, porque cambia lo
     * que significa la insignia: aquí nadie sabe qué versión de Minecraft ni
     * qué loader ejecuta el servidor.
     */
    'check_note' => 'Más nuevo quiere decir más nuevo en Modrinth. Aquí nadie sabe qué versión de Minecraft ni qué loader ejecuta tu servidor, así que comprueba que la versión que elijas dice encajar antes de arrancar el servidor.',
    'unknown' => 'No instalado desde aquí — usa «Cambiar de versión» para decir qué es',

    'remove' => 'Quitar',
    'remove_confirm' => 'El archivo se borra del servidor. Esto no se puede deshacer desde aquí.',
    'removed' => 'Quitado',

    'running' => 'El servidor está en marcha',
    'running_helper' => 'Minecraft lee mods/ y plugins/ una sola vez, al arrancar. Un archivo añadido ahora no se cargaría hasta reiniciar, y uno retirado por debajo de un juego en marcha puede llevarse el juego por delante. Detén primero el servidor.',

    'failed' => 'Eso no funcionó',
    'failed_version' => 'Esa versión no tiene ninguna jar que esto pueda instalar. Algunas publicaciones solo traen el código fuente, o solo una compilación de cliente.',
    'failed_write' => 'El nodo rechazó la descarga. Puede que no haya podido llegar a Modrinth.',

    'installed_title' => 'Instalados',
    'installed_mods' => 'En mods/',
    'installed_plugins' => 'En plugins/',
    /*
     * Dicho porque una lista vacía es ambigua: normalmente significa que este
     * servidor no usa esa carpeta en absoluto, y no que falte algo.
     */
    'installed_empty' => 'Aquí no hay nada. Un servidor solo usa una de estas dos carpetas, así que que una esté vacía es normal.',
    'installed_note' => 'Solo se listan los archivos .jar. Las carpetas de configuración y los archivos desactivados se dejan en paz y no se muestran.',
];
