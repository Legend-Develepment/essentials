<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * Palworlds verdensinnstillinger, på en side i stedet for i en fil.
 *
 * Ingenting her navngir en enkelt innstilling. Hver etikett på den siden utledes
 * av nøkkelen som serverens egen fil inneholder - se
 * Support\Palworld\Palworld::label() for hvorfor en liste med navn ville vært
 * verre enn ingen.
 */

return [
    'title' => 'Palworld-innstillinger',
    'nav_label' => 'Palworld',
    'subheading' => 'Verdensinnstillingene fra denne serverens egen PalWorldSettings.ini, lest da du åpnet siden. Kan bare endres mens serveren er stoppet.',

    'reload' => 'Les filen på nytt',

    'save_confirm' => 'Filen skrives om med disse verdiene. Hver innstilling denne siden ikke viste, skrives tilbake nøyaktig slik den var, og det gjør alt annet i filen også.',
    'saved' => 'Innstillinger lagret',
    'saved_body' => 'De trer i kraft neste gang serveren starter.',
    'save_failed' => 'Filen kunne ikke skrives',

    'running' => 'Serveren kjører',
    'running_body' => 'Palworld holder disse innstillingene i minnet og skriver filen ut igjen når den stopper, så noe som ble lagret nå, ville blitt rullet tilbake uten et ord. Stopp serveren først.',

    'groups' => [
        'server' => 'Server og tilkobling',
        'world' => 'Verden og rater',
        'pals' => 'Pals',
        'players' => 'Spillere',
        'building' => 'Bygging, gjenstander og sanking',
        'guild' => 'Laug',
        'other' => 'Annet',
    ],
];
