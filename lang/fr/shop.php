<?php

/*
 * Français. Écrit à la main.
 *
 * Les réglages de la boutique, et plus tard la boutique elle-même.
 *
 * Deux lecteurs partagent ce fichier à dessein. La moitié réglages est lue par
 * l'administrateur ; les moitiés publique et client - ajoutées à mesure que la
 * boutique grandit - sont lues par des gens qui n'ont peut-être jamais entendu
 * parler de Pelican, et chaque phrase là doit être écrite pour eux.
 */

return [
    'title' => 'Réglages de la boutique',
    'nav_label' => 'Réglages de la boutique',
    'subheading' => 'La devise, la taxe, la numérotation des factures et ce que dit la page publique. Ce qui est en vente est sur la page Offres.',

    // ---- où elle est -----------------------------------------------------
    'address' => 'La boutique publique est à',
    'address_off' => 'La page publique est désactivée. Activez « Page publique de la boutique » dans la liste des fonctions de la page Réglages d\'Essentials et elle répond à :url.',

    // ---- général ---------------------------------------------------------
    'section_general' => 'Argent',
    'section_general_helper' => 'Une devise pour toute la boutique. Chaque prix de chaque offre est un nombre dans celle-ci.',
    'currency' => 'Devise',
    'currency_helper' => 'La changer ne convertit rien : les prix des offres sont des nombres, et après un changement ce sont des nombres dans la nouvelle devise.',
    'tax' => 'Taxe',
    'tax_helper' => 'Un pourcentage ajouté à chaque facture sur sa propre ligne. Les prix des offres sont hors taxe. Zéro pour aucune.',
    'tax_suffix' => '%',
    'prefix' => 'Les numéros de facture commencent par',
    'prefix_helper' => 'Suivi d\'un numéro qui s\'incrémente. INV- donne INV-000001.',

    // ---- renouvellements -------------------------------------------------
    'section_renewals' => 'Renouvellements',
    'section_renewals_helper' => 'Pour les offres facturées au mois, au trimestre ou à l\'année. Une offre en une seule fois n\'est jamais touchée par ceci.',
    'notice_days' => 'Facturer ce nombre de jours avant la fin de la période',
    'notice_days_helper' => 'Quand la facture suivante est créée et le client prévenu.',
    'grace' => 'Suspendre ce nombre de jours après l\'échéance d\'une facture',
    'grace_helper' => 'Une facture impayée au-delà suspend le serveur — la suspension de Pelican lui-même, levée dès que la facture est payée. La boutique ne supprime jamais rien.',
    'days' => 'jours',

    // ---- la page publique ------------------------------------------------
    'section_public' => 'La page publique',
    'section_public_helper' => 'Lue par des gens sans compte. Qu\'elle soit servie ou non, c\'est l\'interrupteur « Page publique de la boutique » dans la liste des fonctions.',
    'heading' => 'Titre',
    'heading_helper' => 'Laissé vide, le nom du panneau est utilisé.',
    'note' => 'Une ligne au-dessus des offres',
    'note_helper' => 'Pour dire qui vous êtes, ou ce qu\'acheter apporte. Texte brut.',
    'terms_url' => 'Conditions',
    'terms_url_helper' => 'Une adresse https. Si elle est renseignée, acheter signifie cocher une case qui y renvoie.',

    // ---- payer à la main -------------------------------------------------
    'section_manual' => 'Payer sans prestataire',
    'section_manual_helper' => 'Affiché sur une facture impayée tant qu\'aucun prestataire de paiement n\'est activé : coordonnées bancaires, ou où envoyer l\'argent. Texte brut.',
    'pay_note' => 'Comment payer',
    'pay_note_helper' => 'Laissez vide et une facture impayée dit seulement qu\'elle est impayée.',

    // ---- les boutons -----------------------------------------------------
    'save' => 'Enregistrer',
    'saved' => 'Enregistré',
    'save_failed' => 'Rien n\'a été enregistré',

    /* ---------------------------------------------------------------------
     * La boutique elle-même, à partir d\'ici.
     *
     * Un tout autre lecteur : quelqu\'un qui achète un serveur, qui n\'a
     * peut-être jamais entendu parler de Pelican et ignore ce qu\'est un egg.
     * Rien ci-dessous n\'emploie les mots du panel, et chaque phrase répond à
     * la question qu\'un client se pose vraiment à cet endroit de la page.
     * ------------------------------------------------------------------- */

    // ---- la boutique -----------------------------------------------------
    'store_title' => 'Boutique',
    'store_nav_label' => 'Boutique',
    'store_subheading' => 'Choisissez un serveur. Il est créé pour vous dès que la facture est payée.',
    'store_empty' => 'Rien n\'est en vente pour le moment',
    'store_empty_body' => 'Revenez plus tard, ou demandez à qui tient ce panel.',

    'buy' => 'Acheter',
    'sold_out' => 'Épuisé',
    'plus_setup' => 'plus :amount une fois',

    'spec_memory' => ':amount Mio de mémoire',
    'spec_disk' => ':amount Mio de disque',
    'spec_cpu' => ':amount% de CPU',
    'spec_backups' => ':count sauvegardes',
    'spec_databases' => ':count bases de données',

    // ---- la page publique ------------------------------------------------
    'public_empty' => 'Rien n\'est en vente pour le moment',
    'public_empty_body' => 'Revenez plus tard.',
    'to_panel' => 'Se connecter',
    'terms' => 'Conditions',
    'sign_in_note' => 'Choisissez un serveur ci-dessous. Vous vous connectez pour terminer, et il est créé une fois la facture payée.',

    // ---- la commande -----------------------------------------------------
    'checkout_title' => 'Commande',
    'tax_line' => 'TVA (:rate%)',
    'coupon' => 'Code de réduction',
    'coupon_placeholder' => 'Si vous en avez un',
    'coupon_bad' => 'Ce code ne marche pas ici.',
    'coupon_good' => 'Code appliqué.',
    'agree' => 'J\'accepte les',
    'place_order' => 'Passer la commande',
    'place_order_note' => 'Cela écrit une facture. Rien n\'est prélevé tant que vous ne payez pas, et le serveur est créé une fois qu\'elle est payée.',
    'back_to_store' => 'Retour à la boutique',

    'placed' => 'Commande passée',
    'placed_body' => 'La facture :number vous attend sur votre page de facturation.',

    'refused' => 'Cela n\'a pas pu être acheté',
    'refused_gone' => 'Ce n\'est plus en vente.',
    'refused_sold_out' => 'Le dernier est parti.',
    'refused_bad_coupon' => 'Le code de réduction ne vaut pas pour cela.',
    'refused_failed' => 'Quelque chose s\'est mal passé à l\'écriture de la commande. Rien n\'a été prélevé. Réessayez, et dites-le à qui tient ce panel si cela continue.',

    // ---- la facturation --------------------------------------------------
    'billing_title' => 'Facturation',
    'billing_nav_label' => 'Facturation',
    'billing_subheading' => 'Ce que vous avez acheté, et ce que vous devez.',
    'your_orders' => 'Vos commandes',
    'your_invoices' => 'Vos factures',
    'no_orders' => 'Vous n\'avez encore rien acheté',
    'no_orders_body' => 'Tout ce que vous achetez apparaît ici avec son serveur et ses dates.',
    'no_invoices' => 'Aucune facture pour l\'instant',
    'to_store' => 'Aller à la boutique',
    'renews' => 'Renouvellement',
    'ask_how_to_pay' => 'Demandez à qui tient ce panel comment payer. Ils ne l\'ont pas encore écrit ici.',
    'order_pending' => 'En attente du paiement de la facture. Le serveur est créé juste après.',
    'order_suspended' => 'Arrêté pour une facture impayée. La payer redémarre le serveur : rien n\'a été supprimé.',

    // ---- payer -----------------------------------------------------------
    'pay_with' => 'Payer avec',
    'pay_now' => 'Payer',
    'pay_description' => 'Facture :number',
    'pay_thanks' => 'Merci. La facture est payée.',
    'pay_pending' => 'Le prestataire ne l\'a pas encore confirmé. Cette page se met à jour dès qu\'il le fait.',
    'pay_refused' => 'Cela n\'a pas démarré',
    'pay_refused_body' => 'Le paiement n\'a pas pu être ouvert. Essayez autrement, ou demandez à qui tient ce panel.',
    'gateway_mollie' => 'Mollie',

    // ---- les réglages du prestataire -------------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'Accepte iDEAL, les cartes, Bancontact et le reste par un seul compte. Test et production sont le même réglage : la clé dit elle-même à quel compte elle appartient.',
    'mollie_on' => 'Proposer Mollie',
    'mollie_on_helper' => 'Éteint retire le bouton de toutes les factures. Ce qui est déjà payé reste payé.',
    'mollie_key' => 'Clé API',
    'mollie_key_helper' => 'Dans la section Developers de votre tableau de bord Mollie. Elle n\'est jamais écrite dans un fichier de réglages exporté.',
    'mollie_hook' => 'Adresse du webhook',
    'mollie_hook_helper' => 'Mollie écrira à :url - votre panel doit y être joignable depuis internet.',

    'gateway_stripe' => 'Carte',

    'section_stripe' => 'Stripe',
    'section_stripe_helper' => 'Accepte les cartes sur une page dessinée par Stripe, de sorte qu\'aucun numéro de carte n\'atteint jamais ce panel. Test et production tiennent au préfixe de la clé, pas à un réglage.',
    'stripe_on' => 'Proposer Stripe',
    'stripe_on_helper' => 'Éteint retire le bouton de toutes les factures. Ce qui est déjà payé reste payé.',
    'stripe_key' => 'Clé secrète',
    'stripe_key_helper' => 'Celle qui commence par sk_, dans Developers, API keys. Jamais écrite dans un fichier de réglages exporté.',
    'stripe_hook' => 'Secret de signature',
    'stripe_hook_key_helper' => 'La valeur whsec_ que Stripe affiche quand vous ajoutez l\'adresse ci-dessous. Sans elle, leurs messages ne peuvent être prouvés authentiques et sont ignorés.',
    'stripe_hook_helper' => 'Ajoutez :url comme endpoint dans Developers, webhooks, pour l\'événement checkout.session.completed.',

    'gateway_paypal' => 'PayPal',

    'section_paypal' => 'PayPal',
    'section_paypal_helper' => 'Le seul prestataire où l\'argent bouge au retour du client plutôt que pendant qu\'il est encore chez PayPal : un onglet fermé laisse donc une facture impayée, pas un paiement perdu.',
    'paypal_on' => 'Proposer PayPal',
    'paypal_on_helper' => 'Éteint retire le bouton de toutes les factures. Ce qui est déjà payé reste payé.',
    'paypal_sandbox' => 'Bac à sable',
    'paypal_sandbox_helper' => 'Parle au compte de test de PayPal plutôt qu\'au vrai. Leurs client ids se ressemblent dans les deux cas, et c\'est précisément pourquoi ce réglage existe.',
    'paypal_id' => 'Client ID',
    'paypal_secret' => 'Secret',
    'paypal_id_helper' => 'De l\'app que vous avez créée dans Apps & Credentials. Vérifiez que l\'onglet correspond au réglage ci-dessus.',
    'paypal_secret_helper' => 'À côté du client ID, derrière Show. Jamais écrit dans un fichier de réglages exporté.',
    'paypal_hook' => 'ID du webhook',
    'paypal_hook_id_helper' => 'L\'ID que PayPal donne au webhook une fois ajouté - pas l\'adresse. Sans lui, leurs messages ne peuvent pas leur être soumis pour vérification et sont ignorés.',
    'paypal_hook_helper' => 'Ajoutez :url comme webhook sur cette app, pour PAYMENT.CAPTURE.COMPLETED, puis collez ici l\'ID obtenu.',
];
