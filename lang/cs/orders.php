<?php

/*
 * Čeština. Psáno rukou.
 *
 * Objednávky: co si někdo koupil a co z toho vzešlo.
 *
 * Čtyři stavy níže mluví o penězích, ne o serveru. Jestli server právě běží, je
 * otázka samotného Pelicanu a odpovídají na ni jeho vlastní stránky. Slova zde
 * obě věci drží od sebe.
 */

return [
    'title' => 'Objednávky',
    'nav_label' => 'Objednávky',
    'subheading' => 'Všechno, co se prodalo, server, který z toho vznikl, a jak na tom je.',

    // ---- tabulka ---------------------------------------------------------
    'column_order' => 'Objednávka',
    'column_customer' => 'Zákazník',
    'column_package' => 'Balíček',
    'column_server' => 'Server',
    'column_state' => 'Stav',
    'column_due' => 'Další splatnost',

    'no_server' => 'Zatím nepostaven',
    'no_due' => 'Jednorázově',
    'gone_customer' => 'Účet smazán',
    'gone_package' => 'Balíček smazán',
    'overdue_days' => 'Po splatnosti o :days dní',

    'state_pending' => 'Čeká',
    'state_active' => 'Aktivní',
    'state_suspended' => 'Pozastavená',
    'state_cancelled' => 'Zrušená',

    // ---- tlačítka --------------------------------------------------------
    'retry' => 'Postavit znovu',
    'retry_confirm' => 'Zařadí stavbu do fronty ještě jednou. Nic dalšího se nemění a faktura zůstává zaplacená.',
    'retrying' => 'Zařazeno do fronty',

    'suspend' => 'Pozastavit',
    'suspend_confirm' => 'Zastaví server vlastním pozastavením Pelicanu. Soubory, databáze a zálohy zůstávají, kde jsou, a zaplacení faktury je zase sundá.',
    'suspended' => 'Pozastaveno',

    'unsuspend' => 'Zrušit pozastavení',
    'unsuspended' => 'Zase běží',

    'change_due' => 'Změnit splatnost',
    'change_due_helper' => 'Kdy se vypíše další faktura. Prázdné znamená nikdy - objednávka se přestane obnovovat, aniž by byla zrušená.',

    'cancel' => 'Zrušit',
    'cancel_confirm' => 'Zastaví obnovování a vrátí místo v zásobě. Server zůstává: mazat se chodí do Pelicanu, kam to patří.',
    'cancelled' => 'Zrušeno',

    'saved' => 'Uloženo',
    'refused' => 'Nic se nezměnilo',
    'refused_body' => 'Objednávka není ve stavu, kdy by to šlo. Načti stránku znovu a podívej se ještě jednou.',

    // ---- co slyší zákazník -----------------------------------------------
    'bell_ready' => 'Tvůj server je připraven',
    'bell_ready_body' => ':server byl vytvořen a čeká, až ho spustíš.',
    'bell_suspended' => 'Tvůj server byl pozastaven',
    'bell_suspended_body' => 'Faktura zůstala nezaplacená i po lhůtě odkladu. Zaplacení server zase spustí; nic nebylo smazáno.',

    // ---- co slyší správce ------------------------------------------------
    'bell_failed' => 'Objednávku :number se nepodařilo postavit',
    'no_allocation' => 'Žádný node v tomto balíčku nemá volnou allocation. Přidej ji a postav znovu.',
    'no_reason' => 'Panel to odmítl, aniž by řekl proč.',

    // ---- server, který z toho vzejde -------------------------------------
    'server_description' => 'Koupeno v obchodě, objednávka :number.',
    'server_fallback' => 'Server',

    'empty' => 'Zatím se nic neprodalo',
    'empty_body' => 'Objednávky se tu objeví, jakmile si někdo koupí balíček.',
];
