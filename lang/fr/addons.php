<?php

/*
 * Français. Écrit à la main.
 *
 * Les suppléments vendus à côté d’une offre.
 *
 * Deux mots sont tenus à l’écart ici. Ce qu’un supplément *coûte*, c’est son
 * prix, et c’est ce qui est facturé à chaque fois. Ce qu’il *coûte
 * aujourd’hui*, c’est une part de ce prix, parce que celui qui en achète un au
 * milieu du mois paie un demi-mois. Les mots que lit un client disent toujours
 * duquel des deux il s’agit.
 *
 * « N’ajoute rien au serveur » est une vraie réponse, et elle est dite
 * franchement plutôt que laissée en blanc : un support prioritaire est une
 * chose ordinaire à vendre, et une case vide se lit comme une erreur.
 */

return [
    'title' => 'Suppléments',
    'nav_label' => 'Suppléments',
    'subheading' => 'Ce qui se vend à côté d’une offre : plus de mémoire, une sauvegarde de plus, ou quelque chose qui n’est qu’une ligne sur la facture.',

    // ---- le tableau -------------------------------------------------------
    'column_name' => 'Supplément',
    'column_price' => 'Prix',
    'column_adds' => 'Ajoute',
    'column_sold' => 'Utilisés',
    'column_live' => 'En vente',
    'adds_nothing' => 'Rien sur le serveur',

    // ---- le formulaire ----------------------------------------------------
    'section_what' => 'Ce que c’est',
    'section_what_helper' => 'Le nom et le prix que voit un client, et les offres avec lesquelles cela peut être acheté.',
    'name' => 'Nom',
    'price' => 'Prix',
    'price_helper' => 'Ce qu’il coûte à chaque facturation. Acheté en cours de période, un client en paie une part, puis le prix entier à partir du renouvellement suivant.',
    'billing' => 'Facturé',
    'billing_helper' => '« À chaque renouvellement » veut dire qu’il revient tant qu’il est gardé. « Une seule fois » veut dire qu’il est facturé sur la facture qui le porte en premier, et plus jamais ensuite.',
    'billing_with' => 'À chaque renouvellement',
    'billing_once' => 'Une seule fois',
    'max' => 'Maximum par service',
    'max_helper' => 'Combien on peut en détenir. Un est le cas ordinaire ; montez-le pour quelque chose qui se vend au gigaoctet.',
    'description' => 'Description',
    'description_helper' => 'Une ligne sous le nom au moment de payer. Dites ce qu’il fait, pas comment il s’appelle.',
    'packages' => 'Offres',
    'packages_helper' => 'Avec quelles offres cela peut être acheté. Rien de coché signifie toutes, ce qu’est en général une option de support ou une sauvegarde supplémentaire.',

    'section_adds' => 'Ce qu’il ajoute au serveur',
    'section_adds_helper' => 'Ces valeurs s’ajoutent à ce que l’offre donne déjà, elles ne la remplacent pas : 4096 en mémoire rend le serveur 4 Gio plus grand. Deux fois le même supplément s’additionnent. Laissez tout à zéro pour quelque chose qui n’est qu’une ligne sur la facture. Un nombre négatif retire quelque chose : c’est permis, et c’est de temps en temps exactement ce que l’on veut.',
    'sort' => 'Ordre',
    'sort_helper' => 'Le plus petit passe en premier au moment de payer. À nombre égal, c’est le prix qui départage.',
    'live' => 'En vente',
    'live_helper' => 'Éteint, il n’est proposé nulle part. Qui l’a déjà le garde et continue d’être facturé pour lui.',

    // ---- les boutons ------------------------------------------------------
    'new' => 'Nouveau supplément',
    'edit' => 'Modifier',
    'delete' => 'Supprimer',
    'delete_confirm' => 'Personne ne l’a. Le supprimer le retire de la liste pour de bon.',
    'delete_sold' => ':count service(s) l’ont. Ils le gardent, gardent les limites qu’il leur a données et continuent d’être facturés pour lui - ce qui disparaît, c’est l’entrée dans la liste, pour que personne de nouveau ne puisse l’acheter.',
    'go_live' => 'Mettre en vente',
    'go_offline' => 'Retirer de la vente',
    'saved' => 'Enregistré',
    'deleted' => 'Le supplément a disparu',
    'save_failed' => 'Non enregistré',
    'save_failed_body' => 'Rien n’a été écrit. Réessayez, et regardez dans les logs si cela se reproduit.',
    'invalid' => 'Un supplément a besoin d’un nom et d’un prix.',
    'empty' => 'Aucun supplément pour l’instant',
    'empty_body' => 'Un supplément est quelque chose qui se vend à côté d’une offre : un gigaoctet de plus, une deuxième sauvegarde, ou un service qui n’ajoute rien du tout au serveur.',

    // ---- ce que voit un client --------------------------------------------
    'choose' => 'Suppléments',
    'choose_helper' => 'Facultatifs, et vous pouvez en ajouter ou en retirer plus tard.',
    'yours' => 'Suppléments sur ce service',
    'add' => 'Ajouter un supplément',
    'add_helper' => 'Vous payez maintenant ce qui reste de cette période, et le prix entier à partir du renouvellement suivant.',
    'add_to' => 'Ajouter :name',
    'add_confirm' => 'Ajouter :name à ce service ?',
    'drop' => 'Retirer',
    'drop_confirm' => 'Retirer :name ? La part non utilisée de ce que vous avez payé retourne sur votre compte, et votre serveur change aussitôt.',
    'costs_now' => ':amount maintenant',
    'free_now' => 'Rien à payer maintenant',
    'then' => 'puis :amount par renouvellement',
    'once_only' => ':amount, une seule fois',
    'each' => 'chacun',
    'added' => ':name ajouté',
    'added_body' => 'Votre serveur a reçu ce qu’il apporte.',
    'dropped' => ':name retiré',
    'dropped_body' => 'Ce que vous aviez payé sans l’utiliser est sur votre compte.',

    // ---- et quand cela ne se fera pas -------------------------------------
    'refused' => 'Cela n’a pas pu être fait',
    'refused_off' => 'Les suppléments sont désactivés sur ce panel.',
    'refused_not_active' => 'Seul un service en cours peut recevoir des suppléments.',
    'refused_gone' => 'Ce supplément n’est plus en vente.',
    'refused_wrong_package' => 'Ce supplément ne se vend pas avec cette offre.',
    'refused_enough' => 'Vous en avez déjà autant que ce service peut en détenir.',
    'refused_failed' => 'Rien n’a été enregistré, donc rien n’a changé. Réessayez, et signalez-le à qui gère ce panel si cela se reproduit.',
    'refused_server' => 'Le serveur n’a pas voulu des nouvelles limites : rien n’a été changé et rien n’a été facturé.',
    'refused_not_yours' => 'Ce supplément n’est pas sur ce service.',

    // ---- ce que disent les documents -------------------------------------
    'line' => ':name × :many, pour les :days jours restants de cette période',
    'credit_reason' => 'Retiré : :name',
    'bell_failed' => 'Un supplément n’a pas pu être donné au serveur sur la commande :number',

    // ---- les unités, pour le tableau d’administration ---------------------
    'unit_memory' => 'Mio de mémoire',
    'unit_swap' => 'Mio de swap',
    'unit_disk' => 'Mio de disque',
    'unit_cpu' => '% CPU',
    'unit_database_limit' => 'bases de données',
    'unit_allocation_limit' => 'allocations',
    'unit_backup_limit' => 'sauvegardes',
];
