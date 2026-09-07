<?php

/*
 * Polski. Napisane ręcznie.
 *
 * „Swap", „Load average", „Wings" i „Uptime" zostają po angielsku: pod tymi
 * nazwami odnajduje się je na hoście i w samym interfejsie Pelicana.
 */

return [
    'title' => 'Stan systemu',
    'nav_label' => 'Stan systemu',
    'subheading' => 'Maszyna, na której działa sam panel, co na niej działa, a obok każdy węzeł, o który poprosiłeś.',

    'options' => 'Opcje',
    'enabled' => 'Pokaż na pasku bocznym',
    'enabled_helper' => 'Wyłączone zdejmuje pozycję z paska bocznego. Strona zachowuje własny adres, więc zawsze jest, żeby ją z powrotem włączyć.',

    'refresh' => 'Czytaj ponownie co',
    'refresh_helper' => 'Cała strona jest pobierana od nowa w tym odstępie. Wyłączone zostawia ją taką, jaka była przy otwarciu.',
    'refresh_off' => 'Tylko gdy ją otworzę',
    'refresh_seconds' => ':seconds sekund',

    'blocks' => 'Pokaż',
    'blocks_helper' => 'Zaznaczone znaczy widoczne. „Dysk" to jedna karta na system plików, więc pełna partycja główna nie chowa się za do połowy pustym montowaniem danych.',
    'block_cpu' => 'Procesor',
    'block_memory' => 'Pamięć',
    'block_swap' => 'Swap',
    'block_disk' => 'Dysk',
    'block_load' => 'Load average',
    'block_uptime' => 'Uptime',
    'block_system' => 'System',
    'block_version' => 'Wersja panelu',
    // Nigdy nie pokazywane - karta węzła nosi nazwę samego węzła - ale blank()
    // o to pyta, a brakujący klucz drukujący własną nazwę to kiepskie
    // rozwiązanie awaryjne.
    'block_node' => 'Węzeł',

    'nodes' => 'Węzły do pokazania',
    'nodes_helper' => 'Po jednej karcie, obok hosta panelu. Nic zaznaczonego nie pokazuje żadnego — pulpit ma już blok ze wszystkimi węzłami. Każdy jest pytany u własnego daemona, więc krótki odstęp i długa lista to dużo żądań.',

    'section_usage' => 'Zużycie',
    'section_host' => 'Ten panel',
    'section_nodes' => 'Węzły',

    'disk_panel' => 'Tu mieszka panel',
    'wings' => 'Wings :version',
    'version_installed' => 'Zainstalowana',
    'version_latest' => 'Najnowsza',
    'version_current' => 'Aktualna',
    'version_update' => 'Dostępna aktualizacja',
    'version_unknown' => 'Nie udało się sprawdzić',

    /*
     * Co oferuje karta, która została w tyle.
     *
     * Odnośnik do wydania zamiast przycisku, który aktualizuje, bo stąd nie ma
     * czego aktualizować: Pelican nie ma polecenia aktualizacji, a Wings nie ma
     * punktu końcowego, który podmieniałby własny plik wykonywalny. Wskazówka
     * mówi, gdzie praca naprawdę się odbywa, żeby nikt nie szukał przycisku,
     * który nigdy nie był możliwy.
     */
    'version_release' => 'Co nowego',
    'version_how_panel' => 'Otwiera notatki do wydania. Panel aktualizuje się na maszynie, na której działa - panel nie może podmienić własnych plików, a żadna wtyczka nie może uruchamiać poleceń powłoki.',
    'version_how_wings' => 'Otwiera notatki do wydania. Wings aktualizuje się na samym węźle - panel nie ma żadnego kanału do programu działającego na innej maszynie.',

    'wings_latest' => 'Najnowsza :version',
    'load_cores' => ':percent % z :cores procesorów',
    'load_windows' => ':five przez 5 min · :fifteen przez 15 min',
    'uptime_since' => 'Od :date',
    'unavailable' => 'Niedostępne na tym hoście',

    'fact_os' => 'System operacyjny',
    'fact_hostname' => 'Nazwa hosta',
    'fact_php' => 'PHP',
    'fact_cores' => 'Procesory',
    'fact_processes' => 'Procesy',
];
