<?php

/*
 * Français. Écrit à la main.
 *
 * Le watchdog.
 *
 * Chaque message d’ici est lu sur un téléphone, à trois heures du matin, par
 * quelqu’un qui dormait il y a une minute. Chacun dit donc quelle machine, ce
 * qui ne va pas, et rien d’autre - le détail appartient à la page qu’il ouvrira
 * ensuite, pas à la ligne qui l’a réveillé.
 *
 * Un retour à la normale est écrit comme une nouvelle et non comme une note en
 * bas de page. « Est-ce que c’est revenu » est la question pour laquelle
 * quelqu’un se lèverait autrement.
 *
 * « Node », « Wings », « daemon », « webhook », « queue », « Discord » et
 * « SMTP » restent en anglais : c’est sous ces noms qu’on les retrouve dans
 * Pelican, sur l’hôte et dans tout ce qui s’écrit à leur sujet.
 */

return [
    'title' => 'Alertes',
    'nav_label' => 'Alertes',
    'subheading' => 'Le panel sait déjà quand un nœud cesse de répondre, quand un disque se remplit ou quand la file s’arrête. Ceci est ce qui vous le dit.',

    // ---- les canaux, et ce qu’ils ont fait en dernier ---------------------
    'channels' => 'Où vont les messages',
    'channels_helper' => 'Ce qu’a fait chaque canal la dernière fois qu’on lui a demandé d’envoyer quelque chose. Un canal activé qui refuse en silence ressemble exactement à un panel où rien ne cloche - d’où sa place en haut de la page.',

    'state_off' => 'Inactif',
    'state_untried' => 'Rien n’a encore été envoyé',
    'state_ok' => 'Remis',
    'state_failed' => 'Refusé',

    // ---- quand ------------------------------------------------------------
    'when' => 'À quelle fréquence',
    'when_helper' => 'Les vérifications tournent en arrière-plan : elles ont donc besoin d’un queue worker. Sans lui, rien n’est envoyé et rien ne le dit - utilisez « Envoyer un test », qui ne passe pas par la file.',

    'every' => 'Vérifier toutes les',
    'every_helper' => 'Chaque vérification joint le daemon de chaque nœud : cela fait une requête par nœud et par passage. Quinze minutes suffisent pour entendre parler d’une panne tant qu’elle en est encore une.',
    'every_off' => 'Aucune - pas de vérification du tout',
    'every_five' => '5 minutes',
    'every_fifteen' => '15 minutes',
    'every_thirty' => '30 minutes',
    'every_hourly' => 'Heure',
    'every_daily' => 'Jour',

    'repeat' => 'Me le rappeler tant que cela dure',
    'repeat_helper' => 'Un message part quand quelque chose change, et un autre quand cela revient. Ceci ajoute un rappel tant qu’un problème dure encore. Zéro veut dire aucun rappel - un canal qui se répète toutes les quinze minutes est un canal qu’on met en sourdine.',
    'hours' => 'heures',

    // ---- où ---------------------------------------------------------------
    'where' => 'Canaux',
    'where_helper' => 'Plus d’un est raisonnable. Ils tombent en panne différemment.',

    'discord' => 'Discord',
    'discord_helper' => 'L’endroit où un message est réellement lu par quelqu’un qui ne regarde pas le panel.',
    'webhook' => 'Adresse du webhook',
    'webhook_helper' => 'Dans Discord : Paramètres du serveur → Intégrations → Webhooks → Nouveau webhook → Copier l’URL du webhook. Limité à https, parce que ceci publie laquelle de vos machines est tombée et à quel point son disque est plein.',
    'bot' => 'Votre propre bot',
    'bot_helper' => 'Un seul envoi JSON signé vers une adresse que vous faites tourner, pour que quelque chose hors du panel entende parler d\'un node mort au lieu de demander chaque minute s\'il y en a un. Les webhooks livrés avec Pelican ne peuvent pas porter ceci : ils se déclenchent sur les modèles et sur le journal d\'activité, et un node qui a cessé de répondre n\'écrit ni l\'un ni l\'autre.',
    'bot_url' => 'Où l\'envoyer',
    'bot_url_helper' => 'Limité à https, parce que ceci envoie laquelle de vos machines est tombée vers une adresse sur internet.',
    'bot_secret' => 'Secret de signature',
    'bot_secret_helper' => 'Partagé avec ce qui reçoit ceci. Le corps est haché avec lui et le hachage voyage dans X-Essentials-Signature sous la forme sha256=<hex>, pour que votre bot puisse refuser tout ce qui ne vient pas de ce panel. Rien n\'est envoyé tant que ceci est vide - une signature facultative est une signature que personne ne vérifie.',

    'panel' => 'Dans le panel',
    'panel_helper' => 'Une notification pour tous ceux qui détiennent cette permission. Fonctionne toujours, ne demande aucune configuration, et reste invisible pour quiconque n’est pas connecté.',

    'email' => 'E-mail',
    'email_helper' => 'Séparées par des virgules. Utilise le mailer du panel - fiable quand il est configuré, et complètement silencieux quand il ne l’est pas, ce qui est la seule panne qu’un watchdog ne doit pas avoir. Laissez vide pour le désactiver.',

    // ---- quoi -------------------------------------------------------------
    'what' => 'Ce qui est surveillé',
    'what_helper' => 'Chaque mesure ici est une mesure que le panel prend déjà. Rien sur cette page n’ouvre une connexion que la page État du système n’ouvre pas.',

    'percent_helper' => 'Zéro désactive cette vérification.',
    'disk' => 'Avertir quand le disque d’un nœud dépasse',
    'memory' => 'Avertir quand la mémoire d’un nœud dépasse',

    'maintenance' => 'Avertir d’une maintenance laissée active depuis',
    'maintenance_helper' => 'Un nœud en maintenance est ignoré par toutes les autres vérifications, et c’est juste - c’est aussi ainsi qu’on en oublie un pendant quinze jours. Zéro désactive cela.',

    'versions' => 'Versions du panel et de Wings',
    'versions_helper' => 'Un message quand quelque chose prend du retard, et un quand c’est de nouveau à jour. Pas de rappels - une version n’est pas une panne.',

    'backups' => 'Sauvegardes en retard',
    'backups_helper' => 'Un seul message nommant les serveurs plutôt qu’un par serveur - quand une tâche planifiée s’arrête, tous les serveurs deviennent périmés d’un coup, et quarante messages distincts pour une seule cause font un canal qu’on met en sourdine. Désactivé par défaut : un panel qui sauvegarde à la main plutôt que sur planning se ferait sermonner tous les jours.',
    'backup_days' => 'Une sauvegarde est périmée après',
    'backup_days_helper' => 'C’est aussi ce qu’utilise la page Sauvegardes. Un serveur sauvegardé chaque semaine ne devrait pas être signalé au bout de huit jours.',
    'days' => 'jours',

    'stock' => 'Offres qui s’épuisent',
    'stock_helper' => 'Un seul message nommant les offres plutôt qu’un par offre, et jamais de rappel : qu’une offre soit épuisée est un état ordinaire d’une boutique et non une panne, et l’entendre toutes les quatre heures est exactement ainsi que ceci cesse d’être lu. Seules les offres ayant un plafond sont regardées : une boutique qui vend tout sans limite ne coûte rien à surveiller. Désactivé par défaut, comme le reste.',
    'stock_left' => 'Avertir quand il en reste',
    'stock_left_helper' => 'Compté contre le plafond posé sur l’offre. Une offre doit descendre à ce nombre pour être signalée, et remonter de deux crans au-dessus pour être déclarée saine de nouveau : celle qu’un achat et une annulation poussent d’un côté puis de l’autre ne dit donc rien. Zéro est ici un nombre et non une absence : il garde l’avertissement silencieux et ne laisse que le message qui dit qu’une offre est épuisée.',
    'stock_left_suffix' => 'ou moins',

    'worker' => 'Queue worker',
    'worker_helper' => 'Si quelque chose exécute bien le travail de fond de ce plugin. Notez la circularité : la vérification elle-même tourne sur la file, un panel qui n’a jamais eu de worker ne peut donc pas le signaler. La ligne en haut de cette page, elle, le peut.',

    // ---- les boutons ------------------------------------------------------
    'save' => 'Enregistrer',
    'saved' => 'Enregistré',
    'save_failed' => 'Rien n’a été enregistré',

    'test' => 'Envoyer un test',
    'test_one' => 'Tester',
    'test_off' => 'Ce canal est inactif',
    'test_off_body' => 'Activez-le et enregistrez, et il sera testé avec les autres.',
    'test_title' => 'Message de test',
    'test_body' => 'Si vous lisez ceci, les alertes de votre panel Pelican arriveront ici. Il n’y a aucun problème.',
    'test_sent' => 'Envoyé à tous les canaux actifs',
    'test_failed' => 'Au moins un canal l’a refusé',
    'test_none' => 'Il n’y a nulle part où envoyer',
    'test_none_body' => 'Aucun canal n’est activé : une vraie alerte n’irait donc nulle part non plus.',

    /*
     * Que faire d’un refus.
     *
     * La raison donnée par un fournisseur est brève et exacte, et inutile telle
     * quelle. Les deux qui reviennent presque à chaque fois sont nommées, parce
     * qu’aucune ne se devine depuis le code : un 553 concerne l’expéditeur et
     * non le destinataire, et un 401 de Discord est une URL révoquée ou mal
     * recopiée.
     */
    'hint_email_sender' => 'Votre serveur SMTP a refusé l’adresse depuis laquelle le panel envoie, et non celle à laquelle il envoyait. Sous Admin → Réglages → Mail, l’adresse d’expédition doit être une boîte au nom de laquelle votre compte SMTP a le droit d’envoyer. Cela n’a rien à voir avec ce plugin - le mail de test de Pelican, sur cette même page, échouera de la même façon.',
    'hint_email' => 'Regardez sous Admin → Réglages → Mail. Le bouton de mail de test de cette page utilise les mêmes réglages et dira la même chose.',
    'hint_discord_url' => 'Discord n’a pas reconnu ce webhook. Il a été supprimé, régénéré, ou collé en partie - créez-en un nouveau sous Paramètres du serveur → Intégrations → Webhooks et copiez l’URL entière.',
    'hint_discord' => 'Le panel n’a pas pu joindre Discord. Si ce panel est derrière un pare-feu qui bloque les requêtes sortantes, ce canal ne peut pas fonctionner d’ici.',
    'hint_panel' => 'Personne ne détient la permission pour cela, ou la notification n’a pas pu être stockée. Regardez sous Rôles.',

    'run_now' => 'Lancer les vérifications maintenant',
    'run_started' => 'Vérification en arrière-plan',
    'run_failed' => 'Les vérifications n’ont pas pu être lancées',

    'reset' => 'Oublier ce qu’il sait',
    'reset_confirm' => 'Efface ce que chaque vérification a dit en dernier. Le passage suivant repart de zéro et n’envoie rien : un problème encore en cours sera donc signalé au passage d’après. Utilisez ceci après avoir mis hors service un nœud sur lequel le watchdog insiste encore.',
    'reset_done' => 'Effacé',

    // ---- les messages eux-mêmes -------------------------------------------
    'still' => 'Dure depuis :for.',
    'cleared_body' => 'Cela avait duré :for.',

    'for_unknown' => 'un moment',
    'for_minutes' => ':count minutes',
    'for_hours' => ':count heures',
    'for_days' => ':count jours',

    'node_down' => ':node ne répond pas',
    'node_down_body' => 'Le panel ne joint pas le daemon de :node. Les serveurs qui s’y trouvent ne démarreront pas, ne s’arrêteront pas et ne signaleront rien tant qu’il n’est pas revenu.',
    'node_up' => ':node répond de nouveau',

    'node_disk' => ':node manque d’espace disque',
    'node_disk_body' => 'Le disque de :node est plein à :percent %, au-dessus des :limit % que vous avez fixés. Les sauvegardes et les installations de serveurs sont les premières choses à échouer quand cela arrive en haut.',
    'node_disk_over' => 'Le disque de :node est repassé sous la limite',

    'node_memory' => ':node manque de mémoire',
    'node_memory_body' => 'La mémoire de :node est utilisée à :percent %, au-dessus des :limit % que vous avez fixés. Les serveurs qui s’y trouvent peuvent être tués par le noyau avant que quoi que ce soit ne signale un problème.',
    'node_memory_over' => 'La mémoire de :node est repassée sous la limite',

    'node_maintenance' => ':node est en maintenance depuis longtemps',
    'node_maintenance_body' => ':node est en maintenance depuis plus de :hours heures. Rien d’autre à son sujet n’est vérifié pendant ce temps, et c’est bien le but - mais il vaut la peine de savoir qu’il en est toujours là.',
    'node_maintenance_over' => ':node est sorti de maintenance',

    'wings_behind' => 'Wings sur :node n’est plus à jour',
    'wings_behind_body' => ':node fait tourner Wings :installed, et :latest est sortie. Mettez-le à jour sur le nœud lui-même - le panel n’a aucun moyen de le faire.',
    'wings_current' => 'Wings sur :node est à jour',

    'panel_behind' => 'Le panel n’est plus à jour',
    'panel_behind_body' => 'Ce panel fait tourner :installed, et :latest est sortie.',
    'panel_current' => 'Le panel est à jour',

    'and_more' => 'et :count de plus',

    'owners' => 'Prévenir les gens quand la machine de leur propre serveur est tombée',
    'owners_helper' => 'La seule vérification d’ici qui écrive à quelqu’un d’autre que vous. Le propriétaire de chaque serveur sur une machine qui a cessé de répondre reçoit une notification dans le panel - la cloche, jamais un e-mail - et une autre quand elle revient. Jamais de rappel entre les deux : le répéter tous les quarts d’heure à tout le monde sur un nœud chargé, c’est ainsi que les notifications d’un panel cessent d’être lues. Les subusers ne sont pas prévenus ; le propriétaire est celui qui décide quoi faire. La machine ne leur est pas nommée, pour la même raison que la page de statut ne la publie pas.',

    'owner_down' => '{1} Un de vos serveurs est hors ligne|[2,*] :count de vos serveurs sont hors ligne',
    'owner_down_body' => 'La machine sur laquelle ils se trouvent a cessé de répondre. Quelqu’un a été prévenu. Concernés : :servers',
    'owner_up' => '{1} Votre serveur est de retour|[2,*] :count de vos serveurs sont de retour',
    'owner_up_body' => 'La machine répond de nouveau. De retour : :servers',

    'schedules' => 'Tâches planifiées qui se sont arrêtées',
    'schedules_helper' => 'Une tâche bloquée en cours d’exécution, une dont l’heure est passée parce que le cron ne tourne pas, ou une qui n’a jamais tourné du tout. Pelican n’a de mot pour aucune des trois - une exécution plantée reste « en cours » pour toujours et se dessine exactement comme une exécution en train de tourner. Lit toutes les tâches planifiées actives du panel à chaque vérification.',

    'schedule_stopped' => ':count tâches planifiées se sont arrêtées',
    'schedule_stopped_body' => 'Bloquées depuis plus de :hours heures, en retard, ou jamais lancées : :schedules',
    'schedule_running' => 'Toutes les tâches planifiées tournent de nouveau',

    'stock_out' => '{1} Une offre est épuisée|[2,*] :count offres sont épuisées',
    'stock_out_body' => 'Toujours en vente, et il n’y a plus rien à vendre : :packages',
    'stock_low' => '{1} Une offre est bientôt épuisée|[2,*] :count offres sont bientôt épuisées',
    'stock_low_body' => 'Il en reste :limit ou moins : :packages',
    'stock_back' => '{1} Une offre est de nouveau en vente|[2,*] :count offres sont de nouveau en vente',
    'stock_back_body' => 'Il y a de nouveau quelque chose à vendre : :packages',

    'backup_none' => ':count serveurs n’ont jamais été sauvegardés',
    'backup_none_body' => 'Rien n’a jamais été sauvegardé sur : :servers',
    'backup_none_over' => 'Tous les serveurs ont maintenant une sauvegarde',

    'backup_stale' => ':count serveurs n’ont pas été sauvegardés récemment',
    'backup_stale_body' => 'Aucune sauvegarde réussie depuis :days jours sur : :servers',
    'backup_stale_over' => 'Tous les serveurs ont été sauvegardés récemment',

    'backup_failed' => 'Les sauvegardes échouent sur :count serveurs',
    'backup_failed_body' => 'Une sauvegarde s’est terminée sans succès sur : :servers',
    'backup_failed_over' => 'Plus aucune sauvegarde n’échoue',

    'worker_missing' => 'Rien ne traite la file',
    'worker_missing_body' => 'Un travail a été mis en file et rien ne l’a pris. Les mises à jour de plugins, les installations de modpacks et ces vérifications s’arrêtent toutes tant qu’aucun worker ne tourne - essayez systemctl status pelican-queue sur la machine du panel.',
    'worker_back' => 'La file est de nouveau traitée',
    'failed_title' => ':count travaux ont échoué depuis la dernière vérification',
    'failed_body' => 'Quelque chose que le panel devait faire ne s’est pas produit et ne sera pas réessayé - un serveur non construit, une facture non écrite, un mail non envoyé. Ils sont dans la table failed_jobs ; `php artisan queue:retry all` les y remet, une fois réglé ce qui les a bloqués.',
    'failed_back' => 'Rien n’a échoué depuis la dernière vérification',
    'failed' => 'Me prévenir quand un travail en file échoue',
    'failed_helper' => 'Laravel note un travail qu’il a abandonné et n’en dit rien. Ceci en dit quelque chose. Comptés plutôt que listés : vingt échecs en une nuit ont en général une seule cause.',
];
