<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * Kunder: butikken, bare vendt mod personen i stedet for mod rækken.
 *
 * Ordrer, fakturaer og betalinger er hver en liste over, hvad der er sket.
 * Denne side stiller det spørgsmål, som den, der sidder med en sag, faktisk
 * har: hvem er det, hvad har de, hvad har de betalt, og hvad står tilbage.
 */

return [
    'title' => 'Kunder',
    'nav_label' => 'Kunder',
    'subheading' => 'Alle, der har købt noget, med hvad de har, hvad de har betalt, og hvad der stadig skyldes.',

    // ---- tabellen --------------------------------------------------------
    'column_customer' => 'Kunde',
    'column_services' => 'Ydelser',
    'column_spent' => 'Betalt',
    'column_outstanding' => 'Udestående',

    'of_orders' => 'af :count bestilte',
    'nothing_owed' => 'Ingenting',

    'filter_owing' => 'Skylder noget',
    'filter_active' => 'Har en aktiv ydelse',

    // ---- en af dem -------------------------------------------------------
    'open' => 'Åbn',
    'close' => 'Luk',
    'servers' => 'Servere',
    'since' => 'Kunde siden',
    'their_services' => 'Ydelser',
    'their_invoices' => 'Fakturaer',
    'no_services' => 'Intet aktivt, og intet der venter på at blive bygget.',
    'no_invoices' => 'Der er ikke skrevet nogen fakturaer til denne konto.',

    'empty' => 'Ingen har købt noget endnu',
    'empty_body' => 'Her står dem, der har bestilt, ikke alle med en konto - så den fylder sig ved første salg.',
];
