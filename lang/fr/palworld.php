<?php

/*
 * Français. Écrit à la main.
 *
 * Les réglages du monde de Palworld, sur une page plutôt que dans un fichier.
 *
 * Rien ici ne nomme un réglage. Chaque libellé de cette page est déduit de la
 * clé que contient le fichier du serveur lui-même — voir
 * Support\Palworld\Palworld::label() pour comprendre pourquoi une liste de noms
 * serait pire que pas de liste du tout.
 */

return [
    'title' => 'Réglages Palworld',
    'nav_label' => 'Palworld',
    'subheading' => 'Les réglages du monde issus du PalWorldSettings.ini de ce serveur, lus à l’ouverture de cette page. Modifiables uniquement lorsque le serveur est arrêté.',

    'reload' => 'Relire le fichier',

    'save_confirm' => 'Le fichier est réécrit avec ces valeurs. Chaque réglage que cette page n’a pas montré est réécrit exactement tel qu’il était, et tout le reste du fichier également.',
    'saved' => 'Réglages enregistrés',
    'saved_body' => 'Ils prennent effet au prochain démarrage du serveur.',
    'save_failed' => 'Impossible d’écrire le fichier',

    'running' => 'Le serveur est en marche',
    'running_body' => 'Palworld garde ces réglages en mémoire et réécrit le fichier en s’arrêtant : une modification enregistrée maintenant serait annulée sans un mot. Arrêtez d’abord le serveur.',

    'groups' => [
        'server' => 'Serveur et connexion',
        'world' => 'Monde et taux',
        'pals' => 'Pals',
        'players' => 'Joueurs',
        'building' => 'Construction, objets et récolte',
        'guild' => 'Guildes',
        'other' => 'Autres',
    ],
];
