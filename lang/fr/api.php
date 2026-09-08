<?php

/*
 * Français. Écrit à la main.
 *
 * Une entrée depuis l’extérieur du panel.
 *
 * Deux publics dans un seul fichier, et ils veulent l’inverse l’un de l’autre.
 * Un administrateur qui lit cette page est en train de décider s’il confie une
 * clé à quelqu’un : chaque ligne dit donc ce qu’une clé atteint, et non comment
 * elle s’appelle. Celui qui en demande une veut savoir ce qu’on lui remet et ce
 * qui se passe s’il la perd, et c’est pourquoi la phrase sur la clé montrée une
 * seule fois n’est pas une note de bas de page.
 *
 * Nulle part ici on ne dit « token ». « Clé » est le mot de la page de compte de
 * Pelican, et un panel qui donne deux noms à la même chose est un panel où
 * quelqu’un cherche le mauvais.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Des clés qui permettent à quelque chose hors du panel de demander ce que ce plugin sait. En lecture seule — rien ici ne peut démarrer, arrêter ni joindre un serveur.',

    'my_title' => 'Accès API',
    'my_nav_label' => 'Accès API',
    'my_subheading' => 'Une clé à vous, pour un bot ou un script. Elle ne répond que pour les serveurs que vous pouvez déjà ouvrir.',

    // ---- ce qu’est une clé, dit une fois, là où ça compte ----------------
    'address' => 'L’adresse',
    'address_helper' => 'Envoyez la clé en en-tête Authorization : :example',

    /*
     * La seule chose que quelqu’un doit avoir lue avant de fermer la fenêtre.
     * Écrite comme ce qu’il faut faire plutôt que comme un avertissement, parce
     * que « gardez-la en lieu sûr » est un conseil dont personne ne peut rien
     * faire et « collez-la maintenant là où le bot la lit » en est un.
     */
    'once' => 'C’est la seule fois où cette clé est montrée',
    'once_body' => 'Elle est stockée sous forme de hachage : personne — pas même celui qui fait tourner ce panel — ne peut la relire. Collez-la maintenant là où le bot ou le script la lit. Si elle est perdue, révoquez celle-ci et demandez-en une autre.',
    'copy' => 'Copier',
    'copied' => 'Copié',

    // ---- les états -------------------------------------------------------
    'state' => 'État',
    'state_pending' => 'En attente',
    'state_active' => 'Active',
    'state_refused' => 'Refusée',
    'state_revoked' => 'Révoquée',

    'state_pending_body' => 'Quelqu’un doit l’accorder avant qu’elle ne réponde à quoi que ce soit.',
    'state_refused_body' => 'Cela a été refusé. Rien n’a été délivré.',
    'state_revoked_body' => 'Cette clé a été retirée et ne répond plus.',

    // ---- les portées -----------------------------------------------------
    'scope' => 'Atteint',
    'scope_person' => 'Ses propres serveurs',
    'scope_panel' => 'Tout le panel',

    'scope_person_helper' => 'Ne répond que pour les serveurs que son propriétaire peut déjà ouvrir, demandés de la même manière que le panel les demande. Perdre cette clé ne perd rien que son propriétaire ne pouvait déjà voir.',
    'scope_panel_helper' => 'Répond aux questions qui portent sur tout le panel — chaque nœud, la capacité, le watchdog, la machine du panel elle-même. Pour un bot qui rend compte du panel plutôt que pour une personne.',

    // ---- le tableau ------------------------------------------------------
    'column_name' => 'Pour quoi',
    'column_owner' => 'À qui',
    'column_prefix' => 'Clé',
    'column_asked' => 'Demandée',
    'column_used' => 'Dernière utilisation',
    'column_expires' => 'Expire',

    'never_used' => 'Jamais',
    'no_expiry' => 'Jusqu’à révocation',

    'tab_waiting' => 'En attente',
    'tab_active' => 'Actives',
    'tab_all' => 'Toutes',

    'empty' => 'Pas encore de clés',
    'empty_body' => 'Personne n’en a demandé et aucune n’a été délivrée. Cette page se remplit d’elle-même à mesure que les gens le font.',

    'my_empty' => 'Vous n’avez pas de clé',
    'my_empty_body' => 'Demandez-en une et elle apparaîtra ici avec la réponse qu’on lui aura donnée.',

    // ---- demander --------------------------------------------------------
    'ask' => 'Demander une clé',
    'ask_name' => 'À quoi elle sert',
    'ask_name_helper' => 'Quelques mots, pour distinguer plus tard deux des vôtres et pour que celui qui l’accorde sache ce qu’il accorde.',
    'ask_reason' => 'Ce qu’il vaut la peine d’ajouter',
    'ask_reason_helper' => 'Facultatif. Lu par celui qui décide.',
    'ask_sent' => 'Demandée',
    'ask_sent_body' => 'Elle apparaît ci-dessous dès que quelqu’un a répondu.',
    'ask_granted' => 'Voici votre clé',
    'ask_open' => 'Vous en avez déjà une en attente de réponse',
    'ask_open_body' => 'Une demande à la fois. Annulez celle-là si c’était une erreur.',
    'ask_failed' => 'Cela n’a pas pu être demandé',

    'cancel' => 'Annuler',
    'cancel_confirm' => 'Retire la demande. Rien n’a été délivré, donc rien ne cesse de fonctionner.',

    // ---- décider ---------------------------------------------------------
    'grant' => 'Accorder',
    'grant_confirm' => 'Délivre une clé qui répond pour les serveurs de cette personne, et la montre une fois. Elle voit déjà tout ce que la clé rapportera — ceci décide si quelque chose hors du panel peut demander en son nom.',
    'granted' => 'Accordée',

    'refuse' => 'Refuser',
    'refuse_answer' => 'Ce qu’on leur dit',
    'refuse_answer_helper' => 'Facultatif, et affiché sur leur propre page. Un refus sans raison est un refus qu’on redemande la semaine suivante.',
    'refused' => 'Refusée',
    'collect' => 'Montrer ma clé',
    'state_ready_body' => 'Accordée. Appuyez sur Montrer ma clé pour la voir — une fois, parce qu\'elle est stockée sous forme de hachage et ne peut plus être relue ensuite.',
    'replace' => 'Remplacer',
    'replace_confirm' => 'Cette clé cesse de fonctionner immédiatement et une nouvelle prend sa place, montrée une fois. Il n\'y a aucun moyen de retrouver l\'ancienne — elle n\'a jamais été stockée — donc la remplacer est la seule réponse à sa perte.',
    'granted_body' => 'Elle la récupère elle-même sur sa propre page Accès API. Elle n\'est pas montrée ici : une clé appartient à la personne qui l\'a demandée, pas à celle qui a dit oui.',

    'revoke' => 'Révoquer',
    'revoke_confirm' => 'La clé cesse de répondre immédiatement et son hachage est supprimé : elle ne peut pas revenir. Tout ce qui s’en sert s’arrête. Demandez-en une nouvelle plutôt que de vouloir défaire ceci.',
    'revoked' => 'Révoquée',
    'forget' => 'Retirer',
    'forget_confirm' => 'Enlève la ligne de cette page pour de bon. Elle a déjà cessé de répondre, donc rien de ce qui fonctionne ne s\'arrête - ceci retire seulement la trace de son existence.',
    'forgotten' => 'Retirée',

    'mint' => 'Nouvelle clé',
    'mint_body' => 'Pour un bot plutôt que pour une personne. Elle est accordée au moment même où elle est créée, parce que c’est vous qui l’auriez approuvée.',
    'abilities' => 'Ce qu\'elle peut demander',
    'abilities_helper' => 'Tout est coché au départ, parce que c\'est ce qu\'était une clé avant que ceci existe. Décocher est l\'acte délibéré. Ce qui est stocké est la liste des autorisations, donc une capacité ajoutée dans une version ultérieure est désactivée pour les clés créées avant elle - une capacité que personne n\'a cochée est une capacité que personne n\'a accordée.',
    'ability_health' => 'Prouver que la clé fonctionne',
    'ability_health_helper' => 'N\'atteint rien d\'autre. Sans risque à appeler à intervalles réguliers.',
    'ability_me' => 'Ses propres serveurs',
    'ability_me_helper' => 'Les serveurs que son propriétaire peut déjà ouvrir, et leurs sauvegardes. Elle ne peut jamais voir quelqu\'un d\'autre.',
    'ability_panel' => 'Tout le panel',
    'ability_panel_helper' => 'Chaque node, chaque sauvegarde, les tâches planifiées arrêtées, le watchdog et la machine du panel. Demande aussi une clé qui couvre tout le panel.',
    'ability_live' => 'Interroger un serveur directement',
    'ability_live_helper' => 'Qui joue, et si un serveur tourne. Les seules questions qui coûtent quelque chose — elles joignent un serveur de jeu ou un daemon, en cache quinze à vingt secondes.',
    'ability_connect' => 'Lier des comptes Discord à des comptes du panel',
    'ability_connect_helper' => 'Le seul groupe qui n\'est pas une lecture. Il crée des clés API Pelican sur les comptes des gens qui le demandent et peut mettre fin à un lien. Ne le donnez qu\'au bot qui en a besoin.',
    'own_rate' => 'Requêtes par minute pour cette clé',
    'own_rate_helper' => 'Laissez vide pour suivre le réglage du panel. Un nombre ici ne vaut que pour cette clé. Zéro veut dire aucun plafond — raisonnable pour un bot sur votre propre machine, et une vraie façon de le regretter si la clé va ailleurs.',
    'own_rate_default' => 'Suit le panel',
    'mint_owner' => 'À qui elle est',
    'mint_owner_helper' => 'Une clé répond au nom de quelqu’un. Pour une clé qui couvre tout le panel, ce n’est que la personne qui en répond ; pour une clé personnelle, c’est aussi ce que la clé peut voir.',
    'minted' => 'Créée',
    'profile_tab' => 'API Essentials',
    'profile_make' => 'Une clé pour l\'API Essentials',
    'profile_make_helper' => 'Une API différente de celle du dessus : celle-ci répond sur ce que ce plugin sait — lesquels de vos serveurs n\'ont pas de sauvegarde, qui y joue, s\'ils tournent. Elle répond toujours pour vous seul et n\'atteint que les serveurs que vous pouvez déjà ouvrir.',
    'profile_create' => 'Créer',
    'profile_yours' => 'Vos clés Essentials',
    'profile_manage' => 'Révoquer une clé, voir pourquoi l\'une a été refusée et connecter Discord se font tous sur la page Accès API, dans la barre latérale.',
    'discord' => 'Discord',
    'discord_body' => 'Liez votre compte Discord à celui-ci, pour qu\'un bot puisse répondre pour vos serveurs quand vous le lui demandez. Ce qu\'il reçoit est une clé qui atteint exactement ce que vous pouvez atteindre, et rien de plus.',
    'discord_connect' => 'Connecter Discord',
    'discord_code' => 'Tapez ceci dans Discord dans les dix minutes',
    'discord_code_body' => 'Envoyez :command dans un salon que le bot peut lire. Le code fonctionne une fois. Personne ne peut s\'en servir à part le compte pour lequel il a été fait.',
    'discord_on' => 'Connecté en tant que :name',
    'discord_since' => 'Depuis :when',
    'discord_cut' => 'Déconnecté',
    'discord_cut_confirm' => 'Met fin au lien et supprime la clé qu\'il a créée, donc le bot cesse immédiatement de répondre pour vous. Vous pouvez vous reconnecter quand vous voulez.',
    'discord_off' => 'Non connecté',
    'discord_key_note' => 'La connexion crée sur votre compte une clé API Pelican appelée Discord (Essentials). Vous pouvez la voir, et la révoquer, sous Compte → Clés API — cette page n\'est qu\'un raccourci vers la même chose.',
    'docs_title' => 'Comment utiliser cette API',
    'docs_subheading' => 'Ce à quoi ce panel répond, aux adresses où il répond. Écrit à partir de la même description que celle dont l\'API est construite, donc il ne peut pas avoir une version de retard.',
    'docs_base' => 'Où elle se trouve',
    'docs_endpoints' => 'Points d\'accès',
    'docs_answers' => 'Ce qui revient',
    'docs_calls' => 'Les clés qui peuvent l\'appeler',
    'docs_params' => 'Ce qu\'il faut envoyer',
    'docs_required' => 'obligatoire',
    'docs_optional' => 'facultatif',
    'docs_try' => 'Essayer',
    'docs_errors' => 'Quand quelque chose ne va pas',
    'docs_hook' => 'Ce que le panel vous envoie',
    'docs_hook_body' => 'L\'autre sens, et la seule partie de tout ceci qui arrive sans avoir été demandée. Activée sous Alertes avec une adresse et un secret de signature : un envoi JSON quand le watchdog trouve quelque chose et un quand cela se règle, pour qu\'un bot entende parler d\'un node mort au lieu de demander chaque minute s\'il y en a un.',
    'docs_hook_verify' => 'Le corps est haché avec votre secret et le hachage voyage dans X-Essentials-Signature sous la forme sha256=<hex>. Hachez le corps brut, pas un objet re-sérialisé — la moindre différence d\'espacement ou d\'ordre des clés donne un autre hachage, et l\'écart ressemble à une attaque plutôt qu\'à un bug.',
    'docs_download_md' => 'Télécharger en Markdown',
    'docs_download_json' => 'Télécharger en OpenAPI',

    // ---- ce que règle un administrateur ----------------------------------
    'settings' => 'Comment cela fonctionne',
    'approval' => 'Les demandes attendent d’être accordées',
    'approval_helper' => 'Activé, celui qui demande une clé en reçoit une quand quelqu’un dit oui. Désactivé, il en reçoit une tout de suite — ce qui est raisonnable sur un panel où toute personne ayant un compte est déjà de confiance, et mérite d’être choisi plutôt que subi.',
    'rate' => 'Requêtes par minute, par clé',
    'rate_helper' => 'Un bot qui demande à quarante serveurs qui joue, ce sont quarante questions à quarante serveurs de jeu. C’est le plafond qui empêche une boucle écrite à trois heures du matin de devenir un test de charge.',
    'days' => 'Une clé accordée dure',
    'days_helper' => 'En jours. Zéro veut dire jusqu’à révocation, et c’est la valeur par défaut — une clé qui expire pendant que personne ne regarde, c’est un bot qui s’arrête dans la nuit sans que rien nulle part ne dise pourquoi.',
    'days_never' => 'Jusqu’à révocation',
    'hide_pelican' => 'Retirer l\'onglet des clés API du panel',
    'hide_pelican_helper' => 'Enlève entièrement l\'onglet des clés API du profil du compte, pour qu\'il n\'y ait plus qu\'une seule chose appelée clés API sur cette page. Il est retiré de la page plutôt que masqué, donc il ne reste aucune adresse qui y mène. Une chose qu\'il ne peut pas faire : l\'API client du panel créera encore une clé de compte pour tout ce qui la demande directement — l\'onglet est l\'endroit où les gens en font une à la main, et ceci enlève la main. Les clés qui existent déjà continuent de fonctionner.',

    /*
     * Dit sur la page plutôt que laissé à découvrir. Pelican annule les
     * migrations d’un plugin quand on le désinstalle, et l’unique table de ce
     * plugin part avec elles.
     */
    'uninstall_note' => 'Retirer ce plugin retire toutes les clés avec lui. C’est délibéré — une clé qui survit à ce qui lui répond est un accès que plus personne ne peut révoquer.',
];
