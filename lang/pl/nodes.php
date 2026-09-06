<?php

/*
 * Polski. Napisane ręcznie.
 *
 * Blok na pulpicie: maszyna, na której stoi panel, i każdy węzeł.
 *
 * Liczby węzłów są liczbami samego Pelicana, czytanymi z daemona każdego węzła.
 * Wiersz panelu czytany jest z /proc, a to inne pytanie - patrz
 * Support\SystemStatus.
 */

return [
    // Nagłówek bloku to nazwa samej wtyczki, czytana w czasie działania, więc
    // nie ma tu dla niego tekstu.
    'panel' => 'Ten panel',
    'offline' => 'nie odpowiada',
    'maintenance' => 'konserwacja',
    'cpu' => 'Procesor',
    'memory' => 'Pamięć',
    'disk' => 'Dysk',
    'load' => 'Obciążenie',
];
