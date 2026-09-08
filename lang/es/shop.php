<?php

/*
 * Español. Escrito a mano.
 *
 * Los ajustes de la tienda, y más adelante la tienda misma.
 *
 * Dos lectores comparten este archivo a propósito. La mitad de ajustes la lee
 * el administrador; las mitades pública y de cliente - que se añaden conforme
 * crece la tienda - las lee gente que quizá nunca haya oído hablar de Pelican,
 * y cada frase ahí tiene que estar escrita para ellos.
 */

return [
    'title' => 'Ajustes de la tienda',
    'nav_label' => 'Ajustes de la tienda',
    'subheading' => 'La moneda, el impuesto, cómo se numeran las facturas y qué dice la página pública. Lo que está a la venta está en la página Paquetes.',

    // ---- dónde está ------------------------------------------------------
    'address' => 'La tienda pública está en',
    'address_off' => 'La página pública está desactivada. Activa «Página pública de la tienda» en la lista de funciones de la página Ajustes de Essentials y responderá en :url.',

    // ---- general ---------------------------------------------------------
    'section_general' => 'Dinero',
    'section_general_helper' => 'Una moneda para toda la tienda. Cada precio de cada paquete es un número en ella.',
    'currency' => 'Moneda',
    'currency_helper' => 'Cambiarla no convierte nada: los precios de los paquetes son números, y tras un cambio son números en la nueva moneda.',
    'tax' => 'Impuesto',
    'tax_helper' => 'Un porcentaje añadido a cada factura como línea propia. Los precios de los paquetes son sin impuestos. Cero para ninguno.',
    'tax_suffix' => '%',
    'prefix' => 'Los números de factura empiezan por',
    'prefix_helper' => 'Seguido de un número que va subiendo. INV- da INV-000001.',

    // ---- renovaciones ----------------------------------------------------
    'section_renewals' => 'Renovaciones',
    'section_renewals_helper' => 'Para paquetes facturados por mes, trimestre o año. Un paquete de pago único nunca se ve afectado por esto.',
    'notice_days' => 'Facturar estos días antes de que termine el periodo',
    'notice_days_helper' => 'Cuándo se crea la siguiente factura y se avisa al cliente.',
    'grace' => 'Suspender estos días después del vencimiento de una factura',
    'grace_helper' => 'Una factura impagada pasado esto suspende el servidor — la suspensión propia de Pelican, levantada en cuanto se paga la factura. La tienda nunca elimina nada.',
    'days' => 'días',

    // ---- la página pública -----------------------------------------------
    'section_public' => 'La página pública',
    'section_public_helper' => 'La lee gente sin cuenta. Si se sirve o no es el interruptor «Página pública de la tienda» de la lista de funciones.',
    'heading' => 'Título',
    'heading_helper' => 'Dejado vacío, se usa el nombre del propio panel.',
    'note' => 'Una línea sobre los paquetes',
    'note_helper' => 'Para decir quién eres, o qué obtiene alguien al comprar. Texto sin formato.',
    'terms_url' => 'Condiciones',
    'terms_url_helper' => 'Una dirección https. Si está puesta, comprar implica marcar una casilla que apunta a ella.',

    // ---- pagar a mano ----------------------------------------------------
    'section_manual' => 'Pagar sin proveedor',
    'section_manual_helper' => 'Se muestra en una factura impagada mientras no haya ningún proveedor de pago activado: datos bancarios, o adónde enviar el dinero. Texto sin formato.',
    'pay_note' => 'Cómo pagar',
    'pay_note_helper' => 'Déjalo vacío y una factura impagada solo dice que está impagada.',

    // ---- los botones -----------------------------------------------------
    'save' => 'Guardar',
    'saved' => 'Guardado',
    'save_failed' => 'No se ha guardado nada',
];
