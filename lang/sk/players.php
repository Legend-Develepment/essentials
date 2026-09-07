<?php

/*
 * Slovenčina. Písané ručne.
 *
 * „Whitelist" a „operator" ostávajú po anglicky: to sú slová, ktoré samotný
 * Minecraft píše do server.properties, do whitelist.json a do ops.json, a tie
 * isté sa naspäť ťukajú do konzoly.
 */

return [
    'nav_label' => 'Hráči',
    'title' => 'Hráči',
    'subheading' => 'Whitelist, operators, bany a všetci, koho tento server videl.',

    /*
     * Povedané raz, hore, lebo to vysvetľuje aj to, čo stránka vie, aj to,
     * prečo jedna vec, ktorú nerobí, nie je chyba. Každá zmena odchádza ako
     * príkaz do konzoly, lebo práve takto sa to Minecraftu má povedať - hra
     * zmenu vykoná a zapíše si vlastný súbor, takže sa tí dvaja nikdy
     * nerozídu.
     */
    'how' => 'Zmeny sa na server posielajú ako príkazy konzoly, takže ich vykonáva hra a ona sama si píše svoje súbory. Na to musí server bežať.',
    'needs_running' => 'Server musí bežať. Tieto zmeny robí hra, nie úprava jej súborov popod ňu.',

    'name' => 'Meno hráča',
    'reason' => 'Dôvod (nepovinné)',

    'whitelist' => 'Pridať do whitelistu',
    'unwhitelist' => 'Odobrať z whitelistu',
    'op' => 'Urobiť operatorom',
    'deop' => 'Odobrať operatora',
    'ban' => 'Zabanovať',
    'pardon' => 'Odbanovať',
    'kick' => 'Vyhodiť',

    'sent' => 'Príkaz odoslaný',
    'sent_body' => 'Server ho použije a aktualizuje si vlastné súbory. Načítajte stránku znova, nech uvidíte zmenené zoznamy.',
    'refused' => 'Toto sa neodoslalo',

    'flag_op' => 'Operator',
    'flag_whitelisted' => 'Vo whiteliste',
    'flag_banned' => 'Zabanovaný',
    'flag_seen' => 'Už tu hral',

    'online' => 'Práve online',
    'online_count' => ':online z :max',
    'online_none' => 'Nikto nie je pripojený.',

    'players' => 'Hráči',
    'ips' => 'Zabanované adresy',
    'ips_empty' => 'Žiadna adresa nie je zabanovaná.',

    /*
     * Čo znamená prázdna stránka, a obyčajne to neznamená „žiadni hráči", ale
     * „tento server ešte nikdy nenabehol". Minecraft žiadny z týchto súborov
     * pred prvým behom nevytvorí.
     */
    'empty' => 'Zatiaľ nie je čo ukázať. Minecraft si tieto zoznamy píše sám a nevytvorí ich, kým server prvýkrát nenabehne.',

    'level' => 'Úroveň :level',

    /*
     * Jediná vec, ktorú táto stránka nerobí, povedaná rovno, nie ponechaná na
     * objavenie. Stav naživo potrebuje druhé pripojenie k samotnej hre, a to je
     * iná funkcia s vlastnými nárokmi.
     */
    'not_live' => 'Toto je to, čo si server zapísal, nie to, kto je pripojený práve teraz.',
];
