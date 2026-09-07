<?php

/*
 * Polski. Napisane ręcznie.
 *
 * Kto jest na serwerze, dla gier odpowiadających na zapytanie Valve.
 *
 * Jedna strona dla Rusta, ARK-a, Valheima i reszty, bo odpowiadają na ten sam
 * pakiet. To, co różni się między grami, to co można komuś zrobić — wyrzucenie
 * to `kick "nazwa"` w jednej i `KickPlayer <id>` w drugiej — i dlatego ta
 * strona czyta, a nie działa.
 */

return [
    'title' => 'Gracze',
    'nav_label' => 'Gracze',
    'subheading' => 'Kto jest połączony, zapytane samej gry, a nie panelu.',

    'refresh' => 'Zapytaj jeszcze raz',

    'count' => 'połączonych: :count',
    'score' => 'Wynik',

    'just_joined' => 'właśnie wszedł',
    'minutes' => ':count min',
    'hours' => ':count godz.',
    'hours_minutes' => ':hours godz. :minutes min',

    'empty' => 'Nikogo nie ma na tym serwerze.',

    /*
     * Nie „nikogo nie ma", a różnica ma znaczenie.
     *
     * Panel i port gry często są w sieciach, które się nie widzą, a
     * narysowanie tego jako pustej listy byłoby powiedzeniem czegoś, czego ta
     * strona nie wie.
     */
    'unreachable' => 'Serwer nie odpowiedział. Może się uruchamiać, albo panel może nie sięgać do jego portu gry z miejsca, w którym działa — a to nie to samo, co brak ludzi w środku.',
];
