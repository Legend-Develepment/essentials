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
    'state_ending' => 'Finalizando',
    'ends_on' => 'Termina el :date',
    'no_more_dues' => 'No se vuelve a facturar',
    'cancel_confirm_open' => 'Detiene ahora las renovaciones y devuelve el sitio en el inventario. El servidor se queda funcionando: este paquete no tiene permanencia mínima, así que no hay fecha hasta la que llegar. Borra el servidor en Pelican cuando el cliente ya no lo necesite.',
    'terminate' => 'Parar y borrar',
    'terminate_heading' => '¿Borrar este servidor?',
    'terminate_confirm' => 'El servidor se borra ahora, con sus archivos, sus bases de datos y sus copias de seguridad. No hay vuelta atrás ni espera a que termine el contrato. Cancela en su lugar si el cliente debe conservarlo hasta la fecha que se le dio.',
    'terminate_go' => 'Borrarlo',
    'terminated' => 'Borrado',
    'terminated_body' => 'El servidor ya no está y el pedido queda cerrado.',
    'bell_ending' => 'Tu :package termina el :date',
    'bell_ending_open' => 'Tu :package ha sido cancelado',
    'bell_ending_body' => 'No se te volverá a facturar por él. Todo lo que haya en el servidor se borra cuando se detiene, así que copia lo que quieras conservar.',
    'bell_ended' => 'Tu :package ha terminado',
    'bell_ended_body' => 'El contrato ha llegado a su fin y el servidor se ha borrado.',
    'bell_undeleted' => 'El pedido :number no se pudo borrar',
    'bell_undeleted_body' => 'El panel se negó a borrar el servidor. El pedido queda cerrado y no se le facturará a nadie, pero el servidor sigue ahí y hay que quitarlo en Pelican.',
    'bell_undelivered' => 'El archivo del pedido :number sigue aquí',
    'bell_undelivered_body' => 'El servidor se creó, pero el archivo que subió el cliente no se pudo meter en él. Sigue en el almacenamiento del panel, y el motivo está en storage/logs.',
    'details' => 'Detalles',
    'details_of' => 'Pedido :number',
    'close' => 'Cerrar',
    'detail_package' => 'Paquete',
    'detail_placed' => 'Comprado',
    'detail_built' => 'Servidor creado',
    'detail_due' => 'Próximo vencimiento',
    'detail_ends' => 'Termina',
    'detail_suspended' => 'Suspendido',
    'detail_cancelled' => 'Cancelado',
    'detail_file_in' => 'Archivo metido',
    'detail_file_waiting' => 'Archivo',
    'detail_file_waiting_value' => 'Subido, esperando a que se cree el servidor.',
    'detail_note' => 'Último problema',

    'empty' => 'Todavía no se ha comprado nada',
    'empty_body' => 'Los pedidos aparecen aquí en cuanto alguien compra un paquete.',

    // ---- renovaciones ----------------------------------------------------
    'filter_late' => 'Con una factura atrasada',
    'run_renewals' => 'Ejecutar renovaciones ahora',
    'run_renewals_confirm' => 'Hace lo que hace la pasada nocturna: escribe la siguiente factura de todo lo que vence pronto, y detiene los servidores detrás de una factura que quedó sin pagar pasado el periodo de gracia.',
    'renewals_queued' => 'Puesto en la cola',
    'renewals_queued_body' => 'Se ejecuta en la cola. Recarga en un momento para ver qué ha cambiado.',
];
