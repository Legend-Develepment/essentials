<?php

/*
 * La page qui répond à « lequel des miens est en retard ». Écrite pour celui
 * à qui les serveurs appartiennent, pas pour celui qui tient le panel -
 * c’est pourquoi il n’est nulle part question de nodes, et pourquoi aucun
 * chiffre sur lequel il ne peut rien n’est proposé. Chaque ligne nomme un
 * serveur qu’il peut ouvrir ou dit quoi en faire.
 */

return [
    'title' => 'À surveiller',
    'nav_label' => 'À surveiller',
    'subheading' => 'Vos serveurs, triés par ce qui est en retard plutôt que par nom. Une sauvegarde est dite périmée après :days jours.',
    'column_server' => 'Serveur',
    'column_last' => 'Dernière sauvegarde',
    'column_kept' => 'Gardées',
    'column_schedules' => 'Tâches arrêtées',
    'never' => 'Jamais',
    'filter_none' => 'Jamais sauvegardé',
    'filter_stale' => 'Sauvegarde périmée',
    'open' => 'Sauvegardes',
    'empty' => 'Rien n\'est en retard',
    'empty_body' => 'Chaque serveur que vous pouvez ouvrir a une sauvegarde récente et aucune tâche arrêtée. Cette page se remplit d\'elle-même quand ce n\'est plus le cas.',
];
