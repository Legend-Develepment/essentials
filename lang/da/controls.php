<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * Kontrollinjen på en serverside. Sin egen fil frem for et hjørne af
 * settings.php, for det her læses af dem, der bruger panelet, ikke af den, der
 * sætter temaet op.
 *
 * Tilstanden ved siden af knapperne er Pelicans eget ord, taget fra enum'et
 * ContainerStatus, så linjen og konsolsiden aldrig er uenige om, hvad en server
 * er i gang med.
 *
 * "Kill" bliver stående på engelsk: sådan hedder Pelicans knap og sådan hedder
 * kommandoen, og det er ikke det samme som at stoppe.
 */

return [
    'console' => 'Konsol',
    'full_page' => 'Nyt vindue',
    'close' => 'Luk',

    'start' => 'Start',
    'restart' => 'Genstart',
    'stop' => 'Stop',
    'kill' => 'Kill',

    'kill_confirm' => 'Kill stopper containeren med det samme. Alt, som serveren endnu ikke har skrevet til disken, går tabt. Fortsæt?',

    'sent_title' => 'Strømhandling',
    'sent_body' => ':action blev sendt til :name.',
    'failed' => 'Noden kunne ikke nås.',
];
