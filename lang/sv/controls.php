<?php

/*
 * Svenska. Skriven för hand.
 *
 * Kontrollraden på en serversida. En egen fil i stället för ett hörn av
 * settings.php, för det här läses av dem som använder panelen och inte av den
 * som ställer in temat.
 *
 * Tillståndet bredvid knapparna är Pelicans eget ord för saken, hämtat ur
 * ContainerStatus, så raden och konsolsidan aldrig säger emot varandra om vad
 * en server håller på med.
 *
 * «Kill» står kvar på engelska: det är namnet på Pelicans egen knapp och på
 * kommandot, och det är något annat än att stoppa.
 */

return [
    'console' => 'Konsol',
    'full_page' => 'Nytt fönster',
    'close' => 'Stäng',

    'start' => 'Starta',
    'restart' => 'Starta om',
    'stop' => 'Stoppa',
    'kill' => 'Kill',

    'kill_confirm' => 'Kill stoppar containern där den står. Allt servern ännu inte har skrivit till disk går förlorat. Fortsätta?',

    'sent_title' => 'Strömkommando',
    'sent_body' => ':action skickades till :name.',
    'failed' => 'Noden gick inte att nå.',
];
