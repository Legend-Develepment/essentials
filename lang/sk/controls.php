<?php

/*
 * Slovenčina. Písané ručne.
 *
 * Ovládacia lišta na stránke servera. Vlastný súbor, nie kút v settings.php,
 * lebo toto číta ten, kto panel používa, nie ten, kto nastavuje motív.
 *
 * Stav vedľa tlačidiel je slovo samotného Pelicanu, prevzaté z výpočtu
 * ContainerStatus, aby sa lišta a stránka konzoly nikdy nerozchádzali v tom, čo
 * server práve robí.
 *
 * "Kill" ostáva po anglicky: tak sa volá tlačidlo Pelicanu a tak sa volá
 * príkaz, a nie je to to isté ako zastavenie.
 */

return [
    'console' => 'Konzola',
    'full_page' => 'Nové okno',
    'close' => 'Zavrieť',

    'start' => 'Spustiť',
    'restart' => 'Reštartovať',
    'stop' => 'Zastaviť',
    'kill' => 'Kill',

    'kill_confirm' => 'Kill zastaví kontajner okamžite. Všetko, čo server ešte nezapísal na disk, sa stratí. Pokračovať?',

    'sent_title' => 'Akcia napájania',
    'sent_body' => ':action bolo odoslané na :name.',
    'failed' => 'Uzol nebol dostupný.',
];
