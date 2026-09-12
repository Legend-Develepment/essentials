<?php

/*
 * Română. Scris de mână.
 *
 * Clienți: magazinul, doar întors spre om în loc de spre rând.
 *
 * Comenzile, facturile și plățile sunt fiecare o listă cu ce s-a întâmplat.
 * Pagina asta pune întrebarea pe care o are cu adevărat cineva care răspunde
 * la o solicitare: cine e, ce are, ce a plătit și ce rămâne.
 */

return [
    'title' => 'Clienți',
    'nav_label' => 'Clienți',
    'subheading' => 'Toți cei care au cumpărat ceva, cu ce au, ce au plătit și ce mai datorează.',

    // ---- tabelul ---------------------------------------------------------
    'column_customer' => 'Client',
    'column_services' => 'Servicii',
    'column_spent' => 'Plătit',
    'column_outstanding' => 'De plată',

    'of_orders' => 'din :count comandate',
    'nothing_owed' => 'Nimic',

    'filter_owing' => 'Datorează ceva',
    'filter_active' => 'Are un serviciu activ',

    // ---- unul dintre ei --------------------------------------------------
    'open' => 'Deschide',
    'close' => 'Închide',
    'servers' => 'Servere',
    'since' => 'Client din',
    'their_services' => 'Servicii',
    'their_invoices' => 'Facturi',
    'no_services' => 'Nimic activ și nimic care să aștepte să fie construit.',
    'no_invoices' => 'Pentru acest cont nu s-a scris nicio factură.',

    'empty' => 'Nimeni nu a cumpărat încă nimic',
    'empty_body' => 'Aici apar cei care au comandat, nu toți cei cu cont - așa că se umple la prima vânzare.',
    'who' => 'Cine este',
];
