<?php

/*
 * Polski. Napisane ręcznie.
 *
 * „Queue worker", „scheduler", „cron", „kanał" i ścieżki takie jak storage/app
 * zostają jak są: pod tymi nazwami odnajduje się je na serwerze i w
 * dokumentacji Pelicana, i dokładnie tego trzeba, gdy pojawia się któryś z tych
 * komunikatów.
 */

return [
    'updating_now' => 'Ten panel instaluje aktualizację. Strona może przez chwilę wyglądać dziwnie.',
    'updating_done' => 'Aktualizacja jest zainstalowana. Jeśli strona chwilę temu wyglądała dziwnie, odśwież ją.',
    'title' => 'Ustawienia Essentials',
    'nav_label' => 'Ustawienia Essentials',
    'save' => 'Zapisz',
    'saved' => 'Ustawienia zapisane',
    'save_failed' => 'Nie udało się zapisać ustawień',
    'update' => 'Zaktualizuj',
    'update_available' => 'Jest dostępna aktualizacja',
    'update_confirm' => 'Panel pobiera nową wersję, przebudowuje swoje assety i czyści cache. Twoje ustawienia zostają.',
    'update_started' => 'Aktualizacja uruchomiona',
    'update_background' => 'Leci w tle i zajmuje minutę albo dwie.',
    'update_failed' => 'Nie udało się zaktualizować motywu',
    'update_done' => 'Motyw zaktualizowany',
    'check' => 'Sprawdź aktualizacje',
    'check_failed' => 'Nie udało się odczytać kanału aktualizacji',
    'check_failed_body' => 'Panel do niego nie dotarł albo nie zwrócił poprawnego JSON-a.',
    'up_to_date' => 'Masz najnowszą wersję',
    'reinstall' => 'Zainstaluj ponownie',

    'auto_on' => 'Aktualizacje instalują się same',

    /*
     * Co zrobiło ostatnie automatyczne sprawdzenie. Każdy z tych wierszy
     * wskazuje miejsce, w które trzeba by zajrzeć, bo z poziomu przeglądarki
     * wszystkie trzy sposoby, na jakie to się psuje, wyglądają tak samo: liczba,
     * która odlicza.
     */
    'auto_never' => 'Nie było jeszcze żadnego sprawdzenia. Automatyczne aktualizacje potrzebują schedulera panelu - wpisu w cronie, który co minutę uruchamia php artisan schedule:run. Bez niego nic zaplanowanego się nie dzieje.',
    'auto_ago' => 'Ostatnie sprawdzenie :ago',
    'auto_just_now' => 'przed chwilą',
    'auto_minutes' => 'minut temu',
    'auto_current' => 'na tym kanale nie ma nic nowszego.',
    'auto_installed' => 'Wersja :version została zainstalowana tutaj, przez samo zaplanowane sprawdzenie. Robi tak, gdy żaden queue worker nie odpowiada, więc aktualizacja i tak się odbywa - ale panel bez workera to panel, w którym reszta pracy z kolejki też się nie dzieje.',
    'auto_queued' => 'Wersja :version trafiła do queue workera. Jeśli wersja powyżej nie zmieni się w ciągu kilku minut, worker bierze zadania, ale na tym jednym się wykłada - zwykle pomaga jego restart, a powód jest w storage/logs.',
    'auto_unreachable' => 'nie udało się odczytać kanału aktualizacji. Jest pobierany przez internet, więc zwykle to problem sieci albo DNS na hoście panelu.',
    'auto_error' => 'sprawdzenie się nie powiodło. Powód jest w storage/logs.',

    /*
     * Queue worker, czyli to, co faktycznie wykonuje aktualizację. Powiedziane
     * osobno od sprawdzenia powyżej, bo psują się osobno, a lekarstwo dla
     * każdego jest inne.
     */
    'worker_missing' => 'Żaden queue worker nie odpowiedział. Aktualizacje, instalacje modpacków i te sprawdzenia trafiają do kolejki i wykonuje je proces worker, więc dopóki żaden nie działa, są zapisywane i nigdy nie wykonywane, bez żadnego błędu w jakimkolwiek miejscu. Albo workera nie ma, albo jest taki, który wystartował przed instalacją tej wtyczki i nie umie wczytać jej kodu - jedno i drugie naprawia jego restart na hoście panelu. Ustaw jego usługę tak, żeby restartowała się sama, bo inaczej wróci to po każdej aktualizacji.',
    'cron_missing' => 'Scheduler panelu nie uruchomił się od :for minut. Odnowienia, sprawdzenia watchdoga i automatyczne aktualizacje - wszystko to na niego czeka. Wpis do crona jest w dokumentacji Pelicana.',

    'next_check' => 'Następne sprawdzenie za',
    'due_now' => 'należne teraz',

    /*
     * Nazwane od przyczyny, a nie od objawu, bo objawem jest „nic się nie
     * stało" i to właśnie utrudniało umiejscowienie: ogłoszenia, odnośniki
     * nawigacji, zapisane style i układy stron to wszystko pliki w storage/app,
     * a katalog, do którego panel nie może pisać, traci je wszystkie bez słowa.
     */
    'storage_failed' => 'Panel nie mógł zapisać do swojego katalogu storage, więc to nie zostało zapisane. Sprawdź, czy storage/app należy do użytkownika, na którym działa panel. Powód jest w storage/logs.',

    /*
     * Powiedziane po każdej nieudanej aktualizacji, a nie tylko po niezgodności
     * identyfikatorów. Komunikat powyżej nazywa już przyczynę; ten nazywa
     * jedyne lekarstwo, którego nie da się wyprowadzić z „oczekiwano X,
     * dostano Y".
     */
    'update_renamed' => 'Jeśli pisze, że dwa identyfikatory się nie zgadzają, wtyczka została przemianowana i żadna aktualizacja przez to nie przejdzie - Pelican rozpoznaje zainstalowaną wtyczkę po identyfikatorze. Odinstaluj starą pozycję w Admin → Wtyczki i zainstaluj tę na nowo. Twoje ustawienia to przetrwają: leżą w .env i w storage/app/private/legend-theme, a żadne z nich nie jest indeksowane identyfikatorem.',
];
