<?php

/*
 * Polski. Napisane ręcznie.
 *
 * Pakiety: serwer, który ktoś może kupić.
 *
 * Czyta to osoba, która urządza sklep. Każde słowo tutaj dotyczy szablonu i
 * ceny; to, co widzi klient, jest w shop.php, bo dwaj czytelnicy chcą innych
 * zdań o tym samym wierszu.
 *
 * „egg", „node", „swap", „io" i słowa z Minecrafta zostają po angielsku: to
 * słowa z własnego formularza serwera Pelicana, a pakiet to ten formularz
 * odłożony na później.
 */

return [
    'title' => 'Pakiety',
    'nav_label' => 'Pakiety',
    'subheading' => 'To, co jest na sprzedaż. Każdy to szablon serwera z ceną; klient kupuje jeden, a panel tworzy serwer.',

    // ---- tabela ----------------------------------------------------------
    'column_name' => 'Pakiet',
    'column_egg' => 'Egg',
    'column_price' => 'Cena',
    'column_stock' => 'Dostępność',
    'column_live' => 'W sprzedaży',
    'column_orders' => 'Sprzedano',

    'live' => 'W sprzedaży',
    'offline' => 'Nie w sprzedaży',
    'no_egg' => 'Brak egg — nie da się zbudować',

    'stock_unlimited' => 'Bez limitu',
    'stock_left' => 'Zostało: :count',
    'stock_out' => 'Wyprzedane',

    // ---- okresy ----------------------------------------------------------
    'period_once' => 'Jednorazowo',
    'period_month' => 'Miesięcznie',
    'period_quarter' => 'Kwartalnie',
    'period_year' => 'Rocznie',

    // Po cenie: „12,50 zł miesięcznie".
    'per_once' => 'jednorazowo',
    'per_month' => 'miesięcznie',
    'per_quarter' => 'kwartalnie',
    'per_year' => 'rocznie',

    // ---- akcje -----------------------------------------------------------
    'new' => 'Nowy pakiet',
    'edit' => 'Edytuj',
    'duplicate' => 'Duplikuj',
    'copy_suffix' => ' (kopia)',
    'go_live' => 'Wystaw na sprzedaż',
    'go_offline' => 'Wycofaj ze sprzedaży',
    'delete' => 'Usuń',
    'delete_confirm' => 'Usuwa pakiet. To, co już kupiono, zostaje nietknięte — zamówienia mają własną kopię tego, czym były.',
    'delete_refused' => 'Nie usunięto',
    'delete_refused_body' => 'Na ten pakiet złożono zamówienia i one na niego wskazują. Zamiast tego wycofaj go ze sprzedaży; zostanie w dokumentacji i nikt nie będzie mógł go kupić.',
    'deleted' => 'Pakiet usunięty',
    'saved' => 'Pakiet zapisany',
    'save_failed' => 'Nie udało się zapisać pakietu',
    'price_invalid' => 'To nie jest kwota. Zapisz ją jako 12.50 albo 12,50.',

    // ---- formularz: czym jest --------------------------------------------
    'section_basics' => 'Pakiet',
    'section_basics_helper' => 'To, co klient widzi na karcie.',
    'name' => 'Nazwa',
    'name_helper' => 'Jak nazywa się w sklepie.',
    'slug' => 'Adres',
    'slug_helper' => 'Małe litery, cyfry i myślniki. Pozostawiony pusty powstaje z nazwy. Zmiana później psuje link, który ktoś zapisał.',
    'description' => 'Opis',
    'description_helper' => 'Kilka linijek pod nazwą. Zwykły tekst.',
    'live_field' => 'W sprzedaży',
    'live_helper' => 'Wyłączone trzyma pakiet tutaj i nie pokazuje go nikomu. Pakiet bez egg nigdy nie jest pokazywany, cokolwiek tu stoi.',
    'sort' => 'Kolejność',
    'sort_helper' => 'Niższa wartość jest wcześniej w sklepie.',

    // ---- formularz: czym się staje ---------------------------------------
    'section_server' => 'Serwer, którym się staje',
    'section_server_helper' => 'Te same pytania, które Pelican zadaje przy ręcznym tworzeniu serwera, tu zadane raz i użyte przy każdej sprzedaży.',
    'egg' => 'Egg',
    'egg_helper' => 'Wybranie jednego wypełnia obraz, polecenie startowe i każdą zmienną domyślnymi wartościami egg. Potem zmień, co chcesz.',
    'image' => 'Obraz Docker',
    'image_helper' => 'Jeden z obrazów, które oferuje egg.',
    'image_default' => 'Pierwszy obraz egg',
    'startup' => 'Polecenie startowe',
    'startup_helper' => 'Jedno z poleceń, które oferuje egg.',
    'startup_default' => 'Pierwsze polecenie egg',
    'environment' => 'Zmienne',
    'environment_helper' => 'Zmienne egg i ich wartości. Wszystko, co egg ma, a czego tu nie ma, przyjmuje wartość domyślną przy tworzeniu serwera.',
    'env_key' => 'Zmienna',
    'env_value' => 'Wartość',
    'nodes' => 'Node',
    'nodes_helper' => 'Gdzie może powstać serwer z tego pakietu, próbowane w tej kolejności, aż któryś ma wolny adres. Nic zaznaczonego oznacza dowolny node.',

    // ---- formularz: limity -----------------------------------------------
    'section_limits' => 'Limity',
    'section_limits_helper' => 'Co dostaje serwer. Te same pola co własny formularz serwera Pelicana, w tych samych jednostkach.',
    'memory' => 'Pamięć',
    'disk' => 'Dysk',
    'cpu' => 'CPU',
    'cpu_helper' => 'Procent jednego rdzenia: 100 to jeden rdzeń, 200 to dwa, 0 to bez limitu.',
    'swap' => 'Swap',
    'swap_helper' => '0 to brak, -1 to bez limitu.',
    'io' => 'Waga IO bloków',
    'io_helper' => 'Domyślnie w Pelicanie 500. Zostaw tak, chyba że wiesz, dlaczego nie.',
    'threads' => 'Przypięcie CPU',
    'threads_helper' => 'Które rdzenie, tak jak zapisuje je Pelican: 0,1 albo 0-3. Puste to dowolne.',
    'oom_killer' => 'OOM killer',
    'oom_killer_helper' => 'Czy jądro może zakończyć serwer, gdy skończy mu się pamięć.',
    'databases' => 'Bazy danych',
    'allocations' => 'Dodatkowe allocation',
    'backups' => 'Kopie zapasowe',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- formularz: pieniądze --------------------------------------------
    'section_price' => 'Cena i dostępność',
    'section_price_helper' => 'W walucie sklepu, ustawionej na stronie Ustawienia sklepu. Bez podatku — podatek jest dodawany na fakturze jako osobna pozycja.',
    'price' => 'Cena',
    'price_helper' => 'Za okres. Zapisz ją jako 12.50 albo 12,50.',
    'setup_fee' => 'Opłata instalacyjna',
    'setup_fee_helper' => 'Pobierana raz, na pierwszej fakturze. Zero oznacza brak.',
    'period' => 'Rozliczanie',
    'period_helper' => 'Jednorazowo płaci się raz i zatrzymuje. Pozostałe dostają nową fakturę co okres; niezapłacona zawiesza serwer po okresie karencji ze strony Ustawienia sklepu.',
    'stock' => 'Dostępność',
    'stock_helper' => 'Ile może być sprzedanych naraz, licząc każde nieanulowane zamówienie. Puste to bez limitu.',
    'term' => 'Minimalny okres',
    'term_helper' => 'Na jak długo ktoś się wiąże, kupując. Zero to brak zobowiązania: może anulować i kończy się to z końcem okresu, który opłacił.',
    'term_unit' => 'Liczone w',
    'term_unit_helper' => 'Dni, miesiące albo lata. Anulowane zamówienie dobiega do końca tego okresu, a serwer zostaje tego dnia usunięty.',
    'unit_day' => 'Dni',
    'unit_month' => 'Miesiące',
    'unit_year' => 'Lata',
    'term_day' => 'Minimalny okres: :count dni',
    'term_month' => 'Minimalny okres: :count miesięcy',
    'term_year' => 'Minimalny okres: :count lat',
    'section_art' => 'Obrazek',
    'section_art_helper' => 'Obrazek na karcie pakietu, w sklepie i przy usługach klienta. Zostaw oba puste, a użyta zostanie własna grafika egg, którą większość pakietów już ma.',
    'art_file' => 'Wgraj obrazek',
    'art_file_helper' => 'Raczej szeroki niż wysoki: karta przycina go do 16:9. Do 8 MB.',
    'art_url' => 'Albo adres obrazka',
    'art_url_helper' => 'Pełny adres https. Używany, gdy powyżej nic nie wgrano.',

    'empty' => 'Nie ma jeszcze pakietów',
    'empty_body' => 'Utwórz jeden, a pojawi się w sklepie, gdy tylko zostanie wystawiony na sprzedaż.',
];
