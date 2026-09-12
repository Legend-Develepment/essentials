<?php

/*
 * Polski. Napisane ręcznie.
 *
 * „Cron" zostaje po angielsku: tak nazywa się na hoście i w dokumentacji
 * Pelicana, i dokładnie to trzeba wiedzieć, gdy ta strona mówi, że nie działa.
 */

return [
    'nav_label' => 'Zadania zaplanowane',
    'title' => 'Które zadanie zaplanowane stanęło',
    'subheading' => 'Wszystkie zadania zaplanowane w panelu, najgorsze na górze - zablokowane od ponad :hours godzin, spóźnione albo nigdy nieuruchomione.',

    'how' => 'Pelican pokazuje zadania zaplanowane wewnątrz każdego serwera, a jego własny stan ma dla nich trzy słowa: nieaktywne, w trakcie, aktywne. Żadne nie mówi „to stanęło". Uruchomienie, które padło w połowie, zostaje „w trakcie" na zawsze i rysuje się dokładnie tak jak takie, które właśnie działa; zadanie, którego godzina minęła kilka godzin temu, bo cron umarł, dalej nazywa się aktywnym. Ta strona zadaje to drugie pytanie. Tylko do odczytu - wszystko, co edytuje, uruchamia albo usuwa zadanie, zostaje na stronie Pelicana dla tego serwera.',

    'column_state' => 'Stan',
    'column_name' => 'Zadanie',
    'column_server' => 'Serwer',
    'column_last' => 'Ostatnie uruchomienie',
    'column_next' => 'Następne uruchomienie',

    /*
     * Pięć werdyktów. Napisane jako to, co jest prawdą, a nie jako polecenie,
     * bo trzy z nich to rzeczy do obejrzenia, a dwa nie.
     */
    'state_stuck' => 'Zablokowane',
    'state_overdue' => 'Spóźnione',
    'state_never' => 'Nigdy nieuruchomione',
    'state_healthy' => 'W porządku',
    'state_off' => 'Nieaktywne',

    'filter_stuck' => 'Zablokowane',
    'filter_overdue' => 'Spóźnione',
    'filter_never' => 'Nigdy nieuruchomione',
    'filter_off' => 'Wyłączone',

    'open' => 'Otwórz na serwerze',

    'empty' => 'Brak zadań zaplanowanych na jakimkolwiek serwerze, do którego sięgasz - albo żadnego, które stanęło, jeśli masz włączony filtr.',
];
