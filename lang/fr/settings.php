<?php

/*
 * Français. Écrit à la main.
 *
 * « Egg », « nœud », « subuser », « Wings », « queue », « webhook », « topbar »,
 * « cron » et les formats de fichiers restent tels quels : ce sont les mots
 * qu’on retrouve dans Pelican lui-même, sur l’hôte et dans tout ce qui s’écrit
 * à leur sujet. Les noms des styles ne sont pas traduits non plus - un style
 * s’appelle comme il s’appelle, et un nom traduit serait un second nom pour la
 * même chose.
 */

return [
    'shrunk' => 'Une image a été réduite',
    'shrunk_body' => ':name est arrivée en :was et est affichée bien plus petite que cela, donc une copie en :now a été conservée à sa place. Celle que vous avez choisie reste intacte sur votre propre machine.',

    'css_warning' => 'Enregistré, mais ce CSS a l’air incorrect',
    'css_unclosed' => 'Une règle ouverte à la ligne :line n’est jamais fermée. Tout ce qui suit se trouve à l’intérieur de cette règle et ne s’appliquera pas.',
    'css_extra' => 'Il y a une accolade fermante à la ligne :line alors que rien n’est ouvert. Tout ce qui suit est en dehors de toute règle et sera ignoré.',
    'css_comment' => 'Un commentaire ouvert à la ligne :line n’est jamais fermé : le reste du fichier se trouve donc dedans.',

    'modules' => [
        'appearance' => 'L’allure du panel',
        'appearance_helper' => 'Les couleurs, la forme, l’écran de connexion, les annonces, vos propres liens dans la barre latérale, et les pages qui servent à les changer. C’est pour cela que la plupart des panels installent cette extension, et cela ne coûte rien que l’on puisse mesurer.',

        'servers' => 'Sur un serveur',
        'servers_helper' => 'Ce qui apparaît dans un serveur ou à côté de lui dans la liste : la duplication, l’étoile, le bouton console, l’avertissement de sauvegarde, les illustrations, et les pages pour Minecraft, Palworld, ARK et Valheim.',

        'panel' => 'Faire tourner le panel',
        'panel_helper' => 'Ce qui est plein, ce qui s’est arrêté, et ce qui s’est passé. Le bloc du tableau de bord, la page d’état du système, les vues d’ensemble des sauvegardes et des planifications, la capacité, et le journal d’activité.',

        'alerts' => 'Prévenir quelqu’un',
        'alerts_helper' => 'Une sentinelle qui signale un node qui ne répond plus, un disque qui se remplit, une file d’attente arrêtée, un forfait épuisé. Elle envoie vers Discord, par courriel, dans le panel ou à une adresse à vous, et elle tourne sur une minuterie que quelqu’un regarde ou non.',

        'support' => 'Répondre aux clients',
        'support_helper' => 'Un guichet de tickets, dans le panel ou via Modora sur Discord. Il ajoute un bouton d’aide sur chaque page et une table que quelqu’un doit surveiller.',

        'shop' => 'Vendre ce que vous hébergez',
        'shop_helper' => 'Des forfaits, un panier, des factures, trois prestataires de paiement, des renouvellements, des suspensions, du crédit, des améliorations, des options et une liste d’attente. Il crée ses propres tables et il encaisse de l’argent, donc il est désactivé tant que vous ne dites pas le contraire.',

        'outside' => 'Joignable de l’extérieur',
        'outside_helper' => 'Une API avec des clés, des pages d’état publiques que n’importe qui ouvre sans se connecter, et des fichiers gardés sur un CDN ou dans un bucket plutôt que sur cette machine. Chacun est une porte ; désactivée tant que vous ne voulez pas l’ouvrir.',
    ],

    'cost' => [
        'page' => 'Travaille sur chaque page',
        'timer' => 'Tourne sur une minuterie',
        'opened' => 'Seulement quand vous l’ouvrez',
    ],

    'waiting' => [
        'eggs' => 'Activé, et n’affiche rien : nommez d’abord les eggs concernés.',
        'styles' => 'Activé, et n’affiche rien : personne ne peut choisir un style à lui tant que vous n’en proposez aucun.',
        'store' => 'Activé, et garde les fichiers sur cette machine. Pointez vers un CDN ou un bucket pour changer cela.',
        'shown' => 'Activé et répondant 404 : choisissez les serveurs, nœuds ou surveillances qu\'il doit montrer.',
        'granted' => 'Activé, et n’accorde rien : personne n’atteint de serveur par ce biais tant qu’aucun rôle n’est pointé vers un serveur.',
    ],

    'needs' => 'A besoin de :names, qui est désactivé.',
    'lessens' => 'En fait moins sans :names, qui est désactivé.',

    'groups' => [
        'appearance' => 'Apparence',
        'servers' => 'Liste des serveurs',
        'windows' => 'Styles programmés',
        'windows_helper' => 'Un style différent entre deux heures de la journée. Il ne se passe rien tant que vous n’en ajoutez pas un. L’horloge est celle du panel, tirée de son réglage de fuseau horaire, et non celle de chaque lecteur - un panel qui aurait deux allures différentes pour deux personnes au même instant aurait l’air cassé plutôt que programmé. Une plage modifie l’allure que le panel a déjà : elle ne fait donc rien tant que le style est réglé sur « Aucun ». Un style que quelqu’un a choisi pour lui-même l’emporte toujours.',
        'minecraft' => 'Minecraft',
        'ark' => 'ARK',
        'dontstarve' => 'Don\'t Starve Together',
        'enshrouded' => 'Enshrouded',
        'factorio' => 'Factorio',
        'satisfactory' => 'Satisfactory',
        'terraria' => 'Terraria',
        'vrising' => 'V Rising',
        'onset' => 'Onset',
        'craftopia' => 'Craftopia',
        'valheim' => 'Valheim',
        'languages' => 'Langues',
        'files_where' => 'Où les fichiers sont gardés',
        'files_bucket' => 'Le bucket',
        'files_cdn' => 'Le CDN',
        'files_mirror' => 'Les langues, gardées hors du panel',
        'servers_helper' => 'Comment une carte de serveur est dessinée. Qu’elles apparaissent en grille ou en liste est le choix de chacun, sous Compte → Disposition du tableau de bord.',
        'server_pages' => 'Pages de serveur',
        'server_pages_helper' => 'Ce que porte chaque page à l’intérieur d’un serveur, quelle que soit la page.',
        'console' => 'Page de console',
        'console_helper' => 'La police du terminal, sa taille et sa hauteur sont le choix de chacun, sous Compte.',
        'background' => 'Arrière-plan',
        'background_helper' => 'S’applique à tout le panel, y compris à l’écran de connexion.',
        'icons' => 'Icônes',
        'bars' => 'Jauges de ressources',
        'bars_helper' => 'Les barres de processeur, de mémoire et de disque sur les cartes de serveur.',
        'updates' => 'Mises à jour',
        'updates_helper' => 'La version installée et l’état des mises à jour que signale Essentials Auto Updater quand ce plugin est installé.',
        'brand' => 'Marque',
        'login' => 'Écran de connexion',
        'login_helper' => 'S’applique aux écrans de connexion, de réinitialisation de mot de passe et de double authentification.',
        'advanced' => 'CSS personnalisé',
        'advanced_helper' => 'Pour tout ce que les réglages ci-dessus ne couvrent pas. Chargé après tout le reste, il l’emporte donc.',
        'areas' => 'Par zone',
        'areas_helper' => 'Tout ce qui précède s’applique partout. Ici, vous pouvez mettre une zone à part ; ce qui est laissé vide continue de suivre le réglage général.',
        'footer' => 'Pied de la barre latérale',
        'footer_helper' => 'Le bas de la barre latérale, que Pelican laisse vide. Tout ici est inactif tant que vous ne le remplissez pas.',
        'features' => 'Ce que ce plugin ajoute',
        'features_helper' => 'Les parties de cette extension qu’un panel propose se décident sur la page des modules, où elles sont groupées par ce à quoi elles servent plutôt que listées par ordre alphabétique - et où un interrupteur peut dire qu’il est activé et n’affiche encore rien. En désactiver une l’enlève du panel et garde ses réglages, donc on ne perd rien à essayer.',
        'features_open' => 'Ouvrir les modules',
        'identity' => 'Ce plugin dans la barre latérale',
        'identity_helper' => 'L’entrée que ce plugin ajoute à la barre latérale, et l’image dessus.',
    ],

    /*
     * Les pages de réglages, chacune une entrée dans le groupe du plugin dans
     * la barre latérale. Regroupées selon la question à laquelle on répond
     * plutôt que selon la classe qui les implémente.
     */
    /*
     * Où sont mis les fichiers que ce plugin garde.
     *
     * Les mots parlent d’une destination plutôt que d’un prestataire, car les
     * trois mêmes phrases valent pour un bucket comme pour un CDN, et
     * l’administrateur qui met l’un ou l’autre en place ne se soucie pas de
     * savoir lequel il regarde tant que les champs ne diffèrent pas.
     */
    'files' => [
        'where' => 'Les fichiers sont gardés',
        'where_helper' => 'Sur le panel, ils sont posés sur son propre disque, là où ils sont toujours allés, et cela ne demande aucune installation. Ailleurs, c’est un endroit que ce panel n’a pas à tenir, et qui est servi plus près de celui qui regarde. Une destination qui ne répond pas retombe sur le panel plutôt que de perdre un envoi.',
        'panel' => 'Sur ce panel',
        's3' => 'Dans un bucket (S3, R2, MinIO, Wasabi)',
        'cdn' => 'Sur un CDN',
        'read_from' => 'Lire depuis',
        'read_from_helper' => 'L’adresse où un fichier est récupéré, qui n’est pas toujours celle où il a été écrit. Un CDN devant un bucket se met ici, et une adresse de distribution différente de celle de l’API aussi. Vide, la destination se débrouille elle-même.',
        'read_from_https' => 'Commencez ceci par https:// ou laissez-le vide. Une adresse sans cela est lue comme un chemin sur ce panel, et on n’y trouverait donc jamais rien.',

        'bucket' => 'Le bucket',
        'bucket_helper' => 'Tout ce qui parle le protocole S3. L’endpoint et l’option path-style sont ce dont ont besoin ceux qui ne sont pas AWS ; laissez les deux tels quels pour AWS lui-même.',
        'bucket_key' => 'Clé d’accès',
        'bucket_secret' => 'Secret',
        'bucket_name' => 'Nom du bucket',
        'bucket_region' => 'Région',
        'bucket_region_helper' => 'auto convient à R2 et à la plupart des installations à soi. AWS veut la sienne, comme eu-central-1.',
        'bucket_endpoint' => 'Endpoint',
        'bucket_endpoint_helper' => 'Laissez vide pour AWS. R2, MinIO et les autres ont chacun le leur.',
        'bucket_path_style' => 'Adresses en path-style',
        'bucket_path_style_helper' => 'Ce dont ont besoin MinIO et la plupart des installations à soi. AWS et R2 non.',

        'cdn_title' => 'Le CDN',
        'cdn_helper' => 'Un CDN qui parle l’API Modora. Le jeton est un jeton de serveur à serveur et il vaut administrateur complet sur ce compte : il est donc tenu hors d’un fichier de réglages exporté, comme tous les autres identifiants ici.',
        'cdn_base' => 'Adresse',
        'cdn_base_helper' => 'Là où vit l’API. Si les fichiers sont servis depuis ailleurs, mettez cette adresse dans « Lire depuis » ci-dessus.',
        'cdn_token' => 'Jeton',
        'cdn_token_helper' => 'Envoyé dans X-Internal-Token. Quiconque le détient peut écrire et supprimer sur tout le compte.',
        'cdn_folder' => 'Dossier',
        'cdn_folder_helper' => 'Un dossier sous le compte où garder les fichiers de ce panel, pour qu’un seul CDN puisse servir plusieurs panels sans qu’ils se marchent dessus.',

        'move' => 'Déplacer ce qui est encore sur le panel',
        'move_confirm' => 'L’icône de la barre latérale, le fond du panel et le fond de la page de connexion sont copiés vers la destination et leurs adresses réécrites. Les copies sur ce panel sont laissées où elles sont : rien ne casse si vous changez d’avis. Les images envoyées à partir de maintenant vont de toute façon vers la destination ; ceci ne vaut que pour celles qui sont déjà ici.',
        'move_done' => 'Déplacés',
        'move_done_body' => 'Examinés : :looked, déplacés : :moved, impossibles à déplacer : :failed.',
        'check' => 'Tester ceci',
        'check_ok' => 'Cela fonctionne',
        'check_ok_body' => 'Un fichier a été écrit, récupéré par son adresse publique et supprimé à nouveau.',
        'check_bad' => 'Cela n’a pas fonctionné',
        'check_panel' => 'Les fichiers sont réglés pour être gardés sur ce panel : il n’y a rien à tester.',
        'check_refused' => 'La destination a refusé le fichier sans rien dire du pourquoi.',
        'check_unreadable' => 'Elle a pris le fichier, mais il n’a pas pu être relu depuis :url. C’est l’adresse qu’un navigateur utilisera : un fichier que personne ne peut récupérer est une image cassée plus tard. Vérifiez « Lire depuis », et que la destination sert bien les fichiers publiquement.',
        'bucket_missing' => 'La clé, le secret et le nom du bucket sont tous nécessaires avant qu’il y ait quelque chose à tester.',
        'cdn_missing' => 'L’adresse et le jeton sont tous deux nécessaires avant qu’il y ait quelque chose à tester.',
        'cdn_shape' => 'Il a accepté le fichier puis a répondu sous une forme dans laquelle ce panel n’a pas trouvé d’adresse. Ce qu’il a dit : :body',
        'mirror_minutes' => 'Chercher les langues modifiées toutes les',
        'mirror_minutes_helper' => 'En minutes. Chercher ne coûte rien : chaque langue envoyée est lue, hachée et comparée à ce qui a été transmis la dernière fois, si bien qu’un passage ordinaire n’envoie rien du tout. Seule une langue que quelqu’un a modifiée passe sur le réseau.',
        'mirror_now' => 'Copier les langues maintenant',
        'mirror_done' => 'Langues copiées',
        'mirror_done_body' => 'Examinées : :looked, envoyées : :sent, impossibles à envoyer : :failed.',
        'mirror_restore' => 'Restaurer les langues',
        'mirror_restore_confirm' => 'Ceci écrit chaque langue de la copie hors panel par-dessus ce qui se trouve sur ce panel. C’est tout l’intérêt après une mise à niveau, et il n’y a aucun moyen de retirer ensuite une langue installée : cela vaut la peine d’être sûr.',
        'mirror_back' => 'Langues restaurées',
        'mirror_back_body' => 'Trouvées : :found, remises : :put, impossibles à récupérer : :failed.',
    ],

    'pages' => [
        'look' => 'Aspect',
        'look_helper' => 'La couleur, la forme et le nom du panel.',
        'pages' => 'Pages',
        'pages_helper' => 'La liste des serveurs, les pages à l’intérieur d’un serveur, et le terminal.',
        'advanced' => 'Avancé',
        'advanced_helper' => 'Les deux issues de secours : votre propre CSS, et les réglages qui ne valent que pour une zone.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Quels eggs sont Minecraft, et tout le reste à son sujet.',
        'games' => 'Autres jeux',
        'games_helper' => 'Les fichiers que ces jeux gardent à côté de leur monde, sous forme de formulaire plutôt que de texte. Quels serveurs ont une page dépend de la liste d eggs de chaque section : une section sans rien de coché, c est ce jeu déjà désactivé.',
        'languages' => 'Langues',
        'languages_helper' => 'Dans quelles langues ce plugin répond.',
        'files' => 'Stockage et CDN',
        'files_helper' => 'Où sont mis les fichiers que ce plugin garde, et l’adresse depuis laquelle ils sont lus.',
    ],

    'features' => [
        'look' => 'Réglages d’aspect',
        'look_helper' => 'L’entrée de barre latérale pour la couleur, la forme et la marque.',
        'pages' => 'Réglages des pages',
        'pages_helper' => 'L’entrée de barre latérale pour la liste des serveurs, les pages de serveur et le terminal.',
        'advanced' => 'Réglages avancés',
        'advanced_helper' => 'L’entrée de barre latérale pour votre propre CSS et les exceptions par zone.',
        'announcements' => 'Annonces',
        'announcements_helper' => 'Le bandeau en haut du panel.',
        'nav_links' => 'Liens de navigation',
        'nav_links_helper' => 'Vos propres entrées dans la barre latérale.',
        'login' => 'Écran de connexion',
        'login_helper' => 'L’image, l’avis et les liens de l’écran de connexion.',
        'bars' => 'Jauges de ressources',
        'bars_helper' => 'Les barres de processeur, de mémoire et de disque recolorées.',
        'dashboard_status' => 'Ligne de version',
        'dashboard_status_helper' => 'Le haut du bloc du tableau de bord : quelle version est installée et si une autre attend.',
        'dashboard_nodes' => 'Machines',
        'dashboard_nodes_helper' => 'Le reste du bloc du tableau de bord : ce panel et chaque nœud, avec ce que chacun consomme.',
        'system_status' => 'Page État du système',
        'system_status_helper' => 'La page de la machine sur laquelle le panel lui-même tourne.',
        'sidebar_footer' => 'Pied de la barre latérale',
        'sidebar_footer_helper' => 'Votre ligne de texte, la version du panel et un lien, tout en bas de la barre latérale.',
        'console' => 'Bouton de console',
        'console_helper' => 'Le bouton flottant à l’intérieur d’un serveur, avec la console et les boutons d’alimentation dessus, qui joint le nœud directement. La forme qu’il prend se règle dans les réglages des pages ; ceci décide s’il est dessiné du tout.',
        'arranger' => 'Agencement des pages',
        'arranger_helper' => 'Faire glisser les blocs d’une page dans l’ordre que quelqu’un souhaite. Il porte sa propre permission sous Rôles : ceci décide si le panel le propose, et la permission décide à qui.',
        'user_themes' => 'Styles par personne',
        'user_themes_helper' => 'Laisser chacun choisir un style parmi ceux que vous proposez, sous Apparence dans l’espace client. Quels styles sont proposés se règle sur la page Aspect ; ceci décide si la question est posée à quiconque.',
        'api' => 'API',
        'api_helper' => 'Une entrée depuis l’extérieur du panel : une adresse à laquelle un bot Discord ou un script à vous peut demander ce que ce plugin sait - qui joue, quels serveurs n’ont pas de sauvegarde, si un de plus tient sur un nœud. Désactivé n’enregistre aucune route du tout plutôt qu’une qui refuse, ce qui est moins de surface plutôt qu’une quantité plus polie de surface. Toute personne connectée peut demander une clé qui ne répond que pour ses propres serveurs ; en accorder une, en refuser une, en révoquer une que détient quelqu’un d’autre et en délivrer une couvrant tout le panel demandent toutes la permission.',
        'languages' => 'Langues',
        'languages_helper' => 'Répondre à chacun dans la langue réglée sur son propre compte, là où ce plugin a été traduit. Désactivé, tout le monde reçoit l’anglais.',
        'files' => 'Stockage et CDN',
        'files_helper' => 'Garder les fichiers de ce plugin ailleurs que sur le panel : un bucket S3, ou un CDN. Désactivé ne veut pas dire « aucun fichier » - cela veut dire le disque du panel lui-même, là où ils sont toujours allés. Ce que ceci décide, c’est si un autre endroit est proposé du tout. Une destination qui ne répond pas retombe sur le panel plutôt que de perdre un envoi, et une adresse déjà écrite n’est jamais reprise : changer ceci décide où va le prochain fichier, pas où vit le dernier.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Un onglet Minecraft dans la barre latérale, et une page dans chaque serveur Minecraft pour modifier son server.properties sous forme de formulaire. Quels eggs comptent, c’est à vous de le dire.',
        'palworld' => 'Réglages Palworld',
        'palworld_helper' => 'Une page dans un serveur Palworld pour modifier les réglages de son monde. Elle n’apparaît sur aucun autre serveur, et jamais pendant que ce serveur tourne.',
        'settings_search' => 'Recherche dans les réglages',
        'settings_search_helper' => 'Le champ au-dessus de ces formulaires qui les réduit aux sections contenant ce que vous tapez.',
        'preview' => 'Aperçu en direct',
        'waitlist' => 'Liste d’attente',
        'waitlist_helper' => 'Laisser quelqu’un demander à être prévenu quand une offre épuisée est de nouveau en vente. Quand le stock revient, tous ceux qui attendent cette offre sont prévenus en même temps et elle est pour qui achète le premier - rien n’est réservé à personne, et chaque message le dit. Être prévenu retire de la liste : une demande achète une notification et jamais un abonnement permanent. Cela demande la boutique, et c’est la seule chose dans la boutique qui écrive à un client qui n’a rien acheté.',
        'preview_helper' => 'Le cadre à côté du formulaire Aspect qui montre ce que font les couleurs, les angles et les espacements avant de les enregistrer.',
        'duplicate' => 'Dupliquer un serveur',
        'duplicate_helper' => 'Une page pour configurer un autre serveur exactement comme un serveur existant, ou plusieurs d’un coup. Les fichiers ne sont jamais copiés.',
        'favourites' => 'Serveurs en favori',
        'favourites_helper' => 'Une étoile sur chaque carte de serveur. Les serveurs en favori passent en premier, et la liste de chacun est conservée sur le panel - ses étoiles le suivent donc jusqu’au prochain appareil où il se connecte. Cela change ce qu’il voit et rien pour les autres. Être sur le panel veut toutefois dire que c’est un fichier sous storage, que quiconque a accès à la machine peut lire.',
        'artwork' => 'Images des eggs',
        'artwork_helper' => 'La page admin qui va chercher l’image de chaque egg sur Steam ou IGDB et l’écrit dans l’egg lui-même.',
        'alerts' => 'Alertes',
        'alerts_helper' => 'La vérification régulière d’un nœud qui a cessé de répondre, d’un disque qui se remplit, d’un queue worker mort ou d’une version en retard, et le message Discord, panel ou e-mail qu’elle envoie.',
        'backups' => 'Vue des sauvegardes',
        'backups_helper' => 'La page admin qui liste chaque serveur selon le temps écoulé sans sauvegarde. En lecture seule.',
        'public_status' => 'Page de statut publique',
        'public_status_helper' => 'La page que n’importe qui peut ouvrir sans compte. Désactivée, l’adresse répond 404 quoi qu’il y ait sur la liste.',
        'game_players' => 'Joueurs, autres jeux',
        'game_players_helper' => 'Une page dans Rust, ARK, Valheim et tout ce qui répond à la requête de Valve, montrant qui est connecté et depuis combien de temps.',
        'owner_alerts' => 'Prévenir les gens que leur serveur est hors ligne',
        'owner_alerts_helper' => 'La seule partie de ce plugin qui écrit à des gens qui ne sont pas administrateurs : une notification dans le panel quand la machine d’un de leurs serveurs cesse de répondre, et une autre quand elle revient. La cloche du panel, jamais un courriel, et jamais de rappel entre les deux - le répéter tous les quarts d’heure à tout le monde sur un nœud chargé, c’est comme ça que les notifications d’un panel cessent d’être lues. Les subusers ne sont pas prévenus, parce que c’est le propriétaire qui décide quoi faire, et la machine ne lui est pas nommée pour la même raison que la page de statut ne la publie pas. Inactive tant qu’elle n’est pas activée, comme le reste.',
        'my_backups' => 'Avertissement de sauvegarde sur la liste des serveurs',
        'my_backups_helper' => 'Une ligne au-dessus de la liste de serveurs de chacun quand l’un des siens n’a jamais été sauvegardé ou ne l’a pas été depuis un moment. Les cartes de Pelican disent ce qu’un serveur fait maintenant ; rien là-dedans ne dit qu’aucune sauvegarde n’a tourné depuis trois semaines. Dessinée uniquement quand quelque chose est en retard, et elle ne nomme aucun serveur que la personne ne pouvait pas déjà ouvrir.',
        'capacity' => 'Vue de la capacité',
        'capacity_helper' => 'La page admin qui montre la mémoire, le disque et le processeur promis face au disponible sur chaque machine, avec les serveurs à court de sauvegardes, de bases de données ou d’allocations. Promis et non consommé - un nœud peut être chargé et vide, ou inactif et plein.',
        'schedules' => 'Vue des tâches planifiées',
        'schedules_helper' => 'La page admin qui liste toutes les tâches planifiées du panel, les pires en premier - bloquées, en retard, ou jamais lancées. En lecture seule ; tout ce qui en modifie ou en lance une reste sur la page de Pelican pour ce serveur.',
        'activity' => 'Activité du panel',
        'activity_helper' => 'La page admin qui liste chaque événement journalisé du panel, le plus récent en premier, avec qui l’a fait et sur quel serveur. En lecture seule - elle ne supprime rien, et le réglage de Pelican décide toujours de la durée de conservation des lignes.',
        'access' => 'Accès aux serveurs par rôle',
        'access_helper' => 'Une page pour lier un rôle à des serveurs, tenue à jour dans la table des subusers de Pelican. Elle n’accorde rien tant que vous n’associez rien. La désactiver arrête la réconciliation ; l’accès déjà accordé reste, et la page a un bouton pour le reprendre.',
        'scheduled' => 'Styles programmés',
        'scheduled_helper' => 'La section de la page Aspect qui donne au panel un style différent entre deux heures de la journée. Elle ne change rien de ce qui est enregistré - une plage est posée par-dessus les réglages au moment où la page est dessinée, puis relâchée aussitôt - la désactiver rétablit donc l’allure du panel sur-le-champ et ne perd rien.',
        'games' => 'Autres jeux',
        'games_helper' => 'Le fichier de configuration que garde chacun de ces jeux, sous forme de formulaire plutôt que de fichier dans le gestionnaire. Quels serveurs en ont un dépend de la liste d eggs sur la page Autres jeux.',
        'quick' => 'Menu « Aller à »',
        'quick_helper' => 'Un élément en haut de chaque page pour sauter vers un serveur ou vers une page mise en favori, avec un champ de recherche sur toute votre liste de serveurs. Il met aussi en favori la page où vous êtes. Ce que quelqu’un y trouve est ce qu’il pouvait déjà atteindre : cela n’accorde donc rien - le désactiver retire le raccourci et la page Favoris avec lui.',
        'shop' => 'Boutique',
        'shop_helper' => 'Vendre des serveurs depuis le panneau : la boutique et le paiement dans l\'espace client, la page de facturation de chacun, et la page Réglages de la boutique pour la devise, la taxe et les textes. L\'interrupteur principal - désactivé, personne ne peut acheter ni payer, et ce qui a déjà été vendu reste administré par les pages ci-dessous.',
        'packages' => 'Offres',
        'packages_helper' => 'La page d\'administration où l\'on définit ce qui est en vente : un modèle de serveur avec un prix, une période et un stock. Son propre droit, parce que fixer des prix est un autre travail que marquer des factures payées.',
        'orders' => 'Commandes',
        'orders_helper' => 'La page d\'administration listant tout ce qui a été acheté, le serveur que chaque commande est devenue et son état - en attente, active, suspendue, annulée. Son propre droit.',
        'invoices' => 'Factures',
        'invoices_helper' => 'La page d\'administration listant ce qui est dû et ce qui a été payé, avec un bouton pour marquer une facture payée à la main. Son propre droit, parce que ce bouton est l\'endroit où l\'argent est enregistré.',
        'payments' => 'Paiements',
        'payments_helper' => 'Les prestataires de paiement - leurs clés, et chaque tentative passée par eux. Son propre droit, parce que c\'est là que vivent les identifiants : qui peut voir chaque facture n\'a pas forcément à voir le secret.',
        'coupons' => 'Codes promo',
        'coupons_helper' => 'Des codes qui retirent un pourcentage ou un montant fixe de la première facture, avec une expiration et une limite d\'utilisations. Son propre droit.',
        'customers' => 'Clients',
        'customers_helper' => 'La page d\'administration qui retourne la boutique : une ligne par personne ayant acheté, avec ce qu\'elle a, ce qu\'elle a payé et ce qui reste dû. Droit à part, car c\'est la seule page de la boutique qui parle d\'une personne plutôt que d\'une ligne - qui fixe les prix n\'a pas besoin de tout l\'historique d\'un client, et qui répond à un ticket, si.',
        'credit' => 'Crédit et remboursements',
        'credit_helper' => 'L’argent que la boutique garde pour un client. Un remboursement peut repartir vers la carte d’où il venait ou rester sur le compte en crédit ; dans les deux cas un avoir est écrit, et le crédit d’un compte est déduit de la facture suivante automatiquement, avant même qu’on demande au client de payer. Droit à part, car marquer une facture payée enregistre que de l’argent est arrivé, tandis que ceci en distribue.',
        'upgrades' => 'Changement d’offre',
        'upgrades_helper' => 'Déplacer un service en cours vers une autre offre sans en acheter une nouvelle. Ce qui reste de la période déjà payée revient, la même durée est facturée au nouveau prix, et la différence est facturée ou mise sur le compte du client. Chaque offre liste celles vers lesquelles elle peut être déplacée, et seules celles qui partagent son egg sont proposées : un autre egg est un autre serveur, pas un plus grand.',
        'addons' => 'Suppléments',
        'addons_helper' => 'Ce qui se vend à côté d’une offre : plus de mémoire, une sauvegarde de plus, ou quelque chose qui n’est qu’une ligne sur la facture. Chacun dit avec quelles offres il va et ce qu’il ajoute au serveur, et il est facturé soit à chaque renouvellement, soit une seule fois. Acheté au moment de payer ou plus tard sur un service en cours, où il est calculé au prorata de ce qui reste de la période. Droit à part, car ce qu’un supplément peut ajouter au serveur de quelqu’un est une décision sur sa machine plutôt que sur une liste de prix.',
        'tickets' => 'Tickets',
        'tickets_helper' => 'Un endroit où les clients peuvent poser une question depuis l’intérieur du panel, à côté du service dont ils parlent - c’est la seule chose qu’un salon de discussion ne sait pas faire. On y répond sur une page ici, ou via Discord par Modora, selon le réglage de la page Tickets. Chaque question et chaque réponse sont gardées dans ce panel dans les deux cas : rien n’est perdu quand l’autre bout est injoignable. Droit à part, car répondre aux clients est un travail que l’on confie plutôt qu’un travail qui vient avec le fait de fixer le prix des offres.',
        'overview' => 'Vue de la boutique',
        'overview_helper' => 'La page qui répond à ce qui est rentré ce mois-ci, à ce qui est dû, à ce que valent les services actifs chaque mois et à ce qui demande un regard aujourd’hui. Droit à part, car le chiffre d’affaires n’est pas une chose que doit pouvoir lire quiconque a le droit de fixer le prix d’une offre.',
        'terminate' => 'Mettre fin à un service',
        'terminate_helper' => 'Le bouton qui arrête un service maintenant et supprime son serveur, fichiers compris. Séparé du droit sur les commandes à dessein : suspendre, déplacer une échéance et annuler sont réversibles, celui-ci ne l’est pas. Qui répond aux tickets peut avoir les trois premiers sans avoir celui-ci.',
        'public_shop' => 'Page publique de la boutique',
        'public_shop_helper' => 'La page que n\'importe qui peut ouvrir sans compte, listant ce qui est en vente. Elle ne publie rien qu\'un client connecté ne verrait pas dans la boutique, donc activée ou désactivée est toute la décision - désactivée répond 404, comme la page de statut.',
        'pelican_strings' => 'Textes propres à Pelican',
        'pelican_strings_helper' => 'Les pages propres à Pelican dans votre langue là où sa traduction s’arrête. Ses traductions viennent de sa communauté et la plupart sont inachevées ; Essentials ne complète que ce qui manque au Pelican de ce panel, donc chaque texte que Pelican possède garde les mots de Pelican. Désactivé, le reste de Pelican reste en anglais.',
        'log_clock' => 'Journal à l’heure du serveur',
        'log_clock_helper' => 'Le journal du panel est écrit dans le fuseau horaire du serveur lui-même, pour que ses lignes concordent avec nginx et le journal du système. Seul le journal change : Pelican continue de stocker les heures en UTC et de montrer à chaque compte son propre fuseau. Désactivé, le journal reste en UTC, comme Pelican l’écrit.',
    ],

    /*
     * Le champ de recherche au-dessus des formulaires de réglages. Il filtre ce
     * qui est déjà sur la page dans le navigateur et ne demande rien au
     * serveur : il n’y a donc pas d’état « recherche en cours » à décrire, ni
     * de manière pour lui d’échouer.
     */
    /*
     * Le cadre d’aperçu. Tout ce qu’il contient est un substitut et non un
     * échantillon de votre panel, et les mots le disent - un cadre qui nommerait
     * un vrai serveur ou un vrai chiffre serait lu comme tel.
     */
    'preview' => [
        'label' => 'Aperçu',
        'card' => 'Une carte',
        'card_helper' => 'Dessinée par les mêmes règles que le panel, avec les réglages de cette page au lieu de ceux qui sont enregistrés.',
        'button' => 'Un bouton',
        'field' => 'Un champ',
        'meter_ok' => 'Correct',
        'meter_warning' => 'Avertissement',
        'meter_danger' => 'Critique',

        /*
         * L’aperçu en pleine page. Un onglet et non un panneau, parce que
         * Pelican envoie X-Frame-Options: DENY et refuse d’être encadré par
         * quoi que ce soit, y compris par lui-même - voir Support\FullPreview.
         */
        'full' => 'Voir tout le panel',
        'full_confirm' => 'Ouvre le panel dessiné à partir des réglages de cette page plutôt que de ceux qui sont enregistrés. Rien n’est écrit - les valeurs sont gardées quinze minutes et le panel redevient normal quand vous quittez l’aperçu ou enregistrez.',
        'full_go' => 'Montrez-moi',
        'full_failed' => 'L’aperçu n’a pas pu être lancé',
        'bar' => 'Vous regardez des réglages non enregistrés. Rien de tout cela n’a été écrit.',
        'bar_back' => 'Retour aux réglages',
    ],

    'search' => [
        'placeholder' => 'Rechercher dans les réglages',
        'label' => 'Rechercher dans ces réglages',
        'none' => 'Rien ne correspond sur cette page. Les réglages sont répartis sur quatre pages - essayez Aspect, Pages, Avancé, ou Réglages Essentials.',
    ],

    'footer' => [
        'text' => 'Votre propre ligne',
        'text_helper' => 'Texte brut, 120 caractères au plus. Échappé, comme le bandeau d’annonce - ceci s’affiche sur chaque page du panel, ce qui en fait le mauvais endroit pour accepter du balisage.',
        'version' => 'Afficher la version du panel',
        'version_helper' => 'La version de Pelican, pas celle de ce plugin. Le plugin annonce la sienne sur le tableau de bord ; ce qu’on cherche en bas d’une barre latérale, c’est quel panel on a devant soi.',
        'link_label' => 'Texte du lien',
        'link_url' => 'Adresse du lien',
        'link_url_helper' => 'Une adresse http ou https, ou un chemin du panel lui-même comme /account. S’ouvre dans un nouvel onglet.',
    ],

    'layout' => [
        'label' => 'Disposition',
        'helper' => 'Comment le panel est agencé, plutôt que de quelle couleur il est. S’applique à l’espace admin, à la liste des serveurs et à l’espace client. L’emplacement de la navigation est une valeur par défaut : quiconque a réglé la sienne sous Compte → Navigation la garde.',
        'default' => 'Barre latérale - celle de Pelican',
        'rail' => 'Rail d’icônes - étroit, s’ouvre au survol',
        'top' => 'Navigation en haut - pas de barre latérale',
        'mixed' => 'Barre du haut et barre latérale - les deux',
        'wide' => 'Large - le contenu prend tout l’écran',
        'focus' => 'Concentré - colonne étroite, barre latérale repliée',

        'nav_label' => 'Style de la barre latérale',
        'nav_helper' => 'Comment la barre latérale elle-même est dessinée.',
        'nav_default' => 'Par défaut',
        'nav_floating' => 'Flottante - une carte à part',
        'nav_flat' => 'Plate - aucun fond',
        'nav_bordered' => 'Bordée - un trait, pas une surface',

        'topbar_label' => 'Style de la topbar',
        'topbar_helper' => '« Masquée » ne vaut que pour le bureau - sur un téléphone, la topbar porte le seul chemin de retour vers le menu.',
        'topbar_default' => 'Par défaut',
        'topbar_floating' => 'Flottante - une barre détachée',
        'topbar_flush' => 'Affleurante - plate, sans flou',
        'topbar_hidden' => 'Masquée sur le bureau',

        'card_label' => 'Style des cartes',
        'card_helper' => 'Les sections, les widgets, les cartes de serveur et les blocs au-dessus de la console.',
        'card_default' => 'Par défaut - surélevée, bord doux',
        'card_flat' => 'Plate - sans relief',
        'card_outline' => 'Contour - une bordure et rien derrière',
        'card_glass' => 'Givrée - le fond transparaît',
        'card_sharp' => 'Anguleuse - angles droits',
    ],

    'servers' => [
        /*
         * L’étoile sur une carte. Passée au script plutôt qu’écrite dedans, pour
         * que les textes restent au seul endroit où vivent les textes.
         */
        'favourite' => 'Mettre ce serveur en favori',
        'favourited' => 'En favori - affiché en premier',

        /*
         * La pastille à côté des onglets de Pelican. Nommée d’après ce qu’elle
         * fait à la liste plutôt que comme un quatrième onglet, parce qu’elle
         * filtre l’onglet choisi au lieu de le remplacer.
         */
        'favourites_tab' => 'Favoris',
        'favourites_empty' => 'Aucun favori sur cette page. Utilisez l’étoile d’une carte de serveur pour en ajouter un - et notez que ceci filtre les serveurs déjà listés ici : un serveur en favori sur une page suivante n’est pas caché, il n’est simplement pas sur celle-ci.',
        'favourites_failed' => 'Vos serveurs en favori n’ont pas pu être enregistrés : ils ont donc été remis à ce que le panel avait en dernier. La console du navigateur indique ce que la requête a répondu.',

        'art' => 'Image du jeu',
        'art_helper' => 'Pelican dessine l’image de l’egg sur chaque carte. Ceci décide de ce qu’on en fait.',
        'art_faded' => 'Estompée - un voile derrière le texte',
        'art_cover' => 'Couvrante - derrière le nom, en s’estompant',
        'art_off' => 'Désactivée',
        'art_dim' => 'Assombrir l’image',
        'art_dim_helper' => 'L’image d’un jeu est un ciel clair et celle d’un autre une grotte.',

        'status' => 'Marque d’état',
        'status_helper' => 'Où la couleur en marche / démarre / arrêté est montrée.',
        'status_bar' => 'Barre - le long du bord gauche',
        'status_edge' => 'Bord - en travers du haut',
        'status_dot' => 'Point - dans le coin',
        'status_off' => 'Désactivée',

        'density' => 'Hauteur des cartes',
        'density_comfortable' => 'Confortable',
        'density_compact' => 'Compacte - pour beaucoup de serveurs',

        'filter_label' => 'Étiqueter le bouton de filtre',
        'filter_label_helper' => 'Pelican filtre déjà cette liste par egg et par propriétaire, sur toutes les pages - mais l’entrée est une icône sans étiquette à côté du champ de recherche. Ceci y met le mot.',
        'filter_button' => 'Filtres',

        'columns' => 'Cartes de front sur un écran large',
        'columns_helper' => 'Ne vaut que pour la grille, et seulement à partir de 1280px. Le maximum de Pelican est de deux.',
    ],

    'controls' => [
        'mode' => 'Bouton de console sur chaque page de serveur',
        'mode_helper' => 'Un bouton flottant, sur chaque page à l’intérieur d’un serveur. Il ouvre la console par-dessus ce que vous étiez en train de faire, avec l’état et les boutons d’alimentation dans son en-tête - en joignant le nœud directement, comme le fait la liste des serveurs, plutôt que par le websocket de la page de console. Il n’apparaît jamais sur la page de console, qui a déjà tout cela.',
        'mode_full' => 'Console et boutons d’alimentation',
        'mode_console' => 'Console seulement',

        'label' => 'Le bouton affiche',
        'label_text' => 'Icône et nom',
        'label_icon' => 'Icône seule',

        'position' => 'Où il flotte',
        'position_helper' => 'Contre le bord que vous avez le moins de chances d’être en train de lire.',
        'position_top' => 'En haut',
        'position_right' => 'À droite',
        'position_bottom' => 'En bas',
    ],

    'console' => [
        'stats' => 'Blocs au-dessus de la console',
        'stats_helper' => 'Pelican montre le nom, l’état, l’adresse et les trois chiffres d’utilisation au-dessus du terminal. Les masquer rend la hauteur à la console.',
        'stats_tiles' => 'Tuiles - libellé, chiffre et une icône',
        'stats_plain' => 'Simples - tels que Pelican les dessine',
        'stats_off' => 'Masqués',
    ],

    'terminal' => [
        'helper' => 'Transmis au terminal lui-même : ces réglages prennent donc effet au prochain chargement de page plutôt qu’au moment de l’enregistrement.',

        'renderer' => 'Dessiné par',
        'renderer_helper' => 'Pelican dessine le terminal sur le GPU, ce qui est bien plus rapide devant un mur de sortie qui défile. Un navigateur ne garde qu’un certain nombre de contextes GPU en vie à la fois - moins sur un téléphone - et retire le plus ancien une fois la limite dépassée ; le terminal ne dessine alors plus rien du tout, sans la moindre erreur. Si votre console devient blanche alors que tout le reste a l’air normal, c’est ce réglage qu’il faut changer.',
        'renderer_webgl' => 'Le GPU - celui de Pelican, plus rapide',
        'renderer_dom' => 'Le navigateur - plus lent, dessine toujours',

        'scheme' => 'Palette de couleurs',
        'scheme_helper' => 'Le seul réglage de terminal que Pelican ne propose pas. « Suivre le thème » dérive les couleurs de l’accent, et c’est pour cela que ceci existe.',
        'scheme_theme' => 'Suivre le thème',
        'scheme_dracula' => 'Dracula',
        'scheme_nord' => 'Nord',
        'scheme_solarized' => 'Solarized Dark',
        'scheme_gruvbox' => 'Gruvbox Dark',
        'scheme_one_dark' => 'One Dark',
        'scheme_tokyo_night' => 'Tokyo Night',
        'scheme_catppuccin' => 'Catppuccin Mocha',
        'scheme_monokai' => 'Monokai',

        'cursor' => 'Curseur',
        'cursor_helper' => 'La console n’accepte pas la frappe - le champ de commande est en dessous - ceci est donc l’endroit où la sortie s’est arrêtée, et non l’endroit où vous êtes.',
        'cursor_underline' => 'Souligné - celui de Pelican',
        'cursor_block' => 'Bloc',
        'cursor_bar' => 'Barre',

        'blink' => 'Curseur clignotant',

        'scrollback' => 'Historique',
        'scrollback_helper' => 'Jusqu’où la console peut être remontée. Chaque ligne est gardée dans le navigateur : un serveur bavard avec un réglage élevé, c’est de la mémoire bien réelle sur la machine qui lit.',
        'scrollback_lines' => ':lines lignes',
    ],

    'notice' => [
        'text' => 'Message',
        'text_helper' => 'Une ligne, jusqu’à 200 caractères. Il est échappé à l’entrée et à la sortie : il ne peut donc pas porter de balisage sur une page que d’autres chargent.',
        'style' => 'Ton',
        'style_info' => 'Information',
        'style_warning' => 'Avertissement',
        'style_danger' => 'Urgent',
        'style_accent' => 'Couleur d’accent',
        'scope' => 'Montré à',
        'scope_all' => 'Tout le monde',
        'scope_client' => 'Uniquement hors de l’espace admin',
        'scope_admin' => 'Uniquement dans l’espace admin',
        'link_label' => 'Texte du bouton',
        'link_url' => 'Adresse du bouton',
        'link_url_helper' => 'https:// ou un chemin à l’intérieur de ce panel, comme /account. Tout le reste est ignoré - un lien dans un bandeau présent sur chaque page n’est pas un endroit pour un protocole auquel personne ne s’attend.',
        'dismissible' => 'Peut être fermé',
        'dismissible_helper' => 'La fermeture est retenue par navigateur, et seulement pour ce message : changez le texte et il revient pour tout le monde.',
        'dismiss' => 'Fermer',
    ],

    'preset' => [
        'label' => 'Style',
        'helper' => 'Choisissez une allure de départ. Elle remplit tout ce qui suit, que vous pouvez ensuite modifier. « Aucun » désactive le thème et laisse le panel exactement tel que Pelican le livre.',
        'options' => [
            'none' => 'Aucun - pas de thème',
            'legend' => 'Legend - du feu rouge vers l’éclair bleu',
            'ember' => 'Ember - noir chaud, accent orange',
            'midnight' => 'Midnight - bleu profond, calme',
            'crimson' => 'Crimson - rouge, angles nets, compact',
            'forest' => 'Forest - vert, arrondi, sans halo',
            'nebula' => 'Nebula - violet, avec un fond en dégradé',
            'terminal' => 'Terminal - vert sur noir, chasse fixe, net',
            'console' => 'Console - rond et spacieux, pour une tablette',
            'nord' => 'Nord - la palette Nord, sourde',
            'solarized' => 'Solarized - Solarized dark, accent cyan',
            'paper' => 'Paper - clair, fort contraste, plat',
            'daylight' => 'Daylight - clair et chaud, avec un voile doux',
            'mono' => 'Mono - niveaux de gris, plat et dense',
        ],

        'save' => 'Enregistrer comme style',
        'save_confirm' => 'Conserve les couleurs, les angles, l’arrière-plan, la typographie, les icônes et les seuils des jauges que vous avez à l’écran en ce moment - sous un nom à vous, dans le sélecteur à côté de ceux fournis. Il enregistre ce qui est sur la page, et non ce qui a été enregistré en dernier.',
        'save_name' => 'Nom',
        'save_name_helper' => 'Son nom dans le sélecteur. Enregistrer sous un nom déjà utilisé remplace celui-là.',
        'saved' => 'Style enregistré',
        'save_failed' => 'Impossible d’enregistrer ce style',
        'save_full' => 'Il y a de la place pour :max styles à vous. Supprimez-en un d’abord.',

        'delete' => 'Supprimer un style',
        'delete_which' => 'Lequel',
        'delete_confirm' => 'Seuls vos propres styles peuvent être supprimés ; ceux fournis ne le peuvent pas. Rien ne change à l’allure actuelle du panel - un style est un point de départ, et chaque valeur qu’il a posée est déjà dans les réglages ci-dessous.',
        'deleted' => 'Style supprimé',
        'deleted_current' => 'C’était celui sur lequel ce panel était réglé. Ses réglages sont inchangés et toujours sur cette page - choisissez un style, ou enregistrez-les à nouveau sous un nom.',
    ],

    'user_themes' => [
        'label' => 'Styles que les gens peuvent choisir pour eux-mêmes',
        'helper' => 'Les styles cochés apparaissent sur une page Apparence dans l’espace client, où toute personne connectée peut en choisir un pour elle-même. Cela change ce qu’elle voit et rien pour les autres. Rien de coché veut dire que personne ne choisit rien et que le panel garde une seule allure - ce qu’il fait aujourd’hui.',
        'helper_off' => 'Les styles cochés apparaissent sur une page Apparence dans l’espace client, où toute personne connectée peut en choisir un pour elle-même. Les styles par personne sont éteints pour le moment, donc on ne demande à personne. Leur interrupteur se trouve sur la page Modules, et ce que vous cochez ici est conservé et refonctionne dès qu’il est rallumé.',
    ],

    'mode' => [
        'label' => 'Mode du panel',
        'helper' => 'Dans quel mode le panel s’ouvre. Ceux qui n’ont pas choisi eux-mêmes reçoivent celui-ci ; le sélecteur du menu utilisateur leur permet toujours d’en changer, sauf si vous le verrouillez ci-dessous.',
        'dark' => 'Sombre',
        'light' => 'Clair',
        'system' => 'Système - suivre le réglage du visiteur',
    ],

    'font' => [
        'label' => 'Typographie du panel',
        'helper' => 'Chaque option est une famille que le système d’exploitation possède déjà - rien n’est récupéré chez un fournisseur de polices. Le terminal n’est pas concerné : sa police est le choix de chacun, sous Compte.',
        'default' => 'Par défaut - celle de Pelican',
        'mono' => 'Chasse fixe',
        'rounded' => 'Arrondie',
        'serif' => 'Serif',
        'system' => 'Système - celle qu’utilise cette machine',
    ],

    'surface' => [
        'label' => 'Couleur des surfaces',
        'helper' => 'Les cartes et les panneaux. Les teintes plus claires et plus sombres en sont dérivées.',
        'placeholder' => 'Suivre le thème',
    ],

    'radius' => [
        'label' => 'Angles',
    ],

    'accent' => [
        'label' => 'Couleur d’accent',
        'helper' => 'Utilisée pour les boutons, les liens, l’entrée de navigation active et les anneaux de focus.',

        /*
         * Dit, et non imposé. Une couleur signalée ici est quand même
         * enregistrée : c’est le panel de quelqu’un, le chiffre mesure une seule
         * chose, et il y a de bonnes raisons de vouloir un accent qui note mal.
         * Le sélecteur dit ce qu’il voit et s’écarte.
         */
        'contrast_dark' => 'Lisibilité : :ratio face à un panel sombre. En dessous de 3, un accent est difficile à lire comme bouton ou comme lien - un plus clair le fait ressortir.',
        'contrast_light' => 'Lisibilité : :ratio face à un panel clair. En dessous de 3, un accent est difficile à lire comme bouton ou comme lien - un plus sombre le fait ressortir.',
    ],
    'density' => [
        'label' => 'Densité',
        'helper' => 'Compacte resserre les espacements pour faire tenir plus de lignes à l’écran.',
        'comfortable' => 'Confortable',
        'compact' => 'Compacte',
    ],
    'force_dark' => [
        'label' => 'Forcer le mode sombre',
        'helper' => 'Masque le sélecteur clair/sombre et garde tous les utilisateurs sur le thème sombre.',
    ],
    'glass' => [
        'label' => 'Topbar givrée',
        'helper' => 'Rend flous la topbar et les fonds de fenêtres modales. À désactiver sur les appareils modestes.',
    ],
    'glow' => [
        'label' => 'Halo d’accent',
        'helper' => 'Une ombre d’accent douce sur les boutons principaux, la navigation active et la carte de connexion.',
    ],

    'background' => [
        'label' => 'Type d’arrière-plan',
        'helper' => 'Aurora est l’arrière-plan propre au thème : des halos d’accent avec un grain fin.',
        'aurora' => 'Aurora (par défaut)',
        'solid' => 'Une seule couleur',
        'gradient' => 'Dégradé',
        'image' => 'Image',
        'color' => 'Couleur',
        'base' => 'Couleur derrière les halos',
        'base_helper' => 'Ce sur quoi repose la page avant que les halos d’accent ne soient peints par-dessus. Laissez vide pour garder la valeur par défaut du panel, presque noire en sombre et presque blanche en clair. Réglez-la et une palette garde sa propre couleur de nuit tout en restant éclairée.',
        'color_end' => 'Seconde couleur',
        'angle' => 'Direction',
        'upload' => 'Envoyer une image',
        'upload_helper' => 'Jusqu’à 8 Mo. Une image envoyée l’emporte sur l’URL ci-dessous.',
        'url' => 'Ou une URL',
        'url_helper' => 'Doit commencer par https:// et être joignable depuis l’extérieur.',
        'dim' => 'Assombrir',
        'dim_helper' => 'Sans assombrissement, du texte blanc sur une photo claire est illisible.',
        'blur' => 'Flou',
    ],

    /*
     * The plugin's own page, under Updates. Only something to read: the
     * installed version, and what the Essentials Auto Updater reports when it
     * is installed.
     */
    'updates' => [
        'installed' => 'Version installée',
        'state' => 'Mise à jour',
    ],

    /*
     * L’onglet Langues.
     *
     * Attentif à ce qu’il prétend. Pelican laisse déjà chacun choisir une langue
     * pour tout son compte et l’applique déjà ; rien ici ne change cela et rien
     * ne devrait. Ceci décide seulement si les textes propres à ce plugin
     * suivent ce choix.
     */
    'languages' => [
        'section_helper' => 'Pelican laisse déjà chacun choisir une langue pour son compte, et ce plugin la suit partout où il a été traduit. C’est ici que vous décidez lesquelles il suivra. La plupart des langues sont à un pourcentage bas à dessein : ce qui est traduit en premier, c’est la partie que tout le monde voit sur chaque page - les boutons d’alimentation au-dessus d’une console et les jauges des nœuds - et le reste arrive à mesure que les gens y contribuent.',
        'panel' => 'Laisser ceci décider de la langue de tout le panel',
        'panel_helper' => 'Activé, une langue que ce plugin ne porte pas - ou une langue désactivée ci-dessous - met tout le panel en anglais pour ce lecteur, et pas seulement ces pages. Désactivé, seul ce plugin suit la liste et Pelican continue de parler ce à quoi le compte est réglé, ce qui veut dire qu’un lecteur peut croiser deux langues sur un même écran. Aucun compte n’est modifié dans un cas comme dans l’autre : réactivez une langue et il la retrouve.',
        'label' => 'Langues dans lesquelles répondre',
        'helper' => 'Décocher une langue renvoie à l’anglais, pour ce plugin uniquement, les lecteurs dont le compte y est réglé - le reste du panel continue de parler leur langue. L’anglais n’est pas listé, parce que tout se rabat dessus.',
        'under' => 'pas encore proposée - cochez-la pour la proposer quand même',
        'done' => ':percent % traduit',
        'main' => 'Langue principale',
        'main_helper' => 'Ce que reçoit un lecteur quand sa propre langue ne peut pas être utilisée - soit ce plugin ne la porte pas, soit elle est décochée ci-dessous. C’était toujours l’anglais ; dans une équipe qui ne travaille pas en anglais, c’était une mauvaise réponse donnée avec assurance. Elle ne peut pas être décochée ci-dessous, parce que tout se rabat dessus.',
        'labels' => 'Le nom de chaque langue',
        'labels_helper' => 'Le nom que lecteurs et administrateurs voient dans les sélecteurs. Laissez-en un vide pour garder le nom sous lequel ce plugin la connaît. Une langue envoyée sous un nom à vous n’en a aucun : elle serait donc listée sous son code jusqu’à ce que vous lui en donniez un ici.',
        'labels_code' => 'Code',
        'labels_name' => 'Affichée comme',
        'remove' => 'Retirer une langue',
        'remove_which' => 'Laquelle',
        'remove_which_helper' => 'Les langues que quelqu’un a téléversées, et celles que cette extension transporte quand des corrections ont été téléversées par-dessus. Pour celles-là, seules les corrections partent.',
        'remove_confirm' => 'Ce qui a été téléversé sous ce nom part : les textes de cette extension, et aussi ceux du panel là où Pelican ne transporte pas cette langue lui-même. Pour une langue que cette extension transporte, ce ne sont que les corrections, et ce qu’elle livre revient. Cela ne peut pas être annulé d’ici : la seule copie qui reste est celle que garde encore la personne qui l’a faite, et la copie conservée hors du panel est oubliée elle aussi, donc une restauration ne la ramènera pas.',
        'remove_refused' => 'Cette langue est restée où elle était',
        'remove_refused_bad_code' => 'Ce n’est pas un nom qu’une langue peut porter.',
        'remove_refused_shipped' => 'Cette extension transporte cette langue elle-même et rien n’a été téléversé par-dessus, il n’y a donc rien à reprendre.',
        'remove_refused_unknown' => 'Rien n’a jamais été téléversé sous ce nom.',
        'remove_refused_in_use' => 'C’est la langue vers laquelle le panel se rabat. Choisissez d’abord une autre langue principale, puis retirez celle-ci.',
        'remove_refused_stuck' => 'Les fichiers ne sont pas partis. Le panel n’a pas pu écrire dans son propre dossier de langues.',
        'removed' => ':code a été retirée',
        'removed_body' => 'Qui lisait le panel dans cette langue le lit maintenant dans la langue principale.',
        'removed_shipped' => ':code est revenue à ce que livre cette extension',
        'download' => 'Télécharger un fichier de traduction',
        'download_from' => 'Partir de',
        'download_from_helper' => 'Un JSON de tous les textes de ce plugin. Prenez l’anglais pour une langue que personne n’a commencée, ou une langue existante pour poursuivre ce qui est déjà traduit.',
        'download_ready' => ':translated textes sur :total étaient déjà traduits. Le reste est sorti en anglais, et c\'est là que le travail vaut la peine.',
        'code' => 'Code de langue',
        'code_helper' => 'Le code auquel le fichier correspond. Une vraie locale, telle que les comptes l’utilisent - fr, de, pt_BR - atteint les lecteurs dont le compte y est réglé, et doit correspondre exactement, sans quoi elle ne les atteindra pas. Un nom à vous, comme Gaming-FR, est permis et fonctionne autrement : Pelican ne laisse un compte porter qu’une vraie locale, personne ne peut donc sélectionner le vôtre. Il est atteignable comme langue principale ci-dessus, c’est-à-dire ce que reçoit quiconque dont la langue ne peut pas être utilisée.',
        'url' => 'Ou le récupérer à une adresse',
        'url_helper' => 'Une adresse https que le panel peut joindre - un CDN, un bucket, un fichier brut dans un dépôt. Elle est récupérée une fois, à l’enregistrement, et écrite comme le serait un envoi : changer le fichier à cette adresse plus tard ne fait donc rien tant que vous n’enregistrez pas de nouveau. Un fichier choisi ci-dessus l’emporte sur une adresse laissée dans ce champ.',
        'upload' => 'Envoyer un fichier de traduction',
        'upload_helper' => 'Le JSON ci-dessus, avec les valeurs traduites. Il est écrit en dehors du plugin, une mise à jour ne le jettera donc pas, et il est fusionné par-dessus l’anglais clé par clé - un fichier contenant la moitié des textes vous donne une demi-langue et l’anglais pour le reste.',
        'uploaded' => '{1} Un texte installé pour :code|[2,*] :count textes installés pour :code',
        'uploaded_halves' => 'Parmi eux, :mine sont des textes propres à ce plugin et :panel appartiennent au panel. Zéro d’un côté veut dire que cette moitié du fichier ne contenait rien - les clés du plugin commencent par essentials:: et celles du panel non.',
        'uploaded_same' => '{1} L\'autre disait déjà ce que dit ce panneau, il a donc été laissé tel quel.|[2,*] Les :count autres disaient déjà ce que dit ce panneau, ils ont donc été laissés tels quels.',
        'uploaded_skipped' => '{1} :count ligne a été écartée :|[2,*] :count lignes ont été écartées :',
        'upload_failed' => 'Ce fichier n’a pas pu être lu',
        'upload_failed_body' => 'Ce doit être le JSON du téléchargement ci-dessus - un objet plat de clés et de textes. Vérifiez qu’un éditeur ne l’a pas enregistré sous une autre forme.',
    ],

    'windows' => [
        'add' => 'Ajouter une plage',
        'from' => 'De',
        'to' => 'Jusqu’à',
        'to_helper' => 'Plus tôt que le début veut dire qu’elle passe minuit - 22:00 jusqu’à 06:00, c’est la nuit.',
        'preset' => 'Style',
        'days' => 'Jours',
        'days_helper' => 'Laissez-les tous décochés pour tous les jours. Une plage qui passe minuit appartient au jour où elle commence : vendredi 22:00 jusqu’à 06:00 couvre donc le samedi matin.',
        'day_mon' => 'Lundi',
        'day_tue' => 'Mardi',
        'day_wed' => 'Mercredi',
        'day_thu' => 'Jeudi',
        'day_fri' => 'Vendredi',
        'day_sat' => 'Samedi',
        'day_sun' => 'Dimanche',
    ],

    'arranger' => [
        'label' => 'Agencement des pages',
        'helper' => 'Le bouton « Agencer la page », sur chaque page du panel. Quiconque détient la permission Agencer l’obtient et peut aussi définir l’agencement de départ de tous les autres, ou celui d’un rôle. Désactivé, il est masqué pour tout le monde ; les agencements déjà enregistrés restent en place.',
        'roles' => 'Un agencement n’est pas une permission. Un bloc qu’un rôle masque reste un bloc que quelqu’un pourrait atteindre en tapant l’adresse - ce qui l’en empêche, ce sont les permissions de Pelican, sur la page des rôles. Trois couches s’appliquent dans cet ordre : celle de départ commune, puis le rôle du lecteur, puis ce qu’il a déplacé lui-même.',
        'users' => 'Laisser chacun agencer ses propres pages',
        'users_helper' => 'Activé, toute personne connectée peut réagencer et masquer des blocs sur les pages qu’elle voit déjà, pour elle seule - cela ne change rien pour les autres. Définir l’agencement de départ commun reste attaché à la permission Agencer.',

        'launch' => 'Agencer la page',
        'hint' => 'Faites glisser un bloc par sa poignée, ou utilisez l’œil pour le masquer.',
        'drag_to_move' => 'Glisser pour déplacer',
        'show_or_hide' => 'Afficher ou masquer ce bloc',
        'save_layout' => 'Enregistrer l’agencement',
        'reset_page' => 'Réinitialiser la page',
        'done' => 'Terminé',
        'saving' => 'Enregistrement…',
        'saved_own' => 'Enregistré.',
        'saved_everyone' => 'Enregistré pour tout le monde.',
        'saved_role' => 'Enregistré pour :role.',
        'save_failed' => 'Impossible d’enregistrer - voir la console.',
        'reset_done' => 'Réinitialisé.',
        'scope_me' => 'Rien que pour moi',
        'scope_shared' => 'Pour tout le monde',
        'scope_role' => 'Pour :role',
        'that_role' => 'ce rôle',
        'editing_own' => 'Vous modifiez votre propre agencement.',
        'editing_shared' => 'Vous modifiez l’agencement de départ de tout le monde.',
        'editing_role' => 'Vous modifiez l’agencement pour :role.',
    ],

    'brand' => [
        'logo_height' => 'Hauteur du logo',
        'logo_height_helper' => 'Pelican livre 2rem. Des valeurs plus grandes rendent l’en-tête de la barre latérale plus haut avec lui.',
        'logo_url' => 'Remplacer le logo',
        'logo_url_helper' => 'Laissez vide pour garder ce que visent les réglages de Pelican.',
    ],

    'login' => [
        'image' => 'Image de fond',
        'image_helper' => 'Uniquement pour l’écran de connexion. Sans elle, il continue d’afficher le fond du panel.',
        'url' => 'Ou une URL',
        'blur' => 'Flou de la carte',
        'blur_helper' => 'Givre la carte pour que l’image derrière transparaisse.',
        'width' => 'Largeur de la carte',
        'position' => 'Cadrage de l’image',
        'position_helper' => 'Quelle partie de l’image survit au recadrage sur l’écran.',
        'position_center' => 'Centre',
        'position_top' => 'Haut',
        'position_bottom' => 'Bas',
        'position_left' => 'Gauche',
        'position_right' => 'Droite',
        'align' => 'Position de la carte',
        'align_helper' => 'Où la carte de connexion se place en travers de l’écran.',
        'align_center' => 'Centre',
        'align_start' => 'Gauche',
        'align_end' => 'Droite',
        'opacity' => 'Opacité de la carte',
        'opacity_helper' => 'Plus bas laisse passer davantage de l’image à travers la carte.',
        'glow' => 'Halo d’accent',
        'glow_helper' => 'Le halo autour de la carte. Désactivé, elle garde son bord et sa profondeur.',
        'hide_heading' => 'Masquer le titre',
        'hide_heading_helper' => 'Retire le titre au-dessus du formulaire, laissant le formulaire seul.',
        'hide_footer' => 'Masquer le pied de page',
        'hide_footer_helper' => 'Retire la ligne sous la carte qui renvoie vers pelican.dev.',
        'above' => 'Ligne au-dessus du formulaire',
        'above_helper' => 'Une ligne, montrée à quiconque atteint l’écran de connexion. Laissez vide pour aucune.',
        'notice' => 'Avis sous la carte',
        'notice_helper' => 'Une ligne, montrée à quiconque atteint l’écran de connexion. Laissez vide pour aucun.',
        'register' => 'Laisser chacun créer son propre compte',
        'register_helper' => 'Désactivé, et cela le reste tant que vous ne l\'activez pas ici : une mise à jour ne doit jamais ouvrir un panel à des inconnus d\'elle-même. Activé, l\'écran de connexion reçoit un lien vers un formulaire d\'inscription et quiconque atteint votre panel peut se créer un compte. Ils n\'obtiennent aucun serveur et aucune permission, donc ce qu\'ils peuvent réellement faire, c\'est ce que vous avez donné aux personnes sans rôle - vérifiez-le avant d\'ouvrir ceci. Désactivez-le à nouveau et le formulaire cesse d\'exister. Ce n\'est pourtant pas la seule manière d\'entrer : voyez ci-dessous.',
        'register_note' => 'Ligne sous le formulaire d\'inscription',
        'register_note_helper' => 'Une ligne, pour une règle ou pour dire où demander un accès. Texte brut, montré à des personnes qui ne sont pas connectées. Laissez vide pour aucune.',
        'register_oauth' => 'Se connecter crée aussi des comptes',
        'register_oauth_body' => 'Quoi que dise l\'interrupteur ci-dessus, ceux-ci peuvent déjà créer un compte à la première connexion : :names. C\'est un réglage de Pelican lui-même, un par fournisseur, sous Réglages, OAuth, appelé « create missing users ». C\'est là qu\'il faut le désactiver si vous vouliez un panel fermé.',
    ],

    'advanced' => [
        'css' => 'CSS personnalisé',
        'css_helper' => 'Jusqu’à 100 Ko. Enregistré dans storage, pas dans le .env.',
        'reference' => 'Référence CSS',
        'reference_helper' => 'Chaque variable et chaque classe que ce thème et le panel exposent.',
    ],

    'areas' => [
        'add' => 'Ajouter une zone',
        'area' => 'Zone',
        'inherit' => 'Général',
        'radius' => 'Angles',
        'radius_sharp' => 'Nets',
        'radius_normal' => 'Normaux',
        'radius_round' => 'Arrondis',
        'surface' => 'Couleur des surfaces',
        'surface_helper' => 'Les cartes et les panneaux de cette zone ; les teintes plus claires et plus sombres en sont dérivées.',
        'names' => [
            'terminal' => 'Terminal',
            'console' => 'Console (le reste de la page)',
            'files' => 'Page Fichiers',
            'edit' => 'Page d’édition',
            'server' => 'Autres pages et onglets de serveur',
        ],
    ],

    'bars' => [
        'base' => 'Couleur de base',
        'base_green' => 'Vert',
        'base_accent' => 'Couleur d’accent',
        'warning' => 'Orange à partir de',
        'danger' => 'Rouge à partir de',
    ],

    'icons' => [
        'stroke' => 'Épaisseur du trait',
        'stroke_thin' => 'Fin',
        'stroke_normal' => 'Normal',
        'stroke_bold' => 'Gras',
        'scale' => 'Taille',
        'accent' => 'Icônes de menu dans la couleur d’accent',
        'accent_helper' => 'S’applique aux icônes de la barre latérale et de la topbar.',
        'pack' => 'Pack d’icônes',
        'pack_helper' => 'Le jeu dans lequel puise le sélecteur ci-dessous. Tous les jeux d’icônes installés sur le serveur sont proposés, plus le jeu Essentials livré avec ce plugin et tout pack que vous envoyez. Une différence vaut la peine d’être connue : une icône de trait est dessinée dans la couleur du menu et suit le survol et l’entrée active, tandis que les icônes Essentials sont des images et gardent leurs propres couleurs. Cela dépend de ce qu’est le fichier, et non du jeu dont il vient.',
        'pack_custom' => 'Pack envoyé',
        'pack_shipped' => 'Icônes Essentials',
        'use_shipped' => 'Utiliser les icônes Essentials partout',
        'use_shipped_confirm' => 'Règle le pack sur les icônes Essentials et remplit chaque entrée de menu ci-dessous avec l’icône dessinée pour elle - la console reçoit le terminal, le démarrage reçoit le bouton de lancement, et ainsi de suite. Cela remplace les entrées que vous avez maintenant, et rien n’est enregistré tant que vous n’appuyez pas sur Enregistrer : fermer la page l’annule donc.',
        'pack_upload' => 'Envoyer un pack',
        'pack_upload_helper' => 'Un .zip de fichiers SVG. Chaque fichier devient une icône qui porte son nom - logo.svg devient custom-logo. Un envoi remplace le pack en place. Les fichiers de plus de 256 Ko et tout ce qui dépasse 4 000 icônes sont laissés de côté, et on vous dit combien : pour l’échelle, tout le jeu Tabler avoisine les six mille icônes en environ trois mégaoctets - un pack bien plus gros que cela porte donc autre chose que des icônes, et l’essentiel sera ignoré. Un envoi volumineux peut aussi être refusé avant même que ce champ ne dise quoi que ce soit, par upload_max_filesize et post_max_size dans le php.ini de l’hôte du panel - aucun réglage ici ne peut les relever.',
        'pack_partial' => '{1} Une icône installée, mais pas toutes|[2,*] :count icônes installées, mais pas toutes',
        'pack_partial_body' => 'Ignorées : :big trop grandes pour une icône, :unusable inutilisables comme SVG, :duplicate portant un nom déjà pris, :empty sans plus rien à dessiner une fois nettoyées. Un SVG de plus de 256 Ko est presque toujours une image emballée dans un SVG plutôt qu’un dessin - exportez-le à la taille d’une icône et il fera quelques kilo-octets. Une icône sans rien à dessiner ne contenait que quelque chose qui ne sera pas servi ici - si c’est tout un pack, cela vaut la peine d’être signalé.',
        'pack_stopped_files' => 'Il s’est aussi arrêté à la limite du nombre d’icônes qu’un pack peut contenir.',
        'pack_stopped_size' => 'Il s’est aussi arrêté parce que le reste du pack, décompressé, dépasse ce que le panel garde en mémoire d’un coup - le zip peut être plus petit que cela, le SVG se compressant environ cinq fois.',
        'overrides' => 'Remplacer des icônes',
        'overrides_helper' => 'Une ligne par icône à changer. Choisissez l’entrée de menu, puis une icône du pack ci-dessus, donnez une adresse, ou envoyez une image à vous. Si plusieurs sont renseignés, l’envoi l’emporte, puis l’adresse, puis le pack.',
        'overrides_key' => 'Entrée de menu',
        'overrides_value' => 'Icône du pack',
        'overrides_url' => 'Ou une adresse',
        'overrides_url_helper' => 'Une adresse https pour une image que vous hébergez vous-même - un CDN, un bucket, n’importe où que le navigateur puisse joindre. Rien n’est copié sur le panel : remplacer le fichier à cette adresse change donc l’icône sans toucher à cette page ; le revers, c’est une icône qui disparaît en même temps que l’adresse. Elle garde ses propres couleurs, comme une image envoyée.',
        'overrides_file' => 'Ou envoyer une image',
        /*
         * Dit en quoi consiste réellement la différence, parce qu’elle n’est pas
         * évidente et que c’est la raison pour laquelle on choisit l’un plutôt
         * que l’autre.
         */
        'overrides_file_helper' => 'PNG, SVG ou ICO. Une icône du pack est dessinée dans la couleur du menu et suit le survol et l’entrée active ; une image envoyée garde ses propres couleurs et ne le fait pas. Pour un logo, c’est en général ce que l’on veut.',
        'overrides_add' => 'Remplacer une autre icône',
        'overrides_search' => 'Tapez un nom, ou l’entrée de menu…',
    ],

    /*
     * Pas sous « Marque ». La marque parle de l’allure du panel ; ceci parle de
     * la façon dont ce plugin y apparaît, ce qui est une autre question et se
     * répond sur une autre page.
     */
    'identity' => [
        'nav_icon' => 'Icône de l’entrée « Réglages Essentials »',
        'nav_icon_helper' => 'PNG, SVG ou ICO, jusqu’à 8 Mo. Remplace l’icône de cette seule entrée de la barre latérale ; laissez vide pour celle que ce plugin livre. Elle est dessinée comme une image plutôt que comme une icône : elle garde donc ses propres couleurs au lieu de suivre le texte - et c’est en général ce que veut un logo. Le fichier est servi plutôt qu’intégré, chaque navigateur ne le récupère donc qu’une fois ; il vaut quand même la peine d’en exporter un petit : quelques kilo-octets suffisent largement pour une entrée de vingt pixels de haut. Si un envoi échoue avant même que ce champ ne dise quoi que ce soit, la limite qu’il a heurtée est upload_max_filesize dans le php.ini du panel.',
    ],
];
