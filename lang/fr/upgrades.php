<?php

/*
 * Français. Écrit à la main.
 *
 * Déplacer un service en cours d’une offre vers une autre.
 *
 * Les mots gardent une chose au clair d’un bout à l’autre : ce que coûte une
 * offre et ce que coûte le passage vers celle-ci aujourd’hui sont deux montants
 * différents. Le premier est sur l’étagère ; le second dépend de l’avancement
 * de la période déjà payée pour ce service, et c’est celui-là qu’on accepte en
 * appuyant sur le bouton.
 *
 * « Upgrade » est évité dans ce que lit un client, car la moitié de ces
 * mouvements vont dans l’autre sens. Ici, le mot est changement.
 */

return [
    // ---- sur la carte du service -----------------------------------------
    'change' => 'Changer d’offre',
    'change_body' => 'Ce qui reste de la période déjà payée est déduit, et les mêmes jours sont facturés au nouveau prix. Rien n’est perdu sur votre serveur.',
    'change_to' => 'Changer pour :name',
    'change_confirm' => 'Changer ce service pour :name ?',
    'change_free' => 'Rien à payer',
    'costs_now' => ':amount maintenant',
    'gives_back' => ':amount en retour',
    'waiting' => 'Changement convenu',
    'waiting_for' => 'Un changement vers :name attend une facture impayée.',

    // ---- ce qui se passe ensuite -----------------------------------------
    'done' => 'Passé à :name',
    'done_body' => 'Votre service est sur la nouvelle offre. Ce qui vous était dû est sur votre compte.',
    'refused' => 'Le changement n’a pas été fait',

    // ---- et pourquoi, une raison à la fois -------------------------------
    'refused_off' => 'Le changement d’offre est désactivé sur ce panel.',
    'refused_not_active' => 'Seul un service en cours peut être changé. Un service en attente, suspendu ou qui se termine n’a rien à calculer.',
    'refused_gone' => 'L’offre sur laquelle se trouve ce service n’existe plus : il n’y a plus rien à quoi la comparer.',
    'refused_same' => 'C’est l’offre sur laquelle il est déjà.',
    'refused_egg' => 'Cette offre fait tourner un autre logiciel. Ce serait un autre serveur plutôt qu’un plus grand : il faut donc l’acheter comme tel.',
    'refused_period' => 'Cette offre est facturée sur une autre période, ce qui est un autre accord plutôt qu’un plus grand.',
    'refused_stock' => 'Cette offre est épuisée.',
    'refused_waiting' => 'Un changement attend déjà une facture impayée pour ce service. Payez ou annulez celle-là d’abord.',
    'refused_failed' => 'Rien n’a été enregistré, donc rien n’a changé. Réessayez, et signalez-le à qui gère ce panel si cela se reproduit.',
    'refused_server' => 'Le serveur n’a pas pu recevoir les nouvelles limites : le service est resté exactement tel qu’il était. Qui gère ce panel a été prévenu.',

    // ---- ce que disent les documents -------------------------------------
    'line' => 'Changement de :from vers :to, pour les :days jours restants de cette période',
    'credit_reason' => 'Changement vers :name',

    // ---- et ce que le propriétaire apprend -------------------------------
    'bell_failed' => 'Un changement d’offre a échoué sur la commande :number',
    'cold_title' => 'Un changement d’offre a atteint le panel mais pas le node, sur la commande :number',
    'cold_body' => 'Le service est sur :name et les nouvelles limites sont enregistrées. Le node ne les a pas encore reprises et les lira au prochain démarrage de ce serveur : jusque-là, le client a toujours l’ancienne taille. Vérifiez le node.',
    'gone' => 'L’offre vers laquelle le changement allait n’existe plus.',
    'refused_by_node' => 'Le serveur n’a pas voulu des nouvelles limites : :why',

    // ---- remettre les choses en ordre ------------------------------------
    'retry' => 'Réessayer le changement',
    'retry_confirm' => 'Réessayer le changement d’offre. La facture correspondante est déjà payée : rien n’est facturé deux fois.',
    'retried' => 'Le changement est passé',
    'retry_failed' => 'Il a de nouveau échoué. La raison est sur la commande.',
];
