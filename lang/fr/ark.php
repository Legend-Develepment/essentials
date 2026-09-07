<?php

/*
 * Français. Écrit à la main.
 *
 * « Egg », « GameUserSettings.ini » et « daemon » restent en anglais : ce sont
 * les mots qu’on retrouve dans Pelican, dans le gestionnaire de fichiers et
 * dans tout ce qui s’écrit à propos d’ARK.
 */

return [
    /* ------------------------------------------------ l’onglet admin ----- */

    /*
     * Le titre de la section n’est pas ici. Chaque section de réglages tire son
     * titre de settings.groups.<nom>, que construit group().
     */
    'section_helper' => 'Quels eggs font tourner ARK. Rien d’autre — le reste d’un serveur ARK se configure par ses variables de démarrage, et la page Démarrage de Pelican les modifie déjà.',

    'eggs' => 'Quels eggs sont ARK',
    'eggs_helper' => 'Cochez les eggs qui font tourner un serveur ARK. Une page Réglages du monde apparaît dans les serveurs qui les utilisent, et nulle part ailleurs. C’est une question distincte de celle de la page de statut : celle-là demande quels eggs répondent à la requête de Valve, ce que font aussi Rust et Valheim, et celle-ci demande quels eggs gardent GameUserSettings.ini là où ARK le garde, ce que seul ARK fait. Rien n’est coché au départ, et c’est volontaire — un plugin ne peut pas savoir comment vous avez nommé vos eggs.',

    /* --------------------------------------------- la page du serveur ---- */

    'nav_label' => 'Réglages du monde',
    'title' => 'Réglages du monde ARK',
    'subheading' => 'Les réglages que les gens changent réellement, tirés de GameUserSettings.ini.',

    'group_server' => 'Le serveur',
    'group_server_helper' => 'Comment le serveur s’appelle, qui peut le rejoindre, et combien.',
    'group_rates' => 'Taux',
    'group_rates_helper' => 'À quelle vitesse les choses se passent. 1.0 est le jeu tel qu’il est livré ; 2.0 est deux fois plus rapide.',
    'group_rules' => 'Règles',
    'group_rules_helper' => 'Ce que les joueurs ont le droit de faire et ce que le jeu leur montre.',

    'keeps' => 'Quinze réglages tirés d’un fichier qui en contient des centaines. Tout le reste — vos réglages de mods, des clés dont ce plugin n’a jamais entendu parler, les commentaires et l’ordre de l’ensemble — reste exactement tel quel à l’enregistrement.',
    'missing' => 'Ce serveur n’a pas encore de GameUserSettings.ini. Le jeu l’écrit à son premier lancement : démarrez le serveur une fois et cette page se remplira.',
    'read_only' => 'Vous pouvez lire ce fichier mais pas l’écrire : rien ici ne peut donc être modifié.',

    'save' => 'Enregistrer',
    'saved' => 'Enregistré',
    'saved_restart' => 'ARK lit ce fichier à son démarrage : redémarrez le serveur pour que le changement prenne effet.',
    'failed' => 'Impossible d’enregistrer',
    'failed_write' => 'Le daemon a refusé l’écriture. Vérifiez que le serveur est joignable et que le fichier n’est pas en lecture seule.',
];
