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
    'title' => 'Ustawienia Essentials',
    'nav_label' => 'Ustawienia Essentials',
    'save' => 'Zapisz',
    'saved' => 'Ustawienia zapisane',
    'save_failed' => 'Nie udało się zapisać ustawień',
    'secret_kept' => 'Zapisano. Zostaw puste, aby zachować, lub wpisz nowy, aby zastąpić.',
    'update_background' => 'Leci w tle i zajmuje minutę albo dwie.',

    /*
     * Queue worker i harmonogram (scheduler), od których zależy każde zadanie
     * w tle i każde zadanie zaplanowane. Powiedziane osobno, bo psują się
     * osobno, a lekarstwo dla każdego jest inne.
     */
    'worker_missing' => 'Żaden queue worker nie odpowiedział. Instalacje modpacków, maile i inne zadania w tle trafiają do kolejki i wykonuje je proces worker, więc dopóki żaden nie działa, są zapisywane i nigdy nie wykonywane, bez żadnego błędu w jakimkolwiek miejscu. Albo workera nie ma, albo jest taki, który wystartował przed instalacją tej wtyczki i nie umie wczytać jej kodu - jedno i drugie naprawia jego restart na hoście panelu. Ustaw jego usługę tak, żeby restartowała się sama, bo inaczej wróci to po każdej aktualizacji.',
    'cron_missing' => 'Scheduler panelu nie uruchomił się od :for minut. Odnowienia i sprawdzenia watchdoga na niego czekają. Wpis do crona jest w dokumentacji Pelicana.',

    /*
     * Nazwane od przyczyny, a nie od objawu, bo objawem jest „nic się nie
     * stało" i to właśnie utrudniało umiejscowienie: ogłoszenia, odnośniki
     * nawigacji, zapisane style i układy stron to wszystko pliki w storage/app,
     * a katalog, do którego panel nie może pisać, traci je wszystkie bez słowa.
     */
    'storage_failed' => 'Panel nie mógł zapisać do swojego katalogu storage, więc to nie zostało zapisane. Sprawdź, czy storage/app należy do użytkownika, na którym działa panel. Powód jest w storage/logs.',
];
