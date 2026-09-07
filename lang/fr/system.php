<?php

/*
 * Français. Écrit à la main.
 *
 * « Swap », « Load average », « Wings » et « Uptime » restent en anglais : ce
 * sont les noms sous lesquels on les retrouve sur l’hôte et dans l’interface de
 * Pelican elle-même.
 */

return [
    'title' => 'État du système',
    'nav_label' => 'État du système',
    'subheading' => 'La machine sur laquelle tourne le panel lui-même, ce qu’elle fait tourner, et à côté chaque nœud que vous avez demandé.',

    'options' => 'Options',
    'enabled' => 'Afficher dans la barre latérale',
    'enabled_helper' => 'Désactivé retire l’entrée de la barre latérale. La page garde sa propre adresse : elle est donc toujours là pour la réactiver.',

    'refresh' => 'Relire toutes les',
    'refresh_helper' => 'La page entière est redemandée à cet intervalle. Désactivé la laisse telle qu’elle était à l’ouverture.',
    'refresh_off' => 'Seulement quand je l’ouvre',
    'refresh_seconds' => ':seconds secondes',

    'blocks' => 'Afficher',
    'blocks_helper' => 'Coché veut dire affiché. « Disque » est une carte par système de fichiers : une partition racine pleine ne se cache donc pas derrière un montage de données à moitié vide.',
    'block_cpu' => 'Processeur',
    'block_memory' => 'Mémoire',
    'block_swap' => 'Swap',
    'block_disk' => 'Disque',
    'block_load' => 'Load average',
    'block_uptime' => 'Uptime',
    'block_system' => 'Système',
    'block_version' => 'Version du panel',
    // Jamais affiché - une carte de nœud porte le nom du nœud lui-même - mais
    // blank() le demande, et une clé manquante qui imprime son propre nom est
    // un mauvais repli.
    'block_node' => 'Nœud',

    'nodes' => 'Nœuds à afficher',
    'nodes_helper' => 'Une carte chacun, à côté de l’hôte du panel. Rien de coché n’en affiche aucun — le tableau de bord a déjà un bloc avec tous les nœuds. Chacun est interrogé auprès de son propre daemon : un intervalle court et une longue liste font beaucoup de requêtes.',

    'section_usage' => 'Utilisation',
    'section_host' => 'Ce panel',
    'section_nodes' => 'Nœuds',

    'disk_panel' => 'Le panel vit ici',
    'wings' => 'Wings :version',
    'version_installed' => 'Installée',
    'version_latest' => 'Dernière',
    'version_current' => 'À jour',
    'version_update' => 'Mise à jour disponible',
    'version_unknown' => 'Vérification impossible',

    /*
     * Ce que propose une carte en retard.
     *
     * Un lien vers la publication plutôt qu’un bouton qui met à jour, parce
     * qu’il n’y a rien à mettre à jour d’ici : Pelican n’a pas de commande de
     * mise à niveau, et Wings n’a aucun point d’accès qui remplace son propre
     * binaire. L’indication dit où le travail se fait réellement, pour que
     * personne ne cherche un bouton qui n’a jamais été possible.
     */
    'version_release' => 'Ce qui est nouveau',
    'version_how_panel' => 'Ouvre les notes de version. La mise à niveau du panel se fait sur la machine où il tourne — le panel ne peut pas remplacer ses propres fichiers, et aucun plugin n’a le droit d’exécuter des commandes shell.',
    'version_how_wings' => 'Ouvre les notes de version. Wings se met à jour sur le nœud lui-même — le panel n’a aucun canal vers un programme qui tourne sur une autre machine.',

    'wings_latest' => 'Dernière :version',
    'load_cores' => ':percent % de :cores processeurs',
    'load_windows' => ':five sur 5 min · :fifteen sur 15 min',
    'uptime_since' => 'Depuis :date',
    'unavailable' => 'Non disponible sur cet hôte',

    'fact_os' => 'Système d’exploitation',
    'fact_hostname' => 'Nom d’hôte',
    'fact_php' => 'PHP',
    'fact_cores' => 'Processeurs',
    'fact_processes' => 'Processus',
];
