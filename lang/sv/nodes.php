<?php

/*
 * Svenska. Skriven för hand.
 *
 * Blocket på översikten: maskinen panelen står på, och varje nod.
 *
 * Nodsiffrorna är Pelicans egna, lästa från daemonen på varje nod. Panelraden
 * läses ur /proc, vilket är en annan fråga - se Support\SystemStatus.
 *
 * «Nod» står kvar: det är ordet Pelican använder överallt, och en översättning
 * skulle bli ett andra namn på samma sak.
 */

return [
    // Blockets rubrik är pluginets eget namn, läst vid körning, så det finns
    // ingen sträng för den här.
    'panel' => 'Den här panelen',
    'offline' => 'svarar inte',
    'maintenance' => 'underhåll',
    'cpu' => 'CPU',
    'memory' => 'Minne',
    'disk' => 'Disk',
    'load' => 'Last',
];
