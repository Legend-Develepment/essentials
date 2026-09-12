<?php

/*
 * Español. Escrito a mano.
 *
 * Una entrada desde fuera del panel.
 *
 * Dos públicos en un solo archivo, y quieren lo contrario. Un administrador que
 * lee esta página está decidiendo si le confía una clave a alguien, así que
 * cada línea dice lo que una clave alcanza y no cómo se llama. Quien pide una
 * quiere saber qué le entregan y qué pasa si la pierde, y por eso la frase
 * sobre que una clave se muestra una sola vez no es una nota al pie.
 *
 * En ningún sitio se dice «token». «Clave» es la palabra de la página de cuenta
 * del propio Pelican, y un panel que llama a lo mismo de dos maneras es un
 * panel donde alguien busca la equivocada.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Claves que permiten a algo de fuera del panel preguntar lo que este plugin sabe. Solo lectura - nada de aquí puede arrancar, detener ni alcanzar un servidor.',

    'my_title' => 'Acceso a la API',
    'my_nav_label' => 'Acceso a la API',
    'my_subheading' => 'Una clave tuya, para un bot o un script. Solo responde por los servidores que ya puedes abrir.',

    // ---- qué es una clave, dicho una vez, donde importa ------------------
    'address' => 'La dirección',
    'address_helper' => 'Envía la clave como cabecera Authorization: :example',

    /*
     * Lo único que alguien tiene que haber leído antes de cerrar el cuadro.
     * Escrito como lo que hay que hacer y no como una advertencia, porque
     * «guárdala bien» es un consejo con el que nadie puede hacer nada y «pégala
     * ahora donde el bot la lee» sí.
     */
    'once' => 'Esta es la única vez que se muestra esta clave',
    'once_body' => 'Se guarda como un hash, así que nadie - tampoco quien lleva este panel - puede volver a leerla. Pégala ahora donde el bot o el script la lee. Si se pierde, revoca esta y pide otra.',
    'copy' => 'Copiar',
    'copied' => 'Copiada',

    // ---- los estados -----------------------------------------------------
    'state' => 'Estado',
    'state_pending' => 'Esperando',
    'state_active' => 'Activa',
    'state_refused' => 'Rechazada',
    'state_revoked' => 'Revocada',

    'state_pending_body' => 'Alguien tiene que concederla antes de que responda a nada.',
    'state_refused_body' => 'Esto se denegó. No se emitió nada.',
    'state_revoked_body' => 'Esta clave se ha retirado y ya no responde.',

    // ---- los alcances ----------------------------------------------------
    'scope' => 'Alcanza',
    'scope_person' => 'Sus propios servidores',
    'scope_panel' => 'Todo el panel',

    'scope_person_helper' => 'Solo responde por los servidores que su dueño ya puede abrir, preguntado igual que lo pregunta el panel. Perder esta clave no pierde nada que su dueño no pudiera ver ya.',
    'scope_panel_helper' => 'Responde a las preguntas de todo el panel - cada nodo, la capacidad, el watchdog, la propia máquina del panel. Para un bot que informa sobre el panel más que para una persona.',

    // ---- la tabla --------------------------------------------------------
    'column_name' => 'Para qué',
    'column_owner' => 'De quién',
    'column_prefix' => 'Clave',
    'column_asked' => 'Pedida',
    'column_used' => 'Último uso',
    'column_expires' => 'Caduca',

    'never_used' => 'Nunca',
    'no_expiry' => 'Hasta que se revoque',

    'tab_waiting' => 'Esperando',
    'tab_active' => 'Activas',
    'tab_all' => 'Todas',

    'empty' => 'Aún no hay claves',
    'empty_body' => 'Nadie ha pedido ninguna y no se ha emitido ninguna. Esta página se va llenando sola conforme la gente lo hace.',

    'my_empty' => 'No tienes ninguna clave',
    'my_empty_body' => 'Pide una y aparecerá aquí con lo que sea que se le haya respondido.',

    // ---- pedir -----------------------------------------------------------
    'ask' => 'Pedir una clave',
    'ask_name' => 'Para qué es',
    'ask_name_helper' => 'Unas pocas palabras, para que luego distingas dos tuyas y quien la conceda sepa qué está concediendo.',
    'ask_reason' => 'Algo que valga la pena añadir',
    'ask_reason_helper' => 'Opcional. Lo lee quien decide.',
    'ask_sent' => 'Pedida',
    'ask_sent_body' => 'Aparece abajo en cuanto alguien haya respondido.',
    'ask_granted' => 'Aquí está tu clave',
    'ask_open' => 'Ya tienes una esperando respuesta',
    'ask_open_body' => 'Una petición cada vez. Cancela aquella si fue un error.',
    'ask_failed' => 'Eso no se pudo pedir',

    'cancel' => 'Cancelar',
    'cancel_confirm' => 'Retira la petición. No se emitió nada, así que tampoco deja de funcionar nada.',

    // ---- decidir ---------------------------------------------------------
    'grant' => 'Conceder',
    'grant_confirm' => 'Emite una clave que responde por los servidores propios de esta persona, y la muestra una vez. Ella ya puede ver todo lo que la clave informará - esto decide si algo de fuera del panel puede preguntar en su nombre.',
    'granted' => 'Concedida',

    'refuse' => 'Rechazar',
    'refuse_answer' => 'Qué decirle',
    'refuse_answer_helper' => 'Opcional, y se muestra en su propia página. Un rechazo sin motivo es un rechazo que se vuelve a pedir la semana que viene.',
    'refused' => 'Rechazada',
    'collect' => 'Mostrar mi clave',
    'state_ready_body' => 'Concedida. Pulsa Mostrar mi clave para verla - una vez, porque se guarda como un hash y después no se puede volver a leer.',
    'replace' => 'Sustituir',
    'replace_confirm' => 'Esta clave deja de funcionar al momento y otra nueva ocupa su lugar, mostrada una sola vez. La antigua no se puede consultar en ningún sitio, porque nunca se guardó: sustituirla es la única respuesta a haberla perdido.',
    'granted_body' => 'La recogen ellos mismos en su propia página de Acceso a la API. Aquí no se muestra: una clave es de quien la pidió, no de quien dijo que sí.',

    'revoke' => 'Revocar',
    'revoke_confirm' => 'La clave deja de responder al momento y su hash se elimina, así que no se puede recuperar. Todo lo que la use se para. Pide una nueva en vez de intentar deshacer esto.',
    'revoked' => 'Revocada',
    'forget' => 'Quitar',
    'forget_confirm' => 'Saca la fila de esta página para siempre. Ya ha dejado de responder, así que no se para nada que funcione - esto solo borra la constancia de que existió.',
    'forgotten' => 'Quitada',

    'mint' => 'Clave nueva',
    'mint_body' => 'Para un bot y no para una persona. Se concede en el mismo momento en que se crea, porque tú eres quien la habría aprobado.',
    'abilities' => 'Sobre qué puede preguntar',
    'abilities_helper' => 'Al principio está todo marcado, porque eso era una clave antes de que existiera esto. Desmarcar es el acto deliberado. Lo que se guarda es la lista de lo permitido, así que una capacidad añadida en una versión posterior está apagada para las claves creadas antes - una capacidad que nadie marcó es una capacidad que nadie concedió.',
    'ability_health' => 'Demostrar que la clave funciona',
    'ability_health_helper' => 'No alcanza nada más. Se puede llamar sin problema a intervalos.',
    'ability_me' => 'Sus propios servidores',
    'ability_me_helper' => 'Los servidores que su dueño ya puede abrir, y sus copias de seguridad. Nunca puede ver los de nadie más.',
    'ability_panel' => 'Todo el panel',
    'ability_panel_helper' => 'Cada nodo, cada copia de seguridad, las tareas programadas paradas, el watchdog y la máquina del panel. Necesita además una clave de todo el panel.',
    'ability_live' => 'Preguntar a un servidor directamente',
    'ability_live_helper' => 'Quién está jugando, y si un servidor está funcionando. Las únicas preguntas que cuestan algo - alcanzan un servidor de juego o un daemon, con quince o veinte segundos de caché.',
    'ability_connect' => 'Enlazar cuentas de Discord con cuentas del panel',
    'ability_connect_helper' => 'El único grupo que no es una lectura. Crea claves de la API de Pelican en las cuentas de quienes lo piden y puede terminar una conexión. Dásela solo al bot que la necesita.',
    'own_rate' => 'Peticiones por minuto para esta clave',
    'own_rate_helper' => 'Déjalo vacío para seguir el ajuste del panel. Un número aquí vale solo para esta clave. Cero significa ningún techo - razonable para un bot en tu propia máquina, y una manera segura de arrepentirse si la clave acaba en otro sitio.',
    'own_rate_default' => 'Sigue al panel',
    'mint_owner' => 'De quién es',
    'mint_owner_helper' => 'Una clave responde como alguien. Para una clave de todo el panel eso es solo quién responde por ella; para una personal es además lo que la clave puede ver.',
    'minted' => 'Creada',
    'profile_tab' => 'API de Essentials',
    'profile_make' => 'Una clave para la API de Essentials',
    'profile_make_helper' => 'Una API distinta de la de arriba: esta responde lo que sabe este plugin - cuál de tus servidores no tiene copia de seguridad, quién está jugando en ellos, si están funcionando. Responde siempre solo por ti y alcanza solo los servidores que ya puedes abrir.',
    'profile_create' => 'Crear',
    'profile_yours' => 'Tus claves de Essentials',
    'profile_manage' => 'Revocar una clave, ver por qué se rechazó alguna y conectar Discord están todos en la página Acceso a la API de la barra lateral.',
    'discord' => 'Discord',
    'discord_body' => 'Enlaza tu cuenta de Discord con esta, para que un bot pueda responder por tus servidores cuando se lo pidas. Lo que recibe es una clave que alcanza exactamente lo que alcanzas tú y nada más.',
    'discord_connect' => 'Conectar Discord',
    'discord_code' => 'Escribe esto en Discord antes de diez minutos',
    'discord_code_body' => 'Envía :command en un canal que el bot pueda leer. El código sirve una vez. Nadie puede usarlo salvo la cuenta para la que se hizo.',
    'discord_on' => 'Conectado como :name',
    'discord_since' => 'Desde :when',
    'discord_cut' => 'Desconectado',
    'discord_cut_confirm' => 'Termina la conexión y borra la clave que creó, así que el bot deja de responder por ti al momento. Puedes volver a conectarte cuando quieras.',
    'discord_off' => 'Sin conectar',
    'discord_key_note' => 'Conectar crea en tu cuenta una clave de la API de Pelican llamada Discord (Essentials). Puedes verla y revocarla en Cuenta → Claves de API - esta página es solo un atajo a lo mismo.',
    'docs_title' => 'Cómo se usa esta API',
    'docs_subheading' => 'A qué responde este panel, en las direcciones en las que responde. Escrito a partir de la misma descripción con la que se construye la API, así que no puede quedarse una versión por detrás.',
    'docs_base' => 'Dónde vive',
    'docs_endpoints' => 'Puntos de acceso',
    'docs_answers' => 'Qué devuelve',
    'docs_calls' => 'Claves que pueden llamarlo',
    'docs_params' => 'Qué enviar',
    'docs_required' => 'obligatorio',
    'docs_optional' => 'opcional',
    'docs_try' => 'Probarlo',
    'docs_errors' => 'Cuando algo va mal',
    'docs_hook' => 'Lo que el panel te envía',
    'docs_hook_body' => 'La otra dirección, y lo único de todo esto que llega sin haberlo pedido. Se enciende en Avisos con una dirección y un secreto de firma: un envío JSON cuando el watchdog encuentra algo y otro cuando se resuelve, para que un bot se entere de un nodo caído en vez de preguntar cada minuto si hay alguno.',
    'docs_hook_verify' => 'El cuerpo se pasa por hash con tu secreto y el hash viaja en X-Essentials-Signature como sha256=<hex>. Pasa por hash el cuerpo en bruto, no un objeto vuelto a serializar - cualquier diferencia en los espacios o en el orden de las claves da otro hash, y el desajuste se lee como un ataque y no como un fallo.',
    'docs_download_md' => 'Descargar como Markdown',
    'docs_download_json' => 'Descargar como OpenAPI',

    // ---- lo que ajusta un administrador ----------------------------------
    'settings' => 'Cómo funciona esto',
    'approval' => 'Las peticiones esperan a que se concedan',
    'approval_helper' => 'Encendido, quien pide una clave la recibe cuando alguien dice que sí. Apagado, la recibe al momento - lo cual es razonable en un panel donde todo el que tiene cuenta ya es de confianza, y merece elegirse en vez de acabar ahí sin más.',
    'rate' => 'Peticiones por minuto, por clave',
    'rate_helper' => 'Un bot que pregunta a cuarenta servidores quién está jugando son cuarenta preguntas a cuarenta servidores de juego. Este es el techo que impide que un bucle escrito a las tres de la mañana se convierta en una prueba de carga.',
    'days' => 'Una clave concedida dura',
    'days_helper' => 'En días. Cero significa hasta que se revoque, que es lo predeterminado - una clave que caduca mientras nadie mira es un bot que se para de madrugada sin que nada en ningún sitio diga por qué.',
    'days_never' => 'Hasta que se revoque',
    'hide_pelican' => 'Quitar la pestaña de claves de API del propio panel',
    'hide_pelican_helper' => 'Saca del perfil de la cuenta la pestaña Claves de API por completo, para que en esa página solo haya una cosa llamada Claves de API. Se quita de la página en vez de taparla, así que no queda ninguna dirección que llegue a ella. Una cosa no puede hacer: la propia API de cliente del panel seguirá creando una clave de cuenta para lo que se la pida directamente - la pestaña es donde la gente crea una a mano, y esto quita la mano. Las claves que ya existen siguen funcionando.',

    /*
     * Dicho en la página en vez de dejarlo para que se descubra. Pelican revierte
     * las migraciones de un plugin cuando se desinstala, y la única tabla de este
     * plugin se va con ellas.
     */
    'uninstall_note' => 'Quitar este plugin quita con él todas las claves. Es a propósito - una clave que sobrevive a aquello que la responde es una credencial que ya nadie puede revocar.',
];
