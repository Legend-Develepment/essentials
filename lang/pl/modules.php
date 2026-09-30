<?php

/*
 * Polski. Napisane ręcznie.
 *
 * Strona modułów.
 *
 * Własny plik zamiast kąta w settings.php, który jest już największym
 * plikiem językowym tej wtyczki.
 */

return [
    'title' => 'Moduły',
    'nav_label' => 'Moduły',
    'subheading' => 'Czym ta wtyczka jest na tym panelu. Wszystko tutaj można wyłączyć, a wyłączenie czegoś nigdy nie usuwa tego, co już zostało zapisane.',

    'first_title' => 'Do czego jest ten panel?',
    'first_helper' => 'Odpowiedz raz, a części, które do tego pasują, zostaną włączone. Nic się przez to nie przesądza: każdy przełącznik poniżej nadal jest twój, a wyłączenie czegoś nigdy nie usuwa tego, co już zostało zapisane.',
    'first_look' => 'Głównie jak wygląda',
    'first_look_helper' => 'Kolory, ekran logowania, ogłoszenia, twoje odnośniki i strony, na których się to zmienia. Nic, co sprzedaje, odpowiada albo sięga na zewnątrz.',
    'first_run' => 'Prowadzenie serwerów, dla siebie albo dla ekipy',
    'first_run_helper' => 'Wygląd, plus to, co pokazuje serwer i co jest pełne albo stanęło. Bez sklepu, bez okienka zgłoszeń i bez niczego, co wysyła pocztę według czasu.',
    'first_sell' => 'Sprzedawanie hostingu klientom',
    'first_sell_helper' => 'Wszystko. Sklep bez miejsca na odpowiadanie na pytania i bez niczego, co pilnuje node’ów, to pół sklepu.',
    'first_skip' => 'Sam je wybiorę',

    'first_left' => 'Zostawione tak, jak było. Przełączniki są wszystkie poniżej.',
    'go' => 'Skonfiguruj',

    'state_on' => 'Włączone',
    'state_part' => 'Częściowo włączone',
    'state_off' => 'Wyłączone',

    'count' => '{1} włączona :on z :of części|[2,*] włączone :on z :of części',
    'parts' => '{1} Jedyna część|[2,*] Wszystkie części (:count)',

    'health_tables' => 'Jego tabel jeszcze nie ma. Zapisanie czegokolwiek na tej stronie je utworzy.',
    'health_missing' => '{1} Jedna część potrzebuje czegoś, co jest wyłączone|[2,*] Części potrzebujących czegoś wyłączonego: :count',
    'health_waiting' => '{1} Jedna część jest włączona i nic jeszcze nie pokazuje|[2,*] Włączonych części, które nic jeszcze nie pokazują: :count',

    'left_access' => '{1} Jedna osoba nadal ma serwer przyznany stąd|[2,*] Osób, które nadal mają serwery przyznane stąd: :count',
    'left_public_status' => '{1} Jedna opublikowana strona i jej adres zostają|[2,*] Opublikowanych stron i ich adresów, które zostają: :count',
    'left_arranger' => '{1} Jeden zapisany układ zostaje|[2,*] Zapisanych układów, które zostają: :count',
    'left_user_themes' => '{1} Wybrany styl jednej osoby zostaje|[2,*] Wybranych stylów, które zostają: :count',
    'left_unknown' => 'Coś tu zostało, a panel nie zdołał odczytać ile.',
    'cleared' => '{1} Jedno cofnięte|[2,*] Cofnięto: :count',
    'clear_failed' => 'Tego nie udało się posprzątać',

    'turn_on' => 'Włącz',
    'turn_off' => 'Wyłącz',

    'saved' => 'Zapisano',
    'brought' => 'Włączone razem z nią, bo bez tego nic tu nie działa: :names.',
    'save_failed' => 'Tego nie udało się zapisać',
    'read_only' => 'Możesz na to patrzeć, ale nie możesz tego zmieniać. Zmiana tego, co panel oferuje, wymaga szerszego uprawnienia do tej wtyczki.',
];
