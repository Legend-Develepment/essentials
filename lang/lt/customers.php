<?php

/*
 * Lietuvių. Parašyta ranka.
 *
 * Klientai: parduotuvė, tik atsukta į žmogų, o ne į eilutę.
 *
 * Užsakymai, sąskaitos ir mokėjimai - kiekvienas jų yra sąrašas to, kas įvyko.
 * Šis puslapis kelia klausimą, kurį iš tikrųjų turi tas, kuris atsako į
 * užklausą: kas tai, ką jis turi, ką sumokėjo ir kas lieka.
 */

return [
    'title' => 'Klientai',
    'nav_label' => 'Klientai',
    'subheading' => 'Visi, kurie ką nors nusipirko, su tuo, ką turi, ką sumokėjo ir ką dar skolingi.',

    // ---- lentelė ---------------------------------------------------------
    'column_customer' => 'Klientas',
    'column_services' => 'Paslaugos',
    'column_spent' => 'Sumokėta',
    'column_outstanding' => 'Neapmokėta',

    'of_orders' => 'iš :count užsakytų',
    'nothing_owed' => 'Nieko',

    'filter_owing' => 'Yra skolingas',
    'filter_active' => 'Turi veikiančią paslaugą',

    // ---- vienas iš jų ----------------------------------------------------
    'open' => 'Atverti',
    'close' => 'Užverti',
    'servers' => 'Serveriai',
    'since' => 'Klientas nuo',
    'their_services' => 'Paslaugos',
    'their_invoices' => 'Sąskaitos',
    'no_services' => 'Nieko veikiančio ir nieko, kas lauktų sukūrimo.',
    'no_invoices' => 'Šiai paskyrai nebuvo išrašyta nė viena sąskaita.',

    'empty' => 'Kol kas niekas nieko nenusipirko',
    'empty_body' => 'Čia rodomi tie, kurie užsakė, o ne visi turintys paskyrą - taigi sąrašas prisipildys nuo pirmo pardavimo.',
    'who' => 'Kas jis toks',
];
