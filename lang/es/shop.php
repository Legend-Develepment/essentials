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

    /* ---------------------------------------------------------------------
     * La tienda en sí, de aquí para abajo.
     *
     * Un lector completamente distinto: alguien que compra un servidor, que
     * quizá nunca haya oído hablar de Pelican y no sabe qué es un egg. Nada de
     * lo de abajo usa las palabras del panel, y cada frase responde a la
     * pregunta que un cliente se hace de verdad en ese punto de la página.
     * ------------------------------------------------------------------- */

    // ---- la tienda -------------------------------------------------------
    'store_title' => 'Tienda',
    'store_nav_label' => 'Tienda',
    'store_subheading' => 'Elige un servidor. Se crea para ti en cuanto la factura esté pagada.',
    'store_empty' => 'Ahora mismo no hay nada a la venta',
    'store_empty_body' => 'Vuelve más tarde, o pregunta a quien lleva este panel.',

    'buy' => 'Comprar',
    'sold_out' => 'Agotado',
    'plus_setup' => 'más :amount una vez',

    'spec_memory' => ':amount MiB de memoria',
    'spec_disk' => ':amount MiB de disco',
    'spec_cpu' => ':amount% de CPU',
    'spec_backups' => ':count copias de seguridad',
    'spec_databases' => ':count bases de datos',

    // ---- la página pública -----------------------------------------------
    'public_empty' => 'Ahora mismo no hay nada a la venta',
    'public_empty_body' => 'Vuelve más tarde.',
    'to_panel' => 'Entrar',
    'terms' => 'Condiciones',
    'sign_in_note' => 'Elige un servidor abajo. Entras para terminar, y se crea en cuanto la factura esté pagada.',

    // ---- el pago ---------------------------------------------------------
    'checkout_title' => 'Pago',
    'tax_line' => 'Impuesto (:rate%)',
    'coupon' => 'Código de descuento',
    'coupon_placeholder' => 'Si tienes uno',
    'coupon_bad' => 'Ese código no vale aquí.',
    'coupon_good' => 'Código aplicado.',
    'agree' => 'Acepto las',
    'place_order' => 'Hacer el pedido',
    'place_order_note' => 'Esto escribe una factura. No se cobra nada hasta que la pagues, y el servidor se crea en cuanto esté pagada.',
    'back_to_store' => 'Volver a la tienda',

    'placed' => 'Pedido hecho',
    'placed_body' => 'La factura :number te espera en tu página de facturación.',

    'refused' => 'Eso no se pudo comprar',
    'refused_gone' => 'Ya no está a la venta.',
    'refused_sold_out' => 'Se ha ido el último.',
    'refused_bad_coupon' => 'El código de descuento no vale para esto.',
    'refused_failed' => 'Algo salió mal al escribir el pedido. No se ha cobrado nada. Inténtalo otra vez y díselo a quien lleva este panel si sigue pasando.',

    // ---- facturación -----------------------------------------------------
    'billing_title' => 'Facturación',
    'billing_nav_label' => 'Facturación',
    'billing_subheading' => 'Lo que has comprado y lo que debes.',
    'your_orders' => 'Tus pedidos',
    'your_invoices' => 'Tus facturas',
    'no_orders' => 'Todavía no has comprado nada',
    'no_orders_body' => 'Todo lo que compres aparece aquí con su servidor y sus fechas.',
    'no_invoices' => 'Todavía no hay facturas',
    'to_store' => 'Ir a la tienda',
    'renews' => 'Se renueva',
    'ask_how_to_pay' => 'Pregunta a quien lleva este panel cómo pagar. Todavía no lo han escrito aquí.',
    'order_pending' => 'Esperando a que se pague la factura. El servidor se crea justo después.',
    'order_suspended' => 'Detenido por una factura sin pagar. Pagarla vuelve a arrancar el servidor: no se ha borrado nada.',

    // ---- pagar -----------------------------------------------------------
    'pay_with' => 'Pagar con',
    'pay_now' => 'Pagar',
    'pay_description' => 'Factura :number',
    'pay_thanks' => 'Gracias. La factura está pagada.',
    'pay_pending' => 'La pasarela aún no lo ha confirmado. Esta página se actualiza en cuanto lo haga.',
    'pay_refused' => 'Eso no arrancó',
    'pay_refused_body' => 'No se pudo abrir el pago. Prueba de otra manera, o pregunta a quien lleva este panel.',
    'gateway_mollie' => 'Mollie',

    // ---- los ajustes de la pasarela --------------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'Acepta iDEAL, tarjetas, Bancontact y el resto con una sola cuenta. Prueba y producción son el mismo ajuste: la propia clave dice a qué cuenta pertenece.',
    'mollie_on' => 'Ofrecer Mollie',
    'mollie_on_helper' => 'Apagado quita el botón de todas las facturas. Lo ya pagado sigue pagado.',
    'mollie_key' => 'Clave de API',
    'mollie_key_helper' => 'De la sección Developers de tu panel de Mollie. Nunca se escribe en un archivo de ajustes exportado.',
    'mollie_hook' => 'Dirección del webhook',
    'mollie_hook_helper' => 'Mollie avisará a :url - tu panel tiene que ser alcanzable ahí desde internet.',

    'gateway_stripe' => 'Tarjeta',

    'section_stripe' => 'Stripe',
    'section_stripe_helper' => 'Acepta tarjetas en una página que dibuja Stripe, así que ningún número de tarjeta llega nunca a este panel. Prueba y producción están en el prefijo de la clave, no en un interruptor.',
    'stripe_on' => 'Ofrecer Stripe',
    'stripe_on_helper' => 'Apagado quita el botón de todas las facturas. Lo ya pagado sigue pagado.',
    'stripe_key' => 'Clave secreta',
    'stripe_key_helper' => 'La que empieza por sk_, en Developers, API keys. Nunca se escribe en un archivo de ajustes exportado.',
    'stripe_hook' => 'Secreto de firma',
    'stripe_hook_key_helper' => 'El valor whsec_ que Stripe muestra al añadir la dirección de abajo. Sin él no se puede demostrar que sus mensajes son auténticos y se ignoran.',
    'stripe_hook_helper' => 'Añade :url como endpoint en Developers, webhooks, para el evento checkout.session.completed.',

    'gateway_paypal' => 'PayPal',

    'section_paypal' => 'PayPal',
    'section_paypal_helper' => 'La única pasarela en la que el dinero se mueve cuando el cliente vuelve y no mientras sigue en PayPal, así que una pestaña cerrada deja una factura sin pagar y no un pago perdido.',
    'paypal_on' => 'Ofrecer PayPal',
    'paypal_on_helper' => 'Apagado quita el botón de todas las facturas. Lo ya pagado sigue pagado.',
    'paypal_sandbox' => 'Entorno de pruebas',
    'paypal_sandbox_helper' => 'Habla con la cuenta de pruebas de PayPal en vez de con la real. Sus client ids se parecen en ambos casos, y por eso existe este interruptor.',
    'paypal_id' => 'Client ID',
    'paypal_secret' => 'Secret',
    'paypal_id_helper' => 'De la app que creaste en Apps & Credentials. Comprueba que la pestaña coincide con el interruptor de arriba.',
    'paypal_secret_helper' => 'Junto al client ID, detrás de Show. Nunca se escribe en un archivo de ajustes exportado.',
    'paypal_hook' => 'ID del webhook',
    'paypal_hook_id_helper' => 'El ID que PayPal le da al webhook una vez añadido, no la dirección. Sin él sus mensajes no se les pueden consultar y se ignoran.',
    'paypal_hook_helper' => 'Añade :url como webhook en esa app, para PAYMENT.CAPTURE.COMPLETED, y pega aquí el ID que te dé.',

    // ---- la página de pago -----------------------------------------------
    'pay_title' => 'Pagar',
    'pay_subheading' => 'Lo que debes, y las maneras de saldarlo.',
    'pay_choose' => '¿Cómo quieres pagar?',
    'pay_choose_body' => 'Elijas lo que elijas, terminas en su propia página y vuelves aquí justo después.',
    'pay_safe' => 'Se te envía a la pasarela para pagar. Los datos de tu tarjeta nunca llegan a este panel.',
    'pay_no_ways' => 'En cuanto llegue el dinero, la factura pasa a pagada y se prepara tu servidor.',
    'pay_gone' => 'Esa factura no existe',
    'pay_gone_body' => 'Puede que la hayan retirado, o que la dirección esté mal.',
    'pay_already' => 'Esta ya está pagada',
    'pay_already_body' => 'Nada más que hacer. Todo lo que la esperaba ya va en camino.',
    'pay_withdrawn' => 'Esta fue retirada',
    'pay_withdrawn_body' => 'Está fuera de los libros y no hay que pagarla. Pregunta a quien lleva este panel si eso te parece raro.',
    'back_to_billing' => 'Volver a facturación',

    'gateway_mollie_note' => 'iDEAL, Bancontact, tarjeta y más',
    'gateway_stripe_note' => 'Visa, Mastercard, American Express',
    'gateway_paypal_note' => 'Tu saldo de PayPal, o una tarjeta a través de PayPal',

    // ---- servicios y facturas, por separado ------------------------------
    'services_title' => 'Mis servicios',
    'services_nav_label' => 'Mis servicios',
    'services_subheading' => 'Lo que estás pagando, y el servidor que salió de cada uno.',
    'open_server' => 'Abrir el servidor',
    'no_server_yet' => 'Preparándose',

    'invoices_title' => 'Facturas',
    'invoices_subheading' => 'Lo que se te ha facturado, y lo que queda por pagar.',
    'no_invoices_body' => 'Todo lo que compres se factura aquí, y se queda aquí después de pagarlo.',

    // ---- la tienda como página de inicio ---------------------------------
    'section_landing' => 'Dónde va la tienda',
    'section_landing_helper' => 'Si quien entra aterriza en la tienda o en sus servidores.',
    'landing' => 'Abrir la tienda primero',
    'landing_helper' => 'Encendido, la tienda es la primera página tras entrar y la lista de servidores se coloca a su lado. Tus servicios y tus facturas quedan a un clic, en la cabecera de la tienda y en el menú de la cuenta. Apagado, no se mueve nada y la tienda es una página como cualquier otra.',
];
