<?php

/*
 * Français. Écrit à la main.
 *
 * Paiements : chaque tentative de paiement et ce que le prestataire en a dit.
 *
 * Une ligne par tentative plutôt que par facture, car c'est ce qui est arrivé.
 * Le mot que cette page répète est « tentative » : un paiement qui a échoué est
 * un fait qui mérite d'être gardé, pas une erreur à cacher.
 */

return [
    'title' => 'Paiements',
    'nav_label' => 'Paiements',
    'subheading' => 'Chaque tentative de paiement, chez chaque prestataire. Revérifier redemande au prestataire, ce que fait leur webhook quand il arrive.',

    // ---- le tableau ------------------------------------------------------
    'column_invoice' => 'Facture',
    'column_gateway' => 'Prestataire',
    'column_reference' => 'Leur référence',
    'column_amount' => 'Montant',
    'column_state' => 'État',
    'column_updated' => 'Dernières nouvelles',

    'gone_invoice' => 'Facture supprimée',

    'state_open' => 'En attente',
    'state_paid' => 'Payé',
    'state_failed' => 'Échoué',
    'state_cancelled' => 'Abandonné',

    // ---- les boutons -----------------------------------------------------
    'recheck' => 'Revérifier',
    'rechecked' => 'Redemandé',
    'rechecked_body' => 'Le prestataire ne dit toujours pas que c\'est payé. Rien n\'a changé.',
    'settled' => 'C\'est payé',
    'settled_body' => 'La facture est réglée et tout ce qui l\'attendait est en route.',
    'recheck_failed' => 'Impossible de demander',
    'recheck_failed_body' => 'Le prestataire n\'a pas répondu. Réessayez dans une minute ; si cela continue, vérifiez la clé sur la page Réglages de la boutique.',
    'no_gateway' => 'Ce prestataire est éteint',
    'no_gateway_body' => 'Rallumez-le pour poser la question, ou marquez la facture payée à la main.',

    'answer' => 'Leur réponse',
    'no_answer' => 'Rien de consigné',
    'close' => 'Fermer',

    'empty' => 'Personne n\'a encore payé par un prestataire',
    'empty_body' => 'Les tentatives apparaissent ici dès que quelqu\'un appuie sur Payer, qu\'elles aboutissent ou non.',
];
