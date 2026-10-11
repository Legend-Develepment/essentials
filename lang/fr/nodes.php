<?php

/*
 * Français. Écrit à la main.
 *
 * Le bloc du tableau de bord : la machine sur laquelle est le panel, et chaque
 * nœud.
 *
 * Les chiffres des nœuds sont ceux de Pelican, lus auprès du daemon de chaque
 * nœud. La ligne du panel est lue dans /proc, ce qui est une autre question -
 * voir Support\SystemStatus.
 */

return [
    'title' => 'Machines',
    'panel' => 'Ce panel',
    'offline' => 'ne répond pas',
    'maintenance' => 'maintenance',
    'cpu' => 'Processeur',
    'memory' => 'Mémoire',
    'disk' => 'Disque',
    'load' => 'Charge',
];
