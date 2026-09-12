<?php

/*
 * Español. Escrito a mano.
 *
 * Cupones: códigos que quitan algo de la primera factura.
 *
 * Solo de la primera, a propósito, y el texto lo dice donde importa. Un código
 * que además descontara cada renovación sería un cambio de precio con fecha de
 * caducidad, y quien quiera eso debería cambiar el precio.
 */

return [
    'title' => 'Cupones',
    'nav_label' => 'Cupones',
    'subheading' => 'Códigos que quitan un porcentaje o un importe de la primera factura. Las renovaciones van al precio del paquete.',

    // ---- la tabla --------------------------------------------------------
    'column_code' => 'Código',
    'column_value' => 'Valor',
    'column_uses' => 'Usado',
    'column_expires' => 'Caduca',
    'column_packages' => 'Se aplica a',
    'column_live' => 'Activo',

    'never_expires' => 'Sin fecha de fin',
    'all_packages' => 'Todo',
    'some_packages' => ':count paquetes',
    'usable' => 'Se puede usar ahora mismo',
    'unusable' => 'Apagado, caducado o agotado',

    // ---- los botones -----------------------------------------------------
    'new' => 'Nuevo cupón',
    'edit' => 'Editar',
    'delete' => 'Eliminar',
    'delete_confirm' => 'Quita el código. Las facturas que ya lo usaron conservan su descuento: cada una guarda lo que se le restó.',
    'deleted' => 'Cupón eliminado',
    'saved' => 'Cupón guardado',
    'save_failed' => 'El cupón no se pudo guardar',
    'taken' => 'Ya hay algo que usa ese código.',
    'invalid' => 'Un porcentaje es un número entero del 1 al 100. Un importe se escribe como 12.50 o 12,50.',

    // ---- el formulario ---------------------------------------------------
    'section_code' => 'El código',
    'section_code_helper' => 'Lo que el cliente escribe al pagar.',
    'code' => 'Código',
    'code_helper' => 'Se guarda y se compara en mayúsculas y sin espacios, para que funcione lo escriba como lo escriba.',
    'live' => 'Activo',
    'live_helper' => 'Apagado deja de funcionar sin borrarlo, con lo que queda fuera de uso mientras el descuento que dio se queda en las facturas que lo tuvieron.',

    'section_worth' => 'Lo que quita',
    'section_worth_helper' => 'Solo de la primera factura. Nunca deja una factura por debajo de cero.',
    'kind' => 'Tipo',
    'kind_helper' => 'Una parte del precio, o un importe fijo.',
    'kind_percent' => 'Porcentaje',
    'kind_fixed' => 'Importe fijo',
    'value' => 'Valor',
    'value_percent_helper' => 'Un número entero del 1 al 100.',
    'value_fixed_helper' => 'En la moneda de la tienda. Escríbelo como 12.50 o 12,50.',

    'section_limits' => 'Límites',
    'section_limits_helper' => 'Todo esto es opcional. Un código sin ninguno de ellos vale para todo, para cualquiera, siempre.',
    'max_uses' => 'Veces que puede usarse',
    'max_uses_helper' => 'Se cuenta al hacer el pedido, no al pagar la factura: de lo contrario un código de diez usos podría gastarse cien veces en una noche.',
    'expires' => 'Caduca',
    'expires_helper' => 'Después de ese momento el código deja de funcionar. Vacío significa que eso no pasa nunca.',
    'packages' => 'Paquetes',
    'packages_helper' => 'Nada marcado significa todos los paquetes, ahora y después.',

    'empty' => 'Todavía no hay cupones',
    'empty_body' => 'Crea uno y funciona al pagar en cuanto esté activo.',
];
