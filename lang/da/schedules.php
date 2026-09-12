<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * „Cron" bliver stående på engelsk: sådan hedder den på værten og i Pelicans
 * dokumentation, og det er præcis det, man skal vide, når denne side siger, at
 * den ikke kører.
 */

return [
    'nav_label' => 'Planlagte opgaver',
    'title' => 'Hvilken planlagt opgave er gået i stå',
    'subheading' => 'Alle planlagte opgaver på panelet, de værste øverst - hængt fast i over :hours timer, forsinkede, eller aldrig kørt.',

    'how' => 'Pelican viser planlagte opgaver inde i hver server, og dens egen tilstand har tre ord til dem: inaktiv, behandler, aktiv. Ingen af dem siger „denne gik i stå". En kørsel, der faldt om undervejs, bliver ved med at være „behandler" for altid og tegnes præcis som en, der kører lige nu; en opgave, hvis tidspunkt gik for timer siden, fordi cron døde, hedder stadig aktiv. Denne side stiller det andet spørgsmål. Kun læsning - alt, der retter, kører eller sletter en opgave, bliver på Pelicans egen side for den server.',

    'column_state' => 'Tilstand',
    'column_name' => 'Opgave',
    'column_server' => 'Server',
    'column_last' => 'Seneste kørsel',
    'column_next' => 'Næste kørsel',

    /*
     * De fem domme. Skrevet som det, der er sandt, frem for som en anvisning,
     * fordi tre af dem er noget at se på, og to er det ikke.
     */
    'state_stuck' => 'Hængt fast',
    'state_overdue' => 'Forsinket',
    'state_never' => 'Aldrig kørt',
    'state_healthy' => 'Fin',
    'state_off' => 'Inaktiv',

    'filter_stuck' => 'Hængt fast',
    'filter_overdue' => 'Forsinkede',
    'filter_never' => 'Aldrig kørt',
    'filter_off' => 'Slået fra',

    'open' => 'Åbn på serveren',

    'empty' => 'Ingen planlagte opgaver på nogen server, du kan nå - eller ingen, der er gået i stå, hvis du har et filter slået til.',
];
