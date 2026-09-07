<?php

/*
 * Français. Écrit à la main.
 *
 * « Modpack », « loader », « egg », « daemon », « mods » et « config » restent
 * en anglais : ce sont les mots sur Modrinth, dans le gestionnaire de fichiers
 * et dans tout tutoriel qu’on trouve à ce sujet.
 */

return [
    'nav_label' => 'Modpacks',
    'title' => 'Modpacks',
    'subheading' => 'Installer un modpack de Modrinth sur ce serveur.',

    'section' => 'Trouver un pack',
    'section_helper' => 'Modrinth uniquement, et uniquement les packs côté serveur. Il ne demande ni compte ni clé d’API, et c’est pour cela qu’il est la seule source ici — les autres veulent chacune une clé collée quelque part avant que quoi que ce soit n’apparaisse.',

    'search' => 'Rechercher',
    'search_helper' => 'Laissez vide pour les plus téléchargés. Une recherche interroge Modrinth : elle a donc lieu quand vous quittez le champ, et non pendant que vous tapez.',

    'pack' => 'Pack',
    'pack_helper' => 'Seuls les packs qui se déclarent utilisables sur un serveur sont listés.',

    'version' => 'Version',
    'version_helper' => 'La version du jeu et le loader sont indiqués à côté de chacune. Choisissez le loader que l’egg de ce serveur fait déjà tourner — ceci installe des fichiers et ne change ni votre egg ni votre commande de démarrage.',

    'downloads' => 'téléchargements',

    'install' => 'Installer ce pack',
    'install_go' => 'L’installer',
    'install_confirm' => 'Les fichiers du pack sont ajoutés à ce serveur. **Rien n’est supprimé** — ni votre monde, ni vos anciens mods, ni une config. Un pack installé par-dessus un autre laisse les deux en place : retirez d’abord vous-même les mods du pack précédent si c’est ce que vous voulez. Le serveur doit être arrêté, et il le reste.',

    'started' => 'Installation en cours',
    'started_helper' => 'Le pack est en train d’être récupéré et décompressé. Quelques centaines de fichiers prennent quelques minutes, et vous recevez une notification à la fin — cela continue si vous quittez cette page.',

    'running' => 'Le serveur est en marche',
    'running_helper' => 'Minecraft charge ses mods au démarrage : un pack installé maintenant laisserait un serveur qui n’est ni l’ancien pack ni le nouveau jusqu’au redémarrage. Arrêtez-le et réessayez.',

    'done' => ':pack installé',
    'done_body' => ':files fichiers récupérés et :overrides éléments du dossier propre au pack mis en place. Démarrez le serveur quand vous êtes prêt.',
    'done_refused' => ':count fichiers ont été ignorés parce que le pack les demandait depuis un endroit d’où rien ne sera téléchargé ici.',

    'failed' => 'Le pack n’a pas été installé',
    'failed_fetch' => 'Le pack n’a pas pu être récupéré ou décompressé. Le daemon est peut-être injoignable, ou le serveur n’a plus de disque.',
    'failed_index' => 'Le pack a été récupéré mais ne contenait aucun index lisible : il n’y avait donc rien à installer.',
    'failed_version' => 'Cette version n’a plus de fichier de pack à télécharger. Choisissez-en une autre.',
    'failed_queue' => 'L’installation n’a pas pu être mise en file. Cela demande un queue worker en marche sur le panel.',
];
