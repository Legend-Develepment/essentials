<?php

/*
 * Español. Escrito a mano.
 *
 * Pedir aviso de cuándo vuelve a estar a la venta un paquete agotado.
 *
 * Aquí no se le promete a nadie la cosa en sí. Cuando vuelve el stock se avisa
 * a toda la lista a la vez y se lo queda quien compre primero, así que cada
 * frase lo dice tal cual en vez de decir «¡ya está aquí!» y dejar que
 * veintiocho personas averigüen cuánto valía eso.
 *
 * El aviso también saca a esa persona de la lista, y eso también se dice en
 * voz alta: una petición compra un aviso, que es lo que mantiene la campana
 * digna de leerse.
 */

return [
    'bell_back' => ':name vuelve a estar disponible',
    'bell_back_body' => '{1} Hay uno, y se lo queda quien compre primero. Ya no estás en la lista, así que vuelve a pedirlo si se te escapa.|[2,*] Hay :count, y se los queda quien compre primero. Ya no estás en la lista, así que vuelve a pedirlo si se te escapan.',
    'bell_back_any' => 'Ya no está limitado, así que hay para todo el mundo. Ya no estás en la lista.',
];
