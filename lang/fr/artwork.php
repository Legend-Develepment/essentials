<?php

/*
 * Français. Écrit à la main.
 *
 * « Steam App ID », « IGDB », « Twitch client ID » et « client secret » restent
 * en anglais : ce sont exactement les mots qui figurent sur les pages d’où
 * viennent ces valeurs.
 */

return [
    'title' => 'Images des eggs',
    'nav_label' => 'Images des eggs',
    'subheading' => 'Les images de jeu de vos eggs : depuis la bibliothèque d’illustrations Essentials, Steam ou IGDB, ou l’une des vôtres. Un egg sans image affiche l’oiseau de Pelican sur chaque carte de serveur qui l’utilise.',

    // ---- le tableau ------------------------------------------------------
    'column_name' => 'Egg',
    'column_library' => 'Bibliothèque',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'Verrouillée',

    'locked' => 'Verrouillée',
    'unlocked' => 'Libre',
    'fetch_library' => 'Bibliothèque',
    'library_logo' => 'Logo',
    'library_logo_helper' => 'Tapez pour chercher dans la bibliothèque d’illustrations Essentials. Le logo qui porte le nom de cet egg est prérempli s’il en existe un. En choisir un verrouille l’image, pour qu’une passe groupée ne la remplace pas.',
    'upload' => 'Envoyer',
    'upload_file' => 'Image',
    'upload_file_helper' => 'N’importe quelle image jusqu’à 4 Mo, dessin SVG compris ; tout ce qui n’est pas PNG, JPEG ou WebP est converti en WebP. Une image envoyée est verrouillée, pour qu’une passe groupée ne la remplace pas.',

    // ---- ce qu’on peut faire sur une ligne -------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'Le nombre dans l’adresse Steam d’un jeu - store.steampowered.com/app/892970 donne 892970. Récupérer par identifiant verrouille l’image, parce que taper un nombre est une décision et qu’une passe groupée ultérieure ne doit pas l’annuler.',

    'fetch_igdb' => 'IGDB',
    'search_term' => 'Rechercher',
    'search_term_helper' => 'Le nom de l’egg est prérempli, mais c’est rarement le nom du jeu - « Paper 1.20.4 », c’est Minecraft. Tapez le jeu.',

    'lock' => 'Verrouiller',
    'unlock' => 'Déverrouiller',
    'locked_done' => 'Verrouillée - une passe groupée laissera celle-ci tranquille',
    'unlocked_done' => 'Déverrouillée - une passe groupée peut remplacer cette image',

    'clear' => 'Effacer',
    'clear_confirm' => 'Retire l’image, le Steam App ID et le logo de la bibliothèque. L’egg revient à l’oiseau de Pelican, et la prochaine passe groupée réessaiera.',
    'cleared' => 'Image retirée',

    // ---- résultats -------------------------------------------------------
    'fetched' => 'Image enregistrée',
    'failed' => 'Aucune image n’a été enregistrée',

    /*
     * Une raison pour chacun, parce que ce sont des problèmes différents.
     *
     * Une récupération qui a échoué sur une faute de frappe et une qui a échoué
     * parce que le disque est plein ne devraient pas dire toutes les deux
     * « échec » - la première se règle en regardant le nombre, la seconde en
     * regardant le serveur.
     */
    'why_bad_id' => 'Ce n’est pas un Steam App ID.',
    'why_not_found' => 'Steam n’a rien à cette adresse. Vérifiez l’App ID - un jeu sans page de boutique n’a pas non plus d’image d’en-tête.',
    'why_no_match' => 'Rien n’a été trouvé sous ce nom. Essayez le nom réel du jeu plutôt que celui de l’egg.',
    'why_no_name' => 'Il n’y a rien à rechercher.',
    'why_no_token' => 'Twitch n’a pas délivré de jeton. Vérifiez le client ID et le secret sous « Identifiants ».',
    'why_not_configured' => 'IGDB a besoin d’un Twitch client ID et d’un secret. Renseignez-les sous « Identifiants ».',
    'why_empty' => 'La réponse était vide.',
    'why_large' => 'Cette image est bien plus grande qu’une icône et n’a pas été enregistrée.',
    'why_not_an_image' => 'Ce qui est revenu n’est pas une image. Cela veut dire le plus souvent qu’une page d’erreur a répondu avec un code de succès.',
    'why_wrong_format' => 'Cette image est dans un format que ce panel ne stocke pas. Pelican conserve le PNG, le JPEG et le WebP.',
    'why_unwritable' => 'L’image n’a pas pu être écrite. Vérifiez que storage/app/public appartient à l’utilisateur sous lequel tourne le panel, et que php artisan storage:link a bien été lancé.',
    'why_unknown' => 'Cela n’a pas fonctionné, et la raison n’en est pas une à laquelle ceci sache donner un nom.',
    'why_library_gone' => 'La bibliothèque d’illustrations n’a pas fourni cette image. Elle a peut-être été retirée, ou la bibliothèque était injoignable.',

    // ---- tout d’un coup --------------------------------------------------
    'bulk' => 'Récupérer toutes les manquantes',
    'bulk_confirm_steam' => 'Cherche chaque egg sans image et non verrouillé dans la bibliothèque d’illustrations Essentials, puis cherche sur Steam par nom ce que la bibliothèque n’a pas. Les eggs verrouillés et ceux qui ont déjà une image sont laissés tranquilles. Cela tourne en arrière-plan - vous serez prévenu à la fin.',
    'bulk_confirm_both' => 'Cherche chaque egg sans image et non verrouillé dans la bibliothèque d’illustrations Essentials, cherche sur Steam par nom ce que la bibliothèque n’a pas, puis essaie IGDB pour ce qui reste. Les eggs verrouillés et ceux qui ont déjà une image sont laissés tranquilles. Cela tourne en arrière-plan - vous serez prévenu à la fin.',

    'bulk_started' => 'Récupération en arrière-plan',
    'bulk_started_body' => 'Cela peut prendre plusieurs minutes sur un grand panel. Vous recevrez une notification une fois terminé, et vous pouvez quitter cette page.',

    'bulk_done' => 'Images des eggs terminées',
    'bulk_done_body' => ':fetched récupérées, :skipped laissées tranquilles, :failed sans rien trouvé. Un egg est laissé tranquille s’il est verrouillé ou s’il a déjà une image.',

    'bulk_failed' => 'La passe groupée n’a pas eu lieu',
    'bulk_failed_queue' => 'Elle n’a pas pu être confiée à la file. Cela demande un queue worker - vérifiez que pelican-queue tourne.',

    // ---- identifiants IGDB -----------------------------------------------
    'credentials' => 'Identifiants',
    'credentials_helper' => 'La bibliothèque d’illustrations et Steam fonctionnent sans rien de tout cela. Ceci ne sert qu’à IGDB, qui couvre les jeux qu’aucun des deux n’a - tout ce qui est sorti sur console, la plupart des eggs moddés.',
    'credentials_where' => 'Créez une application sur dev.twitch.tv/console, générez un client secret, et collez les deux ici. C’est gratuit.',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => 'Identifiants enregistrés',
    'credentials_failed' => 'Les identifiants n’ont pas pu être enregistrés',
];
