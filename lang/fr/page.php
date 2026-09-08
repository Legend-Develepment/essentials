<?php

/*
 * Français. Écrit à la main.
 *
 * « Queue worker », « scheduler », « cron », « canal » et les chemins comme
 * storage/app restent tels quels : ce sont les noms sous lesquels on les
 * retrouve sur le serveur et dans la documentation de Pelican, et c’est
 * exactement ce dont on a besoin quand un de ces messages s’affiche.
 */

return [
    'title' => 'Réglages Essentials',
    'nav_label' => 'Réglages Essentials',
    'save' => 'Enregistrer',
    'saved' => 'Réglages enregistrés',
    'save_failed' => 'Impossible d’enregistrer les réglages',
    'update' => 'Mettre à jour',
    'update_available' => 'Une mise à jour est disponible',
    'update_confirm' => 'Le panel télécharge la nouvelle version, reconstruit ses assets et vide ses caches. Vos réglages sont conservés.',
    'update_started' => 'Mise à jour lancée',
    'update_background' => 'Elle tourne en arrière-plan et prend une minute ou deux.',
    'update_failed' => 'Impossible de mettre le thème à jour',
    'update_done' => 'Thème mis à jour',
    'check' => 'Chercher des mises à jour',
    'check_failed' => 'Impossible de lire le flux de mises à jour',
    'check_failed_body' => 'Le panel n’a pas pu le joindre, ou il n’a pas renvoyé de JSON valide.',
    'up_to_date' => 'Vous êtes sur la dernière version',
    'reinstall' => 'Réinstaller',

    'auto_on' => 'Les mises à jour s’installent toutes seules',

    /*
     * Ce qu’a fait la dernière vérification automatique. Chacune de ces lignes
     * nomme la partie qu’il faudrait aller regarder, parce que depuis un
     * navigateur les trois façons dont cela tourne mal se ressemblent toutes :
     * un nombre qui décompte.
     */
    'auto_never' => 'Aucune vérification n’a encore eu lieu. Les mises à jour automatiques ont besoin du scheduler du panel — l’entrée cron qui lance php artisan schedule:run chaque minute. Sans elle, rien de planifié ne se produit du tout.',
    'auto_ago' => 'Dernière vérification :ago',
    'auto_just_now' => 'à l’instant',
    'auto_minutes' => 'minutes',
    'auto_current' => 'rien de plus récent sur ce canal.',
    'auto_installed' => 'v:version a été installée ici même, par la vérification planifiée elle-même. Elle le fait quand aucun queue worker ne répond : la mise à jour a donc lieu quoi qu’il arrive — mais un panel sans worker est un panel où le reste du travail en file ne se fait pas non plus.',
    'auto_queued' => 'v:version a été confiée au queue worker. Si la version ci-dessus ne change pas d’ici quelques minutes, le worker prend bien des tâches mais échoue sur celle-ci — le redémarrer est le remède habituel, et la raison est dans storage/logs.',
    'auto_unreachable' => 'le flux de mises à jour n’a pas pu être lu. Il est récupéré par internet : c’est donc en général un problème de réseau ou de DNS sur l’hôte du panel.',
    'auto_error' => 'la vérification a échoué. La raison est dans storage/logs.',

    /*
     * Le queue worker, qui est ce qui exécute réellement une mise à jour. Dit
     * séparément de la vérification ci-dessus, parce qu’ils tombent en panne
     * séparément et que le remède diffère pour chacun.
     */
    'worker_missing' => 'Aucun queue worker n’a répondu. Les mises à jour et les installations de modpacks sont mises en file et exécutées par un processus worker : tant qu’aucun ne tourne, elles sont notées et jamais exécutées, sans la moindre erreur nulle part. Soit il n’y a pas de worker, soit il y en a un qui a été lancé avant l’installation de ce plugin et qui ne peut pas charger son code — dans les deux cas, le redémarrer sur l’hôte du panel règle la chose. Réglez son service pour qu’il redémarre de lui-même, sinon cela reviendra après chaque mise à jour.',

    'next_check' => 'Prochaine vérification dans',
    'due_now' => 'attendue maintenant',

    /*
     * Nommé d’après la cause plutôt que d’après le symptôme, parce que le
     * symptôme est « il ne s’est rien passé » et que c’est ce qui rendait la
     * chose difficile à situer : les annonces, les liens de navigation, les
     * styles enregistrés et les dispositions de pages sont tous des fichiers
     * sous storage/app, et un dossier où le panel ne peut pas écrire les perd
     * tous sans un mot.
     */
    'storage_failed' => 'Le panel n’a pas pu écrire dans son dossier storage : ceci n’a donc pas été enregistré. Vérifiez que storage/app appartient à l’utilisateur sous lequel tourne le panel. La raison est dans storage/logs.',

    /*
     * Dit après chaque mise à jour échouée, et pas seulement après une
     * discordance d’identifiants. Le message ci-dessus nomme déjà la cause ;
     * celui-ci nomme le seul remède qu’on ne peut pas déduire de « attendu X,
     * obtenu Y ».
     */
    'update_renamed' => 'Si cela dit que deux identifiants ne correspondent pas, c’est que le plugin a été renommé, et aucune mise à jour ne franchit cela — Pelican reconnaît un plugin installé à son identifiant. Désinstallez l’ancienne entrée sous Admin → Plugins et installez celui-ci à neuf. Vos réglages survivent : ils vivent dans .env et dans storage/app/private/legend-theme, et ni l’un ni l’autre n’est indexé par l’identifiant.',
];
