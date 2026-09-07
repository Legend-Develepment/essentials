<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * Blokken på oversikten: maskinen panelet står på, og hver node.
 *
 * Tallene for nodene er Pelicans egne, lest hos daemonen på hver node. Linjen
 * for panelet leses fra /proc, som er et annet spørsmål - se
 * Support\SystemStatus.
 */

return [
    // Overskriften på blokken er navnet på selve pluginet, lest mens det kjører,
    // så det finnes ingen tekst til den her.
    'panel' => 'Dette panelet',
    'offline' => 'svarer ikke',
    'maintenance' => 'vedlikehold',
    'cpu' => 'CPU',
    'memory' => 'Minne',
    'disk' => 'Disk',
    'load' => 'Belastning',
];
