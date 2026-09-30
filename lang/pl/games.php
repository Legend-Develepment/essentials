<?php

/*
 * The words every game settings page uses.
 *
 * Shared because that is where the cost of a game turned out to be. A page's
 * own list of settings costs nothing to translate - a key in a config file is
 * the same string in every language, and the two pages that exist both derive
 * their field names from it. What a game actually costs is its page: the title,
 * the sentence under it, what to say when the file is not there yet, and what
 * to say when the daemon refuses a write.
 *
 * None of that is about any particular game, so none of it is repeated per
 * game. A third game needs six strings of its own rather than eighteen.
 *
 * See roadmap/games.md.
 */

return [
    'save' => 'Zapisz',
    'saved' => 'Zapisano',
    'restart' => 'Gra czyta ten plik przy starcie, więc zrestartuj serwer, aby zmiana zadziałała.',
    'failed' => 'Nie udało się zapisać',
    'failed_write' => 'Demon odmówił zapisu. Sprawdź, czy serwer jest osiągalny i czy plik nie jest tylko do odczytu.',
    'read_only' => 'Możesz czytać ten plik, ale nie zapisywać, więc nic tu nie da się zmienić.',
    'missing' => 'Ten serwer nie ma jeszcze pliku ustawień. Gra tworzy go przy pierwszym uruchomieniu, więc uruchom serwer raz, a strona się wypełni.',
    'keeps' => 'Cała reszta pliku - komentarze, puste linie, kolejność i każdy klucz, którego ta wtyczka nie zna - po zapisie zostaje dokładnie taka sama.',
    'raw' => 'Nazwy tutaj to nazwy samej gry, w kolejności pliku. Nic nie jest tłumaczone ani grupowane, bo ta strona czyta plik, a nie ręcznie spisaną listę.',
    'unset' => 'Nieustawione. Gra wymienia to jako przykład; wypełnienie dodaje.',
    'group_all' => 'Ustawienia',
    'group_all_helper' => 'Wszystko, co wymienia ten plik.',
    'subheading' => 'Zbudowane z :files, a nie z ręcznie spisanej listy.',
];
