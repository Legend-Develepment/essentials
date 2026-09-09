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
    'state_ending' => 'Končí',
    'ends_on' => 'Končí :date',
    'no_more_dues' => 'Už se nefakturuje',
    'cancel_confirm_open' => 'Zastaví obnovování teď a vrátí místo v zásobě. Server zůstává běžet: tenhle balíček nemá minimální dobu, takže není datum, ke kterému by doběhl. Server smaž v Pelicanu, až s ním zákazník skončí.',
    'terminate' => 'Zastavit a smazat',
    'terminate_heading' => 'Smazat tenhle server?',
    'terminate_confirm' => 'Server se maže teď, se soubory, databázemi i zálohami. Není cesta zpět a nečeká se na konec smlouvy. Zruš to místo toho, když si ho zákazník má nechat do data, které dostal.',
    'terminate_go' => 'Smazat',
    'terminated' => 'Smazáno',
    'terminated_body' => 'Server je pryč a objednávka je uzavřená.',
    'bell_ending' => 'Tvůj :package končí :date',
    'bell_ending_open' => 'Tvůj :package byl zrušen',
    'bell_ending_body' => 'Už ti za to nebude nic účtováno. Všechno na serveru se smaže, až se zastaví, tak si zkopíruj, co si chceš nechat.',
    'bell_ended' => 'Tvůj :package skončil',
    'bell_ended_body' => 'Smlouva doběhla a server byl smazán.',
    'bell_undeleted' => 'Objednávku :number se nepodařilo smazat',
    'bell_undeleted_body' => 'Panel odmítl server smazat. Objednávka je uzavřená a nikomu se za ni fakturovat nebude, ale server pořád stojí a odstranit ho je potřeba v Pelicanu.',
    'bell_undelivered' => 'Soubor k objednávce :number tu pořád leží',
    'bell_undelivered_body' => 'Server byl postaven, ale soubor nahraný zákazníkem se do něj nepodařilo dostat. Pořád leží v úložišti panelu a důvod je v storage/logs.',
    'by_customer' => 'Ukončena zákazníkem',
    'by_admin' => 'Ukončena zde',
    'filter_by' => 'Kdo ukončil',
    'details' => 'Podrobnosti',
    'details_of' => 'Objednávka :number',
    'close' => 'Zavřít',
    'detail_package' => 'Balíček',
    'detail_placed' => 'Objednáno',
    'detail_built' => 'Server postaven',
    'detail_due' => 'Další splatnost',
    'detail_ends' => 'Končí',
    'detail_suspended' => 'Pozastavená',
    'detail_cancelled' => 'Zrušená',
    'detail_file_in' => 'Soubor vložen',
    'detail_file_waiting' => 'Soubor',
    'detail_file_waiting_value' => 'Nahrán, čeká na postavení serveru.',
    'detail_note' => 'Poslední problém',

    'empty' => 'Zatím se nic neprodalo',
    'empty_body' => 'Objednávky se tu objeví, jakmile si někdo koupí balíček.',

    // ---- obnovení --------------------------------------------------------
    'filter_late' => 'Pozadu s fakturou',
    'run_renewals' => 'Spustit obnovení teď',
    'run_renewals_confirm' => 'Udělá to, co noční průchod: vypíše další fakturu pro všechno, čemu se blíží splatnost, a zastaví servery za fakturou, která zůstala nezaplacená po lhůtě odkladu.',
    'renewals_queued' => 'Zařazeno do fronty',
    'renewals_queued_body' => 'Běží ve frontě. Za chvíli načti stránku znovu a uvidíš, co se změnilo.',
];
