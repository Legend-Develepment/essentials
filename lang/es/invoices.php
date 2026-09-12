<?php

/*
 * Español. Escrito a mano.
 *
 * Facturas: el documento, la página que las lista y el correo.
 *
 * Tres lectores comparten este archivo. Quien administra lee la tabla y pulsa
 * «marcar como pagada»; un cliente lee el documento imprimible y el correo; y
 * el documento en sí lo lee meses después alguien que lleva la contabilidad.
 * Por eso las líneas doc_ son sobrias y formales: una factura no es el sitio
 * para el tono del resto del panel.
 */

return [
    'title' => 'Facturas',
    'nav_label' => 'Facturas',
    'subheading' => 'Lo que se debe y lo que se ha pagado. Marcar una como pagada aquí hace todo lo que haría pagarla: se crea el servidor, uno suspendido vuelve.',

    // ---- la tabla --------------------------------------------------------
    'column_number' => 'Factura',
    'column_customer' => 'Cliente',
    'column_order' => 'Pedido',
    'column_total' => 'Total',
    'column_state' => 'Estado',
    'column_due' => 'Vence',

    'kind_order' => 'Primera factura',
    'kind_renewal' => 'Renovación',
    'kind_credit' => 'Nota de crédito',
    'kind_upgrade' => 'Cambio de paquete',
    'kind_topup' => 'Añadir saldo',
    'kind_addon' => 'Extra',

    'state_unpaid' => 'Sin pagar',
    'state_paid' => 'Pagada',
    'state_cancelled' => 'Retirada',

    'no_order' => 'Sin pedido',
    'order_count' => ':count servicios',
    'no_due' => 'Sin fecha',
    'gone_customer' => 'Cuenta eliminada',
    'discount_of' => ':amount de descuento con :code',
    'paid_via' => 'por :how',
    'column_attempts' => 'Pago',
    'paid_by' => 'pagada: :how',
    'paid_by_unknown' => 'pagada',
    'paid_by_manual' => 'a mano',
    'paid_by_free' => 'nada que pagar',
    'attempts_none' => 'ningún intento',
    'attempts_open' => ':count intento(s) - :how',
    'attempt_last' => 'último :when, :state',
    'attempt_open' => 'sin terminar',
    'attempt_paid' => 'pagado',
    'attempt_cancelled' => 'cancelado',
    'attempt_failed' => 'fallido',
    'emailed' => 'Enviada',
    'not_emailed' => 'No enviada',
    'filter_overdue' => 'Vencidas',

    // ---- los botones -----------------------------------------------------
    'open' => 'Abrir',
    'mark_paid' => 'Marcar como pagada',
    'mark_paid_confirm' => 'Deja constancia de que el dinero llegó. Se crea el servidor, uno suspendido vuelve a arrancar y el próximo vencimiento avanza, igual que si lo hubiera dicho una pasarela de pago.',
    'paid' => 'Marcada como pagada',
    'paid_body' => 'Todo lo que esperaba a esta factura ya está en camino.',
    'already_paid' => 'Ya estaba pagada',

    'withdraw' => 'Retirar',
    'withdraw_confirm' => 'Saca la factura de los libros. Solo puede retirarse una sin pagar; una factura pagada es la constancia de un dinero que cambió de manos.',
    'withdrawn' => 'Retirada',
    'withdraw_refused' => 'Solo se puede retirar una factura sin pagar',

    'empty' => 'Todavía no hay facturas',
    'empty_body' => 'Se escribe una en cuanto alguien compra, y otra cada periodo para todo lo que se renueva.',

    // ---- el documento ----------------------------------------------------
    'doc_title' => 'Factura',
    'doc_number' => 'Número',
    'doc_issued' => 'Emitida',
    'doc_due' => 'Vencimiento',
    'doc_paid_on' => 'Pagada',
    'doc_billed_to' => 'Facturada a',
    'doc_from' => 'De',
    'doc_vat' => 'NIF-IVA',
    'doc_coc' => 'Cámara de Comercio',
    'doc_description' => 'Concepto',
    'doc_amount' => 'Importe',
    'doc_subtotal' => 'Subtotal',
    'doc_discount' => 'Descuento',
    'doc_total' => 'Total',
    'doc_how_to_pay' => 'Cómo pagar',
    'doc_print' => 'Imprimir o guardar como PDF',
    'doc_back' => 'Volver al panel',

    // ---- el correo -------------------------------------------------------
    'mail_subject' => 'Factura :number',
    'mail_hello' => 'Hola :name:',
    'mail_intro' => 'Aquí tienes la factura :number.',
    'mail_open' => 'Abrir la factura',
    'mail_foot' => 'Puedes releer esta factura cuando quieras en tu página de facturación.',

    // ---- la campana ------------------------------------------------------
    'bell_new' => 'Factura :number',
    'bell_new_body' => 'Quedan :total por pagar. Abre tu página de facturación para pagarla.',
    'bell_reminder' => 'La factura :number ha vencido',
    'bell_reminder_body' => 'Sigue abierta por :total. El servidor que paga se detiene el :date si para entonces no se ha pagado, y no se borra nada de lo que hay en él cuando eso pasa.',
];
