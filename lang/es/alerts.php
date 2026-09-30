<?php

/*
 * Español. Escrito a mano.
 *
 * El watchdog.
 *
 * Cada mensaje de aquí se lee en un teléfono, a las tres de la mañana, por
 * alguien que hace un minuto estaba dormido. Cada uno dice qué máquina, qué va
 * mal, y nada más - el detalle va en la página que abrirá después, no en la
 * línea que le ha despertado.
 *
 * La vuelta a la normalidad se escribe como noticia y no como añadido. «¿Ya ha
 * vuelto?» es la pregunta por la que alguien se levantaría si no.
 *
 * «Node», «Wings», «daemon», «webhook», «queue», «Discord» y «SMTP» se quedan
 * en inglés: con esos nombres se encuentran en Pelican, en el host y en todo lo
 * que se escribe sobre ellos.
 */

return [
    'title' => 'Avisos',
    'nav_label' => 'Avisos',
    'subheading' => 'El panel ya sabe cuándo un nodo deja de responder, cuándo se llena un disco o cuándo se para la cola. Esto es lo que te lo dice.',

    // ---- los canales, y qué hicieron la última vez ------------------------
    'channels' => 'Adónde van los mensajes',
    'channels_helper' => 'Lo que hizo cada canal la última vez que se le pidió enviar algo. Un canal encendido que rechaza en silencio se ve exactamente igual que un panel al que no le pasa nada, y por eso esto es lo primero de la página.',

    'state_off' => 'Apagado',
    'state_untried' => 'Todavía no se ha enviado nada',
    'state_ok' => 'Entregado',
    'state_failed' => 'Rechazado',

    // ---- cuándo -----------------------------------------------------------
    'when' => 'Cada cuánto',
    'when_helper' => 'Las comprobaciones se ejecutan en segundo plano, así que necesitan un queue worker. Sin él no se envía nada y nada lo dice - usa «Enviar una prueba», que no pasa por la cola.',

    'every' => 'Comprobar cada',
    'every_helper' => 'Cada comprobación llega al daemon de cada nodo, así que es una petición por nodo y por pasada. Quince minutos bastan para enterarse de una caída mientras todavía es una caída.',
    'every_off' => 'Apagado - ninguna comprobación',
    'every_five' => '5 minutos',
    'every_fifteen' => '15 minutos',
    'every_thirty' => '30 minutos',
    'every_hourly' => 'Hora',
    'every_daily' => 'Día',

    'repeat' => 'Recordármelo mientras dure',
    'repeat_helper' => 'Se envía un mensaje cuando algo cambia, y otro cuando se recupera. Esto añade un recordatorio mientras un problema sigue en curso. Cero significa sin recordatorios - un canal que se repite cada quince minutos es un canal que la gente silencia.',
    'hours' => 'horas',

    // ---- dónde ------------------------------------------------------------
    'where' => 'Canales',
    'where_helper' => 'Más de uno es sensato. Fallan de maneras distintas.',

    'discord' => 'Discord',
    'discord_helper' => 'Donde un mensaje lo lee de verdad alguien que no está mirando el panel.',
    'webhook' => 'Dirección del webhook',
    'webhook_helper' => 'En Discord: Ajustes del servidor → Integraciones → Webhooks → Nuevo webhook → Copiar URL del webhook. Limitado a https, porque esto publica cuál de tus máquinas se ha caído y lo lleno que está su disco.',
    'bot' => 'Un bot tuyo',
    'bot_helper' => 'Un solo envío JSON firmado a una dirección que llevas tú, para que algo de fuera del panel se entere de un nodo caído en vez de preguntar cada minuto si hay alguno. Los webhooks que trae Pelican no pueden con esto: se disparan sobre modelos y sobre el registro de actividad, y un nodo que ha dejado de responder no escribe en ninguno de los dos.',
    'bot_url' => 'Adónde enviarlo',
    'bot_url_helper' => 'Limitado a https, porque esto envía a una dirección de internet cuál de tus máquinas se ha caído.',
    'bot_secret' => 'Secreto de firma',
    'bot_secret_helper' => 'Compartido con lo que reciba esto. El cuerpo se pasa por hash con él y el hash viaja en X-Essentials-Signature como sha256=<hex>, así que tu bot puede rechazar todo lo que no venga de este panel. Mientras esto esté vacío no se envía nada - una firma opcional es una firma que nadie comprueba.',
    'facts' => 'Avisar también al bot cuando ocurra algo',
    'facts_helper' => 'Todo lo anterior es un fallo. Esto no: son cosas que simplemente ocurrieron. Cada una está desactivada hasta que la marques, así que actualizar no cambia nada, y solo van al bot, nunca a Discord, la campana o el correo.',

    'panel' => 'En el panel',
    'panel_helper' => 'Una notificación para todos los que tengan este permiso. Funciona siempre, no necesita configuración, y es invisible para quien no haya iniciado sesión.',

    'email' => 'Correo',
    'email_helper' => 'Separados por comas. Usa el mailer del propio panel - fiable cuando está configurado y completamente silencioso cuando no lo está, que es el único fallo que un watchdog no puede tener. Déjalo vacío para apagarlo.',

    // ---- qué --------------------------------------------------------------
    'what' => 'Qué se vigila',
    'what_helper' => 'Cada lectura de aquí es una que el panel ya hace. Nada de esta página abre una conexión que la página Estado del sistema no abra.',

    'percent_helper' => 'Cero apaga esta comprobación.',
    'disk' => 'Avisar cuando el disco de un nodo pase de',
    'memory' => 'Avisar cuando la memoria de un nodo pase de',

    'maintenance' => 'Avisar de un mantenimiento dejado puesto más de',
    'maintenance_helper' => 'Un nodo en mantenimiento se salta el resto de comprobaciones, y eso está bien - y es también la manera de que uno se quede olvidado quince días. Cero apaga esto.',

    'versions' => 'Versiones del panel y de Wings',
    'versions_helper' => 'Un mensaje cuando algo se queda atrás, y otro cuando vuelve a estar al día. Sin recordatorios - una versión no es una caída.',

    'backups' => 'Copias de seguridad que se quedan atrás',
    'backups_helper' => 'Un solo mensaje nombrando los servidores en vez de uno por servidor - cuando una tarea programada se para, todos los servidores caducan a la vez, y cuarenta mensajes separados por una sola causa son un canal que la gente silencia. Apagado por defecto: a un panel que respalda a mano en vez de por horario se le echaría esto en cara a diario.',
    'backup_days' => 'Una copia se considera caducada tras',
    'backup_days_helper' => 'Es también lo que usa la página de Copias de seguridad. Un servidor que se respalda cada semana no debería salir avisado a los ocho días.',
    'days' => 'días',

    'stock' => 'Paquetes que se agotan',

    'unbuilt_switch_helper' => 'Un pedido con la factura pagada cuyo servidor un nodo rechazó. La única comprobación de aquí en la que alguien ha perdido dinero sin que nada lo diga: todo lo demás en esta lista es una máquina que se paró. Apagado hasta que lo enciendas, como el resto.',

    'unbuilt_switch' => 'Pagado y sin crear',
    'stock_helper' => 'Un solo mensaje nombrando los paquetes en vez de uno por paquete, y nunca un recordatorio: que algo esté agotado es un estado normal de una tienda y no una caída, y enterarse de ello cada cuatro horas es justo la manera de que esto deje de leerse. Solo se miran los paquetes que tienen un tope, así que una tienda que lo vende todo sin límite no cuesta nada de vigilar. Apagado por defecto, como el resto.',
    'modules_switch' => 'Un módulo encendido que no funciona',
    'modules_switch_helper' => 'Un mensaje por módulo en vez de uno solo para todos, porque lo que falla en cada uno es distinto y la frase tiene que decirlo. Avisa de dos cosas: un módulo al que le faltan las tablas, que es una instalación que no pudo terminar, y un módulo con partes encendidas que esperan a que se rellene algo. La página de Módulos muestra las dos en la tarjeta; esto es para los paneles donde nadie va a mirar. Apagado por defecto, como el resto.',
    'module_tables_title' => 'El módulo «:module» está encendido y le faltan las tablas',
    'module_tables' => 'Las páginas de «:module» se esconden porque las tablas que leen no están, que suele ser una instalación que no pudo terminar. Abre la página de Módulos, apágalo y vuelve a encenderlo, y las tablas se crean.',
    'module_waiting_title' => 'El módulo «:module» está encendido y una parte está esperando',
    'module_waiting' => '{1} Una parte de «:module» está encendida y no muestra nada hasta que se rellene algo - los eggs a los que se aplica, los estilos que se ofrecen, los servidores que debe mostrar una página pública. La página de Módulos dice cuál, en la tarjeta.|[2,*] :count partes de «:module» están encendidas y no muestran nada hasta que se rellene algo - los eggs a los que se aplican, los estilos que se ofrecen, los servidores que debe mostrar una página pública. La página de Módulos dice cuáles, en la tarjeta.',
    'module_cleared' => 'El módulo «:module» vuelve a funcionar',
    'ports_switch' => 'Puertos que se agotan',
    'ports_switch_helper' => 'Un mensaje por paquete en vez de uno solo para todos, porque lo que sirve es el rango y la cuenta, no una lista de nombres. Solo se miran los paquetes que tienen un rango puesto, así que una tienda que deja que las compras tomen cualquier puerto libre no cuesta nada de vigilar. Apagado por defecto, como el resto.',
    'stock_left' => 'Avisar cuando queden',
    'stock_left_helper' => 'Se cuenta contra el tope del paquete. Un paquete tiene que bajar a este número para que se avise de él, y subir dos por encima para volver a darse por sano, así que uno al que una compra y una cancelación empujan de un lado a otro no dice nada. Aquí el cero es un número y no una ausencia: deja callado el aviso y solo queda el mensaje que dice que un paquete se ha agotado.',
    'stock_left_suffix' => 'por vender',

    'worker' => 'Queue worker',
    'worker_helper' => 'Si hay algo ejecutando el trabajo de fondo de este plugin. Fíjate en la circularidad: la comprobación misma se ejecuta en la cola, así que un panel que nunca ha tenido un worker no puede avisarlo. La línea de arriba de esta página sí.',

    // ---- los botones ------------------------------------------------------
    'save' => 'Guardar',
    'saved' => 'Guardado',
    'save_failed' => 'No se guardó nada',

    'test' => 'Enviar una prueba',
    'test_one' => 'Probar',
    'test_off' => 'Ese canal está apagado',
    'test_off_body' => 'Enciéndelo y guarda, y se probará junto con el resto.',
    'test_title' => 'Mensaje de prueba',
    'test_body' => 'Si estás leyendo esto, los avisos de tu panel Pelican llegarán aquí. No pasa nada.',
    'test_sent' => 'Enviado a todos los canales encendidos',
    'test_failed' => 'Al menos un canal lo rechazó',
    'test_none' => 'No hay adónde enviar',
    'test_none_body' => 'No hay ningún canal encendido, así que un aviso de verdad tampoco iría a ninguna parte.',

    /*
     * Qué hacer ante un rechazo.
     *
     * El motivo que da un proveedor es escueto y correcto, e inútil por sí
     * solo. Los dos que salen casi siempre están nombrados, porque ninguno se
     * adivina desde el código: un 553 es sobre el remitente y no sobre el
     * destinatario, y un 401 de Discord es una URL revocada o mal copiada.
     */
    'hint_email_sender' => 'Tu servidor SMTP rechazó la dirección desde la que envía el panel, no la dirección a la que enviaba. En Admin → Ajustes → Correo, la dirección de remitente tiene que ser un buzón desde el que tu cuenta SMTP tenga permiso para enviar. No tiene nada que ver con este plugin - el correo de prueba del propio Pelican en esa página fallará igual.',
    'hint_email' => 'Mira en Admin → Ajustes → Correo. El botón de correo de prueba de esa página usa los mismos ajustes y dirá lo mismo.',
    'hint_discord_url' => 'Discord no reconoció ese webhook. Se ha borrado, se ha regenerado, o se ha pegado a medias - crea uno nuevo en Ajustes del servidor → Integraciones → Webhooks y copia la URL entera.',
    'hint_discord' => 'El panel no pudo llegar a Discord. Si este panel está detrás de un cortafuegos que bloquea las peticiones salientes, este canal no puede funcionar desde aquí.',
    'hint_panel' => 'Nadie tiene el permiso para esto, o la notificación no se pudo guardar. Mira en Roles.',

    'run_now' => 'Ejecutar las comprobaciones ahora',
    'run_started' => 'Comprobando en segundo plano',
    'run_failed' => 'No se pudieron iniciar las comprobaciones',

    'reset' => 'Olvidar lo que sabe',
    'reset_confirm' => 'Borra lo que dijo cada comprobación la última vez. La siguiente pasada aprende de cero y no envía nada, así que un problema que siga en curso se avisará en la pasada siguiente. Usa esto después de retirar un nodo sobre el que el watchdog sigue insistiendo.',
    'reset_done' => 'Borrado',

    // ---- los mensajes en sí -----------------------------------------------
    'still' => 'Sigue así desde hace :for.',
    'cleared_body' => 'Llevaba así :for.',
    'ports_title' => 'Casi sin puertos para :game',
    'ports_body' => 'Las compras de :game caen en :from a :to, y solo :free de :total siguen libres. Una compra que no encuentra ninguno se paga y luego se rechaza, así que añade allocations en el nodo, o amplía el rango en el paquete, antes de que pase.',
    'ports_none_title' => 'No quedan puertos para :game',
    'ports_none' => 'Las compras de :game caen en :from a :to y los :total están todos ocupados. La siguiente compra de este juego se pagará y luego se rechazará, sin allocation. Añade allocations en el nodo, o amplía el rango en el paquete mismo.',
    'ports_empty_title' => 'No existe ningún puerto para :game',
    'ports_empty' => 'Las compras de :game caen en :from a :to, y no hay ni una allocation en ese rango en ninguno de los nodos que puede usar. Toda compra de este juego se pagará y luego se rechazará. Crea las allocations en el nodo, o amplía el rango en el propio paquete.',
    'ports_cleared' => 'Vuelve a haber puertos libres para :game',

    'for_unknown' => 'un rato',
    'for_minutes' => '{1} un minuto|[2,*] :count minutos',
    'for_hours' => '{1} una hora|[2,*] :count horas',
    'for_days' => '{1} un día|[2,*] :count días',

    'node_down' => ':node no responde',
    'node_down_body' => 'El panel no llega al daemon de :node. Los servidores que hay en él no arrancarán, no se detendrán ni informarán de nada hasta que vuelva.',
    'node_up' => ':node vuelve a responder',

    'node_disk' => 'A :node se le acaba el disco',
    'node_disk_body' => 'El disco de :node está al :percent %, por encima del :limit % que fijaste. Las copias de seguridad y las instalaciones de servidores son lo primero que falla cuando esto llega arriba.',
    'node_disk_over' => 'El disco de :node vuelve a estar por debajo del límite',

    'node_memory' => 'A :node se le acaba la memoria',
    'node_memory_body' => 'La memoria de :node está al :percent %, por encima del :limit % que fijaste. El kernel puede matar los servidores que hay en él antes de que nada avise de un problema.',
    'node_memory_over' => 'La memoria de :node vuelve a estar por debajo del límite',

    'node_maintenance' => ':node lleva mucho tiempo en mantenimiento',
    'node_maintenance_body' => ':node lleva más de :hours horas en mantenimiento. Mientras tanto no se comprueba nada más de él, que es de lo que se trata - pero conviene saber que sigue así.',
    'node_maintenance_over' => ':node ha salido de mantenimiento',

    'wings_behind' => 'Wings en :node está desactualizado',
    'wings_behind_body' => ':node ejecuta Wings :installed y ya está :latest. Actualízalo en el propio nodo - el panel no tiene forma de hacerlo.',
    'wings_current' => 'Wings en :node está al día',

    'panel_behind' => 'El panel está desactualizado',
    'panel_behind_body' => 'Este panel ejecuta :installed y ya está :latest.',
    'panel_current' => 'El panel está al día',

    'and_more' => 'y :count más',


    'owner_down' => '{1} Uno de tus servidores está fuera de línea|[2,*] :count de tus servidores están fuera de línea',
    'owner_down_body' => 'La máquina en la que están ha dejado de responder. Ya se ha avisado a alguien. Afectados: :servers',
    'owner_up' => '{1} Tu servidor ha vuelto|[2,*] :count de tus servidores han vuelto',
    'owner_up_body' => 'La máquina vuelve a responder. De vuelta: :servers',

    'schedules' => 'Tareas programadas que se han parado',
    'schedules_helper' => 'Una tarea atascada a mitad de una ejecución, una cuya hora pasó porque el cron no está en marcha, o una que no se ha ejecutado nunca. Pelican no tiene palabra para ninguna de las tres - una ejecución caída se queda en «procesando» para siempre y se dibuja igual que una que está corriendo ahora. Lee todas las tareas programadas activas del panel en cada comprobación.',

    'schedule_stopped' => '{1} Una tarea programada se ha detenido|[2,*] :count tareas programadas se han detenido',
    'schedule_stopped_body' => 'Atascadas más de :hours horas, vencidas, nunca ejecutadas, o sin ninguna tarea: :schedules',
    'schedule_running' => 'Todas las tareas programadas vuelven a ejecutarse',

    'unbuilt_over' => 'Todos los pedidos pagados tienen su servidor',

    'unbuilt_body' => 'Alguien pagó y no tiene nada. Abre Pedidos y créalos, o mira por qué se rechazaron: :orders',

    'unbuilt' => '{1} Un pedido pagado sin servidor|[2,*] :count pedidos pagados sin servidor',

    'stock_out' => '{1} Un paquete se ha agotado|[2,*] :count paquetes se han agotado',
    'stock_out_body' => 'A la venta, y ya no queda nada que vender: :packages',
    'stock_low' => '{1} Un paquete está casi agotado|[2,*] :count paquetes están casi agotados',
    'stock_low_body' => 'Con :limit o menos por vender: :packages',
    'stock_back' => '{1} Un paquete vuelve a estar a la venta|[2,*] :count paquetes vuelven a estar a la venta',
    'stock_back_body' => 'Vuelve a haber algo que vender: :packages',

    'backup_none' => '{1} Un servidor nunca se ha respaldado|[2,*] :count servidores nunca se han respaldado',
    'backup_none_body' => 'Nunca se ha respaldado nada en: :servers',
    'backup_none_over' => 'Todos los servidores tienen ya una copia',

    'backup_stale' => '{1} Un servidor no se ha respaldado últimamente|[2,*] :count servidores no se han respaldado últimamente',
    'backup_stale_body' => 'Sin ninguna copia correcta en :days días en: :servers',
    'backup_stale_over' => 'Todos los servidores se han respaldado hace poco',

    'backup_failed' => '{1} Las copias fallan en un servidor|[2,*] Las copias fallan en :count servidores',
    'backup_failed_body' => 'Una copia terminó sin éxito en: :servers',
    'backup_failed_over' => 'Ya no falla ninguna copia',

    'worker_missing' => 'No hay nada procesando la cola',
    'worker_missing_body' => 'Se encoló un trabajo y no lo recogió nada. Las actualizaciones de plugins, las instalaciones de modpacks y estas comprobaciones se paran todas hasta que haya un worker en marcha - prueba systemctl status pelican-queue en la máquina del panel.',
    'worker_back' => 'La cola vuelve a procesarse',
    'failed_title' => '{1} Un trabajo ha fallado desde la última comprobación|[2,*] :count trabajos han fallado desde la última comprobación',
    'failed_body' => 'Algo que el panel tenía que hacer no se hizo y no se volverá a intentar - un servidor sin crear, una factura sin escribir, un correo sin enviar. Están en la tabla failed_jobs; con `php artisan queue:retry all` se vuelven a poner en cola, una vez arreglado lo que los paró.',
    'failed_back' => 'No ha fallado nada desde la última comprobación',
    'failed' => 'Avísame cuando falle un trabajo de la cola',
    'failed_helper' => 'Laravel anota un trabajo que ha dado por perdido y no dice nada al respecto. Esto sí lo dice. Contados en vez de listados: veinte fallos en una noche suelen tener una sola causa.',

    'health_interval_off' => 'Las alertas están activadas, pero el intervalo está en Desactivado, así que el vigilante nunca se ejecuta.',
    'health_owners_unwatched' => 'Las alertas a propietarios están activadas, pero el vigilante no se ejecuta, así que los propietarios nunca se enteran de una caída.',
    'health_no_channel' => 'El vigilante se ejecuta, pero todas las formas de avisar a alguien están desactivadas.',
    'health_discord' => 'Las alertas de Discord están activadas, pero no hay ningún webhook https válido guardado.',
    'health_bot' => 'Las alertas del bot están activadas, pero falta la dirección https o el secreto de firma.',
    'health_email' => 'Los correos de alerta están activados, pero no hay ninguna dirección válida, o el correo del panel solo escribe en su registro.',
];
