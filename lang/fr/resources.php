<?php

/*
 * Français. Écrit à la main.
 *
 * « Mod », « plugin », « loader », « jar » et les noms de dossiers mods/ et
 * plugins/ restent tels quels : ce sont les mots sur Modrinth, dans le
 * gestionnaire de fichiers et dans tout tutoriel qu’on trouve à ce sujet.
 */

return [
    'nav_label' => 'Mods et plugins',
    'title' => 'Mods et plugins',
    'subheading' => 'Un à la fois, depuis Modrinth, dans ce serveur.',

    'section' => 'Trouver quelque chose',
    'section_helper' => 'La page Modpacks installe un pack entier d’un coup. Ici, on installe un seul mod ou plugin - et c’est ce qu’on veut bien plus souvent.',

    'kind' => 'Qu’ajoutez-vous',
    /*
     * Demandé plutôt que déduit. Un egg s’appelle comme un administrateur l’a
     * appelé, et plusieurs loaders lisent les deux dossiers : il n’y a donc
     * aucun moyen honnête de le deviner d’ici - et se tromper écrit une jar
     * dans un dossier que rien ne lit.
     */
    'kind_helper' => 'Un mod va dans mods/ et concerne Fabric, Forge ou NeoForge. Un plugin va dans plugins/ et concerne Bukkit, Spigot ou Paper. Cela décide aussi quelle moitié de Modrinth est fouillée.',
    'kind_mod' => 'Un mod (mods/)',
    'kind_plugin' => 'Un plugin (plugins/)',

    'search' => 'Rechercher',
    'search_helper' => 'Tapez un nom puis cliquez hors du champ. Les résultats sont classés par nombre de téléchargements.',

    'project' => 'Mod ou plugin',
    'version' => 'Version',
    'version_helper' => 'Chaque ligne indique le numéro de version, les versions de Minecraft pour lesquelles elle est construite et les loaders pris en charge. Choisissez-en une qui correspond à votre serveur - rien ici ne le vérifie pour vous.',

    'install' => 'Installer',
    'install_confirm' => 'Le fichier est récupéré par le nœud directement chez Modrinth et déposé dans le dossier. Rien de ce qui s’y trouve déjà n’est retiré.',
    'installed' => 'Installé',
    'installed_helper' => 'Il se charge au prochain démarrage du serveur.',

    'change' => 'Changer de version',
    'change_helper' => 'Met une autre version du même projet à la place de ce fichier. La nouvelle est téléchargée avant que l’ancienne ne soit supprimée : un téléchargement raté vous laisse donc avec ce que vous aviez déjà.',
    'change_project_helper' => 'Fixé pour tout ce qui a été installé depuis cette page. Le changer ne serait pas un changement de version - ce serait un autre mod sous le même nom de fichier.',
    'change_lookup_helper' => 'Ce fichier était déjà dans le dossier : rien ici ne sait donc ce qu’il est. Cherchez-le une fois et il sera retenu.',
    'changed' => 'Version changée',

    'check' => 'Chercher des mises à jour',
    'checked' => 'Vérifié',
    'checked_none' => 'Tout ce qui est connu est dans sa version la plus récente.',
    'checked_some' => ':count ont une version plus récente. Ils sont signalés dans la liste.',
    'update_ready' => 'v:number disponible',
    /*
     * Dit à côté du badge plutôt que dans une infobulle, parce que cela change
     * ce que le badge veut dire : rien ici ne sait quelle version de Minecraft
     * ni quel loader le serveur fait tourner.
     */
    'check_note' => 'Plus récent veut dire plus récent sur Modrinth. Rien ici ne sait quelle version de Minecraft ni quel loader votre serveur fait tourner : vérifiez donc que la version choisie se déclare compatible avant de démarrer le serveur.',
    'unknown' => 'Pas installé d’ici - utilisez « Changer de version » pour dire ce que c’est',

    'remove' => 'Retirer',
    'remove_confirm' => 'Le fichier est supprimé du serveur. Cela ne peut pas être annulé d’ici.',
    'removed' => 'Retiré',

    'running' => 'Le serveur est en marche',
    'running_helper' => 'Minecraft lit mods/ et plugins/ une seule fois, au démarrage. Un fichier ajouté maintenant ne se chargerait qu’après un redémarrage, et un fichier retiré sous les pieds d’un jeu en marche peut emporter le jeu avec lui. Arrêtez d’abord le serveur.',

    'failed' => 'Cela n’a pas fonctionné',
    'failed_version' => 'Cette version n’a aucune jar que ceci puisse installer. Certaines publications ne contiennent que des sources, ou qu’un build client.',
    'failed_write' => 'Le nœud a refusé le téléchargement. Il n’a peut-être pas pu joindre Modrinth.',

    'installed_title' => 'Installés',
    'installed_mods' => 'Dans mods/',
    'installed_plugins' => 'Dans plugins/',
    /*
     * Dit parce qu’une liste vide est ambiguë : elle veut dire le plus souvent
     * que ce serveur n’utilise pas ce dossier du tout, et non qu’il manque
     * quelque chose.
     */
    'installed_empty' => 'Rien ici. Un serveur n’utilise qu’un seul de ces deux dossiers : que l’un soit vide est normal.',
    'installed_note' => 'Seuls les fichiers .jar sont listés. Les dossiers de configuration et les fichiers désactivés sont laissés tels quels et ne sont pas affichés.',
];
