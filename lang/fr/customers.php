<?php

/*
 * Français. Écrit à la main.
 *
 * Les clients : la boutique, tournée vers la personne plutôt que vers la ligne.
 *
 * Les commandes, les factures et les paiements sont chacun une liste de ce qui
 * s\'est passé. Cette page pose la question que se pose vraiment quelqu\'un qui
 * a un ticket devant lui : qui est-ce, qu\'a-t-il, qu\'a-t-il payé et que
 * reste-t-il dû. Les mots ici sont choisis pour ce moment-là, pas pour un
 * rapport.
 */

return [
    'title' => 'Clients',
    'nav_label' => 'Clients',
    'subheading' => 'Tous ceux qui ont acheté quelque chose, avec ce qu\'ils ont, ce qu\'ils ont payé et ce qui reste dû.',

    // ---- le tableau ------------------------------------------------------
    'column_customer' => 'Client',
    'column_services' => 'Services',
    'column_spent' => 'Payé',
    'column_outstanding' => 'Restant dû',

    'of_orders' => 'sur :count commandés',
    'nothing_owed' => 'Rien',

    'filter_owing' => 'Doit quelque chose',
    'filter_active' => 'A un service actif',

    // ---- l\'un d\'eux ----------------------------------------------------
    'open' => 'Ouvrir',
    'close' => 'Fermer',
    'servers' => 'Serveurs',
    'since' => 'Client depuis',
    'their_services' => 'Services',
    'their_invoices' => 'Factures',
    'no_services' => 'Rien d\'actif, et rien en attente de construction.',
    'no_invoices' => 'Aucune facture n\'a été écrite pour ce compte.',

    'empty' => 'Personne n\'a encore rien acheté',
    'empty_body' => 'Cette liste montre ceux qui ont commandé, pas tous ceux qui ont un compte : elle se remplit à la première vente.',
];
