<?php

/*
 * Français. Écrit à la main.
 *
 * « Nœud » est le mot que Pelican emploie en français pour une machine, et
 * c’est celui qui est repris ici ; sur les pages publiques, où lit quelqu’un
 * qui n’a jamais entendu parler de Pelican, c’est « machine ».
 */

return [
    'nav_label' => 'Capacité',
    'title' => 'Si un serveur de plus tient encore',
    'subheading' => 'Ce qui a été promis sur chaque nœud, face à ce qu’il a le droit de distribuer.',

    'how' => 'Promis, et non consommé. Un nœud peut être occupé à vingt pour cent et complètement plein, parce que « plein » parle de ce qui a été distribué et non de ce qui tourne - le bloc Machines du tableau de bord répond à l’autre question, et il reste où il est. Le calcul fait ici est celui de Pelican, repris de la méthode qui décide si un serveur peut être créé du tout : la capacité multipliée par un plus la surallocation, face à la somme de ce qui a été promis à chaque serveur du nœud. Une capacité de zéro veut dire illimité, et une surallocation inférieure à zéro aussi - d’où les lignes sans pourcentage, plutôt qu’une barre pleine ou vide.',

    'column_node' => 'Machine',
    'column_fullest' => 'Le plus plein',
    'column_memory' => 'Mémoire',
    'column_disk' => 'Disque',
    'column_cpu' => 'Processeur',
    'column_at_limit' => 'À une limite',

    'servers' => ':count serveurs',

    'filter_tight' => 'Presque pleins',

    'open' => 'Ouvrir la machine',

    'empty' => 'Aucune machine que vous puissiez atteindre.',
];
