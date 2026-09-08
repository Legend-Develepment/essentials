<?php

/*
 * Français. Écrit à la main.
 *
 * Les offres : un serveur que quelqu'un peut acheter.
 *
 * Lu par la personne qui met la boutique en place. Chaque mot ici parle du
 * modèle et du prix ; ce que voit un client est dans shop.php, parce que les
 * deux lecteurs veulent des phrases différentes sur la même ligne.
 *
 * « egg », « node », « swap », « io » et les mots de Minecraft restent en
 * anglais : ce sont les mots du formulaire de serveur de Pelican, et une offre
 * est ce formulaire, gardé pour plus tard.
 */

return [
    'title' => 'Offres',
    'nav_label' => 'Offres',
    'subheading' => 'Ce qui est en vente. Chacune est un modèle de serveur avec un prix dessus ; un client en achète une et le panneau crée le serveur.',

    // ---- le tableau ------------------------------------------------------
    'column_name' => 'Offre',
    'column_egg' => 'Egg',
    'column_price' => 'Prix',
    'column_stock' => 'Stock',
    'column_live' => 'En vente',
    'column_orders' => 'Vendues',

    'live' => 'En vente',
    'offline' => 'Pas en vente',
    'no_egg' => 'Pas d\'egg — impossible à construire',

    'stock_unlimited' => 'Illimité',
    'stock_left' => ':count restantes',
    'stock_out' => 'Épuisée',

    // ---- périodes --------------------------------------------------------
    'period_once' => 'Une seule fois',
    'period_month' => 'Mensuel',
    'period_quarter' => 'Trimestriel',
    'period_year' => 'Annuel',

    // Après un prix : « 12,50 € par mois ».
    'per_once' => 'une fois',
    'per_month' => 'par mois',
    'per_quarter' => 'par trimestre',
    'per_year' => 'par an',

    // ---- actions ---------------------------------------------------------
    'new' => 'Nouvelle offre',
    'edit' => 'Modifier',
    'duplicate' => 'Dupliquer',
    'copy_suffix' => ' (copie)',
    'go_live' => 'Mettre en vente',
    'go_offline' => 'Retirer de la vente',
    'delete' => 'Supprimer',
    'delete_confirm' => 'Supprime l\'offre. Ce qui a déjà été acheté n\'est pas touché — les commandes gardent leur propre copie de ce qu\'elles étaient.',
    'delete_refused' => 'Non supprimée',
    'delete_refused_body' => 'Des commandes ont été passées sur cette offre, et elles pointent vers elle. Retirez-la plutôt de la vente ; elle reste pour les archives et personne ne peut l\'acheter.',
    'deleted' => 'Offre supprimée',
    'saved' => 'Offre enregistrée',
    'save_failed' => 'L\'offre n\'a pas pu être enregistrée',
    'price_invalid' => 'Ce n\'est pas un montant. Écrivez-le comme 12.50 ou 12,50.',

    // ---- le formulaire : ce que c'est ------------------------------------
    'section_basics' => 'L\'offre',
    'section_basics_helper' => 'Ce qu\'un client voit sur la carte.',
    'name' => 'Nom',
    'name_helper' => 'Comment elle s\'appelle dans la boutique.',
    'slug' => 'Adresse',
    'slug_helper' => 'Minuscules, chiffres et traits d\'union. Laissée vide, elle est faite à partir du nom. La changer ensuite casse un lien que quelqu\'un a gardé.',
    'description' => 'Description',
    'description_helper' => 'Quelques lignes sous le nom. Texte brut.',
    'live_field' => 'En vente',
    'live_helper' => 'Désactivé garde l\'offre ici et ne la montre à personne. Une offre sans egg n\'est jamais montrée, quoi qu\'il soit indiqué ici.',
    'sort' => 'Ordre',
    'sort_helper' => 'Plus petit vient en premier dans la boutique.',

    // ---- le formulaire : ce que ça devient -------------------------------
    'section_server' => 'Le serveur qu\'elle devient',
    'section_server_helper' => 'Les mêmes questions que pose Pelican quand vous créez un serveur à la main, répondues une fois ici et utilisées à chaque vente.',
    'egg' => 'Egg',
    'egg_helper' => 'En choisir un remplit l\'image, la commande de démarrage et chaque variable avec les valeurs par défaut de l\'egg. Modifiez-les ensuite.',
    'image' => 'Image Docker',
    'image_helper' => 'Une des images que propose l\'egg.',
    'image_default' => 'La première image de l\'egg',
    'startup' => 'Commande de démarrage',
    'startup_helper' => 'Une des commandes que propose l\'egg.',
    'startup_default' => 'La première commande de l\'egg',
    'environment' => 'Variables',
    'environment_helper' => 'Les variables de l\'egg et leur valeur. Tout ce que l\'egg possède et qui n\'est pas listé ici prend sa valeur par défaut à la création du serveur.',
    'env_key' => 'Variable',
    'env_value' => 'Valeur',
    'nodes' => 'Nodes',
    'nodes_helper' => 'Où un serveur de cette offre peut être créé, essayées dans cet ordre jusqu\'à ce qu\'une ait une adresse libre. Rien de coché signifie n\'importe quelle node.',

    // ---- le formulaire : limites -----------------------------------------
    'section_limits' => 'Limites',
    'section_limits_helper' => 'Ce que reçoit le serveur. Les mêmes champs que le formulaire de serveur de Pelican, dans les mêmes unités.',
    'memory' => 'Mémoire',
    'disk' => 'Disque',
    'cpu' => 'CPU',
    'cpu_helper' => 'Pourcentage d\'un cœur : 100 est un cœur, 200 en fait deux, 0 est sans limite.',
    'swap' => 'Swap',
    'swap_helper' => '0 est aucun, -1 est illimité.',
    'io' => 'Poids IO bloc',
    'io_helper' => 'La valeur par défaut de Pelican est 500. Laissez-la sauf si vous savez pourquoi non.',
    'threads' => 'Épinglage CPU',
    'threads_helper' => 'Quels cœurs, comme Pelican les écrit : 0,1 ou 0-3. Vide est n\'importe lequel.',
    'oom_killer' => 'OOM killer',
    'oom_killer_helper' => 'Si le noyau peut arrêter le serveur quand il manque de mémoire.',
    'databases' => 'Bases de données',
    'allocations' => 'Allocations supplémentaires',
    'backups' => 'Sauvegardes',
    'unit_mib' => 'Mio',
    'unit_percent' => '%',

    // ---- le formulaire : l'argent ----------------------------------------
    'section_price' => 'Prix et stock',
    'section_price_helper' => 'Dans la devise de la boutique, réglée sur la page Réglages de la boutique. Hors taxe — la taxe est ajoutée sur la facture sur sa propre ligne.',
    'price' => 'Prix',
    'price_helper' => 'Par période. Écrivez-le comme 12.50 ou 12,50.',
    'setup_fee' => 'Frais de mise en place',
    'setup_fee_helper' => 'Facturés une fois, sur la première facture. Zéro pour aucun.',
    'period' => 'Facturée',
    'period_helper' => 'Une seule fois est payée une fois et gardée. Les autres reçoivent une nouvelle facture à chaque période ; une facture impayée suspend le serveur après le délai de grâce de la page Réglages de la boutique.',
    'stock' => 'Stock',
    'stock_helper' => 'Combien peuvent être vendues en même temps, en comptant chaque commande non annulée. Vide est illimité.',
    'term' => 'Durée minimale',
    'term_helper' => 'Pour combien de temps quelqu\'un s\'engage en achetant. Zéro est sans engagement : il peut annuler et cela s\'arrête à la fin de la période qu\'il a payée.',
    'term_unit' => 'Comptée en',
    'term_unit_helper' => 'Jours, mois ou années. Une commande annulée va jusqu\'au bout de cette durée et le serveur est supprimé ce jour-là.',
    'unit_day' => 'Jours',
    'unit_month' => 'Mois',
    'unit_year' => 'Années',
    'term_day' => 'Durée minimale : :count jours',
    'term_month' => 'Durée minimale : :count mois',
    'term_year' => 'Durée minimale : :count ans',
    'section_art' => 'Image',
    'section_art_helper' => 'L\'image sur la carte de l\'offre, dans la boutique et sur les services d\'un client. Laissez les deux vides et l\'illustration de l\'egg est utilisée, ce que la plupart des offres ont déjà.',
    'art_file' => 'Envoyer une image',
    'art_file_helper' => 'Plutôt large que haute : la carte la recadre en 16:9. Jusqu\'à 8 Mo.',
    'art_url' => 'Ou une adresse d\'image',
    'art_url_helper' => 'Une adresse https complète. Utilisée quand rien n\'est envoyé ci-dessus.',

    'empty' => 'Pas encore d\'offres',
    'empty_body' => 'Créez-en une et elle apparaît dans la boutique dès qu\'elle est mise en vente.',
];
