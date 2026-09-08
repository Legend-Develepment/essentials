<?php

/*
 * Español. Escrito a mano.
 *
 * Pedidos: lo que alguien compró y en qué acabó.
 *
 * Los cuatro estados de abajo hablan del dinero, no del servidor. Si el
 * servidor está funcionando ahora mismo es la pregunta de Pelican, y se
 * responde en las páginas de Pelican. Las palabras de aquí mantienen las dos
 * cosas separadas.
 */

return [
    'title' => 'Pedidos',
    'nav_label' => 'Pedidos',
    'subheading' => 'Todo lo que se ha comprado, el servidor en que se convirtió y cómo está.',

    // ---- la tabla --------------------------------------------------------
    'column_order' => 'Pedido',
    'column_customer' => 'Cliente',
    'column_package' => 'Paquete',
    'column_server' => 'Servidor',
    'column_state' => 'Estado',
    'column_due' => 'Próximo vencimiento',

    'no_server' => 'Aún no creado',
    'no_due' => 'Pago único',
    'gone_customer' => 'Cuenta eliminada',
    'gone_package' => 'Paquete eliminado',
    'overdue_days' => ':days días de retraso',

    'state_pending' => 'Esperando',
    'state_active' => 'Activo',
    'state_suspended' => 'Suspendido',
    'state_cancelled' => 'Cancelado',

    // ---- los botones -----------------------------------------------------
    'retry' => 'Crear de nuevo',
    'retry_confirm' => 'Vuelve a poner la creación en la cola. No cambia nada más y la factura sigue pagada.',
    'retrying' => 'Puesto en la cola',

    'suspend' => 'Suspender',
    'suspend_confirm' => 'Detiene el servidor con la propia suspensión de Pelican. Archivos, bases de datos y copias de seguridad se quedan donde están, y pagar la factura la levanta.',
    'suspended' => 'Suspendido',

    'unsuspend' => 'Quitar la suspensión',
    'unsuspended' => 'Funciona de nuevo',

    'change_due' => 'Cambiar el vencimiento',
    'change_due_helper' => 'Cuándo se escribe la próxima factura. Vacío significa nunca: el pedido deja de renovarse sin estar cancelado.',

    'cancel' => 'Cancelar',
    'cancel_confirm' => 'Detiene las renovaciones y devuelve el sitio en el inventario. El servidor se deja como está: borrarlo se hace en Pelican, que es donde corresponde.',
    'cancelled' => 'Cancelado',

    'saved' => 'Guardado',
    'refused' => 'No cambió nada',
    'refused_body' => 'El pedido no está en un estado en el que eso se pueda hacer. Recarga la página y míralo otra vez.',

    // ---- lo que oye el cliente -------------------------------------------
    'bell_ready' => 'Tu servidor está listo',
    'bell_ready_body' => ':server se ha creado y espera a que lo arranques.',
    'bell_suspended' => 'Tu servidor ha sido suspendido',
    'bell_suspended_body' => 'Una factura quedó sin pagar más allá del periodo de gracia. Pagarla vuelve a arrancar el servidor; no se ha borrado nada.',

    // ---- lo que oye quien administra -------------------------------------
    'bell_failed' => 'El pedido :number no se pudo crear',
    'no_allocation' => 'Ningún node de este paquete tiene una allocation libre. Añade una y vuelve a crearlo.',
    'no_reason' => 'El panel lo rechazó sin decir por qué.',

    // ---- el servidor que sale de ahí -------------------------------------
    'server_description' => 'Comprado en la tienda, pedido :number.',
    'server_fallback' => 'Servidor',

    'empty' => 'Todavía no se ha comprado nada',
    'empty_body' => 'Los pedidos aparecen aquí en cuanto alguien compra un paquete.',
];
