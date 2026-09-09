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
    'state_ending' => 'Končí',
    'ends_on' => 'Končí :date',
    'no_more_dues' => 'Už sa neúčtuje',
    'cancel_confirm_open' => 'Zastaví obnovovanie hneď teraz a vráti miesto v zásobe. Server ostáva bežať: tento balík nemá minimálnu viazanosť, takže niet dátumu, ku ktorému by dobehol. Server zmaž v Pelicane, keď ho zákazník už nepotrebuje.',
    'terminate' => 'Zastaviť a zmazať',
    'terminate_heading' => 'Zmazať tento server?',
    'terminate_confirm' => 'Server sa zmaže teraz, aj so súbormi, databázami a zálohami. Niet cesty späť ani čakania na koniec zmluvy. Ak si ho má zákazník nechať do dátumu, ktorý dostal, zruš objednávku namiesto toho.',
    'terminate_go' => 'Zmazať',
    'terminated' => 'Zmazané',
    'terminated_body' => 'Server je preč a objednávka je uzavretá.',
    'bell_ending' => 'Tvoj :package sa končí :date',
    'bell_ending_open' => 'Tvoj :package bol zrušený',
    'bell_ending_body' => 'Už ti za to nič vyúčtované nebude. Všetko na serveri sa zmaže, keď sa zastaví, tak si skopíruj, čo si chceš nechať.',
    'bell_ended' => 'Tvoj :package sa skončil',
    'bell_ended_body' => 'Zmluva sa skončila a server bol zmazaný.',
    'bell_undeleted' => 'Objednávku :number sa nepodarilo zmazať',
    'bell_undeleted_body' => 'Panel odmietol server zmazať. Objednávka je uzavretá a nikomu sa za ňu nebude účtovať, ale server tam stále je a treba ho odstrániť v Pelicane.',
    'bell_undelivered' => 'Súbor k objednávke :number je tu stále',
    'bell_undelivered_body' => 'Server bol postavený, ale súbor, ktorý zákazník nahral, sa doň nepodarilo vložiť. Stále leží v úložisku panela a dôvod stojí v storage/logs.',
    'by_customer' => 'Ukončená zákazníkom',
    'by_admin' => 'Ukončená tu',
    'filter_by' => 'Kto ukončil',
    'details' => 'Podrobnosti',
    'details_of' => 'Objednávka :number',
    'close' => 'Zavrieť',
    'detail_package' => 'Balík',
    'detail_placed' => 'Odoslaná',
    'detail_built' => 'Server postavený',
    'detail_due' => 'Ďalšia splatnosť',
    'detail_ends' => 'Končí',
    'detail_suspended' => 'Pozastavená',
    'detail_cancelled' => 'Zrušená',
    'detail_file_in' => 'Súbor vložený',
    'detail_file_waiting' => 'Súbor',
    'detail_file_waiting_value' => 'Nahraný, čaká na postavenie servera.',
    'detail_note' => 'Posledný problém',

    'empty' => 'Zatiaľ sa nič nepredalo',
    'empty_body' => 'Objednávky sa tu objavia, len čo si niekto kúpi balík.',

    // ---- obnovenia -------------------------------------------------------
    'filter_late' => 'Pozadu s faktúrou',
    'run_renewals' => 'Spustiť obnovenia teraz',
    'run_renewals_confirm' => 'Urobí to, čo nočný prechod: vypíše ďalšiu faktúru pre všetko, čomu sa blíži splatnosť, a zastaví servery za faktúrou, ktorá zostala nezaplatená po lehote odkladu.',
    'renewals_queued' => 'Zaradené do frontu',
    'renewals_queued_body' => 'Beží vo fronte. O chvíľu načítaj stránku znova a uvidíš, čo sa zmenilo.',
];
