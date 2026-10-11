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
    'secret_kept' => 'Enregistré. Laissez vide pour le conserver, ou saisissez-en un nouveau.',
    'update_background' => 'Elle tourne en arrière-plan et prend une minute ou deux.',

    /*
     * Le queue worker et le scheduler, dont dépendent toutes les tâches en
     * arrière-plan et toutes les tâches planifiées. Dit séparément, parce qu’ils
     * tombent en panne séparément et que le remède diffère pour chacun.
     */
    'worker_missing' => 'Aucun queue worker n’a répondu. Les installations de modpacks, les e-mails et les autres tâches de fond sont mis en file et exécutés par un processus worker : tant qu’aucun ne tourne, ils sont notés et jamais exécutés, sans la moindre erreur nulle part. Soit il n’y a pas de worker, soit il y en a un qui a été lancé avant l’installation de ce plugin et qui ne peut pas charger son code - dans les deux cas, le redémarrer sur l’hôte du panel règle la chose. Réglez son service pour qu’il redémarre de lui-même, sinon cela reviendra après chaque mise à jour.',
    'cron_missing' => 'Le scheduler du panel n’a pas tourné depuis :for minutes. Les renouvellements et les vérifications du watchdog l’attendent. La ligne cron se trouve dans la documentation de Pelican.',

    /*
     * Nommé d’après la cause plutôt que d’après le symptôme, parce que le
     * symptôme est « il ne s’est rien passé » et que c’est ce qui rendait la
     * chose difficile à situer : les annonces, les liens de navigation, les
     * styles enregistrés et les dispositions de pages sont tous des fichiers
     * sous storage/app, et un dossier où le panel ne peut pas écrire les perd
     * tous sans un mot.
     */
    'storage_failed' => 'Le panel n’a pas pu écrire dans son dossier storage : ceci n’a donc pas été enregistré. Vérifiez que storage/app appartient à l’utilisateur sous lequel tourne le panel. La raison est dans storage/logs.',
];
