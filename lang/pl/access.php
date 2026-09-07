<?php

/*
 * Polski. Napisane ręcznie.
 *
 * „Subuser", „Wings", „SFTP", „cron" i „queue worker" zostają po angielsku: pod
 * tymi nazwami odnajduje się je w Pelicanie i na hoście, i dokładnie to trzeba
 * wiedzieć, gdy pojawia się któryś z tych wierszy.
 */

return [
    'nav_label' => 'Dostęp do serwerów',
    'title' => 'Serwery według roli',
    'subheading' => 'Daj wszystkim z daną rolą dostęp do tych samych serwerów.',

    /*
     * Powiedziane przed wszystkim innym na stronie, bo to jedyna funkcja
     * tutaj, która pisze do tabeli należącej do Pelicana.
     */
    'more' => 'Jak to działa',
    'warning' => 'Działa to przez utrzymywanie w aktualności subuserów samego Pelicana — tych samych wierszy, które dodałbyś ręcznie na stronie Użytkownicy danego serwera, i tych, które czyta lista serwerów, każde sprawdzenie uprawnień oraz Wings. Rusza wyłącznie wiersze, które sam utworzył: to, co dodałeś ręcznie, nigdy nie jest zmieniane ani usuwane. Nikt nie dostaje maila, gdy rola przyznaje mu serwer. Odebranie dostępu unieważnia też jego SFTP, a to wymaga queue workera, o którego Pelican i tak prosi.',

    'never' => 'Nic jeszcze nie zostało uzgodnione. Zapisz przypisanie poniżej, a stanie się to od razu, a potem co minutę przez cron samego panelu.',
    'timing' => 'Dostęp jest odbierany w chwili, w której powinien: kto traci rolę, traci serwery już na następnej stronie. Przyznanie może potrwać do minuty, bo to przebieg szukający ludzi, którzy akurat nie korzystają z panelu.',
    'last_run' => 'Ostatni przebieg :ago sekund temu: dodano :added, usunięto :removed, zostawiono :held.',
    'capped' => 'Za dużo naraz — przyznań: :pairs, a limit to :max. Nic nie zostało zapisane. Zawęź przypisanie: rola z pięćdziesięcioma osobami i dwudziestoma serwerami to tysiąc przyznań sama z siebie.',

    'which' => 'Przypisania',
    'which_helper' => 'Rola, serwery, do których mają sięgać jej posiadacze, i co mogą tam robić. Kto ma dwie role, dostaje wszystko, co przyznają obie. Właściciele serwerów i administratorzy root są pomijani — mają już więcej, niż to mogłoby im dać.',
    'add' => 'Dodaj rolę',

    'role' => 'Rola',
    'role_helper' => 'Wszyscy, którzy ją mają, także ci, którzy dostaną ją później.',
    'servers' => 'Serwery',
    'servers_helper' => 'Serwery, które dostają. Usunięcie jednego stąd odbiera ten dostęp z powrotem.',

    'permissions' => 'Co mogą robić',
    'permissions_helper' => 'Uprawnienia subusera samego Pelicana. Zostaw je tak, jak są, dla rozsądnego zestawu: konsola, przyciski zasilania, pliki, kopie zapasowe i dziennik aktywności — i nic, co edytuje serwer, jego użytkowników, bazy danych czy alokacje. „Connect to websocket" jest zawsze dołączone, bo bez niego strona konsoli nie łączy się z niczym.',

    'save' => 'Zapisz i zastosuj',
    'saved' => 'Zapisano',
    'saved_body' => 'Przyznano :added, odebrano :removed.',
    'save_failed' => 'Nie udało się zapisać',
    'save_failed_disk' => 'Nie udało się zapisać listy do storage. Sprawdź, czy storage/app należy do użytkownika, na którym działa panel.',

    'revoke' => 'Odbierz wszystko',
    'revoke_confirm' => 'Usunąć wszystko, co to przyznało?',
    'revoke_confirm_helper' => 'Każdy wiersz subusera, który utworzyła ta strona, na każdym serwerze, dla każdego — i ich SFTP razem z nim. Wiersze dodane ręcznie nie są ruszane. Przypisania poniżej zostają, więc następny zapis albo następny przebieg przyznałby je ponownie: najpierw opróżnij listę, jeśli to na poważnie.',
    'revoked' => 'Usunięto :count',
    'revoked_body' => 'Tylko wiersze, które utworzyła ta strona. To, co dodano ręcznie, zostało tam, gdzie było.',
    'revoke_failed' => 'Nie udało się ich usunąć',
];
