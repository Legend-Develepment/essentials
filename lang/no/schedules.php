<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * «Cron» blir stående på engelsk: det er det den heter på verten og i Pelicans
 * dokumentasjon, og det er nøyaktig det man trenger å vite når denne siden sier
 * at den ikke kjører.
 */

return [
    'nav_label' => 'Planlagte oppgaver',
    'title' => 'Hvilken planlagt oppgave har stoppet',
    'subheading' => 'Alle planlagte oppgaver på panelet, de verste øverst - sittende fast i over :hours timer, forsinket, eller aldri kjørt.',

    'how' => 'Pelican viser planlagte oppgaver inne i hver server, og dens egen tilstand har tre ord for dem: inaktiv, behandler, aktiv. Ingen av dem sier «denne stoppet». En kjøring som falt sammen underveis, blir stående som «behandler» for alltid og tegnes nøyaktig som en som kjører nå; en oppgave hvis tidspunkt gikk for timer siden fordi cron døde, heter fortsatt aktiv. Denne siden stiller det andre spørsmålet. Kun lesing - alt som endrer, kjører eller sletter en oppgave, blir på Pelicans egen side for den serveren.',

    'column_state' => 'Tilstand',
    'column_name' => 'Oppgave',
    'column_server' => 'Server',
    'column_last' => 'Siste kjøring',
    'column_next' => 'Neste kjøring',

    /*
     * De fem dommene. Skrevet som det som er sant framfor som en anvisning,
     * fordi tre av dem er noe å se på, og to er det ikke.
     */
    'state_stuck' => 'Sitter fast',
    'state_overdue' => 'Forsinket',
    'state_never' => 'Aldri kjørt',
    'state_healthy' => 'Grei',
    'state_off' => 'Inaktiv',

    'filter_stuck' => 'Sitter fast',
    'filter_overdue' => 'Forsinkede',
    'filter_never' => 'Aldri kjørt',
    'filter_off' => 'Slått av',

    'open' => 'Åpne på serveren',

    'empty' => 'Ingen planlagte oppgaver på noen server du kan nå - eller ingen som har stoppet, hvis du har et filter på.',
];
