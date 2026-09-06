<?php

/*
 * Polski. Napisane ręcznie.
 *
 * „Whitelist" i „operator" zostają po angielsku: to słowa, które sam Minecraft
 * zapisuje w server.properties, w whitelist.json i w ops.json, i te same
 * wpisuje się z powrotem w konsoli.
 */

return [
    'nav_label' => 'Gracze',
    'title' => 'Gracze',
    'subheading' => 'Whitelista, operatorzy, bany i wszyscy, których ten serwer widział.',

    /*
     * Powiedziane raz, u góry, bo tłumaczy zarówno to, co strona potrafi, jak i
     * to, dlaczego jedna rzecz, której nie robi, nie jest usterką. Każda zmiana
     * wychodzi jako polecenie konsoli, bo tak należy mówić Minecraftowi - gra
     * wprowadza zmianę i zapisuje własny plik, więc obie strony nigdy się nie
     * rozjeżdżają.
     */
    'how' => 'Zmiany są wysyłane do serwera jako polecenia konsoli, więc wprowadza je gra i to ona zapisuje swoje pliki. Do tego serwer musi działać.',
    'needs_running' => 'Serwer musi działać. Te zmiany robi gra, a nie edytowanie jej plików spod spodu.',

    'name' => 'Nazwa gracza',
    'reason' => 'Powód (opcjonalnie)',

    'whitelist' => 'Dodaj do whitelisty',
    'unwhitelist' => 'Usuń z whitelisty',
    'op' => 'Nadaj operatora',
    'deop' => 'Odbierz operatora',
    'ban' => 'Zbanuj',
    'pardon' => 'Odbanuj',
    'kick' => 'Wyrzuć',

    'sent' => 'Polecenie wysłane',
    'sent_body' => 'Serwer je stosuje i aktualizuje własne pliki. Odśwież stronę, żeby zobaczyć zmienione listy.',
    'refused' => 'To nie zostało wysłane',

    'flag_op' => 'Operator',
    'flag_whitelisted' => 'Na whiteliście',
    'flag_banned' => 'Zbanowany',
    'flag_seen' => 'Grał tu już',

    'online' => 'Teraz online',
    'online_count' => ':online z :max',
    'online_none' => 'Nikt nie jest połączony.',

    'players' => 'Gracze',
    'ips' => 'Zbanowane adresy',
    'ips_empty' => 'Żaden adres nie jest zbanowany.',

    /*
     * Co znaczy pusta strona, a zwykle nie znaczy „brak graczy", tylko „ten
     * serwer nigdy nie wystartował". Minecraft nie tworzy żadnego z tych plików
     * przed pierwszym uruchomieniem.
     */
    'empty' => 'Nie ma jeszcze czego pokazać. Minecraft zapisuje te listy sam i nie tworzy ich, dopóki serwer nie wystartuje po raz pierwszy.',

    'level' => 'Poziom :level',

    /*
     * Jedyna rzecz, której ta strona nie robi, powiedziana wprost, a nie
     * zostawiona do odkrycia. Stan na żywo wymaga drugiego połączenia do samej
     * gry, a to inna funkcja z własnymi wymaganiami.
     */
    'not_live' => 'To jest to, co serwer zapisał, a nie to, kto jest połączony w tej chwili.',
];
