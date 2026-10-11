<?php

/*
 * Français. Écrit à la main.
 *
 * La page des modules.
 *
 * Un fichier à elle plutôt qu’un coin de settings.php, qui est déjà le plus
 * gros fichier de langue de cette extension.
 */

return [
    'title' => 'Modules',
    'nav_label' => 'Modules',
    'subheading' => 'Ce que cette extension est sur ce panel. Tout ici peut être désactivé, et désactiver quelque chose n’efface jamais ce qui a déjà été noté.',

    'first_title' => 'À quoi sert ce panel ?',
    'first_helper' => 'Répondez une fois et les parties qui vont avec sont activées. Rien n’est figé par là : chaque interrupteur ci-dessous reste le vôtre, et en désactiver un n’efface jamais ce qu’il a déjà noté.',
    'first_look' => 'Surtout son allure',
    'first_look_helper' => 'Les couleurs, l’écran de connexion, les annonces, vos propres liens, et les pages qui servent à les changer. Rien qui vende, réponde ou sorte du panel.',
    'first_run' => 'Faire tourner des serveurs, pour moi ou une équipe',
    'first_run_helper' => 'L’allure, plus ce qu’un serveur montre et ce qui est plein ou arrêté. Pas de boutique, pas de guichet de tickets, et rien qui envoie du courrier sur une minuterie.',
    'first_sell' => 'Vendre de l’hébergement à des clients',
    'first_sell_helper' => 'Tout. Une boutique sans endroit où répondre aux questions, et sans rien qui surveille les nodes, est une demi-boutique.',
    'first_skip' => 'Je les choisirai moi-même',

    'first_left' => 'Laissé tel quel. Les interrupteurs sont tous en dessous.',
    'go' => 'Le configurer',

    'state_on' => 'Activé',
    'state_part' => 'En partie',
    'state_off' => 'Désactivé',

    'count' => '{1} :on partie sur :of activée|[2,*] :on parties sur :of activées',
    'parts' => '{1} La seule partie|[2,*] Les :count parties',

    'health_tables' => 'Ses tables ne sont pas encore là. Enregistrer quoi que ce soit sur cette page les crée.',
    'health_missing' => '{1} Une partie a besoin de quelque chose qui est désactivé|[2,*] :count parties ont besoin de quelque chose qui est désactivé',
    'health_waiting' => '{1} Une partie est activée et n’affiche encore rien|[2,*] :count parties sont activées et n’affichent encore rien',

    'left_access' => '{1} Une personne a encore un serveur accordé ici|[2,*] :count personnes ont encore des serveurs accordés ici',
    'left_public_status' => '{1} Une page publiée et son adresse restent|[2,*] :count pages publiées et leurs adresses restent',
    'left_arranger' => '{1} Une disposition enregistrée reste|[2,*] :count dispositions enregistrées restent',
    'left_user_themes' => '{1} Le style choisi par une personne reste|[2,*] Les styles choisis par :count personnes restent',
    'left_unknown' => 'Quelque chose reste ici, et le panel n’a pas pu lire combien.',
    'cleared' => '{1} Un repris|[2,*] :count repris',
    'clear_failed' => 'Cela n’a pas pu être nettoyé',

    'turn_on' => 'Activer',
    'turn_off' => 'Désactiver',

    'saved' => 'Enregistré',
    'brought' => 'Activées en même temps, car rien ici ne fonctionne sans elles : :names.',
    'save_failed' => 'Impossible d’enregistrer cela',
    'read_only' => 'Vous pouvez regarder ceci sans le modifier. Changer ce que le panel propose demande le droit plus large sur cette extension.',
];
