<?php

/*
 * Français. Écrit à la main.
 *
 * « Subuser », « Wings », « SFTP », « cron » et « queue worker » restent en
 * anglais : c’est sous ces noms qu’on les retrouve dans Pelican et sur l’hôte,
 * et c’est exactement ce qu’il faut savoir quand une de ces lignes s’affiche.
 */

return [
    'nav_label' => 'Accès aux serveurs',
    'title' => 'Les serveurs par rôle',
    'subheading' => 'Donner à tous les détenteurs d’un rôle l’accès aux mêmes serveurs.',

    /*
     * Dit avant tout le reste sur la page, parce que c’est la seule
     * fonctionnalité d’ici qui écrit dans une table appartenant à Pelican.
     */
    'more' => 'Comment cela fonctionne',
    'warning' => 'Cela fonctionne en tenant à jour les subusers de Pelican — les mêmes lignes que vous ajouteriez à la main sur la page Utilisateurs d’un serveur, celles que lisent la liste des serveurs, les contrôles de permission et Wings. Seules les lignes qu’il a créées sont touchées : ce que vous avez ajouté à la main n’est jamais modifié ni supprimé. Personne ne reçoit d’e-mail quand un rôle lui accorde un serveur. Retirer un accès révoque aussi son SFTP, ce qui demande le queue worker que Pelican réclame déjà.',

    'never' => 'Rien n’a encore été réconcilié. Enregistrez une association ci-dessous et cela se produit aussitôt, puis chaque minute via le cron du panel.',
    'timing' => 'L’accès est retiré au moment où il doit l’être : quelqu’un qui perd un rôle perd les serveurs dès sa page suivante. L’octroi peut prendre jusqu’à une minute, parce que c’est le passage qui cherche les gens qui n’utilisent pas le panel en ce moment.',
    'last_run' => 'Dernier passage il y a :ago secondes : :added ajoutés, :removed retirés, :held laissés en place.',
    'capped' => 'Trop d’un coup — :pairs octrois, et la limite est de :max. Rien n’a été écrit. Resserrez une association : un rôle avec cinquante personnes et vingt serveurs fait mille octrois à lui seul.',

    'which' => 'Les associations',
    'which_helper' => 'Un rôle, les serveurs que ses détenteurs doivent pouvoir atteindre, et ce qu’ils ont le droit d’y faire. Quelqu’un qui a deux rôles obtient tout ce que les deux accordent. Les propriétaires de serveurs et les administrateurs root sont ignorés — ils ont déjà davantage que ce que ceci pourrait leur donner.',
    'add' => 'Ajouter un rôle',

    'role' => 'Rôle',
    'role_helper' => 'Tous ses détenteurs, y compris ceux à qui il sera donné plus tard.',
    'servers' => 'Serveurs',
    'servers_helper' => 'Les serveurs qu’ils obtiennent. En retirer un ici retire à nouveau cet accès.',

    'permissions' => 'Ce qu’ils ont le droit de faire',
    'permissions_helper' => 'Les permissions de subuser de Pelican. Laissez-les telles quelles pour un ensemble raisonnable : la console, les boutons d’alimentation, les fichiers, les sauvegardes et le journal d’activité — et rien qui modifie le serveur, ses utilisateurs, ses bases de données ou ses allocations. « Connect to websocket » est toujours incluse, car sans elle la page de console ne se connecte à rien.',

    'save' => 'Enregistrer et appliquer',
    'saved' => 'Enregistré',
    'saved_body' => ':added accordés, :removed repris.',
    'save_failed' => 'Impossible d’enregistrer',
    'save_failed_disk' => 'La liste n’a pas pu être écrite dans storage. Vérifiez que storage/app appartient à l’utilisateur sous lequel tourne le panel.',

    'revoke' => 'Tout reprendre',
    'revoke_confirm' => 'Retirer tout ce que ceci a accordé ?',
    'revoke_confirm_helper' => 'Chaque ligne de subuser créée par cette page, sur chaque serveur, pour tout le monde — et leur SFTP avec. Les lignes que vous avez ajoutées à la main ne sont pas touchées. Les associations ci-dessous restent : le prochain enregistrement ou le prochain passage les accorderait de nouveau. Videz d’abord la liste si vous le voulez pour de bon.',
    'revoked' => ':count retirés',
    'revoked_body' => 'Uniquement les lignes que cette page avait créées. Ce qui a été ajouté à la main est resté en place.',
    'revoke_failed' => 'Impossible de les retirer',
];
