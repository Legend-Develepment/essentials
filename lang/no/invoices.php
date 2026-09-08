<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * Fakturaer: dokumentet, siden med listen og e-posten.
 *
 * Tre lesere deler denne filen. En administrator leser tabellen og trykker
 * "merk som betalt"; en kunde leser dokumentet som kan skrives ut, og
 * e-posten; og selve dokumentet leses måneder senere av den som fører
 * regnskapet. Det er derfor doc_-linjene er tørre og formelle - en faktura er
 * ikke stedet for tonen i resten av panelet.
 */

return [
    'title' => 'Fakturaer',
    'nav_label' => 'Fakturaer',
    'subheading' => 'Hva som skyldes, og hva som er betalt. Å merke en som betalt her gjør alt betaling ville gjort: serveren blir bygget, en suspendert kommer tilbake.',

    // ---- tabellen --------------------------------------------------------
    'column_number' => 'Faktura',
    'column_customer' => 'Kunde',
    'column_order' => 'Bestilling',
    'column_total' => 'Totalt',
    'column_state' => 'Tilstand',
    'column_due' => 'Forfaller',

    'kind_order' => 'Første faktura',
    'kind_renewal' => 'Fornyelse',

    'state_unpaid' => 'Ubetalt',
    'state_paid' => 'Betalt',
    'state_cancelled' => 'Trukket tilbake',

    'no_order' => 'Ingen bestilling',
    'no_due' => 'Ingen dato',
    'gone_customer' => 'Konto slettet',
    'discount_of' => ':amount i rabatt med :code',
    'paid_via' => 'gjennom :how',
    'emailed' => 'Sendt',
    'not_emailed' => 'Ikke sendt',
    'filter_overdue' => 'På overtid',

    // ---- knappene --------------------------------------------------------
    'open' => 'Åpne',
    'mark_paid' => 'Merk som betalt',
    'mark_paid_confirm' => 'Noterer at pengene er kommet. Serveren blir bygget, en suspendert starter igjen, og neste forfall flyttes fram - akkurat som om en betalingsleverandør hadde sagt det.',
    'paid' => 'Merket som betalt',
    'paid_body' => 'Alt som ventet på denne fakturaen, er på vei.',
    'already_paid' => 'Den var allerede betalt',

    'withdraw' => 'Trekk tilbake',
    'withdraw_confirm' => 'Tar fakturaen ut av bøkene. Bare en ubetalt kan trekkes tilbake; en betalt faktura er dokumentasjon på penger som har skiftet hender.',
    'withdrawn' => 'Trukket tilbake',
    'withdraw_refused' => 'Bare en ubetalt faktura kan trekkes tilbake',

    'empty' => 'Ingen fakturaer ennå',
    'empty_body' => 'Det skrives en så snart noen kjøper, og deretter en per periode for alt som fornyer seg.',

    // ---- dokumentet ------------------------------------------------------
    'doc_title' => 'Faktura',
    'doc_number' => 'Nummer',
    'doc_issued' => 'Utstedt',
    'doc_due' => 'Forfallsdato',
    'doc_paid_on' => 'Betalt',
    'doc_billed_to' => 'Fakturert til',
    'doc_from' => 'Fra',
    'doc_description' => 'Beskrivelse',
    'doc_amount' => 'Beløp',
    'doc_subtotal' => 'Delsum',
    'doc_discount' => 'Rabatt',
    'doc_total' => 'Totalt',
    'doc_how_to_pay' => 'Slik betaler du',
    'doc_print' => 'Skriv ut eller lagre som PDF',
    'doc_back' => 'Tilbake til panelet',

    // ---- e-posten --------------------------------------------------------
    'mail_subject' => 'Faktura :number',
    'mail_hello' => 'Hei :name,',
    'mail_intro' => 'Her er faktura :number.',
    'mail_open' => 'Åpne fakturaen',
    'mail_foot' => 'Du kan lese denne fakturaen når som helst på faktureringssiden din.',

    // ---- bjella ----------------------------------------------------------
    'bell_new' => 'Faktura :number',
    'bell_new_body' => ':total skal betales. Åpne faktureringssiden din for å betale.',
];
