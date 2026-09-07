<?php

/*
 * Français. Écrit à la main.
 *
 * Les sauvegardes, à l’échelle du panel.
 *
 * Pelican répond à « quelles sauvegardes ce serveur a-t-il ». Cette page répond
 * à l’inverse, qui est la question que se pose réellement un administrateur et
 * que le panel n’a nulle part où poser : lesquels des miens n’en ont aucune.
 */

return [
    'title' => 'Sauvegardes',
    'nav_label' => 'Sauvegardes',
    'subheading' => 'Tous les serveurs que vous pouvez atteindre, avec le temps écoulé depuis leur dernière sauvegarde. Ceux qui n’en ont jamais eu sont en haut ; au-delà de :days jours, une sauvegarde est considérée comme périmée.',

    // ---- le tableau -------------------------------------------------------
    'column_server' => 'Serveur',
    'column_last' => 'Dernière sauvegarde',
    'column_kept' => 'Conservées',
    'column_size' => 'Taille',
    'column_failed' => 'Échouées',

    'never' => 'Jamais',

    'filter_none' => 'Jamais sauvegardés',
    'filter_stale' => 'Périmées',
    'filter_failed' => 'En échec',

    'open' => 'Ouvrir dans Pelican',
];
