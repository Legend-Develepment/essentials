<?php

/*
 * Română. Scrisă de mână.
 *
 * Comutatorul din bara de sus și pagina la care duce.
 *
 * Un singur control care răspunde la două întrebări puse întruna - care server,
 * și unde erau setările acelea - și o pagină care înșiră tot ce a marcat cineva
 * cu stea. Vezi Support\Quick.
 */

return [
    // ---- controlul din bara de sus ---------------------------------------
    'label' => 'Mergi la',
    'open' => 'Mergi la un server sau la o pagină marcată',
    'search' => 'Caută servere…',

    'favourites' => 'Favorite',
    'servers' => 'Servere',
    'pages' => 'Pagini',

    'loading' => 'Se caută…',
    'empty' => 'Nu s-a găsit nimic.',
    // Spus, nu ascuns: o listă care se oprește tăcut la douăzeci și cinci arată
    // ca o căutare care nu găsește lucrurile.
    'more' => 'Mai multe potriviri decât încap aici — mai scrie puțin.',
    'failed' => 'Panoul nu a putut fi contactat, deci lista poate fi învechită. Consola browserului spune ce a răspuns cererea.',

    'star_page' => 'Marchează această pagină',
    'unstar_page' => 'Marcată — clic pentru a scoate',
    'all' => 'Vezi tot',

    // ---- pagina ----------------------------------------------------------
    'title' => 'Favorite',
    'nav_label' => 'Favorite',
    'subheading' => 'Tot ce ai marcat cu stea, într-un singur loc.',

    'how' => 'Marchezi un server cu steaua de pe fișa lui din lista de servere, iar o pagină cu butonul din meniul Mergi la, în partea de sus a ecranului. Lista ta se ține pe panou și nu în acest browser, așa că te urmează oriunde te vei conecta data viitoare.',
    'page_empty' => 'Nimic marcat încă.',
    'remove' => 'Scoate din favorite',
];
