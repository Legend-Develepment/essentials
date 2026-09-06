<?php

/*
 * Français. Écrit à la main.
 *
 * La barre de contrôles d’une page de serveur. Un fichier à elle plutôt qu’un
 * coin de settings.php, parce que ceci est lu par les gens qui utilisent le
 * panel, et non par celui qui configure le thème.
 *
 * L’état affiché à côté des boutons est le mot de Pelican lui-même, tiré de
 * l’enum ContainerStatus : la barre et la page de console ne se contredisent
 * donc jamais sur ce que fait un serveur.
 *
 * « Kill » reste en anglais : c’est le mot du bouton de Pelican et celui de la
 * commande, et l’action n’est pas la même qu’un arrêt.
 */

return [
    'console' => 'Console',
    'full_page' => 'Nouvelle fenêtre',
    'close' => 'Fermer',

    'start' => 'Démarrer',
    'restart' => 'Redémarrer',
    'stop' => 'Arrêter',
    'kill' => 'Kill',

    'kill_confirm' => 'Un kill arrête le conteneur sur-le-champ. Tout ce que le serveur n’a pas encore écrit sur le disque est perdu. Continuer ?',

    'sent_title' => 'Action d’alimentation',
    'sent_body' => ':action a été envoyé à :name.',
    'failed' => 'Le nœud n’a pas pu être joint.',
];
