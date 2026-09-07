<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * Blokken på oversigten: maskinen, panelet står på, og hver node.
 *
 * Nodernes tal er Pelicans egne, læst hos hver nodes daemon. Panelets linje
 * læses fra /proc, hvilket er et andet spørgsmål - se Support\SystemStatus.
 */

return [
    // Blokkens overskrift er pluginnets eget navn, læst mens det kører, så der
    // er ingen tekst til den her.
    'panel' => 'Dette panel',
    'offline' => 'svarer ikke',
    'maintenance' => 'vedligeholdelse',
    'cpu' => 'CPU',
    'memory' => 'Hukommelse',
    'disk' => 'Disk',
    'load' => 'Belastning',
];
