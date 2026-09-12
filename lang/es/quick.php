<?php

/*
 * Español. Escrito a mano.
 *
 * El selector de la barra superior, y la página a la que lleva.
 *
 * Un solo control que responde a las dos preguntas que la gente se hace todo el
 * rato - qué servidor, y dónde estaban esos ajustes - y una página con todo lo
 * que alguien ha marcado. Véase Support\Quick.
 */

return [
    // ---- el control de la barra superior ---------------------------------
    'label' => 'Ir a',
    'open' => 'Ir a un servidor o a una página marcada',
    'search' => 'Buscar servidores…',

    'favourites' => 'Favoritos',
    'servers' => 'Servidores',
    'pages' => 'Páginas',

    'loading' => 'Buscando…',
    'empty' => 'No se ha encontrado nada.',
    // Dicho en vez de escondido: una lista que se corta en silencio a los
    // veinticinco parece una búsqueda incapaz de encontrar cosas.
    'more' => 'Hay más coincidencias de las que caben aquí - escribe un poco más.',
    'failed' => 'No se pudo contactar con el panel, así que esta lista puede estar desfasada. La consola del navegador dice qué respondió la petición.',

    'star_page' => 'Marcar esta página',
    'unstar_page' => 'Marcada - pulsa para quitarla',
    'all' => 'Ver todo',

    // ---- la página -------------------------------------------------------
    'title' => 'Favoritos',
    'nav_label' => 'Favoritos',
    'subheading' => 'Todo lo que has marcado, en un solo sitio.',

    'how' => 'Marca un servidor con la estrella de su tarjeta en la lista de servidores, y una página con el botón del menú «Ir a», arriba en la pantalla. Tu lista se guarda en el panel y no en este navegador, así que te sigue al siguiente sitio donde inicies sesión.',
    'page_empty' => 'Todavía no hay nada marcado.',
    'remove' => 'Quitar de favoritos',
];
