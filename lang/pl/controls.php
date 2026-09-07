<?php

/*
 * Polski. Napisane ręcznie.
 *
 * Pasek sterowania na stronie serwera. Własny plik, a nie kąt w settings.php,
 * bo to czyta ktoś, kto korzysta z panelu, a nie ktoś, kto konfiguruje motyw.
 *
 * Stan obok przycisków to słowo samego Pelicana, wzięte z enuma
 * ContainerStatus, żeby pasek i strona konsoli nigdy nie mówiły czegoś innego o
 * tym, co robi serwer.
 *
 * "Kill" zostaje po angielsku: tak nazywa się przycisk Pelicana i tak nazywa
 * się polecenie, a to nie to samo co zatrzymanie.
 */

return [
    'console' => 'Konsola',
    'full_page' => 'Nowe okno',
    'close' => 'Zamknij',

    'start' => 'Uruchom',
    'restart' => 'Uruchom ponownie',
    'stop' => 'Zatrzymaj',
    'kill' => 'Kill',

    'kill_confirm' => 'Kill zatrzymuje kontener natychmiast. Wszystko, czego serwer nie zapisał jeszcze na dysku, zostanie utracone. Kontynuować?',

    'sent_title' => 'Akcja zasilania',
    'sent_body' => 'Wysłano :action do :name.',
    'failed' => 'Nie udało się połączyć z węzłem.',
];
