<?php

/*
 * Français. Écrit à la main.
 *
 * Les commandes : ce que quelqu'un a acheté, et ce qu'il en est advenu.
 *
 * Les quatre états ci-dessous parlent d'argent, pas du serveur. Savoir si le
 * serveur tourne en ce moment est la question de Pelican, à laquelle répondent
 * les pages de Pelican. Les mots ici gardent les deux séparés.
 */

return [
    'title' => 'Commandes',
    'nav_label' => 'Commandes',
    'subheading' => 'Tout ce qui a été acheté, le serveur qui en est né, et où cela en est.',

    // ---- le tableau ------------------------------------------------------
    'column_order' => 'Commande',
    'column_customer' => 'Client',
    'column_package' => 'Formule',
    'column_server' => 'Serveur',
    'column_state' => 'État',
    'column_due' => 'Prochaine échéance',

    'no_server' => 'Pas encore construit',
    'no_due' => 'Paiement unique',
    'gone_customer' => 'Compte supprimé',
    'gone_package' => 'Formule supprimée',
    'overdue_days' => ':days jours de retard',

    'state_pending' => 'En attente',
    'state_active' => 'Actif',
    'state_suspended' => 'Suspendu',
    'state_cancelled' => 'Annulé',

    // ---- les boutons -----------------------------------------------------
    'retry' => 'Reconstruire',
    'retry_confirm' => 'Remet la construction dans la file. Rien d\'autre ne change, et la facture reste payée.',
    'retrying' => 'Mis dans la file',

    'suspend' => 'Suspendre',
    'suspend_confirm' => 'Arrête le serveur avec la suspension de Pelican. Fichiers, bases de données et sauvegardes restent où ils sont, et payer la facture la lève.',
    'suspended' => 'Suspendu',

    'unsuspend' => 'Lever la suspension',
    'unsuspended' => 'Il tourne de nouveau',

    'change_due' => 'Changer l\'échéance',
    'change_due_helper' => 'Quand la prochaine facture est écrite. Vide veut dire jamais : la commande cesse de se renouveler sans être annulée.',

    'cancel' => 'Annuler',
    'cancel_confirm' => 'Arrête les renouvellements et rend la place dans le stock. Le serveur est laissé tel quel : on le supprime dans Pelican, là où c\'est sa place.',
    'cancelled' => 'Annulée',

    'saved' => 'Enregistré',
    'refused' => 'Rien n\'a changé',
    'refused_body' => 'La commande n\'est pas dans un état qui le permet. Rechargez la page et regardez-la de nouveau.',

    // ---- ce que le client entend -----------------------------------------
    'bell_ready' => 'Votre serveur est prêt',
    'bell_ready_body' => ':server a été créé et attend que vous le démarriez.',
    'bell_suspended' => 'Votre serveur a été suspendu',
    'bell_suspended_body' => 'Une facture est restée impayée au-delà du délai de grâce. La payer redémarre le serveur ; rien n\'a été supprimé.',

    // ---- ce que l\'administrateur entend ---------------------------------
    'bell_failed' => 'La commande :number n\'a pas pu être construite',
    'no_allocation' => 'Aucun node de cette formule n\'a d\'allocation libre. Ajoutez-en une, puis reconstruisez.',
    'no_reason' => 'Le panel a refusé sans dire pourquoi.',

    // ---- le serveur qui en naît ------------------------------------------
    'server_description' => 'Acheté dans la boutique, commande :number.',
    'server_fallback' => 'Serveur',

    'empty' => 'Rien n\'a encore été acheté',
    'empty_body' => 'Les commandes apparaissent ici dès que quelqu\'un achète une formule.',
];
