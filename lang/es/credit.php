<?php

/*
 * Español. Escrito a mano.
 *
 * Saldo, devoluciones y notas de crédito.
 *
 * Abajo se mantienen dos palabras separadas a propósito.
 *
 * El «saldo» es dinero que la tienda guarda para alguien. Se descuenta solo de
 * su próxima factura, antes de que se le llegue a pedir que pague.
 *
 * Una «devolución» es el acto de devolver el dinero, y tiene dos destinos: a la
 * tarjeta de la que salió, o a la cuenta como saldo. El texto dice siempre cuál
 * de los dos, porque un cliente al que le dicen «se te ha devuelto» y luego no
 * encuentra nada en el banco escribe, y con razón.
 *
 * Una «nota de crédito» es el documento. Se escribe en los dos casos, porque es
 * la constancia de que ese dinero ya no se le debe a la tienda - no una
 * afirmación sobre adónde fue.
 */

return [
    // ---- lo que ve un cliente --------------------------------------------
    'yours' => 'Tu saldo',
    'yours_body' => 'Esto se descuenta solo de tu próxima factura. No tienes que hacer nada con ello.',
    'applied' => 'Pagado con tu saldo',
    'payable' => 'Queda por pagar',

    // ---- el libro, en la ventana del cliente -----------------------------
    'held' => 'Saldo',
    'none_held' => 'Nada en la cuenta',
    'movements' => 'Saldo',
    'column' => 'Saldo',
    'none' => 'Nada',

    // ---- dar saldo -------------------------------------------------------
    'give' => 'Saldo',
    'give_helper' => 'Esta cuenta tiene :held. Lo que le pongas se descuenta solo de su próxima factura. Un importe negativo vuelve a quitar saldo, y los dos movimientos quedan en el historial.',
    'amount' => 'Importe',
    'amount_helper' => 'Un importe negativo quita saldo en vez de darlo.',
    'reason' => 'Motivo',
    'reason_helper' => 'El cliente ve esto al lado del importe, así que escríbelo para él y no para el archivo.',
    'given' => ':amount de saldo para :who',
    'bad_amount' => 'Eso no es un importe.',
    'give_failed' => 'El saldo no se dio',
    'give_failed_body' => 'No se escribió nada. Inténtalo otra vez, y mira en el log si sigue pasando.',
    'take_failed' => 'El saldo no se quitó',
    'take_failed_body' => 'Hay menos en la cuenta de lo que pediste quitar. Un saldo nunca baja de cero.',

    // ---- lo que dice un movimiento ---------------------------------------
    'spent_on' => 'Factura :number',
    'returned' => 'Devuelto: la factura para la que era no se pudo escribir',
    'note_line' => 'Nota de crédito de la factura :number',
    'refund_description' => 'Devolución de la factura :number',

    // ---- devolverlo ------------------------------------------------------
    'refund' => 'Devolver',
    'refund_helper' => 'De esta factura quedan :left sin devolver. En cualquiera de los dos casos se escribe una nota de crédito, así que queda constancia por ambas partes.',
    'refund_amount_helper' => 'Una parte también vale. Lo que quede se puede devolver más adelante.',
    'refund_reason_helper' => 'Esto sale impreso en la nota de crédito que el cliente puede abrir.',
    'where' => 'Adónde va el dinero',
    'where_provider' => 'De vuelta por donde pagaron',
    'where_provider_helper' => 'El proveedor lo envía a la tarjeta o la cuenta de la que salió. Puede tardar unos días en aparecer, y pueden negarse - un pago antiguo, o un método que no da marcha atrás.',
    'where_balance' => 'A su cuenta de aquí',
    'where_balance_helper' => 'Se convierte en saldo y se descuenta de su próxima factura. No sale nada del banco, y no puede fallar.',
    'refunded' => 'Se devolvieron :amount',
    'refunded_body' => 'Se escribió la nota de crédito :number.',
    'refund_failed' => 'No se devolvió nada',

    // ---- y por qué no, un motivo por frase -------------------------------
    'refused_off' => 'El saldo y las devoluciones están desactivados en este panel.',
    'refused_amount' => 'Eso es más de lo que queda en esta factura.',
    'refused_no_payment' => 'Ningún pago de esta factura tiene tanto disponible, así que no hay nada que un proveedor pueda revertir. Ponlo en su cuenta en su lugar.',
    'refused_no_gateway' => 'El proveedor con el que se pagó esto ya no está activado, así que no se le puede pedir que revierta nada. Ponlo en su cuenta en su lugar.',
    'refused_refused' => 'El proveedor se negó. Suele ser un pago antiguo o un método que no da marcha atrás; el motivo que dieron está en el log. Ponlo en su cuenta en su lugar.',
    'refused_note_failed' => 'El dinero se movió pero la nota de crédito no se pudo escribir, así que no quedó constancia. Mira en el log antes de volver a intentarlo.',

    // ---- meter dinero ----------------------------------------------------
    'topup' => 'Añadir saldo',
    'topup_helper' => 'Tienes :held en la cuenta. Lo que añadas aquí se descuenta solo de tu próxima factura, y cualquier factura que ya tengas abierta se salda con ello en cuanto llegue.',
    'topup_go' => 'Continuar al pago',
    'topup_amount_helper' => 'Entre :least y :most.',
    'topup_bad' => 'Ese importe no se puede pagar',
    'topup_failed' => 'El pago no se pudo iniciar. Inténtalo otra vez, y avisa a quien lleve este panel si sigue pasando.',
    'topup_line' => 'Saldo añadido a la cuenta',
    'topup_reason' => 'Añadido en la factura :number',

    // ---- dónde se ve -----------------------------------------------------
    'menu' => ':amount de saldo',
    'held_helper' => 'Se descuenta solo de tu próxima factura. Puedes añadir más en la página de facturas.',
];
