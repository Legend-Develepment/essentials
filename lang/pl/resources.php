<?php

/*
 * Polski. Napisane ręcznie.
 *
 * „Mod", „plugin", „loader", „jar" oraz nazwy katalogów mods/ i plugins/
 * zostają jak są: to słowa z Modrintha, z menedżera plików i z każdego
 * poradnika, jaki się na ten temat znajdzie.
 */

return [
    'nav_label' => 'Mody i pluginy',
    'title' => 'Mody i pluginy',
    'subheading' => 'Po jednym, z Modrintha, na ten serwer.',

    'section' => 'Znajdź coś',
    'section_helper' => 'Strona modpacków instaluje cały pack naraz. Tutaj instaluje się pojedynczy mod albo plugin — a tego chce się znacznie częściej.',

    'kind' => 'Co dodajesz',
    /*
     * Pytane, a nie wyprowadzane. Egg nazywa się tak, jak nazwał go
     * administrator, a kilka loaderów czyta oba katalogi, więc stąd nie ma
     * uczciwego sposobu, żeby to zgadnąć - a złe zgadnięcie zapisuje jara do
     * katalogu, którego nikt nie czyta.
     */
    'kind_helper' => 'Mod idzie do mods/ i jest dla Fabrica, Forge albo NeoForge. Plugin idzie do plugins/ i jest dla Bukkita, Spigota albo Papera. To decyduje też, w której połowie Modrintha się szuka.',
    'kind_mod' => 'Mod (mods/)',
    'kind_plugin' => 'Plugin (plugins/)',

    'search' => 'Szukaj',
    'search_helper' => 'Wpisz nazwę i kliknij poza polem. Wyniki są od najczęściej pobieranych.',

    'project' => 'Mod albo plugin',
    'version' => 'Wersja',
    'version_helper' => 'Każdy wiersz ma numer wersji, wersje Minecrafta, dla których została zbudowana, i obsługiwane loadery. Wybierz taką, która pasuje do Twojego serwera — nic tutaj tego za Ciebie nie sprawdza.',

    'install' => 'Zainstaluj',
    'install_confirm' => 'Plik jest pobierany przez węzeł prosto z Modrintha i wkładany do katalogu. Nic, co już tam jest, nie jest usuwane.',
    'installed' => 'Zainstalowano',
    'installed_helper' => 'Wczyta się przy następnym starcie serwera.',

    'change' => 'Zmień wersję',
    'change_helper' => 'Wstawia inną wersję tego samego projektu w miejsce tego pliku. Nowa jest pobierana przed usunięciem starej, więc nieudane pobranie zostawia Cię z tym, co już miałeś.',
    'change_project_helper' => 'Ustalone dla wszystkiego, co zainstalowano z tej strony. Zmiana tego nie byłaby zmianą wersji — byłaby innym modem pod tą samą nazwą pliku.',
    'change_lookup_helper' => 'Ten plik już był w katalogu, więc nic tutaj nie wie, czym jest. Wyszukaj go raz, a zostanie zapamiętany.',
    'changed' => 'Wersja zmieniona',

    'check' => 'Sprawdź aktualizacje',
    'checked' => 'Sprawdzono',
    'checked_none' => 'Wszystko, co znane, jest w najnowszej wersji.',
    'checked_some' => ':count ma nowszą wersję. Są zaznaczone na liście.',
    'update_ready' => 'dostępna v:number',
    /*
     * Powiedziane obok odznaki, a nie w dymku, bo zmienia to, co odznaka
     * znaczy: nic tutaj nie wie, jaką wersję Minecrafta ani jaki loader serwer
     * uruchamia.
     */
    'check_note' => 'Nowsze znaczy nowsze na Modrincie. Nic tutaj nie wie, jaką wersję Minecrafta ani jaki loader uruchamia Twój serwer, więc sprawdź, czy wybrana wersja deklaruje, że pasuje, zanim uruchomisz serwer.',
    'unknown' => 'Nie stąd — użyj „Zmień wersję", żeby powiedzieć, co to jest',

    'remove' => 'Usuń',
    'remove_confirm' => 'Plik zostanie usunięty z serwera. Stąd nie da się tego cofnąć.',
    'removed' => 'Usunięto',

    'running' => 'Serwer działa',
    'running_helper' => 'Minecraft czyta mods/ i plugins/ raz, przy starcie. Plik dodany teraz wczytałby się dopiero po restarcie, a plik zabrany spod działającej gry może zabrać grę ze sobą. Najpierw zatrzymaj serwer.',

    'failed' => 'To nie zadziałało',
    'failed_version' => 'Ta wersja nie ma jara, którego dałoby się tu zainstalować. Niektóre wydania zawierają tylko źródła albo tylko build kliencki.',
    'failed_write' => 'Węzeł odrzucił pobranie. Mógł nie dosięgnąć Modrintha.',

    'installed_title' => 'Zainstalowane',
    'installed_mods' => 'W mods/',
    'installed_plugins' => 'W plugins/',
    /*
     * Powiedziane, bo pusta lista jest dwuznaczna: zwykle znaczy, że ten serwer
     * w ogóle nie używa tego katalogu, a nie że czegoś brakuje.
     */
    'installed_empty' => 'Tu nic nie ma. Serwer używa tylko jednego z tych dwóch katalogów, więc to, że jeden jest pusty, jest normalne.',
    'installed_note' => 'Wypisane są tylko pliki .jar. Katalogi konfiguracyjne i pliki wyłączone są zostawiane w spokoju i nie są pokazywane.',
];
