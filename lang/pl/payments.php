<?php

/*
 * Polski. Napisane ręcznie.
 *
 * Płatności: każda próba zapłaty i to, co operator o niej powiedział.
 *
 * Jeden wiersz na próbę, nie na fakturę, bo tak to się odbyło. Słowo, które ta
 * strona powtarza, to „próba": nieudana płatność jest faktem wartym zapisania,
 * nie pomyłką do ukrycia.
 */

return [
    'title' => 'Płatności',
    'nav_label' => 'Płatności',
    'subheading' => 'Każda próba zapłaty, u każdego operatora. Sprawdź ponownie pyta operatora jeszcze raz - dokładnie to, co robi ich webhook, kiedy dotrze.',

    // ---- tabela ----------------------------------------------------------
    'column_invoice' => 'Faktura',
    'column_gateway' => 'Operator',
    'column_reference' => 'Ich numer',
    'column_amount' => 'Kwota',
    'column_state' => 'Stan',
    'column_updated' => 'Ostatnia wiadomość',

    'gone_invoice' => 'Faktura usunięta',

    'state_open' => 'Czeka',
    'state_paid' => 'Zapłacona',
    'state_failed' => 'Nieudana',
    'state_cancelled' => 'Porzucona',

    // ---- przyciski -------------------------------------------------------
    'recheck' => 'Sprawdź ponownie',
    'rechecked' => 'Zapytano jeszcze raz',
    'rechecked_body' => 'Operator nadal nie mówi, że jest zapłacone. Nic się nie zmieniło.',
    'settled' => 'Jest zapłacone',
    'settled_body' => 'Faktura jest rozliczona, a wszystko, co na nią czekało, jest w drodze.',
    'recheck_failed' => 'Nie udało się zapytać',
    'recheck_failed_body' => 'Operator nie odpowiedział. Spróbuj za minutę; jeśli to się powtarza, sprawdź klucz na stronie Ustawienia sklepu.',
    'no_gateway' => 'Ten operator jest wyłączony',
    'no_gateway_body' => 'Włącz go z powrotem, żeby zapytać o tę płatność, albo oznacz fakturę jako opłaconą ręcznie.',

    'answer' => 'Ich odpowiedź',
    'no_answer' => 'Nic nie zapisano',
    'close' => 'Zamknij',

    'empty' => 'Nikt jeszcze nie zapłacił przez operatora',
    'empty_body' => 'Próby pojawiają się tutaj w chwili, gdy ktoś naciśnie Zapłać - niezależnie od tego, czy dokończy.',
];
