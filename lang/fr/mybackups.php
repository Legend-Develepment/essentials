<?php

/*
 * Français. Écrit à la main.
 */

return [
    /*
     * Deux phrases qui se rejoignent en une ligne, parce que ce sont deux
     * problèmes différents : un serveur sans la moindre sauvegarde est en
     * général un serveur pour lequel personne n’en a jamais créé, et un serveur
     * dont la dernière remonte à neuf jours est une tâche planifiée à l’arrêt.
     */
    'none' => '{1} Un de vos serveurs n\'a jamais été sauvegardé.|[2,*] :count de vos serveurs n\'ont jamais été sauvegardés.',
    'stale' => '{1} Un n\'a pas été sauvegardé depuis plus de :days jours.|[2,*] :count n\'ont pas été sauvegardés depuis plus de :days jours.',
    'schedules' => '{1} Une de vos tâches planifiées est arrêtée.|[2,*] :count de vos tâches planifiées sont arrêtées.',

    'and_more' => 'et :count de plus',

    'open' => 'Ouvrez un serveur et allez dans Sauvegardes pour en créer une.',
];
