<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * Kontrollinjen på en serverside. Sin egen fil framfor et hjørne av
 * settings.php, for dette leses av dem som bruker panelet, ikke av den som
 * setter opp temaet.
 *
 * Tilstanden ved siden av knappene er Pelicans eget ord, hentet fra enumen
 * ContainerStatus, slik at linjen og konsollsiden aldri er uenige om hva en
 * server holder på med.
 *
 * "Kill" blir stående på engelsk: det er navnet på Pelicans knapp og navnet på
 * kommandoen, og det er ikke det samme som å stoppe.
 */

return [
    'console' => 'Konsoll',
    'full_page' => 'Nytt vindu',
    'close' => 'Lukk',

    'start' => 'Start',
    'restart' => 'Start på nytt',
    'stop' => 'Stopp',
    'kill' => 'Kill',

    'kill_confirm' => 'Kill stopper containeren umiddelbart. Alt serveren ennå ikke har skrevet til disk, går tapt. Fortsette?',

    'sent_title' => 'Strømhandling',
    'sent_body' => ':action ble sendt til :name.',
    'failed' => 'Noden kunne ikke nås.',
];
