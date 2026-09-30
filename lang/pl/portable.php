<?php

/*
 * Polski. Napisane ręcznie.
 *
 * Ustawienia jako plik: na zewnątrz i z powrotem.
 *
 * Wgranych plików celowo w nim nie ma - patrz Support\Portable, tam jest powód,
 * dla którego lepiej to powiedzieć, niż po cichu je pominąć.
 */

return [
    'export' => 'Wyeksportuj ustawienia',
    'records' => 'Wyeksportuj rekordy',
    'records_helper' => 'Wszystkie pakiety, zamówienia, faktury, płatności i zgłoszenia w jednym pliku. Usunięcie tej wtyczki kasuje to wszystko, a Pelican nie pyta wcześniej o nic, więc to jest kopia robiona zawczasu. Kluczy API tu nie ma: klucza nie odtwarza się z pliku, wydaje się go na nowo.',
    'import' => 'Zaimportuj ustawienia',
    'apply' => 'Zaimportuj',

    'file' => 'Plik ustawień',
    'file_helper' => 'Plik wyeksportowany z tej wtyczki. Obrazów i paczek ikon w nim nie ma - to pliki na dysku i zostają takie, jakie są.',

    'summary' => 'Co by to zmieniło',
    'summary_none' => 'Wybierz plik, żeby zobaczyć, co by się zmieniło.',
    'summary_unreadable' => 'To nie jest plik ustawień tej wtyczki albo nie zawiera niczego, co ten panel rozpoznaje.',
    'summary_same' => 'Nic. Każde ustawienie w tym pliku już zgadza się z tym panelem.',
    'summary_count' => '{1} Zmieniłoby się jedno ustawienie.|[2,*] Zmieniłoby się :count ustawień.',
    'summary_more' => '· i jeszcze :count',

    'imported' => 'Ustawienia zaimportowane',
    'missing' => 'Tych obrazów nie ma na tym panelu, więc są pomijane: :files',
    'failed' => 'Nie udało się zaimportować tego pliku',
    'no_file' => 'Nie dotarł żaden plik. Wgranie, które czeka zbyt długo przed naciśnięciem Zaimportuj, jest przez panel sprzątane - wybierz plik jeszcze raz i zaimportuj go od razu.',
    'denied' => 'Nie masz uprawnień do zmiany tych ustawień.',
];
