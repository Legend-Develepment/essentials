<?php

/*
 * Polski. Napisane ręcznie.
 *
 * Dodatki sprzedawane obok pakietu.
 *
 * Dwie rzeczy są tutaj trzymane osobno. To, ile dodatek *kosztuje*, to jego
 * cena, czyli to, co jest liczone przy każdym rozliczeniu. To, ile *kosztuje
 * dzisiaj*, jest częścią tamtej kwoty, bo kto kupuje go w połowie miesiąca,
 * płaci za pół miesiąca. Tekst dla klienta zawsze mówi, o którą z tych dwóch
 * chodzi.
 *
 * „Nic nie dokłada do serwera" to prawdziwa odpowiedź i jest wypisana zamiast
 * zostawiona pusta, bo pierwszeństwo w supporcie to zwyczajna rzecz do
 * sprzedania, a pusta komórka czyta się jak błąd.
 */

return [
    'title' => 'Dodatki',
    'nav_label' => 'Dodatki',
    'subheading' => 'Rzeczy sprzedawane obok pakietu: więcej pamięci, jeszcze jedna kopia zapasowa albo coś, co jest tylko pozycją na fakturze.',

    // ---- tabela ----------------------------------------------------------
    'column_name' => 'Dodatek',
    'column_price' => 'Cena',
    'column_adds' => 'Dokłada',
    'column_sold' => 'W użyciu',
    'column_live' => 'W sprzedaży',
    'adds_nothing' => 'Nic do serwera',

    // ---- formularz -------------------------------------------------------
    'section_what' => 'Czym jest',
    'section_what_helper' => 'Nazwa i cena, które widzi klient, oraz to, przy których pakietach można go kupić.',
    'name' => 'Nazwa',
    'price' => 'Cena',
    'price_helper' => 'Ile kosztuje przy każdym rozliczeniu. Kupiony w trakcie okresu, klient płaci część tej kwoty, a od następnego odnowienia całość.',
    'billing' => 'Rozliczany',
    'billing_helper' => 'Razem z usługą znaczy, że wraca przy każdym odnowieniu, dopóki klient go trzyma. Jednorazowo znaczy, że wchodzi na fakturę, która niesie go pierwszy raz, i nigdy więcej.',
    'billing_with' => 'Przy każdym odnowieniu',
    'billing_once' => 'Jednorazowo',
    'max' => 'Najwyżej na usługę',
    'max_helper' => 'Ile sztuk tego jednego może mieć jedna osoba. Jeden to zwykły przypadek; podnieś przy czymś sprzedawanym na gigabajty.',
    'description' => 'Opis',
    'description_helper' => 'Jedna linijka pod nazwą przy zamawianiu. Napisz, co robi, a nie jak się nazywa.',
    'packages' => 'Pakiety',
    'packages_helper' => 'Przy których pakietach można to kupić. Nic zaznaczonego oznacza przy wszystkich, a tym zwykle jest opcja supportu albo miejsce na kopię zapasową.',

    'section_adds' => 'Co dokłada do serwera',
    'section_adds_helper' => 'To dochodzi do tego, co pakiet już daje, a nie wchodzi zamiast: 4096 w pamięci robi serwer o 4 GiB większy. Dwa takie same dodatki sumują się. Zostaw wszystko na zerze przy czymś, co jest tylko pozycją na fakturze. Liczba ujemna coś zabiera, co jest dozwolone i co czasem jest dokładnie tym, czego ktoś chce.',
    'sort' => 'Kolejność',
    'sort_helper' => 'Niższe idzie pierwsze przy zamawianiu. Przy równych liczbach decyduje cena.',
    'live' => 'W sprzedaży',
    'live_helper' => 'Wyłączone: nie jest nigdzie oferowany. Kto już go ma, ten go zachowuje i dalej za niego płaci.',

    // ---- przyciski -------------------------------------------------------
    'new' => 'Nowy dodatek',
    'edit' => 'Edytuj',
    'delete' => 'Usuń',
    'delete_confirm' => 'Nikt tego nie ma. Usunięcie zdejmuje go z listy na dobre.',
    'delete_sold' => 'Ma to usług: :count. Zachowują go, zachowują limity, które im dał, i dalej za niego płacą - znika tylko pozycja z listy, więc nikt nowy już go nie kupi.',
    'go_live' => 'Wystaw na sprzedaż',
    'go_offline' => 'Zdejmij ze sprzedaży',
    'saved' => 'Zapisano',
    'deleted' => 'Dodatku już nie ma',
    'save_failed' => 'Niezapisane',
    'save_failed_body' => 'Nic nie zostało zapisane. Spróbuj ponownie, a jeśli to się powtarza, zajrzyj do logu.',
    'invalid' => 'Dodatek potrzebuje nazwy i ceny.',
    'empty' => 'Jeszcze nie ma dodatków',
    'empty_body' => 'Dodatek to coś sprzedawanego obok pakietu: kolejny gigabajt, drugie miejsce na kopię zapasową albo usługa, która nic a nic nie dokłada do serwera.',

    // ---- co widzi klient -------------------------------------------------
    'choose' => 'Dodatki',
    'choose_helper' => 'Nieobowiązkowe, a dołożyć je albo zdjąć możesz też później.',
    'yours' => 'Dodatki przy tej usłudze',
    'add' => 'Dołóż dodatek',
    'add_helper' => 'Teraz płacisz za to, co zostało z tego okresu, a od następnego odnowienia całą cenę.',
    'add_to' => 'Dołóż :name',
    'add_confirm' => 'Dołożyć :name do tej usługi?',
    'drop' => 'Usuń',
    'drop_confirm' => 'Usunąć :name? Niewykorzystana część tego, co zapłacono, wraca na Twoje konto, a serwer zmienia się od razu.',
    'costs_now' => 'teraz :amount',
    'free_now' => 'Teraz nic do zapłaty',
    'then' => 'potem :amount za odnowienie',
    'once_only' => ':amount, jednorazowo',
    'each' => 'za sztukę',
    'added' => 'Dołożono :name',
    'added_body' => 'Twój serwer dostał to, co dodatek dokłada.',
    'dropped' => 'Usunięto :name',
    'dropped_body' => 'To, co zapłacone i niewykorzystane, jest na Twoim koncie.',

    // ---- a kiedy się nie uda ---------------------------------------------
    'refused' => 'Tego nie dało się zrobić',
    'refused_off' => 'Dodatki są w tym panelu wyłączone.',
    'refused_not_active' => 'Dodatki można dokładać tylko do działającej usługi.',
    'refused_gone' => 'Tego dodatku nie ma już w sprzedaży.',
    'refused_wrong_package' => 'Ten dodatek nie jest sprzedawany przy tym pakiecie.',
    'refused_enough' => 'Masz ich już tyle, ile ta usługa może mieć.',
    'refused_failed' => 'Nic nie zostało zapisane, więc nic się nie zmieniło. Spróbuj ponownie, a jeśli to się powtarza, powiedz o tym osobie, która prowadzi ten panel.',
    'refused_server' => 'Serwer nie przyjął nowych limitów, więc nic się nie zmieniło i nic nie zostało policzone.',
    'refused_not_yours' => 'Tego dodatku nie ma przy tej usłudze.',

    // ---- co mówią dokumenty ----------------------------------------------
    'line' => ':name × :many, za pozostałe :days dni tego okresu',
    'credit_reason' => 'Usunięto: :name',
    'bell_failed' => 'Nie udało się dać serwerowi dodatku przy zamówieniu :number',

    // ---- jednostki, do tabeli administratora -----------------------------
    'unit_memory' => 'MiB pamięci',
    'unit_swap' => 'MiB swapu',
    'unit_disk' => 'MiB dysku',
    'unit_cpu' => '% CPU',
    'unit_database_limit' => 'baz danych',
    'unit_allocation_limit' => 'allocation',
    'unit_backup_limit' => 'kopii zapasowych',
];
