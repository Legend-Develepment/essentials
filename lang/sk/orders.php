<?php

/*
 * Slovenčina. Písané rukou.
 *
 * Objednávky: čo si niekto kúpil a čo z toho vzišlo.
 *
 * Štyri stavy nižšie hovoria o peniazoch, nie o serveri. Či server práve beží,
 * je otázka samotného Pelicanu a odpovedajú na ňu jeho vlastné stránky. Slová
 * tu držia obe veci oddelene.
 */

return [
    'title' => 'Objednávky',
    'nav_label' => 'Objednávky',
    'subheading' => 'Všetko, čo sa predalo, server, ktorý z toho vznikol, a ako na tom je.',

    // ---- tabuľka ---------------------------------------------------------
    'column_order' => 'Objednávka',
    'column_customer' => 'Zákazník',
    'column_package' => 'Balík',
    'column_server' => 'Server',
    'column_state' => 'Stav',
    'column_due' => 'Ďalšia splatnosť',

    'no_server' => 'Zatiaľ nepostavený',
    'no_due' => 'Jednorazovo',
    'gone_customer' => 'Účet zmazaný',
    'gone_package' => 'Balík zmazaný',
    'overdue_days' => 'Po splatnosti o :days dní',

    'state_pending' => 'Čaká',
    'state_active' => 'Aktívna',
    'state_suspended' => 'Pozastavená',
    'state_cancelled' => 'Zrušená',

    // ---- tlačidlá --------------------------------------------------------
    'retry' => 'Postaviť znova',
    'retry_confirm' => 'Zaradí stavbu do frontu ešte raz. Nič ďalšie sa nemení a faktúra zostáva zaplatená.',
    'retrying' => 'Zaradené do frontu',

    'suspend' => 'Pozastaviť',
    'suspend_confirm' => 'Zastaví server vlastným pozastavením Pelicanu. Súbory, databázy a zálohy zostávajú, kde sú, a zaplatenie faktúry ho zase zloží.',
    'suspended' => 'Pozastavené',

    'unsuspend' => 'Zrušiť pozastavenie',
    'unsuspended' => 'Zase beží',

    'change_due' => 'Zmeniť splatnosť',
    'change_due_helper' => 'Kedy sa vypíše ďalšia faktúra. Prázdne znamená nikdy - objednávka sa prestane obnovovať bez toho, aby bola zrušená.',

    'cancel' => 'Zrušiť',
    'cancel_confirm' => 'Zastaví obnovovanie a vráti miesto v zásobe. Server zostáva: mazať sa chodí do Pelicanu, kam to patrí.',
    'cancelled' => 'Zrušené',

    'saved' => 'Uložené',
    'refused' => 'Nič sa nezmenilo',
    'refused_body' => 'Objednávka nie je v stave, kedy by to šlo. Načítaj stránku znova a pozri sa ešte raz.',

    // ---- čo počuje zákazník ----------------------------------------------
    'bell_ready' => 'Tvoj server je pripravený',
    'bell_ready_body' => ':server bol vytvorený a čaká, kým ho spustíš.',
    'bell_suspended' => 'Tvoj server bol pozastavený',
    'bell_suspended_body' => 'Faktúra zostala nezaplatená aj po lehote odkladu. Zaplatenie server zase spustí; nič nebolo zmazané.',

    // ---- čo počuje správca -----------------------------------------------
    'bell_failed' => 'Objednávku :number sa nepodarilo postaviť',
    'no_allocation' => 'Žiadny node v tomto balíku nemá voľnú allocation. Pridaj ju a postav znova.',
    'no_reason' => 'Panel to odmietol bez toho, aby povedal prečo.',

    // ---- server, ktorý z toho vzíde --------------------------------------
    'server_description' => 'Kúpené v obchode, objednávka :number.',
    'server_fallback' => 'Server',

    'empty' => 'Zatiaľ sa nič nepredalo',
    'empty_body' => 'Objednávky sa tu objavia, len čo si niekto kúpi balík.',
];
