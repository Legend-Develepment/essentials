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
    'subheading' => 'Claves que permiten a algo de fuera del panel preguntar lo que este plugin sabe. Solo lectura — nada de aquí puede arrancar, detener ni alcanzar un servidor.',

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
    'once_body' => 'Se guarda como un hash, así que nadie — tampoco quien lleva este panel — puede volver a leerla. Pégala ahora donde el bot o el script la lee. Si se pierde, revoca esta y pide otra.',
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
    'scope_panel_helper' => 'Responde a las preguntas de todo el panel — cada nodo, la capacidad, el watchdog, la propia máquina del panel. Para un bot que informa sobre el panel más que para una persona.',

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
    'grant_confirm' => 'Emite una clave que responde por los servidores propios de esta persona, y la muestra una vez. Ella ya puede ver todo lo que la clave informará — esto decide si algo de fuera del panel puede preguntar en su nombre.',
    'granted' => 'Concedida',

    'refuse' => 'Rechazar',
    'refuse_answer' => 'Qué decirle',
    'refuse_answer_helper' => 'Opcional, y se muestra en su propia página. Un rechazo sin motivo es un rechazo que se vuelve a pedir la semana que viene.',
    'refused' => 'Rechazada',

    'revoke' => 'Revocar',
    'revoke_confirm' => 'La clave deja de responder al momento y su hash se elimina, así que no se puede recuperar. Todo lo que la use se para. Pide una nueva en vez de intentar deshacer esto.',
    'revoked' => 'Revocada',

    'mint' => 'Clave nueva',
    'mint_body' => 'Para un bot y no para una persona. Se concede en el mismo momento en que se crea, porque tú eres quien la habría aprobado.',
    'mint_owner' => 'De quién es',
    'mint_owner_helper' => 'Una clave responde como alguien. Para una clave de todo el panel eso es solo quién responde por ella; para una personal es además lo que la clave puede ver.',
    'minted' => 'Creada',

    // ---- lo que ajusta un administrador ----------------------------------
    'settings' => 'Cómo funciona esto',
    'approval' => 'Las peticiones esperan a que se concedan',
    'approval_helper' => 'Encendido, quien pide una clave la recibe cuando alguien dice que sí. Apagado, la recibe al momento — lo cual es razonable en un panel donde todo el que tiene cuenta ya es de confianza, y merece elegirse en vez de acabar ahí sin más.',
    'rate' => 'Peticiones por minuto, por clave',
    'rate_helper' => 'Un bot que pregunta a cuarenta servidores quién está jugando son cuarenta preguntas a cuarenta servidores de juego. Este es el techo que impide que un bucle escrito a las tres de la mañana se convierta en una prueba de carga.',
    'days' => 'Una clave concedida dura',
    'days_helper' => 'En días. Cero significa hasta que se revoque, que es lo predeterminado — una clave que caduca mientras nadie mira es un bot que se para de madrugada sin que nada en ningún sitio diga por qué.',
    'days_never' => 'Hasta que se revoque',

    /*
     * Dicho en la página en vez de dejarlo para que se descubra. Pelican revierte
     * las migraciones de un plugin cuando se desinstala, y la única tabla de este
     * plugin se va con ellas.
     */
    'uninstall_note' => 'Quitar este plugin quita con él todas las claves. Es a propósito — una clave que sobrevive a aquello que la responde es una credencial que ya nadie puede revocar.',
];
