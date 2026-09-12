<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * «Egg» blir stående på engelsk: det er ordet Pelican bruker i hele
 * grensesnittet sitt, og en innstilling som heter noe annet enn skjermen den
 * kommer fra, er en man slår opp to ganger.
 */

return [
    'title' => 'Kopier en server',
    'nav_label' => 'Kopier server',
    'subheading' => 'Enda en server satt opp nøyaktig som en du allerede har, eller flere på én gang.',

    'section' => 'Hva som kopieres',
    'section_helper' => 'Eieren, egget, startkommandoen, grensene og alle variabler blir kopiert. Filer, databaser, sikkerhetskopier og planlagte oppgaver blir det ikke - en kopi av filene til en server som kjører, er en kopi av tilstanden dens, og det er sjelden det man mener med «en til som denne».',

    'source' => 'Kopier fra',
    'source_helper' => 'Kopiene havner på den samme noden som denne serveren, for det er der de ledige adressene dens er.',

    'name' => 'Navn på kopien',
    'name_helper' => 'Lager du mer enn én, blir de nummerert: «Bot 1», «Bot 2» og så videre.',

    'copies' => 'Hvor mange',
    'copies_helper' => 'Velg en server først.',
    'room' => ':count ledige adresser på :node, så det er det meste som kan lages akkurat nå.',
    'no_room' => 'Det er ingen ledig adresse igjen på :node. En kopi trenger sin egen, så legg først en tildeling til den noden.',

    /*
     * Talt opp framfor listet for det som gikk bra, og listet for det som ikke
     * gjorde det - det er den veien det hjelper: ti navn som virket, er en vegg
     * av tekst ingen leser, og det ene som ikke gjorde det, er det eneste som er
     * verdt å lese.
     */
    'made' => ':count kopier laget',
    'partly_failed' => ':count kopier kunne ikke lages',
    'failed' => 'Ingenting ble kopiert',
];
