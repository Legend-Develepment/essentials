<?php

/*
 * Français. Écrit à la main.
 *
 * La page de statut publique.
 *
 * La seule chose que ce plugin serve à quelqu’un qui n’est pas connecté, et la
 * seule page dont il faut relire les mots en se disant qu’un inconnu les verra -
 * parce qu’un inconnu les verra. Rien ici ne dit quel nœud, quel propriétaire
 * ni quelle adresse ; un nom, s’il tourne, et combien de gens sont dessus.
 *
 * « Nœud » ne paraît que dans les réglages ; sur la page publique elle-même,
 * c’est « machine », parce que là, c’est quelqu’un qui n’a jamais entendu
 * parler de Pelican qui lit.
 */

return [
    // ---- la page de réglages ---------------------------------------------
    'title' => 'Page de statut publique',
    'nav_label' => 'Page de statut',
    'subheading' => 'Une page que n’importe qui peut ouvrir, sans compte, montrant lesquels de vos serveurs tournent. Rien n’y apparaît tant que vous n’avez pas nommé un serveur ci-dessous.',

    'address' => 'Votre page de statut est en ligne à l’adresse',
    'address_off' => 'Rien n’est encore servi. Ajoutez un serveur, une machine ou un service ci-dessous et enregistrez : l’adresse apparaîtra ici.',

    'which' => 'Ce qui est publié',
    'which_helper' => 'La liste commence vide, et rien n’est public tant qu’elle l’est. Seuls les serveurs que vous pouvez déjà ouvrir sont proposés.',
    'add' => 'Publier un serveur',
    'server' => 'Serveur',
    'shown_as' => 'Affiché comme',
    'shown_as_helper' => 'Ce que le public voit. Tapez-le plutôt que de laisser le panel prendre le vrai nom - « mc-prod-3 (ne pas toucher) » est une note pour vous-même, pas quelque chose à mettre sur un forum.',

    'look' => 'Formulation',
    'look_helper' => 'Tout ce qui est sur cette page est lu par des gens qui n’ont pas de compte.',
    'heading' => 'Titre',
    'heading_helper' => 'Laissé vide, c’est le nom du panel lui-même qui est utilisé.',
    'note' => 'Une ligne au-dessus de la liste',
    'note_helper' => 'Pour dire ce qui se passe - une fenêtre de maintenance, ou où poser une question. Texte brut.',
    'link' => 'Lien vers le panel',
    'link_helper' => 'Un chemin de retour, en bas de la page. Désactivez-le si vous préférez ne pas annoncer où se trouve votre panel.',

    'save' => 'Enregistrer',
    'saved' => 'Enregistré',
    'save_failed' => 'Rien n’a été enregistré',
    'open' => 'Ouvrir la page',

    // ---- nombre de joueurs ------------------------------------------------
    'counts' => 'Nombre de joueurs',
    'counts_helper' => 'D’où viennent les nombres à côté d’un serveur. Les serveurs Minecraft répondent à leur propre handshake et se configurent sous Minecraft ; tout ce qui suit concerne les jeux qui répondent à la requête de Valve - Rust, ARK, Valheim, 7 Days to Die et la plupart de ce qui tourne sur Source ou Unreal.',
    'query_eggs' => 'Les eggs qui répondent à la requête de Valve',
    'query_eggs_helper' => 'Cochez les eggs de ces jeux. Cette même liste décide aussi quels serveurs obtiennent une page Joueurs dans le panel - une question posée pour deux raisons. Rien n’est demandé tant que vous ne le dites pas : c’est la seule chose ici qui ouvre une connexion du panel directement vers un port de jeu, c’est donc un choix et non quelque chose qui se met à arriver. Un serveur dont le port n’est pas joignable depuis le panel n’affiche simplement aucun nombre.',

    // ---- les nœuds --------------------------------------------------------
    'nodes' => 'Machines',
    'nodes_helper' => 'En marche ou à l’arrêt, et rien d’autre. Ni la charge ni le remplissage du disque - quelqu’un qui demande s’il peut jouer n’a pas besoin d’un rapport de capacité sur votre matériel, et en publier un revient à dessiner la carte des endroits qui tirent.',
    'add_node' => 'Publier une machine',
    'node' => 'Machine',
    'node_shown_as_helper' => 'Tapez-le. Un nœud s’appelle en général quelque chose comme hetzner-fsn1-01, et c’est une phrase entière sur l’endroit où sont vos machines.',

    // ---- les moniteurs HTTP -----------------------------------------------
    'monitors' => 'Autres services',
    'monitors_helper' => 'Tout le reste dont il vaut la peine de savoir que cela tourne : votre site, une API, le point de santé d’un bot. Le panel interroge chacun au même rythme que les serveurs. Administrateurs seulement - un moniteur fait aller ce panel chercher une adresse, et laisser n’importe qui en ajouter un en fait une sonde qu’on peut pointer où l’on veut.',
    'add_monitor' => 'Ajouter un service',
    'monitor_name' => 'Nom',
    'monitor_url' => 'Adresse',
    'monitor_url_helper' => 'https uniquement. Si ce panel allait chercher du http en clair à intervalle régulier, tout le monde sur le chemin saurait lesquels de vos services existent.',
    'monitor_expect' => 'Attendu',
    'monitor_expect_helper' => 'Laissez vide pour « n’importe quelle réponse », ce qui convient à un site qui redirige ou qui répond 403 à une requête nue. Un nombre est fait pour un point d’accès écrit pour dire exactement cela et rien d’autre - trop strict, la ligne reste rouge pour toujours sur un service qui va bien.',

    // ---- les pages des utilisateurs ---------------------------------------
    'users' => 'Pages pour vos utilisateurs',
    'users_helper' => 'Si les gens qui ont des serveurs sur ce panel peuvent publier une page de statut à eux.',
    'user_pages' => 'Laisser les utilisateurs créer la leur',
    'user_pages_helper' => 'Chacun obtient une adresse à lui sur /status/son-identifiant, ne montrant que les serveurs qu’il possède, sous les noms qu’il tape. Aucune machine et aucun autre service dessus - les deux n’appartiennent qu’à vous. Une fois ceci activé, ils le trouveront sous « Page de statut » dans le menu de leur compte, quel que soit le panel où ils se trouvent.',

    // ---- l’allure ---------------------------------------------------------
    'every' => 'Vérifier toutes les',
    'every_helper' => 'À quelle fréquence la page se reconstruit, et à quelle fréquence elle se rafraîchit dans le navigateur. Une page que les gens regardent pendant un redémarrage veut des secondes ; une page liée depuis un forum que personne n’a ouverte veut une heure - et interroger chaque nœud chaque minute pour elle, c’est du travail fait pour personne.',
    'every_realtime' => 'Temps réel (10 secondes)',
    'every_30s' => '30 secondes',
    'every_1m' => '1 minute',
    'every_5m' => '5 minutes',
    'every_10m' => '10 minutes',
    'every_30m' => '30 minutes',
    'every_60m' => '60 minutes',

    'style' => 'Style',
    'style_helper' => 'Une des allures du panel, appliquée à cette page : sa couleur, les gris construits à partir de sa surface, et l’arrondi des angles. « Suivre le panel » veut dire celle qui y est réglée aujourd’hui, y compris tout changement ultérieur.',
    'style_mine_helper' => 'Les styles que ce panel propose, appliqués à votre page : une couleur, les gris construits à partir d’elle, et l’arrondi des angles. Quels styles figurent sur cette liste, c’est au propriétaire du panel d’en décider - la même liste que celle où vous choisissez sous Apparence. « Suivre le panel » veut dire celle qui y est réglée.',
    'style_panel' => 'Suivre le panel',

    // ---- la page de quelqu’un ---------------------------------------------
    'mine_title' => 'Ma page de statut',
    'mine_nav_label' => 'Page de statut',
    'mine_subheading' => 'Une adresse à donner aux gens qui jouent sur vos serveurs. Elle montre les serveurs que vous choisissez et rien d’autre de ce panel.',
    'mine_address' => 'Votre adresse',
    'mine_address_helper' => 'Prenez quelque chose de court. La changer plus tard casse tous les liens que quelqu’un a déjà enregistrés.',
    'mine_address_off' => 'Choisissez une adresse ci-dessous et enregistrez : votre page apparaîtra ici.',
    'slug' => 'Adresse',
    'slug_helper' => 'Minuscules, chiffres et traits d’union. Trois caractères ou plus.',
    'mine_heading' => 'Titre',
    'mine_heading_helper' => 'Laissé vide, c’est votre adresse qui est utilisée.',
    'mine_note_helper' => 'Pour dire ce qui se passe - un redémarrage, un événement, où vous trouver. Texte brut, et lu par quiconque a le lien.',
    'mine_which' => 'Vos serveurs',
    'mine_which_helper' => 'Seuls les serveurs qui vous appartiennent sont proposés. Être subuser ailleurs, c’est un accès à une machine, pas la permission de publier qu’elle existe.',
    'mine_shown_as_helper' => 'Ce que voient les visiteurs. Tapez-le plutôt que d’utiliser le nom du panel si ce nom est une note pour vous-même.',
    'mine_look_helper' => 'L’allure de votre page pour les gens à qui vous l’envoyez.',
    'mine_remove' => 'Retirer ma page',
    'mine_remove_confirm' => 'Retire votre page et libère l’adresse pour quelqu’un d’autre. Tout ce que vous avez réglé est perdu ; les serveurs eux-mêmes ne sont pas touchés.',
    'mine_removed' => 'Votre page a été retirée',

    'why_slug' => 'Cette adresse ne convient pas. Minuscules, chiffres et traits d’union, trois caractères ou plus - et quelques mots sont réservés.',
    'why_taken' => 'Quelqu’un d’autre a déjà cette adresse.',
    'why_unwritable' => 'Cela n’a pas pu être écrit. Vérifiez que storage/app appartient à l’utilisateur sous lequel tourne le panel.',

    // ---- les titres sur la page elle-même ---------------------------------
    'section_servers' => 'Serveurs',
    'section_nodes' => 'Machines',
    'section_monitors' => 'Services',

    // ---- la page elle-même ------------------------------------------------
    'up' => 'En ligne',
    'down' => 'Hors ligne',
    'starting' => 'Démarre',

    /*
     * Pas « hors ligne », et la différence compte en public.
     *
     * Le panel n’a pas pu joindre le serveur. C’est en général un nœud en
     * maintenance ou un daemon qui redémarre - ce n’est pas la même chose qu’un
     * serveur éteint, et dire à cent joueurs que leur serveur est tombé alors
     * qu’il tourne est pire que d’avouer ne pas savoir.
     */
    'unknown' => 'Inconnu',

    'players' => 'Joueurs',
    'online_now' => 'jouent en ce moment',
    'checked' => 'Vérifié',
    'next_check' => 'avant la prochaine vérification',
    'just_now' => 'à l’instant',
    'seconds_ago' => 'il y a :count secondes',
    'panel' => 'Se connecter',

    'all_up' => 'Tout tourne.',
    'some_down' => 'Quelque chose ne tourne pas.',
    'empty' => 'Rien n’est encore publié ici.',
];
