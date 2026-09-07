<?php

/*
 * Svenska. Skriven för hand.
 *
 * Växlaren i topbaren, och sidan den leder till.
 *
 * En kontroll som svarar på två frågor folk ställer hela tiden - vilken server,
 * och var var de där inställningarna - och en sida som listar allt någon har
 * stjärnmärkt. Se Support\Quick.
 */

return [
    // ---- kontrollen i topbaren -------------------------------------------
    'label' => 'Gå till',
    'open' => 'Gå till en server eller en stjärnmärkt sida',
    'search' => 'Sök servrar…',

    'favourites' => 'Favoriter',
    'servers' => 'Servrar',
    'pages' => 'Sidor',

    'loading' => 'Letar…',
    'empty' => 'Ingenting hittat.',
    // Sagt i stället för dolt: en lista som tyst slutar vid tjugofem ser ut som
    // en sökning som inte hittar saker.
    'more' => 'Fler träffar än som får plats här — skriv lite till.',
    'failed' => 'Panelen gick inte att nå, så den här listan kan vara inaktuell. Webbläsarens konsol säger vad förfrågan svarade.',

    'star_page' => 'Stjärnmärk den här sidan',
    'unstar_page' => 'Stjärnmärkt — klicka för att ta bort',
    'all' => 'Se alla',

    // ---- sidan -----------------------------------------------------------
    'title' => 'Favoriter',
    'nav_label' => 'Favoriter',
    'subheading' => 'Allt du har stjärnmärkt, på ett ställe.',

    'how' => 'Stjärnmärk en server med stjärnan på dess kort i serverlistan, och en sida med knappen i Gå till-menyn högst upp på skärmen. Din lista ligger på panelen och inte i den här webbläsaren, så den följer med dit du än loggar in nästa gång.',
    'page_empty' => 'Ingenting stjärnmärkt ännu.',
    'remove' => 'Ta bort från favoriter',
];
