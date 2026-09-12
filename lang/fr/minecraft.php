<?php

/*
 * Français. Écrit à la main.
 *
 * Les modes de jeu et les difficultés ne sont pas traduits. Minecraft les
 * affiche dans le jeu lui-même comme Survival, Creative, Peaceful et Hard - et
 * un réglage nommé autrement que l’écran d’où il vient est un réglage qu’il
 * faut chercher deux fois.
 *
 * Il en va de même des termes qui figurent dans server.properties : whitelist,
 * operator, seed, chunk, RCON, query, resource pack et le Nether.
 */

return [
    /* ------------------------------------------------ l’onglet admin ----- */

    'nav_label' => 'Minecraft',
    'title' => 'Réglages Minecraft',
    'subheading' => 'Le server.properties de ce serveur, sous forme de formulaire plutôt que de fichier texte.',

    /*
     * Le titre lui-même n’est pas ici. Chaque section de réglages tire son
     * titre de settings.groups.<nom>, que construit group().
     */
    'section_helper' => 'À quels eggs cela s’applique, et tout ce que ce plugin fait d’autre autour de Minecraft.',

    'live' => 'Demander aux serveurs qui joue',
    'live_helper' => 'Ajoute à la page Joueurs une liste en direct des joueurs connectés, par le même handshake que fait le client Minecraft pour dessiner un serveur dans sa propre liste. Désactivé par défaut, parce que c’est la seule chose ici qui ouvre une connexion du panel directement vers un port de jeu : si votre panel et vos nœuds sont sur des réseaux qui ne se joignent pas, rien ne répondra et la ligne n’apparaîtra tout simplement pas. Rien n’est à activer sur le serveur de jeu lui-même.',

    'eggs' => 'Quels eggs sont Minecraft',
    'eggs_helper' => 'Cochez les eggs qui font tourner un serveur Minecraft - Vanilla, Paper, Purpur, Fabric, Forge, et quel que soit le nom des vôtres. La page apparaît dans les serveurs qui les utilisent, et nulle part ailleurs. Rien n’est coché au départ, et c’est volontaire : un plugin ne peut pas savoir comment vous avez nommé vos eggs, et une liste devinée serait fausse sur le panel de quelqu’un dès la semaine de sa sortie.',

    /* --------------------------------------------- la page du serveur ---- */

    'groups' => [
        'general' => 'Le serveur',
        'players' => 'Joueurs',
        'world' => 'Le monde',
        'performance' => 'Performances',
        'access' => 'Accès et suppléments',
        'other' => 'Tout le reste du fichier',
    ],

    'other_helper' => 'Lu depuis server.properties et laissé exactement tel quel. Les mods et les modpacks y déposent leurs propres réglages ; ils sont affichés pour que vous sachiez qu’ils existent, et se modifient par le gestionnaire de fichiers. Enregistrer cette page n’y touche jamais.',

    'reload' => 'Relire le fichier',

    'saved' => 'Enregistré dans server.properties',
    'saved_helper' => 'Cela prend effet au prochain démarrage du serveur.',

    'running' => 'Le serveur est en marche',
    'running_helper' => 'Minecraft lit server.properties au démarrage et le réécrit à l’arrêt : ce qui serait enregistré maintenant serait écrasé en chemin. Arrêtez le serveur et enregistrez à nouveau.',

    'missing' => 'Aucun server.properties trouvé',
    'missing_helper' => 'Le fichier apparaît au premier démarrage du serveur. Démarrez-le une fois, puis revenez.',

    'failed' => 'Impossible d’enregistrer',
    'failed_helper' => 'Le daemon a refusé l’écriture. Le serveur a peut-être démarré pendant que cette page était ouverte.',

    /* ------------------------------------ ce que veut dire chaque clé ---- */

    'keys' => [
        'motd' => 'Message dans la liste des serveurs',
        'gamemode' => 'Mode de jeu',
        'difficulty' => 'Difficulté',
        'hardcore' => 'Hardcore - la mort est définitive',
        'force_gamemode' => 'Remettre tout le monde au mode par défaut à la connexion',
        'pvp' => 'Les joueurs peuvent se blesser entre eux',

        'max_players' => 'Nombre maximum de joueurs à la fois',
        'white_list' => 'Whitelist uniquement',
        'enforce_whitelist' => 'Expulser quiconque n’est pas sur la whitelist',
        'online_mode' => 'Vérifier les comptes auprès de Mojang',
        'player_idle_timeout' => 'Expulser après tant de minutes d’inactivité',
        'op_permission_level' => 'Ce qu’un operator a le droit de faire (1–4)',

        'level_name' => 'Dossier du monde',
        'level_seed' => 'Seed',
        'level_type' => 'Type de monde',
        'allow_nether' => 'Le Nether',
        'spawn_monsters' => 'Apparition des monstres',
        'spawn_protection' => 'Blocs protégés autour du spawn',

        'view_distance' => 'Distance d’affichage en chunks',
        'simulation_distance' => 'Distance de simulation en chunks',
        'max_tick_time' => 'Watchdog, en millisecondes (-1 le désactive)',
        'sync_chunk_writes' => 'Écrire les chunks directement sur le disque',

        'enable_command_block' => 'Blocs de commande',
        'allow_flight' => 'Autoriser le vol',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'Adresse du resource pack',
        'require_resource_pack' => 'Le resource pack est obligatoire',
    ],

    'values' => [
        'survival' => 'Survival',
        'creative' => 'Creative',
        'adventure' => 'Adventure',
        'spectator' => 'Spectator',
        'peaceful' => 'Peaceful',
        'easy' => 'Easy',
        'normal' => 'Normal',
        'hard' => 'Hard',
    ],
];
