<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * Hvem som er på en server, for de spillene som svarer på Valves forespørsel.
 *
 * Én side for Rust, ARK, Valheim og resten, fordi de svarer på den samme
 * pakken. Det som er forskjellig fra spill til spill, er hva man kan gjøre med
 * noen - å kaste ut er `kick "navn"` i det ene og `KickPlayer <id>` i det andre
 * - og derfor leser denne siden og handler ikke.
 */

return [
    'title' => 'Spillere',
    'nav_label' => 'Spillere',
    'subheading' => 'Hvem som er tilkoblet, spurt hos spillet selv framfor hos panelet.',

    'refresh' => 'Spør på nytt',

    'count' => ':count tilkoblet',
    'score' => 'Poeng',

    'just_joined' => 'nettopp kommet inn',
    'minutes' => ':count min',
    'hours' => ':count t',
    'hours_minutes' => ':hours t :minutes min',

    'empty' => 'Det er ingen på denne serveren.',

    /*
     * Ikke «det er ingen her», og forskjellen betyr noe.
     *
     * Panelet og spillporten ligger ofte på nett som ikke når hverandre, og å
     * tegne det som en tom liste ville vært denne siden som sier noe den ikke
     * vet.
     */
    'unreachable' => 'Serveren svarte ikke. Den holder kanskje på å starte, eller panelet når ikke spillporten dens derfra det kjører - og det er ikke det samme som at det ikke er noen der inne.',
];
