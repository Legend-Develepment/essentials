<?php

/*
 * Español. Escrito a mano.
 *
 * La página de estado pública.
 *
 * Lo único que este plugin sirve a alguien que no ha iniciado sesión, y la
 * única página cuyas palabras hay que leer pensando que las verá un
 * desconocido - porque las verá. Aquí nada dice qué nodo, qué propietario ni
 * qué dirección; un nombre, si está en marcha, y cuánta gente hay dentro.
 *
 * «Nodo» solo aparece en los ajustes; en la página pública es «máquina», porque
 * allí lee alguien que nunca ha oído hablar de Pelican.
 */

return [
    // ---- la página de ajustes ---------------------------------------------
    'title' => 'Página de estado pública',
    'nav_label' => 'Página de estado',
    'subheading' => 'Una página que cualquiera puede abrir, sin cuenta, mostrando cuáles de tus servidores están en marcha. No aparece nada en ella hasta que nombres un servidor abajo.',

    'address' => 'Tu página de estado está en',
    'address_off' => 'Todavía no se sirve nada. Añade abajo un servidor, una máquina o un servicio y guarda, y aquí aparecerá la dirección.',

    'which' => 'Qué se publica',
    'which_helper' => 'La lista empieza vacía y nada es público mientras no haya algo dentro. Solo se ofrecen los servidores que ya puedes abrir.',
    'add' => 'Publicar un servidor',
    'server' => 'Servidor',
    'shown_as' => 'Se muestra como',
    'shown_as_helper' => 'Lo que ve el público. Escríbelo en vez de dejar que el panel use el nombre real - «mc-prod-3 (no tocar)» es una nota para ti, no algo que poner en un foro.',

    'look' => 'Redacción',
    'look_helper' => 'Todo lo que hay en esta página lo lee gente que no tiene cuenta.',
    'heading' => 'Título',
    'heading_helper' => 'Si se deja vacío, se usa el nombre del propio panel.',
    'note' => 'Una línea encima de la lista',
    'note_helper' => 'Para decir qué pasa - una ventana de mantenimiento, o dónde preguntar. Texto sin formato.',
    'link' => 'Enlace al panel',
    'link_helper' => 'Una vuelta hacia dentro, al pie de la página. Desactívalo si prefieres no anunciar dónde está tu panel.',

    'save' => 'Guardar',
    'saved' => 'Guardado',
    'save_failed' => 'No se guardó nada',
    'open' => 'Abrir la página',

    // ---- número de jugadores ----------------------------------------------
    'counts' => 'Número de jugadores',
    'counts_helper' => 'De dónde salen los números que hay junto a un servidor. Los servidores de Minecraft responden a su propio handshake y se configuran en Minecraft; todo lo de abajo es para los juegos que responden a la consulta de Valve - Rust, ARK, Valheim, 7 Days to Die y casi todo lo demás que corre sobre Source o Unreal.',
    'query_eggs' => 'Eggs que responden a la consulta de Valve',
    'query_eggs_helper' => 'Marca los eggs de esos juegos. Esta misma lista decide además qué servidores tienen página de Jugadores dentro del panel - una pregunta hecha por dos motivos. No se pregunta nada hasta que tú lo digas: esto es lo único de aquí que abre una conexión del panel directamente a un puerto de juego, así que es una decisión y no algo que empieza a pasar solo. Un servidor cuyo puerto no sea alcanzable desde el panel sencillamente no muestra número.',

    // ---- los nodos --------------------------------------------------------
    'nodes' => 'Máquinas',
    'nodes_helper' => 'En marcha o parada, y nada más. Ni la carga ni lo lleno que esté el disco - quien pregunta si puede jugar no necesita un informe de capacidad de tu hardware, y publicar uno es dibujar el mapa de dónde aprieta.',
    'add_node' => 'Publicar una máquina',
    'node' => 'Máquina',
    'node_shown_as_helper' => 'Escríbelo. Un nodo suele llamarse algo como hetzner-fsn1-01, y eso es una frase entera sobre dónde están tus máquinas.',

    // ---- los monitores HTTP -----------------------------------------------
    'monitors' => 'Otros servicios',
    'monitors_helper' => 'Cualquier otra cosa de la que merezca la pena saber que está en marcha: tu web, una API, el endpoint de salud de un bot. El panel pregunta a cada uno con el mismo ritmo que a los servidores. Solo administradores - un monitor hace que este panel descargue una dirección, y dejar que cualquiera añada uno lo convierte en una sonda que se puede apuntar a donde se quiera.',
    'add_monitor' => 'Añadir un servicio',
    'monitor_name' => 'Nombre',
    'monitor_url' => 'Dirección',
    'monitor_url_helper' => 'Solo https. Que este panel pidiera http en claro cada pocos minutos le diría a cualquiera que esté en el camino cuáles de tus servicios existen.',
    'monitor_expect' => 'Se espera',
    'monitor_expect_helper' => 'Déjalo vacío para «cualquier respuesta», que es lo correcto para un sitio que redirige o que responde 403 a una petición pelada. Un número es para un endpoint escrito para decir exactamente eso y nada más - puesto demasiado estricto, la fila se queda roja para siempre en un servicio que está perfecto.',

    // ---- páginas para los usuarios ----------------------------------------
    'users' => 'Páginas para tus usuarios',
    'users_helper' => 'Si la gente con servidores en este panel puede publicar una página de estado propia.',
    'user_pages' => 'Dejar que los usuarios hagan la suya',
    'user_pages_helper' => 'Cada uno recibe una dirección propia en /status/su-identificador, con solo los servidores que posee, con los nombres que escriba. Ninguna máquina y ningún otro servicio en ellas - las dos cosas son solo tuyas. Con esto activado, lo encontrarán en «Página de estado» dentro del menú de su cuenta, en el panel en el que estén.',

    // ---- el aspecto -------------------------------------------------------
    'every' => 'Comprobar cada',
    'every_helper' => 'Cada cuánto se reconstruye la página, y cada cuánto se refresca sola en el navegador. Una página que la gente mira durante un reinicio quiere segundos; una enlazada desde un foro que nadie tiene abierta quiere una hora, y preguntar a cada nodo cada minuto por ella es trabajo hecho para nadie.',
    'every_realtime' => 'Tiempo real (10 segundos)',
    'every_30s' => '30 segundos',
    'every_1m' => '1 minuto',
    'every_5m' => '5 minutos',
    'every_10m' => '10 minutos',
    'every_30m' => '30 minutos',
    'every_60m' => '60 minutos',

    'style' => 'Estilo',
    'style_helper' => 'Uno de los aspectos del propio panel, aplicado a esta página: su color, los grises construidos a partir de su superficie, y lo redondeadas que son las esquinas. «Seguir al panel» significa el que esté puesto hoy, incluido cualquier cambio posterior.',
    'style_mine_helper' => 'Los estilos que ofrece este panel, aplicados a tu página: un color, los grises construidos a partir de él, y lo redondeadas que son las esquinas. Qué estilos hay en esta lista lo decide el dueño del panel - la misma lista de la que puedes elegir en Apariencia. «Seguir al panel» significa el que esté puesto.',
    'style_panel' => 'Seguir al panel',

    // ---- la página de alguien ---------------------------------------------
    'mine_title' => 'Mi página de estado',
    'mine_nav_label' => 'Página de estado',
    'mine_subheading' => 'Una dirección que dar a la gente que juega en tus servidores. Muestra los servidores que elijas y nada más de este panel.',
    'mine_address' => 'Tu dirección',
    'mine_address_helper' => 'Elige algo corto. Cambiarla más adelante rompe cualquier enlace que alguien ya haya guardado.',
    'mine_address_off' => 'Elige abajo una dirección y guarda, y tu página aparecerá aquí.',
    'slug' => 'Dirección',
    'slug_helper' => 'Minúsculas, números y guiones. Tres caracteres o más.',
    'mine_heading' => 'Título',
    'mine_heading_helper' => 'Si se deja vacío, se usa tu dirección.',
    'mine_note_helper' => 'Para decir qué pasa - un reinicio, un evento, dónde encontrarte. Texto sin formato, y lo lee cualquiera que tenga el enlace.',
    'mine_which' => 'Tus servidores',
    'mine_which_helper' => 'Solo se ofrecen los servidores que son tuyos. Ser subuser en otro sitio es acceso a una máquina, no permiso para publicar que existe.',
    'mine_shown_as_helper' => 'Lo que ven los visitantes. Escríbelo en vez de usar el nombre del panel si ese nombre es una nota para ti.',
    'mine_look_helper' => 'El aspecto de tu página para la gente a la que se la envías.',
    'mine_remove' => 'Retirar mi página',
    'mine_remove_confirm' => 'Retira tu página y libera la dirección para otra persona. Todo lo que hayas configurado se pierde; los servidores en sí no se tocan.',
    'mine_removed' => 'Tu página se ha retirado',

    'why_slug' => 'Esa dirección no vale. Minúsculas, números y guiones, tres caracteres o más - y unas cuantas palabras están reservadas.',
    'why_taken' => 'Esa dirección ya la tiene otra persona.',
    'why_unwritable' => 'No se pudo escribir. Comprueba que storage/app pertenece al usuario con el que se ejecuta el panel.',

    // ---- los títulos de la propia página ----------------------------------
    'section_servers' => 'Servidores',
    'section_nodes' => 'Máquinas',
    'section_monitors' => 'Servicios',

    // ---- la propia página -------------------------------------------------
    'up' => 'En línea',
    'down' => 'Fuera de línea',
    'starting' => 'Arrancando',

    /*
     * No «fuera de línea», y la diferencia importa en público.
     *
     * El panel no pudo llegar al servidor. Eso suele ser un nodo en
     * mantenimiento o un daemon reiniciándose - no es lo mismo que el servidor
     * esté apagado, y decirle a cien jugadores que su servidor se ha caído
     * cuando está en marcha es peor que reconocer que no se sabe.
     */
    'unknown' => 'Desconocido',

    'players' => 'Jugadores',
    'online_now' => 'jugando ahora mismo',
    'checked' => 'Comprobado',
    'next_check' => 'hasta la próxima comprobación',
    'just_now' => 'ahora mismo',
    'seconds_ago' => 'hace :count segundos',
    'panel' => 'Iniciar sesión',

    'all_up' => 'Todo está en marcha.',
    'some_down' => 'Algo no está en marcha.',
    'empty' => 'Aquí todavía no se publica nada.',
];
