<?php

/*
 * Polski. Napisane ręcznie.
 *
 * Ustawienia świata Palworlda, na stronie zamiast w pliku.
 *
 * Nic tu nie nazywa pojedynczego ustawienia. Każda etykieta na tamtej stronie
 * jest wyprowadzana z klucza, który zawiera plik samego serwera — patrz
 * Support\Palworld\Palworld::label(), tam jest powód, dla którego lista nazw
 * byłaby gorsza niż jej brak.
 */

return [
    'title' => 'Ustawienia Palworlda',
    'nav_label' => 'Palworld',
    'subheading' => 'Ustawienia świata z pliku PalWorldSettings.ini tego serwera, wczytane przy otwarciu tej strony. Do edycji tylko przy zatrzymanym serwerze.',

    'reload' => 'Wczytaj plik jeszcze raz',

    'save_confirm' => 'Plik jest zapisywany od nowa z tymi wartościami. Każde ustawienie, którego ta strona nie pokazała, wraca dokładnie takie, jakie było, i tak samo cała reszta pliku.',
    'saved' => 'Ustawienia zapisane',
    'saved_body' => 'Zaczną obowiązywać przy następnym uruchomieniu serwera.',
    'save_failed' => 'Nie udało się zapisać pliku',

    'running' => 'Serwer działa',
    'running_body' => 'Palworld trzyma te ustawienia w pamięci i zapisuje plik od nowa przy zatrzymaniu, więc zmiana zapisana teraz zostałaby cofnięta bez słowa. Najpierw zatrzymaj serwer.',

    'groups' => [
        'server' => 'Serwer i połączenie',
        'world' => 'Świat i współczynniki',
        'pals' => 'Pale',
        'players' => 'Gracze',
        'building' => 'Budowanie, przedmioty i zbieranie',
        'guild' => 'Gildie',
        'other' => 'Inne',
    ],
];
