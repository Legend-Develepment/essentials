<?php

/*
 * Français. Écrit à la main.
 *
 * « Egg », « daemon », « SteamID64 » et « PlayFab ID » restent en anglais : ce
 * sont les mots de Pelican et ceux du jeu, et c’est sous ces noms qu’on les
 * retrouve.
 */

return [
    /* ------------------------------------------------ l’onglet admin ----- */

    'section_helper' => 'Quels eggs font tourner Valheim. Rien d’autre — un serveur Valheim se configure par ses variables de démarrage, et la page Démarrage de Pelican les modifie déjà.',

    'eggs' => 'Quels eggs sont Valheim',
    'eggs_helper' => 'Cochez les eggs qui font tourner un serveur Valheim. Une page Listes de joueurs apparaît dans les serveurs qui les utilisent, et nulle part ailleurs. L’emplacement de ces listes change d’un egg à l’autre : il est donc déterminé serveur par serveur, en regardant aux endroits qu’utilise le jeu. Rien n’est coché au départ, et c’est volontaire — un plugin ne peut pas savoir comment vous avez nommé vos eggs.',

    /* --------------------------------------------- la page du serveur ---- */

    'nav_label' => 'Listes de joueurs',
    'title' => 'Listes de joueurs Valheim',
    'subheading' => 'Les admins, les bannis et la liste des autorisés, sous forme de trois listes plutôt que de trois fichiers texte.',

    'admin' => 'Admins',
    'admin_helper' => 'Tous ceux qui sont ici peuvent utiliser les commandes admin en jeu.',
    'banned' => 'Bannis',
    'banned_helper' => 'Tous ceux qui sont ici sont refusés quand ils tentent de rejoindre.',
    'permitted' => 'Autorisés',
    'permitted_helper' => 'Si cette liste contient quelqu’un, seules ces personnes peuvent rejoindre. Une liste vide laisse entrer tout le monde — ce que veut la plupart des serveurs : laissez-la vide, sauf si vous le voulez vraiment.',

    'ids' => 'Identifiants de joueurs',
    'ids_placeholder' => 'Collez un identifiant et appuyez sur espace',

    'how' => 'Un identifiant par joueur — un SteamID64 sur un serveur Steam, un PlayFab ID sur un serveur crossplay. Collez-les et appuyez sur espace, tabulation ou virgule. Ce que le jeu a écrit en commentaire au-dessus de la liste reste où il est.',
    'where' => 'Lu depuis :dir.',
    'missing' => 'Ce serveur n’a encore aucun de ces fichiers. Le jeu les écrit dès qu’il en a besoin, et enregistrer ici créera ceux que vous remplissez.',
    'read_only' => 'Vous pouvez lire ces fichiers mais pas les écrire : rien ici ne peut donc être modifié.',

    'save' => 'Enregistrer',
    'saved' => 'Enregistré',
    'saved_reload' => 'Valheim relit ces listes pendant qu’il tourne : le changement s’applique sans redémarrage.',
    'unchanged' => 'Rien n’avait changé, rien n’a donc été écrit',
    'failed' => 'Impossible d’enregistrer',
    'failed_lists' => 'Le daemon a refusé l’écriture pour : :lists. Vérifiez que le serveur est joignable et que les fichiers ne sont pas en lecture seule.',
];
