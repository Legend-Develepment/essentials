<?php

/*
 * Français. Écrit à la main.
 *
 * « Cron » reste en anglais : c’est sous ce nom qu’on le retrouve sur l’hôte et
 * dans la documentation de Pelican, et c’est exactement ce dont on a besoin
 * quand cette page dit qu’il ne tourne pas.
 */

return [
    'nav_label' => 'Tâches planifiées',
    'title' => 'Quelle tâche planifiée s’est arrêtée',
    'subheading' => 'Toutes les tâches planifiées du panel, les pires en premier — bloquées depuis plus de :hours heures, en retard, ou jamais lancées.',

    'how' => 'Pelican montre les tâches planifiées à l’intérieur de chaque serveur, et son propre état a trois mots pour elles : inactive, en cours, active. Aucun ne dit « celle-ci s’est arrêtée ». Une exécution qui s’est plantée en route reste « en cours » pour toujours et ressemble exactement à une exécution en train de tourner ; une tâche dont l’heure est passée depuis des heures parce que le cron est mort est toujours dite active. Cette page pose l’autre question. En lecture seule — tout ce qui modifie, lance ou supprime une tâche reste sur la page de Pelican pour ce serveur.',

    'column_state' => 'État',
    'column_name' => 'Tâche',
    'column_server' => 'Serveur',
    'column_last' => 'Dernière exécution',
    'column_next' => 'Prochaine exécution',

    /*
     * Les cinq verdicts. Écrits comme ce qui est vrai plutôt que comme une
     * consigne, parce que trois d’entre eux sont des choses à regarder et deux
     * ne le sont pas.
     */
    'state_stuck' => 'Bloquée',
    'state_overdue' => 'En retard',
    'state_never' => 'Jamais lancée',
    'state_healthy' => 'Correcte',
    'state_off' => 'Inactive',

    'filter_stuck' => 'Bloquées',
    'filter_overdue' => 'En retard',
    'filter_never' => 'Jamais lancées',
    'filter_off' => 'Désactivées',

    'open' => 'Ouvrir sur le serveur',

    'empty' => 'Aucune tâche planifiée sur les serveurs que vous pouvez atteindre — ou aucune arrêtée, si un filtre est actif.',
];
