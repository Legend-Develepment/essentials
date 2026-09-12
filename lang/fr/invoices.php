<?php

/*
 * Français. Écrit à la main.
 *
 * Les factures : le document, la page qui les liste et le courriel.
 *
 * Trois lecteurs se partagent ce fichier. Un administrateur lit le tableau et
 * appuie sur « marquer payée » ; un client lit le document imprimable et le
 * courriel ; et le document lui-même est lu des mois plus tard par quelqu'un
 * qui tient la comptabilité. C'est pour ce dernier que les lignes doc_ sont
 * sobres et formelles : une facture n'est pas l'endroit du ton employé
 * ailleurs dans le panel.
 */

return [
    'title' => 'Factures',
    'nav_label' => 'Factures',
    'subheading' => 'Ce qui est dû et ce qui a été payé. Marquer une facture payée ici fait tout ce que payer ferait : le serveur est construit, un serveur suspendu revient.',

    // ---- le tableau ------------------------------------------------------
    'column_number' => 'Facture',
    'column_customer' => 'Client',
    'column_order' => 'Commande',
    'column_total' => 'Total',
    'column_state' => 'État',
    'column_due' => 'Échéance',

    'kind_order' => 'Première facture',
    'kind_renewal' => 'Renouvellement',
    'kind_credit' => 'Avoir',
    'kind_upgrade' => 'Changement d\'offre',
    'kind_topup' => 'Ajout de crédit',
    'kind_addon' => 'Supplément',

    'state_unpaid' => 'Impayée',
    'state_paid' => 'Payée',
    'state_cancelled' => 'Retirée',

    'no_order' => 'Aucune commande',
    'order_count' => ':count services',
    'no_due' => 'Aucune date',
    'gone_customer' => 'Compte supprimé',
    'discount_of' => ':amount de remise avec :code',
    'paid_via' => 'par :how',
    'column_attempts' => 'Paiement',
    'paid_by' => 'payée par :how',
    'paid_by_unknown' => 'un moyen inconnu',
    'paid_by_manual' => 'saisie manuelle',
    'paid_by_free' => 'un total nul',
    'attempts_none' => 'aucune tentative',
    'attempts_open' => ':count tentatives - :how',
    'attempt_last' => 'dernière :when, :state',
    'attempt_open' => 'non aboutie',
    'attempt_paid' => 'payée',
    'attempt_cancelled' => 'annulée',
    'attempt_failed' => 'échouée',
    'emailed' => 'Envoyée',
    'not_emailed' => 'Non envoyée',
    'filter_overdue' => 'En retard',

    // ---- les boutons -----------------------------------------------------
    'open' => 'Ouvrir',
    'mark_paid' => 'Marquer payée',
    'mark_paid_confirm' => 'Consigne que l\'argent est arrivé. Le serveur est construit, un serveur suspendu redémarre et la prochaine échéance avance, exactement comme si un prestataire de paiement l\'avait dit.',
    'paid' => 'Marquée payée',
    'paid_body' => 'Tout ce qui attendait cette facture est en route.',
    'already_paid' => 'Elle était déjà payée',

    'withdraw' => 'Retirer',
    'withdraw_confirm' => 'Sort la facture des comptes. Seule une facture impayée peut être retirée ; une facture payée est la trace d\'un argent qui a changé de mains.',
    'withdrawn' => 'Retirée',
    'withdraw_refused' => 'Seule une facture impayée peut être retirée',

    'empty' => 'Aucune facture pour l\'instant',
    'empty_body' => 'Il s\'en écrit une dès que quelqu\'un achète, puis une par période pour tout ce qui se renouvelle.',

    // ---- le document -----------------------------------------------------
    'doc_title' => 'Facture',
    'doc_number' => 'Numéro',
    'doc_issued' => 'Émise le',
    'doc_due' => 'Échéance',
    'doc_paid_on' => 'Payée le',
    'doc_billed_to' => 'Facturé à',
    'doc_from' => 'De',
    'doc_vat' => 'N° de TVA',
    'doc_coc' => 'N° RCS',
    'doc_description' => 'Désignation',
    'doc_amount' => 'Montant',
    'doc_subtotal' => 'Sous-total',
    'doc_discount' => 'Remise',
    'doc_total' => 'Total',
    'doc_how_to_pay' => 'Comment payer',
    'doc_print' => 'Imprimer ou enregistrer en PDF',
    'doc_back' => 'Retour au panel',

    // ---- le courriel -----------------------------------------------------
    'mail_subject' => 'Facture :number',
    'mail_hello' => 'Bonjour :name,',
    'mail_intro' => 'Voici la facture :number.',
    'mail_open' => 'Ouvrir la facture',
    'mail_foot' => 'Vous pouvez relire cette facture à tout moment sur votre page de facturation.',

    // ---- la cloche -------------------------------------------------------
    'bell_new' => 'Facture :number',
    'bell_new_body' => ':total à régler. Ouvrez votre page de facturation pour payer.',
    'bell_reminder' => 'La facture :number a dépassé son échéance',
    'bell_reminder_body' => 'Elle reste ouverte pour :total. Le serveur qu’elle paie s’arrête le :date si elle n’est pas réglée d’ici là, et rien de ce qui s’y trouve n’est supprimé à ce moment.',
];
