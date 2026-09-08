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
];
