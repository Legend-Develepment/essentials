<?php

/*
 * Français. Écrit à la main.
 *
 * Les codes de réduction : des codes qui retirent quelque chose de la première
 * facture.
 *
 * De la première seulement, à dessein, et le texte le dit là où cela compte.
 * Un code qui réduirait aussi chaque renouvellement serait un changement de
 * prix avec une date de fin, et qui veut cela devrait changer le prix.
 */

return [
    'title' => 'Codes de réduction',
    'nav_label' => 'Codes de réduction',
    'subheading' => 'Des codes qui retirent un pourcentage ou un montant de la première facture. Les renouvellements se font au prix de la formule.',

    // ---- le tableau ------------------------------------------------------
    'column_code' => 'Code',
    'column_value' => 'Valeur',
    'column_uses' => 'Utilisé',
    'column_expires' => 'Expire',
    'column_packages' => 'S\'applique à',
    'column_live' => 'Actif',

    'never_expires' => 'Sans date de fin',
    'all_packages' => 'Tout',
    'some_packages' => ':count formules',
    'usable' => 'Utilisable en ce moment',
    'unusable' => 'Éteint, expiré ou épuisé',

    // ---- les boutons -----------------------------------------------------
    'new' => 'Nouveau code',
    'edit' => 'Modifier',
    'delete' => 'Supprimer',
    'delete_confirm' => 'Retire le code. Les factures qui l\'ont déjà utilisé gardent leur remise : chacune conserve ce qui en a été retiré.',
    'deleted' => 'Code supprimé',
    'saved' => 'Code enregistré',
    'save_failed' => 'Le code n\'a pas pu être enregistré',
    'taken' => 'Quelque chose utilise déjà ce code.',
    'invalid' => 'Un pourcentage est un nombre entier de 1 à 100. Un montant s\'écrit 12.50 ou 12,50.',

    // ---- le formulaire ---------------------------------------------------
    'section_code' => 'Le code',
    'section_code_helper' => 'Ce qu\'un client tape au moment de commander.',
    'code' => 'Code',
    'code_helper' => 'Enregistré et comparé en majuscules sans espaces, pour qu\'il marche quelle que soit la façon dont on le tape.',
    'live' => 'Actif',
    'live_helper' => 'Éteint, le code cesse de fonctionner sans être supprimé : il sort de l\'usage tandis que la remise qu\'il a donnée reste sur les factures.',

    'section_worth' => 'Ce qu\'il retire',
    'section_worth_helper' => 'De la première facture seulement. Il ne descend jamais une facture sous zéro.',
    'kind' => 'Type',
    'kind_helper' => 'Une part du prix, ou un montant fixe.',
    'kind_percent' => 'Pourcentage',
    'kind_fixed' => 'Montant fixe',
    'value' => 'Valeur',
    'value_percent_helper' => 'Un nombre entier de 1 à 100.',
    'value_fixed_helper' => 'Dans la monnaie de la boutique. Écrivez-le 12.50 ou 12,50.',

    'section_limits' => 'Limites',
    'section_limits_helper' => 'Tout ici est facultatif. Un code sans aucune de ces limites marche pour tout, pour tout le monde, toujours.',
    'max_uses' => 'Nombre d\'utilisations',
    'max_uses_helper' => 'Compté quand la commande est passée, pas quand la facture est payée : sinon un code à dix utilisations pourrait être posé cent fois dans la nuit.',
    'expires' => 'Expire',
    'expires_helper' => 'Après ce moment le code cesse de fonctionner. Vide veut dire que cela n\'arrive jamais.',
    'packages' => 'Formules',
    'packages_helper' => 'Rien de coché veut dire toutes les formules, maintenant et plus tard.',

    'empty' => 'Aucun code pour l\'instant',
    'empty_body' => 'Créez-en un et il marche à la commande dès qu\'il est actif.',
];
