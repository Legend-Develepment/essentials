<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * Hvem der er på en server, for de spil, der svarer på Valves forespørgsel.
 *
 * Én side til Rust, ARK, Valheim og resten, fordi de svarer på den samme pakke.
 * Det, der er forskelligt fra spil til spil, er, hvad man kan gøre ved nogen -
 * at smide ud er `kick "navn"` i det ene og `KickPlayer <id>` i det andet - og
 * derfor læser denne side og handler ikke.
 */

return [
    'title' => 'Spillere',
    'nav_label' => 'Spillere',
    'subheading' => 'Hvem der er tilsluttet, spurgt hos spillet selv frem for hos panelet.',

    'refresh' => 'Spørg igen',

    'count' => ':count tilsluttet',
    'score' => 'Point',

    'just_joined' => 'lige kommet ind',
    'minutes' => ':count min',
    'hours' => ':count t',
    'hours_minutes' => ':hours t :minutes min',

    'empty' => 'Der er ingen på denne server.',

    /*
     * Ikke „der er ingen", og forskellen betyder noget.
     *
     * Panelet og spilporten sidder tit på net, der ikke kan nå hinanden, og at
     * tegne det som en tom liste ville være denne side, der siger noget, den
     * ikke ved.
     */
    'unreachable' => 'Serveren svarede ikke. Den er måske ved at starte, eller panelet kan ikke nå dens spilport derfra, hvor det kører - og det er ikke det samme som, at der ikke er nogen indenfor.',
];
