<?php

/*
 * Español. Escrito a mano.
 *
 * La página de módulos.
 *
 * Un archivo propio en lugar de un rincón de settings.php, que ya es el
 * archivo de idioma más grande de este complemento.
 */

return [
    'title' => 'Módulos',
    'nav_label' => 'Módulos',
    'subheading' => 'Lo que este complemento es en este panel. Todo aquí se puede apagar, y apagar algo nunca borra lo que ya dejó anotado.',

    'first_title' => '¿Para qué es este panel?',
    'first_helper' => 'Responde una vez y se encienden las partes que van con ello. No se fija nada: cada interruptor de abajo sigue siendo tuyo, y apagar algo nunca borra lo que ya dejó anotado.',
    'first_look' => 'Sobre todo su aspecto',
    'first_look_helper' => 'Colores, la pantalla de acceso, los avisos, tus propios enlaces y las páginas para cambiarlos. Nada que venda, responda ni salga del panel.',
    'first_run' => 'Tener servidores en marcha, para mí o un equipo',
    'first_run_helper' => 'El aspecto, más lo que muestra un servidor y lo que está lleno o parado. Sin tienda, sin mostrador de tickets y sin nada que mande correo con un temporizador.',
    'first_sell' => 'Vender alojamiento a clientes',
    'first_sell_helper' => 'Todo. Una tienda sin sitio donde responder preguntas, y sin nada que vigile los nodos, es media tienda.',
    'first_skip' => 'Ya los elijo yo',

    'first_left' => 'Se queda como está. Los interruptores están todos abajo.',
    'go' => 'Configurarlo',

    'state_on' => 'Encendido',
    'state_part' => 'En parte',
    'state_off' => 'Apagado',

    'count' => '{1} :on de :of parte encendida|[2,*] :on de :of partes encendidas',
    'parts' => '{1} La única parte|[2,*] Las :count partes',

    'health_tables' => 'Sus tablas todavía no están. Guardar cualquier cosa en esta página las crea.',
    'health_missing' => '{1} Una parte necesita algo que está apagado|[2,*] :count partes necesitan algo que está apagado',
    'health_waiting' => '{1} Una parte está encendida y todavía no muestra nada|[2,*] :count partes están encendidas y todavía no muestran nada',

    'left_access' => '{1} Una persona todavía tiene un servidor concedido aquí|[2,*] :count personas todavía tienen servidores concedidos aquí',
    'left_public_status' => '{1} Una página publicada y su dirección siguen guardadas|[2,*] :count páginas publicadas y sus direcciones siguen guardadas',
    'left_arranger' => '{1} Una disposición guardada sigue ahí|[2,*] :count disposiciones guardadas siguen ahí',
    'left_user_themes' => '{1} El estilo elegido de una persona sigue ahí|[2,*] Los estilos elegidos de :count personas siguen ahí',
    'left_unknown' => 'Aquí queda algo, y el panel no pudo leer cuánto.',
    'cleared' => '{1} Uno retirado|[2,*] :count retirados',
    'clear_failed' => 'Eso no se pudo limpiar',

    'turn_on' => 'Encender',
    'turn_off' => 'Apagar',

    'saved' => 'Guardado',
    'brought' => 'Encendidas junto con ella, porque sin ellas aquí no funciona nada: :names.',
    'save_failed' => 'Eso no se pudo guardar',
    'read_only' => 'Puedes mirar esto y no cambiarlo. Cambiar lo que el panel ofrece pide el permiso más amplio sobre este complemento.',
];
