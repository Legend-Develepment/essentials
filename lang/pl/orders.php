<?php

/*
 * Polski. Napisane ręcznie.
 *
 * Zamówienia: co ktoś kupił i co z tego wyszło.
 *
 * Cztery stany poniżej mówią o pieniądzach, nie o serwerze. To, czy serwer
 * właśnie działa, jest pytaniem samego Pelicana i odpowiadają na nie strony
 * Pelicana. Słowa tutaj trzymają te dwie rzeczy osobno.
 */

return [
    'title' => 'Zamówienia',
    'nav_label' => 'Zamówienia',
    'subheading' => 'Wszystko, co zostało kupione, serwer, który z tego powstał, i na czym stoi.',

    // ---- tabela ----------------------------------------------------------
    'column_order' => 'Zamówienie',
    'column_customer' => 'Klient',
    'column_package' => 'Pakiet',
    'column_server' => 'Serwer',
    'column_state' => 'Stan',
    'column_due' => 'Następny termin',

    'no_server' => 'Jeszcze nie zbudowany',
    'no_due' => 'Jednorazowo',
    'gone_customer' => 'Konto usunięte',
    'gone_package' => 'Pakiet usunięty',
    'overdue_days' => 'Po terminie o :days dni',

    'state_pending' => 'Czeka',
    'state_active' => 'Aktywne',
    'state_suspended' => 'Zawieszone',
    'state_cancelled' => 'Anulowane',

    // ---- przyciski -------------------------------------------------------
    'retry' => 'Zbuduj ponownie',
    'retry_confirm' => 'Wstawia budowanie do kolejki jeszcze raz. Nic więcej się nie zmienia, a faktura zostaje opłacona.',
    'retrying' => 'Wstawione do kolejki',

    'suspend' => 'Zawieś',
    'suspend_confirm' => 'Zatrzymuje serwer własnym zawieszeniem Pelicana. Pliki, bazy danych i kopie zapasowe zostają tam, gdzie są, a opłacenie faktury je zdejmuje.',
    'suspended' => 'Zawieszone',

    'unsuspend' => 'Zdejmij zawieszenie',
    'unsuspended' => 'Znowu działa',

    'change_due' => 'Zmień termin',
    'change_due_helper' => 'Kiedy zostanie wystawiona następna faktura. Puste znaczy nigdy - zamówienie przestaje się odnawiać, nie będąc anulowanym.',

    'cancel' => 'Anuluj',
    'cancel_confirm' => 'Zatrzymuje odnowienia i oddaje miejsce w zapasie. Serwer zostaje: usuwa się go w Pelicanie, gdzie jest na to miejsce.',
    'cancelled' => 'Anulowane',

    'saved' => 'Zapisano',
    'refused' => 'Nic się nie zmieniło',
    'refused_body' => 'Zamówienie nie jest w stanie, który by na to pozwalał. Odśwież stronę i spójrz jeszcze raz.',

    // ---- co słyszy klient ------------------------------------------------
    'bell_ready' => 'Twój serwer jest gotowy',
    'bell_ready_body' => ':server został utworzony i czeka, aż go uruchomisz.',
    'bell_suspended' => 'Twój serwer został zawieszony',
    'bell_suspended_body' => 'Faktura pozostała nieopłacona po okresie karencji. Opłacenie jej uruchamia serwer z powrotem; nic nie zostało usunięte.',

    // ---- co słyszy administrator -----------------------------------------
    'bell_failed' => 'Zamówienia :number nie udało się zbudować',
    'no_allocation' => 'Żaden node w tym pakiecie nie ma wolnej allocation. Dodaj jedną i zbuduj ponownie.',
    'no_reason' => 'Panel odmówił, nie mówiąc dlaczego.',

    // ---- serwer, który z tego powstaje -----------------------------------
    'server_description' => 'Kupione w sklepie, zamówienie :number.',
    'server_fallback' => 'Serwer',
    'state_ending' => 'Kończy się',
    'ends_on' => 'Kończy się :date',
    'no_more_dues' => 'Bez kolejnych faktur',
    'cancel_confirm_open' => 'Zatrzymuje odnowienia i oddaje miejsce w zapasie. Serwer zostaje uruchomiony: ten pakiet nie ma minimalnego okresu, więc nie ma daty, do której miałby dobiec. Usuń serwer w Pelicanie, gdy klient skończy z niego korzystać.',
    'terminate' => 'Zatrzymaj i usuń',
    'terminate_heading' => 'Usunąć ten serwer?',
    'terminate_confirm' => 'Serwer zostaje usunięty teraz, wraz z plikami, bazami danych i kopiami zapasowymi. Nie ma cofnięcia ani czekania na koniec umowy. Zamiast tego anuluj, jeśli klient ma go zatrzymać do daty, którą dostał.',
    'terminate_go' => 'Usuń go',
    'terminated' => 'Usunięto',
    'terminated_body' => 'Serwera nie ma, a zamówienie jest zamknięte.',
    'bell_ending' => 'Twój :package kończy się :date',
    'bell_ending_open' => 'Twój :package został anulowany',
    'bell_ending_body' => 'Nie zostaniesz za niego ponownie obciążony. Wszystko na serwerze zostaje usunięte, kiedy się zatrzyma, więc skopiuj sobie to, co chcesz zachować.',
    'bell_ended' => 'Twój :package dobiegł końca',
    'bell_ended_body' => 'Umowa się skończyła, a serwer został usunięty.',
    'bell_undeleted' => 'Zamówienia :number nie udało się usunąć',
    'bell_undeleted_body' => 'Panel odmówił usunięcia serwera. Zamówienie jest zamknięte i nikt nie zostanie za nie obciążony, ale serwer nadal stoi i trzeba go usunąć w Pelicanie.',
    'bell_undelivered' => 'Plik z zamówienia :number wciąż tu leży',
    'bell_undelivered_body' => 'Serwer został zbudowany, ale pliku wgranego przez klienta nie udało się do niego włożyć. Nadal jest w magazynie panelu, a powód stoi w storage/logs.',
    'by_customer' => 'Zakończone przez klienta',
    'by_admin' => 'Zakończone tutaj',
    'filter_by' => 'Kto zakończył',
    'details' => 'Szczegóły',
    'details_of' => 'Zamówienie :number',
    'close' => 'Zamknij',
    'detail_package' => 'Pakiet',
    'detail_placed' => 'Zamówiono',
    'detail_built' => 'Serwer zbudowany',
    'detail_due' => 'Następny termin',
    'detail_ends' => 'Kończy się',
    'detail_suspended' => 'Zawieszone',
    'detail_cancelled' => 'Anulowane',
    'detail_file_in' => 'Plik włożony',
    'detail_file_waiting' => 'Plik',
    'detail_file_waiting_value' => 'Wgrany, czeka na zbudowanie serwera.',
    'detail_note' => 'Ostatni problem',

    'empty' => 'Nic jeszcze nie kupiono',
    'empty_body' => 'Zamówienia pojawiają się tutaj, gdy tylko ktoś kupi pakiet.',

    // ---- odnowienia ------------------------------------------------------
    'filter_late' => 'Zaległość na fakturze',
    'run_renewals' => 'Uruchom odnowienia teraz',
    'run_renewals_confirm' => 'Robi to, co nocny przebieg: wystawia następną fakturę dla wszystkiego, czemu wkrótce mija termin, i zatrzymuje serwery stojące za fakturą, która została nieopłacona po okresie karencji.',
    'renewals_queued' => 'Wstawione do kolejki',
    'renewals_queued_body' => 'Działa w kolejce. Odśwież za chwilę, żeby zobaczyć, co się zmieniło.',
];
