<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * Palworlds verdensindstillinger, på en side i stedet for i en fil.
 *
 * Intet her navngiver en enkelt indstilling. Hver etikette på den side udledes
 * af den nøgle, serverens egen fil indeholder — se
 * Support\Palworld\Palworld::label() for hvorfor en liste af navne ville være
 * værre end ingen.
 */

return [
    'title' => 'Palworld-indstillinger',
    'nav_label' => 'Palworld',
    'subheading' => 'Verdensindstillingerne fra denne servers egen PalWorldSettings.ini, læst da du åbnede siden. Kan kun ændres, mens serveren er stoppet.',

    'reload' => 'Læs filen igen',

    'save_confirm' => 'Filen skrives om med disse værdier. Hver indstilling, denne side ikke viste, skrives tilbage præcis som den var, og det gør alt andet i filen også.',
    'saved' => 'Indstillinger gemt',
    'saved_body' => 'De træder i kraft, næste gang serveren starter.',
    'save_failed' => 'Filen kunne ikke skrives',

    'running' => 'Serveren kører',
    'running_body' => 'Palworld holder disse indstillinger i hukommelsen og skriver filen ud igen, når den stopper, så noget, der blev gemt nu, ville blive rullet tilbage uden et ord. Stop serveren først.',

    'groups' => [
        'server' => 'Server og forbindelse',
        'world' => 'Verden og satser',
        'pals' => 'Pals',
        'players' => 'Spillere',
        'building' => 'Bygning, genstande og indsamling',
        'guild' => 'Laug',
        'other' => 'Andet',
    ],
];
