<?php

/*
 * Polski. Napisane ręcznie.
 *
 * „Egg", „węzeł", „subuser", „Wings", „queue", „webhook", „topbar", „cron" i
 * nazwy formatów plików zostają jak są: to słowa, pod którymi odnajduje się je
 * w samym Pelicanie, na hoście i we wszystkim, co się o nich pisze. Nazwy stylów
 * też nie są tłumaczone — styl nazywa się tak, jak się nazywa, a przetłumaczona
 * nazwa byłaby drugą nazwą tej samej rzeczy.
 */

return [
    'css_warning' => 'Zapisano, ale ten CSS wygląda na błędny',
    'css_unclosed' => 'Reguła otwarta w wierszu :line nigdy nie jest zamykana. Wszystko po niej stoi w środku tej reguły i nie zadziała.',
    'css_extra' => 'W wierszu :line jest nawias zamykający, choć nic nie jest otwarte. Wszystko po nim stoi poza jakąkolwiek regułą i zostanie pominięte.',
    'css_comment' => 'Komentarz otwarty w wierszu :line nigdy nie jest zamykany, więc reszta pliku stoi w jego środku.',

    'groups' => [
        'appearance' => 'Wygląd',
        'servers' => 'Lista serwerów',
        'windows' => 'Style o porach dnia',
        'windows_helper' => 'Inny styl między dwiema godzinami dnia. Nic się nie dzieje, dopóki jednego nie dodasz. Zegar jest zegarem samego panelu, z jego ustawienia strefy czasowej, a nie zegarem każdego czytelnika — panel, który w tej samej chwili wyglądałby inaczej dla dwóch osób, wyglądałby na zepsuty, a nie na zaplanowany. Okno zmienia wygląd, który panel już ma, więc nie robi nic, dopóki styl stoi na „Żaden". Styl, który ktoś wybrał dla siebie, i tak wygrywa.',
        'minecraft' => 'Minecraft',
        'ark' => 'ARK',
        'valheim' => 'Valheim',
        'languages' => 'Języki',
        'servers_helper' => 'Jak rysowana jest karta serwera. To, czy pokazują się siatką czy listą, jest wyborem każdego, w Konto → Układ pulpitu.',
        'server_pages' => 'Strony serwera',
        'server_pages_helper' => 'Co niesie każda strona wewnątrz serwera, którakolwiek by nie była.',
        'console' => 'Strona konsoli',
        'console_helper' => 'Krój pisma terminala, jego rozmiar i wysokość są wyborem każdego, w Konto.',
        'background' => 'Tło',
        'background_helper' => 'Dotyczy całego panelu, również ekranu logowania.',
        'icons' => 'Ikony',
        'bars' => 'Wskaźniki zasobów',
        'bars_helper' => 'Paski procesora, pamięci i dysku na kartach serwerów.',
        'updates' => 'Aktualizacje',
        'updates_helper' => 'Które wydania oferuje strona motywu i gdzie ich szuka.',
        'brand' => 'Marka',
        'login' => 'Ekran logowania',
        'login_helper' => 'Dotyczy ekranów logowania, resetu hasła i drugiego składnika.',
        'advanced' => 'Własny CSS',
        'advanced_helper' => 'Do wszystkiego, czego ustawienia powyżej nie obejmują. Ładowany po całej reszcie, więc wygrywa.',
        'areas' => 'Na obszar',
        'areas_helper' => 'Wszystko powyżej działa wszędzie. Tutaj możesz wydzielić jeden obszar; to, co zostawisz puste, dalej idzie za ustawieniem ogólnym.',
        'footer' => 'Stopka paska bocznego',
        'footer_helper' => 'Dół paska bocznego, który Pelican zostawia pusty. Wszystko tutaj jest wyłączone, dopóki tego nie wypełnisz.',
        'features' => 'Co dodaje ta wtyczka',
        'features_helper' => 'Odznaczenie czegoś usuwa to z panelu całkowicie. Jego ustawienia zostają, a jego strona zachowuje adres, więc nic się nie traci przez wyłączenie czegoś, żeby zobaczyć, co robiło. Większość ma też własne uprawnienie w Rolach, żeby oddać jedno bez oddawania reszty. Nie wszystko: wskaźniki zasobów, stopka paska bocznego i wyszukiwarka ustawień są rysowane dla każdego i nikt nimi nie zarządza, gwiazdka na karcie serwera należy do tego, kto ją kliknął, a strony Palworlda i Minecrafta wewnątrz serwera idą za uprawnieniami tego serwera, a nie za którymś z tych. Sam wygląd nie jest na tej liście — ma własny przełącznik, w Wygląd → Wygląd → Styl → Żaden.',
        'identity' => 'Ta wtyczka na pasku bocznym',
        'identity_helper' => 'Pozycja, którą ta wtyczka dokłada do paska bocznego, i obrazek na niej.',
    ],

    /*
     * Strony ustawień, każda jako pozycja we własnej grupie wtyczki na pasku
     * bocznym. Pogrupowane według pytania, na które się odpowiada, a nie według
     * klasy, która je realizuje.
     */
    'pages' => [
        'look' => 'Wygląd',
        'look_helper' => 'Kolor, kształt i to, jak panel się nazywa.',
        'pages' => 'Strony',
        'pages_helper' => 'Lista serwerów, strony wewnątrz serwera i terminal.',
        'advanced' => 'Zaawansowane',
        'advanced_helper' => 'Dwa wyjścia awaryjne: własny CSS i ustawienia dotyczące tylko jednego obszaru.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Które eggi to Minecraft i wszystko inne na ten temat.',
        'artwork' => 'Obrazki eggów',
        'artwork_helper' => 'Strona z każdym eggiem i sposób na pobranie grafiki gry ze Steama albo z IGDB. Pisze do samych eggów — obrazek i dwa tagi zapisujące, o którą grę chodzi i czy obrazek wybrano ręcznie — i dlatego niesie własne uprawnienie.',
        'alerts' => 'Alerty',
        'alerts_helper' => 'Cykliczne sprawdzenie rzeczy, które panel i tak mierzy, ale nikomu nie mówi: węzeł przestający odpowiadać, zapełniający się dysk, queue worker, który stanął, wersja zostająca w tyle. Wysyła na Discorda, do panelu albo mailem. Własne uprawnienie, bo cyklicznie sięga do każdego węzła i publikuje pod adres, który ktoś wpisał.',
        'backups' => 'Przegląd kopii zapasowych',
        'backups_helper' => 'Strona z każdym serwerem i z tym, jak długo jest bez kopii, ułożona tak, żeby te bez żadnej były na górze. Tylko do odczytu — wszystko, co działa na kopii, zostaje na własnej stronie Pelicana dla tego serwera. Własne uprawnienie, bo ta lista to mapa tego, gdzie są dziury.',
        'public_status' => 'Publiczna strona statusu',
        'public_status_helper' => 'Strona, którą każdy może otworzyć bez konta, pokazująca, które z Twoich serwerów działają i ilu ludzi na nich jest. Nic nie jest publikowane, dopóki nie wskażesz serwera, maszyny albo usługi — wszystkie trzy listy zaczynają się puste, a dopóki takie są, adres odpowiada 404. Własne uprawnienie, bo decyduje o tym, co wychodzi z panelu.',
        'game_players' => 'Gracze, inne gry',
        'capacity' => 'Pojemność',
        'capacity_helper' => 'Ile obiecano na każdej maszynie wobec tego, ile może rozdać, żeby dało się zobaczyć, czy zmieści się jeszcze jeden serwer. Lista węzłów Pelicana pokazuje nazwę i liczbę serwerów, a blok Maszyny na pulpicie pokazuje, co działa - to jest trzecie pytanie, a rachunek jest rachunkiem samego Pelicana. Tylko do odczytu. Własne uprawnienie.',
        'schedules' => 'Zadania zaplanowane',
        'schedules_helper' => 'Wszystkie zadania zaplanowane w panelu wraz z tym, które z nich stanęły: zablokowane w połowie uruchomienia, spóźnione, bo cron nie działa, albo nigdy nieuruchomione. Pelican pokazuje zadania wewnątrz każdego serwera, a jego własny stan nie ma słowa na żaden z tych przypadków. Tylko do odczytu. Własne uprawnienie.',
        'activity' => 'Aktywność',
        'activity_helper' => 'Każde zdarzenie, które panel zapisuje, w jednej liście zamiast po jednym serwerze naraz. Pelican prowadzi dziennik i pokazuje go per serwer; to pyta ten sam dziennik od drugiej strony. Tylko do odczytu. Własne uprawnienie, bo zapis tego, kto co zrobił, oddaje się świadomie.',
        'access' => 'Dostęp do serwerów',
        'access_helper' => 'Powiązanie roli z serwerami, tak żeby każdy, kto ją ma, mógł do nich sięgnąć. Działa przez utrzymywanie w aktualności subuserów samego Pelicana, których i tak czyta lista serwerów i każde sprawdzenie uprawnień. Własne uprawnienie, bo to jedyna strona tutaj, która daje ludziom dostęp do rzeczy.',
        'games' => 'Inne gry',
        'games_helper' => 'Pliki, które ARK i Valheim trzymają obok świata, jako formularze: ustawienia świata ARK-a oraz listy adminów, banów i dopuszczonych Valheima. To, które serwery je dostają, mówi lista eggów na tamtej stronie, więc pusta lista jest już wyłącznikiem na grę.',
        'game_players_helper' => 'Strona wewnątrz Rusta, ARK-a, Valheima i wszystkiego, co odpowiada na zapytanie Valve, pokazująca, kto jest połączony i od jak dawna. Tylko do odczytu — to, co można komuś zrobić, różni się między grami, a to osobne wydanie. Które eggi się liczą, to ta sama lista, której używa strona statusu.',
        'api' => 'API',
        'api_helper' => 'Klucze, które ludzie mają, kto o jakiś poprosił, i co każdy z nich może zobaczyć.',
        'languages' => 'Języki',
        'languages_helper' => 'W jakich językach odpowiada ta wtyczka.',
    ],

    'features' => [
        'look' => 'Ustawienia wyglądu',
        'look_helper' => 'Pozycja na pasku bocznym dla koloru, kształtu i marki.',
        'pages' => 'Ustawienia stron',
        'pages_helper' => 'Pozycja na pasku bocznym dla listy serwerów, stron serwera i terminala.',
        'advanced' => 'Ustawienia zaawansowane',
        'advanced_helper' => 'Pozycja na pasku bocznym dla własnego CSS-a i wyjątków na obszar.',
        'announcements' => 'Ogłoszenia',
        'announcements_helper' => 'Pasek na górze panelu.',
        'nav_links' => 'Odnośniki nawigacji',
        'nav_links_helper' => 'Twoje własne pozycje na pasku bocznym.',
        'login' => 'Ekran logowania',
        'login_helper' => 'Obrazek, komunikat i odnośniki ekranu logowania.',
        'bars' => 'Wskaźniki zasobów',
        'bars_helper' => 'Przekolorowane paski procesora, pamięci i dysku.',
        'dashboard_status' => 'Wiersz wersji',
        'dashboard_status_helper' => 'Góra bloku na pulpicie: która wersja jest zainstalowana i czy jakaś czeka.',
        'dashboard_nodes' => 'Maszyny',
        'dashboard_nodes_helper' => 'Reszta bloku na pulpicie: ten panel i każdy węzeł, wraz z tym, ile każdy zużywa.',
        'system_status' => 'Strona stanu systemu',
        'system_status_helper' => 'Strona maszyny, na której działa sam panel.',
        'sidebar_footer' => 'Stopka paska bocznego',
        'sidebar_footer_helper' => 'Twój wiersz tekstu, wersja panelu i jeden odnośnik, na dole paska bocznego.',
        'api' => 'API',
        'api_helper' => 'Droga do środka spoza panelu: adres, pod którym bot Discorda albo własny skrypt może zapytać o to, co wie ta wtyczka — kto gra, które serwery nie mają kopii zapasowej, czy na węzeł wejdzie jeszcze jeden. Wyłączone nie rejestruje żadnej trasy zamiast takiej, która odmawia, a to mniej powierzchni, a nie uprzejmiejsza jej ilość. Każdy zalogowany może poprosić o klucz, który odpowiada tylko za jego własne serwery; przyznanie go, odmowa, unieważnienie cudzego i wydanie klucza na cały panel wymagają uprawnienia.',
        'languages' => 'Języki',
        'languages_helper' => 'Odpowiadanie każdemu w języku ustawionym na jego koncie, tam gdzie ta wtyczka została przetłumaczona. Przy wyłączonym każdy dostaje angielski.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Zakładka Minecraft na pasku bocznym i strona wewnątrz każdego serwera Minecrafta do edycji jego server.properties jako formularza. Które eggi się liczą, mówisz Ty.',
        'palworld' => 'Ustawienia Palworlda',
        'palworld_helper' => 'Strona wewnątrz serwera Palworlda do edycji jego ustawień świata. Nie pojawia się na żadnym innym serwerze i nigdy, gdy ten serwer działa.',
        'settings_search' => 'Wyszukiwarka ustawień',
        'settings_search_helper' => 'Pole nad tymi formularzami, które zawęża je do sekcji zawierających to, co wpiszesz.',
        'preview' => 'Podgląd na żywo',
        'preview_helper' => 'Ramka obok formularza Wygląd, pokazująca, co robią kolory, rogi i odstępy, zanim je zapiszesz.',
        'duplicate' => 'Duplikowanie serwera',
        'duplicate_helper' => 'Strona do ustawienia kolejnego serwera dokładnie takiego jak ten, który już masz, albo kilku naraz. Pliki nigdy nie są kopiowane.',
        'favourites' => 'Oznaczone serwery',
        'favourites_helper' => 'Gwiazdka na każdej karcie serwera. Oznaczone idą pierwsze, a lista każdego jest trzymana w panelu — więc jego gwiazdki idą z nim tam, gdzie następnym razem się zaloguje. Zmienia to, co widzi on, i nic dla innych. Bycie w panelu znaczy jednak, że to plik w storage, który może przeczytać każdy z dostępem do maszyny.',
        'artwork' => 'Obrazki eggów',
        'artwork_helper' => 'Strona administracyjna, która pobiera grafikę każdego egga ze Steama albo z IGDB i zapisuje ją do samego egga.',
        'alerts' => 'Alerty',
        'alerts_helper' => 'Cykliczne sprawdzenie węzła, który przestał odpowiadać, zapełniającego się dysku, martwego queue workera albo wersji zostającej w tyle, oraz wiadomość na Discorda, do panelu albo mailem, którą wysyła.',
        'backups' => 'Przegląd kopii zapasowych',
        'backups_helper' => 'Strona administracyjna wypisująca każdy serwer według tego, jak długo jest bez kopii. Tylko do odczytu.',
        'public_status' => 'Publiczna strona statusu',
        'public_status_helper' => 'Strona, którą każdy może otworzyć bez konta. Przy wyłączonym adres odpowiada 404, cokolwiek by nie stało na liście.',
        'game_players' => 'Gracze, inne gry',
        'game_players_helper' => 'Strona wewnątrz Rusta, ARK-a, Valheima i wszystkiego, co odpowiada na zapytanie Valve, pokazująca, kto jest połączony i od jak dawna.',
        'owner_alerts' => 'Mów ludziom, że ich serwer jest offline',
        'owner_alerts_helper' => 'Jedyna część tej wtyczki, która pisze do ludzi niebędących administratorami: powiadomienie w panelu, gdy maszyna jednego z ich serwerów przestaje odpowiadać, i drugie, gdy wraca. Wyłączone, dopóki nie włączy się tego i tutaj, i na stronie Alerty, w obu miejscach - pisze do Twoich klientów, więc wymaga dwóch decyzji, a nie jednej.',
        'my_backups' => 'Ostrzeżenie o kopiach na liście serwerów',
        'my_backups_helper' => 'Wiersz nad własną listą serwerów każdego, gdy któryś z jego serwerów nigdy nie miał kopii albo nie ma jej od dłuższego czasu. Karty Pelicana mówią, co serwer robi teraz; nic tam nie mówi, że kopia nie leciała od trzech tygodni. Rysowany tylko wtedy, gdy coś jest w tyle, i nie wymienia żadnego serwera, którego ta osoba i tak nie mogłaby otworzyć.',
        'capacity' => 'Przegląd pojemności',
        'capacity_helper' => 'Strona administracyjna pokazująca pamięć, dysk i procesor obiecane wobec dostępnych na każdej maszynie, wraz z serwerami, którym skończyły się kopie, bazy danych albo alokacje. Obiecane, a nie zużyte - węzeł może być zajęty i pusty albo bezczynny i pełny.',
        'schedules' => 'Przegląd zadań zaplanowanych',
        'schedules_helper' => 'Strona administracyjna wypisująca wszystkie zadania zaplanowane w panelu, najgorsze na górze - zablokowane, spóźnione albo nigdy nieuruchomione. Tylko do odczytu; wszystko, co edytuje albo uruchamia zadanie, zostaje na własnej stronie Pelicana dla tego serwera.',
        'activity' => 'Aktywność panelu',
        'activity_helper' => 'Strona administracyjna wypisująca każde zapisane zdarzenie w panelu, najnowsze na górze, wraz z tym, kto je zrobił i na którym serwerze. Tylko do odczytu - nic nie usuwa, a to, jak długo wiersze są trzymane, dalej decyduje ustawienie samego Pelicana.',
        'access' => 'Dostęp do serwerów według roli',
        'access_helper' => 'Strona do powiązania roli z serwerami, utrzymywana w zgodzie w tabeli subuserów samego Pelicana. Nie przyznaje niczego, dopóki czegoś nie przypiszesz. Wyłączenie zatrzymuje uzgadnianie; już przyznany dostęp zostaje, a strona ma przycisk do jego odebrania.',
        'scheduled' => 'Style o porach dnia',
        'scheduled_helper' => 'Sekcja na stronie Wygląd, która daje panelowi inny styl między dwiema godzinami dnia. Nie zmienia niczego z tego, co zapisane — okno nakłada się na ustawienia w chwili rysowania strony i puszcza je zaraz potem — więc wyłączenie przywraca własny wygląd panelu natychmiast i nic nie traci.',
        'games' => 'Inne gry',
        'games_helper' => 'Ustawienia świata ARK-a oraz listy adminów, banów i dopuszczonych Valheima, jako formularze zamiast plików w menedżerze plików. To, które serwery je dostają, mówi lista eggów na stronie Inne gry.',
        'quick' => 'Menu „Przejdź do"',
        'quick_helper' => 'Jeden element na górze każdej strony do skoku na serwer albo na oznaczoną stronę, z polem wyszukiwania po całej Twojej liście serwerów. Oznacza też stronę, na której stoisz. To, co ktoś przez to znajdzie, to i tak było w jego zasięgu, więc nic to nie przyznaje - wyłączenie zabiera skrót i stronę Ulubione razem z nim.',
    ],

    /*
     * Pole wyszukiwania nad formularzami ustawień. Filtruje to, co i tak jest na
     * stronie w przeglądarce, i o nic nie pyta serwera, więc nie ma stanu
     * „szukam" do opisania ani sposobu, w jaki mogłoby zawieść.
     */
    /*
     * Ramka podglądu. Wszystko w niej jest zastępnikiem, a nie próbką Twojego
     * panelu, i słowa to mówią - ramka, która nazywałaby prawdziwy serwer albo
     * prawdziwą liczbę, byłaby tak czytana.
     */
    'preview' => [
        'label' => 'Podgląd',
        'card' => 'Karta',
        'card_helper' => 'Rysowana tymi samymi zasadami co panel, tylko z ustawieniami z tej strony zamiast zapisanych.',
        'button' => 'Przycisk',
        'field' => 'Pole',
        'meter_ok' => 'W porządku',
        'meter_warning' => 'Ostrzeżenie',
        'meter_danger' => 'Niebezpiecznie',

        /*
         * Podgląd całej strony. Zakładka, a nie panel, bo Pelican wysyła
         * X-Frame-Options: DENY i nie daje się osadzić niczemu, także sobie
         * samemu - patrz Support\FullPreview.
         */
        'full' => 'Zobacz cały panel',
        'full_confirm' => 'Otwiera panel narysowany z ustawień z tej strony zamiast z zapisanych. Nic nie jest zapisywane — wartości są trzymane piętnaście minut, a panel wraca do normy, gdy wyjdziesz z podglądu albo zapiszesz.',
        'full_go' => 'Pokaż',
        'full_failed' => 'Nie udało się uruchomić podglądu',
        'bar' => 'Patrzysz na niezapisane ustawienia. Nic z tego nie zostało zapisane.',
        'bar_back' => 'Wróć do ustawień',
    ],

    'search' => [
        'placeholder' => 'Szukaj w ustawieniach',
        'label' => 'Szukaj w tych ustawieniach',
        'none' => 'Nic na tej stronie nie pasuje. Ustawienia są rozłożone na cztery strony — spróbuj Wygląd, Strony, Zaawansowane albo Ustawienia Essentials.',
    ],

    'footer' => [
        'text' => 'Twój własny wiersz',
        'text_helper' => 'Zwykły tekst, najwyżej 120 znaków. Jest maskowany, tak jak pasek ogłoszeń — to renderuje się na każdej stronie panelu, co czyni je złym miejscem na przyjmowanie znaczników.',
        'version' => 'Pokaż wersję panelu',
        'version_helper' => 'Wersję Pelicana, nie tej wtyczki. Wtyczka podaje swoją na pulpicie; to, czego ludzie szukają na dole paska bocznego, to który panel mają przed sobą.',
        'link_label' => 'Tekst odnośnika',
        'link_url' => 'Adres odnośnika',
        'link_url_helper' => 'Adres http albo https, albo ścieżka samego panelu, na przykład /account. Otwiera się w nowej karcie.',
    ],

    'layout' => [
        'label' => 'Układ',
        'helper' => 'Jak panel jest ułożony, a nie jakiego jest koloru. Dotyczy tak samo obszaru administracyjnego, listy serwerów i obszaru klienta. Gdzie idzie nawigacja, to wartość domyślna: kto ustawił własną w Konto → Nawigacja, ten ją zachowuje.',
        'default' => 'Pasek boczny — własny Pelicana',
        'rail' => 'Szyna ikon — wąska, rozwija się po najechaniu',
        'top' => 'Nawigacja na górze — bez paska bocznego',
        'mixed' => 'Pasek górny i boczny — oba',
        'wide' => 'Szeroki — treść zajmuje cały ekran',
        'focus' => 'Skupiony — wąska kolumna, pasek boczny się chowa',

        'nav_label' => 'Styl paska bocznego',
        'nav_helper' => 'Jak rysowany jest sam pasek boczny.',
        'nav_default' => 'Domyślny',
        'nav_floating' => 'Unoszący się — osobna karta',
        'nav_flat' => 'Płaski — bez żadnego tła',
        'nav_bordered' => 'Z obramowaniem — linia, a nie powierzchnia',

        'topbar_label' => 'Styl topbara',
        'topbar_helper' => '„Ukryty" dotyczy tylko komputera — na telefonie topbar niesie jedyną drogę powrotu do menu.',
        'topbar_default' => 'Domyślny',
        'topbar_floating' => 'Unoszący się — odłączony pasek',
        'topbar_flush' => 'Przylegający — płaski, bez rozmycia',
        'topbar_hidden' => 'Ukryty na komputerze',

        'card_label' => 'Styl kart',
        'card_helper' => 'Sekcje, widżety, karty serwerów i bloki nad konsolą.',
        'card_default' => 'Domyślny — uniesiona, z miękką krawędzią',
        'card_flat' => 'Płaska — bez uniesienia',
        'card_outline' => 'Kontur — obramowanie i nic za nim',
        'card_glass' => 'Matowa — tło prześwituje',
        'card_sharp' => 'Ostra — proste rogi',
    ],

    'servers' => [
        /*
         * Gwiazdka na karcie. Przekazana do skryptu, a nie wpisana w niego, żeby
         * teksty zostały w jedynym miejscu, w którym teksty mieszkają.
         */
        'favourite' => 'Oznacz ten serwer',
        'favourited' => 'Oznaczony — pokazywany pierwszy',

        /*
         * Pigułka obok własnych zakładek Pelicana. Nazwana od tego, co robi z
         * listą, a nie jako czwarta zakładka, bo filtruje tę wybraną zamiast ją
         * zastępować.
         */
        'favourites_tab' => 'Ulubione',
        'favourites_empty' => 'Nic nie jest oznaczone na tej stronie. Użyj gwiazdki na karcie serwera, żeby coś dodać — i zauważ, że to filtruje serwery już wypisane tutaj: oznaczony serwer na dalszej stronie nie jest ukrywany, po prostu nie ma go na tej.',
        'favourites_failed' => 'Nie udało się zapisać Twoich oznaczonych serwerów, więc wróciły do tego, co panel miał ostatnio. Konsola przeglądarki mówi, co odpowiedziało żądanie.',

        'art' => 'Grafika gry',
        'art_helper' => 'Pelican rysuje obrazek egga na każdej karcie. To decyduje, co się z nim robi.',
        'art_faded' => 'Przygaszona — mgiełka za tekstem',
        'art_cover' => 'Kryjąca — za nazwą, wygaszając się',
        'art_off' => 'Wyłączona',
        'art_dim' => 'Przyciemnij grafikę',
        'art_dim_helper' => 'Grafika jednej gry to jasne niebo, a innej jaskinia.',

        'status' => 'Znacznik stanu',
        'status_helper' => 'Gdzie pokazywany jest kolor działa / uruchamia się / zatrzymany.',
        'status_bar' => 'Pasek — przy lewej krawędzi',
        'status_edge' => 'Krawędź — w poprzek góry',
        'status_dot' => 'Kropka — w rogu',
        'status_off' => 'Wyłączony',

        'density' => 'Wysokość kart',
        'density_comfortable' => 'Wygodna',
        'density_compact' => 'Zwarta — przy wielu serwerach',

        'filter_label' => 'Podpisz przycisk filtra',
        'filter_label_helper' => 'Pelican już filtruje tę listę po eggu i po właścicielu, na wszystkich stronach - ale wejściem jest nieopisana ikona obok pola wyszukiwania. To kładzie na niej słowo.',
        'filter_button' => 'Filtry',

        'columns' => 'Kart obok siebie na szerokim ekranie',
        'columns_helper' => 'Dotyczy tylko siatki i dopiero od 1280px. Własne maksimum Pelicana to dwie.',
    ],

    'controls' => [
        'mode' => 'Przycisk konsoli na każdej stronie serwera',
        'mode_helper' => 'Jeden unoszący się przycisk, na każdej stronie wewnątrz serwera. Otwiera konsolę nad tym, co właśnie robisz, ze stanem i przyciskami zasilania w nagłówku — sięgając do węzła bezpośrednio, tak jak robi to lista serwerów, a nie przez websocket strony konsoli. Nigdy nie pojawia się na stronie konsoli, która już to wszystko ma.',
        'mode_full' => 'Konsola i przyciski zasilania',
        'mode_console' => 'Tylko konsola',
        'mode_off' => 'Wyłączony',

        'label' => 'Przycisk pokazuje',
        'label_text' => 'Ikonę i nazwę',
        'label_icon' => 'Tylko ikonę',

        'position' => 'Gdzie się unosi',
        'position_helper' => 'Przy krawędzi, której najpewniej akurat nie czytasz.',
        'position_top' => 'Na górze',
        'position_right' => 'Po prawej',
        'position_bottom' => 'Na dole',
    ],

    'console' => [
        'stats' => 'Bloki nad konsolą',
        'stats_helper' => 'Pelican pokazuje nazwę, stan, adres i trzy liczby zużycia nad terminalem. Ukrycie ich oddaje konsoli wysokość.',
        'stats_tiles' => 'Kafelki — etykieta, liczba i ikona',
        'stats_plain' => 'Proste — tak, jak rysuje je Pelican',
        'stats_off' => 'Ukryte',
    ],

    'terminal' => [
        'helper' => 'Przekazywane samemu terminalowi, więc działają od następnego załadowania strony, a nie w chwili zapisu.',

        'renderer' => 'Rysowane przez',
        'renderer_helper' => 'Pelican rysuje terminal na GPU, co jest znacznie szybsze przy ścianie przewijającego się wyjścia. Przeglądarka trzyma przy życiu tylko pewną liczbę kontekstów GPU naraz — na telefonie mniej — i zabiera najstarszy, gdy limit zostanie przekroczony; terminal wtedy nie rysuje już nic, bez żadnego błędu. Jeśli Twoja konsola robi się pusta, a wszystko inne wygląda normalnie, to jest ustawienie, które się zmienia.',
        'renderer_webgl' => 'GPU — własne Pelicana, szybsze',
        'renderer_dom' => 'Przeglądarka — wolniej, zawsze rysuje',

        'scheme' => 'Zestaw kolorów',
        'scheme_helper' => 'Jedyne ustawienie terminala, którego Pelican nie oferuje. „Idź za motywem" wyprowadza kolory z akcentu i dlatego to w ogóle istnieje.',
        'scheme_theme' => 'Idź za motywem',
        'scheme_dracula' => 'Dracula',
        'scheme_nord' => 'Nord',
        'scheme_solarized' => 'Solarized Dark',
        'scheme_gruvbox' => 'Gruvbox Dark',
        'scheme_one_dark' => 'One Dark',
        'scheme_tokyo_night' => 'Tokyo Night',
        'scheme_catppuccin' => 'Catppuccin Mocha',
        'scheme_monokai' => 'Monokai',

        'cursor' => 'Kursor',
        'cursor_helper' => 'Konsola nie przyjmuje pisania — pole poleceń jest pod nią — więc to jest miejsce, w którym zatrzymało się wyjście, a nie miejsce, w którym jesteś Ty.',
        'cursor_underline' => 'Podkreślenie — własny Pelicana',
        'cursor_block' => 'Blok',
        'cursor_bar' => 'Kreska',

        'blink' => 'Migający kursor',

        'scrollback' => 'Historia przewijania',
        'scrollback_helper' => 'Jak daleko wstecz da się przewinąć konsolę. Każdy wiersz jest trzymany w przeglądarce, więc gadatliwy serwer przy wysokim ustawieniu to prawdziwa pamięć na maszynie, która to czyta.',
        'scrollback_lines' => 'wierszy: :lines',
    ],

    'notice' => [
        'text' => 'Wiadomość',
        'text_helper' => 'Jeden wiersz, do 200 znaków. Jest maskowany na wejściu i na wyjściu, więc nie może wnieść znaczników na stronę, którą ładują inni ludzie.',
        'style' => 'Ton',
        'style_info' => 'Informacja',
        'style_warning' => 'Ostrzeżenie',
        'style_danger' => 'Pilne',
        'style_accent' => 'Kolor akcentu',
        'scope' => 'Pokazywane',
        'scope_all' => 'Wszystkim',
        'scope_client' => 'Tylko poza obszarem administracyjnym',
        'scope_admin' => 'Tylko w obszarze administracyjnym',
        'link_label' => 'Tekst przycisku',
        'link_url' => 'Adres przycisku',
        'link_url_helper' => 'https:// albo ścieżka wewnątrz tego panelu, na przykład /account. Cała reszta jest pomijana — odnośnik na pasku, który jest na każdej stronie, to nie miejsce na schemat, którego nikt się nie spodziewa.',
        'dismissible' => 'Można zamknąć',
        'dismissible_helper' => 'Zamknięcie jest pamiętane per przeglądarka i tylko dla tej wiadomości: zmień tekst, a wróci dla wszystkich.',
        'dismiss' => 'Zamknij',
    ],

    'preset' => [
        'label' => 'Styl',
        'helper' => 'Wybierz wygląd, od którego zaczynasz. Wypełnia wszystko poniżej, co potem możesz zmieniać. „Żaden" wyłącza motyw i zostawia panel dokładnie takim, jakim dostarcza go Pelican.',
        'options' => [
            'none' => 'Żaden - bez motywu',
            'legend' => 'Legend - czerwony ogień przechodzący w niebieską błyskawicę',
            'ember' => 'Ember - ciepła czerń, pomarańczowy akcent',
            'midnight' => 'Midnight - głęboki błękit, spokojny',
            'crimson' => 'Crimson - czerwony, ostre rogi, zwarty',
            'forest' => 'Forest - zielony, zaokrąglony, bez poświaty',
            'nebula' => 'Nebula - fiolet z gradientowym tłem',
            'terminal' => 'Terminal - zielone na czarnym, stała szerokość, ostro',
            'console' => 'Console - okrągły i przestronny, na tablet',
            'nord' => 'Nord - paleta Nord, stonowana',
            'solarized' => 'Solarized - Solarized dark, akcent cyjan',
            'paper' => 'Paper - jasny, mocny kontrast, płaski',
            'daylight' => 'Daylight - jasny i ciepły, z miękką mgiełką',
            'mono' => 'Mono - odcienie szarości, płasko i gęsto',
        ],

        'save' => 'Zapisz jako styl',
        'save_confirm' => 'Zachowuje kolory, rogi, tło, kroje pisma, ikony i progi wskaźników, które masz teraz na ekranie — pod własną nazwą, w wybieraku obok tych wbudowanych. Zapisuje to, co jest na stronie, a nie to, co zapisano ostatnio.',
        'save_name' => 'Nazwa',
        'save_name_helper' => 'Jak będzie się nazywać w wybieraku. Zapis pod nazwą już użytą zastępuje tamten.',
        'saved' => 'Styl zapisany',
        'save_failed' => 'Nie udało się zapisać tego stylu',
        'save_full' => 'Jest miejsce na własnych stylów: :max. Najpierw usuń jeden.',

        'delete' => 'Usuń styl',
        'delete_which' => 'Który',
        'delete_confirm' => 'Usunąć można tylko własne style; wbudowanych nie. Nic w obecnym wyglądzie panelu się nie zmienia — styl to punkt wyjścia, a każda wartość, którą ustawił, jest już w ustawieniach poniżej.',
        'deleted' => 'Styl usunięty',
        'deleted_current' => 'To był ten, na którym stał ten panel. Jego ustawienia są nienaruszone i dalej są na tej stronie — wybierz styl albo zapisz je jeszcze raz pod nazwą.',
    ],

    'user_themes' => [
        'label' => 'Style, które ludzie mogą wybrać dla siebie',
        'helper' => 'Zaznaczone style pojawiają się na stronie Wygląd w panelu klienta, gdzie każdy zalogowany może wybrać jeden dla siebie. Zmienia to, co widzi on, i nic dla innych. Nic zaznaczonego znaczy, że nikt niczego nie wybiera i panel trzyma jeden wygląd — a to właśnie robi teraz.',
    ],

    'mode' => [
        'label' => 'Tryb panelu',
        'helper' => 'W którym trybie panel się otwiera. Kto sam nie wybrał, dostaje ten; przełącznik w menu użytkownika i tak pozwala mu to zmienić, chyba że zablokujesz to poniżej.',
        'dark' => 'Ciemny',
        'light' => 'Jasny',
        'system' => 'Systemowy — idź za ustawieniem odwiedzającego',
    ],

    'font' => [
        'label' => 'Krój pisma panelu',
        'helper' => 'Każda opcja to rodzina, którą system operacyjny już ma — nic nie jest pobierane od dostawcy fontów. Terminala to nie dotyczy: jego krój jest wyborem każdego, w Konto.',
        'default' => 'Domyślny - własny Pelicana',
        'mono' => 'Stała szerokość',
        'rounded' => 'Zaokrąglony',
        'serif' => 'Szeryfowy',
        'system' => 'Systemowy - ten, którego używa ta maszyna',
    ],

    'surface' => [
        'label' => 'Kolor powierzchni',
        'helper' => 'Karty i panele. Jaśniejsze i ciemniejsze odcienie są z niego wyprowadzane.',
        'placeholder' => 'Idź za motywem',
    ],

    'radius' => [
        'label' => 'Rogi',
    ],

    'accent' => [
        'label' => 'Kolor akcentu',
        'helper' => 'Używany do przycisków, odnośników, aktywnej pozycji nawigacji i pierścieni fokusu.',

        /*
         * Powiedziane, a nie wymuszone. Kolor, przed którym to ostrzega, i tak
         * zostaje zapisany: to czyjś panel, liczba mierzy jedną rzecz, a są
         * dobre powody, żeby chcieć akcentu, który wypada źle. Wybierak mówi, co
         * widzi, i schodzi z drogi.
         */
        'contrast_dark' => 'Czytelność: :ratio na ciemnym panelu. Poniżej 3 akcent trudno czytać jako przycisk albo odnośnik — jaśniejszy go podnosi.',
        'contrast_light' => 'Czytelność: :ratio na jasnym panelu. Poniżej 3 akcent trudno czytać jako przycisk albo odnośnik — ciemniejszy go podnosi.',
    ],
    'density' => [
        'label' => 'Gęstość',
        'helper' => 'Zwarta ściąga odstępy, żeby na ekranie zmieściło się więcej wierszy.',
        'comfortable' => 'Wygodna',
        'compact' => 'Zwarta',
    ],
    'force_dark' => [
        'label' => 'Wymuś tryb ciemny',
        'helper' => 'Ukrywa przełącznik jasny/ciemny i trzyma wszystkich użytkowników na ciemnym motywie.',
    ],
    'glass' => [
        'label' => 'Matowy topbar',
        'helper' => 'Rozmywa topbar i tła okien modalnych. Wyłącz na słabszych urządzeniach.',
    ],
    'glow' => [
        'label' => 'Poświata akcentu',
        'helper' => 'Miękki cień w kolorze akcentu na głównych przyciskach, aktywnej nawigacji i karcie logowania.',
    ],

    'background' => [
        'label' => 'Rodzaj tła',
        'helper' => 'Aurora to własne tło motywu: poświaty akcentu z drobnym ziarnem.',
        'aurora' => 'Aurora (domyślne)',
        'solid' => 'Jeden kolor',
        'gradient' => 'Gradient',
        'image' => 'Obraz',
        'color' => 'Kolor',
        'base' => 'Kolor pod poświatami',
        'base_helper' => 'Na czym leży strona, zanim poświaty akcentu zostaną namalowane na wierzchu. Zostaw puste, żeby zachować domyślny kolor panelu, prawie czarny w ciemnym i prawie biały w jasnym. Ustaw go, a zestaw zachowa własny kolor nocy i i tak zostanie podświetlony.',
        'color_end' => 'Drugi kolor',
        'angle' => 'Kierunek',
        'upload' => 'Wgraj obraz',
        'upload_helper' => 'Do 8 MB. Wgrany obraz ma pierwszeństwo przed adresem poniżej.',
        'url' => 'Albo adres URL',
        'url_helper' => 'Musi zaczynać się od https:// i być osiągalny z zewnątrz.',
        'dim' => 'Przyciemnienie',
        'dim_helper' => 'Bez przyciemnienia biały tekst na jasnym zdjęciu jest nieczytelny.',
        'blur' => 'Rozmycie',
    ],

    'channel' => [
        'installed' => 'zainstalowana',
        'version' => 'Zainstaluj konkretną wersję',
        'version_helper' => 'Dowolne wydanie z tego kanału, nie tylko najnowsze — do cofnięcia się, gdy coś nowego okazuje się gorsze, albo do przodu, do builda, o którym Ci powiedziano. Tylko dopóki aktualizacje nie instalują się same: przy tym włączonym to, co wybierzesz, dotrwałoby do następnego sprawdzenia.',
        'version_placeholder' => 'Wybierz wersję',
        'version_install' => 'Zainstaluj tę wersję',
        'version_confirm' => 'Panel pobiera to wydanie, przebudowuje swoje assety i czyści cache. Twoje ustawienia zostają. Powrót do starszej wersji jest dozwolony i nie jest za Ciebie cofany — wybierz nowszą jeszcze raz, żeby ruszyć naprzód.',
        'label' => 'Kanał aktualizacji',
        'helper' => 'Które wydania oferuje strona motywu. Beta dostaje nowe wersje pierwsza, i ostre krawędzie też pierwsza.',
        'stable' => 'Stabilny',
        'beta' => 'Beta',
        'dev' => 'Dev (gałąź robocza)',
        'auto' => [
            'label' => 'Instaluj aktualizacje automatycznie',
            'helper' => 'Wyłączone zostawia aktualizowanie Tobie. Włączone sprawia, że panel sprawdza wybrany kanał i instaluje wszystko nowsze - przebudowuje przy tym swoje assety i przez kilka minut jest niedostępny, dlatego codziennie i co tydzień idą o 04:00. Wymaga działającego crona panelu.',
            'interval' => 'Sprawdzaj co',
            'minute' => 'Co minutę',
            'five_minutes' => 'Co 5 minut',
            'ten_minutes' => 'Co 10 minut',
            'thirty_minutes' => 'Co 30 minut',
            'hourly' => 'Co godzinę',
            'daily' => 'Codziennie (04:00)',
            'weekly' => 'Co tydzień (poniedziałek 04:00)',
        ],
    ],

    /*
     * Zakładka Języki.
     *
     * Ostrożna z tym, co twierdzi. Pelican już pozwala każdemu wybrać język dla
     * całego konta i już go stosuje; nic tutaj tego nie zmienia ani nie
     * powinno. To decyduje wyłącznie o tym, czy własne teksty tej wtyczki idą
     * za tym wyborem.
     */
    'languages' => [
        'section_helper' => 'Pelican już pozwala każdemu wybrać język dla konta, a ta wtyczka idzie za nim wszędzie tam, gdzie została przetłumaczona. Tutaj decydujesz, za którymi z nich pójdzie. Większość języków stoi na niskim procencie celowo: najpierw tłumaczy się tę część, którą każdy widzi na każdej stronie — przyciski zasilania nad konsolą i wskaźniki węzłów — a reszta przychodzi, gdy ludzie ją dołożą.',
        'panel' => 'Niech to decyduje o języku całego panelu',
        'panel_helper' => 'Włączone sprawia, że język, którego ta wtyczka nie niesie — albo wyłączony poniżej — ustawia dla tego czytelnika cały panel na angielski, a nie tylko te strony. Wyłączone sprawia, że tylko ta wtyczka idzie za listą, a Pelican dalej mówi tym, co ustawiono na koncie, co znaczy, że czytelnik może spotkać dwa języki na jednym ekranie. Żadne konto nie jest tak ani tak zmieniane: włącz język z powrotem, a znów go ma.',
        'label' => 'Języki, w których odpowiadać',
        'helper' => 'Odznaczenie odsyła do angielskiego, tylko dla tej wtyczki, czytelników, którzy mają go ustawionego na koncie — reszta panelu dalej mówi w ich języku. Angielskiego nie ma na liście, bo wszystko na niego spada.',
        'under' => 'nie jest oferowany, dopóki nie posunie się dalej — zaznacz, żeby mimo to go oferować',
        'done' => 'przetłumaczone w :percent %',
        'main' => 'Język główny',
        'main_helper' => 'To, co dostaje czytelnik, gdy jego własnego języka nie da się użyć — albo ta wtyczka go nie niesie, albo jest odznaczony poniżej. Zawsze był to angielski; w zespole, który nie pracuje po angielsku, była to zła odpowiedź podana z przekonaniem. Poniżej nie da się go odznaczyć, bo wszystko na niego spada.',
        'labels' => 'Jak nazywa się każdy język',
        'labels_helper' => 'Nazwa, którą czytelnicy i administratorzy widzą w wybierakach. Zostaw jedną pustą, żeby zachować nazwę, pod którą zna go ta wtyczka. Język wgrany pod własną nazwą żadnej nie ma, więc byłby wypisany jako swój kod, dopóki nie nadasz mu tutaj nazwy.',
        'labels_code' => 'Kod',
        'labels_name' => 'Pokazywany jako',
        'download' => 'Pobierz plik tłumaczenia',
        'download_from' => 'Zacznij od',
        'download_from_helper' => 'JSON ze wszystkimi tekstami tej wtyczki. Weź angielski dla języka, którego nikt nie zaczął, albo istniejący, żeby kontynuować to, co już jest przetłumaczone.',
        'code' => 'Kod języka',
        'code_helper' => 'Kod, którego plik dotyczy. Prawdziwe locale, tak jak używają go konta — fr, de, pt_BR — dociera do czytelników, którzy mają je ustawione, i musi zgadzać się dokładnie, bo inaczej nie dotrze. Własna nazwa, na przykład Gaming-PL, jest dozwolona i działa inaczej: Pelican pozwala kontu trzymać tylko prawdziwe locale, więc Twojej nikt nie wybierze. Jest osiągalna jako język główny powyżej, czyli to, co dostaje każdy, czyjego języka nie da się użyć.',
        'url' => 'Albo pobierz go z adresu',
        'url_helper' => 'Adres https, do którego panel dosięgnie — CDN, bucket, surowy plik w repozytorium. Jest pobierany raz przy zapisie i zapisywany tak samo jak wgranie, więc późniejsza zmiana pliku pod tym adresem nic nie daje, dopóki nie zapiszesz ponownie. Plik wybrany powyżej wygrywa z adresem zostawionym w tym polu.',
        'upload' => 'Wgraj plik tłumaczenia',
        'upload_helper' => 'Ten JSON z góry, z przetłumaczonymi wartościami. Jest zapisywany poza wtyczką, więc aktualizacja go nie wyrzuci, i jest nakładany na angielski klucz po kluczu — plik z połową tekstów daje pół języka, a resztę po angielsku.',
        'uploaded' => 'Zainstalowano tekstów dla :code: :count',
        'uploaded_halves' => 'Z tego :mine to własne teksty tej wtyczki, a :panel należy do panelu. Zero po którejś stronie znaczy, że ta połowa pliku nic nie zawierała — klucze wtyczki zaczynają się od essentials::, a klucze panelu nie.',
        'uploaded_skipped' => 'Pominięto :count: puste albo klucze, których ta wtyczka nie ma. Pierwsze z nich: :keys',
        'upload_failed' => 'Nie udało się odczytać tego pliku',
        'upload_failed_body' => 'To musi być JSON z pobrania powyżej — płaski obiekt kluczy i tekstów. Sprawdź, czy edytor nie zapisał go jako czegoś innego.',
    ],

    'windows' => [
        'add' => 'Dodaj okno',
        'from' => 'Od',
        'to' => 'Do',
        'to_helper' => 'Wcześniej niż początek znaczy, że przechodzi przez północ — od 22:00 do 06:00 to noc.',
        'preset' => 'Styl',
        'days' => 'Dni',
        'days_helper' => 'Zostaw wszystkie niezaznaczone dla każdego dnia. Okno przechodzące przez północ należy do dnia, w którym się zaczyna, więc piątek od 22:00 do 06:00 obejmuje sobotni poranek.',
        'day_mon' => 'Poniedziałek',
        'day_tue' => 'Wtorek',
        'day_wed' => 'Środa',
        'day_thu' => 'Czwartek',
        'day_fri' => 'Piątek',
        'day_sat' => 'Sobota',
        'day_sun' => 'Niedziela',
    ],

    'arranger' => [
        'label' => 'Układanie stron',
        'helper' => 'Przycisk „Ułóż stronę", na każdej stronie panelu. Kto ma uprawnienie Układanie, ten go dostaje i może też ustawić układ, od którego zaczynają wszyscy inni, albo układ dla roli. Wyłączone ukrywa go wszystkim; już zapisane układy zostają na miejscu.',
        'roles' => 'Układ to nie uprawnienie. Blok, który rola ukrywa, dalej jest blokiem, do którego ktoś mógłby dojść, wpisując adres — powstrzymują to własne uprawnienia Pelicana, na stronie ról. Nakładają się trzy warstwy w tej kolejności: wspólna wyjściowa, potem rola czytelnika, potem to, co sam przesunął.',
        'users' => 'Pozwól każdemu układać własne strony',
        'users_helper' => 'Włączone pozwala każdemu zalogowanemu przestawiać i ukrywać bloki na stronach, które i tak widzi, tylko dla siebie — dla nikogo innego nic to nie zmienia. Ustawianie wspólnego układu wyjściowego zostaje przy uprawnieniu Układanie.',
    ],

    'brand' => [
        'logo_height' => 'Wysokość logo',
        'logo_height_helper' => 'Pelican dostarcza 2rem. Większe wartości podnoszą razem z nim nagłówek paska bocznego.',
        'logo_url' => 'Podmień logo',
        'logo_url_helper' => 'Zostaw puste, żeby zachować to, na co wskazują własne ustawienia Pelicana.',
    ],

    'login' => [
        'image' => 'Obraz tła',
        'image_helper' => 'Tylko dla ekranu logowania. Bez niego dalej pokazuje tło panelu.',
        'url' => 'Albo adres URL',
        'blur' => 'Rozmycie karty',
        'blur_helper' => 'Matowi kartę, żeby obraz za nią prześwitywał.',
        'width' => 'Szerokość karty',
        'position' => 'Kadr obrazu',
        'position_helper' => 'Która część obrazu przeżywa przycięcie do ekranu.',
        'position_center' => 'Środek',
        'position_top' => 'Góra',
        'position_bottom' => 'Dół',
        'position_left' => 'Lewa',
        'position_right' => 'Prawa',
        'align' => 'Położenie karty',
        'align_helper' => 'Gdzie karta logowania stoi w poprzek ekranu.',
        'align_center' => 'Środek',
        'align_start' => 'Lewa',
        'align_end' => 'Prawa',
        'opacity' => 'Krycie karty',
        'opacity_helper' => 'Niższe przepuszcza przez kartę więcej obrazu.',
        'glow' => 'Poświata akcentu',
        'glow_helper' => 'Aureola wokół karty. Wyłączona zostawia jej krawędź i głębię.',
        'hide_heading' => 'Ukryj nagłówek',
        'hide_heading_helper' => 'Usuwa tytuł nad formularzem, zostawiając sam formularz.',
        'hide_footer' => 'Ukryj stopkę',
        'hide_footer_helper' => 'Usuwa wiersz pod kartą, który prowadzi do pelican.dev.',
        'above' => 'Wiersz nad formularzem',
        'above_helper' => 'Jeden wiersz, pokazywany każdemu, kto trafi na ekran logowania. Zostaw puste, żeby go nie było.',
        'notice' => 'Komunikat pod kartą',
        'notice_helper' => 'Jeden wiersz, pokazywany każdemu, kto trafi na ekran logowania. Zostaw puste, żeby go nie było.',
    ],

    'advanced' => [
        'css' => 'Własny CSS',
        'css_helper' => 'Do 100 KB. Zapisywany do storage, nie do .env.',
        'reference' => 'Wykaz CSS',
        'reference_helper' => 'Każda zmienna i każda klasa, które udostępniają ten motyw i panel.',
    ],

    'areas' => [
        'add' => 'Dodaj obszar',
        'area' => 'Obszar',
        'inherit' => 'Ogólne',
        'radius' => 'Rogi',
        'radius_sharp' => 'Ostre',
        'radius_normal' => 'Normalne',
        'radius_round' => 'Zaokrąglone',
        'surface' => 'Kolor powierzchni',
        'surface_helper' => 'Karty i panele wewnątrz tego obszaru; jaśniejsze i ciemniejsze odcienie są z niego wyprowadzane.',
        'names' => [
            'terminal' => 'Terminal',
            'console' => 'Konsola (reszta strony)',
            'files' => 'Strona plików',
            'edit' => 'Strona edycji',
            'server' => 'Inne strony i zakładki serwera',
        ],
    ],

    'bars' => [
        'base' => 'Kolor podstawowy',
        'base_green' => 'Zielony',
        'base_accent' => 'Kolor akcentu',
        'warning' => 'Bursztynowy od',
        'danger' => 'Czerwony od',
    ],

    'icons' => [
        'stroke' => 'Grubość kreski',
        'stroke_thin' => 'Cienka',
        'stroke_normal' => 'Normalna',
        'stroke_bold' => 'Gruba',
        'scale' => 'Rozmiar',
        'accent' => 'Ikony menu w kolorze akcentu',
        'accent_helper' => 'Dotyczy ikon na pasku bocznym i w topbarze.',
        'pack' => 'Paczka ikon',
        'pack_helper' => 'Z którego zestawu czerpie wybierak poniżej. Oferowany jest każdy zestaw ikon zainstalowany na serwerze, do tego zestaw Essentials dołączony do tej wtyczki i każda paczka, którą wgrasz. Jedna różnica warta poznania: ikona kreskowa jest rysowana w kolorze menu i idzie za najechaniem oraz aktywną pozycją, a ikony Essentials to obrazki i zachowują własne kolory. Decyduje o tym, czym jest plik, a nie z którego zestawu przyszedł.',
        'pack_custom' => 'Wgrana paczka',
        'pack_shipped' => 'Ikony Essentials',
        'use_shipped' => 'Używaj ikon Essentials wszędzie',
        'use_shipped_confirm' => 'Ustawia paczkę na ikony Essentials i wypełnia każdą pozycję menu poniżej ikoną narysowaną dla niej — konsola dostaje terminal, uruchamianie dostaje przycisk startu i tak dalej. Zastępuje pozycje, które masz teraz, a nic nie jest zapisywane, dopóki nie naciśniesz Zapisz, więc zamknięcie strony to cofa.',
        'pack_upload' => 'Wgraj paczkę',
        'pack_upload_helper' => 'Plik .zip z plikami SVG. Każdy plik staje się ikoną nazwaną po nim — logo.svg staje się custom-logo. Wgranie zastępuje paczkę, która jest teraz. Pliki powyżej 256 KB i wszystko powyżej 4000 ikon zostają poza, a Ty dostajesz informację ile: dla skali, cały zestaw Tabler to blisko sześć tysięcy ikon w około trzech megabajtach, więc paczka znacznie większa niesie coś innego niż ikony i większość zostanie pominięta. Duże wgranie może też zostać odrzucone, zanim to pole cokolwiek powie, przez upload_max_filesize i post_max_size w php.ini hosta panelu — żadne ustawienie tutaj ich nie podniesie.',
        'pack_partial' => 'Zainstalowano ikon: :count, ale nie wszystkie',
        'pack_partial_body' => 'Pominięte: :big za duże na ikonę, :unusable nieużyteczne jako SVG, :duplicate o nazwie już zajętej, :empty bez czegokolwiek do narysowania po oczyszczeniu. SVG powyżej 256 KB to prawie zawsze obrazek opakowany w SVG, a nie rysunek — wyeksportuj go w rozmiarze ikony, a będzie miał kilka kilobajtów. Ikona bez czegokolwiek do narysowania zawierała tylko coś, czego się tu nie podaje — jeśli to cała paczka, warto to zgłosić.',
        'pack_stopped_files' => 'Zatrzymało się także na limicie tego, ile ikon może zawierać paczka.',
        'pack_stopped_size' => 'Zatrzymało się także dlatego, że reszta paczki po rozpakowaniu przekracza to, co panel utrzyma naraz w pamięci — sam zip może być mniejszy, bo SVG kompresuje się mniej więcej pięć do jednego.',
        'overrides' => 'Podmień ikony',
        'overrides_helper' => 'Jeden wiersz na każdą ikonę, którą chcesz zmienić. Wybierz pozycję menu, potem wybierz ikonę z paczki powyżej, podaj adres albo wgraj własny obrazek. Jeśli wypełnione jest więcej niż jedno, wygrywa wgranie, potem adres, potem paczka.',
        'overrides_key' => 'Pozycja menu',
        'overrides_value' => 'Ikona z paczki',
        'overrides_url' => 'Albo adres',
        'overrides_url_helper' => 'Adres https obrazka, który hostujesz sam — CDN, bucket, gdziekolwiek przeglądarka dosięgnie. Nic nie jest kopiowane do panelu, więc podmiana pliku pod tym adresem zmienia ikonę bez ruszania tej strony; druga strona tego jest taka, że ikona znika, gdy zniknie adres. Zachowuje własne kolory, jak wgrany obrazek.',
        'overrides_file' => 'Albo wgraj obrazek',
        /*
         * Mówi, na czym różnica naprawdę polega, bo nie jest oczywista i jest
         * powodem, dla którego ktoś wybrałby jedno zamiast drugiego.
         */
        'overrides_file_helper' => 'PNG, SVG albo ICO. Ikona z paczki jest rysowana w kolorze menu i idzie za najechaniem oraz aktywną pozycją; wgrany obrazek zachowuje własne kolory i tego nie robi. Przy logo zwykle właśnie o to chodzi.',
        'overrides_add' => 'Podmień kolejną ikonę',
        'overrides_search' => 'Wpisz nazwę albo pozycję menu…',
    ],

    /*
     * Nie pod „Marką". Marka mówi o tym, jak panel wygląda; to mówi o tym, jak
     * pojawia się w nim ta wtyczka, a to inne pytanie, na które odpowiada inna
     * strona.
     */
    'identity' => [
        'nav_icon' => 'Ikona pozycji „Ustawienia Essentials"',
        'nav_icon_helper' => 'PNG, SVG albo ICO, do 8 MB. Podmienia ikonę tej jednej pozycji na pasku bocznym; zostaw puste, żeby użyć tej, którą wtyczka przynosi ze sobą. Jest rysowana jak obrazek, a nie jak ikona, więc zachowuje własne kolory zamiast iść za tekstem — a tego zwykle chce logo. Plik jest serwowany, a nie osadzany, więc każda przeglądarka pobiera go raz, ale i tak warto wyeksportować coś małego: kilka kilobajtów zupełnie wystarczy na pozycję o wysokości dwudziestu pikseli. Jeśli wgranie padnie, zanim to pole cokolwiek powie, limitem, o który uderzyło, jest upload_max_filesize w php.ini panelu.',
    ],
];
