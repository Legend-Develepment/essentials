<?php

/*
 * Français. Écrit à la main.
 *
 * Qui est sur un serveur, pour les jeux qui répondent à la requête de Valve.
 *
 * Une seule page pour Rust, ARK, Valheim et les autres, parce qu’ils répondent
 * au même paquet. Ce qui diffère d’un jeu à l’autre, c’est ce qu’on peut faire
 * à quelqu’un — expulser s’écrit `kick "nom"` sur l’un et `KickPlayer <id>` sur
 * l’autre — et c’est pourquoi cette page lit sans agir.
 */

return [
    'title' => 'Joueurs',
    'nav_label' => 'Joueurs',
    'subheading' => 'Qui est connecté, demandé au jeu lui-même plutôt qu’au panel.',

    'refresh' => 'Redemander',

    'count' => ':count connectés',
    'score' => 'Score',

    'just_joined' => 'vient d’arriver',
    'minutes' => ':count min',
    'hours' => ':count h',
    'hours_minutes' => ':hours h :minutes min',

    'empty' => 'Personne n’est sur ce serveur.',

    /*
     * Pas « personne n’est connecté », et la différence compte.
     *
     * Le panel et le port de jeu sont souvent sur des réseaux qui ne se
     * joignent pas, et dessiner cela comme une liste vide reviendrait à dire
     * quelque chose que cette page ne sait pas.
     */
    'unreachable' => 'Le serveur n’a pas répondu. Il est peut-être en train de démarrer, ou le panel n’arrive pas à joindre son port de jeu depuis l’endroit où il tourne — ce n’est pas la même chose que personne dessus.',
];
