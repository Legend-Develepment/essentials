<?php

/*
 * Čeština. Psáno rukou.
 *
 * Faktury: doklad, stránka se seznamem a e-mail.
 *
 * Tenhle soubor sdílí tři čtenáři. Správce čte tabulku a mačká „označit jako
 * zaplacenou"; zákazník čte doklad k vytištění a e-mail; a samotný doklad čte
 * o měsíce později někdo, kdo vede účetnictví. Kvůli tomu poslednímu jsou řádky
 * doc_ střízlivé a formální - faktura není místo pro tón zbytku panelu.
 */

return [
    'title' => 'Faktury',
    'nav_label' => 'Faktury',
    'subheading' => 'Co se dluží a co je zaplaceno. Označit fakturu zde udělá všechno, co by udělalo zaplacení: server se postaví, pozastavený se vrátí.',

    // ---- tabulka ---------------------------------------------------------
    'column_number' => 'Faktura',
    'column_customer' => 'Zákazník',
    'column_order' => 'Objednávka',
    'column_total' => 'Celkem',
    'column_state' => 'Stav',
    'column_due' => 'Splatnost',

    'kind_order' => 'První faktura',
    'kind_renewal' => 'Obnovení',

    'state_unpaid' => 'Nezaplacená',
    'state_paid' => 'Zaplacená',
    'state_cancelled' => 'Stažená',

    'no_order' => 'Bez objednávky',
    'no_due' => 'Bez data',
    'gone_customer' => 'Účet smazán',
    'discount_of' => ':amount sleva s kódem :code',
    'paid_via' => 'přes :how',
    'emailed' => 'Odeslána',
    'not_emailed' => 'Neodeslána',
    'filter_overdue' => 'Po splatnosti',

    // ---- tlačítka --------------------------------------------------------
    'open' => 'Otevřít',
    'mark_paid' => 'Označit jako zaplacenou',
    'mark_paid_confirm' => 'Zaznamená, že peníze dorazily. Server se postaví, pozastavený se zase rozjede a další splatnost se posune - přesně jako by to řekla platební brána.',
    'paid' => 'Označena jako zaplacená',
    'paid_body' => 'Všechno, co na tuhle fakturu čekalo, je na cestě.',
    'already_paid' => 'Už byla zaplacená',

    'withdraw' => 'Stáhnout',
    'withdraw_confirm' => 'Vyjme fakturu z účetnictví. Stáhnout jde jen nezaplacená; zaplacená faktura je záznam o penězích, které změnily majitele.',
    'withdrawn' => 'Stažena',
    'withdraw_refused' => 'Stáhnout jde jen nezaplacená faktura',

    'empty' => 'Zatím žádné faktury',
    'empty_body' => 'První se vypíše, jakmile si někdo koupí, a pak jedna za období u všeho, co se obnovuje.',

    // ---- doklad ----------------------------------------------------------
    'doc_title' => 'Faktura',
    'doc_number' => 'Číslo',
    'doc_issued' => 'Vystaveno',
    'doc_due' => 'Splatnost',
    'doc_paid_on' => 'Zaplaceno',
    'doc_billed_to' => 'Odběratel',
    'doc_from' => 'Dodavatel',
    'doc_description' => 'Popis',
    'doc_amount' => 'Částka',
    'doc_subtotal' => 'Základ',
    'doc_discount' => 'Sleva',
    'doc_total' => 'Celkem',
    'doc_how_to_pay' => 'Jak zaplatit',
    'doc_print' => 'Vytisknout nebo uložit jako PDF',
    'doc_back' => 'Zpět do panelu',

    // ---- e-mail ----------------------------------------------------------
    'mail_subject' => 'Faktura :number',
    'mail_hello' => 'Ahoj :name,',
    'mail_intro' => 'Tady je faktura :number.',
    'mail_open' => 'Otevřít fakturu',
    'mail_foot' => 'Tuhle fakturu si můžeš kdykoli přečíst na své stránce plateb.',

    // ---- zvoneček --------------------------------------------------------
    'bell_new' => 'Faktura :number',
    'bell_new_body' => 'K zaplacení je :total. Otevři si stránku plateb.',
];
