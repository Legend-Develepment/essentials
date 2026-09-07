<?php

/*
 * Polski. Napisane ręcznie.
 *
 * Publiczna strona statusu.
 *
 * Jedyna rzecz, którą ta wtyczka podaje komuś niezalogowanemu, i jedyna strona,
 * której słowa trzeba czytać tak, jakby zobaczył je ktoś obcy - bo zobaczy. Nic
 * tutaj nie mówi, który węzeł, który właściciel ani jaki adres; nazwa, czy
 * działa, i ilu ludzi na niej gra.
 *
 * „Węzeł" pojawia się tylko w ustawieniach; na samej publicznej stronie jest
 * „maszyna", bo tam czyta ktoś, kto nigdy nie słyszał o Pelicanie.
 */

return [
    // ---- strona ustawień --------------------------------------------------
    'title' => 'Publiczna strona statusu',
    'nav_label' => 'Strona statusu',
    'subheading' => 'Strona, którą każdy może otworzyć bez konta, pokazująca, które z Twoich serwerów działają. Nic się na niej nie pojawia, dopóki nie wskażesz serwera poniżej.',

    'address' => 'Twoja strona statusu działa pod adresem',
    'address_off' => 'Nic jeszcze nie jest podawane. Dodaj poniżej serwer, maszynę albo usługę i zapisz, a adres pojawi się tutaj.',

    'which' => 'Co jest publikowane',
    'which_helper' => 'Lista zaczyna się pusta i nic nie jest publiczne, dopóki coś w niej nie stanie. Oferowane są tylko serwery, które i tak możesz otworzyć.',
    'add' => 'Opublikuj serwer',
    'server' => 'Serwer',
    'shown_as' => 'Pokazywany jako',
    'shown_as_helper' => 'To, co widzi publiczność. Wpisz to sam, zamiast pozwolić panelowi wziąć prawdziwą nazwę — „mc-prod-3 (nie ruszać)" to notatka do siebie, a nie rzecz na forum.',

    'look' => 'Treść',
    'look_helper' => 'Wszystko na tej stronie czytają ludzie, którzy nie mają konta.',
    'heading' => 'Nagłówek',
    'heading_helper' => 'Zostawione puste — używana jest nazwa samego panelu.',
    'note' => 'Wiersz nad listą',
    'note_helper' => 'Do powiedzenia, co się dzieje — okno serwisowe albo gdzie pytać. Zwykły tekst.',
    'link' => 'Odnośnik do panelu',
    'link_helper' => 'Droga z powrotem, na dole strony. Wyłącz, jeśli wolisz nie ogłaszać, gdzie stoi Twój panel.',

    'save' => 'Zapisz',
    'saved' => 'Zapisano',
    'save_failed' => 'Nic nie zostało zapisane',
    'open' => 'Otwórz stronę',

    // ---- liczby graczy ----------------------------------------------------
    'counts' => 'Liczby graczy',
    'counts_helper' => 'Skąd biorą się liczby obok serwera. Serwery Minecrafta odpowiadają na własny handshake i ustawia się je pod Minecraftem; wszystko poniżej dotyczy gier, które odpowiadają na zapytanie Valve — Rusta, ARK-a, Valheima, 7 Days to Die i większości reszty, która stoi na Source albo Unrealu.',
    'query_eggs' => 'Eggi odpowiadające na zapytanie Valve',
    'query_eggs_helper' => 'Zaznacz eggi tych gier. Ta sama lista decyduje też, które serwery dostają stronę Gracze wewnątrz panelu — jedno pytanie zadane z dwóch powodów. Nic nie jest pytane, dopóki tego nie powiesz: to jedyna rzecz tutaj, która otwiera połączenie z panelu prosto do portu gry, więc jest wyborem, a nie czymś, co samo zaczyna się dziać. Serwer, którego port nie jest osiągalny z panelu, po prostu nie pokazuje liczby.',

    // ---- węzły ------------------------------------------------------------
    'nodes' => 'Maszyny',
    'nodes_helper' => 'Działa albo nie działa, i nic więcej. Ani obciążenie, ani to, jak pełny jest dysk — ktoś, kto pyta, czy może zagrać, nie potrzebuje raportu o pojemności Twojego sprzętu, a opublikowanie go to mapa tego, gdzie ciśnie.',
    'add_node' => 'Opublikuj maszynę',
    'node' => 'Maszyna',
    'node_shown_as_helper' => 'Wpisz to sam. Węzeł zwykle nazywa się jakoś jak hetzner-fsn1-01, a to całe zdanie o tym, gdzie stoją Twoje maszyny.',

    // ---- monitory HTTP ----------------------------------------------------
    'monitors' => 'Inne usługi',
    'monitors_helper' => 'Wszystko inne, o czym warto wiedzieć, że działa: Twoja strona, API, endpoint zdrowia bota. Panel pyta każdą z nich w tym samym rytmie co serwery. Tylko administratorzy — monitor sprawia, że ten panel pobiera jakiś adres, a pozwolenie każdemu dodać monitor zamienia go w sondę, którą można wycelować, gdzie się chce.',
    'add_monitor' => 'Dodaj usługę',
    'monitor_name' => 'Nazwa',
    'monitor_url' => 'Adres',
    'monitor_url_helper' => 'Tylko https. Gdyby ten panel co jakiś czas pobierał zwykłe http, powiedziałby każdemu po drodze, które z Twoich usług istnieją.',
    'monitor_expect' => 'Oczekiwane',
    'monitor_expect_helper' => 'Zostaw puste dla „jakakolwiek odpowiedź", co pasuje do strony, która przekierowuje albo odpowiada 403 na gołe żądanie. Liczba jest dla endpointu napisanego tak, żeby mówić dokładnie to i nic więcej — ustawiona zbyt ostro sprawia, że wiersz jest na zawsze czerwony przy usłudze, z którą wszystko w porządku.',

    // ---- strony dla użytkowników ------------------------------------------
    'users' => 'Strony dla Twoich użytkowników',
    'users_helper' => 'Czy ludzie z serwerami w tym panelu mogą publikować własną stronę statusu.',
    'user_pages' => 'Pozwól użytkownikom zrobić własną',
    'user_pages_helper' => 'Każdy dostaje własny adres pod /status/jego-skrót, pokazujący tylko serwery, których jest właścicielem, pod nazwami, które sam wpisze. Żadnych maszyn i żadnych innych usług na nich — jedno i drugie należy tylko do Ciebie. Gdy to jest włączone, znajdą to pod „Strona statusu" w menu swojego konta, w którymkolwiek panelu akurat są.',

    // ---- wygląd -----------------------------------------------------------
    'every' => 'Sprawdzaj co',
    'every_helper' => 'Jak często strona jest budowana od nowa i jak często odświeża się sama w przeglądarce. Strona, na którą ludzie patrzą podczas restartu, chce sekund; strona podlinkowana z forum, której nikt nie ma otwartej, chce godziny, a pytanie o nią każdego węzła co minutę to praca wykonana dla nikogo.',
    'every_realtime' => 'Na żywo (10 sekund)',
    'every_30s' => '30 sekund',
    'every_1m' => '1 minuta',
    'every_5m' => '5 minut',
    'every_10m' => '10 minut',
    'every_30m' => '30 minut',
    'every_60m' => '60 minut',

    'style' => 'Styl',
    'style_helper' => 'Jeden z wyglądów samego panelu, zastosowany na tej stronie: jego kolor, szarości zbudowane z jego powierzchni i to, jak zaokrąglone są rogi. „Idź za panelem" znaczy ten, który jest w nim ustawiony dziś, razem z każdą późniejszą zmianą.',
    'style_mine_helper' => 'Style, które oferuje ten panel, zastosowane na Twojej stronie: kolor, szarości z niego zbudowane i to, jak zaokrąglone są rogi. Które style są na tej liście, decyduje właściciel panelu — ta sama lista, z której możesz wybierać pod Wygląd. „Idź za panelem" znaczy ten, który jest ustawiony.',
    'style_panel' => 'Idź za panelem',

    // ---- czyjaś własna strona ---------------------------------------------
    'mine_title' => 'Moja strona statusu',
    'mine_nav_label' => 'Strona statusu',
    'mine_subheading' => 'Jeden adres do dania ludziom, którzy grają na Twoich serwerach. Pokazuje serwery, które wybierzesz, i nic więcej o tym panelu.',
    'mine_address' => 'Twój adres',
    'mine_address_helper' => 'Weź coś krótkiego. Zmiana później psuje każdy odnośnik, który ktoś już zapisał.',
    'mine_address_off' => 'Wybierz poniżej adres i zapisz, a Twoja strona pojawi się tutaj.',
    'slug' => 'Adres',
    'slug_helper' => 'Małe litery, cyfry i myślniki. Trzy znaki albo więcej.',
    'mine_heading' => 'Nagłówek',
    'mine_heading_helper' => 'Zostawione puste — używany jest Twój adres.',
    'mine_note_helper' => 'Do powiedzenia, co się dzieje — restart, wydarzenie, gdzie Cię znaleźć. Zwykły tekst, czytany przez każdego, kto ma odnośnik.',
    'mine_which' => 'Twoje serwery',
    'mine_which_helper' => 'Oferowane są tylko serwery, których jesteś właścicielem. Bycie subuserem gdzie indziej to dostęp do maszyny, a nie zgoda na publikowanie, że ona istnieje.',
    'mine_shown_as_helper' => 'To, co widzą odwiedzający. Wpisz to sam, zamiast używać nazwy z panelu, jeśli ta nazwa jest notatką do siebie.',
    'mine_look_helper' => 'Jak Twoja strona wygląda dla ludzi, którym ją wysyłasz.',
    'mine_remove' => 'Zdejmij moją stronę',
    'mine_remove_confirm' => 'Zdejmuje Twoją stronę i zwalnia adres dla kogoś innego. Wszystko, co ustawiłeś, przepada; same serwery pozostają nietknięte.',
    'mine_removed' => 'Twoja strona została zdjęta',

    'why_slug' => 'Ten adres się nie nada. Małe litery, cyfry i myślniki, trzy znaki albo więcej — a kilka słów jest zarezerwowanych.',
    'why_taken' => 'Ten adres ma już ktoś inny.',
    'why_unwritable' => 'Nie udało się tego zapisać. Sprawdź, czy storage/app należy do użytkownika, na którym działa panel.',

    // ---- nagłówki na samej stronie ----------------------------------------
    'section_servers' => 'Serwery',
    'section_nodes' => 'Maszyny',
    'section_monitors' => 'Usługi',

    // ---- sama strona ------------------------------------------------------
    'up' => 'Online',
    'down' => 'Offline',
    'starting' => 'Uruchamia się',

    /*
     * Nie „offline", a różnica ma znaczenie publicznie.
     *
     * Panel nie dosięgnął serwera. To zwykle węzeł w konserwacji albo daemon,
     * który się restartuje - to nie to samo, co wyłączony serwer, a mówienie
     * stu graczom, że ich serwer padł, gdy on działa, jest gorsze niż przyznanie
     * się, że się nie wie.
     */
    'unknown' => 'Nieznany',

    'players' => 'Gracze',
    'online_now' => 'gra w tej chwili',
    'checked' => 'Sprawdzono',
    'next_check' => 'do następnego sprawdzenia',
    'just_now' => 'przed chwilą',
    'seconds_ago' => ':count sekund temu',
    'panel' => 'Zaloguj się',

    'all_up' => 'Wszystko działa.',
    'some_down' => 'Coś nie działa.',
    'empty' => 'Nic tu jeszcze nie jest publikowane.',
];
