<?php

/*
 * Español. Escrito a mano.
 *
 * Clientes: la tienda, pero mirando a la persona en vez de a la fila.
 *
 * Pedidos, facturas y pagos son cada uno una lista de lo que pasó. Esta página
 * hace la pregunta que de verdad tiene quien está atendiendo un ticket: quién
 * es este, qué tiene, qué ha pagado y qué queda pendiente. Las palabras de
 * aquí están elegidas para ese momento, no para un informe.
 */

return [
    'title' => 'Clientes',
    'nav_label' => 'Clientes',
    'subheading' => 'Todos los que han comprado algo, con lo que tienen, lo que han pagado y lo que queda pendiente.',

    // ---- la tabla --------------------------------------------------------
    'column_customer' => 'Cliente',
    'column_services' => 'Servicios',
    'column_spent' => 'Pagado',
    'column_outstanding' => 'Pendiente',

    'of_orders' => 'de :count pedidos',
    'nothing_owed' => 'Nada',

    'filter_owing' => 'Debe algo',
    'filter_active' => 'Tiene un servicio activo',

    // ---- uno de ellos ----------------------------------------------------
    'open' => 'Abrir',
    'close' => 'Cerrar',
    'servers' => 'Servidores',
    'since' => 'Cliente desde',
    'their_services' => 'Servicios',
    'their_invoices' => 'Facturas',
    'no_services' => 'Nada activo, y nada esperando a crearse.',
    'no_invoices' => 'No se ha escrito ninguna factura para esta cuenta.',

    'empty' => 'Todavía nadie ha comprado nada',
    'empty_body' => 'Aquí salen quienes han pedido, no todo el que tiene cuenta, así que se llena con la primera venta.',
    'who' => 'Quién es',
];
