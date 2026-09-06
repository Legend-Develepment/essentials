<?php

/*
 * Polski. Napisane ręcznie.
 *
 * „Egg", „GameUserSettings.ini" i „daemon" zostają po angielsku: to słowa, które
 * widać w Pelicanie, w menedżerze plików i we wszystkim, co pisze się o ARK-u.
 */

return [
    /* ------------------------------------------------ zakładka admina ---- */

    /*
     * Samego nagłówka sekcji tu nie ma. Każda sekcja ustawień bierze tytuł z
     * settings.groups.<nazwa>, a to buduje group().
     */
    'section_helper' => 'Które eggi uruchamiają ARK-a. Nic więcej — resztę serwera ARK konfiguruje się jego zmiennymi startowymi, a strona Uruchamianie w Pelicanie już je edytuje.',

    'eggs' => 'Które eggi to ARK',
    'eggs_helper' => 'Zaznacz eggi, które uruchamiają serwer ARK. W serwerach, które ich używają, pojawia się strona Ustawienia świata, i nigdzie indziej. To inne pytanie niż na stronie statusu: tamto pyta, które eggi odpowiadają na zapytanie Valve, co robią też Rust i Valheim, a to pyta, które eggi trzymają GameUserSettings.ini tam, gdzie trzyma go ARK, co robi tylko ARK. Na początku nic nie jest zaznaczone i to celowo — wtyczka nie może wiedzieć, jak nazwałeś swoje eggi.',

    /* --------------------------------------------------- strona serwera -- */

    'nav_label' => 'Ustawienia świata',
    'title' => 'Ustawienia świata ARK',
    'subheading' => 'Ustawienia, które ludzie naprawdę zmieniają, z GameUserSettings.ini.',

    'group_server' => 'Serwer',
    'group_server_helper' => 'Jak serwer się nazywa, kto może wejść i ilu.',
    'group_rates' => 'Współczynniki',
    'group_rates_helper' => 'Jak szybko rzeczy się dzieją. 1.0 to gra taka, jaka wychodzi; 2.0 to dwa razy szybciej.',
    'group_rules' => 'Zasady',
    'group_rules_helper' => 'Co gracze mogą robić i co gra im pokazuje.',

    'keeps' => 'Piętnaście ustawień z pliku, który ma ich setki. Cała reszta — ustawienia Twoich modów, klucze, o których ta wtyczka nigdy nie słyszała, komentarze i kolejność tego wszystkiego — zostaje dokładnie taka, jaka jest, gdy zapisujesz.',
    'missing' => 'Ten serwer nie ma jeszcze GameUserSettings.ini. Gra zapisuje go przy pierwszym uruchomieniu, więc uruchom serwer raz, a ta strona się wypełni.',
    'read_only' => 'Możesz ten plik czytać, ale nie zapisywać, więc nic tu nie da się zmienić.',

    'save' => 'Zapisz',
    'saved' => 'Zapisano',
    'saved_restart' => 'ARK czyta ten plik przy starcie, więc uruchom serwer ponownie, żeby zmiana zadziałała.',
    'failed' => 'Nie udało się zapisać',
    'failed_write' => 'Daemon odrzucił zapis. Sprawdź, czy serwer jest osiągalny i czy plik nie jest tylko do odczytu.',
];
