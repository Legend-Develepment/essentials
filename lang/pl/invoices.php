<?php

/*
 * Polski. Napisane ręcznie.
 *
 * Faktury: dokument, strona z listą i wiadomość.
 *
 * Ten plik dzieli trzech czytelników. Administrator czyta tabelę i naciska
 * „oznacz jako opłaconą"; klient czyta dokument do druku i wiadomość; a sam
 * dokument czyta miesiące później ktoś, kto prowadzi księgowość. Właśnie
 * dlatego wiersze doc_ są suche i formalne - faktura nie jest miejscem na ton
 * reszty panelu.
 */

return [
    'title' => 'Faktury',
    'nav_label' => 'Faktury',
    'subheading' => 'Co jest do zapłaty i co zostało opłacone. Oznaczenie tutaj robi wszystko to, co zrobiłaby zapłata: serwer zostaje zbudowany, zawieszony wraca.',

    // ---- tabela ----------------------------------------------------------
    'column_number' => 'Faktura',
    'column_customer' => 'Klient',
    'column_order' => 'Zamówienie',
    'column_total' => 'Razem',
    'column_state' => 'Stan',
    'column_due' => 'Termin',

    'kind_order' => 'Pierwsza faktura',
    'kind_renewal' => 'Odnowienie',

    'state_unpaid' => 'Nieopłacona',
    'state_paid' => 'Opłacona',
    'state_cancelled' => 'Wycofana',

    'no_order' => 'Bez zamówienia',
    'no_due' => 'Bez daty',
    'gone_customer' => 'Konto usunięte',
    'discount_of' => ':amount rabatu z kodem :code',
    'paid_via' => 'przez :how',
    'emailed' => 'Wysłana',
    'not_emailed' => 'Niewysłana',
    'filter_overdue' => 'Po terminie',

    // ---- przyciski -------------------------------------------------------
    'open' => 'Otwórz',
    'mark_paid' => 'Oznacz jako opłaconą',
    'mark_paid_confirm' => 'Zapisuje, że pieniądze dotarły. Serwer zostaje zbudowany, zawieszony rusza z powrotem, a następny termin przesuwa się do przodu - dokładnie tak, jakby powiedział to operator płatności.',
    'paid' => 'Oznaczona jako opłacona',
    'paid_body' => 'Wszystko, co czekało na tę fakturę, jest w drodze.',
    'already_paid' => 'Była już opłacona',

    'withdraw' => 'Wycofaj',
    'withdraw_confirm' => 'Zdejmuje fakturę z ksiąg. Wycofać można tylko nieopłaconą; opłacona faktura jest zapisem pieniędzy, które zmieniły właściciela.',
    'withdrawn' => 'Wycofana',
    'withdraw_refused' => 'Wycofać można tylko nieopłaconą fakturę',

    'empty' => 'Jeszcze nie ma faktur',
    'empty_body' => 'Pierwsza powstaje, gdy tylko ktoś kupi, a potem po jednej na okres dla wszystkiego, co się odnawia.',

    // ---- dokument --------------------------------------------------------
    'doc_title' => 'Faktura',
    'doc_number' => 'Numer',
    'doc_issued' => 'Wystawiono',
    'doc_due' => 'Termin płatności',
    'doc_paid_on' => 'Opłacono',
    'doc_billed_to' => 'Nabywca',
    'doc_from' => 'Sprzedawca',
    'doc_description' => 'Opis',
    'doc_amount' => 'Kwota',
    'doc_subtotal' => 'Netto',
    'doc_discount' => 'Rabat',
    'doc_total' => 'Razem',
    'doc_how_to_pay' => 'Jak zapłacić',
    'doc_print' => 'Wydrukuj lub zapisz jako PDF',
    'doc_back' => 'Wróć do panelu',

    // ---- wiadomość -------------------------------------------------------
    'mail_subject' => 'Faktura :number',
    'mail_hello' => 'Cześć :name,',
    'mail_intro' => 'Oto faktura :number.',
    'mail_open' => 'Otwórz fakturę',
    'mail_foot' => 'Tę fakturę możesz przeczytać w każdej chwili na swojej stronie płatności.',

    // ---- dzwonek ---------------------------------------------------------
    'bell_new' => 'Faktura :number',
    'bell_new_body' => 'Do zapłaty :total. Otwórz swoją stronę płatności, żeby zapłacić.',
    'bell_reminder' => 'Faktura :number jest po terminie',
    'bell_reminder_body' => 'Wciąż jest do zapłaty :total. Serwer, za który płaci, zatrzyma się :date, jeśli do tego czasu nie zostanie opłacona, a nic na nim nie zostanie wtedy usunięte.',
];
