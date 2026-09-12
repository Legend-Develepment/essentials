<?php

/*
 * Español. Escrito a mano.
 *
 * Mover un servicio en marcha de un paquete a otro.
 *
 * Los textos mantienen una cosa clara de principio a fin: lo que cuesta un
 * paquete y lo que cuesta cambiarse a él hoy son dos cifras distintas. La
 * primera está en el escaparate; la segunda depende de por dónde va este
 * servicio dentro del periodo pagado, y es la que alguien acepta al pulsar el
 * botón.
 *
 * La palabra «mejora» se evita en lo que lee un cliente, porque la mitad de
 * estos movimientos van en la otra dirección. Aquí se llama cambio.
 */

return [
    // ---- en la tarjeta del servicio --------------------------------------
    'change' => 'Cambiar de paquete',
    'change_body' => 'Lo que queda del periodo que ya has pagado se descuenta, y esos mismos días se cobran al precio nuevo. No se pierde nada de tu servidor.',
    'change_to' => 'Cambiar a :name',
    'change_confirm' => '¿Cambiar este servicio a :name?',
    'change_free' => 'Nada que pagar',
    'costs_now' => ':amount ahora',
    'gives_back' => ':amount de vuelta',
    'waiting' => 'Cambio acordado',
    'waiting_for' => 'Un cambio a :name está esperando a una factura sin pagar.',

    // ---- lo que pasa después ---------------------------------------------
    'done' => 'Movido a :name',
    'done_body' => 'Tu servicio está en el paquete nuevo. Lo que se te debía está en tu cuenta.',
    'refused' => 'El cambio no se hizo',

    // ---- y por qué no, un motivo por frase -------------------------------
    'refused_off' => 'Cambiar de paquete está desactivado en este panel.',
    'refused_not_active' => 'Solo se puede cambiar un servicio activo. Uno que está esperando, suspendido o finalizando no tiene nada que ajustar.',
    'refused_gone' => 'El paquete en el que está este servicio ya no existe, así que no hay nada con lo que compararlo.',
    'refused_same' => 'Ese es el paquete en el que ya está.',
    'refused_egg' => 'Ese paquete ejecuta otro software. Sería otro servidor y no uno más grande, así que hay que comprarlo como tal.',
    'refused_period' => 'Ese paquete se factura por otro periodo, y eso es otro acuerdo y no uno más grande.',
    'refused_stock' => 'Ese paquete está agotado.',
    'refused_waiting' => 'Ya hay un cambio esperando a una factura sin pagar para este servicio. Paga o cancela esa primero.',
    'refused_failed' => 'No se escribió nada, así que nada ha cambiado. Inténtalo otra vez, y avisa a quien lleve este panel si sigue pasando.',
    'refused_server' => 'Al servidor no se le pudieron dar los límites nuevos, así que el servicio se quedó exactamente como estaba. Ya se ha avisado a quien lleva este panel.',

    // ---- lo que dicen los documentos -------------------------------------
    'line' => 'Cambio de :from a :to, por los :days días que quedan de este periodo',
    'credit_reason' => 'Cambio a :name',

    // ---- y lo que se le cuenta al dueño ----------------------------------
    'bell_failed' => 'Falló un cambio de paquete en el pedido :number',
    'cold_title' => 'Un cambio de paquete llegó al panel pero no al node, en el pedido :number',
    'cold_body' => 'El servicio está en :name y los límites nuevos están anotados. El node todavía no los ha cogido y los leerá la próxima vez que arranque ese servidor, así que hasta entonces el cliente sigue con el tamaño antiguo. Revisa el node.',
    'gone' => 'El paquete al que se estaba moviendo ya no existe.',
    'refused_by_node' => 'El servidor no aceptó los límites nuevos: :why',

    // ---- arreglarlo ------------------------------------------------------
    'retry' => 'Reintentar el cambio',
    'retry_confirm' => 'Vuelve a intentar el cambio de paquete. Su factura ya está pagada, así que no se cobra nada dos veces.',
    'retried' => 'El cambio salió adelante',
    'retry_failed' => 'Ha vuelto a fallar. El motivo está en el pedido.',
];
