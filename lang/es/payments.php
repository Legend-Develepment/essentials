<?php

/*
 * Español. Escrito a mano.
 *
 * Pagos: cada intento de pagar y lo que dijo la pasarela al respecto.
 *
 * Una fila por intento en vez de por factura, porque eso es lo que pasó. La
 * palabra que esta página repite es «intento»: un pago que falló es un hecho
 * que vale la pena guardar, no un error que esconder.
 */

return [
    'title' => 'Pagos',
    'nav_label' => 'Pagos',
    'subheading' => 'Cada intento de pago, por cada pasarela. Volver a comprobar se lo pregunta otra vez a la pasarela, que es lo mismo que hace su webhook cuando llega.',

    // ---- la tabla --------------------------------------------------------
    'column_invoice' => 'Factura',
    'column_gateway' => 'Pasarela',
    'column_reference' => 'Su referencia',
    'column_amount' => 'Importe',
    'column_state' => 'Estado',
    'column_updated' => 'Última noticia',

    'gone_invoice' => 'Factura eliminada',

    'state_open' => 'Esperando',
    'state_paid' => 'Pagado',
    'state_failed' => 'Fallido',
    'state_cancelled' => 'Abandonado',

    // ---- los botones -----------------------------------------------------
    'recheck' => 'Volver a comprobar',
    'rechecked' => 'Preguntado otra vez',
    'rechecked_body' => 'La pasarela sigue sin decir que está pagado. No ha cambiado nada.',
    'settled' => 'Está pagado',
    'settled_body' => 'La factura queda saldada y todo lo que la esperaba va en camino.',
    'recheck_failed' => 'No se pudo preguntar',
    'recheck_failed_body' => 'La pasarela no respondió. Inténtalo dentro de un minuto; si sigue pasando, revisa la clave en la página Ajustes de la tienda.',
    'no_gateway' => 'Esa pasarela está apagada',
    'no_gateway_body' => 'Vuelve a encenderla para preguntar por este pago, o marca la factura como pagada a mano.',

    'answer' => 'Su respuesta',
    'no_answer' => 'Nada registrado',
    'close' => 'Cerrar',

    'empty' => 'Todavía nadie ha pagado por una pasarela',
    'empty_body' => 'Los intentos aparecen aquí en cuanto alguien pulsa Pagar, lleguen a término o no.',
];
