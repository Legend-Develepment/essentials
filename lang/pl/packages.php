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
    'column_flags' => 'Flagi',
    'column_flags_from' => 'od :count',
    'column_egg' => 'Egg',
    'column_price' => 'Cena',
    'column_stock' => 'Dostępność',
    'column_live' => 'W sprzedaży',
    'column_orders' => 'Sprzedano',

    'live' => 'W sprzedaży',
    'offline' => 'Nie w sprzedaży',
    'no_egg' => 'Brak egg - nie da się zbudować',

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
    'delete_confirm' => 'Usuwa pakiet. To, co już kupiono, zostaje nietknięte - zamówienia mają własną kopię tego, czym były.',
    'delete_confirm_sold' => 'Liczba sprzedaży: :count. Tych usług nic nie rusza: zamówienie ma własną kopię wszystkiego, z czym zostało sprzedane, więc serwery dalej działają, a faktury dalej mówią, co kupiono. Znika tylko obrazek na karcie ich usługi, a pakiet wypada ze sprzedaży.',
    'delete_refused' => 'Nie usunięto',
    'delete_refused_body' => 'Na ten pakiet złożono zamówienia i one na niego wskazują. Zamiast tego wycofaj go ze sprzedaży; zostanie w dokumentacji i nikt nie będzie mógł go kupić.',
    'deleted' => 'Pakiet usunięty',
    'deleted_sold' => 'Sprzedanych z niego usług: :count - są nietknięte i dalej działają.',
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
    'upgrade_to' => 'Można zmienić na',
    'upgrade_to_helper' => 'Na które pakiety wolno przenieść działającą usługę z tego pakietu, w górę albo w dół. Na liście są tylko pakiety na tym samym eggu, bo inny egg to inny serwer, a nie większy. Nic zaznaczonego oznacza, że z tego pakietu nie da się zmienić na żaden inny.',
    'upgrade_to_none' => 'Żaden inny pakiet nie używa jeszcze tego egga.',

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
    'section_price_helper' => 'W walucie sklepu, ustawionej na stronie Ustawienia sklepu. Bez podatku - podatek jest dodawany na fakturze jako osobna pozycja.',
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
    'section_ask' => 'Zapytaj klienta',
    'section_ask_helper' => 'Pytania stawiane przy zamówieniu, na które klient odpowiada, zanim je złoży. Odpowiedzi trafiają do serwera, gdy ten powstaje.',
    'ask_vars' => 'Zmienne, o które pytać',
    'ask_vars_helper' => 'Własne zmienne egg. Zaznacz jedną, a klient wypełni ją przy kupowaniu i jego odpowiedź zostanie użyta zamiast wartości z tego pakietu. Nic nie zaznaczaj, a nikt o nic nie zostanie zapytany.',
    'upload_ask' => 'Poproś o plik',
    'upload_ask_helper' => 'Zip, który klient wgrywa przy kupowaniu - świat, modpack, zestaw konfiguracji. Trafia do jego serwera, gdy ten powstaje, zanim klient usłyszy, że serwer jest gotowy.',
    'upload_label' => 'Jak to nazwać',
    'upload_label_helper' => 'Etykieta nad polem na plik, twoimi słowami. Pozostawiona pusta daje zwykłą.',
    'upload_dir' => 'Gdzie w serwerze',
    'upload_dir_helper' => 'Ścieżka wewnątrz serwera, na przykład / albo /world. Zostaje zabezpieczona, zanim będzie użyta.',
    'upload_extract' => 'Rozpakuj',
    'upload_extract_helper' => 'Włączone: zip zostaje rozpakowany tam, gdzie wyląduje, a samo archiwum usunięte - tak trzeba przy świecie albo zestawie konfiguracji. Wyłączone: zip zostaje plikiem, a tego właśnie chce egg, który instaluje z niego modpack.',
    'empty_body' => 'Utwórz jeden, a pojawi się w sklepie, gdy tylko zostanie wystawiony na sprzedaż.',
    'popular' => 'Wskaż ten',
    'popular_helper' => 'Oznacza go jako ten, który wybiera większość. Przesuwa się w sklepie do góry, pod to, co jest w promocji, i dostaje małą flagę. To nie jest twierdzenie o wynikach sprzedaży - to sprzedawca, który wskazuje palcem.',
    'offer' => 'W promocji',
    'offer_helper' => 'Przesuwa go na początek sklepu z flagą i zdejmuje z ceny rabat podany niżej.',
    'offer_kind' => 'Rabat jako',
    'offer_percent' => 'Procent',
    'offer_amount' => 'Kwota',
    'offer_value' => 'Ile zdjąć',
    'offer_value_percent' => 'Procent ceny, więc 20 znaczy piątą część mniej.',
    'offer_value_amount' => 'Kwota w walucie sklepu, więc 2.50 znaczy dwa i pół mniej.',
    'offer_min' => 'Dopiero od tylu pozycji',
    'offer_min_helper' => 'Jak pełny musi być koszyk, zanim rabat zadziała, licząc wszystko, co w nim jest, a nie tylko ten pakiet. Zero albo jeden znaczy zawsze. Dwa to powód, żeby dołożyć coś jeszcze.',
];
