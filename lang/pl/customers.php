<?php

/*
 * Polski. Napisane ręcznie.
 *
 * Klienci: sklep, tylko zwrócony ku osobie zamiast ku wierszowi.
 *
 * Zamówienia, faktury i płatności to każde lista tego, co się wydarzyło. Ta
 * strona zadaje pytanie, które naprawdę ma ktoś odpowiadający na zgłoszenie:
 * kto to jest, co ma, co zapłacił i co zostało do zapłaty.
 */

return [
    'title' => 'Klienci',
    'nav_label' => 'Klienci',
    'subheading' => 'Wszyscy, którzy coś kupili, z tym, co mają, co zapłacili i co jeszcze są winni.',

    // ---- tabela ----------------------------------------------------------
    'column_customer' => 'Klient',
    'column_services' => 'Usługi',
    'column_spent' => 'Zapłacone',
    'column_outstanding' => 'Do zapłaty',

    'of_orders' => 'z :count zamówionych',
    'nothing_owed' => 'Nic',

    'filter_owing' => 'Ma coś do zapłaty',
    'filter_active' => 'Ma aktywną usługę',

    // ---- jeden z nich ----------------------------------------------------
    'open' => 'Otwórz',
    'close' => 'Zamknij',
    'servers' => 'Serwery',
    'since' => 'Klient od',
    'their_services' => 'Usługi',
    'their_invoices' => 'Faktury',
    'no_services' => 'Nic aktywnego i nic czekającego na zbudowanie.',
    'no_invoices' => 'Dla tego konta nie wystawiono żadnej faktury.',

    'empty' => 'Nikt jeszcze nic nie kupił',
    'empty_body' => 'Tu są ci, którzy złożyli zamówienie, nie każdy z kontem - więc zapełnia się przy pierwszej sprzedaży.',
];
