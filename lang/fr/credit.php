<?php

/*
 * Français. Écrit à la main.
 *
 * Le crédit, les remboursements et les avoirs.
 *
 * Deux mots sont tenus à l’écart l’un de l’autre partout ci-dessous.
 *
 * Le « crédit », c’est de l’argent que la boutique garde pour quelqu’un. Il est
 * déduit tout seul de sa prochaine facture, avant même qu’on lui demande de
 * payer.
 *
 * Un « remboursement », c’est le fait de rendre l’argent, et il a deux
 * destinations : la carte d’où il venait, ou le compte, en crédit. Les mots
 * disent toujours laquelle des deux, car un client à qui l’on annonce un
 * remboursement et qui ne trouve rien sur son compte en banque écrit, et il a
 * raison.
 *
 * Un « avoir », c’est le document. Il est écrit dans les deux cas, car il acte
 * que l’argent n’est plus dû à la boutique - il ne dit rien de l’endroit où il
 * est allé.
 */

return [
    // ---- ce que voit un client -------------------------------------------
    'yours' => 'Votre crédit',
    'yours_body' => 'Il est déduit automatiquement de votre prochaine facture. Vous n’avez rien à faire.',
    'applied' => 'Payé sur votre crédit',
    'payable' => 'Reste à payer',

    // ---- le registre, dans la fenêtre du client --------------------------
    'held' => 'Crédit',
    'none_held' => 'Rien sur le compte',
    'movements' => 'Crédit',
    'column' => 'Crédit',
    'none' => 'Aucun',

    // ---- en donner -------------------------------------------------------
    'give' => 'Crédit',
    'give_helper' => 'Ce compte détient :held. Ce que vous y mettez est déduit tout seul de sa prochaine facture. Un montant négatif reprend du crédit, et les deux mouvements restent dans l’historique.',
    'amount' => 'Montant',
    'amount_helper' => 'Un montant négatif retire du crédit au lieu d’en donner.',
    'reason' => 'Motif',
    'reason_helper' => 'Le client le voit à côté du montant : écrivez-le pour lui, pas pour le dossier.',
    'given' => ':amount de crédit pour :who',
    'bad_amount' => 'Ce n’est pas un montant.',
    'give_failed' => 'Le crédit n’a pas été donné',
    'give_failed_body' => 'Rien n’a été enregistré. Réessayez, et regardez dans les logs si cela se reproduit.',
    'take_failed' => 'Le crédit n’a pas été retiré',
    'take_failed_body' => 'Il y a moins sur le compte que ce que vous vouliez retirer. Un solde ne descend jamais sous zéro.',

    // ---- ce que dit un mouvement -----------------------------------------
    'spent_on' => 'Facture :number',
    'returned' => 'Remis : la facture à laquelle il servait n’a pas pu être écrite',
    'note_line' => 'Avoir sur la facture :number',
    'refund_description' => 'Remboursement de la facture :number',

    // ---- le rendre -------------------------------------------------------
    'refund' => 'Rembourser',
    'refund_helper' => ':left de cette facture n’a pas encore été rendu. Un avoir est écrit dans les deux cas, pour qu’il en reste une trace des deux côtés.',
    'refund_amount_helper' => 'Une partie suffit. Le reste peut être rendu plus tard.',
    'refund_reason_helper' => 'Ceci est imprimé sur l’avoir que le client peut ouvrir.',
    'where' => 'Où va l’argent',
    'where_provider' => 'Là d’où il a été payé',
    'where_provider_helper' => 'Le prestataire le renvoie vers la carte ou le compte d’où il venait. Cela peut mettre quelques jours à apparaître, et il peut refuser - un paiement ancien, ou un moyen qui ne se rembourse pas.',
    'where_balance' => 'Sur son compte ici',
    'where_balance_helper' => 'Il devient du crédit et sera déduit de sa prochaine facture. Rien ne quitte la banque, et cela ne peut pas échouer.',
    'refunded' => ':amount remboursés',
    'refunded_body' => 'L’avoir :number a été écrit pour cela.',
    'refund_failed' => 'Rien n’a été remboursé',

    // ---- et pourquoi, une raison à la fois -------------------------------
    'refused_off' => 'Le crédit et les remboursements sont désactivés sur ce panel.',
    'refused_amount' => 'C’est plus que ce qu’il reste sur cette facture.',
    'refused_no_payment' => 'Aucun paiement de cette facture n’a autant de disponible : il n’y a rien qu’un prestataire puisse rembourser. Mettez-le plutôt sur son compte.',
    'refused_no_gateway' => 'Le prestataire par lequel cela a été payé n’est plus allumé : impossible de lui demander de rembourser quoi que ce soit. Mettez-le plutôt sur son compte.',
    'refused_refused' => 'Le prestataire a refusé. C’est en général un paiement ancien ou un moyen qui ne se rembourse pas ; la raison qu’il a donnée est dans les logs. Mettez-le plutôt sur son compte.',
    'refused_note_failed' => 'L’argent a bougé mais l’avoir n’a pas pu être écrit : rien n’a donc été enregistré. Regardez dans les logs avant de réessayer.',

    // ---- en mettre sur le compte -----------------------------------------
    'topup' => 'Ajouter du crédit',
    'topup_helper' => 'Vous avez :held sur votre compte. Ce que vous ajoutez ici est déduit tout seul de votre prochaine facture, et une facture déjà ouverte est réglée dessus dès son arrivée.',
    'topup_go' => 'Passer au paiement',
    'topup_amount_helper' => 'Entre :least et :most.',
    'topup_bad' => 'Ce montant ne peut pas être payé',
    'topup_failed' => 'Le paiement n’a pas pu être lancé. Réessayez, et signalez-le à qui gère ce panel si cela se reproduit.',
    'topup_line' => 'Crédit ajouté au compte',
    'topup_reason' => 'Ajouté sur la facture :number',

    // ---- où cela s’affiche -----------------------------------------------
    'menu' => ':amount de crédit',
    'held_helper' => 'Déduit tout seul de votre prochaine facture. Vous pouvez en ajouter sur la page des factures.',
];
