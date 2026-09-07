<?php

/*
 * Polski. Napisane ręcznie.
 *
 * „Egg" zostaje po angielsku: tego słowa Pelican używa w całym swoim interfejsie,
 * a ustawienie nazwane inaczej niż ekran, z którego pochodzi, to ustawienie,
 * którego szuka się dwa razy.
 */

return [
    'title' => 'Zduplikuj serwer',
    'nav_label' => 'Zduplikuj serwer',
    'subheading' => 'Kolejny serwer ustawiony dokładnie tak jak ten, który już masz, albo kilka naraz.',

    'section' => 'Co jest kopiowane',
    'section_helper' => 'Kopiowane są właściciel, egg, polecenie startowe, limity i wszystkie zmienne. Pliki, bazy danych, kopie zapasowe i zadania zaplanowane nie — kopia plików działającego serwera to kopia jego stanu, a rzadko o to chodzi, gdy mówi się „jeszcze jeden taki".',

    'source' => 'Kopiuj z',
    'source_helper' => 'Kopie lądują na tym samym węźle co ten serwer, bo tam są jego wolne adresy.',

    'name' => 'Nazwa kopii',
    'name_helper' => 'Zrobienie więcej niż jednej numeruje je: „Bot 1", „Bot 2" i tak dalej.',

    'copies' => 'Ile',
    'copies_helper' => 'Najpierw wybierz serwer.',
    'room' => 'Wolnych adresów na :node: :count, więc tyle najwyżej da się teraz zrobić.',
    'no_room' => 'Na :node nie został żaden wolny adres. Kopia potrzebuje własnego, więc najpierw dodaj alokację do tego węzła.',

    /*
     * Policzone, a nie wypisane dla udanych, i wypisane dla nieudanych — tak
     * jest pożytecznie: dziesięć nazw, które się udały, to ściana tekstu,
     * której nikt nie czyta, a ta jedna, która się nie udała, to jedyna rzecz
     * warta przeczytania.
     */
    'made' => 'Utworzono kopii: :count',
    'partly_failed' => 'Nie udało się utworzyć kopii: :count',
    'failed' => 'Nic nie zostało skopiowane',
];
