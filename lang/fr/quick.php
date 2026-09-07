<?php

/*
 * Français. Écrit à la main.
 *
 * Le sélecteur de la barre du haut, et la page vers laquelle il mène.
 *
 * Un seul élément qui répond aux deux questions qu’on se pose sans arrêt —
 * quel serveur, et où étaient ces réglages — et une page qui liste tout ce que
 * quelqu’un a mis en favori. Voir Support\Quick.
 */

return [
    // ---- l’élément dans la barre du haut ---------------------------------
    'label' => 'Aller à',
    'open' => 'Aller à un serveur ou à une page favorite',
    'search' => 'Chercher un serveur…',

    'favourites' => 'Favoris',
    'servers' => 'Serveurs',
    'pages' => 'Pages',

    'loading' => 'Recherche…',
    'empty' => 'Rien trouvé.',
    // Dit plutôt que caché : une liste qui s’arrête discrètement à vingt-cinq
    // ressemble à une recherche incapable de trouver.
    'more' => 'Plus de résultats qu’il n’en tient ici — tapez encore un peu.',
    'failed' => 'Le panel n’a pas pu être joint : cette liste est peut-être périmée. La console du navigateur indique ce que la requête a répondu.',

    'star_page' => 'Mettre cette page en favori',
    'unstar_page' => 'En favori — cliquez pour l’enlever',
    'all' => 'Tout voir',

    // ---- la page ---------------------------------------------------------
    'title' => 'Favoris',
    'nav_label' => 'Favoris',
    'subheading' => 'Tout ce que vous avez mis en favori, au même endroit.',

    'how' => 'Mettez un serveur en favori avec l’étoile de sa carte dans la liste des serveurs, et une page avec le bouton du menu « Aller à », en haut de l’écran. Votre liste est conservée sur le panel plutôt que dans ce navigateur : elle vous suit donc sur le prochain appareil où vous vous connectez.',
    'page_empty' => 'Aucun favori pour le moment.',
    'remove' => 'Retirer des favoris',
];
