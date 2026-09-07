<?php

/*
 * Svenska. Skriven för hand.
 *
 * «Maskin» på själva sidan, för raden handlar om järnet och inte om Pelicans
 * begrepp; «nod» hör hemma i inställningarna, där man redan har läst ordet.
 */

return [
    'nav_label' => 'Kapacitet',
    'title' => 'Om det får plats en server till',
    'subheading' => 'Vad som är utlovat på varje nod, mot vad den får dela ut.',

    'how' => 'Utlovat, inte använt. En nod kan vara tjugo procent upptagen och samtidigt helt full, för full handlar om vad som har delats ut och inte om vad som körs — blocket Maskiner på översikten är den andra frågan, och det stannar där det är. Räknesättet här är Pelicans eget, från den metod som avgör om en server över huvud taget får skapas: kapaciteten gånger ett plus överallokeringen, mot summan av vad varje server på noden har blivit lovad. En kapacitet på noll betyder obegränsat, och det gör en överallokering under noll också — det är därför vissa rader saknar procenttal i stället för att visa en full eller en tom stapel.',

    'column_node' => 'Maskin',
    'column_fullest' => 'Fullast',
    'column_memory' => 'Minne',
    'column_disk' => 'Disk',
    'column_cpu' => 'Processor',
    'column_at_limit' => 'Vid en gräns',

    'servers' => ':count servrar',

    'filter_tight' => 'Nästan full',

    'open' => 'Öppna maskinen',

    'empty' => 'Inga maskiner som du når.',
];
