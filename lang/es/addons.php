<?php

/*
 * Español. Escrito a mano.
 *
 * Extras que se venden junto a un paquete.
 *
 * Aquí se mantienen dos cosas separadas. Lo que *cuesta* un extra es su precio,
 * que es lo que se cobra cada vez. Lo que *cuesta hoy* es una parte de eso,
 * porque quien compra uno a mitad de mes paga medio mes. Los textos para el
 * cliente dicen siempre cuál de los dos es.
 *
 * «No añade nada al servidor» es una respuesta de verdad y se dice en voz alta
 * en vez de dejar la celda vacía, porque la atención prioritaria es una cosa
 * corriente de vender y una celda vacía se lee como un error.
 */

return [
    'title' => 'Extras',
    'nav_label' => 'Extras',
    'subheading' => 'Cosas que se venden junto a un paquete: más memoria, otra copia de seguridad, o algo que solo es una línea en la factura.',

    // ---- la tabla --------------------------------------------------------
    'column_name' => 'Extra',
    'column_price' => 'Precio',
    'column_adds' => 'Añade',
    'column_sold' => 'En uso',
    'column_live' => 'A la venta',
    'adds_nothing' => 'Nada al servidor',

    // ---- el formulario ---------------------------------------------------
    'section_what' => 'Qué es',
    'section_what_helper' => 'El nombre y el precio que ve un cliente, y con qué paquetes se puede comprar.',
    'name' => 'Nombre',
    'price' => 'Precio',
    'price_helper' => 'Lo que cuesta cada vez que se cobra. Si alguien lo compra a mitad de un periodo, paga una parte de esto y el importe entero desde la siguiente renovación.',
    'billing' => 'Se cobra',
    'billing_helper' => 'Con el servicio significa que vuelve en cada renovación, mientras lo mantengan. Una sola vez significa que se cobra en la factura que lo lleva por primera vez y nunca más.',
    'billing_with' => 'En cada renovación',
    'billing_once' => 'Una sola vez',
    'max' => 'Máximo por servicio',
    'max_helper' => 'Cuántos de este puede tener alguien. Uno es el caso normal; súbelo para algo que se venda por gigabyte.',
    'description' => 'Descripción',
    'description_helper' => 'Una línea bajo el nombre al pagar. Di lo que hace, no cómo se llama.',
    'packages' => 'Paquetes',
    'packages_helper' => 'Con qué paquetes se puede comprar esto. Nada marcado significa con todos, que es lo que suele ser una opción de soporte o una copia de seguridad.',

    'section_adds' => 'Qué le añade al servidor',
    'section_adds_helper' => 'Esto se suma a lo que ya da el paquete, no lo sustituye: 4096 en memoria hace el servidor 4 GiB más grande. Dos extras iguales se suman. Déjalo todo a cero para algo que solo sea una línea en la factura. Un número negativo quita algo, lo cual se permite y de vez en cuando es justo lo que se quiere.',
    'sort' => 'Orden',
    'sort_helper' => 'Cuanto menor, antes aparece al pagar. Con números iguales manda el precio.',
    'live' => 'A la venta',
    'live_helper' => 'Desactivado, no se ofrece en ninguna parte. Quien ya lo tenga lo conserva y se le sigue cobrando.',

    // ---- los botones -----------------------------------------------------
    'new' => 'Nuevo extra',
    'edit' => 'Editar',
    'delete' => 'Eliminar',
    'delete_confirm' => 'Nadie tiene este. Eliminarlo lo quita de la lista para siempre.',
    'delete_sold' => ':count servicio(s) tienen este. Lo conservan, conservan los límites que les dio y se les sigue cobrando - lo que desaparece es la entrada de la lista, así que nadie nuevo puede comprarlo.',
    'go_live' => 'Poner a la venta',
    'go_offline' => 'Retirar de la venta',
    'saved' => 'Guardado',
    'deleted' => 'El extra ya no está',
    'save_failed' => 'No se guardó',
    'save_failed_body' => 'No se escribió nada. Inténtalo otra vez, y mira en el log si sigue pasando.',
    'invalid' => 'Un extra necesita un nombre y un precio.',
    'empty' => 'Todavía no hay extras',
    'empty_body' => 'Un extra es algo que se vende al lado de un paquete: otro gigabyte, una segunda copia de seguridad, o un servicio que no le añade nada al servidor.',

    // ---- lo que ve un cliente --------------------------------------------
    'choose' => 'Extras',
    'choose_helper' => 'Son opcionales, y puedes añadirlos o quitarlos más adelante.',
    'yours' => 'Extras de este servicio',
    'add' => 'Añadir un extra',
    'add_helper' => 'Ahora pagas lo que queda de este periodo, y el precio entero desde la siguiente renovación.',
    'add_to' => 'Añadir :name',
    'add_confirm' => '¿Añadir :name a este servicio?',
    'drop' => 'Quitar',
    'drop_confirm' => '¿Quitar :name? La parte sin usar de lo que has pagado vuelve a tu cuenta, y tu servidor cambia al momento.',
    'costs_now' => ':amount ahora',
    'free_now' => 'Nada que pagar ahora',
    'then' => 'luego :amount por renovación',
    'once_only' => ':amount, una sola vez',
    'each' => 'por unidad',
    'added' => ':name añadido',
    'added_body' => 'A tu servidor ya se le ha dado lo que añade.',
    'dropped' => ':name quitado',
    'dropped_body' => 'Lo que habías pagado y no has usado está en tu cuenta.',

    // ---- y cuando no se puede --------------------------------------------
    'refused' => 'Eso no se pudo hacer',
    'refused_off' => 'Los extras están desactivados en este panel.',
    'refused_not_active' => 'Solo se le pueden añadir extras a un servicio activo.',
    'refused_gone' => 'Ese extra ya no está a la venta.',
    'refused_wrong_package' => 'Ese extra no se vende con este paquete.',
    'refused_enough' => 'Ya tienes tantos de esos como puede tener este servicio.',
    'refused_failed' => 'No se escribió nada, así que nada ha cambiado. Inténtalo otra vez, y avisa a quien lleve este panel si sigue pasando.',
    'refused_server' => 'El servidor no aceptó los límites nuevos, así que no se cambió nada y no se cobró nada.',
    'refused_not_yours' => 'Ese extra no está en este servicio.',

    // ---- lo que dicen los documentos -------------------------------------
    'line' => ':name × :many, por los :days días que quedan de este periodo',
    'credit_reason' => 'Quitado: :name',
    'bell_failed' => 'Un extra no se le pudo dar al servidor en el pedido :number',

    // ---- unidades, para la tabla de administración -----------------------
    'unit_memory' => 'MiB de memoria',
    'unit_swap' => 'MiB de swap',
    'unit_disk' => 'MiB de disco',
    'unit_cpu' => '% de CPU',
    'unit_database_limit' => 'bases de datos',
    'unit_allocation_limit' => 'allocations',
    'unit_backup_limit' => 'copias de seguridad',
];
