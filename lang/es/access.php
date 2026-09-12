<?php

/*
 * Español. Escrito a mano.
 *
 * «Subuser», «Wings», «SFTP», «cron» y «queue worker» se quedan en inglés: con
 * esos nombres se encuentran en Pelican y en el host, y es justo lo que hay que
 * saber cuando aparece una de estas líneas.
 */

return [
    'nav_label' => 'Acceso a servidores',
    'title' => 'Servidores por rol',
    'subheading' => 'Dar a todos los que tienen un rol acceso a los mismos servidores.',

    /*
     * Dicho antes que nada más en la página, porque esta es la única función de
     * aquí que escribe en una tabla que pertenece a Pelican.
     */
    'more' => 'Cómo funciona esto',
    'warning' => 'Funciona manteniendo al día los subusers del propio Pelican - las mismas filas que añadirías a mano en la página Usuarios de un servidor, y las que leen la lista de servidores, las comprobaciones de permisos y Wings. Solo toca las filas que ha creado él: lo que hayas añadido a mano no se cambia ni se borra nunca. A nadie se le envía un correo cuando un rol le concede un servidor. Quitar el acceso también revoca su SFTP, cosa que necesita el queue worker que Pelican ya pide.',

    'never' => 'Todavía no se ha reconciliado nada. Guarda una asignación abajo y ocurre al momento, y cada minuto con el cron del propio panel a partir de entonces.',
    'timing' => 'El acceso se quita en el momento en que debe quitarse: quien pierde un rol pierde los servidores en su siguiente página. Concederlo puede tardar hasta un minuto, porque esa es la pasada que busca a la gente que no está usando el panel ahora mismo.',
    'last_run' => 'Última pasada hace :ago segundos: :added añadidos, :removed quitados, :held mantenidos.',
    'capped' => 'Demasiado de golpe - :pairs concesiones, y el límite es :max. No se escribió nada. Acota una asignación: un rol con cincuenta personas y veinte servidores son mil concesiones él solo.',

    'which' => 'Las asignaciones',
    'which_helper' => 'Un rol, los servidores que deben alcanzar quienes lo tienen, y qué pueden hacer allí. Quien tenga dos roles recibe todo lo que conceden ambos. Los propietarios de servidores y los administradores root se omiten - ya tienen más de lo que esto podría darles.',
    'add' => 'Añadir un rol',

    'role' => 'Rol',
    'role_helper' => 'Todos los que lo tienen, incluido quien lo reciba más adelante.',
    'servers' => 'Servidores',
    'servers_helper' => 'Los servidores que reciben. Quitar uno de aquí les retira ese acceso.',

    'permissions' => 'Qué pueden hacer',
    'permissions_helper' => 'Los permisos de subuser del propio Pelican. Déjalos como están para un conjunto razonable: la consola, los botones de encendido, los archivos, las copias de seguridad y el registro de actividad - y nada que edite el servidor, sus usuarios, sus bases de datos o sus asignaciones. «Connect to websocket» va siempre incluido, porque sin él la página de consola no se conecta a nada.',

    'save' => 'Guardar y aplicar',
    'saved' => 'Guardado',
    'saved_body' => ':added concedidos, :removed retirados.',
    'save_failed' => 'No se pudo guardar',
    'save_failed_disk' => 'La lista no se pudo escribir en storage. Comprueba que storage/app pertenece al usuario con el que se ejecuta el panel.',

    'revoke' => 'Retirarlo todo',
    'revoke_confirm' => '¿Quitar todo lo que esto ha concedido?',
    'revoke_confirm_helper' => 'Cada fila de subuser que ha creado esta página, en cada servidor, para todo el mundo - y su SFTP con ella. Las filas que hayas añadido a mano no se tocan. Las asignaciones de abajo se quedan, así que el siguiente guardado o la siguiente pasada volverían a concederlas: vacía primero la lista si lo dices en serio.',
    'revoked' => ':count quitados',
    'revoked_body' => 'Solo las filas que había creado esta página. Lo añadido a mano sigue donde estaba.',
    'revoke_failed' => 'No se pudieron quitar',
];
