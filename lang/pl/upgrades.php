<?php

/*
 * Polski. Napisane ręcznie.
 *
 * Przeniesienie działającej usługi z jednego pakietu na drugi.
 *
 * Tekst trzyma od początku do końca jedną rzecz prosto: ile pakiet kosztuje i
 * ile kosztuje dzisiaj przejście na niego to dwie różne liczby. Pierwsza stoi
 * na półce; druga zależy od tego, jak daleko w opłaconym okresie jest ta
 * usługa, i to na nią ktoś się zgadza, naciskając przycisk.
 *
 * Słowo „upgrade" nie pada w tym, co czyta klient, bo połowa tych przejść idzie
 * w drugą stronę. Tutaj nazywa się to zmianą.
 */

return [
    // ---- na karcie usługi ------------------------------------------------
    'change' => 'Zmień pakiet',
    'change_body' => 'To, co zostało z opłaconego już okresu, schodzi z rachunku, a te same dni zostają policzone po nowej cenie. Nic z Twojego serwera nie przepada.',
    'change_to' => 'Zmień na :name',
    'change_confirm' => 'Zmienić tę usługę na :name?',
    'change_free' => 'Nic do zapłaty',
    'costs_now' => 'teraz :amount',
    'gives_back' => ':amount z powrotem',
    'waiting' => 'Zmiana ustalona',
    'waiting_for' => 'Zmiana na :name czeka na nieopłaconą fakturę.',

    // ---- co dzieje się potem ---------------------------------------------
    'done' => 'Przeniesione na :name',
    'done_body' => 'Twoja usługa stoi na nowym pakiecie. To, co Ci się należało, jest na Twoim koncie.',
    'refused' => 'Zmiana nie została wykonana',

    // ---- a dlaczego nie, po jednym powodzie na raz -----------------------
    'refused_off' => 'Zmiana pakietu jest w tym panelu wyłączona.',
    'refused_not_active' => 'Zmienić można tylko działającą usługę. Przy takiej, która czeka, jest zawieszona albo się kończy, nie ma czego rozliczać.',
    'refused_gone' => 'Pakiet, na którym stoi ta usługa, już nie istnieje, więc nie ma z czym porównywać.',
    'refused_same' => 'To ten pakiet, na którym już stoi.',
    'refused_egg' => 'Ten pakiet chodzi na innym oprogramowaniu. To byłby inny serwer, a nie większy, więc trzeba go kupić osobno.',
    'refused_period' => 'Ten pakiet jest rozliczany w innym okresie, a to inna umowa, a nie większa.',
    'refused_stock' => 'Ten pakiet jest wyprzedany.',
    'refused_waiting' => 'Dla tej usługi już czeka jedna zmiana na nieopłaconą fakturę. Opłać ją albo anuluj najpierw.',
    'refused_failed' => 'Nic nie zostało zapisane, więc nic się nie zmieniło. Spróbuj ponownie, a jeśli to się powtarza, powiedz o tym osobie, która prowadzi ten panel.',
    'refused_server' => 'Serwerowi nie udało się nadać nowych limitów, więc usługa została dokładnie taka, jaka była. Osoba, która prowadzi ten panel, została powiadomiona.',

    // ---- co mówią dokumenty ----------------------------------------------
    'line' => 'Zmiana z :from na :to, za pozostałe :days dni tego okresu',
    'credit_reason' => 'Zmiana na :name',

    // ---- i co słyszy właściciel ------------------------------------------
    'bell_failed' => 'Zmiana pakietu nie powiodła się przy zamówieniu :number',
    'cold_title' => 'Zmiana pakietu doszła do panelu, ale nie do node, przy zamówieniu :number',
    'cold_body' => 'Usługa stoi na :name i nowe limity są zapisane. Node jeszcze ich nie przejął i odczyta je przy następnym starcie tego serwera, więc do tego czasu klient ma nadal stary rozmiar. Sprawdź node.',
    'gone' => 'Pakiet, na który miało być zmienione, już nie istnieje.',
    'refused_by_node' => 'Serwer nie przyjął nowych limitów: :why',

    // ---- naprawianie -----------------------------------------------------
    'retry' => 'Spróbuj zmiany ponownie',
    'retry_confirm' => 'Spróbuj zmiany pakietu jeszcze raz. Faktura za nią jest już opłacona, więc nic nie zostanie policzone dwa razy.',
    'retried' => 'Zmiana przeszła',
    'retry_failed' => 'Znowu się nie udało. Powód jest przy zamówieniu.',
];
