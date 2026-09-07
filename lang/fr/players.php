<?php

/*
 * Français. Écrit à la main.
 *
 * « Whitelist » et « operator » restent en anglais : ce sont les mots que
 * Minecraft écrit lui-même dans server.properties, dans whitelist.json et dans
 * ops.json, et ce sont ceux qu’on retape dans la console.
 */

return [
    'nav_label' => 'Joueurs',
    'title' => 'Joueurs',
    'subheading' => 'La whitelist, les operators, les bannissements, et tous ceux que ce serveur a vus.',

    /*
     * Dit une fois, vers le haut, parce que cela explique à la fois ce que la
     * page peut faire et pourquoi une chose qu’elle ne fait pas n’est pas un
     * défaut. Chaque changement est émis comme une commande console, ce qui est
     * la façon dont Minecraft doit être prévenu — le jeu applique le changement
     * et écrit son propre fichier, les deux ne se contredisent donc jamais.
     */
    'how' => 'Les changements sont envoyés au serveur sous forme de commandes console : c’est le jeu qui les applique et qui écrit ses propres fichiers. Cela demande que le serveur soit en marche.',
    'needs_running' => 'Le serveur doit être en marche. Ces changements sont faits par le jeu, et non en modifiant ses fichiers sous ses pieds.',

    'name' => 'Nom du joueur',
    'reason' => 'Raison (facultatif)',

    'whitelist' => 'Ajouter à la whitelist',
    'unwhitelist' => 'Retirer de la whitelist',
    'op' => 'Passer operator',
    'deop' => 'Retirer operator',
    'ban' => 'Bannir',
    'pardon' => 'Débannir',
    'kick' => 'Expulser',

    'sent' => 'Commande envoyée',
    'sent_body' => 'Le serveur l’applique et met à jour ses propres fichiers. Rechargez la page pour voir les listes changer.',
    'refused' => 'Cela n’a pas été envoyé',

    'flag_op' => 'Operator',
    'flag_whitelisted' => 'Sur la whitelist',
    'flag_banned' => 'Banni',
    'flag_seen' => 'A déjà joué ici',

    'online' => 'En ligne',
    'online_count' => ':online sur :max',
    'online_none' => 'Personne n’est connecté.',

    'players' => 'Joueurs',
    'ips' => 'Adresses bannies',
    'ips_empty' => 'Aucune adresse n’est bannie.',

    /*
     * Ce que veut dire une page vide, et ce n’est en général pas « aucun
     * joueur » mais « ce serveur n’a jamais démarré ». Minecraft ne crée aucun
     * de ces fichiers avant sa première exécution.
     */
    'empty' => 'Rien à montrer pour l’instant. Minecraft écrit ces listes lui-même, et il ne les crée pas tant que le serveur n’a pas démarré une première fois.',

    'level' => 'Niveau :level',

    /*
     * La seule chose que cette page ne fait pas, dite plutôt que laissée à
     * découvrir. Un état en direct demande une seconde connexion au jeu
     * lui-même, ce qui est une autre fonctionnalité avec ses propres exigences.
     */
    'not_live' => 'Ceci est ce que le serveur a noté, et non qui est connecté en ce moment.',
];
