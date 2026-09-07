<?php

/*
 * Čeština. Psáno ručně.
 *
 * Ovládací lišta na stránce serveru. Vlastní soubor, ne kout v settings.php,
 * protože tohle čte ten, kdo panel používá, ne ten, kdo nastavuje motiv.
 *
 * Stav vedle tlačítek je slovo samotného Pelicanu, převzaté z výčtu
 * ContainerStatus, aby se lišta a stránka konzole nikdy nerozcházely v tom, co
 * server právě dělá.
 *
 * "Kill" zůstává anglicky: tak se jmenuje tlačítko Pelicanu a tak se jmenuje
 * příkaz, a není to totéž co zastavení.
 */

return [
    'console' => 'Konzole',
    'full_page' => 'Nové okno',
    'close' => 'Zavřít',

    'start' => 'Spustit',
    'restart' => 'Restartovat',
    'stop' => 'Zastavit',
    'kill' => 'Kill',

    'kill_confirm' => 'Kill zastaví kontejner na místě. Vše, co server ještě nezapsal na disk, bude ztraceno. Pokračovat?',

    'sent_title' => 'Akce napájení',
    'sent_body' => ':action bylo odesláno na :name.',
    'failed' => 'Uzel nebyl dostupný.',
];
