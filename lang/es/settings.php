<?php

/*
 * Español. Escrito a mano.
 *
 * «Egg», «nodo», «subuser», «Wings», «queue», «webhook», «topbar», «cron» y los
 * formatos de archivo se quedan como están: son las palabras que se encuentran
 * en el propio Pelican, en el host y en todo lo que se escribe sobre ellos. Los
 * nombres de los estilos tampoco se traducen — un estilo se llama como se
 * llama, y un nombre traducido sería un segundo nombre para lo mismo.
 */

return [
    'css_warning' => 'Guardado, pero este CSS parece incorrecto',
    'css_unclosed' => 'Una regla abierta en la línea :line no se cierra nunca. Todo lo que va después está dentro de esa regla y no se aplicará.',
    'css_extra' => 'Hay una llave de cierre en la línea :line sin nada abierto. Todo lo que va después queda fuera de cualquier regla y se ignorará.',
    'css_comment' => 'Un comentario abierto en la línea :line no se cierra nunca, así que el resto del archivo está dentro de él.',

    'groups' => [
        'appearance' => 'Apariencia',
        'servers' => 'Lista de servidores',
        'windows' => 'Estilos por horario',
        'windows_helper' => 'Un estilo distinto entre dos horas del día. No pasa nada hasta que añades uno. El reloj es el del propio panel, de su ajuste de zona horaria, y no el de cada lector — un panel que se viera distinto para dos personas en el mismo momento parecería roto y no programado. Una franja cambia el aspecto que el panel ya tiene, así que no hace nada mientras el estilo esté en «Ninguno». Un estilo que alguien haya elegido para sí mismo sigue ganando.',
        'minecraft' => 'Minecraft',
        'ark' => 'ARK',
        'valheim' => 'Valheim',
        'languages' => 'Idiomas',
        'servers_helper' => 'Cómo se dibuja una tarjeta de servidor. Que se muestren en cuadrícula o en lista es la elección de cada uno, en Cuenta → Disposición del panel de control.',
        'server_pages' => 'Páginas de servidor',
        'server_pages_helper' => 'Lo que lleva cada página dentro de un servidor, sea la que sea.',
        'console' => 'Página de consola',
        'console_helper' => 'La fuente del terminal, su tamaño y su altura son la elección de cada uno, en Cuenta.',
        'background' => 'Fondo',
        'background_helper' => 'Se aplica a todo el panel, incluida la pantalla de acceso.',
        'icons' => 'Iconos',
        'bars' => 'Medidores de recursos',
        'bars_helper' => 'Las barras de procesador, memoria y disco de las tarjetas de servidor.',
        'updates' => 'Actualizaciones',
        'updates_helper' => 'Qué versiones ofrece la página del tema, y dónde las busca.',
        'brand' => 'Marca',
        'login' => 'Pantalla de acceso',
        'login_helper' => 'Se aplica a las pantallas de acceso, de restablecimiento de contraseña y de doble factor.',
        'advanced' => 'CSS propio',
        'advanced_helper' => 'Para todo lo que los ajustes de arriba no cubren. Se carga después de todo lo demás, así que gana.',
        'areas' => 'Por área',
        'areas_helper' => 'Todo lo de arriba se aplica en todas partes. Aquí puedes apartar un área; lo que dejes vacío sigue el ajuste general.',
        'footer' => 'Pie de la barra lateral',
        'footer_helper' => 'La parte de abajo de la barra lateral, que Pelican deja vacía. Todo esto está apagado hasta que lo rellenes.',
        'features' => 'Lo que añade este plugin',
        'features_helper' => 'Desmarcar una cosa la quita del panel por completo. Sus ajustes se conservan y su página mantiene su dirección, así que no se pierde nada por apagar algo para ver qué hacía. La mayoría tienen además un permiso propio en Roles, para repartir uno sin repartir el resto. No todas: los medidores de recursos, el pie de la barra lateral y la búsqueda de ajustes se dibujan para todo el mundo y no los administra nadie, la estrella de una tarjeta de servidor pertenece a quien la pulsó, y las páginas de Palworld y Minecraft dentro de un servidor van por los permisos de ese servidor y no por uno de estos. El estilo en sí no está en esta lista — tiene su propio interruptor, en Aspecto → Apariencia → Estilo → Ninguno.',
        'identity' => 'Este plugin en la barra lateral',
        'identity_helper' => 'La entrada que este plugin añade a la barra lateral, y la imagen que lleva.',
    ],

    /*
     * Las páginas de ajustes, cada una una entrada del grupo propio del plugin
     * en la barra lateral. Agrupadas por la pregunta que respondes y no por la
     * clase que las implementa.
     */
    'pages' => [
        'look' => 'Aspecto',
        'look_helper' => 'El color, la forma y cómo se llama el panel.',
        'pages' => 'Páginas',
        'pages_helper' => 'La lista de servidores, las páginas de dentro de un servidor, y el terminal.',
        'advanced' => 'Avanzado',
        'advanced_helper' => 'Las dos salidas de emergencia: tu propio CSS, y los ajustes que solo valen para un área.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Qué eggs son Minecraft, y todo lo demás sobre ello.',
        'artwork' => 'Imágenes de los eggs',
        'artwork_helper' => 'Una página con todos los eggs, y una forma de traer la imagen del juego desde Steam o IGDB. Escribe en los eggs mismos — la imagen, y dos etiquetas que anotan de qué juego se trata y si la imagen se eligió a mano — y por eso lleva un permiso propio.',
        'alerts' => 'Avisos',
        'alerts_helper' => 'Una comprobación periódica de las cosas que el panel ya mide pero no le cuenta a nadie: un nodo que deja de responder, un disco que se llena, un queue worker que se ha parado, una versión que se queda atrás. Envía a Discord, al panel o por correo. Permiso propio, porque llega a todos los nodos periódicamente y publica a una dirección que alguien ha escrito.',
        'backups' => 'Resumen de copias',
        'backups_helper' => 'Una página con todos los servidores y el tiempo que llevan sin copia, ordenada para que los que no tienen ninguna queden arriba. Solo lectura — todo lo que actúa sobre una copia se queda en la página de Pelican de ese servidor. Permiso propio, porque la lista es un mapa de dónde están los huecos.',
        'public_status' => 'Página de estado pública',
        'public_status_helper' => 'Una página que cualquiera puede abrir sin cuenta, mostrando cuáles de tus servidores están en marcha y cuánta gente hay en ellos. No se publica nada hasta que nombras un servidor, una máquina o un servicio — las tres listas empiezan vacías, y mientras lo estén la dirección responde 404. Permiso propio, porque decide qué sale del panel.',
        'game_players' => 'Jugadores, otros juegos',
        'capacity' => 'Capacidad',
        'capacity_helper' => 'Lo prometido en cada máquina frente a lo que puede repartir, para ver si cabe otro servidor. La lista de nodos de Pelican muestra un nombre y un número de servidores, y el bloque Máquinas del panel de control muestra lo que está en marcha - esta es la tercera pregunta, y la cuenta es la del propio Pelican. Solo lectura. Permiso propio.',
        'schedules' => 'Tareas programadas',
        'schedules_helper' => 'Todas las tareas programadas del panel con cuáles se han parado: atascadas a mitad de una ejecución, atrasadas porque el cron no está en marcha, o sin ejecutarse nunca. Pelican muestra las tareas dentro de cada servidor y su propio estado no tiene palabra para ninguno de esos casos. Solo lectura. Permiso propio.',
        'activity' => 'Actividad',
        'activity_helper' => 'Todos los eventos que el panel registra, en una lista en vez de un servidor cada vez. Pelican guarda el registro y lo muestra por servidor; esto pregunta al mismo registro del revés. Solo lectura. Permiso propio, porque un registro de quién hizo qué es algo que se entrega a propósito.',
        'access' => 'Acceso a servidores',
        'access_helper' => 'Atar un rol a unos servidores, para que todos los que lo tengan puedan llegar a ellos. Funciona manteniendo al día los subusers del propio Pelican, que es lo que ya leen la lista de servidores y todas las comprobaciones de permisos. Permiso propio, porque es la única página de aquí que da acceso a cosas.',
        'games' => 'Otros juegos',
        'games_helper' => 'Los archivos que ARK y Valheim guardan junto a su mundo, como formularios: los ajustes de mundo de ARK, y las listas de admins, baneados y permitidos de Valheim. Qué servidores los reciben lo dice la lista de eggs de esa página, así que una lista vacía ya es un interruptor por juego.',
        'game_players_helper' => 'Una página dentro de Rust, ARK, Valheim y todo lo que responda a la consulta de Valve, mostrando quién está conectado y cuánto tiempo lleva. Solo lectura — lo que puedes hacerle a alguien cambia según el juego, y eso es una versión aparte. Qué eggs cuentan es la misma lista que usa la página de estado.',
        'languages' => 'Idiomas',
        'languages_helper' => 'En qué idiomas responde este plugin.',
    ],

    'features' => [
        'look' => 'Ajustes de aspecto',
        'look_helper' => 'La entrada de la barra lateral para color, forma y marca.',
        'pages' => 'Ajustes de páginas',
        'pages_helper' => 'La entrada de la barra lateral para la lista de servidores, las páginas de servidor y el terminal.',
        'advanced' => 'Ajustes avanzados',
        'advanced_helper' => 'La entrada de la barra lateral para tu propio CSS y las excepciones por área.',
        'announcements' => 'Anuncios',
        'announcements_helper' => 'La franja de la parte superior del panel.',
        'nav_links' => 'Enlaces de navegación',
        'nav_links_helper' => 'Tus propias entradas en la barra lateral.',
        'login' => 'Pantalla de acceso',
        'login_helper' => 'La imagen, el aviso y los enlaces de la pantalla de acceso.',
        'bars' => 'Medidores de recursos',
        'bars_helper' => 'Las barras recoloreadas de procesador, memoria y disco.',
        'dashboard_status' => 'Línea de versión',
        'dashboard_status_helper' => 'La parte de arriba del bloque del panel de control: qué versión está instalada y si hay otra esperando.',
        'dashboard_nodes' => 'Máquinas',
        'dashboard_nodes_helper' => 'El resto del bloque del panel de control: este panel y cada nodo, con lo que está usando cada uno.',
        'system_status' => 'Página de estado del sistema',
        'system_status_helper' => 'La página de la máquina en la que se ejecuta el propio panel.',
        'sidebar_footer' => 'Pie de la barra lateral',
        'sidebar_footer_helper' => 'Tu línea de texto, la versión del panel y un enlace, al fondo de la barra lateral.',
        'languages' => 'Idiomas',
        'languages_helper' => 'Responder a cada uno en el idioma que tenga puesto su propia cuenta, allí donde este plugin esté traducido. Con esto apagado, todo el mundo recibe inglés.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Una pestaña de Minecraft en la barra lateral, y una página dentro de cada servidor de Minecraft para editar su server.properties como formulario. Qué eggs cuentan lo dices tú.',
        'palworld' => 'Ajustes de Palworld',
        'palworld_helper' => 'Una página dentro de un servidor de Palworld para editar los ajustes de su mundo. No aparece en ningún otro servidor, ni nunca mientras ese servidor está en marcha.',
        'settings_search' => 'Búsqueda de ajustes',
        'settings_search_helper' => 'El campo que hay encima de estos formularios y que los reduce a las secciones que contienen lo que escribes.',
        'preview' => 'Vista previa en vivo',
        'preview_helper' => 'El recuadro junto al formulario de Aspecto que muestra lo que hacen los colores, las esquinas y los espacios antes de guardarlos.',
        'duplicate' => 'Duplicar servidor',
        'duplicate_helper' => 'Una página para montar otro servidor exactamente igual que uno que ya tienes, o varios a la vez. Los archivos no se copian nunca.',
        'favourites' => 'Servidores marcados',
        'favourites_helper' => 'Una estrella en cada tarjeta de servidor. Los marcados van primero, y la lista de cada uno se guarda en el panel — así que sus estrellas le siguen a donde inicie sesión la próxima vez. Cambia lo que ve él y nada para los demás. Estar en el panel sí significa que es un archivo bajo storage, que puede leer cualquiera con acceso a la máquina.',
        'artwork' => 'Imágenes de los eggs',
        'artwork_helper' => 'La página de administración que trae la imagen de cada egg desde Steam o IGDB y la escribe en el egg mismo.',
        'alerts' => 'Avisos',
        'alerts_helper' => 'La comprobación periódica de un nodo que ha dejado de responder, un disco que se llena, un queue worker muerto o una versión que se queda atrás, y el mensaje de Discord, del panel o de correo que envía.',
        'backups' => 'Resumen de copias',
        'backups_helper' => 'La página de administración que lista todos los servidores por el tiempo que llevan sin copia. Solo lectura.',
        'public_status' => 'Página de estado pública',
        'public_status_helper' => 'La página que cualquiera puede abrir sin cuenta. Con esto apagado, la dirección responde 404 haya lo que haya en la lista.',
        'game_players' => 'Jugadores, otros juegos',
        'game_players_helper' => 'Una página dentro de Rust, ARK, Valheim y todo lo que responda a la consulta de Valve, mostrando quién está conectado y cuánto tiempo lleva.',
        'owner_alerts' => 'Avisar a la gente de que su servidor está fuera de línea',
        'owner_alerts_helper' => 'La única parte de este plugin que escribe a gente que no es administradora: una notificación en el panel cuando la máquina de uno de sus servidores deja de responder, y otra cuando vuelve. Apagado hasta que se encienda aquí y en la página de Avisos, en las dos - escribe a tus clientes, así que exige dos decisiones y no una.',
        'my_backups' => 'Aviso de copias en la lista de servidores',
        'my_backups_helper' => 'Una línea encima de la lista de servidores de cada uno cuando alguno de los suyos no se ha respaldado nunca o lleva tiempo sin respaldarse. Las tarjetas de Pelican dicen lo que un servidor está haciendo ahora; nada de ahí dice que no se ha hecho una copia en tres semanas. Solo se dibuja cuando algo va atrasado, y no nombra ningún servidor que esa persona no pudiera abrir ya.',
        'capacity' => 'Resumen de capacidad',
        'capacity_helper' => 'La página de administración que muestra memoria, disco y procesador prometidos frente a disponibles en cada máquina, con los servidores que se han quedado sin copias, sin bases de datos o sin asignaciones. Prometido y no consumido - un nodo puede estar ocupado y vacío, o inactivo y lleno.',
        'schedules' => 'Resumen de tareas programadas',
        'schedules_helper' => 'La página de administración que lista todas las tareas programadas del panel, las peores primero - atascadas, atrasadas, o nunca ejecutadas. Solo lectura; todo lo que edita o ejecuta una se queda en la página de Pelican de ese servidor.',
        'activity' => 'Actividad del panel',
        'activity_helper' => 'La página de administración que lista todos los eventos registrados del panel, el más reciente primero, con quién lo hizo y en qué servidor. Solo lectura - no borra nada, y el ajuste del propio Pelican sigue decidiendo cuánto tiempo se guardan las líneas.',
        'access' => 'Acceso a servidores por rol',
        'access_helper' => 'Una página para atar un rol a unos servidores, mantenida al día en la tabla de subusers del propio Pelican. No concede nada mientras no asignes algo. Apagarlo detiene la reconciliación; el acceso ya concedido se queda, y la página tiene un botón para retirarlo.',
        'scheduled' => 'Estilos por horario',
        'scheduled_helper' => 'La sección de la página de Aspecto para dar al panel un estilo distinto entre dos horas del día. No cambia nada de lo guardado — una franja se pone encima de los ajustes mientras se dibuja la página y se suelta justo después — así que apagarlo devuelve el aspecto propio del panel al instante y no pierde nada.',
        'games' => 'Otros juegos',
        'games_helper' => 'Los ajustes de mundo de ARK, y las listas de admins, baneados y permitidos de Valheim, como formularios en vez de como archivos en el gestor de archivos. Qué servidores los reciben lo dice la lista de eggs de la página Otros juegos.',
        'quick' => 'Menú «Ir a»',
        'quick_helper' => 'Un control en la parte de arriba de cada página para saltar a un servidor o a una página marcada, con un buscador sobre toda tu lista de servidores. También marca la página en la que estás. Lo que alguien encuentra con él es lo que ya podía alcanzar, así que no concede nada - apagarlo quita el atajo y la página de Favoritos con él.',
    ],

    /*
     * El buscador que hay encima de los formularios de ajustes. Filtra lo que ya
     * está en la página dentro del navegador y no le pide nada al servidor, así
     * que no hay estado de «buscando» que describir ni forma de que falle.
     */
    /*
     * El recuadro de vista previa. Todo lo que hay en él es un sustituto y no
     * una muestra de tu panel, y las palabras lo dicen - un recuadro que
     * nombrara un servidor real o una cifra real se leería como tal.
     */
    'preview' => [
        'label' => 'Vista previa',
        'card' => 'Una tarjeta',
        'card_helper' => 'Dibujada con las mismas reglas que el panel, con los ajustes de esta página en vez de con los guardados.',
        'button' => 'Un botón',
        'field' => 'Un campo',
        'meter_ok' => 'Bien',
        'meter_warning' => 'Aviso',
        'meter_danger' => 'Peligro',

        /*
         * La vista previa a página completa. Una pestaña y no un panel, porque
         * Pelican envía X-Frame-Options: DENY y se niega a que lo enmarque
         * nada, ni él mismo - véase Support\FullPreview.
         */
        'full' => 'Ver todo el panel',
        'full_confirm' => 'Abre el panel dibujado con los ajustes de esta página en vez de con los guardados. No se escribe nada — los valores se guardan quince minutos y el panel vuelve a la normalidad cuando sales de la vista previa o guardas.',
        'full_go' => 'Muéstramelo',
        'full_failed' => 'No se pudo iniciar la vista previa',
        'bar' => 'Estás viendo ajustes sin guardar. Nada de esto se ha escrito.',
        'bar_back' => 'Volver a los ajustes',
    ],

    'search' => [
        'placeholder' => 'Buscar en los ajustes',
        'label' => 'Buscar en estos ajustes',
        'none' => 'No hay nada que coincida en esta página. Los ajustes están repartidos en cuatro páginas — prueba en Aspecto, Páginas, Avanzado, o Ajustes de Essentials.',
    ],

    'footer' => [
        'text' => 'Tu propia línea',
        'text_helper' => 'Texto sin formato, 120 caracteres como mucho. Se escapa, igual que la franja de anuncios — esto se dibuja en cada página del panel, lo que lo convierte en el sitio equivocado para aceptar marcado.',
        'version' => 'Mostrar la versión del panel',
        'version_helper' => 'La versión de Pelican, no la de este plugin. El plugin dice la suya en el panel de control; lo que la gente busca al pie de una barra lateral es qué panel está mirando.',
        'link_label' => 'Texto del enlace',
        'link_url' => 'Dirección del enlace',
        'link_url_helper' => 'Una dirección http o https, o una ruta del propio panel como /account. Se abre en una pestaña nueva.',
    ],

    'layout' => [
        'label' => 'Disposición',
        'helper' => 'Cómo está organizado el panel, y no de qué color es. Se aplica igual al área de administración, a la lista de servidores y al área de cliente. Dónde va la navegación es un valor por defecto: quien haya puesto el suyo en Cuenta → Navegación lo conserva.',
        'default' => 'Barra lateral — la de Pelican',
        'rail' => 'Raíl de iconos — estrecho, se abre al pasar por encima',
        'top' => 'Navegación arriba — sin barra lateral',
        'mixed' => 'Barra superior y barra lateral — las dos',
        'wide' => 'Ancho — el contenido usa toda la pantalla',
        'focus' => 'Centrado — columna estrecha, la barra lateral se pliega',

        'nav_label' => 'Estilo de la barra lateral',
        'nav_helper' => 'Cómo se dibuja la propia barra lateral.',
        'nav_default' => 'Por defecto',
        'nav_floating' => 'Flotante — una tarjeta aparte',
        'nav_flat' => 'Plana — sin fondo alguno',
        'nav_bordered' => 'Con borde — una línea, no una superficie',

        'topbar_label' => 'Estilo de la topbar',
        'topbar_helper' => '«Oculta» solo vale en escritorio — en un teléfono, la topbar lleva la única vuelta al menú.',
        'topbar_default' => 'Por defecto',
        'topbar_floating' => 'Flotante — una barra despegada',
        'topbar_flush' => 'A ras — plana, sin desenfoque',
        'topbar_hidden' => 'Oculta en escritorio',

        'card_label' => 'Estilo de las tarjetas',
        'card_helper' => 'Las secciones, los widgets, las tarjetas de servidor y los bloques de encima de la consola.',
        'card_default' => 'Por defecto — elevada, con borde suave',
        'card_flat' => 'Plana — sin elevación',
        'card_outline' => 'Contorno — un borde y nada detrás',
        'card_glass' => 'Esmerilada — el fondo se transparenta',
        'card_sharp' => 'Angulosa — esquinas rectas',
    ],

    'servers' => [
        /*
         * La estrella de una tarjeta. Pasada al script en vez de escrita dentro
         * de él, para que los textos sigan en el único sitio donde viven.
         */
        'favourite' => 'Marcar este servidor',
        'favourited' => 'Marcado — se muestra primero',

        /*
         * La píldora junto a las pestañas de Pelican. Nombrada por lo que hace
         * con la lista y no como una cuarta pestaña, porque filtra la pestaña
         * que esté elegida en vez de reemplazarla.
         */
        'favourites_tab' => 'Favoritos',
        'favourites_empty' => 'No hay nada marcado en esta página. Usa la estrella de una tarjeta de servidor para añadir uno — y ten en cuenta que esto filtra los servidores que ya están listados aquí: un servidor marcado que esté en una página posterior no se está ocultando, sencillamente no está en esta.',
        'favourites_failed' => 'Tus servidores marcados no se pudieron guardar, así que se han devuelto a lo último que tenía el panel. La consola del navegador dice qué respondió la petición.',

        'art' => 'Imagen del juego',
        'art_helper' => 'Pelican dibuja la imagen del egg en cada tarjeta. Esto decide qué se hace con ella.',
        'art_faded' => 'Difuminada — un velo detrás del texto',
        'art_cover' => 'Cubierta — detrás del nombre, desvaneciéndose',
        'art_off' => 'Apagada',
        'art_dim' => 'Oscurecer la imagen',
        'art_dim_helper' => 'La imagen de un juego es un cielo claro y la de otro es una cueva.',

        'status' => 'Marca de estado',
        'status_helper' => 'Dónde se muestra el color de en marcha / arrancando / parado.',
        'status_bar' => 'Barra — por el borde izquierdo',
        'status_edge' => 'Borde — cruzando la parte de arriba',
        'status_dot' => 'Punto — en la esquina',
        'status_off' => 'Apagada',

        'density' => 'Altura de las tarjetas',
        'density_comfortable' => 'Cómoda',
        'density_compact' => 'Compacta — para muchos servidores',

        'filter_label' => 'Poner texto al botón de filtro',
        'filter_label_helper' => 'Pelican ya filtra esta lista por egg y por propietario, en todas las páginas - pero la entrada es un icono sin texto junto al buscador. Esto le pone la palabra.',
        'filter_button' => 'Filtros',

        'columns' => 'Tarjetas a lo ancho en pantalla grande',
        'columns_helper' => 'Solo vale para la cuadrícula, y solo a partir de 1280px. El máximo del propio Pelican es dos.',
    ],

    'controls' => [
        'mode' => 'Botón de consola en cada página de servidor',
        'mode_helper' => 'Un botón flotante, en cada página de dentro de un servidor. Abre la consola encima de lo que estuvieras haciendo, con el estado y los botones de encendido en su cabecera — llegando al nodo directamente, como hace la lista de servidores, y no por el websocket de la página de consola. No aparece nunca en la página de consola, que ya lo tiene todo.',
        'mode_full' => 'Consola y botones de encendido',
        'mode_console' => 'Solo la consola',
        'mode_off' => 'Apagado',

        'label' => 'El botón muestra',
        'label_text' => 'Icono y nombre',
        'label_icon' => 'Solo el icono',

        'position' => 'Dónde flota',
        'position_helper' => 'Contra el borde que menos probablemente estés leyendo.',
        'position_top' => 'Arriba',
        'position_right' => 'Derecha',
        'position_bottom' => 'Abajo',
    ],

    'console' => [
        'stats' => 'Bloques encima de la consola',
        'stats_helper' => 'Pelican muestra el nombre, el estado, la dirección y las tres cifras de uso encima del terminal. Ocultarlos le devuelve la altura a la consola.',
        'stats_tiles' => 'Baldosas — etiqueta, cifra y un icono',
        'stats_plain' => 'Simples — tal como los dibuja Pelican',
        'stats_off' => 'Ocultos',
    ],

    'terminal' => [
        'helper' => 'Se le pasan al propio terminal, así que surten efecto al cargar la página siguiente y no en el momento de guardarlos.',

        'renderer' => 'Dibujado por',
        'renderer_helper' => 'Pelican dibuja el terminal en la GPU, que es mucho más rápido con un muro de salida desplazándose. Un navegador solo mantiene vivos unos cuantos contextos de GPU a la vez — menos en un teléfono — y quita el más antiguo al pasar el límite; entonces el terminal no dibuja nada en absoluto, sin ningún error. Si tu consola se queda en blanco y todo lo demás se ve bien, este es el ajuste que hay que cambiar.',
        'renderer_webgl' => 'La GPU — la de Pelican, más rápida',
        'renderer_dom' => 'El navegador — más lento, dibuja siempre',

        'scheme' => 'Esquema de colores',
        'scheme_helper' => 'El único ajuste de terminal que Pelican no ofrece. «Seguir al tema» deriva los colores del acento, y por eso existe esto.',
        'scheme_theme' => 'Seguir al tema',
        'scheme_dracula' => 'Dracula',
        'scheme_nord' => 'Nord',
        'scheme_solarized' => 'Solarized Dark',
        'scheme_gruvbox' => 'Gruvbox Dark',
        'scheme_one_dark' => 'One Dark',
        'scheme_tokyo_night' => 'Tokyo Night',
        'scheme_catppuccin' => 'Catppuccin Mocha',
        'scheme_monokai' => 'Monokai',

        'cursor' => 'Cursor',
        'cursor_helper' => 'La consola no acepta escritura — el campo de comandos está debajo — así que esto es donde se paró la salida, y no donde estás tú.',
        'cursor_underline' => 'Subrayado — el de Pelican',
        'cursor_block' => 'Bloque',
        'cursor_bar' => 'Barra',

        'blink' => 'Cursor parpadeante',

        'scrollback' => 'Historial',
        'scrollback_helper' => 'Hasta dónde se puede subir en la consola. Cada línea se guarda en el navegador, así que un servidor hablador con un ajuste alto es memoria real en la máquina que está leyendo.',
        'scrollback_lines' => ':lines líneas',
    ],

    'notice' => [
        'text' => 'Mensaje',
        'text_helper' => 'Una línea, hasta 200 caracteres. Se escapa a la entrada y a la salida, así que no puede llevar marcado a una página que carguen otras personas.',
        'style' => 'Tono',
        'style_info' => 'Información',
        'style_warning' => 'Aviso',
        'style_danger' => 'Urgente',
        'style_accent' => 'Color de acento',
        'scope' => 'Se muestra a',
        'scope_all' => 'Todo el mundo',
        'scope_client' => 'Solo fuera del área de administración',
        'scope_admin' => 'Solo en el área de administración',
        'link_label' => 'Texto del botón',
        'link_url' => 'Dirección del botón',
        'link_url_helper' => 'https:// o una ruta dentro de este panel, como /account. Todo lo demás se ignora — un enlace en una franja que sale en cada página no es sitio para un esquema que nadie espera.',
        'dismissible' => 'Se puede cerrar',
        'dismissible_helper' => 'Que se haya cerrado se recuerda por navegador, y solo para este mensaje: cambia el texto y vuelve para todos.',
        'dismiss' => 'Cerrar',
    ],

    'preset' => [
        'label' => 'Estilo',
        'helper' => 'Elige un aspecto del que partir. Rellena todo lo de abajo, que luego puedes cambiar. «Ninguno» apaga el tema y deja el panel exactamente como lo entrega Pelican.',
        'options' => [
            'none' => 'Ninguno - sin tema',
            'legend' => 'Legend - fuego rojo hacia rayo azul',
            'ember' => 'Ember - negro cálido, acento naranja',
            'midnight' => 'Midnight - azul profundo, tranquilo',
            'crimson' => 'Crimson - rojo, esquinas rectas, compacto',
            'forest' => 'Forest - verde, redondeado, sin brillo',
            'nebula' => 'Nebula - morado con un fondo en degradado',
            'terminal' => 'Terminal - verde sobre negro, monoespaciado, recto',
            'console' => 'Console - redondo y espacioso, para una tableta',
            'nord' => 'Nord - la paleta Nord, apagada',
            'solarized' => 'Solarized - Solarized dark, acento cian',
            'paper' => 'Paper - claro, mucho contraste, plano',
            'daylight' => 'Daylight - claro y cálido, con un velo suave',
            'mono' => 'Mono - escala de grises, plano y denso',
        ],

        'save' => 'Guardar como estilo',
        'save_confirm' => 'Conserva los colores, las esquinas, el fondo, la tipografía, los iconos y los umbrales de los medidores que tienes ahora mismo en pantalla — con un nombre tuyo, en el selector junto a los que vienen incluidos. Guarda lo que hay en la página, no lo último que se guardó.',
        'save_name' => 'Nombre',
        'save_name_helper' => 'Cómo se llamará en el selector. Guardar con un nombre que ya has usado reemplaza aquel.',
        'saved' => 'Estilo guardado',
        'save_failed' => 'No se pudo guardar ese estilo',
        'save_full' => 'Hay sitio para :max estilos tuyos. Borra uno primero.',

        'delete' => 'Borrar un estilo',
        'delete_which' => 'Cuál',
        'delete_confirm' => 'Solo se pueden borrar los estilos tuyos; los incluidos no. No cambia nada del aspecto actual del panel — un estilo es un punto de partida, y todos los valores que puso ya están en los ajustes de abajo.',
        'deleted' => 'Estilo borrado',
        'deleted_current' => 'Ese era el que tenía puesto este panel. Sus ajustes están sin cambios y siguen en esta página — elige un estilo, o vuelve a guardarlos con un nombre.',
    ],

    'user_themes' => [
        'label' => 'Estilos que la gente puede elegir para sí misma',
        'helper' => 'Los estilos marcados aparecen en una página de Apariencia dentro del área de cliente, donde cualquiera que haya iniciado sesión puede elegir uno para sí. Cambia lo que ve él y nada para los demás. Nada marcado significa que nadie elige nada y el panel mantiene un solo aspecto — que es lo que hace ahora.',
    ],

    'mode' => [
        'label' => 'Modo del panel',
        'helper' => 'Con qué modo abre el panel. Quien no haya elegido por sí mismo recibe este; el interruptor del menú de usuario les deja cambiarlo igualmente, salvo que lo bloquees abajo.',
        'dark' => 'Oscuro',
        'light' => 'Claro',
        'system' => 'Sistema — seguir el ajuste del visitante',
    ],

    'font' => [
        'label' => 'Tipografía del panel',
        'helper' => 'Cada opción es una familia que el sistema operativo ya tiene — no se descarga nada de un proveedor de fuentes. El terminal no se ve afectado: su fuente es la elección de cada uno, en Cuenta.',
        'default' => 'Por defecto - la de Pelican',
        'mono' => 'Monoespaciada',
        'rounded' => 'Redondeada',
        'serif' => 'Serif',
        'system' => 'Sistema - la que use esta máquina',
    ],

    'surface' => [
        'label' => 'Color de las superficies',
        'helper' => 'Las tarjetas y los paneles. Los tonos más claros y más oscuros se derivan de él.',
        'placeholder' => 'Seguir al tema',
    ],

    'radius' => [
        'label' => 'Esquinas',
    ],

    'accent' => [
        'label' => 'Color de acento',
        'helper' => 'Se usa en los botones, los enlaces, la entrada de navegación activa y los anillos de foco.',

        /*
         * Dicho, no impuesto. Un color sobre el que esto avisa se guarda
         * igualmente: es el panel de alguien, la cifra mide una sola cosa, y
         * hay buenas razones para querer un acento que puntúe mal. El selector
         * dice lo que ve y se aparta.
         */
        'contrast_dark' => 'Legibilidad: :ratio frente a un panel oscuro. Por debajo de 3 un acento cuesta de leer como botón o como enlace — uno más claro lo levanta.',
        'contrast_light' => 'Legibilidad: :ratio frente a un panel claro. Por debajo de 3 un acento cuesta de leer como botón o como enlace — uno más oscuro lo levanta.',
    ],
    'density' => [
        'label' => 'Densidad',
        'helper' => 'Compacta aprieta los espacios para que quepan más filas en pantalla.',
        'comfortable' => 'Cómoda',
        'compact' => 'Compacta',
    ],
    'force_dark' => [
        'label' => 'Forzar el modo oscuro',
        'helper' => 'Oculta el interruptor claro/oscuro y mantiene a todos los usuarios en el tema oscuro.',
    ],
    'glass' => [
        'label' => 'Topbar esmerilada',
        'helper' => 'Desenfoca la topbar y los fondos de las ventanas modales. Apágalo en dispositivos modestos.',
    ],
    'glow' => [
        'label' => 'Brillo de acento',
        'helper' => 'Una sombra de acento suave en los botones principales, la navegación activa y la tarjeta de acceso.',
    ],

    'background' => [
        'label' => 'Tipo de fondo',
        'helper' => 'Aurora es el fondo propio del tema: brillos de acento con un grano fino.',
        'aurora' => 'Aurora (por defecto)',
        'solid' => 'Un solo color',
        'gradient' => 'Degradado',
        'image' => 'Imagen',
        'color' => 'Color',
        'base' => 'Color detrás de los brillos',
        'base_helper' => 'Sobre qué se apoya la página antes de pintar encima los brillos de acento. Déjalo vacío para conservar el valor por defecto del panel, casi negro en oscuro y casi blanco en claro. Ponlo y un esquema conserva su propio color de noche y sigue quedando iluminado.',
        'color_end' => 'Segundo color',
        'angle' => 'Dirección',
        'upload' => 'Subir una imagen',
        'upload_helper' => 'Hasta 8 MB. Una imagen subida tiene prioridad sobre la URL de abajo.',
        'url' => 'O una URL',
        'url_helper' => 'Tiene que empezar por https:// y ser alcanzable desde fuera.',
        'dim' => 'Oscurecer',
        'dim_helper' => 'Sin oscurecer, el texto blanco sobre una foto clara no se lee.',
        'blur' => 'Desenfoque',
    ],

    'channel' => [
        'installed' => 'instalada',
        'version' => 'Instalar una versión concreta',
        'version_helper' => 'Cualquier versión de este canal, no solo la más nueva — para volver atrás cuando algo nuevo sale peor, o adelante hacia una compilación que te han dicho que pruebes. Solo mientras las actualizaciones no se instalen solas: con eso encendido, lo que elijas duraría hasta la siguiente comprobación.',
        'version_placeholder' => 'Elige una versión',
        'version_install' => 'Instalar esta versión',
        'version_confirm' => 'El panel descarga esa versión, reconstruye sus assets y vacía sus cachés. Tus ajustes se conservan. Volver a una versión anterior está permitido y no se deshace solo — vuelve a elegir la más nueva para avanzar.',
        'label' => 'Canal de actualización',
        'helper' => 'Qué versiones ofrece la página del tema. Beta recibe las versiones nuevas primero, y las asperezas también primero.',
        'stable' => 'Estable',
        'beta' => 'Beta',
        'dev' => 'Dev (rama de trabajo)',
        'auto' => [
            'label' => 'Instalar las actualizaciones automáticamente',
            'helper' => 'Apagado deja la actualización en tus manos. Encendido, el panel comprueba el canal elegido e instala todo lo más nuevo - reconstruye sus assets mientras tanto y queda no disponible unos minutos, por eso el diario y el semanal van a las 04:00. Necesita el cron del panel en marcha.',
            'interval' => 'Comprobar cada',
            'minute' => 'Cada minuto',
            'five_minutes' => 'Cada 5 minutos',
            'ten_minutes' => 'Cada 10 minutos',
            'thirty_minutes' => 'Cada 30 minutos',
            'hourly' => 'Cada hora',
            'daily' => 'Cada día (04:00)',
            'weekly' => 'Cada semana (lunes 04:00)',
        ],
    ],

    /*
     * La pestaña de Idiomas.
     *
     * Cuidadosa con lo que afirma. Pelican ya deja que cada uno elija un idioma
     * para toda su cuenta y ya lo aplica; nada de aquí cambia eso ni debería.
     * Esto decide únicamente si los textos propios de este plugin siguen esa
     * elección.
     */
    'languages' => [
        'section_helper' => 'Pelican ya deja que cada uno elija un idioma para su cuenta, y este plugin lo sigue allí donde está traducido. Aquí decides a cuáles de ellos hará caso. La mayoría de los idiomas están en un porcentaje bajo a propósito: lo primero que se traduce es la parte que todo el mundo ve en cada página — los botones de encendido de encima de una consola y los medidores de los nodos — y el resto llega según la gente lo aporta.',
        'panel' => 'Dejar que esto decida el idioma de todo el panel',
        'panel_helper' => 'Encendido, un idioma que este plugin no lleva — o uno apagado abajo — pone todo el panel en inglés para ese lector, y no solo estas páginas. Apagado, solo este plugin sigue la lista y Pelican sigue hablando lo que tenga puesto la cuenta, lo que significa que un lector puede encontrarse dos idiomas en una misma pantalla. En ningún caso se cambia ninguna cuenta: vuelve a encender un idioma y lo tiene otra vez.',
        'label' => 'Idiomas en los que responder',
        'helper' => 'Desmarcar uno devuelve al inglés, solo para este plugin, a los lectores que lo tengan puesto en su cuenta — el resto del panel sigue hablando su idioma. El inglés no aparece en la lista porque todo cae de vuelta a él.',
        'under' => 'no se ofrece hasta que avance más — márcalo para ofrecerlo igualmente',
        'done' => ':percent % traducido',
        'main' => 'Idioma principal',
        'main_helper' => 'Lo que recibe un lector cuando su propio idioma no se puede usar — o este plugin no lo lleva, o está desmarcado abajo. Siempre fue el inglés; en un equipo que no trabaja en inglés esa era una respuesta equivocada dada con seguridad. No se puede desmarcar abajo, porque todo cae de vuelta a él.',
        'labels' => 'Cómo se llama cada idioma',
        'labels_helper' => 'El nombre que ven lectores y administradores en los selectores. Deja uno vacío para conservar el nombre con el que este plugin lo conoce. Un idioma subido con un nombre tuyo no tiene ninguno, así que aparecería con su código hasta que le des uno aquí.',
        'labels_code' => 'Código',
        'labels_name' => 'Se muestra como',
        'download' => 'Descargar un archivo de traducción',
        'download_from' => 'Partir de',
        'download_from_helper' => 'Un JSON con todos los textos de este plugin. Elige inglés para un idioma que nadie ha empezado, o uno existente para seguir con lo que ya está traducido.',
        'code' => 'Código de idioma',
        'code_helper' => 'El código al que corresponde el archivo. Una locale real, tal como la usan las cuentas — fr, de, pt_BR — llega a los lectores que la tengan puesta, y tiene que coincidir exactamente o no llegará. Un nombre tuyo, como Gaming-ES, está permitido y funciona de otra manera: Pelican solo deja que una cuenta tenga una locale real, así que nadie puede seleccionar el tuyo. Es alcanzable como idioma principal de arriba, que es lo que recibe todo aquel cuyo idioma no se puede usar.',
        'url' => 'O traerlo de una dirección',
        'url_helper' => 'Una dirección https a la que el panel llegue — un CDN, un bucket, un archivo en bruto de un repositorio. Se descarga una vez al guardar y se escribe igual que una subida, así que cambiar el archivo de esa dirección más adelante no hace nada hasta que vuelvas a guardar. Un archivo elegido arriba gana frente a una dirección que quede en este campo.',
        'upload' => 'Subir un archivo de traducción',
        'upload_helper' => 'El JSON de arriba, con los valores traducidos. Se escribe fuera del plugin, así que una actualización no lo tirará, y se combina sobre el inglés clave por clave — un archivo con la mitad de los textos te da medio idioma e inglés para el resto.',
        'uploaded' => ':count textos instalados para :code',
        'uploaded_halves' => 'De ellos, :mine son textos propios de este plugin y :panel son del panel. Cero en uno de los lados significa que esa mitad del archivo no traía nada — las claves del plugin empiezan por essentials:: y las del panel no.',
        'uploaded_skipped' => 'Se omitieron :count: vacíos, o claves que este plugin no tiene. Los primeros: :keys',
        'upload_failed' => 'Ese archivo no se pudo leer',
        'upload_failed_body' => 'Tiene que ser el JSON de la descarga de arriba — un objeto plano de claves y textos. Comprueba que un editor no lo haya guardado como otra cosa.',
    ],

    'windows' => [
        'add' => 'Añadir una franja',
        'from' => 'Desde',
        'to' => 'Hasta',
        'to_helper' => 'Más temprano que el inicio significa que cruza la medianoche — de 22:00 hasta 06:00 es la noche.',
        'preset' => 'Estilo',
        'days' => 'Días',
        'days_helper' => 'Déjalos todos sin marcar para todos los días. Una franja que cruza la medianoche pertenece al día en que empieza, así que el viernes de 22:00 hasta 06:00 cubre la mañana del sábado.',
        'day_mon' => 'Lunes',
        'day_tue' => 'Martes',
        'day_wed' => 'Miércoles',
        'day_thu' => 'Jueves',
        'day_fri' => 'Viernes',
        'day_sat' => 'Sábado',
        'day_sun' => 'Domingo',
    ],

    'arranger' => [
        'label' => 'Organizador de páginas',
        'helper' => 'El botón «Organizar la página», en todas las páginas del panel. Quien tenga el permiso Organizar lo recibe y puede además fijar la disposición de la que parten todos los demás, o una para un rol. Apagado lo oculta para todos; las disposiciones ya guardadas se quedan donde están.',
        'roles' => 'Una disposición no es un permiso. Un bloque que un rol oculta sigue siendo un bloque al que alguien podría llegar escribiendo la dirección — lo que lo impide son los permisos del propio Pelican, en la página de roles. Se aplican tres capas en este orden: la de partida común, luego el rol del lector, y luego lo que él mismo haya movido.',
        'users' => 'Dejar que cada uno organice sus propias páginas',
        'users_helper' => 'Encendido, cualquiera que haya iniciado sesión puede recolocar y ocultar bloques en las páginas que ya ve, solo para sí mismo — no cambia nada para nadie más. Fijar la disposición de partida común sigue atado al permiso Organizar.',
    ],

    'brand' => [
        'logo_height' => 'Altura del logo',
        'logo_height_helper' => 'Pelican entrega 2rem. Los valores mayores hacen más alta con él la cabecera de la barra lateral.',
        'logo_url' => 'Sustituir el logo',
        'logo_url_helper' => 'Déjalo vacío para conservar aquello a lo que apunten los ajustes del propio Pelican.',
    ],

    'login' => [
        'image' => 'Imagen de fondo',
        'image_helper' => 'Solo para la pantalla de acceso. Sin ella sigue mostrando el fondo del panel.',
        'url' => 'O una URL',
        'blur' => 'Desenfoque de la tarjeta',
        'blur_helper' => 'Esmerila la tarjeta para que se transparente la imagen de detrás.',
        'width' => 'Ancho de la tarjeta',
        'position' => 'Encuadre de la imagen',
        'position_helper' => 'Qué parte de la imagen sobrevive al recorte a la pantalla.',
        'position_center' => 'Centro',
        'position_top' => 'Arriba',
        'position_bottom' => 'Abajo',
        'position_left' => 'Izquierda',
        'position_right' => 'Derecha',
        'align' => 'Posición de la tarjeta',
        'align_helper' => 'Dónde se sitúa la tarjeta de acceso a lo ancho de la pantalla.',
        'align_center' => 'Centro',
        'align_start' => 'Izquierda',
        'align_end' => 'Derecha',
        'opacity' => 'Opacidad de la tarjeta',
        'opacity_helper' => 'Más baja deja pasar más imagen a través de la tarjeta.',
        'glow' => 'Brillo de acento',
        'glow_helper' => 'El halo alrededor de la tarjeta. Apagado conserva su borde y su profundidad.',
        'hide_heading' => 'Ocultar el título',
        'hide_heading_helper' => 'Quita el título de encima del formulario, dejando el formulario solo.',
        'hide_footer' => 'Ocultar el pie',
        'hide_footer_helper' => 'Quita la línea de debajo de la tarjeta que enlaza a pelican.dev.',
        'above' => 'Línea encima del formulario',
        'above_helper' => 'Una línea, mostrada a todo el que llegue a la pantalla de acceso. Déjalo vacío para ninguna.',
        'notice' => 'Aviso debajo de la tarjeta',
        'notice_helper' => 'Una línea, mostrada a todo el que llegue a la pantalla de acceso. Déjalo vacío para ninguno.',
    ],

    'advanced' => [
        'css' => 'CSS propio',
        'css_helper' => 'Hasta 100 KB. Se guarda en storage, no en el .env.',
        'reference' => 'Referencia de CSS',
        'reference_helper' => 'Todas las variables y clases que exponen este tema y el panel.',
    ],

    'areas' => [
        'add' => 'Añadir un área',
        'area' => 'Área',
        'inherit' => 'General',
        'radius' => 'Esquinas',
        'radius_sharp' => 'Rectas',
        'radius_normal' => 'Normales',
        'radius_round' => 'Redondeadas',
        'surface' => 'Color de las superficies',
        'surface_helper' => 'Las tarjetas y los paneles de dentro de esta área; los tonos más claros y más oscuros se derivan de él.',
        'names' => [
            'terminal' => 'Terminal',
            'console' => 'Consola (el resto de la página)',
            'files' => 'Página de archivos',
            'edit' => 'Página de edición',
            'server' => 'Otras páginas y pestañas de servidor',
        ],
    ],

    'bars' => [
        'base' => 'Color base',
        'base_green' => 'Verde',
        'base_accent' => 'Color de acento',
        'warning' => 'Ámbar a partir de',
        'danger' => 'Rojo a partir de',
    ],

    'icons' => [
        'stroke' => 'Grosor del trazo',
        'stroke_thin' => 'Fino',
        'stroke_normal' => 'Normal',
        'stroke_bold' => 'Grueso',
        'scale' => 'Tamaño',
        'accent' => 'Iconos de menú en el color de acento',
        'accent_helper' => 'Se aplica a los iconos de la barra lateral y de la topbar.',
        'pack' => 'Paquete de iconos',
        'pack_helper' => 'De qué conjunto saca el selector de abajo. Se ofrecen todos los conjuntos de iconos instalados en el servidor, más el conjunto Essentials que viene con este plugin y cualquier paquete que subas. Hay una diferencia que conviene saber: un icono de trazo se dibuja en el color del menú y sigue el paso del ratón y la fila activa, mientras que los iconos de Essentials son imágenes y conservan sus propios colores. Eso lo decide lo que es el archivo, no el conjunto del que venga.',
        'pack_custom' => 'Paquete subido',
        'pack_shipped' => 'Iconos de Essentials',
        'use_shipped' => 'Usar los iconos de Essentials en todas partes',
        'use_shipped_confirm' => 'Pone el paquete en los iconos de Essentials y rellena cada entrada de menú de abajo con el icono dibujado para ella — la consola recibe el terminal, el arranque recibe el botón de lanzar, y así. Reemplaza las entradas que tienes ahora, y no se guarda nada hasta que pulses Guardar, así que cerrar la página lo deshace.',
        'pack_upload' => 'Subir un paquete',
        'pack_upload_helper' => 'Un .zip de archivos SVG. Cada archivo se convierte en un icono con su nombre — logo.svg pasa a ser custom-logo. Subir uno reemplaza el paquete que haya ahora. Los archivos de más de 256 KB y todo lo que pase de 4.000 iconos se quedan fuera, y se te dice cuántos: como referencia, todo el conjunto Tabler ronda los seis mil iconos en unos tres megabytes, así que un paquete mucho mayor lleva algo que no son iconos y la mayor parte se omitirá. Una subida grande también puede rechazarse antes de que este campo diga nada, por upload_max_filesize y post_max_size en el php.ini del host del panel — ningún ajuste de aquí puede subirlos.',
        'pack_partial' => ':count iconos instalados, pero no todos',
        'pack_partial_body' => 'Omitidos: :big demasiado grandes para un icono, :unusable no utilizables como SVG, :duplicate con un nombre ya ocupado, :empty sin nada que dibujar una vez limpiados. Un SVG de más de 256 KB casi siempre es una imagen envuelta en uno y no un dibujo — expórtalo al tamaño de un icono y ocupará unos pocos kilobytes. Un icono sin nada que dibujar solo contenía algo que aquí no se sirve — si es un paquete entero, merece la pena avisar.',
        'pack_stopped_files' => 'También se detuvo en el límite de cuántos iconos puede contener un paquete.',
        'pack_stopped_size' => 'También se detuvo porque el resto del paquete, descomprimido, ocupa más de lo que el panel mantiene en memoria de una vez — el zip puede ser más pequeño, ya que el SVG comprime alrededor de cinco a uno.',
        'overrides' => 'Reemplazar iconos',
        'overrides_helper' => 'Una fila por cada icono que quieras cambiar. Elige la entrada de menú, y luego escoge un icono del paquete de arriba, da una dirección, o sube una imagen tuya. Si hay más de uno relleno, gana la subida, luego la dirección, luego el paquete.',
        'overrides_key' => 'Entrada de menú',
        'overrides_value' => 'Icono del paquete',
        'overrides_url' => 'O una dirección',
        'overrides_url_helper' => 'Una dirección https de una imagen que alojes tú — un CDN, un bucket, cualquier sitio al que llegue el navegador. No se copia nada al panel, así que reemplazar el archivo de esa dirección cambia el icono sin tocar esta página; la otra cara es un icono que desaparece cuando desaparece la dirección. Conserva sus propios colores, como una imagen subida.',
        'overrides_file' => 'O subir una imagen',
        /*
         * Dice en qué consiste realmente la diferencia, porque no es evidente y
         * es la razón por la que alguien elegiría uno u otro.
         */
        'overrides_file_helper' => 'PNG, SVG o ICO. Un icono del paquete se dibuja en el color del menú y sigue el paso del ratón y la fila activa; una imagen subida conserva sus propios colores y no lo hace. Para un logo eso suele ser lo que se quiere.',
        'overrides_add' => 'Reemplazar otro icono',
        'overrides_search' => 'Escribe un nombre, o la entrada de menú…',
    ],

    /*
     * No dentro de «Marca». La marca habla del aspecto del panel; esto habla de
     * cómo aparece este plugin dentro de él, que es otra pregunta y se responde
     * en otra página.
     */
    'identity' => [
        'nav_icon' => 'Icono de la entrada «Ajustes de Essentials»',
        'nav_icon_helper' => 'PNG, SVG o ICO, hasta 8 MB. Reemplaza el icono de esa única entrada de la barra lateral; déjalo vacío para el que trae este plugin. Se dibuja como una imagen y no como un icono, así que conserva sus propios colores en vez de seguir al texto — que es lo que suele querer un logo. El archivo se sirve en vez de incrustarse, así que cada navegador lo descarga una sola vez, pero aun así merece la pena exportar algo pequeño: unos pocos kilobytes sobran para una fila de veinte píxeles de alto. Si una subida falla antes de que este campo diga nada, el límite con el que chocó es upload_max_filesize en el php.ini del panel.',
    ],
];
