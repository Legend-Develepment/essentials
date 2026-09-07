<?php

/*
 * Svenska. Skriven för hand.
 *
 * Palworlds världsinställningar, på en sida i stället för i en fil.
 *
 * Ingenting här namnger en inställning. Varje etikett på den sidan räknas fram
 * ur den nyckel serverns egen fil bär - se Support\Palworld\Palworld::label()
 * för varför en lista med namn vore sämre än ingen alls.
 *
 * «Pal» och «guild» står kvar: det är spelets egna ord, och det är dem man ser
 * inne i spelet.
 */

return [
    'title' => 'Palworld-inställningar',
    'nav_label' => 'Palworld',
    'subheading' => 'Världsinställningarna ur den här serverns egen PalWorldSettings.ini, lästa när du öppnade sidan. Går bara att ändra medan servern är stoppad.',

    'reload' => 'Läs filen igen',

    'save_confirm' => 'Filen skrivs om med de här värdena. Varje inställning den här sidan inte visade skrivs tillbaka exakt som den var, och det gör allt annat i filen också.',
    'saved' => 'Inställningarna sparade',
    'saved_body' => 'De träder i kraft nästa gång servern startar.',
    'save_failed' => 'Filen gick inte att skriva',

    'running' => 'Servern kör',
    'running_body' => 'Palworld håller de här inställningarna i minnet och skriver ut filen igen när den stoppar, så en ändring som sparas nu skulle göras ogjord utan ett ord. Stoppa servern först.',

    'groups' => [
        'server' => 'Server och anslutning',
        'world' => 'Värld och takt',
        'pals' => 'Pals',
        'players' => 'Spelare',
        'building' => 'Bygge, föremål och insamling',
        'guild' => 'Guilds',
        'other' => 'Övrigt',
    ],
];
