<?php

/*
 * Slovenčina. Písané rukou.
 *
 * Faktúry: doklad, stránka so zoznamom a e-mail.
 *
 * Tento súbor zdieľajú traja čitatelia. Správca číta tabuľku a stláča „označiť
 * ako zaplatenú"; zákazník číta doklad na tlač a e-mail; a samotný doklad číta
 * o mesiace neskôr niekto, kto vedie účtovníctvo. Kvôli tomu poslednému sú
 * riadky doc_ striezlivé a formálne - faktúra nie je miesto pre tón zvyšku
 * panela.
 */

return [
    'title' => 'Faktúry',
    'nav_label' => 'Faktúry',
    'subheading' => 'Čo sa dlhuje a čo je zaplatené. Označiť faktúru tu urobí všetko, čo by urobilo zaplatenie: server sa postaví, pozastavený sa vráti.',

    // ---- tabuľka ---------------------------------------------------------
    'column_number' => 'Faktúra',
    'column_customer' => 'Zákazník',
    'column_order' => 'Objednávka',
    'column_total' => 'Spolu',
    'column_state' => 'Stav',
    'column_due' => 'Splatnosť',

    'kind_order' => 'Prvá faktúra',
    'kind_renewal' => 'Obnovenie',

    'state_unpaid' => 'Nezaplatená',
    'state_paid' => 'Zaplatená',
    'state_cancelled' => 'Stiahnutá',

    'no_order' => 'Bez objednávky',
    'no_due' => 'Bez dátumu',
    'gone_customer' => 'Účet zmazaný',
    'discount_of' => ':amount zľava s kódom :code',
    'paid_via' => 'cez :how',
    'emailed' => 'Odoslaná',
    'not_emailed' => 'Neodoslaná',
    'filter_overdue' => 'Po splatnosti',

    // ---- tlačidlá --------------------------------------------------------
    'open' => 'Otvoriť',
    'mark_paid' => 'Označiť ako zaplatenú',
    'mark_paid_confirm' => 'Zaznamená, že peniaze dorazili. Server sa postaví, pozastavený sa zase rozbehne a ďalšia splatnosť sa posunie - presne tak, ako keby to povedala platobná brána.',
    'paid' => 'Označená ako zaplatená',
    'paid_body' => 'Všetko, čo na túto faktúru čakalo, je na ceste.',
    'already_paid' => 'Už bola zaplatená',

    'withdraw' => 'Stiahnuť',
    'withdraw_confirm' => 'Vyberie faktúru z účtovníctva. Stiahnuť sa dá len nezaplatená; zaplatená faktúra je záznam o peniazoch, ktoré zmenili majiteľa.',
    'withdrawn' => 'Stiahnutá',
    'withdraw_refused' => 'Stiahnuť sa dá len nezaplatená faktúra',

    'empty' => 'Zatiaľ žiadne faktúry',
    'empty_body' => 'Prvá sa vypíše, len čo si niekto kúpi, a potom jedna za obdobie pri všetkom, čo sa obnovuje.',

    // ---- doklad ----------------------------------------------------------
    'doc_title' => 'Faktúra',
    'doc_number' => 'Číslo',
    'doc_issued' => 'Vystavené',
    'doc_due' => 'Splatnosť',
    'doc_paid_on' => 'Zaplatené',
    'doc_billed_to' => 'Odberateľ',
    'doc_from' => 'Dodávateľ',
    'doc_description' => 'Popis',
    'doc_amount' => 'Suma',
    'doc_subtotal' => 'Základ',
    'doc_discount' => 'Zľava',
    'doc_total' => 'Spolu',
    'doc_how_to_pay' => 'Ako zaplatiť',
    'doc_print' => 'Vytlačiť alebo uložiť ako PDF',
    'doc_back' => 'Späť do panela',

    // ---- e-mail ----------------------------------------------------------
    'mail_subject' => 'Faktúra :number',
    'mail_hello' => 'Ahoj :name,',
    'mail_intro' => 'Tu je faktúra :number.',
    'mail_open' => 'Otvoriť faktúru',
    'mail_foot' => 'Túto faktúru si môžeš kedykoľvek prečítať na svojej stránke platieb.',

    // ---- zvonček ---------------------------------------------------------
    'bell_new' => 'Faktúra :number',
    'bell_new_body' => 'Na zaplatenie je :total. Otvor si stránku platieb.',
];
