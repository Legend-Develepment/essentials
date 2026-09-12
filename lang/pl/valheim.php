<?php

/*
 * Polski. Napisane ręcznie.
 *
 * „Egg", „daemon", „SteamID64" i „PlayFab ID" zostają po angielsku: to słowa
 * Pelicana i słowa gry, i pod tymi nazwami się je odnajduje.
 */

return [
    /* ------------------------------------------------ zakładka admina ---- */

    'section_helper' => 'Które eggi uruchamiają Valheima. Nic więcej - serwer Valheima konfiguruje się jego zmiennymi startowymi, a strona Uruchamianie w Pelicanie już je edytuje.',

    'eggs' => 'Które eggi to Valheim',
    'eggs_helper' => 'Zaznacz eggi, które uruchamiają serwer Valheima. W serwerach, które ich używają, pojawia się strona Listy graczy, i nigdzie indziej. Gdzie te listy leżą, różni się między eggami, więc jest ustalane serwer po serwerze, zaglądaniem w miejsca, których używa gra. Na początku nic nie jest zaznaczone i to celowo - wtyczka nie może wiedzieć, jak nazwałeś swoje eggi.',

    /* --------------------------------------------------- strona serwera -- */

    'nav_label' => 'Listy graczy',
    'title' => 'Listy graczy Valheima',
    'subheading' => 'Admini, zbanowani i lista dopuszczonych, jako trzy listy zamiast trzech plików tekstowych.',

    'admin' => 'Admini',
    'admin_helper' => 'Każdy, kto tu jest, może używać poleceń administratora w grze.',
    'banned' => 'Zbanowani',
    'banned_helper' => 'Każdy, kto tu jest, zostaje odrzucony przy próbie wejścia.',
    'permitted' => 'Dopuszczeni',
    'permitted_helper' => 'Jeśli ta lista kogoś zawiera, wejść mogą tylko te osoby. Pusta lista wpuszcza wszystkich - i tego chce większość serwerów, więc zostaw ją pustą, chyba że naprawdę o to chodzi.',

    'ids' => 'Identyfikatory graczy',
    'ids_placeholder' => 'Wklej identyfikator i naciśnij spację',

    'how' => 'Jeden identyfikator na gracza - SteamID64 na serwerze Steam, PlayFab ID na crossplayowym. Wklej je i naciśnij spację, tabulator albo przecinek. To, co gra zapisała jako komentarz nad listą, zostaje na miejscu.',
    'where' => 'Czytane z :dir.',
    'missing' => 'Ten serwer nie ma jeszcze żadnego z tych plików. Gra zapisuje je, gdy pierwszy raz ich potrzebuje, a zapis tutaj utworzy te, które wypełnisz.',
    'read_only' => 'Możesz te pliki czytać, ale nie zapisywać, więc nic tu nie da się zmienić.',

    'save' => 'Zapisz',
    'saved' => 'Zapisano',
    'saved_reload' => 'Valheim czyta te listy na bieżąco, więc zmiana działa bez restartu.',
    'unchanged' => 'Nic się nie zmieniło, więc nic nie zostało zapisane',
    'failed' => 'Nie udało się zapisać',
    'failed_lists' => 'Daemon odrzucił zapis dla: :lists. Sprawdź, czy serwer jest osiągalny i czy pliki nie są tylko do odczytu.',
];
