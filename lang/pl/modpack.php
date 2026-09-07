<?php

/*
 * Polski. Napisane ręcznie.
 *
 * „Modpack", „loader", „egg", „daemon", „mody" i „config" zostają po angielsku:
 * to słowa, które widać na Modrincie, w menedżerze plików i w każdym poradniku,
 * jaki się na ten temat znajdzie.
 */

return [
    'nav_label' => 'Modpacki',
    'title' => 'Modpacki',
    'subheading' => 'Instalacja modpacka z Modrintha na ten serwer.',

    'section' => 'Znajdź pack',
    'section_helper' => 'Tylko Modrinth i tylko packi serwerowe. Nie wymaga ani konta, ani klucza API, i dlatego jest tu jedynym źródłem — pozostałe chcą klucza wklejonego gdzieś, zanim cokolwiek się pojawi.',

    'search' => 'Szukaj',
    'search_helper' => 'Zostaw puste, żeby zobaczyć najczęściej pobierane. Szukanie pyta Modrintha, więc dzieje się, gdy wychodzisz z pola, a nie w trakcie pisania.',

    'pack' => 'Pack',
    'pack_helper' => 'Wypisane są tylko packi, które deklarują, że działają na serwerze.',

    'version' => 'Wersja',
    'version_helper' => 'Wersja gry i loader są pokazane przy każdej. Wybierz loader, który egg tego serwera już uruchamia — to instaluje pliki i nie zmienia ani Twojego egga, ani polecenia startowego.',

    'downloads' => 'pobrań',

    'install' => 'Zainstaluj ten pack',
    'install_go' => 'Zainstaluj',
    'install_confirm' => 'Pliki packa są dodawane do tego serwera. **Nic nie jest usuwane** — ani Twój świat, ani stare mody, ani config. Pack zainstalowany na innym zostawia oba, więc najpierw sam usuń mody poprzedniego packa, jeśli o to chodzi. Serwer musi być zatrzymany i pozostaje zatrzymany.',

    'started' => 'Instalowanie',
    'started_helper' => 'Pack jest pobierany i rozpakowywany. Kilkaset plików zajmuje kilka minut, a na koniec dostajesz powiadomienie — leci dalej, nawet jeśli opuścisz tę stronę.',

    'running' => 'Serwer działa',
    'running_helper' => 'Minecraft ładuje mody przy starcie, więc pack zainstalowany teraz zostawiłby serwer, który do restartu nie jest ani starym packiem, ani nowym. Zatrzymaj go i spróbuj jeszcze raz.',

    'done' => 'Zainstalowano :pack',
    'done_body' => 'Pobrano plików: :files, a elementów z własnego katalogu packa ustawiono: :overrides. Uruchom serwer, kiedy zechcesz.',
    'done_refused' => 'Pominięto plików: :count, bo pack prosił o nie z miejsca, z którego się tutaj nie pobiera.',

    'failed' => 'Pack nie został zainstalowany',
    'failed_fetch' => 'Nie udało się pobrać ani rozpakować packa. Daemon może być nieosiągalny albo serwerowi mógł skończyć się dysk.',
    'failed_index' => 'Pack został pobrany, ale nie miał w środku czytelnego indeksu, więc nie było czego instalować.',
    'failed_version' => 'Ta wersja nie ma już pliku packa do pobrania. Wybierz inną.',
    'failed_queue' => 'Nie udało się dodać instalacji do kolejki. To wymaga działającego queue workera w panelu.',
];
