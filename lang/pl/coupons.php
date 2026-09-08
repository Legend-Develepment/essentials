<?php

/*
 * Polski. Napisane ręcznie.
 *
 * Kody rabatowe: kody, które zdejmują coś z pierwszej faktury.
 *
 * Tylko z pierwszej, celowo, i tekst mówi to tam, gdzie to ma znaczenie. Kod,
 * który obniżałby też każde odnowienie, byłby zmianą ceny z datą końca, a kto
 * tego chce, powinien zmienić cenę.
 */

return [
    'title' => 'Kody rabatowe',
    'nav_label' => 'Kody rabatowe',
    'subheading' => 'Kody, które zdejmują procent albo kwotę z pierwszej faktury. Odnowienia idą po cenie pakietu.',

    // ---- tabela ----------------------------------------------------------
    'column_code' => 'Kod',
    'column_value' => 'Wartość',
    'column_uses' => 'Użyto',
    'column_expires' => 'Wygasa',
    'column_packages' => 'Dotyczy',
    'column_live' => 'Aktywny',

    'never_expires' => 'Bez daty końca',
    'all_packages' => 'Wszystkiego',
    'some_packages' => 'Pakietów: :count',
    'usable' => 'Można go teraz użyć',
    'unusable' => 'Wyłączony, wygasły albo zużyty',

    // ---- przyciski -------------------------------------------------------
    'new' => 'Nowy kod',
    'edit' => 'Edytuj',
    'delete' => 'Usuń',
    'delete_confirm' => 'Usuwa kod. Faktury, które już go użyły, zachowują swój rabat - każda przechowuje własny zapis tego, co zostało zdjęte.',
    'deleted' => 'Kod usunięty',
    'saved' => 'Kod zapisany',
    'save_failed' => 'Nie udało się zapisać kodu',
    'taken' => 'Coś innego już używa tego kodu.',
    'invalid' => 'Procent to liczba całkowita od 1 do 100. Kwotę zapisuje się jako 12.50 albo 12,50.',

    // ---- formularz -------------------------------------------------------
    'section_code' => 'Kod',
    'section_code_helper' => 'To, co klient wpisuje przy zamawianiu.',
    'code' => 'Kod',
    'code_helper' => 'Przechowywany i porównywany wielkimi literami bez spacji, żeby działał niezależnie od tego, jak ktoś go wpisze.',
    'live' => 'Aktywny',
    'live_helper' => 'Wyłączenie sprawia, że kod przestaje działać, ale go nie usuwa: wychodzi z użycia, a rabat, którego udzielił, zostaje na fakturach, które go miały.',

    'section_worth' => 'Ile zdejmuje',
    'section_worth_helper' => 'Tylko z pierwszej faktury. Nigdy nie schodzi z fakturą poniżej zera.',
    'kind' => 'Rodzaj',
    'kind_helper' => 'Część ceny albo stała kwota.',
    'kind_percent' => 'Procent',
    'kind_fixed' => 'Stała kwota',
    'value' => 'Wartość',
    'value_percent_helper' => 'Liczba całkowita od 1 do 100.',
    'value_fixed_helper' => 'W walucie sklepu. Zapisz ją jako 12.50 albo 12,50.',

    'section_limits' => 'Ograniczenia',
    'section_limits_helper' => 'Wszystko tutaj jest opcjonalne. Kod bez żadnego z nich działa na wszystko, dla każdego, na zawsze.',
    'max_uses' => 'Ile razy można go użyć',
    'max_uses_helper' => 'Liczone przy składaniu zamówienia, nie przy opłacaniu faktury - inaczej kod na dziesięć użyć dałoby się złożyć sto razy przez jedną noc.',
    'expires' => 'Wygasa',
    'expires_helper' => 'Po tym momencie kod przestaje działać. Puste znaczy, że to się nigdy nie stanie.',
    'packages' => 'Pakiety',
    'packages_helper' => 'Nic niezaznaczone znaczy każdy pakiet, teraz i później.',

    'empty' => 'Jeszcze nie ma kodów',
    'empty_body' => 'Zrób jeden, a zadziała przy zamawianiu, gdy tylko będzie aktywny.',
];
