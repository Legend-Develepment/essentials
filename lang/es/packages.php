<?php

/*
 * Español. Escrito a mano.
 *
 * Paquetes: un servidor que alguien puede comprar.
 *
 * Lo lee quien monta la tienda. Cada palabra aquí trata de la plantilla y el
 * precio; lo que ve un cliente está en shop.php, porque los dos lectores
 * quieren frases distintas sobre la misma fila.
 *
 * «egg», «node», «swap», «io» y las palabras de Minecraft se quedan en inglés:
 * son las palabras del formulario de servidor de Pelican, y un paquete es ese
 * formulario guardado para después.
 */

return [
    'title' => 'Paquetes',
    'nav_label' => 'Paquetes',
    'subheading' => 'Lo que está a la venta. Cada uno es una plantilla de servidor con un precio; un cliente compra uno y el panel crea el servidor.',

    // ---- la tabla --------------------------------------------------------
    'column_name' => 'Paquete',
    'column_egg' => 'Egg',
    'column_price' => 'Precio',
    'column_stock' => 'Existencias',
    'column_live' => 'A la venta',
    'column_orders' => 'Vendidos',

    'live' => 'A la venta',
    'offline' => 'Fuera de venta',
    'no_egg' => 'Sin egg — no se puede construir',

    'stock_unlimited' => 'Ilimitadas',
    'stock_left' => 'Quedan :count',
    'stock_out' => 'Agotado',

    // ---- periodos --------------------------------------------------------
    'period_once' => 'Pago único',
    'period_month' => 'Mensual',
    'period_quarter' => 'Trimestral',
    'period_year' => 'Anual',

    // Tras un precio: «12,50 € al mes».
    'per_once' => 'una vez',
    'per_month' => 'al mes',
    'per_quarter' => 'al trimestre',
    'per_year' => 'al año',

    // ---- acciones --------------------------------------------------------
    'new' => 'Nuevo paquete',
    'edit' => 'Editar',
    'duplicate' => 'Duplicar',
    'copy_suffix' => ' (copia)',
    'go_live' => 'Poner a la venta',
    'go_offline' => 'Retirar de la venta',
    'delete' => 'Eliminar',
    'delete_confirm' => 'Elimina el paquete. Lo ya comprado no se toca: los pedidos guardan su propia copia de lo que eran.',
    'delete_refused' => 'No se ha eliminado',
    'delete_refused_body' => 'Hay pedidos hechos sobre este paquete, y apuntan a él. Retíralo de la venta en su lugar; se queda para los registros y nadie puede comprarlo.',
    'deleted' => 'Paquete eliminado',
    'saved' => 'Paquete guardado',
    'save_failed' => 'No se pudo guardar el paquete',
    'price_invalid' => 'Eso no es un importe. Escríbelo como 12.50 o 12,50.',

    // ---- el formulario: qué es -------------------------------------------
    'section_basics' => 'El paquete',
    'section_basics_helper' => 'Lo que ve un cliente en la tarjeta.',
    'name' => 'Nombre',
    'name_helper' => 'Cómo se llama en la tienda.',
    'slug' => 'Dirección',
    'slug_helper' => 'Minúsculas, cifras y guiones. Dejada vacía se forma a partir del nombre. Cambiarla después rompe un enlace que alguien haya guardado.',
    'description' => 'Descripción',
    'description_helper' => 'Unas líneas bajo el nombre. Texto sin formato.',
    'live_field' => 'A la venta',
    'live_helper' => 'Desactivado mantiene el paquete aquí y no se lo muestra a nadie. Un paquete sin egg nunca se muestra, diga lo que diga esto.',
    'sort' => 'Orden',
    'sort_helper' => 'Cuanto menor, antes aparece en la tienda.',

    // ---- el formulario: en qué se convierte ------------------------------
    'section_server' => 'El servidor en que se convierte',
    'section_server_helper' => 'Las mismas preguntas que hace Pelican al crear un servidor a mano, respondidas una vez aquí y usadas en cada venta.',
    'egg' => 'Egg',
    'egg_helper' => 'Elegir uno rellena la imagen, el comando de arranque y cada variable con los valores por defecto del egg. Cambia lo que quieras después.',
    'image' => 'Imagen Docker',
    'image_helper' => 'Una de las imágenes que ofrece el egg.',
    'image_default' => 'La primera imagen del egg',
    'startup' => 'Comando de arranque',
    'startup_helper' => 'Uno de los comandos que ofrece el egg.',
    'startup_default' => 'El primer comando del egg',
    'environment' => 'Variables',
    'environment_helper' => 'Las variables del egg y su valor. Todo lo que tenga el egg y no esté aquí toma su valor por defecto al crear el servidor.',
    'env_key' => 'Variable',
    'env_value' => 'Valor',
    'nodes' => 'Nodes',
    'nodes_helper' => 'Dónde se puede crear un servidor de este paquete, probados en este orden hasta que uno tenga una dirección libre. Nada marcado significa cualquier node.',

    // ---- el formulario: límites ------------------------------------------
    'section_limits' => 'Límites',
    'section_limits_helper' => 'Lo que recibe el servidor. Los mismos campos que el formulario de servidor de Pelican, en las mismas unidades.',
    'memory' => 'Memoria',
    'disk' => 'Disco',
    'cpu' => 'CPU',
    'cpu_helper' => 'Porcentaje de un núcleo: 100 es un núcleo, 200 son dos, 0 es sin límite.',
    'swap' => 'Swap',
    'swap_helper' => '0 es ninguna, -1 es ilimitada.',
    'io' => 'Peso de IO de bloque',
    'io_helper' => 'El valor por defecto de Pelican es 500. Déjalo ahí salvo que sepas por qué no.',
    'threads' => 'Fijación de CPU',
    'threads_helper' => 'Qué núcleos, como los escribe Pelican: 0,1 o 0-3. Vacío es cualquiera.',
    'oom_killer' => 'OOM killer',
    'oom_killer_helper' => 'Si el kernel puede terminar el servidor cuando se queda sin memoria.',
    'databases' => 'Bases de datos',
    'allocations' => 'Allocations adicionales',
    'backups' => 'Copias de seguridad',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- el formulario: el dinero ----------------------------------------
    'section_price' => 'Precio y existencias',
    'section_price_helper' => 'En la moneda de la tienda, fijada en la página Ajustes de la tienda. Sin impuestos: el impuesto se añade en la factura como línea propia.',
    'price' => 'Precio',
    'price_helper' => 'Por periodo. Escríbelo como 12.50 o 12,50.',
    'setup_fee' => 'Cuota de instalación',
    'setup_fee_helper' => 'Se cobra una vez, en la primera factura. Cero para ninguna.',
    'period' => 'Facturado',
    'period_helper' => 'Pago único se paga una vez y se conserva. Los demás reciben una factura nueva cada periodo; una impagada suspende el servidor tras el periodo de gracia de la página Ajustes de la tienda.',
    'stock' => 'Existencias',
    'stock_helper' => 'Cuántos pueden estar vendidos a la vez, contando cada pedido no cancelado. Vacío es ilimitado.',

    'empty' => 'Aún no hay paquetes',
    'empty_body' => 'Crea uno y aparece en la tienda en cuanto se ponga a la venta.',
];
