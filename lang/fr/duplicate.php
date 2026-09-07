<?php

/*
 * Français. Écrit à la main.
 *
 * « Egg » reste en anglais : c’est le mot que Pelican emploie partout dans son
 * interface, et un réglage nommé autrement que l’écran d’où il vient est un
 * réglage qu’il faut chercher deux fois.
 */

return [
    'title' => 'Dupliquer un serveur',
    'nav_label' => 'Dupliquer un serveur',
    'subheading' => 'Un autre serveur configuré exactement comme un serveur existant, ou plusieurs d’un coup.',

    'section' => 'Ce qui est copié',
    'section_helper' => 'Le propriétaire, l’egg, la commande de démarrage, les limites et toutes les variables sont copiés. Les fichiers, les bases de données, les sauvegardes et les tâches planifiées ne le sont pas — copier les fichiers d’un serveur en marche revient à copier son état, ce qui est rarement ce que veut dire « un autre comme celui-ci ».',

    'source' => 'Copier depuis',
    'source_helper' => 'Les copies atterrissent sur le même nœud que ce serveur, parce que c’est là que se trouvent ses adresses libres.',

    'name' => 'Nommer la copie',
    'name_helper' => 'En faire plusieurs les numérote : « Bot 1 », « Bot 2 », et ainsi de suite.',

    'copies' => 'Combien',
    'copies_helper' => 'Choisissez d’abord un serveur.',
    'room' => ':count adresses libres sur :node, c’est donc le maximum qu’on puisse créer pour l’instant.',
    'no_room' => 'Il ne reste aucune adresse libre sur :node. Une copie a besoin de la sienne : ajoutez d’abord une allocation à ce nœud.',

    /*
     * Comptées plutôt qu’énumérées pour les réussites, et énumérées pour les
     * échecs — c’est le sens qui aide : dix noms qui ont fonctionné, c’est un
     * mur de texte que personne ne lit, et celui qui a échoué est la seule
     * chose qui mérite d’être lue.
     */
    'made' => ':count copies créées',
    'partly_failed' => ':count copies n’ont pas pu être créées',
    'failed' => 'Rien n’a été copié',
];
